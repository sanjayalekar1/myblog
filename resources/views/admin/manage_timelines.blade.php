@extends('layouts.admin_layout')
@section('title', 'Manage Timelines')

@section('content')
<section class="content-header">
    <h1>Manage Timelines</h1>
    <ol class="breadcrumb">
        <li><a href="{{Config::get('constants.admin_url')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Manage Timelines</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <div class="col-xs-12 connectedSortable">
        <div class="box">
            <div class="box-header">
                <div class="box-tools" style="float: right;">
                    <a class="btn bg-navy" href="{{Config::get('constants.admin_url')}}add-timeline">Add Timeline</a>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                   <thead>
                        <tr>
                            <th>Year</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($timelines as $timeline_row)
                        <tr>
                            <td>{{$timeline_row->timeline_year}}</td>
                            <td>
                                <a class="btn bg-navy" href="{{Config::get('constants.admin_url')}}edit-timeline/{{$timeline_row->id}}">Edit</a>
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