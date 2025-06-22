@extends('template')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Daftar Pemesanan Gedung</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="table-primary">
            <tr>
                <th>Gedung</th>
                <th>Email</th>
                <th>Tanggal Mulai</th>
                <th>Tanggal Selesai</th>
                <th>DP Dibayar</th>
                <th>Bukti DP</th>
                <th>Status Pemesanan</th>
                <th>Aksi Admin</th>
                <th>Aksi Pembayaran</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pemesanans as $p)
                <tr>
                    <td>{{ $p->gedung->nama ?? '-' }}</td>
                    <td>{{ $p->email }}</td>
                    <td>{{ $p->tanggal_mulai }}</td>
                    <td>{{ $p->tanggal_selesai }}</td>
                    <td>
                        @if($p->pembayaran)
                            Rp{{ number_format($p->pembayaran->jumlah_bayar, 0, ',', '.') }}
                        @else
                            <span class="text-muted">Belum bayar</span>
                        @endif
                    </td>
                    <td>
                        @if($p->pembayaran && $p->pembayaran->bukti_bayar)
                            <a href="{{ asset('storage/' . $p->pembayaran->bukti_bayar) }}" target="_blank">
                                <img src="{{ asset('storage/' . $p->pembayaran->bukti_bayar) }}" alt="Bukti Bayar" width="80">
                            </a>
                        @else
                            <span class="text-muted">Tidak ada</span>
                        @endif
                    </td>
                    <td>
                        @if ($p->status == 'pending')
                            <span class="badge bg-warning text-dark">Pending</span>
                        @elseif ($p->status == 'disetujui')
                            <span class="badge bg-success">Disetujui</span>
                        @else
                            <span class="badge bg-danger">Ditolak</span>
                        @endif
                    </td>

                    {{-- Kolom Aksi Admin --}}
                    <td>
                        @if ($p->status == 'pending')
                            <div class="d-flex gap-1">
                                <form method="POST" action="{{ route('pemesanan.accept', $p->id) }}">
                                    @csrf
                                    <button class="btn btn-success btn-sm" onclick="return confirm('Yakin setujui pemesanan ini?')">Accept</button>
                                </form>
                                <form method="POST" action="{{ route('pemesanan.reject', $p->id) }}">
                                    @csrf
                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin tolak pemesanan ini?')">Tolak</button>
                                </form>
                            </div>
                        @else
                            <em>-</em>
                        @endif
                    </td>

                    {{-- Kolom Aksi Pembayaran --}}
                    <td>
                        @if ($p->pembayaran && $p->pembayaran->status_bayar == 'menunggu')
                            <form method="POST" action="{{ route('pembayaran.verifikasi', $p->pembayaran->id) }}">
                                @csrf
                                <button class="btn btn-primary btn-sm" onclick="return confirm('Setujui pembayaran DP ini?')">Verifikasi DP</button>
                            </form>
                        @elseif($p->pembayaran && $p->pembayaran->status_bayar == 'lunas')
                            <span class="badge bg-success">DP Lunas</span>
                        @elseif($p->pembayaran && $p->pembayaran->status_bayar == 'gagal')
                            <span class="badge bg-danger">Gagal</span>
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center">Belum ada pemesanan</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
