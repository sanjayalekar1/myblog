@extends('layouts.website_layout')
@section('meta_title', $meta_data->meta_title)
@section('meta_description', $meta_data->meta_description)
@section('canonical_tag', $meta_data->canonical_tag)
@section('banner_image', "banners/".$banner->banner_image)
@section('content')
<main>
    <div class="container-fluid banner lazy p-0" data-scroll-repeat data-scroll data-scroll-class="inView" style="background: #000 url({{url('/')}}/assets/images/banners/{{$banner->banner_image}})no-repeat top center/cover;background:transparent;">
        <video class="desktop" poster="{{url('/')}}/assets/videos/banner-poster.jpg" playsinline autoplay muted loop>
            <!-- <source src="{{url('/')}}/assets/videos/banner.webm" type="video/webm"> -->
            <source src="{{url('/')}}/assets/videos/desktop-project-banner.mp4" type="video/mp4">
        </video>
         <video class="mobile" poster="{{url('/')}}/assets/videos/banner-poster.jpg" playsinline autoplay muted loop>
            <!-- <source src="{{url('/')}}/assets/videos/banner.webm" type="video/webm"> -->
            <source src="{{url('/')}}/assets/videos/mobile-project-banner.mp4" type="video/mp4">
        </video>
        <div class="scrollTo m-auto">
            <div class="scrollTo__scroll">
                 Scroll Down
                 <span></span>
            </div>
        </div>
    </div>
    <div class="container-fluid projects mt-5 pt-5" id="projectListing">
        <div class="row custom-row">
            <div class="col-12">
                <h3 class="heading-primary" data-scroll data-scroll-speed="1">Century Real Estate has the most fitting<br> options for your dream home.</h3>
            </div>
        </div>
        <div class="row custom-row projects__tabs mt-5" id="filters">
            <div class="col-12 col-sm-12 col-md-6  mb-5">
                <h2 class="sub-title mb-3 mt-4" data-scroll data-scroll-speed="1.2">Type</h2>
                <ul class="button-group project_type_filter" data-scroll data-scroll-speed="1.4">
                    @foreach($project_types as $project_type_row)
                    <li data-filter="{{$project_type_row->id}}">{{$project_type_row->project_type_title}}</li>
                    @endforeach
                </ul>
            </div>
            <div class="col-12 col-sm-12 col-md-6  mb-5">
                <h2 class="sub-title mb-3 mt-4" data-scroll data-scroll-speed="1.2">Status</h2>
                <ul class="button-group project_status_filter" data-scroll data-scroll-speed="1.4">
                    @foreach($project_statuses as $project_status_row)
                    <li data-filter="{{$project_status_row->id}}">{{$project_status_row->project_status_title}}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="projects__lists">
            @include('project_blocks')
        </div>
    </div>
    <div class="enquiry p-0" data-scroll-offset="5%" data-scroll-repeat data-scroll data-scroll-class="inView">
        <div class="row custom-row pr-0">
            <div class="col-12 col-sm-12 col-md-6">
                @php
                $form_location = "Project Listing";
                @endphp
                @include('enquiry_form')
            </div>
            <div class="col-12 col-sm-12 col-md-6" style="background: #2f090e;"></div>
        </div>
    </div>
</main>
@endsection