@extends('layouts.admin_layout')
@section('title', 'Commercial Projects')
@section('content')
<section class="content-header">
    <h1>Commercial Projects</h1>
    <ol class="breadcrumb">
        <li><a href="{{Config::get('constants.admin_url')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{Config::get('constants.admin_url')}}commercial-project"><i class="fa fa-dashboard"></i> Commercial Projects</a></li>
        <li class="active">Commercial Projects List</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <div class="col-xs-12 connectedSortable">
        <div class="box">
            <div class="box-header">
                <div class="box-tools" style="float: right;">
                    <a class="btn bg-navy" href="{{Config::get('constants.admin_url')}}add-commercial-project">Add Project</a>
                    <!-- <button class="btn btn-default save_sorting_projects">Save Sorting</button> -->
                </div>
            </div><!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                   <thead>
                        <tr>
                            <th>image</th>
                            <th>Name</th>
                            <th>Location</th>
                            <th>Project Status</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="sortable">
                        @foreach($comm_projects as $project_row)
                        <tr>
                        <td><img src="{{url('/')}}/assets/images/projects/{{$project_row->project_logo}}" width="40px" height="40px"></td>
                            <td>{{$project_row->project_title}}</td>
                            <td>{{$project_row->project_location_text}}</td>
                            <td>{{$project_row->project_status_title}}</td>
                            <td>@if($project_row->status==0)<label class="badge badge-primary" >Disabled<lebel>@else <label class="badge badge-primary" style="background-color:green">Active<lebel>@endif</td>
                            <td>
                                <a class="btn bg-navy" href="{{Config::get('constants.admin_url')}}edit-commercial-project/{{$project_row->id}}">Edit</a>
                            </td>
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