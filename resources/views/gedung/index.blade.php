@extends('template')

@section('content')
<div class="container py-4">
    <h2 class="mb-4 fw-bold text-primary">
        <i class="fas fa-building me-2"></i> Daftar Gedung
    </h2>

    @if (session('success'))
        <div class="alert alert-success shadow-sm">
            <i class="fas fa-check-circle me-1"></i> {{ session('success') }}
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="{{ route('gedung.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i> Tambah Gedung
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-hover table-bordered align-middle shadow-sm rounded">
            <thead class="table-primary text-center">
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
                        <td>Rp{{ number_format($gedung->harga_per_hari, 0, ',', '.') }}</td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-1 flex-wrap">
                                <a href="{{ route('gedung.edit', $gedung->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('gedung.destroy', $gedung->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus gedung ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">
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
