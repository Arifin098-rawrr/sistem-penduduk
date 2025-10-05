<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    use HasFactory;

    protected $fillable = [
        'penduduk_id',
        'admin_id', 
        'jenis_surat',
        'nomor_surat',
        'tanggal_surat',
        'keperluan'
    ];
    public function penduduk()
    {
        return $this->belongsTo(Penduduk::class, 'penduduk_id', 'id_penduduk');
    }
    
    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id', 'id_user');
    }
}
