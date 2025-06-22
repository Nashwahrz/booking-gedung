@extends('template')

@section('content')
<div class="container py-5">
    <h3 class="mb-4">Cek Status Pemesanan Anda</h3>

    <form action="{{ route('pemesanan.cek') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">Masukkan Email Anda:</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Cek Pemesanan</button>
    </form>
</div>
@endsection
