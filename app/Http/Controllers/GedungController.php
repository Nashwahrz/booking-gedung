<?php

namespace App\Http\Controllers;

use App\Models\Gedung;
use App\Models\Kategori;
use Illuminate\Http\Request;

class GedungController extends Controller
{
     public function index()
    {
        $gedungs = Gedung::with('kategori', 'fasilitas')->get();
        return view('gedung.index', compact('gedungs'));
    }

//     public function index(Request $request)
// {
//     $query = Gedung::with('kategori', 'fasilitas');

//     // Cek apakah ada input pencarian
//     if ($request->filled('cari')) {
//         $query->where('nama', 'like', '%' . $request->cari . '%');
//     }

//     $gedungs = $query->get();

//     return view('gedung.index', compact('gedungs'));
// }
    public function create()
    {
        $kategoris = Kategori::all();
        return view('gedung.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'lokasi' => 'required',
            'deskripsi' => 'required',
            'kapasitas' => 'required|integer',
            'harga_per_hari' => 'required|integer',
            'kategori_id' => 'required|exists:nashwa_kategoris,id',
            'foto' => 'nullable|image|max:2048',
        ]);

        // simpan foto
        $foto = null;
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto')->store('gedung', 'public');
        }

        $gedung = Gedung::create([
            'nama' => $request->nama,
            'lokasi' => $request->lokasi,
            'deskripsi' => $request->deskripsi,
            'kapasitas' => $request->kapasitas,
            'harga_per_hari' => $request->harga_per_hari,
            'kategori_id' => $request->kategori_id,
            'foto' => $foto,
        ]);

        // Simpan fasilitas
      // Simpan fasilitas
$gedung->fasilitas()->create([
    'proyektor' => $request->proyektor,
    'meja' => $request->meja,
    'kursi' => $request->kursi,
    'wc' => $request->wc,
    'tempat_ibadah' => $request->tempat_ibadah,
    'wifi' => $request->wifi,
    'ac' => $request->ac,
    'lainnya' => $request->lainnya,
]);


        return redirect()->route('gedung.index')->with('success', 'Data gedung berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $gedung = Gedung::with('fasilitas')->findOrFail($id);
        $kategoris = Kategori::all();
        return view('gedung.edit', compact('gedung', 'kategoris'));
    }

   public function update(Request $request, $id)
{
    $gedung = Gedung::findOrFail($id);

    $request->validate([
        'nama' => 'required',
        'lokasi' => 'required',
        'deskripsi' => 'required',
        'kapasitas' => 'required|integer',
        'harga_per_hari' => 'required|integer',
        'kategori_id' => 'required|exists:nashwa_kategoris,id',
        'foto' => 'nullable|image|max:2048',
    ]);

    if ($request->hasFile('foto')) {
        $foto = $request->file('foto')->store('gedung', 'public');
    } else {
        $foto = $gedung->foto;
    }

    $gedung->update([
        'nama' => $request->nama,
        'lokasi' => $request->lokasi,
        'deskripsi' => $request->deskripsi,
        'kapasitas' => $request->kapasitas,
        'harga_per_hari' => $request->harga_per_hari,
        'kategori_id' => $request->kategori_id,
        'foto' => $foto,
    ]);

    $gedung->fasilitas()->update([
        'proyektor' => $request->proyektor,
        'meja' => $request->meja,
        'kursi' => $request->kursi,
        'wc' => $request->wc,
        'tempat_ibadah' => $request->tempat_ibadah,
        'wifi' => $request->wifi,
        'ac' => $request->ac,
        'lainnya' => $request->lainnya,
    ]);

    return redirect()->route('gedung.index')->with('success', 'Data gedung berhasil diperbarui.');
}

    public function destroy($id)
    {
        $gedung = Gedung::findOrFail($id);
        $gedung->fasilitas()->delete();
        $gedung->delete();
        return redirect()->route('gedung.index')->with('success', 'Gedung berhasil dihapus.');
    }
}
