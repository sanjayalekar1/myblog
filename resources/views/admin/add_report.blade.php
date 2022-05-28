@extends('layouts.admin_layout')
@section('title', 'Add Report')
@section('content')
<section class="content-header">
    <h1>Add Report</h1>
    <ol class="breadcrumb">
        <li><a href="{{Config::get('constants.admin_url')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{Config::get('constants.admin_url')}}manage-reports"><i class="fa fa-dashboard"></i> Manage Report</a></li>
        <li class="active">Add Report</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 connectedSortable">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Add Report</h3>
                <div class="box-tools"></div>
            </div>
            <form id="add_report" class="hideformspan" enctype="multipart/form-data">
                @csrf
                <div class="box-body">
                    <div class="form-group">
                        <label>Report Title</label>
                        <input name="report_title" id="report_title">
                        <span id="report_title_err"></span>
                    </div>
                    <div class="form-group">
                        <label for="report_thumbnail">Report Thumbnail*</label>
                        <input type="file" name="report_thumbnail" id="report_thumbnail" accept="image/*" required>
                        <span id="report_thumbnail_err"></span>
                    </div>
                    <div class="form-group">
                        <label>Report Date</label>
                        <input type="date" name="report_publish_date" id="report_publish_date">
                        <span id="report_publish_date_err"></span>
                    </div>
                    <div class="form-group">
                        <label>Report PDF</label>
                        <input type="file" name="report_pdf" id="report_pdf" accept=".pdf">
                        <span id="report_pdf_err"></span>
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