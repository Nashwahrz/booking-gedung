@extends('template')

@section('content')

{{-- ====== SECTION 1: INTRO / HEADER (FULL WIDTH BIRU, IKON SAJA) ====== --}}
<section class="d-flex align-items-center text-white border-bottom" style="background-color: #007bff; min-height: 100vh;">
    <div class="container py-5">
        <div class="row gy-5">
            <div class="col-lg-12 text-center">
                <h1 class="display-4 fw-bold mb-3">Temukan Gedung Terbaik di Kampusmu</h1>
                <p class="lead text-white-50 mb-4">
                    Mulai dari seminar akademik, pelatihan UKM, hingga acara resmi – semua bisa kamu laksanakan dengan mudah dan cepat hanya di satu tempat!
                </p>
                <a href="#listGedung" class="btn btn-outline-light btn-lg mb-5">
                    <i class="fas fa-arrow-down me-2"></i> Lihat Daftar Gedung
                </a>
            </div>

            {{-- Baris Ikon Fitur --}}
            <div class="col-lg-12">
                <div class="row text-center g-4 justify-content-center">
                    <div class="col-6 col-md-3">
                        <div class="bg-white rounded-4 p-4 shadow-sm text-primary h-100">
                            <i class="fas fa-clock fa-2x mb-3"></i>
                            <h6 class="fw-bold">Fleksibel</h6>
                            <small class="text-muted">Atur jadwal sesuai kebutuhan</small>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="bg-white rounded-4 p-4 shadow-sm text-primary h-100">
                            <i class="fas fa-tags fa-2x mb-3"></i>
                            <h6 class="fw-bold">Harga Terjangkau</h6>
                            <small class="text-muted">Mulai dari Rp 100.000</small>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="bg-white rounded-4 p-4 shadow-sm text-primary h-100">
                            <i class="fas fa-map-marker-alt fa-2x mb-3"></i>
                            <h6 class="fw-bold">Lokasi Strategis</h6>
                            <small class="text-muted">Lingkungan kampus utama</small>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="bg-white rounded-4 p-4 shadow-sm text-primary h-100">
                            <i class="fas fa-calendar-check fa-2x mb-3"></i>
                            <h6 class="fw-bold">Mudah Dipesan</h6>
                            <small class="text-muted">Online & realtime</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



{{-- ====== SECTION 2: LIST GEDUNG ====== --}}
<section class="py-5" id="listGedung">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold text-dark">Daftar Gedung Tersedia</h2>
            <p class="text-muted">Berikut gedung-gedung yang bisa kamu booking sesuai kebutuhan acara.</p>
        </div>

        <div class="row">
            @forelse ($gedungs as $gedung)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm border-0 rounded-4 overflow-hidden">
                        @if ($gedung->foto)
                            <img src="{{ asset('storage/' . $gedung->foto) }}" class="card-img-top" alt="{{ $gedung->nama }}" style="height: 220px; object-fit: cover;">
                        @else
                            <img src="https://via.placeholder.com/400x220?text=No+Image" class="card-img-top" alt="No Image">
                        @endif

                        <div class="card-body">
                            <h5 class="card-title text-dark fw-semibold">{{ $gedung->nama }}</h5>
                            <p class="card-text text-muted mb-2">{{ Str::limit($gedung->deskripsi, 100) }}</p>
                            <p class="mb-0 text-primary fw-bold">Rp{{ number_format($gedung->harga_per_hari, 0, ',', '.') }} / hari</p>
                        </div>

                        <div class="card-footer bg-white border-0 d-flex justify-content-between p-3">
                            <a href="#" class="btn btn-outline-success btn-sm">
                                <i class="fas fa-calendar-check me-1"></i> Booking
                            </a>
                            <a href="{{ route('gedung.detail', $gedung->id ?? 0) }}" class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-info-circle me-1"></i> Detail
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <img src="{{ asset('img/no-data.svg') }}" alt="No data" class="img-fluid mb-4" style="max-height: 200px;">
                    <h5 class="text-muted">Belum ada gedung yang tersedia.</h5>
                    <p class="text-muted">Silakan hubungi admin jika Anda memerlukan bantuan.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

{{-- CSS Tambahan --}}
<style>
    .card:hover {
        transform: translateY(-4px);
        transition: 0.3s ease;
        box-shadow: 0 8px 20px rgba(0,0,0,0.08);
    }
</style>
@endsection
