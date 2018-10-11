<?php $url = url()->current(); ?>
<div id="sidebar"><a href="#" class="visible-phone"><i class="icon icon-home"></i> Dashboard</a>
  <ul>
    <li <?php if(preg_match("/dashboard/i", $url)){ ?> class="active" <?php } ?> ><a href="{{ url('/admin/dashboard')}}"><i class="icon icon-home"></i> <span>Dashboard</span></a> </li>
    <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Categories</span> <span class="label label-important">2</span></a>
      <ul <?php if(preg_match("/category/i", $url)){ ?> style="display: block;" <?php } ?> >
        <li <?php if(preg_match("/add-category/i", $url)){ ?> class="active" <?php } ?> ><a href="{{ url('/admin/add-category')}}">Add Category</a></li>
        <li <?php if(preg_match("/view-all-categories/i", $url)){ ?> class="active" <?php } ?> ><a href="{{ url('/admin/view-all-categories')}}">All Categories</a></li>
      </ul>
    </li>

    <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Products</span> <span class="label label-important">2</span></a>
      <ul <?php if(preg_match("/product/i", $url)){ ?> style="display: block;" <?php } ?> >
        <li <?php if(preg_match("/add-product/i", $url)){ ?> class="active" <?php } ?> ><a href="{{ url('/admin/add-product')}}">Add Product</a></li>
        <li <?php if(preg_match("/view-all-products/i", $url)){ ?> class="active" <?php } ?> ><a href="{{ url('/admin/view-all-products')}}">All Products </a></li>
      </ul>
    </li>

    <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Coupons</span> <span class="label label-important">2</span></a>
      <ul <?php if(preg_match("/coupon/i", $url)){ ?> style="display: block;" <?php } ?>>
        <li <?php if(preg_match("/add-coupon/i", $url)){ ?> class="active" <?php } ?> ><a href="{{ url('/admin/add-coupon')}}">Add Coupon</a></li>
        <li <?php if(preg_match("/view-all-coupons/i", $url)){ ?> class="active" <?php } ?> ><a href="{{ url('/admin/view-all-coupons')}}">All Coupons </a></li>
      </ul>
    </li>

    <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Banners</span> <span class="label label-important">2</span></a>
      <ul <?php if(preg_match("/banner/i", $url)){ ?> style="display: block;" <?php } ?>>
        <li <?php if(preg_match("/add-banner/i", $url)){ ?> class="active" <?php } ?> ><a href="{{ url('/admin/add-banner')}}">Add Banner</a></li>
        <li <?php if(preg_match("/view-all-banners/i", $url)){ ?> class="active" <?php } ?> ><a href="{{ url('/admin/view-all-banners')}}">All Banners </a></li>
      </ul>
    </li>
  </ul>
</div>