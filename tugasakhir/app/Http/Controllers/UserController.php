<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index(){
        //get posts
        $user = User::all();
         
      
        //render view with posts
        return view('dashboard.datauser.datauser', compact('user'));
    }
}
