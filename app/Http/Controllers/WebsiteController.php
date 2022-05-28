<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DB;
use Mail;
use Browser;

class WebsiteController extends Controller {
	public function __construct() {
        $projects = DB::table('projects')->select('id', 'project_name')->where('display_status', 1)->orderBy('sorting_order')->get();

        $commercial_projects = DB::table('commercial_project')->select('id', 'project_title as project_name')->where('status', 1)->orderBy('sorting_order')->get();

        $project_types = DB::table('project_types')->where('display_status', 1)->get();

        $script_code = DB::table('frontend_scripts')->find(1)->script_code;

        view()->share('navigation_class', '');
        view()->share('form_location', '');
        view()->share('projects', $projects);
        view()->share('commercial_projects', $commercial_projects);
        view()->share('project_types', $project_types);
        view()->share('script_code', $script_code);
        view()->share('commercial_projects', $commercial_projects);
    }

    public function index() {
    	$meta_data = DB::table('meta_data')->find(1);

    	$banner = DB::table('banners')->find(1);

        $home_page_sliders = DB::table('home_page_sliders')
        ->where('display_status', 1)
        ->orderBy('sorting_order')
        ->get();

        $home_page_about_us = DB::table('home_page_about_us')->find(1);

        $project_zones = DB::table('project_zones')
        ->select('project_zones.id', 'project_zones.project_zone_title')
        ->join('projects', 'projects.project_zone_id', 'project_zones.id')
        ->where('projects.display_status', 1)
        ->where('project_zones.display_status', 1)
        ->groupBy('project_zone_title')
        ->orderBy('project_zone_title')
        ->get();

        $project_locations = DB::table('project_locations')
        ->select('project_locations.id', 'project_locations.project_location_title')
        ->join('projects', 'projects.project_location_id', 'project_locations.id')
        ->where('project_locations.display_status', 1)
        ->where('projects.display_status', 1)
        ->groupBy('project_location_title')
        ->orderBy('project_location_title')
        ->get();

        $project_categories = DB::table('project_categories')
        ->select('project_categories.id', 'project_categories.project_category_title')
        ->join('project_selected_categories', 'project_selected_categories.project_category_id', 'project_categories.id')
        ->join('projects', 'projects.id', 'project_selected_categories.project_id')
        ->where('projects.display_status', 1)
        ->groupBy('project_category_title')
        ->orderBy('project_category_title')
        ->get();

        $projects = DB::table('projects')
        ->select('id', 'project_name', 'project_url_slug', 'project_thumbnail', 'project_template_id', 'project_accommodation_type', 'project_location_text')
        ->where('display_status', 1)
        ->groupBy('projects.id')
        ->orderBy('projects.sorting_order')
        ->limit(9)
        ->get();


        $commercial_projects = DB::table('commercial_project')
        ->select('id', 'project_title as project_name' , 'project_thumbnail', 'project_slug', 'project_location_text','project_description')
        ->addSelect(['project_type_title' => DB::table('project_types')
            ->select('project_type_title')
            ->whereColumn('project_types.id', 'commercial_project.project_type')])
        ->addSelect(['project_status_title' => DB::table('project_statuses')
            ->select('project_status_title')
            ->whereColumn('project_statuses.id', 'commercial_project.project_status_id')])
        ->orderBy('sorting_order')
        ->get();

        $testimonials = DB::table('testimonials')
        ->where('testimonial_featured', 1)
        ->where('display_status', 1)
        ->where('testimonial_layout_id', 1)
        ->orderBy('sorting_order')
        ->get();

    	return view('index', compact('meta_data', 'banner', 'home_page_sliders', 'home_page_about_us', 'projects', 'project_categories', 'project_zones', 'project_locations', 'testimonials','commercial_projects'));
    }

    public function filter_zone_details(Request $request) {
        $project_zone_id = $request->input('project_zone_id');

        if(empty($project_zone_id)) {
            $project_locations = DB::table('project_locations')
            ->select('project_locations.id', 'project_locations.project_location_title')
            ->join('projects', 'projects.project_location_id', 'project_locations.id')
            ->where('project_locations.display_status', 1)
            ->where('projects.display_status', 1)
            ->groupBy('project_location_title')
            ->orderBy('project_location_title')
            ->get();

            $project_categories = DB::table('project_categories')
            ->select('project_categories.id', 'project_categories.project_category_title')
            ->join('project_selected_categories', 'project_selected_categories.project_category_id', 'project_categories.id')
            ->join('projects', 'projects.id', 'project_selected_categories.project_id')
            ->where('projects.display_status', 1)
            ->groupBy('project_category_title')
            ->orderBy('project_category_title')
            ->get();
        } else {
            $project_locations = DB::table('project_locations')
            ->select('project_locations.id', 'project_locations.project_location_title')
            ->join('projects', 'projects.project_location_id', 'project_locations.id')
            ->where('project_locations.display_status', 1)
            ->where('projects.display_status', 1)
            ->where('projects.project_zone_id', $project_zone_id)
            ->groupBy('project_location_title')
            ->orderBy('project_location_title')
            ->get();

            $project_categories = DB::table('project_categories')
            ->select('project_categories.id', 'project_categories.project_category_title')
            ->join('project_selected_categories', 'project_selected_categories.project_category_id', 'project_categories.id')
            ->join('projects', 'projects.id', 'project_selected_categories.project_id')
            ->where('projects.display_status', 1)
            ->where('projects.project_zone_id', $project_zone_id)
            ->groupBy('project_category_title')
            ->orderBy('project_category_title')
            ->get();
        }

        return response()->json(['project_locations' => $project_locations, 'project_categories' => $project_categories]);
    }

    public function filter_location_details(Request $request) {
        $project_zone_id = $request->input('project_zone_id');
        $project_location_id = $request->input('project_location_id');

        if(empty($project_zone_id) && empty($project_location_id)) {
            $project_categories = DB::table('project_categories')
            ->select('project_categories.id', 'project_categories.project_category_title')
            ->join('project_selected_categories', 'project_selected_categories.project_category_id', 'project_categories.id')
            ->join('projects', 'projects.id', 'project_selected_categories.project_id')
            ->where('projects.display_status', 1)
            ->groupBy('project_category_title')
            ->orderBy('project_category_title')
            ->get();
        } else if(!empty($project_zone_id) && empty($project_location_id)) {
            $project_categories = DB::table('project_categories')
            ->select('project_categories.id', 'project_categories.project_category_title')
            ->join('project_selected_categories', 'project_selected_categories.project_category_id', 'project_categories.id')
            ->join('projects', 'projects.id', 'project_selected_categories.project_id')
            ->where('projects.display_status', 1)
            ->where('projects.project_zone_id', $project_zone_id)
            ->groupBy('project_category_title')
            ->orderBy('project_category_title')
            ->get();
        } else if(empty($project_zone_id) && !empty($project_location_id)) {
            $project_categories = DB::table('project_categories')
            ->select('project_categories.id', 'project_categories.project_category_title')
            ->join('project_selected_categories', 'project_selected_categories.project_category_id', 'project_categories.id')
            ->join('projects', 'projects.id', 'project_selected_categories.project_id')
            ->where('projects.display_status', 1)
            ->where('projects.project_location_id', $project_location_id)
            ->groupBy('project_category_title')
            ->orderBy('project_category_title')
            ->get();
        } else if(!empty($project_zone_id) && !empty($project_location_id)) {
            $project_categories = DB::table('project_categories')
            ->select('project_categories.id', 'project_categories.project_category_title')
            ->join('project_selected_categories', 'project_selected_categories.project_category_id', 'project_categories.id')
            ->join('projects', 'projects.id', 'project_selected_categories.project_id')
            ->where('projects.display_status', 1)
            ->where('projects.project_zone_id', $project_zone_id)
            ->where('projects.project_location_id', $project_location_id)
            ->groupBy('project_category_title')
            ->orderBy('project_category_title')
            ->get();
        }

        return response()->json(['project_categories' => $project_categories]);
    }

    public function filter_project_details(Request $request) {
        $input_list = [
            'project_zone_id' => ['bail', 'nullable', 'exists:project_zones,id'],
            'project_location_id' => ['bail', 'nullable', 'exists:project_locations,id'],
            'project_category_id' => ['bail', 'nullable', 'exists:project_categories,id'],
            'project_type_id' => ['bail', 'nullable', 'exists:project_types,id'],
            'project_status_id' => ['bail', 'nullable', 'exists:project_statuses,id']
        ];

        $validation_list = [];

        Validator::make($request->all(), $input_list, $validation_list)->validate();

        $project_zone_id = $request->input('project_zone_id');
        $project_location_id = $request->input('project_location_id');
        $project_category_id = $request->input('project_category_id');
        $project_type_id = $request->input('project_type_id');
        $project_status_id = $request->input('project_status_id');

        if(!empty($project_type_id)) {
            $projects = DB::table('projects')
            ->select('id', 'project_name', 'project_url_slug', 'project_thumbnail', 'project_template_id', 'project_accommodation_type', 'project_location_text')
            ->where('display_status', 1)
            ->where('project_type_id', $project_type_id)
            ->groupBy('projects.id')
            ->orderBy('projects.sorting_order')
            ->get();
        } else if(!empty($project_status_id)) {
            $projects = DB::table('projects')
            ->select('id', 'project_name', 'project_url_slug', 'project_thumbnail', 'project_template_id', 'project_accommodation_type', 'project_location_text')
            ->where('display_status', 1)
            ->where('project_status_id', $project_status_id)
            ->groupBy('projects.id')
            ->orderBy('projects.sorting_order')
            ->get();
        } else if(!empty($project_zone_id) && !empty($project_location_id) && !empty($project_category_id)) {
            $projects = DB::table('projects')
            ->select('projects.id', 'projects.project_name', 'project_url_slug', 'projects.project_thumbnail', 'project_template_id', 'project_accommodation_type', 'project_location_text')
            ->join('project_selected_categories', 'project_selected_categories.project_id', 'projects.id')
            ->where('projects.display_status', 1)
            ->where('projects.project_zone_id', $project_zone_id)
            ->where('projects.project_location_id', $project_location_id)
            ->where('project_selected_categories.project_category_id', $project_category_id)
            ->groupBy('projects.id')
            ->orderBy('projects.sorting_order')
            ->get();
        } else if(empty($project_zone_id) && !empty($project_location_id) && !empty($project_category_id)) {
            $projects = DB::table('projects')
            ->select('projects.id', 'projects.project_name', 'project_url_slug', 'projects.project_thumbnail', 'project_template_id', 'project_accommodation_type', 'project_location_text')
            ->join('project_selected_categories', 'project_selected_categories.project_id', 'projects.id')
            ->where('projects.display_status', 1)
            ->where('projects.project_location_id', $project_location_id)
            ->where('project_selected_categories.project_category_id', $project_category_id)
            ->groupBy('projects.id')
            ->orderBy('projects.sorting_order')
            ->get();
        } else if(!empty($project_zone_id) && empty($project_location_id) && !empty($project_category_id)) {
            $projects = DB::table('projects')
            ->select('projects.id', 'projects.project_name', 'project_url_slug', 'projects.project_thumbnail', 'project_template_id', 'project_accommodation_type', 'project_location_text')
            ->join('project_selected_categories', 'project_selected_categories.project_id', 'projects.id')
            ->where('projects.display_status', 1)
            ->where('projects.project_zone_id', $project_zone_id)
            ->where('project_selected_categories.project_category_id', $project_category_id)
            ->groupBy('projects.id')
            ->orderBy('projects.sorting_order')
            ->get();
        } else if(!empty($project_zone_id) && !empty($project_location_id) && empty($project_category_id)) {
            $projects = DB::table('projects')
            ->select('projects.id', 'projects.project_name', 'project_url_slug', 'projects.project_thumbnail', 'project_template_id', 'project_accommodation_type', 'project_location_text')
            ->join('project_selected_categories', 'project_selected_categories.project_id', 'projects.id')
            ->where('projects.display_status', 1)
            ->where('projects.project_zone_id', $project_zone_id)
            ->where('projects.project_location_id', $project_location_id)
            ->groupBy('projects.id')
            ->orderBy('projects.sorting_order')
            ->get();
        } else if(empty($project_zone_id) && empty($project_location_id) && !empty($project_category_id)) {
            $projects = DB::table('projects')
            ->select('projects.id', 'projects.project_name', 'project_url_slug', 'projects.project_thumbnail', 'project_template_id', 'project_accommodation_type', 'project_location_text')
            ->join('project_selected_categories', 'project_selected_categories.project_id', 'projects.id')
            ->where('projects.display_status', 1)
            ->where('project_selected_categories.project_category_id', $project_category_id)
            ->groupBy('projects.id')
            ->orderBy('projects.sorting_order')
            ->get();
        } else if(empty($project_zone_id) && !empty($project_location_id) && empty($project_category_id)) {
            $projects = DB::table('projects')
            ->select('projects.id', 'projects.project_name', 'project_url_slug', 'projects.project_thumbnail', 'project_template_id', 'project_accommodation_type', 'project_location_text')
            ->join('project_selected_categories', 'project_selected_categories.project_id', 'projects.id')
            ->where('projects.display_status', 1)
            ->where('projects.project_location_id', $project_location_id)
            ->groupBy('projects.id')
            ->orderBy('projects.sorting_order')
            ->get();
        } else if(!empty($project_zone_id) && empty($project_location_id) && empty($project_category_id)) {
            $projects = DB::table('projects')
            ->select('projects.id', 'projects.project_name', 'project_url_slug', 'projects.project_thumbnail', 'project_template_id', 'project_accommodation_type', 'project_location_text')
            ->join('project_selected_categories', 'project_selected_categories.project_id', 'projects.id')
            ->where('projects.display_status', 1)
            ->where('projects.project_zone_id', $project_zone_id)
            ->groupBy('projects.id')
            ->orderBy('projects.sorting_order')
            ->get();
        } else if(empty($project_zone_id) && empty($project_location_id) && empty($project_category_id)) {
            $projects = DB::table('projects')
            ->select('projects.id', 'projects.project_name', 'project_url_slug', 'projects.project_thumbnail', 'project_template_id', 'project_accommodation_type', 'project_location_text')
            ->join('project_selected_categories', 'project_selected_categories.project_id', 'projects.id')
            ->where('projects.display_status', 1)
            ->groupBy('projects.id')
            ->orderBy('projects.sorting_order')
            ->get();
        }

        return view('project_blocks', compact('projects'));
    }

    public function about() {
    	$meta_data = DB::table('meta_data')->find(2);

    	$banner = DB::table('banners')->find(2);

        $banner_two = DB::table('banners')->find(13);

        $timelines = DB::table('timelines')->where('display_status', 1)->orderBy('timeline_year')->get();

        $managements = DB::table('management')->where('display_status', 1)->where('management_category_id', 1)->orderBy('sorting_order')->limit(3)->get();

    	return view('about', compact('meta_data', 'banner', 'timelines', 'managements', 'banner_two'));
    }

    public function projects() {
    	$meta_data = DB::table('meta_data')->find(3);

    	$banner = DB::table('banners')->find(3);

        $project_types = DB::table('project_types')->where('display_status', 1)->get();

        $project_statuses = DB::table('project_statuses')->where('display_status', 1)->get();

        $projects = DB::table('projects')
        ->select('id', 'project_name', 'project_thumbnail', 'project_url_slug', 'project_template_id', 'project_accommodation_type', 'project_location_text')
        ->addSelect(['project_type_title' => DB::table('project_types')
            ->select('project_type_title')
            ->whereColumn('project_types.id', 'projects.project_type_id')])
        ->addSelect(['project_status_title' => DB::table('project_statuses')
            ->select('project_status_title')
            ->whereColumn('project_statuses.id', 'projects.project_status_id')])
        ->orderBy('sorting_order')
        ->get();

    	return view('projects', compact('meta_data', 'banner', 'project_types', 'project_statuses', 'projects'));
    }
    public function commercial_projects() {
    	//$meta_data = DB::table('meta_data')->find(3);

    	//$banner = DB::table('banners')->find(3);

        $project_types = DB::table('project_types')->where('display_status', 1)->get();

        $project_statuses = DB::table('project_statuses')->where('display_status', 1)->get();


        $commercial_projects = DB::table('commercial_project')
        ->select('id', 'project_title as project_name' , 'project_thumbnail', 'project_slug', 'project_location_text','project_description','project_area')
        ->addSelect(['project_type_title' => DB::table('project_types')
            ->select('project_type_title')
            ->whereColumn('project_types.id', 'commercial_project.project_type')])
        ->addSelect(['project_status_title' => DB::table('project_statuses')
            ->select('project_status_title')
            ->whereColumn('project_statuses.id', 'commercial_project.project_status_id')])
        ->orderBy('sorting_order')
        ->get();




    	return view('commercial-projects', compact('project_types', 'project_statuses','commercial_projects'));
    }

    public function project_thank_you($project_url_slug) {
        $project = DB::table('projects')
        ->where('project_url_slug', $project_url_slug)
        ->where('display_status', 1)
        ->first();

        if(empty($project)) {
            abort(404);
        }

        $related_projects = DB::table('projects')
        ->select('projects.id', 'projects.project_name', 'projects.project_thumbnail', 'projects.project_url_slug', 'projects.project_template_id', 'projects.project_accommodation_type', 'projects.project_location_text')
        ->join('related_projects', 'related_projects.related_project_id', '=', 'projects.id')
        ->where('related_projects.project_id', $project->id)
        ->where('related_projects.display_status', 1)
        ->orderBy('projects.project_name')
        ->groupBy('projects.id')
        ->limit(3)
        ->get();

        return view('project_thank_you', compact('project', 'related_projects'));
    }

    public function project_details($project_url_slug) {
        $project = DB::table('projects')
        ->where('project_url_slug', $project_url_slug)
        ->where('display_status', 1)
        ->first();

        if(empty($project)) {
            abort(404);
        }

        if($project->project_template_id == 1) {
            $project_layout_view = "project_details";
        } else if($project->project_template_id == 2) {
            $project_layout_view = "century_seasons";
        } else {
            abort(404);
        }

        $project_sliders = DB::table('project_sliders')->where('display_status', 1)->where('project_id', $project->id)->orderBy('sorting_order')->get();

        $project_video_sliders = DB::table('project_video_sliders')->where('display_status', 1)->where('project_id', $project->id)->orderBy('sorting_order')->get();

        $project_highlighted_amenities = DB::table('project_highlighted_amenities')->where('display_status', 1)->where('project_id', $project->id)->orderBy('sorting_order')->get();

        $project_amenities = DB::table('project_amenities')->where('display_status', 1)->where('project_id', $project->id)->orderBy('sorting_order')->get();

        $project_gallery_categories = DB::table('project_gallery_categories')->orderBy('id')->get();

        $project_galleries = DB::table('project_galleries')
        ->addSelect(['project_gallery_category_title' => DB::table('project_gallery_categories')
            ->select('project_gallery_category_title')
            ->whereColumn('project_gallery_categories.id', 'project_galleries.project_gallery_category_id')])
        ->where('display_status', 1)
        ->where('project_id', $project->id)
        ->orderBy('sorting_order')
        ->get();

        $project_landmarks = DB::table('project_landmarks')->where('display_status', 1)->where('project_id', $project->id)->orderBy('sorting_order')->get();

        $project_plans = DB::table('project_plans')->where('display_status', 1)->where('project_id', $project->id)->orderBy('sorting_order')->get();

        $project_faqs = DB::table('project_faqs')->where('display_status', 1)->where('project_id', $project->id)->orderBy('sorting_order')->get();

        $project_configurations = DB::table('project_configurations')->where('display_status', 1)->where('project_id', $project->id)->orderBy('sorting_order')->get();

        $related_projects = DB::table('projects')
        ->select('projects.id', 'projects.project_name', 'projects.project_thumbnail', 'projects.project_url_slug', 'projects.project_template_id', 'projects.project_accommodation_type', 'projects.project_location_text')
        ->join('related_projects', 'related_projects.related_project_id', '=', 'projects.id')
        ->where('related_projects.project_id', $project->id)
        ->where('related_projects.display_status', 1)
        ->orderBy('projects.project_name')
        ->groupBy('projects.id')
        ->limit(3)
        ->get();

        return view($project_layout_view, compact('project', 'project_sliders', 'project_video_sliders', 'project_highlighted_amenities', 'project_amenities', 'project_gallery_categories', 'project_galleries', 'project_landmarks', 'project_faqs', 'related_projects', 'project_configurations', 'project_plans'));
    }
    public function commercial_project_details($project_url_slug) {
        //$project_url_slug = 'century-arcade';
        //$project_url_slug = 'century-nester';
        // $project = DB::table('commercial_project')
        // ->where('project_slug', $project_url_slug)
        // ->where('status', 1)
        // ->first();

        $project = DB::table('commercial_project')->addSelect(['project_type_text' => DB::table('project_types')->select('project_type_title')->whereColumn('project_types.id', 'commercial_project.project_type')])
        ->where('project_slug', $project_url_slug)
        ->where('status', 1)
        ->first();

        $commercial_projects = DB::table('commercial_project')
        ->select('commercial_project.*','project_title as project_name')
        ->where('project_slug', $project_url_slug)
        ->where('status', 1)
        ->get();

        if(empty($project)) {
            abort(404);
        }

        $project_sliders = DB::table('project_sliders')->where('display_status', 1)->where('project_id', $project->id)->orderBy('sorting_order')->first();


        $project_gallery_categories = DB::table('project_gallery_categories')->orderBy('id')->get();

        $project_galleries = DB::table('project_galleries')
        ->addSelect(['project_gallery_category_title' => DB::table('project_gallery_categories')
            ->select('project_gallery_category_title')
            ->whereColumn('project_gallery_categories.id', 'project_galleries.project_gallery_category_id')])
        ->where('display_status', 1)
        ->where('project_id', $project->id)
        ->orderBy('sorting_order')
        ->get();

        $related_projects = DB::table('commercial_project')
        ->select('commercial_project.id', 'commercial_project.project_title', 'commercial_project.project_thumbnail', 'commercial_project.project_slug', 'commercial_project.project_location_text', 'commercial_project.project_description')
        ->join('related_projects', 'related_projects.related_project_id', '=', 'commercial_project.id')
        ->where('related_projects.project_id', $project->id)
        ->where('related_projects.display_status', 1)
        ->orderBy('commercial_project.project_title')
        ->groupBy('commercial_project.id')
        ->limit(3)
        ->get();

        return view('commercial-projects-details', compact('project','commercial_projects', 'project_sliders', 'project_gallery_categories', 'project_galleries', 'related_projects'));
    }

    public function why_us() {
    	$meta_data = DB::table('meta_data')->find(4);

    	$banner = DB::table('banners')->find(4);

        $why_us_query = DB::table('why_us')->where('display_status', 1)->orderBy('sorting_order')->get();

    	return view('why_us', compact('meta_data', 'banner', 'why_us_query'));
    }

    public function contact() {
    	$meta_data = DB::table('meta_data')->find(5);

    	$banner = DB::table('banners')->find(5);

    	return view('contact', compact('meta_data', 'banner'));
    }

    public function disclaimer() {
    	$meta_data = DB::table('meta_data')->find(6);

    	$banner = DB::table('banners')->find(1);

    	return view('disclaimer', compact('meta_data', 'banner'));
    }

    public function privacy() {
    	$meta_data = DB::table('meta_data')->find(7);

    	$banner = DB::table('banners')->find(1);

    	return view('privacy', compact('meta_data', 'banner'));
    }

    public function terms() {
    	$meta_data = DB::table('meta_data')->find(8);

    	$banner = DB::table('banners')->find(1);

    	return view('terms', compact('meta_data', 'banner'));
    }

    public function videos() {
    	$meta_data = DB::table('meta_data')->find(9);

    	$banner = DB::table('banners')->find(11);

        $video_years = DB::table('videos')
        ->selectRaw("YEAR(video_publish_date) AS single_year")
        ->where('display_status', 1)
        ->orderBy('video_publish_date')
        ->groupBy('single_year')
        ->get();

        if(!empty(count($video_years))) {
            $video_current_year = $video_years[0]->single_year;
        } else {
            $video_current_year = 0;
        }

        $videos = DB::table('videos')
        ->select('video_title', 'video_publish_date', 'youtube_video_id')
        ->whereRaw("YEAR(video_publish_date) = '$video_current_year'")
        ->orderBy('video_publish_date', 'desc')
        ->get();

    	return view('videos', compact('meta_data', 'banner', 'video_years', 'videos'));
    }

    public function filter_video_details(Request $request) {
        $input_list = [
            'selected_year' => ['bail', 'nullable', 'digits:4']
        ];

        $validation_list = [];

        Validator::make($request->all(), $input_list, $validation_list)->validate();

        $selected_year = $request->input('selected_year');

        if(!empty($selected_year)) {
            $videos = DB::table('videos')
            ->select('video_title', 'video_publish_date', 'youtube_video_id')
            ->whereRaw("YEAR(video_publish_date) = '$selected_year'")
            ->orderBy('video_publish_date', 'desc')
            ->get();
        } else {
            $videos = DB::table('videos')
            ->select('video_title', 'video_publish_date', 'youtube_video_id')
            ->orderBy('video_publish_date', 'desc')
            ->get();
        }

        return view('video_blocks', compact('videos'));
    }

    public function associated_enterprises() {
    	$meta_data = DB::table('meta_data')->find(10);

    	$banner = DB::table('banners')->find(6);

    	$navigation_class = 'white';

    	return view('associated_enterprises', compact('meta_data', 'banner', 'navigation_class'));
    }

    public function social_responsibility() {
    	$meta_data = DB::table('meta_data')->find(11);

    	$banner = DB::table('banners')->find(7);

        $sections = DB::table('social_responsibilities')->where('display_status', 1)->orderBy('sorting_order')->get();

        $social_projects = DB::table('social_projects')->where('display_status', 1)->orderBy('sorting_order')->get();

        $galleries = DB::table('galleries')->where('display_status', 1)->orderBy('sorting_order')->get();

        $gallery_image_array = [];

        $i = 0;
        $j = 1;

        foreach($galleries as $gallery_row) {
            $gallery_image_single_array = [
                'gallery_image_name' => $gallery_row->gallery_image_name,
                'gallery_image_caption' => $gallery_row->gallery_image_caption
            ];

            $gallery_image_array[$i][] = $gallery_image_single_array;

            if($j % 3 == 0) {
                $i++;
            }

            $j++;
        }

    	return view('social_responsibility', compact('meta_data', 'banner', 'sections', 'social_projects', 'gallery_image_array'));
    }

    public function corporate_governance() {
    	$meta_data = DB::table('meta_data')->find(12);

    	$banner = DB::table('banners')->find(8);

    	$navigation_class = 'white';

    	return view('corporate_governance', compact('meta_data', 'banner', 'navigation_class'));
    }

    public function rising_north() {
    	$meta_data = DB::table('meta_data')->find(13);

    	$banner = DB::table('banners')->find(1);

    	return view('rising_north', compact('meta_data', 'banner'));
    }

    public function awards() {
        $meta_data = DB::table('meta_data')->find(14);

        $banner = DB::table('banners')->find(15);

        $award_years = DB::table('awards')
        ->selectRaw("YEAR(award_date) AS single_year")
        ->where('display_status', 1)
        ->orderBy('award_date', 'desc')
        ->groupBy('single_year')
        ->get();

        if(!empty(count($award_years))) {
            $award_current_year = $award_years[0]->single_year;
        } else {
            $award_current_year = 0;
        }

        $awards = DB::table('awards')->where('display_status', 1)->orderBy('sorting_order', 'desc')->get();

        return view('awards', compact('meta_data', 'banner', 'awards', 'award_years', 'award_current_year'));
    }

    public function filter_award_details(Request $request) {
        $selected_year = $request->input('selected_year');

        if(empty($selected_year)) {
            $awards = DB::table('awards')->where('display_status', 1)->orderBy('sorting_order')->get();
        } else {
            $awards = DB::table('awards')->where('display_status', 1)->whereRaw("YEAR(award_date) = '$selected_year'")->orderBy('sorting_order')->get();
        }


        return view('award_blocks', compact('awards'));
    }

    public function media() {
    	$meta_data = DB::table('meta_data')->find(15);

    	$banner = DB::table('banners')->find(12);

        $press_years = DB::table('press_contents')
        ->selectRaw("YEAR(press_publish_date) AS single_year")
        ->where('display_status', 1);

        $report_years = DB::table('reports')
        ->selectRaw("YEAR(report_publish_date) AS single_year")
        ->where('display_status', 1);

        $video_years = DB::table('videos')
        ->selectRaw("YEAR(video_publish_date) AS single_year")
        ->where('display_status', 1);

        $media_years = DB::table('media')
        ->selectRaw("YEAR(media_publish_date) AS single_year")
        ->where('display_status', 1)
        ->union($press_years)
        ->union($video_years)
        ->union($report_years)
        ->orderBy('single_year', 'desc')
        ->get();

        $press = DB::table('presses')
        ->select('presses.id', 'presses.press_title')
        ->join('press_contents', 'press_contents.press_id', '=', 'presses.id')
        ->where('presses.display_status', 1)
        ->where('press_contents.display_status', 1)
        ->orderBy('press_contents.press_publish_date', 'desc')
        ->groupBy('presses.id')
        ->get();

        $press_contents = DB::table('press_contents')
        ->select('press_id', 'press_media_title', 'press_publish_date', 'press_link_attachment', 'press_link', 'press_attachment')
        ->where('press_contents.display_status', 1)
        ->orderBy('sorting_order')
        ->get();

        $press_content_array = [];

        foreach($press_contents as $press_content_row) {
            $press_content_array[$press_content_row->press_id][] = [
                'press_media_title' => $press_content_row->press_media_title,
                'press_publish_date' => $press_content_row->press_publish_date,
                'press_link_attachment' => $press_content_row->press_link_attachment,
                'press_link' => $press_content_row->press_link,
                'press_attachment' => $press_content_row->press_attachment
            ];
        }

        $media_types = DB::table('media_types')
        ->select('id', 'media_type_title')
        ->orderBy('sorting_order')
        ->get();

    	return view('media', compact('meta_data', 'banner', 'media_years', 'press', 'press_content_array', 'media_types'));
    }

    public function filter_media_details(Request $request) {
        $input_list = [
            'selected_year' => ['bail', 'nullable', 'digits:4']
        ];

        $validation_list = [];

        Validator::make($request->all(), $input_list, $validation_list)->validate();

        $selected_year = $request->input('selected_year');

        if(!empty($selected_year)) {
            $media = DB::table('media')
            ->select('media_title', 'media_publish_date', 'media_thumbnail', 'media_pdf')
            ->whereRaw("YEAR(media_publish_date) = '$selected_year'")
            ->orderBy('media_publish_date', 'desc')
            ->get();
        } else {
            $media = DB::table('media')
            ->select('media_title', 'media_publish_date', 'media_thumbnail', 'media_pdf')
            ->orderBy('media_publish_date', 'desc')
            ->get();
        }

        return view('media_blocks', compact('media'));
    }

    public function filter_report_details(Request $request) {
        $input_list = [
            'selected_year' => ['bail', 'nullable', 'digits:4']
        ];

        $validation_list = [];

        Validator::make($request->all(), $input_list, $validation_list)->validate();

        $selected_year = $request->input('selected_year');

        if(!empty($selected_year)) {
            $reports = DB::table('reports')
            ->select('report_title', 'report_publish_date', 'report_thumbnail', 'report_pdf')
            ->whereRaw("YEAR(report_publish_date) = '$selected_year'")
            ->orderBy('report_publish_date', 'desc')
            ->get();
        } else {
            $reports = DB::table('reports')
            ->select('report_title', 'report_publish_date', 'report_thumbnail', 'report_pdf')
            ->orderBy('report_publish_date', 'desc')
            ->get();
        }

        return view('report_blocks', compact('reports'));
    }

    public function customer_testimonials() {
        $meta_data = DB::table('meta_data')->find(16);

        $banner = DB::table('banners')->find(14);

        $testimonials = DB::table('testimonials')
        ->where('display_status', 1)
        ->orderBy('sorting_order')
        ->get();

        return view('customer_testimonials', compact('meta_data', 'banner', 'testimonials'));
    }

    public function referrals() {
    	$meta_data = DB::table('meta_data')->find(17);

    	$banner = DB::table('banners')->find(18);

    	return view('referrals', compact('meta_data', 'banner'));
    }

    public function century_appreciation() {
    	$meta_data = DB::table('meta_data')->find(18);

    	$banner = DB::table('banners')->find(1);

    	return view('century_appreciation', compact('meta_data', 'banner'));
    }

    public function nri_corner() {
    	$meta_data = DB::table('meta_data')->find(19);

    	$banner = DB::table('banners')->find(19);

    	return view('nri_corner', compact('meta_data', 'banner'));
    }

    public function century_connect() {
    	$meta_data = DB::table('meta_data')->find(20);

    	$banner = DB::table('banners')->find(16);

    	return view('century_connect', compact('meta_data', 'banner'));
    }

    public function life_at_century() {
    	$meta_data = DB::table('meta_data')->find(21);

    	$banner = DB::table('banners')->find(17);

    	return view('life_at_century', compact('meta_data', 'banner'));
    }

    public function blog() {
    	$meta_data = DB::table('meta_data')->find(22);

    	$banner = DB::table('banners')->find(1);

    	return view('blog', compact('meta_data', 'banner'));
    }

    public function press() {
    	$meta_data = DB::table('meta_data')->find(23);

    	$banner = DB::table('banners')->find(10);

        $press_years = DB::table('press_contents')
        ->selectRaw("YEAR(press_publish_date) AS single_year")
        ->where('display_status', 1)
        ->orderBy('press_publish_date', 'desc')
        ->groupBy('single_year')
        ->get();

        if(!empty(count($press_years))) {
            $press_current_year = $press_years[0]->single_year;
        } else {
            $press_current_year = 0;
        }

        $press = DB::table('presses')
        ->select('presses.id', 'presses.press_title')
        ->join('press_contents', 'press_contents.press_id', '=', 'presses.id')
        ->whereRaw("YEAR(press_contents.press_publish_date) = '$press_current_year'")
        ->where('presses.display_status', 1)
        ->where('press_contents.display_status', 1)
        ->orderBy('press_contents.press_publish_date')
        ->groupBy('presses.id')
        ->get();

        $press_contents = DB::table('press_contents')
        ->select('press_id', 'press_media_title', 'press_publish_date', 'press_link_attachment', 'press_link', 'press_attachment')
        ->whereRaw("YEAR(press_publish_date) = '$press_current_year'")
        ->where('press_contents.display_status', 1)
        ->orderBy('sorting_order')
        ->get();

        $press_content_array = [];

        foreach($press_contents as $press_content_row) {
            $press_content_array[$press_content_row->press_id][] = [
                'press_media_title' => $press_content_row->press_media_title,
                'press_publish_date' => $press_content_row->press_publish_date,
                'press_link_attachment' => $press_content_row->press_link_attachment,
                'press_link' => $press_content_row->press_link,
                'press_attachment' => $press_content_row->press_attachment
            ];
        }

    	return view('press', compact('meta_data', 'banner', 'press_years', 'press', 'press_content_array'));
    }

    public function filter_press_details(Request $request) {
        $input_list = [
            'selected_year' => ['bail', 'nullable', 'digits:4']
        ];

        $validation_list = [];

        Validator::make($request->all(), $input_list, $validation_list)->validate();

        $selected_year = $request->input('selected_year');

        if(!empty($selected_year)) {
            $press = DB::table('presses')
            ->select('presses.id', 'presses.press_title')
            ->join('press_contents', 'press_contents.press_id', '=', 'presses.id')
            ->whereRaw("YEAR(press_contents.press_publish_date) = '$selected_year'")
            ->where('presses.display_status', 1)
            ->where('press_contents.display_status', 1)
            ->orderBy('press_contents.press_publish_date', 'desc')
            ->groupBy('presses.id')
            ->get();

            $press_contents = DB::table('press_contents')
            ->select('press_id', 'press_media_title', 'press_publish_date', 'press_link_attachment', 'press_link', 'press_attachment')
            ->whereRaw("YEAR(press_publish_date) = '$selected_year'")
            ->where('press_contents.display_status', 1)
            ->orderBy('sorting_order')
            ->get();
        } else {
            $press = DB::table('presses')
            ->select('presses.id', 'presses.press_title')
            ->join('press_contents', 'press_contents.press_id', '=', 'presses.id')
            ->where('presses.display_status', 1)
            ->where('press_contents.display_status', 1)
            ->orderBy('press_contents.press_publish_date', 'desc')
            ->groupBy('presses.id')
            ->get();

            $press_contents = DB::table('press_contents')
            ->select('press_id', 'press_media_title', 'press_publish_date', 'press_link_attachment', 'press_link', 'press_attachment')
            ->where('press_contents.display_status', 1)
            ->orderBy('sorting_order')
            ->get();
        }

        $press_content_array = [];

        foreach($press_contents as $press_content_row) {
            $press_content_array[$press_content_row->press_id][] = [
                'press_media_title' => $press_content_row->press_media_title,
                'press_publish_date' => $press_content_row->press_publish_date,
                'press_link_attachment' => $press_content_row->press_link_attachment,
                'press_link' => $press_content_row->press_link,
                'press_attachment' => $press_content_row->press_attachment
            ];
        }

        return view('press_blocks', compact('press', 'press_content_array'));
    }

    public function key_management() {
        $meta_data = DB::table('meta_data')->find(24);

        $banner = DB::table('banners')->find(9);

        $board_managements = DB::table('management')->where('display_status', 1)->where('management_category_id', 1)->orderBy('sorting_order')->get();
        $key_managements = DB::table('management')->where('display_status', 1)->where('management_category_id', 2)->orderBy('sorting_order')->get();

        return view('key_management', compact('meta_data', 'banner', 'board_managements', 'key_managements'));
    }

    public function contact_enquiry_form_details(Request $request) {
        $input_list = [
            'contact_enquiry_name' => ['bail', 'required'],
            'contact_enquiry_email_id' => ['bail', 'required', 'email'],
            'contact_enquiry_isd_code' => ['bail', 'required'],
            'contact_enquiry_mobile_number' => ['bail', 'required', 'numeric'],
            'contact_enquiry_comments' => ['bail', 'required']
        ];

        $validation_list = [
            'contact_enquiry_name.required' => 'Please enter your name',
            'contact_enquiry_email_id.required' => 'Please enter your email ID',
            'contact_enquiry_email_id.email' => 'Please enter a valid email ID',
            'contact_enquiry_isd_code.required' => 'Please select your country',
            'contact_enquiry_mobile_number.required' => 'Please enter your mobile number',
            'contact_enquiry_mobile_number.numeric' => 'Please enter only numbers',
            'contact_enquiry_comments.required' => 'Please type your query'
        ];

        Validator::make($request->all(), $input_list, $validation_list)->validate();

        $enquiry_name = $request->input('contact_enquiry_name');
        $enquiry_email_id = $request->input('contact_enquiry_email_id');
        $enquiry_isd_code = $request->input('contact_enquiry_isd_code');
        $enquiry_mobile_number = $request->input('contact_enquiry_mobile_number');
        $enquiry_comments = $request->input('contact_enquiry_comments');
        $ip_address = $request->ip();
        $referral_url = $request->server('HTTP_REFERER');

        $enquiry = new \App\Models\ContactEnquiry;
        $enquiry->enquiry_name = $enquiry_name;
        $enquiry->enquiry_email_id = $enquiry_email_id;
        $enquiry->enquiry_isd_code = $enquiry_isd_code;
        $enquiry->enquiry_mobile_number = $enquiry_mobile_number;
        $enquiry->enquiry_comments = $enquiry_comments;
        $enquiry->ip_address = $ip_address;
        $enquiry->referral_url = $referral_url;

        $platform_name = Browser::platformName();
        $browser_name = Browser::browserName();

        $device_details = "$platform_name - $browser_name";

        $referral_url = strstr($referral_url, "?");
        $referral_url = str_replace("?", "", $referral_url);

        if(!empty($referral_url)) {
            $referer_url_array = explode("&", $referral_url);

            $campaign_data = array();

            foreach($referer_url_array as $single_pair) {
                $single_pair_array = explode("=", $single_pair);

                $campaign_data[$single_pair_array[0]] = $single_pair_array[1];

                if($single_pair_array[0] == "gclid") {
                    $campaign_data["utm_source"] = "Google";
                }
            }

            if(isset($campaign_data['utm_source'])) {
                $enquiry->utm_source = $campaign_data['utm_source'];
            }

            if(isset($campaign_data['utm_medium'])) {
                $enquiry->utm_medium = $campaign_data['utm_medium'];
            }

            if(isset($campaign_data['utm_campaign'])) {
                $enquiry->utm_campaign = $campaign_data['utm_campaign'];
            }

            if(isset($campaign_data['utm_term'])) {
                $enquiry->utm_term = $campaign_data['utm_term'];
            }

            if(isset($campaign_data['utm_content'])) {
                $enquiry->utm_content = $campaign_data['utm_content'];
            }
        }

        $enquiry->user_device = $device_details;
        $enquiry->otp_status = "Unverified";
        $enquiry->save();
        $enquiry_id = $enquiry->id;

        $enquiry = DB::table('contact_enquiries')->find($enquiry_id);

        $admin_email_id = "chatleads@centuryrealestate.in";

        $cc_email_ids = ["anirban.d@centuryrealestate.in", "deepak.mc@centuryrealestate.in"];

        Mail::to($admin_email_id)->cc($cc_email_ids)->send(new \App\Mail\ContactEnquiryAdminEmail($enquiry));

        $otp_code = mt_rand(1000, 9999);

        $request->session()->forget(['download_type', 'project_id', 'media_kit_id']);
        $request->session()->put('contact_enquiry_id', $enquiry_id);
        $request->session()->put('otp_code', $otp_code);
        $request->session()->put('enquiry_isd_code', $enquiry_isd_code);
        $request->session()->put('enquiry_mobile_number', $enquiry_mobile_number);
        $request->session()->put('template_id', "60b89c28eb9de559ca707bb2");

        $this->send_sms($enquiry_isd_code.$enquiry_mobile_number, $otp_code, "60b89c28eb9de559ca707bb2");

        /*
        $post_data = [
            'name' => urlencode($enquiry->enquiry_name),
            'phone' => urlencode($enquiry->enquiry_mobile_number),
            'email' => urlencode($enquiry->enquiry_email_id),
            'remarks' => urlencode($enquiry->enquiry_comments),
            'country_code' => urlencode("+".$enquiry->enquiry_isd_code),
            'project_name' => '',
            'key' => urlencode("bm1iemo0cHloMGY5MDk0Yzh1Ynk=")
        ];

        $this->crm_api("http://portal.centuryrealestate.in/lpi/contactus", $post_data); */

        return response()->json(['response_code' => 200]);
    }

    public function enquiry_form_details(Request $request) {
        $input_list = [
            'enquiry_form_name' => ['bail', 'required'],
            'enquiry_name' => ['bail', 'required'],
            'enquiry_email_id' => ['bail', 'required', 'email'],
            'enquiry_isd_code' => ['bail', 'required'],
            'enquiry_mobile_number' => ['bail', 'required', 'numeric'],
            'enquiry_project_id' => ['bail', 'required', 'exists:projects,id'],
            'enquiry_comments' => ['bail', 'required']
        ];

        $validation_list = [
            'enquiry_name.required' => 'Please enter your name',
            'enquiry_email_id.required' => 'Please enter your email ID',
            'enquiry_email_id.email' => 'Please enter a valid email ID',
            'enquiry_isd_code.required' => 'Please select your country',
            'enquiry_mobile_number.required' => 'Please enter your mobile number',
            'enquiry_mobile_number.numeric' => 'Please enter only numbers',
            'enquiry_project_id.required' => 'Please select a project',
            'enquiry_project_id.exists' => 'Please select a valid project',
            'enquiry_comments.required' => 'Please type your query'
        ];

        Validator::make($request->all(), $input_list, $validation_list)->validate();

        $request->session()->forget(['project_id', 'download_type']);

        $enquiry_form_name = $request->input('enquiry_form_name');
        $enquiry_name = $request->input('enquiry_name');
        $enquiry_email_id = $request->input('enquiry_email_id');
        $enquiry_isd_code = $request->input('enquiry_isd_code');
        $enquiry_mobile_number = $request->input('enquiry_mobile_number');
        $enquiry_project_id = $request->input('enquiry_project_id');
        $enquiry_comments = $request->input('enquiry_comments');
        $ip_address = $request->ip();
        $referral_url = $request->server('HTTP_REFERER');

        $enquiry = new \App\Models\Enquiry;
        $enquiry->enquiry_name = $enquiry_name;
        $enquiry->enquiry_email_id = $enquiry_email_id;
        $enquiry->enquiry_isd_code = $enquiry_isd_code;
        $enquiry->enquiry_mobile_number = $enquiry_mobile_number;
        $enquiry->enquiry_project_id = $enquiry_project_id;
        $enquiry->enquiry_comments = $enquiry_comments;
        $enquiry->enquiry_form_name = $enquiry_form_name;
        $enquiry->ip_address = $ip_address;
        $enquiry->referral_url = $referral_url;

        $platform_name = Browser::platformName();
        $browser_name = Browser::browserName();

        $device_details = "$platform_name - $browser_name";

        $referral_url = strstr($referral_url, "?");
        $referral_url = str_replace("?", "", $referral_url);

        if(!empty($referral_url)) {
            $referer_url_array = explode("&", $referral_url);

            $campaign_data = array();

            foreach($referer_url_array as $single_pair) {
                $single_pair_array = explode("=", $single_pair);

                $campaign_data[$single_pair_array[0]] = $single_pair_array[1];

                if($single_pair_array[0] == "gclid") {
                    $campaign_data["utm_source"] = "Google";
                }
            }

            if(isset($campaign_data['utm_source'])) {
                $enquiry->utm_source = $campaign_data['utm_source'];
            }

            if(isset($campaign_data['utm_medium'])) {
                $enquiry->utm_medium = $campaign_data['utm_medium'];
            }

            if(isset($campaign_data['utm_campaign'])) {
                $enquiry->utm_campaign = $campaign_data['utm_campaign'];
            }

            if(isset($campaign_data['utm_term'])) {
                $enquiry->utm_term = $campaign_data['utm_term'];
            }

            if(isset($campaign_data['utm_content'])) {
                $enquiry->utm_content = $campaign_data['utm_content'];
            }
        }

        $enquiry->user_device = $device_details;
        $enquiry->otp_status = "Unverified";
        $enquiry->save();
        $enquiry_id = $enquiry->id;

        $enquiry = DB::table('enquiries')
        ->addSelect(['project_name' => DB::table('projects')
            ->select('project_name')
            ->whereColumn('projects.id', 'enquiries.enquiry_project_id')])
        ->where('id', $enquiry_id)
        ->first();

        $admin_email_id = "chatleads@centuryrealestate.in";

        $cc_email_ids = ["anirban.d@centuryrealestate.in", "presales@centuryrealestate.in"];

        Mail::to($admin_email_id)->cc($cc_email_ids)->send(new \App\Mail\EnquiryAdminEmail($enquiry));

        $project = DB::table('projects')->find($enquiry_project_id);

        /*

        if(!empty($project->api_url)) {
            $post_data = [
                'project' => urlencode($project->project_name),
                'name' => urlencode($enquiry_name),
                'phone' => urlencode($enquiry_isd_code.$enquiry_mobile_number),
                'email' => urlencode($enquiry_email_id),
                'remarks' => urlencode($enquiry_comments),
                'key' => urlencode($project->api_key)
            ];

            $this->crm_api($project->api_url, $post_data);
        }

        $post_data = [
            'Name' => $enquiry_name,
            'Mobile' => $enquiry_isd_code.$enquiry_mobile_number,
            'Email' => $enquiry_email_id,
            'Project_Name' => $project->project_name,
            'Campaign_Code' => 'Corporate001',
            'Comments' => $enquiry_comments
        ];

        $this->record_sforce_prod($post_data); */

        $otp_code = mt_rand(1000, 9999);

        $request->session()->forget(['download_type', 'project_id', 'media_kit_id']);
        $request->session()->put('enquiry_id', $enquiry_id);
        $request->session()->put('otp_code', $otp_code);
        $request->session()->put('enquiry_isd_code', $enquiry_isd_code);
        $request->session()->put('enquiry_mobile_number', $enquiry_mobile_number);
        $request->session()->put('template_id', $project->sms_gateway_key);

        $this->send_sms($enquiry_isd_code.$enquiry_mobile_number, $otp_code, $project->sms_gateway_key);

        $projectName = $project->project_name;

        if($projectName != "Century Sports Village") {
            $mailerName = $enquiry_name;

            $mailerEmail = $enquiry_email_id;

            include '/data/www/ftp/microsites/ftp/files/mailer/corporate.php';
        }

        return response()->json(['response_code' => 200]);
    }

    public function media_kit_enquiry_form_pop_details(Request $request) {
        $input_list = [
            'media_kit_pop_name' => ['bail', 'required'],
            'media_kit_pop_email_id' => ['bail', 'required', 'email'],
            'media_kit_pop_isd_code' => ['bail', 'required'],
            'media_kit_pop_mobile_number' => ['bail', 'required', 'numeric']
        ];

        $validation_list = [
            'media_kit_pop_name.required' => 'Please enter your name',
            'media_kit_pop_email_id.required' => 'Please enter your email ID',
            'media_kit_pop_email_id.email' => 'Please enter a valid email ID',
            'media_kit_pop_isd_code.required' => 'Please select your country',
            'media_kit_pop_mobile_number.required' => 'Please enter your mobile number',
            'media_kit_pop_mobile_number.numeric' => 'Please enter only numbers'
        ];

        Validator::make($request->all(), $input_list, $validation_list)->validate();

        $media_kit_name = $request->input('media_kit_pop_name');
        $media_kit_email_id = $request->input('media_kit_pop_email_id');
        $media_kit_isd_code = $request->input('media_kit_pop_isd_code');
        $media_kit_mobile_number = $request->input('media_kit_pop_mobile_number');
        $ip_address = $request->ip();
        $referral_url = $request->server('HTTP_REFERER');

        $enquiry = new \App\Models\MediaKitEnquiry;
        $enquiry->enquiry_name = $media_kit_name;
        $enquiry->enquiry_email_id = $media_kit_email_id;
        $enquiry->enquiry_isd_code = $media_kit_isd_code;
        $enquiry->enquiry_mobile_number = $media_kit_mobile_number;
        $enquiry->ip_address = $ip_address;
        $enquiry->referral_url = $referral_url;

        $platform_name = Browser::platformName();
        $browser_name = Browser::browserName();

        $device_details = "$platform_name - $browser_name";

        $referral_url = strstr($referral_url, "?");
        $referral_url = str_replace("?", "", $referral_url);

        if(!empty($referral_url)) {
            $referer_url_array = explode("&", $referral_url);

            $campaign_data = array();
            
            foreach($referer_url_array as $single_pair) {
                $single_pair_array = explode("=", $single_pair);
                
                $campaign_data[$single_pair_array[0]] = $single_pair_array[1];

                if($single_pair_array[0] == "gclid") {
                    $campaign_data["utm_source"] = "Google";
                }
            }

            if(isset($campaign_data['utm_source'])) {
                $enquiry->utm_source = $campaign_data['utm_source'];
            }

            if(isset($campaign_data['utm_medium'])) {
                $enquiry->utm_medium = $campaign_data['utm_medium'];
            }

            if(isset($campaign_data['utm_campaign'])) {
                $enquiry->utm_campaign = $campaign_data['utm_campaign'];
            }

            if(isset($campaign_data['utm_term'])) {
                $enquiry->utm_term = $campaign_data['utm_term'];
            }

            if(isset($campaign_data['utm_content'])) {
                $enquiry->utm_content = $campaign_data['utm_content'];
            }
        }

        
        $enquiry->user_device = $device_details;
        $enquiry->otp_status = "Unverified";
        $enquiry->save();
        $enquiry_id = $enquiry->id;

        $otp_code = mt_rand(1000, 9999);

        $request->session()->forget(['download_type', 'project_id', 'enquiry_id']);
        $request->session()->put('media_kit_id', $enquiry_id);
        $request->session()->put('otp_code', $otp_code);
        $request->session()->put('media_kit_isd_code', $media_kit_isd_code);
        $request->session()->put('media_kit_mobile_number', $media_kit_mobile_number);
        $request->session()->put('template_id', "60b5d8e14bb7e35e6623dbf8");

        $this->send_sms($media_kit_isd_code.$media_kit_mobile_number, $otp_code, "60b5d8e14bb7e35e6623dbf8");

        return response()->json(['response_code' => 200]);
    }

    public function enquiry_form_pop_details(Request $request) {
        $input_list = [
            'enquiry_pop_name' => ['bail', 'required'],
            'enquiry_pop_email_id' => ['bail', 'required', 'email'],
            'enquiry_pop_isd_code' => ['bail', 'required'],
            'enquiry_pop_mobile_number' => ['bail', 'required', 'numeric']
        ];

        $validation_list = [
            'enquiry_pop_name.required' => 'Please enter your name',
            'enquiry_pop_email_id.required' => 'Please enter your email ID',
            'enquiry_pop_email_id.email' => 'Please enter a valid email ID',
            'enquiry_pop_isd_code.required' => 'Please select your country',
            'enquiry_pop_mobile_number.required' => 'Please enter your mobile number',
            'enquiry_pop_mobile_number.numeric' => 'Please enter only numbers'
        ];

        Validator::make($request->all(), $input_list, $validation_list)->validate();

        $enquiry_name = $request->input('enquiry_pop_name');
        $enquiry_email_id = $request->input('enquiry_pop_email_id');
        $enquiry_isd_code = $request->input('enquiry_pop_isd_code');
        $enquiry_mobile_number = $request->input('enquiry_pop_mobile_number');
        $enquiry_project_id = $request->session()->get('project_id');
        $ip_address = $request->ip();
        $referral_url = $request->server('HTTP_REFERER');        

        $enquiry = new \App\Models\Enquiry;
        $enquiry->enquiry_name = $enquiry_name;
        $enquiry->enquiry_email_id = $enquiry_email_id;
        $enquiry->enquiry_isd_code = $enquiry_isd_code;
        $enquiry->enquiry_mobile_number = $enquiry_mobile_number;
        $enquiry->enquiry_project_id = $enquiry_project_id;
        $enquiry->ip_address = $ip_address;
        $enquiry->referral_url = $referral_url;

        $platform_name = Browser::platformName();
        $browser_name = Browser::browserName();

        $device_details = "$platform_name - $browser_name";

        $referral_url = strstr($referral_url, "?");
        $referral_url = str_replace("?", "", $referral_url);

        if(!empty($referral_url)) {
            $referer_url_array = explode("&", $referral_url);

            $campaign_data = array();
            
            foreach($referer_url_array as $single_pair) {
                $single_pair_array = explode("=", $single_pair);

                if(isset($single_pair_array[1])) {
                    $campaign_data[$single_pair_array[0]] = $single_pair_array[1];
                } else {
                    $campaign_data[$single_pair_array[0]] = "";
                }

                if($single_pair_array[0] == "gclid") {
                    $campaign_data["utm_source"] = "Google";
                }
            }

            if(isset($campaign_data['utm_source'])) {
                $enquiry->utm_source = $campaign_data['utm_source'];
            }

            if(isset($campaign_data['utm_medium'])) {
                $enquiry->utm_medium = $campaign_data['utm_medium'];
            }

            if(isset($campaign_data['utm_campaign'])) {
                $enquiry->utm_campaign = $campaign_data['utm_campaign'];
            }

            if(isset($campaign_data['utm_term'])) {
                $enquiry->utm_term = $campaign_data['utm_term'];
            }

            if(isset($campaign_data['utm_content'])) {
                $enquiry->utm_content = $campaign_data['utm_content'];
            }
        }

        
        $enquiry->user_device = $device_details;
        $enquiry->otp_status = "Unverified";
        $enquiry->save();
        $enquiry_id = $enquiry->id;

        $enquiry = DB::table('enquiries')
        ->addSelect(['project_name' => DB::table('projects')
            ->select('project_name')
            ->whereColumn('projects.id', 'enquiries.enquiry_project_id')])
        ->where('id', $enquiry_id)
        ->first();

        $admin_email_id = "chatleads@centuryrealestate.in";

        $cc_email_ids = ["anirban.d@centuryrealestate.in", "presales@centuryrealestate.in"];

        Mail::to($admin_email_id)->cc($cc_email_ids)->send(new \App\Mail\EnquiryAdminEmail($enquiry));

        if(!empty($enquiry_project_id)) {
            $project = DB::table('projects')->find($enquiry_project_id);

            /*
            if(!empty($project->api_url)) {
                $post_data = [
                    'project' => urlencode($project->project_name),
                    'name' => urlencode($enquiry_name),
                    'phone' => urlencode($enquiry_isd_code.$enquiry_mobile_number),
                    'email' => urlencode($enquiry_email_id),
                    'remarks' => '',
                    'key' => urlencode($project->api_key)
                ];

                $this->crm_api($project->api_url, $post_data);
            }

            $post_data = [
                'Name' => $enquiry_name,
                'Mobile' => $enquiry_isd_code.$enquiry_mobile_number,
                'Email' => $enquiry_email_id,
                'Project_Name' => $project->project_name,
                'Campaign_Code' => 'Corporate001',
                'Comments' => ''
            ];

            $this->record_sforce_prod($post_data); */

            $otp_code = mt_rand(1000, 9999);

            $request->session()->forget(['download_type', 'project_id', 'media_kit_id']);
            $request->session()->put('enquiry_id', $enquiry_id);
            $request->session()->put('otp_code', $otp_code);
            $request->session()->put('enquiry_isd_code', $enquiry_isd_code);
            $request->session()->put('enquiry_mobile_number', $enquiry_mobile_number);
            $request->session()->put('template_id', $project->sms_gateway_key);

            $this->send_sms($enquiry_isd_code.$enquiry_mobile_number, $otp_code, $project->sms_gateway_key);

            $projectName = $project->project_name;

            if($projectName != "Century Sports Village") {
                $mailerName = $enquiry_name;

                $mailerEmail = $enquiry_email_id;

                include '/data/www/ftp/microsites/ftp/files/mailer/corporate.php';
            }
        }

        return response()->json(['response_code' => 200]);
    }

    public function download_pdf_file(Request $request) {
        $project_id = $request->session()->get('project_id');
        $download_type = $request->session()->get('download_type');

        if(empty($project_id)) {
            abort(404);
        } else if(empty($download_type)) {
            abort(404);
        }

        $project = DB::table('projects')->find($project_id);

        if($download_type == 1) {
            $file_name = $project->project_brochure;
        }

        return response()->download("./assets/pdfs/$file_name", $project->project_name.'.pdf');
    }

    public function download_media_kit_file(Request $request) {
        $media_kit_file_name = DB::table('media_kits')->find(1)->media_kit_file_name;

        return response()->download("./assets/images/media/$media_kit_file_name");
    }

    public function verify_otp_details(Request $request) {
        $otp_digit_array = $request->input('otp_digit');

        $otp_digits = implode("", $otp_digit_array);

        $sent_otp_code = $request->session()->get('otp_code');
        $media_kit_id = $request->session()->get('media_kit_id');
        $contact_enquiry_id = $request->session()->get('contact_enquiry_id');
        $enquiry_id = $request->session()->get('enquiry_id');
        $project_id = $request->session()->get('project_id');
        $download_type = $request->session()->get('download_type');

        if($sent_otp_code != $otp_digits) {
            return response()->json(['errors' => ['otp_digit' => "Please enter a valid OTP"]], 422);
        } else {
            if(!empty($enquiry_id)) {
                $enquiry = \App\Models\Enquiry::find($enquiry_id);

                $enquiry_count = DB::table('enquiries')
                ->select('id')
                ->where('enquiry_mobile_number', $enquiry->enquiry_mobile_number)
                ->where('otp_status', 'Verified')
                ->whereRaw('enquiry_project_id IS NOT NULL')
                ->count();

                $enquiry->otp_status = "Verified";
                $enquiry->save();

                if(!empty($enquiry->enquiry_project_id) && empty($enquiry_count)) {
                    $project = DB::table('projects')->find($enquiry->enquiry_project_id);

                    if(!empty($project->api_url)) {
                        $post_data = [
                            'project' => urlencode($project->project_name),
                            'name' => urlencode($enquiry->enquiry_name),
                            'phone' => urlencode($enquiry->enquiry_isd_code.$enquiry->enquiry_mobile_number),
                            'email' => urlencode($enquiry->enquiry_email_id),
                            'remarks' => urlencode($enquiry->enquiry_comments),
                            'key' => urlencode($project->api_key)
                        ];

                        $this->crm_api($project->api_url, $post_data);
                    }

                    $post_data = [
                        'Name' => $enquiry->enquiry_name,
                        'Mobile' => $enquiry->enquiry_isd_code.$enquiry->enquiry_mobile_number,
                        'Email' => $enquiry->enquiry_email_id,
                        'Project_Name' => $project->project_name,
                        'Campaign_Code' => 'Corporate001',
                        'Comments' => $enquiry->enquiry_comments
                    ];

                    $this->record_sforce_prod($post_data);
                }
            } else if(!empty($contact_enquiry_id)) {
                $enquiry = \App\Models\ContactEnquiry::find($contact_enquiry_id);
                $enquiry->otp_status = "Verified";
                $enquiry->save();
            } else if(!empty($media_kit_id)) {
                $enquiry = \App\Models\MediaKitEnquiry::find($media_kit_id);
                $enquiry->otp_status = "Verified";
                $enquiry->save();
            }

            if(!empty($media_kit_id)) {
                $display_message = $project_url_slug = "";
                $pdf_file_download = 2;
            } else if(!empty($project_id) && !empty($download_type)) {
                $display_message = $project_url_slug = "";
                $pdf_file_download = 1;
            } else if(!empty($contact_enquiry_id)) {
                $project_url_slug = "";
                $display_message = "Thank you! We will contact you soon.";
                $pdf_file_download = "";
            } else {
                $project_id = $enquiry->enquiry_project_id;

                $project_url_slug = \App\Models\Project::find($project_id)->project_url_slug;

                $display_message = "Thank you! We will contact you soon.";
                $pdf_file_download = "";
            }

            $request->session()->forget(['otp_code', 'enquiry_mobile_number', 'enquiry_id', 'contact_enquiry_id']);

            return response()->json(['display_message' => $display_message, 'project_url_slug' => $project_url_slug, 'pdf_file_download' => $pdf_file_download]);
        }
    }

    public function resend_otp_details(Request $request) {
        $enquiry_mobile_number = $request->session()->get('enquiry_mobile_number');
        $enquiry_isd_code = $request->session()->get('enquiry_isd_code');
        $template_id = $request->session()->get('template_id');

        if(!empty($enquiry_mobile_number)) {
            $otp_code = mt_rand(1000, 9999);

            $request->session()->put('otp_code', $otp_code);

            $this->send_sms($enquiry_isd_code.$enquiry_mobile_number, $otp_code, $template_id);

            return response()->json(['response_code' => 200]);
        } else {
            return response()->json(['response_code' => 422], 422);
        }
    }

    private function send_sms($mobile_number, $otp_code, $template_id = 0) {
        $authKey = '264301A4roPtJauf5c6fb703';
        $length = 4;

        if(empty($template_id)) {
            $template_id = "6059c7a09fca26128c3a3143";
        }

        $sms_trigger_url = "https://api.msg91.com/api/v5/otp?otp=$otp_code&authkey=$authKey&mobile=$mobile_number&otp_length=$length&template_id=$template_id";
        
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $sms_trigger_url);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);

        return $response;
    }

    private function sales_force_access_token_prod() {
        $post_data = [
            'client_id' => urlencode('3MVG9fe4g9fhX0E4AD9UQ0IY_YxSm6dhFFUjwXHfxoKoGTvJJQLOPOPZTSqsHAlZny6G3g1JcAdmsYQvoet.j'),
            'client_secret' => urlencode('FDB1D47DF7FC917E696BD517DF9F4D485836FC207334CDB0F3F57252B14AC9B7'),
            'grant_type' => urlencode('password'),
            'username' => urlencode('ashwin.cen@stetig.in'),
            'password' => urlencode('Password@123451Wz14X7AccBCTEAvwoaw6Dw0e')
        ];

        $post_data_string = "";

        $i = 1;

        foreach ($post_data as $key => $value) {
            $post_data_string .= $key."=".$value;

            if($i != count($post_data)) {
                $post_data_string .= "&";
            }

            $i++;
        }

        $api_url = "https://login.salesforce.com/services/oauth2/token";

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $api_url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $post_data_string,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/x-www-form-urlencoded'
            ),
        ));

        $response = curl_exec($curl);

        $response = json_decode($response);

        if(isset($response->access_token)) {
            return $response->access_token;
        }
    }

    private function record_sforce_prod($post_data) {
        $api_url = "https://centuryrealestate.my.salesforce.com/services/apexrest/Century/InsertNewEnquiry";

        $access_token = $this->sales_force_access_token_prod();

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $api_url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($post_data),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Bearer '.$access_token
            ),
        ));

        $response = curl_exec($curl);

        $response = json_decode($response);

        return $response;
    }

    private function sales_force_access_token() {
        $post_data = [
            'client_id' => urlencode('3MVG9ZUGg10Hh225UfOy1maAMNyarHEMQuOJ7oXJUZMzKXqgmC_npaenaXwy8Sstoa2QbPLfeYqn.Fcemte.W'),
            'client_secret' => urlencode('B7BBCBFA10E69DD06A9706B29F5DF2B9149B5721AD54AF8A1223EB5143E7216F'),
            'grant_type' => urlencode('password'),
            'username' => urlencode('ashwin.cen@stetig.in.centurysb'),
            'password' => urlencode('century@1234aF0Tonoze1AWyFQwQEsDB7tJ')
        ];

        $post_data_string = "";

        $i = 1;

        foreach ($post_data as $key => $value) {
            $post_data_string .= $key."=".$value;

            if($i != count($post_data)) {
                $post_data_string .= "&";
            }

            $i++;
        }

        $api_url = "https://test.salesforce.com/services/oauth2/token";

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $api_url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $post_data_string,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/x-www-form-urlencoded'
            ),
        ));

        $response = curl_exec($curl);

        $response = json_decode($response);

        if(isset($response->access_token)) {
            return $response->access_token;
        }
    }

    private function record_sforce($post_data) {
        $api_url = "https://centuryrealestate--centurysb.my.salesforce.com/services/apexrest/Century/InsertNewEnquiry";

        $access_token = $this->sales_force_access_token();

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $api_url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($post_data),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Bearer '.$access_token
            ),
        ));

        $response = curl_exec($curl);

        $response = json_decode($response);

        return $response;
    }

    private function crm_api($api_url, $post_data) {
        $post_data_string = "";

        $i = 1;

        foreach ($post_data as $key => $value) {
            $post_data_string .= $key."=".$value;

            if($i != count($post_data)) {
                $post_data_string .= "&";
            }

            $i++;
        }

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $api_url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $post_data_string,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/x-www-form-urlencoded'
            ),
        ));

        $response = curl_exec($curl);

        return $response;
    }

    public function configure_download_type_details(Request $request) {
        $input_list = [
            'download_type' => ['bail', 'required', 'digits:1'],
            'project_id' => ['bail', 'required', 'exists:projects,id']
        ];

        $validation_list = [];

        Validator::make($request->all(), $input_list, $validation_list)->validate();

        $download_type = $request->input('download_type');
        $project_id = $request->input('project_id');

        $request->session()->put('project_id', $project_id);
        $request->session()->put('download_type', $download_type);
    }

    public function fetch_country_list(Request $request) {
        $countries = DB::table('countries')->select('isd_code', 'country_name')->orderBy('country_name')->get();

        return response()->json(['countries' => $countries]);
    }
}