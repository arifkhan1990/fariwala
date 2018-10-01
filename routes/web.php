<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::match(['get','post'],'/admin','AdminController@login');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::group(['middleware' => ['auth']], function(){
	Route::get('/admin/dashboard','AdminController@dashboard');
	Route::get('/settings','AdminController@settings');
	Route::get('/admin/check-pwd','AdminController@checkPassword');
	Route::match(['get','post'],'/admin/update-pwd','AdminController@updatePassword');
    Route::get('/logout','AdminController@logout');

    //category route here ....................
    Route::match(['get','post'],'/admin/add-category','CategoryController@addCategory');
    Route::get('/admin/view-all-categories','CategoryController@viewAllCategories');
    Route::match(['get','post'],'/admin/edit-category/{category_id}','CategoryController@editCategory');
    Route::get('/admin/delete-category/{category_id}','CategoryController@deleteCategory');
    //product route here ....................
    Route::match(['get','post'],'/admin/add-product','ProductsController@addProduct');
    Route::get('/admin/view-all-products','ProductsController@viewAllProduct');
    Route::match(['get','post'],'/admin/edit-product/{product_id}','ProductsController@editProduct');
    Route::get('/admin/delete-product_image/{product_id}','ProductsController@deleteProductImage');
    Route::get('/admin/delete-product/{product_id}','ProductsController@deleteProduct');
    //Products Attribute route here..........................
    Route::match(['get','post'],'/admin/add-attribute/{product_id}','ProductsController@addAttribute');
});
