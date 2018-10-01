@extends('layouts.adminLayout.admin_design')
@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">All Categories</a> </div>
    <h1>View Categories</h1>
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
            <h5>Data table</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Category Id</th>
                  <th>Category Name</th>
                  <th>Category Level</th>
                  <th>Category Description</th>
                  <th>Category Url</th>
                  <th>Category Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              @foreach ($categories_info as $category)
              <tbody>
                
                <tr class="gradeX">
                  <td>{{ $category->category_id }}</td>
                  <td>{{ $category->category_name }}</td>
                  <td>{{ $category->parent_id }}</td>
                  <td>{{ $category->category_description }}</td>
                  <td>{{ $category->category_url }}</td>
                  <td>
                  @if($category->category_status==1)
                  <span class="label label-success">Active</span>
                  @else
                  <span class="label label-danger">Unactive</span>
                  @endif
                  </td>
                  <td>
                    @if($category->category_status==1)
                    <a href="" class="btn btn-danger"><i class="halflings-icon white  icon-thumbs-down"></i></a>
                    @else 
                    <a href="" class="btn btn-success"><i class="halflings-icon white  icon-thumbs-up"></i></a>
                    @endif
                    <a href="{{ url('/admin/edit-category/'.$category->category_id )}}" class="btn btn-info"><i class="halflings-icon white icon-edit"></i></a>
                    <a rel="{{ $category->category_id }}" rel1="delete-category" <?php /*href ="{{ url('/admin/delete-category/'.$category->category_id ) }}"*/ ?> href="javascript:" class="btn btn-danger deleteRecord" ><i class="halflings-icon white icon-trash"></i></a>
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