@extends('layouts.dashboard')

@section('breadcrumbs')
    {{ Breadcrumbs::render('dashboard_kk_anggota', $kk) }}
@endsection

@section('kk', 'active')
@section('main_penduduk', 'show')

@section('content')
@include('layouts.alert')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('anggota_kk.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="no_kk" class="font-weight-bold">No KK</label>
                                    <input id="no_kk" value="{{ old('no_kk', $kk->no_kk) }}" name="no_kk" type="text" class="form-control" readonly/>
                                    <input id="no_kk" value="{{ old('no_kk', $kk->id) }}" name="no_kk" type="hidden" class="form-control"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama_kepala_keluarga" class="font-weight-bold">Nama Kepala Keluarga</label>
                                    <input id="nama_kepala_keluarga" value="{{ old('nama_kepala_keluarga', $kk->nama_kepala_keluarga) }}" name="nama_kepala_keluarga" type="text" class="form-control" readonly/>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="input_penduduk_alamat" class="font-weight-bold">
                                Alamat
                            </label>
                            <textarea class="form-control" name="alamat" placeholder="Input Alamat" readonly>{{old('alamat', $kk->alamat)}}</textarea>
                       </div>
                       <br>
                       <h3>Anggota Keluarga</h3>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold">Penduduk</label>
                                    <select id="select_penduduk" name="penduduk" data-placeholder="Pilih Penduduk" class="custom-select w-100 @error('penduduk') is-invalid @enderror">
                                        @if (old('penduduk'))
                                            <option value="{{ old('penduduk') }}" selected>{{ old('penduduk')->nik }} - {{ old('penduduk')->nama }}</option>
                                        @endif
                                    </select>
                                    @error('penduduk')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    @if ($existingAnggota)
                                        <span class="invalid-feedback">
                                            <strong>Penduduk sudah menjadi anggota KK di KK lain.</strong>
                                        </span>
                                    @endif
                                </div>
                                
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="hubungan_keluarga" class="font-weight-bold">Hubungan Keluarga</label>
                                    <select id="hubungan_keluarga" name="hubungan_keluarga" class="form-control @error('hubungan_keluarga') is-invalid @enderror">
                                        <option value="" selected disabled>Pilih Hubungan Keluarga</option>
                                        <option value="Istri" {{ old('hubungan_keluarga') == 'Istri' ? 'selected' : '' }}>Istri</option>
                                        <option value="Anak" {{ old('hubungan_keluarga') == 'Anak' ? 'selected' : '' }}>Anak</option>
                                    </select>
                                    @error('hubungan_keluarga')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                  </div>
                            </div>
                       </div>
                        
                        <div class="float-right">
                            <button type="submit" class="btn btn-success float-right px-3">Simpan</button>
                        </div>
                    </form>
                    
                    <div class="table-responsive" style="margin-top: 100px">
                        <table class="table table-bordered" id="example" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th class="text-center" width="10">No</th>
                                    <th class="text-center">NIK</th>
                                    <th class="text-center">Nama</th>
                                    <th class="text-center">Hubungan Keluarga</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @php $no = 1; @endphp
                            @forelse ($anggota_kk as $ak)
                            <tr align="center">
                                <td align="center">{{ $no++ }}</td>
                                <td>{{ $ak->nik }}</td>
                                <td>{{ $ak->nama}}</td>
                                <td>{{ $ak->hubungan_keluarga}}</td>
                                <td>
                                <!-- delete -->
                                <form class="d-inline" role="alert" action="{{route('anggota_kk.delete',['anggota_kk' => $ak])}}" method="POST" alert-title = "Hapus Anggota KK?" alert-text = "Apakah anda yakin ingin menghapus data ini?">
                                    @csrf
                                    @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i>
                                        </button>
                                </form>                   
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('css-external')
    <link rel="stylesheet" href="{{asset('template/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('template/select2/css/select2-bootstrap5.min.css')}}">
@endpush

@push('javascript-external')
    <script src="{{asset('template/select2/js/select2.min.js')}}"></script>
@endpush

@push('javascript-internal')
        <script>
            $(function (){
                
                //select penduduk
                $('#select_penduduk').select2({
                    theme: 'bootstrap5',
                    language: "",
                    allowClear: true,
                    ajax: {
                        url: "{{route('penduduk.select')}}",
                        dataType: 'json',
                        delay: 250,
                        processResults: function(data) {
                            return {
                                results: $.map(data, function(item) {
                                    return {
                                        text: [item.nik + " - " + item.nama],
                                        id: item.id
                                    }
                                })
                            };
                        }
                    }
                });

            });
        </script>

        <script>
            $(document).ready(function () {
                $('#example').DataTable();

                $("form[role='alert']").submit(function (event){
                    event.preventDefault();
                    Swal.fire({
                        title: $(this).attr('alert-title'),
                        text: $(this).attr('alert-text'),
                        icon: 'warning',
                        allowOutsideClick: true,
                        showCancelButton: true,
                        cancelButtonText: "Cancel",
                        reverseButtons: true,
                        confirmButtonText: "Yes",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            event.target.submit();
                        }
                    });

                })
            })
        </script>
@endpush


