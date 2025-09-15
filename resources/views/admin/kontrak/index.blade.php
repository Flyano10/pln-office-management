@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4>Kelola Kontrak</h4>
                <a href="{{ route('admin.kontrak.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah
                    Kontrak</a>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Gedung</th>
                            <th>Jenis Kontrak</th>
                            <th>Periode Mulai</th>
                            <th>Periode Selesai</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($kontraks as $kontrak)
                            <tr>
                                <td>{{ $kontrak->gedung->plnOffice->office_name ?? '-' }}</td>
                                <td>{{ $kontrak->jenis_kontrak ?? '-' }}</td>
                                <td>{{ $kontrak->periode_mulai ?? '-' }}</td>
                                <td>{{ $kontrak->periode_selesai ?? '-' }}</td>
                                <td>
                                    <a href="{{ route('admin.kontrak.show', $kontrak) }}" class="btn btn-sm btn-info"><i
                                            class="fas fa-eye"></i></a>
                                    <a href="{{ route('admin.kontrak.edit', $kontrak) }}" class="btn btn-sm btn-warning"><i
                                            class="fas fa-edit"></i></a>
                                    <form action="{{ route('admin.kontrak.destroy', $kontrak) }}" method="POST"
                                        class="d-inline" onsubmit="return confirm('Yakin hapus kontrak ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Tidak ada data kontrak</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    {{ $kontraks->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
