@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <h1 class="mb-4 fw-bold">{{ $office->office_name }}</h1>

        <div class="row g-4">
            <div class="col-md-6">
                <p><strong>Alamat:</strong> {{ $office->address }}</p>
                <p><strong>Kota:</strong> {{ $office->city }}</p>
                <p><strong>Provinsi:</strong> {{ $office->province }}</p>
                <p><strong>Jenis Kantor:</strong> {{ $office->office_type }}</p>
            </div>
            <div class="col-md-6">
                <p><strong>Kantor Induk:</strong> {{ optional($office->parentOffice)->office_name ?? '-' }}</p>
                <p><strong>Latitude:</strong> {{ $office->latitude }}</p>
                <p><strong>Longitude:</strong> {{ $office->longitude }}</p>
            </div>
        </div>

        <ul class="nav nav-tabs mt-4" id="officeTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="gedung-tab" data-bs-toggle="tab" data-bs-target="#gedung" type="button"
                    role="tab" aria-controls="gedung" aria-selected="true">Gedung</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="operasional-tab" data-bs-toggle="tab" data-bs-target="#operasional"
                    type="button" role="tab" aria-controls="operasional" aria-selected="false">Operasional</button>
            </li>
        </ul>
        <div class="tab-content" id="officeTabContent">
            <div class="tab-pane fade show active" id="gedung" role="tabpanel" aria-labelledby="gedung-tab">
                <h3 class="mt-3">Daftar Gedung</h3>
                @if ($gedungs->isEmpty())
                    <p>Tidak ada gedung terkait kantor ini.</p>
                @else
                    <ul class="list-group shadow-sm rounded-3">
                        @foreach ($gedungs as $gedung)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <a href="{{ route('user.gedung.show', $gedung->id) }}" class="text-decoration-none">
                                    {{ $gedung->id }} - Gedung
                                </a>
                                <span class="badge bg-primary rounded-pill">{{ $gedung->jumlah_lantai }} Lantai</span>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
            <div class="tab-pane fade" id="operasional" role="tabpanel" aria-labelledby="operasional-tab">
                <h3 class="mt-3">Data Operasional</h3>
                @if ($operasionals->isEmpty())
                    <p>Tidak ada data operasional untuk kantor ini.</p>
                @else
                    <div class="table-responsive shadow-sm rounded-3">
                        <table class="table table-striped table-hover align-middle mb-0 bg-white">
                            <thead class="table-light">
                                <tr>
                                    <th>Jumlah Pegawai</th>
                                    <th>Divisi/Departemen</th>
                                    <th>PIC Nama</th>
                                    <th>Nomor Kontak</th>
                                    <th>Jam Operasional</th>
                                    <th>Keamanan</th>
                                    <th>Catatan Tambahan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($operasionals as $operasional)
                                    <tr>
                                        <td>{{ $operasional->jumlah_pegawai }}</td>
                                        <td>{{ $operasional->divisi_departemen }}</td>
                                        <td>{{ $operasional->pic_nama }}</td>
                                        <td>{{ $operasional->nomor_kontak }}</td>
                                        <td>{{ $operasional->jam_operasional }}</td>
                                        <td>{{ is_array($operasional->keamanan) ? implode(', ', $operasional->keamanan) : $operasional->keamanan }}
                                        </td>
                                        <td>{{ $operasional->catatan_tambahan }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
