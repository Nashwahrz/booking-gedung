@extends('template')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">Form Booking - {{ $gedung->nama }}</h2>

    <form action="{{ route('booking.store') }}" method="POST">
        @csrf

        <input type="hidden" name="gedung_id" value="{{ $gedung->id }}">

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>No HP</label>
            <input type="text" name="no_hp" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Tanggal Mulai</label>
            <input type="date" name="tanggal_mulai" class="form-control" value="{{ $tanggal }}">
        </div>

        <div class="mb-3">
            <label>Tanggal Selesai</label>
            <input type="date" name="tanggal_selesai" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Kirim Booking</button>
        <a href="{{ url()->previous() }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
