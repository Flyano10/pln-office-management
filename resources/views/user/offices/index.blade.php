@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <!-- Judul -->
        <h1 class="text-center mb-4 fw-bold" style="color:#003399; font-size:2.5rem;">
            Daftar Kantor PLN Seluruh Indonesia
        </h1>

        <!-- Tombol Lihat Map -->
        <div class="text-center mb-4">
            <a href="{{ route('user.map') }}" class="btn btn-lg btn-map">
                Lihat Semua Kantor di Peta
            </a>
        </div>

        <!-- Filter Jenis Kantor -->
        <div class="row mb-4 justify-content-center">
            <div class="col-md-6">
                <select class="form-select" id="officeFilter" onchange="filterOffices()">
                    <option value="">-- Pilih Jenis Kantor --</option>
                    <option value="Pusat">Kantor Pusat</option>
                    <option value="SBU">SBU</option>
                    <option value="KP">Kantor Perwakilan</option>
                </select>
            </div>
        </div>

        <!-- Grid Kantor -->
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4" id="officeGrid">
            @foreach ($offices as $office)
                <div class="col office-card" data-type="{{ $office->office_type }}">
                    <div class="card h-100 card-office hover-scale position-relative shadow-sm border-0">
                        <!-- Ribbon Featured -->
                        @if (isset($office->is_featured) && $office->is_featured)
                            <div class="ribbon">Featured</div>
                        @endif

                        <!-- Image -->
                        @if ($office->photo_path)
                            <img src="{{ asset('storage/' . $office->photo_path) }}" class="card-img-top"
                                alt="{{ $office->office_name }}">
                        @else
                            <img src="{{ asset('assets/default-office.png') }}" class="card-img-top" alt="Default Office">
                        @endif

                        <!-- Card Body -->
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title text-primary fw-bold">{{ $office->office_name }}</h5>
                            <p class="card-text mb-1">{{ $office->address }}</p>
                            <span class="badge bg-warning text-dark mb-2">{{ $office->city }},
                                {{ $office->province }}</span>

                            <!-- Office Type Badge -->
                            <span class="badge bg-info mb-2">
                                @switch($office->office_type)
                                    @case('Pusat')
                                        Kantor Pusat
                                    @break

                                    @case('SBU')
                                        SBU
                                    @break

                                    @case('KP')
                                        Kantor Perwakilan
                                    @break

                                    @default
                                        {{ $office->office_type }}
                                @endswitch
                            </span>

                            <div class="d-flex gap-2 mt-auto">
                                <a href="{{ route('user.offices.show', $office->id) }}" class="btn btn-primary btn-office">
                                    Lihat Detail
                                </a>
                                <a href="{{ route('user.map') }}#{{ $office->id }}"
                                    class="btn btn-outline-primary btn-office">
                                    Lihat di Peta
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- No Results Message -->
        <div id="noResults" class="text-center mt-4" style="display: none;">
            <div class="alert alert-info">
                <i class="fas fa-info-circle"></i> Tidak ada kantor yang sesuai dengan filter yang dipilih.
            </div>
        </div>

        <!-- Pagination -->
        <div class="mt-5 d-flex justify-content-center" id="paginationContainer">
            {{ $offices->links('pagination::bootstrap-5') }}
        </div>
    </div>

    <!-- Custom Styles -->
    <style>
        .card-office {
            border-radius: 0.75rem;
            overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .card-office img {
            height: 180px;
            object-fit: cover;
        }

        .hover-scale:hover {
            transform: translateY(-5px) scale(1.05);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .btn-map {
            background-color: #FFCC00;
            color: #003399;
            font-weight: bold;
            border: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.15);
            transition: transform 0.2s, box-shadow 0.2s;
            padding: 12px 24px;
            border-radius: 8px;
        }

        .btn-map:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.25);
            color: #003399;
        }

        .btn-office {
            border-color: #003399;
            color: #003399;
            font-weight: bold;
            transition: background-color 0.2s, color 0.2s;
        }

        .btn-office:hover {
            background-color: #003399;
            color: #fff;
            border-color: #003399;
        }

        .ribbon {
            width: 120px;
            height: 25px;
            background: #FFCC00;
            color: #003399;
            text-align: center;
            line-height: 25px;
            font-weight: bold;
            font-size: 12px;
            position: absolute;
            top: 10px;
            right: -30px;
            transform: rotate(45deg);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .form-select:focus {
            border-color: #003399;
            box-shadow: 0 0 0 0.2rem rgba(0, 51, 153, 0.25);
        }
    </style>

    <!-- Filter Script -->
    <script>
        function filterOffices() {
            const filter = document.getElementById('officeFilter').value;
            const offices = document.querySelectorAll('.office-card');
            const noResults = document.getElementById('noResults');
            const paginationContainer = document.getElementById('paginationContainer');
            let visibleCount = 0;

            offices.forEach(office => {
                const type = office.getAttribute('data-type');
                if (!filter || type === filter) {
                    office.style.display = '';
                    visibleCount++;
                } else {
                    office.style.display = 'none';
                }
            });

            // Show/hide no results message
            if (visibleCount === 0 && filter) {
                noResults.style.display = 'block';
                paginationContainer.style.display = 'none';
            } else {
                noResults.style.display = 'none';
                paginationContainer.style.display = 'flex';
            }
        }

        // Auto-hide pagination when filtering
        document.getElementById('officeFilter').addEventListener('change', function() {
            const paginationContainer = document.getElementById('paginationContainer');
            if (this.value) {
                paginationContainer.style.display = 'none';
            } else {
                paginationContainer.style.display = 'flex';
            }
        });
    </script>
@endsection
