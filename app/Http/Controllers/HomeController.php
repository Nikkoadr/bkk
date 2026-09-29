<?php

namespace App\Http\Controllers;

use App\Exports\LaporanExport;
use App\Models\Loker;
use Illuminate\Http\Request;
use App\Models\Pendaftaran;
use App\Exports\PendaftaranExport;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            $user = auth()->user();
            if (! $user || (int) ($user->id_role ?? 0) !== 1) {
                abort(403, 'Akses admin saja.');
            }

            return $next($request);
        });
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $lokerData = Loker::select(
            'loker.id_loker',
            'loker.nama_loker',
            'loker.posisi',
            'loker.status_loker',
            'loker.administrasi',
            DB::raw('COUNT(pendaftaran.id) as total'),
            DB::raw('SUM(CASE WHEN pendaftaran.status_bayar = "belum" THEN 1 ELSE 0 END) as belum_bayar'),
            DB::raw('SUM(CASE WHEN pendaftaran.status_bayar = "menunggu" THEN 1 ELSE 0 END) as menunggu'),
            DB::raw('SUM(CASE WHEN pendaftaran.status_bayar = "sudah" THEN 1 ELSE 0 END) as sudah_bayar')
        )
            ->leftJoin('pendaftaran', 'loker.id_loker', '=', 'pendaftaran.id_loker')
            ->groupBy('loker.id_loker', 'loker.nama_loker', 'loker.posisi', 'loker.status_loker', 'loker.administrasi')
            ->orderBy('loker.nama_loker')
            ->get();

        $totals = [
            'loker_aktif' => Loker::where('status_loker', 'aktif')->count(),
            'pendaftar' => \App\Models\Pendaftaran::count(),
            'belum' => \App\Models\Pendaftaran::where('status_bayar', 'belum')->count(),
            'menunggu' => \App\Models\Pendaftaran::where('status_bayar', 'menunggu')->count(),
            'sudah' => \App\Models\Pendaftaran::where('status_bayar', 'sudah')->count(),
            'omset' => (int) \App\Models\Pendaftaran::where('status_bayar', 'sudah')
                ->join('loker', 'pendaftaran.id_loker', '=', 'loker.id_loker')
                ->sum('loker.administrasi'),
        ];

        $tren = DB::table('pendaftaran')
            ->select(DB::raw('DATE(created_at) as tgl'), DB::raw('COUNT(*) as total'))
            ->where('created_at', '>=', now()->subDays(13)->startOfDay())
            ->groupBy(DB::raw('DATE(created_at)'))
            ->orderBy('tgl')
            ->get();

        return view('admin.home', compact('lokerData', 'totals', 'tren'));
    }



    public function data_loker()
    {
        $data_loker = Loker::all();
        return view('admin.data_loker', compact('data_loker'));
    }

    public function tambah_loker(Request $request)
    {
        $validated = $request->validate([
            'nama_loker' => 'required|string|max:255',
            'posisi' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'administrasi' => 'required|integer|min:0|max:10000000',
            'status_loker' => 'required|in:aktif,tidak aktif',
            'grup_wa' => 'required|url|starts_with:https://chat.whatsapp.com/',
            'form_npwp' => 'required|in:aktif,tidak aktif',
            'form_npsn' => 'required|in:aktif,tidak aktif',
            'form_nilai_ijazah' => 'required|in:aktif,tidak aktif',
            'form_nilai_matematika' => 'required|in:aktif,tidak aktif',
            'form_domisili' => 'required|in:aktif,tidak aktif',
            'form_pernah_mengikuti_reqrutment_calon_karyawan' => 'required|in:aktif,tidak aktif',
            'form_pernah_bekerja' => 'required|in:aktif,tidak aktif',
            'form_vaksin' => 'required|in:aktif,tidak aktif',
        ]);

        $validated['deskripsi'] = $this->sanitizeDeskripsi($validated['deskripsi']);
        Loker::create($validated);

        return redirect()->back()->with('success', 'Loker has been added successfully');
    }

    private function sanitizeDeskripsi(string $html): string
    {
        $html = preg_replace('#<(script|style|iframe|object|embed|form|input|button)[^>]*?>.*?</\\1>#is', '', $html);
        $html = preg_replace('/\son\w+\s*=\s*("[^"]*"|\'[^\']*\'|[^\s>]+)/i', '', $html);
        $html = preg_replace('/(href|src)\s*=\s*["\']\s*javascript:[^"\']*["\']/i', '$1="#"', $html);
        $allowed = '<p><br><ul><ol><li><strong><em><u><h6><b><i><span><div>';
        $clean = strip_tags($html, $allowed);

        return substr($clean, 0, 20000);
    }

    public function edit_loker($id)
    {
        $data = Loker::find($id);
        return view('admin.edit_loker', compact('data'));
    }

    public function update_loker(Request $request, $id)
    {
        $request->validate([
            'nama_loker' => 'required|string|max:255',
            'posisi' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'administrasi' => 'required|integer|min:0|max:10000000',
            'status_loker' => 'required|in:aktif,tidak aktif',
            'grup_wa' => 'required|url|starts_with:https://chat.whatsapp.com/',
            'form_npwp' => 'required|in:aktif,tidak aktif',
            'form_npsn' => 'required|in:aktif,tidak aktif',
            'form_nilai_ijazah' => 'required|in:aktif,tidak aktif',
            'form_nilai_matematika' => 'required|in:aktif,tidak aktif',
            'form_domisili' => 'required|in:aktif,tidak aktif',
            'form_pernah_mengikuti_reqrutment_calon_karyawan' => 'required|in:aktif,tidak aktif',
            'form_pernah_bekerja' => 'required|in:aktif,tidak aktif',
            'form_vaksin' => 'required|in:aktif,tidak aktif',
        ]);

        $loker = Loker::findOrFail($id);
        $data = $request->only([
            'nama_loker',
            'posisi',
            'deskripsi',
            'administrasi',
            'status_loker',
            'grup_wa',
            'form_npwp',
            'form_npsn',
            'form_nilai_ijazah',
            'form_nilai_matematika',
            'form_domisili',
            'form_pernah_mengikuti_reqrutment_calon_karyawan',
            'form_pernah_bekerja',
            'form_vaksin'
        ]);
        $data['deskripsi'] = $this->sanitizeDeskripsi($data['deskripsi']);
        $loker->update($data);

        return redirect()->route('data_loker')->with('success', 'Loker updated successfully');
    }

    private function hapusFileBukti($files): void
    {
        $disk = config('filesystems.default', 'local');
        foreach ($files as $file) {
            if (! $file) {
                continue;
            }
            $name = basename($file);
            if (preg_match('/^[A-Za-z0-9_.-]+$/', $name) && Storage::disk($disk)->exists($name)) {
                Storage::disk($disk)->delete($name);
            }
        }
    }

    public function hapus_loker($id)
    {
        $loker = Loker::findOrFail($id);
        $files = Pendaftaran::where('id_loker', $id)->whereNotNull('bukti_transfer')->pluck('bukti_transfer');
        $this->hapusFileBukti($files);
        Pendaftaran::where('id_loker', $id)->delete();
        $loker->delete();
        return redirect()->back()->with('success', 'Loker has been deleted successfully');
    }
    public function hapus_seluruh_pelamar($id)
    {
        $files = Pendaftaran::where('id_loker', $id)->whereNotNull('bukti_transfer')->pluck('bukti_transfer');
        $this->hapusFileBukti($files);
        Pendaftaran::where('id_loker', $id)->delete();
        return redirect()->back()->with('success', 'Seluruh pelamar telah dihapus dari loker ini');
    }

    public function download_pelamar($id)
    {
        $loker = DB::table('loker')->where('id_loker', $id)->first();
        if (! $loker) {
            return redirect()->back()->with('error', 'Loker tidak ditemukan.');
        }
        $safe = preg_replace('/[^A-Za-z0-9-_]+/', '_', $loker->nama_loker);
        return Excel::download(new PendaftaranExport($id), date('Y-m-d_H-i-s') . '_' . substr($safe, 0, 50) . '_' . (int) $id . '.xlsx');
    }


    public function status_pelamar()
    {
        $pendaftaran = Pendaftaran::orderBy('created_at', 'desc')->get();
        return view('admin.status_pelamar', compact('pendaftaran'));
    }

    public function get_data_pelamar(Request $request)
    {
        $dataPelamar = Pendaftaran::with('loker') // pastikan ada relasi 'loker' di model Pendaftaran
            ->join('loker', 'pendaftaran.id_loker', '=', 'loker.id_loker')
            ->select('pendaftaran.*', 'loker.nama_loker');

        // Filter berdasarkan dropdown (id lebih akurat, nama tetap didukung)
        if ($request->filled('filter_loker_id')) {
            $dataPelamar->where('pendaftaran.id_loker', (int) $request->filter_loker_id);
        } elseif ($request->filled('filter_loker')) {
            $dataPelamar->where('loker.nama_loker', $request->filter_loker);
        }

        if ($request->filled('filter_bayar') && in_array($request->filter_bayar, ['belum', 'menunggu', 'sudah'], true)) {
            $dataPelamar->where('pendaftaran.status_bayar', $request->filter_bayar);
        }

        // Handle search global dari kolom pencarian
        if ($request->has('search') && !empty($request->search['value'])) {
            $keyword = $request->search['value'];
            $dataPelamar->where(function ($query) use ($keyword) {
                $query->where('pendaftaran.nama', 'like', "%{$keyword}%")
                    ->orWhere('pendaftaran.code_pendaftaran', 'like', "%{$keyword}%")
                    ->orWhere('pendaftaran.nomor_wa', 'like', "%{$keyword}%")
                    ->orWhere('pendaftaran.status_bayar', 'like', "%{$keyword}%")
                    ->orWhere('pendaftaran.bukti_transfer', 'like', "%{$keyword}%")
                    ->orWhere('loker.nama_loker', 'like', "%{$keyword}%");
            });
        }

        // Order handling (whitelist agar tidak bisa SQL injection)
        $allowedSorts = ['code_pendaftaran', 'nama', 'nomor_wa', 'status_bayar', 'id'];
        if ($request->has('order')) {
            foreach ($request->order as $order) {
                $orderColumn = (int) ($order['column'] ?? -1);
                $orderDir = strtolower($order['dir'] ?? 'asc') === 'desc' ? 'desc' : 'asc';
                $columns = $request->columns;
                $orderColumnName = $columns[$orderColumn]['name'] ?? null;
                if (in_array($orderColumnName, $allowedSorts, true)) {
                    $dataPelamar->orderBy('pendaftaran.'.$orderColumnName, $orderDir);
                }
            }
        } else {
            $dataPelamar->orderBy('pendaftaran.nama', 'asc')->orderBy('pendaftaran.status_bayar', 'asc');
        }

        return DataTables::of($dataPelamar)
            ->editColumn('bukti_transfer', function ($data) {
                $file = $data->bukti_transfer ? basename($data->bukti_transfer) : null;
                if (! $file || ! preg_match('/^[A-Za-z0-9_.-]+$/', $file)) {
                    return 'N/A';
                }
                $url = asset('/storage/bukti_transfer/' . $file);

                return '<a href="' . e($url) . '" target="_blank">
                    <img width="50" height="50" src="' . e($url) . '" alt="Bukti Transfer">
            </a>';
            })
            ->rawColumns(['action', 'bukti_transfer'])
            ->make(true);
    }


    public function edit_pelamar($id)
    {
        $data = Pendaftaran::find($id);
        return view('admin.edit_pelamar', compact('data'));
    }

    public function update_pelamar(Request $request, $id)
    {
        $validatedData = $request->validate([
            'code_pendaftaran' => 'required|string|max:255|unique:pendaftaran,code_pendaftaran,'.$id,
            'status_bayar' => 'required|in:belum,menunggu,sudah',
            'email' => 'required|email|max:255',
            'nomor_wa' => 'required|string|max:15',
            'nama' => 'required|string|max:255',
            'nomor_nik' => 'nullable|string|max:255',
            'npwp' => 'nullable|string|max:255',
            'sim' => 'nullable|in:D,C1,C2,C3,A,A UMUM,B1,B2,B1 UMUM,B2 UMUM',
            'tempat_lahir' => 'nullable|string|max:255',
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'nullable|in:L,P',
            'status_perkawinan' => 'nullable|in:MENIKAH,BELUM MENIKAH',
            'jenis_pendidikan_terakhir' => 'nullable|in:MA,MAK,SMA,SMK,D1,D2,D3,S1,S2,S3',
            'npsn' => 'nullable|string|max:255',
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
            'lokasi_vaksin_3' => 'nullable|string|max:255'
        ]);
        $pendaftaran = Pendaftaran::findOrFail($id);
        $pendaftaran->forceFill($validatedData)->save();
        return redirect('status_pelamar')->with('success', 'Data pelamar berhasil diupdate');
    }

    public function hapus_pelamar($id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);

        $this->hapusFileBukti([$pendaftaran->bukti_transfer]);

        $pendaftaran->delete();

        return redirect()->back()->with('success', 'Data pelamar berhasil dihapus');
    }



    public function download_laporan()
    {
        $nama_file = 'Seluruh Data Pelamar_' . date('Y-m-d') . '.xlsx';
        return Excel::download(new LaporanExport, $nama_file);
    }

    public function update_status_pembayaran($id)
    {
        $pelamar = Pendaftaran::findOrFail($id);
        $pelamar->forceFill(['status_bayar' => 'sudah'])->save();

        return response()->json(['success' => true, 'message' => 'Status pembayaran berhasil diperbarui']);
    }
}
