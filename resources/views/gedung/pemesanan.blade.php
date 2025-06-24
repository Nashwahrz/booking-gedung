@extends('template')

@section('content')
    <div class="container py-4">
        <h2 class="mb-4 text-primary fw-bold"><i class="fas fa-calendar-check me-2"></i>Daftar Pemesanan Gedung</h2>

        @if (session('success'))
            <div class="alert alert-success shadow-sm">{{ session('success') }}</div>
        @endif

        <div class="table-responsive">
            <table class="table table-hover table-bordered shadow-sm rounded">
                <thead class="table-primary text-center align-middle">
                    <tr>
                        <th>Gedung</th>
                        <th>Email</th>
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
                            <td>{{ $p->tanggal_mulai }}</td>
                            <td>{{ $p->tanggal_selesai }}</td>
                            <td>
                                @if ($p->pembayaran)
                                    <span
                                        class="text-success fw-semibold">Rp{{ number_format($p->pembayaran->jumlah_bayar, 0, ',', '.') }}</span>
                                @else
                                    <span class="text-muted fst-italic">Belum bayar</span>
                                @endif
                            </td>

                            {{-- Bukti Bayar --}}
                            <td class="text-center">
                                @if ($p->pembayaran && $p->pembayaran->bukti_bayar)
                                    <a href="{{ asset('storage/' . $p->pembayaran->bukti_bayar) }}" target="_blank">
                                        <img src="{{ asset('storage/' . $p->pembayaran->bukti_bayar) }}" alt="Bukti Bayar"
                                            class="img-thumbnail" width="80">
                                        <div class="small text-muted mt-1">
                                            @if ($p->pembayaran->status_bayar === 'lunas')
                                                <i class="fas fa-check-circle text-success"></i> Pelunasan
                                            @else
                                                <i class="fas fa-money-bill-wave text-warning"></i> DP
                                            @endif
                                        </div>
                                    </a>
                                @else
                                    <span class="text-muted">Tidak ada</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if ($p->pembayaran && $p->pembayaran->pelunasan)
                                    <span
                                        class="text-success fw-semibold">Rp{{ number_format($p->pembayaran->pelunasan, 0, ',', '.') }}</span>
                                @else
                                    <span class="text-muted fst-italic">Belum lunas</span>
                                @endif
                            </td>


                            {{-- Status Pemesanan --}}
                            <td class="text-center">
                                @switch($p->status)
                                    @case('pending')
                                        <span class="badge bg-warning text-dark"><i
                                                class="fas fa-hourglass-half me-1"></i>Pending</span>
                                    @break

                                    @case('disetujui')
                                        <span class="badge bg-success"><i class="fas fa-check me-1"></i>Disetujui</span>
                                    @break

                                    @default
                                        <span class="badge bg-danger"><i class="fas fa-times me-1"></i>Ditolak</span>
                                @endswitch
                            </td>

                            {{-- Aksi Admin --}}
                            <td class="text-center">
                                @if ($p->status == 'pending')
                                    <div class="d-flex flex-column gap-1">
                                        <form method="POST" action="{{ route('pemesanan.accept', $p->id) }}">
                                            @csrf
                                            <button class="btn btn-sm btn-success w-100"
                                                onclick="return confirm('Setujui pemesanan ini?')">
                                                <i class="fas fa-check me-1"></i> Terima
                                            </button>
                                        </form>
                                        <form method="POST" action="{{ route('pemesanan.reject', $p->id) }}">
                                            @csrf
                                            <button class="btn btn-sm btn-danger w-100"
                                                onclick="return confirm('Tolak pemesanan ini?')">
                                                <i class="fas fa-times me-1"></i> Tolak
                                            </button>
                                        </form>
                                    </div>
                                @else
                                    <em class="text-muted">-</em>
                                @endif
                            </td>

                            {{-- Status Bayar --}}
                            <td class="text-center">
                                @if ($p->pembayaran)
                                    @switch($p->pembayaran->status_bayar)
                                        @case('menunggu')
                                            <form method="POST" action="{{ route('pembayaran.verifikasi', $p->pembayaran->id) }}"
                                                class="mb-1">
                                                @csrf
                                                <button class="btn btn-sm btn-primary w-100"
                                                    onclick="return confirm('Verifikasi pembayaran ini?')">
                                                    <i class="fas fa-check-circle me-1"></i> Verifikasi
                                                </button>
                                            </form>

                                            <form method="POST" action="{{ route('pembayaran.gagal', $p->pembayaran->id) }}">
                                                @csrf
                                                <button class="btn btn-sm btn-danger w-100"
                                                    onclick="return confirm('Tandai pembayaran ini sebagai gagal?')">
                                                    <i class="fas fa-times-circle me-1"></i> Gagal
                                                </button>
                                            </form>
                                        @break

                                        @case('lunas')
                                            <span class="badge bg-success"><i class="fas fa-check-circle me-1"></i> Lunas</span>
                                        @break

                                        @case('gagal')
                                            <span class="badge bg-danger"><i class="fas fa-times-circle me-1"></i> Gagal</span>
                                        @break
                                    @endswitch
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center text-muted py-4">Belum ada data pemesanan</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    @endsection
