@extends('layouts.admin_layout')
@section('title', 'Edit Management')
@section('content')
<section class="content-header">
    <h1>Edit Management</h1>
    <ol class="breadcrumb">
        <li><a href="{{Config::get('constants.admin_url')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{Config::get('constants.admin_url')}}manage-management"><i class="fa fa-dashboard"></i> Manage Management</a></li>
        <li class="active">Edit Management</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 connectedSortable">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Edit Management</h3>
                <div class="box-tools"></div>
            </div>
            <form id="edit_management" class="hideformspan" enctype="multipart/form-data">
                @csrf
                <div class="box-body">
                    <input type="hidden" name="management_id" value="{{$management->id}}">
                    <div class="form-group">
                        <label for="management_category_id">Category</label>
                        <select name="management_category_id" id="management_category_id">
                            <option value="1">Board of Directors</option>
                            <option value="2"@if($management->management_category_id == 2) selected @endif>Key Management</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Management Name*</label>
                        <input name="management_name" id="management_name" value="{{$management->management_name}}">
                        <span id="management_name_err"></span>
                    </div>
                    <div class="form-group">
                        <label for="management_thumbnail">Management Thumbnail*</label>
                        <br>
                        <img src="{{url('/')}}/assets/images/management/{{$management->management_thumbnail}}" style="width: 300px;">
                        <input type="file" name="management_thumbnail" id="management_thumbnail" accept="image/*">
                        <span id="management_thumbnail_err"></span>
                    </div>
                    <div class="form-group">
                        <label>Management Designation*</label>
                        <input type="text" name="management_designation" id="management_designation" value="{{$management->management_designation}}">
                        <span id="management_designation_err"></span>
                    </div>
                    <div class="form-group">
                        <label>Management Description*</label>
                        <textarea name="management_description" id="management_description">{{$management->management_description}}</textarea>
                        <span id="management_description_err"></span>
                    </div>
                    <div class="form-group">
                        <label>Management Linked IN</label>
                        <input type="url" name="management_linked_in" id="management_linked_in" value="{{$management->management_linked_in}}">
                        <span id="management_linked_in_err"></span>
                    </div>
                    <div class="form-group">
                        <label>Management Twitter</label>
                        <input type="url" name="management_twitter" id="management_twitter" value="{{$management->management_twitter}}">
                        <span id="management_twitter_err"></span>
                    </div>
                    <div class="form-group">
                        <label for="display_status">Status</label>
                        <select name="display_status" id="display_status">
                            <option value="1">Active</option>
                            <option value="0"@if(empty($management->display_status)) selected @endif>Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="box-footer">
                    <input type="submit" value="Upload" class="btn btn-primary">
                </div>
            </form>
        </div>
        <div id="resultmessage"></div>
    </div><!-- /.col -->
    <!-- /.row -->
</section><!-- /.content -->
@endsection