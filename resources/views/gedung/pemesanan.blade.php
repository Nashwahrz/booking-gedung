@extends('template')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Daftar Pemesanan Gedung</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead class="table-primary">
            <tr>
                <th>Gedung</th>
                <th>Email</th>
                <th>Tanggal Mulai</th>
                <th>Tanggal Selesai</th>
                <th>Status</th>
                <th>Aksi</th>
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
                        @if ($p->status == 'pending')
                            <span class="badge bg-warning text-dark">Pending</span>
                        @elseif ($p->status == 'disetujui')
                            <span class="badge bg-success">Disetujui</span>
                        @else
                            <span class="badge bg-danger">Ditolak</span>
                        @endif
                    </td>
                    <td>
                        @if ($p->status == 'pending')
                            <form method="POST" action="{{ route('pemesanan.accept', $p->id) }}">
                                @csrf
                                <button class="btn btn-success btn-sm" onclick="return confirm('Yakin setujui pemesanan ini?')">Accept</button>
                            </form>
                        @else
                            <em>-</em>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Belum ada pemesanan</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
