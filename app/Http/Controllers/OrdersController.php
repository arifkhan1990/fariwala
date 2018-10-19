<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Order;
class OrdersController extends Controller
{
    public function userOrders(){
    	$user_id = Auth::user()->id;
    	$orders = Order::with('orders')->where('user_id',$user_id)->orderBy('id','DESC')->get();
    	// $orders = json_decode(json_encode($orders));
    	// echo "<pre>"; print_r($orders);die;
    	return view('orders.user_orders',['orders'=>$orders]);
    }

    public function userOrdersDetails($order_id){
    	$user_id = Auth::user()->id;
    	$orderDetails = Order::with('orders')->where('id',$order_id)->first();
    	// $orderDetails = json_decode(json_encode($orderDetails));
    	// echo "<pre>"; print_r($orderDetails);die;
    	return view('orders.user_orders_details',['orderDetails'=>$orderDetails]);
    }
}
