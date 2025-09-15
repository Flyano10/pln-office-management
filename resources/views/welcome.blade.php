@extends('layouts.app')

@section('content')
    <style>
        /* Card hover effect */
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            transition: all 0.3s ease;
        }

        /* Header background illustration */
        .header-bg {
            position: relative;
            background: url('{{ asset('images/electricity-bg.svg') }}') no-repeat center center;
            background-size: cover;
            border-radius: 12px;
            padding: 40px 30px;
            margin-bottom: 30px;
            color: #004080;
        }

        /* Differentiate buttons */
        .btn-primary-custom {
            background-color: #004080;
            border-color: #004080;
        }
        .btn-primary-custom:hover {
            background-color: #003366;
            border-color: #003366;
        }
        .btn-outline-primary-custom {
            color: #2c7be5;
            border-color: #2c7be5;
        }
        .btn-outline-primary-custom:hover {
            background-color: #2c7be5;
            color: white;
        }
    </style>

    <div class="container py-5">
        <div class="row align-items-center header-bg">
            <div class="col-md-6">
                <img src="{{ asset('images/logo-pln.png') }}" alt="PLN Icon Plus" style="height: 50px; margin-bottom: 20px;">
                <h5 class="text-primary fw-bold">PLN ICON PLUS</h5>
                <h1 class="display-4 fw-bold">
                    Sistem Informasi <br />
                    <span class="text-primary">Asset & Property</span>
                </h1>
                <p class="lead text-secondary">
                    Platform terintegrasi untuk pengelolaan dan monitoring aset properti PLN di seluruh Indonesia.
                    Mendukung efisiensi operasional dan pengambilan keputusan strategis.
                </p>
                <div class="d-flex gap-3 my-4">
                    <a href="{{ route('user.offices.index') }}" class="btn btn-primary btn-lg shadow-sm btn-primary-custom">
                        <i class="fas fa-search me-2"></i> Cari Kantor
                    </a>
                    <a href="{{ route('user.map') }}" class="btn btn-outline-primary btn-lg shadow-sm btn-outline-primary-custom">
                        <i class="fas fa-map-marker-alt me-2"></i> Peta Lokasi
                    </a>
                </div>
            </div>
            <div class="col-md-6 position-relative">
                <img src="{{ asset('images/peta.png') }}" alt="Peta Indonesia" class="img-fluid rounded shadow-sm" />
                <div class="position-absolute top-0 end-0 m-3 p-2 bg-white rounded shadow-sm"
                    style="min-width: 50px; text-align: center;">
                    <i class="fas fa-building text-primary"></i>
                    <div class="fw-bold text-primary">3</div>
                </div>
            </div>
        </div>

        <div class="mt-4 d-flex gap-3">
            <!-- Removed duplicate buttons -->
        </div>

        <div class="row mt-5 text-center">
            <h3>Akses Cepat</h3>
            <p>Navigasi langsung ke fitur utama sistem</p>
            <div class="d-flex justify-content-center gap-4 flex-wrap">
                <div class="card card-hover shadow-sm" style="width: 12rem;">
                    <div class="card-body">
                        <i class="fas fa-building fa-2x text-primary mb-3"></i>
                        <h5 class="card-title">Daftar Kantor</h5>
                        <p class="card-text">Lihat semua kantor PLN</p>
                        <a href="{{ route('user.offices.index') }}" class="btn btn-outline-primary">Buka</a>
                    </div>
                </div>
                <div class="card card-hover shadow-sm" style="width: 12rem;">
                    <div class="card-body">
                        <i class="fas fa-map fa-2x text-success mb-3"></i>
                        <h5 class="card-title">Peta Lokasi</h5>
                        <p class="card-text">Visualisasi geografis</p>
                        <a href="{{ route('user.map') }}" class="btn btn-outline-success">Buka</a>
                    </div>
                </div>
                <div class="card card-hover shadow-sm" style="width: 12rem;">
                    <div class="card-body">
                        <i class="fas fa-chart-line fa-2x text-warning mb-3"></i>
                        <h5 class="card-title">Dashboard</h5>
                        <p class="card-text">Statistik & analitik</p>
                        <a href="#" class="btn btn-outline-info">Buka</a>
                    </div>
                </div>
                <div class="card card-hover shadow-sm" style="width: 12rem;">
                    <div class="card-body">
                        <i class="fas fa-file-alt fa-2x text-danger mb-3"></i>
                        <h5 class="card-title">Laporan</h5>
                        <p class="card-text">Export & reporting</p>
                        <span class="badge bg-danger">Coming Soon</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-md-8">
                <h3>Tentang Sistem</h3>
                <p>
                    Sistem Informasi Asset & Property PLN dikembangkan untuk memfasilitasi pengelolaan aset properti
                    perusahaan secara terintegrasi. Sistem ini menyediakan platform digital yang mendukung proses bisnis
                    pengelolaan properti PLN dengan fitur-fitur modern dan user-friendly.
                </p>
                <ul class="list-unstyled">
                    <li><i class="fas fa-check text-success me-2"></i>Database terpusat semua kantor PLN</li>
                    <li><i class="fas fa-check text-success me-2"></i>Sistem pencarian canggih</li>
                    <li><i class="fas fa-check text-success me-2"></i>Peta interaktif dengan lokasi real-time</li>
                    <li><i class="fas fa-check text-success me-2"></i>Dashboard analitik & reporting</li>
                </ul>
            </div>
            <div class="col-md-4">
                <div class="p-3 bg-white rounded shadow-sm">
                    <h5><i class="fas fa-headset me-2"></i> Butuh Bantuan?</h5>
                    <p>Hubungi tim support untuk bantuan teknis atau informasi lebih lanjut.</p>
                    <p><i class="fas fa-envelope me-2"></i> internal@plniconplus.co.id</p>
                    <p><i class="fas fa-clock me-2"></i> Support 24/7</p>
                </div>
            </div>
        </div>

        <footer class="mt-5 py-4 bg-dark text-white">
            <div class="container d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <img src="{{ asset('images/logo-pln.png') }}" alt="PLN Icon Plus"
                        style="height: 30px; margin-right: 10px;">
                    <div>
                        <div>PT PLN ICON PLUS</div>
                        <div>Sistem Informasi Asset & Property</div>
                    </div>
                </div>
                <div>
                    <div><i class="fas fa-code-branch me-2"></i> Version 1.0.0</div>
                    <div><i class="fas fa-calendar-alt me-2"></i> Senin, 15 September 2025</div>
                </div>
                <div>
                    &copy; 2025 PLN Icon Plus. All rights reserved.
                </div>
            </div>
        </footer>
    </div>
@endsection
