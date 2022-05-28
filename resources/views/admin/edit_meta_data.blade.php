@extends('layouts.admin_layout')
@section('title', 'Edit Meta Data')
@section('content')
<section class="content-header">
    <h1>Edit {{$meta_data->page_name}} Meta Data</h1>
    <ol class="breadcrumb">
        <li><a href="{{Config::get('constants.admin_url')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{Config::get('constants.admin_url')}}manage-meta-data"><i class="fa fa-dashboard"></i> Manage Meta Data</a></li>
        <li class="active">Edit {{$meta_data->page_name}} Meta Data</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 connectedSortable">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Edit {{$meta_data->page_name}} Meta Data</h3>
                <div class="box-tools"></div>
            </div>
            <form id="edit_meta_data" class="hideformspan" enctype="multipart/form-data">
                @csrf
                <div class="box-body">
                    <input type="hidden" name="id" value="{{$meta_data->id}}">
                    <div class="form-group">
                        <label for="meta_title">Meta Title*</label>
                        <input type="text" name="meta_title" id="meta_title" value="{{$meta_data->meta_title}}" required>
                        <span id="meta_title_err"></span>
                    </div>
                    <div class="form-group">
                        <label for="meta_description">Meta Description*</label>
                        <textarea name="meta_description" id="meta_description" required>{{$meta_data->meta_description}}</textarea>
                        <span id="meta_description_err"></span>
                    </div>
                    <div class="form-group">
                        <label for="introduction_text_one">Introduction Paragraph One</label>
                        <textarea name="introduction_text_one" id="introduction_text_one">{{$meta_data->introduction_text_one}}</textarea>
                        <span id="introduction_text_one_err"></span>
                    </div>
                    <div class="form-group">
                        <label for="introduction_text_two">Introduction Paragraph Two</label>
                        <textarea name="introduction_text_two" id="introduction_text_two">{{$meta_data->introduction_text_two}}</textarea>
                        <span id="introduction_text_two_err"></span>
                    </div>
                    <div class="form-group">
                        <label for="canonical_tag">Canonical Value*</label>
                        <input type="text" name="canonical_tag" value="{{$meta_data->canonical_tag}}">
                        <span id="canonical_tag_err"></span>
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