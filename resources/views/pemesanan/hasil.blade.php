@extends('template')

@section('content')
<style>
    .results-hero {
        background: linear-gradient(135deg, #2d7a8d 0%, #1e2c3d 100%);
        color: #ffffff;
        padding: 60px 0;
        border-radius: 25px;
        margin-bottom: 40px;
        position: relative;
        overflow: hidden;
    }

    .results-hero::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 300px;
        height: 300px;
        background: rgba(204, 236, 238, 0.1);
        border-radius: 50%;
        animation: float 8s ease-in-out infinite;
    }

    .results-hero::after {
        content: '';
        position: absolute;
        bottom: -30%;
        left: -10%;
        width: 200px;
        height: 200px;
        background: rgba(204, 236, 238, 0.08);
        border-radius: 50%;
        animation: float 6s ease-in-out infinite reverse;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-30px) rotate(180deg); }
    }

    .results-card {
        background: #ffffff;
        border: none;
        border-radius: 20px;
        box-shadow: 0 20px 40px rgba(45, 122, 141, 0.1);
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .results-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 25px 50px rgba(45, 122, 141, 0.15);
    }

    .table-custom {
        border: none;
        background: #ffffff;
    }

    .table-custom thead th {
        background: linear-gradient(135deg, #ccecee 0%, #ffffff 100%);
        color: #1e2c3d;
        border: none;
        padding: 20px 15px;
        font-weight: 600;
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .table-custom tbody td {
        padding: 20px 15px;
        border: none;
        border-bottom: 1px solid rgba(204, 236, 238, 0.3);
        vertical-align: middle;
        color: #1e2c3d;
    }

    .table-custom tbody tr {
        transition: all 0.3s ease;
    }

    .table-custom tbody tr:hover {
        background: rgba(204, 236, 238, 0.1);
        transform: scale(1.01);
    }

    .badge-custom {
        padding: 8px 16px;
        border-radius: 20px;
        font-weight: 500;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .badge-pending {
        background: linear-gradient(135deg, #ffc107, #ffb300);
        color: #1e2c3d;
    }

    .badge-approved {
        background: linear-gradient(135deg, #2d7a8d, #1e5f6b);
        color: #ffffff;
    }

    .badge-rejected {
        background: linear-gradient(135deg, #dc3545, #c82333);
        color: #ffffff;
    }

    .badge-paid {
        background: linear-gradient(135deg, #2d7a8d, #1e5f6b);
        color: #ffffff;
    }

    .badge-waiting {
        background: linear-gradient(135deg, #ccecee, #a8d5d8);
        color: #1e2c3d;
    }

    .badge-unpaid {
        background: linear-gradient(135deg, #6c757d, #5a6268);
        color: #ffffff;
    }

    .btn-custom-print {
        background: linear-gradient(135deg, #2d7a8d, #1e2c3d);
        border: none;
        color: #ffffff;
        padding: 10px 20px;
        border-radius: 15px;
        font-weight: 500;
        transition: all 0.3s ease;
        box-shadow: 0 5px 15px rgba(45, 122, 141, 0.3);
    }

    .btn-custom-print:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(45, 122, 141, 0.4);
        color: #ffffff;
    }

    .btn-custom-pay {
        background: linear-gradient(135deg, #ccecee, #a8d5d8);
        border: none;
        color: #1e2c3d;
        padding: 10px 20px;
        border-radius: 15px;
        font-weight: 500;
        transition: all 0.3s ease;
        box-shadow: 0 5px 15px rgba(204, 236, 238, 0.3);
    }

    .btn-custom-pay:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(204, 236, 238, 0.4);
        color: #1e2c3d;
        background: linear-gradient(135deg, #a8d5d8, #ccecee);
    }

    .btn-back {
        background: linear-gradient(135deg, #1e2c3d, #2d7a8d);
        border: none;
        color: #ffffff;
        padding: 15px 30px;
        border-radius: 50px;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 8px 20px rgba(30, 44, 61, 0.3);
    }

    .btn-back:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 30px rgba(30, 44, 61, 0.4);
        color: #ffffff;
    }

    .alert-custom {
        background: linear-gradient(135deg, #ccecee, #ffffff);
        border: 2px solid rgba(45, 122, 141, 0.2);
        border-radius: 15px;
        color: #1e2c3d;
        padding: 25px;
        font-weight: 500;
    }

    .email-highlight {
        color: #d1eaf1;
        font-weight: 600;
        background: rgba(204, 236, 238, 0.3);
        padding: 2px 8px;
        border-radius: 8px;
    }
</style>

<div class="container py-5">
    <div class="results-hero text-center">
        <div class="position-relative">
            <h3 class="fw-bold mb-3">
                <i class="fas fa-search me-3"></i>Hasil Pemesanan
            </h3>
            <p class="mb-0 opacity-90">
                Berikut adalah daftar pemesanan yang ditemukan untuk email:
                <span class="email-highlight">{{ $email }}</span>
            </p>
        </div>
    </div>

    <div class="results-card card shadow-sm rounded-4 border-0">
        <div class="card-body p-0">
            @if($pemesanans->isEmpty())
                <div class="alert alert-custom text-center m-4">
                    <i class="fas fa-exclamation-circle me-2 fs-4"></i>
                    <div class="mt-2">Belum ada pemesanan dengan email tersebut.</div>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-custom align-middle mb-0">
                        <thead>
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
                                        <span class="badge badge-custom badge-pending">Menunggu</span>
                                    @elseif ($p->status === 'disetujui')
                                        <span class="badge badge-custom badge-approved">Disetujui</span>
                                    @else
                                        <span class="badge badge-custom badge-rejected">Ditolak</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @php $pembayaran = $p->pembayaran; @endphp
                                    @if (!$pembayaran)
                                        <span class="badge badge-custom badge-unpaid">Belum Bayar</span>
                                    @elseif ($pembayaran->status_bayar === 'menunggu')
                                        <span class="badge badge-custom badge-waiting">Menunggu Verifikasi</span>
                                    @elseif ($pembayaran->status_bayar === 'lunas')
                                        <span class="badge badge-custom badge-paid">Lunas</span>
                                    @else
                                        <span class="badge badge-custom badge-rejected">Gagal</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($p->status === 'disetujui')
                                        @if ($pembayaran && $pembayaran->status_bayar === 'lunas')
                                            <form action="{{ route('pemesanan.cetak', $p->id) }}" method="GET" target="_blank">
                                                <button class="btn btn-sm btn-custom-print">
                                                    <i class="fas fa-print me-1"></i> Cetak
                                                </button>
                                            </form>
                                        @else
                                            <form action="{{ route('pembayaran.formPelunasan', $p->id) }}" method="GET">
                                                <button class="btn btn-sm btn-custom-pay">
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

    <div class="text-center mt-5">
        <a href="{{ url('/') }}" class="btn btn-back">
            <i class="fas fa-arrow-left me-2"></i> Kembali ke Beranda
        </a>
    </div>
</div>
@endsection
