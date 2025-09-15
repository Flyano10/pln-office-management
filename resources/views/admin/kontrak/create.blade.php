@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Tambah Kontrak</h4>
    <form action="{{ route('admin.kontrak.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="gedung_id" class="form-label">Gedung</label>
            <select name="gedung_id" id="gedung_id" class="form-select @error('gedung_id') is-invalid @enderror" required>
                <option value="">-- Pilih Gedung --</option>
                @foreach($gedungs as $gedung)
                    <option value="{{ $gedung->id }}" {{ old('gedung_id') == $gedung->id ? 'selected' : '' }}>
                        {{ $gedung->plnOffice->office_name ?? '-' }} - Gedung #{{ $gedung->id }}
                    </option>
                @endforeach
            </select>
            @error('gedung_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="jenis_kontrak" class="form-label">Jenis Kontrak</label>
            <input type="text" name="jenis_kontrak" id="jenis_kontrak" class="form-control @error('jenis_kontrak') is-invalid @enderror" value="{{ old('jenis_kontrak') }}">
            @error('jenis_kontrak')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="periode_mulai" class="form-label">Periode Mulai</label>
            <input type="date" name="periode_mulai" id="periode_mulai" class="form-control @error('periode_mulai') is-invalid @enderror" value="{{ old('periode_mulai') }}">
            @error('periode_mulai')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="periode_selesai" class="form-label">Periode Selesai</label>
            <input type="date" name="periode_selesai" id="periode_selesai" class="form-control @error('periode_selesai') is-invalid @enderror" value="{{ old('periode_selesai') }}">
            @error('periode_selesai')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <a href="{{ route('admin.kontrak.index') }}" class="btn btn-secondary">Batal</a>
        <button type="submit" class="btn btn-primary">Simpan Kontrak</button>
    </form>
</div>
@endsection
