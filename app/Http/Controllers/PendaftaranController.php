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

    public function daftar(Request $request){
        $request->request->add(['bayar'=> '50000', 'status_bayar'=> 'belum']);
        $pendaftaran = Pendaftaran::create($request->all());

        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = config('midtrans.production_status');
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;
        \Midtrans\Config::$overrideNotifUrl = config('midtrans.notifikasi_url').'/api/midtrans-callback';


        $params = array(
            'transaction_details' => array(
                'order_id' => $pendaftaran->id,
                'gross_amount' => $pendaftaran->bayar,
            ),
            'customer_details' => array(
                'first_name' => $pendaftaran-> nama,
                'last_name' => '',
                'email' => $pendaftaran->email,
                'phone' => $pendaftaran->nomor_wa,
            ),
        );
        $snapToken = \Midtrans\Snap::getSnapToken($params);
        return view('pembayaran', compact('snapToken','pendaftaran'));
    }

    public function callback(Request $request){
        $serverKey = config('midtrans.server_key');
        $hashed = hash("sha512", $request->order_id.$request->status_code.$request->gross_amount.$serverKey);
        if($hashed == $request->signature_key){
            if(($request->transaction_status == 'capture' && $request-> payment_type =='credit_card' && $request->fraud_status =='accept') or $request->transaction_status == 'settlement'){
                $order = Pendaftaran::find($request->order_id);
                $order->update(['status_bayar' => 'sudah']);
            }
        }
    }
    public function bukti_pembayaran($id){
        $pendaftaran = Pendaftaran::find($id);
        return view('bukti_pembayaran', compact('pendaftaran'));
    }

}
