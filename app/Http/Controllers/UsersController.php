<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{
    public function userRegister(Request $request){
    	if($request->isMethod('post')){
    		$data = $request->all();
    		// Check if user already exists
    		$usersCount = User::where(['email'=>$data['email']])->count();
    		if($usersCount > 0){
    			return redirect()->back()->with('flash_message_error','Email already exists!');
    		}
    	}
    	return view('users.user_register');
    }

    public function checkEmail(Request $request){
    	$data = $request->all();
    	$usersCount = User::where(['email'=>$data['email']])->count();
    	if($usersCount > 0){
    		echo "false";
    	}else{
    		echo "true";die;
    	}
    }
}
