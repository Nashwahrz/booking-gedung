<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GedungController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/gedung/{id}/detail', [HomeController::class, 'detail'])->name('gedung.detail');


Route::middleware(['auth', \App\Http\Middleware\IsAdmin::class])->group(function () {
    Route::get('/gedung', [GedungController::class, 'index'])->name('gedung.index');
    Route::get('/gedung/create', [GedungController::class, 'create'])->name('gedung.create');
    Route::post('/gedung', [GedungController::class, 'store'])->name('gedung.store');
    Route::get('/gedung/{id}/edit', [GedungController::class, 'edit'])->name('gedung.edit');
    Route::put('/gedung/{id}', [GedungController::class, 'update'])->name('gedung.update');
    Route::delete('/gedung/{id}', [GedungController::class, 'destroy'])->name('gedung.destroy');
});

Route::get('/login', [AuthController::class, 'formLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'destroy'])->name('logout');
