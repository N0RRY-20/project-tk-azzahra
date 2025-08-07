<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $primaryKey = 'id_siswa'; // Jika nama PK bukan 'id'
    protected $table = 'siswa';

    protected $fillable  = [
        'nama_lengkap',
        'id_kelas',
        'tanggal_lahir'
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }

    public function orangtua()
    {
        return $this->belongsTo(User::class, 'id_orangtua');
    }

    public function laporanPerkembangan()
    {
        return $this->hasMany(LaporanPerkembangan::class, 'id_siswa');
    }
}
