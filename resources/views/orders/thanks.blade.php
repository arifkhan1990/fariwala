@extends('layouts.frontendLayout.frontend_design')
@section('content')
<section id="cart_items">
	<div class="container">
		<div class="breadcrumbs">
			<ol class="breadcrumb">
				<li><a href="{{ url('/') }}">Home</a></li>
				<li class="active">Thanks</li>
			</ol>
		</div>
	</div>
</section>
<section id="do_action">
	<div class="container">
		<div class="heading" align="center">
			<h3>Your COD order has been placed</h3>
			<p>Your order number is {{ Session::get('order_id') }} and total payable about is <strong>{{ Session::get('grand_total') }} Tk</strong></p>
		</div>
	</div>
</section>
@endsection

<?php 
  Session::forget('order_id');
  Session::forget('grand_total');
 ?>