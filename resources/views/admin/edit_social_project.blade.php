@extends('layouts.admin_layout')
@section('title', 'Edit Social Project')
@section('content')
<section class="content-header">
    <h1>Edit Social Project</h1>
    <ol class="breadcrumb">
        <li><a href="{{Config::get('constants.admin_url')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{Config::get('constants.admin_url')}}manage-social-projects"><i class="fa fa-dashboard"></i> Manage Social Projects</a></li>
        <li class="active">Edit Social Project</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 connectedSortable">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Edit Social Project</h3>
                <div class="box-tools"></div>
            </div>
            <form id="edit_social_project" class="hideformspan" enctype="multipart/form-data">
                @csrf
                <div class="box-body">
                    <input type="hidden" name="social_project_id" value="{{$social_project->id}}">
                    <div class="form-group">
                        <label>Social Project Name*</label>
                        <input name="social_project_name" id="social_project_name" value="{{$social_project->social_project_name}}">
                        <span id="social_project_name_err"></span>
                    </div>
                    <div class="form-group">
                        <label>Social Project Description*</label>
                        <textarea name="social_project_description" id="social_project_description">{{$social_project->social_project_description}}</textarea>
                        <span id="social_project_description_err"></span>
                    </div>
                    <div class="form-group">
                        <label for="display_status">Status</label>
                        <select name="display_status" id="display_status">
                            <option value="1">Active</option>
                            <option value="0"@if(empty($social_project->display_status)) selected @endif>Inactive</option>
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