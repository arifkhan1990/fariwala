@extends('layouts.adminLayout.admin_design')
@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="{{ url('/admin/dashboard')}}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Coupons</a> <a href="{{ url('/admin/add-coupon')}}" class="current">Add Coupon</a> </div>
    <h1>Coupons</h1>
        @if(Session::has('flash_message_error'))
            <div class="alert alert-error alert-block">
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
  </div>
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Add Coupon</h5>
          </div>
          <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{ url('/admin/add-product') }}" name="add_product" id="add_product" novalidate="novalidate" enctype="multipart/form-data">
              {{ csrf_field() }}

              <div class="control-group">
                <label class="control-label">Coupon Code</label>
                <div class="controls">
                  <input type="text" name="coupon_code" id="coupon_code">
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Amount</label>
                <div class="controls">
                  <input type="text" name="amount" id="amount">
                </div>
              </div>

              <div class="control-group">
                <label class="control-label"> Amount Type</label>
                <div class="controls">
                  <select name="category_id" style="width: 220px;">
                    <option value="Percentage">Percentage</option>
                    <option value="Fixed">Fixed</option>
                  </select>
                </div>
              </div>

               <div class="control-group">
                <label class="control-label">Expiry Date</label>
                <div class="controls">
                  <input type="text" name="expiry_date" id="expiry_date">
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Coupon Status</label>
                <div class="controls">
                  <input type="checkbox" name="coupon_status" id="coupon_status" value="1">
                </div>
              </div>

              <div class="form-actions">
                <input type="submit" value="Add coupon" class="btn btn-success">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection