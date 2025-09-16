@extends('layouts.app')

@section('content')
    <div class="container">
        @if ($kontrak)
            <h1>Realisasi Kontrak: {{ $kontrak->nama_perjanjian }}</h1>
            <a href="{{ route('admin.kontrak.show', $kontrak->id) }}" class="btn btn-secondary mb-3">Kembali ke Kontrak</a>
            <a href="{{ route('admin.realisasi.create', $kontrak->id) }}" class="btn btn-primary mb-3">Tambah Realisasi</a>
        @else
            <h1>Daftar Realisasi Kontrak</h1>
            <a href="{{ route('admin.realisasi.create') }}" class="btn btn-primary mb-3">Tambah Realisasi</a>
        @endif

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Tanggal Realisasi</th>
                    <th>Jenis Kompensasi</th>
                    <th>Deskripsi</th>
                    <th>Nilai Kompensasi</th>
                    <th>Lokasi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($realisasis as $realisasi)
                    <tr>
                        <td>{{ $realisasi->tanggal_realisasi->format('d-m-Y') }}</td>
                        <td>{{ $realisasi->jenis_kompensasi }}</td>
                        <td>{{ Str::limit($realisasi->deskripsi, 50) }}</td>
                        <td>Rp {{ number_format($realisasi->nilai_kompensasi, 0, ',', '.') }}</td>
                        <td>{{ $realisasi->lokasi }}</td>
                        <td>
                            <a href="{{ route('admin.realisasi.edit', [$kontrak->id, $realisasi->id]) }}"
                                class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('admin.realisasi.destroy', [$kontrak->id, $realisasi->id]) }}"
                                method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Yakin ingin menghapus realisasi ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $realisasis->links() }}
    </div>
@endsection
