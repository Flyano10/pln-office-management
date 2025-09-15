@csrf

<div class="row g-4">
    <!-- Section: Informasi Dasar -->
    <div class="col-12">
        <h5 class="border-bottom pb-2 mb-3"><i class="fas fa-info-circle text-primary"></i> Informasi Dasar</h5>
    </div>

    <!-- ID Kantor -->
    <div class="col-md-6">
        <label class="form-label fw-bold">ID Kantor <span class="text-danger">*</span></label>
        <input type="text" name="office_id" value="{{ old('office_id', $office->office_id ?? '') }}"
            class="form-control @error('office_id') is-invalid @enderror" required placeholder="Contoh: PLN-JKT-001">
        @error('office_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Nama Kantor -->
    <div class="col-md-6">
        <label class="form-label fw-bold">Nama Kantor <span class="text-danger">*</span></label>
        <input type="text" name="office_name" value="{{ old('office_name', $office->office_name ?? '') }}"
            class="form-control @error('office_name') is-invalid @enderror" required
            placeholder="Contoh: PLN Pusat Jakarta">
        @error('office_name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Alamat -->
    <div class="col-12">
        <label class="form-label fw-bold">Alamat Lengkap <span class="text-danger">*</span></label>
        <textarea name="address" rows="3" class="form-control @error('address') is-invalid @enderror" required
            placeholder="Masukkan alamat lengkap kantor...">{{ old('address', $office->address ?? '') }}</textarea>
        @error('address')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Kota & Provinsi -->
    <div class="col-md-6">
        <label class="form-label fw-bold">Kota <span class="text-danger">*</span></label>
        <input type="text" name="city" value="{{ old('city', $office->city ?? '') }}"
            class="form-control @error('city') is-invalid @enderror" required placeholder="Contoh: Jakarta">
        @error('city')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label fw-bold">Provinsi <span class="text-danger">*</span></label>
        <input type="text" name="province" value="{{ old('province', $office->province ?? '') }}"
            class="form-control @error('province') is-invalid @enderror" required placeholder="Contoh: DKI Jakarta">
        @error('province')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Jenis Kantor & Parent -->
    <div class="col-md-6">
        <label class="form-label fw-bold">Jenis Kantor <span class="text-danger">*</span></label>
        <select name="office_type" class="form-select @error('office_type') is-invalid @enderror" required>
            <option value="">-- Pilih Jenis Kantor --</option>
            @foreach ($officeTypes as $key => $label)
                <option value="{{ $key }}"
                    {{ old('office_type', $office->office_type ?? '') == $key ? 'selected' : '' }}>
                    {{ $label }}
                </option>
            @endforeach
        </select>
        @error('office_type')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label fw-bold">Kantor Induk</label>
        <select name="parent_office" class="form-select">
            <option value="">-- Pilih Kantor Induk (Opsional) --</option>
            @foreach ($offices as $parent)
                <option value="{{ $parent->id }}"
                    {{ old('parent_office', $office->parent_office ?? '') == $parent->id ? 'selected' : '' }}>
                    {{ $parent->office_name }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- Koordinat -->
    <div class="col-md-6">
        <label class="form-label fw-bold">Latitude <span class="text-danger">*</span></label>
        <input type="number" step="any" name="latitude" value="{{ old('latitude', $office->latitude ?? '') }}"
            class="form-control @error('latitude') is-invalid @enderror" required placeholder="Contoh: -6.2088">
        @error('latitude')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label fw-bold">Longitude <span class="text-danger">*</span></label>
        <input type="number" step="any" name="longitude"
            value="{{ old('longitude', $office->longitude ?? '') }}"
            class="form-control @error('longitude') is-invalid @enderror" required placeholder="Contoh: 106.8456">
        @error('longitude')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<!-- Tombol -->
<div class="mt-5 pt-3 border-top d-flex justify-content-end gap-2">
    <a href="{{ route('admin.offices.index') }}" class="btn btn-secondary">
        <i class="fas fa-times"></i> Batal
    </a>
    <button type="submit" class="btn btn-{{ isset($office) ? 'warning' : 'primary' }}">
        <i class="fas fa-save"></i> {{ isset($office) ? 'Update Kantor' : 'Simpan Kantor' }}
    </button>
</div>
