@extends('layouts.dashboard')
@section('breadcrumbs')
{{Breadcrumbs::render('dashboard_pegawai')}}
@endsection
@section('pegawai', 'active')
@section('main', 'show')
@section('content')
{{--    Message Alert --}}
@include('layouts.alert')
    <div class="row">
      <div class="col-md-12">
         <div class="card">
            <div class="card-header">
                  @can('pegawai_create')
                     <a href="{{route('pegawai.create')}}" class="btn btn-success float-right" role="button">
                        Tambah Data
                        <i class="fas fa-plus-square"></i>
                     </a>
                  @endcan
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="example" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center" width="10">No</th>
                                <th class="text-center">NIP Pegawai</th>
                                <th class="text-center">Nama Pegawai</th>
                                <th class="text-center">Jabatan</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php $no = 1; @endphp
                        @forelse ($pegawai as $p)
                        <tr align="center">
                            <td align="center">{{ $no++ }}</td>
                            <td>{{ $p->nip }}</td>
                            <td>{{ $p->nama_pegawai}}</td>
                            <td>{{ $p->jabatan}}</td>
                            <td>
                            <!-- detail -->
                            @can('pegawai_detail')
                                <a href="{{ route('pegawai.show', ['pegawai' => $p]) }}" class="btn btn-sm btn-warning" role="button">
                                    <i class="fas fa-eye"></i>
                                </a>
                            @endcan
                            <!-- edit -->
                            @can('pegawai_update')
                                <a href="{{ route('pegawai.edit', ['pegawai' => $p]) }}" class="btn btn-sm btn-info" role="button">
                                    <i class="fas fa-edit"></i>
                                </a>
                            @endcan
                            <!-- delete -->
                            @can('pegawai_delete')
                                <form class="d-inline" role="alert" action="{{route('pegawai.destroy',['pegawai' => $p])}}" method="POST" alert-title = "Hapus Pegawai?" alert-text = "Apakah anda yakin ingin menghapus data ini?">
                            @csrf
                            @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                      <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            @endcan                    
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
