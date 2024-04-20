@extends('layouts.dashboard')
@section('breadcrumbs')
{{Breadcrumbs::render('dashboard_galeri')}}
@endsection
@section('galeri', 'active')
@section('main_konten', 'show')
@section('content')
@include('layouts.alert')
<div class="row">
    <div class="col-md-12">
       <div class="card">
          <div class="card-header">
            <a href="{{route('galeri.create')}}" class="btn btn-success float-right" role="button">
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
                              <th class="text-center">Jenis Foto</th>
                              <th class="text-center">Foto</th>
                              <th class="text-center">Action</th>
                          </tr>
                      </thead>
                      <tbody>
                      @php $no = 1; @endphp
                      @forelse ($galeri as $g)
                      <tr align="center">
                          <td align="center">{{ $no++ }}</td>
                          <td>{{ $g->jenis_foto }}</td>
                          <td><a href="{{ asset('galeri/'.$g->foto) }}" class="btn btn-warning" target="_blank"><b>Lihat Foto</b></a></td>
                          <td>
                              <!-- edit -->
                              <a href="{{ route('galeri.edit', ['galeri' => $g]) }}" class="btn btn-sm btn-info" role="button">
                                  <i class="fas fa-edit"></i>
                              </a>
                              <!-- delete -->
                              <form class="d-inline" role="alert" action="{{route('galeri.delete',['galeri' => $g])}}" method="POST" alert-title = "Hapus Foto?" alert-text = "Apakah anda yakin ingin menghapus data ini?">
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
