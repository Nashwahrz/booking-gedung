@extends('template')

@section('content')
<div class="container py-4">
    <h3>Pelunasan Pemesanan</h3>

    <form action="{{ route('pembayaran.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="pemesanan_id" value="{{ $pemesanan->id }}">
    <input type="hidden" name="is_pelunasan" value="1"> {{-- flag penanda pelunasan --}}

    <div class="mb-3">
        <label>Tanggal Bayar</label>
        <input type="date" name="tanggal_bayar" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Jumlah Pelunasan</label>
        <input type="number" name="jumlah_pelunasan" class="form-control" required>

    </div>

    <div class="mb-3">
        <label>Bukti Bayar</label>
        <input type="file" name="bukti_bayar" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-success">Kirim Pelunasan</button>
</form>

</div>
@endsection
