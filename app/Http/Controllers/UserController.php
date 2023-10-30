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
        if($userdata){
            $users=User::where('owner_id',auth()->id())->get();
            $userlist='';
            foreach($users as $k=>$value){
                $userlist.='<tr id="user'.$value->id.'">
                <input type="hidden" value="'.$value->id.'" id="user_id" name="user_id">
                <th scope="row">'. $k + 1 .'</th>
                <td>'. $value->firstname .'</td>
                <td>'. $value->lastname .'</td>
                <td>'. $value->email .'</td>
                <td>'. $value->phone .'</td>
                <td>
                    <a href="javascript:void(0);" type="button" onclick="openeditmodal('.$value->id.','.$value->firstname.','.$value->lastname.','.$value->email.',"'.$value->phone.'")" class="btn btn-success">
                        <img src="'. asset('images/edit.svg') .'" alt="">
                    </a>
                    <a href="javascript:void(0);" type="button" onclick="opendeletemodal('.$value->id.')" class="btn btn-danger">
                        <img src="'. asset('images/delete.svg') .'" alt="">
                    </a>
                </td>
            </tr>';
            }

            $response=[
                'status'=>'success',
                'message'=>'User Account Created Successfully',
                'data'=>$userlist
            ];
        }else {
            $response=[
                'status'=>'error',
                'message'=>'User Not Account Created',
            ];
        }
        return $response;
    }

    // function to update user
    public function update(Request $request)
    {
        $request->validate([
            'firstname'=>'required',
            'lastname'=>'required',
            'email'=>'required|email',
            'phone'=>'required|min:10|max:10'
        ]);
        $user=User::findOrFail($request->user_id);
        $updatedata=[
            'firstname'=>$request->firstname,
            'lastname'=>$request->lastname,
            'email'=>$request->email,
            'phone'=>$request->phone
        ];
        $updateuser=$user->update($updatedata);
        if($updateuser){
            $users=User::where('owner_id',auth()->id())->get();
            $userlist='';
            foreach($users as $k=>$value){
                $userlist.='<tr id="user'.$value->id.'">
                <input type="hidden" value="'.$value->id.'" id="user_id" name="user_id">
                <th scope="row">'. $k + 1 .'</th>
                <td>'. $value->firstname .'</td>
                <td>'. $value->lastname .'</td>
                <td>'. $value->email .'</td>
                <td>'. $value->phone .'</td>
                <td>
                    <a href="javascript:void(0);" type="button" onclick="openeditmodal('.$value->id.','.$value->firstname.','.$value->lastname.','.$value->email.',"'.$value->phone.'")" class="btn btn-success">
                        <img src="'. asset('images/edit.svg') .'" alt="">
                    </a>
                    <a href="javascript:void(0);" type="button" onclick="opendeletemodal('.$value->id.')" class="btn btn-danger">
                        <img src="'. asset('images/delete.svg') .'" alt="">
                    </a>
                </td>
            </tr>';
            }

            $response=[
                'status'=>'success',
                'message'=>'User Account Updated Successfully',
                'data'=>$userlist
            ];
        }else {
            $response=[
                'status'=>'error',
                'message'=>'User Account Not Updated',
            ];
        }
        return $response;
    }

    // function to delete user
    public function destroy(Request $request)
    {
        $deleteuser=User::findOrFail($request->user_id)->delete();
        if($deleteuser){
            $users=User::where('owner_id',auth()->id())->get();
            $userlist='';
            foreach($users as $k=>$value){
                $userlist.='<tr id="user'.$value->id.'">
                <input type="hidden" value="'.$value->id.'" id="user_id" name="user_id">
                <th scope="row">'. $k + 1 .'</th>
                <td>'. $value->firstname .'</td>
                <td>'. $value->lastname .'</td>
                <td>'. $value->email .'</td>
                <td>'. $value->phone .'</td>
                <td>
                    <a href="javascript:void(0);" type="button" onclick="openeditmodal('.$value->id.','.$value->firstname.','.$value->lastname.','.$value->email.',"'.$value->phone.'")" class="btn btn-success">
                        <img src="'. asset('images/edit.svg') .'" alt="">
                    </a>
                    <a href="javascript:void(0);" type="button" onclick="opendeletemodal('.$value->id.')" class="btn btn-danger">
                        <img src="'. asset('images/delete.svg') .'" alt="">
                    </a>
                </td>
            </tr>';
            }

            $response=[
                'status'=>'success',
                'message'=>'User Account Deleted Successfully',
                'data'=>$userlist
            ];
        }else{
            $response=[
                'status'=>'error',
                'message'=>'User Account Not Deleted Successfully'
            ];
        }
        return $response;
    }
}
