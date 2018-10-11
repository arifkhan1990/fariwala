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

// Route::get('/', function () {
//     return view('welcome');
// });

//Here All Frontend route



//Here all Backend route
Route::match(['get','post'],'/admin','AdminController@login');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
// Home pages
Route::get('/','IndexController@index');

//Category / Listing Page..................................
Route::get('/products/{category_url}','ProductsController@products');
//Product detail page route................................
Route::get('/product/{id}','ProductsController@viewProductDetail');
//Cart route...............................................
Route::match(['get','post'],'/add-cart','CartController@addToCart');
Route::match(['get','post'],'/cart','CartController@cart');
Route::get('/cart/delete-product/{id}','CartController@deleteCartProduct');
Route::get('/cart/update-quantity/{id}/{quantity}','CartController@updateProductQuantity');
Route::post('/cart/apply-coupon','CouponsController@applyCoupon');

//Get Product  Attribute Price.............................
Route::get('/get-product-price','ProductsController@getProductPrice');

//User login resigter logout route.........................
Route::post('/user-register','UsersController@userRegister');
Route::match(['get','post'],'/user-login','UsersController@userLogin');
Route::get('/user-logout','UsersController@userLogout');
Route::group(['middleware'=>['frontlogin']],function(){
    Route::match(['get','post'],'/user-account','UsersController@userAccount');
    Route::post('/check-user-pwd','UsersController@checkUserPassword');
    Route::post('/update-user-password','UsersController@updateUserPassword');
    Route::match(['get','post'],'/checkout','CartController@checkOut');
});
// Check user email already exists.........................
Route::match(['get','post'],'/check-email','UsersController@checkEmail');

Route::group(['middleware' => ['auth']], function(){
	Route::get('/admin/dashboard','AdminController@dashboard');
	Route::get('/settings','AdminController@settings');
	Route::get('/admin/check-pwd','AdminController@checkPassword');
	Route::match(['get','post'],'/admin/update-pwd','AdminController@updatePassword');
    Route::get('/logout','AdminController@logout');

    //category route here ..................................
    Route::match(['get','post'],'/admin/add-category','CategoryController@addCategory');
    Route::get('/admin/view-all-categories','CategoryController@viewAllCategories');
    Route::match(['get','post'],'/admin/edit-category/{id}','CategoryController@editCategory');
    Route::get('/admin/unactive-category/{id}','CategoryController@unactiveCategory');
    Route::get('/admin/active-category/{id}','CategoryController@activeCategory');
    Route::get('/admin/delete-category/{id}','CategoryController@deleteCategory');
    //product route here ...................................
    Route::match(['get','post'],'/admin/add-product','ProductsController@addProduct');
    Route::get('/admin/view-all-products','ProductsController@viewAllProduct');
    Route::match(['get','post'],'/admin/edit-product/{id}','ProductsController@editProduct');
    Route::get('/admin/delete-product_image/{id}','ProductsController@deleteProductImage');
    Route::get('/admin/unactive-product/{id}','ProductsController@unactiveProduct');
    Route::get('/admin/active-product/{id}','ProductsController@activeProduct');
    Route::get('/admin/delete-product/{id}','ProductsController@deleteProduct');
    //Products Attribute route here..........................
    Route::match(['get','post'],'/admin/add-attribute/{id}','ProductsController@addAttribute');
    Route::match(['get','post'],'/admin/edit-attribute/{id}','ProductsController@editAttribute');
    Route::get('/admin/delete-attribute/{id}','ProductsController@deleteAttribute');
    //Products Alternative Image route here..................
    Route::match(['get','post'],'/admin/add-image/{id}','ProductsController@addImage');
    Route::get('/admin/delete-alt-product-image/{id}','ProductsController@deleteAlterProductImage');
    //Coupon route here......................................
    Route::match(['get','post'],'/admin/add-coupon','CouponsController@addCoupon');
    Route::get('/admin/view-all-coupons','CouponsController@viewAllCoupons');
    Route::match(['get','post'],'/admin/edit-coupon/{id}','CouponsController@editCoupon');
    Route::get('/admin/unactive-coupon/{id}','CouponsController@unactiveCoupon');
    Route::get('/admin/active-coupon/{id}','CouponsController@activeCoupon');
    Route::get('/admin/delete-coupon/{id}','CouponsController@deleteCoupon');
    //Banner route here......................................
    Route::match(['get','post'],'/admin/add-banner','BannersController@addBanner');
    Route::get('/admin/view-all-banners','BannersController@viewAllBanners');
    Route::match(['get','post'],'/admin/edit-banner/{id}','BannersController@editBanner');
    Route::get('/admin/delete-banner-image/{id}','BannersController@deleteBannerImage');
    Route::get('/admin/unactive-banner/{id}','BannersController@unactiveBanner');
    Route::get('/admin/active-banner/{id}','BannersController@activeBanner');
    Route::get('/admin/delete-banner/{id}','BannersController@deleteBanner');
});
