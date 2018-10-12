<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Product;
use App\ProductsAttribute;
use App\Coupon;
use Auth;
use App\User;
use App\Country;
use App\DeliveryAddress;

session_start();

class CartController extends Controller
{
    public function addToCart(Request $request){
      Session::forget('CouponAmount');
      Session::forget('CouponCode');

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
    		                       'session_id'=>$session_id
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
      Session::forget('CouponAmount');
      Session::forget('CouponCode');     
    	DB::table('cart')->where('id',$id)->delete();
    	return redirect()->back()->with('flash_message_success','Product has
    		been deleted successfully from Cart!');
    }

    public function updateProductQuantity($id = null, $quantity = null){
      Session::forget('CouponAmount');
      Session::forget('CouponCode');
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

    public function checkOut(Request $request){
        $user_id = Auth::user()->id;
        $user_email = Auth::user()->email;
        $userDetails = User::find($user_id);
        $countries = Country::get();
        $shippingCount = DeliveryAddress::where('user_id',$user_id)->count();
        $shippingDetails = "";
        if($shippingCount > 0){
            $shippingDetails = DeliveryAddress::where('user_id',$user_id)->first();
        }
        
        //Update cart table with user email
        $session_id = Session::get('session_id');
        DB::table('cart')->where(['session_id'=>$session_id])->update(['user_email'=>$user_email]);

        if($request->isMethod('post')){
            $data = $request->all();
            if(empty($data['billing_name']) || empty($data['billing_address']) || empty($data['billing_city']) || empty($data['billing_state']) || empty($data['billing_country']) || empty($data['billing_pincode']) || empty($data['billing_phone']) || empty($data['shipping_name']) || empty($data['shipping_address']) || empty($data['shipping_city']) || empty($data['shipping_state']) || empty($data['shipping_country']) || empty($data['shipping_pincode']) || empty($data['shipping_phone'])) {
                return redirect()->back()->with('flash_message_error','Please fill all fields to Checkout!');
            }
            User::where('id',$user_id)->update(['name'=>$data['billing_name'],'address'=>$data['billing_address'],'city'=>$data['billing_city'],'state'=>$data['billing_state'],'country'=>$data['billing_country'],'zipcode'=>$data['billing_pincode'],'phone'=>$data['billing_phone']]);

            if($shippingCount > 0){
                DeliveryAddress::where('user_id',$user_id)->update(['name'=>$data['shipping_name'],'address'=>$data['shipping_address'],'city'=>$data['shipping_city'],'state'=>$data['shipping_state'],'country'=>$data['shipping_country'],'pincode'=>$data['shipping_pincode'],'phone'=>$data['shipping_phone']]);
            }else{
                $shipping = new DeliveryAddress;
                $shipping->user_id = $user_id;
                $shipping->user_email = $user_email;
                $shipping->name = $data['shipping_name'];
                $shipping->address = $data['shipping_address'];
                $shipping->city = $data['shipping_city'];
                $shipping->state = $data['shipping_state'];
                $shipping->country = $data['shipping_country'];
                $shipping->pincode = $data['shipping_pincode'];
                $shipping->phone = $data['shipping_phone'];
                $shipping->save();

            }
            return redirect()->action('CartController@orderReview');
        }

        return view('cart.checkout',['userDetails'=>$userDetails,'countries'=>$countries,'shippingDetails'=>$shippingDetails]);
    }

    public function orderReview(){
        return view('cart.order_review');
    }
}
