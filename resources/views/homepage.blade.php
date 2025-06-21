@extends('template')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 text-center">Daftar Gedung</h2>

    <div class="row">
        @forelse ($gedungs as $gedung)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow">
                    @if ($gedung->foto)
                        <img src="{{ asset('storage/' . $gedung->foto) }}" class="card-img-top" alt="{{ $gedung->nama }}" style="height: 200px; object-fit: cover;">
                    @else
                        <img src="https://via.placeholder.com/400x200?text=No+Image" class="card-img-top" alt="No Image">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $gedung->nama }}</h5>
                        <p class="card-text">{{ Str::limit($gedung->deskripsi, 100) }}</p>
                        <p><strong>Harga:</strong> Rp{{ number_format($gedung->harga_per_hari, 0, ',', '.') }} / hari</p>
                    </div>
                    <div class="card-footer bg-white border-0 d-flex justify-content-between">
                        <a href="#" class="btn btn-success btn-sm">Booking</a>
                        <a href="{{ route('gedung.detail', $gedung->id ?? 0) }}" class="btn btn-primary btn-sm">Lihat Detail</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center">
                <p class="text-muted">Belum ada gedung yang tersedia.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
