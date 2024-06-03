<?php

namespace App\Http\Controllers;

use App\Models\Loker;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;

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
    public function bukti_pembayaran(Request $request){
        $id_pendaftaran = $request-> id;
        $pendaftaran = Pendaftaran::find($id_pendaftaran);
        $pendaftaran->update(['bukti_transfer' => $request->bukti_transfer]);
        return view('bukti_pembayaran', compact('pendaftaran'));
    }

}
