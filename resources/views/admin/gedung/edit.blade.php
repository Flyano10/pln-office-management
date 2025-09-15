@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Edit Gedung</h4>
    <form action="{{ route('admin.gedung.update', $gedung) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="kantor_id" class="form-label">Kantor</label>
            <select name="kantor_id" id="kantor_id" class="form-select @error('kantor_id') is-invalid @enderror" required>
                <option value="">-- Pilih Kantor --</option>
                @foreach($offices as $office)
                    <option value="{{ $office->id }}" {{ old('kantor_id', $gedung->kantor_id) == $office->id ? 'selected' : '' }}>{{ $office->office_name }}</option>
                @endforeach
            </select>
            @error('kantor_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="luas_bangunan" class="form-label">Luas Bangunan (m²)</label>
            <input type="number" step="any" name="luas_bangunan" id="luas_bangunan" class="form-control @error('luas_bangunan') is-invalid @enderror" value="{{ old('luas_bangunan', $gedung->luas_bangunan) }}">
            @error('luas_bangunan')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="jumlah_lantai" class="form-label">Jumlah Lantai</label>
            <input type="number" name="jumlah_lantai" id="jumlah_lantai" class="form-control @error('jumlah_lantai') is-invalid @enderror" value="{{ old('jumlah_lantai', $gedung->jumlah_lantai) }}">
            @error('jumlah_lantai')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="jumlah_ruangan" class="form-label">Jumlah Ruangan</label>
            <input type="number" name="jumlah_ruangan" id="jumlah_ruangan" class="form-control @error('jumlah_ruangan') is-invalid @enderror" value="{{ old('jumlah_ruangan', $gedung->jumlah_ruangan) }}">
            @error('jumlah_ruangan')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="fasilitas_utama" class="form-label">Fasilitas Utama (pisahkan dengan koma)</label>
            <input type="text" name="fasilitas_utama" id="fasilitas_utama" class="form-control @error('fasilitas_utama') is-invalid @enderror" value="{{ old('fasilitas_utama', $gedung->fasilitas_utama ? implode(', ', json_decode($gedung->fasilitas_utama)) : '') }}">
            @error('fasilitas_utama')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="status_gedung" class="form-label">Status Gedung</label>
            <input type="text" name="status_gedung" id="status_gedung" class="form-control @error('status_gedung') is-invalid @enderror" value="{{ old('status_gedung', $gedung->status_gedung) }}">
            @error('status_gedung')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <a href="{{ route('admin.gedung.index') }}" class="btn btn-secondary">Batal</a>
        <button type="submit" class="btn btn-warning">Update Gedung</button>
    </form>
</div>
@endsection
