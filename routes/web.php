<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\HomeController;
use App\Models\Loker;

Route::get('/', function () {
    $loker = Loker::all();
    return view('welcome', compact('loker'));
});

Auth::routes(['register' => false]);

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::post('/form_daftar', [PendaftaranController::class, 'form_daftar'])->name('form_daftar');
Route::get('/form_daftar', function () {
    return redirect('/');});
Route::post('/daftar', [PendaftaranController::class, 'daftar'])->name('daftar');
Route::get('/daftar', function () {
    return redirect('/');});
Route::get('/pembayaran/{pendaftaran}', [PendaftaranController::class, 'show'])->name('pembayaran.show');
Route::patch('/bukti_pembayaran', [PendaftaranController::class, 'bukti_pembayaran'])->name('bukti_pembayaran');
Route::get('/data_loker', [HomeController::class, 'data_loker'])->name('data_loker');
Route::get('/data_pelamar', [HomeController::class, 'data_pelamar'])->name('data_pelamar');
