<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rpph extends Model
{
    protected $table = 'rpph';
    protected $primaryKey = 'id_rpph';
    protected $fillable = [
        'id_rppm',
        'tanggal',
        'kegiatan_pembuka',
        'kegiatan_inti',
        'kegiatan_penutup',
        'alat_dan_bahan',
    ];

    public function rppm()
    {
        return $this->belongsTo(Rppm::class, 'id_rppm', 'id_rppm');
    }
}
