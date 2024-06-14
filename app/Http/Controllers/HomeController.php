<?php

namespace App\Http\Controllers;

use App\Models\Loker;
use Illuminate\Http\Request;
use App\Models\Pendaftaran;
use App\Exports\PendaftaranExport;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\DataTables;

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
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin.home');
    }

    public function data_loker() {
        $data_loker = Loker::all();
        return view('admin.data_loker', compact('data_loker'));
    }

    public function tambah_loker(Request $request)
    {
        $request->validate([
            'nama_loker' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'status_loker' => 'required|string|max:255',
            'grup_wa' => 'required|string',
        ]);

        Loker::create($request->all());

        return redirect()->back()->with('success', 'Loker has been added successfully');
    }

    public function edit_loker($id){
        $data = Loker::find($id);
        return view('admin.edit_loker', compact('data'));
    }

    public function update_loker(Request $request, $id)
    {
        $request->validate([
            'nama_loker' => 'required|string|max:255',
            'deskripsi' => 'required|string|',
            'status_loker' => 'required|string|max:255',
            'grup_wa' => 'required|string',
        ]);

        $loker = Loker::findOrFail($id);
        $loker->update($request->only(['nama_loker', 'deskripsi', 'status_loker', 'grup_wa']));

        return redirect()->route('data_loker')->with('success', 'Loker updated successfully');
    }

    public function hapus_loker($id)
    {
        $loker = Loker::findOrFail($id);
        Pendaftaran::where('id_loker', $id)->delete();
        $loker->delete();
        return redirect()->back()->with('success', 'Loker has been deleted successfully');
    }

    public function download_pelamar($id)
    {
        return Excel::download(new PendaftaranExport($id), date('Y-m-d_H-i-s').'_pendaftaran_'.$id.'.xlsx');
    }


    public function status_pelamar()
    {
        $pendaftaran = Pendaftaran::orderBy('created_at', 'desc')->get();
        return view('admin.status_pelamar', compact('pendaftaran'));
    }

    public function get_data_pelamar( Request $request){
                $dataPelamar = Pendaftaran::query()->orderBy('created_at', 'desc');

        if ($request->has('search') && !empty($request->search['value'])) {
            $keyword = $request->search['value'];
            $dataPelamar->where(function ($query) use ($keyword) {
                $query->where('nama', 'like', "%{$keyword}%")
                    ->orWhere('code_pendaftaran', 'like', "%{$keyword}%")
                    ->orWhere('nomor_wa', 'like', "%{$keyword}%")
                    ->orWhere('status_bayar', 'like', "%{$keyword}%")
                    ->orWhere('bukti_transfer', 'like', "%{$keyword}%");
            });
        }

        return DataTables::of($dataPelamar)
            ->addColumn('action', function ($data) {
                $editUrl = route('edit_pelamar', $data->id);
                $deleteUrl = route('hapus_pelamar', $data->id);

                return '
                    <a href="'.$editUrl.'" class="btn btn-sm btn-primary">Edit</a>
                    <form action="'.$deleteUrl.'" method="POST" style="display:inline;">
                        '.csrf_field().'
                        '.method_field('DELETE').'
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                ';
            })
            ->editColumn('bukti_transfer', function ($data) {
                if ($data->bukti_transfer) {
                    return '<a href="' . asset('storage/bukti_transfer/' . $data->bukti_transfer) . '" target="_blank">Lihat</a>';
                } else {
                    return 'N/A';
                }
            })
            ->rawColumns(['action', 'bukti_transfer'])
            ->make(true);
    }

    public function edit_pelamar($id){
        $data = Pendaftaran::find($id);
        return view('admin.edit_pelamar', compact('data'));
    }

    public function update_pelamar(Request $request, $id) {
        $validatedData = $request->validate([
            'code_pendaftaran' => 'required|string|max:255',
            'status_bayar' => 'required|in:belum,menunggu,sudah',
            'bukti_transfer' => 'nullable|string|max:255',
            'email' => 'required|email|max:255',
            'nomor_wa' => 'required|string|max:15',
            'nama' => 'required|string|max:255',
            'nomor_nik' => 'nullable|string|max:255',
            'npwp' => 'nullable|string|max:255',
            'tempat_lahir' => 'nullable|string|max:255',
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'nullable|in:L,P',
            'status_perkawinan' => 'nullable|in:MENIKAH,BELUM MENIKAH',
            'jenis_pendidikan_terakhir' => 'nullable|in:MA,MAK,SMA,SMK',
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
        $pendaftaran->update($validatedData);
        return redirect('status_pelamar')->with('success', 'Data pelamar berhasil diupdate');
    }

    public function hapus_pelamar($id) {
        $pendaftaran = Pendaftaran::findOrFail($id);
        $pendaftaran->delete();
        return redirect()->back()->with('success', 'data pelamar berhasil di hapus');
    }
}
