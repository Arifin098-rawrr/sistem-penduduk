<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'users';
    protected $primaryKey = 'id_user';

    protected $fillable = [
        'username',
        'password',
        'rt_rw',
        'kelurahan',
        'kecamatan',
        'kota',
        'foto',
    ];
    public function surats()
    {
        return $this->hasMany(Surat::class, 'admin_id', 'id_user');
    }
    
    protected $hidden = [
        'password',
    ];
}
