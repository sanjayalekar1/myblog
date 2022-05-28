@extends('layouts.admin_layout')
@section('title', 'Edit Timeline')
@section('content')
<section class="content-header">
    <h1>Edit Timeline</h1>
    <ol class="breadcrumb">
        <li><a href="{{Config::get('constants.admin_url')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{Config::get('constants.admin_url')}}manage-timelines"><i class="fa fa-dashboard"></i> Manage Timelines</a></li>
        <li class="active">Edit Timeline</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 connectedSortable">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Edit Timeline</h3>
                <div class="box-tools"></div>
            </div>
            <form id="edit_timeline" class="hideformspan" enctype="multipart/form-data">
                @csrf
                <div class="box-body">
                    <input type="hidden" name="timeline_id" value="{{$timeline->id}}">
                    <div class="form-group">
                        <label>Timeline Name</label>
                        <input name="timeline_year" id="timeline_year" value="{{$timeline->timeline_year}}">
                        <span id="timeline_year_err"></span>
                    </div>
                    <div class="form-group">
                        <label for="timeline_thumbnail">Timeline Thumbnail*</label>
                        <br>
                        <img src="{{url('/')}}/assets/images/timelines/{{$timeline->timeline_thumbnail}}" style="width: 300px;">
                        <input type="file" name="timeline_thumbnail" id="timeline_thumbnail" accept="image/*">
                        <span id="timeline_thumbnail_err"></span>
                    </div>
                    <div class="form-group">
                        <label>Timeline Description</label>
                        <textarea name="timeline_description" id="timeline_description">{{$timeline->timeline_description}}</textarea>
                        <span id="timeline_description_err"></span>
                    </div>
                    <div class="form-group">
                        <label for="display_status">Status</label>
                        <select name="display_status" id="display_status">
                            <option value="1">Active</option>
                            <option value="0"@if(empty($timeline->display_status)) selected @endif>Inactive</option>
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