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

        <div class="mb-4">
            <label class="form-label">Fasilitas</label>
            <div class="row">
                <div class="col-md-4 mb-2">
                    <label for="meja" class="form-label">Jumlah Meja</label>
                    <input type="number" class="form-control" id="meja" name="meja" placeholder="Contoh: 20">
                </div>

                <div class="col-md-4 mb-2">
                    <label for="kursi" class="form-label">Jumlah Kursi</label>
                    <input type="number" class="form-control" id="kursi" name="kursi" placeholder="Contoh: 100">
                </div>

                <div class="col-md-4 mb-2">
                    <label for="proyektor" class="form-label">Jumlah Proyektor</label>
                    <input type="number" class="form-control" id="proyektor" name="proyektor" placeholder="Contoh: 2">
                </div>

                <div class="col-md-4 mb-2">
                    <label for="wc" class="form-label">Jumlah WC</label>
                    <input type="number" class="form-control" id="wc" name="wc" placeholder="Contoh: 4">
                </div>

                <div class="col-md-4 mb-2">
                    <label for="tempat_ibadah" class="form-label">Tempat Ibadah</label>
                    <input type="text" class="form-control" id="tempat_ibadah" name="tempat_ibadah" placeholder="Contoh: Mushola">
                </div>

                <div class="col-md-4 mb-2">
                    <label for="wifi" class="form-label">Wi-Fi</label>
                    <input type="text" class="form-control" id="wifi" name="wifi" placeholder="Contoh: 100Mbps tersedia">
                </div>

                <div class="col-md-4 mb-2">
                    <label for="ac" class="form-label">AC</label>
                    <input type="text" class="form-control" id="ac" name="ac" placeholder="Contoh: 4 unit, Central AC">
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label for="lainnya" class="form-label">Fasilitas Lainnya</label>
            <input type="text" class="form-control" id="lainnya" name="lainnya" placeholder="Contoh: Sound system, panggung">
        </div>

        <div class="mb-3">
            <label for="foto" class="form-label">Foto Gedung</label>
            <input type="file" class="form-control" id="foto" name="foto" accept="image/*">
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
