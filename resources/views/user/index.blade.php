@extends('layouts.dashboard')
@section('breadcrumbs')
{{Breadcrumbs::render('dashboard_users')}}
@endsection
@section('content')
    {{--    Message Alert --}}
    @include('layouts.alert')

    <div class="row">
	   <div class="col-md-12">
	      <div class="card">
	         <div class="card-header">
	            <div class="row">
	               <div class="col-md-6">
	                  <form action="" method="GET">
	                  	<div class="col-md-6">
	                     <div class="input-group">
	                        <input name="keyword" value="{{ request()->get('keyword') }}" type="search" class="form-control" placeholder="Search for users">
	                        <div class="input-group-append">
	                           <button class="btn btn-success" type="submit">
	                              <i class="fas fa-search"></i>
	                           </button>
	                        </div>
	                     </div>
	                 	</div>
	                  </form>
	               </div>
	               <div class="col-md-6">
	               	@can('user_create')
	               		<a href="{{route('user.create')}}" class="btn btn-success float-right" role="button">
	                     Tambah Data
		                     <i class="fas fa-plus-square"></i>
		                 </a>
	               	@endcan
	               </div>
	            </div>
	         </div>
	         <div class="card-body">
	            <div class="row">
	               <!-- list users -->
	               @forelse ($users as $user)
	               	<div class="col-md-6">
					   <div class="card my-1">
					      <div class="card-body">
					         <div class="row">
					            <div class="col-md-2">
					               <i class="fas fa-id-badge fa-5x"></i>
					            </div>
					            <div class="col-md-10">
					               <table>
					                  <tr>
					                     <th>
					                        Username
					                     </th>
					                     <td>:</td>
					                     <td>
					                        {{ $user->username }}
					                     </td>
					                  </tr>
					                  <tr>
					                     <th>
					                        Email
					                     </th>
					                     <td>:</td>
					                     <td>
					                        {{ $user->email }}
					                     </td>
					                  </tr>
					                  <tr>
					                     <th>
					                        Role
					                     </th>
					                     <td>:</td>
					                     <td>
					                     	{{ $user->roles->first()->name }}
					                     </td>
					                  </tr>
					               </table>
					            </div>
					         </div>
					         <div class="float-right">
					            <!-- edit -->
					            @can('user_update')
					            	<a href="{{route('user.edit', ['user' => $user])}}" class="btn btn-sm btn-info" role="button">
					               		<i class="fas fa-edit"></i>
					            	</a>
	               				@endcan
					            <!-- delete -->
					            @can('user_delete')
					            	<form class="d-inline" role="alert" action="{{route('user.destroy',['user' => $user])}}"method="POST" alert-title = "Hapus User?" alert-text = "Apakah anda yakin ingin mengahpus data ini?">
		                              @csrf
		                              @method('DELETE')
		                              <button type="submit" class="btn btn-sm btn-danger">
		                                 <i class="fas fa-trash"></i>
		                              </button>
		                           </form>
	               				@endcan
					         </div>
					      </div>
					   </div>
					</div>
	               @empty
	               		<p>
	               			<strong>
	               				@if (request()->get('keyword'))
			                     {{request()->get('keyword')}} Not Found in User
			                    @else
			                      No Users Data Yet
			                    @endif
	               			</strong>
	               		</p>
	               @endforelse
	            </div>
	         </div>
	         @if ($users->hasPages())
	           <div class="card-footer">
	              {{$users->links('vendor.pagination.bootstrap-5')}}
	           </div>
	         @endif
	      </div>
	   </div>
	</div>
@endsection

@push('javascript-internal')
    <script>
        $(document).ready(function () {
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
