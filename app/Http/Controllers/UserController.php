<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Mail;
use App\Mail\AddUserMail;
use Hash;
use Auth;

class UserController extends Controller
{
    /* function to return json response */
    private function response($status,$message)
    {
        if($status){
            $users=User::where('owner_id',auth()->id())->orwhere('id',auth()->user()->owner_id)->orwhere('owner_id',auth()->user()->owner_id)->where('owner_id','!=','null')->where('id','!=',auth()->id())->get();
            $response=[
                'status'  =>200,
                'message' =>$message,
                'data'    =>$users
            ];
        }else {
            $response=[
                'status'  =>500,
                'message' =>'Internal Server Error',
            ];
        }
        return $response;
    }

    /* function to store new user */
    public function store(Request $request)
    {
        $request->validate([
            'firstname' =>'required',
            'lastname'  =>'required',
            'email'     =>'required|email|unique:users',
            'phone'     =>'required|regex:"^[0-9]{10}$"'
        ]);

        $randompassword=rand(100000,999999);
        $insertdata=[
            'firstname'          =>$request->firstname,
            'lastname'           =>$request->lastname,
            'email'              =>$request->email,
            'phone'              =>$request->phone,
            'password'           =>Hash::make($randompassword),
            'owner_id'           =>auth()->id(),
            'is_first_login'     =>'1'
        ];

        $userdata=User::create($insertdata);
        $authuser=Auth::user();

        if($userdata){

            dispatch(function() use ($userdata, $randompassword,$authuser){
                Mail::to($userdata['email'])->send(new AddUserMail($userdata,$randompassword,$authuser));
            })->delay(now()->addSeconds(5));

        }
        $response=$this->response($userdata,'User Created Successfully');
        return $response;
    }

    /* function to update user */
    public function update(Request $request)
    {
        $validator=$request->validate([
            'firstname' =>'required',
            'lastname'  =>'required',
            'email'     =>'required|email',
            'phone'     =>'required|regex:"^[0-9]{10}$"'
        ]);

        $user=User::findOrFail($request->user_id);
        $updatedata=[
            'firstname' =>$request->firstname,
            'lastname'  =>$request->lastname,
            'phone'     =>$request->phone
        ];
        $updateuser=$user->update($updatedata);
        $response=$this->response($updateuser,'User Updated Successfully');
        return $response;
    }

    /* function to delete user */
    public function destroy(Request $request)
    {
        $deleteuser=User::findOrFail($request->user_id)->delete();
        $response=$this->response($deleteuser,'User Deleted Successfully');
        return $response;
    }
}
