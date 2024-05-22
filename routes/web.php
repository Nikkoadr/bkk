<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\HomeController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register' => false]);

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::post('/daftar', [PendaftaranController::class, 'daftar'])->name('daftar');
Route::get('/bukti_pembayaran/{id}', [PendaftaranController::class, 'bukti_pembayaran'])->name('bukti_pembayaran');
Route::get('/data_loker', [HomeController::class, 'data_loker'])->name('data_loker');
Route::get('/data_pelamar', [HomeController::class, 'data_pelamar'])->name('data_pelamar');
