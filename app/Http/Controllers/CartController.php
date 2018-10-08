<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
session_start();

class CartController extends Controller
{
    public function addToCart(Request $request){
    	$data = $request->all();
    	if(empty($data['user_email'])){
    		$data['user_email'] = '';
    	}
        
        $session_id = Session::get('session_id');
        if(empty($session_id)){
        	$session_id = str_random(40);
        	Session::put('session_id',$session_id);
        }

        //Deleting extra '-' char
    	$sizeArr = explode("-",$data['size']);
    	DB::table('cart')->insert(['product_id'=>$data['product_id'],
    		                       'product_name'=>$data['product_name'],
    		                       'product_code'=>$data['product_code'],
    		                       'product_color'=>$data['product_color'],
    		                       'product_price'=>$data['product_price'],
    		                       'product_size'=>$sizeArr[1],
    		                       'quantity'=>$data['quantity'],
    		                       'user_email'=>$data['user_email'],
    		                       'session_id'=>$session_id,
    ]);
    	return redirect('/cart')->with('flash_message_success','Product has been added to Cart!');
    }

    public function cart(){
    	$session_id = Session::get('session_id');
    	$userCart = DB::table('cart')->where(['session_id'=>$session_id])->get();

    	return view('admin.cart.cart',['userCart'=>$userCart]);
    }
}
