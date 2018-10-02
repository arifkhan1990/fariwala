@extends('layouts.adminLayout.admin_design')
@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Products</a> <a href="#" class="current">Add Product Attributes</a> </div>
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
            <h5>Add Product Attributes</h5>
          </div>
          <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{ url('/admin/add-attribute/'.$product_details->id) }}" name="add_attribute" id="add_attribute" novalidate="novalidate" enctype="multipart/form-data">
              {{ csrf_field() }}
              <input type="hidden" name="product_id" value="{{ $product_details->id }}">
              <div class="control-group">
                <label class="control-label">Product Name</label>
                <label class="control-label"><strong>{{$product_details->product_name}}</strong></label>
              </div>

              <div class="control-group">
                <label class="control-label">Product Code</label>
                <label class="control-label"><strong>{{$product_details->product_code}}</strong></label>
              </div>

              <div class="control-group">
                <label class="control-label">Product Color</label>
                <label class="control-label"><strong>{{$product_details->product_color}}</strong></label>
              </div>

              <div class="control-group">
                <label class="control-label">Product Price</label>
                <label class="control-label"><strong>{{$product_details->product_price}}</strong></label>
              </div>


              <div class="control-group">
                <label class="control-label">Product Size</label>
                <label class="control-label"><strong>{{$product_details->product_size}}</strong></label>
              </div>

              <div class="control-group">
                <label class="control-label"></label>
                <div class="field_wrapper">
                  <div>
                    <input required="" type="text" name="sku[]" id="sku" placeholder="SKU" style="width: 120px;" />
                    <input required="" type="text" name="size[]" id="size" placeholder="Size" style="width: 120px;margin-left: 7px;" />
                    <input required="" type="text" name="price[]" id="price" placeholder="Price" style="width: 120px;margin-left: 7px;" />
                    <input required="" type="text" name="stock[]" id="stock" placeholder="Stock" style="width: 120px;margin-left: 7px;" />
                    <a href="javascript:void(0);" class="add_button" title="Add field"> Add</a>
                  </div>
                </div>
              </div>

              <div class="form-actions">
                <input type="submit" value="Add Attributes" class="btn btn-success">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Product Attributes table</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>SKU</th>
                  <th>Size</th>
                  <th>Price</th>
                  <th>Stock</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($product_details['attributes'] as $product)
                <tr class="gradeX">
                  <td>{{ $product->id }}</td>
                  <td>{{ $product->sku }}</td>
                  <td>{{ $product->size }}</td>
                  <td>{{ $product->price }}</td>
                  <td>{{ $product->stock }}</td>
                  <td>
                    <a rel="{{ $product->id }}" rel1="delete-attribute" href="javascript:void" class="btn btn-danger deleteRecord" ><i class="halflings-icon white icon-trash"></i></a>
                  </td>
                </tr>
               @endforeach  
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection