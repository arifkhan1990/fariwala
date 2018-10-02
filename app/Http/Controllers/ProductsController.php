<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Image;
use Auth;
use Session;
use App\Category;
use App\Product;
use App\ProductsAttribute;
use DB;

class ProductsController extends Controller
{
    public function addProduct(Request $request){

    	if($request->isMethod('post')){
    		$data = $request->all();
    		if(empty($data['category_id'])){
    			return redirect()->back()->with('flash_message_error','Under Category is missing!!');
    		}
    		$product = new Product;
    		$product->category_id = $data['category_id'];
    		$product->product_name = $data['product_name'];
    		$product->product_code = $data['product_code'];
    		$product->product_color = $data['product_color'];
    		$product->product_description = $data['product_description'];
    		$product->product_price = $data['product_price'];
    		$product->product_size = $data['product_size'];
    		//uplpad image
    		if($request->hasFile('product_image')){
    			$image_tmp = Input::file('product_image');
    			if($image_tmp->isValid()){
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(111,99999).'.'.$extension;
                    $large_image_path = 'images/backend_images/products/large/'.$filename;
                    $medium_image_path = 'images/backend_images/products/medium/'.$filename;
                    $small_image_path = 'images/backend_images/products/small/'.$filename;
                    //resize images
                    Image::make($image_tmp)->save($large_image_path);
                    Image::make($image_tmp)->resize(600,600)->save($medium_image_path);
                    Image::make($image_tmp)->resize(300,300)->save($small_image_path);
                     
                    $product->product_image = $filename;
    			}
    		}
    		$product->save();
    		return redirect()->back()->with('flash_message_success','Product has been added successfully!');
    	}
    	//category dropdown ..........
    	$categories = Category::where(['parent_id'=>0])->get();
    	$categories_dropdown = "<option selected disabled>Select</option>";
    	foreach ($categories as $val) {
    		$categories_dropdown .="<option value='".$val->id."'>".$val->category_name."</option>";
    		$sub_categories = Category::where(['parent_id'=>$val->id])->get();
    		foreach ($sub_categories as $sub_val) {
    			$categories_dropdown .= "<option value= '".$sub_val->id."'>&nbsp;--&nbsp;".$sub_val->category_name."</option>";
    		}
    	}
    	return view('admin.products.add_product',['category_dropdown'=>$categories_dropdown]);
    }

    public function viewAllProduct(){
    	$products_info = Product::get();
    	foreach ($products_info as $key => $val) {
    		$category_name = Category::where(['id'=>$val->id])->first();
    		$products_info[$key]->category_name = $category_name->category_name;
    	}
    	return view('admin.products.view_all_products',['products_info'=>$products_info]);
    }

    public function editProduct(Request $request, $id=null){

     	if($request->isMethod('post')){
    		$data = array();
    		$data['category_id'] = $request->category_id;
    		$data['product_name'] = $request->product_name;
    		$data['product_code'] = $request->product_code;
    		$data['product_color'] = $request->product_color;
    		$data['product_description'] = $request->product_description;
    		$data['product_price'] = $request->product_price;
    		$data['product_size'] = $request->product_size;

    		if($request->hasFile('product_image')){
    			$image_tmp = Input::file('product_image');
    			if($image_tmp->isValid()){
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(111,99999).'.'.$extension;
                    $large_image_path = 'images/backend_images/products/large/'.$filename;
                    $medium_image_path = 'images/backend_images/products/medium/'.$filename;
                    $small_image_path = 'images/backend_images/products/small/'.$filename;
                    //resize images
                    Image::make($image_tmp)->save($large_image_path);
                    Image::make($image_tmp)->resize(600,600)->save($medium_image_path);
                    Image::make($image_tmp)->resize(300,300)->save($small_image_path);
                     
                    $data['product_image'] = $filename;
    			}
    		}else if(!empty($current_image)){
    			$data['product_image'] = $current_image;
    		}

    		Product::where(['id'=>$id])->update($data);

    		return redirect('/admin/view-all-products')->with('flash_message_success','Product has been Updated Successfully!');
    	}

    	$product_details = Product::where(['id'=>$id])->first();
    	//category dropdown ..........
    	$categories = Category::where(['parent_id'=>0])->get();
    	$categories_dropdown = "<option selected disabled>Select</option>";
    	foreach ($categories as $val) {
    		if($val->id == $product_details->category_id){
    			$selected = "selected";
    		}else{
    			$selected = "";
    		}
    		$categories_dropdown .="<option value='".$val->id."'".$selected.">".$val->category_name."</option>";
    		$sub_categories = Category::where(['parent_id'=>$val->id])->get();
    		foreach ($sub_categories as $sub_val) {
    		    if($sub_val->id == $product_details->category_id){
    			    $selected = "selected";
    		    }else{
    			    $selected = "";
    		    }
    			$categories_dropdown .= "<option value= '".$sub_val->id."'".$selected.">&nbsp;--&nbsp;".$sub_val->category_name."</option>";
    		}
    	}

    	return view('admin.products.edit_product',['product_details'=>$product_details,'category_dropdown'=>$categories_dropdown]);    	
    }

    public function deleteProductImage($id = null){
    	Product::where(['id'=>$id])->update(['product_image'=>'']);
    	return redirect()->back()->with('flash_message_success','Product Image has been deleted successfully!');
    }

    public function deleteProduct($id = null){
    	Product::where(['id'=>$id])->delete();
    	return redirect()->back()->with('flash_message_success','Product has been deleted successfully!');
    }

    public function addAttribute(Request $request,$id = null){
        $product_details = Product::with('attributes')->where(['id'=>$id])->first();
        // $product_details = json_decode(json_encode($product_details));
        // echo "<pre>";  print_r($product_details);die;
        
    	if($request->isMethod('post')){
    		$data = $request->all();
    		foreach ($data['sku'] as $key => $val) {
    			if(!empty($val)){
    				$attribute = new ProductsAttribute;
    				$attribute->product_id = $id;
    				$attribute->sku  = $val;
    				$attribute->size = $data['size'][$key];
    				$attribute->price = $data['price'][$key];
    				$attribute->stock = $data['stock'][$key];
    				$attribute->save(); 
    			}
    		}

    		return redirect('/admin/add-attribute/'.$id)->with('flash_message_success','Product Attributes has been added successfully!');
    	}

    	return view('admin.products.add_attribute',['product_details'=>$product_details]);
    }

    public function deleteAttribute($id = null){
        ProductsAttribute::where(['id'=>$id])->delete();
        return redirect()->back()->with('flash_message_success','Attribute has been deleted successfully!');
    }

}
