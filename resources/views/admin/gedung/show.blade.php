@extends('layouts.app')

@section('content')
    <div class="container">
        <h4>Detail Gedung</h4>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th>Kantor</th>
                    <td>{{ $gedung->plnOffice->office_name ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Luas Bangunan (m²)</th>
                    <td>{{ $gedung->luas_bangunan ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Jumlah Lantai</th>
                    <td>{{ $gedung->jumlah_lantai ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Jumlah Ruangan</th>
                    <td>{{ $gedung->jumlah_ruangan ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Fasilitas Utama</th>
                    <td>{{ $gedung->fasilitas_utama ? implode(', ', json_decode($gedung->fasilitas_utama)) : '-' }}</td>
                </tr>
                <tr>
                    <th>Status Gedung</th>
                    <td>{{ $gedung->status_gedung ?? '-' }}</td>
                </tr>
            </tbody>
        </table>
        <a href="{{ route('admin.gedung.index') }}" class="btn btn-secondary">Kembali</a>
        <a href="{{ route('admin.gedung.edit', $gedung) }}" class="btn btn-warning">Edit</a>
    </div>
@endsection
