@extends('template')

@section('content')
<div class="container">
    <h2 class="mb-4">Edit Gedung</h2>

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

    <form action="{{ route('gedung.update', $gedung->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nama" class="form-label">Nama Gedung</label>
            <input type="text" class="form-control" id="nama" name="nama" value="{{ $gedung->nama }}" required>
        </div>

        <div class="mb-3">
            <label for="lokasi" class="form-label">Lokasi</label>
            <input type="text" class="form-control" id="lokasi" name="lokasi" value="{{ $gedung->lokasi }}" required>
        </div>

        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required>{{ $gedung->deskripsi }}</textarea>
        </div>

        <div class="mb-3">
            <label for="kapasitas" class="form-label">Kapasitas</label>
            <input type="number" class="form-control" id="kapasitas" name="kapasitas" value="{{ $gedung->kapasitas }}" required>
        </div>

        <div class="mb-3">
            <label for="harga_per_hari" class="form-label">Harga per Hari</label>
            <input type="number" class="form-control" id="harga_per_hari" name="harga_per_hari" value="{{ $gedung->harga_per_hari }}" required>
        </div>

        <div class="mb-3">
            <label for="kategori_id" class="form-label">Kategori</label>
            <select class="form-select" id="kategori_id" name="kategori_id" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach ($kategoris as $kategori)
                    <option value="{{ $kategori->id }}" {{ $gedung->kategori_id == $kategori->id ? 'selected' : '' }}>
                        {{ $kategori->nama_kategori }}
                    </option>
                @endforeach
            </select>
        </div>

        @php $f = $gedung->fasilitas; @endphp
        <div class="mb-4">
            <label class="form-label">Fasilitas</label>
            <div class="row">
                <div class="col-md-4 mb-2">
                    <label for="meja" class="form-label">Jumlah Meja</label>
                    <input type="number" class="form-control" name="meja" id="meja" value="{{ $f->meja }}">
                </div>

                <div class="col-md-4 mb-2">
                    <label for="kursi" class="form-label">Jumlah Kursi</label>
                    <input type="number" class="form-control" name="kursi" id="kursi" value="{{ $f->kursi }}">
                </div>

                <div class="col-md-4 mb-2">
                    <label for="proyektor" class="form-label">Jumlah Proyektor</label>
                    <input type="number" class="form-control" name="proyektor" id="proyektor" value="{{ $f->proyektor }}">
                </div>

                <div class="col-md-4 mb-2">
                    <label for="wc" class="form-label">Jumlah WC</label>
                    <input type="number" class="form-control" name="wc" id="wc" value="{{ $f->wc }}">
                </div>

                <div class="col-md-4 mb-2">
                    <label for="tempat_ibadah" class="form-label">Tempat Ibadah</label>
                    <input type="text" class="form-control" name="tempat_ibadah" id="tempat_ibadah" value="{{ $f->tempat_ibadah }}">
                </div>

                <div class="col-md-4 mb-2">
                    <label for="wifi" class="form-label">Wi-Fi</label>
                    <input type="text" class="form-control" name="wifi" id="wifi" value="{{ $f->wifi }}">
                </div>

                <div class="col-md-4 mb-2">
                    <label for="ac" class="form-label">AC</label>
                    <input type="text" class="form-control" name="ac" id="ac" value="{{ $f->ac }}">
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label for="lainnya" class="form-label">Fasilitas Lainnya</label>
            <input type="text" class="form-control" name="lainnya" id="lainnya" value="{{ $f->lainnya }}">
        </div>

        <div class="mb-3">
            <label for="foto" class="form-label">Foto Gedung (kosongkan jika tidak ingin ganti)</label>
            <input type="file" class="form-control" id="foto" name="foto" accept="image/*">
            @if ($gedung->foto)
                <p class="mt-2">Foto saat ini:</p>
                <img src="{{ asset('storage/' . $gedung->foto) }}" alt="Foto Gedung" width="150">
            @endif
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('gedung.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
