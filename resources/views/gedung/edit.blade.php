@extends('template')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow border-0 rounded-4">
                <div class="card-body p-5">
                    <h3 class="mb-4 text-success fw-bold">
                        <i class="fas fa-pen-to-square me-2"></i>Edit Data Gedung
                    </h3>

                    @if ($errors->any())
                        <div class="alert alert-danger shadow-sm">
                            <strong>Oops!</strong> Ada kesalahan:
                            <ul class="mt-2 mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('gedung.update', $gedung->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="nama" class="form-label fw-semibold">Nama Gedung</label>
                                <input type="text" class="form-control" id="nama" name="nama" value="{{ $gedung->nama }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="lokasi" class="form-label fw-semibold">Lokasi</label>
                                <input type="text" class="form-control" id="lokasi" name="lokasi" value="{{ $gedung->lokasi }}" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi" class="form-label fw-semibold">Deskripsi</label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required>{{ $gedung->deskripsi }}</textarea>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="kapasitas" class="form-label fw-semibold">Kapasitas</label>
                                <input type="number" class="form-control" id="kapasitas" name="kapasitas" value="{{ $gedung->kapasitas }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="harga_per_hari" class="form-label fw-semibold">Harga per Hari</label>
                                <input type="number" class="form-control" id="harga_per_hari" name="harga_per_hari" value="{{ $gedung->harga_per_hari }}" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="kategori_id" class="form-label fw-semibold">Kategori</label>
                            <select class="form-select" id="kategori_id" name="kategori_id" required>
                                <option value="">-- Pilih Kategori --</option>
                                @foreach ($kategoris as $kategori)
                                    <option value="{{ $kategori->id }}" {{ $gedung->kategori_id == $kategori->id ? 'selected' : '' }}>
                                        {{ $kategori->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <hr class="my-4">

                        @php $f = $gedung->fasilitas; @endphp
                        <h5 class="mb-3 text-primary">Fasilitas Gedung</h5>

                        <div class="row g-3">
                            <div class="col-md-4">
                                <label for="meja" class="form-label">Jumlah Meja</label>
                                <input type="number" class="form-control" name="meja" id="meja" value="{{ $f->meja }}">
                            </div>
                            <div class="col-md-4">
                                <label for="kursi" class="form-label">Jumlah Kursi</label>
                                <input type="number" class="form-control" name="kursi" id="kursi" value="{{ $f->kursi }}">
                            </div>
                            <div class="col-md-4">
                                <label for="proyektor" class="form-label">Jumlah Proyektor</label>
                                <input type="number" class="form-control" name="proyektor" id="proyektor" value="{{ $f->proyektor }}">
                            </div>
                            <div class="col-md-4">
                                <label for="wc" class="form-label">Jumlah WC</label>
                                <input type="number" class="form-control" name="wc" id="wc" value="{{ $f->wc }}">
                            </div>
                            <div class="col-md-4">
                                <label for="tempat_ibadah" class="form-label">Tempat Ibadah</label>
                                <input type="text" class="form-control" name="tempat_ibadah" id="tempat_ibadah" value="{{ $f->tempat_ibadah }}">
                            </div>
                            <div class="col-md-4">
                                <label for="wifi" class="form-label">Wi-Fi</label>
                                <input type="text" class="form-control" name="wifi" id="wifi" value="{{ $f->wifi }}">
                            </div>
                            <div class="col-md-4">
                                <label for="ac" class="form-label">AC</label>
                                <input type="text" class="form-control" name="ac" id="ac" value="{{ $f->ac }}">
                            </div>
                            <div class="col-md-8">
                                <label for="lainnya" class="form-label">Fasilitas Lainnya</label>
                                <input type="text" class="form-control" name="lainnya" id="lainnya" value="{{ $f->lainnya }}">
                            </div>
                        </div>

                        <div class="mt-4">
                            <label for="foto" class="form-label fw-semibold">Foto Gedung (kosongkan jika tidak ingin ganti)</label>
                            <input type="file" class="form-control" id="foto" name="foto" accept="image/*">
                            @if ($gedung->foto)
                                <div class="mt-2">
                                    <p class="text-muted mb-1">Foto Saat Ini:</p>
                                    <img src="{{ asset('storage/' . $gedung->foto) }}" alt="Foto Gedung" width="150" class="img-thumbnail shadow-sm">
                                </div>
                            @endif
                        </div>

                        <div class="mt-4 d-flex justify-content-between">
                            <a href="{{ route('gedung.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-1"></i> Batal
                            </a>
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save me-1"></i> Simpan Perubahan
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
