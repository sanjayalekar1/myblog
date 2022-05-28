<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use DB;
use Excel;
use Illuminate\Support\Facades\Hash;

class CenturyAdminPanel extends Controller {
    public function __construct() {
        $this->middleware('auth');
    }

    private function success_message($string) {
        $string = '<div class="alert alert-success alert-dismissable">
            <i class="fa fa-check"></i>
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            '.$string.'
        </div>';
        
        return $string;
    }
    
    private function failed_message($string) {
        $string = '<div class="alert alert-danger alert-dismissable">
            <i class="fa fa-ban"></i>
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            '.$string.'
        </div>';
        
        return $string;
    }

    private function get_present_value($tableName, $primaryKey, $whereClause) {
        $result = DB::table($tableName)->where('id', $primaryKey)->value($whereClause);
        
        return $result;
    }

    private function upload_file($file_name, $target_dir, $dedicated_file_name = 0) {
        $target_dir = "assets/".$target_dir;
        
        $file_name_extension = $file_name->getClientOriginalExtension();

        if(!empty($dedicated_file_name)) {
            $file_name_temp = $dedicated_file_name.".".$file_name_extension;    
        } else {
            $file_name_temp = Str::random(30).".".$file_name_extension;    
        }
        
        $file_name->move($target_dir, $file_name_temp);
        
        return $file_name_temp;
    }
    
    private function get_last_sorting($tableName, $whereKey = 0, $whereValue = 0) {
        if(empty($whereKey)) {
            $result_count = DB::table($tableName)->select('sorting_order')->get()->count();
        } else {
            $result_count = DB::table($tableName)->select('sorting_order')->where($whereKey, $whereValue)->get()->count();
        }
        
        if(empty($result_count)) {
            $sorting_order = 1;
        } else {
            if(empty($whereKey)) {
                $sorting_order = DB::table($tableName)->select('sorting_order')->orderBy('sorting_order', 'desc')->take(1)->value('sorting_order');
            } else {
                $sorting_order = DB::table($tableName)->select('sorting_order')->where($whereKey, $whereValue)->orderBy('sorting_order', 'desc')->take(1)->value('sorting_order');
            }
            
            $sorting_order = $sorting_order + 1;
        }
        
        return $sorting_order;
    }
    
    private function update_sorting_number($tableName, $orderNumber, $tableID) {
        $data = ['sorting_order' => $orderNumber];
        
        $result = DB::table($tableName)->where('id', $tableID)->update($data);
    }

    public function index() {
        return view('admin.home');
    }
    
    public function manage_meta_data() {
        $meta_data = DB::table('meta_data')->orderBy('page_name')->get();
        
        return view('admin.manage_meta_data', compact('meta_data'));
    }
    
    public function edit_meta_data($meta_id) {
        $meta_data = DB::table('meta_data')->find($meta_id);
        
        return view('admin.edit_meta_data', compact('meta_data'));
    }
    
    public function edit_meta_data_details(Request $request) {
        $input_list = [
            'meta_title' => ['bail', 'required'],
            'meta_description' => ['bail', 'required']
        ];

        $validation_list = [
            'meta_title.required' => 'Please Enter Meta Title',
            'meta_description.required' => 'Please Enter Meta Description'
        ];

        Validator::make($request->all(), $input_list, $validation_list)->validate();
        
        $meta_id = $request->input('id');
        $meta_title = $request->input('meta_title');
        $meta_description = $request->input('meta_description');
        $introduction_text_one = $request->input('introduction_text_one');
        $introduction_text_two = $request->input('introduction_text_two');
        $canonical_tag = $request->input('canonical_tag');
        
        $canonical_tag = Str::slug($canonical_tag, "-");
        
        $meta_data = \App\Models\MetaData::find($meta_id);
        $meta_data->meta_title = $meta_title;
        $meta_data->meta_description = $meta_description;
        $meta_data->introduction_text_one = $introduction_text_one;
        $meta_data->introduction_text_two = $introduction_text_two;
        $meta_data->canonical_tag = $canonical_tag;
        $meta_data->save();
        
        $display_message = $this->success_message("Meta Data Updated Successfully");
        
        return response()->json(['display_message' => $display_message]);
    }

    public function manage_banners() {
        $banners = DB::table('banners')->orderBy('page_name')->get();
        
        return view('admin.manage_banners', compact('banners'));
    }
    
    public function edit_banner($banner_id) {
        $banner = DB::table('banners')->find($banner_id);
        
        return view('admin.edit_banner', compact('banner'));
    }
    
    public function edit_banner_details(Request $request) {
        $banner_id = $request->input('id');
        $banner_image = $request->file('banner_image');
        $banner_image_mobile = $request->file('banner_image_mobile');
        
        $target_dir = "images/banners";

        if(!empty($banner_image)) {    
            $banner_image = $this->upload_file($banner_image, $target_dir);
        } else {
            $banner_image = $this->get_present_value('banners', $banner_id, 'banner_image');
        }

        if(!empty($banner_image_mobile)) {    
            $banner_image_mobile = $this->upload_file($banner_image_mobile, $target_dir);
        } else {
            $banner_image_mobile = $this->get_present_value('banners', $banner_id, 'banner_image_mobile');
        }
        
        $banner = \App\Models\Banner::find($banner_id);
        $banner->banner_image = $banner_image;
        $banner->banner_image_mobile = $banner_image_mobile;
        $banner->save();
        
        $display_message = $this->success_message("Banner Updated Successfully");
        
        return response()->json(['display_message' => $display_message]);
    }

    public function manage_home_page_sliders() {
        $home_page_slider = DB::table('home_page_sliders')->orderBy('sorting_order')->get();
        
        return view('admin.manage_home_page_sliders', compact('home_page_slider'));
    }
    
    public function add_home_page_slider() {
        return view('admin.add_home_page_slider');
    }
    
    public function add_home_page_slider_details(Request $request) {
        $input_list = [
            'slider_caption' => ['bail', 'required']
        ];

        $validation_list = [
            'slider_caption.required' => 'Please enter slider text line one'
        ];

        Validator::make($request->all(), $input_list, $validation_list)->validate();
        
        $slider_image = $request->file('slider_image');
        $slider_image_mobile = $request->file('slider_image_mobile');
        $slider_caption = $request->input('slider_caption');
        $slider_caption_two = $request->input('slider_caption_two');
        $display_status = $request->input('display_status');
        $sorting_order = $this->get_last_sorting('home_page_sliders');
        
        $target_dir = "images/home-page-sliders";

        if(!empty($slider_image)) {        
            $slider_image = $this->upload_file($slider_image, $target_dir);
        }

        if(!empty($slider_image_mobile)) {
            $slider_image_mobile = $this->upload_file($slider_image_mobile, $target_dir);
        }
        
        $slider = new \App\Models\HomePageSlider;
        $slider->slider_image = $slider_image;
        $slider->slider_image_mobile = $slider_image_mobile;
        $slider->slider_caption = $slider_caption;
        $slider->slider_caption_two = $slider_caption_two;
        $slider->display_status = $display_status;
        $slider->sorting_order = $sorting_order;
        $slider->save();
        
        $display_message = $this->success_message("Home Page Slider Uploaded Successfully");
        
        return response()->json(['display_message' => $display_message]);
    }
    
    public function edit_home_page_slider($slider_id) {
        $slider = DB::table('home_page_sliders')->find($slider_id);
        
        return view('admin.edit_home_page_slider', compact('slider'));
    }
    
    public function edit_home_page_slider_details(Request $request) {
        $input_list = [
            'slider_caption' => ['bail', 'required']
        ];

        $validation_list = [
            'slider_caption.required' => 'Please enter slider text line one'
        ];

        Validator::make($request->all(), $input_list, $validation_list)->validate();
        
        $slider_id = $request->input('slider_id');
        $slider_image = $request->file('slider_image');
        $slider_image_mobile = $request->file('slider_image_mobile');
        $slider_caption = $request->input('slider_caption');
        $slider_caption_two = $request->input('slider_caption_two');
        $display_status = $request->input('display_status');
        
        $target_dir = "images/home-page-sliders";
        
        if(!empty($slider_image)) {
            $slider_image = $this->upload_file($slider_image, $target_dir);
        } else {
            $slider_image = $this->get_present_value('home_page_sliders', $slider_id, 'slider_image');
        }
        
        if(!empty($slider_image_mobile)) {
            $slider_image_mobile = $this->upload_file($slider_image_mobile, $target_dir);
        } else {
            $slider_image_mobile = $this->get_present_value('home_page_sliders', $slider_id, 'slider_image_mobile');
        }
        
        $slider = \App\Models\HomePageSlider::find($slider_id);
        $slider->slider_image = $slider_image;
        $slider->slider_image_mobile = $slider_image_mobile;
        $slider->slider_caption = $slider_caption;
        $slider->slider_caption_two = $slider_caption_two;
        $slider->display_status = $display_status;
        $slider->save();
        
        $display_message = $this->success_message("Home Page Slider Updated Successfully");
        
        return response()->json(['display_message' => $display_message]);
    }
    
    public function update_home_page_sliders_sorting(Request $request) {
        $input_list = [
            'data_order' => ['bail', 'required', 'array'],
            'data_id' => ['bail', 'required', 'array']
        ];

        $validation_list = [];

        Validator::make($request->all(), $input_list, $validation_list)->validate();
        
        $data_order = $request->input('data_order');
        $data_id = $request->input('data_id');
        
        foreach($data_order as $key => $order_number) {
            $id_number = $data_id[$key];
            
            $this->update_sorting_number('home_page_sliders', $order_number, $id_number);
        }
    }

    public function edit_home_page_video() {
        return view('admin.edit_home_page_video');
    }

    public function edit_home_page_video_details(Request $request) {
        $desktop_video = $request->file('desktop_video');
        $mobile_video = $request->file('mobile_video');

        $target_dir = "videos";
        
        if(!empty($desktop_video)) {
            $desktop_video = $this->upload_file($desktop_video, $target_dir, "desktop-home-banner");
        }

        if(!empty($mobile_video)) {
            $mobile_video = $this->upload_file($mobile_video, $target_dir, "mobile-home-banner");
        }

        $display_message = $this->success_message("Home Page Video Updated Successfully");
        
        return response()->json(['display_message' => $display_message]);
    }

    public function edit_home_page_about_us() {
        $about_us = 1;

        $about = \App\Models\HomePageAboutUs::find(1);

        return view('admin.edit_home_page_about_us', compact('about'));
    }

    public function edit_home_page_about_us_details(Request $request) {
        $input_list = [
            'home_page_about_us_title' => ['bail', 'required'],
            'home_page_about_us_description' => ['bail', 'required']
        ];

        $validation_list = [
            'home_page_about_us_title.required' => 'Please enter about us title',
            'home_page_about_us_description.required' => 'Please enter about us description'
        ];

        Validator::make($request->all(), $input_list, $validation_list)->validate();

        $about_us_id = $request->input('about_us_id');
        $home_page_about_us_image = $request->file('home_page_about_us_image');
        $home_page_about_us_title = $request->input('home_page_about_us_title');
        $home_page_about_us_description = $request->input('home_page_about_us_description');
        $about_us_content = $request->input('about_us_content');

        $target_dir = "images/home-page";
        
        if(!empty($home_page_about_us_image)) {
            $home_page_about_us_image = $this->upload_file($home_page_about_us_image, $target_dir);
        } else {
            $home_page_about_us_image = $this->get_present_value('home_page_about_us', $about_us_id, 'home_page_about_us_image');
        }

        $about = \App\Models\HomePageAboutUs::find(1);
        $about->home_page_about_us_image = $home_page_about_us_image;
        $about->home_page_about_us_title = $home_page_about_us_title;
        $about->home_page_about_us_description = $home_page_about_us_description;
        $about->about_us_content = $about_us_content;
        $about->save();

        $display_message = $this->success_message("Home Page About Us Updated Successfully");
        
        return response()->json(['display_message' => $display_message]);
    }

    public function manage_project_budgets() {
        $project_budgets = DB::table('project_budgets')->orderBy('project_budget_min_price')->get();
        
        return view('admin.manage_project_budgets', compact('project_budgets'));
    }
    
    public function add_project_budget() {
        return view('admin.add_project_budget');
    }
    
    public function add_project_budget_details(Request $request) {
        $input_list = [
            'project_budget_title' => ['bail', 'required', 'unique:project_budgets,project_budget_title'],
            'project_budget_min_price' => ['bail', 'required'],
            'project_budget_max_price' => ['bail', 'required']
        ];

        $validation_list = [
            'project_budget_title.required' => 'Please enter the budget title',
            'project_budget_title.unique' => 'This budget title already exists',
            'project_budget_min_price.image' => 'Please enter the budget range minimum price',
            'project_budget_max_price.image' => 'Please enter the budget range maximum price'
        ];

        Validator::make($request->all(), $input_list, $validation_list)->validate();
        
        $project_budget_title = $request->input('project_budget_title');
        $project_budget_min_price = $request->input('project_budget_min_price');
        $project_budget_max_price = $request->input('project_budget_max_price');
        $display_status = $request->input('display_status');
        
        $project_budget = new \App\Models\ProjectBudget;
        $project_budget->project_budget_title = $project_budget_title;
        $project_budget->project_budget_min_price = $project_budget_min_price;
        $project_budget->project_budget_max_price = $project_budget_max_price;
        $project_budget->display_status = $display_status;
        $project_budget->save();
        
        $display_message = $this->success_message("Project Budget Uploaded Successfully");
        
        return response()->json(['display_message' => $display_message]);
    }
    
    public function edit_project_budget($project_budget_id) {
        $project_budget = DB::table('project_budgets')->find($project_budget_id);
        
        return view('admin.edit_project_budget', compact('project_budget'));
    }
    
    public function edit_project_budget_details(Request $request) {
        $project_budget_id = $request->input('project_budget_id');

        $input_list = [
            'project_budget_title' => ['bail', 'required', "unique:project_budgets,project_budget_title,$project_budget_id"],
            'project_budget_min_price' => ['bail', 'required'],
            'project_budget_max_price' => ['bail', 'required']
        ];

        $validation_list = [
            'project_budget_title.required' => 'Please enter the budget title',
            'project_budget_title.unique' => 'This budget title already exists',
            'project_budget_min_price.image' => 'Please enter the budget range minimum price',
            'project_budget_max_price.image' => 'Please enter the budget range maximum price'
        ];

        Validator::make($request->all(), $input_list, $validation_list)->validate();
        
        $project_budget_title = $request->input('project_budget_title');
        $project_budget_min_price = $request->input('project_budget_min_price');
        $project_budget_max_price = $request->input('project_budget_max_price');
        $display_status = $request->input('display_status');
        
        $project_budget = \App\Models\ProjectBudget::find($project_budget_id);
        $project_budget->project_budget_title = $project_budget_title;
        $project_budget->project_budget_min_price = $project_budget_min_price;
        $project_budget->project_budget_max_price = $project_budget_max_price;
        $project_budget->display_status = $display_status;
        $project_budget->save();
        
        $display_message = $this->success_message("Project Budget Updated Successfully");
        
        return response()->json(['display_message' => $display_message]);
    }

    public function manage_project_locations() {
        $project_locations = DB::table('project_locations')->orderBy('project_location_title')->get();
        
        return view('admin.manage_project_locations', compact('project_locations'));
    }
    
    public function add_project_location() {
        return view('admin.add_project_location');
    }
    
    public function add_project_location_details(Request $request) {
        $input_list = [
            'project_location_title' => ['bail', 'required', 'unique:project_locations,project_location_title']
        ];

        $validation_list = [
            'project_location_title.required' => 'Please enter the location title',
            'project_location_title.unique' => 'This location title already exists'
        ];

        Validator::make($request->all(), $input_list, $validation_list)->validate();
        
        $project_location_title = $request->input('project_location_title');
        $display_status = $request->input('display_status');
        
        $project_location = new \App\Models\ProjectLocation;
        $project_location->project_location_title = $project_location_title;
        $project_location->display_status = $display_status;
        $project_location->save();
        
        $display_message = $this->success_message("Project Location Uploaded Successfully");
        
        return response()->json(['display_message' => $display_message]);
    }
    
    public function edit_project_location($project_location_id) {
        $project_location = DB::table('project_locations')->find($project_location_id);
        
        return view('admin.edit_project_location', compact('project_location'));
    }
    
    public function edit_project_location_details(Request $request) {
        $project_location_id = $request->input('project_location_id');

        $input_list = [
            'project_location_title' => ['bail', 'required', "unique:project_locations,project_location_title,$project_location_id"]
        ];

        $validation_list = [
            'project_location_title.required' => 'Please enter the location title',
            'project_location_title.unique' => 'This location title already exists'
        ];

        Validator::make($request->all(), $input_list, $validation_list)->validate();
        
        $project_location_title = $request->input('project_location_title');
        $display_status = $request->input('display_status');
        
        $project_location = \App\Models\ProjectLocation::find($project_location_id);
        $project_location->project_location_title = $project_location_title;
        $project_location->display_status = $display_status;
        $project_location->save();
        
        $display_message = $this->success_message("Project Location Updated Successfully");
        
        return response()->json(['display_message' => $display_message]);
    }

    public function manage_project_zones() {
        $project_zones = DB::table('project_zones')->orderBy('project_zone_title')->get();
        
        return view('admin.manage_project_zones', compact('project_zones'));
    }
    
    public function add_project_zone() {
        return view('admin.add_project_zone');
    }
    
    public function add_project_zone_details(Request $request) {
        $input_list = [
            'project_zone_title' => ['bail', 'required', 'unique:project_zones,project_zone_title']
        ];

        $validation_list = [
            'project_zone_title.required' => 'Please enter the zone title',
            'project_zone_title.unique' => 'This zone title already exists'
        ];

        Validator::make($request->all(), $input_list, $validation_list)->validate();
        
        $project_zone_title = $request->input('project_zone_title');
        $display_status = $request->input('display_status');
        
        $project_zone = new \App\Models\ProjectZone;
        $project_zone->project_zone_title = $project_zone_title;
        $project_zone->display_status = $display_status;
        $project_zone->save();
        
        $display_message = $this->success_message("Project Zone Uploaded Successfully");
        
        return response()->json(['display_message' => $display_message]);
    }
    
    public function edit_project_zone($project_zone_id) {
        $project_zone = DB::table('project_zones')->find($project_zone_id);
        
        return view('admin.edit_project_zone', compact('project_zone'));
    }
    
    public function edit_project_zone_details(Request $request) {
        $project_zone_id = $request->input('project_zone_id');

        $input_list = [
            'project_zone_title' => ['bail', 'required', "unique:project_zones,project_zone_title,$project_zone_id"]
        ];

        $validation_list = [
            'project_zone_title.required' => 'Please enter the zone title',
            'project_zone_title.unique' => 'This zone title already exists'
        ];

        Validator::make($request->all(), $input_list, $validation_list)->validate();
        
        $project_zone_title = $request->input('project_zone_title');
        $display_status = $request->input('display_status');
        
        $project_zone = \App\Models\ProjectZone::find($project_zone_id);
        $project_zone->project_zone_title = $project_zone_title;
        $project_zone->display_status = $display_status;
        $project_zone->save();
        
        $display_message = $this->success_message("Project Zone Updated Successfully");
        
        return response()->json(['display_message' => $display_message]);
    }

    public function manage_project_types() {
        $project_types = DB::table('project_types')->get();
        
        return view('admin.manage_project_types', compact('project_types'));
    }
    
    public function add_project_type() {
        return view('admin.add_project_type');
    }
    
    public function add_project_type_details(Request $request) {
        $input_list = [
            'project_type_title' => ['bail', 'required', 'unique:project_types,project_type_title']
        ];

        $validation_list = [
            'project_type_title.required' => 'Please enter the type title',
            'project_type_title.unique' => 'This type title already exists'
        ];

        Validator::make($request->all(), $input_list, $validation_list)->validate();
        
        $project_type_title = $request->input('project_type_title');
        $display_status = $request->input('display_status');
        
        $project_type = new \App\Models\ProjectType;
        $project_type->project_type_title = $project_type_title;
        $project_type->display_status = $display_status;
        $project_type->save();
        
        $display_message = $this->success_message("Project Type Uploaded Successfully");
        
        return response()->json(['display_message' => $display_message]);
    }
    
    public function edit_project_type($project_type_id) {
        $project_type = DB::table('project_types')->find($project_type_id);
        
        return view('admin.edit_project_type', compact('project_type'));
    }
    
    public function edit_project_type_details(Request $request) {
        $project_type_id = $request->input('project_type_id');

        $input_list = [
            'project_type_title' => ['bail', 'required', "unique:project_types,project_type_title,$project_type_id"]
        ];

        $validation_list = [
            'project_type_title.required' => 'Please enter the type title',
            'project_type_title.unique' => 'This type title already exists'
        ];

        Validator::make($request->all(), $input_list, $validation_list)->validate();
        
        $project_type_title = $request->input('project_type_title');
        $display_status = $request->input('display_status');
        
        $project_type = \App\Models\ProjectType::find($project_type_id);
        $project_type->project_type_title = $project_type_title;
        $project_type->display_status = $display_status;
        $project_type->save();
        
        $display_message = $this->success_message("Project Type Updated Successfully");
        
        return response()->json(['display_message' => $display_message]);
    }

    public function manage_project_categories() {
        $project_categories = DB::table('project_categories')->get();
        
        return view('admin.manage_project_categories', compact('project_categories'));
    }
    
    public function add_project_category() {
        return view('admin.add_project_category');
    }
    
    public function add_project_category_details(Request $request) {
        $input_list = [
            'project_category_title' => ['bail', 'required', 'unique:project_categories,project_category_title']
        ];

        $validation_list = [
            'project_category_title.required' => 'Please enter the category title',
            'project_category_title.unique' => 'This category title already exists'
        ];

        Validator::make($request->all(), $input_list, $validation_list)->validate();
        
        $project_category_title = $request->input('project_category_title');
        
        $project_category = new \App\Models\ProjectCategory;
        $project_category->project_category_title = $project_category_title;
        $project_category->save();
        
        $display_message = $this->success_message("Project Type Uploaded Successfully");
        
        return response()->json(['display_message' => $display_message]);
    }
    
    public function edit_project_category($project_category_id) {
        $project_category = DB::table('project_categories')->find($project_category_id);
        
        return view('admin.edit_project_category', compact('project_category'));
    }
    
    public function edit_project_category_details(Request $request) {
        $project_category_id = $request->input('project_category_id');

        $input_list = [
            'project_category_title' => ['bail', 'required', "unique:project_categories,project_category_title,$project_category_id"]
        ];

        $validation_list = [
            'project_category_title.required' => 'Please enter the category title',
            'project_category_title.unique' => 'This category title already exists'
        ];

        Validator::make($request->all(), $input_list, $validation_list)->validate();
        
        $project_category_title = $request->input('project_category_title');
        
        $project_category = \App\Models\ProjectCategory::find($project_category_id);
        $project_category->project_category_title = $project_category_title;
        $project_category->save();
        
        $display_message = $this->success_message("Project Type Updated Successfully");
        
        return response()->json(['display_message' => $display_message]);
    }

    public function manage_project_status() {
        $project_status = DB::table('project_statuses')->get();
        
        return view('admin.manage_project_status', compact('project_status'));
    }
    
    public function add_project_status() {
        return view('admin.add_project_status');
    }
    
    public function add_project_status_details(Request $request) {
        $input_list = [
            'project_status_title' => ['bail', 'required', 'unique:project_statuses,project_status_title']
        ];

        $validation_list = [
            'project_status_title.required' => 'Please enter the status title',
            'project_status_title.unique' => 'This status title already exists'
        ];

        Validator::make($request->all(), $input_list, $validation_list)->validate();
        
        $project_status_title = $request->input('project_status_title');
        $display_status = $request->input('display_status');
        
        $project_status = new \App\Models\ProjectStatus;
        $project_status->project_status_title = $project_status_title;
        $project_status->display_status = $display_status;
        $project_status->save();
        
        $display_message = $this->success_message("Project Status Uploaded Successfully");
        
        return response()->json(['display_message' => $display_message]);
    }
    
    public function edit_project_status($project_status_id) {
        $project_status = DB::table('project_statuses')->find($project_status_id);
        
        return view('admin.edit_project_status', compact('project_status'));
    }
    
    public function edit_project_status_details(Request $request) {
        $project_status_id = $request->input('project_status_id');

        $input_list = [
            'project_status_title' => ['bail', 'required', "unique:project_status,project_status_title,$project_status_id"]
        ];

        $validation_list = [
            'project_status_title.required' => 'Please enter the status title',
            'project_status_title.unique' => 'This status title already exists'
        ];

        Validator::make($request->all(), $input_list, $validation_list)->validate();
        
        $project_status_title = $request->input('project_status_title');
        $display_status = $request->input('display_status');
        
        $project_status = \App\Models\ProjectStatus::find($project_status_id);
        $project_status->project_status_title = $project_status_title;
        $project_status->display_status = $display_status;
        $project_status->save();
        
        $display_message = $this->success_message("Project Status Updated Successfully");
        
        return response()->json(['display_message' => $display_message]);
    }

    public function manage_projects() {
        $projects = DB::table('projects')->addSelect(['project_status_title' => DB::table('project_statuses')->select('project_status_title')->whereColumn('project_statuses.id', 'projects.project_status_id')])->orderBy('sorting_order')->get();
        
        return view('admin.manage_projects', compact('projects'));
    }
    
    public function add_project() {
        $project_categories = DB::table('project_categories')->orderBy('project_category_title')->get();

        $project_locations = DB::table('project_locations')->orderBy('project_location_title')->get();

        $project_zones = DB::table('project_zones')->orderBy('project_zone_title')->get();

        $project_types = DB::table('project_types')->get();

        $project_status = DB::table('project_statuses')->get();

        $project_budgets = DB::table('project_budgets')->orderBy('project_budget_min_price')->get();

        $project_gallery_categories = DB::table('project_gallery_categories')->orderBy('id')->get();

        $project_templates = DB::table('project_templates')->orderBy('id')->get();

        $projects = DB::table('projects')->select('id', 'project_name')->orderBy('project_name')->get();

        return view('admin.add_project', compact('project_locations', 'project_zones', 'project_types', 'project_status', 'project_budgets', 'project_categories', 'project_gallery_categories', 'project_templates', 'projects'));
    }
    
    public function add_project_details(Request $request) {
        $input_list = [
            'project_name' => ['bail', 'required', 'unique:projects,project_name'],
            'project_thumbnail' => ['bail', 'required', 'image', 'file'],
            'project_logo' => ['bail', 'required', 'image', 'file'],
            'project_category_id' => ['bail', 'required'],
            'project_type_id' => ['bail', 'required'],
            'project_zone_id' => ['bail', 'required'],
            'project_location_id' => ['bail', 'required'],
            'project_budget_id' => ['bail', 'required'],
            'project_price' => ['bail', 'required'],
            'project_status_id' => ['bail', 'required'],
            'project_about_image' => ['bail', 'image'],
            'project_form_image' => ['bail', 'image'],
            'project_brochure' => ['bail', 'mimes:pdf'],
            'project_configuration' => ['bail', 'mimes:pdf']
        ];

        $validation_list = [
            'project_name.required' => 'Please enter the project name',
            'project_name.unique' => 'This project name already exists',
            'project_thumbnail.required' => 'Please Select an Image to Upload',
            'project_thumbnail.image' => 'Please Select a Valid Image to Upload',
            'project_thumbnail.file' => 'Please try again.',
            'project_logo.required' => 'Please Select an Image to Upload',
            'project_logo.image' => 'Please Select a Valid Image to Upload',
            'project_logo.file' => 'Please try again.',
            'project_category_id.required' => 'Please select at least one project category',
            'project_type_id.required' => 'Please select the project type',
            'project_zone_id.required' => 'Please select the project zone',
            'project_location_id.required' => 'Please select the project location',
            'project_budget_id.required' => 'Please select the project budget',
            'project_price.required' => 'Please enter the project price',
            'project_status_id.required' => 'Please select the project status',
            'project_about_image.image' => 'Please select a valid image to upload',
            'project_form_image.image' => 'Please select a valid image to upload',
            'project_brochure.mimes' => 'Please select a valid PDF file to upload',
            'project_configuration.mimes' => 'Please select a valid PDF file to upload'
        ];

        Validator::make($request->all(), $input_list, $validation_list)->validate();
        
        $project_name = $request->input('project_name');
        $project_url_slug = Str::slug($project_name, '-');
        $project_template_id = $request->input('project_template_id');
        $project_thumbnail = $request->file('project_thumbnail');
        $project_accommodation_type = $request->input('project_accommodation_type');
        $project_location_text = $request->input('project_location_text');
        $project_logo = $request->file('project_logo');
        $project_category_ids = $request->input('project_category_id');
        $related_project_ids = $request->input('related_project_ids');
        $project_type_id = $request->input('project_type_id');
        $project_zone_id = $request->input('project_zone_id');
        $project_location_id = $request->input('project_location_id');
        $project_budget_id = $request->input('project_budget_id');
        $project_price = $request->input('project_price');
        $project_link = $request->input('project_link');
        $project_status_id = $request->input('project_status_id');
        $project_slider_images = $request->file('project_slider_images');
        $project_slider_image_mobiles = $request->file('project_slider_image_mobiles');
        $project_slider_captions = $request->input('project_slider_captions');
        $project_slider_descriptions = $request->input('project_slider_descriptions');
        $project_overview_title_one = $request->input('project_overview_title_one');
        $project_overview_value_one = $request->input('project_overview_value_one');
        $project_overview_title_two = $request->input('project_overview_title_two');
        $project_overview_value_two = $request->input('project_overview_value_two');
        $project_overview_title_three = $request->input('project_overview_title_three');
        $project_overview_value_three = $request->input('project_overview_value_three');
        $project_overview_title_four = $request->input('project_overview_title_four');
        $project_overview_value_four = $request->input('project_overview_value_four');
        $project_headline = $request->input('project_headline');
        $project_caption = $request->input('project_caption');
        $project_description = $request->input('project_description');
        $project_about_image = $request->file('project_about_image');
        $project_brochure = $request->file('project_brochure');
        $project_configuration = $request->file('project_configuration');
        $project_rera_numbers = $request->input('project_rera_numbers');
        $project_video_category_ids = $request->input('project_video_category_ids');
        $project_video_titles = $request->input('project_video_titles');
        $project_video_thumbnails = $request->file('project_video_thumbnails');
        $video_youtube_ids = $request->input('video_youtube_ids');
        $project_highlighted_amenity_titles = $request->input('project_highlighted_amenity_titles');
        $project_highlighted_amenity_images = $request->file('project_highlighted_amenity_images');
        $project_highlighted_amenity_descriptions = $request->input('project_highlighted_amenity_descriptions');
        $project_highlighted_amenity_illustrations = $request->file('project_highlighted_amenity_illustrations');
        $project_amenity_titles = $request->input('project_amenity_titles');
        $project_amenity_images = $request->file('project_amenity_images');
        $project_gallery_category_ids = $request->input('project_gallery_category_ids');
        $project_gallery_images = $request->file('project_gallery_images');
        $project_gallery_captions = $request->input('project_gallery_captions');
        $project_layout_titles = $request->input('project_layout_titles');
        $project_layout_types = $request->input('project_layout_types');
        $project_layout_images = $request->file('project_layout_images');
        $project_layout_area_title_ones = $request->input('project_layout_area_title_ones');
        $project_layout_area_value_ones = $request->input('project_layout_area_value_ones');
        $project_layout_area_title_twos = $request->input('project_layout_area_title_twos');
        $project_layout_area_value_twos = $request->input('project_layout_area_value_twos');
        $project_layout_area_title_threes = $request->input('project_layout_area_title_threes');
        $project_layout_area_value_threes = $request->input('project_layout_area_value_threes');
        $project_3d_walk = $request->input('project_3d_walk');
        $project_configuration_types = $request->input('project_configuration_types');
        $project_configuration_areas = $request->input('project_configuration_areas');
        $project_configuration_sold_outs = $request->input('project_configuration_sold_outs');
        $project_location_title = $request->input('project_location_title');
        $project_location_image = $request->file('project_location_image');
        $project_location_description = $request->input('project_location_description');
        $project_location_iframe = $request->input('project_location_iframe');
        $project_landmarks = $request->input('project_landmarks');
        $project_landmark_texts = $request->input('project_landmark_texts');
        $project_faq_questions = $request->input('project_faq_questions');
        $project_faq_answers = $request->input('project_faq_answers');
        $project_form_image = $request->file('project_form_image');
        $meta_title = $request->input('meta_title');
        $meta_description = $request->input('meta_description');
        $schema_code = $request->input('schema_code');
        $display_status = $request->input('display_status');
        $sorting_order = $this->get_last_sorting('projects');

        $target_dir = "pdfs";

        if(!empty($project_brochure)) {
            $project_brochure = $this->upload_file($project_brochure, $target_dir);
        } else {
            $project_brochure = "";
        }

        if(!empty($project_configuration)) {
            $project_configuration = $this->upload_file($project_configuration, $target_dir);
        } else {
            $project_configuration = "";
        }
        
        $target_dir = "images/projects";
        
        $project_thumbnail = $this->upload_file($project_thumbnail, $target_dir);
        $project_logo = $this->upload_file($project_logo, $target_dir);

        if(!empty($project_about_image)) {
            $project_about_image = $this->upload_file($project_about_image, $target_dir);
        } else {
            $project_about_image = "";
        }

        if(!empty($project_location_image)) {
            $project_location_image = $this->upload_file($project_location_image, $target_dir);
        } else {
            $project_location_image = "";
        }

        if(!empty($project_form_image)) {
            $project_form_image = $this->upload_file($project_form_image, $target_dir);
        } else {
            $project_form_image = "";
        }
        
        $project = new \App\Models\Project;
        $project->project_name = $project_name;
        $project->project_url_slug = $project_url_slug;
        $project->project_template_id = $project_template_id;
        $project->project_thumbnail = $project_thumbnail;
        $project->project_accommodation_type = $project_accommodation_type;
        $project->project_location_text = $project_location_text;
        $project->project_logo = $project_logo;
        $project->project_type_id = $project_type_id;
        $project->project_zone_id = $project_zone_id;
        $project->project_location_id = $project_location_id;
        $project->project_budget_id = $project_budget_id;
        $project->project_price = $project_price;
        $project->project_link = $project_link;
        $project->project_status_id = $project_status_id;
        $project->project_overview_title_one = $project_overview_title_one;
        $project->project_overview_value_one = $project_overview_value_one;
        $project->project_overview_title_two = $project_overview_title_two;
        $project->project_overview_value_two = $project_overview_value_two;
        $project->project_overview_title_three = $project_overview_title_three;
        $project->project_overview_value_three = $project_overview_value_three;
        $project->project_overview_title_four = $project_overview_title_four;
        $project->project_overview_value_four = $project_overview_value_four;
        $project->project_headline = $project_headline;
        $project->project_caption = $project_caption;
        $project->project_description = $project_description;
        $project->project_about_image = $project_about_image;
        $project->project_brochure = $project_brochure;
        $project->project_configuration = $project_configuration;
        $project->project_rera_numbers = $project_rera_numbers;
        $project->project_3d_walk = $project_3d_walk;
        $project->project_location_title = $project_location_title;
        $project->project_location_image = $project_location_image;
        $project->project_location_description = $project_location_description;
        $project->project_location_iframe = $project_location_iframe;
        $project->project_landmarks = $project_landmarks;
        $project->project_form_image = $project_form_image;
        $project->meta_title = $meta_title;
        $project->meta_description = $meta_description;
        $project->schema_code = $schema_code;
        $project->display_status = $display_status;
        $project->sorting_order = $sorting_order;
        $project->save();
        $project_id = $project->id;

        if(is_array($project_category_ids)) {
            foreach($project_category_ids as $project_category_id) {
                $project_category = new \App\Models\ProjectSelectedCategory;
                $project_category->project_id = $project_id;
                $project_category->project_category_id = $project_category_id;
                $project_category->display_status = 1;
                $project_category->save();
            }
        }

        if(is_array($related_project_ids)) {
            foreach($related_project_ids as $related_project_id) {
                $related_project = new \App\Models\RelatedProject;
                $related_project->project_id = $project_id;
                $related_project->related_project_id = $related_project_id;
                $related_project->display_status = 1;
                $related_project->save();
            }
        }

        if(is_array($project_slider_images)) {
            foreach($project_slider_images as $key => $project_slider_image) {
                $project_slider_caption = $project_slider_captions[$key];
                $project_slider_image_mobile = $project_slider_image_mobiles[$key];
                $project_slider_description = $project_slider_descriptions[$key];

                $project_slider_image = $this->upload_file($project_slider_image, $target_dir);
                $project_slider_image_mobile = $this->upload_file($project_slider_image_mobile, $target_dir);

                $project_slider = new \App\Models\ProjectSlider;
                $project_slider->project_id = $project_id;
                $project_slider->project_slider_image = $project_slider_image;
                $project_slider->project_slider_image_mobile = $project_slider_image_mobile;
                $project_slider->project_slider_caption = $project_slider_caption;
                $project_slider->project_slider_description = $project_slider_description;
                $project_slider->display_status = 1;
                $project_slider->sorting_order = $key + 1;
                $project_slider->save();
            }
        }

        if(is_array($video_youtube_ids)) {
            foreach($video_youtube_ids as $key => $video_youtube_id) {
                $project_video_title = $project_video_titles[$key];
                $project_video_category_id = $project_video_category_ids[$key];

                if(isset($project_video_thumbnails[$key])) {
                    $project_video_thumbnail = $project_video_thumbnails[$key];
                } else {
                    $project_video_thumbnail = "";
                }

                if(!empty($project_video_thumbnail)) {
                    $project_video_thumbnail = $this->upload_file($project_video_thumbnail, $target_dir);
                } else {
                    $project_video_thumbnail = "";
                }

                $project_video_slider = new \App\Models\ProjectVideoSlider;
                $project_video_slider->project_id = $project_id;
                $project_video_slider->project_video_category_id = $project_video_category_id;
                $project_video_slider->project_video_title = $project_video_title;
                $project_video_slider->project_video_thumbnail = $project_video_thumbnail;
                $project_video_slider->video_youtube_id = $video_youtube_id;
                $project_video_slider->display_status = 1;
                $project_video_slider->sorting_order = $key + 1;
                $project_video_slider->save();
            }
        }

        if(is_array($project_highlighted_amenity_titles)) {
            foreach($project_highlighted_amenity_titles as $key => $project_amenity_title) {
                $project_amenity_image = $project_highlighted_amenity_images[$key];
                $project_amenity_description = $project_highlighted_amenity_descriptions[$key];

                if(isset($project_highlighted_amenity_illustrations[$key])) {
                    $project_amenity_illustration = $project_highlighted_amenity_illustrations[$key];
                } else {
                    $project_amenity_illustration = "";
                }

                if(!empty($project_amenity_image)) {
                    $project_amenity_image = $this->upload_file($project_amenity_image, $target_dir);
                }

                if(!empty($project_amenity_illustration)) {
                    $project_amenity_illustration = $this->upload_file($project_amenity_illustration, $target_dir);
                } else {
                    $project_amenity_illustration = "";
                }

                $project_highlighted_amenity = new \App\Models\ProjectHighlightedAmenity;
                $project_highlighted_amenity->project_id = $project_id;
                $project_highlighted_amenity->project_amenity_title = $project_amenity_title;
                $project_highlighted_amenity->project_amenity_image = $project_amenity_image;
                $project_highlighted_amenity->project_amenity_illustration = $project_amenity_illustration;
                $project_highlighted_amenity->project_amenity_description = $project_amenity_description;
                $project_highlighted_amenity->display_status = 1;
                $project_highlighted_amenity->sorting_order = $key + 1;
                $project_highlighted_amenity->save();
            }
        }

        if(is_array($project_amenity_titles)) {
            foreach($project_amenity_titles as $key => $project_amenity_title) {
                $project_amenity_image = $project_amenity_images[$key];

                if(!empty($project_amenity_image)) {
                    $project_amenity_image = $this->upload_file($project_amenity_image, $target_dir);
                }

                $project_amenity = new \App\Models\ProjectAmenity;
                $project_amenity->project_id = $project_id;
                $project_amenity->project_amenity_title = $project_amenity_title;
                $project_amenity->project_amenity_image = $project_amenity_image;
                $project_amenity->display_status = 1;
                $project_amenity->sorting_order = $key + 1;
                $project_amenity->save();
            }
        }

        if(is_array($project_gallery_category_ids)) {
            foreach($project_gallery_category_ids as $key => $project_gallery_category_id) {
                $project_gallery_image = $project_gallery_images[$key];
                $project_gallery_caption = $project_gallery_captions[$key];

                if(!empty($project_gallery_image)) {
                    $project_gallery_image = $this->upload_file($project_gallery_image, $target_dir);

                    $project_gallery = new \App\Models\ProjectGallery;
                    $project_gallery->project_id = $project_id;
                    $project_gallery->project_gallery_category_id = $project_gallery_category_id;
                    $project_gallery->project_gallery_image = $project_gallery_image;
                    $project_gallery->project_gallery_caption = $project_gallery_caption;
                    $project_gallery->display_status = 1;
                    $project_gallery->sorting_order = $key + 1;
                    $project_gallery->save();
                }
            }
        }

        if(is_array($project_layout_titles)) {
            foreach($project_layout_titles as $key => $project_layout_title) {
                $project_layout_type = $project_layout_types[$key];
                $project_layout_image = $project_layout_images[$key];
                $project_layout_area_title_one = $project_layout_area_title_ones[$key];
                $project_layout_area_value_one = $project_layout_area_value_ones[$key];
                $project_layout_area_title_two = $project_layout_area_title_twos[$key];
                $project_layout_area_value_two = $project_layout_area_value_twos[$key];
                $project_layout_area_title_three = $project_layout_area_title_threes[$key];
                $project_layout_area_value_three = $project_layout_area_value_threes[$key];

                if(!empty($project_layout_image)) {
                    $project_layout_image = $this->upload_file($project_layout_image, $target_dir);

                    $project_plan = new \App\Models\ProjectPlan;
                    $project_plan->project_id = $project_id;
                    $project_plan->project_layout_title = $project_layout_title;
                    $project_plan->project_layout_type = $project_layout_type;
                    $project_plan->project_layout_image = $project_layout_image;
                    $project_plan->project_layout_area_title_one = $project_layout_area_title_one;
                    $project_plan->project_layout_area_value_one = $project_layout_area_value_one;
                    $project_plan->project_layout_area_title_two = $project_layout_area_title_two;
                    $project_plan->project_layout_area_value_two = $project_layout_area_value_two;
                    $project_plan->project_layout_area_title_three = $project_layout_area_title_three;
                    $project_plan->project_layout_area_value_three = $project_layout_area_value_three;
                    $project_plan->display_status = 1;
                    $project_plan->sorting_order = $key + 1;
                    $project_plan->save();
                }
            }
        }

        if(is_array($project_landmark_texts)) {
            foreach($project_landmark_texts as $key => $project_landmark_text) {
                $project_landmarks = new \App\Models\ProjectLandmark;
                $project_landmarks->project_id = $project_id;
                $project_landmarks->project_landmark_text = $project_landmark_text;
                $project_landmarks->display_status = 1;
                $project_landmarks->sorting_order = $key + 1;
                $project_landmarks->save();
            }
        }

        if(is_array($project_faq_questions)) {
            foreach($project_faq_questions as $key => $project_faq_question) {
                $project_faq_answer = $project_faq_answers[$key];

                $project_faq = new \App\Models\ProjectFaq;
                $project_faq->project_id = $project_id;
                $project_faq->project_faq_question = $project_faq_question;
                $project_faq->project_faq_answer = $project_faq_answer;
                $project_faq->display_status = 1;
                $project_faq->sorting_order = $key + 1;
                $project_faq->save();
            }
        }

        if(is_array($project_configuration_types)) {
            foreach($project_configuration_types as $key => $project_configuration_type) {
                $project_configuration_area = $project_configuration_areas[$key];
                $project_configuration_sold_out = $project_configuration_sold_outs[$key];

                $project_configuration = new \App\Models\ProjectConfiguration;
                $project_configuration->project_id = $project_id;
                $project_configuration->project_configuration_type = $project_configuration_type;
                $project_configuration->project_configuration_area = $project_configuration_area;
                $project_configuration->project_configuration_sold_out = $project_configuration_sold_out;
                $project_configuration->display_status = 1;
                $project_configuration->sorting_order = $key + 1;
                $project_configuration->save();
            }
        }
        
        $display_message = $this->success_message("Project Uploaded Successfully");
        
        return response()->json(['display_message' => $display_message]);
    }
    
    public function edit_project($project_id) {
        $project_categories = DB::table('project_categories')->orderBy('project_category_title')->get();

        $project_locations = DB::table('project_locations')->orderBy('project_location_title')->get();

        $project_zones = DB::table('project_zones')->orderBy('project_zone_title')->get();

        $project_types = DB::table('project_types')->get();

        $project_status = DB::table('project_statuses')->get();

        $project_budgets = DB::table('project_budgets')->orderBy('project_budget_min_price')->get();

        $project_selected_categories = DB::table('project_selected_categories')->where('display_status', 1)->where('project_id', $project_id)->get();

        $related_projects = DB::table('related_projects')->where('display_status', 1)->where('project_id', $project_id)->get();

        $project_category_ids = $related_project_ids = [];

        foreach($project_selected_categories as $project_selected_category_row) {
            $project_category_ids[] = $project_selected_category_row->project_category_id;
        }

        foreach($related_projects as $related_project_row) {
            $related_project_ids[] = $related_project_row->related_project_id;
        }

        $project_sliders = DB::table('project_sliders')->where('display_status', 1)->where('project_id', $project_id)->orderBy('sorting_order')->get();

        $project_faqs = DB::table('project_faqs')->where('display_status', 1)->where('project_id', $project_id)->orderBy('sorting_order')->get();

        $project_configurations = DB::table('project_configurations')->where('display_status', 1)->where('project_id', $project_id)->orderBy('sorting_order')->get();

        $project_video_sliders = DB::table('project_video_sliders')->where('display_status', 1)->where('project_id', $project_id)->orderBy('sorting_order')->get();

        $project_highlighted_amenities = DB::table('project_highlighted_amenities')->where('display_status', 1)->where('project_id', $project_id)->orderBy('sorting_order')->get();

        $project_amenities = DB::table('project_amenities')->where('display_status', 1)->where('project_id', $project_id)->orderBy('sorting_order')->get();

        $project_galleries = DB::table('project_galleries')->where('display_status', 1)->where('project_id', $project_id)->orderBy('sorting_order')->get();

        $project_gallery_categories = DB::table('project_gallery_categories')->orderBy('id')->get();

        $project_templates = DB::table('project_templates')->orderBy('id')->get();

        $project_plans = DB::table('project_plans')->where('display_status', 1)->where('project_id', $project_id)->orderBy('sorting_order')->get();

        $projects = DB::table('projects')->select('id', 'project_name')->where('id', '!=', $project_id)->orderBy('project_name')->get();

        $project = DB::table('projects')->find($project_id);
        
        return view('admin.edit_project', compact('project', 'project_locations', 'project_zones', 'project_types', 'project_status', 'project_budgets', 'project_categories', 'project_category_ids', 'project_sliders', 'project_video_sliders', 'project_highlighted_amenities', 'project_amenities', 'project_gallery_categories', 'project_galleries', 'project_templates', 'project_faqs', 'project_configurations', 'project_plans', 'projects', 'related_project_ids'));
    }
    
    public function edit_project_details(Request $request) {
        $project_id = $request->input('project_id');

        $input_list = [
            'project_name' => ['bail', 'required', "unique:projects,project_name,$project_id"],
            'project_thumbnail' => ['bail', 'image', 'file'],
            'project_logo' => ['bail', 'image', 'file'],
            'project_category_id' => ['bail', 'required'],
            'project_type_id' => ['bail', 'required'],
            'project_zone_id' => ['bail', 'required'],
            'project_location_id' => ['bail', 'required'],
            'project_budget_id' => ['bail', 'required'],
            'project_price' => ['bail', 'required'],
            'project_status_id' => ['bail', 'required'],
            'project_about_image' => ['bail', 'image'],
            'project_form_image' => ['bail', 'image'],
            'project_brochure' => ['bail', 'mimes:pdf'],
            'project_configuration' => ['bail', 'mimes:pdf']
        ];

        $validation_list = [
            'project_name.required' => 'Please enter the project name',
            'project_name.unique' => 'This project name already exists',
            'project_thumbnail.image' => 'Please Select a Valid Image to Upload',
            'project_thumbnail.file' => 'Please try again.',
            'project_logo.image' => 'Please Select a Valid Image to Upload',
            'project_logo.file' => 'Please try again.',
            'project_category_id.required' => 'Please select at least one project category',
            'project_type_id.required' => 'Please select the project type',
            'project_zone_id.required' => 'Please select the project zone',
            'project_location_id.required' => 'Please select the project location',
            'project_budget_id.required' => 'Please select the project budget',
            'project_price.required' => 'Please enter the project price',
            'project_status_id.required' => 'Please select the project status',
            'project_about_image.image' => 'Please select a valid image to upload',
            'project_form_image.image' => 'Please select a valid image to upload',
            'project_brochure.mimes' => 'Please select a valid PDF file to upload',
            'project_configuration.mimes' => 'Please select a valid PDF file to upload'
        ];

        Validator::make($request->all(), $input_list, $validation_list)->validate();
        
        $project_name = $request->input('project_name');
        $project_url_slug = Str::slug($project_name, '-');
        $project_template_id = $request->input('project_template_id');
        $project_thumbnail = $request->file('project_thumbnail');
        $project_accommodation_type = $request->input('project_accommodation_type');
        $project_location_text = $request->input('project_location_text');
        $project_logo = $request->file('project_logo');
        $project_category_ids = $request->input('project_category_id');
        $related_project_ids = $request->input('related_project_ids');
        $project_type_id = $request->input('project_type_id');
        $project_zone_id = $request->input('project_zone_id');
        $project_location_id = $request->input('project_location_id');
        $project_budget_id = $request->input('project_budget_id');
        $project_price = $request->input('project_price');
        $project_link = $request->input('project_link');
        $project_status_id = $request->input('project_status_id');
        $project_slider_ids = $request->input('project_slider_ids');
        $project_slider_images = $request->file('project_slider_images');
        $project_slider_image_mobiles = $request->file('project_slider_image_mobiles');
        $project_slider_captions = $request->input('project_slider_captions');
        $project_slider_descriptions = $request->input('project_slider_descriptions');
        $project_overview_title_one = $request->input('project_overview_title_one');
        $project_overview_value_one = $request->input('project_overview_value_one');
        $project_overview_title_two = $request->input('project_overview_title_two');
        $project_overview_value_two = $request->input('project_overview_value_two');
        $project_overview_title_three = $request->input('project_overview_title_three');
        $project_overview_value_three = $request->input('project_overview_value_three');
        $project_overview_title_four = $request->input('project_overview_title_four');
        $project_overview_value_four = $request->input('project_overview_value_four');
        $project_headline = $request->input('project_headline');
        $project_caption = $request->input('project_caption');
        $project_description = $request->input('project_description');
        $project_about_image = $request->file('project_about_image');
        $project_brochure = $request->file('project_brochure');
        $project_configuration = $request->file('project_configuration');
        $project_rera_numbers = $request->input('project_rera_numbers');
        $project_video_slider_ids = $request->input('project_video_slider_ids');
        $project_video_category_ids = $request->input('project_video_category_ids');
        $project_video_titles = $request->input('project_video_titles');
        $project_video_thumbnails = $request->file('project_video_thumbnails');
        $video_youtube_ids = $request->input('video_youtube_ids');
        $project_highlighted_amenity_ids = $request->input('project_highlighted_amenity_ids');
        $project_highlighted_amenity_titles = $request->input('project_highlighted_amenity_titles');
        $project_highlighted_amenity_images = $request->file('project_highlighted_amenity_images');
        $project_highlighted_amenity_descriptions = $request->input('project_highlighted_amenity_descriptions');
        $project_highlighted_amenity_illustrations = $request->file('project_highlighted_amenity_illustrations');
        $project_amenity_ids = $request->input('project_amenity_ids');
        $project_amenity_titles = $request->input('project_amenity_titles');
        $project_amenity_images = $request->file('project_amenity_images');
        $project_gallery_image_ids = $request->input('project_gallery_image_ids');
        $project_gallery_category_ids = $request->input('project_gallery_category_ids');
        $project_gallery_images = $request->file('project_gallery_images');
        $project_gallery_captions = $request->input('project_gallery_captions');
        $project_plan_ids = $request->input('project_plan_ids');
        $project_layout_titles = $request->input('project_layout_titles');
        $project_layout_types = $request->input('project_layout_types');
        $project_layout_images = $request->file('project_layout_images');
        $project_layout_area_title_ones = $request->input('project_layout_area_title_ones');
        $project_layout_area_value_ones = $request->input('project_layout_area_value_ones');
        $project_layout_area_title_twos = $request->input('project_layout_area_title_twos');
        $project_layout_area_value_twos = $request->input('project_layout_area_value_twos');
        $project_layout_area_title_threes = $request->input('project_layout_area_title_threes');
        $project_layout_area_value_threes = $request->input('project_layout_area_value_threes');
        $project_3d_walk = $request->input('project_3d_walk');
        $project_configuration_ids = $request->input('project_configuration_ids');
        $project_configuration_types = $request->input('project_configuration_types');
        $project_configuration_areas = $request->input('project_configuration_areas');
        $project_configuration_sold_outs = $request->input('project_configuration_sold_outs');
        $project_location_title = $request->input('project_location_title');
        $project_location_image = $request->file('project_location_image');
        $project_location_description = $request->input('project_location_description');
        $project_location_iframe = $request->input('project_location_iframe');
        $project_landmarks = $request->input('project_landmarks');
        $project_landmark_ids = $request->input('project_landmark_ids');
        $project_landmark_texts = $request->input('project_landmark_texts');
        $project_faq_ids = $request->input('project_faq_ids');
        $project_faq_questions = $request->input('project_faq_questions');
        $project_faq_answers = $request->input('project_faq_answers');
        $project_form_image = $request->file('project_form_image');
        $meta_title = $request->input('meta_title');
        $meta_description = $request->input('meta_description');
        $schema_code = $request->input('schema_code');
        $display_status = $request->input('display_status');

        $target_dir = "pdfs";

        if(!empty($project_brochure)) {
            $project_brochure = $this->upload_file($project_brochure, $target_dir);
        } else {
            $project_brochure = $this->get_present_value('projects', $project_id, 'project_brochure');            
        }
        
        if(!empty($project_configuration)) {
            $project_configuration = $this->upload_file($project_configuration, $target_dir);
        } else {
            $project_configuration = $this->get_present_value('projects', $project_id, 'project_configuration');            
        }
        
        $target_dir = "images/projects";
        
        if(!empty($project_thumbnail)) {
            $project_thumbnail = $this->upload_file($project_thumbnail, $target_dir);
        } else {
            $project_thumbnail = $this->get_present_value('projects', $project_id, 'project_thumbnail');            
        }

        if(!empty($project_logo)) {
            $project_logo = $this->upload_file($project_logo, $target_dir);
        } else {
            $project_logo = $this->get_present_value('projects', $project_id, 'project_logo');            
        }

        if(!empty($project_about_image)) {
            $project_about_image = $this->upload_file($project_about_image, $target_dir);
        } else {
            $project_about_image = $this->get_present_value('projects', $project_id, 'project_about_image');            
        }

        if(!empty($project_location_image)) {
            $project_location_image = $this->upload_file($project_location_image, $target_dir);
        } else {
            $project_location_image = $this->get_present_value('projects', $project_id, 'project_location_image');            
        }

        if(!empty($project_form_image)) {
            $project_form_image = $this->upload_file($project_form_image, $target_dir);
        } else {
            $project_form_image = $this->get_present_value('projects', $project_id, 'project_form_image');            
        }
        
        $project = \App\Models\Project::find($project_id);
        $project->project_name = $project_name;
        $project->project_url_slug = $project_url_slug;
        $project->project_template_id = $project_template_id;
        $project->project_thumbnail = $project_thumbnail;
        $project->project_accommodation_type = $project_accommodation_type;
        $project->project_location_text = $project_location_text;
        $project->project_logo = $project_logo;
        $project->project_type_id = $project_type_id;
        $project->project_zone_id = $project_zone_id;
        $project->project_location_id = $project_location_id;
        $project->project_budget_id = $project_budget_id;
        $project->project_price = $project_price;
        $project->project_link = $project_link;
        $project->project_status_id = $project_status_id;
        $project->project_overview_title_one = $project_overview_title_one;
        $project->project_overview_value_one = $project_overview_value_one;
        $project->project_overview_title_two = $project_overview_title_two;
        $project->project_overview_value_two = $project_overview_value_two;
        $project->project_overview_title_three = $project_overview_title_three;
        $project->project_overview_value_three = $project_overview_value_three;
        $project->project_overview_title_four = $project_overview_title_four;
        $project->project_overview_value_four = $project_overview_value_four;
        $project->project_headline = $project_headline;
        $project->project_caption = $project_caption;
        $project->project_description = $project_description;
        $project->project_about_image = $project_about_image;
        $project->project_brochure = $project_brochure;
        $project->project_configuration = $project_configuration;
        $project->project_rera_numbers = $project_rera_numbers;
        $project->project_3d_walk = $project_3d_walk;
        $project->project_location_title = $project_location_title;
        $project->project_location_image = $project_location_image;
        $project->project_location_description = $project_location_description;
        $project->project_location_iframe = $project_location_iframe;
        $project->project_landmarks = $project_landmarks;
        $project->project_form_image = $project_form_image;
        $project->meta_title = $meta_title;
        $project->meta_description = $meta_description;
        $project->schema_code = $schema_code;
        $project->display_status = $display_status;
        $project->save();

        if(empty($project_category_ids)) {
            $project_category_ids = array();
        }

        $project_selected_categories = DB::table('project_selected_categories')->where('display_status', 1)->where('project_id', $project_id)->get();

        $project_category_current_ids = [];

        foreach($project_selected_categories as $project_selected_category_row) {
            $project_category_current_ids[] = $project_selected_category_row->project_category_id;
        }

        $deleted_project_category_ids = array_diff($project_category_current_ids, $project_category_ids);

        if(is_array($deleted_project_category_ids)) {
            foreach($deleted_project_category_ids as $key => $project_category_id) {
                $data = ['display_status' => 0];
        
                DB::table('project_selected_categories')->where('project_category_id', $project_category_id)->where('project_id', $project_id)->update($data);
            }
        }

        $common_project_category_ids = array_intersect($project_category_ids, $project_category_current_ids);

        if(is_array($common_project_category_ids)) {
            foreach($common_project_category_ids as $key => $project_category_id) {
                unset($project_category_ids[$key]);
            }
        }

        $project_category_ids = array_values($project_category_ids);

        if(is_array($project_category_ids)) {
            foreach($project_category_ids as $project_category_id) {
                $project_category_id_exist = DB::table('project_selected_categories')->where('project_category_id', $project_category_id)->where('project_id', $project_id)->get()->count();
                
                if(empty($project_category_id_exist)) {
                    $project_category = new \App\Models\ProjectSelectedCategory;
                    $project_category->project_id = $project_id;
                    $project_category->project_category_id = $project_category_id;
                    $project_category->display_status = 1;
                    $project_category->save();
                } else {
                    $data = ['display_status' => 1];
        
                    DB::table('project_selected_categories')
                    ->where('project_category_id', $project_category_id)
                    ->where('project_id', $project_id)
                    ->update($data);
                }
            }
        }

        $data = ['display_status' => 0];

        DB::table('project_sliders')->where('project_id', $project_id)->update($data);
        DB::table('project_video_sliders')->where('project_id', $project_id)->update($data);
        DB::table('project_highlighted_amenities')->where('project_id', $project_id)->update($data);
        DB::table('project_amenities')->where('project_id', $project_id)->update($data);
        DB::table('project_galleries')->where('project_id', $project_id)->update($data);
        DB::table('project_plans')->where('project_id', $project_id)->update($data);
        DB::table('project_landmarks')->where('project_id', $project_id)->update($data);
        DB::table('project_faqs')->where('project_id', $project_id)->update($data);
        DB::table('project_configurations')->where('project_id', $project_id)->update($data);
        DB::table('related_projects')->where('project_id', $project_id)->update($data);

        if(is_array($related_project_ids)) {
            foreach($related_project_ids as $related_project_id) {
                $related_project_exist = DB::table('related_projects')->where('project_id', $project_id)->where('related_project_id', $related_project_id)->first();

                if(empty($related_project_exist)) {
                    $related_project = new \App\Models\RelatedProject;
                } else {
                    $related_project = \App\Models\RelatedProject::find($related_project_exist->id);
                }

                $related_project->project_id = $project_id;
                $related_project->related_project_id = $related_project_id;
                $related_project->display_status = 1;
                $related_project->save();
            }
        }

        if(is_array($project_slider_ids)) {
            foreach($project_slider_ids as $key => $project_slider_id) {
                $project_slider_caption = $project_slider_captions[$key];
                $project_slider_description = $project_slider_descriptions[$key];

                if(isset($project_slider_images[$key])) {
                    $project_slider_image = $project_slider_images[$key];

                    $project_slider_image = $this->upload_file($project_slider_image, $target_dir);
                } else {
                    $project_slider_image = $this->get_present_value('project_sliders', $project_slider_id, 'project_slider_image');
                }

                if(isset($project_slider_image_mobiles[$key])) {
                    $project_slider_image_mobile = $project_slider_image_mobiles[$key];

                    $project_slider_image_mobile = $this->upload_file($project_slider_image_mobile, $target_dir);
                } else {
                    $project_slider_image_mobile = $this->get_present_value('project_sliders', $project_slider_id, 'project_slider_image_mobile');
                }

                if(!empty($project_slider_id)) {
                    $project_slider = \App\Models\ProjectSlider::find($project_slider_id);
                } else {
                    $project_slider = new \App\Models\ProjectSlider;
                }
                
                $project_slider->project_id = $project_id;
                $project_slider->project_slider_image = $project_slider_image;
                $project_slider->project_slider_image_mobile = $project_slider_image_mobile;
                $project_slider->project_slider_caption = $project_slider_caption;
                $project_slider->project_slider_description = $project_slider_description;
                $project_slider->display_status = 1;
                $project_slider->sorting_order = $key + 1;
                $project_slider->save();
            }
        }

        if(is_array($video_youtube_ids)) {
            foreach($video_youtube_ids as $key => $video_youtube_id) {
                $project_video_slider_id = $project_video_slider_ids[$key];
                $project_video_title = $project_video_titles[$key];
                $project_video_category_id = $project_video_category_ids[$key];

                if(isset($project_video_thumbnails[$key])) {
                    $project_video_thumbnail = $project_video_thumbnails[$key];
                } else {
                    $project_video_thumbnail = "";
                }

                if(!empty($project_video_thumbnail)) {
                    $project_video_thumbnail = $this->upload_file($project_video_thumbnail, $target_dir);
                } else if(!empty($project_video_slider_id)) {
                    $project_video_thumbnail = $this->get_present_value('project_video_sliders', $project_video_slider_id, 'project_video_thumbnail');
                } else {
                    $project_video_thumbnail = "";
                }

                if(!empty($project_video_slider_id)) {
                    $project_video_slider = \App\Models\ProjectVideoSlider::find($project_video_slider_id);
                } else {
                    $project_video_slider = new \App\Models\ProjectVideoSlider;
                }
                
                $project_video_slider->project_id = $project_id;
                $project_video_slider->project_video_category_id = $project_video_category_id;
                $project_video_slider->project_video_title = $project_video_title;
                $project_video_slider->project_video_thumbnail = $project_video_thumbnail;
                $project_video_slider->video_youtube_id = $video_youtube_id;
                $project_video_slider->display_status = 1;
                $project_video_slider->sorting_order = $key + 1;
                $project_video_slider->save();
            }
        }

        if(is_array($project_highlighted_amenity_titles)) {
            foreach($project_highlighted_amenity_titles as $key => $project_amenity_title) {
                $project_highlighted_amenity_id = $project_highlighted_amenity_ids[$key];

                if(isset($project_highlighted_amenity_images[$key])) {
                    $project_amenity_image = $project_highlighted_amenity_images[$key];
                } else {
                    $project_amenity_image = "";
                }

                if(isset($project_highlighted_amenity_illustrations[$key])) {
                    $project_amenity_illustration = $project_highlighted_amenity_illustrations[$key];
                } else {
                    $project_amenity_illustration = "";
                }
                
                $project_amenity_description = $project_highlighted_amenity_descriptions[$key];

                if(!empty($project_amenity_image)) {
                    $project_amenity_image = $this->upload_file($project_amenity_image, $target_dir);
                } else {
                    $project_amenity_image = $this->get_present_value('project_highlighted_amenities', $project_highlighted_amenity_id, 'project_amenity_image');
                }

                if(!empty($project_amenity_illustration)) {
                    $project_amenity_illustration = $this->upload_file($project_amenity_illustration, $target_dir);
                } else if(!empty($project_highlighted_amenity_id)) {
                    $project_amenity_illustration = $this->get_present_value('project_highlighted_amenities', $project_highlighted_amenity_id, 'project_amenity_illustration');
                } else {
                    $project_amenity_illustration = "";
                }

                if(!empty($project_highlighted_amenity_id)) {
                    $project_highlighted_amenity = \App\Models\ProjectHighlightedAmenity::find($project_highlighted_amenity_id);
                } else {
                    $project_highlighted_amenity = new \App\Models\ProjectHighlightedAmenity;
                }
                
                $project_highlighted_amenity->project_id = $project_id;
                $project_highlighted_amenity->project_amenity_title = $project_amenity_title;
                $project_highlighted_amenity->project_amenity_image = $project_amenity_image;
                $project_highlighted_amenity->project_amenity_description = $project_amenity_description;
                $project_highlighted_amenity->project_amenity_illustration = $project_amenity_illustration;
                $project_highlighted_amenity->display_status = 1;
                $project_highlighted_amenity->sorting_order = $key + 1;
                $project_highlighted_amenity->save();
            }
        }

        if(is_array($project_amenity_titles)) {
            foreach($project_amenity_titles as $key => $project_amenity_title) {
                $project_amenity_id = $project_amenity_ids[$key];

                if(isset($project_amenity_images[$key])) {
                    $project_amenity_image = $project_amenity_images[$key];
                } else {
                    $project_amenity_image = "";
                }

                if(!empty($project_amenity_image)) {
                    $project_amenity_image = $this->upload_file($project_amenity_image, $target_dir);
                } else {
                    $project_amenity_image = $this->get_present_value('project_amenities', $project_amenity_id, 'project_amenity_image');
                }

                if(!empty($project_amenity_id)) {
                    $project_amenity = \App\Models\ProjectAmenity::find($project_amenity_id);
                } else {
                    $project_amenity = new \App\Models\ProjectAmenity;
                }
                
                $project_amenity->project_id = $project_id;
                $project_amenity->project_amenity_title = $project_amenity_title;
                $project_amenity->project_amenity_image = $project_amenity_image;
                $project_amenity->display_status = 1;
                $project_amenity->sorting_order = $key + 1;
                $project_amenity->save();
            }
        }


        if(is_array($project_gallery_category_ids)) {
            foreach($project_gallery_category_ids as $key => $project_gallery_category_id) {
                $project_gallery_image_id = $project_gallery_image_ids[$key];

                if(isset($project_gallery_images[$key])) {
                    $project_gallery_image = $project_gallery_images[$key];
                } else {
                    $project_gallery_image = "";
                }
                
                $project_gallery_caption = $project_gallery_captions[$key];

                if(!empty($project_gallery_image)) {
                    $project_gallery_image = $this->upload_file($project_gallery_image, $target_dir);
                } else {
                    $project_gallery_image = $this->get_present_value('project_galleries', $project_gallery_image_id, 'project_gallery_image');
                }

                if(!empty($project_gallery_image_id)) {
                    $project_gallery = \App\Models\ProjectGallery::find($project_gallery_image_id);
                } else {
                    $project_gallery = new \App\Models\ProjectGallery;
                }
                
                $project_gallery->project_id = $project_id;
                $project_gallery->project_gallery_category_id = $project_gallery_category_id;
                $project_gallery->project_gallery_image = $project_gallery_image;
                $project_gallery->project_gallery_caption = $project_gallery_caption;
                $project_gallery->display_status = 1;
                $project_gallery->sorting_order = $key + 1;
                $project_gallery->save();
            }
        }

        if(is_array($project_layout_titles)) {
            foreach($project_layout_titles as $key => $project_layout_title) {
                $project_plan_id = $project_plan_ids[$key];
                $project_layout_type = $project_layout_types[$key];
                $project_layout_area_title_one = $project_layout_area_title_ones[$key];
                $project_layout_area_value_one = $project_layout_area_value_ones[$key];
                $project_layout_area_title_two = $project_layout_area_title_twos[$key];
                $project_layout_area_value_two = $project_layout_area_value_twos[$key];
                $project_layout_area_title_three = $project_layout_area_title_threes[$key];
                $project_layout_area_value_three = $project_layout_area_value_threes[$key];

                if(isset($project_layout_images[$key])) {
                    $project_layout_image = $project_layout_images[$key];
                } else {
                    $project_layout_image = "";
                }

                if(!empty($project_layout_image)) {
                    $project_layout_image = $this->upload_file($project_layout_image, $target_dir);
                } else {
                    $project_layout_image = $this->get_present_value('project_plans', $project_plan_id, 'project_layout_image');
                }

                if(!empty($project_plan_id)) {
                    $project_plan = \App\Models\ProjectPlan::find($project_plan_id);
                } else {
                    $project_plan = new \App\Models\ProjectPlan;
                }
                
                $project_plan->project_id = $project_id;
                $project_plan->project_layout_title = $project_layout_title;
                $project_plan->project_layout_type = $project_layout_type;
                $project_plan->project_layout_image = $project_layout_image;
                $project_plan->project_layout_area_title_one = $project_layout_area_title_one;
                $project_plan->project_layout_area_value_one = $project_layout_area_value_one;
                $project_plan->project_layout_area_title_two = $project_layout_area_title_two;
                $project_plan->project_layout_area_value_two = $project_layout_area_value_two;
                $project_plan->project_layout_area_title_three = $project_layout_area_title_three;
                $project_plan->project_layout_area_value_three = $project_layout_area_value_three;
                $project_plan->display_status = 1;
                $project_plan->sorting_order = $key + 1;
                $project_plan->save();
            }
        }

        if(is_array($project_landmark_texts)) {
            foreach($project_landmark_texts as $key => $project_landmark_text) {
                $project_landmark_id = $project_landmark_ids[$key];

                if(!empty($project_landmark_id)) {
                    $project_landmarks = \App\Models\ProjectLandmark::find($project_landmark_id);
                } else {
                    $project_landmarks = new \App\Models\ProjectLandmark;
                }
                
                $project_landmarks->project_id = $project_id;
                $project_landmarks->project_landmark_text = $project_landmark_text;
                $project_landmarks->display_status = 1;
                $project_landmarks->sorting_order = $key + 1;
                $project_landmarks->save();
            }
        }

        if(is_array($project_faq_questions)) {
            foreach($project_faq_questions as $key => $project_faq_question) {
                $project_faq_id = $project_faq_ids[$key];
                $project_faq_answer = $project_faq_answers[$key];

                if(!empty($project_faq_id)) {
                    $project_faq = \App\Models\ProjectFaq::find($project_faq_id);
                } else {
                    $project_faq = new \App\Models\ProjectFaq;
                }
                
                $project_faq->project_id = $project_id;
                $project_faq->project_faq_question = $project_faq_question;
                $project_faq->project_faq_answer = $project_faq_answer;
                $project_faq->display_status = 1;
                $project_faq->sorting_order = $key + 1;
                $project_faq->save();
            }
        }

        if(is_array($project_configuration_types)) {
            foreach($project_configuration_types as $key => $project_configuration_type) {
                $project_configuration_id = $project_configuration_ids[$key];
                $project_configuration_area = $project_configuration_areas[$key];
                $project_configuration_sold_out = $project_configuration_sold_outs[$key];

                if(!empty($project_configuration_id)) {
                    $project_configuration = \App\Models\ProjectConfiguration::find($project_configuration_id);
                } else {
                    $project_configuration = new \App\Models\ProjectConfiguration;
                }
                
                $project_configuration->project_id = $project_id;
                $project_configuration->project_configuration_type = $project_configuration_type;
                $project_configuration->project_configuration_area = $project_configuration_area;
                $project_configuration->project_configuration_sold_out = $project_configuration_sold_out;
                $project_configuration->display_status = 1;
                $project_configuration->sorting_order = $key + 1;
                $project_configuration->save();
            }
        }
        
        $display_message = "Project Updated Successfully";
        
        return response()->json(['display_message' => $display_message]);
    }
    
    public function update_projects_sorting(Request $request) {
        $input_list = [
            'data_order' => ['bail', 'required', 'array'],
            'data_id' => ['bail', 'required', 'array']
        ];

        $validation_list = [];

        Validator::make($request->all(), $input_list, $validation_list)->validate();
        
        $data_order = $request->input('data_order');
        $data_id = $request->input('data_id');
        
        foreach($data_order as $key => $order_number) {
            $id_number = $data_id[$key];
            
            $this->update_sorting_number('projects', $order_number, $id_number);
        }
    }

    public function manage_enquiries() {
        $enquiries = DB::table('enquiries')
        ->addSelect(['enquiry_project_name' => DB::table('projects')
            ->select('project_name')
            ->whereColumn('projects.id', 'enquiries.enquiry_project_id')])
        ->orderBy('created_at', 'desc')
        ->limit(1000)
        ->get();

        return view('admin.manage_enquiries', compact('enquiries'));
    }

    public function export_enquiries() {
        return Excel::download(new \App\Exports\Enquiries, 'EnquiriesExport-'.time().'.xlsx');
    }

    public function manage_contact_enquiries() {
        $enquiries = DB::table('contact_enquiries')->orderBy('created_at', 'desc')->get();

        return view('admin.manage_contact_enquiries', compact('enquiries'));
    }

    public function export_contact_enquiries() {
        return Excel::download(new \App\Exports\ContactEnquiries, 'ContactEnquiriesExport-'.time().'.xlsx');
    }

    public function manage_media_kit_enquiries() {
        $enquiries = DB::table('media_kit_enquiries')->orderBy('created_at', 'desc')->get();

        return view('admin.manage_media_kit_enquiries', compact('enquiries'));
    }

    public function export_media_kit_enquiries() {
        return Excel::download(new \App\Exports\MediaKitEnquiries, 'MediaKitEnquiriesExport-'.time().'.xlsx');
    }

    public function manage_timelines() {
        $timelines = DB::table('timelines')->orderBy('timeline_year')->get();
        
        return view('admin.manage_timelines', compact('timelines'));
    }
    
    public function add_timeline() {
        return view('admin.add_timeline');
    }
    
    public function add_timeline_details(Request $request) {
        $input_list = [
            'timeline_year' => ['bail', 'required', 'unique:timelines,timeline_year'],
            'timeline_thumbnail' => ['bail', 'required', 'image', 'file'],
            'timeline_description' => ['bail', 'required']
        ];

        $validation_list = [
            'timeline_year.required' => 'Please enter the timeline year',
            'timeline_year.unique' => 'This timeline year already exists',
            'timeline_thumbnail.required' => 'Please Select an Image to Upload',
            'timeline_thumbnail.image' => 'Please Select a Valid Image to Upload',
            'timeline_thumbnail.file' => 'Please try again.',
            'timeline_description.required' => 'Please select the timeline description'
        ];

        Validator::make($request->all(), $input_list, $validation_list)->validate();
        
        $timeline_year = $request->input('timeline_year');
        $timeline_thumbnail = $request->file('timeline_thumbnail');
        $timeline_description = $request->input('timeline_description');
        $display_status = $request->input('display_status');
        
        $target_dir = "images/timelines";
        
        $timeline_thumbnail = $this->upload_file($timeline_thumbnail, $target_dir);
        
        $timeline = new \App\Models\Timeline;
        $timeline->timeline_year = $timeline_year;
        $timeline->timeline_thumbnail = $timeline_thumbnail;
        $timeline->timeline_description = $timeline_description;
        $timeline->display_status = $display_status;
        $timeline->save();
        
        $display_message = $this->success_message("Timeline Uploaded Successfully");
        
        return response()->json(['display_message' => $display_message]);
    }
    
    public function edit_timeline($timeline_id) {
        $timeline = DB::table('timelines')->find($timeline_id);
        
        return view('admin.edit_timeline', compact('timeline'));
    }
    
    public function edit_timeline_details(Request $request) {
        $timeline_id = $request->input('timeline_id');

        $input_list = [
            'timeline_year' => ['bail', 'required', "unique:timelines,timeline_year,$timeline_id"],
            'timeline_thumbnail' => ['bail', 'image', 'file'],
            'timeline_description' => ['bail', 'required']
        ];

        $validation_list = [
            'timeline_year.required' => 'Please enter the timeline name',
            'timeline_year.unique' => 'This timeline name already exists',
            'timeline_thumbnail.image' => 'Please Select a Valid Image to Upload',
            'timeline_thumbnail.file' => 'Please try again.',
            'timeline_description.required' => 'Please select the timeline description'
        ];

        Validator::make($request->all(), $input_list, $validation_list)->validate();
        
        $timeline_year = $request->input('timeline_year');
        $timeline_thumbnail = $request->file('timeline_thumbnail');
        $timeline_description = $request->input('timeline_description');
        $display_status = $request->input('display_status');
        
        $target_dir = "images/timelines";
        
        if(!empty($timeline_thumbnail)) {
            $timeline_thumbnail = $this->upload_file($timeline_thumbnail, $target_dir);
        } else {
            $timeline_thumbnail = $this->get_present_value('timelines', $timeline_id, 'timeline_thumbnail');            
        }
        
        $timeline = \App\Models\Timeline::find($timeline_id);
        $timeline->timeline_year = $timeline_year;
        $timeline->timeline_thumbnail = $timeline_thumbnail;
        $timeline->timeline_description = $timeline_description;
        $timeline->display_status = $display_status;
        $timeline->save();
        
        $display_message = $this->success_message("Timeline Updated Successfully");
        
        return response()->json(['display_message' => $display_message]);
    }

    public function manage_management() {
        $management = DB::table('management')->orderBy('sorting_order')->get();
        
        return view('admin.manage_management', compact('management'));
    }
    
    public function add_management() {
        return view('admin.add_management');
    }
    
    public function add_management_details(Request $request) {
        $input_list = [
            'management_name' => ['bail', 'required'],
            'management_thumbnail' => ['bail', 'required', 'image', 'file'],
            'management_designation' => ['bail', 'required'],
            'management_description' => ['bail', 'required'],
            'management_linked_in' => ['bail', 'nullable', 'url'],
            'management_twitter' => ['bail', 'nullable', 'url']
        ];

        $validation_list = [
            'management_name.required' => 'Please enter the management name',
            'management_thumbnail.required' => 'Please Select an Image to Upload',
            'management_thumbnail.image' => 'Please Select a Valid Image to Upload',
            'management_thumbnail.file' => 'Please try again.',
            'management_designation.required' => 'Please enter the management designation',
            'management_description.required' => 'Please enter the management description',
            'management_linked_in.url' => 'Please enter a valid URL',
            'management_twitter.url' => 'Please enter a valid URL',
        ];

        Validator::make($request->all(), $input_list, $validation_list)->validate();
        
        $management_category_id = $request->input('management_category_id');
        $management_name = $request->input('management_name');
        $management_thumbnail = $request->file('management_thumbnail');
        $management_designation = $request->input('management_designation');
        $management_description = $request->input('management_description');
        $management_linked_in = $request->input('management_linked_in');
        $management_twitter = $request->input('management_twitter');
        $display_status = $request->input('display_status');
        $sorting_order = $this->get_last_sorting('management');
        
        $target_dir = "images/management";
        
        $management_thumbnail = $this->upload_file($management_thumbnail, $target_dir);
        
        $management = new \App\Models\Management;
        $management->management_category_id = $management_category_id;
        $management->management_name = $management_name;
        $management->management_thumbnail = $management_thumbnail;
        $management->management_designation = $management_designation;
        $management->management_description = $management_description;
        $management->management_linked_in = $management_linked_in;
        $management->management_twitter = $management_twitter;
        $management->display_status = $display_status;
        $management->sorting_order = $sorting_order;
        $management->save();
        
        $display_message = $this->success_message("Management Uploaded Successfully");
        
        return response()->json(['display_message' => $display_message]);
    }
    
    public function edit_management($management_id) {
        $management = DB::table('management')->find($management_id);
        
        return view('admin.edit_management', compact('management'));
    }
    
    public function edit_management_details(Request $request) {
        $management_id = $request->input('management_id');

        $input_list = [
            'management_name' => ['bail', 'required'],
            'management_thumbnail' => ['bail', 'image', 'file'],
            'management_designation' => ['bail', 'required'],
            'management_description' => ['bail', 'required'],
            'management_linked_in' => ['bail', 'nullable', 'url'],
            'management_twitter' => ['bail', 'nullable', 'url']
        ];

        $validation_list = [
            'management_name.required' => 'Please enter the management name',
            'management_thumbnail.image' => 'Please Select a Valid Image to Upload',
            'management_thumbnail.file' => 'Please try again.',
            'management_designation.required' => 'Please enter the management designation',
            'management_description.required' => 'Please enter the management description',
            'management_linked_in.url' => 'Please enter a valid URL',
            'management_twitter.url' => 'Please enter a valid URL'
        ];

        Validator::make($request->all(), $input_list, $validation_list)->validate();
        
        $management_category_id = $request->input('management_category_id');
        $management_name = $request->input('management_name');
        $management_thumbnail = $request->file('management_thumbnail');
        $management_designation = $request->input('management_designation');
        $management_description = $request->input('management_description');
        $management_linked_in = $request->input('management_linked_in');
        $management_twitter = $request->input('management_twitter');
        $display_status = $request->input('display_status');
        
        $target_dir = "images/management";
        
        if(!empty($management_thumbnail)) {
            $management_thumbnail = $this->upload_file($management_thumbnail, $target_dir);
        } else {
            $management_thumbnail = $this->get_present_value('management', $management_id, 'management_thumbnail');            
        }
        
        $management = \App\Models\Management::find($management_id);
        $management->management_category_id = $management_category_id;
        $management->management_name = $management_name;
        $management->management_thumbnail = $management_thumbnail;
        $management->management_designation = $management_designation;
        $management->management_description = $management_description;
        $management->management_linked_in = $management_linked_in;
        $management->management_twitter = $management_twitter;
        $management->display_status = $display_status;
        $management->save();
        
        $display_message = $this->success_message("Management Updated Successfully");
        
        return response()->json(['display_message' => $display_message]);
    }
    
    public function update_management_sorting(Request $request) {
        $input_list = [
            'data_order' => ['bail', 'required', 'array'],
            'data_id' => ['bail', 'required', 'array']
        ];

        $validation_list = [];

        Validator::make($request->all(), $input_list, $validation_list)->validate();
        
        $data_order = $request->input('data_order');
        $data_id = $request->input('data_id');
        
        foreach($data_order as $key => $order_number) {
            $id_number = $data_id[$key];
            
            $this->update_sorting_number('management', $order_number, $id_number);
        }
    }

    public function manage_why_us() {
        $why_us = DB::table('why_us')->orderBy('sorting_order')->get();
        
        return view('admin.manage_why_us', compact('why_us'));
    }
    
    public function add_why_us() {
        return view('admin.add_why_us');
    }
    
    public function add_why_us_details(Request $request) {
        $input_list = [
            'section_title' => ['bail', 'required'],
            'section_image' => ['bail', 'required', 'image', 'file'],
            'section_content' => ['bail', 'required'],
        ];

        $validation_list = [
            'section_title.required' => 'Please enter the title',
            'section_image.required' => 'Please Select an Image to Upload',
            'section_image.image' => 'Please Select a Valid Image to Upload',
            'section_image.file' => 'Please try again.',
            'section_content.required' => 'Please enter the content',
        ];

        Validator::make($request->all(), $input_list, $validation_list)->validate();
        
        $section_title = $request->input('section_title');
        $section_image = $request->file('section_image');
        $section_content = $request->input('section_content');
        $display_status = $request->input('display_status');
        $sorting_order = $this->get_last_sorting('why_us');
        
        $target_dir = "images/why-us";
        
        $section_image = $this->upload_file($section_image, $target_dir);
        
        $why_us = new \App\Models\WhyUs;
        $why_us->section_title = $section_title;
        $why_us->section_image = $section_image;
        $why_us->section_content = $section_content;
        $why_us->display_status = $display_status;
        $why_us->sorting_order = $sorting_order;
        $why_us->save();
        
        $display_message = $this->success_message("Why Us Uploaded Successfully");
        
        return response()->json(['display_message' => $display_message]);
    }
    
    public function edit_why_us($why_us_id) {
        $why_us = DB::table('why_us')->find($why_us_id);
        
        return view('admin.edit_why_us', compact('why_us'));
    }
    
    public function edit_why_us_details(Request $request) {
        $why_us_id = $request->input('why_us_id');

        $input_list = [
            'section_title' => ['bail', 'required'],
            'section_image' => ['bail', 'image', 'file'],
            'section_content' => ['bail', 'required']
        ];

        $validation_list = [
            'section_title.required' => 'Please enter the title',
            'section_image.image' => 'Please Select a Valid Image to Upload',
            'section_image.file' => 'Please try again.',
            'section_content.required' => 'Please enter the content',
        ];

        Validator::make($request->all(), $input_list, $validation_list)->validate();
        
        $section_title = $request->input('section_title');
        $section_image = $request->file('section_image');
        $section_content = $request->input('section_content');
        $display_status = $request->input('display_status');
        
        $target_dir = "images/why-us";
        
        if(!empty($section_image)) {
            $section_image = $this->upload_file($section_image, $target_dir);
        } else {
            $section_image = $this->get_present_value('why_us', $why_us_id, 'section_image');            
        }
        
        $why_us = \App\Models\WhyUs::find($why_us_id);
        $why_us->section_title = $section_title;
        $why_us->section_image = $section_image;
        $why_us->section_content = $section_content;
        $why_us->display_status = $display_status;
        $why_us->save();
        
        $display_message = $this->success_message("Why Us Updated Successfully");
        
        return response()->json(['display_message' => $display_message]);
    }
    
    public function update_why_us_sorting(Request $request) {
        $input_list = [
            'data_order' => ['bail', 'required', 'array'],
            'data_id' => ['bail', 'required', 'array']
        ];

        $validation_list = [];

        Validator::make($request->all(), $input_list, $validation_list)->validate();
        
        $data_order = $request->input('data_order');
        $data_id = $request->input('data_id');
        
        foreach($data_order as $key => $order_number) {
            $id_number = $data_id[$key];
            
            $this->update_sorting_number('why_us', $order_number, $id_number);
        }
    }

    public function manage_social_responsibilities() {
        $social_responsibilities = DB::table('social_responsibilities')->orderBy('sorting_order')->get();
        
        return view('admin.manage_social_responsibilities', compact('social_responsibilities'));
    }
    
    public function add_social_responsibility() {
        return view('admin.add_social_responsibility');
    }
    
    public function add_social_responsibility_details(Request $request) {
        $input_list = [
            'section_title' => ['bail', 'required'],
            'section_image' => ['bail', 'required', 'image', 'file'],
            'section_content' => ['bail', 'required'],
        ];

        $validation_list = [
            'section_title.required' => 'Please enter the title',
            'section_image.required' => 'Please Select an Image to Upload',
            'section_image.image' => 'Please Select a Valid Image to Upload',
            'section_image.file' => 'Please try again.',
            'section_content.required' => 'Please enter the content',
        ];

        Validator::make($request->all(), $input_list, $validation_list)->validate();
        
        $section_title = $request->input('section_title');
        $section_image = $request->file('section_image');
        $section_content = $request->input('section_content');
        $display_status = $request->input('display_status');
        $sorting_order = $this->get_last_sorting('social_responsibilities');
        
        $target_dir = "images/social-responsibilities";
        
        $section_image = $this->upload_file($section_image, $target_dir);
        
        $social_responsibility = new \App\Models\SocialResponsibility;
        $social_responsibility->section_title = $section_title;
        $social_responsibility->section_image = $section_image;
        $social_responsibility->section_content = $section_content;
        $social_responsibility->display_status = $display_status;
        $social_responsibility->sorting_order = $sorting_order;
        $social_responsibility->save();
        
        $display_message = $this->success_message("Social Responsibility Uploaded Successfully");
        
        return response()->json(['display_message' => $display_message]);
    }
    
    public function edit_social_responsibility($social_responsibility_id) {
        $social_responsibility = DB::table('social_responsibilities')->find($social_responsibility_id);
        
        return view('admin.edit_social_responsibility', compact('social_responsibility'));
    }
    
    public function edit_social_responsibility_details(Request $request) {
        $social_responsibility_id = $request->input('social_responsibility_id');

        $input_list = [
            'section_title' => ['bail', 'required'],
            'section_image' => ['bail', 'image', 'file'],
            'section_content' => ['bail', 'required']
        ];

        $validation_list = [
            'section_title.required' => 'Please enter the title',
            'section_image.image' => 'Please Select a Valid Image to Upload',
            'section_image.file' => 'Please try again.',
            'section_content.required' => 'Please enter the content',
        ];

        Validator::make($request->all(), $input_list, $validation_list)->validate();
        
        $section_title = $request->input('section_title');
        $section_image = $request->file('section_image');
        $section_content = $request->input('section_content');
        $display_status = $request->input('display_status');
        
        $target_dir = "images/social-responsibilities";
        
        if(!empty($section_image)) {
            $section_image = $this->upload_file($section_image, $target_dir);
        } else {
            $section_image = $this->get_present_value('social_responsibilities', $social_responsibility_id, 'section_image');            
        }
        
        $social_responsibility = \App\Models\SocialResponsibility::find($social_responsibility_id);
        $social_responsibility->section_title = $section_title;
        $social_responsibility->section_image = $section_image;
        $social_responsibility->section_content = $section_content;
        $social_responsibility->display_status = $display_status;
        $social_responsibility->save();
        
        $display_message = $this->success_message("Social Responsibility Updated Successfully");
        
        return response()->json(['display_message' => $display_message]);
    }
    
    public function update_social_responsibilities_sorting(Request $request) {
        $input_list = [
            'data_order' => ['bail', 'required', 'array'],
            'data_id' => ['bail', 'required', 'array']
        ];

        $validation_list = [];

        Validator::make($request->all(), $input_list, $validation_list)->validate();
        
        $data_order = $request->input('data_order');
        $data_id = $request->input('data_id');
        
        foreach($data_order as $key => $order_number) {
            $id_number = $data_id[$key];
            
            $this->update_sorting_number('social_responsibilities', $order_number, $id_number);
        }
    }

    public function manage_social_projects() {
        $social_projects = DB::table('social_projects')->orderBy('sorting_order')->get();
        
        return view('admin.manage_social_projects', compact('social_projects'));
    }
    
    public function add_social_project() {
        return view('admin.add_social_project');
    }
    
    public function add_social_project_details(Request $request) {
        $input_list = [
            'social_project_name' => ['bail', 'required'],
            'social_project_description' => ['bail', 'required']
        ];

        $validation_list = [
            'social_project_name.required' => 'Please enter the social project name',
            'social_project_description.required' => 'Please enter the social project description',
        ];

        Validator::make($request->all(), $input_list, $validation_list)->validate();
        
        $social_project_name = $request->input('social_project_name');
        $social_project_description = $request->input('social_project_description');
        $display_status = $request->input('display_status');
        $sorting_order = $this->get_last_sorting('social_projects');
        
        $social_project = new \App\Models\SocialProject;
        $social_project->social_project_name = $social_project_name;
        $social_project->social_project_description = $social_project_description;
        $social_project->display_status = $display_status;
        $social_project->sorting_order = $sorting_order;
        $social_project->save();
        
        $display_message = $this->success_message("Social Project Uploaded Successfully");
        
        return response()->json(['display_message' => $display_message]);
    }
    
    public function edit_social_project($social_project_id) {
        $social_project = DB::table('social_projects')->find($social_project_id);
        
        return view('admin.edit_social_project', compact('social_project'));
    }
    
    public function edit_social_project_details(Request $request) {
        $social_project_id = $request->input('social_project_id');

        $input_list = [
            'social_project_name' => ['bail', 'required'],
            'social_project_description' => ['bail', 'required']
        ];

        $validation_list = [
            'social_project_name.required' => 'Please enter the social project name',
            'social_project_description.required' => 'Please enter the social project description'
        ];

        Validator::make($request->all(), $input_list, $validation_list)->validate();
        
        $social_project_name = $request->input('social_project_name');
        $social_project_description = $request->input('social_project_description');
        $display_status = $request->input('display_status');
        
        $social_project = \App\Models\SocialProject::find($social_project_id);
        $social_project->social_project_name = $social_project_name;
        $social_project->social_project_description = $social_project_description;
        $social_project->display_status = $display_status;
        $social_project->save();
        
        $display_message = $this->success_message("Social Project Updated Successfully");
        
        return response()->json(['display_message' => $display_message]);
    }
    
    public function update_social_projects_sorting(Request $request) {
        $input_list = [
            'data_order' => ['bail', 'required', 'array'],
            'data_id' => ['bail', 'required', 'array']
        ];

        $validation_list = [];

        Validator::make($request->all(), $input_list, $validation_list)->validate();
        
        $data_order = $request->input('data_order');
        $data_id = $request->input('data_id');
        
        foreach($data_order as $key => $order_number) {
            $id_number = $data_id[$key];
            
            $this->update_sorting_number('social_projects', $order_number, $id_number);
        }
    }

    public function manage_galleries() {
        $galleries = DB::table('galleries')->orderBy('sorting_order')->get();
        
        return view('admin.manage_galleries', compact('galleries'));
    }
    
    public function add_gallery() {
        return view('admin.add_gallery');
    }
    
    public function add_gallery_details(Request $request) {
        $input_list = [
            'gallery_image_caption' => ['bail', 'required'],
            'gallery_image_name' => ['bail', 'required', 'image', 'file']
        ];

        $validation_list = [
            'gallery_image_caption.required' => 'Please enter the image caption',
            'gallery_image_name.required' => 'Please Select an Image to Upload',
            'gallery_image_name.image' => 'Please Select a Valid Image to Upload',
            'gallery_image_name.file' => 'Please try again.'
        ];

        Validator::make($request->all(), $input_list, $validation_list)->validate();
        
        $gallery_image_caption = $request->input('gallery_image_caption');
        $gallery_image_name = $request->file('gallery_image_name');
        $display_status = $request->input('display_status');
        $sorting_order = $this->get_last_sorting('galleries');
        
        $target_dir = "images/gallery";
        
        $gallery_image_name = $this->upload_file($gallery_image_name, $target_dir);
        
        $gallery = new \App\Models\Gallery;
        $gallery->gallery_image_caption = $gallery_image_caption;
        $gallery->gallery_image_name = $gallery_image_name;
        $gallery->display_status = $display_status;
        $gallery->sorting_order = $sorting_order;
        $gallery->save();
        
        $display_message = $this->success_message("Gallery Uploaded Successfully");
        
        return response()->json(['display_message' => $display_message]);
    }
    
    public function edit_gallery($gallery_id) {
        $gallery = DB::table('galleries')->find($gallery_id);
        
        return view('admin.edit_gallery', compact('gallery'));
    }
    
    public function edit_gallery_details(Request $request) {
        $gallery_id = $request->input('gallery_id');

        $input_list = [
            'gallery_image_caption' => ['bail', 'required'],
            'gallery_image_name' => ['bail', 'image', 'file'],
        ];

        $validation_list = [
            'gallery_image_caption.required' => 'Please enter the image caption',
            'gallery_image_name.image' => 'Please Select a Valid Image to Upload',
            'gallery_image_name.file' => 'Please try again.'
        ];

        Validator::make($request->all(), $input_list, $validation_list)->validate();
        
        $gallery_image_caption = $request->input('gallery_image_caption');
        $gallery_image_name = $request->file('gallery_image_name');
        $display_status = $request->input('display_status');
        
        $target_dir = "images/gallery";
        
        if(!empty($gallery_image_name)) {
            $gallery_image_name = $this->upload_file($gallery_image_name, $target_dir);
        } else {
            $gallery_image_name = $this->get_present_value('galleries', $gallery_id, 'gallery_image_name');            
        }
        
        $gallery = \App\Models\Gallery::find($gallery_id);
        $gallery->gallery_image_caption = $gallery_image_caption;
        $gallery->gallery_image_name = $gallery_image_name;
        $gallery->display_status = $display_status;
        $gallery->save();
        
        $display_message = $this->success_message("Gallery Updated Successfully");
        
        return response()->json(['display_message' => $display_message]);
    }
    
    public function update_galleries_sorting(Request $request) {
        $input_list = [
            'data_order' => ['bail', 'required', 'array'],
            'data_id' => ['bail', 'required', 'array']
        ];

        $validation_list = [];

        Validator::make($request->all(), $input_list, $validation_list)->validate();
        
        $data_order = $request->input('data_order');
        $data_id = $request->input('data_id');
        
        foreach($data_order as $key => $order_number) {
            $id_number = $data_id[$key];
            
            $this->update_sorting_number('galleries', $order_number, $id_number);
        }
    }

    public function manage_press() {
        $presses = DB::table('presses')->orderBy('press_publish_date', 'desc')->get();
        
        return view('admin.manage_press', compact('presses'));
    }
    
    public function add_press() {
        return view('admin.add_press');
    }
    
    public function add_press_details(Request $request) {
        $input_list = [
            'press_title' => ['bail', 'required', 'unique:presses,press_title']
        ];

        $validation_list = [
            'press_title.required' => 'Please enter the press title',
            'press_title.unique' => 'This press title already exists'
        ];

        Validator::make($request->all(), $input_list, $validation_list)->validate();
        
        $press_title = $request->input('press_title');
        
        $press_media_title_array = $request->input('press_media_title');
        $press_publish_date_array = $request->input('press_publish_date');
        $press_link_attachment_array = $request->input('press_link_attachment');
        $press_link_array = $request->input('press_link');
        $press_attachment_array = $request->file('press_attachment');

        $display_status = $request->input('display_status');
        
        $press = new \App\Models\Press;
        $press->press_title = $press_title;
        $press->display_status = $display_status;
        $press->save();
        $press_id = $press->id;

        $target_dir = "images/press";

        if(is_array($press_media_title_array)) {
            foreach($press_media_title_array as $key => $press_media_title) {
                $press_publish_date = $press_publish_date_array[$key];
                $press_link_attachment = $press_link_attachment_array[$key];
                $press_link = $press_link_array[$key];

                if(isset($press_attachment_array[$key])) {
                	$press_attachment = $press_attachment_array[$key];
                	
                    $press_attachment = $this->upload_file($press_attachment, $target_dir);
                } else {
                    $press_attachment = "";
                }

                $press_content = new \App\Models\PressContent;
                $press_content->press_id = $press_id;
                $press_content->press_media_title = $press_media_title;
                $press_content->press_publish_date = $press_publish_date;
                $press_content->press_link_attachment = $press_link_attachment;
                $press_content->press_link = $press_link;
                $press_content->press_attachment = $press_attachment;
                $press_content->display_status = 1;
                $press_content->sorting_order = $key + 1;
                $press_content->save();
            }
        }
        
        $display_message = $this->success_message("Press Uploaded Successfully");
        
        return response()->json(['display_message' => $display_message]);
    }
    
    public function edit_press($press_id) {
        $press = DB::table('presses')->find($press_id);

        $press_contents = DB::table('press_contents')->where('press_id', $press_id)->where('display_status', 1)->orderBy('sorting_order')->get();
        
        return view('admin.edit_press', compact('press', 'press_contents'));
    }
    
    public function edit_press_details(Request $request) {
        $press_id = $request->input('press_id');

        $input_list = [
            'press_title' => ['bail', 'required', "unique:presses,press_title,$press_id"]
        ];

        $validation_list = [
            'press_title.required' => 'Please enter the press title',
            'press_title.unique' => 'This press title already exists'
        ];

        Validator::make($request->all(), $input_list, $validation_list)->validate();
        
        $press_title = $request->input('press_title');
        
        $press_content_id_array = $request->input('press_content_id');
        $press_media_title_array = $request->input('press_media_title');
        $press_publish_date_array = $request->input('press_publish_date');
        $press_link_attachment_array = $request->input('press_link_attachment');
        $press_link_array = $request->input('press_link');
        $press_attachment_array = $request->file('press_attachment');

        $display_status = $request->input('display_status');
        
        $press = \App\Models\Press::find($press_id);
        $press->press_title = $press_title;
        $press->display_status = $display_status;
        $press->save();

        DB::table('press_contents')->where('press_id', $press_id)->update(['display_status' => 0]);

        $target_dir = "images/press";

        if(is_array($press_media_title_array)) {
            foreach($press_media_title_array as $key => $press_media_title) {
                if(isset($press_content_id_array[$key])) {
                    $press_content_id = $press_content_id_array[$key];
                } else {
                    $press_content_id = 0;
                }

                $press_publish_date = $press_publish_date_array[$key];
                $press_link_attachment = $press_link_attachment_array[$key];
                $press_link = $press_link_array[$key];

                if(isset($press_attachment_array)) {
                    $press_attachment = $press_attachment_array[$key];
                } else {
                    $press_attachment = "";
                }

                if(!empty($press_attachment)) {
                    $press_attachment = $this->upload_file($press_attachment, $target_dir);
                } else if($press_link_attachment == 2) {
                    $press_attachment = $this->get_present_value('press_contents', $press_content_id, 'press_attachment');
                } else {
                    $press_attachment = "";
                }

                if(empty($press_content_id)) {
                    $press_content = new \App\Models\PressContent;
                } else {
                    $press_content = \App\Models\PressContent::find($press_content_id);
                }

                $press_content->press_id = $press_id;
                $press_content->press_media_title = $press_media_title;
                $press_content->press_publish_date = $press_publish_date;
                $press_content->press_link_attachment = $press_link_attachment;
                $press_content->press_link = $press_link;
                $press_content->press_attachment = $press_attachment;
                $press_content->display_status = 1;
                $press_content->sorting_order = $key + 1;
                $press_content->save();
            }
        }
        
        $display_message = $this->success_message("Press Updated Successfully");
        
        return response()->json(['display_message' => $display_message]);
    }

    public function manage_media() {
        $media = DB::table('media')->orderBy('media_publish_date')->get();
        
        return view('admin.manage_media', compact('media'));
    }
    
    public function add_media() {
        return view('admin.add_media');
    }
    
    public function add_media_details(Request $request) {
        $input_list = [
            'media_title' => ['bail', 'required', 'unique:media,media_title'],
            'media_thumbnail' => ['bail', 'required', 'image'],
            'media_publish_date' => ['bail', 'required'],
            'media_pdf' => ['bail', 'required', 'mimes:pdf']
        ];

        $validation_list = [
            'media_title.required' => 'Please enter the media name',
            'media_title.unique' => 'This media name already exists',
            'media_thumbnail.required' => 'Please select an image to upload',
            'media_thumbnail.image' => 'Please select a valid image to upload',
            'media_publish_date.required' => 'Please select a date',
            'media_pdf.required' => 'Please select a PDF file to upload',
            'media_pdf.mimes' => 'Please select a valid PDF file to upload'
        ];

        Validator::make($request->all(), $input_list, $validation_list)->validate();
        
        $media_title = $request->input('media_title');
        $media_thumbnail = $request->file('media_thumbnail');
        $media_publish_date = $request->input('media_publish_date');
        $media_pdf = $request->file('media_pdf');
        $display_status = $request->input('display_status');
        
        $target_dir = "images/media";
        
        if(!empty($media_thumbnail)) {
            $media_thumbnail = $this->upload_file($media_thumbnail, $target_dir);
        } else {
            $media_thumbnail = "";
        }

        $target_dir = "pdfs";
        
        if(!empty($media_pdf)) {
            $media_pdf = $this->upload_file($media_pdf, $target_dir);
        } else {
            $media_pdf = "";
        }
        
        $media = new \App\Models\Media;
        $media->media_title = $media_title;
        $media->media_thumbnail = $media_thumbnail;
        $media->media_publish_date = $media_publish_date;
        $media->media_pdf = $media_pdf;
        $media->display_status = $display_status;
        $media->save();
        
        $display_message = $this->success_message("Media Uploaded Successfully");
        
        return response()->json(['display_message' => $display_message]);
    }
    
    public function edit_media($media_id) {
        $media = DB::table('media')->find($media_id);
        
        return view('admin.edit_media', compact('media'));
    }
    
    public function edit_media_details(Request $request) {
        $media_id = $request->input('media_id');

        $input_list = [
            'media_title' => ['bail', 'required', "unique:media,media_title,$media_id"],
            'media_thumbnail' => ['bail', 'image'],
            'media_publish_date' => ['bail', 'required'],
            'media_pdf' => ['bail', 'mimes:pdf']
        ];

        $validation_list = [
            'media_title.required' => 'Please enter the media name',
            'media_title.unique' => 'This media name already exists',
            'media_thumbnail.image' => 'Please select a valid image to upload',
            'media_publish_date.required' => 'Please select a date',
            'media_pdf.mimes' => 'Please select a valid PDF file to upload'
        ];

        Validator::make($request->all(), $input_list, $validation_list)->validate();
        
        $media_title = $request->input('media_title');
        $media_thumbnail = $request->file('media_thumbnail');
        $media_publish_date = $request->input('media_publish_date');
        $media_pdf = $request->file('media_pdf');
        $display_status = $request->input('display_status');
        
        $target_dir = "images/media";
        
        if(!empty($media_thumbnail)) {
            $media_thumbnail = $this->upload_file($media_thumbnail, $target_dir);
        } else {
            $media_thumbnail = $this->get_present_value('media', $media_id, 'media_thumbnail');            
        }

        $target_dir = "pdfs";
        
        if(!empty($media_pdf)) {
            $media_pdf = $this->upload_file($media_pdf, $target_dir);
        } else {
            $media_pdf = $this->get_present_value('media', $media_id, 'media_pdf');            
        }
        
        $media = \App\Models\Media::find($media_id);
        $media->media_title = $media_title;
        $media->media_thumbnail = $media_thumbnail;
        $media->media_publish_date = $media_publish_date;
        $media->media_pdf = $media_pdf;
        $media->display_status = $display_status;
        $media->save();

        $display_message = $this->success_message("Media Updated Successfully");
        
        return response()->json(['display_message' => $display_message]);
    }

    public function manage_reports() {
        $reports = DB::table('reports')->orderBy('report_publish_date')->get();
        
        return view('admin.manage_reports', compact('reports'));
    }
    
    public function add_report() {
        return view('admin.add_report');
    }
    
    public function add_report_details(Request $request) {
        $input_list = [
            'report_title' => ['bail', 'required', 'unique:reports,report_title'],
            'report_thumbnail' => ['bail', 'required', 'image'],
            'report_publish_date' => ['bail', 'required'],
            'report_pdf' => ['bail', 'required', 'mimes:pdf']
        ];

        $validation_list = [
            'report_title.required' => 'Please enter the report name',
            'report_title.unique' => 'This report name already exists',
            'report_thumbnail.required' => 'Please select an image to upload',
            'report_thumbnail.image' => 'Please select a valid image to upload',
            'report_publish_date.required' => 'Please select a date',
            'report_pdf.required' => 'Please select a PDF file to upload',
            'report_pdf.mimes' => 'Please select a valid PDF file to upload'
        ];

        Validator::make($request->all(), $input_list, $validation_list)->validate();
        
        $report_title = $request->input('report_title');
        $report_thumbnail = $request->file('report_thumbnail');
        $report_publish_date = $request->input('report_publish_date');
        $report_pdf = $request->file('report_pdf');
        $display_status = $request->input('display_status');
        
        $target_dir = "images/media";
        
        if(!empty($report_thumbnail)) {
            $report_thumbnail = $this->upload_file($report_thumbnail, $target_dir);
        } else {
            $report_thumbnail = "";
        }

        $target_dir = "pdfs";
        
        if(!empty($report_pdf)) {
            $report_pdf = $this->upload_file($report_pdf, $target_dir);
        } else {
            $report_pdf = "";
        }
        
        $report = new \App\Models\Report;
        $report->report_title = $report_title;
        $report->report_thumbnail = $report_thumbnail;
        $report->report_publish_date = $report_publish_date;
        $report->report_pdf = $report_pdf;
        $report->display_status = $display_status;
        $report->save();
        
        $display_message = $this->success_message("Report Uploaded Successfully");
        
        return response()->json(['display_message' => $display_message]);
    }
    
    public function edit_report($report_id) {
        $report = DB::table('reports')->find($report_id);
        
        return view('admin.edit_report', compact('report'));
    }
    
    public function edit_report_details(Request $request) {
        $report_id = $request->input('report_id');

        $input_list = [
            'report_title' => ['bail', 'required', "unique:reports,report_title,$report_id"],
            'report_thumbnail' => ['bail', 'image'],
            'report_publish_date' => ['bail', 'required'],
            'report_pdf' => ['bail', 'mimes:pdf']
        ];

        $validation_list = [
            'report_title.required' => 'Please enter the report name',
            'report_title.unique' => 'This report name already exists',
            'report_thumbnail.image' => 'Please select a valid image to upload',
            'report_publish_date.required' => 'Please select a date',
            'report_pdf.mimes' => 'Please select a valid PDF file to upload'
        ];

        Validator::make($request->all(), $input_list, $validation_list)->validate();
        
        $report_title = $request->input('report_title');
        $report_thumbnail = $request->file('report_thumbnail');
        $report_publish_date = $request->input('report_publish_date');
        $report_pdf = $request->file('report_pdf');
        $display_status = $request->input('display_status');
        
        $target_dir = "images/media";
        
        if(!empty($report_thumbnail)) {
            $report_thumbnail = $this->upload_file($report_thumbnail, $target_dir);
        } else {
            $report_thumbnail = $this->get_present_value('reports', $report_id, 'report_thumbnail');            
        }

        $target_dir = "pdfs";
        
        if(!empty($report_pdf)) {
            $report_pdf = $this->upload_file($report_pdf, $target_dir);
        } else {
            $report_pdf = $this->get_present_value('reports', $report_id, 'report_pdf');            
        }
        
        $report = \App\Models\Report::find($report_id);
        $report->report_title = $report_title;
        $report->report_thumbnail = $report_thumbnail;
        $report->report_publish_date = $report_publish_date;
        $report->report_pdf = $report_pdf;
        $report->display_status = $display_status;
        $report->save();

        $display_message = $this->success_message("Report Updated Successfully");
        
        return response()->json(['display_message' => $display_message]);
    }

    public function edit_media_kit() {
        $media_kit = \App\Models\MediaKit::find(1);

        return view('admin.edit_media_kit', compact('media_kit'));
    }

    public function edit_media_kit_details(Request $request) {
        $media_kit_file_name = $request->file('media_kit_file_name');

        $target_dir = "images/media";
        
        if(!empty($media_kit_file_name)) {
            $media_kit_file_name = $this->upload_file($media_kit_file_name, $target_dir, "media-kit-".time());
        } else {
            $media_kit_file_name = $this->get_present_value('media_kits', 1, 'media_kit_file_name');
        }

        $about = \App\Models\MediaKit::find(1);
        $about->media_kit_file_name = $media_kit_file_name;
        $about->save();

        $display_message = $this->success_message("Media Kit Updated Successfully");
        
        return response()->json(['display_message' => $display_message]);
    }

    public function manage_videos() {
        $videos = DB::table('videos')->orderBy('video_publish_date')->get();
        
        return view('admin.manage_videos', compact('videos'));
    }
    
    public function add_video() {
        return view('admin.add_video');
    }
    
    public function add_video_details(Request $request) {
        $input_list = [
            'video_title' => ['bail', 'required', 'unique:videos,video_title'],
            'youtube_video_id' => ['bail', 'required'],
            'video_publish_date' => ['bail', 'required']
        ];

        $validation_list = [
            'video_title.required' => 'Please enter the video name',
            'video_title.unique' => 'This video name already exists',
            'youtube_video_id.required' => 'Please enter a YouTube video ID',
            'video_publish_date.required' => 'Please select a date'
        ];

        Validator::make($request->all(), $input_list, $validation_list)->validate();
        
        $video_title = $request->input('video_title');
        $youtube_video_id = $request->input('youtube_video_id');
        $video_publish_date = $request->input('video_publish_date');
        $display_status = $request->input('display_status');
        
        $video = new \App\Models\Video;
        $video->video_title = $video_title;
        $video->youtube_video_id = $youtube_video_id;
        $video->video_publish_date = $video_publish_date;
        $video->display_status = $display_status;
        $video->save();
        
        $display_message = $this->success_message("Video Uploaded Successfully");
        
        return response()->json(['display_message' => $display_message]);
    }
    
    public function edit_video($video_id) {
        $video = DB::table('videos')->find($video_id);
        
        return view('admin.edit_video', compact('video'));
    }
    
    public function edit_video_details(Request $request) {
        $video_id = $request->input('video_id');

        $input_list = [
            'video_title' => ['bail', 'required', "unique:videos,video_title,$video_id"],
            'youtube_video_id' => ['bail', 'required'],
            'video_publish_date' => ['bail', 'required']
        ];

        $validation_list = [
            'video_title.required' => 'Please enter the video name',
            'video_title.unique' => 'This video name already exists',
            'youtube_video_id.required' => 'Please enter a YouTube video ID',
            'video_publish_date.required' => 'Please select a date'
        ];

        Validator::make($request->all(), $input_list, $validation_list)->validate();
        
        $video_title = $request->input('video_title');
        $youtube_video_id = $request->input('youtube_video_id');
        $video_publish_date = $request->input('video_publish_date');
        $display_status = $request->input('display_status');
        
        $video = \App\Models\Video::find($video_id);
        $video->video_title = $video_title;
        $video->youtube_video_id = $youtube_video_id;
        $video->video_publish_date = $video_publish_date;
        $video->display_status = $display_status;
        $video->save();

        $display_message = $this->success_message("Video Updated Successfully");
        
        return response()->json(['display_message' => $display_message]);
    }

    public function manage_testimonials() {
        $testimonial = DB::table('testimonials')->orderBy('sorting_order')->get();
        
        return view('admin.manage_testimonials', compact('testimonial'));
    }
    
    public function add_testimonial() {
        $projects = DB::table('projects')->get();

        return view('admin.add_testimonial', compact('projects'));
    }
    
    public function add_testimonial_details(Request $request) {
        $input_list = [
            'testimonial_content' => ['bail', 'required'],
            'testimonial_name' => ['bail', 'required'],
            'project_name' => ['bail', 'required'],
            'testimonial_youtube_id' => ['bail', 'nullable', 'size:11'],
            'testimonial_thumbnail' => ['bail', 'image']
        ];

        $validation_list = [
            'testimonial_content.required' => 'Please Enter Testimonial Content',
            'testimonial_name.required' => 'Please enter testimonial name',
            'project_name.required' => 'Please enter a project name',
            'testimonial_youtube_id.required' => 'Please enter testimonial YouTube ID',
            'testimonial_youtube_id.size' => 'Please enter a valid YouTube ID',
            'testimonial_thumbnail.image' => 'Please select a valid image to upload'
        ];

        Validator::make($request->all(), $input_list, $validation_list)->validate();
        
        $project_name = $request->input('project_name');
        $testimonial_content = $request->input('testimonial_content');
        $testimonial_name = $request->input('testimonial_name');
        $testimonial_layout_id = $request->input('testimonial_layout_id');
        $testimonial_youtube_id = $request->input('testimonial_youtube_id');
        $testimonial_thumbnail = $request->file('testimonial_thumbnail');
        $display_status = $request->input('display_status');
        $testimonial_featured = $request->input('testimonial_featured');
        $sorting_order = $this->get_last_sorting('testimonials');

        $target_dir = "images/testimonials";

        if(!empty($testimonial_thumbnail)) {
            $testimonial_thumbnail = $this->upload_file($testimonial_thumbnail, $target_dir);
        } else {
            $testimonial_thumbnail = "";
        }
        
        $testimonial = new \App\Models\Testimonial;
        $testimonial->project_name = $project_name;
        $testimonial->testimonial_content = $testimonial_content;
        $testimonial->testimonial_name = $testimonial_name;
        $testimonial->testimonial_layout_id = $testimonial_layout_id;
        $testimonial->testimonial_youtube_id = $testimonial_youtube_id;
        $testimonial->testimonial_thumbnail = $testimonial_thumbnail;
        $testimonial->testimonial_featured = $testimonial_featured;
        $testimonial->display_status = $display_status;
        $testimonial->sorting_order = $sorting_order;
        $testimonial->save();
        
        $display_message = $this->success_message("Testimonial Uploaded Successfully");
        
        return response()->json(['display_message' => $display_message]);
    }
    
    public function edit_testimonial($testimonial_id) {
        $testimonial = DB::table('testimonials')->find($testimonial_id);

        $projects = DB::table('projects')->get();
        
        return view('admin.edit_testimonial', compact('testimonial', 'projects'));
    }
    
    public function edit_testimonial_details(Request $request) {
        $input_list = [
            'testimonial_content' => ['bail', 'required'],
            'testimonial_name' => ['bail', 'required'],
            'project_name' => ['bail', 'required'],
            'testimonial_youtube_id' => ['bail', 'nullable', 'size:11'],
            'testimonial_thumbnail' => ['bail', 'image']
        ];

        $validation_list = [
            'testimonial_content.required' => 'Please Enter Testimonial Content',
            'testimonial_name.required' => 'Please enter testimonial name',
            'project_name.required' => 'Please enter a project name',
            'testimonial_youtube_id.required' => 'Please enter testimonial YouTube ID',
            'testimonial_youtube_id.size' => 'Please enter a valid YouTube ID',
            'testimonial_thumbnail.image' => 'Please select a valid image to upload'
        ];

        Validator::make($request->all(), $input_list, $validation_list)->validate();
        
        
        $testimonial_id = $request->input('testimonial_id');
        $project_name = $request->input('project_name');
        $testimonial_content = $request->input('testimonial_content');
        $testimonial_name = $request->input('testimonial_name');
        $testimonial_layout_id = $request->input('testimonial_layout_id');
        $testimonial_youtube_id = $request->input('testimonial_youtube_id');
        $testimonial_thumbnail = $request->file('testimonial_thumbnail');
        $display_status = $request->input('display_status');
        $testimonial_featured = $request->input('testimonial_featured');

        $target_dir = "images/testimonials";

        if(!empty($testimonial_thumbnail)) {
            $testimonial_thumbnail = $this->upload_file($testimonial_thumbnail, $target_dir);    
        } else {
            $testimonial_thumbnail = $this->get_present_value('testimonials', $testimonial_id, 'testimonial_thumbnail');
        }
        
        $testimonial = \App\Models\Testimonial::find($testimonial_id);
        $testimonial->project_name = $project_name;
        $testimonial->testimonial_content = $testimonial_content;
        $testimonial->testimonial_name = $testimonial_name;
        $testimonial->testimonial_layout_id = $testimonial_layout_id;
        $testimonial->testimonial_youtube_id = $testimonial_youtube_id;
        $testimonial->testimonial_thumbnail = $testimonial_thumbnail;
        $testimonial->testimonial_featured = $testimonial_featured;
        $testimonial->display_status = $display_status;
        $testimonial->save();
        
        $display_message = $this->success_message("Testimonial Updated Successfully");
        
        return response()->json(['display_message' => $display_message]);
    }
    
    public function update_testimonials_sorting(Request $request) {
        $input_list = [
            'data_order' => ['bail', 'required', 'array'],
            'data_id' => ['bail', 'required', 'array']
        ];

        $validation_list = [];

        Validator::make($request->all(), $input_list, $validation_list)->validate();
        
        $data_order = $request->input('data_order');
        $data_id = $request->input('data_id');
        
        foreach($data_order as $key => $order_number) {
            $id_number = $data_id[$key];
            
            $this->update_sorting_number('testimonials', $order_number, $id_number);
        }
    }

    public function manage_awards() {
        $awards = DB::table('awards')->orderBy('sorting_order')->get();
        
        return view('admin.manage_awards', compact('awards'));
    }
    
    public function add_award() {
        return view('admin.add_award');
    }
    
    public function add_award_details(Request $request) {
        $input_list = [
            'award_description' => ['bail', 'required'],
            'award_title' => ['bail', 'required'],
            'award_date' => ['bail', 'required'],
            'award_thumbnail' => ['bail', 'required', 'image']
        ];

        $validation_list = [
            'award_description.required' => 'Please enter award description',
            'award_title.required' => 'Please enter award name',
            'award_date.required' => 'Please enter award date',
            'award_thumbnail.required' => 'Please select an image to upload',
            'award_thumbnail.image' => 'Please select a valid image to upload'
        ];

        Validator::make($request->all(), $input_list, $validation_list)->validate();
        
        $award_description = $request->input('award_description');
        $award_title = $request->input('award_title');
        $award_date = $request->input('award_date');
        $award_thumbnail = $request->file('award_thumbnail');
        $display_status = $request->input('display_status');
        $sorting_order = $this->get_last_sorting('awards');

        $target_dir = "images/awards";

        $award_thumbnail = $this->upload_file($award_thumbnail, $target_dir);
        
        $award = new \App\Models\Award;
        $award->award_description = $award_description;
        $award->award_title = $award_title;
        $award->award_date = $award_date;
        $award->award_thumbnail = $award_thumbnail;
        $award->display_status = $display_status;
        $award->sorting_order = $sorting_order;
        $award->save();
        
        $display_message = $this->success_message("Award Uploaded Successfully");
        
        return response()->json(['display_message' => $display_message]);
    }
    
    public function edit_award($award_id) {
        $award = DB::table('awards')->find($award_id);
        
        return view('admin.edit_award', compact('award'));
    }
    
    public function edit_award_details(Request $request) {
        $input_list = [
            'award_description' => ['bail', 'required'],
            'award_title' => ['bail', 'required'],
            'award_date' => ['bail', 'required'],
            'award_thumbnail' => ['bail', 'image']
        ];

        $validation_list = [
            'award_description.required' => 'Please enter award description',
            'award_title.required' => 'Please enter award name',
            'award_date.required' => 'Please enter award date',
            'award_thumbnail.image' => 'Please select a valid image to upload'
        ];

        Validator::make($request->all(), $input_list, $validation_list)->validate();
        
        $award_id = $request->input('award_id');
        $award_description = $request->input('award_description');
        $award_title = $request->input('award_title');
        $award_date = $request->input('award_date');
        $award_thumbnail = $request->file('award_thumbnail');
        $display_status = $request->input('display_status');
        $sorting_order = $this->get_last_sorting('awards');

        $target_dir = "images/awards";

        if(!empty($award_thumbnail)) {
            $award_thumbnail = $this->upload_file($award_thumbnail, $target_dir);    
        } else {
            $award_thumbnail = $this->get_present_value('awards', $award_id, 'award_thumbnail');
        }
        
        $award = \App\Models\Award::find($award_id);
        $award->award_description = $award_description;
        $award->award_title = $award_title;
        $award->award_date = $award_date;
        $award->award_thumbnail = $award_thumbnail;
        $award->display_status = $display_status;
        $award->save();
        
        $display_message = $this->success_message("Award Updated Successfully");
        
        return response()->json(['display_message' => $display_message]);
    }
    
    public function update_awards_sorting(Request $request) {
        $input_list = [
            'data_order' => ['bail', 'required', 'array'],
            'data_id' => ['bail', 'required', 'array']
        ];

        $validation_list = [];

        Validator::make($request->all(), $input_list, $validation_list)->validate();
        
        $data_order = $request->input('data_order');
        $data_id = $request->input('data_id');
        
        foreach($data_order as $key => $order_number) {
            $id_number = $data_id[$key];
            
            $this->update_sorting_number('awards', $order_number, $id_number);
        }
    }

    public function edit_frontend_script() {
        $frontend_script = \App\Models\FrontendScript::find(1);

        return view('admin.edit_frontend_script', compact('frontend_script'));
    }

    public function edit_frontend_script_details(Request $request) {
        $script_code = $request->input('script_code');

        $frontend_script = \App\Models\FrontendScript::find(1);
        $frontend_script->script_code = $script_code;
        $frontend_script->save();

        $display_message = $this->success_message("Script Updated Successfully");
        
        return response()->json(['display_message' => $display_message]);
    }
}