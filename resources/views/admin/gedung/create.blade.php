@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card shadow rounded">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h4 class="mb-0">
                    <i class="fas fa-plus-circle me-2"></i>Tambah Gedung
                </h4>
                <a href="{{ route('admin.gedung.index') }}" class="btn btn-light btn-sm">
                    <i class="fas fa-arrow-left me-1"></i>Kembali
                </a>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.gedung.store') }}" method="POST" novalidate>
                    @csrf

                    <div class="mb-3">
                        <label for="kantor_id" class="form-label fw-bold">Kantor</label>
                        <select name="kantor_id" id="kantor_id" class="form-select @error('kantor_id') is-invalid @enderror"
                            required>
                            <option value="">Pilih Kantor</option>
                            @foreach ($kantors as $kantor)
                                <option value="{{ $kantor->id }}" {{ old('kantor_id') == $kantor->id ? 'selected' : '' }}>
                                    {{ $kantor->office_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('kantor_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="luas_bangunan" class="form-label fw-bold">Luas Bangunan (m²)</label>
                        <input type="number" name="luas_bangunan" id="luas_bangunan"
                            class="form-control @error('luas_bangunan') is-invalid @enderror"
                            value="{{ old('luas_bangunan') }}" required min="0" step="0.01">
                        @error('luas_bangunan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="jumlah_lantai" class="form-label fw-bold">Jumlah Lantai</label>
                        <input type="number" name="jumlah_lantai" id="jumlah_lantai"
                            class="form-control @error('jumlah_lantai') is-invalid @enderror"
                            value="{{ old('jumlah_lantai') }}" required min="1" step="1">
                        @error('jumlah_lantai')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="jumlah_ruangan" class="form-label fw-bold">Jumlah Ruangan</label>
                        <input type="number" name="jumlah_ruangan" id="jumlah_ruangan"
                            class="form-control @error('jumlah_ruangan') is-invalid @enderror"
                            value="{{ old('jumlah_ruangan') }}" required min="1" step="1">
                        @error('jumlah_ruangan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="fasilitas_utama" class="form-label fw-bold">Fasilitas Utama (pisahkan dengan
                            koma)</label>
                        <input type="text" name="fasilitas_utama" id="fasilitas_utama"
                            class="form-control @error('fasilitas_utama') is-invalid @enderror"
                            value="{{ old('fasilitas_utama') }}">
                        @error('fasilitas_utama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <script>
                        document.querySelector('form').addEventListener('submit', function(e) {
                            const fasilitasInput = document.getElementById('fasilitas_utama');
                            if (fasilitasInput) {
                                // Convert comma-separated string to array before submit
                                const values = fasilitasInput.value.split(',').map(item => item.trim()).filter(item => item.length >
                                    0);
                                // Create hidden inputs for each array item
                                values.forEach((val, idx) => {
                                    const hiddenInput = document.createElement('input');
                                    hiddenInput.type = 'hidden';
                                    hiddenInput.name = 'fasilitas_utama[]';
                                    hiddenInput.value = val;
                                    this.appendChild(hiddenInput);
                                });
                                // Remove original input to avoid conflict
                                fasilitasInput.disabled = true;
                            }
                        });
                    </script>

                    <div class="mb-3">
                        <label for="status_gedung" class="form-label fw-bold">Status Gedung</label>
                        <select name="status_gedung" id="status_gedung"
                            class="form-select @error('status_gedung') is-invalid @enderror" required>
                            <option value="">Pilih Status</option>
                            <option value="Milik" {{ old('status_gedung') == 'Milik' ? 'selected' : '' }}>Milik</option>
                            <option value="Sewa" {{ old('status_gedung') == 'Sewa' ? 'selected' : '' }}>Sewa</option>
                            <option value="Hibah" {{ old('status_gedung') == 'Hibah' ? 'selected' : '' }}>Hibah</option>
                            <option value="Layanan" {{ old('status_gedung') == 'Layanan' ? 'selected' : '' }}>Layanan
                            </option>
                        </select>
                        @error('status_gedung')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('admin.gedung.index') }}" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan Gedung</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
