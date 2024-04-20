@extends('layouts.dashboard')
@section('breadcrumbs')
{{Breadcrumbs::render('dashboard_agenda_create')}}
@endsection
@section('agenda', 'active')
@section('main_konten', 'show')
@section('content')
@include('layouts.alert')

<div class="row">
    <div class="col-md-12">
       <div class="card">
          <div class="card-body">
             <form action="{{ route('agenda.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="form-group">
                    <label for="input_judul" class="font-weight-bold">
                        Judul
                    </label>
                    <input id="input_judul" value="{{old('judul')}}" name="judul" type="text" class="form-control @error('judul') is-invalid @enderror" placeholder="Input Judul" />
                    <!-- error message -->
                    @error('judul')
                      <span class="invalid-feedback">
                        <strong>{{$message}}</strong>
                      </span>
                    @enderror
               </div>

               <div class="form-group">
                    <label for="input_deskripsi" class="font-weight-bold">
                        Deskripsi
                    </label>
                    <textarea class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" placeholder="Input Deskripsi">{{old('deskripsi')}}</textarea>
                    <!-- error message -->
                    @error('deskripsi')
                    <span class="invalid-feedback">
                        <strong>{{$message}}</strong>
                    </span>
                    @enderror
                </div>
               
                <div class="form-group">
                    <label class="font-weight-bold">Tanggal Kegiatan</label>
                    
                    <input id="tgl_kegiatan" value="{{old('tgl_kegiatan')}}" name="tgl_kegiatan" type="date" class="form-control @error('tgl_kegiatan') is-invalid @enderror" placeholder="Input tgl_kegiatan"/>
                    <!-- error message -->
                    @error('tgl_kegiatan')
                        <span class="invalid-feedback">
                        <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="font-weight-bold">Waktu Mulai</label>
                            
                            <input id="waktu_mulai" value="{{old('waktu_mulai')}}" name="waktu_mulai" type="time" class="form-control @error('waktu_mulai') is-invalid @enderror" placeholder="Input Waktu Mulai"/>
                            <!-- error message -->
                            @error('waktu_mulai')
                                <span class="invalid-feedback">
                                <strong>{{$message}}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="font-weight-bold">Waktu Selesai</label>
                            <input id="waktu_selesai" value="{{old('waktu_selesai')}}" name="waktu_selesai" type="time" class="form-control @error('waktu_selesai') is-invalid @enderror" placeholder="Input Waktu Selesai"/>
                            <!-- error message -->
                            @error('waktu_selesai')
                                <span class="invalid-feedback">
                                <strong>{{$message}}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="input_tempat" class="font-weight-bold">
                        Tempat
                    </label>
                    <textarea class="form-control @error('tempat') is-invalid @enderror" name="tempat" placeholder="Input Tempat">{{old('tempat')}}</textarea>
                    <!-- error message -->
                    @error('tempat')
                    <span class="invalid-feedback">
                        <strong>{{$message}}</strong>
                    </span>
                    @enderror
                </div>

                <div class="float-right">
                    <a href="{{ route('agenda.index') }}" class="btn btn-warning px-3 mx-2" href="">
                        Kembali
                     </a>
                    <button type="submit" class="btn btn-primary float-right px-3">
                        Simpan
                    </button>
                </div>
             </form>
          </div>
       </div>
    </div>
 </div>
 
@endsection
