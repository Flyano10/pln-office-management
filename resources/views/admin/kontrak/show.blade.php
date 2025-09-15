@extends('layouts.app')

@section('content')
    <div class="container">
        <h4>Detail Kontrak</h4>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th>Gedung</th>
                    <td>{{ $kontrak->gedung->plnOffice->office_name ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Jenis Kontrak</th>
                    <td>{{ $kontrak->jenis_kontrak ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Periode Mulai</th>
                    <td>{{ $kontrak->periode_mulai ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Periode Selesai</th>
                    <td>{{ $kontrak->periode_selesai ?? '-' }}</td>
                </tr>
            </tbody>
        </table>
        <a href="{{ route('admin.kontrak.index') }}" class="btn btn-secondary">Kembali</a>
        <a href="{{ route('admin.kontrak.edit', $kontrak) }}" class="btn btn-warning">Edit</a>
    </div>
@endsection
