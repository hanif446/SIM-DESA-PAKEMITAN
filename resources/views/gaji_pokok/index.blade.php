@extends('layouts.dashboard')
@section('breadcrumbs')
{{Breadcrumbs::render('dashboard_gaji_pokok')}}
@endsection
@section('gaji_pegawai', 'active')
@section('main', 'show')
@section('content')
{{--    Message Alert --}}
@include('layouts.alert')
<div class="row">
      <div class="col-md-12">
         <div class="card">
            <div class="card-header">
                <div class="row d-flex align-items-center">
                    <form method="POST" action="{{ route('gaji-pokok.cetak') }}" class="col-md-9" target="_blank">
	            	@csrf
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <select style="cursor:pointer;" class="form-control" id="select_bulan_gaji" name="bulan_gaji">
                                        <option value="" selected disabled> Pilih Bulan</option>
                                        <option value="Januari"> Januari</option>
                                        <option value="Februari"> Februari</option>
                                        <option value="Maret"> Maret</option>
                                        <option value="April"> April</option>
                                        <option value="Mei"> Mei</option>
                                        <option value="Juni"> Juni</option>
                                        <option value="Juli"> Juli</option>
                                        <option value="Agustus"> Agustus</option>
                                        <option value="September"> September</option>
                                        <option value="Oktober"> Oktober</option>
                                        <option value="November"> November</option>
                                        <option value="Desember"> Desember</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <select style="cursor:pointer;" class="form-control"  name="tahun_gaji">
                                        <option value="0" selected disabled> Pilih Tahun</option>
                                        {{$year = date('Y')}}
                                        {{$min = $year - 20}}
                                        {{$max = $year + 20}}
                                        @for( $i=$max; $i>=$min; $i-- ) 
                                            <option value="{{$i}}">{{$i}}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <!-- print -->
                                    <button class="btn btn-sm btn-secondary" type="submit" role="button">
                                        <i class="fas fa-print"></i>
                                    </button>
                                    
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="col-md-3">
                        <a href="{{route('gaji-pokok.create')}}" class="btn btn-success float-right" role="button">
                            Tambah Data
                            <i class="fas fa-plus-square"></i>
                        </a>
                        
                    </div>
                </div>
            </div>            
            <div class="card-body">
               <div class="table-responsive">
                    <table class="table table-bordered" id="example" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center" width="10">No</th>
                                <th class="text-center">NIP Pegawai</th>
                                <th class="text-center">Nama Pegawai</th>
                                <th class="text-center">Bulan Gaji</th>
                                <th class="text-center">Jumlah Gaji</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php $no = 1; @endphp
                        @forelse ($gaji_pokok as $gp)
                        <tr align="center">
                            <td align="center">{{ $no++ }}</td>
                            <td>{{ $gp->nip }}</td>
                            <td>{{ $gp->nama_pegawai}}</td>
                            <td>{{ $gp->bulan_gaji }} {{ $gp->tahun_gaji }}</td>
                            <td>Rp. {{number_format($gp->jumlah_gaji, 0, ',', '.')}}</td>
                            <td>
                                <!-- edit -->
                                <a href="{{ route('gaji-pokok.edit', ['gaji_pokok' => $gp]) }}" class="btn btn-sm btn-info" role="button">
                                    <i class="fas fa-edit"></i>
                                </a>
                                
                                <!-- delete -->
                                <form class="d-inline" role="alert" action="{{route('gaji-pokok.destroy',['gaji_pokok' => $gp])}}" method="POST" alert-title = "Hapus Gaji Pegawai?" alert-text = "Apakah anda yakin ingin menghapus data ini?">
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

@push('javascript-internal')
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
