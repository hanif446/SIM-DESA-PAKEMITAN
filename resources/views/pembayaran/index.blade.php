@extends('layouts.dashboard')
@section('breadcrumbs')
{{Breadcrumbs::render('dashboard_pembayaran')}}
@endsection
@section('content')
{{--    Message Alert --}}
@include('layouts.alert')
    <div class="row">
      <div class="col-md-12">
         <div class="card">
            <div class="card-header">
                <a href="{{route('pembayaran.create')}}" class="btn btn-success float-right" role="button">
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
                                <th class="text-center">Tanggal Pembayaran</th>
                                <th class="text-center">Jenis Pembayaran</th>
                                <th class="text-center">Total Pembayaran</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php $no = 1; @endphp
                        @forelse ($pembayaran as $p)
                        <tr align="center">
                            <td align="center">{{ $no++ }}</td>
                            <td>{{ $p->no_kk }}</td>
                            <td>{{ $p->nama_kepala_keluarga}}</td>
                            <td>{{ date('d F Y', strtotime($p->tgl_pembayaran)) }}</td>
                            <td>{{ $p->jenis_pembayaran}}</td>
                            <td>Rp. {{number_format($p->total_pembayaran, 0, ',', '.')}}</td>
                            <td>
                            <!-- edit -->
                            <a href="{{ route('pembayaran.edit', ['pembayaran' => $p->pembayaran_id]) }}" class="btn btn-sm btn-info" role="button">
                                <i class="fas fa-edit"></i>
                            </a>
                            <!-- delete -->
                            <form class="d-inline" role="alert" action="{{route('pembayaran.destroy',['pembayaran' => $p->pembayaran_id])}}" method="POST" alert-title = "Hapus Pembayaran?" alert-text = "Apakah anda yakin ingin menghapus data ini?">
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
