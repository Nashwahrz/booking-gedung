@extends('template')

@section('content')
@php
    use Illuminate\Support\Carbon;

    $start = Carbon::parse($pemesanan->tanggal_mulai);
    $end = Carbon::parse($pemesanan->tanggal_selesai);
    $days = $start->diffInDays($end) + 1;
    $totalHarga = $pemesanan->gedung->harga_per_hari * $days;
    $dpSudahBayar = $pemesanan->pembayaran->jumlah_bayar ?? 0;
    $sisaPelunasan = max($totalHarga - $dpSudahBayar, 0);
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

    .btn-theme {
        background: linear-gradient(135deg, #2d7a8d, #1e2c3d);
        color: white;
        border: none;
        transition: 0.3s ease;
    }

    .btn-theme:hover {
        opacity: 0.9;
    }

    label {
        font-weight: 600;
    }
</style>

<div class="container py-4">
    <h3 class="mb-4 gradient-title"><i class="bi bi-wallet2 me-2"></i>Pelunasan Sisa Pembayaran</h3>

    <div class="info-card">
        <p class="mb-2"><strong>Gedung:</strong> {{ $pemesanan->gedung->nama }}</p>
        <p class="mb-2"><strong>Tanggal Sewa:</strong> {{ $pemesanan->tanggal_mulai }} s/d {{ $pemesanan->tanggal_selesai }} ({{ $days }} hari)</p>
        <p class="mb-2"><strong>Total Harga:</strong> Rp{{ number_format($totalHarga, 0, ',', '.') }}</p>
        <p class="mb-2"><strong>DP Sudah Dibayar:</strong> Rp{{ number_format($dpSudahBayar, 0, ',', '.') }}</p>
        <p class="fw-bold text-danger">Sisa Pelunasan: Rp{{ number_format($sisaPelunasan, 0, ',', '.') }}</p>
    </div>

   @if ($dpSudahBayar <= 0)
    <div class="alert alert-warning shadow-sm d-flex justify-content-between align-items-center">
        <div>
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            Anda belum membayar <strong>Uang Muka (DP)</strong>. Silakan lakukan pembayaran DP terlebih dahulu sebelum melanjutkan pelunasan.
        </div>
      <a href="{{route('pembayaran.dp.form', ['pemesanan' => $pemesanan->id])
 }}?from=pelunasan" class="btn btn-sm btn-outline-primary">
    Bayar DP terlebih dahulu
</a>


    </div>
@else
    {{-- Form pelunasan --}}
    <form action="{{ route('pembayaran.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-4 shadow-sm rounded-4">
        @csrf
        <input type="hidden" name="pemesanan_id" value="{{ $pemesanan->id }}">
        <input type="hidden" name="is_pelunasan" value="1">

        <div class="mb-3">
            <label for="tanggal_bayar" class="form-label">Tanggal Bayar</label>
            <input type="date" name="tanggal_bayar" id="tanggal_bayar" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="jumlah_pelunasan" class="form-label">Jumlah Pelunasan</label>
            <input type="number" name="jumlah_pelunasan" id="jumlah_pelunasan" class="form-control bg-light" value="{{ $sisaPelunasan }}" readonly>
        </div>

        <div class="mb-4">
            <label for="bukti_bayar" class="form-label">Upload Bukti Pelunasan</label>
            <input type="file" name="bukti_bayar" id="bukti_bayar" class="form-control" accept="image/*" required>
        </div>

        <button type="submit" class="btn btn-theme px-4 py-2">
            <i class="bi bi-send-check me-2"></i>Kirim Pelunasan
        </button>
    </form>
@endif

</div>

@endsection
