<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    protected $table = 'pendaftaran';

    protected $casts = [
        'paid_at' => 'datetime',
    ];

    protected $fillable = [
        'code_pendaftaran',
        'id_loker',
        'payment_method',
        'email',
        'nomor_wa',
        'nama',
        'nomor_nik',
        'npwp',
        'sim',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'status_perkawinan',
        'jenis_pendidikan_terakhir',
        'npsn',
        'nama_sekolah',
        'jurusan_pendidikan',
        'kota_asal_sekolah',
        'tahun_lulus',
        'nilai_rata_rata_ijazah',
        'nilai_rata_rata_matematika',
        'blok',
        'rt',
        'rw',
        'desa',
        'kecamatan',
        'kabupaten',
        'kode_pos',
        'domisili',
        'tinggi_badan',
        'berat_badan',
        'posisi_yang_dilamar',
        'pengalaman_kerja',
        'pernah_mengikuti_reqrutment_calon_karyawan',
        'pernah_bekerja',
        'source',
        'nama_kordinator',
        'vaksin_1',
        'jenis_vaksin_1',
        'tanggal_vaksin_1',
        'lokasi_vaksin_1',
        'vaksin_2',
        'jenis_vaksin_2',
        'tanggal_vaksin_2',
        'lokasi_vaksin_2',
        'vaksin_3',
        'jenis_vaksin_3',
        'tanggal_vaksin_3',
        'lokasi_vaksin_3',
    ];

    public function loker()
    {
        return $this->belongsTo(Loker::class, 'id_loker', 'id_loker');
    }
}
