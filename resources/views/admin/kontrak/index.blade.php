@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Daftar Kontrak</h1>
        <a href="{{ route('admin.kontrak.create') }}" class="btn btn-primary mb-3">Tambah Kontrak</a>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama Perjanjian</th>
                    <th>Pihak 1</th>
                    <th>Pihak 2</th>
                    <th>Tanggal Mulai</th>
                    <th>Tanggal Selesai</th>
                    <th>Status</th>
                    <th>Gedung</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kontraks as $kontrak)
                    <tr>
                        <td>{{ $kontrak->nama_perjanjian }}</td>
                        <td>{{ $kontrak->no_perjanjian_pihak1 }}</td>
                        <td>{{ $kontrak->no_perjanjian_pihak2 }}</td>
                        <td>{{ $kontrak->tanggal_mulai ? $kontrak->tanggal_mulai->format('d-m-Y') : '-' }}</td>
                        <td>{{ $kontrak->tanggal_selesai ? $kontrak->tanggal_selesai->format('d-m-Y') : '-' }}</td>
                        <td>{{ ucfirst($kontrak->status) }}</td>
                        <td>{{ $kontrak->gedung->nama ?? '-' }}</td>
                        <td>
                            <a href="{{ route('admin.realisasi.index', ['kontrak_id' => $kontrak->id]) }}"
                                class="btn btn-primary btn-sm">Kelola Realisasi</a>
                            <a href="{{ route('admin.kontrak.edit', $kontrak->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('admin.kontrak.destroy', $kontrak->id) }}" method="POST"
                                style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Yakin ingin menghapus kontrak ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $kontraks->links() }}
    </div>
@endsection
