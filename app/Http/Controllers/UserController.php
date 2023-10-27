<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Mail;
use App\Mail\AddUserMail;
use Hash;
use Session;
class UserController extends Controller
{
    // function to store new user
    public function store(Request $request)
    {
        $request->validate([
            'firstname'=>'required',
            'lastname'=>'required',
            'email'=>'required|email|unique:users',
            'phone'=>'required|min:10|max:10'
        ]);

        $randompassword=rand(100000,999999);
        $insertdata=[
            'firstname'=>$request->firstname,
            'lastname'=>$request->lastname,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'password'=>Hash::make($randompassword),
            'owner_id'=>auth()->id(),
            'is_firsttime_login'=>'1'
        ];

        $userdata=User::create($insertdata);

        // dispatch(function() use($userdata,$randompassword){
        //     Mail::to($userdata->email)->send(new AddUserMail($userdata,$randompassword));
        // });
        Mail::to($userdata->email)->send(new AddUserMail($userdata,$randompassword));

        $users=User::where('owner_id',auth()->id())->get();
        return view('userlist',compact('users'));
    }

    // function to update user
    public function update(Request $request)
    {
        $request->validate([
            'firstname'=>'required',
            'lastname'=>'required',
            'email'=>'required|email|unique:users',
            'phone'=>'required|min:10|max:10'
        ]);
        $user=User::findOrFail($request->user_id);
        $updatedata=[
            'firstname'=>$request->firstname,
            'lastname'=>$request->lastname,
            'email'=>$request->email,
            'phone'=>$request->phone
        ];
        $user->update($updatedata);
        $users=User::where('owner_id',auth()->id())->get();
        return view('userlist',compact('users'));
    }

    // function to delete user
    public function destroy(Request $request)
    {
        $deleteuser=User::findOrFail($request->user_id)->delete();
        $users=User::where('owner_id',auth()->id())->get();
        return view('userlist',compact('users'));
    }

}
