<?php

namespace App\Http\Controllers;

use App\Models\Loker;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PendaftaranController extends Controller
{
    public function form_daftar(Request $request){
        $data = Loker::find( $request->id_loker);
        return view('pendaftaran.form_pendaftaran', compact('data'));
    }

public function bayar(Request $request)
{
    // Check if id_loker and nik are already registered
    $cek_pendaftar = Pendaftaran::where('id_loker', $request->id_loker)
                                ->where('nomor_nik', $request->nomor_nik)
                                ->first();
    
    if ($cek_pendaftar) {
        // Check the payment status
        if ($cek_pendaftar->status_bayar == 'belum') {
            // Proceed with the existing pendaftaran if not paid yet
            $pendaftaran = $cek_pendaftar;
        } else {
            // Redirect with an error if already registered and paid
            return redirect('/')->with('error', 'NIK Anda Sudah terdaftar Pada PT yang anda coba daftar');
        }
    } else {
        // Create a new pendaftaran if not already registered
        $pendaftaran = Pendaftaran::where('code_pendaftaran', $request->code_pendaftaran)->first();
        if (!$pendaftaran) {
            $request->merge(['status_bayar' => 'belum']);
            $pendaftaran = Pendaftaran::create($request->all());
        }
    }

    // Get registration details with join to loker table
    $pendaftaran = DB::table('pendaftaran')
        ->join('loker', 'pendaftaran.id_loker', '=', 'loker.id_loker')
        ->select('pendaftaran.*', 'loker.*', 'loker.nama_loker as nama_loker')
        ->where('pendaftaran.id', $pendaftaran->id)
        ->first();

    // Get payment details
    $bayar = DB::table('loker')
        ->where('id_loker', $pendaftaran->id_loker)
        ->select('administrasi')
        ->first();

    return view('pendaftaran.pembayaran', compact('pendaftaran', 'bayar'));
}

public function bukti_pembayaran(Request $request)
{
    // Validasi input
    $request->validate([
        'bukti_transfer' => 'required|file|mimes:jpg,jpeg,png,pdf,heif|max:5000',
    ]);

    // Ambil data pendaftaran beserta status_bayar dan loker dalam satu query
    $pendaftaran = DB::table('pendaftaran')
        ->join('loker', 'pendaftaran.id_loker', '=', 'loker.id_loker')
        ->select(
            'pendaftaran.*', 
            'pendaftaran.created_at as pendaftaran_created_at',
            'loker.*', 
            'loker.created_at as loker_created_at'
        )
        ->where('pendaftaran.id', $request->id)
        ->first();

    // Jika data pendaftaran tidak ditemukan
    if (!$pendaftaran) {
        return redirect()->back()->with('error', 'maaf file harus gambar  dan tidak lebih dari 5Mb');
    }

    // Simpan file bukti transfer
    $nama_file = 'bukti_transfer_'.$request->id.'_'.$request->nama.'.'.$request->bukti_transfer->getClientOriginalExtension();
    Storage::disk(env('STORAGE_DISK'))->put($nama_file, file_get_contents($request->bukti_transfer));

    // Siapkan data untuk diupdate
    $updateData = ['bukti_transfer' => $nama_file];
    if ($pendaftaran->status_bayar === 'belum') {
        $updateData['status_bayar'] = 'menunggu';
    }

    // Update data pendaftaran
    DB::table('pendaftaran')
        ->where('id', $request->id)
        ->update($updateData);

    // Kembalikan view dengan data pendaftaran
    return view('pendaftaran.bukti_pembayaran', compact('pendaftaran'));
}
    
public function cari(Request $request) {
    $pendaftaran = DB::table('pendaftaran')
        ->join('loker', 'pendaftaran.id_loker', '=', 'loker.id_loker')
        ->select(
            'pendaftaran.*', 
            'pendaftaran.created_at as pendaftaran_created_at',
            'loker.*', 
            'loker.created_at as loker_created_at'
        )
        ->where('pendaftaran.code_pendaftaran', $request->code_pendaftaran)
        ->first();
        
    if (!$pendaftaran) {
        return redirect('/')->with('notif', 'Data yang Anda cari tidak ditemukan.');
    }

    // Check if the status is 'belum'
    if ($pendaftaran->status_bayar == 'belum') {
        // Get payment details
        $bayar = DB::table('loker')
            ->where('id_loker', $pendaftaran->id_loker)
            ->select('administrasi')
            ->first();
        
        return view('pendaftaran.pembayaran', compact('pendaftaran', 'bayar'));
    }

    return view('pendaftaran.cari_pendaftaran', compact('pendaftaran'));
}

    public function scan($code_pendaftaran) {
    $pendaftaran = DB::table('pendaftaran')
        ->join('loker', 'pendaftaran.id_loker', '=', 'loker.id_loker')
        ->select(
            'pendaftaran.*', 
            'pendaftaran.created_at as pendaftaran_created_at',
            'loker.*', 
            'loker.created_at as loker_created_at'
        )
        ->where('pendaftaran.code_pendaftaran', $code_pendaftaran)
        ->first();
    if (!$pendaftaran) {
    return redirect('/')->with('notif', 'Data yang Anda cari tidak ditemukan.');
    }
    return view('pendaftaran.cari_pendaftaran', compact('pendaftaran'));
    }

    public function print_bukti_transfer(Request $request) {
        
    $pendaftaran = DB::table('pendaftaran')
        ->join('loker', 'pendaftaran.id_loker', '=', 'loker.id_loker')
        ->select(
            'pendaftaran.code_pendaftaran', 
            'pendaftaran.nama', 
            'pendaftaran.nomor_wa', 
            'pendaftaran.nama_sekolah',
            'pendaftaran.status_bayar',
            'loker.nama_loker', 
            'pendaftaran.created_at as pendaftaran_created_at'
        )
        ->where('pendaftaran.code_pendaftaran', $request->code_pendaftaran)
        ->first();
        
    return view('pendaftaran.print_bukti_transfer', compact('pendaftaran'));
    }

}
