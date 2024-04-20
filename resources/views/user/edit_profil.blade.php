@extends('layouts.dashboard')

@section('breadcrumbs')
    {{Breadcrumbs::render('dashboard_edit_profil', $user)}}
@endsection

@section('content')
<div class="row">
       <div class="col-md-12">
          <div class="card">
             <div class="card-body">
                <form action="{{ route('user.update_profil', ['user' => $user]) }}" method="POST">
                    @csrf
                    @method('PUT')
                   <!-- name -->
                   <div class="form-group">
                      <label for="input_user_name" class="font-weight-bold">
                         Username
                      </label>
                      <input id="input_user_username" value="{{old('username', $user->username)}}" name="username" type="text" class="form-control @error('username') is-invalid @enderror"  placeholder="Input Username" />
                      @error('username')
                          <span class="invalid-feedback">
                            <strong>
                                {{$message}}
                            </strong>   
                          </span>
                      @enderror
                   </div>

                   <!-- email -->
                   <div class="form-group">
                      <label for="input_user_email" class="font-weight-bold">
                         Email
                      </label>
                      <input id="input_user_email" value="{{old('email', $user->email)}}" name="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Input Email"
                         autocomplete="email" />
                      @error('email')
                          <span class="invalid-feedback">
                            <strong>
                                {{$message}}
                            </strong>   
                          </span>
                      @enderror
                   </div>

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
                        <div class="col-md-6">
                            <!-- uker -->
                            <div class="form-group">
                                <label for="input_pegawai_uker" class="font-weight-bold">
                                    Unit Kerja
                                </label>
                                <input id="input_pegawai_uker" value="{{old('uker', $pegawai->uker)}}" name="uker" type="text" class="form-control @error('uker') is-invalid @enderror" placeholder="Input Unit Kerja"/>
                                <!-- error message -->
                                @error('uker')
                                  <span class="invalid-feedback">
                                    <strong>{{$message}}</strong>
                                  </span>
                                @enderror
                           </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <!-- pendidikan -->
                            <div class="form-group">
                                <label for="input_pegawai_pendidikan" class="font-weight-bold">
                                    Pendidikan Terakhir
                                </label>
                                <input id="input_pegawai_pendidikan" value="{{old('pendidikan' , $pegawai->pendidikan)}}" name="pendidikan" type="text" class="form-control @error('pendidikan') is-invalid @enderror" placeholder="Input Pendidikan"/>
                                <!-- error message -->
                                @error('pendidikan')
                                  <span class="invalid-feedback">
                                    <strong>{{$message}}</strong>
                                  </span>
                                @enderror
                           </div>
                        </div>
                        <div class="col-md-6">
                            <!-- jurusan -->
                            <div class="form-group">
                                <label for="input_pegawai_jurusan" class="font-weight-bold">
                                    Jurusan
                                </label>
                                <input id="input_pegawai_jurusan" value="{{old('jurusan', $pegawai->jurusan)}}" name="jurusan" type="text" class="form-control @error('jurusan') is-invalid @enderror" placeholder="Input Jurusan" />
                                <!-- error message -->
                                @error('jurusan')
                                  <span class="invalid-feedback">
                                    <strong>{{$message}}</strong>
                                  </span>
                                @enderror
                           </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <!-- diklat_pim -->
                            <div class="form-group">
                                <label for="input_pegawai_diklat_pim" class="font-weight-bold">
                                    Diklat Pimpinan
                                </label>
                                <input id="input_pegawai_diklat_pim" value="{{old('diklat_pim', $pegawai->diklat_pim)}}" name="diklat_pim" type="text" class="form-control @error('diklat_pim') is-invalid @enderror" placeholder="Input Diklat Pimpinan"/>
                                <!-- error message -->
                                @error('diklat_pim')
                                  <span class="invalid-feedback">
                                    <strong>{{$message}}</strong>
                                  </span>
                                @enderror
                           </div>
                        </div>
                        <div class="col-md-6">
                            <!-- thn_lulus -->
                            <div class="form-group">
                                <label for="input_pegawai_thn_lulus" class="font-weight-bold">
                                    Tahun Lulus
                                </label>
                                <input id="input_pegawai_thn_lulus" value="{{old('thn_lulus', $pegawai->thn_lulus)}}" name="thn_lulus" type="text" class="form-control @error('thn_lulus') is-invalid @enderror" placeholder="Input Tahun Lulus" />
                                <!-- error message -->
                                @error('thn_lulus')
                                  <span class="invalid-feedback">
                                    <strong>{{$message}}</strong>
                                  </span>
                                @enderror
                           </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
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
                        
                    </div>
                   
                   <div class="float-right">
                      <a href="{{ route('dashboard.index') }}" class="btn btn-warning px-3 mx-2" href="">
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