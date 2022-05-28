@extends('layouts.admin_layout')
@section('title', 'Edit Report')
@section('content')
<section class="content-header">
    <h1>Edit Report</h1>
    <ol class="breadcrumb">
        <li><a href="{{Config::get('constants.admin_url')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{Config::get('constants.admin_url')}}manage-reports"><i class="fa fa-dashboard"></i> Manage Report</a></li>
        <li class="active">Edit Report</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 connectedSortable">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Edit Report</h3>
                <div class="box-tools"></div>
            </div>
            <form id="edit_report" class="hideformspan" enctype="multipart/form-data">
                @csrf
                <div class="box-body">
                    <input type="hidden" name="report_id" value="{{$report->id}}">
                    <div class="form-group">
                        <label>Report Name</label>
                        <input name="report_title" id="report_title" value="{{$report->report_title}}">
                        <span id="report_title_err"></span>
                    </div>
                    <div class="form-group">
                        <label for="report_thumbnail">Report Thumbnail*</label>
                        <br>
                        <img src="{{url('/')}}/assets/images/media/{{$report->report_thumbnail}}" style="width: 300px;">
                        <input type="file" name="report_thumbnail" id="report_thumbnail" accept="image/*">
                        <span id="report_thumbnail_err"></span>
                    </div>
                    <div class="form-group">
                        <label>Report Date</label>
                        <input type="date" name="report_publish_date" id="report_publish_date" value="{{$report->report_publish_date}}">
                        <span id="report_publish_date_err"></span>
                    </div>
                    <div class="form-group">
                        <label>Report PDF</label>
                        <br>
                        <a class="btn btn-default" href="{{url('/')}}/assets/pdfs/{{$report->report_pdf}}" target="_blank">View</a>
                        <br>
                        <input type="file" name="report_pdf" id="report_pdf" accept=".pdf">
                        <span id="report_pdf_err"></span>
                    </div>
                    <div class="form-group">
                        <label for="display_status">Status</label>
                        <select name="display_status" id="display_status">
                            <option value="1">Active</option>
                            <option value="0"@if(empty($report->display_status)) selected @endif>Inactive</option>
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