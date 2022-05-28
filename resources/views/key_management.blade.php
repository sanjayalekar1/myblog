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
        <div class="row custom-row justify-content-center">
            <div class="col-12 col-md-11 col-lg-10 intro__inner text-center">
                <h1 class="heading-primary mb-5" data-scroll data-scroll-speed="1">Key Management</h1>
                <p class="paragraph mb-5" data-scroll data-scroll-speed="1.2">{{$meta_data->introduction_text_one}}</p>
            </div>
        </div>
    </div>

    <div class="container-fluid directors">
        <div class="row custom-row">
            <div class="col-12 management__title mb-4">
                <h2 class="sub-title mb-5" data-scroll data-scroll-speed="1">Board of Directors</h2>
                <h3 class="heading-primary mb-3 pt-3" data-scroll data-scroll-speed="1.2">Century Real Estate
                </h3>
            </div>
        </div>
        <div class="row custom-row directors__listing mb-4">
            @foreach($board_managements as $management_row)
            <div class="col-12 col-md-12 col-lg-6 mb-4">
                <div class="row directors__listing__block m-0" data-scroll-repeat data-scroll data-scroll-speed=".8" data-scroll-class="inView">
                    <div class="col-12 col-md-5  directors__listing__block__image p-0">
                        <img loading="lazy" src="{{url('/')}}/assets/images/management/{{$management_row->management_thumbnail}}" alt="{{$management_row->management_name}}" class="img-fluid">
                    </div>
                    <div class="col-12 col-md-7 directors__listing__block__info" data-scroll
                        data-scroll-speed="1">
                        <h4>{{$management_row->management_name}}</h4>
                        <span class="designation">{{$management_row->management_designation}}</span>
                        <p class="paragraph">{{Str::limit($management_row->management_description, 100)}}</p>
                        <div class="d-none profile__data">
                            <p id="data-profile-image" data-profile-image="{{url('/')}}/assets/images/management/{{$management_row->management_thumbnail}}">
                            </p>
                            <p id="data-profile-name" data-profile-name="{{$management_row->management_name}}"></p>
                            <p id="data-profile-position" data-profile-position="{{$management_row->management_designation}}"></p>
                            <p id="data-profile-linkedin" data-profile-linkedin="{{$management_row->management_linked_in}}"></p>
                            <p id="data-profile-twitter" data-profile-twitter="{{$management_row->management_twitter}}"></p>
                            <p id="data-profile-description" data-profile-description="{!!nl2br($management_row->management_description)!!}">
                        </div>
                        <a href="#" class="link"><span></span>Read More</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <div class="container-fluid vision lazy"
        style="background: #000 url({{url('/')}}/assets/images/about/vision.jpg)no-repeat center/cover;">
        <div class="row custom-row">
            <h3 class="heading-primary p-0 text-center" data-scroll="" data-scroll-speed="1.2" style="transform: matrix3d(1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, 0, 0, 10.7681, 0, 1);">To be the leadership team at Century Real Estate comprises of a vastly experienced Board of Directors
                that provides strategic direction and a Management Team that is focused on delivering results..</h3>
        </div>
    </div>
    <div class="container-fluid directors">
        <div class="row custom-row">
            <div class="col-12 management__title mb-4">
                <h2 class="sub-title mb-5">Key Management</h2>
            </div>
        </div>
        <div class="row custom-row directors__listing mb-4">
            @foreach($key_managements as $management_row)
            <div class="col-12 col-md-12 col-lg-6 mb-4">
                <div class="row directors__listing__block m-0" data-scroll-repeat data-scroll data-scroll-speed=".8" data-scroll-class="inView">
                    <div class="col-12 col-md-5  directors__listing__block__image p-0">
                        <img loading="lazy" src="{{url('/')}}/assets/images/management/{{$management_row->management_thumbnail}}" alt="{{$management_row->management_name}}" class="img-fluid">
                    </div>
                    <div class="col-12 col-md-7 directors__listing__block__info" data-scroll
                        data-scroll-speed="1">
                        <h4>{{$management_row->management_name}}</h4>
                        <span class="designation">{{$management_row->management_designation}}</span>
                        <p class="paragraph">{{Str::limit($management_row->management_description, 100)}}</p>
                        <div class="d-none profile__data">
                            <p id="data-profile-image" data-profile-image="{{url('/')}}/assets/images/management/{{$management_row->management_thumbnail}}">
                            </p>
                            <p id="data-profile-name" data-profile-name="{{$management_row->management_name}}"></p>
                            <p id="data-profile-position" data-profile-position="{{$management_row->management_designation}}"></p>
                            <p id="data-profile-linkedin" data-profile-linkedin="{{$management_row->management_linked_in}}"></p>
                            <p id="data-profile-twitter" data-profile-twitter="{{$management_row->management_twitter}}"></p>
                            <p id="data-profile-description" data-profile-description="{!!nl2br($management_row->management_description)!!}">
                        </div>
                        <a href="#" class="link"><span></span>Read More</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</main>
@endsection