@extends('layouts.admin_layout')
@section('title', 'Add Commercial Project')
@section('content')
<section class="content-header">
    <h1>Add Commercial Project</h1>
    <ol class="breadcrumb">
        <li><a href="{{Config::get('constants.admin_url')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{Config::get('constants.admin_url')}}manage-commercial-projects"><i class="fa fa-dashboard"></i> Manage Commercial Projects</a></li>
        <li class="active">Add Commercial Project</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 connectedSortable">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Add Project</h3>
                <div class="box-tools"></div>
            </div>
            <form id="add_commercial_project" class="hideformspan" enctype="multipart/form-data">
                @csrf
                <div class="box-body">
                    <div class="form-group">
                        <label>Project Name</label>
                        <input name="project_name" id="project_name">
                        <span id="project_name_err"></span>
                    </div>
                    <div class="form-group">
                        <label for="project_thumbnail">Project Thumbnail*</label>
                        <input type="file" name="project_thumbnail" id="project_thumbnail" accept="image/*" required>
                        <span id="project_thumbnail_err"></span>
                    </div>
                    <div class="form-group">
                        <label>Project Location Text</label>
                        <input type="text" name="project_location_text" id="project_location_text">
                        <span id="project_location_text_err"></span>
                    </div>
                    <div class="form-group">
                        <label for="project_logo">Project Logo*</label>
                        <input type="file" name="project_logo" id="project_logo" accept="image/*" required>
                        <span id="project_logo_err"></span>
                    </div>
                    <div class="form-group">
                        <label>Project Category</label>
                        <select name="project_category_id[]" id="project_category_id" >
                            @foreach($project_categories as $project_category_row)
                            <option value="{{$project_category_row->id}}">{{$project_category_row->project_category_title}}</option>
                            @endforeach
                        </select>
                        <span id="project_category_id_err"></span>
                    </div>
                    <div class="form-group">
                        <label>Project Type</label>
                        <select name="project_type_id" id="project_type_id">
                            <option value="">Select Project Type</option>
                            @foreach($project_types as $project_type_row)
                            <option value="{{$project_type_row->id}}">{{$project_type_row->project_type_title}}</option>
                            @endforeach
                        </select>
                        <span id="project_type_id_err"></span>
                    </div>
                    <div class="form-group">
                        <label>Project Location</label>
                        <select name="project_location_id" id="project_location_id">
                            <option value="">Select Project Location</option>
                            @foreach($project_locations as $project_location_row)
                            <option value="{{$project_location_row->id}}">{{$project_location_row->project_location_title}}</option>
                            @endforeach
                        </select>
                        <span id="project_location_id_err"></span>
                    </div>
                    <div class="form-group">
                        <label>Project Area(In Sq.Ft.)</label>
                        <input type="text" name="project_area" id="project_area">
                        <span id="project_area_err"></span>
                    </div>
                    <div class="form-group">
                        <label>Project Link</label>
                        <input type="url" name="project_link" id="project_link">
                        <span id="project_link_err"></span>
                    </div>
                    <div class="form-group">
                        <label>Project Status</label>
                        <select name="project_status_id" id="project_status_id">
                            <option value="">Select Project Status</option>
                            @foreach($project_status as $project_status_row)
                            <option value="{{$project_status_row->id}}">{{$project_status_row->project_status_title}}</option>
                            @endforeach
                        </select>
                        <span id="project_status_id_err"></span>
                    </div>
                    <div class="form-group with_template_data">
                        <div class="form-group">
                            <label>Project Banner</label>
                        </div>
                        <div class="form-group sortable project_slider_blocks"></div>
                        <div class="form-group">
                            <button type="button" class="btn bg-navy add_project_slider_block">Add Banner Image</button>
                        </div>
                        <!-- <div class="form-group">
                            <label>Project Banner Headline</label>
                            <input type="text" name="project_headline" id="project_headline">
                            <span id="project_headline_err"></span>
                        </div>
                        <div class="form-group">
                            <label>Project Banner Sub Headeline</label>
                            <textarea name="project_sub_headline" id="project_sub_headline"></textarea>
                            <span id="project_caption_err"></span>
                        </div> -->
                        <div class="form-group">
                            <label>Project Description</label>
                            <textarea name="project_description" id="project_description"></textarea>
                            <span id="project_description_err"></span>
                        </div>
                        <div class="form-group">
                            <label for="project_about_image">Project About Image</label>
                            <input type="file" name="project_about_image" id="project_about_image" accept="image/*">
                            <span id="project_about_image_err"></span>
                        </div>
                        <div class="form-group">
                            <label for="project_brochure">Project Brochure</label>
                            <input type="file" name="project_brochure" id="project_brochure" accept=".pdf">
                            <span id="project_brochure_err"></span>
                        </div>
                        <div class="form-group">
                            <label>Feature 1</label>
                            <textarea name="feature1" id="feature1"></textarea>
                            <span id="project_feature1_err"></span>
                        </div>
                        <div class="form-group">
                            <label>Feature 2</label>
                            <textarea name="feature2" id="feature2"></textarea>
                            <span id="project_description_err"></span>
                        </div>
                        <div class="form-group">
                            <label>Feature 3</label>
                            <textarea name="feature3" id="feature3"></textarea>
                            <span id="project_description_err"></span>
                        </div>
                        <div class="form-group">
                            <label>Feature 4</label>
                            <textarea name="feature4" id="feature4"></textarea>
                            <span id="project_description_err"></span>
                        </div>
                        <div class="form-group">
                            <label>Gallery</label>
                        </div>
                        <div class="form-group sortable project_gallery_blocks"></div>
                        <div class="form-group">
                            <button type="button" class="btn bg-navy add_project_gallery_block">Add Gallery Image</button>
                        </div>
                        <div class="form-group">
                            <label>Project Map IFrame Code</label>
                            <textarea name="project_location_iframe" id="project_location_iframe"></textarea>
                            <span id="project_location_iframe_err"></span>
                        </div>
                        <div class="form-group">
                            <label>Landmarks</label>
                            <textarea class="basic_editor" name="project_landmarks"></textarea>
                            <span id="project_landmarks_err"></span>
                        </div>
                        <div class="form-group">
                            <label>Related Projects</label>
                            <select name="related_project_ids[]" id="related_project_ids" multiple>
                                @foreach($projects as $project_row)
                                <option value="{{$project_row->id}}">{{$project_row->project_title}}</option>
                                @endforeach
                            </select>
                            <span id="project_category_id_err"></span>
                        </div>
                        <div class="form-group">
                            <label for="meta_title">Meta Title*</label>
                            <input type="text" name="meta_title" id="meta_title">
                            <span id="meta_title_err"></span>
                        </div>
                        <div class="form-group">
                            <label for="meta_description">Meta Description*</label>
                            <textarea name="meta_description" id="meta_description"></textarea>
                            <span id="meta_description_err"></span>
                        </div>
                        <div class="form-group">
                            <label for="schema_code">Schema Code</label>
                            <textarea name="schema_code" id="schema_code" rows="10"></textarea>
                            <span id="schema_code_err"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="display_status">Status</label>
                        <select name="display_status" id="display_status">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="box-footer">
                    <input type="submit" value="Upload" class="btn btn-primary">
                </div>
            </form>
            <div class="reserved_slider_html" style="display:none;">
                <div class="form-group project_slider_block" style="border: 1px solid black; padding: 25px; margin-bottom:20px;">
                    <div class="form-group">
                        <label>Desktop Image*</label>
                        <input type="file" name="project_slider_images[]" required>
                    </div>
                    <div class="form-group">
                        <label>Mobile Image*</label>
                        <input type="file" name="project_slider_image_mobiles[]" required>
                    </div>
                    <div class="form-group">
                        <label>Caption*</label>
                        <input type="text" name="project_slider_captions[]">
                    </div>
                    <div class="form-group">
                        <label>Description*</label>
                        <input type="text" name="project_slider_descriptions[]">
                    </div>
                    <div class="form-group" style="margin-left: 92%">
                        <button type="button" class="btn btn-danger delete_block">Delete</button>
                    </div>
                </div>
            </div>

            <div class="reserved_highlighted_amenity_html" style="display:none;">
                <div class="form-group project_highlighted_amenity_block" style="border: 1px solid black; padding: 25px; margin-bottom:20px;">
                    <div class="form-group">
                        <label>Amenity Title*</label>
                        <input type="text" name="project_highlighted_amenity_titles[]" required>
                    </div>
                    <div class="form-group">
                        <label>Amenity Image*</label>
                        <input type="file" name="project_highlighted_amenity_images[]" accept="image/*" required>
                    </div>
                    <div class="form-group">
                        <label>Amenity Description*</label>
                        <textarea name="project_highlighted_amenity_descriptions[]" class="basic_editor_holder" required></textarea>
                    </div>
                    <div class="form-group amenity_illustration_image" style="display: none;">
                        <label>Amenity Illustration Image* (Mandatory if Seasons Template selected)</label>
                        <input type="file" name="project_highlighted_amenity_illustrations[]" accept="image/*">
                    </div>
                    <div class="form-group" style="margin-left: 92%">
                        <button type="button" class="btn btn-danger delete_block">Delete</button>
                    </div>
                </div>
            </div>

            <div class="reserved_gallery_html" style="display:none;">
                <div class="form-group project_gallery_block" style="border: 1px solid black; padding: 25px; margin-bottom:20px;">
                    <div class="form-group">
                        <label>Gallery Category*</label>
                        <select name="project_gallery_category_ids[]" required>
                            <option value="">Select Category</option>
                            @foreach($project_gallery_categories as $project_gallery_category_row)
                            <option value="{{$project_gallery_category_row->id}}">{{$project_gallery_category_row->project_gallery_category_title}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Gallery Image*</label>
                        <input type="file" name="project_gallery_images[]" required>
                    </div>
                    <div class="form-group">
                        <label>Gallery Image Caption*</label>
                        <input type="text" name="project_gallery_captions[]" required>
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