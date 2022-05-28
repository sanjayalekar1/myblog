@extends('layouts.admin_layout')
@section('title', 'Edit Media Kit')
@section('content')
<section class="content-header">
    <h1>Edit Media Kit</h1>
    <ol class="breadcrumb">
        <li><a href="{{Config::get('constants.admin_url')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Edit Media Kit</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 connectedSortable">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Edit Media Kit</h3>
                <div class="box-tools"></div>
            </div>
            <form id="edit_media_kit" class="hideformspan" enctype="multipart/form-data">
                @csrf
                <div class="box-body">
                    <div class="form-group">
                        <label for="home_page_about_us_image">Media Kit File*</label>
                        <br>
                        <a class="btn btn-default" target="_blank" href="{{url('/')}}/assets/images/media/{{$media_kit->media_kit_file_name}}">View File</a>
                        <br>
                        <input type="file" name="media_kit_file_name" id="media_kit_file_name">
                        <span id="home_page_about_us_image_err"></span>
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