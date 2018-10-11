<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\User;
use App\Country;
use Auth;

class UsersController extends Controller
{
	public function userLogin(Request $request){
		if($request->isMethod('post')){
			$data = $request->all();
			if(Auth::attempt(['email'=>$data['email'],'password'=>$data['password']])){
				Session::put('frontSession',$data['email']);
				return redirect('/cart');
			}else{
				return redirect()->back()->with('flash_message_error','Invalid Email or Password');
			}
		}
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
    				Session::put('frontSession',$data['email']);
    				return redirect('/cart');
    			}
    		}
    	}
    }

    public function userAccount(){
    	$user_id = Auth::user()->id;
    	$countries = Country::get();
    	$userDetails = User::find($user_id);
       return view('users.account',['countries'=>$countries,'userDetails'=>$userDetails]);
    }

    public function userLogout(){
    	Auth::logout();
    	Session::forget('frontSession');
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
