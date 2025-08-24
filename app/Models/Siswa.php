<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $primaryKey = 'id_siswa'; // Jika nama PK bukan 'id'
    protected $table = 'siswa';

    protected $fillable  = [
        'nama_lengkap',
        'tanggal_lahir',
        'telepon_orangtua',
        'id_kelas',
        'id_orangtua',
        'kode_aktivasi',
        'riwayat_kesehatan',
        'catatan_khusus_ortu',
        'jenis_kelamin',
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
    public function absensi()
    {
        // Satu siswa memiliki banyak (hasMany) catatan absensi
        return $this->hasMany(AbsensiSiswa::class, 'id_siswa', 'id_siswa');
    }
    /**
     * Relasi ke semua pesan komunikasi yang terkait dengan siswa ini.
     */
    public function komunikasi()
    {
        return $this->hasMany(BukuKomunikasi::class, 'id_siswa', 'id_siswa');
    }

    // app/Models/Siswa.php
    public function tagihan()
    {
        // Satu siswa punya banyak tagihan
        return $this->hasMany(Tagihan::class, 'id_siswa', 'id_siswa');
    }
}
