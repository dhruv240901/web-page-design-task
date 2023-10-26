<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OtherUser;
use Session;
class UserController extends Controller
{
    // function to store new user
    public function store(Request $request)
    {
        $request->validate([
            'firstname'=>'required',
            'lastname'=>'required',
            'email'=>'required|email',
            'phone'=>'required|min:10|max:10'
        ]);

        $insertdata=[
            'firstname'=>$request->firstname,
            'lastname'=>$request->lastname,
            'email'=>$request->email,
            'phone'=>$request->phone
        ];
        OtherUser::create($insertdata);
        $otheruser=OtherUser::get();
        session()->flash('message', 'User Added Successfully!');
        return view('userlist',compact('otheruser'));
    }

    // function to update user
    public function update(Request $request)
    {
        $request->validate([
            'user_id'=>'required',
            'firstname'=>'required',
            'lastname'=>'required',
            'email'=>'required|email',
            'phone'=>'required|min:10|max:10'
        ]);
        $user=OtherUser::findOrFail($request->user_id);
        $updatedata=[
            'firstname'=>$request->firstname,
            'lastname'=>$request->lastname,
            'email'=>$request->email,
            'phone'=>$request->phone
        ];
        $user->update($updatedata);
        $otheruser=OtherUser::get();
        session()->flash('message', 'User Updated Successfully!');
        return view('userlist',compact('otheruser'));
    }

    // function to delete user
    public function destroy(Request $request)
    {
        $deleteuser=OtherUser::findOrFail($request->user_id)->delete();
        $otheruser=OtherUser::get();
        session()->flash('message', 'User Deleted Successfully!');
        return view('userlist',compact('otheruser'));
    }
}
