<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Gedung;

use App\Models\Pemesanan;

// use App\Mail\PemesananDisetujui;
use Illuminate\Http\Request;
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
    $request->validate([
        'email' => 'required|email',
        'nama_kegiatan' => 'required|string',
        'no_hp' => 'required|string',
        'gedung_id' => 'required|exists:nashwa_gedungs,id',
        'tanggal_mulai' => 'required|date',
        'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
    ]);

    $seharian = $request->has('seharian');
    $jamMulai = '00:00:00';
    $jamSelesai = '23:59:59';
    $durasi = 24;

    if (!$seharian) {
        $request->validate([
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
        ]);

        $jamMulai = $request->jam_mulai;
        $jamSelesai = $request->jam_selesai;

        // ✅ Gabungkan tanggal + jam untuk hitung durasi
        $mulai = Carbon::parse($request->tanggal_mulai . ' ' . $jamMulai);
        $selesai = Carbon::parse($request->tanggal_mulai . ' ' . $jamSelesai);

        if (!$selesai->gt($mulai)) {
            return back()->with('error', 'Jam selesai harus lebih besar dari jam mulai.');
        }

        $durasi = $mulai->floatDiffInHours($selesai);
    }

    // Validasi jam bentrok
    $bentrok = Pemesanan::where('gedung_id', $request->gedung_id)
        ->where('tanggal_mulai', $request->tanggal_mulai)
        ->where(function ($q) use ($jamMulai, $jamSelesai) {
            $q->whereBetween('jam_mulai', [$jamMulai, $jamSelesai])
              ->orWhereBetween('jam_selesai', [$jamMulai, $jamSelesai])
              ->orWhere(function ($q2) use ($jamMulai, $jamSelesai) {
                  $q2->where('jam_mulai', '<=', $jamMulai)
                     ->where('jam_selesai', '>=', $jamSelesai);
              });
        })
        ->exists();

    if ($bentrok) {
        return back()->with('error', 'Jam tersebut sudah dibooking orang lain.');
    }

    $pemesanan = Pemesanan::create([
        'email' => $request->email,
        'nama_kegiatan' => $request->nama_kegiatan,
        'no_hp' => $request->no_hp,
        'gedung_id' => $request->gedung_id,
        'tanggal_mulai' => $request->tanggal_mulai,
        'tanggal_selesai' => $request->tanggal_selesai,
        'jam_mulai' => $jamMulai,
        'jam_selesai' => $jamSelesai,
       'durasi' => round($durasi, 2),
        'status' => 'pending',
    ]);

    return redirect()->route('pembayaran.create', $pemesanan->id);
}




    public function form($gedungId, $tanggal)
{
    $gedung = Gedung::findOrFail($gedungId);

    $bookedTimes = Pemesanan::where('gedung_id', $gedungId)
        ->where('tanggal_mulai', $tanggal)
        ->where('status', '!=', 'ditolak') // biar yg ditolak ga ikut
        ->select('jam_mulai', 'jam_selesai')
        ->get()
        ->map(function ($item) {
            return [
                'jam_mulai' => substr($item->jam_mulai, 0, 5),
                'jam_selesai' => substr($item->jam_selesai, 0, 5),
            ];
        })
        ->toArray();

    return view('booking.form', compact('gedung', 'tanggal', 'bookedTimes'));
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
public function show($id)
{
    $gedung = Gedung::with('kategori', 'fasilitas')->findOrFail($id);

    $bulan = request('bulan', now()->month);
    $tahun = request('tahun', now()->year);

    $start = Carbon::create($tahun, $bulan, 1);
    $end = $start->copy()->endOfMonth();

 $semua_pemesanans = Pemesanan::with('pembayaran')
    ->where('gedung_id', $id)
    ->where(function ($q) use ($start, $end) {
        $q->whereBetween('tanggal_mulai', [$start, $end])
          ->orWhereBetween('tanggal_selesai', [$start, $end]);
    })
    ->get();



    return view('detail', compact('gedung', 'semua_pemesanans', 'bulan', 'tahun'));
}


}



