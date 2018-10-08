<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Product;
use App\ProductsAttribute;
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

    	$countProducts =  DB::table('cart')->where([
    		                  'product_id'=>$data['product_id'],
    		                  'product_color'=>$data['product_color'],
    		                  'product_size'=>$sizeArr[1],
    		                  'session_id'=>$session_id,])->count();
    	if($countProducts > 0){
            return redirect()->back()->with('flash_message_error','Product already exists in Cart!');
    	}else{
            
            $getSKU = ProductsAttribute::select('sku')->where(['product_id'=>$data['product_id'],'size'=>$sizeArr[1]])->first();
    	    DB::table('cart')->insert(['product_id'=>$data['product_id'],
    		                       'product_name'=>$data['product_name'],
    		                       'product_code'=>$getSKU->sku,
    		                       'product_color'=>$data['product_color'],
    		                       'product_price'=>$data['product_price'],
    		                       'product_size'=>$sizeArr[1],
    		                       'quantity'=>$data['quantity'],
    		                       'user_email'=>$data['user_email'],
    		                       'session_id'=>$session_id,
    ]);    		
    	}

    	return redirect('/cart')->with('flash_message_success','Product has been added to Cart!');
    }

    public function cart(){
    	$session_id = Session::get('session_id');
    	$userCart = DB::table('cart')->where(['session_id'=>$session_id])->get();
        foreach ($userCart as $key => $val) {
        	$productDetails = Product::where('id',$val->product_id)->first();
        	$userCart[$key]->image = $productDetails->product_image;
        }
    	return view('cart.cart',['userCart'=>$userCart]);
    }

    public function deleteCartProduct($id = null){
    	DB::table('cart')->where('id',$id)->delete();
    	return redirect()->back()->with('flash_message_success','Product has
    		been deleted successfully from Cart!');
    }

    public function updateProductQuantity($id = null, $quantity = null){
    	$getCartDetails = DB::table('cart')->where('id',$id)->first();
    	$getAttributeStock = ProductsAttribute::where('sku',$getCartDetails->product_code)->first();
    	$updatedQuantity = $getCartDetails->quantity + $quantity;
    	if($getAttributeStock->stock >= $updatedQuantity){
    		DB::table('cart')->where('id',$id)->increment('quantity',$quantity);
    	    return redirect()->back()->with('flash_message_success','Product Quantity change successfully!');
    	}else{
    		return redirect()->back()->with('flash_message_error','Required Product Quantity is not available!');
    	}

    }
}
