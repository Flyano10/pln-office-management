@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4>Kelola Operasional</h4>
                <a href="{{ route('admin.operasional.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah
                    Operasional</a>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Kantor</th>
                            <th>Jumlah Pegawai</th>
                            <th>Divisi/Departemen</th>
                            <th>PIC Nama</th>
                            <th>Nomor Kontak</th>
                            <th>Jam Operasional</th>
                            <th>Keamanan</th>
                            <th>Catatan Tambahan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($operasionals as $operasional)
                            <tr>
                                <td>{{ $operasional->kantor->office_name ?? '-' }}</td>
                                <td>{{ $operasional->jumlah_pegawai ?? '-' }}</td>
                                <td>{{ $operasional->divisi_departemen ?? '-' }}</td>
                                <td>{{ $operasional->pic_nama ?? '-' }}</td>
                                <td>{{ $operasional->nomor_kontak ?? '-' }}</td>
                                <td>{{ $operasional->jam_operasional ?? '-' }}</td>
                                <td>
                                    @php
                                        $keamanan = $operasional->keamanan;
                                        if (is_string($keamanan)) {
                                            $keamananArray = json_decode($keamanan, true);
                                            if (json_last_error() === JSON_ERROR_NONE && is_array($keamananArray)) {
                                                echo implode(', ', $keamananArray);
                                            } else {
                                                echo $keamanan;
                                            }
                                        } elseif (is_array($keamanan)) {
                                            echo implode(', ', $keamanan);
                                        } else {
                                            echo '-';
                                        }
                                    @endphp
                                </td>
                                <td>{{ $operasional->catatan_tambahan ?? '-' }}</td>
                                <td>
                                    <a href="{{ route('admin.operasional.show', $operasional) }}"
                                        class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                                    <a href="{{ route('admin.operasional.edit', $operasional) }}"
                                        class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                    <form action="{{ route('admin.operasional.destroy', $operasional) }}" method="POST"
                                        class="d-inline" onsubmit="return confirm('Yakin hapus data operasional ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center">Tidak ada data operasional</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    {{ $operasionals->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
