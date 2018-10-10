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

    public function viewAllBanners(){
     	$banners = Banner::get();
     	return view('admin.banners.view_all_banners',['banners'=>$banners]);
    }
    
    public function editBanner(Request $request, $id=null){

    	if($request->isMethod('post')){
    		$data = array();
    		$data['title'] = $request->title;
    		$data['link'] = $request->link;

    		if($request->hasFile('image')){
    			$image_tmp = Input::file('image');
    			if($image_tmp->isValid()){
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(111,99999).'.'.$extension;
                    $image_path = 'images/frontend_images/banners/'.$filename;

                    Image::make($image_tmp)->resize(1140,340)->save($image_path);
                     
                    $data['image'] = $filename;
    			}
    		}else if(!empty($current_image)){
    			$data['image'] = $current_image;
    		}

            Banner::where('id',$id)->update($data);

            return redirect('/admin/view-all-banners')->with('flash_message_success','Banner has been Updated successfully!');
    	}
    	$bannerDetails = Banner::where('id',$id)->first();
        return view('admin.banners.edit_banner',['bannerDetails'=>$bannerDetails]);
    }

    public function deleteBannerImage($id = null){

        //Get Product Image Name
        $bannerImage = Banner::where(['id'=>$id])->first();

        //Get Product Image Paths
        $image_path = 'images/frontend_images/banners/';

        //Delete Large Image if not exists in folder
        if(file_exists($image_path.$bannerImage->image)){
            unlink($image_path.$bannerImage->image);
        }

        //Delete Image from Products table
    	Banner::where(['id'=>$id])->update(['image'=>'']);
    	return redirect()->back()->with('flash_message_success','Banner Image has been deleted successfully!');
    }
    
    public function unactiveBanner($id = null){
         Banner::where('id',$id)->update(['banner_status' => 0]);
         return redirect()->back()->with('flash_message_success','Banner Unactive successfully !!');
    }

    public function activeBanner($id){
         Banner::where('id',$id)->update(['banner_status' => 1]);
         return redirect()->back()->with('flash_message_success','Banner Active successfully !!');
    }

    public function deleteBanner($id = null){
    	Banner::where(['id'=>$id])->delete();
    	return redirect()->back()->with('flash_message_success','Banner has been deleted successfully!');
    }
}
