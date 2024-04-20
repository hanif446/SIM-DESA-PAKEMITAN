<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayaran';

    protected $fillable = [
        'kk_id',
        'jenis_pembayaran',
        'total_pembayaran',
        'keterangan'
    ];

    public function kk(){
        return $this->belongsTo(KK::class, 'kk_id');
    }
}
