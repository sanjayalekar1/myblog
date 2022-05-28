@extends('layouts.website_layout')
@section('meta_title', $meta_data->meta_title)
@section('meta_description', $meta_data->meta_description)
@section('canonical_tag', $meta_data->canonical_tag)
@section('banner_image', "banners/".$banner->banner_image)
@section('content')
<main>
    <div class="container-fluid banner lazy p-0" data-scroll-repeat data-scroll data-scroll-class="inView" style="background: #000 url({{url('/')}}/assets/images/banners/{{$banner->banner_image}})no-repeat top center/cover;"></div>
    <div class="container-fluid intro mb-0">
        <div class="row custom-row justify-content-center">
            <div class="col-12 col-md-11 col-lg-10 intro__inner text-center">
                <h1 class="heading-primary mb-5" data-scroll data-scroll-speed="1">{{$meta_data->introduction_text_one}}</h1>
            </div>
        </div>
        <div class="row custom-row justify-content-center">
            @php
            $i = 1;
            @endphp
            @foreach($why_us_query as $why_us_row)
            <div class="col-12- col-md-4 text-center mb-5 mt-4">
                <div class="intro__feature" data-scroll data-scroll-speed="1.2">
                    <img loading="lazy" src="{{url('/')}}/assets/images/why-us/icons/{{$i}}.jpg" alt="{{$why_us_row->section_title}}" class="img-fluid" width="72" height="72">
                    <h2 class="sub-title">{{$why_us_row->section_title}}</h2>
                </div>
            </div>
            @php
            $i++;
            @endphp
            @endforeach
        </div>
    </div>
    <div class="container-fluid speciality">
        @php
        $i = 0;
        @endphp
        @foreach($why_us_query as $why_us_row)
        @if($i % 2 == 0)
        <div class="row mt-5 pt-5">
            <div class="col-12 col-md-5 p-0 speciality__image left__image" data-scroll-repeat data-scroll data-scroll-class="inView">
                <img loading="lazy" src="{{url('/')}}/assets/images/why-us/{{$why_us_row->section_image}}" alt="{{$why_us_row->section_title}}" class="img-fluid" width="960" height="960">
            </div>
            <div class="col-12 col-md-7 speciality__text">
                <div class="speciality__text__inner">
                    <h3 class="heading-primary mb-5" data-scroll data-scroll-speed="1">{{$why_us_row->section_title}}</h3>
                    {!!$why_us_row->section_content!!}
                </div>
            </div>
        </div>
        @else
        <div class="row mt-5 pt-5">
            <div class="col-12 col-md-7 speciality__text order-1 order-md-0">
                <div class="speciality__text__inner">
                    <h3 class="heading-primary mb-5" data-scroll data-scroll-speed="1">{{$why_us_row->section_title}}</h3>
                    {!!$why_us_row->section_content!!}
                </div>
            </div>
            <div class="col-12 col-md-5 p-0 speciality__image order-0 order-md-1 right__image" data-scroll-repeat data-scroll data-scroll-class="inView">
                <img loading="lazy" src="{{url('/')}}/assets/images/why-us/{{$why_us_row->section_image}}" alt="{{$why_us_row->section_title}}" class="img-fluid" width="960" height="960">
            </div>
        </div>
        @endif
        @php
        $i++;
        @endphp
        @endforeach
    </div>
</main>
@endsection