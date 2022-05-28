@extends('layouts.admin_layout')
@section('title', 'Edit Gallery')
@section('content')
<section class="content-header">
    <h1>Edit Gallery</h1>
    <ol class="breadcrumb">
        <li><a href="{{Config::get('constants.admin_url')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{Config::get('constants.admin_url')}}manage-galleries"><i class="fa fa-dashboard"></i> Manage Gallery</a></li>
        <li class="active">Edit Gallery</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 connectedSortable">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Edit Gallery</h3>
                <div class="box-tools"></div>
            </div>
            <form id="edit_gallery" class="hideformspan" enctype="multipart/form-data">
                @csrf
                <div class="box-body">
                    <input type="hidden" name="gallery_id" value="{{$gallery->id}}">
                    <div class="form-group">
                        <label>Caption*</label>
                        <input name="gallery_image_caption" id="gallery_image_caption" value="{{$gallery->gallery_image_caption}}">
                        <span id="gallery_image_caption_err"></span>
                    </div>
                    <div class="form-group">
                        <label for="gallery_image_name">Image*</label>
                        <br>
                        <img src="{{url('/')}}/assets/images/gallery/{{$gallery->gallery_image_name}}" style="width: 300px;">
                        <input type="file" name="gallery_image_name" id="gallery_image_name" accept="image/*">
                        <span id="gallery_image_name_err"></span>
                    </div>
                    <div class="form-group">
                        <label for="display_status">Status</label>
                        <select name="display_status" id="display_status">
                            <option value="1">Active</option>
                            <option value="0"@if(empty($gallery->display_status)) selected @endif>Inactive</option>
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