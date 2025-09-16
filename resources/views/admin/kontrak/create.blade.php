@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Kontrak</h1>
    <a href="{{ route('admin.kontrak.index') }}" class="btn btn-secondary mb-3">Kembali</a>

    <form action="{{ route('admin.kontrak.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="nama_perjanjian">Nama Perjanjian</label>
            <input type="text" class="form-control" id="nama_perjanjian" name="nama_perjanjian" required>
        </div>

        <div class="form-group">
            <label for="no_perjanjian_pihak1">Nomor Perjanjian Pihak 1</label>
            <input type="text" class="form-control" id="no_perjanjian_pihak1" name="no_perjanjian_pihak1" required>
        </div>

        <div class="form-group">
            <label for="no_perjanjian_pihak2">Nomor Perjanjian Pihak 2</label>
            <input type="text" class="form-control" id="no_perjanjian_pihak2" name="no_perjanjian_pihak2" required>
        </div>

        <div class="form-group">
            <label for="tanggal_mulai">Tanggal Mulai</label>
            <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai" required>
        </div>

        <div class="form-group">
            <label for="tanggal_selesai">Tanggal Selesai</label>
            <input type="date" class="form-control" id="tanggal_selesai" name="tanggal_selesai" required>
        </div>

        <div class="form-group">
            <label for="sbu">SBU</label>
            <input type="text" class="form-control" id="sbu" name="sbu" required>
        </div>

        <div class="form-group">
            <label for="ruang_lingkup">Ruang Lingkup</label>
            <textarea class="form-control" id="ruang_lingkup" name="ruang_lingkup" required></textarea>
        </div>

        <div class="form-group">
            <label for="asset_owner">Asset Owner</label>
            <input type="text" class="form-control" id="asset_owner" name="asset_owner" required>
        </div>

        <div class="form-group">
            <label for="peruntukan">Peruntukan</label>
            <select class="form-control" id="peruntukan" name="peruntukan" required>
                <option value="">Pilih Peruntukan</option>
                <option value="Kantor SBU">Kantor SBU</option>
                <option value="Kantor KP">Kantor KP</option>
                <option value="Gudang">Gudang</option>
            </select>
        </div>

        <div class="form-group">
            <label for="alamat">Alamat</label>
            <textarea class="form-control" id="alamat" name="alamat" required></textarea>
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <select class="form-control" id="status" name="status" required>
                <option value="">Pilih Status</option>
                <option value="baru">Baru</option>
                <option value="berjalan">Berjalan</option>
                <option value="selesai">Selesai</option>
                <option value="amandemen">Amandemen</option>
            </select>
        </div>

        <div class="form-group">
            <label for="gedung_id">Gedung</label>
            <select class="form-control" id="gedung_id" name="gedung_id" required>
                <option value="">Pilih Gedung</option>
                @foreach($gedungs as $gedung)
                    <option value="{{ $gedung->id }}">{{ $gedung->nama }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
