@extends('layouts.dashboard')

@section('breadcrumbs')
    {{Breadcrumbs::render('dashboard_pegawai_edit', $pegawai)}}
@endsection
@section('pegawai', 'active')
@section('main', 'show')
@section('content')
<div class="row">
       <div class="col-md-12">
          <div class="card">
             <div class="card-body">
                <form action="{{ route('pegawai.update', ['pegawai' => $pegawai]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <!-- nip -->
                            <div class="form-group">
                                <label for="input_pegawai_nip" class="font-weight-bold">
                                    NIP
                                </label>
                                <input id="input_pegawai_nip" value="{{old('nip', $pegawai->nip)}}" name="nip" type="text" class="form-control @error('nip') is-invalid @enderror" placeholder="Input NIP"/>
                                <!-- error message -->
                                @error('nip')
                                  <span class="invalid-feedback">
                                    <strong>{{$message}}</strong>
                                  </span>
                                @enderror
                           </div>
                        </div>
                        <div class="col-md-6">
                            <!-- name -->
                            <div class="form-group">
                                <label for="input_pegawai_nama" class="font-weight-bold">
                                    Nama Pegawai
                                </label>
                                <input id="input_pegawai_nama" value="{{old('nama_pegawai', $pegawai->nama_pegawai)}}" name="nama_pegawai" type="text" class="form-control @error('nama_pegawai') is-invalid @enderror" placeholder="Input Nama Pegawai" />
                                <!-- error message -->
                                @error('nama_pegawai')
                                  <span class="invalid-feedback">
                                    <strong>{{$message}}</strong>
                                  </span>
                                @enderror
                           </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <!-- tempat_lahir -->
                            <div class="form-group">
                                <label for="input_pegawai_tempat_lhr" class="font-weight-bold">
                                    Tempat lahir
                                </label>
                                <input id="input_pegawai_tempat_lhr" value="{{old('tempat_lhr', $pegawai->tempat_lhr)}}" name="tempat_lhr" type="text" class="form-control @error('tempat_lhr') is-invalid @enderror" placeholder="Input Tempat Lahir" />
                                <!-- error message -->
                                @error('tempat_lhr')
                                  <span class="invalid-feedback">
                                    <strong>{{$message}}</strong>
                                  </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <!-- tgl_lhr -->
                            <div class="form-group">
                                <label for="input_pegawai_tgl_lhr" class="font-weight-bold">
                                    Tanggal Lahir
                                </label>
                                <input id="input_pegawai_tgl_lhr" value="{{old('tgl_lhr', $pegawai->tgl_lhr)}}" name="tgl_lhr" type="date" class="form-control @error('tgl_lhr') is-invalid @enderror" placeholder="Input Tanggal Lahir" />
                                <!-- error message -->
                                @error('tgl_lhr')
                                  <span class="invalid-feedback">
                                    <strong>{{$message}}</strong>
                                  </span>
                                @enderror
                           </div>
                        </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <!-- jabatan -->
                        <div class="form-group">
                            <label for="input_pegawai_jabatan" class="font-weight-bold">
                                Jabatan
                            </label>
                            <input id="input_pegawai_jabatan" value="{{old('jabatan', $pegawai->jabatan)}}" name="jabatan" type="text" class="form-control @error('jabatan') is-invalid @enderror" placeholder="Input Jabatan" />
                            <!-- error message -->
                            @error('jabatan')
                              <span class="invalid-feedback">
                                <strong>{{$message}}</strong>
                              </span>
                            @enderror
                       </div>
                    </div>
                        <div class="col-md-6">
                            <!-- no_hp -->
                            <div class="form-group">
                                <label for="input_pegawai_no_hp" class="font-weight-bold">
                                    No HP
                                </label>
                                <input id="input_pegawai_no_hp" value="{{old('no_hp', $pegawai->no_hp)}}" name="no_hp" type="text" class="form-control @error('no_hp') is-invalid @enderror" placeholder="Input No HP" />
                                <!-- error message -->
                                @error('no_hp')
                                  <span class="invalid-feedback">
                                    <strong>{{$message}}</strong>
                                  </span>
                                @enderror
                           </div>
                        </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6">
                        <!-- alamat -->
                        <div class="form-group">
                            <label for="input_pegawai_alamat" class="font-weight-bold">
                                Alamat
                            </label>
                            <textarea class="form-control @error('alamat') is-invalid @enderror" name="alamat" placeholder="Input Alamat">{{old('alamat', $pegawai->alamat)}}</textarea>
                            <!-- error message -->
                            @error('alamat')
                              <span class="invalid-feedback">
                                <strong>{{$message}}</strong>
                              </span>
                            @enderror
                        </div>
                      </div>
                      <div class="col-md-6">
                        <!-- pendidikan -->
                        <div class="form-group">
                          <label for="input_pegawai_pendidikan_terakhir" class="font-weight-bold">Pendidikan Terakhir</label>
                          <select id="input_pegawai_pendidikan_terakhir" name="pendidikan_terakhir" class="form-control @error('pendidikan_terakhir') is-invalid @enderror">
                              <option value="" selected disabled>Pilih Pendidikan Terakhir</option>
                              <option value="SD" @if(old('pendidikan_terakhir', $pegawai->pendidikan_terakhir) == 'SD') selected @endif>SD</option>
                              <option value="SLTP" @if(old('pendidikan_terakhir', $pegawai->pendidikan_terakhir) == 'SLTP') selected @endif>SLTP</option>
                              <option value="SLTA" @if(old('pendidikan_terakhir', $pegawai->pendidikan_terakhir) == 'SLTA') selected @endif>SLTA</option>
                              <option value="Diploma" @if(old('pendidikan_terakhir', $pegawai->pendidikan_terakhir) == 'Diploma') selected @endif>Diploma</option>
                              <option value="S1" @if(old('pendidikan_terakhir', $pegawai->pendidikan_terakhir) == 'S1') selected @endif>S1</option>
                              <option value="S2" @if(old('pendidikan_terakhir', $pegawai->pendidikan_terakhir) == 'S2') selected @endif>S2</option>
                              <option value="S3" @if(old('pendidikan_terakhir', $pegawai->pendidikan_terakhir) == 'S3') selected @endif>S3</option>
                          </select>
                          <!-- error message -->
                          @error('pendidikan_terakhir')
                              <span class="invalid-feedback">
                                  <strong>{{$message}}</strong>
                              </span>
                          @enderror
                        </div>                      
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <!-- no_sk_pengangkatan -->
                        <div class="form-group">
                            <label for="input_pegawai_no_sk_pengangkatan" class="font-weight-bold">
                                No SK Pengangkatan
                            </label>
                            <input id="input_pegawai_no_sk_pengangkatan" value="{{old('no_sk_pengangkatan', $pegawai->no_sk_pengangkatan)}}" name="no_sk_pengangkatan" type="text" class="form-control @error('no_sk_pengangkatan') is-invalid @enderror" placeholder="Input No SK Pengangkatan" />
                            <!-- error message -->
                            @error('no_sk_pengangkatan')
                              <span class="invalid-feedback">
                                <strong>{{$message}}</strong>
                              </span>
                            @enderror
                        </div>
                      </div>
                      <div class="col-md-6">
                        <!-- thn_sk_pengangkatan -->
                        <div class="form-group">
                            <label for="input_pegawai_thn_sk_pengangkatan" class="font-weight-bold">
                                Tahun SK Pengangkatan
                            </label>
                            <select style="cursor:pointer;" class="form-control @error('thn_sk_pengangkatan') is-invalid @enderror"  name="thn_sk_pengangkatan">
                              <option value="0" selected disabled> Pilih Tahun</option>
                              
                               {{$year = date('Y')}}
                               {{$min = $year - 20}}
                               {{$max = $year + 20}}
                               @for( $i=$max; $i>=$min; $i-- ) 
                                 <option value="{{$i}}" {{ old('thn_sk_pengangkatan', $pegawai->thn_sk_pengangkatan) == $i ? "selected" : null}}>{{$i}}</option>
                               @endfor
                            </select>
                            <!-- error message -->
                            @error('thn_sk_pengangkatan')
                              <span class="invalid-feedback">
                                <strong>{{$message}}</strong>
                              </span>
                            @enderror
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <!-- foto -->
                        <div class="form-group">
                            <label for="input_pegawai_foto" class="font-weight-bold">
                                Foto
                            </label>
                            <input id="input_pegawai_foto" value="{{old('foto', $pegawai->foto)}}" name="foto" type="file" class="form-control @error('foto') is-invalid @enderror" placeholder="Input Foto" />
                            <!-- error message -->
                            @error('foto')
                              <span class="invalid-feedback">
                                <strong>{{$message}}</strong>
                              </span>
                            @enderror
                        </div>
                      </div>
                      <div class="col-md-6">
                        <img src="{{url('pegawai/'.$pegawai->foto)}}" width="150" height="200">
                      </div>
                    </div>

                    <div class="float-right">
                        <a class="btn btn-warning px-3 mx-2" href="{{ route('pegawai.index') }}">
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
