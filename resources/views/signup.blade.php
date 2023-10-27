@extends('layouts.auth')
@section('title', 'Signup')
@section('content')
    <form class="col-md-4 border rounded pb-3" action="{{ route('custom-signup') }}" method="POST" id="signupform">
        <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
        @include('components.flash')
        <h3 class="text-center">Sign Up</h3>
        <div class="mb-3">
            <label for="exampleInputFirstName" class="form-label">First Name</label>
            <input type="text" class="form-control" id="firstname" name="firstname">
        </div>
        <div class="mb-3">
            <label for="exampleInputLastName" class="form-label">Last Name</label>
            <input type="text" class="form-control" id="lastname" name="lastname">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email">
        </div>
        <div class="mb-3">
            <label for="exampleInputPhone" class="form-label">Phone Number</label>
            <input type="text" class="form-control" id="phone" name="phone">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <div class="mb-3">
            <label for="exampleInputConfirmPassword" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" id="confirmpassword" name="confirmpassword">
        </div>
        <p>Already have an account? <a href="{{ route('login') }}">login</a></p>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
