@extends('layouts.frontendLayout.frontend_design')
@section('content')
	<section>
		<div class="container">
			<div class="row">

				<!-- Sidebar Link Start -->
                @include('layouts.frontendLayout.frontend_sidebar')
                <!-- Sidebar Link End -->

				<div class="col-sm-9 padding-right">
					<div class="product-details"><!--product-details-->
						<div class="col-sm-5">
							<div class="view-product">
								<div class="easyzoom easyzoom--overlay easyzoom--with-thumbnails">
									<a href="{{ asset('images/backend_images/products/large/'. $product_details->product_image )}}" data-standard="{{ asset('images/backend_images/products/small/'. $product_details->product_image )}}">
								    <img class="mainClass" src="{{ asset('images/backend_images/products/medium/'. $product_details->product_image )}}" style="width: 350px;" alt="" />
								    </a>
								</div>
							</div>
							<div id="similar-product" class="carousel slide" data-ride="carousel">
								
								  <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                        <div class="item active thumbnails">
                        	<a href="{{ asset('images/backend_images/products/large/'. $product_details->product_image )}}" data-standard="{{ asset('images/backend_images/products/small/'. $product_details->product_image )}}">
							<img class="subClass" src="{{ asset('images/backend_images/products/small/'. $product_details->product_image )}}" style="width: 50px;" alt="" />
							</a>
                        	@foreach($productalteImg as $altImg)
                        	<a href="{{ url('images/backend_images/products/large/'.$altImg->product_images)}}" data-standard="{{ url('images/backend_images/products/small/'.$altImg->product_images)}}">
                            <img class="subClass"  style="cursor:pointer; width: 50px;" src="{{ url('images/backend_images/products/small/'.$altImg->product_images)}}" alt="">
                            </a>
                            @endforeach
                        </div>
                    </div>

							</div>

						</div>
						<div class="col-sm-7">
							<div class="product-information"><!--/product-information-->
								<img src="images/product-details/new.jpg" class="newarrival" alt="" />
								<h2>{{ $product_details->product_name}}</h2>
								<p>Product Code: {{ $product_details->product_code}}</p>
								<p>
									<select id="selSize" name="size" style="width: 150px;">
										<option value="">Select Size</option>
										@foreach($product_details->attributes as $sizes)
										<option value="{{ $product_details->id }}-{{ $sizes->size }}">{{ $sizes->size }}</option>
										@endforeach
									</select>
								</p>
								<img src="images/product-details/rating.png" alt="" />
								<span>
									<span id="getPrice">{{ $product_details->product_price}} Tk.</span>
									<label>Quantity:</label>
									<input type="text" value="3" />
									@if($totalStock > 0)
									<button type="button" class="btn btn-fefault cart" id="cartButton">
										<i class="fa fa-shopping-cart"></i>
										Add to cart
									</button>
									@endif
								</span>
								<p><b>Availability:</b> <span id = "availability">@if($totalStock > 0) In Stock @else Out of Stock @endif</span></p>
								<p><b>Condition:</b> New</p>
								<p><b>Brand:</b> Fariwala</p>
								<a href=""><img src="images/product-details/share.png" class="share img-responsive"  alt="" /></a>
							</div><!--/product-information-->
						</div>
					</div><!--/product-details-->
					
					<div class="category-tab shop-details-tab"><!--category-tab-->
						<div class="col-sm-12">
							<ul class="nav nav-tabs">
								<li  class="active"><a href="#description" data-toggle="tab">Description</a></li>
								<li><a href="#care" data-toggle="tab">Material & Care</a></li>
								<li><a href="#delivery" data-toggle="tab">Delivery Options</a></li>
							</ul>
						</div>
						<div class="tab-content">
							<div class="tab-pane fade active in" id="description" >
								<div class="col-sm-12">
									<p>{{ $product_details->product_description}}</p>
								</div>
							</div>
							
							<div class="tab-pane fade" id="care" >
                                <div class="col-sm-12">
                                	<p>{{ $product_details->product_care}}</p>
                                </div>
							</div>
							
							<div class="tab-pane fade" id="delivery" >
                                <div class="col-sm-12">
                                	<p>100% original Products<br>
                                		Cash on delivery
                                	</p>
                                </div>
							</div>
						</div>
					</div><!--/category-tab-->
					
					<div class="recommended_items"><!--recommended_items-->
						<h2 class="title text-center">recommended items</h2>
						
						<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">
								<div class="item active">	
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="images/home/recommend1.jpg" alt="" />
													<h2>$56</h2>
													<p>Easy Polo Black Edition</p>
													<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
												</div>
											</div>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="images/home/recommend2.jpg" alt="" />
													<h2>$56</h2>
													<p>Easy Polo Black Edition</p>
													<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
												</div>
											</div>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="images/home/recommend3.jpg" alt="" />
													<h2>$56</h2>
													<p>Easy Polo Black Edition</p>
													<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="item">	
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="images/home/recommend1.jpg" alt="" />
													<h2>$56</h2>
													<p>Easy Polo Black Edition</p>
													<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
												</div>
											</div>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="images/home/recommend2.jpg" alt="" />
													<h2>$56</h2>
													<p>Easy Polo Black Edition</p>
													<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
												</div>
											</div>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="images/home/recommend3.jpg" alt="" />
													<h2>$56</h2>
													<p>Easy Polo Black Edition</p>
													<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							 <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
								<i class="fa fa-angle-left"></i>
							  </a>
							  <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
								<i class="fa fa-angle-right"></i>
							  </a>			
						</div>
					</div><!--/recommended_items-->
					
				</div>
			</div>
		</div>
	</section>
@endsection