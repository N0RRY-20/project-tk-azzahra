<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    protected $fillable = [
        'username',
        'password',
        'peran'
    ];
    public function guruProfil()
    {
        return $this->hasOne(GuruProfil::class, 'user_id');
    }
    public function siswaAsOrangtua()
    {
        return $this->hasOne(Siswa::class, 'id_orangtua');
    }
}
