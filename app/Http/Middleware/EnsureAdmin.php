<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureAdmin
{
    /**
     * Handle an incoming request.
     * Only allow access if session indicates an admin user or user.role == 'admin'.
     */
    public function handle(Request $request, Closure $next)
    {
        // Check for explicit admin session
        if (session('admin')) {
            return $next($request);
        }

        // Check for user session with role set to admin
        $user = session('user');
        if (is_array($user) && isset($user['role']) && $user['role'] === 'admin') {
            return $next($request);
        }

        // Not authorized: redirect to login (admin) or show 403
        return redirect('/login')->with('error', 'Unauthorized: admin access only.');
    }
}
