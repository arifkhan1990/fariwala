<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Coupon;

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
    		die;
    	}
        return view('admin.coupons.add_coupon');
    }
}
