@extends('template')

@section('content')
@php
    use Illuminate\Support\Carbon;

    $start = Carbon::parse($pemesanan->tanggal_mulai);
    $end = Carbon::parse($pemesanan->tanggal_selesai);
    $days = $start->diffInDays($end) + 1;
    $totalHarga = $pemesanan->gedung->harga_per_hari * $days;
    $dp = $totalHarga * 0.10;
@endphp

<style>
    .gradient-title {
        background: linear-gradient(135deg, #2d7a8d, #1e2c3d);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        font-weight: 700;
    }

    .info-card {
        background-color: #f8f9fa;
        border-left: 5px solid #2d7a8d;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 3px 8px rgba(0,0,0,0.05);
        margin-bottom: 30px;
    }

    label {
        font-weight: 600;
    }

    .btn-theme {
        background: linear-gradient(135deg, #2d7a8d, #1e2c3d);
        color: white;
        border: none;
        transition: 0.3s ease;
    }

    .btn-theme:hover {
        opacity: 0.9;
    }
</style>

<div class="container py-4">
    <h3 class="mb-4 gradient-title">
        <i class="bi bi-cash-coin me-2"></i> Pembayaran Uang Muka (DP)
    </h3>

    <!-- Informasi Pemesanan -->
    <div class="info-card">
        <p class="mb-2"><strong>Gedung:</strong> {{ $pemesanan->gedung->nama }}</p>
        <p class="mb-2"><strong>Tanggal Sewa:</strong> {{ $pemesanan->tanggal_mulai }} s/d {{ $pemesanan->tanggal_selesai }}</p>
        <p class="mb-2"><strong>Lama Sewa:</strong> {{ $days }} hari</p>
        <p class="mb-2"><strong>Total Biaya Sewa:</strong> Rp{{ number_format($totalHarga, 0, ',', '.') }}</p>
        <p class="mb-0 fw-bold text-success">DP 10%: Rp{{ number_format($dp, 0, ',', '.') }}</p>
    </div>

    <!-- Form Pembayaran DP -->
    <form action="{{ route('pembayaran.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-4 shadow-sm rounded-4">
        @csrf
        <input type="hidden" name="pemesanan_id" value="{{ $pemesanan->id }}">
       <input type="hidden" name="redirect_to_pelunasan" value="{{ request('from') === 'pelunasan' ? '1' : '0' }}">
<!-- Ini untuk tahu asalnya dari pelunasan atau tidak -->

        <div class="mb-3">
            <label for="tanggal_bayar" class="form-label">Tanggal Bayar</label>
            <input type="date" name="tanggal_bayar" id="tanggal_bayar" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="jumlah_bayar" class="form-label">Jumlah Bayar (DP 10%)</label>
            <input type="number" name="jumlah_bayar" id="jumlah_bayar" class="form-control bg-light" value="{{ $dp }}" readonly>
        </div>

        <div class="mb-4">
            <label for="bukti_bayar" class="form-label">Upload Bukti Bayar</label>
            <input type="file" name="bukti_bayar" id="bukti_bayar" class="form-control" accept="image/*" required>
        </div>

        <button type="submit" class="btn btn-theme px-4 py-2">
            <i class="bi bi-send-check me-2"></i> Kirim Pembayaran
        </button>
    </form>
</div>
@endsection
