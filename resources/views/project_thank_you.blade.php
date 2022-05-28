@extends('layouts.website_layout')
@section('meta_title', "Thank You | ".$project->project_name)
@section('meta_description', "Thank You ".$project->meta_description)
@section('canonical_tag', "projects/".$project->project_url_slug)
@section('banner_image', "projects/".$project->project_thumbnail)
@section('content')
<style>
.download__brochure{display:none;}	
</style>
<main>
	<div class="container-fluid banner lazy p-0" data-scroll-repeat data-scroll data-scroll-class="inView" style="background: #000 url({{url('/')}}/assets/images/home/thank_you.jpg)no-repeat top center/cover;">
	    <div class="row custom-row justify-content-center" style="padding-top: 200px;color:white">
            <div class="col-12 col-md-11 col-lg-10 text-center project__intro__info__cta">
                <h1 class="heading-primary mb-5" data-scroll data-scroll-speed="1">Thank you for your interest!</h1>
                <p class="paragraph mb-5" data-scroll data-scroll-speed="1.2">We will reaching out to you shortly with the details</p>
                <div class="row justify-content-center">
                	@if(!empty($project->project_brochure))
	                <div class="col-12 col-md-4">
	                    <a class="link" href="{{url('/')}}/assets/pdfs/{{$project->project_brochure}}" target="_blank" style="color:white">download Brochure <span><img loading="lazy" src="{{url('/')}}/assets/images/home/download-brochure-white.png" alt="Download" class="img-fluid" width="26" height="28"></span></a>
	                </div>
	                @endif
                    @if(!empty($project->project_3d_walk))
	                <div class="col-12 col-md-4 walkthrough">
	                    <a class="link" data-iframe="{{$project->project_3d_walk}}" style="color:white">Take a Tour <span><img loading="lazy" src="{{url('/')}}/assets/images/home/360-degrees-white.png" alt="Take A Tour" class="img-fluid" width="43" height="32"></span></a>
	                </div>
	                @endif
	            </div>
            </div>
        </div>
    </div>
	<div class="container-fluid project__links" data-scroll-offset="5%" data-scroll-repeat data-scroll data-scroll-class="inView">
        <div class="row custom-row">
            <div class="col-12 col-md-6 project__links__left">
                 <div class="title">
                    <h3 class="sub-title">Other Projects</h3>
                </div>
            </div>
            <div class="col-12 col-md-6 project__links__right">
                
            </div>
        </div>
    </div>

    @if(!empty(count($related_projects)))
    <div class="container-fluid project__other" data-scroll-offset="5%" data-scroll-repeat data-scroll data-scroll-class="inView">
        <div class="row">
            @foreach($related_projects as $project_row)
            <div class="col-12 col-md-4">
                <div class="project__other__left__block__item mobile-items">
                    <a @if($project_row->project_template_id != 3) href="{{url('/')}}/projects/{{$project_row->project_url_slug}}" target="_blank" @endif class="project__other__left__block__item__inner">
                        <img loading="lazy" src="{{url('/')}}/assets/images/projects/{{$project_row->project_thumbnail}}" alt="{{$project_row->project_name}}" class="img-fluid" width="488" height="488">
                        <div class="project__other__left__block__item__inner__caption" data-scroll data-scroll-repeat data-scroll-class="fadeInView" data-scroll-delay="2000">
                            <h3 class="project-heading mb-4" data-scroll data-scroll-speed="1">{{$project_row->project_name}}</h3>
                            @if(!empty($project_row->project_accommodation_type))
                            <h4 data-scroll data-scroll-speed="1.1" class="mb-3"><span><i class="fa fa-building-o" aria-hidden="true"></i></span> {{$project_row->project_accommodation_type}}</h4>
                            @endif
                            @if(!empty($project_row->project_location_text))
                            <h4 data-scroll data-scroll-speed="1.2" class="mb-2"><span><i class="fa fa-map-marker" aria-hidden="true"></i></span> {{$project_row->project_location_text}}</h4>
                            @endif
                            @if($project_row->project_template_id != 3)
                            <span class="link" data-scroll data-scroll-speed="1.2"> <span></span>Explore</span>
                            @endif
                        </div>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</main>
@endsection