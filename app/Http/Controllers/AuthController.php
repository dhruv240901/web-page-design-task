<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Hash;
use App\Models\User;

class AuthController extends Controller
{
     // function to render signup form
    public function signup(Request $request){
        if(Auth::check()){
            return redirect()->route('index');
        }
        return view('signup');
    }

    // function to create user account
    public function CustomSignup(Request $request){
       $validator=$request->validate([
            'name'=>'required',
            'email'=>'required|email',
            'password'=>'required|min:6'
       ]);

       $checkemailunique=User::where('email',$request->email)->first();

       if($checkemailunique!=null){
            return redirect()->route('signup')->with('error','Email Id already exists');
       }
       else{
            $insertdata=[
                    'name'=>$request->name,
                    'email'=>$request->email,
                    'password'=>Hash::make($request->password),
            ];
            User::create($insertdata);
            return redirect()->route('login')->with('success','Account created successfully!');
       }
    }

    // function to render login page
    public function login(Request $request){
        if(Auth::check()){
            return redirect()->route('index');
        }
        return view('login');
    }

    // function to login user into their account
    public function CustomLogin(Request $request){
        $validator=$request->validate([
            'email'=>'required|email',
            'password'=>'required|min:6'
       ]);

       $credentials=$request->only('email','password');
       if(Auth::attempt($credentials)){
            return redirect()->route('index')->with('success','Logged In successfully!');
       }
       return redirect()->route('login')->with('error','Invalid Credentials!');
    }

    // function to logout user
    public function logout(Request $request){
       auth()->logout();
       return redirect()->route('index')->with('success','Logout Successfully!');
    }
}
