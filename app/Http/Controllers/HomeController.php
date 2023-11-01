<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;

class HomeController extends Controller
{
    // function to render home page
    public function index(){
        if(Auth::check()){
            $users=User::where('owner_id',auth()->id())->orwhere('id',auth()->user()->owner_id)->orwhere('owner_id',auth()->user()->owner_id)->where('owner_id','!=','null')->where('id','!=',auth()->id())->get();
        }else{
            $users='';
        }
        return view('index',compact('users'));
    }
}
