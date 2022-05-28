@extends('layouts.admin_layout')
@section('title', 'Edit Testimonial')
@section('content')
<section class="content-header">
    <h1>Edit Testimonial</h1>
    <ol class="breadcrumb">
        <li><a href="{{Config::get('constants.admin_url')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{Config::get('constants.admin_url')}}manage-testimonials"><i class="fa fa-dashboard"></i> Manage Testimonials</a>
        <li class="active">Edit Testimonial</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 connectedSortable">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Edit Testimonial</h3>
                <div class="box-tools"></div>
            </div>
            <form id="edit_testimonial" class="hideformspan" enctype="multipart/form-data">
                @csrf
                <div class="box-body">
                    <input type="hidden" name="testimonial_id" value="{{$testimonial->id}}">
                    <div class="form-group">
                        <label>Content</label>
                        <textarea name="testimonial_content" id="testimonial_content">{{$testimonial->testimonial_content}}</textarea>
                        <span id="testimonial_content_err"></span>
                    </div>
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="testimonial_name" id="testimonial_name" value="{{$testimonial->testimonial_name}}" required>
                        <span id="testimonial_name_err"></span>
                    </div>
                    <div class="form-group">
                        <label>Project Name</label>
                        <input type="text" name="project_name" id="project_name" value="{{$testimonial->project_name}}" required>
                        <span id="project_name_err"></span>
                    </div>
                    <div class="form-group">
                        <label>Layout</label>
                        <select name="testimonial_layout_id" id="testimonial_layout_id">
                            <option value="1">Image + Video</option>
                            <option value="2" @if($testimonial->testimonial_layout_id == 2) selected @endif>Image</option>
                            <option value="3" @if($testimonial->testimonial_layout_id == 3) selected @endif>No Image, No Video</option>
                        </select>
                        <span id="testimonial_layout_id_err"></span>
                    </div>
                    <div class="form-group youtube_video_block" @if($testimonial->testimonial_layout_id != 1) style="display:none;" @endif>
                        <label>YouTube Video ID</label>
                        <input type="text" name="testimonial_youtube_id" id="testimonial_youtube_id" value="{{$testimonial->testimonial_youtube_id}}" maxlength="11">
                        <span id="testimonial_youtube_id_err"></span>
                    </div>
                    <div class="form-group thumbnail_block" @if($testimonial->testimonial_layout_id == 3) style="display:none;" @endif>
                        <label>Thumbnail</label>
                        <br>
                        <img src="{{url('/')}}/assets/images/testimonials/{{$testimonial->testimonial_thumbnail}}" style="width: 300px;">
                        <input type="file" name="testimonial_thumbnail" id="testimonial_thumbnail" accept="image/*">
                        <span id="testimonial_youtube_id_err"></span>
                    </div>
                    <div class="form-group">
                        <label for="testimonial_featured">Featured?</label>
                        <select name="testimonial_featured" id="testimonial_featured">
                            <option value="0">No</option>
                            <option value="1" @if(!empty($testimonial->testimonial_featured)) selected @endif>Yes</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="display_status">Status</label>
                        <select name="display_status" id="display_status">
                            <option value="1">Active</option>
                            <option value="0"@if(empty($testimonial->display_status)) selected @endif>Inactive</option>
                        </select>
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