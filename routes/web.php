<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GedungController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('gedung', GedungController::class)->middleware('auth');

