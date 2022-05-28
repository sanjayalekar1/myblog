@extends('layouts.admin_layout')
@section('title', 'Edit Frontend Script')
@section('content')
<section class="content-header">
    <h1>Edit Frontend Script</h1>
    <ol class="breadcrumb">
        <li><a href="{{Config::get('constants.admin_url')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Edit Frontend Script</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 connectedSortable">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Edit Frontend Script</h3>
                <div class="box-tools"></div>
            </div>
            <form id="edit_frontend_script" class="hideformspan" enctype="multipart/form-data">
                @csrf
                <div class="box-body">
                    <div class="form-group">
                        <label>Script</label>
                        <textarea name="script_code" id="script_code" rows="15">{{$frontend_script->script_code}}</textarea>
                        <span id="script_code_err"></span>
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