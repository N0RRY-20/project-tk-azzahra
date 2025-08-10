<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaporanPerkembangan extends Model
{
    protected $primaryKey = 'id_laporan';
    protected $table = 'laporan_perkembangan';
    protected $fillable = [
        'id_siswa',
        'id_guru',
        'id_aspek',
        'capaian',
        'catatan_guru',
        'tanggal_laporan',
    ];
    

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa');
    }

    public function guru()
    {
        return $this->belongsTo(GuruProfil::class, 'id_guru');
    }

    public function aspek()
    {
        return $this->belongsTo(AspekPenilaian::class, 'id_aspek');
    }
}
