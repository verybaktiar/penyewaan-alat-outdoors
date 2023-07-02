<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index(){
        //get posts
        $user = User::all();
         
      
        if(session('is_logged_in')){
            if(session('is_admin')){
                //render view with posts
                return view('dashboard.datauser.datauser', compact('user'));
            }else{
                return view('forbidden');
            }
        }else{
            return view('adminlogin.index');
        }
    }
}
