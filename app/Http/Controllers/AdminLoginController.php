<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // For authentication methods
use App\Models\Admin; // IMPORTANT: Now using your new Admin model!
use Illuminate\Support\Facades\Hash; // For password hashing (though Admin model cast handles it)
use Illuminate\Validation\ValidationException; // For validation errors

class AdminLoginController extends Controller
{
    /**
     * The authentication guard for admins.
     * @var string
     */
    protected $guard = 'admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Apply the 'guest' middleware to this controller,
        // ensuring only unauthenticated users (for the 'admin' guard) can access
        // the login form. If an admin is already logged in, they'll be
        // redirected to the 'admin.dashboard'.
        // The 'except('logout')' ensures that the logout method is not affected by this middleware.
        $this->middleware('guest:' . $this->guard)->except('logout');
    }

    /**
     * Display the admin login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view("admin_login");
    }

    /**
     * Handle an incoming admin authentication request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {
        // Validate the incoming request data for admin login
        $credentials = $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        // Attempt to log in the admin using the 'admin' guard.
        // Auth::guard($this->guard) uses the 'admin' guard configured in config/auth.php.
        // The second argument, $request->boolean('remember'), handles the "remember me" functionality.
        if (Auth::guard($this->guard)->attempt($credentials, $request->boolean('remember'))) {
            // If authentication is successful, regenerate the session ID to prevent session fixation attacks.
            $request->session()->regenerate();

            // Redirect the admin to their intended URL or the default admin dashboard route.
            // 'admin.dashboard' is the named route defined in web.php.
            return redirect()->intended(route('admin.dashboard'))->with('success', 'Welcome, Admin!');
        }

        // If authentication fails, throw a validation exception with a custom error message.
        // This will automatically redirect the user back to the login form with the error.
        throw ValidationException::withMessages([
            'email' => 'These credentials do not match our admin records.',
        ]);
    }

    /**
     * Log the admin user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        // Log out the currently authenticated admin user using the 'admin' guard.
        Auth::guard($this->guard)->logout();

        // Invalidate the current session to remove all session data for security.
        $request->session()->invalidate();

        // Regenerate the CSRF token to prevent session fixation and CSRF token reuse.
        $request->session()->regenerateToken();

        // Redirect the admin back to the admin login page.
        return redirect(route('admin.login'))->with('success', 'You have been logged out from admin panel.');
    }
}
