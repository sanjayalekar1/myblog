@extends('layouts.admin_layout')
@section('title', 'Manage Why Us')

@section('content')
<section class="content-header">
    <h1>Manage Why Us</h1>
    <ol class="breadcrumb">
        <li><a href="{{Config::get('constants.admin_url')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Manage Why Us</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <div class="col-xs-12 connectedSortable">
        <div class="box">
            <div class="box-header">
                <div class="box-tools" style="float: right;">
                    <a class="btn bg-navy" href="{{Config::get('constants.admin_url')}}add-why-us">Add Why Us</a>
                    <button class="btn btn-default save_sorting_why_us">Save Sorting</button>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                   <thead>
                        <tr>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="sortable">
                        @foreach($why_us as $why_us_row)
                        <tr data-order="{{$why_us_row->sorting_order}}" data-id="{{$why_us_row->id}}">
                            <td>{{$why_us_row->section_title}}</td>
                            <td>
                                <a class="btn bg-navy" href="{{Config::get('constants.admin_url')}}edit-why-us/{{$why_us_row->id}}">Edit</a>
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