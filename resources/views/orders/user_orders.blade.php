@extends('layouts.frontendLayout.frontend_design')
@section('content')
<section id="cart_items">
	<div class="container">
		<div class="breadcrumbs">
			<ol class="breadcrumb">
				<li><a href="{{ url('/') }}">Home</a></li>
				<li class="active">Orders</li>
			</ol>
		</div>
	</div>
</section>
<section id="do_action">
	<div class="container">
		<div class="heading" align="center">
			<table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Order ID</th>
                        <th scope="col">Ordered Products</th>
                        <th scope="col">Payment Method</th>
                        <th scope="col">Grand Total</th>
                        <th scope="col">Created on</th>
                    </tr>
                </thead>
                <tbody>
                	@foreach($orders as $order)
                    <tr>
                       <th scope="row">{{ $order->id }}</th>
                       <td>
                       	@foreach($order->orders as $pro)
                       	<span><a href="{{ url('/orders/'.$order->id )}}">{{ $pro->product_code }}</a><br /></span>
                       	@endforeach
                       </td>
                       <td>{{ $order->payment_method }}</td>
                       <td>{{ $order->grand_total }}</td>
                       <td>{{ $order->created_at }}</td>
                   </tr>
                    @endforeach
                </tbody>
            </table>
		</div>
	</div>
</section>
@endsection