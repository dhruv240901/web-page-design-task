@extends('layouts.app')

@section('content')
    <div class="display-area p-3">
        <div class="row page-titles mt-3 day-time" style="float:right;margin-right:10px">
            <div class="col-md-6 col-4 align-self-center">
                <div class=" float-right mr-2 hidden-sm-down">
                    <button class="btn btn-secondary datetime" type="button" id="dropdownMenuButton" aria-haspopup="true"
                        aria-expanded="false" style="cursor: default;" disabled></button>
                </div>
            </div>
        </div>
        <div class="row mt-5 profilecard">
            <div class="card mb-3">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="{{ asset('images/profile-icon.svg') }}" alt="user">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">Dhruv Patel</h5>
                            <a href="#">dhruv@gmail.com</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
