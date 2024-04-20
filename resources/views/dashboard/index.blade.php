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
                            <div class="h6 mb-0 font-weight-bold text-gray-800">Total: {{ $penduduk }}</div>
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
                            <div class="h6 mb-0 font-weight-bold text-gray-800">Total: {{ $kk }}</div>
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
    <!-- Tambahkan elemen canvas untuk menampilkan diagram lingkaran -->
    <div class="container">
        <canvas id="myChart" width="400" height="400"></canvas>
    </div>
    <br><br>
    <!-- Tambahkan elemen canvas untuk menampilkan diagram batang -->
    <div class="container">
        <canvas id="myChartPekerjaan" width="400" height="200"></canvas>
    </div>
@endsection

@push('javascript-internal')
    <!-- Tambahkan library Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // Data penduduk berdasarkan jenis kelamin
        var data = {
            labels: ["Laki-laki", "Perempuan"],
            datasets: [{
                data: [{{$jumlah_laki_laki}}, {{$jumlah_perempuan}}],
                backgroundColor: [
                    'blue',
                    'pink'
                ],
                hoverOffset: 4
            }]
        };

        // Konfigurasi diagram
        var options = {
            responsive: true,
            maintainAspectRatio: false,
        };

        // Inisialisasi diagram lingkaran
        var ctx = document.getElementById('myChart').getContext('2d');
        var myPieChart = new Chart(ctx, {
            type: 'pie',
            data: data,
            options: {
                ...options,
                plugins: {
                    title: {
                        display: true,
                        text: 'Jumlah Penduduk Berdasarkan Jenis Kelamin',
                        font: {
                            size: 16
                        }
                    }
                }
            }
        });

        var dataPekerjaan = {
            labels: {!! json_encode($pekerjaanLabels) !!}, // Label pekerjaan
            datasets: [{
                label: 'Jumlah Penduduk',
                data: {!! json_encode($jumlahPenduduk) !!}, // Jumlah penduduk berdasarkan pekerjaan
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                ],
                borderWidth: 1
            }]
        };

        // Konfigurasi diagram
        var optionsPekerjaan = {
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 5, // Langkah kelipatan
                        precision: 0, // Tanpa desimal
                    }
                }
            },
            plugins: {
                title: {
                    display: true,
                    text: 'Jumlah Penduduk Berdasarkan Pekerjaan',
                    font: {
                        size: 16
                    }
                }
            }
        };

        // Inisialisasi diagram batang
        var ctxPekerjaan = document.getElementById('myChartPekerjaan').getContext('2d');
        var myBarChart = new Chart(ctxPekerjaan, {
            type: 'bar',
            data: dataPekerjaan,
            options: optionsPekerjaan
        });
    </script>
@endpush
