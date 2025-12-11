<?php

// /app/Http/Middleware/IsSuperAdmin.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class IsSuperAdmin
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is authenticated AND has the 'super_admin' role.
        if (Auth::check() && Auth::user()->role === 'super_admin') {
            return $next($request);
        }

        // Deny access with a 403 Forbidden response.
        return response()->view('errors.403', [], 403);
    }
}
