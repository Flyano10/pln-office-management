1
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'PLN System') }}</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --bs-primary: #004080;
            --bs-primary-rgb: 0, 64, 128;
            --bs-secondary: #6c757d;
            --bs-success: #28a745;
            --bs-info: #17a2b8;
            --bs-warning: #ffc107;
            --bs-danger: #dc3545;
            --bs-light: #f8f9fa;
            --bs-dark: #343a40;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
        }

        .navbar-custom {
            background: linear-gradient(135deg, #004080 0%, #1e90ff 100%);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .sidebar {
            background: #ffffff;
            min-height: calc(100vh - 76px);
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
        }

        .sidebar .nav-link {
            color: #495057;
            font-weight: 500;
            padding: 12px 20px;
            margin: 5px 10px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background-color: #e3f2fd;
            color: #004080;
        }

        .sidebar .nav-link i {
            margin-right: 10px;
            width: 20px;
        }

        .card-custom {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        }

        .btn-custom-primary {
            background: linear-gradient(135deg, #004080 0%, #1e90ff 100%);
            border: none;
            border-radius: 8px;
            font-weight: 500;
            padding: 10px 20px;
            transition: all 0.3s ease;
        }

        .btn-custom-primary:hover {
            background: linear-gradient(135deg, #003366 0%, #0066cc 100%);
            transform: translateY(-1px);
            box-shadow: 0 4px 15px rgba(0, 64, 128, 0.3);
        }

        .table-custom {
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .table-custom thead th {
            background: linear-gradient(135deg, #004080 0%, #1e90ff 100%);
            color: white;
            border: none;
            font-weight: 600;
            padding: 15px;
        }

        .table-custom tbody tr:hover {
            background-color: #f8f9fa;
        }

        .form-control-custom {
            border: 2px solid #e9ecef;
            border-radius: 8px;
            padding: 12px 15px;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .form-control-custom:focus {
            border-color: #004080;
            box-shadow: 0 0 0 0.2rem rgba(0, 64, 128, 0.25);
        }

        .badge-custom {
            border-radius: 20px;
            font-weight: 500;
            padding: 6px 12px;
        }

        .stats-card {
            background: linear-gradient(135deg, #004080 0%, #1e90ff 100%);
            color: white;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .stats-card h2 {
            font-size: 2.5rem;
            font-weight: 700;
            margin: 10px 0;
        }

        .stats-card h5 {
            font-weight: 600;
            opacity: 0.9;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center text-white" href="{{ route('welcome') }}">
                <img src="{{ asset('images/logo-pln.png') }}" alt="PLN Logo" height="60" class="me-3"
                    style="filter: brightness(1.1);">
                <span class="fw-bold fs-5">PLN Asset & Property</span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    @auth
                        @if (auth()->user()->isAdmin())
                            <li class="nav-item">
                                <a class="nav-link text-white fw-semibold" href="{{ route('admin.dashboard') }}">
                                    <i class="fas fa-tachometer-alt me-1"></i>Dashboard
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white fw-semibold" href="{{ route('admin.map') }}">
                                    <i class="fas fa-map-marker-alt me-1"></i>Map
                                </a>
                            </li>
                            <li class="nav-item">
                                <form action="{{ route('admin.logout') }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-light ms-3">
                                        <i class="fas fa-sign-out-alt me-1"></i>Logout
                                    </button>
                                </form>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link text-white fw-semibold" href="{{ route('user.offices.index') }}">
                                    <i class="fas fa-building me-1"></i>Kantor PLN
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white fw-semibold" href="{{ route('user.map') }}">
                                    <i class="fas fa-map me-1"></i>Peta
                                </a>
                            </li>
                            <li class="nav-item">
                                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-light ms-3">
                                        <i class="fas fa-sign-out-alt me-1"></i>Logout
                                    </button>
                                </form>
                            </li>
                        @endif
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            @auth
                @if (auth()->user()->isAdmin())
                    <!-- Admin Sidebar -->
                    <div class="col-md-2 sidebar p-0">
                        <nav class="nav flex-column py-3">
                            <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                                href="{{ route('admin.dashboard') }}">
                                <i class="fas fa-tachometer-alt"></i> Dashboard
                            </a>
                            <a class="nav-link {{ request()->routeIs('admin.offices.*') ? 'active' : '' }}"
                                href="{{ route('admin.offices.index') }}">
                                <i class="fas fa-building"></i> Kantor PLN
                            </a>
                            <a class="nav-link {{ request()->routeIs('admin.gedung.*') ? 'active' : '' }}"
                                href="{{ route('admin.gedung.index') }}">
                                <i class="fas fa-home"></i> Gedung
                            </a>
                            <a class="nav-link {{ request()->routeIs('admin.kontrak.*') ? 'active' : '' }}"
                                href="{{ route('admin.kontrak.index') }}">
                                <i class="fas fa-file-contract"></i> Kontrak
                            </a>
                            <a class="nav-link d-flex align-items-center {{ request()->routeIs('admin.realisasi.*') ? 'active' : '' }}"
                                href="{{ route('admin.realisasi.index') }}">
                                <i class="fas fa-file-alt me-2"></i> Realisasi Kontrak
                            </a>
                            <a class="nav-link {{ request()->routeIs('admin.operasional.*') ? 'active' : '' }}"
                                href="{{ route('admin.operasional.index') }}">
                                <i class="fas fa-cogs"></i> Operasional
                            </a>
                            <a class="nav-link {{ request()->routeIs('admin.map') ? 'active' : '' }}"
                                href="{{ route('admin.map') }}">
                                <i class="fas fa-map"></i> Peta
                            </a>
                        </nav>
                    </div>
                    <div class="col-md-10 p-4">
                        @yield('content')
                    </div>
                @else
                    <!-- User Content -->
                    <div class="col-12 p-4">
                        @yield('content')
                    </div>
                @endif
            @else
                <!-- Guest Content -->
                <div class="col-12 p-4">
                    @yield('content')
                </div>
            @endauth
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
