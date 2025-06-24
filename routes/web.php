<?php

use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GedungController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\PembayaranController;


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/gedung/{id}/detail', [HomeController::class, 'detail'])->name('gedung.detail');

// Route::get('/gedung/{id}/booking', [PemesananController::class, 'create'])->name('booking.form');
// Route::post('/gedung/{id}/booking', [PemesananController::class, 'store'])->name('booking.store');
Route::get('/booking/{gedung}/{tanggal}', [App\Http\Controllers\PemesananController::class, 'form'])->name('booking.form');
Route::post('/booking', [App\Http\Controllers\PemesananController::class, 'store'])->name('booking.store');

Route::get('/cek-pemesanan', [PemesananController::class, 'formCek'])->name('pemesanan.form');
Route::post('/cek-pemesanan', [PemesananController::class, 'cek'])->name('pemesanan.cek');

Route::middleware(['auth', \App\Http\Middleware\IsAdmin::class])->group(function () {
    // Route lihat daftar pemesanan
    Route::get('/gedung/pemesanan', [PemesananController::class, 'index'])->name('pemesanan.index');



    // Route untuk menyetujui
    Route::post('/gedung/pemesanan/{id}/accept', [PemesananController::class, 'accept'])->name('pemesanan.accept');
    Route::post('/pemesanan/{id}/reject', [PemesananController::class, 'reject'])->name('pemesanan.reject');

});



Route::get('/pemesanan/hasil/{email}', [PemesananController::class, 'hasil'])->name('pemesanan.hasil');





Route::middleware(['auth',IsAdmin::class])->group(function () {
    Route::get('/gedung', [GedungController::class, 'index'])->name('gedung.index');
    Route::get('/gedung/create', [GedungController::class, 'create'])->name('gedung.create');
    Route::post('/gedung', [GedungController::class, 'store'])->name('gedung.store');
    Route::get('/gedung/{id}/edit', [GedungController::class, 'edit'])->name('gedung.edit');
    Route::put('/gedung/{id}', [GedungController::class, 'update'])->name('gedung.update');
    Route::delete('/gedung/{id}', [GedungController::class, 'destroy'])->name('gedung.destroy');
});
Route::get('/gedung/{id}', [PemesananController::class, 'show'])->name('gedung.show');
Route::get('/login', [AuthController::class, 'formLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'destroy'])->name('logout');

// Tampilkan form pembayaran
// Route::get('/pembayaran/{pemesanan_id}', [PembayaranController::class, 'form'])->name('pembayaran.form');

// Simpan data pembayaran
Route::get('/pembayaran/{pemesanan}', [PembayaranController::class, 'create'])->name('pembayaran.create');
Route::post('/pembayaran', [PembayaranController::class, 'store'])->name('pembayaran.store');


// Admin: lihat daftar pembayaran
Route::get('/admin/pembayaran', [PembayaranController::class, 'index'])->middleware(['auth', IsAdmin::class])->name('pembayaran.index');

// Admin: set lunas
Route::post('/admin/pembayaran/{id}/verifikasi', [PembayaranController::class, 'verifikasi'])->name('pembayaran.verifikasi');
Route::get('/pembayaran/pelunasan/{id}', [PembayaranController::class, 'formPelunasan'])->name('pembayaran.formPelunasan');


Route::get('/pemesanan/cetak/{id}', [PemesananController::class, 'cetak'])->name('pemesanan.cetak');
Route::post('/pembayaran/verifikasi/{id}', [PembayaranController::class, 'verifikasi'])->name('pembayaran.verifikasi');
Route::post('/pembayaran/{id}/gagal', [PembayaranController::class, 'gagal'])->name('pembayaran.gagal');



