@extends('layouts.admin_layout')
@section('title', 'Edit Award')
@section('content')
<section class="content-header">
    <h1>Edit Award</h1>
    <ol class="breadcrumb">
        <li><a href="{{Config::get('constants.admin_url')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{Config::get('constants.admin_url')}}manage-awards"><i class="fa fa-dashboard"></i> Manage Awards</a>
        <li class="active">Edit Award</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 connectedSortable">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Edit Award</h3>
                <div class="box-tools"></div>
            </div>
            <form id="edit_award" class="hideformspan" enctype="multipart/form-data">
                @csrf
                <div class="box-body">
                    <input type="hidden" name="award_id" value="{{$award->id}}">
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="award_description" id="award_description">{{$award->award_description}}</textarea>
                        <span id="award_description_err"></span>
                    </div>
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="award_title" id="award_title" value="{{$award->award_title}}" required>
                        <span id="award_title_err"></span>
                    </div>
                    <div class="form-group">
                        <label>Date</label>
                        <input type="date" name="award_date" id="award_date" value="{{$award->award_date}}" required>
                        <span id="award_date_err"></span>
                    </div>
                    <div class="form-group">
                        <label>Thumbnail</label>
                        <br>
                        <img src="{{url('/')}}/assets/images/awards/{{$award->award_thumbnail}}" style="width: 300px;">
                        <input type="file" name="award_thumbnail" id="award_thumbnail" accept="image/*">
                        <span id="award_date_err"></span>
                    </div>
                    <div class="form-group">
                        <label for="display_status">Status</label>
                        <select name="display_status" id="display_status">
                            <option value="1">Active</option>
                            <option value="0"@if(empty($award->display_status)) selected @endif>Inactive</option>
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