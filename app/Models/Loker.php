<?php

namespace App\Models;

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

    /**
     * Deskripsi loker dalam bentuk teks bersih tanpa tag HTML.
     * Dipakai untuk preview di tabel admin agar tidak menampilkan markup mentah.
     */
    public function getDeskripsiPlainAttribute(): string
    {
        $html = (string) $this->deskripsi;

        // Pertahankan pemisah antar blok/baris sebelum tag dibuang.
        $text = preg_replace('/<(br|\/p|\/li|\/div|\/h[1-6])\s*\/?>/i', ' ', $html);

        $text = strip_tags((string) $text);
        $text = html_entity_decode($text, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $text = str_replace(["\xC2\xA0", "\u{00A0}"], ' ', $text);

        return trim(preg_replace('/\s+/u', ' ', $text));
    }
}
