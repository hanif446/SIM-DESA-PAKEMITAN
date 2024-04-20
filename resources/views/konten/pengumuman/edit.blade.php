@extends('layouts.dashboard')
@section('breadcrumbs')
{{Breadcrumbs::render('dashboard_pengumuman_edit', $pengumuman)}}
@endsection
@section('pengumuman', 'active')
@section('main_konten', 'show')
@section('content')
@include('layouts.alert')

<div class="row">
    <div class="col-md-12">
       <div class="card">
          <div class="card-body">
             <form action="{{ route('pengumuman.update', ['pengumuman' => $pengumuman]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="input_judul" class="font-weight-bold">
                        Judul
                    </label>
                    <input id="input_judul" value="{{old('judul', $pengumuman->judul)}}" name="judul" type="text" class="form-control @error('judul') is-invalid @enderror" placeholder="Input Judul" />
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
                    <textarea class="form-control @error('isi_pengumuman') is-invalid @enderror" name="isi_pengumuman" placeholder="Input Isi Pengumuman">{{old('isi_pengumuman', $pengumuman->isi_pengumuman)}}</textarea>
                    <!-- error message -->
                    @error('isi_pengumuman')
                    <span class="invalid-feedback">
                        <strong>{{$message}}</strong>
                    </span>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="font-weight-bold">Gambar</label>
                            <input id="gambar" value="{{old('gambar', $pengumuman->gambar)}}" name="gambar" type="file" class="form-control @error('gambar') is-invalid @enderror" placeholder="Input Gambar"/>
                            <!-- error message -->
                            @error('gambar')
                                <span class="invalid-feedback">
                                <strong>{{$message}}</strong>
                                </span>
                            @enderror
                        </div>        
                    </div>
                    <div class="col-md-6">
                        <img src="{{url('pengumuman/'.$pengumuman->gambar)}}" width="150" height="200">
                    </div>
                </div>
               
                <div class="form-group">
                    <label for="input_penerbit" class="font-weight-bold">
                        Penerbit
                    </label>
                    <input id="input_penerbit" value="{{old('penerbit', $pengumuman->penerbit)}}" name="penerbit" type="text" class="form-control @error('penerbit') is-invalid @enderror" placeholder="Input Penerbit" />
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
                    <button type="submit" class="btn btn-success float-right px-3">
                        Ubah
                    </button>
                </div>
             </form>
          </div>
       </div>
    </div>
 </div>
 
@endsection