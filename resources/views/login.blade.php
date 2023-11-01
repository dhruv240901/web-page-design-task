@extends('layouts.auth')
@section('title','Login')
@section('content')
    <form class="col-md-4 border rounded pb-3" method="POST" action="{{route('custom-login')}}" id="loginform">
        @csrf
        @include('components.flash')

        <h3 class="text-center mt-2">Login</h3>
        <div class="mb-3 px-4">
          <label for="exampleInputEmail1" class="form-label">Email address</label>
          <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email">
        </div>
        <div class="mb-3 px-4">
          <label for="exampleInputPassword1" class="form-label">Password</label>
          <input type="password" class="form-control" id="exampleInputPassword1" name="password">
        </div>
        <p class="px-4">Create a new account? <a href="{{route('signup')}}">signup</a></p>
        <div class="mb-3 px-4 d-flex justify-content-center">
            <button type="submit" class="btn btn-primary px-4">Login</button>
        </div>
    </form>
@endsection
