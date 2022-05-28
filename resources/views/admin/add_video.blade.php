@extends('layouts.admin_layout')
@section('title', 'Add Video')
@section('content')
<section class="content-header">
    <h1>Add Video</h1>
    <ol class="breadcrumb">
        <li><a href="{{Config::get('constants.admin_url')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{Config::get('constants.admin_url')}}manage-videos"><i class="fa fa-dashboard"></i> Manage Videos</a></li>
        <li class="active">Add Video</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 connectedSortable">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Add Video</h3>
                <div class="box-tools"></div>
            </div>
            <form id="add_video" class="hideformspan" enctype="multipart/form-data">
                @csrf
                <div class="box-body">
                    <div class="form-group">
                        <label>Video Title</label>
                        <input name="video_title" id="video_title">
                        <span id="video_title_err"></span>
                    </div>
                    <div class="form-group">
                        <label for="youtube_video_id">YouTube Video ID*</label>
                        <input type="text" name="youtube_video_id" id="youtube_video_id" maxlength="11">
                        <span id="youtube_video_id_err"></span>
                    </div>
                    <div class="form-group">
                        <label>Video Publish Date</label>
                        <input type="date" name="video_publish_date" id="video_publish_date">
                        <span id="video_publish_date_err"></span>
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