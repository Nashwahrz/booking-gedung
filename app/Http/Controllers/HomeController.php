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
    public function show($id)
{
    $gedung = \App\Models\Gedung::with(['kategori', 'fasilitas'])->findOrFail($id);
    return view('detail', compact('gedung'));
}

}
