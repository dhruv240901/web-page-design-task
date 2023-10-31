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
                <table class="table table-striped" id="user_table" style="width: 75%;background-color: #e8e9df;border:2px solid">
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
                       {{-- @include('userlist') --}}
                       @foreach ($users as $k => $value)
                        <tr id="user{{$value->id}}">
                            <input type="hidden" value="{{$value->id}}" id="user_id" name="user_id">
                            <th scope="row">{{ $k + 1 }}</th>
                            <td id="firstname{{$value->id}}">{{ $value->firstname }}</td>
                            <td id="lastname{{$value->id}}">{{ $value->lastname }}</td>
                            <td id="email{{$value->id}}">{{ $value->email }}</td>
                            <td id="phone{{$value->id}}">{{ $value->phone }}</td>
                            <td>
                                @auth
                                @if($value->owner_id==auth()->id())
                                <a href="javascript:void(0);" type="button" onclick="openeditmodal('{{$value->id}}')" class="btn btn-success">
                                    <img src="{{ asset('images/edit.svg') }}" alt="">
                                </a>
                                <a href="javascript:void(0);" type="button" onclick="opendeletemodal('{{$value->id}}')" class="btn btn-danger">
                                    <img src="{{ asset('images/delete.svg') }}" alt="">
                                </a>
                                @endif
                                @endauth
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
var table=$('#user_table').DataTable({
    "createdRow" : function ( row, data_use, dataIndex ) {
        $(row).attr('id', dataIndex);
    },
});

function openaddmodal()
{
    $('#UserModal').modal('show');
    $('.modal-title').html('');
    $('.modal-title').html('Add User');
    $('#user_id').val('');
    $('#userform')[0].reset();
    $('.error').hide()
    $('#userbtn').html('');
    $('#userbtn').html('Submit');
}
function openeditmodal(id)
{
    $('#UserModal').modal('show');
    $('.modal-title').html('');
    $('.modal-title').html('Edit User')
    $('#user_id').val(id);
    $('#firstname').val($('#firstname'+id).html())
    $('#lastname').val($('#lastname'+id).html())
    $('#Email').val($('#email'+id).html())
    $('#Phone').val($('#phone'+id).html())
    $('.error').hide()
    $('#userbtn').html('');
    $('#userbtn').html('Update');
}

function opendeletemodal(id)
{
    Swal.fire({
        title: 'Are you sure?',
        text: "You want to delete this user!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                method: "POST",
                url: "{{ route('delete-user') }}",
                data: {
                    '_token':'{{csrf_token()}}',
                    'user_id':id,
                },
                dataType: "json",
                success:function(response){
                    if(response['status']==200){
                        table.clear();
                        var count=1
                        for (var i = 0; i < response['data'].length; i++) {
                            var row = table.row.add([
                                count++,
                                response['data'][i].firstname,
                                response['data'][i].lastname,
                                response['data'][i].email,
                                response['data'][i].phone,
                                `<a href="javascript:void(0);" type="button" class="btn btn-success" onclick="openeditmodal('${response['data'][i].id}')"><img src="{{ asset('images/edit.svg') }}" alt=""></a> <a href="javascript:void(0);" type="button" class="btn btn-danger" onclick="opendeletemodal(${response['data'][i].id})"><img src="{{ asset('images/delete.svg') }}" alt=""></a>`
                            ]).draw(false).node();
                            $(row).find('td:eq(1)').attr('id', 'firstname' + response['data'][i].id);
                            $(row).find('td:eq(2)').attr('id', 'lastname' + response['data'][i].id);
                            $(row).find('td:eq(3)').attr('id', 'email' + response['data'][i].id);
                            $(row).find('td:eq(4)').attr('id', 'phone' + response['data'][i].id);
                        }
                        Swal.fire({
                            icon: 'success',
                            title: 'Deleted!',
                            text:'User has been deleted successfully.',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }
                }
            })
        }
      })
}
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
                if($('#user_id').val()==""){
                    $.ajax({
                        type: 'POST',
                        url: '{{route('check_email_unique')}}',
                        data: { _token:$('#csrf-token').val(),
                                email: $("#Email").val()
                        },
                        success: function (response) {
                            if (response=='false') {
                                $("#exampleInputEmail-error").show();
                                $("#exampleInputEmail-error").html("Email Id already exist");
                                emailError = false;
                            } else {
                                $("#exampleInputEmail-error").hide();
                                emailError=true;
                            }
                        }
                    });
                }
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

        $("#userbtn").click(function () {
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
                if($('#user_id').val()==""){
                    $.ajax({
                        method: "POST",
                        url: "{{ route('store-user') }}",
                        data: $("#userform").serialize(),
                        dataType: "json",
                        success:function(response){
                            if(response['status']==200){
                                table.clear();
                                var count=1
                                for (var i = 0; i < response['data'].length; i++) {
                                    var row = table.row.add([
                                        count++,
                                        response['data'][i].firstname,
                                        response['data'][i].lastname,
                                        response['data'][i].email,
                                        response['data'][i].phone,
                                        `<a href="javascript:void(0);" type="button" class="btn btn-success" onclick="openeditmodal('${response['data'][i].id}')"><img src="{{ asset('images/edit.svg') }}" alt=""></a> <a href="javascript:void(0);" type="button" class="btn btn-danger" onclick="opendeletemodal(${response['data'][i].id})"><img src="{{ asset('images/delete.svg') }}" alt=""></a>`
                                    ]).draw(false).node();
                                    $(row).find('td:eq(1)').attr('id', 'firstname' + response['data'][i].id);
                                    $(row).find('td:eq(2)').attr('id', 'lastname' + response['data'][i].id);
                                    $(row).find('td:eq(3)').attr('id', 'email' + response['data'][i].id);
                                    $(row).find('td:eq(4)').attr('id', 'phone' + response['data'][i].id);
                                }
                                $("#UserModal").modal("toggle");
                                $('#userform')[0].reset();
                                toastr.success(''+response.message+'')
                            }
                        }
                    })

                }
                    else{
                        $.ajax({
                            method: "POST",
                            url: "{{ route('update-user') }}",
                            data: $("#userform").serialize(),
                            dataType: "json",
                            success:function(response){
                                if(response['status']==200){
                                    table.clear();
                                    var count=1
                                    for (var i = 0; i < response['data'].length; i++) {
                                        var row = table.row.add([
                                            count++,
                                            response['data'][i].firstname,
                                            response['data'][i].lastname,
                                            response['data'][i].email,
                                            response['data'][i].phone,
                                            `<a href="javascript:void(0);" type="button" class="btn btn-success" onclick="openeditmodal('${response['data'][i].id}')"><img src="{{ asset('images/edit.svg') }}" alt=""></a> <a href="javascript:void(0);" type="button" class="btn btn-danger" onclick="opendeletemodal(${response['data'][i].id})"><img src="{{ asset('images/delete.svg') }}" alt=""></a>`
                                        ]).draw(false).node();
                                        $(row).find('td:eq(1)').attr('id', 'firstname' + response['data'][i].id);
                                        $(row).find('td:eq(2)').attr('id', 'lastname' + response['data'][i].id);
                                        $(row).find('td:eq(3)').attr('id', 'email' + response['data'][i].id);
                                        $(row).find('td:eq(4)').attr('id', 'phone' + response['data'][i].id);
                                    }
                                    $("#UserModal").modal("toggle");
                                    $('#userform')[0].reset();
                                    toastr.success(''+response.message+'')
                                }
                            }
                        })
                    }
                    return true
                }
            else {
                return false;
            }
        });

        {{-- $("#deleteuserbtn").click(function () {
            $.ajax({
                method: "POST",
                url: "{{ route('delete-user') }}",
                data: $("#deleteuserform").serialize(),
                dataType: "json",
                success:function(response){
                    if(response['status']=='success')
                    {
                        $('#user_table').DataTable().draw();
                        $('#userdata').html(response.data);
                        toastr.success(''+response.message+'')
                    }
                }
            })
        }); --}}
    });

@endsection
