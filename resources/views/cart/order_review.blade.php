@extends('layouts.frontendLayout.frontend_design')
@section('content')
<section id="cart_items">
	<div class="container">
		<div class="breadcrumbs">
			<ol class="breadcrumb">
				<li><a href="#">Home</a></li>
				<li class="active">Order Review</li>
			</ol>
			</div><!--/breadcrums-->
			<div class="container">
				<div class="row">
					<div class="col-sm-4 col-sm-offset-1">
						<div class="login-form">
							<h2 class="col-sm-offset-2">Billing Details</h2>
							<div class="form-group">
								{{ $userDetails->name }}
							</div>
							<div class="form-group">
								{{ $userDetails->address }}
							</div>
							<div class="form-group">
								{{ $userDetails->city }}
							</div>
							<div class="form-group">
								{{ $userDetails->state }}
							</div>
							<div class="form-group">
								{{ $userDetails->country }}
							</div>
							<div class="form-group">
								{{ $userDetails->zipcode }}
							</div>
							<div class="form-group">
								{{ $userDetails->phone }}
							</div>
							</div><!--/login form-->
						</div>
						<div class="col-sm-1" style="margin-left: 20px;">
						</div>
						<div class="col-sm-4" style="margin-left: 40px;">
							<div class="signup-form"><!--sign up form-->
							<h2 class="col-sm-offset-2">Shiping Details</h2>
							<div class="form-group">
								{{ $shippingDetails->name }}
							</div>
							<div class="form-group">
								{{ $shippingDetails->address }}
							</div>
							<div class="form-group">
								{{ $shippingDetails->city }}
							</div>
							<div class="form-group">
								{{ $shippingDetails->state }}
							</div>
							<div class="form-group">
								{{ $shippingDetails->country }}
							</div>
							<div class="form-group">
								{{ $shippingDetails->pincode }}
							</div>
							<div class="form-group">
								{{ $shippingDetails->phone }}
							</div>
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
								<td class="image">Image</td>
								<td class="description">Name|Code|Size</td>
								<td class="price">Price</td>
								<td class="quantity">Quantity</td>
								<td class="total">Total</td>
								<td></td>
							</tr>
						</thead>
						<tbody>
							<?php $totalAmount = 0; ?>
							@foreach($userCart as $cart)
							<tr>
								<td class="cart_product">
									<a href=""><img style="width: 150px;" src="{{ url('images/backend_images/products/small/'.$cart->image)}}" alt=""></a>
								</td>
								<td class="cart_description">
									<h4><a href="">{{ $cart->product_name }}</a></h4>
									<p>Code: {{ $cart->product_code }}</p>
									<p>Size: {{ $cart->product_size }}</p>
								</td>
								<td class="cart_price">
									<p>{{ $cart->product_price }} Tk.</p>
								</td>
								<td class="cart_quantity">
									<div class="cart_quantity_button">
										<a class="cart_quantity_up" href="{{ url('/cart/update-quantity/'.$cart->id.'/1')}}"> + </a>
										<input class="cart_quantity_input" type="text" name="quantity" value="{{ $cart->quantity }}" autocomplete="off" size="2">
										@if($cart->quantity > 1)
										<a class="cart_quantity_down" href="{{ url('/cart/update-quantity/'.$cart->id.'/-1')}}"> - </a>
										@endif
									</div>
								</td>
								<td class="cart_total">
									<p class="cart_total_price">{{ $cart->product_price*$cart->quantity  }} Tk.</p>
								</td>
								<td class="cart_delete">
									<a class="cart_quantity_delete" href="{{ url('/cart/delete-product/'.$cart->id)}}"><i class="fa fa-times"></i></a>
								</td>
							</tr>
							<?php $totalAmount +=  $cart->product_price*$cart->quantity; ?>
							@endforeach
							<tr>
								<td colspan="4">&nbsp;</td>
								<td colspan="2">
									<table class="table table-condensed total-result">
										<tr>
											<td>Cart Sub Total</td>
											<td><span><?php echo $totalAmount; ?> Tk.</span></td>
										</tr>
										<tr>
											<td>Shipping Cost(+)</td>
											<td>Free</td>
										</tr>
										<tr class="shipping-cost">
											<td>Discount Amount(-)</td>
											<td>
												@if(!empty(Session::get('CouponAmount')))
												   {{ Session::get('CouponAmount') }}
												@else
												    0
												@endif
											</td>
										</tr>
										<tr>
											<td>Total</td>
											<td>
												<span>{{ $grand_total = $totalAmount - Session::get('CouponAmount') }} Tk.</span>
											</td>
										</tr>
									</table>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
				<form name="paymentForm" id="paymentForm" action="{{ url('/place-order')}}" method="post">
					{{ csrf_field() }}
					<input type="hidden" name="grand_total" value="{{ $grand_total }}">
				<div class="payment-options">
					<span>
						<label><strong>Select Payment Method:</strong></label>
					</span>
					<span>
						<label><input type="radio" name="payment_method" id="COD" value="COD"><strong> COD</strong></label>
					</span>
					<span>
						<label><input type="radio" name="payment_method" id="Paypal" value="Paypal"><strong> Paypal</strong></label>
					</span>
					<span style="float: right;">
						<button type="submit" class="btn btn-success" onclick="return selectPaymentMethod();">Place Order</button>
					</span>
				</div>
			    </form>
			</div>
			</section> <!--/#cart_items-->
			@endsection