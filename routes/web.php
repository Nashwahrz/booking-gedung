<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GedungController;

// Menampilkan semua gedung
Route::get('/gedung', [GedungController::class, 'index'])->name('gedung.index');

// Form tambah gedung
Route::get('/gedung/create', [GedungController::class, 'create'])->name('gedung.create');

// Proses simpan gedung baru
Route::post('/gedung', [GedungController::class, 'store'])->name('gedung.store');

// Form edit gedung
Route::get('/gedung/{id}/edit', [GedungController::class, 'edit'])->name('gedung.edit');

// Proses update gedung
Route::put('/gedung/{id}', [GedungController::class, 'update'])->name('gedung.update');

// Hapus gedung
Route::delete('/gedung/{id}', [GedungController::class, 'destroy'])->name('gedung.destroy');
