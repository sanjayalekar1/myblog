@extends('layouts.website_layout', ['page_name' => $meta_data->page_name])
@section('meta_title', $meta_data->meta_title)
@section('meta_description', $meta_data->meta_description)
@section('canonical_tag', $meta_data->canonical_tag)
@section('banner_image', "banners/".$banner->banner_image)
@section('content')
<main>
    <div class="container-fluid banner p-0">
        <video class="desktop" poster="{{url('/')}}/assets/videos/banner-poster.jpg" playsinline autoplay muted loop>
            <source src="{{url('/')}}/assets/videos/desktop-home-banner.mp4" type="video/mp4">
        </video>
        <video class="mobile" poster="{{url('/')}}/assets/videos/banner-poster.jpg" playsinline autoplay muted loop>
            <source src="{{url('/')}}/assets/videos/mobile-home-banner.mp4" type="video/mp4">
        </video>
        <div class="banner__slider owl-carousel owl-theme">
            @foreach($home_page_sliders as $home_page_slider_row)
            <div class="banner__slider__item" style="background:#000 url({{url('/')}}/assets/images/banners/{{$banner->banner_image}})no-repeat bottom center/cover;">
                <div class="banner__slider__item__layer_top">
                    <h4 data-splitting>{!!nl2br($home_page_slider_row->slider_caption)!!} <span class="line"></span></h4>
                </div>
                @if(!empty($home_page_slider_row->slider_caption_two))
                <div class="banner__slider__item__caption">
                    <p>{!!nl2br($home_page_slider_row->slider_caption_two)!!}</p>
                    <div class="banner__slider__item__caption__scroll">
                        <span></span> Scroll Down
                    </div>
                </div>
                @endif
            </div>
            @endforeach
        </div>
    </div>
    <div class="container-fluid about" id="about">
        <div class="row custom-row about-row">
            <div class="col-12 col-md-6 order-1 order-md-0">
                <div class="about__left" data-scroll-offset="10%">
                    <div class="about__left__title">
                        <h2 class="sub-title mb-5 mt-4" data-scroll data-scroll-speed="1">{{$home_page_about_us->home_page_about_us_title}}</h2>
                        <h1 class="heading-primary mb-1" data-scroll data-scroll-speed="1.2">{{$home_page_about_us->home_page_about_us_description}}</h1>
                        <div class="about__left__title__content">
                            <p class="paragraph" data-scroll data-scroll-speed="1.4">{!!$home_page_about_us->about_us_content!!}</p>
                            <a class="link mb-3" href="{{url('/')}}/about" data-scroll data-scroll-speed="1.6"><span></span> More About Us</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12  col-md-6 order-0 order-md-1 p-0">
                <div class="about__right">
                    <img loading="lazy" src="{{url('/')}}/assets/images/home-page/{{$home_page_about_us->home_page_about_us_image}}" data-scroll-offset="10%" data-scroll-repeat data-scroll data-scroll-class="inView" alt="About Century" class="img-fluid" width="960" height="950">
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid projects">
        <div class="row custom-row">
            <div class="col-12">
                <h2 class="sub-title mb-5 mt-4" data-scroll data-scroll-speed="1">Projects</h2>
                <h3 class="heading-primary" data-scroll data-scroll-speed="1.2">Presenting the most premium residences and plotted options for your dream home.</h3>
            </div>
        </div>
        <div class="row custom-row projects__tabs mb-5 mt-5" id="filters" data-scroll data-scroll-speed="1.3">
            <div class="col-12 col-sm-12 col-md-6">
                <ul class="button-group project_type_filter">
                    @foreach($project_types as $project_type_row)
                    <li data-filter="{{$project_type_row->id}}">{{$project_type_row->project_type_title}}</li>
                    @endforeach
                </ul>
            </div>
            <div class="col-12 col-sm-12 col-md-6 projects__tabs__link">
                <a class="link" href="{{url('/')}}/projects"> <span></span>View All Projects</a>
            </div>
        </div>

        <div class="projects__lists">
            @include('project_blocks')
        </div>
    </div>
    
    <div class="container-fluid search d-none">
        <div class="row custom-row align-items-center">
            <div class="col-12 col-sm-12 col-md-5 search__title">
                <h4>Our ongoing projects</h4>
            </div>
            <div class="col-12 col-sm-12 col-md-2 search__box">
                <select class="form-control" id="zoneOptions">
                    <option value="">Zone</option>
                    @foreach($project_zones as $project_zone_row)
                    <option value="{{$project_zone_row->id}}">{{$project_zone_row->project_zone_title}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-12 col-sm-12 col-md-2 search__box">
                <select class="form-control" id="locationOptions">
                    <option value="">Location</option>
                    @foreach($project_locations as $project_location_row)
                    <option value="{{$project_location_row->id}}">{{$project_location_row->project_location_title}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-12 col-sm-12 col-md-2 search__box">
                <select class="form-control" id="categoryOptions">
                    <option value="">Type</option>
                    @foreach($project_categories as $project_category_row)
                    <option value="{{$project_category_row->id}}">{{$project_category_row->project_category_title}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-12 col-sm-12 col-md-1">
                <span class="search_icon filter_projects_submit"></span>
            </div>
        </div>
    </div>
    @if(!empty(count($testimonials)))
    <div class="container-fluid testimonials">
        <div class="row custom-row">
            <div class="col-12">
                <h2 class="sub-title mb-5 mt-4" data-scroll data-scroll-speed="1">Video Wall</h2>
            </div>
        </div>
        <div class="row custom-row">
            @foreach($testimonials as $testimonial_row)
            <div class="col-12 col-md-6 testimonials__block play__icon" data-youtube-id="{{$testimonial_row->testimonial_youtube_id}}">
                <div class="testimonials__block__inner">
                    <img loading="lazy" src="{{url('/')}}/assets/images/testimonials/{{$testimonial_row->testimonial_thumbnail}}" alt="{{$testimonial_row->testimonial_name}}" class="img-fluid cover__image" width="800" height="800">
                    <div class="video__play__button">
                        <span></span>
                    </div>
                    <h3 class="caption" data-scroll-speed="1">{{$testimonial_row->testimonial_content}}<span> - {{$testimonial_row->testimonial_name}} </span></h3>
                </div>
            </div>
            @endforeach
        </div>  
    </div>
    @endif
    <div class="container-fluid enquiry" data-scroll-offset="5%" data-scroll-repeat data-scroll data-scroll-class="inView">
        <div class="row custom-row pr-0">
            <div class="col-12 col-sm-12 col-md-6">
                @php
                $form_location = "Home Page";
                @endphp
                @include('enquiry_form')
            </div>
            <div class="col-12 col-sm-12 col-md-6 enquiry__right lazy p-0" style="background: #000 url({{url('/')}}/assets/images/home/enquiry_now_img.jpg)no-repeat center/cover;">
            </div>
        </div>
    </div>
    <div class="container-fluid ceomessage" data-scroll-offset="5%" data-scroll-repeat data-scroll
        data-scroll-class="inView">
        <div class=" row custom-row justify-content-center">
            <div class="col-12 col-md-11 col-lg-10 ceomessage__block text-center">
                <h3 class="sub-title mb-5">THINKING AHEAD</h3>
                <h4 class="heading-primary mb-4 fst-italic">The diverse and state-of-the-art lifestyle
                    experiences offered by Century Real Estate is the result of our corporate
                    philosophy – Thinking Ahead.</h4>
                <span class="d-block paragraph mb-5">Such a philosophy drives us to constantly explore and
                    innovate with new technologies, materials and designs from around the world. It helps us to
                    steadily raise the bar, not just for ourselves, but set new benchmarks in the industry, and
                    ensure good ROI for our customers, partners and investors.</span>
                <a class="link" href="{{url('/')}}/key-management"> <span></span> Our key management</a>
            </div>
        </div>
    </div>
    <div class="container-fluid social lazy"
        style="background: #000 url({{url('/')}}/assets/images/home/social-responsibilities.jpg)no-repeat center/cover;"
        data-scroll-offset="5%" data-scroll-repeat data-scroll data-scroll-class="inView">
        <div class=" row custom-row social__inner align-items-center">
            <div class="col-12 col-sm-12 col-md-6">
                <div class="social__inner_left">
                    <p class="sub-title" data-scroll data-scroll-speed="1">Social Responsibilities</p>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-6">
                <div class="social__inner_right">
                    <a class="link" href="{{url('/')}}/social-responsibility" data-scroll data-scroll-speed="1">
                        <span></span> Learn More</a>
                </div>
            </div>
        </div>
    </div>
</main>


@endsection