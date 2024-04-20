@extends('layouts.dashboard')
@section('breadcrumbs')
{{Breadcrumbs::render('dashboard_pengumuman_create')}}
@endsection
@section('pengumuman', 'active')
@section('main_konten', 'show')
@section('content')
@include('layouts.alert')

<div class="row">
    <div class="col-md-12">
       <div class="card">
          <div class="card-body">
             <form action="{{ route('pengumuman.store') }}" method="POST" enctype="multipart/form-data">
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
                    <label for="input_isi_pengumuman" class="font-weight-bold">
                        Isi Pengumuman
                    </label>
                    <textarea class="form-control @error('isi_pengumuman') is-invalid @enderror" name="isi_pengumuman" placeholder="Input Isi Pengumuman">{{old('isi_pengumuman')}}</textarea>
                    <!-- error message -->
                    @error('isi_pengumuman')
                    <span class="invalid-feedback">
                        <strong>{{$message}}</strong>
                    </span>
                    @enderror
                </div>
               
                <div class="form-group">
                    <label class="font-weight-bold">Gambar</label>
                    
                    <input id="gambar" value="{{old('gambar')}}" name="gambar" type="file" class="form-control @error('gambar') is-invalid @enderror" placeholder="Input Gambar"/>
                    <!-- error message -->
                    @error('gambar')
                        <span class="invalid-feedback">
                        <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="input_penerbit" class="font-weight-bold">
                        Penerbit
                    </label>
                    <input id="input_penerbit" value="{{old('penerbit')}}" name="penerbit" type="text" class="form-control @error('penerbit') is-invalid @enderror" placeholder="Input Penerbit" />
                    <!-- error message -->
                    @error('penerbit')
                      <span class="invalid-feedback">
                        <strong>{{$message}}</strong>
                      </span>
                    @enderror
               </div>

                <div class="float-right">
                    <a href="{{ route('pengumuman.index') }}" class="btn btn-warning px-3 mx-2" href="">
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
