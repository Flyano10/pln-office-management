@extends('layouts.app')

@section('content')
    <div class="container">
        @if ($kontrak)
            <h1>Tambah Realisasi untuk Kontrak: {{ $kontrak->nama_perjanjian }}</h1>
            <a href="{{ route('admin.realisasi.index', $kontrak->id) }}" class="btn btn-secondary mb-3">Kembali</a>

            <form action="{{ route('admin.realisasi.store', $kontrak->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
            @else
                <h1>Tambah Realisasi</h1>
                <a href="{{ route('admin.realisasi.index') }}" class="btn btn-secondary mb-3">Kembali</a>

                <form action="{{ route('admin.realisasi.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="kontrak_id">Pilih Kontrak</label>
                        <select class="form-control" id="kontrak_id" name="kontrak_id" required>
                            <option value="">-- Pilih Kontrak --</option>
                            @foreach (\App\Models\Kontrak::all() as $k)
                                <option value="{{ $k->id }}">{{ $k->nama_perjanjian }}</option>
                            @endforeach
                        </select>
                    </div>
        @endif

        <div class="form-group">
            <label for="no_pihak1">Nomor Pihak 1</label>
            <input type="text" class="form-control" id="no_pihak1" name="no_pihak1" required>
        </div>

        <div class="form-group">
            <label for="no_pihak2">Nomor Pihak 2</label>
            <input type="text" class="form-control" id="no_pihak2" name="no_pihak2" required>
        </div>

        <div class="form-group">
            <label for="tanggal_realisasi">Tanggal Realisasi</label>
            <input type="date" class="form-control" id="tanggal_realisasi" name="tanggal_realisasi" required>
        </div>

        <div class="form-group">
            <label for="jenis_kompensasi">Jenis Kompensasi</label>
            <select class="form-control" id="jenis_kompensasi" name="jenis_kompensasi" required>
                <option value="">Pilih Jenis Kompensasi</option>
                <option value="Pemeliharaan">Pemeliharaan</option>
                <option value="Pembangunan">Pembangunan</option>
            </select>
        </div>

        <div class="form-group">
            <label for="deskripsi">Deskripsi</label>
            <textarea class="form-control" id="deskripsi" name="deskripsi" required></textarea>
        </div>

        <div class="form-group">
            <label for="nilai_kompensasi">Nilai Kompensasi (Rp)</label>
            <input type="number" class="form-control" id="nilai_kompensasi" name="nilai_kompensasi" required>
        </div>

        <div class="form-group">
            <label for="lokasi">Lokasi</label>
            <input type="text" class="form-control" id="lokasi" name="lokasi" required>
        </div>

        <div class="form-group">
            <label for="alamat">Alamat</label>
            <textarea class="form-control" id="alamat" name="alamat" required></textarea>
        </div>

        <div class="form-group">
            <label for="dokumen">Dokumen (PDF, JPG, PNG)</label>
            <input type="file" class="form-control" id="dokumen" name="dokumen" accept=".pdf,.jpg,.jpeg,.png">
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
@endsection
