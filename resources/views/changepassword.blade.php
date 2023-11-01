@extends('layouts.auth')
@section('title','Reset Password')
@section('content')
    <form class="col-md-4 border rounded pb-3" method="POST" action="{{route('change-password')}}" id="changepasswordform">
        @csrf
        @include('components.flash')
        <h3 class="text-center">Change Password</h3>
        <div class="mb-3 px-4">
          <label for="exampleInputPassword1" class="form-label">Password</label>
          <input type="password" class="form-control" id="exampleInputPassword1" name="password">
        </div>
        <div class="mb-3 px-4">
            <label for="exampleInputConfirmPassword" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" id="confirmpassword" name="confirmpassword">
        </div>
        <div class="mb-3 px-4 d-flex justify-content-center">
            <button type="submit" class="btn btn-primary">Change Password</button>
        <div class="mb-3 px-4">
    </form>
@endsection
