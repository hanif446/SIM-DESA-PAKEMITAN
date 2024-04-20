<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnggotaKK extends Model
{
    use HasFactory;

    protected $table = 'anggota_kk';

    protected $fillable = [
        'penduduk_id',
        'kk_id',
        'hubungan_keluarga'
    ];

    public function penduduk(){
        return $this->belongsTo(Penduduk::class, 'penduduk_id');
    }

    public function kk(){
        return $this->belongsTo(KK::class, 'kk_id');
    }
}
