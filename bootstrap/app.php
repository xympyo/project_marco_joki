<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request; // Added this import for the closure below

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Default redirect for guests when accessing auth-protected routes
        $middleware->redirectGuestsTo(fn() => route('login'));

        // Alias your custom RedirectIfAuthenticated as the 'guest' middleware
        $middleware->alias([
            'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
            'auth' => \Illuminate\Auth\Middleware\Authenticate::class, // Ensure default 'auth' is aliased
        ]);

        // Add your custom middlewares to the web group
        $middleware->web(append: [
            // \App\Http\Middleware\VerifyCsrfToken::class, // Already typically included by default
            // \Illuminate\Session\Middleware\StartSession::class, // Already typically included by default
            // Add other global web middleware here if needed.
            \App\Http\Middleware\ForceLogoutOnNavigate::class, // IMPORTANT: ADD THIS LINE
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
