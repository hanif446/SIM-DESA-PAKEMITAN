@extends('layouts.dashboard')
@section('breadcrumbs')
{{Breadcrumbs::render('dashboard_change_password')}}
@endsection

@section('content')
{{--    Message Alert --}}
    @include('layouts.alert')
	<div class="row">
	   <div class="col-md-12">
	      <div class="card">
	         <div class="card-body">
	            <form action="{{ route('user.update_password') }}" method="POST">
	            	@csrf
	               <!-- name -->
	               <div class="form-group">
	                  <label for="input_user_old_password" class="font-weight-bold">
	                     Password Lama
	                  </label>
	                  <input id="input_user_old_password" value="{{old('old_password')}}" name="old_password" type="password" class="form-control @error('old_password') is-invalid @enderror"  placeholder="Input Password Lama" />
	                  @error('old_password')
		                  <span class="invalid-feedback">
		                 	<strong>
		                 		{{$message}}
		                 	</strong> 	
		                  </span>
	                  @enderror
	               </div>             
	               <!-- password -->
	               <div class="form-group">
	                  <label for="input_user_new_password" class="font-weight-bold">
	                     Password Baru
	                  </label>
	                  <input id="input_user_new_password" name="new_password" value="{{old('new_password')}}" type="password" class="form-control @error('new_password') is-invalid @enderror" placeholder="Input Password Baru"/>
	                  @error('new_password')
		                  <span class="invalid-feedback">
		                 	<strong>
		                 		{{$message}}
		                 	</strong> 	
		                  </span>
	                  @enderror
	               </div>
	               <!-- password_confirmation -->
	               <div class="form-group">
	                  <label for="input_user_password_confirmation" class="font-weight-bold">
	                     Konfirmasi Password
	                  </label>
	                  <input id="input_user_password_confirmation" name="confirm_password" value="{{old('confirm_password')}}" type="password"
	                     class="form-control @error('confirm_password') is-invalid @enderror" placeholder="Konfirmasi Password" />
	                   @error('confirm_password')
		                  <span class="invalid-feedback">
		                 	<strong>
		                 		{{$message}}
		                 	</strong> 	
		                  </span>
	                  @enderror
	                  <!-- error message -->
	               </div>
	               <div class="float-right">
	                  <button type="submit" class="btn btn-info float-right px-4">
	                     Update Password
	                  </button>
	               </div>
	            </form>
	         </div>
	      </div>
	   </div>
	</div>
@endsection

