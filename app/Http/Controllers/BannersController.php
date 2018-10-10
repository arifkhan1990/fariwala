<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Image;
use Auth;
use App\Coupon;
use DB;
use App\Cart;
use App\Banner;
use Session;
session_start();

class BannersController extends Controller
{
public function addBanner(Request $request){
    	 if($request->isMethod('post')){
    		$data = $request->all();
    	 	 // echo "<pre>";print_r($data);die;
    	 	$banner = new Banner;
    	 	$banner->title = $data['title'];
    		$banner->link = $data['link'];
    
    	 	if(empty($data['banner_status'])){
    	 		$status = 0;
    	 	}else{
    	 		$status = 1;
    	 	}
    	 	$banner->banner_status = $status;
    	 	if($request->hasFile('image')){
    			$image_tmp = Input::file('image');
    			if($image_tmp->isValid()){
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(111,99999).'.'.$extension;
                    $banner_path = 'images/frontend_images/banners/'.$filename;

                    //resize images
      
                    Image::make($image_tmp)->resize(1140,340)->save($banner_path);
                     
                    $banner->image = $filename;
    			}
    		}
    	 	$banner->save();
    	 	return redirect('/admin/add-banner')->with('flash_message_success','Banner has been added successfully!');
    	 }
        return view('admin.banners.add_banner');
    }

    // public function viewAllbanners(){
    // 	$banners = banner::get();
    // 	return view('admin.banners.view_banner',['banners'=>$banners]);
    // }
    
    // public function editbanner(Request $request, $id=null){
    // 	$bannerDetails = banner::where('id',$id)->first();
    // 	if($request->isMethod('post')){
    // 		$data = $request->all();
    // 		$banner = banner::find($id);
    // 		$banner->banner_code = $data['banner_code'];
    // 		$banner->amount = $data['amount'];
    // 		$banner->amount_type = $data['amount_type'];
    // 		$banner->expiry_date = $data['expiry_date'];
    //         $banner->update();

    //         return redirect('/admin/view-all-banners')->with('flash_message_success','banner has been Updated successfully!');
    // 	}
    //     return view('admin.banners.edit_banner',['bannerDetails'=>$bannerDetails]);
    // }

    // public function unactivebanner($id = null){
    //      banner::where('id',$id)->update(['banner_status' => 0]);
    //      return redirect()->back()->with('flash_message_success','banner Unactive successfully !!');
    // }

    // public function activebanner($id){
    //      banner::where('id',$id)->update(['banner_status' => 1]);
    //      return redirect()->back()->with('flash_message_success','banner Active successfully !!');
    // }

    // public function applybanner(Request $request){
    //     Session::forget('bannerAmount');
    //     Session::forget('bannerCode');

    //     $data = $request->all();
    //     $bannerCount = banner::where('banner_code',$data['banner_code'])->count();
    //     if($bannerCount == 0){
    //         return redirect()->back()->with('flash_message_error','The banner is not exists!');
    //     }else{
    //         $bannerDetails = banner::where('banner_code',$data['banner_code'])->first();
    //         // echo "<pre>";print_r($bannerDetails);die;

    //         // If banner is Inactive
    //        if($bannerDetails->banner_status == 0){
    //         return redirect()->back()->with('flash_message_error','This banner is not active!');
    //        }

    //        // If banner is Expired
    //        $expiry_date = $bannerDetails->expiry_date;
    //        $current_date = date('y-m-d');
    //        if($expiry_date < $current_date){
    //         return redirect()->back()->with('flash_message_error','This banner is expired!');
    //        } 

    //        //Get cart total amount
    //        $session_id = Session::get('session_id');
    //        $userCart = DB::table('cart')->where(['session_id'=>$session_id])->get();
    //        $total_amount = 0;
    //        foreach ($userCart as $item) {
    //            $total_amount = $total_amount + ($item->product_price * $item->quantity);
    //        }
    //       // Check if amount type is Fixed or Percentage
    //        if($bannerDetails->amount_type == "Fixed"){
    //         $bannerAmount = $bannerDetails->amount;
    //        }else{
    //         $bannerAmount = $total_amount * ($bannerDetails->amount/100);
    //        }

    //        Session::put('bannerAmount',$bannerAmount);
    //        Session::put('bannerCode',$data['banner_code']);

    //        return redirect()->back()->with('flash_message_success','banner code successfully applied. You are availing discount!');
    //     }
    // }

    // public function deletebanner($id = null){
    // 	banner::where(['id'=>$id])->delete();
    // 	return redirect()->back()->with('flash_message_success','banner has been deleted successfully!');
    // }
}
