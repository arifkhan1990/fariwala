<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class CartController extends Controller
{
    public function addToCart(Request $request){
    	$data = $request->all();
    	if(empty($data['user_email'])){
    		$data['user_email'] = '';
    	}
    	if(empty($data['session_id'])){
    		$data['session_id'] = '';
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
    		                       'session_id'=>$data['session_id'],
    ]);
    }
}
