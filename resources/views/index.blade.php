@extends('layouts.app')

@section('content')


    <div class="display-area p-3">
        @include('components.flash')
        <div class="row page-titles mt-3 day-time" style="float:right;margin-right:10px">
            <div class="col-md-6 col-4 align-self-center">
                <div class=" float-right mr-2 hidden-sm-down">
                    <button class="btn btn-secondary datetime" type="button" id="dropdownMenuButton" aria-haspopup="true"
                        aria-expanded="false" style="cursor: default;" disabled></button>
                </div>
            </div>
        </div>

        @auth
        <div class="row mt-5 profilecard">
            <div class="card mb-3">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="{{ asset('images/profile-icon.svg') }}" alt="user">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">{{auth()->user()->name}}</h5>
                            <a href="#">{{auth()->user()->email}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endauth

        @guest
        <div style="text-align: center;margin-top: 10%;font-family: 'Vesper Libre', serif;
        font-family: 'Young Serif', serif;">
            <h1 class="display-1">Welcome to Our</h1></br>
            <h1 class="display-1">Website</h1>
        </div>
        @endguest
    </div>

@endsection
