<?php

namespace App\Http\Controllers;

use App\Models\Gedung;
use Illuminate\Http\Request;

class HomeController extends Controller
{
   public function index(Request $request)
{
    $query = Gedung::with('kategori');

    if ($request->filled('cari')) {
        $query->where('nama', 'like', '%' . $request->cari . '%');
    }

    $gedungs = $query->get();

    return view('homepage', compact('gedungs'));
}
    public function detail($id)
    {
        $gedung = Gedung::with('kategori', 'fasilitas')->findOrFail($id);
        $semua_pemesanans = $gedung->pemesanans()->get(['tanggal_mulai', 'tanggal_selesai']);

        return view('detail', compact('gedung', 'semua_pemesanans'));
    }
    public function adminDashboard()
{
    $totalGedung = \App\Models\Gedung::count();
     $totalPemesanan = \App\Models\Pemesanan::where('status', 'disetujui')->count();
    $totalBayar = \App\Models\Pembayaran::sum('jumlah_bayar') + \App\Models\Pembayaran::sum('pelunasan');
    $menunggu = \App\Models\Pemesanan::where('status', 'pending')->count();
    $pemesananTerbaru = \App\Models\Pemesanan::latest()->take(5)->get();

    return view('gedung.dashboard', compact(
        'totalGedung',
        'totalPemesanan',
        'totalBayar',
        'menunggu',
        'pemesananTerbaru'
    ));
}




}
