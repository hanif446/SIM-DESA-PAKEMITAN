@extends('layouts.dashboard')
@section('breadcrumbs')
{{Breadcrumbs::render('dashboard_kontak')}}
@endsection
@section('kontak', 'active')
@section('main_konten', 'show')
@section('content')
@include('layouts.alert')

<div class="row">
    <div class="col-md-12">
       <div class="card">
          <div class="card-body">
             <form action="{{ route('kontak.store') }}" method="POST">
                @csrf
                @if ($cek_data > 0)
                    <div class="form-group">
                        <label class="font-weight-bold">Alamat</label>
                        <textarea name="alamat" id="alamat" class="form-control @error('alamat') is-invalid @enderror" rows="5" placeholder="Input Alamat Desa">{{ old('alamat', $kontak->alamat) }}</textarea>
                        @error('alamat')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">No HP</label>
                        <input name="no_hp" id="no_hp" class="form-control @error('no_hp') is-invalid @enderror" placeholder="Input No HP" value="{{ old('no_hp', $kontak->no_hp) }}">
                        @error('no_hp')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">Email</label>
                        <input name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="Input Email" value="{{ old('email', $kontak->email) }}">
                        @error('email')
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
                        <label class="font-weight-bold">Alamat</label>
                        <textarea name="alamat" id="alamat" class="form-control @error('alamat') is-invalid @enderror" rows="5" placeholder="Input Alamat Desa">{{ old('alamat') }}</textarea>
                        @error('alamat')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">No HP</label>
                        <input name="no_hp" id="no_hp" class="form-control @error('no_hp') is-invalid @enderror" placeholder="Input No HP" value="{{ old('no_hp') }}">
                        @error('no_hp')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">Email</label>
                        <input name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="Input Email" value="{{ old('email') }}">
                        @error('email')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
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

