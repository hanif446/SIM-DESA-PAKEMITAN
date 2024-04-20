@extends('layouts.dashboard')
@section('breadcrumbs')
{{Breadcrumbs::render('dashboard_galeri_edit', $galeri)}}
@endsection
@section('galeri', 'active')
@section('main_konten', 'show')
@section('content')
@include('layouts.alert')

<div class="row">
    <div class="col-md-12">
       <div class="card">
          <div class="card-body">
             <form action="{{ route('galeri.update', ['galeri' => $galeri]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="jenis_foto" class="font-weight-bold">Jenis Foto</label>
                    <select id="jenis_foto" name="jenis_foto" class="form-control @error('jenis_foto') is-invalid @enderror">
                        <option value="" selected disabled>Pilih Jenis Foto</option>
                        <option value="Kegiatan" {{ old('jenis_foto', $galeri->jenis_foto) == 'Kegiatan' ? 'selected' : '' }}>Kegiatan</option>
                        <option value="Wisata" {{ old('jenis_foto', $galeri->jenis_foto) == 'Wisata' ? 'selected' : '' }}>Wisata</option>
                    </select>
                    <!-- Error message -->
                    @error('jenis_foto')
                    <span class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="font-weight-bold">Foto</label>
                            <input type="file" name="foto" id="foto" class="form-control @error('foto') is-invalid @enderror" placeholder="Input Foto" value="{{ old('foto', $galeri->foto) }}">
                            @error('foto')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <img src="{{url('galeri/'.$galeri->foto)}}" width="150" height="200">
                    </div>
                </div>                
                
                <div class="float-right">
                    <a href="{{ route('galeri') }}" class="btn btn-warning px-3 mx-2" href="">
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
