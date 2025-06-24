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

<div class="container py-4">
    <h3 class="mb-4">Pembayaran Uang Muka (DP)</h3>

    <div class="mb-3">
        <p>
            <strong>Gedung:</strong> {{ $pemesanan->gedung->nama }}<br>
            <strong>Tanggal:</strong> {{ $pemesanan->tanggal_mulai }} s/d {{ $pemesanan->tanggal_selesai }}<br>
            <strong>Lama Sewa:</strong> {{ $days }} hari<br>
            <strong>Total Biaya Sewa:</strong> Rp{{ number_format($totalHarga, 0, ',', '.') }}<br>
            <strong><span class="text-success">DP 10%:</span></strong> <span class="fw-bold text-success">Rp{{ number_format($dp, 0, ',', '.') }}</span>
        </p>
    </div>

    <form action="{{ route('pembayaran.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="pemesanan_id" value="{{ $pemesanan->id }}">

        <div class="mb-3">
            <label for="tanggal_bayar" class="form-label">Tanggal Bayar</label>
            <input type="date" name="tanggal_bayar" id="tanggal_bayar" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="jumlah_bayar" class="form-label">Jumlah Bayar (DP 10%)</label>
            <input type="number" name="jumlah_bayar" id="jumlah_bayar" class="form-control" value="{{ $dp }}" readonly>
        </div>

        <div class="mb-3">
            <label for="bukti_bayar" class="form-label">Upload Bukti Bayar</label>
            <input type="file" name="bukti_bayar" id="bukti_bayar" class="form-control" accept="image/*" required>
        </div>

        <button type="submit" class="btn btn-success">💸 Kirim Pembayaran</button>
    </form>
</div>
@endsection
