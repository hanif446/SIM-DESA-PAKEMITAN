@extends('layouts.dashboard')
@section('breadcrumbs')
{{Breadcrumbs::render('dashboard_gaji_pokok_edit', $gaji_pokok)}}
@endsection
@section('gaji_pegawai', 'active')
@section('main', 'show')
@section('content')
<div class="row">
	   <div class="col-md-12">
	      <div class="card">
	         <div class="card-body">
	            <form action="{{ route('gaji-pokok.update', ['gaji_pokok' => $gaji_pokok]) }}" method="POST">
	            	@csrf
                    @method('PUT')
	               <!-- pegawai -->
	               <div class="form-group">
	                  <label class="font-weight-bold">
	                     Pegawai
	                  </label>
	                  <select id="select_pegawai" name="pegawai" data-placeholder="Pilih Pegawai" class="custom-select w-100 @error('pegawai') is-invalid @enderror">
	                  @if (old('pegawai', $pegawai->id))
	                  	<option value="{{ $pegawai->id }}" selected>{{ $pegawai->nip }} - {{ $pegawai->nama_pegawai }}</option>
	                  @endif

	                  </select>
	                  @error('pegawai')
		                  <span class="invalid-feedback">
		                 	<strong>
		                 		{{$message}}
		                 	</strong> 	
		                  </span>
	                  @enderror
	               </div>

	               <div class="row">
	                	<label for="input_pegawai_nip" class="font-weight-bold">
                            Bulan Gaji
                        </label>
                        <div class="col-md-6">
                            <!-- bulan -->
                            <div class="form-group">
                                <select style="cursor:pointer;" class="form-control @error('bulan_gaji') is-invalid @enderror" id="select_bulan_gaji" name="bulan_gaji" data-value="{{ old('bulan_gaji') }}">
								    <option value="" selected disabled> Pilih Bulan</option>
									<option value="Januari" {{ old('bulan_gaji', $gaji_pokok->bulan_gaji) == 'Januari' ? 'selected=selected' : '' }}> Januari</option>
									<option value="Februari" {{ old('bulan_gaji', $gaji_pokok->bulan_gaji) == 'Februari' ? 'selected=selected' : '' }}> Februari</option>
									<option value="Maret" {{ old('bulan_gaji', $gaji_pokok->bulan_gaji) == 'Maret' ? 'selected=selected' : '' }}> Maret</option>
									<option value="April" {{ old('bulan_gaji', $gaji_pokok->bulan_gaji) == 'April' ? 'selected=selected' : '' }}> April</option>
									<option value="Mei" {{ old('bulan_gaji', $gaji_pokok->bulan_gaji) == 'Mei' ? 'selected=selected' : '' }}> Mei</option>
									<option value="Juni" {{ old('bulan_gaji', $gaji_pokok->bulan_gaji) == 'Juni' ? 'selected=selected' : '' }}> Juni</option>
									<option value="Juli" {{ old('bulan_gaji', $gaji_pokok->bulan_gaji) == 'Juli' ? 'selected=selected' : '' }}> Juli</option>
									<option value="Agustus" {{ old('bulan_gaji', $gaji_pokok->bulan_gaji) == 'Agustus' ? 'selected=selected' : '' }}> Agustus</option>
									<option value="September" {{ old('bulan_gaji', $gaji_pokok->bulan_gaji) == 'September' ? 'selected=selected' : '' }}> September</option>
									<option value="Oktober" {{ old('bulan_gaji', $gaji_pokok->bulan_gaji) == 'Oktober' ? 'selected=selected' : '' }}> Oktober</option>
									<option value="November" {{ old('bulan_gaji', $gaji_pokok->bulan_gaji) == 'November' ? 'selected=selected' : '' }}> November</option>
									<option value="Desember" {{ old('bulan_gaji', $gaji_pokok->bulan_gaji) == 'Desember' ? 'selected=selected' : '' }}> Desember</option>
						  		</select>
                                <!-- error message -->
                                @error('bulan_gaji')
                                  <span class="invalid-feedback">
                                    <strong>{{$message}}</strong>
                                  </span>
                                @enderror
                           </div>
                        </div>
                        <div class="col-md-6">
                            <!-- tahun -->
                            <div class="form-group">
                                <select style="cursor:pointer;" class="form-control @error('tahun_gaji') is-invalid @enderror"  name="tahun_gaji">
									<option value="0" selected disabled> Pilih Tahun</option>
									
									 {{$year = date('Y')}}
									 {{$min = $year - 20}}
									 {{$max = $year + 20}}
									 @for( $i=$max; $i>=$min; $i-- ) 
									 	<option value="{{$i}}" {{ old('tahun_gaji', $gaji_pokok->tahun_gaji) == $i ? "selected" : null}}>{{$i}}</option>
									 @endfor
								
							    </select>
                                <!-- error message -->
                                @error('tahun_gaji')
                                  <span class="invalid-feedback">
                                    <strong>{{$message}}</strong>
                                  </span>
                                @enderror
                           </div>
                        </div>
                    </div>

					<!-- jumlah gaji -->
					<div class="form-group">
						<label class="font-weight-bold">
						Jumlah Gaji
						</label>
						<input name="jumlah_gaji" type="text" class="form-control @error('jumlah_gaji') is-invalid @enderror" value="{{ old('jumlah_gaji', $gaji_pokok->jumlah_gaji) }}" placeholder="Input Jumlah Gaji"/>
						@error('jumlah_gaji')
							<span class="invalid-feedback">
							<strong>
								{{$message}}
							</strong> 	
							</span>
						@enderror
					</div>
					
	               <div class="float-right">
	                  <a href="{{ route('gaji-pokok.index') }}" class="btn btn-warning px-3 mx-2" href="">
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
                
                //select pegawai
                $('#select_pegawai').select2({
                    theme: 'bootstrap5',
                    language: "",
                    allowClear: true,
                    ajax: {
                        url: "{{route('pegawai.select')}}",
                        dataType: 'json',
                        delay: 250,
                        processResults: function(data) {
                            return {
                                results: $.map(data, function(item) {
                                    return {
                                        text: [item.nip + " - " + item.nama_pegawai],
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
