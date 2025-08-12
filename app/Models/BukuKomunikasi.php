<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BukuKomunikasi extends Model
{
    use HasFactory;

    protected $table = 'buku_komunikasi';
    protected $primaryKey = 'id_komunikasi';

    protected $fillable = [
        'id_siswa',
        'id_pengirim',
        'pesan',
        'sudah_dibaca',
    ];
    /**
     * Relasi ke siswa yang pesannya ditujukan.
     */
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa', 'id_siswa');
    }

    /**
     * Relasi ke pengguna (guru/orang tua) yang mengirim pesan.
     */
    public function pengirim()
    {
        return $this->belongsTo(User::class, 'id_pengirim');
    }
}
