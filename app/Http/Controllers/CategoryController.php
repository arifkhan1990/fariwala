<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Category;


class CategoryController extends Controller
{
    public function addCategory(Request $request){
    	if($request->isMethod('post')){
    		$data = $request->all();
            $category = new Category;
            $category->category_name = $data['category_name'];
            $category->parent_id = $data['parent_id'];
            $category->category_description = $data['category_description'];
            $category->category_url = $data['category_url'];
            $category->save();
            return redirect('/admin/view-all-categories')->with('flash_message_success','Category Added Successfully!');
    	}

    	$levels = Category::where(['parent_id'=>0])->get();
    	return view('admin.categories.add_category',['levels'=>$levels]);
    }

    public function viewAllCategories(){
    	$categories_info = Category::get();
    	return view('admin.categories.view_all_categories',['categories_info'=>$categories_info]);
    }

    public function editCategory(Request $request, $category_id = null){
    	if($request->isMethod('post')){
    		$data = array();
    		$data['category_name'] = $request->category_name;
    		$data['parent_id'] = $request->parent_id;
    		$data['category_description'] = $request->category_description;
    		$data['category_url'] = $request->category_url;
    		Category::where(['category_id'=>$category_id])->update($data);

    		return redirect('/admin/view-all-categories')->with('flash_message_success','Category Updated Successfully!');
    	}
    	$category_details = Category::where(['category_id'=>$category_id])->first();
    	$levels = Category::where(['parent_id'=>0])->get();
    	return view('admin.categories.edit_category',['category_details'=>$category_details,'levels'=>$levels]);
    }

    public function deleteCategory($category_id=null){
    	if(!empty($category_id)){
    		Category::where(['category_id'=>$category_id])->delete();
    		return redirect()->back()->with('flash_message_success','Category Deleted Successfully!');
    	}
    }
}
