@extends('layouts.admin_layout')
@section('title', 'Manage Social Projects')

@section('content')
<section class="content-header">
    <h1>Manage Social Project</h1>
    <ol class="breadcrumb">
        <li><a href="{{Config::get('constants.admin_url')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Manage Social Projects</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <div class="col-xs-12 connectedSortable">
        <div class="box">
            <div class="box-header">
                <div class="box-tools" style="float: right;">
                    <a class="btn bg-navy" href="{{Config::get('constants.admin_url')}}add-social-project">Add Social Project</a>
                    <button class="btn btn-default save_sorting_social_projects">Save Sorting</button>
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
                        @foreach($social_projects as $social_project_row)
                        <tr data-order="{{$social_project_row->sorting_order}}" data-id="{{$social_project_row->id}}">
                            <td>{{$social_project_row->social_project_name}}</td>
                            <td>
                                <a class="btn bg-navy" href="{{Config::get('constants.admin_url')}}edit-social-project/{{$social_project_row->id}}">Edit</a>
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