@extends('layouts.admin_layout')
@section('title', 'Add Media')
@section('content')
<section class="content-header">
    <h1>Add Media</h1>
    <ol class="breadcrumb">
        <li><a href="{{Config::get('constants.admin_url')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{Config::get('constants.admin_url')}}manage-media"><i class="fa fa-dashboard"></i> Manage Media</a></li>
        <li class="active">Add Media</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 connectedSortable">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Add Media</h3>
                <div class="box-tools"></div>
            </div>
            <form id="add_media" class="hideformspan" enctype="multipart/form-data">
                @csrf
                <div class="box-body">
                    <div class="form-group">
                        <label>Media Title</label>
                        <input name="media_title" id="media_title">
                        <span id="media_title_err"></span>
                    </div>
                    <div class="form-group">
                        <label for="media_thumbnail">Media Thumbnail*</label>
                        <input type="file" name="media_thumbnail" id="media_thumbnail" accept="image/*" required>
                        <span id="media_thumbnail_err"></span>
                    </div>
                    <div class="form-group">
                        <label>Media Date</label>
                        <input type="date" name="media_publish_date" id="media_publish_date">
                        <span id="media_publish_date_err"></span>
                    </div>
                    <div class="form-group">
                        <label>Media PDF</label>
                        <input type="file" name="media_pdf" id="media_pdf" accept=".pdf">
                        <span id="media_pdf_err"></span>
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