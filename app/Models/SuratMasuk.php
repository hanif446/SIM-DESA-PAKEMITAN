<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratMasuk extends Model
{
    use HasFactory;

    protected $table = 'surat_masuk';
    protected $fillable = [
        'no_surat',
        'tgl_surat',
        'tgl_diterima',
        'asal_surat',
        'tujuan_surat',
        'lampiran',
        'perihal',
        'file_surat'
    ];
}
