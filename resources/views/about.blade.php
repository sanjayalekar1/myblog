@extends('layouts.website_layout')
@section('meta_title', $meta_data->meta_title)
@section('meta_description', $meta_data->meta_description)
@section('canonical_tag', $meta_data->canonical_tag)
@section('banner_image', "banners/".$banner->banner_image)
@section('content')
<main>
    <div class="container-fluid banner lazy p-0" data-scroll-repeat data-scroll data-scroll-class="inView" style="background: #000 url({{url('/')}}/assets/images/banners/{{$banner->banner_image}})no-repeat top center/cover;">
    </div>
    <div class="container-fluid intro">
        <div class="row custom-row justify-content-center">
            <div class="col-12 col-md-11 col-lg-10 intro__inner text-center">
                <h1 class="heading-primary mb-5" data-scroll data-scroll-speed="1">{{$meta_data->introduction_text_one}}</h1>
                <p class="paragraph mb-5" data-scroll data-scroll-speed="1.2">{{$meta_data->introduction_text_two}}</p>
                <!-- <a data-scroll data-scroll-speed="1.4" class="link" href="#"> <span></span>Read More</a> -->
            </div>
        </div>
    </div>
    <div class="container-fluid founder p-0" data-scroll-repeat data-scroll data-scroll-class="inView">
        <div class="founder__block">
            <img loading="lazy" src="{{url('/')}}/assets/images/banners/{{$banner_two->banner_image}}" alt="About Us" class="img-fluid" width="1920" height="800">
            <div class="founder__block__caption custom-row">
                <p data-scroll data-scroll-speed="1"></p>
            </div>
        </div>
    </div>
    <div class="container-fluid history">
        <div class="row custom-row pr-0">
            <div class="history__title p-0">
                <h2 class="sub-title" data-scroll data-scroll-speed="1">history</h2>
            </div>
            <div class="year__slider p-0 owl-carousel owl-theme" data-scroll data-scroll-speed="1">
                @foreach($timelines as $timeline_row)
                <div class="year__slider__item">{{$timeline_row->timeline_year}}</div>
                @endforeach
            </div>
        </div>
        <div class="row custom-row">
            <div class="history__slider p-0 owl-carousel owl-theme">
                @foreach($timelines as $timeline_row)
                <div class="row history__slider__item">
                    <div class="col-12 col-sm-12 col-md-5">
                        <div class="history__slider__item__image">
                            <img loading="lazy" src="{{url('/')}}/assets/images/timelines/{{$timeline_row->timeline_thumbnail}}" alt="{{$timeline_row->timeline_year}}" class="img-fluid" width="808" height="1022">
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-7">
                        <div class="history__slider__item__info">
                            <div class="arrows" data-scroll data-scroll-speed="1">
                                <span class="left"></span>
                                <span class="right"></span>
                            </div>
                            <div class="text">
                                <p class="heading-primary" data-scroll data-scroll-speed="1">{{$timeline_row->timeline_description}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="container-fluid vision lazy"
        style="background: #000 url({{url('/')}}/assets/images/about/vision.jpg)no-repeat center/cover;">
        <div class="row custom-row">
            <h2 class="sub-title mb-5 p-0" data-scroll data-scroll-speed="1">Vision</h2>
            <h3 class="heading-primary p-0" data-scroll data-scroll-speed="1.2">To be the most respected and progressive real estate brand that will catalyse the industry and play a significant role in the building of a new and a better India, suited for the evolving life and lifestyle of its people.</h3>
        </div>
    </div>
    <div class="container-fluid missionvalues">
        <div class="row">
            <div class="col-12 col-md-6 missionvalues__block lazy"
                style="background: #000 url({{url('/')}}/assets/images/about/mission.jpg)no-repeat center/cover;">
                <h2 class="sub-title mb-5 p-0" data-scroll data-scroll-speed="1">Mission</h2>
                <span data-bs-toggle="modal" data-bs-target="#mission" class="link" data-scroll data-scroll-speed="1.2"><span></span>Learn More</span>
            </div>
            <div class="col-12 col-md-6 missionvalues__block lazy"
                style="background: #000 url({{url('/')}}/assets/images/about/value.jpg)no-repeat center/cover;">
                <h2 class="sub-title mb-5 p-0" data-scroll data-scroll-speed="1">Values</h2>
                <span data-bs-toggle="modal" data-bs-target="#vision" class="link" data-scroll data-scroll-speed="1.2"><span></span>Learn More</span>
            </div>
        </div>
    </div>
    <div class="container-fluid management">
        <div class="row custom-row pb-4">
            <h2 class="sub-title mb-5 p-0" data-scroll data-scroll-speed="1">Key management</h2>
            <h3 class="heading-primary p-0" data-scroll data-scroll-speed="1.2">Experience is a crucial element of our <br> success.</h3>
        </div>
        <div class="row custom-row mt-5">
            <div class="col-12 text-end mb-4">
                <a href="{{url('/')}}/key-management" class="link"><span></span>View All</a>
            </div>
            @foreach($managements as $management_row)
            <div class="col-12 col-md-4 management__block p-0" data-scroll-repeat data-scroll data-scroll-speed="1.2" data-scroll-class="inView">
                <img loading="lazy" src="{{url('/')}}/assets/images/management/{{$management_row->management_thumbnail}}" alt="{{$management_row->management_name}}" class="img-fluid" width="547" height="547">
                <div class="management__block__caption">
                    <h4 data-scroll data-scroll-speed="1">{{$management_row->management_name}}</h4>
                    <p class="m-0" data-scroll data-scroll-speed="1.2">{{$management_row->management_designation}}</p>
                </div>
                <div class="d-none profile__data">
                    <p id="data-profile-image" data-profile-image="{{url('/')}}/assets/images/management/{{$management_row->management_thumbnail}}"></p>
                    <p id="data-profile-name" data-profile-name="{{$management_row->management_name}}"></p>
                    <p id="data-profile-position" data-profile-position="{{$management_row->management_designation}}"></p>
                    <p id="data-profile-linkedin" data-profile-linkedin="{{$management_row->management_linked_in}}"></p>
                    <p id="data-profile-twitter" data-profile-twitter="{{$management_row->management_twitter}}"></p>
                    <p id="data-profile-description" data-profile-description="{!!nl2br($management_row->management_description)!!}">
                    </p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <div class="container-fluid social lazy"
        style="background: #000 url({{url('/')}}/assets/images/home/social-responsibilities.jpg)no-repeat center/cover;"
        data-scroll-offset="5%" data-scroll-repeat data-scroll data-scroll-class="inView">
        <div class="row custom-row social__inner align-items-center">
            <div class="col-12 col-sm-12 col-md-6">
                <div class="social__inner_left">
                    <p class="sub-title" data-scroll data-scroll-speed="1">SOCIAL RESPONSIBILITY</p>
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
    <div class="container-fluid bottom">
        <div class="row custom-row">
            <div class="col-12 col-md-5 bottom__links">
                <a href="{{url('/')}}/associated-enterprises" class="link" data-scroll
                    data-scroll-speed="1"><span></span>Associated enterprises</a>
            </div>
            <div class="col-12 col-md-5 bottom__links">
                <a href="{{url('/')}}/corporate-governance" class="link" data-scroll
                    data-scroll-speed="1"><span></span>corporate Governance</a>
            </div>
        </div>
    </div>
</main>
@endsection