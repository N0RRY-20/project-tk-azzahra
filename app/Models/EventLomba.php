<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventLomba extends Model
{
    protected $table = 'event_lomba';
    protected $primaryKey = 'id_lomba';
    protected $fillable = [
        'id_event',
        'nama_lomba',
        'keterangan',
        'kuota'
    ];

    /**
     * Satu lomba dimiliki oleh satu event.
     */
    public function event()
    {
        return $this->belongsTo(Event::class, 'id_event', 'id_event');
    }

    /**
     * Satu lomba memiliki banyak pendaftar.
     */
    public function pendaftaran()
    {
        return $this->hasMany(PendaftaranLomba::class, 'id_lomba', 'id_lomba');
    }
}
