@extends('layouts.dashboard')
@section('breadcrumbs')
{{Breadcrumbs::render('dashboard_struktur_organisasi')}}
@endsection
@section('struktur_organisasi', 'active')
@section('main_konten', 'show')
@section('content')
@include('layouts.alert')

<div class="row">
    <div class="col-md-12">
       <div class="card">
          <div class="card-body">
             <form action="{{ route('struktur_organisasi.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if ($cek_data > 0)
                    <div class="form-group">
                        <label class="font-weight-bold">Struktur Organisasi Desa</label>
                        <input type="file" name="struktur_organisasi" id="struktur_organisasi" class="form-control @error('struktur_organisasi') is-invalid @enderror" placeholder="Input struktur_organisasi Desa" value="{{ old('struktur_organisasi', $struktur_organisasi->struktur_organisasi) }}">
                        <br>
                        <a href="{{ asset('struktur_organisasi/'.$struktur_organisasi->struktur_organisasi) }}"  target="_blank">{{ $struktur_organisasi->struktur_organisasi }}</a>
                        @error('struktur_organisasi')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    
                    <div class="float-right">
                        <button type="submit" class="btn btn-warning float-right px-3">
                            Ubah
                        </button>
                    </div>
                @else
                    <div class="form-group">
                        <label class="font-weight-bold">Struktur Organisasi Desa</label>
                        
                        <input id="struktur_organisasi" value="{{old('struktur_organisasi')}}" name="struktur_organisasi" type="file" class="form-control @error('struktur_organisasi') is-invalid @enderror" placeholder="Input Struktur Organisasi"/>
                        
                        <!-- error message -->
                        @error('struktur_organisasi')
                            <span class="invalid-feedback">
                            <strong>{{$message}}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="float-right">
                        <button type="submit" class="btn btn-primary float-right px-3">
                            Simpan
                        </button>
                    </div>
                @endif
             </form>
          </div>
       </div>
    </div>
 </div>
 
@endsection
