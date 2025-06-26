@extends('template')

@section('content')
<style>
    .stat-card {
        border-radius: 1rem;
        padding: 1.5rem;
        color: white;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        transition: 0.3s ease-in-out;
        text-align: center;
    }

    .stat-card:hover {
        transform: translateY(-4px);
    }

    .bg-primary-dark { background-color: #1e2c3d; }
    .bg-tosca { background-color: #2d7a8d; }
    .bg-warning-dark { background-color: #e67e22; }
    .bg-danger-dark { background-color: #c0392b; }

    .section-title {
        font-weight: 600;
        color: #1e2c3d;
        border-left: 4px solid #2d7a8d;
        padding-left: 12px;
        margin-top: 30px;
        margin-bottom: 20px;
        font-size: 18px;
    }

    .gradient-text {
        background: linear-gradient(135deg, #2d7a8d, #1e2c3d);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .modern-table th, .modern-table td {
        padding: 14px 16px;
        font-size: 14px;
        vertical-align: middle;
    }

    .modern-table tbody tr:hover {
        background-color: #f2fbff;
    }

    .badge {
        font-size: 13px;
        padding: 6px 12px;
    }

    .quick-action {
        background-color: #ffffff;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        transition: 0.2s ease-in-out;
        text-align: center;
        height: 100%;
    }

    .quick-action:hover {
        background-color: #f1fafa;
        transform: translateY(-3px);
    }

    .quick-action i {
        font-size: 20px;
        color: #2d7a8d;
    }

    .quick-action span {
        display: block;
        margin-top: 8px;
        font-weight: 600;
        color: #1e2c3d;
    }

    @media (max-width: 576px) {
        .stat-card h2, .stat-card h4 {
            font-size: 1.3rem;
        }
    }
</style>

<div class="container py-4">
    <h2 class="mb-4 fw-bold gradient-text">
        <i class="bi bi-speedometer2 me-2"></i> Dashboard Admin
    </h2>

    {{-- Statistik Ringkas --}}
    <div class="row g-4 mb-4">
        <div class="col-sm-6 col-lg-3">
            <div class="stat-card bg-primary-dark">
                <h6>Total Gedung</h6>
                <h2>{{ $totalGedung }}</h2>
                <i class="bi bi-building fs-3"></i>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="stat-card bg-tosca">
                <h6>Pemesanan Disetujui</h6>
                <h2>{{ $totalPemesanan }}</h2>
                <i class="bi bi-check2-circle fs-3"></i>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="stat-card bg-warning-dark">
                <h6>Menunggu Persetujuan</h6>
                <h2>{{ $menunggu }}</h2>
                <i class="bi bi-hourglass-split fs-3"></i>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="stat-card bg-danger-dark">
                <h6>Total Pembayaran</h6>
                <h4>Rp{{ number_format($totalBayar, 0, ',', '.') }}</h4>
                <i class="bi bi-cash-stack fs-3"></i>
            </div>
        </div>
    </div>

    {{-- Pemesanan Terbaru --}}
    <h5 class="section-title"><i class="bi bi-clock-history me-2"></i>Pemesanan Terbaru</h5>
    <div class="card shadow-sm rounded-4 mb-4">
        <div class="table-responsive">
            <table class="table table-borderless table-hover modern-table mb-0">
                <thead class="bg-light">
                    <tr>
                        <th>Email</th>
                        <th>Gedung</th>
                        <th>Nama Kegiatan</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pemesananTerbaru as $p)
                        <tr>
                            <td>{{ $p->email }}</td>
                            <td>{{ $p->gedung->nama }}</td>
                            <td>{{ $p->nama_kegiatan }}</td>
                            <td>
                                @if ($p->status === 'pending')
                                    <span class="badge bg-warning text-dark">Pending</span>
                                @elseif ($p->status === 'disetujui')
                                    <span class="badge bg-success">Disetujui</span>
                                @else
                                    <span class="badge bg-danger">Ditolak</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4">Belum ada pemesanan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Aksi Cepat --}}
    <h5 class="section-title"><i class="bi bi-lightning-charge me-2"></i>Aksi Cepat</h5>
    <div class="row g-3">
        <div class="col-sm-6 col-lg-4">
            <a href="{{ route('gedung.create') }}" class="text-decoration-none">
                <div class="quick-action">
                    <i class="bi bi-plus-circle"></i>
                    <span>Tambah Gedung</span>
                </div>
            </a>
        </div>
        <div class="col-sm-6 col-lg-4">
            <a href="{{ route('pemesanan.index') }}" class="text-decoration-none">
                <div class="quick-action">
                    <i class="bi bi-calendar-check"></i>
                    <span>Kelola Pemesanan</span>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection
