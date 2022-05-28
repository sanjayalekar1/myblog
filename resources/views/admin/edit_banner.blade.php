@extends('layouts.admin_layout')
@section('title', 'Edit Banner')
@section('content')
<section class="content-header">
    <h1>Edit {{$banner->page_name}} Banner</h1>
    <ol class="breadcrumb">
        <li><a href="{{Config::get('constants.admin_url')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{Config::get('constants.admin_url')}}manage-banners"><i class="fa fa-dashboard"></i> Manage Banners</a></li>
        <li class="active">Edit {{$banner->page_name}} Banner</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 connectedSortable">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Edit {{$banner->page_name}} Banner</h3>
                <div class="box-tools"></div>
            </div>
            <form id="edit_banner" class="hideformspan" enctype="multipart/form-data">
                @csrf
                <div class="box-body">
                    <input type="hidden" name="id" value="{{$banner->id}}">
                    <div class="form-group">
                        <label for="banner_image">Desktop Banner Image</label>
                        <br>
                        <img src="{{url('/')}}/assets/images/banners/{{$banner->banner_image}}" style="width: 100%">
                        <br>
                        <input type="file" name="banner_image">
                        <span id="banner_image_err"></span>
                    </div>
                    <div class="form-group">
                        <label for="banner_image">Mobile Banner Image</label>
                        <br>
                        <img src="{{url('/')}}/assets/images/banners/{{$banner->banner_image_mobile}}" style="width: 300px;">
                        <br>
                        <input type="file" name="banner_image_mobile">
                        <span id="banner_image_mobile_err"></span>
                    </div>
                </div>
                <div class="box-footer">
                    <input type="submit" class="btn btn-primary" value="Update">
                </div>
            </form>
        </div>
        <div id="resultmessage"></div>
    </div><!-- /.col -->
    <!-- /.row -->
</section><!-- /.content -->
@endsection