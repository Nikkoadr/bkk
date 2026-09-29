<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JobfairController extends Controller
{
    public function external_pendaftaran(Request $request)
    {
        $validated = $request->validate([
            'id_loker' => 'required|integer|exists:loker,id_loker',
            'code_pendaftaran' => 'nullable|string|max:64',
            'email' => 'required|email|max:255',
            'nomor_wa' => 'required|string|max:20',
            'nama' => 'required|string|max:255',
            'nomor_nik' => 'required|string|max:32',
            'tempat_lahir' => 'nullable|string|max:255',
            'tanggal_lahir' => 'nullable|date|before:today',
            'jenis_kelamin' => 'nullable|in:L,P',
            'status_perkawinan' => 'nullable|in:MENIKAH,BELUM MENIKAH',
            'jenis_pendidikan_terakhir' => 'nullable|in:MA,MAK,SMA,SMK,D1,D2,D3,S1,S2,S3',
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
        ]);

        $cek_pendaftar = Pendaftaran::where('id_loker', $validated['id_loker'])
            ->where('nomor_nik', $validated['nomor_nik'])
            ->first();

        if ($cek_pendaftar) {
            if ($cek_pendaftar->status_bayar == 'belum') {
                $pendaftaran = $cek_pendaftar;
            } else {
                return redirect('/')->with('error', 'NIK Anda Sudah terdaftar Pada PT yang anda coba daftar');
            }
        } else {
            $code = $validated['code_pendaftaran'] ?? null;
            if (! $code || Pendaftaran::where('code_pendaftaran', $code)->exists()) {
                $code = $this->generateCode((int) $validated['id_loker']);
            }
            $validated['code_pendaftaran'] = $code;

            $pendaftaran = Pendaftaran::create($request->only((new Pendaftaran)->getFillable()) + [
                'code_pendaftaran' => $validated['code_pendaftaran'],
            ]);
            $pendaftaran->forceFill(['status_bayar' => 'menunggu'])->save();
            $pendaftaran->refresh();
        }

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

    private function generateCode(int $idLoker): string
    {
        // Pola sama: {id_loker}-{dd}-{mm}-{yy}-{HHMMSS}-{NNN}
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
}
