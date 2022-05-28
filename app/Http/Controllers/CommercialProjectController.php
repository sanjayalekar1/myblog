<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use DB;
use Excel;
use Illuminate\Support\Facades\Hash;
use App\Models\CommercialProject;

class CommercialProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cp = new CommercialProject;
       // $comm_projects = $cp->where('status',1)->get();
        $comm_projects = DB::table('commercial_project')->addSelect(['project_status_title' => DB::table('project_statuses')->select('project_status_title')->whereColumn('project_statuses.id', 'commercial_project.project_status_id')])->get();
        return view('admin.commercial-project.project.index',compact('comm_projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $project_categories = DB::table('project_categories')->orderBy('project_category_title')->get();

        $project_locations = DB::table('project_locations')->orderBy('project_location_title')->get();

        $project_types = DB::table('project_types')->get();

        $project_status = DB::table('project_statuses')->get();

        $project_gallery_categories = DB::table('project_gallery_categories')->orderBy('id')->get();

        $projects = DB::table('commercial_project')->select('id', 'project_title')->orderBy('project_title')->get();

        return view('admin.commercial-project.project.create', compact('project_locations', 'project_types', 'project_status','project_categories', 'project_gallery_categories', 'projects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input_list = [
            'project_name' => ['bail', 'required', 'unique:projects,project_name'],
            'project_thumbnail' => ['bail', 'required', 'image', 'file'],
            'project_logo' => ['bail', 'required', 'image', 'file'],
            'project_category_id' => ['bail', 'required'],
            'project_type_id' => ['bail', 'required'],
            'project_location_id' => ['bail', 'required'],
            'project_status_id' => ['bail', 'required'],
            'project_about_image' => ['bail', 'image'],
            'project_brochure' => ['bail', 'mimes:pdf']

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
            'project_location_id.required' => 'Please select the project location',
            'project_status_id.required' => 'Please select the project status',
            'project_about_image.image' => 'Please select a valid image to upload',
            'project_brochure.mimes' => 'Please select a valid PDF file to upload'
        ];

        Validator::make($request->all(), $input_list, $validation_list)->validate();

        $project_name = $request->input('project_name');
        $project_url_slug = Str::slug($project_name, '-');
        $project_thumbnail = $request->file('project_thumbnail');
        $project_location_text = $request->input('project_location_text');
        $project_logo = $request->file('project_logo');
        $project_logo_alt_text = $request->input('project_name');
        $project_category_ids = $request->input('project_category_id');
        $related_project_ids = $request->input('related_project_ids');
        $project_type_id = $request->input('project_type_id');
        $project_location_id = $request->input('project_location_id');
        $project_area = $request->input('project_area');
        $project_link = $request->input('project_link');
        $project_status_id = $request->input('project_status_id');
        $project_about_image = $request->file('project_about_image');
        $project_brochure = $request->file('project_brochure');
        $project_feature1 = $request->input('feature1');
        $project_feature2 = $request->input('feature2');
        $project_feature3 = $request->input('feature3');
        $project_feature4 = $request->input('feature4');
        $project_slider_images = $request->file('project_slider_images');
        $project_slider_image_mobiles = $request->file('project_slider_image_mobiles');
        $project_slider_captions = $request->input('project_slider_captions');
        $project_slider_descriptions = $request->input('project_slider_descriptions');
        $project_description = $request->input('project_description');
        $project_location_iframe = $request->input('project_location_iframe');
        $project_landmarks = $request->input('project_landmarks');
        $meta_title = $request->input('meta_title');
        $meta_description = $request->input('meta_description');
        $schema_code = $request->input('schema_code');
        $display_status = $request->input('display_status');
        $sorting_order = $this->get_last_sorting('projects');
        $project_gallery_category_ids = $request->input('project_gallery_category_ids');
        $project_gallery_images = $request->file('project_gallery_images');
        $project_gallery_captions = $request->input('project_gallery_captions');


        $target_dir = "pdfs";

        if(!empty($project_brochure)) {
            $project_brochure = $this->upload_file($project_brochure, $target_dir);
        } else {
            $project_brochure = "";
        }

        $target_dir = "images/projects";

        $project_thumbnail = $this->upload_file($project_thumbnail, $target_dir);
        $project_logo = $this->upload_file($project_logo, $target_dir);

        if(!empty($project_about_image)) {
            $project_about_image = $this->upload_file($project_about_image, $target_dir);
        } else {
            $project_about_image = "";
        }

        $project = new \App\Models\CommercialProject;
        $project->project_title = $project_name;
        $project->project_slug = $project_url_slug;
        $project->project_thumbnail = $project_thumbnail;
        $project->project_location_text = $project_location_text;
        $project->project_logo = $project_logo;
        $project->project_type = $project_type_id;
        $project->project_location = $project_location_id;
        $project->project_area = $project_area;
        $project->project_link = $project_link;
        $project->project_logo_alt_text = $project_logo_alt_text;
        $project->project_status_id = $project_status_id;
        $project->project_description = $project_description;
        $project->project_about_image = $project_about_image;
        $project->broucher_pdf_link = $project_brochure;
        $project->google_iframe_code = $project_location_iframe;
        $project->project_landmarks = $project_landmarks;
        $project->feature1 = $project_feature1;
        $project->feature2 = $project_feature2;
        $project->feature3 = $project_feature3;
        $project->feature4 = $project_feature4;
        $project->meta_title = $meta_title;
        $project->meta_description = $meta_description;
        $project->schema_code = $schema_code;
        $project->status = $display_status;
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

        $display_message = $this->success_message("Project Uploaded Successfully");

        return response()->json(['display_message' => $display_message]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admin.commercial-project.project.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($project_id)
    {
        $project_categories = DB::table('project_categories')->orderBy('project_category_title')->get();

        $project_locations = DB::table('project_locations')->orderBy('project_location_title')->get();

        $project_types = DB::table('project_types')->get();

        $project_status = DB::table('project_statuses')->get();

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

        $project_galleries = DB::table('project_galleries')->where('display_status', 1)->where('project_id', $project_id)->orderBy('sorting_order')->get();

        $project_gallery_categories = DB::table('project_gallery_categories')->orderBy('id')->get();

        $projects = DB::table('commercial_project')->select('id', 'project_title')->where('id', '!=', $project_id)->orderBy('project_title')->get();

        $project = DB::table('commercial_project')->find($project_id);

        return view('admin.commercial-project.project.edit', compact('project', 'project_locations', 'project_types', 'project_status', 'project_categories', 'project_category_ids', 'project_sliders', 'project_gallery_categories', 'project_galleries', 'projects', 'related_project_ids'));

        // $cp = new CommercialProject;
        // $comm_projects = $cp->where('id',$id)->first();
        // dd($comm_projects);
        // return view('admin.commercial-project.project.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $project_id = $request->input('project_id');
        $input_list = [
            'project_name' => ['bail', 'required', "unique:projects,project_name,$project_id"],
            'project_thumbnail' => ['bail', 'image', 'file'],
            'project_logo' => ['bail', 'image', 'file'],
            'project_category_id' => ['bail', 'required'],
            'project_type_id' => ['bail', 'required'],
            'project_location_id' => ['bail', 'required'],
            'project_status_id' => ['bail', 'required'],
            'project_about_image' => ['bail', 'image'],
            'project_brochure' => ['bail', 'mimes:pdf'],

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
            'project_location_id.required' => 'Please select the project location',
            'project_status_id.required' => 'Please select the project status',
            'project_about_image.image' => 'Please select a valid image to upload',
            'project_brochure.mimes' => 'Please select a valid PDF file to upload'
        ];
        Validator::make($request->all(), $input_list, $validation_list)->validate();

        $project_name = $request->input('project_name');
        $project_url_slug = Str::slug($project_name, '-');
        $project_thumbnail = $request->file('project_thumbnail');
        $project_location_text = $request->input('project_location_text');
        $project_logo = $request->file('project_logo');
        $project_logo_alt_text = $request->input('project_name');
        $project_category_ids = $request->input('project_category_id');
        $project_slider_ids = $request->input('project_slider_ids');
        $related_project_ids = $request->input('related_project_ids');
        $project_type_id = $request->input('project_type_id');
        $project_location_id = $request->input('project_location_id');
        $project_area = $request->input('project_area');
        $project_link = $request->input('project_link');
        $project_status_id = $request->input('project_status_id');
        $project_about_image = $request->file('project_about_image');
        $project_brochure = $request->file('project_brochure');
        $project_feature1 = $request->input('feature1');
        $project_feature2 = $request->input('feature2');
        $project_feature3 = $request->input('feature3');
        $project_feature4 = $request->input('feature4');
        $project_slider_images = $request->file('project_slider_images');
        $project_slider_image_mobiles = $request->file('project_slider_image_mobiles');
        $project_slider_captions = $request->input('project_slider_captions');
        $project_slider_descriptions = $request->input('project_slider_descriptions');
        $project_description = $request->input('project_description');
        $project_location_iframe = $request->input('project_location_iframe');
        $project_landmarks = $request->input('project_landmarks');
        $meta_title = $request->input('meta_title');
        $meta_description = $request->input('meta_description');
        $schema_code = $request->input('schema_code');
        $display_status = $request->input('display_status');
        $sorting_order = $this->get_last_sorting('projects');
        $project_gallery_category_ids = $request->input('project_gallery_category_ids');
        $project_gallery_image_ids = $request->input('project_gallery_image_ids');
        $project_gallery_images = $request->file('project_gallery_images');
        $project_gallery_captions = $request->input('project_gallery_captions');


        $target_dir = "pdfs";

        if(!empty($project_brochure)) {
            $project_brochure = $this->upload_file($project_brochure, $target_dir);
        } else {
            $project_brochure = $this->get_present_value('commercial_project', $project_id, 'broucher_pdf_link');
        }

        $target_dir = "images/projects";

        if(!empty($project_thumbnail)) {
            $project_thumbnail = $this->upload_file($project_thumbnail, $target_dir);
        } else {
            $project_thumbnail = $this->get_present_value('commercial_project', $project_id, 'project_thumbnail');
        }
        if(!empty($project_logo)) {
            $project_logo = $this->upload_file($project_logo, $target_dir);
        } else {
            $project_logo = $this->get_present_value('commercial_project', $project_id, 'project_logo');
        }

        if(!empty($project_about_image)) {
            $project_about_image = $this->upload_file($project_about_image, $target_dir);
        } else {
            $project_about_image = $this->get_present_value('commercial_project', $project_id, 'project_about_image');
        }
        $project = \App\Models\CommercialProject::find($project_id);
        $project->project_title = $project_name;
        $project->project_slug = $project_url_slug;
        $project->project_thumbnail = $project_thumbnail;
        $project->project_location_text = $project_location_text;
        $project->project_logo = $project_logo;
        $project->project_type = $project_type_id;
        $project->project_location = $project_location_id;
        $project->project_area = $project_area;
        $project->project_link = $project_link;
        $project->project_logo_alt_text = $project_logo_alt_text;
        $project->project_status_id = $project_status_id;
        $project->project_description = $project_description;
        $project->project_about_image = $project_about_image;
        $project->broucher_pdf_link = $project_brochure;
        $project->google_iframe_code = $project_location_iframe;
        $project->project_landmarks = $project_landmarks;
        $project->feature1 = $project_feature1;
        $project->feature2 = $project_feature2;
        $project->feature3 = $project_feature3;
        $project->feature4 = $project_feature4;
        $project->meta_title = $meta_title;
        $project->meta_description = $meta_description;
        $project->schema_code = $schema_code;
        $project->status = $display_status;
        $project->sorting_order = $sorting_order;
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
        DB::table('project_galleries')->where('project_id', $project_id)->update($data);
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
        $display_message = "Project Updated Successfully";

        return response()->json(['display_message' => $display_message]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
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
}
