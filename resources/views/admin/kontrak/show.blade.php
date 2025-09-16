@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detail Kontrak</h1>
    <a href="{{ route('admin.kontrak.index') }}" class="btn btn-secondary mb-3">Kembali</a>
    <a href="{{ route('admin.kontrak.edit', $kontrak->id) }}" class="btn btn-warning mb-3">Edit</a>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $kontrak->nama_perjanjian }}</h5>
            <p class="card-text"><strong>Pihak 1:</strong> {{ $kontrak->no_perjanjian_pihak1 }}</p>
            <p class="card-text"><strong>Pihak 2:</strong> {{ $kontrak->no_perjanjian_pihak2 }}</p>
            <p class="card-text"><strong>Tanggal Mulai:</strong> {{ $kontrak->tanggal_mulai->format('d-m-Y') }}</p>
            <p class="card-text"><strong>Tanggal Selesai:</strong> {{ $kontrak->tanggal_selesai->format('d-m-Y') }}</p>
            <p class="card-text"><strong>SBU:</strong> {{ $kontrak->sbu }}</p>
            <p class="card-text"><strong>Ruang Lingkup:</strong> {{ $kontrak->ruang_lingkup }}</p>
            <p class="card-text"><strong>Asset Owner:</strong> {{ $kontrak->asset_owner }}</p>
            <p class="card-text"><strong>Peruntukan:</strong> {{ $kontrak->peruntukan }}</p>
            <p class="card-text"><strong>Alamat:</strong> {{ $kontrak->alamat }}</p>
            <p class="card-text"><strong>Status:</strong> {{ ucfirst($kontrak->status) }}</p>
            <p class="card-text"><strong>Gedung:</strong> {{ $kontrak->gedung->nama ?? '-' }}</p>
        </div>
    </div>

    <h3 class="mt-4">Realisasi Kontrak</h3>
    <a href="{{ route('admin.realisasi.create', $kontrak->id) }}" class="btn btn-primary mb-3">Tambah Realisasi</a>
    <a href="{{ route('admin.realisasi.index', $kontrak->id) }}" class="btn btn-info mb-3">Lihat Semua Realisasi</a>

    @if($kontrak->realisasiKontrak->count() > 0)
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Tanggal Realisasi</th>
                    <th>Jenis Kompensasi</th>
                    <th>Nilai Kompensasi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($kontrak->realisasiKontrak->take(5) as $realisasi)
                <tr>
                    <td>{{ $realisasi->tanggal_realisasi->format('d-m-Y') }}</td>
                    <td>{{ $realisasi->jenis_kompensasi }}</td>
                    <td>Rp {{ number_format($realisasi->nilai_kompensasi, 0, ',', '.') }}</td>
                    <td>
                        <a href="{{ route('admin.realisasi.edit', [$kontrak->id, $realisasi->id]) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('admin.realisasi.destroy', [$kontrak->id, $realisasi->id]) }}" method="POST" style="display:inline-block;">
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
    @else
        <p>Tidak ada realisasi untuk kontrak ini.</p>
    @endif
</div>
@endsection
