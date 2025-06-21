<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function formLogin()
    {
        return view('login'); // arahkan ke form login (resources/views/login.blade.php)
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Login berhasil
            return redirect()->intended('/gedung');
        }

        // Login gagal
        return back()->with('error', 'Email atau password salah.');
    }

    public function destroy()
    {
        Auth::logout();
        return redirect('/login');
    }
}
