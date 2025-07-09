@extends('template')

@section('content')
    <style>
        .btn-toska {
            background-color: #126060;
            color: white;
        }

        .btn-toska:hover {
            background-color: #007a7a;
        }

        .btn-outline-donker {
            border-color: #0b3c5d;
            color: #0b3c5d;
        }

        .btn-outline-donker:hover {
            background-color: #0b3c5d;
            color: white;
        }
    </style>

    <div class="container py-4">
        <h2 class="mb-4 fw-bold" style="color: #0b3c5d;">
            <i class="bi bi-calendar-check me-2" style="color: #076262;"></i> Daftar Pemesanan Gedung
        </h2>


        @if (session('success'))
            <div class="alert alert-success shadow-sm">{{ session('success') }}</div>
        @endif

        <div class="table-responsive rounded-4 shadow-sm">
            <table class="table table-hover table-bordered align-middle mb-0">
                <thead class="table-info text-center text-dark fw-semibold">
                    <tr>
                        <th>Gedung</th>
                        <th>Email</th>
                        <th>Nama Kegiatan</th>
                        <th>Tgl Mulai</th>
                        <th>Tgl Selesai</th>
                        <th>DP Dibayar</th>
                        <th>Bukti Bayar</th>
                        <th>Pelunasan</th>
                        <th>Status</th>
                        <th>Aksi Admin</th>
                        <th>Pembayaran</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pemesanans as $p)
                        <tr>
                            <td>{{ $p->gedung->nama ?? '-' }}</td>
                            <td>{{ $p->email }}</td>
                            <td>{{ $p->nama_kegiatan }}</td>
                            <td>{{ $p->tanggal_mulai }}</td>
                            <td>{{ $p->tanggal_selesai }}</td>
                            <td class="text-center">
                                @if ($p->pembayaran)
                                    <span class="text-success fw-semibold">
                                        Rp{{ number_format($p->pembayaran->jumlah_bayar, 0, ',', '.') }}
                                    </span>
                                @else
                                    <span class="text-muted fst-italic">Belum bayar</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if ($p->pembayaran && $p->pembayaran->bukti_bayar)
                                    <a href="{{ asset('storage/' . $p->pembayaran->bukti_bayar) }}" target="_blank">
                                        <img src="{{ asset('storage/' . $p->pembayaran->bukti_bayar) }}"
                                            class="img-thumbnail shadow-sm" width="80">
                                        <div class="small text-muted mt-1">
                                            @if ($p->pembayaran->status_bayar === 'lunas')
                                                <i class="bi bi-check-circle-fill text-success"></i> Lunas
                                            @else
                                                <i class="bi bi-cash text-warning"></i> DP
                                            @endif
                                        </div>
                                    </a>
                                @else
                                    <span class="text-muted">Tidak ada</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if ($p->pembayaran && $p->pembayaran->pelunasan)
                                    <span class="text-success fw-semibold">
                                        Rp{{ number_format($p->pembayaran->pelunasan, 0, ',', '.') }}
                                    </span>
                                @else
                                    <span class="text-muted fst-italic">Belum lunas</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @switch($p->status)
                                    @case('pending')
                                        <span class="badge bg-warning text-dark">
                                            <i class="bi bi-hourglass-split me-1"></i> Pending
                                        </span>
                                    @break

                                    @case('disetujui')
                                        <span class="badge bg-success">
                                            <i class="bi bi-check-circle me-1"></i> Disetujui
                                        </span>
                                    @break

                                    @default
                                        <span class="badge bg-danger">
                                            <i class="bi bi-x-circle me-1"></i> Ditolak
                                        </span>
                                @endswitch
                            </td>
                            <td class="text-center">
                                @if ($p->status == 'pending')
                                    <div class="d-flex flex-column gap-1">
                                        <form method="POST" action="{{ route('pemesanan.accept', $p->id) }}">
                                            @csrf
                                            <button class="btn btn-sm btn-toska w-100"
                                                onclick="return confirm('Setujui pemesanan ini?')">
                                                <i class="bi bi-check2-circle me-1"></i> Terima
                                            </button>
                                        </form>
                                        <form method="POST" action="{{ route('pemesanan.reject', $p->id) }}">
                                            @csrf
                                            <button class="btn btn-sm btn-outline-danger w-100"
                                                onclick="return confirm('Tolak pemesanan ini?')">
                                                <i class="bi bi-x-circle me-1"></i> Tolak
                                            </button>
                                        </form>
                                    </div>
                                @else
                                    <em class="text-muted">-</em>
                                @endif
                            </td>
                            <td class="text-center">
                                @if ($p->pembayaran && $p->status !== 'pending')
                                    @switch($p->pembayaran->status_bayar)
                                        @case('menunggu')
                                            <form method="POST" action="{{ route('pembayaran.verifikasi', $p->pembayaran->id) }}"
                                                class="mb-1">
                                                @csrf
                                                <button class="btn btn-sm btn-outline-primary w-100"
                                                    onclick="return confirm('Verifikasi pembayaran ini?')">
                                                    <i class="bi bi-check2-square me-1"></i> Verifikasi
                                                </button>
                                            </form>
                                            <form method="POST" action="{{ route('pembayaran.gagal', $p->pembayaran->id) }}">
                                                @csrf
                                                <button class="btn btn-sm btn-outline-danger w-100"
                                                    onclick="return confirm('Tandai sebagai gagal?')">
                                                    <i class="bi bi-x-octagon me-1"></i> Gagal
                                                </button>
                                            </form>
                                        @break

                                        @case('lunas')
                                            <span class="badge bg-success">
                                                <i class="bi bi-check-circle-fill me-1"></i> Lunas
                                            </span>
                                        @break

                                        @case('gagal')
                                            <span class="badge bg-danger">
                                                <i class="bi bi-x-circle-fill me-1"></i> Gagal
                                            </span>
                                        @break
                                    @endswitch
                                @else
                                    <span class="text-muted">
                                        @if (!$p->pembayaran)
                                            -
                                        @elseif($p->status === 'pending')
                                            Tunggu Aksi Admin
                                        @endif
                                    </span>
                                @endif
                            </td>


                        </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="text-center text-muted py-4">
                                    Belum ada data pemesanan
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    @endsection
