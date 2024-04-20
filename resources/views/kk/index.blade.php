@extends('layouts.dashboard')
@section('breadcrumbs')
{{Breadcrumbs::render('dashboard_kk')}}
@endsection
@section('kk', 'active')
@section('main_penduduk', 'show')
@section('content')
{{--    Message Alert --}}
@include('layouts.alert')
    <div class="row">
      <div class="col-md-12">
         <div class="card">
            <div class="card-header">
                <a href="{{route('kk.create')}}" class="btn btn-success float-right" role="button">
                Tambah Data
                <i class="fas fa-plus-square"></i>
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="example" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center" width="10">No</th>
                                <th class="text-center">No KK</th>
                                <th class="text-center">Kepala Keluarga</th>
                                <th class="text-center">Alamat</th>
                                <th class="text-center">Anggota</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php $no = 1; @endphp
                        @forelse ($kk as $k)
                        <tr align="center">
                            <td align="center">{{ $no++ }}</td>
                            <td>{{ $k->no_kk }}</td>
                            <td>{{ $k->nama_kepala_keluarga}}</td>
                            <td>{{ $k->alamat}}</td>
                            <td>
                                <!-- anggota -->
                                <a href="{{ route('kk.show', ['kk' => $k]) }}" class="btn btn-sm btn-warning" role="button">
                                    <i class="fas fa-users"></i>
                                </a>
                            </td>
                            <td>
                            <!-- edit -->
                            <a href="{{ route('kk.edit', ['kk' => $k]) }}" class="btn btn-sm btn-info" role="button">
                                <i class="fas fa-edit"></i>
                            </a>
                            <!-- delete -->
                            <form class="d-inline" role="alert" action="{{route('kk.destroy',['kk' => $k])}}" method="POST" alert-title = "Hapus KK?" alert-text = "Apakah anda yakin ingin menghapus data ini?">
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
