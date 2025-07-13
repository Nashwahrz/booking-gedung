<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
            return redirect()->intended('/admin/dashboard');
        }

        // Login gagal
        return back()->with('error', 'Email atau password salah.');
    }

    public function destroy()
    {
        Auth::logout();
        return redirect('/login');
    }

      public function formTambahAdmin()
    {
        return view('admin.tambah-admin');
    }


    public function simpanAdminBaru(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
            'role' => 'required|in:admin,superadmin',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'email_verified_at' => now(),
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Admin berhasil ditambahkan!');
    }
}
