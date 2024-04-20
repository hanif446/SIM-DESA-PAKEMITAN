@extends('layouts.dashboard')
@section('breadcrumbs')
    {{\Diglactic\Breadcrumbs\Breadcrumbs::render('dashboard_home')}}
@endsection

@section('content')
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Data User</div>
                            <div class="h6 mb-0 font-weight-bold text-gray-800">Total: {{ $users }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Data Pegawai</div>
                            <div class="h6 mb-0 font-weight-bold text-gray-800">Total: {{ $pegawais }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-tie fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Data Penduduk</div>
                            <div class="h6 mb-0 font-weight-bold text-gray-800">Total: </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-plus fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                Data KK</div>
                            <div class="h6 mb-0 font-weight-bold text-gray-800">Total: </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>           
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-secondary">{{Auth::user()->roles->first()->name}} Dashboard</h6>
        </div>
        <center>
        <div class="card-body">
            <h5><b>Selamat Datang {{Auth::user()->username}}</b></h5>
        </div>
        <img src="{{asset('template/img/logo-kab.png')}}" width="180" height="200">
        <br>
        <br>
        <h5><b>Sistem Informasi Manajemen Desa Pakemitan</b></h5>
        <br>
    </center>
    </div>
@endsection