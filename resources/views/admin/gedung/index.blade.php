@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="fw-bold">Kelola Gedung</h2>
            <div>
                <a href="{{ route('admin.gedung.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah Gedung
                </a>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success rounded-3 shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-responsive shadow-sm rounded-3">
            <table class="table table-hover align-middle mb-0 bg-white">
                <thead class="table-light">
                    <tr>
                        <th>Kantor</th>
                        <th>Luas Bangunan (m²)</th>
                        <th>Jumlah Lantai</th>
                        <th>Jumlah Ruangan</th>
                        <th>Fasilitas Utama</th>
                        <th>Status Gedung</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($gedungs as $gedung)
                        <tr>
                            <td>{{ optional($gedung->kantor)->office_name ?? '-' }}</td>
                            <td>{{ $gedung->luas_bangunan ?? '-' }}</td>
                            <td>{{ $gedung->jumlah_lantai ?? '-' }}</td>
                            <td>{{ $gedung->jumlah_ruangan ?? '-' }}</td>
                            <td>{{ $gedung->fasilitas_utama ? implode(', ', json_decode($gedung->fasilitas_utama)) : '-' }}
                            </td>
                            <td>{{ $gedung->status_gedung ?? '-' }}</td>
                            <td>
                                <a href="{{ route('admin.gedung.show', $gedung) }}" class="btn btn-sm btn-info me-1"
                                    title="Lihat">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.gedung.edit', $gedung) }}" class="btn btn-sm btn-warning me-1"
                                    title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.gedung.destroy', $gedung) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Yakin hapus gedung ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">Tidak ada data gedung</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $gedungs->links() }}
        </div>
    </div>
@endsection
