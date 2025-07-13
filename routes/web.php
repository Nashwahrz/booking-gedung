<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GedungController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\PembayaranController;
use App\Http\Middleware\CheckRole;

// Halaman depan
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/gedung/{id}/detail', [HomeController::class, 'detail'])->name('gedung.detail');



// Booking
Route::get('/booking/{gedung}/{tanggal}', [PemesananController::class, 'form'])->name('booking.form');
Route::post('/booking', [PemesananController::class, 'store'])->name('booking.store');

// Cek Pemesanan
Route::get('/cek-pemesanan', [PemesananController::class, 'formCek'])->name('pemesanan.form');
Route::post('/cek-pemesanan', [PemesananController::class, 'cek'])->name('pemesanan.cek');
Route::get('/pemesanan/hasil/{email}', [PemesananController::class, 'hasil'])->name('pemesanan.hasil');
Route::get('/pemesanan/cetak/{id}', [PemesananController::class, 'cetak'])->name('pemesanan.cetak');

// Form & Aksi Pembayaran
Route::get('/pembayaran/{pemesanan}', [PembayaranController::class, 'create'])->name('pembayaran.create');
Route::post('/pembayaran', [PembayaranController::class, 'store'])->name('pembayaran.store');
Route::get('/pembayaran/dp/{pemesanan}', [PembayaranController::class, 'formDp'])->name('pembayaran.dp.form');
Route::get('/pembayaran/pelunasan/{id}', [PembayaranController::class, 'formPelunasan'])->name('pembayaran.formPelunasan');
Route::post('/pembayaran/verifikasi/{id}', [PembayaranController::class, 'verifikasi'])->name('pembayaran.verifikasi');
Route::post('/pembayaran/{id}/gagal', [PembayaranController::class, 'gagal'])->name('pembayaran.gagal');

// Login & Logout
Route::get('/login', [AuthController::class, 'formLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'destroy'])->name('logout');

// Kontak
Route::post('/kirim-kontak', [KontakController::class, 'kirim'])->name('kirim.kontak');

// Gedung: Khusus admin (CRUD)
Route::middleware(['auth', CheckRole::class . ':admin,superadmin'])->group(function () {
    Route::get('/gedung', [GedungController::class, 'index'])->name('gedung.index');
    Route::get('/gedung/create', [GedungController::class, 'create'])->name('gedung.create');
    Route::post('/gedung', [GedungController::class, 'store'])->name('gedung.store');
    Route::get('/gedung/{id}/edit', [GedungController::class, 'edit'])->name('gedung.edit');
    Route::put('/gedung/{id}', [GedungController::class, 'update'])->name('gedung.update');
    Route::delete('/gedung/{id}', [GedungController::class, 'destroy'])->name('gedung.destroy');
    Route::get('/admin/dashboard', [HomeController::class, 'adminDashboard'])->name('admin.dashboard');
});

// Pemesanan: bisa diakses admin & superadmin
Route::middleware(['auth', CheckRole::class . ':admin,superadmin'])->group(function () {
    Route::get('/gedung/pemesanan', [PemesananController::class, 'index'])->name('pemesanan.index');
});

// Pemesanan: Khusus superadmin (acc & tolak)
Route::middleware(['auth', CheckRole::class . ':superadmin'])->group(function () {
    // Route::get('/gedung/pemesanan', [PemesananController::class, 'index'])->name('pemesanan.index');
    Route::post('/gedung/pemesanan/{id}/accept', [PemesananController::class, 'accept'])->name('pemesanan.accept');
    Route::post('/pemesanan/{id}/reject', [PemesananController::class, 'reject'])->name('pemesanan.reject');
});

// Pembayaran: bisa dilihat oleh admin dan superadmin
Route::middleware(['auth', CheckRole::class . ':admin,superadmin'])->group(function () {
    Route::get('/admin/pembayaran', [PembayaranController::class, 'index'])->name('pembayaran.index');
});

// Tampilkan booking per gedung
Route::get('/gedung/{id}', [PemesananController::class, 'show'])->name('gedung.show');


// Form Tambah Admin & Simpan: Khusus superadmin
Route::middleware(['auth', CheckRole::class . ':admin'])->group(function () {
    Route::get('/admin/tambah-admin', [AuthController::class, 'formTambahAdmin'])->name('admin.formTambah');
    Route::post('/admin/tambah-admin', [AuthController::class, 'simpanAdminBaru'])->name('admin.simpanAdmin');
});


