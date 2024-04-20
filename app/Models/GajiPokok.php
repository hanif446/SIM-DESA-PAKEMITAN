<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GajiPokok extends Model
{
    use HasFactory;

    protected $fillable = ['pegawai_id', 'bulan_gaji', 'tahun_gaji', 'jumlah_gaji'];

    public function pegawai(){
        return $this->belongsTo(Pegawai::class, 'pegawai_id');
    }
}
