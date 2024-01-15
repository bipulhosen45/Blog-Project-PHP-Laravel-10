@extends('backend.auth.layouts.master')
@section('admin_title', 'Register')

@section('content')

<p class="login-box-msg">Register a new membership</p>
  
<form action="{{ route('register') }}" method="POST">
  @csrf

<!-- Name -->
  <div class="input-group mb-3">
    <input type="text" class="{{$errors->has('name') ? 'is-invalid form-control' : 'form-control'}}" name="name" id="name" placeholder="Full name" :value="old('name')" autofocus autocomplete="name">
    <div class="input-group-append">
      <div class="input-group-text">
        <span class="fas fa-user"></span>
      </div>
    </div>
</div>
@error('name')
<p class="text-danger">{{$message}} </p>
@enderror
      <!-- Email Address -->
  <div class="input-group mb-3">
    <input type="email" class="{{$errors->has('email') ? 'is-invalid form-control' : 'form-control'}}" name="email" id="email" placeholder="Email" :value="old('email')" autocomplete="username">
    <div class="input-group-append">
      <div class="input-group-text">
        <span class="fas fa-envelope"></span>
      </div>
    </div>
</div>
@error('email')
<p class="text-danger">{{$message}} </p>
@enderror
      <!-- Password Address -->
  <div class="input-group mb-3">
    <input type="password" class="{{$errors->has('password') ? 'is-invalid form-control' : 'form-control'}}" name="password" id="password" placeholder="Password" :value="__('Password')" autocomplete="new-password">
    <div class="input-group-append">
      <div class="input-group-text">
        <span class="fas fa-lock"></span>
      </div>
    </div>
</div>
@error('password')
<p class="text-danger">{{$message}} </p>
@enderror
      <!-- Confirm Password Address -->
  <div class="input-group mb-3">
    <input type="password" class="{{$errors->has('password_confirmation') ? 'is-invalid form-control' : 'form-control'}}" name="password_confirmation" id="password_confirmation" placeholder="Retype password" :value="__('Confirm Password')" autocomplete="new-password">
    <div class="input-group-append">
      <div class="input-group-text">
        <span class="fas fa-lock"></span>
      </div>
    </div>
  </div>
  
  <div class="row">
    <div class="col-8">
      <div class="icheck-primary">
        <input type="checkbox" id="agreeTerms" name="terms" value="agree">
        <label for="agreeTerms">
         I agree to the <a href="#">terms</a>
        </label>
      </div>
    </div>
    <!-- /.col -->
    <!-- /.col -->
  </div>
  <div class="d-grid mt-3">
    <button type="submit" class="btn btn-primary btn-block">Register</button>
  </div>
</form>

<div class="mt-2">
  <a href="{{route('login')}}" class="text-center mt-2">I already have a membership</a>
</div>
</div>

@endsection
