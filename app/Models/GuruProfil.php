<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GuruProfil extends Model
{

    protected $primaryKey = 'id_guru';
    protected $table = 'guru_profils';
    protected $fillable = [
        'nama_lengkap',
        'telepon'
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function laporanPerkembangan()
    {
        return $this->hasMany(LaporanPerkembangan::class, 'id_guru');
    }
    public function absensi()
    {
        // Satu guru memiliki banyak (hasMany) catatan absensi
        return $this->hasMany(AbsensiGuru::class, 'id_guru', 'id_guru');
    }
    public function rppm()
    {
        // Satu guru bisa memiliki banyak (hasMany) RPPM
        return $this->hasMany(Rppm::class, 'id_guru', 'id_guru');
    }
}
