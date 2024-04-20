@extends('layouts.dashboard')

@section('breadcrumbs')
    {{ Breadcrumbs::render('dashboard_pembayaran_create') }}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('pembayaran.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="font-weight-bold">
                                Kartu Keluarga
                            </label>
                            <select id="select_kk" name="kk" data-placeholder="Pilih Kartu Keluarga" class="custom-select w-100 @error('kk') is-invalid @enderror">
                                @if (isset(old('kk')->id))
                                    <option value="{{ old('kk')->id }}" selected>{{ old('kk')->no_kk }} - {{ old('kk')->nama_kepala_keluarga}}</option>
                                @endif
                            </select>
                            @error('kk')
                                <span class="invalid-feedback">
                                    <strong>
                                        {{$message}}
                                    </strong> 	
                                </span>
                            @enderror
                        </div>
                        
                         <div class="form-group">
                            <label for="jenis_pembayaran" class="font-weight-bold">Jenis Pembayaran</label>
                            <select id="jenis_pembayaran" name="jenis_pembayaran" class="form-control @error('jenis_pembayaran') is-invalid @enderror">
                                <option value="" selected disabled>Pilih Jenis Pembayaran</option>
                                <option value="PBB" {{ old('jenis_pembayaran') == 'PBB' ? 'selected' : '' }}>PBB</option>
                                <option value="Iuran" {{ old('jenis_pembayaran') == 'Iuran' ? 'selected' : '' }}>Iuran</option>
                            </select>
                            @error('jenis_pembayaran')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                          </div>
                        <div class="form-group">
                            <label for="total_pembayaran" class="font-weight-bold">Total Pembayaran</label>
                            <input id="total_pembayaran" value="{{ old('total_pembayaran') }}" name="total_pembayaran" type="text" class="form-control @error('total_pembayaran') is-invalid @enderror" placeholder="Input Total Pembayaran" />
                            @error('total_pembayaran')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="input_keterangan" class="font-weight-bold">
                                Keterangan
                            </label>
                            <textarea class="form-control @error('keterangan') is-invalid @enderror" name="keterangan" placeholder="Input Keterangan">{{old('keterangan')}}</textarea>
                            <!-- error message -->
                            @error('keterangan')
                              <span class="invalid-feedback">
                                <strong>{{$message}}</strong>
                              </span>
                            @enderror
                       </div>
                        
                        <div class="float-right">
                            <a class="btn btn-warning px-3 mx-2" href="{{ route('pembayaran.index') }}">Kembali</a>
                            <button type="submit" class="btn btn-primary float-right px-3">Simpan</button>
                        </div>
                    </form>
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
                
                //select kk
                $('#select_kk').select2({
                    theme: 'bootstrap5',
                    language: "",
                    allowClear: true,
                    ajax: {
                        url: "{{route('kk.select')}}",
                        dataType: 'json',
                        delay: 250,
                        processResults: function(data) {
                            return {
                                results: $.map(data, function(item) {
                                    return {
                                        text: [item.no_kk + " - " + item.nama_kepala_keluarga],
                                        id: item.id
                                    }
                                })
                            };
                        }
                    }
                });

            });
        </script>
@endpush
