<?php

namespace App\Http\Controllers;

use App\Models\Offerte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class OfferteController extends Controller
{
    public function index(Request $request)
    {
        // Controleer of gebruiker Sales of Management is
        $user = Auth::user();
        if (!$user || !in_array($user->department ?? '', ['Sales', 'Management'])) {
            abort(403, 'Toegang geweigerd. Alleen Sales en Management hebben toegang tot offertes.');
        }

        return view('offerte.index');
    }

    public function show($id)
    {
        $user = Auth::user();
        if (!$user || !in_array($user->department ?? '', ['Sales', 'Management'])) {
            abort(403, 'Toegang geweigerd. Alleen Sales en Management hebben toegang tot offertes.');
        }

        $offerte = Offerte::with(['customer', 'products'])->findOrFail($id);

        return view('offerte.show', compact('offerte'));
    }

    public function create()
    {
        $user = Auth::user();
        if (!$user || !in_array($user->department ?? '', ['Sales', 'Management'])) {
            abort(403, 'Toegang geweigerd. Alleen Sales en Management hebben toegang tot offertes.');
        }

        return view('offerte.create');
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        if (!$user || !in_array($user->department ?? '', ['Sales', 'Management'])) {
            abort(403, 'Toegang geweigerd. Alleen Sales en Management hebben toegang tot offertes.');
        }

        $validated = $request->validate([
            'name_company_id' => ['required', 'exists:customers,id'],
            'product_ids' => ['required', 'array', 'min:1'],
            'product_ids.*' => ['required', 'exists:products,id'],
            'product_quantities' => ['required', 'array'],
            'product_quantities.*' => ['required', 'integer', 'min:1'],
            'valid_until' => ['nullable', 'date', 'after:today'],
            'delivery_time_weeks' => ['nullable', 'integer', 'min:1'],
            'payment_terms_days' => ['nullable', 'integer', 'min:1'],
            'custom_terms' => ['nullable', 'string', 'max:5000'],
            'status' => ['required', 'in:pending,draft'],
        ]);

        // Store primary product in product_id for backward compatibility
        $primaryProduct = $validated['product_ids'][0] ?? null;

        $offerte = Offerte::create([
            'name_company_id' => $validated['name_company_id'],
            'product_id' => $primaryProduct,
            'status' => $validated['status'],
            'valid_until' => $validated['valid_until'] ?? now()->addDays(30),
            'delivery_time_weeks' => $validated['delivery_time_weeks'] ?? null,
            'payment_terms_days' => $validated['payment_terms_days'] ?? null,
            'custom_terms' => $validated['custom_terms'] ?? null,
        ]);

        // Attach products many-to-many with quantity
        $syncData = [];
        foreach ($validated['product_ids'] as $productId) {
            $qty = $validated['product_quantities'][$productId] ?? 1;
            $syncData[$productId] = ['quantity' => $qty];
        }
        $offerte->products()->sync($syncData);

        // Redirect based on status
        if ($validated['status'] === 'draft') {
            return redirect()->route('offertes.edit', $offerte->id)->with('success', 'Concept opgeslagen.');
        }

        return redirect()->route('offertes.show', $offerte->id)->with('success', 'Offerte aangemaakt.');
    }

    public function downloadPdf($id)
    {
        $user = Auth::user();
        if (!$user || !in_array($user->department ?? '', ['Sales', 'Management'])) {
            abort(403, 'Toegang geweigerd. Alleen Sales en Management hebben toegang tot offertes.');
        }

        $offerte = Offerte::with(['customer', 'products'])->findOrFail($id);
        $pdf = Pdf::loadView('offerte.pdf', compact('offerte'));
        $filename = 'Offerte-OFF-' . date('Y', strtotime($offerte->created_at)) . '-' . str_pad($offerte->id, 3, '0', STR_PAD_LEFT) . '.pdf';
        return $pdf->download($filename);
    }

    public function edit($id)
    {
        $user = Auth::user();
        if (!$user || !in_array($user->department ?? '', ['Sales', 'Management'])) {
            abort(403, 'Toegang geweigerd. Alleen Sales en Management hebben toegang tot offertes.');
        }

        $offerte = Offerte::with(['customer', 'products'])->findOrFail($id);

        return view('offerte.edit', compact('offerte'));
    }

    public function update(Request $request, $id)
    {
        $user = Auth::user();
        if (!$user || !in_array($user->department ?? '', ['Sales', 'Management'])) {
            abort(403, 'Toegang geweigerd. Alleen Sales en Management hebben toegang tot offertes.');
        }

        $validated = $request->validate([
            'name_company_id' => ['required', 'exists:customers,id'],
            'product_ids' => ['required', 'array', 'min:1'],
            'product_ids.*' => ['required', 'exists:products,id'],
            'product_quantities' => ['required', 'array'],
            'product_quantities.*' => ['required', 'integer', 'min:1'],
            'status' => ['required', 'in:accepted,rejected,pending,draft'],
        ]);

        $offerte = Offerte::findOrFail($id);

        // Store primary product in product_id for backward compatibility
        $primaryProduct = $validated['product_ids'][0] ?? null;

        $offerte->update([
            'name_company_id' => $validated['name_company_id'],
            'product_id' => $primaryProduct,
            'status' => $validated['status'],
        ]);

        // Sync products many-to-many with quantity
        $syncData = [];
        foreach ($validated['product_ids'] as $productId) {
            $qty = $validated['product_quantities'][$productId] ?? 1;
            $syncData[$productId] = ['quantity' => $qty];
        }
        $offerte->products()->sync($syncData);

        return redirect()->route('offertes.show', $offerte->id)->with('success', 'Offerte bijgewerkt.');
    }
}
