@extends('layouts.admin_layout')
@section('title', 'Manage Testimonials')
@section('content')
<section class="content-header">
    <h1>Manage Testimonials</h1>

    <ol class="breadcrumb">

        <li><a href="{{Config::get('constants.admin_url')}}"><i class="fa fa-dashboard"></i> Home</a></li>

        <li class="active">Manage Testimonials</li>

    </ol>

</section>

<!-- Main content -->

<section class="content">

    <div class="col-xs-12 connectedSortable">

        <div class="box">

            <div class="box-header">

                <div class="box-tools" style="float: right;">

                    <a class="btn bg-navy" href="{{Config::get('constants.admin_url')}}add-testimonial">Add Testimonial</a>

                    <button class="btn btn-default save_sorting_testimonials">Save Sorting</button>

                </div>

            </div><!-- /.box-header -->

            <div class="box-body table-responsive no-padding">

                <table class="table table-hover">

                   <thead>

                        <tr>

                            <th>Testimonial</th>

                            <th>Action</th>

                        </tr>

                    </thead>

                    <tbody class="sortable">

                        @foreach($testimonial as $testimonial_row)

                        <tr data-order="{{$testimonial_row->sorting_order}}" data-id="{{$testimonial_row->id}}">

                            <td>{{strip_tags($testimonial_row->testimonial_content)}}</td>

                            <td>

                                <a class="btn bg-navy" href="{{Config::get('constants.admin_url')}}edit-testimonial/{{$testimonial_row->id}}">Edit</a>

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