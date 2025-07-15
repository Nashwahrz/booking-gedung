@extends('template')

@section('content')
<div class="container py-5">
    <div class="card shadow-lg border-0 rounded-4 mx-auto" style="max-width: 750px; background-color: #f8f9fa;">
        <div class="card-body p-4">
            <h3 class="mb-4 text-center fw-bold" style="color: #1e2c3d;">
                <i class="bi bi-journal-check me-2" style="color: #2d7a8d;"></i>Form Booking - {{ $gedung->nama }}
            </h3>

            <form action="{{ route('booking.store') }}" method="POST">
                @csrf
                <input type="hidden" name="gedung_id" value="{{ $gedung->id }}">

                {{-- NAMA KEGIATAN --}}
                <div class="mb-3">
                    <label for="nama_kegiatan" class="form-label fw-medium" style="color: #1e2c3d;">
                        <i class="bi bi-bullseye me-1" style="color: #2d7a8d;"></i> Nama Kegiatan
                    </label>
                    <input type="text" name="nama_kegiatan" id="nama_kegiatan" class="form-control border-2" placeholder="kuliah umum" style="border-color: #ccecee;" required>
                </div>

                {{-- EMAIL --}}
                <div class="mb-3">
                    <label for="email" class="form-label fw-medium" style="color: #1e2c3d;">
                        <i class="bi bi-envelope me-1" style="color: #2d7a8d;"></i> Email
                    </label>
                    <input type="email" name="email" id="email" class="form-control border-2" placeholder="contoh@email.com" style="border-color: #ccecee;" required>
                </div>

                {{-- NO HP --}}
                <div class="mb-3">
                    <label for="no_hp" class="form-label fw-medium" style="color: #1e2c3d;">
                        <i class="bi bi-phone me-1" style="color: #2d7a8d;"></i> No HP
                    </label>
                    <input type="text" name="no_hp" id="no_hp" class="form-control border-2" placeholder="08xxxxxxxxxx" style="border-color: #ccecee;" required>
                </div>

                {{-- TANGGAL --}}
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="tanggal_mulai" class="form-label fw-medium" style="color: #1e2c3d;">
                            <i class="bi bi-calendar-event me-1" style="color: #2d7a8d;"></i> Tanggal Mulai
                        </label>
                        <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="form-control border-2" value="{{ $tanggal }}" style="border-color: #ccecee;" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="tanggal_selesai" class="form-label fw-medium" style="color: #1e2c3d;">
                            <i class="bi bi-calendar2-check me-1" style="color: #2d7a8d;"></i> Tanggal Selesai
                        </label>
                        <input type="date" name="tanggal_selesai" id="tanggal_selesai" class="form-control border-2" style="border-color: #ccecee;" required>
                    </div>
                </div>
                    <p><i>Pilih "Booking Seharian" untuk pemakaian satu hari penuh.</i></p>
                {{-- BOOKING SEHARIAN --}}
                <div class="form-check form-switch mb-3">
                    <input class="form-check-input" type="checkbox" name="seharian" id="seharian" value="1" onchange="toggleJam()" style="background-color: #ccecee; border-color: #2d7a8d;">
                    <label class="form-check-label fw-medium" for="seharian" style="color: #1e2c3d;">
                        Booking Seharian (00:00 - 23:59)
                    </label>
                </div>

                {{-- JAM --}}
                <div id="jamSection">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="jam_mulai" class="form-label fw-medium" style="color: #1e2c3d;">
                                <i class="bi bi-clock me-1" style="color: #2d7a8d;"></i> Jam Mulai
                            </label>
                            <input type="time" name="jam_mulai" id="jam_mulai" class="form-control border-2" style="border-color: #ccecee;">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="jam_selesai" class="form-label fw-medium" style="color: #1e2c3d;">
                                <i class="bi bi-clock-history me-1" style="color: #2d7a8d;"></i> Jam Selesai
                            </label>
                            <input type="time" name="jam_selesai" id="jam_selesai" class="form-control border-2" style="border-color: #ccecee;">
                        </div>
                    </div>
                </div>

                {{-- JAM YANG SUDAH DIBOOKING --}}
                @if (!empty($bookedTimes))
                    <div class="alert alert-warning rounded-3 shadow-sm" style="background-color: #fff3cd; border-color: #ffeeba;">
                        <strong style="color: #856404;"><i class="bi bi-clock-history me-1"></i>Jam yang sudah dibooking:</strong>
                        <ul class="mt-2 mb-0" style="color: #1e2c3d;">
                            @foreach ($bookedTimes as $booked)
                                <li>🕒 {{ \Carbon\Carbon::parse($booked['jam_mulai'])->format('H:i') }} s/d {{ \Carbon\Carbon::parse($booked['jam_selesai'])->format('H:i') }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- TOMBOL --}}
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ url()->previous() }}" class="btn px-4" style="background-color: #ccecee; color: #1e2c3d; border: 1px solid #2d7a8d;">
                        <i class="bi bi-arrow-left-circle"></i> Batal
                    </a>
                    <button type="submit" class="btn px-4" style="background-color: #2d7a8d; color: white;">
                        <i class="bi bi-send-check"></i> Kirim Booking
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- SCRIPT TOGGLE JAM --}}
<script>
function toggleJam() {
    const seharian = document.getElementById('seharian').checked;
    const jamSection = document.getElementById('jamSection');
    jamSection.style.display = seharian ? 'none' : 'block';
}

document.addEventListener("DOMContentLoaded", () => {
    toggleJam(); // Trigger saat reload
});
</script>
@endsection
