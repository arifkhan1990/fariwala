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

    public function userAccount(Request $request){
    	$user_id = Auth::user()->id;
    	$countries = Country::get();
    	$userDetails = User::find($user_id);
    	if($request->isMethod('post')){
    		$data = $request->all();
    		if(empty($data['name'])){
    			return redirect()->back()->with('flash_message_error','Please enter your name to update your account details!');
    		}
    		if(empty($data['address'])){
    			$data['address'] = '';
    		}
    		if(empty($data['city'])){
    			$data['city'] = '';
    		}
    		if(empty($data['state'])){
    			$data['state'] = '';
    		}
    		if(empty($data['country'])){
    			$data['country'] = '';
    		}
    		if(empty($data['zipcode'])){
    			$data['zipcode'] = '';
    		}
    		if(empty($data['phone'])){
    			$data['phone'] = '';
    		}
    		$user = User::find($user_id);
    		$user->name = $data['name'];
    		$user->address = $data['address'];
    		$user->city = $data['city'];
    		$user->state = $data['state'];
    		$user->country = $data['country'];
    		$user->zipcode = $data['zipcode'];
    		$user->phone = $data['phone'];
    		$user->save();
    		return redirect()->back()->with('flash_message_success','Your account details has been successfully updated!');

    	}
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
