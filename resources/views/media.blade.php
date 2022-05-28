@extends('layouts.website_layout')
@section('meta_title', $meta_data->meta_title)
@section('meta_description', $meta_data->meta_description)
@section('canonical_tag', $meta_data->canonical_tag)
@section('banner_image', "banners/".$banner->banner_image)
@section('content')
<main>
    <div class="container-fluid banner lazy p-0" data-scroll-repeat data-scroll data-scroll-class="inView"
        style="background: #000 url({{url('/')}}/assets/images/banners/{{$banner->banner_image}})no-repeat top center/cover;">
    </div>
    <div class="container-fluid intro mb-0">
        <div class="row custom-row">
            <div class="col-12 col-md-12 intro__inner text-left">
                <h1 class="heading-primary mb-5" data-scroll data-scroll-speed="1">{{$meta_data->introduction_text_one}}</h1>
            </div>
        </div>
    </div>
    <div class="container-fluid press">
        <div class="row custom-row align-items-center">
            <div class="col-12 col-md-3">
                <div class="row align-items-center justify-content-start">
                    <div class="press__title">
                        <p class="paragraph m-0">Choose Year</p>
                    </div>
                    <div class="search__box">
                        <select class="form-select filter_media_year">
                            <option value="">All Years</option>
                            @foreach($media_years as $media_year_row)
                            <option value="{{$media_year_row->single_year}}">{{$media_year_row->single_year}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-5">
                <div class="row align-items-center">
                    <div class="press__title">
                        <p class="paragraph m-0">Media Type</p>
                    </div>
                    <div class="search__box">
                        <select class="form-select filter_media_type_id">
                            @foreach($media_types as $media_type_row)
                            <option value="{{$media_type_row->id}}">{{$media_type_row->media_type_title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row align-items-center mt-3">
                <div class="col-12">
                    <hr>
                </div>
            </div>
        </div>
        <div class="row custom-row press__media media__listing press__listing video__listing">
            @include('press_blocks')
        </div>
    </div>
    <div class="container-fluid missionvalues">
        <div class="row">
            <div class="col-12 col-md-6 missionvalues__block lazy"
                style="background: #000 url({{url('/')}}/assets/images/press/video-bg.jpg)no-repeat center/cover;">
                <h2 class="sub-title mb-5 p-0" data-scroll data-scroll-speed="1">Videos</h2>
                <a href="{{url('/')}}/videos" class="link" data-scroll data-scroll-speed="1.2"><span></span>View all</a>
            </div>
            <div class="col-12 col-md-6 missionvalues__block lazy"
                style="background: #000 url({{url('/')}}/assets/images/century-times/press-bg.png)no-repeat center/cover;">
                <h2 class="sub-title mb-5 p-0" data-scroll data-scroll-speed="1">Press</h2>
                <a href="{{url('/')}}/press" class="link" data-scroll data-scroll-speed="1.2"><span></span>View all</a>
            </div>
        </div>
    </div>
    <div class="container-fluid mediakit lazy"
        style="background: #2f080d url({{url('/')}}/assets/images/press/big-logo.png)no-repeat 80% 50%/21%;">
        <div class="row custom-row">
            <div class="col-12 mediakit__inner" data-scroll data-scroll-speed="1">
                <h3 class="sub-title">Media Kit</h3>
                <a class="show_pointer trigger_media_kit_form">Download</a>
            </div>
        </div>
    </div>
</main>
@endsection