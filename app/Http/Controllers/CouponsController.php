<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Coupon;
use DB;
use App\Cart;
use Session;
use Auth;
session_start();

class CouponsController extends Controller
{
    public function addCoupon(Request $request){
    	if($request->isMethod('post')){
    		$data = $request->all();
    		// echo "<pre>";print_r($data);die;
    		$coupon = new Coupon;
    		$coupon->coupon_code = $data['coupon_code'];
    		$coupon->amount = $data['amount'];
    		$coupon->amount_type = $data['amount_type'];
    		$coupon->expiry_date = $data['expiry_date'];
    		if(empty($data['coupon_status'])){
    			$status = 0;
    		}else{
    			$status = 1;
    		}
    		$coupon->coupon_status = $status;
    		$coupon->save();
    		return redirect('/admin/add-coupon')->with('flash_message_success','Coupon has been added successfully!');
    	}
        return view('admin.coupons.add_coupon');
    }

    public function viewAllCoupons(){
    	$coupons = Coupon::get();
    	return view('admin.coupons.view_coupon',['coupons'=>$coupons]);
    }
    
    public function editCoupon(Request $request, $id=null){
    	$couponDetails = Coupon::where('id',$id)->first();
    	if($request->isMethod('post')){
    		$data = $request->all();
    		$coupon = Coupon::find($id);
    		$coupon->coupon_code = $data['coupon_code'];
    		$coupon->amount = $data['amount'];
    		$coupon->amount_type = $data['amount_type'];
    		$coupon->expiry_date = $data['expiry_date'];
            $coupon->update();

            return redirect('/admin/view-all-coupons')->with('flash_message_success','Coupon has been Updated successfully!');
    	}
        return view('admin.coupons.edit_coupon',['couponDetails'=>$couponDetails]);
    }

    public function unactiveCoupon($id = null){
         Coupon::where('id',$id)->update(['coupon_status' => 0]);
         return redirect()->back()->with('flash_message_success','Coupon Unactive successfully !!');
    }

    public function activeCoupon($id){
         Coupon::where('id',$id)->update(['coupon_status' => 1]);
         return redirect()->back()->with('flash_message_success','Coupon Active successfully !!');
    }

    public function deleteCoupon($id = null){
    	Coupon::where(['id'=>$id])->delete();
    	return redirect()->back()->with('flash_message_success','Coupon has been deleted successfully!');
    }

    public function applyCoupon(Request $request){
        Session::forget('CouponAmount');
        Session::forget('CouponCode');

        $data = $request->all();
        $couponCount = Coupon::where('coupon_code',$data['coupon_code'])->count();

        if($couponCount == 0){
            return redirect()->back()->with('flash_message_error','The Coupon is not exists!');
        }else{
            $couponDetails = Coupon::where('coupon_code',$data['coupon_code'])->first();
            // echo "<pre>";print_r($couponDetails);die;

            // If coupon is Inactive
           if($couponDetails->coupon_status == 0){
            return redirect()->back()->with('flash_message_error','This coupon is not active!');
           }

           // If coupon is Expired
           $expiry_date = $couponDetails->expiry_date;
           $current_date = date('y-m-d');
           if($expiry_date < $current_date){
            return redirect()->back()->with('flash_message_error','This coupon is expired!');
           } 

           //Get cart total amount
           $session_id = Session::get('session_id');

          if(Auth::check()){
              $user_email = Auth::user()->email;
              $userCart = DB::table('cart')->where(['user_email'=>$user_email])->get();
          }else{
              // $session_id = Session::get('session_id');
              $session_id = session()->get('session_id');
              $userCart = DB::table('cart')->where(['session_id'=>$session_id])->get();
          }

           $total_amount = 0;
           foreach ($userCart as $item) {
              $total_amount = $total_amount + ($item->product_price * $item->quantity);
           }

          // Check if amount type is Fixed or Percentage
           if($couponDetails->amount_type == "Fixed"){
               $couponAmount = $couponDetails->amount;
           }else if($couponDetails->amount_type == "Percentage"){
               $couponAmount = $total_amount * ($couponDetails->amount / 100);
           }

           Session::put('CouponAmount',$couponAmount);
           Session::put('CouponCode',$data['coupon_code']);

           return redirect()->back()->with('flash_message_success','Coupon code successfully applied. You are availing discount!');
        }
    }
}
