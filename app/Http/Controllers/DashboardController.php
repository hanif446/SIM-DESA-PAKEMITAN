<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $users = DB::table('users')->count();
        $pegawais = DB::table('pegawais')->count();
        $penduduk = DB::table('penduduk')->count();
        $kk = DB::table('kk')->count();
        $jumlah_laki_laki = DB::table('penduduk')->where('jk', '=', 'Laki-laki')->count();
        $jumlah_perempuan = DB::table('penduduk')->where('jk', '=', 'Perempuan')->count();

        // Mendapatkan jumlah penduduk berdasarkan pekerjaan
        $jumlah_penduduk_per_pekerjaan = DB::table('penduduk')
            ->select('pekerjaan', DB::raw('COUNT(*) as total'))
            ->groupBy('pekerjaan')
            ->get();

        // Mendapatkan label pekerjaan dan jumlah penduduk untuk setiap pekerjaan
        $pekerjaanLabels = $jumlah_penduduk_per_pekerjaan->pluck('pekerjaan')->toArray();
        $jumlahPenduduk = $jumlah_penduduk_per_pekerjaan->pluck('total')->toArray();

        return view('dashboard.index', [
            'users' => $users,
            'pegawais' => $pegawais,
            'penduduk' => $penduduk,
            'kk' => $kk,
            'jumlah_laki_laki'=>$jumlah_laki_laki,
            'jumlah_perempuan'=>$jumlah_perempuan,
            'pekerjaanLabels' => $pekerjaanLabels,
            'jumlahPenduduk' => $jumlahPenduduk
        ]);
    }
}
