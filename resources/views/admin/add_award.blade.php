@extends('layouts.admin_layout')
@section('title', 'Add Award')
@section('content')
<section class="content-header">
    <h1>Add Award</h1>
    <ol class="breadcrumb">
        <li><a href="{{Config::get('constants.admin_url')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{Config::get('constants.admin_url')}}manage-awards"><i class="fa fa-dashboard"></i> Manage Awards</a></li>
        <li class="active">Add Award</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 connectedSortable">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Add Award</h3>
                <div class="box-tools"></div>
            </div>
            <form id="add_award" class="hideformspan" enctype="multipart/form-data">
                @csrf
                <div class="box-body">
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="award_description" id="award_description" required></textarea>
                        <span id="award_description_err"></span>
                    </div>
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="award_title" id="award_title" required>
                        <span id="award_title_err"></span>
                    </div>
                    <div class="form-group">
                        <label>Date</label>
                        <input type="date" name="award_date" id="award_date" required>
                        <span id="award_date_err"></span>
                    </div>
                    <div class="form-group">
                        <label>Thumbnail</label>
                        <input type="file" name="award_thumbnail" id="award_thumbnail" accept="image/*" required>
                        <span id="award_date_err"></span>
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