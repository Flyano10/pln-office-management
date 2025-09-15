@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Tambah Operasional</h4>
    <form action="{{ route('admin.operasional.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="kantor_id" class="form-label">Kantor</label>
            <select name="kantor_id" id="kantor_id" class="form-select @error('kantor_id') is-invalid @enderror" required>
                <option value="">-- Pilih Kantor --</option>
                @foreach($offices as $office)
                    <option value="{{ $office->id }}" {{ old('kantor_id') == $office->id ? 'selected' : '' }}>{{ $office->office_name }}</option>
                @endforeach
            </select>
            @error('kantor_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="jumlah_pegawai" class="form-label">Jumlah Pegawai</label>
            <input type="number" name="jumlah_pegawai" id="jumlah_pegawai" class="form-control @error('jumlah_pegawai') is-invalid @enderror" value="{{ old('jumlah_pegawai') }}">
            @error('jumlah_pegawai')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="divisi_departemen" class="form-label">Divisi/Departemen</label>
            <input type="text" name="divisi_departemen" id="divisi_departemen" class="form-control @error('divisi_departemen') is-invalid @enderror" value="{{ old('divisi_departemen') }}">
            @error('divisi_departemen')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="pic_nama" class="form-label">PIC Nama</label>
            <input type="text" name="pic_nama" id="pic_nama" class="form-control @error('pic_nama') is-invalid @enderror" value="{{ old('pic_nama') }}">
            @error('pic_nama')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="nomor_kontak" class="form-label">Nomor Kontak</label>
            <input type="text" name="nomor_kontak" id="nomor_kontak" class="form-control @error('nomor_kontak') is-invalid @enderror" value="{{ old('nomor_kontak') }}">
            @error('nomor_kontak')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="jam_operasional" class="form-label">Jam Operasional</label>
            <input type="text" name="jam_operasional" id="jam_operasional" class="form-control @error('jam_operasional') is-invalid @enderror" value="{{ old('jam_operasional') }}">
            @error('jam_operasional')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="keamanan" class="form-label">Keamanan (pisahkan dengan koma)</label>
            <input type="text" name="keamanan" id="keamanan" class="form-control @error('keamanan') is-invalid @enderror" value="{{ old('keamanan') }}">
            @error('keamanan')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="catatan_tambahan" class="form-label">Catatan Tambahan</label>
            <textarea name="catatan_tambahan" id="catatan_tambahan" class="form-control @error('catatan_tambahan') is-invalid @enderror">{{ old('catatan_tambahan') }}</textarea>
            @error('catatan_tambahan')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <a href="{{ route('admin.operasional.index') }}" class="btn btn-secondary">Batal</a>
        <button type="submit" class="btn btn-primary">Simpan Operasional</button>
    </form>
</div>
@endsection
