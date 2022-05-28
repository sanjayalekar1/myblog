@extends('layouts.website_layout')
@section('meta_title', $meta_data->meta_title)
@section('meta_description', $meta_data->meta_description)
@section('canonical_tag', $meta_data->canonical_tag)
@section('banner_image', "banners/".$banner->banner_image)
@section('content')
<main>
    <div class="container-fluid banner p-0 lazy" data-scroll-repeat data-scroll data-scroll-class="inView"
        style="background: #000 url({{url('/')}}/assets/images/banners/{{$banner->banner_image}})no-repeat top center/cover;">
    </div>
    <div class="container-fluid intro mb-0">
        <div class="row custom-row">
            <div class="col-12 col-md-12 intro__inner text-left">
                <h1 class="heading-primary mb-5" data-scroll data-scroll-speed="1">{!!nl2br($meta_data->introduction_text_one)!!}</h1>
            </div>
        </div>
    </div>
    <div class="container-fluid press">
        <div class="row custom-row align-items-center">
            <div class="col-4 col-md-2 press__title">
                <p class="paragraph m-0">Choose Year</p>
            </div>
            <div class="col-3 col-md-2 search__box">
                <select class="form-select filter_press_year">
                    @foreach($press_years as $press_year_row)
                    <option value="{{$press_year_row->single_year}}">{{$press_year_row->single_year}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row custom-row press__listing">
            @include('press_blocks')
        </div>
    </div>
    <div class="container-fluid missionvalues">
        <div class="row">
            <div class="col-12 col-md-6 missionvalues__block" style="background: #000 url({{url('/')}}/assets/images/press/video-bg.jpg)no-repeat center/cover;">
                <h2 class="sub-title mb-5 p-0" data-scroll data-scroll-speed="1">Videos</h2>
                <a href="{{url('/')}}/videos"  class="link" data-scroll
                    data-scroll-speed="1.2"><span></span>View all</a>
            </div>
            <div class="col-12 col-md-6 missionvalues__block" style="background: #000 url({{url('/')}}/assets/images/press/times-bg.jpg)no-repeat center/cover;">
                <h2 class="sub-title mb-5 p-0" data-scroll data-scroll-speed="1">Century Times</h2>
                <a href="{{url('/')}}/media" class="link" data-scroll data-scroll-speed="1.2"><span></span>View all</a>
            </div>
        </div>
    </div>
    <div class="container-fluid mediakit" style="background: #2f080d url({{url('/')}}/assets/images/press/big-logo.png)no-repeat 80% 50%/21%;">
        <div class="row custom-row">
            <div class="col-12 mediakit__inner" data-scroll data-scroll-speed="1">
                <h3 class="sub-title">Media Kit</h3>
                <a href="#" download="">Download</a>
            </div>
        </div>
    </div>
</main>
@endsection