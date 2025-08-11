<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalKegiatan extends Model
{
    use HasFactory;

    protected $table = 'jadwal_kegiatan';
    protected $primaryKey = 'id_jadwal';

    protected $fillable = [
        'id_kelas',
        'hari',
        'waktu_mulai',
        'waktu_selesai',
        'kegiatan',
        'keterangan',
    ];
    /**
     * Relasi ke kelas yang memiliki jadwal ini.
     */
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id_kelas');
    }
}
