<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PendaftaranLomba extends Model
{
    protected $table = 'pendaftaran_lomba';
    protected $primaryKey = 'id_pendaftaran';
    protected $fillable = ['id_lomba', 'id_orangtua', 'nama_pendaftar', 'status_pendaftar',];

    /**
     * Satu pendaftaran dimiliki oleh satu lomba.
     */
    public function lomba()
    {
        return $this->belongsTo(EventLomba::class, 'id_lomba', 'id_lomba');
    }

    /**
     * Satu pendaftaran dimiliki oleh satu orang tua (user).
     */
    public function orangtua()
    {
        return $this->belongsTo(User::class, 'id_orangtua');
    }
}
