@extends('layouts.auth')
@section('content')
    <form class="user" method="POST" action="{{ route('login') }}">
        @csrf
        <div class="form-group">
            <input type="email" class="form-control form-control-user  @error('email') is-invalid @enderror" value="{{ old('email') }}" autocomplete="email"
                   id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address" name="email">
            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group">
            <input type="password" class="form-control form-control-user  @error('password') is-invalid @enderror"
                   id="exampleInputPassword" placeholder="Enter Password" name="password">
            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <br>
        <button type="submit" class="btn btn-info btn-user btn-block">
            Login
        </button>

    </form>
    
    <div class="text-center">

    </div>
@endsection
