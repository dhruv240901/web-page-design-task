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
                                <a href="javascript:void(0);" type="button" class="btn btn-primary" onclick="openaddmodal()">
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
                       @include('userlist')
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
        $("#exampleInputfirstname-error").hide();
        let firstnameError = true;
        $("#firstname").keyup(function () {
            validateFirstname();
        });

        function validateFirstname() {
            let firstnameValue = $("#firstname").val();
            if (firstnameValue.length == "") {
                $("#exampleInputfirstname-error").show();
                $("#exampleInputfirstname-error").html("Please enter firstname");
                firstnameError = false;
                return false;
            } else {
                $("#exampleInputfirstname-error").hide();
                firstnameError = true;
            }
        }


        $("#exampleInputlastname-error").hide();
        let lastnameError = true;
        $("#lastname").keyup(function () {
            validateLastname();
        });

        function validateLastname() {
            let lastnameValue = $("#lastname").val();
            if (lastnameValue.length == "") {
                $("#exampleInputlastname-error").show();
                $("#exampleInputlastname-error").html("Please enter lastname");
                lastnameError = false;
                return false;
            } else {
                $("#exampleInputlastname-error").hide();
                lastnameError = true;
            }
        }

        $("#exampleInputEmail-error").hide();
        let emailError = true;
        $("#Email").keyup(function () {
            validateEmail();
        });

        function validateEmail() {
            let emailValue = $("#Email").val();
            let regex =
                /^([_\-\.0-9a-zA-Z]+)@([_\-\.0-9a-zA-Z]+)\.([a-zA-Z]){2,7}$/;
            if (emailValue.length == "") {
                $("#exampleInputEmail-error").show();
                $("#exampleInputEmail-error").html("Please enter email");
                emailError = false;
                return false;
            } else if (!regex.test(emailValue)) {
                $("#exampleInputEmail-error").show();
                $("#exampleInputEmail-error").html("Please enter valid email");
                emailError = false;
            } else {
                $("#exampleInputEmail-error").hide();
                emailError=true;
            }
        }


        $("#exampleInputPhone-error").hide();
        let phoneError = true;
        $("#Phone").keyup(function () {
            validatePhone();
        });

        function validatePhone() {
            let phoneValue = $("#Phone").val();
            if (phoneValue.length == "") {
                $("#exampleInputPhone-error").show();
                $("#exampleInputPhone-error").html("Please enter phone number");
                phoneError = false;
                return false;
            }else if(phoneValue.length != 10){
                $("#exampleInputPhone-error").show();
                $("#exampleInputPhone-error").html("Please enter valid phone number");
                phoneError = false;
                return false;
            }
            else {
                $("#exampleInputPhone-error").hide();
                phoneError = true;
            }
        }

        $("#adduserbtn").click(function () {
            validateFirstname();
            validateLastname();
            validateEmail();
            validatePhone();
            if (
                firstnameError == true &&
                lastnameError == true &&
                emailError==true &&
                phoneError==true
            ) {
                $.ajax({
                    method: "POST",
                    url: "{{ route('store-user') }}",
                    data: $("#adduserform").serialize(),
                    dataType: "html",
                    success:function(data){
                        $("#addUserModal").modal("toggle");
                        $('#userdata').html(data)
                        $('#adduserform')[0].reset();
                        {{-- // toastr.success("{{Session::get('message')}}") --}}
                    }
                })
                return true
            } else {
                return false;
            }
        });

        $("#edituserbtn").click(function () {
            $.ajax({
                method: "POST",
                url: "{{ route('update-user') }}",
                data: $("#edituserform").serialize(),
                dataType: "html",
                success:function(data){
                    $("#editUserModal").modal("toggle");
                    $('#userdata').html(data)
                    toastr.success("{{Session::get('message')}}")
                }
            })
        });

        $("#deleteuserbtn").click(function () {
            $.ajax({
                method: "POST",
                url: "{{ route('delete-user') }}",
                data: $("#deleteuserform").serialize(),
                dataType: "html",
                success:function(data){
                    $('#userdata').html(data)
                    toastr.success("{{Session::get('message')}}")
                }
            })
        });
    });
    function openaddmodal()
    {
        $('#addUserModal').modal('show');
    }
    function openeditmodal(id,firstname,lastname,email,phone)
    {
        $('#editUserModal').modal('show');
        $('#user_id').val(id);
        $('#oldfirstname').val(firstname);
        $('#oldlastname').val(lastname);
        $('#oldEmail').val(email);
        $('#oldPhone').val(phone);
    }

    function opendeletemodal(id)
    {
        $('#deleteUserModal').modal('show');
        $('#userid').val(id);
    }
@endsection
