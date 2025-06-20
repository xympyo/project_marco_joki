<?php

use App\Http\Controllers\ContentController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminLoginController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the "web" middleware group and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Your Home/Landing Page Route (publicly accessible)
Route::get("/", [ContentController::class, "index"])->name("landing");

// --- User Authentication Routes using LoginController ---
// Apply the 'guest' middleware to ensure only unauthenticated users can access these.
Route::middleware('guest')->group(function () {
    Route::get("/login", [LoginController::class, "showLoginForm"])->name("login");
    Route::post("/login", [LoginController::class, "login"]);
    Route::get("/register", [LoginController::class, "showRegistrationForm"])->name("register");
    Route::post("/register", [LoginController::class, "register"]);
});
// Logout route does not use 'guest' middleware as it's for authenticated users
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// --- Routes that require regular user authentication ---
// All routes defined within this group will only be accessible to logged-in regular users.
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', function () {
        return view('profile');
    })->name('profile');

    // Add any other user-specific routes here
});

// --- Admin Authentication & Content Management Routes ---
// These routes are specifically for admin login and content management.
Route::prefix('admin')->name('admin.')->group(function () {

    // Admin Login Routes - Apply 'guest:admin' middleware to ensure only unauthenticated admins can access these.
    // The 'guest:admin' middleware ensures that if an admin is already logged in, they are redirected.
    Route::middleware('guest:admin')->group(function () {
        Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [AdminLoginController::class, 'login'])->name('login.post');
    });

    // Admin Logout Route
    Route::post('/logout', [AdminLoginController::class, 'logout'])->name('logout')->middleware('auth:admin');

    // --- Routes that require admin authentication ---
    // All routes within this nested group will only be accessible to logged-in admins.
    Route::middleware('auth:admin')->group(function () {
        // Admin Dashboard
        Route::get('/dashboard', [ContentController::class, 'indexAdmin'])->name('dashboard');

        // Admin User Management Page (Placeholder)
        Route::get('/users', function () {
            return "Admin User Management Page";
        })->name('users');

        // --- Content Management Routes ---
        // Route for storing new content (from the form on admin dashboard)
        Route::post('/content', [ContentController::class, 'store'])->name('content.store');
        // Route for deleting content
        Route::delete('/content/{content}', [ContentController::class, 'destroy'])->name('content.destroy');
    });
});
