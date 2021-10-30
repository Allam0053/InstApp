@extends('layouts.guest')

@section('content')
@if(Session::has('error'))
<div class="alert alert-danger">
    {{Session::get('error')}}
</div>
@endif
<form enctype="multipart/form-data" role="form" method="POST" action="{{ route('register') }}">
    @csrf
    <div class="mb-3">
        <input type="email" class="form-control form-control-lg {{ $errors->has('name') ? 'error' : '' }}" placeholder="Email" aria-label="Email" id="email" value="{{old('email')}}" required autofocus name="email" aria-describedby="email-addon">
        <!-- Error -->
        @if ($errors->has('email'))
        <div class="error">
            {{ $errors->first('email') }}
        </div>
        @endif
    </div>
    <div class="mb-3">
        <input type="password" class="form-control form-control-lg" placeholder="Password" aria-label="Password" name="password" aria-describedby="password-addon">
        <!-- Error -->
        @if ($errors->has('password'))
        <div class="error">
            {{ $errors->first('password') }}
        </div>
        @endif
    </div>
    <div class="mb-3">
        <input type="password" class="form-control form-control-lg" placeholder="Re-enter Password" aria-label="Password" name="password_confirmation" aria-describedby="password-addon">
        <!-- Error -->
        @if ($errors->has('password'))
        <div class="error">
            {{ $errors->first('password') }}
        </div>
        @endif
    </div>
    <div class="mb-3">
        <input type="text" class="form-control form-control-lg" placeholder="Name" aria-label="Name" id="name" value="{{old('name')}}" required autofocus name="name" aria-describedby="email-addon">
        <!-- Error -->
        @if ($errors->has('name'))
        <div class="error">
            {{ $errors->first('name') }}
        </div>
        @endif
    </div>
    <div class="mb-3">
        <input type="file" class="form-control form-control-lg" placeholder="Avatar" aria-label="Avatar" id="avatar" value="{{old('avatar')}}" autofocus name="avatar" aria-describedby="email-addon">
        <!-- Error -->
        @if ($errors->has('avatar'))
        <div class="error">
            {{ $errors->first('avatar') }}
        </div>
        @endif
    </div>
    <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" id="rememberMe">
        <label class="form-check-label" for="rememberMe">Remember me</label>
    </div>
    <div class="text-center">
        <button type="submit" class="btn btn-lg bg-gradient-primary btn-lg w-100 mt-4 mb-0">SIGN UP</button>
    </div>
</form>
@endsection