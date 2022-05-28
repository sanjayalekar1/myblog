@extends('layouts.admin_layout')
@section('title', 'Edit Home Page Video')
@section('content')
<section class="content-header">
    <h1>Edit Home Page Video</h1>
    <ol class="breadcrumb">
        <li><a href="{{Config::get('constants.admin_url')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Edit Home Page Video</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 connectedSortable">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Edit Home Page Video</h3>
                <div class="box-tools"></div>
            </div>
            <form id="edit_home_page_video" class="hideformspan" enctype="multipart/form-data">
                @csrf
                <div class="box-body">
                    <div class="form-group">
                        <label>Desktop Video</label>
                        <br>
                        <a href="{{url('/')}}/assets/videos/desktop-home-banner.mp4" class="btn btn-default" target="_blank">View Video</a>
                        <input type="file" name="desktop_video">
                    </div>
                    <div class="form-group">
                        <label>Mobile Video</label>
                        <br>
                        <a href="{{url('/')}}/assets/videos/mobile-home-banner.mp4" class="btn btn-default" target="_blank">View Video</a>
                        <input type="file" name="mobile_video">
                    </div>
                </div>
                <div class="box-footer">
                    <input type="submit" value="Update" class="btn btn-primary">
                </div>
            </form>
        </div>
        <div id="resultmessage"></div>
    </div><!-- /.col -->
    <!-- /.row -->
</section><!-- /.content -->
@endsection