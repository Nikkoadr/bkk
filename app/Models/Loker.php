<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loker extends Model
{
    protected $table = 'loker';
    protected $primaryKey = 'id_loker';
    protected $guarded = [];

    public function pendaftaran()
    {
        return $this->hasMany(Pendaftaran::class, 'id_loker', 'id_loker');
    }
}
