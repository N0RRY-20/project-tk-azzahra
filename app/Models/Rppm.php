<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rppm extends Model
{
    protected $table = 'rppm';
    protected $primaryKey = 'id_rppm';
    protected $fillable = [
        'id_guru',
        'id_kelas',
        'tahun_ajaran',
        'semester',
        'bulan',
        'minggu_ke',
        'tema',
        'sub_tema',
    ];

    public function guru()
    {
        return $this->belongsTo(GuruProfil::class, 'id_guru', 'id_guru');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id_kelas');
    }

    public function rpph()
    {
        return $this->hasMany(Rpph::class, 'id_rppm', 'id_rppm');
    }
}
