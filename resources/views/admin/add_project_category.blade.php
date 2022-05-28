@extends('layouts.admin_layout')
@section('title', 'Add Project Category')
@section('content')
<section class="content-header">
    <h1>Add Project Category</h1>
    <ol class="breadcrumb">
        <li><a href="{{Config::get('constants.admin_url')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{Config::get('constants.admin_url')}}manage-project-categories"><i class="fa fa-dashboard"></i> Manage Project Categories</a></li>
        <li class="active">Add Project Category</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 connectedSortable">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Add Project Category</h3>
                <div class="box-tools"></div>
            </div>
            <form id="add_project_category" class="hideformspan" enccategory="multipart/form-data">
                @csrf
                <div class="box-body">
                    <div class="form-group">
                        <label>Category Title</label>
                        <input name="project_category_title" id="project_category_title">
                        <span id="project_category_title_err"></span>
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