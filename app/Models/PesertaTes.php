<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PesertaTes extends Model
{
    protected $table = 'peserta_tes';

    protected $fillable = [
        'no_tes',
        'nama_lengkap',
        'asal_sekolah',
        'email',
        'hari',
        'waktu',
        'perangkat',
        'link',
    ];
}
