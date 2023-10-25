@extends('layouts.app')

@section('content')
    <div class="display-area p-3">
        @include('components.flash')
        <div class="row page-titles mt-3 day-time" style="float:right;margin-right:10px">
            <div class="col-md-6 col-4 align-self-center">
                <div class=" float-right mr-2 hidden-sm-down">
                    <button class="btn btn-secondary datetime" type="button" id="dropdownMenuButton" aria-haspopup="true"
                        aria-expanded="false" style="cursor: default;border:2px solid #0e0d0d" disabled></button>
                </div>
            </div>
        </div>

        @auth
            <div class="row mt-3 profilecard">
                <div class="card mb-3" style="border: 2px solid">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="{{ asset('images/profile-icon.svg') }}" alt="user">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">{{ auth()->user()->name }}</h5>
                                <a href="#">{{ auth()->user()->email }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex mt-5" style="justify-content: center">
                <table class="table table-striped" style="width: 75%;background-color: #e8e9df;border:2px solid">
                    <thead>
                        <tr>
                            <td scope="col" colspan="6">
                                <a href="#" type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#addUserModal">
                                    + Add User
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">email</th>
                            <th scope="col">Phone number</th>
                            <th scope="col">Action</th>

                        </tr>
                    </thead>
                    <tbody id="userdata">
                        @foreach ($otheruser as $k => $value)
                            <tr>
                                <th scope="row">{{ $k + 1 }}</th>
                                <td>{{ $value->firstname }}</td>
                                <td>{{ $value->lastname }}</td>
                                <td>{{ $value->email }}</td>
                                <td>{{ $value->phone }}</td>
                                <td>
                                    <a href="javascript:void(0);" type="button" onclick="openeditmodal('{{$value->id}}','{{$value->firstname}}','{{$value->lastname}}','{{$value->email}}','{{$value->phone}}')" class="btn btn-success" style="background-color:#1bcf1b">
                                        <img src="{{ asset('images/edit.svg') }}" alt="">
                                    </a>

                                    <form action="#"
                                        onsubmit="return confirm('Are you sure you want to delete this account?')"
                                        style="display: inline">
                                        <button type="submit" class="btn" style="background-color:red">
                                            <img src="{{ asset('images/delete.svg') }}" alt="">
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        @endauth

        @guest
            <div
                style="text-align: center;margin-top: 10%;font-family: 'Vesper Libre', serif;
        font-family: 'Young Serif', serif;">
                <h1 class="display-1">Welcome to Our</h1></br>
                <h1 class="display-1">Website</h1>
            </div>
        @endguest
    </div>
@endsection
@section('jscontent')
    $(document).ready(function (){
        $("#adduserbtn").click(function () {
            $.ajax({
                method: "POST",
                url: "{{ route('store-user') }}",
                data: $("#adduserform").serialize(),
                dataType: "html",
                success:function(data){
                    $('#userdata').append(data);
                    $('#addUserModal').modal('hide');
                    $('#addUserModal').remove();
                }
            })
        });

    });
    {{-- function openeditmodal(id,firstname,lastname,email,phone)
        {
            $('#editUserModal').modal('show');
            $('#user_id').val(id);
            $('#oldfirstname').val(firstname);
            $('#oldlastname').val(lastname);
            $('#oldEmail').val(email);
            $('#oldPhone').val(phone);
        } --}}
@endsection
