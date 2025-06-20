<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Shoe Laundry</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #e9ecef;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .navbar {
            background-color: #28a745 !important;
        }

        .navbar-brand,
        .nav-link {
            color: #ffffff !important;
        }

        .content-section {
            padding: 60px 0;
            text-align: center;
            flex-grow: 1;
        }

        .welcome-message {
            margin-bottom: 40px;
        }

        .welcome-message h1 {
            color: #28a745;
            margin-bottom: 15px;
        }

        .card-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }

        .info-card {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
            padding: 25px;
            width: 100%;
            max-width: 350px;
            text-align: left;
            border-top: 5px solid #28a745;
        }

        .info-card h4 {
            color: #212529;
            margin-bottom: 15px;
        }

        .info-card p {
            margin-bottom: 10px;
        }

        .btn-action {
            margin-top: 20px;
            width: 100%;
        }

        .footer {
            background-color: #212529;
            color: #ffffff;
            padding: 20px 0;
            text-align: center;
            margin-top: auto;
        }

        .form-section {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin-top: 50px;
            text-align: left;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
            border-top: 5px solid #007bff;
        }

        .form-section h3 {
            color: #007bff;
            margin-bottom: 30px;
            text-align: center;
        }

        .content-list-section {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin-top: 50px;
            text-align: left;
            max-width: 1000px;
            margin-left: auto;
            margin-right: auto;
            border-top: 5px solid #ffc107;
        }

        .content-list-section h3 {
            color: #ffc107;
            margin-bottom: 30px;
            text-align: center;
        }

        .content-table th {
            background-color: #f2f2f2;
        }

        .content-table img {
            max-width: 80px;
            height: auto;
            border-radius: 4px;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('admin.dashboard') }}">Marco Putra Laundry Sepatu</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::guard('admin')->user()->email ?? 'Admin' }}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li>
                                <form id="admin-logout-form" action="{{ route('admin.logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                                <a class="dropdown-item" href="#"
                                    onclick="event.preventDefault(); document.getElementById('admin-logout-form').submit();">
                                    Admin Logout
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container content-section">
        <div class="welcome-message">
            <h1>Halo!,
                {{ Auth::guard('admin')->user()->name ?? (Auth::guard('admin')->user()->email ?? 'Administrator') }}!
            </h1>
            <p class="lead">Disini kamu bisa menambah jasa laundry, atau menghapus jasa laundry yang sudah ada!</p>
        </div>

        <div class="form-section">
            <h3>Tambah Jasa Laundry Sepatu Yang Baru</h3>
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Please fix the following errors:
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <form action="{{ route('admin.content.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="judul" class="form-label">Judul</label>
                    <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul"
                        name="judul" value="{{ old('judul') }}" required>
                    @error('judul')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="3"
                        required>{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="gambar" class="form-label">Upload Gambar Jasa Kamu</label>
                    <input type="file" class="form-control @error('gambar') is-invalid @enderror" id="gambar"
                        name="gambar">
                    @error('gambar')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="harga" class="form-label">Harga (Di Rupiah)</label>
                    <input type="number" class="form-control @error('harga') is-invalid @enderror" id="harga"
                        name="harga" value="{{ old('harga') }}" required min="0">
                    @error('harga')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="hari" class="form-label">Hari (Berapa Hari Kerja, Contoh: 2-3 Hari Kerja)</label>
                    <input type="text" class="form-control @error('hari') is-invalid @enderror" id="hari"
                        name="hari" value="{{ old('hari') }}" required>
                    @error('hari')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary btn-lg">Tambah Layanan Baru</button>
                </div>
            </form>
        </div>

        <div class="content-list-section mt-5">
            <h3>Jasa Layanan Laundry Sepatu Yang Telah Ada</h3>
            @if (session('success_delete'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success_delete') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if ($contents->isEmpty())
                <div class="alert alert-info text-center" role="alert">
                    No services added yet. Use the form above to add your first service!
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-striped table-hover content-table">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Judul</th>
                                <th scope="col">Deskripsi</th>
                                <th scope="col">Gambar</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Hari</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($contents as $content)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $content->judul }}</td>
                                    <td>{{ Str::limit($content->deskripsi, 50) }}</td>
                                    <td>
                                        @if ($content->gambar)
                                            {{-- IMPORTANT: Use Storage::url() to get the public path of the stored image --}}
                                            <img src="{{ Storage::url($content->gambar) }}"
                                                alt="{{ $content->judul }}" class="img-fluid"
                                                onerror="this.onerror=null;this.src='https://placehold.co/80x80/cccccc/333333?text=No+Image';">
                                        @else
                                            <img src="https://placehold.co/80x80/cccccc/333333?text=No+Image"
                                                alt="No Image" class="img-fluid">
                                        @endif
                                    </td>
                                    <td>Rp {{ number_format($content->harga, 0, ',', '.') }}</td>
                                    <td>{{ $content->hari }}</td>
                                    <td>
                                        <form action="{{ route('admin.content.destroy', $content->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this service?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p>&copy; {{ date('Y') }} Shoe Laundry Admin Panel. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
