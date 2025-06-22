@extends('template')

@section('content')
<div class="container py-5 d-flex justify-content-center">
    <div class="card shadow-lg border-0" style="max-width: 650px; width: 100%;">
        <div class="card-body text-center">
            <h3 class="mb-4 text-primary fw-bold">🧾 Bukti Pemesanan Gedung</h3>

            <table class="table table-sm table-borderless text-start mb-4">
                <tr>
                    <th style="width: 40%;">Gedung</th>
                    <td>: {{ $pemesanan->gedung->nama }}</td>
                </tr>
                <tr>
                    <th>Email Pemesan</th>
                    <td>: {{ $pemesanan->email }}</td>
                </tr>
                <tr>
                    <th>Tanggal Mulai</th>
                    <td>: {{ $pemesanan->tanggal_mulai }}</td>
                </tr>
                <tr>
                    <th>Tanggal Selesai</th>
                    <td>: {{ $pemesanan->tanggal_selesai }}</td>
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
                    <td>:
                        <strong class="text-success">
                            Rp{{ number_format(($pemesanan->pembayaran->jumlah_bayar ?? 0) + ($pemesanan->pembayaran->pelunasan ?? 0), 0, ',', '.') }}
                        </strong>
                    </td>
                </tr>
                <tr>
                    <th>Tanggal Bayar</th>
                    <td>: {{ $pemesanan->pembayaran->tanggal_bayar ?? '-' }}</td>
                </tr>
            </table>

            @if ($pemesanan->pembayaran->bukti_bayar)
                <div class="mt-3">
                    <p class="fw-bold">🖼️ Bukti Pembayaran:</p>
                    <img src="{{ asset('storage/' . $pemesanan->pembayaran->bukti_bayar) }}"
                         class="img-thumbnail shadow-sm"
                         alt="Bukti Bayar"
                         style="max-height: 300px;">
                </div>
            @endif

            <hr class="my-4">
            <p class="text-muted small">
                Simpan halaman ini sebagai bukti resmi pemesanan gedung.<br>
                Terima kasih telah menggunakan layanan kami 🙏
            </p>

            <a href="{{ url()->previous() }}" class="btn btn-outline-primary mt-2">⬅️ Kembali</a>
            <button onclick="window.print()" class="btn btn-primary mt-2">🖨️ Cetak</button>
        </div>
    </div>
</div>
@endsection
