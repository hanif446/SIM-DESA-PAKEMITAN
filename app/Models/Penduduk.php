<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penduduk extends Model
{
    use HasFactory;

    protected $table = 'penduduk';
    protected $fillable = [
        'nik',
        'nama',
        'jk',
        'tempat_lahir',
        'tanggal_lahir',
        'agama',
        'pendidikan',
        'pekerjaan',
        'gol_darah',
        'status_kawin',
        'tgl_kawin',
        'kewarganegaraan',
        'nama_ayah',
        'nama_ibu'
    ];
}
