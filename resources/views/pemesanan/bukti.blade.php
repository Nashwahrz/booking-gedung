@extends('template')

@section('content')
<div class="container py-5">
    <div class="text-center">
        <h3 class="mb-3">Bukti Pemesanan Gedung</h3>
        <p><strong>Gedung:</strong> {{ $pemesanan->gedung->nama }}</p>
        <p><strong>Nama:</strong> {{ $pemesanan->email }}</p>
        <p><strong>Mulai:</strong> {{ $pemesanan->tanggal_mulai }}</p>
        <p><strong>Selesai:</strong> {{ $pemesanan->tanggal_selesai }}</p>
        <p><strong>Status:</strong> {{ ucfirst($pemesanan->status) }}</p>
        <p><strong>Jumlah Dibayar:</strong> Rp{{ number_format($pemesanan->pembayaran->jumlah_bayar, 0, ',', '.') }}</p>
        <p><strong>Tanggal Bayar:</strong> {{ $pemesanan->pembayaran->tanggal_bayar }}</p>

        @if ($pemesanan->pembayaran->bukti_bayar)
            <p><strong>Bukti Pembayaran:</strong></p>
            <img src="{{ asset('storage/' . $pemesanan->pembayaran->bukti_bayar) }}" class="img-fluid" style="max-width: 400px;">
        @endif
    </div>
</div>
@endsection
