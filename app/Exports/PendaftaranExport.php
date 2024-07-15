<?php
namespace App\Exports;

use App\Models\Pendaftaran;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PendaftaranExport implements FromCollection, WithHeadings
{
    protected $id_loker;

    public function __construct($id_loker)
    {
        $this->id_loker = $id_loker;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Pendaftaran::select(
                            'pendaftaran.id', 
                            'pendaftaran.code_pendaftaran', 
                            'pendaftaran.status_bayar', 
                            'pendaftaran.bukti_transfer', 
                            'loker.nama_loker', 
                            'loker.posisi',
                            'pendaftaran.email', 
                            'pendaftaran.nomor_wa', 
                            'pendaftaran.nama', 
                            'pendaftaran.nomor_nik', 
                            'pendaftaran.npwp', 
                            'pendaftaran.tempat_lahir', 
                            'pendaftaran.tanggal_lahir', 
                            'pendaftaran.jenis_kelamin', 
                            'pendaftaran.status_perkawinan', 
                            'pendaftaran.jenis_pendidikan_terakhir', 
                            'pendaftaran.npsn', 
                            'pendaftaran.nama_sekolah', 
                            'pendaftaran.jurusan_pendidikan', 
                            'pendaftaran.kota_asal_sekolah', 
                            'pendaftaran.tahun_lulus', 
                            'pendaftaran.nilai_rata_rata_ijazah', 
                            'pendaftaran.nilai_rata_rata_matematika', 
                            'pendaftaran.blok', 
                            'pendaftaran.rt', 
                            'pendaftaran.rw', 
                            'pendaftaran.desa', 
                            'pendaftaran.kecamatan', 
                            'pendaftaran.kabupaten', 
                            'pendaftaran.kode_pos', 
                            'pendaftaran.domisili', 
                            'pendaftaran.tinggi_badan', 
                            'pendaftaran.berat_badan', 
                            'pendaftaran.pengalaman_kerja', 
                            'pendaftaran.pernah_mengikuti_reqrutment_calon_karyawan', 
                            'pendaftaran.pernah_bekerja', 
                            'pendaftaran.source', 
                            'pendaftaran.nama_kordinator', 
                            'pendaftaran.vaksin_1', 
                            'pendaftaran.jenis_vaksin_1', 
                            'pendaftaran.tanggal_vaksin_1', 
                            'pendaftaran.lokasi_vaksin_1', 
                            'pendaftaran.vaksin_2', 
                            'pendaftaran.jenis_vaksin_2', 
                            'pendaftaran.tanggal_vaksin_2', 
                            'pendaftaran.lokasi_vaksin_2', 
                            'pendaftaran.vaksin_3', 
                            'pendaftaran.jenis_vaksin_3', 
                            'pendaftaran.tanggal_vaksin_3', 
                            'pendaftaran.lokasi_vaksin_3', 
                            'pendaftaran.created_at', 
                            'pendaftaran.updated_at'
                        )
                        ->join('loker', 'pendaftaran.id_loker', '=', 'loker.id_loker')
                        ->where('pendaftaran.id_loker', $this->id_loker)
                        ->where('pendaftaran.status_bayar', 'sudah')
                        ->get();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID', 'Code Pendaftaran', 'Status Bayar', 'Bukti Transfer', 'Nama Loker', 'Posisi', 'Email', 'Nomor WA', 
            'Nama', 'Nomor NIK', 'NPWP', 'Tempat Lahir', 'Tanggal Lahir', 'Jenis Kelamin', 'Status Perkawinan', 
            'Jenis Pendidikan Terakhir', 'NPSN', 'Nama Sekolah', 'Jurusan Pendidikan', 'Kota Asal Sekolah', 
            'Tahun Lulus', 'Nilai Rata-Rata Ijazah', 'Nilai Rata-Rata Matematika', 'Blok', 'RT', 'RW', 
            'Desa', 'Kecamatan', 'Kabupaten', 'Kode Pos', 'Domisili', 'Tinggi Badan', 'Berat Badan', 
            'Pengalaman Kerja', 'Pernah Mengikuti Rekrutmen Calon Karyawan', 'Pernah Bekerja', 'Source', 
            'Nama Kordinator', 'Vaksin 1', 'Jenis Vaksin 1', 'Tanggal Vaksin 1', 'Lokasi Vaksin 1', 'Vaksin 2', 
            'Jenis Vaksin 2', 'Tanggal Vaksin 2', 'Lokasi Vaksin 2', 'Vaksin 3', 'Jenis Vaksin 3', 'Tanggal Vaksin 3', 
            'Lokasi Vaksin 3', 'Created At', 'Updated At'
        ];
    }
}
