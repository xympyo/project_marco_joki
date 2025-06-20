<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Used for authentication methods
use App\Models\User; // Make sure to import your User model
use Illuminate\Support\Facades\Hash; // Used for manual password hashing if not relying on model casts
use Illuminate\Validation\ValidationException; // For throwing specific validation errors

class LoginController extends Controller
{
    /**
     * Display the login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view("login");
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {
        // Validate the incoming login request data.
        $credentials = $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        // Attempt to authenticate the user.
        // Auth::attempt verifies the credentials against the database.
        // The second argument handles the "remember me" functionality.
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            // If authentication is successful, regenerate the session to prevent session fixation.
            $request->session()->regenerate();

            // Redirect the user to their intended URL or a default home page.
            // You can change '/home' to any route name or URL you prefer after login.
            return redirect()->intended('/')->with('success', 'You have successfully logged in!');
        }

        // If authentication fails, throw a validation exception.
        // This will redirect the user back to the login form with an error message.
        throw ValidationException::withMessages([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    /**
     * Display the registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        return view("register");
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function register(Request $request)
    {
        // Validate the incoming registration request data.
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'], // 'unique:users' ensures email is not already in use.
            'password' => ['required', 'string', 'min:8', 'confirmed'], // 'confirmed' ensures password_confirmation matches.
        ]);

        // Create a new user in the database.
        // Your User model's `casts` property for 'password' => 'hashed' will automatically hash the password.
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password, // Password will be hashed by the User model's cast
        ]);

        // Log the newly created user into the application.
        Auth::login($user);

        // Redirect the user to a success page or their dashboard.
        // You can change '/home' to any route name or URL.
        return redirect('/')->with('success', 'Registration successful! Welcome to Shoe Laundry.');
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        // Log out the currently authenticated user.
        Auth::logout();

        // Invalidate the current session to remove session data.
        $request->session()->invalidate();

        // Regenerate the CSRF token to prevent token reuse attacks.
        $request->session()->regenerateToken();

        // Redirect the user back to the home page or any other desired location.
        return redirect('/')->with('success', 'You have been logged out.');
    }
}
