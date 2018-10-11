<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class UsersController extends Controller
{
	public function userLogin(){
		return view('users.user_register');
	}

    public function userRegister(Request $request){
    	if($request->isMethod('post')){
    		$data = $request->all();
    		// Check if user already exists
    		$usersCount = User::where(['email'=>$data['email']])->count();
    		if($usersCount > 0){
    			return redirect()->back()->with('flash_message_error','Email already exists!');
    		}else{
    			$user = new User;
    			$user->name = $data['name'];
    			$user->email = $data['email'];
    			$user->password = bcrypt($data['password']);
    			$user->save();
    			if(Auth::attempt(['email'=>$data['email'],'password'=>$data['password']])){
    				return redirect('/cart');
    			}
    		}
    	}
    }

    public function userLogout(){
    	Auth::logout();
    	return redirect('/');
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
