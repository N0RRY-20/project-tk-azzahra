<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ATP extends Model
{
    use HasFactory;

    protected $table = 'atp';
    protected $primaryKey = 'id_atp';

    protected $fillable = [
        'tahun_ajaran',
        'semester',
        'fase_perkembangan',
        'elemen_kurikulum',
        'tujuan_pembelajaran',
        'urutan',
    ];
}
