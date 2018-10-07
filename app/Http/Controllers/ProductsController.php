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
use App\ProductsImage;
class ProductsController extends Controller
{
    //Products Add , View , Edit, Single Product View, Delete Product Image , Delete Product functionality.......
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
            if(!empty($data['product_description'])){
                $product->product_description = $data['product_description'];
            }else{
                $product->product_description = "Good for nothings!.";
            }

    		if(!empty($data['product_care'])){
                $product->product_care = $data['product_care'];
            }else{
                $product->product_care = "Good for nothings!.";
            }

    		$product->product_price = $data['product_price'];
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
    	$products_info = Product::orderBy('id','DESC')->get();
        // $products_info  = json_decode(json_encode($products_info));
        // echo "<pre>";print_r($products_info);die;
    	foreach ($products_info as $key => $val) {
    		$category_name = Category::where(['id'=>$val->category_id])->first();
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

            if(empty($request->product_description)){
                $data['product_description'] = "Good for nothings!.";
            }else{
                $data['product_description'] = $request->product_description;
            }

            if(empty($request->product_care)){
                $data['product_care'] = "Good for nothings!.";
            }else{
                $data['product_care'] = $request->product_care;
            }

    		$data['product_price'] = $request->product_price;

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

    public function products($url = null){
        // Show 404 page if Category url does not exist
        $categoryUrl = Category::where(['category_url'=>$url,'category_status'=>1])->count();
        if($categoryUrl == 0){
            abort(404);
        }
        //Get all categories and sub categories
        $categories = Category::with('categories')->where(['parent_id'=>0,'category_status'=>1])->get();
        $category_details = Category::where(['category_url'=>$url])->first();

        if($category_details->parent_id == 0){
            //if url is main category url
            $cat_ids = array();
            $sub_categories = Category::where(['parent_id'=>$category_details->id])->get();
            foreach ($sub_categories as $subcat) {
                $cat_ids[] = $subcat->id;
            }
            $allProducts = Product::whereIn('category_id',$cat_ids)->get();
        }else{
            //if url is sub category url
            $allProducts = Product::where(['category_id'=>$category_details->id])->get();
        }

        return view('admin.products.listing',['categories'=>$categories,'category_details'=>$category_details,'allProducts'=>$allProducts]);
    }

    public function viewProductDetail($id = null){
        //Get product details
        $product_details = Product::with('attributes')->where(['id'=>$id])->first();
        // $product_details = json_decode(json_encode($product_details));
        // echo "<pre>"; print_r($product_details);die;

        //Get all categories and Sub categories
        $categories = Category::with('categories')->where(['parent_id'=>0,'category_status'=>1])->get();
        //Get products alternative images
        $productalteImg = ProductsImage::where(['product_id'=>$id])->get();
        // $productalteImg = json_decode(json_encode($productalteImg));
        // echo "<pre>";print_r($productalteImg );die;
        return view('admin.products.product_details',['product_details'=>$product_details,'categories'=>$categories,'productalteImg'=>$productalteImg]);

    }

    public function deleteProductImage($id = null){

        //Get Product Image Name
        $productImage = Product::where(['id'=>$id])->first();

        //Get Product Image Paths
        $large_image_path = 'images/backend_images/products/large/';
        $medium_image_path = 'images/backend_images/products/medium/';
        $small_image_path = 'images/backend_images/products/small/';

        //Delete Large Image if not exists in folder
        if(file_exists($large_image_path.$productImage->product_image)){
            unlink($large_image_path.$productImage->product_image);
        }

        //Delete Medium Image if not exists in folder
        if(file_exists($medium_image_path.$productImage->product_image)){
            unlink($medium_image_path.$productImage->product_image);
        }

        //Delete Small Image if not exists in folder
        if(file_exists($small_image_path.$productImage->product_image)){
            unlink($small_image_path.$productImage->product_image);
        }

        //Delete Image from Products table
    	Product::where(['id'=>$id])->update(['product_image'=>'']);
    	return redirect()->back()->with('flash_message_success','Product Image has been deleted successfully!');
    }

    public function deleteProduct($id = null){
    	Product::where(['id'=>$id])->delete();
    	return redirect()->back()->with('flash_message_success','Product has been deleted successfully!');
    }
    
    // Products Attribute functionality ...................................................................
    public function addAttribute(Request $request,$id = null){
        $product_details = Product::with('attributes')->where(['id'=>$id])->first();
        // $product_details = json_decode(json_encode($product_details));
        // echo "<pre>";  print_r($product_details);die;
        
    	if($request->isMethod('post')){
    		$data = $request->all();
    		foreach ($data['sku'] as $key => $val) {
    			if(!empty($val)){
                    //Prevent duplicate SKU Check
                    $attrSKU = ProductsAttribute::where('sku',$val)->count();
                    if($attrSKU > 0){
                        return redirect('admin/add-attribute/'.$id)->with('flash_message_error','SKU already exists! Please add another SKU.');
                    }

                    // Prevent duplicate Size Check
                    $attrSize = ProductsAttribute::where(['product_id'=>$id,'size'=>$data['size'][$key]])->count();
                    if($attrSize > 0){
                        return redirect('admin/add-attribute/'.$id)->with('flash_message_error','"'.$data['size'][$key].'" Size already exists for this product! Please add another Size.');
                    }
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

    public function getProductPrice(Request $request){
        $data = $request->all();
        // echo "<pre>";print_r($data);die;
        $proAr = explode("-",$data['idSize']);
        $proAttr = ProductsAttribute::where(['product_id'=>$proAr[0], 'size'=>$proAr[1]])->first();
        echo $proAttr->price;
    }

    public function deleteAttribute($id = null){
        ProductsAttribute::where(['id'=>$id])->delete();
        return redirect()->back()->with('flash_message_success','Attribute has been deleted successfully!');
    }

    // Products Alternative images functionality ...................................................................
    public function addImage(Request $request,$id = null){
        $product_details = Product::with('attributes')->where(['id'=>$id])->first();
        // $product_details = json_decode(json_encode($product_details));
        // echo "<pre>";  print_r($product_details);die;
        
        if($request->isMethod('post')){
            $data = $request->all();
            if($request->hasFile('product_images')){
                $files = $request->file('product_images');
                foreach ($files as $file) {
                    $image = new ProductsImage;
                    $extension = $file->getClientOriginalExtension();
                    $filename = rand(111,99999).'.'.$extension;
                    $large_image_path = 'images/backend_images/products/large/'.$filename;
                    $medium_image_path = 'images/backend_images/products/medium/'.$filename;
                    $small_image_path = 'images/backend_images/products/small/'.$filename;
                    //resize images
                    Image::make($file)->save($large_image_path);
                    Image::make($file)->resize(600,600)->save($medium_image_path);
                    Image::make($file)->resize(300,300)->save($small_image_path);
                    $image->product_images = $filename;
                    $image->product_id = $data['product_id'];
                    $image->save();
                }
            }
            return redirect()->back()->with('flash_message_success','Product Images has been added successfully');
        }
        
        $productsImg = ProductsImage::where(['product_id'=>$id])->get();

        return view('admin.products.add_images',['product_details'=>$product_details,'productsImg'=>$productsImg]);
    }

    public function deleteAlterProductImage($id = null){

        //Get Product Image Name
        $productImage = ProductsImage::where(['id'=>$id])->first();

        //Get Product Image Paths
        $large_image_path = 'images/backend_images/products/large/';
        $medium_image_path = 'images/backend_images/products/medium/';
        $small_image_path = 'images/backend_images/products/small/';

        //Delete Large Image if not exists in folder
        if(file_exists($large_image_path.$productImage->product_images)){
            unlink($large_image_path.$productImage->product_images);
        }

        //Delete Medium Image if not exists in folder
        if(file_exists($medium_image_path.$productImage->product_images)){
            unlink($medium_image_path.$productImage->product_images);
        }

        //Delete Small Image if not exists in folder
        if(file_exists($small_image_path.$productImage->product_images)){
            unlink($small_image_path.$productImage->product_images);
        }

        //Delete Image from Products table
        ProductsImage::where(['id'=>$id])->delete();
        return redirect()->back()->with('flash_message_success','Product Alternative Image(s) has been deleted successfully!');
    }

}
