@extends('layouts.admin_layout')
@section('title', 'Edit Project')
@section('content')
<section class="content-header">
    <h1>Edit Project</h1>
    <ol class="breadcrumb">
        <li><a href="{{Config::get('constants.admin_url')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{Config::get('constants.admin_url')}}manage-projects"><i class="fa fa-dashboard"></i> Manage Projects</a></li>
        <li class="active">Edit Project</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 connectedSortable">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Edit Project</h3>
                <div class="box-tools"></div>
            </div>
            <form id="edit_project" class="hideformspan" enctype="multipart/form-data">
                @csrf
                <div class="box-body">
                    <input type="hidden" name="project_id" value="{{$project->id}}">
                    <div class="form-group">
                        <label>Project Name</label>
                        <input name="project_name" id="project_name" value="{{$project->project_name}}">
                        <span id="project_name_err"></span>
                    </div>
                    <div class="form-group">
                        <label>Project Layout Template</label>
                        <select name="project_template_id" class="project_template_id">
                            @foreach($project_templates as $project_template_row)
                            <option value="{{$project_template_row->id}}" @if($project_template_row->id == $project->project_template_id) selected @endif>{{$project_template_row->project_template_title}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="project_thumbnail">Project Thumbnail*</label>
                        <br>
                        <img src="{{url('/')}}/assets/images/projects/{{$project->project_thumbnail}}" style="width: 300px;">
                        <input type="file" name="project_thumbnail" id="project_thumbnail" accept="image/*">
                        <span id="project_thumbnail_err"></span>
                    </div>
                    <div class="form-group">
                        <label>Project Accommodation Types Available</label>
                        <input type="text" name="project_accommodation_type" id="project_accommodation_type" value="{{$project->project_accommodation_type}}">
                        <span id="project_accommodation_type_err"></span>
                    </div>
                    <div class="form-group">
                        <label>Project Location Text</label>
                        <input type="text" name="project_location_text" id="project_location_text" value="{{$project->project_location_text}}">
                        <span id="project_location_text_err"></span>
                    </div>
                    <div class="form-group">
                        <label for="project_logo">Project Logo*</label>
                        <br>
                        <img src="{{url('/')}}/assets/images/projects/{{$project->project_logo}}" style="width: 300px;">
                        <input type="file" name="project_logo" id="project_logo" accept="image/*">
                        <span id="project_logo_err"></span>
                    </div>
                    <div class="form-group">
                        <label>Project Category</label>
                        <select name="project_category_id[]" id="project_category_id" multiple>
                            @foreach($project_categories as $project_category_row)
                            <option value="{{$project_category_row->id}}" @if(in_array($project_category_row->id, $project_category_ids)) selected @endif>{{$project_category_row->project_category_title}}</option>
                            @endforeach
                        </select>
                        <span id="project_category_id_err"></span>
                    </div>
                    <div class="form-group">
                        <label>Project Type</label>
                        <select name="project_type_id" id="project_type_id">
                            <option value="">Select Project Type</option>
                            @foreach($project_types as $project_type_row)
                            <option value="{{$project_type_row->id}}" @if($project_type_row->id == $project->project_type_id) selected @endif>{{$project_type_row->project_type_title}}</option>
                            @endforeach
                        </select>
                        <span id="project_type_id_err"></span>
                    </div>
                    <div class="form-group">
                        <label>Project Zone</label>
                        <select name="project_zone_id" id="project_zone_id">
                            <option value="">Select Project Zone</option>
                            @foreach($project_zones as $project_zone_row)
                            <option value="{{$project_zone_row->id}}" @if($project_zone_row->id == $project->project_zone_id) selected @endif>{{$project_zone_row->project_zone_title}}</option>
                            @endforeach
                        </select>
                        <span id="project_zone_id_err"></span>
                    </div>
                    <div class="form-group">
                        <label>Project Location</label>
                        <select name="project_location_id" id="project_location_id">
                            <option value="">Select Project Location</option>
                            @foreach($project_locations as $project_location_row)
                            <option value="{{$project_location_row->id}}" @if($project_location_row->id == $project->project_location_id) selected @endif>{{$project_location_row->project_location_title}}</option>
                            @endforeach
                        </select>
                        <span id="project_location_id_err"></span>
                    </div>
                    <div class="form-group">
                        <label>Project Budget</label>
                        <select name="project_budget_id" id="project_budget_id">
                            <option value="">Select Project Budget</option>
                            @foreach($project_budgets as $project_budget_row)
                            <option value="{{$project_budget_row->id}}" @if($project_budget_row->id == $project->project_budget_id) selected @endif>{{$project_budget_row->project_budget_title}}</option>
                            @endforeach
                        </select>
                        <span id="project_budget_id_err"></span>
                    </div>
                    <div class="form-group">
                        <label>Project Price</label>
                        <input type="text" name="project_price" id="project_price" value="{{$project->project_price}}">
                        <span id="project_price_err"></span>
                    </div>
                    <div class="form-group">
                        <label>Project Link</label>
                        <input type="url" name="project_link" id="project_link" value="{{$project->project_link}}">
                        <span id="project_link_err"></span>
                    </div>
                    <div class="form-group">
                        <label>Project Status</label>
                        <select name="project_status_id" id="project_status_id">
                            <option value="">Select Project Status</option>
                            @foreach($project_status as $project_status_row)
                            <option value="{{$project_status_row->id}}" @if($project_status_row->id == $project->project_status_id) selected @endif>{{$project_status_row->project_status_title}}</option>
                            @endforeach
                        </select>
                        <span id="project_status_id_err"></span>
                    </div>
                    <div class="form-group with_template_data" @if($project->project_template_id == 3) style="display: none;" @endif>
                        <div class="form-group">
                            <label>Project Slider</label>
                        </div>
                        <div class="form-group sortable project_slider_blocks">
                            @foreach($project_sliders as $project_slider_row)
                            <div class="form-group project_slider_block" style="border: 1px solid black; padding: 25px; margin-bottom:20px;">
                                <input type="hidden" name="project_slider_ids[]" value="{{$project_slider_row->id}}">
                                <div class="form-group">
                                    <label>Desktop Image*</label>
                                    <br>
                                    <img src="{{url('/')}}/assets/images/projects/{{$project_slider_row->project_slider_image}}" style="width:300px;">
                                    <input type="file" name="project_slider_images[]">
                                </div>
                                <div class="form-group">
                                    <label>Mobile Image*</label>
                                    <br>
                                    <img src="{{url('/')}}/assets/images/projects/{{$project_slider_row->project_slider_image_mobile}}" style="width:300px;">
                                    <input type="file" name="project_slider_image_mobiles[]">
                                </div>
                                <div class="form-group">
                                    <label>Caption*</label>
                                    <input type="text" name="project_slider_captions[]" value="{{$project_slider_row->project_slider_caption}}">
                                </div>
                                <div class="form-group">
                                    <label>Description*</label>
                                    <input type="text" name="project_slider_descriptions[]" value="{{$project_slider_row->project_slider_description}}">
                                </div>
                                <div class="form-group" style="margin-left: 92%">
                                    <button type="button" class="btn btn-danger delete_block">Delete</button>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="form-group">
                            <button type="button" class="btn bg-navy add_project_slider_block">Add Slider</button>
                        </div>
                        <div class="form-group">
                            <label>Overview Title One</label>
                            <input type="text" name="project_overview_title_one" value="{{$project->project_overview_title_one}}">
                        </div>
                        <div class="form-group">
                            <label>Overview Value One</label>
                            <input type="text" name="project_overview_value_one" value="{{$project->project_overview_value_one}}">
                        </div>
                        <div class="form-group">
                            <label>Overview Title Two</label>
                            <input type="text" name="project_overview_title_two" value="{{$project->project_overview_title_two}}">
                        </div>
                        <div class="form-group">
                            <label>Overview Value Two</label>
                            <input type="text" name="project_overview_value_two" value="{{$project->project_overview_value_two}}">
                        </div>
                        <div class="form-group">
                            <label>Overview Title Three</label>
                            <input type="text" name="project_overview_title_three" value="{{$project->project_overview_title_three}}">
                        </div>
                        <div class="form-group">
                            <label>Overview Value Three</label>
                            <input type="text" name="project_overview_value_three" value="{{$project->project_overview_value_three}}">
                        </div>
                        <div class="form-group">
                            <label>Overview Title Four</label>
                            <input type="text" name="project_overview_title_four" value="{{$project->project_overview_title_four}}">
                        </div>
                        <div class="form-group">
                            <label>Overview Value Four</label>
                            <input type="text" name="project_overview_value_four" value="{{$project->project_overview_value_four}}">
                        </div>
                        <div class="form-group">
                            <label>Project Headline</label>
                            <input type="text" name="project_headline" id="project_headline" value="{{$project->project_headline}}">
                            <span id="project_headline_err"></span>
                        </div>
                        <div class="form-group">
                            <label>Project Caption</label>
                            <textarea name="project_caption" id="project_caption">{{$project->project_caption}}</textarea>
                            <span id="project_caption_err"></span>
                        </div>
                        <div class="form-group">
                            <label>Project Description</label>
                            <textarea name="project_description" id="project_description">{{$project->project_description}}</textarea>
                            <span id="project_description_err"></span>
                        </div>
                        <div class="form-group">
                            <label for="project_about_image">Project About Image</label>
                            @if(!empty($project->project_about_image))
                            <br>
                            <img src="{{url('/')}}/assets/images/projects/{{$project->project_about_image}}" style="width: 300px;">
                            @endif
                            <input type="file" name="project_about_image" id="project_about_image" accept="image/*">
                            <span id="project_about_image_err"></span>
                        </div>
                        <div class="form-group">
                            <label for="project_brochure">Project Brochure</label>
                            @if(!empty($project->project_brochure))
                            <br>
                            <a class="btn btn-default" href="{{url('/')}}/assets/pdfs/{{$project->project_brochure}}" target="_blank">View Brochure</a>
                            @endif
                            <input type="file" name="project_brochure" id="project_brochure" accept=".pdf">
                            <span id="project_brochure_err"></span>
                        </div>
                        <div class="form-group">
                            <label for="project_configuration">Project Configuration</label>
                            @if(!empty($project->project_configuration))
                            <br>
                            <a class="btn btn-default" href="{{url('/')}}/assets/pdfs/{{$project->project_configuration}}" target="_blank">View Configuration</a>
                            @endif
                            <input type="file" name="project_configuration" id="project_configuration" accept=".pdf">
                            <span id="project_configuration_err"></span>
                        </div>
                        <div class="form-group">
                            <label>Project RERA Numbers (Multiple RERA Numbers separated by a comma and a space {, })</label>
                            <input type="text" name="project_rera_numbers" id="project_rera_numbers" value="{{$project->project_rera_numbers}}">
                            <span id="project_rera_numbers_err"></span>
                        </div>
                        <div class="form-group">
                            <label>Video Wall</label>
                        </div>
                        <div class="form-group sortable project_video_blocks">
                            @foreach($project_video_sliders as $project_video_slider_row)
                            <div class="form-group project_video_block" style="border: 1px solid black; padding: 25px; margin-bottom:20px;">
                                <input type="hidden" name="project_video_slider_ids[]" value="{{$project_video_slider_row->id}}">
                                <div class="form-group">
                                    <label>Video Category</label>
                                    <select name="project_video_category_ids[]">
                                        <option value="1">YouTube</option>
                                        <option value="2" @if($project_video_slider_row->project_video_category_id == 2) selected @endif>RTSP</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Video Caption</label>
                                    <input type="text" name="project_video_titles[]" value="{{$project_video_slider_row->project_video_title}}" required>
                                </div>
                                <div class="form-group">
                                    <label>Video Thumbnail*</label>
                                    <br>
                                    <img src="{{url('/')}}/assets/images/projects/{{$project_video_slider_row->project_video_thumbnail}}" style="width: 300px;">
                                    <input type="file" name="project_video_thumbnails[]">
                                </div>
                                <div class="form-group">
                                    <label>Video ID</label>
                                    <input type="text" name="video_youtube_ids[]" value="{{$project_video_slider_row->video_youtube_id}}" required>
                                </div>
                                <div class="form-group" style="margin-left: 92%">
                                    <button type="button" class="btn btn-danger delete_block">Delete</button>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="form-group">
                            <button type="button" class="btn bg-navy add_project_video_block">Add Video</button>
                        </div>
                        <div class="form-group">
                            <label>Highlighted Amenities</label>
                        </div>
                        <div class="form-group sortable project_highlighted_amenities_blocks">
                            @foreach($project_highlighted_amenities as $project_highlighted_amenity_row)
                            <div class="form-group project_highlighted_amenity_block" style="border: 1px solid black; padding: 25px; margin-bottom:20px;">
                                <input type="hidden" name="project_highlighted_amenity_ids[]" value="{{$project_highlighted_amenity_row->id}}">
                                <div class="form-group">
                                    <label>Amenity Title*</label>
                                    <input type="text" name="project_highlighted_amenity_titles[]" value="{{$project_highlighted_amenity_row->project_amenity_title}}" required>
                                </div>
                                <div class="form-group">
                                    <label>Amenity Image*</label>
                                    <br>
                                    <img src="{{url('/')}}/assets/images/projects/{{$project_highlighted_amenity_row->project_amenity_image}}" style="width:300px;">
                                    <input type="file" name="project_highlighted_amenity_images[]" accept="image/*">
                                </div>
                                <div class="form-group">
                                    <label>Amenity Description*</label>
                                    <textarea name="project_highlighted_amenity_descriptions[]" class="basic_editor" required>{{$project_highlighted_amenity_row->project_amenity_description}}</textarea>
                                </div>
                                <div class="form-group amenity_illustration_image" @if($project->project_template_id != 2) style="display: none;" @endif>
                                    <label>Amenity Illustration Image* (Mandatory if Seasons Template selected)</label>
                                    @if(!empty($project_highlighted_amenity_row->project_amenity_illustration))
                                    <br>
                                    <img src="{{url('/')}}/assets/images/projects/{{$project_highlighted_amenity_row->project_amenity_illustration}}" style="width:300px;">
                                    @endif
                                    <input type="file" name="project_highlighted_amenity_illustrations[]" accept="image/*">
                                </div>
                                <div class="form-group" style="margin-left: 92%">
                                    <button type="button" class="btn btn-danger delete_block">Delete</button>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="form-group">
                            <button type="button" class="btn bg-navy add_project_highlighted_amenity_block">Add Highlighted Amenity</button>
                        </div>
                        <div class="form-group">
                            <label>Amenities</label>
                        </div>
                        <div class="form-group sortable project_amenities_blocks">
                            @foreach($project_amenities as $project_amenity_row)
                            <div class="form-group project_amenity_block" style="border: 1px solid black; padding: 25px; margin-bottom:20px;">
                                <input type="hidden" name="project_amenity_ids[]" value="{{$project_amenity_row->id}}">
                                <div class="form-group">
                                    <label>Amenity Title*</label>
                                    <input type="text" name="project_amenity_titles[]" value="{{$project_amenity_row->project_amenity_title}}" required>
                                </div>
                                <div class="form-group">
                                    <label>Amenity Image*</label>
                                    <br>
                                    <img src="{{url('/')}}/assets/images/projects/{{$project_amenity_row->project_amenity_image}}" style="width:100px;">
                                    <input type="file" name="project_amenity_images[]" accept="image/*">
                                </div>
                                <div class="form-group" style="margin-left: 92%">
                                    <button type="button" class="btn btn-danger delete_block">Delete</button>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="form-group">
                            <button type="button" class="btn bg-navy add_project_amenity_block">Add Amenity</button>
                        </div>
                        <div class="form-group">
                            <label>Gallery</label>
                        </div>
                        <div class="form-group sortable project_gallery_blocks">
                            @foreach($project_galleries as $project_gallery_row)
                            <div class="form-group project_gallery_block" style="border: 1px solid black; padding: 25px; margin-bottom:20px;">
                                <input type="hidden" name="project_gallery_image_ids[]" value="{{$project_gallery_row->id}}">
                                <div class="form-group">
                                    <label>Gallery Category*</label>
                                    <select name="project_gallery_category_ids[]" required>
                                        <option value="">Select Category</option>
                                        @foreach($project_gallery_categories as $project_gallery_category_row)
                                        <option value="{{$project_gallery_category_row->id}}" @if($project_gallery_category_row->id == $project_gallery_row->project_gallery_category_id) selected @endif>{{$project_gallery_category_row->project_gallery_category_title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Gallery Image*</label>
                                    <br>
                                    <img src="{{url('/')}}/assets/images/projects/{{$project_gallery_row->project_gallery_image}}" style="width: 300px;">
                                    <input type="file" name="project_gallery_images[]">
                                </div>
                                <div class="form-group">
                                    <label>Gallery Image Caption*</label>
                                    <input type="text" name="project_gallery_captions[]" value="{{$project_gallery_row->project_gallery_caption}}" required>
                                </div>
                                <div class="form-group" style="margin-left: 92%">
                                    <button type="button" class="btn btn-danger delete_block">Delete</button>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="form-group">
                            <button type="button" class="btn bg-navy add_project_gallery_block">Add Gallery Image</button>
                        </div>
                        <div class="form-group">
                            <label>Plans</label>
                        </div>
                        <div class="form-group sortable project_plan_blocks">
                            @foreach($project_plans as $project_plan_row)
                            <div class="form-group project_plan_block" style="border: 1px solid black; padding: 25px; margin-bottom:20px;">
                                <input type="hidden" name="project_plan_ids[]" value="{{$project_plan_row->id}}">
                                <div class="form-group">
                                    <label>Title*</label>
                                    <input type="text" name="project_layout_titles[]" value="{{$project_plan_row->project_layout_title}}" required>
                                </div>
                                <div class="form-group">
                                    <label>Type*</label>
                                    <input type="text" name="project_layout_types[]" value="{{$project_plan_row->project_layout_type}}">
                                </div>
                                <div class="form-group">
                                    <label>Image</label>
                                    <br>
                                    <img src="{{url('/')}}/assets/images/projects/{{$project_plan_row->project_layout_image}}" style="width: 300px;">
                                    <input type="file" name="project_layout_images[]">
                                </div>
                                <div class="form-group">
                                    <label>Area Title One</label>
                                    <input type="text" name="project_layout_area_title_ones[]" value="{{$project_plan_row->project_layout_area_title_one}}">
                                </div>
                                <div class="form-group">
                                    <label>Area Value One</label>
                                    <input type="text" name="project_layout_area_value_ones[]" value="{{$project_plan_row->project_layout_area_value_one}}">
                                </div>
                                <div class="form-group">
                                    <label>Area Title Two</label>
                                    <input type="text" name="project_layout_area_title_twos[]" value="{{$project_plan_row->project_layout_area_title_two}}">
                                </div>
                                <div class="form-group">
                                    <label>Area Value Two</label>
                                    <input type="text" name="project_layout_area_value_twos[]" value="{{$project_plan_row->project_layout_area_value_two}}">
                                </div>
                                <div class="form-group">
                                    <label>Area Title Three</label>
                                    <input type="text" name="project_layout_area_title_threes[]" value="{{$project_plan_row->project_layout_area_title_three}}">
                                </div>
                                <div class="form-group">
                                    <label>Area Value Three</label>
                                    <input type="text" name="project_layout_area_value_threes[]" value="{{$project_plan_row->project_layout_area_value_three}}">
                                </div>
                                <div class="form-group" style="margin-left: 92%">
                                    <button type="button" class="btn btn-danger delete_block">Delete</button>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="form-group">
                            <button type="button" class="btn bg-navy add_project_plan_block">Add Plan</button>
                        </div>
                        <div class="form-group">
                            <label>Project 3D Walk URL</label>
                            <input type="url" name="project_3d_walk" id="project_3d_walk" value="{{$project->project_3d_walk}}">
                            <span id="project_3d_walk_err"></span>
                        </div>
                        <div class="form-group">
                            <label>Configuration Table</label>
                        </div>
                        <div class="form-group sortable project_configuration_blocks">
                            @foreach($project_configurations as $project_configuration_row)
                            <div class="form-group project_configuration_block" style="border: 1px solid black; padding: 25px; margin-bottom:20px;">
                                <input type="hidden" name="project_configuration_ids[]" value="{{$project_configuration_row->id}}">
                                <div class="form-group">
                                    <label>Type*</label>
                                    <input type="text" name="project_configuration_types[]" value="{{$project_configuration_row->project_configuration_type}}" required>
                                </div>
                                <div class="form-group">
                                    <label>Area*</label>
                                    <input type="text" name="project_configuration_areas[]" value="{{$project_configuration_row->project_configuration_area}}" required>
                                </div>
                                <div class="form-group">
                                    <label>Sold Out?*</label>
                                    <select name="project_configuration_sold_outs[]">
                                        <option value="0">No</option>
                                        <option value="1" @if(!empty($project_configuration_row->project_configuration_sold_out)) selected @endif>Yes</option>
                                    </select>
                                </div>
                                <div class="form-group" style="margin-left: 92%">
                                    <button type="button" class="btn btn-danger delete_block">Delete</button>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="form-group">
                            <button type="button" class="btn bg-navy add_project_configuration_block">Add Configuration</button>
                        </div>
                        <div class="form-group">
                            <label>Location Title</label>
                            <input type="text" name="project_location_title" value="{{$project->project_location_title}}">
                        </div>
                        <div class="form-group">
                            <label>Location Image</label>
                            @if(!empty($project->project_location_image))
                            <br>
                            <img src="{{url('/')}}/assets/images/projects/{{$project->project_location_image}}" style="width:300px;">
                            @endif
                            <input type="file" name="project_location_image" accept="image/*">
                        </div>
                        <div class="form-group">
                            <label>Location Description</label>
                            <textarea name="project_location_description" class="basic_editor">{{$project->project_location_description}}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Project Map IFrame Code</label>
                            <textarea name="project_location_iframe" id="project_location_iframe">{{$project->project_location_iframe}}</textarea>
                            <span id="project_location_iframe_err"></span>
                        </div>
                        <div class="form-group">
                            <label>Landmarks</label>
                            <textarea class="basic_editor" name="project_landmarks">{{$project->project_landmarks}}</textarea>
                            <span id="project_landmarks_err"></span>
                        </div>
                        <div class="form-group">
                            <label>FAQs</label>
                        </div>
                        <div class="form-group sortable project_faq_blocks">
                            @foreach($project_faqs as $project_faq_row)
                            <div class="form-group project_faq_block" style="border: 1px solid black; padding: 25px; margin-bottom:20px;">
                                <input type="hidden" name="project_faq_ids[]" value="{{$project_faq_row->id}}">
                                <div class="form-group">
                                    <label>FAQ Question*</label>
                                    <input type="text" name="project_faq_questions[]" value="{{$project_faq_row->project_faq_question}}" required>
                                </div>
                                <div class="form-group">
                                    <label>FAQ Answer*</label>
                                    <input type="text" name="project_faq_answers[]" class="basic_editor" value="{{$project_faq_row->project_faq_answer}}" required>
                                </div>
                                <div class="form-group" style="margin-left: 92%">
                                    <button type="button" class="btn btn-danger delete_block">Delete</button>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="form-group">
                            <button type="button" class="btn bg-navy add_project_faq_block">Add FAQ</button>
                        </div>
                        <div class="form-group">
                            <label for="project_form_image">Project Enquire Form Image</label>
                            @if(!empty($project->project_form_image))
                            <br>
                            <img src="{{url('/')}}/assets/images/projects/{{$project->project_form_image}}" style="width: 300px;">
                            @endif
                            <input type="file" name="project_form_image" id="project_form_image" accept="image/*">
                            <span id="project_form_image_err"></span>
                        </div>
                        <div class="form-group">
                            <label>Related Projects</label>
                            <select name="related_project_ids[]" id="related_project_ids" multiple>
                                @foreach($projects as $project_row)
                                <option value="{{$project_row->id}}" @if(in_array($project_row->id, $related_project_ids)) selected @endif>{{$project_row->project_name}}</option>
                                @endforeach
                            </select>
                            <span id="project_category_id_err"></span>
                        </div>
                        <div class="form-group">
                            <label for="meta_title">Meta Title*</label>
                            <input type="text" name="meta_title" id="meta_title" value="{{$project->meta_title}}">
                            <span id="meta_title_err"></span>
                        </div>
                        <div class="form-group">
                            <label for="meta_description">Meta Description*</label>
                            <textarea name="meta_description" id="meta_description">{{$project->meta_description}}</textarea>
                            <span id="meta_description_err"></span>
                        </div>
                        <div class="form-group">
                            <label for="schema_code">Schema Code</label>
                            <textarea name="schema_code" id="schema_code" rows="10">{{$project->schema_code}}</textarea>
                            <span id="schema_code_err"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="display_status">Status</label>
                        <select name="display_status" id="display_status">
                            <option value="1">Active</option>
                            <option value="0"@if(empty($project->display_status)) selected @endif>Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="box-footer">
                    <input type="submit" value="Upload" class="btn btn-primary">
                </div>
            </form>
            <div class="reserved_slider_html" style="display:none;">
                <div class="form-group project_slider_block" style="border: 1px solid black; padding: 25px; margin-bottom:20px;">
                    <input type="hidden" name="project_slider_ids[]" value="0">
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
                    <input type="hidden" name="project_video_slider_ids[]" value="0">
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
                    <input type="hidden" name="project_highlighted_amenity_ids[]" value="0">
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
                    <div class="form-group amenity_illustration_image" @if($project->project_template_id != 2) style="display: none;" @endif>
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
                    <input type="hidden" name="project_amenity_ids[]" value="0">
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
                    <input type="hidden" name="project_gallery_image_ids[]" value="0">
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
                    <input type="hidden" name="project_landmark_ids[]" value="0">
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
                    <input type="hidden" name="project_faq_ids[]" value="0">
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
                    <input type="hidden" name="project_configuration_ids[]" value="0">
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
                    <input type="hidden" name="project_plan_ids[]" value="0">
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