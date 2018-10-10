<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function userRegister(Request $request){
    	return view('users.user_register');
    }
}
