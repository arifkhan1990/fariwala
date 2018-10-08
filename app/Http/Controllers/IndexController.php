<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;

class IndexController extends Controller
{
    public function index(){
    	// $allProducts = Product::orderBy('product_id','DESC')->get();  
    	// $allProducts = Product::get(); orderby defualt asceding 
    	$allProducts = Product::inRandomOrder()->where(['product_status'=>1])->get();
        //Get all categories and sub categories
        $categories = Category::with('categories')->where(['parent_id'=>0,'category_status'=>1])->get();
        // $categories = json_decode(json_encode($categories));
        // echo "<pre>";print_r($categories);die;
        // foreach ($categories as $cat) {
        // 	echo $cat->category_name;echo "<br>";
        // 	$sub_categories = Category::where('parent_id',$cat->category_id)->get();
        // 	foreach ($sub_categories as $subcat) {
        // 		echo $subcat->category_name;echo "<br>";
        // 	}
        // }
        // die;
    	return view('index',['allProducts'=>$allProducts,'categories'=>$categories]);
    }
}
