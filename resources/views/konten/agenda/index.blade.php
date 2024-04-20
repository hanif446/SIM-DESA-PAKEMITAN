@extends('layouts.dashboard')
@section('breadcrumbs')
{{Breadcrumbs::render('dashboard_agenda')}}
@endsection
@section('agenda', 'active')
@section('main_konten', 'show')
@section('content')
@include('layouts.alert')
<div class="row">
    <div class="col-md-12">
       <div class="card">
          <div class="card-header">
            <a href="{{route('agenda.create')}}" class="btn btn-success float-right" role="button">
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
                              <th class="text-center">Judul</th>
                              <th class="text-center">Deskripsi</th>
                              <th class="text-center">Tanggal Kegiatan</th>
                              <th class="text-center">Waktu Kegiatan</th>
                              <th class="text-center">Tempat</th>
                              <th class="text-center">Action</th>
                          </tr>
                      </thead>
                      <tbody>
                      @php $no = 1; @endphp
                      @forelse ($agenda as $a)
                      <tr align="center">
                          <td align="center">{{ $no++ }}</td>
                          <td>{{ $a->judul }}</td>
                          <td>{{ $a->deskripsi }}</td>
                          <td>{{ $a->tgl_kegiatan }}</td>
                          <td>{{ $a->waktu_mulai }} s/d {{ $a->waktu_selesai }}</td>
                          <td>{{ $a->tempat }}</td>
                          <td>
                              <!-- edit -->
                              <a href="{{ route('agenda.edit', ['agenda' => $a]) }}" class="btn btn-sm btn-info" role="button">
                                  <i class="fas fa-edit"></i>
                              </a>
                              <!-- delete -->
                              <form class="d-inline" role="alert" action="{{route('agenda.destroy',['agenda' => $a])}}" method="POST" alert-title = "Hapus Agenda?" alert-text = "Apakah anda yakin ingin menghapus data ini?">
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
