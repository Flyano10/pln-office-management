@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="mb-4">Detail Gedung {{ $gedung->id }}</h1>

        <p><strong>Kantor:</strong> {{ optional($gedung->kantor)->office_name ?? '-' }}</p>
        <p><strong>Luas Bangunan:</strong> {{ $gedung->luas_bangunan }} m²</p>
        <p><strong>Jumlah Lantai:</strong> {{ $gedung->jumlah_lantai }}</p>
        <p><strong>Jumlah Ruangan:</strong> {{ $gedung->jumlah_ruangan }}</p>
        <p><strong>Fasilitas Utama:</strong> {{ implode(', ', (array) json_decode($gedung->fasilitas_utama ?? '[]')) }}</p>
        <p><strong>Status Gedung:</strong> {{ $gedung->status_gedung }}</p>

        <ul class="nav nav-tabs mt-4" id="gedungTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="kontrak-tab" data-bs-toggle="tab" data-bs-target="#kontrak" type="button"
                    role="tab" aria-controls="kontrak" aria-selected="true">Kontrak</button>
            </li>
        </ul>
        <div class="tab-content" id="gedungTabContent">
            <div class="tab-pane fade show active" id="kontrak" role="tabpanel" aria-labelledby="kontrak-tab">
                <h3 class="mt-3">Daftar Kontrak</h3>
                @if (!$kontraks)
                    <p>Tidak ada data kontrak untuk gedung ini.</p>
                @else
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Jenis Kontrak</th>
                                    <th>Periode Mulai</th>
                                    <th>Periode Selesai</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $kontraks->jenis_kontrak }}</td>
                                    <td>{{ $kontraks->periode_mulai }}</td>
                                    <td>{{ $kontraks->periode_selesai ?? '-' }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
