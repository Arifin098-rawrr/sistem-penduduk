<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kk extends Model
{
    protected $table = 'kks';
    protected $primaryKey = 'id_kk';

    protected $fillable = [
        'no_kk',
        'nama_kepala_keluarga',
        'alamat',
        'rt_rw',
    ];

    public function penduduks()
    {
        return $this->hasMany(Penduduk::class, 'id_kk');
    }
}
