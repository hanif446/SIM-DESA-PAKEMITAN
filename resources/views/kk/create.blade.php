@extends('layouts.dashboard')

@section('breadcrumbs')
    {{ Breadcrumbs::render('dashboard_kk_create') }}
@endsection

@section('kk', 'active')
@section('main_penduduk', 'show')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('kk.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="no_kk" class="font-weight-bold">No KK</label>
                            <input id="no_kk" value="{{ old('no_kk') }}" name="no_kk" type="text" class="form-control @error('no_kk') is-invalid @enderror" onkeypress="return event.charCode>=48 && event.charCode<=57"  placeholder="Input No KK"/>
                            @error('no_kk')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="nama_kepala_keluarga" class="font-weight-bold">Nama Kepala Keluarga</label>
                            <input id="nama_kepala_keluarga" value="{{ old('nama_kepala_keluarga') }}" name="nama_kepala_keluarga" type="text" class="form-control @error('nama_kepala_keluarga') is-invalid @enderror" placeholder="Input Nama Kepala Keluarga" />
                            @error('nama_kepala_keluarga')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="input_pegawai_alamat" class="font-weight-bold">
                                Alamat
                            </label>
                            <textarea class="form-control @error('alamat') is-invalid @enderror" name="alamat" placeholder="Input Alamat">{{old('alamat')}}</textarea>
                            <!-- error message -->
                            @error('alamat')
                              <span class="invalid-feedback">
                                <strong>{{$message}}</strong>
                              </span>
                            @enderror
                       </div>
                        
                        <div class="float-right">
                            <a class="btn btn-warning px-3 mx-2" href="{{ route('kk.index') }}">Kembali</a>
                            <button type="submit" class="btn btn-primary float-right px-3">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
