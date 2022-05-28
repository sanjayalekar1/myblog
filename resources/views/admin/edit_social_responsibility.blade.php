@extends('layouts.admin_layout')
@section('title', 'Edit Social Responsibility')
@section('content')
<section class="content-header">
    <h1>Edit Social Responsibility</h1>
    <ol class="breadcrumb">
        <li><a href="{{Config::get('constants.admin_url')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{Config::get('constants.admin_url')}}manage-social-responsibilities"><i class="fa fa-dashboard"></i> Manage Social Responsibilities</a></li>
        <li class="active">Edit Social Responsibility</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 connectedSortable">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Edit Social Responsibility</h3>
                <div class="box-tools"></div>
            </div>
            <form id="edit_social_responsibility" class="hideformspan" enctype="multipart/form-data">
                @csrf
                <div class="box-body">
                    <input type="hidden" name="social_responsibility_id" value="{{$social_responsibility->id}}">
                    <div class="form-group">
                        <label>Title*</label>
                        <input name="section_title" id="section_title" value="{{$social_responsibility->section_title}}">
                        <span id="section_title_err"></span>
                    </div>
                    <div class="form-group">
                        <label for="section_image">Image*</label>
                        <br>
                        <img src="{{url('/')}}/assets/images/social-responsibilities/{{$social_responsibility->section_image}}" style="width: 300px;">
                        <input type="file" name="section_image" id="section_image" accept="image/*">
                        <span id="section_image_err"></span>
                    </div>
                    <div class="form-group">
                        <label>Content*</label>
                        <textarea name="section_content" id="section_content" class="basic_editor">{{$social_responsibility->section_content}}</textarea>
                        <span id="section_content_err"></span>
                    </div>
                    <div class="form-group">
                        <label for="display_status">Status</label>
                        <select name="display_status" id="display_status">
                            <option value="1">Active</option>
                            <option value="0"@if(empty($social_responsibility->display_status)) selected @endif>Inactive</option>
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