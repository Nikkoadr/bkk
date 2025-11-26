<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use Illuminate\Http\Request;

class JobfairController extends Controller
{
    public function external_pendaftaran(Request $request)
    {
        $cek_pendaftar = Pendaftaran::where('id_loker', $request->id_loker)
            ->where('nomor_nik', $request->nomor_nik)
            ->first();

        if ($cek_pendaftar) {
            if ($cek_pendaftar->status_bayar == 'belum') {
                $pendaftaran = $cek_pendaftar;
            } else {
                return redirect('/')->with('error', 'NIK Anda Sudah terdaftar Pada PT yang anda coba daftar');
            }
        } else {
            $pendaftaran = Pendaftaran::where('code_pendaftaran', $request->code_pendaftaran)->first();
            if (!$pendaftaran) {
                $request->merge(['status_bayar' => 'menunggu']);
                $pendaftaran = Pendaftaran::create($request->all());
            }
        }

        return view('pendaftaran.bukti_pembayaran', compact('pendaftaran'));
    }
}
