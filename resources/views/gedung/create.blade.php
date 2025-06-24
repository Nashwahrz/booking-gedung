@extends('template')

@section('content')
<style>
    body {
        background-color: #f4f9fd;
    }

    .card {
        border-radius: 18px;
        border: none;
    }

    .form-label {
        font-weight: 600;
    }

    .form-control:focus {
        border-color: #2d7a8d;
        box-shadow: 0 0 0 0.2rem rgba(45, 122, 141, 0.25);
    }

    .btn-primary {
        background-color: #2d7a8d;
        border-color: #2d7a8d;
    }

    .btn-primary:hover {
        background-color: #246b7b;
        border-color: #246b7b;
    }

    .btn-outline-secondary:hover {
        background-color: #e2e6ea;
    }

    .alert-danger {
        background-color: #ffe5e5;
        color: #b20000;
        border: none;
    }

    .form-section-title {
        font-size: 1.1rem;
        font-weight: bold;
        color: #0f3d6e;
    }

    .form-control, .form-select {
        border-radius: 10px;
    }
</style>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-sm">
                <div class="card-body p-5">
                   <h2 class="mb-4 fw-bold d-inline-block px-3 py-2 shadow-sm"
    style="border-left: 6px solid #2d7a8d; background: #e9f6f9; color: #0f3d6e; border-radius: 0 10px 10px 0;">
    <i class="fas fa-building me-2"></i> Form Tambah Gedung Baru
</h2>


                    @if ($errors->any())
                        <div class="alert alert-danger shadow-sm rounded-3 px-3 py-2">
                            <strong>Oops!</strong> Ada kesalahan input:
                            <ul class="mb-0 mt-2">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('gedung.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="nama" class="form-label">Nama Gedung</label>
                                <input type="text" class="form-control" id="nama" name="nama" required>
                            </div>
                            <div class="col-md-6">
                                <label for="lokasi" class="form-label">Lokasi</label>
                                <input type="text" class="form-control" id="lokasi" name="lokasi" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required></textarea>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="kapasitas" class="form-label">Kapasitas</label>
                                <input type="number" class="form-control" id="kapasitas" name="kapasitas" required>
                            </div>
                            <div class="col-md-6">
                                <label for="harga_per_hari" class="form-label">Harga per Hari</label>
                                <input type="number" class="form-control" id="harga_per_hari" name="harga_per_hari" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="kategori_id" class="form-label">Kategori</label>
                            <select class="form-select" id="kategori_id" name="kategori_id" required>
                                <option value="">-- Pilih Kategori --</option>
                                @foreach ($kategoris as $kategori)
                                    <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                                @endforeach
                            </select>
                        </div>

                        <hr class="my-4">
                        <div class="form-section-title mb-3">Fasilitas Gedung</div>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label for="meja" class="form-label">Jumlah Meja</label>
                                <input type="number" class="form-control" id="meja" name="meja" placeholder="Contoh: 20">
                            </div>
                            <div class="col-md-4">
                                <label for="kursi" class="form-label">Jumlah Kursi</label>
                                <input type="number" class="form-control" id="kursi" name="kursi" placeholder="Contoh: 100">
                            </div>
                            <div class="col-md-4">
                                <label for="proyektor" class="form-label">Jumlah Proyektor</label>
                                <input type="number" class="form-control" id="proyektor" name="proyektor" placeholder="Contoh: 2">
                            </div>
                            <div class="col-md-4">
                                <label for="wc" class="form-label">Jumlah WC</label>
                                <input type="number" class="form-control" id="wc" name="wc" placeholder="Contoh: 4">
                            </div>
                            <div class="col-md-4">
                                <label for="tempat_ibadah" class="form-label">Tempat Ibadah</label>
                                <input type="text" class="form-control" id="tempat_ibadah" name="tempat_ibadah" placeholder="Contoh: Mushola">
                            </div>
                            <div class="col-md-4">
                                <label for="wifi" class="form-label">Wi-Fi</label>
                                <input type="text" class="form-control" id="wifi" name="wifi" placeholder="Contoh: 100Mbps tersedia">
                            </div>
                            <div class="col-md-4">
                                <label for="ac" class="form-label">AC</label>
                                <input type="text" class="form-control" id="ac" name="ac" placeholder="Contoh: 4 unit, Central AC">
                            </div>
                            <div class="col-md-8">
                                <label for="lainnya" class="form-label">Fasilitas Lainnya</label>
                                <input type="text" class="form-control" id="lainnya" name="lainnya" placeholder="Contoh: Sound system, panggung">
                            </div>
                        </div>

                        <div class="mt-4">
                            <label for="foto" class="form-label">Upload Foto Gedung</label>
                            <input type="file" class="form-control" id="foto" name="foto" accept="image/*">
                        </div>

                        <div class="mt-4 text-end">
                            <a href="{{ url()->previous() }}" class="btn btn-outline-secondary rounded-3 px-4">Batal</a>
                            <button type="submit" class="btn btn-primary rounded-3 px-4">
                                <i class="fas fa-save me-1"></i> Simpan Gedung
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
