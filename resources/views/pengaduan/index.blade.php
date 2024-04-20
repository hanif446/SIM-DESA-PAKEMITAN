@extends('layouts.dashboard')

@section('breadcrumbs')
{{Breadcrumbs::render('dashboard_pengaduan')}}
@endsection

@section('content')
{{--    Message Alert --}}
@include('layouts.alert')
    <div class="row">
      <div class="col-md-12">
         <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="example" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center" width="10">No</th>
                                <th class="text-center">Judul</th>
                                <th class="text-center">Deskripsi</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php $no = 1; @endphp
                        @forelse ($pengaduan as $p)
                        <tr align="center">
                            <td align="center">{{ $no++ }}</td>
                            <td>{{ $p->judul }}</td>
                            <td>{{ $p->deskripsi}}</td>
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
        })
    </script>
@endpush
