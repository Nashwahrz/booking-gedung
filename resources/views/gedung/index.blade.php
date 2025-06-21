@extends('template')

@section('content')
<div class="container">
    <h2 class="mb-4">Daftar Gedung</h2>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('gedung.create') }}" class="btn btn-primary mb-3">+ Tambah Gedung</a>

    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Foto</th>
                    <th>Nama</th>
                    <th>Lokasi</th>
                    <th>Kategori</th>
                    <th>Harga/Hari</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($gedungs as $index => $gedung)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            @if ($gedung->foto)
                                <img src="{{ asset('storage/' . $gedung->foto) }}" alt="foto" width="80">
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>{{ $gedung->nama }}</td>
                        <td>{{ $gedung->lokasi }}</td>
                        <td>{{ $gedung->kategori->nama_kategori ?? '-' }}</td>
                        <td>Rp{{ number_format($gedung->harga_per_hari, 0, ',', '.') }}</td>
                        <td>
                            <a href="{{ route('gedung.edit', $gedung->id) }}" class="btn btn-sm btn-warning">Edit</a>

                            <form action="{{ route('gedung.destroy', $gedung->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin ingin menghapus gedung ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">Belum ada data gedung.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
