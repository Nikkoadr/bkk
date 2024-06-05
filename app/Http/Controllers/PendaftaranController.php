<?php

namespace App\Http\Controllers;

use App\Models\Loker;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

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
        $currentStatus = DB::table('pendaftaran')
            ->where('id', $request->id)
            ->value('status_bayar');

        $updateData = ['bukti_transfer' => $request->bukti_transfer];
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
                'pendaftaran.*', 
                'pendaftaran.created_at as pendaftaran_created_at',
                'loker.*', 
                'loker.created_at as loker_created_at'
            )
            ->where('pendaftaran.code_pendaftaran', $code_pendaftaran)
            ->first();
        $pendaftaranArray = (array) $pendaftaran;
        $qrCodePath = storage_path('app/public/qrcode_'.$code_pendaftaran.'.png');
        QrCode::size(100)
            ->backgroundColor(255, 255, 255)
            ->generate('https://bkk.smkmuhkandanghaur.sch.id/cari/'.$code_pendaftaran, $qrCodePath);
        $pendaftaranArray['qr_code_path'] = $qrCodePath;
        $pdf = Pdf::loadView('download_pdf', $pendaftaranArray);
        return $pdf->download('bukti_pendaftaran_bkk_ID_'.$code_pendaftaran.'.pdf');
    }

}
