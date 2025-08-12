<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $table = 'pembayaran';
    protected $primaryKey = 'id_pembayaran';

    protected $fillable = [
        'id_tagihan',
        'tanggal_bayar',
        'jumlah_bayar',
        'metode_bayar',
        'catatan_admin',
        'id_admin',
    ];

    public function tagihan()
    {
        return $this->belongsTo(Tagihan::class, 'id_tagihan', 'id_tagihan');
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'id_admin');
    }
}
