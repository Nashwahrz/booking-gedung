@extends('template')

@section('content')
<div class="container py-5">

    <div class="mb-4 text-center">
        <h3 class="fw-bold text-primary">Hasil Pemesanan</h3>
        <p class="text-muted">Berikut adalah daftar pemesanan yang ditemukan untuk email: <strong>{{ $email }}</strong></p>
    </div>

    <div class="card shadow-sm rounded-4 border-0">
        <div class="card-body">
            @if($pemesanans->isEmpty())
                <div class="alert alert-warning text-center">
                    <i class="fas fa-exclamation-circle me-2"></i>Belum ada pemesanan dengan email tersebut.
                </div>
            @else
                <div class="table-responsive">
                    <table class="table align-middle table-bordered table-hover mb-0">
                        <thead class="table-primary text-center">
                            <tr>
                                <th>Gedung</th>
                                <th>Tgl Mulai</th>
                                <th>Tgl Selesai</th>
                                <th>Status Pemesanan</th>
                                <th>Status Pelunasan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pemesanans as $p)
                            <tr>
                                <td>{{ $p->gedung->nama ?? '-' }}</td>
                                <td>{{ $p->tanggal_mulai }}</td>
                                <td>{{ $p->tanggal_selesai }}</td>
                                <td class="text-center">
                                    @if ($p->status === 'pending')
                                        <span class="badge bg-warning text-dark">Menunggu</span>
                                    @elseif ($p->status === 'disetujui')
                                        <span class="badge bg-success">Disetujui</span>
                                    @else
                                        <span class="badge bg-danger">Ditolak</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @php $pembayaran = $p->pembayaran; @endphp
                                    @if (!$pembayaran)
                                        <span class="badge bg-secondary">Belum Bayar</span>
                                    @elseif ($pembayaran->status_bayar === 'menunggu')
                                        <span class="badge bg-warning text-dark">Menunggu Verifikasi</span>
                                    @elseif ($pembayaran->status_bayar === 'lunas')
                                        <span class="badge bg-success">Lunas</span>
                                    @else
                                        <span class="badge bg-danger">Gagal</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($p->status === 'disetujui')
                                        @if ($pembayaran && $pembayaran->status_bayar === 'lunas')
                                            <form action="{{ route('pemesanan.cetak', $p->id) }}" method="GET" target="_blank">
                                                <button class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-print me-1"></i> Cetak
                                                </button>
                                            </form>
                                        @else
                                            <form action="{{ route('pembayaran.formPelunasan', $p->id) }}" method="GET">
                                                <button class="btn btn-sm btn-warning">
                                                    <i class="fas fa-money-bill-wave me-1"></i> Bayar
                                                </button>
                                            </form>
                                        @endif
                                    @else
                                        <em class="text-muted">-</em>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

    <div class="text-center mt-4">
        <a href="{{ url('/') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-1"></i> Kembali ke Beranda
        </a>
    </div>
</div>
@endsection
