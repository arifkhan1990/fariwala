@extends('layouts.adminLayout.admin_design')
@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="{{ url('admin/dashboard')}}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">All Banners</a> </div>
    <h1>View Banners</h1>
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
            <h5>Banner table</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Banner Id</th>
                  <th>Banner Image</th>
                  <th>Banner Title</th>
                  <th>Link</th>
                  <th>Banner Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              @foreach ($banners as $Banner)
              <tbody>
                <tr class="gradeX">
                  <td>{{ $Banner->id }}</td>
                  <td><img src="{{ url('images/frontend_images/banners/'.$Banner->image) }}" style="width: 160px; height: 80px;"></td>
                  <td>{{ $Banner->title }}</td>
                  <td>{{ $Banner->link }}</td>
                  <td>
                  @if($Banner->banner_status==1)
                  <span class="label label-success">Active</span>
                  @else
                  <span class="label label-danger">Unactive</span>
                  @endif
                  </td>
                  <td>
                    @if($Banner->banner_status==1)
                    <a href="{{ url('/admin/unactive-banner/'.$Banner->id) }}" class="btn btn-success" title="Banner Unactive"><i class="halflings-icon white  icon-thumbs-up"></i></a>
                    @else 
                    <a href="{{ url('/admin/active-banner/'.$Banner->id) }}" class="btn btn-danger" title="Banner Active"><i class="halflings-icon white  icon-thumbs-down"></i></a>
                    @endif

                    <a href="{{ url('/admin/edit-banner/'.$Banner->id )}}" class="btn btn-info" title="Edit Banner"><i class="halflings-icon white icon-edit"></i></a>

                    <a rel="{{ $Banner->id }}" rel1="delete-banner" <?php /*href ="{{ url('/admin/delete-banner/'.$Banner->id ) }}"*/ ?> href="javascript:" class="btn btn-danger deleteRecord" ><i class="halflings-icon white icon-trash" title="Delete Banner"></i></a>

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