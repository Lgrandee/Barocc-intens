<?php

namespace App\Http\Controllers;

use App\Models\PlanningTicket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MaintenanceController extends Controller
{
    /**
     * Display the maintenance planning page (only for logged-in technician)
     */
    public function planning(Request $request)
    {
        // Technician can only see their own planning
        $userId = Auth::id();

        // Update overdue tasks to 'te_laat' status
        PlanningTicket::where('user_id', $userId)
            ->where('status', 'open')
            ->where('scheduled_time', '<', now())
            ->update(['status' => 'te_laat']);

        $query = PlanningTicket::with(['user', 'feedback.customer', 'feedback.products'])
            ->where('user_id', $userId);

        // Search filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->whereHas('feedback.customer', function($customerQuery) use ($search) {
                    $customerQuery->where('name_company', 'like', "%{$search}%");
                })
                ->orWhere('location', 'like', "%{$search}%");
            });
        }

        // Status filter
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Category filter
        if ($request->filled('category')) {
            $query->where('catagory', $request->category);
        }

        $planningTickets = $query->orderBy('scheduled_time', 'desc')->paginate(15);

        return view('technician.planning', compact('planningTickets'));
    }



    /**
     * Display the specified maintenance task details
     */
    public function show($id)
    {
        // Technician can only see their own tasks
        $userId = Auth::id();

        $task = PlanningTicket::with(['user', 'feedback.customer', 'feedback.products'])
            ->where('catagory', 'service')
            ->where('user_id', $userId)
            ->findOrFail($id);

        return view('technician.detail', compact('task'));
    }

    /**
     * Show rapport form
     */
    public function rapport($id)
    {
        $userId = Auth::id();

        $task = PlanningTicket::with(['user', 'feedback.customer', 'feedback.products'])
            ->where('catagory', 'service')
            ->where('user_id', $userId)
            ->findOrFail($id);

        return view('technician.rapport', compact('task'));
    }

    /**
     * Update the feedback/rapport for a maintenance task
     */
    public function updateRapport(Request $request, $id)
    {
        $userId = Auth::id();

        $task = PlanningTicket::with('feedback')
            ->where('catagory', 'service')
            ->where('user_id', $userId)
            ->findOrFail($id);

        $request->validate([
            'feedback' => 'required|string|max:5000',
            'status' => 'required|in:voltooid,probleem,te_laat',
            'used_materials' => 'nullable|string|max:2000',
        ]);

        $task->feedback->update([
            'feedback' => $request->feedback,
        ]);

        $task->update([
            'status' => $request->status,
            'used_materials' => $request->used_materials,
        ]);

        return redirect()->route('technician.onderhoud.show', $id)
            ->with('success', 'Rapport succesvol opgeslagen en status bijgewerkt');
    }
}
