@extends('layouts.dashboard')

@section('breadcrumbs')
    {{ Breadcrumbs::render('dashboard_surat_masuk_create') }}
@endsection

@section('surat_masuk', 'active')
@section('main_surat', 'show')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('surat_masuk.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="no_surat" class="font-weight-bold">Nomor Surat</label>
                                    <input id="no_surat" value="{{ old('no_surat') }}" name="no_surat" type="text" class="form-control @error('no_surat') is-invalid @enderror" placeholder="Input Nomor Surat"/>
                                    @error('no_surat')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tgl_surat" class="font-weight-bold">Tanggal Surat</label>
                                    <input id="tgl_surat" value="{{ old('tgl_surat') }}" name="tgl_surat" type="date" class="form-control @error('tgl_surat') is-invalid @enderror" placeholder="Input Tanggal Surat" />
                                    @error('tgl_surat')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tgl_diterima" class="font-weight-bold">Tanggal Diterima</label>
                                    <input id="tgl_diterima" value="{{ old('tgl_diterima') }}" name="tgl_diterima" type="date" class="form-control @error('tgl_diterima') is-invalid @enderror" placeholder="Input Tanggal Diterima" />
                                    @error('tgl_diterima')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="asal_surat" class="font-weight-bold">Asal Surat</label>
                                    <input id="asal_surat" value="{{ old('asal_surat') }}" name="asal_surat" type="text" class="form-control @error('asal_surat') is-invalid @enderror" placeholder="Input Asal Surat" />
                                    @error('asal_surat')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tujuan_surat" class="font-weight-bold">Tujuan Surat</label>
                                    <input id="tujuan_surat" value="{{ old('tujuan_surat') }}" name="tujuan_surat" type="text" class="form-control @error('tujuan_surat') is-invalid @enderror" placeholder="Input Tujuan Surat" />
                                    @error('tujuan_surat')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="lampiran" class="font-weight-bold">Lampiran</label>
                                    <input id="lampiran" value="{{ old('lampiran') }}" name="lampiran" type="text" class="form-control @error('lampiran') is-invalid @enderror" placeholder="Input Lampiran" />
                                    @error('lampiran')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="perihal" class="font-weight-bold">Perihal</label>
                                    <input id="perihal" value="{{ old('perihal') }}" name="perihal" type="text" class="form-control @error('perihal') is-invalid @enderror" placeholder="Input Perihal" />
                                    @error('perihal')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="file_surat" class="font-weight-bold">File Surat</label>
                                    <input id="file_surat" name="file_surat" type="file" class="form-control-file @error('file_surat') is-invalid @enderror" />
                                    @error('file_surat')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-warning px-3 mx-2" href="{{ route('surat_masuk.index') }}">Kembali</a>
                            <button type="submit" class="btn btn-primary float-right px-3">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
