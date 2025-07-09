@extends('template')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <!-- Header -->
                <div class="card-header bg-gradient-pemesanan py-4">
                    <div class="d-flex align-items-center justify-content-center">
                        <div class="bg-white rounded-3 p-2 shadow-sm me-3">
                            <i class="bi bi-search-heart fs-4 text-primary-custom"></i>
                        </div>
                        <h4 class="mb-0 text-white fw-bold">Cek Status Pemesanan</h4>
                    </div>
                </div>

                <!-- Body -->
                <div class="card-body p-4 p-md-5" style="background-color: #ffffff;">
                    <p class="text-muted text-center mb-4">
                        Masukkan alamat email yang Anda gunakan untuk memesan
                    </p>

                    <form action="{{ route('pemesanan.cek') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="email" class="form-label fw-medium text-dark">Email Pemesanan</label>
                            <div class="input-group border rounded-3 bg-input-custom">
                                <span class="input-group-text bg-transparent border-0">
                                    <i class="bi bi-envelope-fill text-primary-custom"></i>
                                </span>
                                <input type="email" name="email" id="email"
                                       class="form-control border-0 py-2 bg-transparent text-dark"
                                       placeholder="contoh: nama@email.com"
                                       required>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary-custom w-100 rounded-3 py-2 fw-medium shadow-sm">
                            <i class="bi bi-search me-2"></i> Cari Pemesanan
                        </button>
                    </form>

                    <div class="mt-4 text-center">
                        <p class="small text-muted mb-1">
                            <i class="bi bi-info-circle me-1"></i>
                            Sistem akan menampilkan semua pemesanan terkait email ini
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Gak ubah body agar tetap putih */

    .bg-gradient-pemesanan {
        background: linear-gradient(135deg, #2d7a8d, #1e2c3d);
    }

    .text-primary-custom {
        color: #2d7a8d !important;
    }

    .btn-primary-custom {
        background-color: #2d7a8d;
        border: none;
        color: #ffffff;
        transition: background-color 0.3s ease;
    }

    .btn-primary-custom:hover {
        background-color: #1e2c3d;
        color: #ffffff;
    }

    .bg-input-custom {
        background-color: #ccecee;
    }

    .card {
        transition: transform 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
    }

    .input-group:focus-within {
        box-shadow: 0 0 0 0.25rem rgba(45, 122, 141, 0.3);
        border-color: #2d7a8d;
    }
</style>
@endsection
