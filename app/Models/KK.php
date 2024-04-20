<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KK extends Model
{
    use HasFactory;

    protected $table = 'kk';
    protected $fillable = [
        'no_kk',
        'nama_kepala_keluarga',
        'alamat'
    ];

}
