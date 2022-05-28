@extends('layouts.admin_layout')
@section('title', 'Manage Banners')
@section('content')
<section class="content-header">
    <h1>Manage Banners</h1>
    <ol class="breadcrumb">
        <li><a href="{{Config::get('constants.admin_url')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Manage Banners</li>
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
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($banners as $banner_row)
                        <tr>
                            <td>{{$banner_row->page_name}}</td>
                            <td>
                                <a class="btn bg-navy" href="{{Config::get('constants.admin_url')}}edit-banner/{{$banner_row->id}}">Edit</a>
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