@extends('layouts.admin_layout')
@section('title', 'Manage Gallery')

@section('content')
<section class="content-header">
    <h1>Manage Gallery</h1>
    <ol class="breadcrumb">
        <li><a href="{{Config::get('constants.admin_url')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Manage Gallery</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <div class="col-xs-12 connectedSortable">
        <div class="box">
            <div class="box-header">
                <div class="box-tools" style="float: right;">
                    <a class="btn bg-navy" href="{{Config::get('constants.admin_url')}}add-gallery">Add Gallery</a>
                    <button class="btn btn-default save_sorting_galleries">Save Sorting</button>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                   <thead>
                        <tr>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="sortable">
                        @foreach($galleries as $gallery_row)
                        <tr data-order="{{$gallery_row->sorting_order}}" data-id="{{$gallery_row->id}}">
                            <td><img src="{{url('/')}}/assets/images/gallery/{{$gallery_row->gallery_image_name}}" style="width: 300px;"></td>
                            <td>
                                <a class="btn bg-navy" href="{{Config::get('constants.admin_url')}}edit-gallery/{{$gallery_row->id}}">Edit</a>
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