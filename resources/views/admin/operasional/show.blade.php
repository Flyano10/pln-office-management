@extends('layouts.app')

@section('content')
    <div class="container">
        <h4>Detail Operasional</h4>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th>Kantor</th>
                    <td>{{ $operasional->plnOffice->office_name ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Jumlah Pegawai</th>
                    <td>{{ $operasional->jumlah_pegawai ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Divisi/Departemen</th>
                    <td>{{ $operasional->divisi_departemen ?? '-' }}</td>
                </tr>
                <tr>
                    <th>PIC Nama</th>
                    <td>{{ $operasional->pic_nama ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Nomor Kontak</th>
                    <td>{{ $operasional->nomor_kontak ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Jam Operasional</th>
                    <td>{{ $operasional->jam_operasional ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Keamanan</th>
                    <td>{{ $operasional->keamanan ? implode(', ', json_decode($operasional->keamanan)) : '-' }}</td>
                </tr>
                <tr>
                    <th>Catatan Tambahan</th>
                    <td>{{ $operasional->catatan_tambahan ?? '-' }}</td>
                </tr>
            </tbody>
        </table>
        <a href="{{ route('admin.operasional.index') }}" class="btn btn-secondary">Kembali</a>
        <a href="{{ route('admin.operasional.edit', $operasional) }}" class="btn btn-warning">Edit</a>
    </div>
@endsection
