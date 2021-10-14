@extends('layouts.guest')

@section('content')
@if(Session::has('error'))
    <div class="alert alert-danger">
    {{Session::get('error')}}
    </div>
@endif
<form role="form" method="POST" action="{{ route('login') }}">
    @csrf
    <div class="mb-3">
        <input type="text" class="form-control form-control-lg" placeholder="Email" aria-label="Email" id="email" value="{{old('email')}}" required autofocus name="email"
            aria-describedby="email-addon">
    </div>
    <div class="mb-3">
        <input type="password" class="form-control form-control-lg" placeholder="Password" aria-label="Password" name="password"
            aria-describedby="password-addon">
    </div>
    <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" id="rememberMe">
        <label class="form-check-label" for="rememberMe">Remember me</label>
    </div>
    <div class="text-center">
        <button type="submit" class="btn btn-lg bg-gradient-primary btn-lg w-100 mt-4 mb-0">Sign in</button>
    </div>
</form>
@endsection