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
			<div class="shopper-informations">
				<div class="row">
					<div class="col-sm-5 col-sm-offset-1">
						<div class="bill-to">
							<p class="col-sm-offset-2">Bill To</p>
							<div class="form-one">
								<form action="{{ url('/save-shipping-details')}}" method="post">
									{{ csrf_field() }}
									<input type="text" placeholder="Billing Name *" name="billing_name" value="{{ $userDetails->name }}" required="">
									<input type="text" value="{{ $userDetails->address }}" placeholder="Billing Address*" name="billing_address" required="">
									<input type="text" value="{{ $userDetails->city }}" placeholder="Billing City *" name="billing_city" required="">
									<input type="text" value="{{ $userDetails->state }}" placeholder="Billing State *" name="billing_state" required="">
									<select id="billing_country" name="billing_country" style="width: 400px;" class="form-control">
										<option value="">Select Country</option>
										@foreach($countries as $country)
										<option value="{{ $country->country_name }}"
											@if($country->country_name == $userDetails->country)
											selected @endif > {{ $country->country_name }}</option>
										@endforeach
									</select>
									<input type="text" value="{{ $userDetails->zipcode }}" placeholder="Billing PinCode *" name="billing_pincode" required="" style="margin-top: 10px;">
									<input type="text" value="{{ $userDetails->phone }}" placeholder="Billing Mobile Number *" name="billing_mobile_number" required="">
									<div class="form-check">
										<input type="checkbox" name="" class="form-check-input" id="billtoship">
										<label class="form-check-label" for="billtoship">Shipping Address same as Billing Address</label>
									</div>
									<!-- <button class="btn btn-block btn-primary">Done</button> -->
								</form>
							</div>
						</div>
					</div>
					<div class=" col-sm-5 col-sm-offset-1">
						<div class="bill-to">
							<p class="col-sm-offset-2">Sipping Details</p>
							<div class="form-one">
								<form action="{{ url('/save-shipping-details')}}" method="post">
									{{ csrf_field() }}
									<input type="text" placeholder="Shipping Name *" name="Shipping_name" required="">
									<input type="text" placeholder="Shipping Address*" name="Shipping_address" required="">
									<input type="text" placeholder="Shipping City *" name="Shipping_city" required="">
									<input type="text" placeholder="Shipping State *" name="Shipping_state" required="">
									<input type="text" placeholder="Shipping Country *" name="Shipping_country" required="">
									<input type="text" placeholder="Shipping PinCode *" name="Shipping_pincode" required="">
									<input type="text" placeholder="Shipping Mobile Number *" name="Shipping_mobile_number" required="">
									<input type="submit" value="Checkout" class="btn btn-primary">
									<!-- <button class="btn btn-block btn-primary">Done</button> -->
								</form>
							</div>
						</div>
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