@extends('layouts.admin_layout')
@section('title', 'Add Project Zone')
@section('content')
<section class="content-header">
    <h1>Add Project Zone</h1>
    <ol class="breadcrumb">
        <li><a href="{{Config::get('constants.admin_url')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{Config::get('constants.admin_url')}}manage-project-zones"><i class="fa fa-dashboard"></i> Manage Project Zones</a></li>
        <li class="active">Add Project Zone</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 connectedSortable">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Add Project Zone</h3>
                <div class="box-tools"></div>
            </div>
            <form id="add_project_zone" class="hideformspan" enctype="multipart/form-data">
                @csrf
                <div class="box-body">
                    <div class="form-group">
                        <label>Zone Title</label>
                        <input name="project_zone_title" id="project_zone_title">
                        <span id="project_zone_title_err"></span>
                    </div>
                    <div class="form-group">
                        <label for="display_status">Status</label>
                        <select name="display_status" id="display_status">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
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