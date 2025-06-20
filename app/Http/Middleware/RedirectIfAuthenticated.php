<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string ...$guards The guards to check authentication against.
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        // If no specific guards are provided (e.g., if it's applied globally without parameters),
        // we'll default to checking all configured guards in config/auth.php.
        // This ensures the middleware covers all authentication types defined in your app.
        $guards = empty($guards) ? array_keys(config('auth.guards')) : $guards;

        foreach ($guards as $guard) {
            // Check if the current request's guard is authenticated.
            if (Auth::guard($guard)->check()) {
                // If the 'admin' guard is authenticated, redirect to the admin dashboard.
                if ($guard === 'admin') {
                    return redirect(route('admin.dashboard'));
                }
                // If any other guard (like 'web') is authenticated, redirect to the regular user dashboard.
                // This assumes 'dashboard' is the route name for your regular user dashboard.
                return redirect(route('dashboard'));
            }
        }

        return $next($request);
    }
}
