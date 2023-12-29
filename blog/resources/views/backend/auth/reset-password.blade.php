@extends('backend.auth.layouts.master')
@section('admin_title', 'Reset Password')

@section('content')


@section('content')

          <p class="login-box-msg">You forgot your password? Here you can easily retrieve a new password.</p>

          <form action="{{ route('password.update') }}" method="POST">
            @csrf
                <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <!-- email -->
                <div class="input-group mb-3">
                  <input type="email" class="{{$errors->has('email') ? 'is-invalid form-control' : 'form-control'}}" name="email" id="email" value="{{$request->email}}">
                  <div class="input-group-append">
                    <div class="input-group-text"><span class="fas fa-envelope"></span></div>
                  </div>
                </div>
            @error('email')
            <p class="text-danger">{{$message}} </p>
            @enderror
                  <!-- Password -->
            <div class="input-group mb-3">
              <input type="password" class="{{$errors->has('Password') ? 'is-invalid form-control' : 'form-control'}}" name="password" id="password" placeholder="Password">
              <div class="input-group-append">
                <div class="input-group-text"><span class="fas fa-lock"></span></div>
              </div>
            </div>
            @error('password')
            <p class="text-danger">{{$message}} </p>
            @enderror
                  <!-- confirm Password -->
            <div class="input-group mb-3">
              <input type="password" class="{{$errors->has('password_confirmation') ? 'is-invalid form-control' : 'form-control'}}" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password" >
              <div class="input-group-append">
                <div class="input-group-text"><span class="fas fa-lock"></span></div>
              </div>
            </div>
            @error('password_confirmation')
            <p class="text-danger">{{$message}} </p>
            @enderror
            <div class="row">
              <div class="col-12">
                <button type="submit" class="btn btn-primary btn-block">Update password</button>
              </div>
              <!-- /.col -->
            </div>
          </form>
          <p class="mt-3 mb-1 text-center">
            <a href="{{route('login')}}">Login</a>
          </p>
@endsection