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
            'jumlah_bayar' => 'required|integer|min:10000',
            'bukti_bayar' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        if ($request->hasFile('bukti_bayar')) {
            $data['bukti_bayar'] = $request->file('bukti_bayar')->store('bukti', 'public');
        }

        $data['status_bayar'] = 'menunggu';
        Pembayaran::create($data);

        // Tandai status pemesanan tetap pending
        $pemesanan = Pemesanan::find($request->pemesanan_id);
        $pemesanan->status = 'pending';
        $pemesanan->save();

          return redirect()->route('pemesanan.cekHasil', ['email' => $pemesanan->email])
        ->with('success', 'Pembayaran dikirim, menunggu konfirmasi admin.');
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

}
