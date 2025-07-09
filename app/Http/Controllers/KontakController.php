<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\KontakMail;

class KontakController extends Controller
{
    public function kirim(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string',
            'email' => 'required|email',
            'pesan' => 'required|string',
        ]);

        Mail::to('pengangumlangit@gmail.com')->send(new KontakMail($data));

        return redirect()->to(url()->previous() . '#contact')->with('success', 'Pesan kamu berhasil dikirim!');

    }
}
