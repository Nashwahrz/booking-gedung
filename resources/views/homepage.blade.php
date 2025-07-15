@extends('template')

@section('content')

{{-- ====== SECTION 1: INTRO / HEADER ====== --}}
<section class="d-flex align-items-center text-white border-bottom" style="background: linear-gradient(135deg, #2d7a8d, #1e2c3d); min-height: 100vh;">
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
                        <div class="bg-white rounded-4 p-4 shadow-sm h-100">
                            <i class="fas fa-clock fa-2x mb-3 icon-theme"></i>
                            <h6 class="fw-bold text-theme">Fleksibel</h6>
                            <small class="text-muted">Atur jadwal sesuai kebutuhan</small>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="bg-white rounded-4 p-4 shadow-sm h-100">
                            <i class="fas fa-tags fa-2x mb-3 icon-theme"></i>
                            <h6 class="fw-bold text-theme">Harga Terjangkau</h6>
                            <small class="text-muted">Mulai dari Rp 100.000</small>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="bg-white rounded-4 p-4 shadow-sm h-100">
                            <i class="fas fa-map-marker-alt fa-2x mb-3 icon-theme"></i>
                            <h6 class="fw-bold text-theme">Lokasi Strategis</h6>
                            <small class="text-muted">Lingkungan kampus utama</small>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="bg-white rounded-4 p-4 shadow-sm h-100">
                            <i class="fas fa-calendar-check fa-2x mb-3 icon-theme"></i>
                            <h6 class="fw-bold text-theme">Mudah Dipesan</h6>
                            <small class="text-muted">Online & realtime</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- <div class="col-sm-6 col-lg-4">
    <a href="{{ route('admin.formTambah') }}" class="text-decoration-none">
        <div class="quick-action">
            <i class="bi bi-person-plus-fill"></i>
            <span>Tambah Admin</span>
        </div>
    </a>
</div> --}}

{{-- ====== SECTION 2: LIST GEDUNG ====== --}}
<section class="py-5" id="listGedung">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold text-theme">Daftar Gedung Tersedia</h2>
       <form method="GET" action="{{ url('/') }}" class="mb-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="input-group shadow-sm rounded-pill overflow-hidden">
                <span class="input-group-text bg-white border-0 ps-4">
                    <i class="fas fa-search text-muted"></i>
                </span>
                <input type="text" name="cari" value="{{ request('cari') }}" class="form-control border-0" placeholder="Cari nama gedung...">
                <button class="btn btn-theme px-4 text-white" type="submit">Cari</button>
            </div>
        </div>
    </div>
</form>


            <p class="text-muted">Berikut gedung-gedung yang bisa kamu booking sesuai kebutuhan acara.</p>
        </div>

        <div class="row">
    @forelse ($gedungs as $gedung)
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card h-100 shadow-sm border-0 rounded-4 overflow-hidden bg-white hover-card">
                {{-- Gambar Gedung --}}
                @if ($gedung->foto)
                    <img src="{{ asset('storage/' . $gedung->foto) }}" class="card-img-top" alt="{{ $gedung->nama }}" style="height: 220px; object-fit: cover;">
                @else
                    <img src="https://via.placeholder.com/400x220?text=No+Image" class="card-img-top" alt="No Image">
                @endif

                {{-- Isi Kartu --}}
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title text-theme fw-semibold mb-2">{{ $gedung->nama }}</h5>
                    <p class="card-text text-muted small mb-3">{{ Str::limit($gedung->deskripsi, 100) }}</p>

                    <div class="d-flex flex-column gap-1 mt-auto">
                        <span class="badge bg-theme text-white fw-normal">Rp{{ number_format($gedung->harga_per_hari, 0, ',', '.') }}/hari</span>
                        <span class="badge bg-light text-theme border border-theme">Rp{{ number_format($gedung->harga_per_jam, 0, ',', '.') }}/jam</span>
                    </div>
                </div>

                {{-- Tombol Aksi --}}
                <div class="card-footer bg-white border-0 d-flex justify-content-between align-items-center p-3">
                    <a href="{{ route('gedung.show', ['id' => $gedung->id]) }}#tgl_booking" class="btn btn-theme btn-sm rounded-pill px-3">
                        <i class="fas fa-calendar-check me-1"></i> Booking
                    </a>
                    <a href="{{ route('gedung.show', $gedung->id ?? 0) }}" class="btn btn-outline-theme btn-sm rounded-pill px-3">
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

{{-- ====== CSS TAMBAHAN ====== --}}
<style>
    .text-theme {
        color: #0f3d6e !important;
    }

    .icon-theme {
        color: #2b7a78;
    }

    .bg-theme {
        background-color: #2b7a78 !important;
    }

    .btn-theme {
        background-color: #2b7a78;
        color: white;
        border: none;
        transition: 0.3s ease;
    }

    .btn-theme:hover {
        background-color: #246b68;
        color: #fff;
    }

    .btn-outline-theme {
        border: 1px solid #2b7a78;
        color: #2b7a78;
        transition: 0.3s ease;
    }

    .btn-outline-theme:hover {
        background-color: #2b7a78;
        color: white;
    }

    .card:hover {
        transform: translateY(-4px);
        transition: 0.3s ease;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
    }

    .card-title {
        font-size: 1.1rem;
        color: #0f3d6e;
        font-weight: 600;
    }

    .card-text {
        font-size: 0.95rem;
    }

    .card-footer {
        background-color: #f8f9fa;
    }

    .badge {
        font-size: 0.85rem;
        padding: 6px 12px;
        border-radius: 20px;
    }

    .badge-theme {
        background-color: #ccecee;
        color: #0f3d6e;
        font-weight: 500;
    }

    .border-theme {
        border-color: #2b7a78 !important;
    }

    section {
        scroll-margin-top: 90px;
    }

    .input-group-text {
        background-color: white;
        border: none;
    }

    .input-group input:focus {
        box-shadow: none;
        outline: none;
    }

    .hover-card {
        transition: all 0.3s ease-in-out;
    }

    .hover-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.12);
    }
</style>


@include('contact')

@endsection
@if(request('cari'))
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const target = document.getElementById('listGedung');
        if (target) {
            target.scrollIntoView({ behavior: 'smooth' });
        }
    });
</script>
@endif
