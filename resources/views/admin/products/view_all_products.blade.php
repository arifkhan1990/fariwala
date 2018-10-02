@extends('layouts.adminLayout.admin_design')
@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">All Products</a> </div>
    <h1>View Products</h1>
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
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Product table</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Product Id</th>
                  <th>Product Image</th>
                  <th>Category Name</th>
                  <th>Product Name</th>
                  <th>Product Code</th>
                  <th>Product Description</th>
                  <th>Product Price</th>
                  <th>Product Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              @foreach ($products_info as $product)
              <tbody>
                
                <tr class="gradeX">
                  <td>{{ $product->product_id }}</td>
                  <td><img src="{{ url('images/backend_images/products/small/'.$product->product_image) }}" style="width: 80px;height: 80px;"></td>
                  <td>{{ $product->category_name }}</td>
                  <td>{{ $product->product_name }}</td>
                  <td>{{ $product->product_code }}</td>
                  <td>{{ $product->product_description }}</td>
                  <td>{{ $product->product_price }}<strong> Tk.</strong></td>
                  <td>
                  @if($product->product_status==1)
                  <span class="label label-success">Active</span>
                  @else
                  <span class="label label-danger">Unactive</span>
                  @endif
                  </td>
                  <td>
                    @if($product->product_status==1)
                    <a href="" class="btn btn-danger"><i class="halflings-icon white  icon-thumbs-down"></i></a>
                    @else 
                    <a href="" class="btn btn-success"><i class="halflings-icon white  icon-thumbs-up"></i></a>
                    @endif
                    <a href="#myModal{{$product->id}}" data-toggle="modal" class="btn btn-primary" id="view_product"><i class="halflings-icon white icon-eye-open"></i></a>

                    <a href="{{ url('/admin/add-attribute/'.$product->id )}}" class="btn btn-info"><i class="halflings-icon white icon-plus"></i></a>

                    <a href="{{ url('/admin/edit-product/'.$product->id )}}" class="btn btn-info"><i class="halflings-icon white icon-edit"></i></a>
                    <a rel="{{ $product->id }}" rel1="delete-product" <?php /*href ="{{ url('/admin/delete-product/'.$product->id ) }}"*/ ?> href="javascript:" class="btn btn-danger deleteRecord" ><i class="halflings-icon white icon-trash"></i></a>
                  </td>
                </tr>
              </tbody>
              <div id="myModal{{$product->id}}" class="modal hide" style="display: none;" aria-hidden="true">
                <div class="modal-header">
                  <button data-dismiss="modal" class="close" type="button">×</button>
                  <h3><strong>{{ $product->product_name }} -> </strong>Full Details</h3>
                </div>
                <div class="modal-body mdleft">
                  <div class="control-group">
                  <label class="control-label">Category Name : </label>
                  <label class="control-label"><strong>{{ $product->category_name }}</strong></label>
                  </div>
                  <label class="control-label">Product Code : </label>
                  <label class="control-"><strong>{{ $product->product_code }}</strong></label>
                  <label class="control-label">Product Color : </label>
                  <label class="control-"><strong>{{ $product->product_color }}</strong></label>
                  <label class="control-label">Product Size : </label>
                  <label class="control-"><strong>{{ $product->product_size }}</strong></label>
                  <label class="control-label">Product Price : </label>
                  <label class="control-"><strong>{{ $product->product_price }} Tk.</strong></label>
                  <label class="control-label">Product Description : </label>
                  <label class="control-"><strong>{{ $product->product_description }}<strong></label>
                </div>
                <div class="modal-body mdright">
                  <img src="{{ url('images/backend_images/products/small/'.$product->product_image) }}">
                </div>
              </div>
            @endforeach             
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection