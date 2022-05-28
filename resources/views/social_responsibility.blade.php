@extends('layouts.website_layout', ['sections' => $sections])
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
                <img loading="lazy" src="{{url('/')}}/assets/images/social-responsiblities/century-pai-logo.png" alt="Century Pai Foundation"
                    class="img-fluid  mb-5" data-scroll data-scroll-speed="1">
                <h1 class="heading-primary mb-5" data-scroll data-scroll-speed="1.2">{{$meta_data->introduction_text_one}}</h1>
                <p class="paragraph" data-scroll data-scroll-speed="1.4">{{$meta_data->introduction_text_two}}</p>
            </div>
        </div>
    </div>
    <div class="container-fluid contribution">
        <div class="row mt-5 pt-5">
            @foreach($sections as $section_row)
            <a href="#" class="col-12 col-md-6 p-0 contribution__block" data-bs-toggle="modal" data-bs-target="#{{Str::slug($section_row->section_title)}}">
                <img loading="lazy" src="{{url('/')}}/assets/images/social-responsibilities/{{$section_row->section_image}}" alt="{{$section_row->section_title}}" class="img-fluid" width="960" height="960">
                <div class="contribution__block__caption" data-scroll data-scroll-repeat
                    data-scroll-class="fadeInView" data-scroll-delay="2000">
                    <h2 class="sub-title mb-4" data-scroll data-scroll-speed="1">{{$section_row->section_title}}</h2>
                    <span class="link" data-scroll data-scroll-speed="1.2" ><span></span> Learn More</span>
                </div>
            </a>
            @endforeach
        </div>
    </div>
    <div class="container-fluid intro">
        <div class="row custom-row justify-content-center">
            <div class="col-12 col-md-11 col-lg-10 intro__inner text-center">
                <h1 class="heading-primary mb-5" data-scroll data-scroll-speed="1">To improve the socio-economic infrastructure of Channahalli village</h1>
                <p class="paragraph mb-5" data-scroll data-scroll-speed="1.2">Century Real Estate recently
                    adopted Channahalli village near
                    Chikkajala
                    in Karnataka for its flagship Corporate Social
                    Responsibility (CSR) initiative. The objective of the initiative is to work towards
                    infrastructural and socioeconomic
                    development in and around the village through community interventions over a15 month period
                    by
                    involving various
                    stakeholders like community, local governing bodies, school and volunteers.
                </p>
                <!-- <a class="link" data-scroll data-scroll-speed="1.4" href="#"> <span></span>Read More</a> -->
            </div>
        </div>
    </div>
    <div class="container-fluid social_projects" data-scroll data-scroll-speed="1">
        <div class="row custom-row">
            @foreach($social_projects as $social_project_row)
            <div class="social_projects__block">
                <div class="social_projects__block__title">
                    <span></span>
                    <h4 class="sub-title">{{$social_project_row->social_project_name}}</h4>
                </div>
                <div class="social_projects__block__info">
                    <p class="paragraph">{{$social_project_row->social_project_description}}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <div class="container-fluid gallery" data-scroll data-scroll-speed="1">
        @php
        $i = 0;
        @endphp
        @foreach($gallery_image_array as $gallery_image_single_array)
        @if($i % 2 == 0)
        <div class="row">
            <div class="col-12 col-md-6 p-0 gallery__block">
                @if(isset($gallery_image_single_array[0]))
                <img loading="lazy" src="{{url('/')}}/assets/images/gallery/{{$gallery_image_single_array[0]['gallery_image_name']}}" alt="{{$gallery_image_single_array[0]['gallery_image_caption']}}" class="img-fluid" width="960" height="1075">
                @endif
            </div>
            <div class="col-12 col-md-6 p-0 gallery__block">
                @if(isset($gallery_image_single_array[1]))
                <img loading="lazy" src="{{url('/')}}/assets/images/gallery/{{$gallery_image_single_array[1]['gallery_image_name']}}" alt="{{$gallery_image_single_array[1]['gallery_image_caption']}}" class="img-fluid" width="960" height="538">
                @endif
                @if(isset($gallery_image_single_array[2]))
                <img loading="lazy" src="{{url('/')}}/assets/images/gallery/{{$gallery_image_single_array[2]['gallery_image_name']}}" alt="{{$gallery_image_single_array[2]['gallery_image_caption']}}" class="img-fluid" width="960" height="538">
                @endif
            </div>
        </div>
        @else
        <div class="row">
            <div class="col-12 col-md-6 p-0 gallery__block">
                @if(isset($gallery_image_single_array[0]))
                <img loading="lazy" src="{{url('/')}}/assets/images/gallery/{{$gallery_image_single_array[0]['gallery_image_name']}}" alt="{{$gallery_image_single_array[0]['gallery_image_caption']}}" class="img-fluid" width="960" height="538">
                @endif
                @if(isset($gallery_image_single_array[1]))
                <img loading="lazy" src="{{url('/')}}/assets/images/gallery/{{$gallery_image_single_array[1]['gallery_image_name']}}" alt="{{$gallery_image_single_array[1]['gallery_image_caption']}}" class="img-fluid" width="960" height="538">
                @endif
            </div>
            <div class="col-12 col-md-6 p-0 gallery__block">
                @if(isset($gallery_image_single_array[2]))
                <img loading="lazy" src="{{url('/')}}/assets/images/gallery/{{$gallery_image_single_array[2]['gallery_image_name']}}" alt="{{$gallery_image_single_array[2]['gallery_image_caption']}}" class="img-fluid" width="960" height="1075">
                @endif
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