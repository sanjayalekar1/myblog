@extends('layouts.admin_layout')
@section('title', 'Add Testimonial')
@section('content')
<section class="content-header">
    <h1>Add Testimonial</h1>
    <ol class="breadcrumb">
        <li><a href="{{Config::get('constants.admin_url')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{Config::get('constants.admin_url')}}manage-testimonials"><i class="fa fa-dashboard"></i> Manage Testimonials</a></li>
        <li class="active">Add Testimonial</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 connectedSortable">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Add Testimonial</h3>
                <div class="box-tools"></div>
            </div>
            <form id="add_testimonial" class="hideformspan" enctype="multipart/form-data">
                @csrf
                <div class="box-body">
                    <div class="form-group">
                        <label>Content</label>
                        <textarea name="testimonial_content" id="testimonial_content" required></textarea>
                        <span id="testimonial_content_err"></span>
                    </div>
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="testimonial_name" id="testimonial_name" required>
                        <span id="testimonial_name_err"></span>
                    </div>
                    <div class="form-group">
                        <label>Project Name</label>
                        <input type="text" name="project_name" id="project_name" required>
                        <span id="project_name_err"></span>
                    </div>
                    <div class="form-group">
                        <label>Layout</label>
                        <select name="testimonial_layout_id" id="testimonial_layout_id">
                            <option value="1">Image + Video</option>
                            <option value="2">Image</option>
                            <option value="3">No Image, No Video</option>
                        </select>
                        <span id="testimonial_layout_id_err"></span>
                    </div>
                    <div class="form-group youtube_video_block">
                        <label>YouTube Video ID</label>
                        <input type="text" name="testimonial_youtube_id" id="testimonial_youtube_id" maxlength="11">
                        <span id="testimonial_youtube_id_err"></span>
                    </div>
                    <div class="form-group thumbnail_block">
                        <label>Thumbnail</label>
                        <input type="file" name="testimonial_thumbnail" id="testimonial_thumbnail" accept="image/*">
                        <span id="testimonial_youtube_id_err"></span>
                    </div>
                    <div class="form-group">
                        <label for="testimonial_featured">Featured?</label>
                        <select name="testimonial_featured" id="testimonial_featured">
                            <option value="0">No</option>
                            <option value="1">Yes</option>
                        </select>
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