<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marco Putra Laundry Sepatu | Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
        }

        .navbar {
            background-color: #343a40 !important;
        }

        .navbar-brand,
        .nav-link {
            color: #ffffff !important;
        }

        .navbar-nav .nav-link.active {
            font-weight: bold;
        }

        .hero-section {
            background: url('https://via.placeholder.com/1500x500/007bff/ffffff?text=Professional+Shoe+Care') no-repeat center center/cover;
            color: #ffffff;
            padding: 100px 0;
            text-align: center;
            position: relative;
        }

        .hero-section::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            /* Overlay for better text readability */
        }

        .hero-section .container {
            position: relative;
            z-index: 1;
        }

        .service-card {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 30px;
            text-align: center;
            transition: transform 0.3s ease-in-out;
            height: 100%;
            /* Ensure cards in a row have equal height */
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .service-card:hover {
            transform: translateY(-5px);
        }

        .service-card img {
            max-width: 100%;
            height: 200px;
            /* Fixed height for images */
            object-fit: cover;
            /* Ensure images cover the area without distortion */
            border-radius: 4px;
            margin-bottom: 15px;
        }

        .service-card h3 {
            color: #007bff;
            margin-bottom: 10px;
        }

        .service-card .price {
            font-size: 1.5rem;
            font-weight: bold;
            color: #28a745;
            margin-top: 15px;
        }

        .service-card .duration {
            font-style: italic;
            color: #6c757d;
            margin-bottom: 15px;
        }

        .footer {
            background-color: #343a40;
            color: #ffffff;
            padding: 40px 0;
            text-align: center;
            margin-top: 50px;
        }

        .footer a {
            color: #007bff;
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">Marco Putra Laundry Sepatu</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#services">Services</a>
                    </li>
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Register</a>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="{{ route('profile') }}">Profile</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                    </form>
                                    <a class="dropdown-item" href="#"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <section class="hero-section">
        <div class="container">
            <h1>Your Shoes Deserve the Best Care</h1>
            <p class="lead">Professional shoe laundry services for all types of footwear. Bring back their shine!</p>
            <a href="#services" class="btn btn-primary btn-lg mt-3">Explore Our Services</a>
        </div>
    </section>

    <section id="services" class="container py-5">
        <h2 class="text-center mb-5">Our Professional Shoe Care Services</h2>
        <div class="row">
            @if ($index->isEmpty())
                <div class="col-12">
                    <div class="alert alert-info text-center" role="alert">
                        No services available yet. Please check back later!
                    </div>
                </div>
            @else
                @foreach ($index as $item)
                    <div class="col-md-4">
                        <div class="service-card">
                            {{-- IMPORTANT: Use Storage::url() to get the public path of the stored image --}}
                            @if ($item->gambar)
                                <img src="{{ Storage::url($item->gambar) }}" alt="{{ $item->judul }}"
                                    onerror="this.onerror=null;this.src='https://placehold.co/400x200/cccccc/333333?text=No+Image';"
                                    loading="lazy">
                            @else
                                <img src="https://placehold.co/400x200/cccccc/333333?text=No+Image"
                                    alt="No Image Available">
                            @endif
                            <h3>{{ $item->judul }}</h3>
                            <p>{{ $item->deskripsi }}</p>
                            <p class="price">Rp {{ number_format($item->harga, 0, ',', '.') }}</p>
                            <p class="duration"> {{ $item->hari }} Hari Kerja </p>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </section>


    </section>

    <footer class="footer">
        <div class="container">
            <p>&copy; {{ date('Y') }} Marco Putra Laundry Sepatu. All rights reserved.</p>
            <p>
                <a href="#">Privacy Policy</a> |
                <a href="#">Terms of Service</a>
            </p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
