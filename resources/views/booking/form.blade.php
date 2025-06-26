@extends('template')

@section('content')
<div class="container py-5">
    <div class="card shadow-lg border-0 rounded-4 mx-auto" style="max-width: 750px;">
        <div class="card-body">
            <h3 class="mb-4 text-center text-primary fw-bold">
                <i class="bi bi-journal-check me-2"></i>Form Booking - {{ $gedung->nama }}
            </h3>

            <form action="{{ route('booking.store') }}" method="POST">
                @csrf
                <input type="hidden" name="gedung_id" value="{{ $gedung->id }}">
                 <div class="mb-3">
                    <label for="nama_kegiatan" class="form-label">
                        <i class="bi bi-bullseye me-1"></i> Nama Kegiatan
                    </label>
                    <input type="text" name="nama_kegiatan" id="nama_kegiatan" class="form-control" placeholder="kuliah umum" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">
                        <i class="bi bi-envelope me-1"></i> Email
                    </label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="contoh@email.com" required>
                </div>


                <div class="mb-3">
                    <label for="no_hp" class="form-label">
                        <i class="bi bi-phone me-1"></i> No HP
                    </label>
                    <input type="text" name="no_hp" id="no_hp" class="form-control" placeholder="08xxxxxxxxxx" required>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="tanggal_mulai" class="form-label">
                            <i class="bi bi-calendar-event me-1"></i> Tanggal Mulai
                        </label>
                        <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="form-control" value="{{ $tanggal }}" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="tanggal_selesai" class="form-label">
                            <i class="bi bi-calendar2-check me-1"></i> Tanggal Selesai
                        </label>
                        <input type="date" name="tanggal_selesai" id="tanggal_selesai" class="form-control" required>
                    </div>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ url()->previous() }}" class="btn btn-outline-secondary px-4">
                        <i class="bi bi-arrow-left-circle"></i> Batal
                    </a>
                    <button type="submit" class="btn btn-success px-4">
                        <i class="bi bi-send-check"></i> Kirim Booking
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
