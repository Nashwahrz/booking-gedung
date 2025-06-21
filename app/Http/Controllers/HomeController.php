<?php

namespace App\Http\Controllers;

use App\Models\Gedung;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $gedungs = Gedung::with('kategori')->get();
        return view('homepage', compact('gedungs'));
    }
    public function detail($id)
    {
        $gedung = Gedung::with('kategori', 'fasilitas')->findOrFail($id);
        $semua_pemesanans = $gedung->pemesanans()->get(['tanggal_mulai', 'tanggal_selesai']);

        return view('detail', compact('gedung', 'semua_pemesanans'));
    }



}
