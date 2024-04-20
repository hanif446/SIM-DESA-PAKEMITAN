@extends('layouts.dashboard')
@section('breadcrumbs')
{{Breadcrumbs::render('dashboard_users_edit', $user)}}
@endsection
@section('content')
    <div class="row">
       <div class="col-md-12">
          <div class="card">
             <div class="card-body">
                <form action="{{ route('user.update', ['user' => $user]) }}" method="POST">
                    @csrf
                    @method('PUT')
                   <!-- name -->
                   <div class="form-group">
                      <label for="input_user_name" class="font-weight-bold">
                         Username
                      </label>
                      <input id="input_user_username" value="{{old('username', $user->username)}}" name="username" type="text" class="form-control @error('username') is-invalid @enderror"  placeholder="Input Username" />
                      @error('username')
                          <span class="invalid-feedback">
                            <strong>
                                {{$message}}
                            </strong>   
                          </span>
                      @enderror
                   </div>

                   <!-- email -->
                   <div class="form-group">
                      <label for="input_user_email" class="font-weight-bold">
                         Email
                      </label>
                      <input id="input_user_email" value="{{old('email', $user->email)}}" name="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Input Email"
                         autocomplete="email" />
                      @error('email')
                          <span class="invalid-feedback">
                            <strong>
                                {{$message}}
                            </strong>   
                          </span>
                      @enderror
                   </div>

                   <!-- role -->
                   <div class="form-group">
                      <label for="select_user_role" class="font-weight-bold">
                         Role
                      </label>
                      <select id="select_user_role" name="role" data-placeholder="Choose Role" class="custom-select w-100 @error('role') is-invalid @enderror">
                      @if (old('role', $roleSelected->id))
                        <option value="{{  $roleSelected->id }}" selected>{{ $roleSelected->name }}</option>
                      @endif

                      </select>
                      @error('role')
                          <span class="invalid-feedback">
                            <strong>
                                {{$message}}
                            </strong>   
                          </span>
                      @enderror
                   </div>
                   
                   <div class="float-right">
                      <a href="{{ route('user.index') }}" class="btn btn-warning px-3 mx-2" href="">
                         Kembali
                      </a>
                      <button type="submit" class="btn btn-success float-right px-3">
                         Ubah
                      </button>
                   </div>
                </form>
             </div>
          </div>
       </div>
    </div>
@endsection

@push('css-external')
    <link rel="stylesheet" href="{{asset('template/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('template/select2/css/select2-bootstrap5.min.css')}}">
@endpush

@push('javascript-external')
    <script src="{{asset('template/select2/js/select2.min.js')}}"></script>
@endpush

@push('javascript-internal')
        <script>
            $(function (){
                
                //select role users
                $('#select_user_role').select2({
                    theme: 'bootstrap5',
                    language: "",
                    allowClear: true,
                    ajax: {
                        url: "{{route('roles.select')}}",
                        dataType: 'json',
                        delay: 250,
                        processResults: function(data) {
                            return {
                                results: $.map(data, function(item) {
                                    return {
                                        text: item.name,
                                        id: item.id
                                    }
                                })
                            };
                        }
                    }
                });
            });
        </script>
@endpush
