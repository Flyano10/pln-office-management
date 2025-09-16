@extends('layouts.app')

@section('content')
    <style>
        .card-custom {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100%;
        }

        .card-custom:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
        }

        .btn-custom-primary {
            background: linear-gradient(135deg, #004080 0%, #1e90ff 100%);
            border: none;
            border-radius: 8px;
            color: white;
            padding: 10px 20px;
            font-weight: 600;
            transition: background 0.3s ease;
            cursor: pointer;
            text-align: center;
            display: inline-block;
        }

        .btn-custom-primary:hover {
            background: linear-gradient(135deg, #1e90ff 0%, #004080 100%);
            color: white;
            text-decoration: none;
        }

        .card-body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: space-between;
            height: 100%;
        }

        .card-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        .card-title {
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .card-text {
            color: #6c757d;
            margin-bottom: 1rem;
            text-align: center;
        }
    </style>

    <div class="row row-cols-1 row-cols-md-4 g-4">
        <div class="col">
            <div class="card card-custom shadow-sm">
                <div class="card-body text-center">
                    <i class="fas fa-building card-icon text-primary"></i>
                    <h5 class="card-title">Kelola Kantor PLN</h5>
                    <p class="card-text">Tambah, edit, dan hapus data kantor PLN</p>
                    <a href="{{ route('admin.offices.index') }}" class="btn-custom-primary">Kelola Kantor</a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card card-custom shadow-sm">
                <div class="card-body text-center">
                    <i class="fas fa-map-marker-alt card-icon text-success"></i>
                    <h5 class="card-title">Peta Kantor PLN</h5>
                    <p class="card-text">Lihat lokasi semua kantor PLN di peta</p>
                    <a href="{{ route('admin.map') }}" class="btn-custom-primary">Lihat Peta</a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card card-custom shadow-sm">
                <div class="card-body text-center">
                    <i class="fas fa-home card-icon text-info"></i>
                    <h5 class="card-title">Kelola Gedung</h5>
                    <p class="card-text">Tambah, edit, dan hapus data gedung</p>
                    <a href="{{ route('admin.gedung.index') }}" class="btn-custom-primary">Kelola Gedung</a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card card-custom shadow-sm">
                <div class="card-body text-center">
                    <i class="fas fa-file-contract card-icon text-warning"></i>
                    <h5 class="card-title">Kelola Kontrak</h5>
                    <p class="card-text">Tambah, edit, dan hapus data kontrak</p>
                    <a href="{{ route('admin.kontrak.index') }}" class="btn-custom-primary">Kelola Kontrak</a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card card-custom shadow-sm">
                <div class="card-body text-center">
                    <i class="fas fa-file-alt card-icon text-info"></i>
                    <h5 class="card-title">Kelola Realisasi Kontrak</h5>
                    <p class="card-text">Tambah, edit, dan hapus data realisasi kontrak</p>
                    <a href="{{ route('admin.realisasi.index') }}" class="btn-custom-primary">Kelola Realisasi</a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card card-custom shadow-sm">
                <div class="card-body text-center">
                    <i class="fas fa-cogs card-icon text-danger"></i>
                    <h5 class="card-title">Kelola Operasional</h5>
                    <p class="card-text">Tambah, edit, dan hapus data operasional</p>
                    <a href="{{ route('admin.operasional.index') }}" class="btn-custom-primary">Kelola Operasional</a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card card-custom shadow-sm">
                <div class="card-body text-center">
                    <i class="fas fa-plus-circle card-icon text-secondary"></i>
                    <h5 class="card-title">Tambah Kantor Baru</h5>
                    <p class="card-text">Tambahkan kantor PLN baru ke sistem</p>
                    <a href="{{ route('admin.offices.create') }}" class="btn-custom-primary">Tambah Kantor</a>
                </div>
            </div>
        </div>
    </div>
@endsection
