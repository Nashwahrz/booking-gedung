@extends('template')

@section('content')
<style>
    .receipt-wrapper {
        max-width: 750px;
        width: 100%;
        background: #fff;
        padding: 25px;
        border: 1px solid #ddd;
        box-shadow: 0 0 5px rgba(0,0,0,0.05);
        font-family: 'Segoe UI', sans-serif;
        font-size: 12px;
        line-height: 1.4;
    }
    .receipt-header {
        border-bottom: 2px solid #246b68;
        padding-bottom: 12px;
        margin-bottom: 20px;
    }
    .receipt-title {
        font-size: 16px;
        font-weight: 700;
        color: #246b68;
    }
    .receipt-logo {
        height: 40px;
    }
    .stempel {
        position: absolute;
        top: -30px;
        left: 50%;
        transform: translateX(-50%);
        opacity: 0.2;
        height: 60px;
        z-index: 0;
    }

    @media print {
        @page {
            size: A4;
            margin: 10mm;
        }
        body {
            background: white !important;
            margin: 0;
            padding: 0;
        }
        .btn, nav, footer {
            display: none !important;
        }
        .receipt-wrapper {
            transform: scale(0.93);
            transform-origin: top center;
            box-shadow: none;
            border: none;
            padding: 10mm;
            font-size: 11px;
        }
        .receipt-title {
            font-size: 14px;
        }
        .receipt-logo {
            height: 35px;
        }
        .stempel {
            height: 50px !important;
            top: -25px !important;
            opacity: 0.2 !important;
        }
    }
</style>

<div class="container py-4 d-flex justify-content-center">
    <div class="receipt-wrapper">
        {{-- Header --}}
        <div class="receipt-header d-flex justify-content-between align-items-center">
            <div>
                <div class="receipt-title">Bukti Pemesanan Gedung</div>
                <small class="text-muted">Sistem Booking Gedung Kampus</small>
            </div>
            <img src="{{ asset('img/logo.png') }}" alt="Logo" class="receipt-logo">
        </div>

        {{-- Data Pemesanan --}}
        <table class="table table-borderless mb-4" style="width: 100%;">
            <tbody>
                <tr>
                    <th style="width: 35%;">Nama Gedung</th>
                    <td>: {{ $pemesanan->gedung->nama }}</td>
                </tr>
                <tr>
                    <th>Email Pemesan</th>
                    <td>: {{ $pemesanan->email }}</td>
                </tr>
                <tr>
                    <th>Tanggal Pemakaian</th>
                    <td>: {{ $pemesanan->tanggal_mulai }} s/d {{ $pemesanan->tanggal_selesai }}</td>
                </tr>
                <tr>
                    <th>Jam Pemakaian</th>
                    <td>:
                        {{ \Carbon\Carbon::parse($pemesanan->jam_mulai)->format('H:i') }} WIB
                        s/d
                        {{ \Carbon\Carbon::parse($pemesanan->jam_selesai)->format('H:i') }} WIB
                    </td>
                </tr>
                <tr>
                    <th>Status Pemesanan</th>
                    <td>:
                        @if ($pemesanan->status === 'disetujui')
                            <span class="badge bg-success">Disetujui</span>
                        @elseif ($pemesanan->status === 'pending')
                            <span class="badge bg-warning text-dark">Pending</span>
                        @else
                            <span class="badge bg-danger">Ditolak</span>
                        @endif
                    </td>
                </tr>
                <tr><td colspan="2"><hr></td></tr>
                <tr>
                    <th>DP (Uang Muka)</th>
                    <td>: Rp{{ number_format($pemesanan->pembayaran->jumlah_bayar ?? 0, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th>Pelunasan</th>
                    <td>: Rp{{ number_format($pemesanan->pembayaran->pelunasan ?? 0, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th>Total Dibayar</th>
                    <td><strong class="text-success">: Rp{{ number_format(($pemesanan->pembayaran->jumlah_bayar ?? 0) + ($pemesanan->pembayaran->pelunasan ?? 0), 0, ',', '.') }}</strong></td>
                </tr>
                <tr>
                    <th>Tanggal Bayar</th>
                    <td>: {{ $pemesanan->pembayaran->tanggal_bayar ?? '-' }}</td>
                </tr>
            </tbody>
        </table>

        {{-- Bukti Transfer --}}
        @if ($pemesanan->pembayaran->bukti_bayar)
            <p class="fw-semibold">Bukti Transfer:</p>
            <img src="{{ asset('storage/' . $pemesanan->pembayaran->bukti_bayar) }}"
                 alt="Bukti Bayar"
                 class="img-thumbnail mb-4"
                 style="max-height: 180px;">
        @endif

        {{-- Tanda Tangan --}}
        <div class="d-flex justify-content-between mt-4">
            <div>
                <p class="mb-1">Pihak Pemesan,</p><br><br>
                <p class="fw-semibold">{{ $pemesanan->email }}</p>
            </div>
            <div class="text-end position-relative" style="min-height: 90px;">
                <p class="mb-1">Petugas,</p>
                <div class="position-relative d-inline-block mt-4">
                    <img src="{{ asset('img/gedung.png') }}" alt="Stempel" class="stempel">
                    <p class="fw-semibold position-relative" style="z-index: 1;">Admin Booking</p>
                </div>
            </div>
        </div>

        <hr class="my-3">
        <p class="text-muted small text-center">
            Cetakan sistem – tidak memerlukan tanda tangan.<br>
            Terima kasih telah menggunakan layanan Booking Gedung.
        </p>

        {{-- Tombol --}}
        <div class="text-center mt-2">
            <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">⬅ Kembali</a>
            <button onclick="window.print()" class="btn btn-primary">🖨 Cetak Bukti</button>
        </div>
    </div>
</div>
@endsection
