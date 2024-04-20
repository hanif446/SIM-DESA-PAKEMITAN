@extends('layouts.dashboard')

@section('breadcrumbs')
    {{ Breadcrumbs::render('dashboard_penduduk_edit', $penduduk) }}
@endsection

@section('penduduk', 'active')
@section('main_penduduk', 'show')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('penduduk.update', ['penduduk' => $penduduk]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nik" class="font-weight-bold">NIK</label>
                                <input id="nik" value="{{ old('nik', $penduduk->nik) }}" name="nik" type="text" class="form-control @error('nik') is-invalid @enderror" placeholder="Input NIK"/>
                                @error('nik')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama" class="font-weight-bold">Nama</label>
                                <input id="nama" value="{{ old('nama', $penduduk->nama) }}" name="nama" type="text" class="form-control @error('nama') is-invalid @enderror" placeholder="Input Nama" />
                                @error('nama')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="jk" class="font-weight-bold">Jenis Kelamin</label>
                                <select id="jk" name="jk" class="form-control @error('jk') is-invalid @enderror">
                                    <option value="" selected disabled>Pilih Jenis Kelamin</option>
                                    <option value="Laki-laki" {{ old('jk', $penduduk->jk) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="Perempuan" {{ old('jk', $penduduk->jk) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                                @error('jk')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tempat_lahir" class="font-weight-bold">Tempat Lahir</label>
                                <input id="tempat_lahir" value="{{ old('tempat_lahir', $penduduk->tempat_lahir) }}" name="tempat_lahir" type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" placeholder="Input Tempat Lahir" />
                                @error('tempat_lahir')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tanggal_lahir" class="font-weight-bold">Tanggal Lahir</label>
                                <input id="tanggal_lahir" value="{{ old('tanggal_lahir', $penduduk->tanggal_lahir) }}" name="tanggal_lahir" type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" />
                                @error('tanggal_lahir')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="agama" class="font-weight-bold">Agama</label>
                                <select id="agama" name="agama" class="form-control @error('agama') is-invalid @enderror">
                                    <option value="" selected disabled>Pilih Agama</option>
                                    <option value="Islam" {{ old('agama', $penduduk->agama) == 'Islam' ? 'selected' : '' }}>Islam</option>
                                    <option value="Kristen Protestan" {{ old('agama', $penduduk->agama) == 'Kristen Protestan' ? 'selected' : '' }}>Kristen Protestan</option>
                                    <option value="Katolik" {{ old('agama', $penduduk->agama) == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                    <option value="Hindu" {{ old('agama', $penduduk->agama) == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                    <option value="Buddha" {{ old('agama', $penduduk->agama) == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                    <option value="Kong Hu Cu" {{ old('agama', $penduduk->agama) == 'Kong Hu Cu' ? 'selected' : '' }}>Kong Hu Cu</option>
                                </select>
                                @error('agama')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="pendidikan" class="font-weight-bold">Pendidikan</label>
                                <select id="pendidikan" name="pendidikan" class="form-control @error('pendidikan') is-invalid @enderror">
                                    <option value="" selected disabled>Pilih Pendidikan</option>
                                    <option value="Tidak Sekolah" {{ old('pendidikan', $penduduk->pendidikan) == 'Tidak Sekolah' ? 'selected' : '' }}>Tidak Sekolah</option>
                                    <option value="SD" {{ old('pendidikan', $penduduk->pendidikan) == 'SD' ? 'selected' : '' }}>SD</option>
                                    <option value="SLTP" {{ old('pendidikan', $penduduk->pendidikan) == 'SLTP' ? 'selected' : '' }}>SLTP</option>
                                    <option value="SLTA" {{ old('pendidikan', $penduduk->pendidikan) == 'SLTA' ? 'selected' : '' }}>SLTA</option>
                                    <option value="D1" {{ old('pendidikan', $penduduk->pendidikan) == 'D1' ? 'selected' : '' }}>D1</option>
                                    <option value="D2" {{ old('pendidikan', $penduduk->pendidikan) == 'D2' ? 'selected' : '' }}>D2</option>
                                    <option value="D3" {{ old('pendidikan', $penduduk->pendidikan) == 'D3' ? 'selected' : '' }}>D3</option>
                                    <option value="D4/S1" {{ old('pendidikan', $penduduk->pendidikan) == 'D4/S1' ? 'selected' : '' }}>D4/S1</option>
                                    <option value="S2" {{ old('pendidikan', $penduduk->pendidikan) == 'S2' ? 'selected' : '' }}>S2</option>
                                    <option value="S3" {{ old('pendidikan', $penduduk->pendidikan) == 'S3' ? 'selected' : '' }}>S3</option>
                                </select>
                                @error('pendidikan')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="pekerjaan" class="font-weight-bold">Pekerjaan</label>
                                <select id="pekerjaan" name="pekerjaan" class="form-control @error('pekerjaan') is-invalid @enderror">
                                    <option value="" selected disabled>Pilih Pekerjaan</option>
                                    <option value="PNS" {{ old('pekerjaan', $penduduk->pekerjaan) == 'PNS' ? 'selected' : '' }}>PNS</option>
                                    <option value="TNI/Polri" {{ old('pekerjaan', $penduduk->pekerjaan) == 'TNI/Polri' ? 'selected' : '' }}>TNI/Polri</option>
                                    <option value="Wiraswasta" {{ old('pekerjaan', $penduduk->pekerjaan) == 'Wiraswasta' ? 'selected' : '' }}>Wiraswasta</option>
                                    <option value="Pegawai Swasta" {{ old('pekerjaan', $penduduk->pekerjaan) == 'Pegawai Swasta' ? 'selected' : '' }}>Pegawai Swasta</option>
                                    <option value="Petani" {{ old('pekerjaan', $penduduk->pekerjaan) == 'Petani' ? 'selected' : '' }}>Petani</option>
                                    <option value="Nelayan" {{ old('pekerjaan', $penduduk->pekerjaan) == 'Nelayan' ? 'selected' : '' }}>Nelayan</option>
                                    <option value="Guru/Dosen" {{ old('pekerjaan', $penduduk->pekerjaan) == 'Guru/Dosen' ? 'selected' : '' }}>Guru/Dosen</option>
                                    <option value="Buruh" {{ old('pekerjaan', $penduduk->pekerjaan) == 'Buruh' ? 'selected' : '' }}>Buruh</option>
                                    <option value="Pedagang" {{ old('pekerjaan', $penduduk->pekerjaan) == 'Pedagang' ? 'selected' : '' }}>Pedagang</option>
                                    <option value="Pelajar/Mahasiswa" {{ old('pekerjaan', $penduduk->pekerjaan) == 'Pelajar/Mahasiswa' ? 'selected' : '' }}>Pelajar/Mahasiswa</option>
                                    <option value="Lainnya" {{ old('pekerjaan', $penduduk->pekerjaan) == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                </select>
                                @error('pekerjaan')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="gol_darah" class="font-weight-bold">Golongan Darah</label>
                                <select id="gol_darah" name="gol_darah" class="form-control @error('gol_darah') is-invalid @enderror">
                                    <option value="" selected disabled>Pilih Golongan Darah</option>
                                    <option value="A" {{ old('gol_darah', $penduduk->gol_darah) == 'A' ? 'selected' : '' }}>A</option>
                                    <option value="B" {{ old('gol_darah', $penduduk->gol_darah) == 'B' ? 'selected' : '' }}>B</option>
                                    <option value="AB" {{ old('gol_darah', $penduduk->gol_darah) == 'AB' ? 'selected' : '' }}>AB</option>
                                    <option value="O" {{ old('gol_darah', $penduduk->gol_darah) == 'O' ? 'selected' : '' }}>O</option>
                                </select>
                                @error('gol_darah')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="status_kawin" class="font-weight-bold">Status Kawin</label>
                                <select id="status_kawin" name="status_kawin" class="form-control @error('status_kawin') is-invalid @enderror">
                                    <option value="" selected disabled>Pilih Status Kawin</option>
                                    <option value="Belum Kawin" {{ old('status_kawin', $penduduk->status_kawin) == 'Belum Kawin' ? 'selected' : '' }}>Belum Kawin</option>
                                    <option value="Kawin" {{ old('status_kawin', $penduduk->status_kawin) == 'Kawin' ? 'selected' : '' }}>Kawin</option>
                                    <option value="Cerai Hidup" {{ old('status_kawin', $penduduk->status_kawin) == 'Cerai Hidup' ? 'selected' : '' }}>Cerai Hidup</option>
                                    <option value="Cerai Mati" {{ old('status_kawin', $penduduk->status_kawin) == 'Cerai Mati' ? 'selected' : '' }}>Cerai Mati</option>
                                </select>
                                @error('status_kawin')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tgl_kawin" class="font-weight-bold">Tanggal Kawin</label>
                                <input id="tgl_kawin" value="{{ old('tgl_kawin', $penduduk->tgl_kawin) }}" name="tgl_kawin" type="date" class="form-control @error('tgl_kawin') is-invalid @enderror" />
                                @error('tgl_kawin')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="kewarganegaraan" class="font-weight-bold">Kewarganegaraan</label>
                                <select id="kewarganegaraan" name="kewarganegaraan" class="form-control @error('kewarganegaraan') is-invalid @enderror">
                                    <option value="" selected disabled>Pilih Kewarganegaraan</option>
                                    <option value="WNI" {{ old('kewarganegaraan', $penduduk->kewarganegaraan) == 'WNI' ? 'selected' : '' }}>Warga Negara Indonesia (WNI)</option>
                                    <option value="WNA" {{ old('kewarganegaraan', $penduduk->kewarganegaraan) == 'WNA' ? 'selected' : '' }}>Warga Negara Asing (WNA)</option>
                                </select>
                                @error('kewarganegaraan')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama_ayah" class="font-weight-bold">Nama Ayah</label>
                                <input id="nama_ayah" value="{{ old('nama_ayah', $penduduk->nama_ayah) }}" name="nama_ayah" type="text" class="form-control @error('nama_ayah') is-invalid @enderror" placeholder="Input Nama Ayah" />
                                @error('nama_ayah')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama_ibu" class="font-weight-bold">Nama Ibu</label>
                                <input id="nama_ibu" value="{{ old('nama_ibu', $penduduk->nama_ibu) }}" name="nama_ibu" type="text" class="form-control @error('nama_ibu') is-invalid @enderror" placeholder="Input Nama Ibu" />
                                @error('nama_ibu')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-warning px-3 mx-2" href="{{ route('penduduk.index') }}">Kembali</a>
                        <button type="submit" class="btn btn-success float-right px-3">Ubah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
