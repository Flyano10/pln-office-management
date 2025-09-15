@extends('layouts.app')

@section('content')
    <div class="container">
        <h4>Peta Lokasi Kantor PLN (Admin)</h4>
        <div id="map" style="height:600px"></div>
    </div>

    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        var map = L.map('map').setView([0, 118], 5);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap'
        }).addTo(map);

        @foreach ($offices as $office)
            L.marker([{{ $office->latitude }}, {{ $office->longitude }}])
                .addTo(map)
                .bindPopup(
                    "<b>{{ $office->office_name }}</b><br>{{ $office->city }}<br><a href='{{ route('admin.offices.edit', $office) }}'>Edit</a>"
                    );
        @endforeach
    </script>
@endsection
