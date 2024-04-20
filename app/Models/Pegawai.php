<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;
    protected $fillable = ['nip', 'nama_pegawai', 'jabatan', 'tempat_lhr', 'tgl_lhr', 'no_hp', 'alamat', 'pendidikan_terakhir', 'no_sk_pengangkatan', 'thn_sk_pengangkatan', 'foto'];

    /*public function scopeSearch($query, $nama_pegawai)
    {
        return $query->where('nama_pegawai',"LIKE", "%{$nama_pegawai}%");
    }*/
}
