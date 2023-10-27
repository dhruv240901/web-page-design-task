<?php

namespace App\Http\Controllers;

use App\Models\User;
class HomeController extends Controller
{
    // function to render home page
    public function index(){
        $users=User::where('owner_id',auth()->id())->get();
        return view('index',compact('users'));
    }
}
