<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\CenturyAdminPanel;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommercialProjectController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/testing', [WebsiteController::class, 'testing']);
Route::get('/', [WebsiteController::class, 'index']);
Route::get('/virtual-meet', [WebsiteController::class, 'index']);
Route::get('/about', [WebsiteController::class, 'about']);
Route::get('/projects', [WebsiteController::class, 'projects']);
Route::get('/projects/{project_slug}', [WebsiteController::class, 'project_details']);
Route::get('/commercial-projects/{project_slug}', [WebsiteController::class, 'commercial_project_details']);
Route::get('/commercial-projects', [WebsiteController::class, 'commercial_projects']);
Route::get('/projects/{project_slug}/thank-you', [WebsiteController::class, 'project_thank_you']);
Route::get('/download-pdf-file', [WebsiteController::class, 'download_pdf_file']);
Route::get('/download-media-kit-file', [WebsiteController::class, 'download_media_kit_file']);
Route::get('/why-us', [WebsiteController::class, 'why_us']);
Route::get('/contact-us', [WebsiteController::class, 'contact']);
Route::get('/disclaimer', [WebsiteController::class, 'disclaimer']);
Route::get('/privacy', [WebsiteController::class, 'privacy']);
Route::get('/terms', [WebsiteController::class, 'terms']);
Route::get('/videos', [WebsiteController::class, 'videos']);
Route::get('/associated-enterprises', [WebsiteController::class, 'associated_enterprises']);
Route::get('/corporate-governance', [WebsiteController::class, 'corporate_governance']);
Route::get('/social-responsibility', [WebsiteController::class, 'social_responsibility']);
Route::get('/rising-north', [WebsiteController::class, 'rising_north']);
Route::get('/awards', [WebsiteController::class, 'awards']);
Route::get('/media', [WebsiteController::class, 'media']);
Route::get('/client-testimonials', [WebsiteController::class, 'customer_testimonials']);
Route::get('/referrals', [WebsiteController::class, 'referrals']);
Route::get('/century-appreciation', [WebsiteController::class, 'century_appreciation']);
Route::get('/nri-corner', [WebsiteController::class, 'nri_corner']);
Route::get('/century-connect', [WebsiteController::class, 'century_connect']);
Route::get('/life-at-century', [WebsiteController::class, 'life_at_century']);
Route::get('/blog', [WebsiteController::class, 'blog']);
Route::get('/press', [WebsiteController::class, 'press']);
Route::get('/key-management', [WebsiteController::class, 'key_management']);

Route::get('/fetch-country-list', [WebsiteController::class, 'fetch_country_list']);
Route::post('/configure-download-type-details', [WebsiteController::class, 'configure_download_type_details']);
Route::post('/enquiry-form-pop-details', [WebsiteController::class, 'enquiry_form_pop_details']);
Route::post('/media-kit-enquiry-form-pop-details', [WebsiteController::class, 'media_kit_enquiry_form_pop_details']);
Route::post('/enquiry-form-details', [WebsiteController::class, 'enquiry_form_details']);
Route::post('/contact-enquiry-form-details', [WebsiteController::class, 'contact_enquiry_form_details']);
Route::post('/verify-otp-details', [WebsiteController::class, 'verify_otp_details']);
Route::post('/resend-otp-details', [WebsiteController::class, 'resend_otp_details']);
Route::post('/filter-project-details', [WebsiteController::class, 'filter_project_details']);
Route::post('/filter-zone-details', [WebsiteController::class, 'filter_zone_details']);
Route::post('/filter-location-details', [WebsiteController::class, 'filter_location_details']);
Route::post('/filter-press-details', [WebsiteController::class, 'filter_press_details']);
Route::post('/filter-report-details', [WebsiteController::class, 'filter_report_details']);
Route::post('/filter-award-details', [WebsiteController::class, 'filter_award_details']);
Route::post('/filter-video-details', [WebsiteController::class, 'filter_video_details']);
Route::post('/filter-media-details', [WebsiteController::class, 'filter_media_details']);

Route::get('/century-admin-panel/login', [AuthController::class, 'login'])->name('login');
Route::get('/century-admin-panel/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/century-admin-panel/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/century-admin-panel/login', [AuthController::class, 'login']);

Route::get('/century-admin-panel', [CenturyAdminPanel::class, 'index']);

Route::get('/century-admin-panel/manage-meta-data', [CenturyAdminPanel::class, 'manage_meta_data']);
Route::get('/century-admin-panel/edit-meta-data/{meta_id}', [CenturyAdminPanel::class, 'edit_meta_data']);
Route::post('/century-admin-panel/edit-meta-data-details', [CenturyAdminPanel::class, 'edit_meta_data_details']);

Route::get('/century-admin-panel/manage-banners', [CenturyAdminPanel::class, 'manage_banners']);
Route::get('/century-admin-panel/edit-banner/{banner_id}', [CenturyAdminPanel::class, 'edit_banner']);
Route::post('/century-admin-panel/edit-banner-details', [CenturyAdminPanel::class, 'edit_banner_details']);

Route::get('/century-admin-panel/edit-home-page-video', [CenturyAdminPanel::class, 'edit_home_page_video']);
Route::post('/century-admin-panel/edit-home-page-video-details', [CenturyAdminPanel::class, 'edit_home_page_video_details']);

Route::get('/century-admin-panel/manage-home-page-sliders', [CenturyAdminPanel::class, 'manage_home_page_sliders']);
Route::get('/century-admin-panel/add-home-page-slider', [CenturyAdminPanel::class, 'add_home_page_slider']);
Route::post('/century-admin-panel/add-home-page-slider-details', [CenturyAdminPanel::class, 'add_home_page_slider_details']);
Route::get('/century-admin-panel/edit-home-page-slider/{slider_id}', [CenturyAdminPanel::class, 'edit_home_page_slider']);
Route::post('/century-admin-panel/edit-home-page-slider-details', [CenturyAdminPanel::class, 'edit_home_page_slider_details']);
Route::post('/century-admin-panel/update-home-page-sliders-sorting', [CenturyAdminPanel::class, 'update_home_page_sliders_sorting']);

Route::get('/century-admin-panel/edit-home-page-about-us', [CenturyAdminPanel::class, 'edit_home_page_about_us']);
Route::post('/century-admin-panel/edit-home-page-about-us-details', [CenturyAdminPanel::class, 'edit_home_page_about_us_details']);

Route::get('/century-admin-panel/edit-frontend-script', [CenturyAdminPanel::class, 'edit_frontend_script']);
Route::post('/century-admin-panel/edit-frontend-script-details', [CenturyAdminPanel::class, 'edit_frontend_script_details']);

Route::get('/century-admin-panel/edit-media-kit', [CenturyAdminPanel::class, 'edit_media_kit']);
Route::post('/century-admin-panel/edit-media-kit-details', [CenturyAdminPanel::class, 'edit_media_kit_details']);

Route::get('/century-admin-panel/manage-project-budgets', [CenturyAdminPanel::class, 'manage_project_budgets']);
Route::get('/century-admin-panel/add-project-budget', [CenturyAdminPanel::class, 'add_project_budget']);
Route::post('/century-admin-panel/add-project-budget-details', [CenturyAdminPanel::class, 'add_project_budget_details']);
Route::get('/century-admin-panel/edit-project-budget/{project_budget_id}', [CenturyAdminPanel::class, 'edit_project_budget']);
Route::post('/century-admin-panel/edit-project-budget-details', [CenturyAdminPanel::class, 'edit_project_budget_details']);

Route::get('/century-admin-panel/manage-project-locations', [CenturyAdminPanel::class, 'manage_project_locations']);
Route::get('/century-admin-panel/add-project-location', [CenturyAdminPanel::class, 'add_project_location']);
Route::post('/century-admin-panel/add-project-location-details', [CenturyAdminPanel::class, 'add_project_location_details']);
Route::get('/century-admin-panel/edit-project-location/{project_location_id}', [CenturyAdminPanel::class, 'edit_project_location']);
Route::post('/century-admin-panel/edit-project-location-details', [CenturyAdminPanel::class, 'edit_project_location_details']);

Route::get('/century-admin-panel/manage-project-zones', [CenturyAdminPanel::class, 'manage_project_zones']);
Route::get('/century-admin-panel/add-project-zone', [CenturyAdminPanel::class, 'add_project_zone']);
Route::post('/century-admin-panel/add-project-zone-details', [CenturyAdminPanel::class, 'add_project_zone_details']);
Route::get('/century-admin-panel/edit-project-zone/{project_zone_id}', [CenturyAdminPanel::class, 'edit_project_zone']);
Route::post('/century-admin-panel/edit-project-zone-details', [CenturyAdminPanel::class, 'edit_project_zone_details']);

Route::get('/century-admin-panel/manage-project-types', [CenturyAdminPanel::class, 'manage_project_types']);
Route::get('/century-admin-panel/add-project-type', [CenturyAdminPanel::class, 'add_project_type']);
Route::post('/century-admin-panel/add-project-type-details', [CenturyAdminPanel::class, 'add_project_type_details']);
Route::get('/century-admin-panel/edit-project-type/{project_type_id}', [CenturyAdminPanel::class, 'edit_project_type']);
Route::post('/century-admin-panel/edit-project-type-details', [CenturyAdminPanel::class, 'edit_project_type_details']);

Route::get('/century-admin-panel/manage-project-categories', [CenturyAdminPanel::class, 'manage_project_categories']);
Route::get('/century-admin-panel/add-project-category', [CenturyAdminPanel::class, 'add_project_category']);
Route::post('/century-admin-panel/add-project-category-details', [CenturyAdminPanel::class, 'add_project_category_details']);
Route::get('/century-admin-panel/edit-project-category/{project_category_id}', [CenturyAdminPanel::class, 'edit_project_category']);
Route::post('/century-admin-panel/edit-project-category-details', [CenturyAdminPanel::class, 'edit_project_category_details']);

Route::get('/century-admin-panel/manage-project-status', [CenturyAdminPanel::class, 'manage_project_status']);
Route::get('/century-admin-panel/add-project-status', [CenturyAdminPanel::class, 'add_project_status']);
Route::post('/century-admin-panel/add-project-status-details', [CenturyAdminPanel::class, 'add_project_status_details']);
Route::get('/century-admin-panel/edit-project-status/{project_status_id}', [CenturyAdminPanel::class, 'edit_project_status']);
Route::post('/century-admin-panel/edit-project-status-details', [CenturyAdminPanel::class, 'edit_project_status_details']);

Route::get('/century-admin-panel/manage-projects', [CenturyAdminPanel::class, 'manage_projects']);
Route::get('/century-admin-panel/add-project', [CenturyAdminPanel::class, 'add_project']);
Route::post('/century-admin-panel/add-project-details', [CenturyAdminPanel::class, 'add_project_details']);
Route::get('/century-admin-panel/edit-project/{project_id}', [CenturyAdminPanel::class, 'edit_project']);
Route::post('/century-admin-panel/edit-project-details', [CenturyAdminPanel::class, 'edit_project_details']);
Route::post('/century-admin-panel/update-projects-sorting', [CenturyAdminPanel::class, 'update_projects_sorting']);

Route::get('/century-admin-panel/manage-enquiries', [CenturyAdminPanel::class, 'manage_enquiries']);
Route::get('/century-admin-panel/export-enquiries', [CenturyAdminPanel::class, 'export_enquiries'])->middleware('cache.headers:private;max_age=36');

Route::get('/century-admin-panel/manage-media-kit-enquiries', [CenturyAdminPanel::class, 'manage_media_kit_enquiries']);
Route::get('/century-admin-panel/export-media-kit-enquiries', [CenturyAdminPanel::class, 'export_media_kit_enquiries'])->middleware('cache.headers:private;max_age=3600');

Route::get('/century-admin-panel/manage-contact-enquiries', [CenturyAdminPanel::class, 'manage_contact_enquiries']);
Route::get('/century-admin-panel/export-contact-enquiries', [CenturyAdminPanel::class, 'export_contact_enquiries'])->middleware('cache.headers:private;max_age=3600');

Route::get('/century-admin-panel/manage-timelines', [CenturyAdminPanel::class, 'manage_timelines']);
Route::get('/century-admin-panel/add-timeline', [CenturyAdminPanel::class, 'add_timeline']);
Route::post('/century-admin-panel/add-timeline-details', [CenturyAdminPanel::class, 'add_timeline_details']);
Route::get('/century-admin-panel/edit-timeline/{timeline_id}', [CenturyAdminPanel::class, 'edit_timeline']);
Route::post('/century-admin-panel/edit-timeline-details', [CenturyAdminPanel::class, 'edit_timeline_details']);

Route::get('/century-admin-panel/manage-management', [CenturyAdminPanel::class, 'manage_management']);
Route::get('/century-admin-panel/add-management', [CenturyAdminPanel::class, 'add_management']);
Route::post('/century-admin-panel/add-management-details', [CenturyAdminPanel::class, 'add_management_details']);
Route::get('/century-admin-panel/edit-management/{management_id}', [CenturyAdminPanel::class, 'edit_management']);
Route::post('/century-admin-panel/edit-management-details', [CenturyAdminPanel::class, 'edit_management_details']);
Route::post('/century-admin-panel/update-management-sorting', [CenturyAdminPanel::class, 'update_management_sorting']);

Route::get('/century-admin-panel/manage-why-us', [CenturyAdminPanel::class, 'manage_why_us']);
Route::get('/century-admin-panel/add-why-us', [CenturyAdminPanel::class, 'add_why_us']);
Route::post('/century-admin-panel/add-why-us-details', [CenturyAdminPanel::class, 'add_why_us_details']);
Route::get('/century-admin-panel/edit-why-us/{why_us_id}', [CenturyAdminPanel::class, 'edit_why_us']);
Route::post('/century-admin-panel/edit-why-us-details', [CenturyAdminPanel::class, 'edit_why_us_details']);
Route::post('/century-admin-panel/update-why-us-sorting', [CenturyAdminPanel::class, 'update_why_us_sorting']);

Route::get('/century-admin-panel/manage-social-responsibilities', [CenturyAdminPanel::class, 'manage_social_responsibilities']);
Route::get('/century-admin-panel/add-social-responsibility', [CenturyAdminPanel::class, 'add_social_responsibility']);
Route::post('/century-admin-panel/add-social-responsibility-details', [CenturyAdminPanel::class, 'add_social_responsibility_details']);
Route::get('/century-admin-panel/edit-social-responsibility/{social_responsibility_id}', [CenturyAdminPanel::class, 'edit_social_responsibility']);
Route::post('/century-admin-panel/edit-social-responsibility-details', [CenturyAdminPanel::class, 'edit_social_responsibility_details']);
Route::post('/century-admin-panel/update-social-responsibilities-sorting', [CenturyAdminPanel::class, 'update_social_responsibilities_sorting']);

Route::get('/century-admin-panel/manage-social-projects', [CenturyAdminPanel::class, 'manage_social_projects']);
Route::get('/century-admin-panel/add-social-project', [CenturyAdminPanel::class, 'add_social_project']);
Route::post('/century-admin-panel/add-social-project-details', [CenturyAdminPanel::class, 'add_social_project_details']);
Route::get('/century-admin-panel/edit-social-project/{social_project_id}', [CenturyAdminPanel::class, 'edit_social_project']);
Route::post('/century-admin-panel/edit-social-project-details', [CenturyAdminPanel::class, 'edit_social_project_details']);
Route::post('/century-admin-panel/update-social-projects-sorting', [CenturyAdminPanel::class, 'update_social_projects_sorting']);

Route::get('/century-admin-panel/manage-galleries', [CenturyAdminPanel::class, 'manage_galleries']);
Route::get('/century-admin-panel/add-gallery', [CenturyAdminPanel::class, 'add_gallery']);
Route::post('/century-admin-panel/add-gallery-details', [CenturyAdminPanel::class, 'add_gallery_details']);
Route::get('/century-admin-panel/edit-gallery/{gallery_id}', [CenturyAdminPanel::class, 'edit_gallery']);
Route::post('/century-admin-panel/edit-gallery-details', [CenturyAdminPanel::class, 'edit_gallery_details']);
Route::post('/century-admin-panel/update-galleries-sorting', [CenturyAdminPanel::class, 'update_galleries_sorting']);

Route::get('/century-admin-panel/manage-press', [CenturyAdminPanel::class, 'manage_press']);
Route::get('/century-admin-panel/add-press', [CenturyAdminPanel::class, 'add_press']);
Route::post('/century-admin-panel/add-press-details', [CenturyAdminPanel::class, 'add_press_details']);
Route::get('/century-admin-panel/edit-press/{press_id}', [CenturyAdminPanel::class, 'edit_press']);
Route::post('/century-admin-panel/edit-press-details', [CenturyAdminPanel::class, 'edit_press_details']);

Route::get('/century-admin-panel/manage-media', [CenturyAdminPanel::class, 'manage_media']);
Route::get('/century-admin-panel/add-media', [CenturyAdminPanel::class, 'add_media']);
Route::post('/century-admin-panel/add-media-details', [CenturyAdminPanel::class, 'add_media_details']);
Route::get('/century-admin-panel/edit-media/{media_id}', [CenturyAdminPanel::class, 'edit_media']);
Route::post('/century-admin-panel/edit-media-details', [CenturyAdminPanel::class, 'edit_media_details']);

Route::get('/century-admin-panel/manage-reports', [CenturyAdminPanel::class, 'manage_reports']);
Route::get('/century-admin-panel/add-report', [CenturyAdminPanel::class, 'add_report']);
Route::post('/century-admin-panel/add-report-details', [CenturyAdminPanel::class, 'add_report_details']);
Route::get('/century-admin-panel/edit-report/{report_id}', [CenturyAdminPanel::class, 'edit_report']);
Route::post('/century-admin-panel/edit-report-details', [CenturyAdminPanel::class, 'edit_report_details']);

Route::get('/century-admin-panel/manage-videos', [CenturyAdminPanel::class, 'manage_videos']);
Route::get('/century-admin-panel/add-video', [CenturyAdminPanel::class, 'add_video']);
Route::post('/century-admin-panel/add-video-details', [CenturyAdminPanel::class, 'add_video_details']);
Route::get('/century-admin-panel/edit-video/{video_id}', [CenturyAdminPanel::class, 'edit_video']);
Route::post('/century-admin-panel/edit-video-details', [CenturyAdminPanel::class, 'edit_video_details']);

Route::get('/century-admin-panel/manage-testimonials', [CenturyAdminPanel::class, 'manage_testimonials']);
Route::get('/century-admin-panel/add-testimonial', [CenturyAdminPanel::class, 'add_testimonial']);
Route::post('/century-admin-panel/add-testimonial-details', [CenturyAdminPanel::class, 'add_testimonial_details']);
Route::get('/century-admin-panel/edit-testimonial/{testimonial_id}', [CenturyAdminPanel::class, 'edit_testimonial']);
Route::post('/century-admin-panel/edit-testimonial-details', [CenturyAdminPanel::class, 'edit_testimonial_details']);
Route::post('/century-admin-panel/update-testimonials-sorting', [CenturyAdminPanel::class, 'update_testimonials_sorting']);

Route::get('/century-admin-panel/manage-awards', [CenturyAdminPanel::class, 'manage_awards']);
Route::get('/century-admin-panel/add-award', [CenturyAdminPanel::class, 'add_award']);
Route::post('/century-admin-panel/add-award-details', [CenturyAdminPanel::class, 'add_award_details']);
Route::get('/century-admin-panel/edit-award/{award_id}', [CenturyAdminPanel::class, 'edit_award']);
Route::post('/century-admin-panel/edit-award-details', [CenturyAdminPanel::class, 'edit_award_details']);
Route::post('/century-admin-panel/update-awards-sorting', [CenturyAdminPanel::class, 'update_awards_sorting']);

Route::get('/century-admin-panel/commercial-projects-lists', [CommercialProjectController::class, 'index']);
Route::get('/century-admin-panel/add-commercial-project', [CommercialProjectController::class, 'create']);
Route::get('/century-admin-panel/edit-commercial-project/{project_id}', [CommercialProjectController::class, 'edit']);
Route::post('/century-admin-panel/update-commercial-project-details', [CommercialProjectController::class, 'update']);
Route::get('/century-admin-panel/commercial-project-details', [CommercialProjectController::class, 'show']);
Route::post('/century-admin-panel/add-project-details', [CommercialProjectController::class, 'store']);
