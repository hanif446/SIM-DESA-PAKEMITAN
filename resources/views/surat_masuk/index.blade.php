@extends('layouts.dashboard')
@section('breadcrumbs')
{{Breadcrumbs::render('dashboard_surat_masuk')}}
@endsection
@section('surat_masuk', 'active')
@section('main_surat', 'show')
@section('content')
{{--    Message Alert --}}
@include('layouts.alert')
    <div class="row">
      <div class="col-md-12">
         <div class="card">
            <div class="card-header">
                <a href="{{route('surat_masuk.create')}}" class="btn btn-success float-right" role="button">
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
                                <th class="text-center">No Surat</th>
                                <th class="text-center">Tanggal Diterima Surat</th>
                                <th class="text-center">Asal Surat</th>
                                <th class="text-center">Tujuan Surat</th>
                                <th class="text-center">Perihal</th>
                                <th class="text-center">File Surat</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php $no = 1; @endphp
                        @forelse ($surat_masuk as $sm)
                        <tr align="center">
                            <td align="center">{{ $no++ }}</td>
                            <td>{{ $sm->no_surat }}</td>
                            <td>{{ date('d F Y', strtotime($sm->tgl_diterima)) }}</td>
                            <td>{{ $sm->asal_surat }}</td>
                            <td>{{ $sm->tujuan_surat }}</td>
                            <td>{{ $sm->perihal }}</td>
                            <td><a href="{{ asset('surat_masuk/'.$sm->file_surat) }}" class="btn btn-primary" target="_blank"><b>Lihat File</b></a></td>
                            <td>
                            <!-- detail -->
                            <a href="{{ route('surat_masuk.show', ['surat_masuk' => $sm]) }}" class="btn btn-sm btn-warning" role="button">
                                <i class="fas fa-eye"></i>
                            </a>
                            <!-- edit -->
                            <a href="{{ route('surat_masuk.edit', ['surat_masuk' => $sm]) }}" class="btn btn-sm btn-info" role="button">
                                <i class="fas fa-edit"></i>
                            </a>
                            <!-- delete -->
                            <form class="d-inline" role="alert" action="{{route('surat_masuk.destroy',['surat_masuk' => $sm])}}" method="POST" alert-title = "Hapus Surat Masuk?" alert-text = "Apakah anda yakin ingin menghapus data ini?">
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
