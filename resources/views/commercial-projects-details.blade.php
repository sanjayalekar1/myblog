@extends('layouts.website_layout', ['project' => $project])
@section('meta_title', $project->meta_title)
@section('meta_description', $project->meta_description)
@section('canonical_tag', "projects/".$project->project_slug)
@section('banner_image', "projects/".$project->project_thumbnail)
@section('content')
<main>
<div class="scroller" data-scroll-container>
        	<div class="header-gap"></div>
            <section class="gap-medium project-header" style="background-image:url({{url('/')}}/assets/images/projects/{{$project_sliders->project_slider_image}});">
            	<div class="container">
                	<div class="row m-0">
                    	<div class="col-md-12">
                        	<nav aria-label="breadcrumb">
                              <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{url('/')}}/commercial-projects">Commercial Projects</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Century Arcade</li>
                              </ol>
                              <h1 class="section-title corporatesbold bold">{{$project_sliders->project_slider_caption}}</h1>
                              <p>{{$project_sliders->project_slider_description}}</p>
                            </nav>
                        </div>
                    </div>
                </div>
            </section>
            <section class="gap-medium project-details">
            	<div class="container">
                	<div  class="row">
                    	<div class="col-md-7">
                        	<!-- <h1 class="section-title corporatesbold bold text-uppercase"><span class="demi">Century</span> <br>Arcade</h1> -->
                          <img src="{{url('/')}}/assets/images/projects/{{$project->project_logo}} " >
                            <p class="mb-0">{{$project->project_description}}</p>
                            <div class="py-3"></div>
                            <a  class="btn btn-defaut btn-download enquire show_pointer trigger_enquire_now" >Download IM <i class='fa fa-angle-right'></i></a>
                            <div class="py-4 py-md-0"></div>
                        </div>
                        <div class="col-md-5">
                        	<img src="{{url('/')}}/assets/images/projects/{{$project->project_about_image}}" class="img-fluid">
                        </div>
                    </div>
                    <div class="py-4"></div>
                    <div class="projectt-fetures">
                    <div class="row">
                    	<div class="col-md-4">
                        	<div class="feture-icon">
                            	<img src="{{url('/')}}/assets/images/commercial-projects/location-icon.png">
                                <p>Location: {{$project->project_location_text}}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                        	<div class="feture-icon">
                            	<img src="{{url('/')}}/assets/images/commercial-projects/are-icon.png">
                                <p>Total Area: {{$project->project_area}} Sqft</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                        	<div class="feture-icon">
                            	<img src="{{url('/')}}/assets/images/commercial-projects/project-type-icon.png">
                                <p>Type: {{$project->project_type_text}}</p>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </section>

            <section class="gap-medium pt-0">
            	<div class="container">
                	<div class="row">
                    	<div class="col-md-12">
                        	<div class="fancy-title-line">
                            	<h1 class="corporatesbold bold">Key USPs <span class="line"></span></h1>
                            </div>
                        </div>
                    </div>
                    <div class="py-4"></div>
                    <div class="row">
                    @if($project->feature4!='')

                    	<div class="col-md-3">
                        	<div class="key mt-0">
                            	<p>{{$project->feature1}}</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                        	<div class="key">
                            	<p>{{$project->feature2}} </p>
                            </div>
                        </div>
                        <div class="col-md-3">
                        	<div class="key">
                            	<p>{{$project->feature3}}</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                        	<div class="key">
                            	<p>{{$project->feature4}}</p>
                            </div>
                        </div>
                        @else
                        <div class="col-md-4">
                        	<div class="key mt-0">
                            	<p>{{$project->feature1}}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                        	<div class="key">
                            	<p>{{$project->feature2}} </p>
                            </div>
                        </div>
                        <div class="col-md-4">
                        	<div class="key">
                            	<p>{{$project->feature3}}</p>
                            </div>
                        </div>
                        @endif

                    </div>

                </div>
            </section>

            @if(!empty(count($project_galleries)))
            <section class="gap-medium pt-0">
            	<div class="container">
                	<div class="row">
                    	<div class="col-md-12">
                        	<div class="key-slider owl-carousel owl-theme owl-loaded owl-drag">
                            @foreach($project_galleries as $project_gallery_row)
                            	<div class="item">
                                	<img src="{{url('/')}}/assets/images/projects/{{$project_gallery_row->project_gallery_image}}">
                                    <div class="img-caption">
                                    	<p>{{$project_gallery_row->project_gallery_caption}}</p>
                                        <p>Shot on Location</p>
                                    </div>
                                </div>
                            @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            @endif

            <section class="gap-medium pt-0">
            	<div class="container">
                	<div class="row">
                    	<div class="col-md-12">
                        	<div class="fancy-title-line">
                            	<h1 class="corporatesbold bold">Connectivity <span class="line"></span></h1>
                            </div>
                        </div>
                    </div>
                    <div class="py-4"></div>
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <!-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2604.3151832419826!2d77.59366686482197!3d12.964476840860543!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bae15d82cd8a349%3A0x1d99fe6316ac405f!2sCENTURY%20RENATA%2C%20Bengaluru%2C%20Karnataka%20560027!5e0!3m2!1sen!2sin!4v1648576307543!5m2!1sen!2sin" width="100%" height="380" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe> -->
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3887.474913794592!2d77.56268031482239!3d13.005400990833701!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0!2zMTPCsDAwJzE5LjQiTiA3N8KwMzMnNTMuNSJF!5e0!3m2!1sen!2sin!4v1648633710283!5m2!1sen!2sin" width="100%" height="380" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                        <div class="col-md-4">
                            <div class="location-table">
                                {!! $project->project_landmarks !!}
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="gap-medium pb-5 pt-0">
            	<div class="container">
                    <div class="row">
                    	<div class="col-md-6">
                            <div class="fancy-title-line">
                            	<h1 class="corporatesbold bold">Similar Projects</h1>
                            </div>
                            <div class="fancy-line"></div>
                        </div>
                    	<div class="col-md-6">
                        	<div class="btn-group">
                            	<a href="{{url('/')}}/commercial-projects" class="btn btn-defaut btn-download btn-bordred">View All Projects <i class='fa fa-angle-right'></i></a>
                                <a  class="btn btn-defaut btn-download  enquire show_pointer trigger_enquire_now" data-toggle="modal" data-target="#enquire_now_Modal">Download IM <i class='fa fa-angle-right'></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="gap-medium pt-0">
            	<div class="projects-slider owl-carousel owl-theme owl-loaded owl-drag">
                  @foreach($related_projects as $related_project_row)
                    <div class="item">
                      <div class="project-thumb" style="background-image:url({{url('/')}}/assets/images/projects/{{$related_project_row->project_thumbnail}});">
                      	<div class="project-info">
                        	<h4>{{$related_project_row->project_title}}</h4>
                            <h6>{{$related_project_row->project_location_text}}</h6>
                            <p>{{substr($related_project_row->project_description, 0, 45)}}</p>
                            <a href="{{url('/')}}/commercial-projects/{{$related_project_row->project_slug}}" class="btn bnt-default">Learn More <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                        </div>
                      </div>
                    </div>
                  @endforeach
                </div>
            </section>


</main>
<script src="{{url('/')}}/assets/js/vanilla-tabs.min.js" defer></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script>
			jQuery(document).ready(function(){
				$('.projects-slider').owlCarousel({
				center: true,
				items:2,
				loop:true,
				margin:20,
				nav: true,
            	navText:["<div class='nav-btn prev-slide'><i class='fa fa-angle-left'></i> </div>","<div class='nav-btn next-slide'><i class='fa fa-angle-right'></i></div>"],
				autoplay:true,
				slideTransition: 'linear',
				autoplaySpeed: 1000,
				//autoplayTimeout: 4000,
				autoplayHoverPause:false,
				responsive:{
					0:{
						items:1,
						margin:15,
						center: false,
					},
					600:{
						items:3,
					},
					1600:{
						items:4,
					}
				}
				});

				$('.key-slider').owlCarousel({
				items:1,
				dots:true,
				loop:true,
				autoplay:true,
				slideTransition: 'linear',
				autoplaySpeed: 1000,
				responsive:{
					0:{
						items:1,
						},
					600:{
						items:1,
						}
					}
				});
			});

        </script>

@endsection
