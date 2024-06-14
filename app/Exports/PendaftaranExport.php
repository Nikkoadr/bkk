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
        return Pendaftaran::where('id_loker', $this->id_loker)
                        ->where('status_bayar', 'sudah')
                        ->get();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID', 'Code Pendaftaran', 'Status Bayar', 'Bukti Transfer', 'ID Loker', 'Email', 'Nomor WA', 
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



