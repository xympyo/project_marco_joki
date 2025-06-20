<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ForceLogoutOnNavigate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Process the request first. This allows the current page to render while
        // the user is still considered authenticated. The logout will occur
        // after this response is prepared.
        $response = $next($request);

        // Define routes that should NOT trigger an immediate logout.
        // These are typically the login, registration, and logout action routes themselves,
        // as well as any form submission routes (like content creation/deletion).
        $excludedRoutes = [
            'login',            // GET for user login form
            'register',         // GET for user register form
            'logout',           // POST for user logout action
            'admin.login',      // GET for admin login form
            'admin.logout',     // POST for admin logout action

            // Also exclude the POST routes that handle the form submissions,
            // otherwise the user would be logged out before being redirected properly.
            'login',            // POST for user login submission
            'register',         // POST for user registration submission
            'admin.login.post', // POST for admin login submission
            'admin.content.store', // POST for admin content creation
            'admin.content.destroy', // DELETE for admin content deletion
        ];

        // Get the current route name. If no route name is available (e.g., 404), it will be null.
        $routeName = $request->route() ? $request->route()->getName() : null;

        // Check if the current route is NOT one of the excluded authentication/action routes.
        if (!in_array($routeName, $excludedRoutes)) {
            // Check if a regular user is authenticated.
            if (Auth::guard('web')->check()) {
                Auth::guard('web')->logout();
                // Invalidate and regenerate session for the web guard
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                // You could add a log here for debugging: \Log::info('Web user logged out by ForceLogoutOnNavigate for route: ' . $routeName);
            }

            // Check if an admin user is authenticated.
            if (Auth::guard('admin')->check()) {
                Auth::guard('admin')->logout();
                // Invalidate and regenerate session for the admin guard
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                // You could add a log here for debugging: \Log::info('Admin user logged out by ForceLogoutOnNavigate for route: ' . $routeName);
            }
        }

        // Return the response, which was prepared with the user still authenticated.
        // The logout will take effect for the *next* request.
        return $response;
    }
}
