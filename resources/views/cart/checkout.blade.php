@extends('layouts.frontendLayout.frontend_design')
@section('content')
<section id="cart_items">
	<div class="container">
		<div class="breadcrumbs">
			<ol class="breadcrumb">
				<li><a href="#">Home</a></li>
				<li class="active">Check out</li>
			</ol>
			</div><!--/breadcrums-->
			<div class="container">
				@if(Session::has('flash_message_error'))
				<div class="alert alert-error alert-block" style="background-color: #f2dfd0">
					<button type="button" class="close" data-dismiss="alert">×</button>
					<strong>{{ session('flash_message_error') }}</strong>
				</div>
				@endif
				@if(Session::has('flash_message_success'))
				<div class="alert alert-success alert-block">
					<button type="button" class="close" data-dismiss="alert">×</button>
					<strong>{{ session('flash_message_success') }}</strong>
				</div>
				@endif
				<form action="{{ url('/checkout')}}" method="post">
					{{ csrf_field() }}
					<div class="row">
						<div class="col-sm-4 col-sm-offset-1">
							<div class="login-form">
								<h2 class="col-sm-offset-2">Bill To</h2>
								<div class="form-group">
									<input type="text" placeholder="Billing Name *" id="billing_name" name="billing_name" @if(!empty($userDetails->name)) value="{{ $userDetails->name }}" @endif required="" class="form-control">
								</div>
								<div class="form-group">
									<input type="text" @if(!empty($userDetails->address)) value="{{ $userDetails->address }}" @endif id="billing_address" placeholder="Billing Address*" name="billing_address" required="" class="form-control">
								</div>
								<div class="form-group">
									<input type="text" @if(!empty($userDetails->city)) value="{{ $userDetails->city }}" @endif placeholder="Billing City *" id="billing_city" name="billing_city" required="" class="form-control">
								</div>
								<div class="form-group">
									<input type="text" @if(!empty($userDetails->state)) value="{{ $userDetails->state }}" @endif placeholder="Billing State *" id="billing_state" name="billing_state" required="" class="form-control">
								</div>
								<div class="form-group">
									<select id="billing_country" name="billing_country" class="form-control">
										<option value="">Select Country</option>
										@foreach($countries as $country)
										<option value="{{ $country->country_name }}"
											@if(!empty($userDetails->country) && $country->country_name == $userDetails->country)
											selected @endif > {{ $country->country_name }}
										</option>
										@endforeach
									</select>
								</div>
								<div class="form-group">
									<input type="text" @if(!empty($userDetails->zipcode)) value="{{ $userDetails->zipcode }}" @endif placeholder="Billing PinCode *" name="billing_pincode" id="billing_pincode" required="" style="margin-top: 10px;" class="form-control">
								</div>
								<div class="form-group">
									<input type="text" @if(!empty($userDetails->phone)) value="{{ $userDetails->phone }}" @endif placeholder="Billing Mobile Number *" id="billing_phone" name="billing_phone" required="" class="form-control">
								</div>
								<div class="form-check">
									<input type="checkbox" name="" class="form-check-input" id="billtoship">
									<label class="form-check-label" for="billtoship">Shipping Address same as Billing Address</label>
								</div>
								</div><!--/login form-->
							</div>
							<div class="col-sm-1" style="margin-left: 20px;">
							</div>
							<div class="col-sm-4" style="margin-left: 40px;">
								<div class="signup-form"><!--sign up form-->
								<h2 class="col-sm-offset-2">Shiping To</h2>
								<div class="form-group">
									<input type="text" placeholder="Shipping Name *" id="shipping_name" name="shipping_name" required="" class="form-control">
								</div>
								<div class="form-group">
									<input type="text" placeholder="Shipping Address*" id="shipping_address" name="shipping_address" required="" class="form-control">
								</div>
								<div class="form-group">
									<input type="text" placeholder="Shipping City *" id="shipping_city" name="shipping_city" required="" class="form-control">
								</div>
								<div class="form-group">
									<input type="text" placeholder="Shipping State *" id="shipping_state" name="shipping_state" required="" class="form-control">
								</div>
								<div class="form-group">
									<select id="shipping_country" name="shipping_country" class="form-control">
										<option value="">Select Country</option>
										@foreach($countries as $country)
										<option value="{{ $country->country_name }}"> {{ $country->country_name }}
										</option>
										@endforeach
									</select>
								</div>
								<div class="form-group">
									<input type="text" placeholder="Shipping PinCode *" id="shipping_pincode" name="shipping_pincode" required="" class="form-control">
								</div>
								<div class="form-group">
									<input type="text" placeholder="Shipping Mobile Number *" name="shipping_phone" id="shipping_phone" required="" class="form-control">
								</div>
								<input type="submit" value="Checkout" class="btn btn-primary">
							</form>
							</div><!--/sign up form-->
						</div>
					</div>
				</div>
				<div class="review-payment">
					<h2>Review & Payment</h2>
				</div>
				<div class="table-responsive cart_info">
					<table class="table table-condensed">
						<thead>
							<tr class="cart_menu">
								<td class="image">Item</td>
								<td class="description"></td>
								<td class="price">Price</td>
								<td class="quantity">Quantity</td>
								<td class="total">Total</td>
								<td></td>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td class="cart_product">
									<a href=""><img src="images/cart/one.png" alt=""></a>
								</td>
								<td class="cart_description">
									<h4><a href="">Colorblock Scuba</a></h4>
									<p>Web ID: 1089772</p>
								</td>
								<td class="cart_price">
									<p>$59</p>
								</td>
								<td class="cart_quantity">
									<div class="cart_quantity_button">
										<a class="cart_quantity_up" href=""> + </a>
										<input class="cart_quantity_input" type="text" name="quantity" value="1" autocomplete="off" size="2">
										<a class="cart_quantity_down" href=""> - </a>
									</div>
								</td>
								<td class="cart_total">
									<p class="cart_total_price">$59</p>
								</td>
								<td class="cart_delete">
									<a class="cart_quantity_delete" href=""><i class="fa fa-times"></i></a>
								</td>
							</tr>
							<tr>
								<td class="cart_product">
									<a href=""><img src="images/cart/two.png" alt=""></a>
								</td>
								<td class="cart_description">
									<h4><a href="">Colorblock Scuba</a></h4>
									<p>Web ID: 1089772</p>
								</td>
								<td class="cart_price">
									<p>$59</p>
								</td>
								<td class="cart_quantity">
									<div class="cart_quantity_button">
										<a class="cart_quantity_up" href=""> + </a>
										<input class="cart_quantity_input" type="text" name="quantity" value="1" autocomplete="off" size="2">
										<a class="cart_quantity_down" href=""> - </a>
									</div>
								</td>
								<td class="cart_total">
									<p class="cart_total_price">$59</p>
								</td>
								<td class="cart_delete">
									<a class="cart_quantity_delete" href=""><i class="fa fa-times"></i></a>
								</td>
							</tr>
							<tr>
								<td class="cart_product">
									<a href=""><img src="images/cart/three.png" alt=""></a>
								</td>
								<td class="cart_description">
									<h4><a href="">Colorblock Scuba</a></h4>
									<p>Web ID: 1089772</p>
								</td>
								<td class="cart_price">
									<p>$59</p>
								</td>
								<td class="cart_quantity">
									<div class="cart_quantity_button">
										<a class="cart_quantity_up" href=""> + </a>
										<input class="cart_quantity_input" type="text" name="quantity" value="1" autocomplete="off" size="2">
										<a class="cart_quantity_down" href=""> - </a>
									</div>
								</td>
								<td class="cart_total">
									<p class="cart_total_price">$59</p>
								</td>
								<td class="cart_delete">
									<a class="cart_quantity_delete" href=""><i class="fa fa-times"></i></a>
								</td>
							</tr>
							<tr>
								<td colspan="4">&nbsp;</td>
								<td colspan="2">
									<table class="table table-condensed total-result">
										<tr>
											<td>Cart Sub Total</td>
											<td>$59</td>
										</tr>
										<tr>
											<td>Exo Tax</td>
											<td>$2</td>
										</tr>
										<tr class="shipping-cost">
											<td>Shipping Cost</td>
											<td>Free</td>
										</tr>
										<tr>
											<td>Total</td>
											<td><span>$61</span></td>
										</tr>
									</table>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="payment-options">
					<span>
						<label><input type="checkbox"> Direct Bank Transfer</label>
					</span>
					<span>
						<label><input type="checkbox"> Check Payment</label>
					</span>
					<span>
						<label><input type="checkbox"> Paypal</label>
					</span>
				</div>
			</div>
			</section> <!--/#cart_items-->
			@endsection