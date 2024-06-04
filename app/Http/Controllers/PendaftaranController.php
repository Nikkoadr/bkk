<?php

namespace App\Http\Controllers;

use App\Models\Loker;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PendaftaranController extends Controller
{
    public function form_daftar(Request $request){
        $data = Loker::find( $request->id_loker);
        return view('form_pendaftaran', compact('data'));
    }

    public function daftar(Request $request)
    {
        $pendaftaran = Pendaftaran::where('code_pendaftaran', $request->code_pendaftaran)->first();
        if ($pendaftaran) {
            return view('pembayaran', compact('pendaftaran'));
        } else {
            $request->merge(['status_bayar' => 'belum']);
            $pendaftaran = Pendaftaran::create($request->all());
            return view('pembayaran', compact('pendaftaran'));
        }
    }
    public function bukti_pembayaran(Request $request) {
        $id_pendaftaran = $request->id;

        // Update bukti_transfer in Pendaftaran table
        DB::table('pendaftaran')
            ->where('id', $id_pendaftaran)
            ->update(['bukti_transfer' => $request->bukti_transfer]);

        // Join Pendaftaran with Loker using id_loker
        $pendaftaran = DB::table('pendaftaran')
            ->join('loker', 'pendaftaran.id_loker', '=', 'loker.id_loker')
            ->select('pendaftaran.*', 'loker.*')
            ->where('pendaftaran.id', $id_pendaftaran)
            ->first();

        return view('bukti_pembayaran', compact('pendaftaran'));
    }
    
    public function cari($code_pendaftaran) {

        $pendaftaran = DB::table('pendaftaran')
            ->join('loker', 'pendaftaran.id_loker', '=', 'loker.id_loker')
            ->select('pendaftaran.*', 'loker.*')
            ->where('pendaftaran.code_pendaftaran', $code_pendaftaran)
            ->first();
            return view('bukti_pembayaran', compact('pendaftaran'));
    }

}
