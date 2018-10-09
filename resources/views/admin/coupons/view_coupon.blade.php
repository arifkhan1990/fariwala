@extends('layouts.adminLayout.admin_design')
@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="{{ url('/admin/dashboard')}}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">All Coupons</a> </div>
    <h1>View Coupons</h1>
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
            <h5>View Coupons</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Coupon Id</th>
                  <th>Coupon Code</th>
                  <th>Amount</th>
                  <th>Amount Type</th>
                  <th>Expiry Date</th>
                  <th>Coupon Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              @foreach ($coupons as $Coupon)
              <tbody>
                
                <tr class="gradeX">
                  <td>{{ $Coupon->id }}</td>
                  <td>{{ $Coupon->coupon_code }}</td>
                  <td>@if($Coupon->amount_type == "Percentage"){{ $Coupon->amount }}% @else {{ $Coupon->amount }} Tk. @endif</td>
                  <td>{{ $Coupon->amount_type }}</td>
                  <td>{{ $Coupon->expiry_date }}</td>
                  <td>
                  @if($Coupon->coupon_status==1)
                  <span class="label label-success">Active</span>
                  @else
                  <span class="label label-danger">Unactive</span>
                  @endif
                  </td>
                  <td>
                    @if($Coupon->coupon_status==1)
                    <a href="{{ url('/admin/unactive-coupon/'.$Coupon->id) }}" class="btn btn-success" title="Coupon Active"><i class="halflings-icon white  icon-thumbs-up"></i></a>
                    @else 
                    <a href="{{ url('/admin/active-coupon/'.$Coupon->id) }}" class="btn btn-danger" title="Coupon UActive"><i class="halflings-icon white  icon-thumbs-down"></i></a>
                    @endif

                    <a href="{{ url('/admin/edit-coupon/'.$Coupon->id )}}" class="btn btn-info" title="Edit Coupon"><i class="halflings-icon white icon-edit"></i></a>

                    <a rel="{{ $Coupon->id }}" rel1="delete-coupon" <?php /*href ="{{ url('/admin/delete-coupon/'.$Coupon->id ) }}"*/ ?> href="javascript:" class="btn btn-danger deleteRecord" ><i class="halflings-icon white icon-trash" title="Delete Coupon"></i></a>

                  </td>
                </tr>
              </tbody>
            @endforeach             
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection