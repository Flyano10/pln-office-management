@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Realisasi untuk Kontrak: {{ $kontrak->nama_perjanjian }}</h1>
    <a href="{{ route('admin.realisasi.index', $kontrak->id) }}" class="btn btn-secondary mb-3">Kembali</a>

    <form action="{{ route('admin.realisasi.update', [$kontrak->id, $realisasi->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="no_pihak1">Nomor Pihak 1</label>
            <input type="text" class="form-control" id="no_pihak1" name="no_pihak1" value="{{ $realisasi->no_pihak1 }}" required>
        </div>

        <div class="form-group">
            <label for="no_pihak2">Nomor Pihak 2</label>
            <input type="text" class="form-control" id="no_pihak2" name="no_pihak2" value="{{ $realisasi->no_pihak2 }}" required>
        </div>

        <div class="form-group">
            <label for="tanggal_realisasi">Tanggal Realisasi</label>
            <input type="date" class="form-control" id="tanggal_realisasi" name="tanggal_realisasi" value="{{ $realisasi->tanggal_realisasi->format('Y-m-d') }}" required>
        </div>

        <div class="form-group">
            <label for="jenis_kompensasi">Jenis Kompensasi</label>
            <select class="form-control" id="jenis_kompensasi" name="jenis_kompensasi" required>
                <option value="">Pilih Jenis Kompensasi</option>
                <option value="Pemeliharaan" {{ $realisasi->jenis_kompensasi == 'Pemeliharaan' ? 'selected' : '' }}>Pemeliharaan</option>
                <option value="Pembangunan" {{ $realisasi->jenis_kompensasi == 'Pembangunan' ? 'selected' : '' }}>Pembangunan</option>
            </select>
        </div>

        <div class="form-group">
            <label for="deskripsi">Deskripsi</label>
            <textarea class="form-control" id="deskripsi" name="deskripsi" required>{{ $realisasi->deskripsi }}</textarea>
        </div>

        <div class="form-group">
            <label for="nilai_kompensasi">Nilai Kompensasi (Rp)</label>
            <input type="number" class="form-control" id="nilai_kompensasi" name="nilai_kompensasi" value="{{ $realisasi->nilai_kompensasi }}" required>
        </div>

        <div class="form-group">
            <label for="lokasi">Lokasi</label>
            <input type="text" class="form-control" id="lokasi" name="lokasi" value="{{ $realisasi->lokasi }}" required>
        </div>

        <div class="form-group">
            <label for="alamat">Alamat</label>
            <textarea class="form-control" id="alamat" name="alamat" required>{{ $realisasi->alamat }}</textarea>
        </div>

        <div class="form-group">
            <label for="dokumen">Dokumen (PDF, JPG, PNG)</label>
            <input type="file" class="form-control" id="dokumen" name="dokumen" accept=".pdf,.jpg,.jpeg,.png">
            @if($realisasi->dokumen)
                <p>Dokumen saat ini: <a href="{{ asset('storage/' . $realisasi->dokumen) }}" target="_blank">Lihat Dokumen</a></p>
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
