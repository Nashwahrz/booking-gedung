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

        <div class="mb-3">
            <label class="form-label">Fasilitas</label><br>
            @php $f = $gedung->fasilitas; @endphp
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="meja" id="meja" {{ $f->meja ? 'checked' : '' }}>
                <label class="form-check-label" for="meja">Meja</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="kursi" id="kursi" {{ $f->kursi ? 'checked' : '' }}>
                <label class="form-check-label" for="kursi">Kursi</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="proyektor" id="proyektor" {{ $f->proyektor ? 'checked' : '' }}>
                <label class="form-check-label" for="proyektor">Proyektor</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="wc" id="wc" {{ $f->wc ? 'checked' : '' }}>
                <label class="form-check-label" for="wc">WC</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="tempat_ibadah" id="tempat_ibadah" {{ $f->tempat_ibadah ? 'checked' : '' }}>
                <label class="form-check-label" for="tempat_ibadah">Tempat Ibadah</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="wifi" id="wifi" {{ $f->wifi ? 'checked' : '' }}>
                <label class="form-check-label" for="wifi">Wi-Fi</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="ac" id="ac" {{ $f->ac ? 'checked' : '' }}>
                <label class="form-check-label" for="ac">AC</label>
            </div>

            <div class="mt-2">
                <label for="lainnya" class="form-label">Fasilitas Lainnya</label>
                <input type="text" class="form-control" name="lainnya" id="lainnya" value="{{ $f->lainnya }}">
            </div>
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
