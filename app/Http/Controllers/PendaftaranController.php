<?php

namespace App\Http\Controllers;

use App\Models\Loker;
use App\Models\Pendaftaran;
use App\Services\MidtransService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PendaftaranController extends Controller
{
    public function form_daftar(Request $request)
    {
        $validated = $request->validate([
            'id_loker' => 'required|integer|exists:loker,id_loker',
        ]);

        $data = Loker::where('id_loker', $validated['id_loker'])
            ->where('status_loker', 'aktif')
            ->first();

        if (! $data) {
            return redirect('/')->with('notif', 'Loker tidak tersedia atau sudah ditutup.');
        }

        return view('pendaftaran.form_pendaftaran', compact('data'));
    }

    public function bayar(Request $request)
    {
        $validated = $request->validate([
            'id_loker' => 'required|integer|exists:loker,id_loker',
            'email' => 'required|email|max:255',
            'nomor_wa' => 'required|string|max:20',
            'nama' => 'required|string|max:255',
            'nomor_nik' => 'required|string|max:32',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date|before:today',
            'jenis_kelamin' => 'required|in:L,P',
            'status_perkawinan' => 'required|in:MENIKAH,BELUM MENIKAH',
            'jenis_pendidikan_terakhir' => 'required|in:MA,MAK,SMA,SMK,D1,D2,D3,S1,S2,S3',
            'sim' => 'nullable|in:D,C1,C2,C3,A,A UMUM,B1,B2,B1 UMUM,B2 UMUM',
            'npwp' => 'nullable|string|max:64',
            'npsn' => 'nullable|string|max:64',
            'nama_sekolah' => 'nullable|string|max:255',
            'jurusan_pendidikan' => 'nullable|string|max:255',
            'kota_asal_sekolah' => 'nullable|string|max:255',
            'tahun_lulus' => 'nullable|string|max:4',
            'nilai_rata_rata_ijazah' => 'nullable|string|max:255',
            'nilai_rata_rata_matematika' => 'nullable|string|max:255',
            'blok' => 'nullable|string|max:255',
            'rt' => 'nullable|string|max:5',
            'rw' => 'nullable|string|max:5',
            'desa' => 'nullable|string|max:255',
            'kecamatan' => 'nullable|string|max:255',
            'kabupaten' => 'nullable|string|max:255',
            'kode_pos' => 'nullable|string|max:10',
            'domisili' => 'nullable|string|max:255',
            'tinggi_badan' => 'nullable|string|max:255',
            'berat_badan' => 'nullable|string|max:255',
            'posisi_yang_dilamar' => 'nullable|string|max:255',
            'pengalaman_kerja' => 'nullable|string|max:255',
            'pernah_mengikuti_reqrutment_calon_karyawan' => 'nullable|in:BELUM PERNAH,SUDAH PERNAH',
            'pernah_bekerja' => 'nullable|in:BELUM PERNAH,SUDAH PERNAH',
            'source' => 'nullable|string|max:255',
            'nama_kordinator' => 'nullable|string|max:255',
            'vaksin_1' => 'nullable|in:sudah,belum',
            'jenis_vaksin_1' => 'nullable|in:SINOVAC,VAKSIN COVID-19 BIO DARMA,ASTRAZENECA,SINOPHARM,MODERNA,PFIZER,SPUTNIK V,INDOVAC,INAVAC',
            'tanggal_vaksin_1' => 'nullable|date',
            'lokasi_vaksin_1' => 'nullable|string|max:255',
            'vaksin_2' => 'nullable|in:sudah,belum',
            'jenis_vaksin_2' => 'nullable|in:SINOVAC,VAKSIN COVID-19 BIO DARMA,ASTRAZENECA,SINOPHARM,MODERNA,PFIZER,SPUTNIK V,INDOVAC,INAVAC',
            'tanggal_vaksin_2' => 'nullable|date',
            'lokasi_vaksin_2' => 'nullable|string|max:255',
            'vaksin_3' => 'nullable|in:sudah,belum',
            'jenis_vaksin_3' => 'nullable|in:SINOVAC,VAKSIN COVID-19 BIO DARMA,ASTRAZENECA,SINOPHARM,MODERNA,PFIZER,SPUTNIK V,INDOVAC,INAVAC',
            'tanggal_vaksin_3' => 'nullable|date',
            'lokasi_vaksin_3' => 'nullable|string|max:255',
            'payment_method' => 'nullable|in:manual,midtrans',
        ]);

        $loker = Loker::where('id_loker', $validated['id_loker'])
            ->where('status_loker', 'aktif')
            ->first();

        if (! $loker) {
            return redirect('/')->with('error', 'Loker tidak tersedia atau sudah ditutup.');
        }

        $cek_pendaftar = Pendaftaran::where('id_loker', $validated['id_loker'])
            ->where('nomor_nik', $validated['nomor_nik'])
            ->first();

        if ($cek_pendaftar) {
            if ($cek_pendaftar->status_bayar === 'belum') {
                $pendaftaran = $cek_pendaftar;
                if (($validated['payment_method'] ?? null) === 'midtrans') {
                    $pendaftaran->forceFill(['payment_method' => 'midtrans'])->save();
                }
            } else {
                return redirect('/')->with('error', 'NIK Anda Sudah terdaftar Pada PT yang anda coba daftar');
            }
        } else {
            $code = $this->generateCode((int) $validated['id_loker']);

            $pendaftaran = Pendaftaran::create($request->only((new Pendaftaran)->getFillable()) + [
                'code_pendaftaran' => $code,
                'payment_method' => $validated['payment_method'] ?? 'manual',
            ]);
            $pendaftaran->forceFill(['status_bayar' => 'belum'])->save();
            $pendaftaran->refresh();
        }

        $pendaftaranRow = DB::table('pendaftaran')
            ->join('loker', 'pendaftaran.id_loker', '=', 'loker.id_loker')
            ->select('pendaftaran.*', 'loker.nama_loker as nama_loker')
            ->where('pendaftaran.id', $pendaftaran->id)
            ->first();

        $bayar = DB::table('loker')
            ->where('id_loker', $pendaftaranRow->id_loker)
            ->select('administrasi')
            ->first();

        $snapToken = null;
        $midtransClientKey = (string) config('midtrans.client_key');
        if (($pendaftaranRow->payment_method === 'midtrans' || ($validated['payment_method'] ?? null) === 'midtrans')
            && MidtransService::configured()
            && (int) $bayar->administrasi > 0
        ) {
            $pendaftaranModel = Pendaftaran::find($pendaftaranRow->id);
            try {
                if (! $pendaftaranModel->midtrans_order_id) {
                    $pendaftaranModel->forceFill([
                        'payment_method' => 'midtrans',
                        'midtrans_order_id' => $pendaftaranModel->code_pendaftaran.'-'.time(),
                    ])->save();
                }
                $snapToken = MidtransService::snapToken(
                    $pendaftaranModel->midtrans_order_id,
                    (int) $bayar->administrasi,
                    ['first_name' => $pendaftaranModel->nama, 'email' => $pendaftaranModel->email, 'phone' => $pendaftaranModel->nomor_wa]
                );
                $pendaftaranModel->forceFill(['midtrans_snap_token' => $snapToken])->save();
                $pendaftaranRow->midtrans_order_id = $pendaftaranModel->midtrans_order_id;
            } catch (\Throwable $e) {
                Log::error('Midtrans snap gagal: '.$e->getMessage());
            }
        }

        return view('pendaftaran.pembayaran', [
            'pendaftaran' => $pendaftaranRow,
            'bayar' => $bayar,
            'snapToken' => $snapToken,
            'midtransClientKey' => $midtransClientKey,
            'midtransReady' => MidtransService::configured(),
        ]);
    }

    private function generateCode(int $idLoker): string
    {
        // Pola sama seperti sebelumnya: {id_loker}-{dd}-{mm}-{yy}-{HHMMSS}-{NNN}
        do {
            $now = now();
            $code = sprintf(
                '%d-%s-%s-%s-%s-%03d',
                $idLoker,
                $now->format('d'),
                $now->format('m'),
                $now->format('y'),
                $now->format('His'),
                random_int(0, 999)
            );
        } while (Pendaftaran::where('code_pendaftaran', $code)->exists());

        return $code;
    }

    public function bukti_pembayaran(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|integer|exists:pendaftaran,id',
            'code_pendaftaran' => 'required|string|max:64',
            'bukti_transfer' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $pendaftaran = Pendaftaran::findOrFail($validated['id']);

        if (! hash_equals((string) $pendaftaran->code_pendaftaran, (string) $validated['code_pendaftaran'])) {
            abort(403, 'Kode pendaftaran tidak cocok.');
        }

        $disk = config('filesystems.default', 'local');
        $extension = strtolower($request->file('bukti_transfer')->getClientOriginalExtension());
        if ($extension === 'jpeg') {
            $extension = 'jpg';
        }
        $nama_file = 'bukti_transfer_'.Str::uuid()->toString().'.'.$extension;

        if ($pendaftaran->bukti_transfer && Storage::disk($disk)->exists(basename($pendaftaran->bukti_transfer))) {
            Storage::disk($disk)->delete(basename($pendaftaran->bukti_transfer));
        }

        $bytes = $this->compressBukti($request->file('bukti_transfer')->getRealPath(), $extension);
        Storage::disk($disk)->put($nama_file, $bytes);

        $pendaftaran->forceFill(['bukti_transfer' => $nama_file]);
        if ($pendaftaran->status_bayar === 'belum') {
            $pendaftaran->forceFill(['status_bayar' => 'menunggu']);
        }
        $pendaftaran->save();

        $row = DB::table('pendaftaran')
            ->join('loker', 'pendaftaran.id_loker', '=', 'loker.id_loker')
            ->select(
                'pendaftaran.*',
                'pendaftaran.created_at as pendaftaran_created_at',
                'loker.nama_loker',
                'loker.grup_wa'
            )
            ->where('pendaftaran.id', $pendaftaran->id)
            ->first();

        return view('pendaftaran.bukti_pembayaran', ['pendaftaran' => $row]);
    }

    public function cari(Request $request)
    {
        $validated = $request->validate([
            'code_pendaftaran' => 'required|string|max:64',
        ]);

        $pendaftaran = DB::table('pendaftaran')
            ->join('loker', 'pendaftaran.id_loker', '=', 'loker.id_loker')
            ->select(
                'pendaftaran.*',
                'pendaftaran.created_at as pendaftaran_created_at',
                'loker.nama_loker'
            )
            ->where('pendaftaran.code_pendaftaran', $validated['code_pendaftaran'])
            ->first();

        if (! $pendaftaran) {
            return redirect('/')->with('notif', 'Data yang Anda cari tidak ditemukan.');
        }

        if ($pendaftaran->status_bayar == 'belum') {
            $bayar = DB::table('loker')
                ->where('id_loker', $pendaftaran->id_loker)
                ->select('administrasi')
                ->first();

            return view('pendaftaran.pembayaran', [
                'pendaftaran' => $pendaftaran,
                'bayar' => $bayar,
                'snapToken' => null,
                'midtransClientKey' => (string) config('midtrans.client_key'),
                'midtransReady' => MidtransService::configured(),
            ]);
        }

        return view('pendaftaran.cari_pendaftaran', compact('pendaftaran'));
    }

    public function scan($code_pendaftaran)
    {
        $code = substr((string) $code_pendaftaran, 0, 64);

        $pendaftaran = DB::table('pendaftaran')
            ->join('loker', 'pendaftaran.id_loker', '=', 'loker.id_loker')
            ->select(
                'pendaftaran.*',
                'pendaftaran.created_at as pendaftaran_created_at',
                'loker.nama_loker'
            )
            ->where('pendaftaran.code_pendaftaran', $code)
            ->first();

        if (! $pendaftaran) {
            return redirect('/')->with('notif', 'Data yang Anda cari tidak ditemukan.');
        }

        return view('pendaftaran.cari_pendaftaran', compact('pendaftaran'));
    }

    public function print_bukti_transfer(Request $request)
    {
        $validated = $request->validate([
            'code_pendaftaran' => 'required|string|max:64',
        ]);

        $pendaftaran = DB::table('pendaftaran')
            ->join('loker', 'pendaftaran.id_loker', '=', 'loker.id_loker')
            ->select(
                'pendaftaran.code_pendaftaran',
                'pendaftaran.nama',
                'pendaftaran.nomor_wa',
                'pendaftaran.nama_sekolah',
                'pendaftaran.status_bayar',
                'pendaftaran.created_at as pendaftaran_created_at',
                'loker.nama_loker',
                'loker.grup_wa'
            )
            ->where('pendaftaran.code_pendaftaran', $validated['code_pendaftaran'])
            ->first();

        if (! $pendaftaran) {
            return redirect()->back()->with('error', 'Data pendaftaran tidak ditemukan');
        }

        if ($pendaftaran->status_bayar === 'belum') {
            return redirect('/')->with('notif', 'Selesaikan pembayaran terlebih dahulu untuk mencetak bukti.');
        }

        $grupWaLink = $this->safeWaLink($pendaftaran->grup_wa ?? null);

        return view('pendaftaran.print_bukti_transfer', compact('pendaftaran', 'grupWaLink'));
    }

    private function compressBukti(string $realPath, string $extension): string
    {
        $raw = @file_get_contents($realPath);
        if ($raw === false || $extension === 'pdf') {
            return $raw === false ? '' : $raw;
        }

        $src = @imagecreatefromstring($raw);
        if ($src === false) {
            return $raw;
        }

        // Resize menjaga rasio, sisi terpanjang maksimal 1280px
        $width = imagesx($src);
        $height = imagesy($src);
        $max = 1280;
        if ($width > $max || $height > $max) {
            $ratio = min($max / $width, $max / $height);
            $newWidth = (int) round($width * $ratio);
            $newHeight = (int) round($height * $ratio);
            $dst = imagecreatetruecolor($newWidth, $newHeight);
            if ($extension === 'png') {
                imagealphablending($dst, false);
                imagesavealpha($dst, true);
            }
            imagecopyresampled($dst, $src, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
            imagedestroy($src);
            $src = $dst;
        }

        ob_start();
        if ($extension === 'png') {
            imagepng($src, null, 6);
        } else {
            imagejpeg($src, null, 70);
        }
        $out = ob_get_clean();
        imagedestroy($src);

        return is_string($out) && $out !== '' ? $out : $raw;
    }

    public function callback(Request $request)
    {
        $validated = $request->validate([
            'order_id' => 'required|string|max:64',
            'status_code' => 'required|string|max:16',
            'gross_amount' => 'required|string|max:32',
            'signature_key' => 'required|string',
            'transaction_status' => 'required|string|max:32',
            'payment_type' => 'nullable|string|max:32',
        ]);

        if (! MidtransService::validSignature(
            $validated['order_id'],
            $validated['status_code'],
            $validated['gross_amount'],
            $validated['signature_key']
        )) {
            Log::warning('Midtrans signature invalid.', ['order_id' => $validated['order_id']]);

            return response()->json(['message' => 'Signature tidak valid.'], 403);
        }

        $pendaftaran = Pendaftaran::where('midtrans_order_id', $validated['order_id'])->first();
        if (! $pendaftaran) {
            return response()->json(['message' => 'Order tidak ditemukan.'], 404);
        }

        $status = $validated['transaction_status'];
        $pendaftaran->forceFill([
            'midtrans_transaction_status' => $status,
            'payment_method' => 'midtrans',
        ])->save();

        if (in_array($status, ['capture', 'settlement'], true)) {
            $pendaftaran->forceFill([
                'status_bayar' => 'sudah',
                'paid_at' => now(),
            ])->save();
        }

        return response()->json(['message' => 'OK']);
    }

    private function safeWaLink(?string $link): string
    {
        if (is_string($link) && preg_match('~^https://chat\.whatsapp\.com/[A-Za-z0-9/?.=_-]+$~', $link)) {
            return $link;
        }

        return 'https://chat.whatsapp.com/';
    }
}
