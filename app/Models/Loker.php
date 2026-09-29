<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loker extends Model
{
    protected $table = 'loker';
    protected $primaryKey = 'id_loker';

    protected $casts = [
        'administrasi' => 'integer',
    ];

    protected $fillable = [
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
        'form_vaksin',
    ];

    public function pendaftaran()
    {
        return $this->hasMany(Pendaftaran::class, 'id_loker', 'id_loker');
    }
}
