@extends('layouts.admin_layout')
@section('title', 'Edit Press')
@section('content')
<section class="content-header">
    <h1>Edit Press</h1>
    <ol class="breadcrumb">
        <li><a href="{{Config::get('constants.admin_url')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{Config::get('constants.admin_url')}}manage-press"><i class="fa fa-dashboard"></i> Manage Press</a></li>
        <li class="active">Edit Press</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 connectedSortable">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Edit Press</h3>
                <div class="box-tools"></div>
            </div>
            <form id="edit_press" class="hideformspan" enctype="multipart/form-data">
                @csrf
                <div class="box-body">
                    <input type="hidden" name="press_id" value="{{$press->id}}">
                    <div class="form-group">
                        <label>Press Title</label>
                        <input name="press_title" id="press_title" value="{{$press->press_title}}">
                        <span id="press_title_err"></span>
                    </div>
                    <div class="form-group">
                        <div class="form-group">
                            <label>TV/Print Media</label>
                        </div>
                    </div>
                    <div class="form-group sortable press_blocks">
                        @foreach($press_contents as $press_content_row)
                        <div class="press_block" style="border: 1px solid black; padding: 25px; margin-bottom:20px;">
                            <input type="hidden" name="press_content_id[]" value="{{$press_content_row->id}}">
                            <div class="form-group">
                                <label>Press TV/Media Name</label>
                                <input type="text" name="press_media_title[]" value="{{$press_content_row->press_media_title}}" required>
                            </div>
                            <div class="form-group">
                                <label>Press Publish Date</label>
                                <input type="date" name="press_publish_date[]" value="{{$press_content_row->press_publish_date}}" required>
                            </div>
                            <div class="form-group">
                                <label>Press Type</label>
                                <select name="press_link_attachment[]" class="press_link_attachment">
                                    <option value="1">Link</option>
                                    <option value="2" @if($press_content_row->press_link_attachment == 2) selected @endif>Attachment</option>
                                </select>
                            </div>
                            <div class="form-group press_link" @if($press_content_row->press_link_attachment == 2) style="display:none" @endif>
                                <label>Press Link</label>
                                <input type="url" name="press_link[]" value="{{$press_content_row->press_link}}">
                            </div>
                            <div class="form-group press_attachment" @if($press_content_row->press_link_attachment == 1) style="display:none" @endif>
                                <label>Press Attachment</label>
                                @if(!empty($press_content_row->press_attachment))
                                <br>
                                <a href="{{url('/')}}/assets/images/press/{{$press_content_row->press_attachment}}" target="_blank" class="btn btn-default">View Attachment</a>
                                <br>
                                @endif
                                <input type="file" name="press_attachment[]">
                            </div>
                            <div class="form-group" style="margin-left: 92%">
                                <button type="button" class="btn btn-danger delete_block">Delete</button>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn bg-navy add_press_block">Add TV/Print Media</button>
                    </div>
                    <div class="form-group">
                        <label for="display_status">Status</label>
                        <select name="display_status" id="display_status">
                            <option value="1">Active</option>
                            <option value="0"@if(empty($press->display_status)) selected @endif>Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="box-footer">
                    <input type="submit" value="Upload" class="btn btn-primary">
                </div>
            </form>
            <div class="reserved_press_html" style="display:none;">
                <div class="press_block" style="border: 1px solid black; padding: 25px; margin-bottom:20px;">
                    <input type="hidden" name="press_content_id[]" value="0">
                    <div class="form-group">
                        <label>Press TV/Media Name</label>
                        <input type="text" name="press_media_title[]" required>
                    </div>
                    <div class="form-group">
                        <label>Press Publish Date</label>
                        <input type="date" name="press_publish_date[]" required>
                    </div>
                    <div class="form-group">
                        <label>Press Type</label>
                        <select name="press_link_attachment[]" class="press_link_attachment">
                            <option value="1">Link</option>
                            <option value="2">Attachment</option>
                        </select>
                    </div>
                    <div class="form-group press_link">
                        <label>Press Link</label>
                        <input type="url" name="press_link[]" id="press_link">
                    </div>
                    <div class="form-group press_attachment" style="display:none">
                        <label>Press Attachment</label>
                        <input type="file" name="press_attachment[]">
                    </div>
                    <div class="form-group" style="margin-left: 92%">
                        <button type="button" class="btn btn-danger delete_block">Delete</button>
                    </div>
                </div>
            </div>
        </div>
        <div id="resultmessage"></div>
    </div><!-- /.col -->
    <!-- /.row -->
</section><!-- /.content -->
@endsection