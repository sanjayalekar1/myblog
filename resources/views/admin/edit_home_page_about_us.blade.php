@extends('layouts.admin_layout')
@section('title', 'Edit About Us')
@section('content')
<section class="content-header">
    <h1>Edit About Us</h1>
    <ol class="breadcrumb">
        <li><a href="{{Config::get('constants.admin_url')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Edit About Us</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 connectedSortable">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Edit About Us</h3>
                <div class="box-tools"></div>
            </div>
            <form id="edit_home_page_about" class="hideformspan" enctype="multipart/form-data">
                @csrf
                <div class="box-body">
                    <input type="hidden" name="about_us_id" value="{{$about->id}}">
                    <div class="form-group">
                        <label for="home_page_about_us_image">About Us Image*</label>
                        <br>
                        <img src="{{url('/')}}/assets/images/home-page/{{$about->home_page_about_us_image}}" style="width: 100%">
                        <br>
                        <input type="file" name="home_page_about_us_image" id="home_page_about_us_image" accept="image/*">
                        <span id="home_page_about_us_image_err"></span>
                    </div>
                    <div class="form-group">
                        <label>About Us Title</label>
                        <input name="home_page_about_us_title" id="home_page_about_us_title" value="{{$about->home_page_about_us_title}}">
                        <span id="home_page_about_us_title_err"></span>
                    </div>
                    <div class="form-group">
                        <label>About Us Description</label>
                        <textarea name="home_page_about_us_description" id="home_page_about_us_description">{{$about->home_page_about_us_description}}</textarea>
                        <span id="home_page_about_us_description_err"></span>
                    </div>
                    <div class="form-group">
                        <label>About Us Content</label>
                        <textarea name="about_us_content" id="about_us_content" class="basic_editor">{{$about->about_us_content}}</textarea>
                        <span id="home_page_about_us_err"></span>
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