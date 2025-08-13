<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'events';
    protected $primaryKey = 'id_event';
    protected $fillable = ['judul', 'deskripsi', 'tanggal_event'];

    /**
     * Satu event memiliki banyak jenis lomba.
     */
    public function lomba()
    {
        return $this->hasMany(EventLomba::class, 'id_event', 'id_event');
    }
}
