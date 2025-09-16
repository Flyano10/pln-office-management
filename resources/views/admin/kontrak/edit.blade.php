@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Kontrak</h1>
    <a href="{{ route('admin.kontrak.index') }}" class="btn btn-secondary mb-3">Kembali</a>

    <form action="{{ route('admin.kontrak.update', $kontrak->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nama_perjanjian">Nama Perjanjian</label>
            <input type="text" class="form-control" id="nama_perjanjian" name="nama_perjanjian" value="{{ $kontrak->nama_perjanjian }}" required>
        </div>

        <div class="form-group">
            <label for="no_perjanjian_pihak1">Nomor Perjanjian Pihak 1</label>
            <input type="text" class="form-control" id="no_perjanjian_pihak1" name="no_perjanjian_pihak1" value="{{ $kontrak->no_perjanjian_pihak1 }}" required>
        </div>

        <div class="form-group">
            <label for="no_perjanjian_pihak2">Nomor Perjanjian Pihak 2</label>
            <input type="text" class="form-control" id="no_perjanjian_pihak2" name="no_perjanjian_pihak2" value="{{ $kontrak->no_perjanjian_pihak2 }}" required>
        </div>

        <div class="form-group">
            <label for="tanggal_mulai">Tanggal Mulai</label>
            <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai" value="{{ $kontrak->tanggal_mulai->format('Y-m-d') }}" required>
        </div>

        <div class="form-group">
            <label for="tanggal_selesai">Tanggal Selesai</label>
            <input type="date" class="form-control" id="tanggal_selesai" name="tanggal_selesai" value="{{ $kontrak->tanggal_selesai->format('Y-m-d') }}" required>
        </div>

        <div class="form-group">
            <label for="sbu">SBU</label>
            <input type="text" class="form-control" id="sbu" name="sbu" value="{{ $kontrak->sbu }}" required>
        </div>

        <div class="form-group">
            <label for="ruang_lingkup">Ruang Lingkup</label>
            <textarea class="form-control" id="ruang_lingkup" name="ruang_lingkup" required>{{ $kontrak->ruang_lingkup }}</textarea>
        </div>

        <div class="form-group">
            <label for="asset_owner">Asset Owner</label>
            <input type="text" class="form-control" id="asset_owner" name="asset_owner" value="{{ $kontrak->asset_owner }}" required>
        </div>

        <div class="form-group">
            <label for="peruntukan">Peruntukan</label>
            <select class="form-control" id="peruntukan" name="peruntukan" required>
                <option value="">Pilih Peruntukan</option>
                <option value="Kantor SBU" {{ $kontrak->peruntukan == 'Kantor SBU' ? 'selected' : '' }}>Kantor SBU</option>
                <option value="Kantor KP" {{ $kontrak->peruntukan == 'Kantor KP' ? 'selected' : '' }}>Kantor KP</option>
                <option value="Gudang" {{ $kontrak->peruntukan == 'Gudang' ? 'selected' : '' }}>Gudang</option>
            </select>
        </div>

        <div class="form-group">
            <label for="alamat">Alamat</label>
            <textarea class="form-control" id="alamat" name="alamat" required>{{ $kontrak->alamat }}</textarea>
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <select class="form-control" id="status" name="status" required>
                <option value="">Pilih Status</option>
                <option value="baru" {{ $kontrak->status == 'baru' ? 'selected' : '' }}>Baru</option>
                <option value="berjalan" {{ $kontrak->status == 'berjalan' ? 'selected' : '' }}>Berjalan</option>
                <option value="selesai" {{ $kontrak->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                <option value="amandemen" {{ $kontrak->status == 'amandemen' ? 'selected' : '' }}>Amandemen</option>
            </select>
        </div>

        <div class="form-group">
            <label for="gedung_id">Gedung</label>
            <select class="form-control" id="gedung_id" name="gedung_id" required>
                <option value="">Pilih Gedung</option>
                @foreach($gedungs as $gedung)
                    <option value="{{ $gedung->id }}" {{ $kontrak->gedung_id == $gedung->id ? 'selected' : '' }}>{{ $gedung->nama }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
