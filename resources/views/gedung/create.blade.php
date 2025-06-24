@extends('template')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body p-5">
                    <h3 class="mb-4 text-primary fw-bold">
                        <i class="fas fa-plus-circle me-2"></i>Tambah Gedung
                    </h3>

                    @if ($errors->any())
                        <div class="alert alert-danger shadow-sm">
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
                                <label for="nama" class="form-label fw-semibold">Nama Gedung</label>
                                <input type="text" class="form-control" id="nama" name="nama" required>
                            </div>
                            <div class="col-md-6">
                                <label for="lokasi" class="form-label fw-semibold">Lokasi</label>
                                <input type="text" class="form-control" id="lokasi" name="lokasi" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi" class="form-label fw-semibold">Deskripsi</label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required></textarea>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="kapasitas" class="form-label fw-semibold">Kapasitas</label>
                                <input type="number" class="form-control" id="kapasitas" name="kapasitas" required>
                            </div>
                            <div class="col-md-6">
                                <label for="harga_per_hari" class="form-label fw-semibold">Harga per Hari</label>
                                <input type="number" class="form-control" id="harga_per_hari" name="harga_per_hari" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="kategori_id" class="form-label fw-semibold">Kategori</label>
                            <select class="form-select" id="kategori_id" name="kategori_id" required>
                                <option value="">-- Pilih Kategori --</option>
                                @foreach ($kategoris as $kategori)
                                    <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                                @endforeach
                            </select>
                        </div>

                        <hr class="my-4">

                        <h5 class="mb-3 text-primary">Fasilitas Gedung</h5>
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
                            <label for="foto" class="form-label fw-semibold">Upload Foto Gedung</label>
                            <input type="file" class="form-control" id="foto" name="foto" accept="image/*">
                        </div>

                        <div class="mt-4 text-end">
                            <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">Batal</a>
                            <button type="submit" class="btn btn-primary">
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
