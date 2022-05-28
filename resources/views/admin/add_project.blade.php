@extends('layouts.admin_layout')
@section('title', 'Add Project')
@section('content')
<section class="content-header">
    <h1>Add Project</h1>
    <ol class="breadcrumb">
        <li><a href="{{Config::get('constants.admin_url')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{Config::get('constants.admin_url')}}manage-projects"><i class="fa fa-dashboard"></i> Manage Projects</a></li>
        <li class="active">Add Project</li>
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
            <form id="add_project" class="hideformspan" enctype="multipart/form-data">
                @csrf
                <div class="box-body">
                    <div class="form-group">
                        <label>Project Name</label>
                        <input name="project_name" id="project_name">
                        <span id="project_name_err"></span>
                    </div>
                    <div class="form-group">
                        <label>Project Layout Template</label>
                        <select name="project_template_id" class="project_template_id">
                            @foreach($project_templates as $project_template_row)
                            <option value="{{$project_template_row->id}}">{{$project_template_row->project_template_title}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="project_thumbnail">Project Thumbnail*</label>
                        <input type="file" name="project_thumbnail" id="project_thumbnail" accept="image/*" required>
                        <span id="project_thumbnail_err"></span>
                    </div>
                    <div class="form-group">
                        <label>Project Accommodation Types Available</label>
                        <input type="text" name="project_accommodation_type" id="project_accommodation_type">
                        <span id="project_accommodation_type_err"></span>
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
                        <select name="project_category_id[]" id="project_category_id" multiple>
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
                        <label>Project Zone</label>
                        <select name="project_zone_id" id="project_zone_id">
                            <option value="">Select Project Zone</option>
                            @foreach($project_zones as $project_zone_row)
                            <option value="{{$project_zone_row->id}}">{{$project_zone_row->project_zone_title}}</option>
                            @endforeach
                        </select>
                        <span id="project_zone_id_err"></span>
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
                        <label>Project Budget</label>
                        <select name="project_budget_id" id="project_budget_id">
                            <option value="">Select Project Budget</option>
                            @foreach($project_budgets as $project_budget_row)
                            <option value="{{$project_budget_row->id}}">{{$project_budget_row->project_budget_title}}</option>
                            @endforeach
                        </select>
                        <span id="project_budget_id_err"></span>
                    </div>
                    <div class="form-group">
                        <label>Project Price</label>
                        <input type="text" name="project_price" id="project_price">
                        <span id="project_price_err"></span>
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
                            <label>Project Slider</label>
                        </div>
                        <div class="form-group sortable project_slider_blocks"></div>
                        <div class="form-group">
                            <button type="button" class="btn bg-navy add_project_slider_block">Add Slider</button>
                        </div>
                        <div class="form-group">
                            <label>Overview Title One</label>
                            <input type="text" name="project_overview_title_one">
                        </div>
                        <div class="form-group">
                            <label>Overview Value One</label>
                            <input type="text" name="project_overview_value_one">
                        </div>
                        <div class="form-group">
                            <label>Overview Title Two</label>
                            <input type="text" name="project_overview_title_two">
                        </div>
                        <div class="form-group">
                            <label>Overview Value Two</label>
                            <input type="text" name="project_overview_value_two">
                        </div>
                        <div class="form-group">
                            <label>Overview Title Three</label>
                            <input type="text" name="project_overview_title_three">
                        </div>
                        <div class="form-group">
                            <label>Overview Value Three</label>
                            <input type="text" name="project_overview_value_three">
                        </div>
                        <div class="form-group">
                            <label>Overview Title Four</label>
                            <input type="text" name="project_overview_title_four">
                        </div>
                        <div class="form-group">
                            <label>Overview Value Four</label>
                            <input type="text" name="project_overview_value_four">
                        </div>
                        <div class="form-group">
                            <label>Project Headline</label>
                            <input type="text" name="project_headline" id="project_headline">
                            <span id="project_headline_err"></span>
                        </div>
                        <div class="form-group">
                            <label>Project Caption</label>
                            <textarea name="project_caption" id="project_caption"></textarea>
                            <span id="project_caption_err"></span>
                        </div>
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
                            <label for="project_configuration">Project Configuration</label>
                            <input type="file" name="project_configuration" id="project_configuration" accept=".pdf">
                            <span id="project_configuration_err"></span>
                        </div>
                        <div class="form-group">
                            <label>Project RERA Numbers (Multiple RERA Numbers separated by a comma and a space {, })</label>
                            <input type="text" name="project_rera_numbers" id="project_rera_numbers">
                            <span id="project_rera_numbers_err"></span>
                        </div>
                        <div class="form-group">
                            <label>Video Wall</label>
                        </div>
                        <div class="form-group sortable project_video_blocks"></div>
                        <div class="form-group">
                            <button type="button" class="btn bg-navy add_project_video_block">Add Video</button>
                        </div>
                        <div class="form-group">
                            <label>Highlighted Amenities</label>
                        </div>
                        <div class="form-group sortable project_highlighted_amenities_blocks"></div>
                        <div class="form-group">
                            <button type="button" class="btn bg-navy add_project_highlighted_amenity_block">Add Highlighted Amenity</button>
                        </div>
                        <div class="form-group">
                            <label>Amenities</label>
                        </div>
                        <div class="form-group sortable project_amenities_blocks"></div>
                        <div class="form-group">
                            <button type="button" class="btn bg-navy add_project_amenity_block">Add Amenity</button>
                        </div>
                        <div class="form-group">
                            <label>Gallery</label>
                        </div>
                        <div class="form-group sortable project_gallery_blocks"></div>
                        <div class="form-group">
                            <button type="button" class="btn bg-navy add_project_gallery_block">Add Gallery Image</button>
                        </div>
                        <div class="form-group">
                            <label>Plans</label>
                        </div>
                        <div class="form-group sortable project_plan_blocks"></div>
                        <div class="form-group">
                            <button type="button" class="btn bg-navy add_project_plan_block">Add Plan</button>
                        </div>
                        <div class="form-group">
                            <label>Project 3D Walk URL</label>
                            <input type="url" name="project_3d_walk" id="project_3d_walk">
                            <span id="project_3d_walk_err"></span>
                        </div>
                        <div class="form-group">
                            <label>Configuration Table</label>
                        </div>
                        <div class="form-group sortable project_configuration_blocks"></div>
                        <div class="form-group">
                            <button type="button" class="btn bg-navy add_project_configuration_block">Add Configuration</button>
                        </div>
                        <div class="form-group">
                            <label>Location Title</label>
                            <input type="text" name="project_location_title">
                        </div>
                        <div class="form-group">
                            <label>Location Image</label>
                            <input type="file" name="project_location_image" accept="image/*">
                        </div>
                        <div class="form-group">
                            <label>Location Description</label>
                            <textarea name="project_location_description" class="basic_editor"></textarea>
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
                            <label>FAQs</label>
                        </div>
                        <div class="form-group sortable project_faq_blocks"></div>
                        <div class="form-group">
                            <button type="button" class="btn bg-navy add_project_faq_block">Add FAQ</button>
                        </div>
                        <div class="form-group">
                            <label for="project_form_image">Project Enquire Form Image</label>
                            <input type="file" name="project_form_image" id="project_form_image" accept="image/*">
                            <span id="project_form_image_err"></span>
                        </div>
                        <div class="form-group">
                            <label>Related Projects</label>
                            <select name="related_project_ids[]" id="related_project_ids" multiple>
                                @foreach($projects as $project_row)
                                <option value="{{$project_row->id}}">{{$project_row->project_name}}</option>
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
            <div class="reserved_video_html" style="display:none;">
                <div class="form-group project_video_block" style="border: 1px solid black; padding: 25px; margin-bottom:20px;">
                    <div class="form-group">
                        <label>Video Category</label>
                        <select name="project_video_category_ids[]">
                            <option value="1">YouTube</option>
                            <option value="2">RTSP</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Video Caption*</label>
                        <input type="text" name="project_video_titles[]" required>
                    </div>
                    <div class="form-group">
                        <label>Video Thumbnail*</label>
                        <input type="file" name="project_video_thumbnails[]" required>
                    </div>
                    <div class="form-group">
                        <label>Video ID*</label>
                        <input type="text" name="video_youtube_ids[]" required>
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
            <div class="reserved_amenity_html" style="display:none;">
                <div class="form-group project_amenity_block" style="border: 1px solid black; padding: 25px; margin-bottom:20px;">
                    <div class="form-group">
                        <label>Amenity Title*</label>
                        <input type="text" name="project_amenity_titles[]" required>
                    </div>
                    <div class="form-group">
                        <label>Amenity Image*</label>
                        <input type="file" name="project_amenity_images[]" accept="image/*" required>
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
            <div class="reserved_landmark_html" style="display:none;">
                <div class="form-group project_landmark_block" style="border: 1px solid black; padding: 25px; margin-bottom:20px;">
                    <div class="form-group">
                        <label>Landmark Text*</label>
                        <input type="text" name="project_landmark_texts[]" required>
                    </div>
                    <div class="form-group" style="margin-left: 92%">
                        <button type="button" class="btn btn-danger delete_block">Delete</button>
                    </div>
                </div>
            </div>
            <div class="reserved_faq_html" style="display:none;">
                <div class="form-group project_faq_block" style="border: 1px solid black; padding: 25px; margin-bottom:20px;">
                    <div class="form-group">
                        <label>FAQ Question*</label>
                        <input type="text" name="project_faq_questions[]" required>
                    </div>
                    <div class="form-group">
                        <label>FAQ Answer*</label>
                        <input type="text" name="project_faq_answers[]" class="basic_editor_holder" required>
                    </div>
                    <div class="form-group" style="margin-left: 92%">
                        <button type="button" class="btn btn-danger delete_block">Delete</button>
                    </div>
                </div>
            </div>
            <div class="reserved_configuration_html" style="display:none;">
                <div class="form-group project_configuration_block" style="border: 1px solid black; padding: 25px; margin-bottom:20px;">
                    <div class="form-group">
                        <label>Type*</label>
                        <input type="text" name="project_configuration_types[]" required>
                    </div>
                    <div class="form-group">
                        <label>Area*</label>
                        <input type="text" name="project_configuration_areas[]" required>
                    </div>
                    <div class="form-group">
                        <label>Sold Out?*</label>
                        <select name="project_configuration_sold_outs[]">
                            <option value="0">No</option>
                            <option value="1">Yes</option>
                        </select>
                    </div>
                    <div class="form-group" style="margin-left: 92%">
                        <button type="button" class="btn btn-danger delete_block">Delete</button>
                    </div>
                </div>
            </div>
            <div class="reserved_plan_html" style="display:none;">
                <div class="form-group project_plan_block" style="border: 1px solid black; padding: 25px; margin-bottom:20px;">
                    <div class="form-group">
                        <label>Title*</label>
                        <input type="text" name="project_layout_titles[]" required>
                    </div>
                    <div class="form-group">
                        <label>Type*</label>
                        <input type="text" name="project_layout_types[]">
                    </div>
                    <div class="form-group">
                        <label>Image*</label>
                        <input type="file" name="project_layout_images[]" required>
                    </div>
                    <div class="form-group">
                        <label>Area Title One</label>
                        <input type="text" name="project_layout_area_title_ones[]">
                    </div>
                    <div class="form-group">
                        <label>Area Value One</label>
                        <input type="text" name="project_layout_area_value_ones[]">
                    </div>
                    <div class="form-group">
                        <label>Area Title Two</label>
                        <input type="text" name="project_layout_area_title_twos[]">
                    </div>
                    <div class="form-group">
                        <label>Area Value Two</label>
                        <input type="text" name="project_layout_area_value_twos[]">
                    </div>
                    <div class="form-group">
                        <label>Area Title Three</label>
                        <input type="text" name="project_layout_area_title_threes[]">
                    </div>
                    <div class="form-group">
                        <label>Area Value Three</label>
                        <input type="text" name="project_layout_area_value_threes[]">
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