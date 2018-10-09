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
}
