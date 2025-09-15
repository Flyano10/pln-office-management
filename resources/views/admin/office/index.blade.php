@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary mb-0">Kelola Kantor PLN</h2>
        <div>
            <a href="{{ route('admin.map') }}" class="btn btn-custom-primary me-2">
                <i class="fas fa-map-marker-alt me-1"></i> Lihat Peta
            </a>
            <a href="{{ route('admin.offices.create') }}" class="btn btn-custom-primary">
                <i class="fas fa-plus me-1"></i> Tambah Kantor
            </a>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-3 shadow-sm" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card card-custom mb-4">
        <div class="card-body">
            <form method="GET">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Jenis Kantor</label>
                        <select name="office_type" class="form-select form-control-custom">
                            <option value="">-- Semua Jenis Kantor --</option>
                            @foreach ($officeTypes as $key => $value)
                                <option value="{{ $key }}" {{ request('office_type') == $key ? 'selected' : '' }}>
                                    {{ $value }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Pencarian</label>
                        <input type="text" name="search" class="form-control form-control-custom"
                            placeholder="Cari kantor..." value="{{ request('search') }}">
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button class="btn btn-custom-primary w-100">
                            <i class="fas fa-search me-1"></i> Cari
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card card-custom">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="fw-semibold">ID Kantor</th>
                            <th class="fw-semibold">Nama Kantor</th>
                            <th class="fw-semibold">Jenis</th>
                            <th class="fw-semibold">Kota</th>
                            <th class="fw-semibold">Provinsi</th>
                            <th class="fw-semibold">Parent Kantor</th>
                            <th class="fw-semibold">Koordinat</th>
                            <th class="fw-semibold text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($offices as $office)
                            <tr>
                                <td class="fw-medium">{{ $office->office_id }}</td>
                                <td>{{ $office->office_name }}</td>
                                <td>
                                    <span class="badge badge-custom bg-primary">{{ $office->office_type }}</span>
                                </td>
                                <td>{{ $office->city }}</td>
                                <td>{{ $office->province }}</td>
                                <td>{{ optional($office->parentOffice)->office_name ?? '-' }}</td>
                                <td class="small text-muted">
                                    {{ number_format($office->latitude, 6) }}<br>
                                    {{ number_format($office->longitude, 6) }}
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.offices.show', $office) }}"
                                            class="btn btn-sm btn-outline-info" title="Lihat">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.offices.edit', $office) }}"
                                            class="btn btn-sm btn-outline-warning" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form method="POST" action="{{ route('admin.offices.destroy', $office) }}"
                                            class="d-inline" onsubmit="return confirm('Yakin hapus?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-outline-danger" title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted py-4">
                                    <i class="fas fa-building fa-2x mb-2 text-muted"></i>
                                    <br>Tidak ada data kantor
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $offices->links() }}
    </div>
@endsection
