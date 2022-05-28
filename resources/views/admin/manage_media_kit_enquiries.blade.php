@extends('layouts.admin_layout')
@section('title', 'Manage Media Kit Enquiries')
@section('content')
<section class="content-header">
    <h1>Manage Media Kit Enquiries</h1>
    <ol class="breadcrumb">
        <li><a href="{{Config::get('constants.admin_url')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Manage Media Kit Enquiries</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <div class="col-xs-12 connectedSortable">
        <div class="box">
            <div class="box-header">
                <div class="box-tools" style="float: right;">
                    <a class="btn btn-default" href="{{Config::get('constants.admin_url')}}export-media-kit-enquiries">Export Media Kit Enquiries</a>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                   <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email ID</th>
                            <th>Mobile Number</th>
                            <th>Time Stamp</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($enquiries as $enquiry_row)
                        <tr>
                            <td>{{$enquiry_row->enquiry_name}}</td>
                            <td>{{$enquiry_row->enquiry_email_id}}</td>
                            <td>{{$enquiry_row->enquiry_mobile_number}}</td>
                            <td>{{date('dS F, Y h:i A', strtotime($enquiry_row->created_at))}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->
    <!-- /.row -->
</section><!-- /.content -->
@endsection