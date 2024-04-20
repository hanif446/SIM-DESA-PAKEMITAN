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

        return view('dashboard.index', [
            'users' => $users,
            'pegawais' => $pegawais
        ]);
    }
}
