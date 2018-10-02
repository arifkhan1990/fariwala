<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class IndexController extends Controller
{
    public function index(){
    	// $allProducts = Product::orderBy('product_id','DESC')->get();  
    	// $allProducts = Product::get(); orderby defualt asceding 
    	$allProducts = Product::inRandomOrder()->get();
    	return view('index',['allProducts'=>$allProducts]);
    }
}
