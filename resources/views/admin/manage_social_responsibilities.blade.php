@extends('layouts.admin_layout')
@section('title', 'Manage Social Responsibilities')

@section('content')
<section class="content-header">
    <h1>Manage Social Responsibilities</h1>
    <ol class="breadcrumb">
        <li><a href="{{Config::get('constants.admin_url')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Manage Social Responsibilities</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <div class="col-xs-12 connectedSortable">
        <div class="box">
            <div class="box-header">
                <div class="box-tools" style="float: right;">
                    <a class="btn bg-navy" href="{{Config::get('constants.admin_url')}}add-social-responsibility">Add Social Responsibility</a>
                    <button class="btn btn-default save_sorting_social_responsibilities">Save Sorting</button>
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
                        @foreach($social_responsibilities as $social_responsibility_row)
                        <tr data-order="{{$social_responsibility_row->sorting_order}}" data-id="{{$social_responsibility_row->id}}">
                            <td>{{$social_responsibility_row->section_title}}</td>
                            <td>
                                <a class="btn bg-navy" href="{{Config::get('constants.admin_url')}}edit-social-responsibility/{{$social_responsibility_row->id}}">Edit</a>
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