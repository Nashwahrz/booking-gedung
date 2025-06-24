@extends('template')

@section('content')
<style>
    .receipt-wrapper {
        max-width: 800px;
        width: 100%;
        background: #fff;
        padding: 40px;
        border: 1px solid #ddd;
        box-shadow: 0 0 10px rgba(0,0,0,0.05);
        font-family: 'Segoe UI', sans-serif;
    }
    .receipt-header {
        border-bottom: 2px solid #007bff;
        padding-bottom: 15px;
        margin-bottom: 30px;
    }
    .receipt-title {
        font-size: 24px;
        font-weight: 700;
        color: #007bff;
    }
    .receipt-logo {
        height: 60px;
    }
    @media print {
        body {
            background: white !important;
        }
        .btn {
            display: none !important;
        }
    }
</style>

<div class="container py-5 d-flex justify-content-center">
    <div class="receipt-wrapper">
        {{-- Kop Surat / Header --}}
        <div class="receipt-header d-flex justify-content-between align-items-center">
            <div>
                <div class="receipt-title">Bukti Pemesanan Gedung</div>
                <small class="text-muted">Sistem Booking Gedung Kampus</small>
            </div>
            <img src="{{ asset('img/logo.png') }}" alt="Logo" class="receipt-logo">
        </div>

        {{-- Isi Data --}}
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

        {{-- Bukti Bayar Gambar --}}
        @if ($pemesanan->pembayaran->bukti_bayar)
            <p class="fw-semibold">Bukti Transfer:</p>
            <img src="{{ asset('storage/' . $pemesanan->pembayaran->bukti_bayar) }}"
                 alt="Bukti Bayar"
                 class="img-thumbnail mb-4"
                 style="max-height: 300px;">
        @endif

        {{-- Footer Tanda Tangan --}}
        <div class="d-flex justify-content-between mt-5">
            <div>
                <p class="mb-1">Pihak Pemesan,</p>
                <br><br>
                <p class="fw-semibold">{{ $pemesanan->email }}</p>
            </div>
            <div class="text-end">
                <p class="mb-1">Petugas,</p>
                <br><br>
                <p class="fw-semibold">Admin Booking</p>
            </div>
        </div>

        <hr class="my-4">
        <p class="text-muted small text-center">
            Bukti ini dicetak secara otomatis oleh sistem dan tidak memerlukan tanda tangan basah.<br>
            Terima kasih telah menggunakan layanan Booking Gedung.
        </p>

        <div class="text-center mt-3">
            <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">⬅ Kembali</a>
            <button onclick="window.print()" class="btn btn-primary">🖨 Cetak Bukti</button>
        </div>
    </div>
</div>
@endsection
