<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Mail;
use App\Mail\AddUserMail;
use Hash;
use Session;
use Auth;

class UserController extends Controller
{
    // function to store new user
    public function store(Request $request)
    {
        $request->validate([
            'firstname'=>'required',
            'lastname' =>'required',
            'email'    =>'required|email|unique:users',
            'phone'    =>'required|min:10|max:10'
        ]);

        $randompassword=rand(100000,999999);
        $insertdata=[
            'firstname'         =>$request->firstname,
            'lastname'          =>$request->lastname,
            'email'             =>$request->email,
            'phone'             =>$request->phone,
            'password'          =>Hash::make($randompassword),
            'owner_id'          =>auth()->id(),
            'is_firsttime_login'=>'1'
        ];

        $userdata=User::create($insertdata);
        $authuser=Auth::user();
        dispatch(function() use ($userdata, $randompassword,$authuser){
            Mail::to($userdata['email'])->send(new AddUserMail($userdata,$randompassword,$authuser));
        });

        if($userdata){

            $users=User::where('owner_id',auth()->id())->orwhere('id',auth()->user()->owner_id)->orwhere('owner_id',auth()->user()->owner_id)->where('owner_id','!=','null')->get();
            $response=[
                'status' =>200,
                'message'=>'User Account Created Successfully',
                'data'   =>$users
            ];
        }else {
            $response=[
                'status' =>500,
                'message'=>'Internal Server Error',
            ];
        }
        return response()->json($response);
    }

    // function to update user
    public function update(Request $request)
    {
        $request->validate([
            'firstname'=>'required',
            'lastname' =>'required',
            'email'    =>'required|email',
            'phone'    =>'required|min:10|max:10'
        ]);
        $user=User::findOrFail($request->user_id);
        $updatedata=[
            'firstname'=>$request->firstname,
            'lastname' =>$request->lastname,
            'email'    =>$request->email,
            'phone'    =>$request->phone
        ];
        $updateuser=$user->update($updatedata);
        if($updateuser){
            $users=User::where('owner_id',auth()->id())->orwhere('id',auth()->user()->owner_id)->orwhere('owner_id',auth()->user()->owner_id)->where('owner_id','!=','null')->get();
            $response=[
                'status' =>200,
                'message'=>'User Account Updated Successfully',
                'data'   =>$users
            ];
        }else {
            $response=[
                'status' =>500,
                'message'=>'Internal Server Error',
            ];
        }
        return response()->json($response);
    }

    // function to delete user
    public function destroy(Request $request)
    {
        $deleteuser=User::findOrFail($request->user_id)->delete();
        if($deleteuser){
            $users=User::where('owner_id',auth()->id())->orwhere('id',auth()->user()->owner_id)->orwhere('owner_id',auth()->user()->owner_id)->where('owner_id','!=','null')->get();
            $response=[
                'status' =>200,
                'message'=>'User Account Deleted Successfully',
                'data'   =>$users
            ];
        }else{
            $response=[
                'status' =>500,
                'message'=>'Internal Server Error',
            ];
        }
        return response()->json($response);
    }
}
