@extends('layouts.dashboard')

@section('breadcrumbs')
    {{ Breadcrumbs::render('dashboard_surat_keluar_detail', $surat_keluar) }}
@endsection

@section('surat_keluar', 'active')
@section('main_surat', 'show')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4>
                        <strong>Data Surat Keluar</strong>
                    </h4>
                    <br>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="font-weight-bold">
                                    Nomor Surat
                                </label>
                                <label>:</label>
                                {{ $surat_keluar->no_surat }}
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">
                                    Tanggal Surat
                                </label>
                                <label>:</label>
                                {{ date('d F Y', strtotime($surat_keluar->tgl_surat)) }}
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">
                                    Asal Surat
                                </label>
                                <label>:</label>
                                {{ $surat_keluar->asal_surat }}
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">
                                    Tujuan Surat
                                </label>
                                <label>:</label>
                                {{ $surat_keluar->tujuan_surat }}
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">
                                    Lampiran
                                </label>
                                <label>:</label>
                                {{ $surat_keluar->lampiran }}
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="font-weight-bold">
                                    Perihal
                                </label>
                                <label>:</label>
                                {{ $surat_keluar->perihal }}
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">
                                    File Surat
                                </label>
                                <label>:</label>
                                <!-- Tampilkan link untuk mengunduh file surat -->
                                @if($surat_keluar->file_surat)
                                    <a href="{{ asset('surat_keluar/'.$surat_keluar->file_surat) }}" target="_blank">{{ $surat_keluar->file_surat }}</a>
                                @else
                                    -
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <a href="{{ route('surat_keluar.index') }}" class="btn btn-warning mx-1" role="button">
                            Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
