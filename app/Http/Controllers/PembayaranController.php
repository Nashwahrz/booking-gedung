<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Pemesanan;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    // Menampilkan form pembayaran (setelah user booking)
    public function create($id)
    {
        $pemesanan = Pemesanan::findOrFail($id);
        return view('pembayaran.form', compact('pemesanan'));
    }

    // Menyimpan data pembayaran (dengan bukti bayar)
   public function store(Request $request)
{
    $data = $request->validate([
        'pemesanan_id' => 'required|exists:nashwa_pemesanans,id',
        'tanggal_bayar' => 'required|date',
        'jumlah_bayar' => 'nullable|integer',
        'jumlah_pelunasan' => 'nullable|integer',
        'bukti_bayar' => 'nullable|file|mimes:jpg,png,pdf',
    ]);

    if ($request->hasFile('bukti_bayar')) {
        $data['bukti_bayar'] = $request->file('bukti_bayar')->store('bukti', 'public');
    }

    $data['status_bayar'] = 'menunggu';

    $pembayaran = Pembayaran::where('pemesanan_id', $request->pemesanan_id)->first();

    if ($pembayaran) {
        // Sudah ada, berarti ini pelunasan
        $pembayaran->update([
            'pelunasan' => $data['jumlah_pelunasan'] ?? 0,
            'tanggal_bayar' => $data['tanggal_bayar'],
            'bukti_bayar' => $data['bukti_bayar'] ?? $pembayaran->bukti_bayar,
            'status_bayar' => 'menunggu',
        ]);
    } else {
        // Belum ada → DP awal
        Pembayaran::create([
            'pemesanan_id' => $data['pemesanan_id'],
            'jumlah_bayar' => $data['jumlah_bayar'],
            'tanggal_bayar' => $data['tanggal_bayar'],
            'bukti_bayar' => $data['bukti_bayar'] ?? null,
            'status_bayar' => 'menunggu',
        ]);
    }

   $email = Pemesanan::find($request->pemesanan_id)->email;

return redirect()->route('pemesanan.cek', ['email' => $email])
    ->with('success', 'Pembayaran berhasil dikirim!');

}


    // Halaman admin: daftar semua pembayaran
    public function index()
    {
        $pembayarans = Pembayaran::with('pemesanan.gedung')->latest()->get();
        return view('admin.pembayaran.index', compact('pembayarans'));
    }

    // Admin memverifikasi pembayaran → status jadi lunas dan pemesanan disetujui
    public function verifikasi($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->status_bayar = 'lunas';
        $pembayaran->save();

        $pembayaran->pemesanan->status = 'disetujui';
        $pembayaran->pemesanan->save();

        return back()->with('success', 'Pembayaran diverifikasi. Pemesanan telah disetujui.');
    }
    public function formPelunasan($id)
{
    $pemesanan = Pemesanan::findOrFail($id);
    return view('pembayaran.pelunasan', compact('pemesanan'));
}

public function bayarPelunasan(Request $request, $id)
{
    $request->validate([
        'pelunasan' => 'required|integer',
        'bukti_bayar' => 'nullable|file|mimes:jpg,png,pdf',
    ]);

    $pembayaran = Pembayaran::where('pemesanan_id', $id)->firstOrFail();
    $pembayaran->pelunasan = $request->pelunasan;

    if ($request->hasFile('bukti_bayar')) {
        $pembayaran->bukti_bayar = $request->file('bukti_bayar')->store('bukti', 'public');
    }

    $pembayaran->status_bayar = 'lunas';
    $pembayaran->save();

    return redirect()->route('pemesanan.hasil')->with('success', 'Pelunasan berhasil dibayar');
}


}
