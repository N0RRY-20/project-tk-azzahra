<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $primaryKey = 'id_kelas';
    protected $table = 'kelas';
    protected $fillable = [
        'nama_kelas',
        'id_guru_wali'
    ];
    public function siswa()
    {
        return $this->hasMany(Siswa::class, 'id_kelas');
    }
     public function waliKelas()
    {
        return $this->belongsTo(GuruProfil::class, 'id_guru_wali', 'id_guru');
    }
}
