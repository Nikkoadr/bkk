<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobfairController;
use App\Http\Controllers\ProfileController;
use App\Models\Loker;

Route::get('/', function () {
    $loker = Loker::where('status_loker', 'aktif')->orderBy('nama_loker')->get();
    return view('welcome', compact('loker'));
});

Auth::routes(['register' => false]);

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::post('/form_daftar', [PendaftaranController::class, 'form_daftar'])->middleware('throttle:30,1')->name('form_daftar');
Route::get('/form_daftar', function () {
    return redirect('/')->with('notif', 'maaf Formulir Pendaftaran hanya bisa di Akses Lewat Metode POST. Ulang Lagi ya Pilih PTnya !!!');
});
Route::post('/bayar', [PendaftaranController::class, 'bayar'])->middleware('throttle:20,1')->name('bayar');
Route::get('/bayar', function () {
    return redirect('/')->with('notif', 'maaf Pembayaran hanya bisa di Akses Lewat Metode POST. Jika anda belum membayar atau belum upload bukti pembayaran hubungi admin !!!');
});
Route::put('/bukti_pembayaran', [PendaftaranController::class, 'bukti_pembayaran'])->middleware('throttle:20,1');
Route::get('/bukti_pembayaran', function () {
    return redirect('/')->with('notif', 'maaf bukti pembayaran tidak bisa di akses lewat url langsung jika ingin melihat bukti pembayaran lakukan pencarian');
});
Route::post('/cari', [PendaftaranController::class, 'cari'])->middleware('throttle:30,1')->name('cari');
Route::get('/scan/{code_pendaftaran}', [PendaftaranController::class, 'scan'])->middleware('throttle:60,1')->name('scan');
Route::post('/print_bukti_transfer', [PendaftaranController::class, 'print_bukti_transfer'])->middleware('throttle:30,1')->name('print_bukti_transfer');

Route::get('/data_loker', [HomeController::class, 'data_loker'])->name('data_loker');
Route::post('/tambah_loker', [HomeController::class, 'tambah_loker'])->name('tambah_loker');
Route::get('/edit_loker/{id}', [HomeController::class, 'edit_loker'])->whereNumber('id');
Route::put('/update_loker/{id}', [HomeController::class, 'update_loker'])->whereNumber('id')->name('update_loker');
Route::put('/download_pelamar/{id}', [HomeController::class, 'download_pelamar'])->whereNumber('id')->name('download_pelamar');
Route::delete('/hapus_loker/{id}', [HomeController::class, 'hapus_loker'])->whereNumber('id')->name('hapus_loker');
Route::delete('/hapus_seluruh_pelamar/{id}', [HomeController::class, 'hapus_seluruh_pelamar'])->whereNumber('id')->name('hapus_seluruh_pelamar');

Route::get('/status_pelamar', [HomeController::class, 'status_pelamar'])->name('status_pelamar');
Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::get('/get_data_pelamar', [HomeController::class, 'get_data_pelamar'])->name('get_data_pelamar');
Route::delete('/hapus_pelamar/{id}', [HomeController::class, 'hapus_pelamar'])->whereNumber('id')->name('hapus_pelamar');
Route::get('/edit_pelamar/{id}', [HomeController::class, 'edit_pelamar'])->whereNumber('id')->name('edit_pelamar');
Route::put('/update_pelamar/{id}', [HomeController::class, 'update_pelamar'])->whereNumber('id');
Route::get('/laporan/download', [HomeController::class, 'download_laporan']);

Route::post('/update_status_pembayaran/{id}', [HomeController::class, 'update_status_pembayaran'])->whereNumber('id');

Route::post('disnaker/jobfair/pendaftaran', [JobfairController::class, 'external_pendaftaran'])->middleware('throttle:20,1')->name('external_pendaftaran');
