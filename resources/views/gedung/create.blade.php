@extends('template')

@section('content')
<div class="container">
    <h2 class="mb-4">Tambah Gedung</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Oops!</strong> Ada kesalahan input:<br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('gedung.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="nama" class="form-label">Nama Gedung</label>
            <input type="text" class="form-control" id="nama" name="nama" required>
        </div>

        <div class="mb-3">
            <label for="lokasi" class="form-label">Lokasi</label>
            <input type="text" class="form-control" id="lokasi" name="lokasi" required>
        </div>

        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required></textarea>
        </div>

        <div class="mb-3">
            <label for="kapasitas" class="form-label">Kapasitas</label>
            <input type="number" class="form-control" id="kapasitas" name="kapasitas" required>
        </div>

        <div class="mb-3">
            <label for="harga_per_hari" class="form-label">Harga per Hari</label>
            <input type="number" class="form-control" id="harga_per_hari" name="harga_per_hari" required>
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

        <div class="mb-3">
            <label class="form-label">Fasilitas</label><br>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="meja" id="meja">
                <label class="form-check-label" for="meja">Meja</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="kursi" id="kursi">
                <label class="form-check-label" for="kursi">Kursi</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="proyektor" id="proyektor">
                <label class="form-check-label" for="proyektor">Proyektor</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="wc" id="wc">
                <label class="form-check-label" for="wc">WC</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="tempat_ibadah" id="tempat_ibadah">
                <label class="form-check-label" for="tempat_ibadah">Tempat Ibadah</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="wifi" id="wifi">
                <label class="form-check-label" for="wifi">Wi-Fi</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="ac" id="ac">
                <label class="form-check-label" for="ac">AC</label>
            </div>
        </div>

        <div class="mb-3">
            <label for="lainnya" class="form-label">Fasilitas Lainnya</label>
            <input type="text" class="form-control" id="lainnya" name="lainnya" placeholder="Contoh: Sound system, panggung...">
        </div>

        <div class="mb-3">
            <label for="foto" class="form-label">Foto Gedung</label>
            <input type="file" class="form-control" id="foto" name="foto" accept="image/*">
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
