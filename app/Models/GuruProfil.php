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
}
