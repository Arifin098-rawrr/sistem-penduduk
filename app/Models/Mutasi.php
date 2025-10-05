<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mutasi extends Model
{
    protected $table = 'mutasis';
    protected $primaryKey = 'id_mutasi';

    protected $fillable = [
        'id_penduduk',
        'jenis_mutasi',
        'tanggal_mutasi',
        'keterangan',
    ];

    public function penduduk()
    {
        return $this->belongsTo(Penduduk::class, 'id_penduduk');
    }
}
