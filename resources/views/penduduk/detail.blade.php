@extends('layouts.dashboard')

@section('breadcrumbs')
    {{ Breadcrumbs::render('dashboard_penduduk_detail', $penduduk) }}
@endsection

@section('penduduk', 'active')
@section('main_penduduk', 'show')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4>
                        <strong>Data Penduduk</strong>
                    </h4>
                    <br>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="font-weight-bold">
                                    NIK
                                </label>
                                <label>:</label>
                                {{ $penduduk->nik }}
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">
                                    Nama
                                </label>
                                <label>:</label>
                                {{ $penduduk->nama }}
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">
                                    Jenis Kelamin
                                </label>
                                <label>:</label>
                                {{ $penduduk->jk }}
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">
                                    Tempat Lahir
                                </label>
                                <label>:</label>
                                {{ $penduduk->tempat_lahir }}
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">
                                    Tanggal Lahir
                                </label>
                                <label>:</label>
                                {{ $penduduk->tanggal_lahir }}
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">
                                    Agama
                                </label>
                                <label>:</label>
                                {{ $penduduk->agama }}
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">
                                    Pendidikan
                                </label>
                                <label>:</label>
                                {{ $penduduk->pendidikan }}
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="font-weight-bold">
                                    Pekerjaan
                                </label>
                                <label>:</label>
                                {{ $penduduk->pekerjaan }}
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">
                                    Golongan Darah
                                </label>
                                <label>:</label>
                                {{ $penduduk->gol_darah }}
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">
                                    Status Kawin
                                </label>
                                <label>:</label>
                                {{ $penduduk->status_kawin }}
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">
                                    Tanggal Kawin
                                </label>
                                <label>:</label>
                                @if ($penduduk->tgl_kawin)
                                    {{ $penduduk->tgl_kawin }}
                                @else
                                    -
                                @endif
                            </div>                            
                            <div class="form-group">
                                <label class="font-weight-bold">
                                    Kewarganegaraan
                                </label>
                                <label>:</label>
                                {{ $penduduk->kewarganegaraan }}
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">
                                    Nama Ayah
                                </label>
                                <label>:</label>
                                {{ $penduduk->nama_ayah }}
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">
                                    Nama Ibu
                                </label>
                                <label>:</label>
                                {{ $penduduk->nama_ibu }}
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <a href="{{ route('penduduk.index') }}" class="btn btn-warning mx-1" role="button">
                            Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
