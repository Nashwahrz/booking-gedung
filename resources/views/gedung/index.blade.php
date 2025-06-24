@extends('template')

@section('content')
<style>
    .table thead th {
        background-color: #0f3d6e !important;
        color: white;
    }

    .btn-primary {
        background-color: #2d7a8d;
        border-color: #2d7a8d;
    }

    .btn-primary:hover {
        background-color: #247381;
        border-color: #247381;
    }

    .btn-warning {
        background-color: #ffb84c;
        border: none;
        color: #333;
    }

    .btn-warning:hover {
        background-color: #e6a437;
    }

    .btn-danger {
        background-color: #e63946;
        border: none;
    }

    .btn-danger:hover {
        background-color: #c62828;
    }

    table {
        border-radius: 16px;
        overflow: hidden;
    }

    .table td, .table th {
        vertical-align: middle;
    }

    .table tbody tr:hover {
        background-color: #f1faff;
        transition: 0.2s;
    }

    .alert-success {
        background-color: #dff9ec;
        border: 1px solid #28a74533;
        color: #257b5e;
    }
</style>

<div class="container py-4">
    <h2 class="mb-4 fw-bold">
        <i class="fas fa-building me-2"></i> Daftar Gedung
    </h2>

    @if (session('success'))
        <div class="alert alert-success shadow-sm rounded-3 px-3 py-2">
            <i class="fas fa-check-circle me-1"></i> {{ session('success') }}
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="{{ route('gedung.create') }}" class="btn btn-primary shadow-sm rounded-3">
            <i class="fas fa-plus me-1"></i> Tambah Gedung
        </a>
    </div>

    <div class="table-responsive rounded-4 shadow-sm">
        <table class="table table-hover align-middle mb-0">
            <thead class="text-center">
                <tr>
                    <th style="width: 50px;">No</th>
                    <th style="width: 100px;">Foto</th>
                    <th>Nama</th>
                    <th>Lokasi</th>
                    <th>Kategori</th>
                    <th>Harga/Hari</th>
                    <th style="width: 130px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($gedungs as $index => $gedung)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td class="text-center">
                            @if ($gedung->foto)
                                <img src="{{ asset('storage/' . $gedung->foto) }}" alt="foto" width="70" class="rounded shadow-sm">
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>{{ $gedung->nama }}</td>
                        <td>{{ $gedung->lokasi }}</td>
                        <td>{{ $gedung->kategori->nama_kategori ?? '-' }}</td>
                        <td class="fw-semibold text-primary">Rp{{ number_format($gedung->harga_per_hari, 0, ',', '.') }}</td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-1 flex-wrap">
                                <a href="{{ route('gedung.edit', $gedung->id) }}" class="btn btn-sm btn-warning shadow-sm rounded-2" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('gedung.destroy', $gedung->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus gedung ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger shadow-sm rounded-2" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">
                            <i class="fas fa-circle-info fa-lg mb-2 d-block"></i>
                            Belum ada data gedung.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
