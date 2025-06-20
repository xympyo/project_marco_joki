<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Shoe Laundry</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #e9ecef;
            /* Slightly different background color */
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        .login-container {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
            /* Slightly stronger shadow */
            padding: 40px;
            width: 100%;
            max-width: 420px;
            /* Slightly wider */
            text-align: center;
        }

        .login-container h2 {
            color: #212529;
            /* Darker heading color */
            margin-bottom: 20px;
        }

        .login-container .admin-label {
            font-size: 0.9em;
            color: #6c757d;
            margin-bottom: 30px;
            display: block;
        }

        .form-control {
            border-radius: 5px;
            border: 1px solid #ced4da;
        }

        .btn-admin-primary {
            background-color: #28a745;
            /* Green button for admin */
            border-color: #28a745;
            border-radius: 5px;
            padding: 10px 0;
            font-size: 1.1rem;
            width: 100%;
            /* Ensure full width */
        }

        .btn-admin-primary:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }

        .form-check-label a {
            color: #28a745;
            /* Link color matching button */
            text-decoration: none;
        }

        .form-check-label a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <h2>Admin Login</h2>
        <span class="admin-label">Access to Admin Panel</span>
        <form method="POST" action="{{ route('admin.login.post') }}"> {{-- Changed route name --}}
            @csrf

            <div class="mb-3 text-start">
                <label for="email" class="form-label">Email Address</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                    name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3 text-start">
                <label for="password" class="form-label">Password</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                    name="password" required autocomplete="current-password">
                @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3 form-check d-flex justify-content-between align-items-center">
                <div>
                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                        {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">
                        Remember Me
                    </label>
                </div>
            </div>

            <div class="d-grid mb-3">
                <button type="submit" class="btn btn-admin-primary">
                    Admin Login
                </button>
            </div>

        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
