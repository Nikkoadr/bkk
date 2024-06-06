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
        return view('form_pendaftaran', compact('data'));
    }

    public function daftar(Request $request)
    {
        $pendaftaran = Pendaftaran::where('code_pendaftaran', $request->code_pendaftaran)->first();
        if (!$pendaftaran) {
            $request->merge(['status_bayar' => 'belum']);
            $pendaftaran = Pendaftaran::create($request->all());
        }
        $pendaftaran = DB::table('pendaftaran')
            ->join('loker', 'pendaftaran.id_loker', '=', 'loker.id_loker')
            ->select('pendaftaran.*', 'loker.*', 'loker.nama_loker as nama_loker')
            ->where('pendaftaran.id', $pendaftaran->id)
            ->first();
        return view('pembayaran', compact('pendaftaran'));
    }

    public function bukti_pembayaran(Request $request) {
        $request->validate([
            'bukti_transfer' => 'required|file|mimes:jpg,jpeg,png,pdf|max:1024',
        ]);

        $currentStatus = DB::table('pendaftaran')
            ->where('id', $request->id)
            ->value('status_bayar');

        $nama_file = 'bukti_transfer_'.$request->id .'_'.$request->bukti_transfer->getClientOriginalExtension();
        Storage::disk(env('STORAGE_DISK'))->put('bukti_transfer/' . $nama_file, file_get_contents($request->bukti_transfer));

        $updateData = ['bukti_transfer' => $nama_file];
        if ($currentStatus === 'belum') {
            $updateData['status_bayar'] = 'menunggu';
        }

        DB::table('pendaftaran')
            ->where('id', $request->id)
            ->update($updateData);

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
            return view('bukti_pembayaran', compact('pendaftaran'));
    }
    
    public function cari($code_pendaftaran) {
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
        return view('bukti_pembayaran', compact('pendaftaran'));
    }

    public function download_pdf($code_pendaftaran) {
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
        ->where('pendaftaran.code_pendaftaran', $code_pendaftaran)
        ->first();
        
    return view('download_pdf', compact('pendaftaran'));
}

}
