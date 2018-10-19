@extends('layouts.frontendLayout.frontend_design')
@section('content')
<section id="cart_items">
	<div class="container">
		<div class="breadcrumbs">
			<ol class="breadcrumb">
				<li><a href="{{ url('/') }}">Home</a></li>
        <li><a href="{{ url('orders') }}">Orders</a></li>
				<li class="active">{{ $orderDetails->id }}</li>
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
                        <th scope="col">Product Code</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Product Size</th>
                        <th scope="col">Product Color</th>
                        <th scope="col">Product Price</th>
                        <th scope="col">Product Quantity</th>
                    </tr>
                </thead>
                <tbody>
                	@foreach($orderDetails->orders as $pro)
                    <tr>
                       <td>{{ $pro->product_code }}</td>
                       <td>{{ $pro->product_name }}</td>
                       <td>{{ $pro->product_size }}</td>
                       <td>{{ $pro->product_color }}</td>
                       <td>{{ $pro->product_price }}</td>
                       <td>{{ $pro->product_qty }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
		</div>
	</div>
</section>
@endsection