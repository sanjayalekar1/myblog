@extends('layouts.admin_layout')
@section('title', 'Edit Why Us')
@section('content')
<section class="content-header">
    <h1>Edit Why Us</h1>
    <ol class="breadcrumb">
        <li><a href="{{Config::get('constants.admin_url')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{Config::get('constants.admin_url')}}manage-why-us"><i class="fa fa-dashboard"></i> Manage Why Us</a></li>
        <li class="active">Edit Why Us</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 connectedSortable">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Edit Why Us</h3>
                <div class="box-tools"></div>
            </div>
            <form id="edit_why_us" class="hideformspan" enctype="multipart/form-data">
                @csrf
                <div class="box-body">
                    <input type="hidden" name="why_us_id" value="{{$why_us->id}}">
                    <div class="form-group">
                        <label>Title*</label>
                        <input name="section_title" id="section_title" value="{{$why_us->section_title}}">
                        <span id="section_title_err"></span>
                    </div>
                    <div class="form-group">
                        <label for="section_image">Image*</label>
                        <br>
                        <img src="{{url('/')}}/assets/images/why-us/{{$why_us->section_image}}" style="width: 300px;">
                        <input type="file" name="section_image" id="section_image" accept="image/*">
                        <span id="section_image_err"></span>
                    </div>
                    <div class="form-group">
                        <label>Content*</label>
                        <textarea name="section_content" id="section_content" class="basic_editor">{{$why_us->section_content}}</textarea>
                        <span id="section_content_err"></span>
                    </div>
                    <div class="form-group">
                        <label for="display_status">Status</label>
                        <select name="display_status" id="display_status">
                            <option value="1">Active</option>
                            <option value="0"@if(empty($why_us->display_status)) selected @endif>Inactive</option>
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