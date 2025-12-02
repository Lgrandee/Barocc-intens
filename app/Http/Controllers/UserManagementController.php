<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class UserManagementController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if (!$user || $user->department !== 'Management') {
            abort(403, 'Toegang geweigerd. Alleen Management heeft toegang tot gebruikersbeheer.');
        }

        $query = User::query();

        // Zoekterm filter (naam of email)
        if (request()->filled('search')) {
            $search = request('search');
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Rol filter
        if (request()->filled('role')) {
            $query->where('department', request('role'));
        }

        // Status filter
        if (request()->filled('status')) {
            $query->where('status', request('status'));
        }

        $users = $query->orderBy('created_at', 'desc')->paginate(15)->appends(request()->query());

        return view('management.users.index', compact('users'));
    }

    public function create()
    {
        $user = Auth::user();
        if (!$user || $user->department !== 'Management') {
            abort(403, 'Toegang geweigerd. Alleen Management heeft toegang tot gebruikersbeheer.');
        }

        return view('management.users.form');
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        if (!$user || $user->department !== 'Management') {
            abort(403, 'Toegang geweigerd. Alleen Management heeft toegang tot gebruikersbeheer.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone_num' => 'nullable|string|max:20',
            'department' => 'required|in:Sales,Purchasing,Finance,Technician,Planner,Management',
            'status' => 'required|in:active,inactive,vacation',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Hash password
        $validated['password'] = Hash::make($validated['password']);

        // Set last_active to now for new users
        $validated['last_active'] = now();

        $newUser = User::create($validated);

        // TODO: Send welcome email if checkbox is checked
        if ($request->has('send_welcome_email')) {
            // Mail::to($newUser->email)->send(new WelcomeEmail($newUser));
        }

        return redirect()->route('management.users.index')
            ->with('success', 'Werknemer succesvol aangemaakt!');
    }

    public function edit($id)
    {
        $user = Auth::user();
        if (!$user || $user->department !== 'Management') {
            abort(403, 'Toegang geweigerd. Alleen Management heeft toegang tot gebruikersbeheer.');
        }

        $user = User::findOrFail($id);

        return view('management.users.form', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $authUser = Auth::user();
        if (!$authUser || $authUser->department !== 'Management') {
            abort(403, 'Toegang geweigerd. Alleen Management heeft toegang tot gebruikersbeheer.');
        }

        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'phone_num' => 'nullable|string|max:20',
            'department' => 'required|in:Sales,Purchasing,Finance,Technician,Planner,Management',
            'status' => 'required|in:active,inactive,vacation',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        // Handle password update (only if provided)
        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()->route('management.users.index')
            ->with('success', 'Werknemer succesvol bijgewerkt!');
    }

    public function destroy($id)
    {
        $user = Auth::user();
        if (!$user || $user->department !== 'Management') {
            abort(403, 'Toegang geweigerd. Alleen Management heeft toegang tot gebruikersbeheer.');
        }

        $userToDelete = User::findOrFail($id);

        // Prevent self-deletion
        if ($userToDelete->id === $user->id) {
            return redirect()->route('management.users.index')
                ->with('error', 'Je kunt je eigen account niet verwijderen!');
        }

        $userToDelete->delete();

        return redirect()->route('management.users.index')
            ->with('success', 'Werknemer succesvol verwijderd!');
    }
}
