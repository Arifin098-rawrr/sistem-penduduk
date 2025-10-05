<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penduduk extends Model
{
    protected $table = 'penduduks';
    protected $primaryKey = 'id_penduduk';

    protected $fillable = [
        'nik',
        'nama',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'agama',
        'kewarganegaraan',
        'alamat',
        'rt_rw',
        'kel_desa',
        'kecamatan',
        'pendidikan',
        'pekerjaan',
        'status_perkawinan',
        'hubungan_keluarga',
        'id_kk',
    ];

    public function kk()
    {
        return $this->belongsTo(Kk::class, 'id_kk');
    }

    public function mutasi()
    {
        return $this->hasMany(Mutasi::class, 'id_penduduk');
    }
    public function surat()
    {
        return $this->hasMany(Surat::class, 'penduduk_id');
    }
}
