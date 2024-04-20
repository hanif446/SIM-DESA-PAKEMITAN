@extends('layouts.dashboard')
@section('breadcrumbs')
{{Breadcrumbs::render('dashboard_galeri_create')}}
@endsection
@section('galeri', 'active')
@section('main_konten', 'show')
@section('content')
@include('layouts.alert')

<div class="row">
    <div class="col-md-12">
       <div class="card">
          <div class="card-body">
             <form action="{{ route('galeri.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="jenis_foto" class="font-weight-bold">Jenis Foto</label>
                    <select id="jenis_foto" name="jenis_foto" class="form-control @error('jenis_foto') is-invalid @enderror">
                        <option value="" selected disabled>Pilih Jenis Foto</option>
                        <option value="Kegiatan" {{ old('jenis_foto') == 'Kegiatan' ? 'selected' : '' }}>Kegiatan</option>
                        <option value="Wisata" {{ old('jenis_foto') == 'Wisata' ? 'selected' : '' }}>Wisata</option>
                    </select>
                    <!-- Error message -->
                    @error('jenis_foto')
                    <span class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            
                <div class="form-group">
                    <label class="font-weight-bold">Foto</label>
                    
                    <input id="foto" value="{{old('foto')}}" name="foto" type="file" class="form-control @error('foto') is-invalid @enderror" placeholder="Input Foto"/>
                    <!-- error message -->
                    @error('foto')
                        <span class="invalid-feedback">
                        <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>

                <div class="float-right">
                    <a href="{{ route('galeri') }}" class="btn btn-warning px-3 mx-2" href="">
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
