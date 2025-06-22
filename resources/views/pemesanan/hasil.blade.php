@extends('template')

@section('content')
<div class="container py-5">
    <h3 class="mb-4">Hasil Pemesanan untuk: <strong>{{ $email }}</strong></h3>

    @if($pemesanans->isEmpty())
        <div class="alert alert-warning">Belum ada pemesanan dengan email tersebut.</div>
    @else
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>Nama Gedung</th>
                    <th>Tanggal Mulai</th>
                    <th>Tanggal Selesai</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pemesanans as $p)
                <tr>
                    <td>{{ $p->gedung->nama ?? '-' }}</td>
                    <td>{{ $p->tanggal_mulai }}</td>
                    <td>{{ $p->tanggal_selesai }}</td>
                    <td>
    @if ($p->status === 'pending')
        <span class="badge bg-warning text-dark">Menunggu</span>
    @elseif ($p->status === 'disetujui')
        <span class="badge bg-success">Disetujui</span>
        {{-- Cek apakah sudah lunas atau belum --}}
        @php
            $pembayaran = $p->pembayaran;
        @endphp

        @if (!$pembayaran || $pembayaran->status_bayar !== 'lunas')
            <form action="{{ route('pembayaran.formPelunasan', $p->id) }}" method="GET" class="mt-2">
                <button class="btn btn-sm btn-warning">Bayar Pelunasan</button>
            </form>
        @else
            <form action="{{ route('pemesanan.cetak', $p->id) }}" method="GET" target="_blank" class="mt-2">
                <button class="btn btn-sm btn-outline-primary">Cetak Bukti</button>
            </form>
        @endif

    @else
        <span class="badge bg-danger">Ditolak</span>
    @endif
</td>

                </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <a href="{{ url('/') }}" class="btn btn-outline-secondary mt-3">Kembali</a>
</div>
@endsection
