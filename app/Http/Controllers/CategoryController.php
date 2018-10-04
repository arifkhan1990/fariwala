<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Category;


class CategoryController extends Controller
{
    public function addCategory(Request $request){
    	if($request->isMethod('post')){
    		$data = $request->all();
            if(empty($data['category_status'])){
                $category_status = 0;
            }else{
                $category_status = 1;
            }

            $category = new Category;
            $category->category_name = $data['category_name'];
            $category->parent_id = $data['parent_id'];
            $category->category_description = $data['category_description'];
            $category->category_url = $data['category_url'];
            $category->category_status = $data['category_status'];
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

    public function editCategory(Request $request, $id = null){
    	if($request->isMethod('post')){
    		$data = array();
    		$data['category_name'] = $request->category_name;
    		$data['parent_id'] = $request->parent_id;
    		$data['category_description'] = $request->category_description;
    		$data['category_url'] = $request->category_url;
    		Category::where(['id'=>$id])->update($data);

    		return redirect('/admin/view-all-categories')->with('flash_message_success','Category Updated Successfully!');
    	}
    	$category_details = Category::where(['id'=>$id])->first();
    	$levels = Category::where(['parent_id'=>0])->get();
    	return view('admin.categories.edit_category',['category_details'=>$category_details,'levels'=>$levels]);
    }

    public function unactiveCategory($id = null){
         Category::where('id',$id)->update(['category_status' => 0]);
         return redirect()->back()->with('flash_message_success','Category Unactive successfully !!');
    }

    public function activeCategory($id){
         Category::where('id',$id)->update(['category_status' => 1]);
         return redirect()->back()->with('flash_message_success','Category Active successfully !!');
    }

    public function deleteCategory($id=null){
    	if(!empty($id)){
    		Category::where(['id'=>$id])->delete();
    		return redirect()->back()->with('flash_message_success','Category Deleted Successfully!');
    	}
    }
}
