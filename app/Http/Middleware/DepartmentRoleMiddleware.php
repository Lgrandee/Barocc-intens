<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class DepartmentRoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            return redirect('login'); // Not logged in
        }

        $user = Auth::user();

        // Admin has all access
        if ($user->department === 'Management') {
            return $next($request);
        }

        // Check roles from parameters, e.g. ->middleware('departmentRole:Sales,Finance')
        foreach ($roles as $role) {
            if ($user->department === $role) {
                return $next($request);
            }
        }

        return redirect('login'); // Not authorized
    }
}
