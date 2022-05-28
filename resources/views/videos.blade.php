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
                        <select class="form-select filter_video_year">
                            @foreach($video_years as $video_year_row)
                            <option value="{{$video_year_row->single_year}}">{{$video_year_row->single_year}}</option>
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
        <div class="row custom-row press__media video__listing">
            @include('video_blocks')
        </div>
    </div>
    <div class="container-fluid missionvalues">
        <div class="row">
            <div class="col-12 col-md-6 missionvalues__block lazy"
                style="background: #000 url({{url('/')}}/assets/images/videos/times-bg.jpg)no-repeat center/cover;">
                <h2 class="sub-title mb-5 p-0" data-scroll data-scroll-speed="1">Century Times</h2>
                <a href="{{url('/')}}/videos" class="link" data-scroll data-scroll-speed="1.2"><span></span>View
                    all</a>
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
                <a href="#" download="">Download</a>
            </div>
        </div>
    </div>
</main>
@endsection