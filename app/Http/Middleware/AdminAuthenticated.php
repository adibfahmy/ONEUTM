<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            /** @var \App\Models\User $user */
            $user = Auth::user();

            // Allow access for admins
            if ($user->hasRole('admin')) {
                return $next($request);
            }

            // Deny access for non-admin users
             abort(403, 'Access denied. You do not have sufficient permissions.');
        }

        // Redirect unauthenticated users to the login page
        return redirect()->route('login')->with('error', 'Please log in to access this page.');
    }
}
