<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OtherUser;
class HomeController extends Controller
{
    // function to render home page
    public function index(){
        $otheruser=OtherUser::get();
        return view('index',compact('otheruser'));
    }
}
