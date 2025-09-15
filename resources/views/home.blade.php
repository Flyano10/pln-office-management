@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="text-center mb-5">
        <h1 class="display-5 fw-bold">
            <i class="bi bi-speedometer2" style="color:#003399;"></i> Dashboard
        </h1>
        <p class="text-muted">Selamat datang kembali, {{ auth()->user()->name }}!</p>
    </div>

    <div class="row g-4">
        {{-- Card Template --}}
        @php
            $cards = [
                ['icon'=>'bi-building-check','title'=>'Jumlah Kantor','count'=>$officeCount ?? 0,'color'=>'#FFCC00'],
                ['icon'=>'bi-people-fill','title'=>'Jumlah Pengguna','count'=>$userCount ?? 0,'color'=>'#28a745'],
                ['icon'=>'bi-folder-fill','title'=>'Total Properti','count'=>$propertyCount ?? 0,'color'=>'#17a2b8'],
            ];
        @endphp

        @foreach($cards as $card)
        <div class="col-md-4">
            <div class="card shadow-sm h-100 border-0 rounded-4" 
                 style="transition: transform 0.3s, box-shadow 0.3s;"
                 onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 10px 25px rgba(0,0,0,0.3)';"
                 onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(0,0,0,0.15)';">
                <div class="card-body text-center">
                    <i class="bi {{ $card['icon'] }} display-4 mb-3" style="color: {{ $card['color'] }};"></i>
                    <h5 class="card-title">{{ $card['title'] }}</h5>
                    <p class="card-text fs-4 fw-bold">{{ $card['count'] }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    {{-- Notifikasi sukses --}}
    @if (session('status'))
        <div class="alert alert-success mt-4 text-center shadow-sm rounded-3" role="alert">
            {{ session('status') }}
        </div>
    @endif
</div>
@endsection
