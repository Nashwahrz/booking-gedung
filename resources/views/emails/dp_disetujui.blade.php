@component('mail::message')
# Pemesanan Disetujui

<img src="{{ asset('img/logo.png') }}" alt="Logo Booking Gedung" width="120" style="margin-bottom: 10px;">

Halo {{ $pemesanan->nama_pemesan }},

DP untuk pemesanan gedung **{{ $pemesanan->gedung->nama }}** pada tanggal **{{ \Carbon\Carbon::parse($pemesanan->tanggal_mulai)->format('d M Y') }}** telah kami **setujui** ✅.

Silakan lanjutkan dengan melakukan **pelunasan pembayaran** melalui tombol berikut:

@component('mail::button', ['url' => url('/pembayaran/pelunasan/' . $pemesanan->id)])
Bayar Pelunasan Sekarang
@endcomponent

Terima kasih telah menggunakan layanan kami 🙏
Salam,
**{{ config('app.name') }}**
@endcomponent
