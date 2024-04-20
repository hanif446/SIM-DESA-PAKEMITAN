@extends('layouts.dashboard')

@section('breadcrumbs')
    {{Breadcrumbs::render('dashboard_pegawai_detail', $pegawai)}}
@endsection
@section('pegawai', 'active')
@section('main', 'show')
@section('content')
    <div class="row">
      <div class="col-md-12">
         <div class="card">
            <div class="card-body">
                <h4>
                    <strong>Data Pegawai</strong>
                </h4>
                <br>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="font-weight-bold">
                                 NIP
                            </label>
                            <label>:</label>
                            {{ $pegawai->nip }}
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">
                                 Nama Pegawai
                            </label>
                            <label>:</label>
                            {{ $pegawai->nama_pegawai }}
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">
                                 Jabatan
                            </label>
                            <label>:</label>
                            {{ $pegawai->jabatan }}
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">
                                 Tempat Lahir
                            </label>
                            <label>:</label>
                            {{ $pegawai->tempat_lhr }}
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">
                                 Tanggal Lahir
                            </label>
                            <label>:</label>
                            {{ $pegawai->tgl_lhr }}
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="font-weight-bold">
                                 No HP
                            </label>
                            <label>:</label>
                            {{ $pegawai->no_hp }}
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">
                                 Alamat
                            </label>
                            <label>:</label>
                            {{ $pegawai->alamat }}     
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">
                                 Pendidikan Terakhir
                            </label>
                            <label>:</label>
                            {{ $pegawai->pendidikan_terakhir }}
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">
                                No SK Pengangkatan
                            </label>
                            <label>:</label>
                            {{ $pegawai->no_sk_pengangkatan}}     
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">
                                Tahun SK Pengangkatan
                            </label>
                            <label>:</label>
                            {{ $pegawai->thn_sk_pengangkatan }}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <img  src="{{url('pegawai/'.$pegawai->foto)}}" width="150" height="200">
                    </div>
                </div>

               <div class="d-flex justify-content-end">
                  <a href="{{ route('pegawai.index') }}" class="btn btn-warning mx-1" role="button">
                     Kembali
                  </a>
               </div>
            </div>
         </div>
      </div>
   </div>
@endsection