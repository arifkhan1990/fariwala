@extends('layouts.adminLayout.admin_design')
@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Categories</a> <a href="#" class="current">Edit Category</a> </div>
    <h1>Categories</h1>
  </div>
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Edit Category</h5>
          </div>
          <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{ url('/admin/edit-category/'.$category_details->category_id) }}" name="add_category" id="add_category" novalidate="novalidate">
              {{ csrf_field() }}
              <div class="control-group">
                <label class="control-label">Category Name</label>
                <div class="controls">
                  <input type="text" name="category_name" id="category_name" value="{{ $category_details->category_name }}">
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Category Level</label>
                <div class="controls">
                  <select name="parent_id" style="width: 220px;">
                    <option value="0">Main Category</option>
                    <?php foreach ($levels as $subCategory): ?>
                      <option value="{{ $subCategory->category_id}}" @if($subCategory->category_id==$category_details->parent_id) selected @endif>{{ $subCategory->category_name}}</option>
                    <?php endforeach ?>
                  </select>
                </div>
              </div>

               <div class="control-group">
                <label class="control-label">Category Description</label>
                <div class="controls">
                  <textarea name="category_description" id="category_description" rows="5">{{ $category_details->category_description }}</textarea> 
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">URL (Start with http://)</label>
                <div class="controls">
                  <input type="text" name="category_url" id="category_url" value="{{ $category_details->category_url }}">
                </div>
              </div>

              <div class="form-actions">
                <input type="submit" value="Edit Category" class="btn btn-success">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection