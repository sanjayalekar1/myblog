@extends('layouts.admin_layout')
@section('title', 'Manage Meta Data')
@section('content')
<section class="content-header">
    <h1>Manage Meta Data</h1>
    <ol class="breadcrumb">
        <li><a href="{{Config::get('constants.admin_url')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Manage Meta Data</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <div class="col-xs-12 connectedSortable">
        <div class="box">
            <div class="box-header">
                <div class="box-tools" style="float: right;">
                </div>
            </div><!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                   <thead>
                        <tr>
                            <th>Page Name</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($meta_data as $meta_data_row)
                        <tr>
                            <td>{{$meta_data_row->page_name}}</td>
                            <td>{{$meta_data_row->meta_title}}</td>
                            <td>{{$meta_data_row->meta_description}}</td>
                            <td>
                                <a class="btn bg-navy" href="{{Config::get('constants.admin_url')}}edit-meta-data/{{$meta_data_row->id}}">Edit</a>
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