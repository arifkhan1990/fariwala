@extends('layouts.adminLayout.admin_design')
@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Products</a> <a href="#" class="current">Add Product</a> </div>
    <h1>Products</h1>
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
            <h5>Add Product</h5>
          </div>
          <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{ url('/admin/add-product') }}" name="add_product" id="add_product" novalidate="novalidate" enctype="multipart/form-data">
              {{ csrf_field() }}

              <div class="control-group">
                <label class="control-label"> Under Category</label>
                <div class="controls">
                  <select name="category_id" style="width: 220px;">
                    <?php echo $category_dropdown; ?>
                  </select>
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Product Name</label>
                <div class="controls">
                  <input type="text" name="product_name" id="product_name">
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Product Code</label>
                <div class="controls">
                  <input type="text" name="product_code" id="product_code">
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Product Color</label>
                <div class="controls">
                  <input type="text" name="product_color" id="product_color">
                </div>
              </div>

               <div class="control-group">
                <label class="control-label">Product Description</label>
                <div class="controls">
                  <textarea name="product_description" id="product_description" rows="4"></textarea> 
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Material & Care</label>
                <div class="controls">
                  <textarea name="product_care" id="product_care" rows="4"></textarea> 
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Product Price</label>
                <div class="controls">
                  <input type="text" name="product_price" id="product_price">
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Product Image</label>
                <div class="controls">
                  <input type="file" name="product_image" id="product_image" class="input-file uniform-on">
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Product Size</label>
                <div class="controls">
                  <input type="text" name="product_size" id="product_size">
                </div>
              </div>

              <div class="form-actions">
                <input type="submit" value="Add product" class="btn btn-success">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection