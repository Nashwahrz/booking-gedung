<!DOCTYPE html>
<html>
<body>
    <p>Halo,</p>
    <p>Selamat! Pemesanan gedung <strong>{{ $pemesanan->gedung->nama }}</strong> telah disetujui.</p>
    <p><strong>Tanggal:</strong> {{ $pemesanan->tanggal_mulai }} sampai {{ $pemesanan->tanggal_selesai }}</p>
    <p>Silakan datang sesuai jadwal. Terima kasih telah menggunakan layanan kami.</p>
</body>
</html>
