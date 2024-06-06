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
    return redirect('/')->with('notif','maaf Formulir Pendaftaran hanya bisa di Akses Lewat Metode POST. Ulang Lagi ya Pilih PTnya !!!');});
Route::post('/daftar', [PendaftaranController::class, 'daftar'])->name('daftar');
Route::get('/daftar', function () {
    return redirect('/')->with('notif','maaf Pembayaran hanya bisa di Akses Lewat Metode POST. Jika anda belum membayar atau belum upload bukti pembayaran hubungi admin !!!');});
Route::put('/bukti_pembayaran', [PendaftaranController::class, 'bukti_pembayaran'])->name('bukti_pembayaran');
Route::get('/bukti_pembayaran', function () {
    return redirect('/')->with('notif','maaf bukti pembayaran tidak bisa di akses lewat url langsung jika ingin melihat bukti pembayaran lakukan pencarian');});
Route::get('/data_loker', [HomeController::class, 'data_loker'])->name('data_loker');
Route::get('/data_pelamar', [HomeController::class, 'data_pelamar'])->name('data_pelamar');
Route::post('/cari', [PendaftaranController::class, 'cari'])->name('cari');
Route::get('/scan/{code_pendaftaran}', [PendaftaranController::class, 'scan'])->name('scan');
Route::post('print_bukti_transfer', [PendaftaranController::class, 'print_bukti_transfer'])->name('print_bukti_transfer');


Route::post('tambah_loker',[HomeController::class, 'tambah_loker'])->name('tambah_loker');
Route::get('edit_loker/{id}',[HomeController::class, 'edit_loker']);
Route::put('update_loker/{id}',[HomeController::class, 'update_loker'])->name('update_loker');
Route::get('hapus_loker/{id}',[HomeController::class, 'hapus_loker']);
