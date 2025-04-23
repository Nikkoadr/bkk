<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    protected $guarded = [];
    protected $table = 'pendaftaran';

    public function loker()
    {
        return $this->belongsTo(Loker::class, 'id_loker', 'id_loker');
    }
}
