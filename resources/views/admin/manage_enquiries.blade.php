@extends('layouts.admin_layout')
@section('title', 'Manage Enquiries')
@section('content')
<section class="content-header">
    <h1>Manage Enquiries</h1>
    <ol class="breadcrumb">
        <li><a href="{{Config::get('constants.admin_url')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Manage Enquiries</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <div class="col-xs-12 connectedSortable">
        <div class="box">
            <div class="box-header">
                <div class="box-tools" style="float: right;">
                    <a class="btn btn-default" href="{{Config::get('constants.admin_url')}}export-enquiries">Export Enquiries</a>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                   <thead>
                        <tr>
                            <th>Time Stamp</th>
                            <th>Project</th>
                            <th>Name</th>
                            <th>Email ID</th>
                            <th>Mobile Number</th>
                            <th>Comments</th>
                            <th>Parameters</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($enquiries as $enquiry_row)
                        <tr>
                            <td>{{date('d/m/Y H:i:s', strtotime($enquiry_row->created_at))}}</td>
                            <td>{{$enquiry_row->enquiry_project_name}}</td>
                            <td>{{$enquiry_row->enquiry_name}}</td>
                            <td>{{$enquiry_row->enquiry_email_id}}</td>
                            <td>{{$enquiry_row->enquiry_mobile_number}}</td>
                            <td>{{$enquiry_row->enquiry_comments}}</td>
                            <td>
                                @php
                                $query_string = parse_url($enquiry_row->referral_url);                                
                                @endphp
                                @if(isset($query_string['query']))
                                @php
                                $query_string = explode("&", $query_string['query']);
                                @endphp
                                @foreach($query_string as $query_string_single)
                                @php
                                $query_string_array = explode("=", $query_string_single);
                                @endphp
                                {{$query_string_array[0]}}: {{urldecode($query_string_array[1])}}<br>
                                @endforeach
                                @endif
                            </td>
                            <td>{{$enquiry_row->otp_status}}</td>
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