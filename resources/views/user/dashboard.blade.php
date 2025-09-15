@extends('layouts.app')

@section('content')
    <div class="text-center mb-5">
        <h1 class="fw-bold text-primary mb-2">Dashboard User</h1>
        <p class="text-muted">Selamat datang, {{ auth()->user()->name }}</p>
    </div>

    <div class="row mb-5">
        <div class="col-md-4">
            <div class="stats-card">
                <h5>Total Kantor PLN</h5>
                <h2>{{ \App\Models\PlnOffice::count() }}</h2>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stats-card">
                <h5>Kantor Pusat</h5>
                <h2>{{ \App\Models\PlnOffice::where('office_type', 'Pusat')->count() }}</h2>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stats-card">
                <h5>SBU</h5>
                <h2>{{ \App\Models\PlnOffice::where('office_type', 'SBU')->count() }}</h2>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card card-custom h-100">
                <div class="card-body text-center d-flex flex-column">
                    <i class="fas fa-building fa-4x text-primary mb-4"></i>
                    <h4 class="card-title fw-bold">Lihat Kantor PLN</h4>
                    <p class="card-text text-muted flex-grow-1">Lihat daftar lengkap dan detail kantor PLN di seluruh Indonesia</p>
                    <a href="{{ route('user.offices.index') }}" class="btn btn-custom-primary mt-auto">
                        <i class="fas fa-list me-2"></i>Lihat Kantor
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card card-custom h-100">
                <div class="card-body text-center d-flex flex-column">
                    <i class="fas fa-map-marked-alt fa-4x text-success mb-4"></i>
                    <h4 class="card-title fw-bold">Peta Kantor PLN</h4>
                    <p class="card-text text-muted flex-grow-1">Eksplorasi lokasi semua kantor PLN melalui peta interaktif</p>
                    <a href="{{ route('user.map') }}" class="btn btn-custom-primary mt-auto">
                        <i class="fas fa-map-marker-alt me-2"></i>Lihat Peta
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
