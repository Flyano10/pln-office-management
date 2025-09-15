@extends('layouts.app')

@section('content')
    <div class="row mb-4">
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
        <div class="col-md-3 mb-3">
            <div class="card card-custom">
                <div class="card-body text-center">
                    <i class="fas fa-building fa-3x text-primary mb-3"></i>
                    <h5>Kelola Kantor PLN</h5>
                    <p class="text-muted">Tambah, edit, dan hapus data kantor PLN</p>
                    <a href="{{ route('admin.offices.index') }}" class="btn btn-custom-primary">Kelola Kantor</a>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card card-custom">
                <div class="card-body text-center">
                    <i class="fas fa-map-marker-alt fa-3x text-success mb-3"></i>
                    <h5>Peta Kantor PLN</h5>
                    <p class="text-muted">Lihat lokasi semua kantor PLN di peta</p>
                    <a href="{{ route('admin.map') }}" class="btn btn-custom-primary">Lihat Peta</a>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card card-custom">
                <div class="card-body text-center">
                    <i class="fas fa-home fa-3x text-info mb-3"></i>
                    <h5>Kelola Gedung</h5>
                    <p class="text-muted">Tambah, edit, dan hapus data gedung</p>
                    <a href="{{ route('admin.gedung.index') }}" class="btn btn-custom-primary">Kelola Gedung</a>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card card-custom">
                <div class="card-body text-center">
                    <i class="fas fa-file-contract fa-3x text-warning mb-3"></i>
                    <h5>Kelola Kontrak</h5>
                    <p class="text-muted">Tambah, edit, dan hapus data kontrak</p>
                    <a href="{{ route('admin.kontrak.index') }}" class="btn btn-custom-primary">Kelola Kontrak</a>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card card-custom">
                <div class="card-body text-center">
                    <i class="fas fa-cogs fa-3x text-danger mb-3"></i>
                    <h5>Kelola Operasional</h5>
                    <p class="text-muted">Tambah, edit, dan hapus data operasional</p>
                    <a href="{{ route('admin.operasional.index') }}" class="btn btn-custom-primary">Kelola Operasional</a>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card card-custom">
                <div class="card-body text-center">
                    <i class="fas fa-plus-circle fa-3x text-secondary mb-3"></i>
                    <h5>Tambah Kantor Baru</h5>
                    <p class="text-muted">Tambahkan kantor PLN baru ke sistem</p>
                    <a href="{{ route('admin.offices.create') }}" class="btn btn-custom-primary">Tambah Kantor</a>
                </div>
            </div>
        </div>
    </div>
@endsection
