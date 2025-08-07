<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AspekPenilaian extends Model
{
    protected $primaryKey = 'id_aspek';
    protected $table = 'aspek_penilaian';
    public function laporanPerkembangan()
    {
        return $this->hasMany(LaporanPerkembangan::class, 'id_aspek');
    }
}
