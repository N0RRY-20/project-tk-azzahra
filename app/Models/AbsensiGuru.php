<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbsensiGuru extends Model
{
    use HasFactory;

    protected $table = 'absensi_guru';
    protected $primaryKey = 'id_absensi_guru';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_guru',
        'tanggal',
        'status',
        'keterangan',
    ];

    /**
     * Relasi ke guru yang memiliki absensi ini.
     */
    public function guru()
    {
        return $this->belongsTo(GuruProfil::class, 'id_guru', 'id_guru');
    }
}
