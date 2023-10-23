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
        <div class="row mt-3 profilecard">
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
        <div class="d-flex mt-5" style="justify-content: center">
        <table class="table table-striped" style="width: 75%;background-color: #e8e9df;">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">First</th>
                <th scope="col">Last</th>
                <th scope="col">Handle</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">1</th>
                <td>Mark</td>
                <td>Otto</td>
                <td>@mdo</td>
              </tr>
              <tr>
                <th scope="row">2</th>
                <td>Jacob</td>
                <td>Thornton</td>
                <td>@fat</td>
              </tr>
              <tr>
                <th scope="row">3</th>
                <td colspan="2">Larry the Bird</td>
                <td>@twitter</td>
              </tr>
            </tbody>
          </table>
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
