@extends('template')

@section('content')
    <style>
        .btn-toska {
            background-color: #2d7a8d;
            color: white;
        }

        .btn-toska:hover {
            background-color: #0f3d6e;
        }

        .btn-outline-donker {
            border: 1px solid #0f3d6e;
            color: #0f3d6e;
        }

        .btn-outline-donker:hover {
            background-color: #0f3d6e;
            color: white;
        }

        .table thead {
            background-color: #ccecee;
        }

        h2.title {
            color: #0f3d6e;
        }

        .icon-title {
            color: #2d7a8d;
        }

        .card-custom {
            background-color: #ffffff;
            border: 1px solid #d0dfe2;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 4px 12px rgba(45, 122, 141, 0.2);
        }

        .badge-status {
            font-size: 0.85rem;
            padding: 0.4em 0.7em;
            border-radius: 8px;
        }

        .bg-soft {
            background-color: #f4fcfc;
        }
    </style>

    <div class="container py-4">
        <h2 class="title fw-bold mb-4">
            <i class="bi bi-calendar-check me-2 icon-title"></i> Daftar Pemesanan Gedung
        </h2>

        @if (session('success'))
            <div class="alert alert-success shadow-sm">{{ session('success') }}</div>
        @endif

        <div class="card-custom">
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle mb-0">
                    <thead class="text-center text-dark fw-semibold">
                        <tr>
                            <th>Gedung</th>
                            <th>Email</th>
                            <th>Nama Kegiatan</th>
                            <th>Waktu</th>
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
                                <td>
                                    <span class="d-block fw-semibold">
                                        {{ \Carbon\Carbon::parse($p->tanggal_mulai)->format('d M Y') }}
                                        {{ $p->jam_mulai }}
                                        &mdash;
                                        {{ \Carbon\Carbon::parse($p->tanggal_selesai)->format('d M Y') }}
                                        {{ $p->jam_selesai }}
                                    </span>
                                </td>
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
                                                    <span class="text-success"><i class="bi bi-check-circle-fill me-1"></i> Lunas</span>
                                                @else
                                                    <span class="text-warning"><i class="bi bi-cash me-1"></i> DP</span>
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
                                            <span class="badge bg-warning text-dark badge-status">
                                                <i class="bi bi-hourglass-split me-1"></i> Pending
                                            </span>
                                            @break
                                        @case('disetujui')
                                            <span class="badge bg-success badge-status">
                                                <i class="bi bi-check-circle me-1"></i> Disetujui
                                            </span>
                                            @break
                                        @default
                                            <span class="badge bg-danger badge-status">
                                                <i class="bi bi-x-circle me-1"></i> Ditolak
                                            </span>
                                    @endswitch
                                </td>
                                <td class="text-center">
                                    @if ($p->status == 'pending' && auth()->user()->role === 'superadmin')
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
                                    @elseif($p->status == 'pending')
                                        <span class="text-muted fst-italic">Tidak memiliki akses</span>
                                    @else
                                        <em class="text-muted">-</em>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($p->pembayaran && $p->status !== 'pending')
                                        @switch($p->pembayaran->status_bayar)
                                            @case('menunggu')
                                                @if (auth()->user()->role === 'superadmin')
                                                    <form method="POST" action="{{ route('pembayaran.verifikasi', $p->pembayaran->id) }}" class="mb-1">
                                                        @csrf
                                                        <button class="btn btn-sm btn-outline-donker w-100"
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
                                                @else
                                                    <span class="text-muted fst-italic">Tidak memiliki akses</span>
                                                @endif
                                                @break
                                            @case('lunas')
                                                <span class="badge bg-success badge-status">
                                                    <i class="bi bi-check-circle-fill me-1"></i> Lunas
                                                </span>
                                                @break
                                            @case('gagal')
                                                <span class="badge bg-danger badge-status">
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
    </div>
@endsection
