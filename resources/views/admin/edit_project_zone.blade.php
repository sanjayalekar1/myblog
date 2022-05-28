@extends('layouts.admin_layout')
@section('title', 'Edit Project Zone')
@section('content')
<section class="content-header">
    <h1>Edit Project Zone</h1>
    <ol class="breadcrumb">
        <li><a href="{{Config::get('constants.admin_url')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{Config::get('constants.admin_url')}}manage-project-zones"><i class="fa fa-dashboard"></i> Manage Project Zones</a></li>
        <li class="active">Edit Project Zone</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 connectedSortable">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Edit Project Zone</h3>
                <div class="box-tools"></div>
            </div>
            <form id="edit_project_zone" class="hideformspan" enctype="multipart/form-data">
                @csrf
                <div class="box-body">
                    <input type="hidden" name="project_zone_id" value="{{$project_zone->id}}">
                    <div class="form-group">
                        <label>Zone Title</label>
                        <input name="project_zone_title" id="project_zone_title" value="{{$project_zone->project_zone_title}}">
                        <span id="project_zone_title_err"></span>
                    </div>
                    <div class="form-group">
                        <label for="display_status">Status</label>
                        <select name="display_status" id="display_status">
                            <option value="1">Active</option>
                            <option value="0"@if(empty($project_zone->display_status)) selected @endif>Inactive</option>
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