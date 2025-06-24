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

<div class="container py-4">
    <h3 class="mb-4">Pelunasan Sisa Pembayaran</h3>

    <div class="mb-3">
        <p>
            <strong>Gedung:</strong> {{ $pemesanan->gedung->nama }}<br>
            <strong>Tanggal:</strong> {{ $pemesanan->tanggal_mulai }} s/d {{ $pemesanan->tanggal_selesai }} ({{ $days }} hari)<br>
            <strong>Total Harga:</strong> Rp{{ number_format($totalHarga, 0, ',', '.') }}<br>
            <strong>DP Sudah Dibayar:</strong> Rp{{ number_format($dpSudahBayar, 0, ',', '.') }}<br>
            <strong><span class="text-danger">Sisa Pelunasan:</span></strong>
            <span class="fw-bold text-danger">Rp{{ number_format($sisaPelunasan, 0, ',', '.') }}</span>
        </p>
    </div>

    <form action="{{ route('pembayaran.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="pemesanan_id" value="{{ $pemesanan->id }}">
        <input type="hidden" name="is_pelunasan" value="1">

        <div class="mb-3">
            <label for="tanggal_bayar" class="form-label">Tanggal Bayar</label>
            <input type="date" name="tanggal_bayar" id="tanggal_bayar" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="jumlah_pelunasan" class="form-label">Jumlah Pelunasan</label>
            <input type="number" name="jumlah_pelunasan" id="jumlah_pelunasan" class="form-control" value="{{ $sisaPelunasan }}" readonly>
        </div>

        <div class="mb-3">
            <label for="bukti_bayar" class="form-label">Upload Bukti Pelunasan</label>
            <input type="file" name="bukti_bayar" id="bukti_bayar" class="form-control" accept="image/*" required>
        </div>

        <button type="submit" class="btn btn-success">💰 Kirim Pelunasan</button>
    </form>
</div>
@endsection
