<?php

namespace App\Http\Controllers;

use App\Models\Gedung;
use App\Models\Pemesanan;

use Illuminate\Http\Request;

// use App\Mail\PemesananDisetujui;
use Illuminate\Support\Facades\Mail;

class PemesananController extends Controller
{
    public function create($id)
    {
        $gedung = Gedung::findOrFail($id);
        return view('booking.form', compact('gedung'));
    }

public function store(Request $request)
{
    $validated = $request->validate([
        'email' => 'required|email',
        'no_hp' => 'required',
        'gedung_id' => 'required|exists:nashwa_gedungs,id',
        'tanggal_mulai' => 'required|date',
        'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
    ]);

    $pemesanan = Pemesanan::create([
        ...$validated,
        'status' => 'pending',
    ]);

    // ⬇️ Redirect ke form pembayaran
    return redirect()->route('pembayaran.create', $pemesanan->id);
}


    public function form($gedungId, $tanggal)
{
    $gedung = \App\Models\Gedung::findOrFail($gedungId);
    return view('booking.form', compact('gedung', 'tanggal'));
}
public function index()
{
    $pemesanans = Pemesanan::with('gedung')->orderBy('created_at', 'desc')->get();
    return view('gedung.pemesanan', compact('pemesanans'));
}

public function accept($id)
{
    $pemesanan = Pemesanan::findOrFail($id);
    $pemesanan->status = 'disetujui';
    $pemesanan->save();

    // Kirim email ke pemesan
    // Mail::to($pemesanan->email)->send(new PemesananDisetujui($pemesanan));

    return back()->with('success', 'Pemesanan telah disetujui.');
}
public function reject($id)
{
    $pemesanan = Pemesanan::findOrFail($id);
    $pemesanan->status = 'ditolak';
    $pemesanan->save();

    return redirect()->back()->with('success', 'Pemesanan berhasil ditolak.');
}

public function formCek()
{
    return view('pemesanan.cek');
}

public function cek(Request $request)
{
    $request->validate([
        'email' => 'required|email',
    ]);

    $data = \App\Models\Pemesanan::with('gedung')
        ->where('email', $request->email)
        ->get();

    return view('pemesanan.hasil', [
        'pemesanans' => $data,
        'email' => $request->email
    ]);
}

public function cetak($id)
{
    $pemesanan = Pemesanan::with('gedung', 'pembayaran')->findOrFail($id);

    if ($pemesanan->status !== 'disetujui' || $pemesanan->pembayaran->status_bayar !== 'lunas') {
        abort(403, 'Pemesanan belum lunas atau belum disetujui');
    }

    return view('pemesanan.bukti', compact('pemesanan'));
}
public function hasil(Request $request)
{
    $request->validate([
        'email' => 'required|email',
    ]);

    $pemesanans = Pemesanan::with(['gedung', 'pembayaran'])
        ->where('email', $request->email)
        ->get();

    return view('pemesanan.hasil', [
        'pemesanans' => $pemesanans,
        'email' => $request->email,
    ]);
}

}



