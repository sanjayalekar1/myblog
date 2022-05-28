@extends('layouts.admin_layout')
@section('title', 'Edit Home Page Slider')
@section('content')
<section class="content-header">
    <h1>Edit Home Page Slider</h1>
    <ol class="breadcrumb">
        <li><a href="{{Config::get('constants.admin_url')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{Config::get('constants.admin_url')}}manage-home-page-sliders"><i class="fa fa-dashboard"></i> Manage Home Page Sliders</a></li>
        <li class="active">Edit Home Page Slider</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 connectedSortable">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Edit Home Page Slider</h3>
                <div class="box-tools"></div>
            </div>
            <form id="edit_home_page_slider" class="hideformspan" enctype="multipart/form-data">
                @csrf
                <div class="box-body">
                    <input type="hidden" name="slider_id" value="{{$slider->id}}">
                    <div class="form-group" style="display:none;">
                        <label for="slider_image">Slider Image*</label>
                        <br>
                        <img src="{{url('/')}}/assets/images/home-page-sliders/{{$slider->slider_image}}" style="width: 100%">
                        <br>
                        <input type="file" name="slider_image" id="slider_image" accept="image/*">
                        <span id="slider_image_err"></span>
                    </div>
                    <div class="form-group" style="display:none;">
                        <label for="slider_image_mobile">Slider Image Mobile*</label>
                        <br>
                        <img src="{{url('/')}}/assets/images/home-page-sliders/{{$slider->slider_image_mobile}}" style="width: 100%">
                        <br>
                        <input type="file" name="slider_image_mobile" id="slider_image_mobile" accept="image/*">
                        <span id="slider_image_mobile_err"></span>
                    </div>
                    <div class="form-group">
                        <label>Slider Text Line One</label>
                        <textarea name="slider_caption" id="slider_caption">{{$slider->slider_caption}}</textarea>
                        <span id="slider_caption_err"></span>
                    </div>
                    <div class="form-group">
                        <label>Slider Text Line Two</label>
                        <textarea name="slider_caption_two" id="slider_caption_two">{{$slider->slider_caption_two}}</textarea>
                        <span id="slider_caption_two_err"></span>
                    </div>
                    <div class="form-group">
                        <label for="display_status">Status</label>
                        <select name="display_status" id="display_status">
                            <option value="1">Active</option>
                            <option value="0"@if(empty($slider->display_status)) selected @endif>Inactive</option>
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