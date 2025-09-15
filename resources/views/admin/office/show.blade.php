@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="card shadow-sm rounded-3">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Detail Kantor PLN</h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered mb-4">
                    <tbody>
                        <tr>
                            <th>ID Kantor</th>
                            <td>{{ $office->office_id }}</td>
                        </tr>
                        <tr>
                            <th>Nama Kantor</th>
                            <td>{{ $office->office_name }}</td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <td>{{ $office->address }}</td>
                        </tr>
                        <tr>
                            <th>Kota</th>
                            <td>{{ $office->city }}</td>
                        </tr>
                        <tr>
                            <th>Provinsi</th>
                            <td>{{ $office->province }}</td>
                        </tr>
                        <tr>
                            <th>Jenis Kantor</th>
                            <td>{{ $office->office_type }}</td>
                        </tr>
                        <tr>
                            <th>Kantor Induk</th>
                            <td>{{ optional($office->parentOffice)->office_name ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Latitude</th>
                            <td>{{ $office->latitude }}</td>
                        </tr>
                        <tr>
                            <th>Longitude</th>
                            <td>{{ $office->longitude }}</td>
                        </tr>
                    </tbody>
                </table>
                <a href="{{ route('admin.offices.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>
@endsection
