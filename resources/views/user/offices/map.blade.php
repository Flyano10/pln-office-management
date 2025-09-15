@extends('layouts.app')

@section('content')
    <div class="container-fluid py-4">
        <div class="row mb-3">
            <div class="col-md-4">
                <div class="input-group input-group-sm">
                    <input type="text" id="search-input" class="form-control rounded-start border-primary"
                        placeholder="Cari kantor di Jakarta...">
                    <button id="search-button" class="btn btn-primary rounded-end">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
            <div class="col-md-3">
                <select id="city-select" class="form-select form-select-sm rounded-3 border-primary">
                    <option value="">Semua Kota</option>
                    @foreach ($cities as $city)
                        <option value="{{ $city }}">{{ $city }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <select id="province-select" class="form-select form-select-sm rounded-3 border-primary">
                    <option value="">Semua Provinsi</option>
                    @foreach ($provinces as $province)
                        <option value="{{ $province }}">{{ $province }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <button id="clear-filters" class="btn btn-outline-primary btn-sm w-100 rounded-3">Reset</button>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm rounded-3">
                    <div
                        class="card-header bg-primary text-white d-flex justify-content-between align-items-center rounded-top">
                        <h5 class="mb-0">
                            <i class="fas fa-map-marked-alt me-2"></i>
                            Peta Lokasi Kantor PLN
                        </h5>
                        <div>
                            @guest
                                <a href="{{ route('admin.login') }}" class="btn btn-light btn-sm rounded-3">
                                    <i class="fas fa-user-shield me-1"></i>
                                    Admin Login
                                </a>
                            @endguest
                        </div>
                    </div>
                    <div class="card-body p-0 rounded-bottom">
                        <div id="map" style="height: 600px; width: 100%; border-radius: 0 0 12px 12px;"></div>
                    </div>
                    <div class="card-footer bg-light rounded-bottom">
                        <div class="row">
                            <div class="col-md-6">
                                <small class="text-muted">
                                    <i class="fas fa-info-circle me-1"></i>
                                    Klik marker untuk melihat detail kantor
                                </small>
                            </div>
                            <div class="col-md-6 text-end">
                                <small class="text-muted">
                                    Total Kantor: <span id="office-count">{{ $offices->count() }}</span>
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster/dist/MarkerCluster.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster/dist/MarkerCluster.Default.css" />

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet.markercluster/dist/leaflet.markercluster.js"></script>

    <style>
        .custom-marker-icon {
            border-radius: 50%;
            border: 2px solid white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
        }

        .marker-cluster-small {
            background-color: rgba(181, 226, 140, 0.6);
        }

        .marker-cluster-small div {
            background-color: rgba(110, 204, 57, 0.6);
        }

        .marker-cluster-medium {
            background-color: rgba(241, 211, 87, 0.6);
        }

        .marker-cluster-medium div {
            background-color: rgba(240, 194, 12, 0.6);
        }

        .marker-cluster-large {
            background-color: rgba(253, 156, 115, 0.6);
        }

        .marker-cluster-large div {
            background-color: rgba(241, 128, 23, 0.6);
        }

        .marker-cluster {
            background-color: rgba(181, 226, 140, 0.6);
        }

        .marker-cluster div {
            background-color: rgba(110, 204, 57, 0.6);
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize map
            var map = L.map('map').setView([-2.5, 118], 5);

            var allMarkers = [];
            var searchInput = document.getElementById('search-input');
            var citySelect = document.getElementById('city-select');
            var provinceSelect = document.getElementById('province-select');
            var clearButton = document.getElementById('clear-filters');

            // Add tile layer
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);

            // Create marker cluster group
            var markers = L.markerClusterGroup({
                chunkedLoading: true,
                spiderfyOnMaxZoom: true,
                showCoverageOnHover: false,
                zoomToBoundsOnClick: true
            });

            // Office type colors
            var officeColors = @json($officeColors);

            // Add markers
            @foreach ($offices as $office)
                @php
                    $color = isset($officeColors[$office->office_type]) ? $officeColors[$office->office_type] : $officeColors['default'];
                    $popupContent =
                        "
                <div class='popup-content'>
                    <h6 class='mb-2'><strong>" .
                        $office->office_name .
                        "</strong></h6>
                    <div class='mb-1'><i class='fas fa-map-marker-alt text-danger me-1'></i><strong>Alamat:</strong> " .
                        $office->address .
                        "</div>
                    <div class='mb-1'><i class='fas fa-city text-info me-1'></i><strong>Kota:</strong> " .
                        $office->city .
                        "</div>
                    <div class='mb-1'><i class='fas fa-building text-warning me-1'></i><strong>Tipe:</strong> " .
                        $office->getOfficeTypeNameAttribute() .
                        "</div>
                    " .
                        ($office->operating_hours ? "<div class='mb-1'><i class='fas fa-clock text-success me-1'></i><strong>Jam Operasional:</strong> " . $office->operating_hours . '</div>' : '') .
                        "
                    " .
                        ($office->contact_number ? "<div class='mb-1'><i class='fas fa-phone text-primary me-1'></i><strong>Kontak:</strong> " . $office->contact_number . '</div>' : '') .
                        "
                    " .
                        ($office->rating ? "<div class='mb-1'><i class='fas fa-star text-warning me-1'></i><strong>Rating:</strong> " . $office->rating . '/5</div>' : '') .
                        "
                </div>
          ";
                @endphp

                var customIcon = L.divIcon({
                    className: 'custom-marker-icon',
                    html: '<div style="background-color: {{ $color }}; width: 20px; height: 20px; border-radius: 50%; border: 2px solid white; box-shadow: 0 2px 5px rgba(0,0,0,0.3);"></div>',
                    iconSize: [20, 20],
                    iconAnchor: [10, 10]
                });

                var marker = L.marker([{{ $office->latitude }}, {{ $office->longitude }}], {
                        icon: customIcon
                    })
                    .bindPopup(`{!! $popupContent !!}`);

                marker.options.office = @json($office);
                allMarkers.push(marker);
                markers.addLayer(marker);
            @endforeach

            // Add markers to map
            map.addLayer(markers);

            // Update initial count
            document.getElementById('office-count').textContent = allMarkers.length;

            // Fit map to markers bounds if there are markers
            if (markers.getLayers().length > 0) {
                map.fitBounds(markers.getBounds(), {
                    padding: [20, 20]
                });
            }

            // Add legend
            var legend = L.control({
                position: 'bottomright'
            });

            legend.onAdd = function(map) {
                var div = L.DomUtil.create('div', 'info legend bg-white p-2 rounded shadow-sm');
                div.innerHTML = '<h6 class="mb-2">Kategori Kantor</h6>';

                Object.keys(officeColors).forEach(function(key) {
                    if (key !== 'default') {
                        var typeName = key.replace(/_/g, ' ').replace(/\b\w/g, l => l.toUpperCase());
                        div.innerHTML +=
                            '<div class="d-flex align-items-center mb-1">' +
                            '<div style="background-color: ' + officeColors[key] +
                            '; width: 12px; height: 12px; border-radius: 50%; margin-right: 8px;"></div>' +
                            '<small>' + typeName + '</small>' +
                            '</div>';
                    }
                });

                return div;
            };

            legend.addTo(map);

            // Event listeners for search and filter
            var searchButton = document.getElementById('search-button');
            searchButton.addEventListener('click', filterMarkers);
            searchInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    filterMarkers();
                }
            });
            citySelect.addEventListener('change', filterMarkers);
            provinceSelect.addEventListener('change', filterMarkers);
            clearButton.addEventListener('click', function() {
                searchInput.value = '';
                citySelect.value = '';
                provinceSelect.value = '';
                filterMarkers();
            });

            // Filter function
            function filterMarkers() {
                var searchText = searchInput.value.toLowerCase();
                var selectedCity = citySelect.value;
                var selectedProvince = provinceSelect.value;
                var filteredMarkers = allMarkers.filter(function(marker) {
                    var office = marker.options.office;
                    var matchesSearch = !searchText ||
                        office.office_name.toLowerCase().includes(searchText) ||
                        office.city.toLowerCase().includes(searchText) ||
                        office.province.toLowerCase().includes(searchText) ||
                        office.address.toLowerCase().includes(searchText);
                    var matchesCity = !selectedCity || office.city === selectedCity;
                    var matchesProvince = !selectedProvince || office.province === selectedProvince;
                    return matchesSearch && matchesCity && matchesProvince;
                });
                markers.clearLayers();
                markers.addLayers(filteredMarkers);
                document.getElementById('office-count').textContent = filteredMarkers.length;
                if (filteredMarkers.length > 0) {
                    map.fitBounds(markers.getBounds(), {
                        padding: [20, 20]
                    });
                } else {
                    map.setView([-2.5, 118], 5);
                }
            }
        });
    </script>
@endsection
