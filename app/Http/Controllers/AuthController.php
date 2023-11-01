<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Hash;
use App\Models\User;

class AuthController extends Controller
{
     // function to render signup form
    public function signup(){
        if(Auth::check()){
            return redirect()->route('index');
        }
        return view('signup');
    }

    // function to create user account
    public function CustomSignup(Request $request){
       $validator=$request->validate([
            'firstname'       =>'required',
            'lastname'        =>'required',
            'email'           =>'required|email|unique:users',
            'phone'           =>'required|min:10|max:10|numeric',
            'password'        =>'required|min:6',
            'confirmpassword' =>'required|min:6|same:password'
       ]);

       $checkemailunique=User::where('email',$request->email)->first();

       if($checkemailunique!=null){
            return redirect()->route('signup')->with('error','Email Id already exists');
       }
       else{
            $insertdata=[
                'firstname' =>$request->firstname,
                'lastname'  =>$request->lastname,
                'email'     =>$request->email,
                'phone'     =>$request->phone,
                'password'  =>Hash::make($request->password),
            ];
            User::create($insertdata);
            return redirect()->route('login')->with('success','Account created successfully!');
       }
    }

    // function to render login page
    public function login(){
        if(Auth::check()){
            return redirect()->route('index');
        }
        return view('login');
    }

    // function to login user into their account
    public function CustomLogin(Request $request){
        $validator=$request->validate([
            'email'    =>'required|email',
            'password' =>'required|min:6'
       ]);

       $credentials=$request->only('email','password');
       if(Auth::attempt($credentials)){
            if(auth()->user()->is_firsttime_login=='1'){
                return redirect()->route('view-change-password')->with('success','Please change your password!');
            }
            return redirect()->route('index')->with('success','Logged In successfully!');
       }
       return redirect()->route('login')->with('error','Invalid Credentials!');
    }

    // function to logout user
    public function logout(){
       auth()->logout();
       return redirect()->route('index')->with('success','Logout Successfully!');
    }

    // function to check email is unique or not
    public function CheckUniqueEmail(Request $request)
    {
        $user=User::where('email',$request->email)->first();
        if($user){
            return 'false';
        }else{
            return 'true';
        }
    }

    // function to render change password form
    public function ViewChangePassword()
    {
        return view('changepassword');
    }

    // function to update password
    public function ChangePassword(Request $request)
    {
        $user=User::where('email',auth()->user()->email)->first();
        $user->update(['password'=>Hash::make($request->password),'is_firsttime_login'=>'0']);
        return redirect()->route('login')->with('success','Password Changed Successfully Please login!');
    }
}
