@extends('layouts.admin_layout')
@section('title', 'Manage Home Page Sliders')

@section('content')
<section class="content-header">
    <h1>Manage Home Page Sliders</h1>
    <ol class="breadcrumb">
        <li><a href="{{Config::get('constants.admin_url')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Manage Home Page Sliders</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <div class="col-xs-12 connectedSortable">
        <div class="box">
            <div class="box-header">
                <div class="box-tools" style="float: right;">
                    <a class="btn bg-navy" href="{{Config::get('constants.admin_url')}}add-home-page-slider">Add Home Page Slider</a>
                    <button class="btn btn-default save_sorting_home_page_sliders">Save Sorting</button>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                   <thead>
                        <tr>
                            <th>Caption</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="sortable">
                        @foreach($home_page_slider as $home_page_slider_row)
                        <tr data-order="{{$home_page_slider_row->sorting_order}}" data-id="{{$home_page_slider_row->id}}">
                            <td>{{$home_page_slider_row->slider_caption}}</td>
                            <td>
                                <a class="btn bg-navy" href="{{Config::get('constants.admin_url')}}edit-home-page-slider/{{$home_page_slider_row->id}}">Edit</a>
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