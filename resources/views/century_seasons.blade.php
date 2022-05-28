@extends('layouts.website_layout', ['project' => $project])
@section('meta_title', $project->meta_title)
@section('meta_description', $project->meta_description)
@section('canonical_tag', "projects/".$project->project_url_slug)
@section('banner_image', "projects/".$project->project_thumbnail)
@section('content')
<main>
    <div class="container-fluid project__banner p-0">
        <div class="project__banner__slider owl-carousel owl-theme">
            @foreach($project_sliders as $project_slider_row)
            <div class="project__banner__slider__item">
                <img loading="lazy" src="{{url('/')}}/assets/images/projects/{{$project_slider_row->project_slider_image}}" alt="{{$project->project_name}}" class="img-fluid desktop">
                <img loading="lazy" src="{{url('/')}}/assets/images/projects/{{$project_slider_row->project_slider_image_mobile}}" alt="{{$project->project_name}}" class="img-fluid mobile">
                <div class="project__banner__slider__item__caption">
                    <h1 class="heading-primary mb-3">{{$project_slider_row->project_slider_caption}}</h1>
                    <p class="paragraph">{{$project_slider_row->project_slider_description}}</p>
                </div>
            </div>
            @endforeach
        </div>
        <div class="row project__banner__footer">
            <div class="col-12 col-md-3 scroll">
                <div class="banner__scroll">
                    <span></span> Scroll Down
                </div>
            </div>
            @if(!empty($project->project_overview_title_one) && !empty($project->project_overview_value_one))
            <div class="col-6 col-md-2 specs">
                <p>{{strtoupper($project->project_overview_title_one)}}</p>
                <h2>{{strtoupper($project->project_overview_value_one)}}</h2>
            </div>
            @endif
            @if(!empty($project->project_overview_title_two) && !empty($project->project_overview_value_two))
            <div class="col-6 col-md-2 specs">
                <p>{{strtoupper($project->project_overview_title_two)}}</p>
                <h2>{{strtoupper($project->project_overview_value_two)}}</h2>
            </div>
            @endif
            @if(!empty($project->project_overview_title_three) && !empty($project->project_overview_value_three))
            <div class="col-6 col-md-2 specs">
                <p>{{strtoupper($project->project_overview_title_three)}}</p>
                <h2>{{strtoupper($project->project_overview_value_three)}}</h2>
            </div>
            @endif
            @if(!empty($project->project_overview_title_four) && !empty($project->project_overview_value_four))
            <div class="col-6 col-md-3 specs">
                <p>{{strtoupper($project->project_overview_title_four)}}</p>
                <h2>{{strtoupper($project->project_overview_value_four)}}</h2>
            </div>
            @endif
        </div>
    </div>
    <div class="container-fluid project__intro seasons mb-0">
        <div class="intro-l-img"><img loading="lazy" src="{{url('/')}}/assets/images/project-details/illustrations/intro-l-img.png" alt="Season" class="img-fluid"></div>
        <div class="intro-r-img"><img loading="lazy" src="{{url('/')}}/assets/images/project-details/illustrations/intro-R-img.png" alt="Season" class="img-fluid"></div>
        <div class="row custom-row justify-content-center">
            <div class="col-12 col-md-11 col-lg-10 text-center">
                <div class="project__intro__logo mb-5" data-scroll data-scroll-speed="1">
                    <img loading="lazy" src="{{url('/')}}/assets/images/projects/{{$project->project_logo}}" alt="{{$project->project_name}}" class="img-fluid">
                </div>
                <div class="project__intro__tagline mb-5">
                    <h1 class="heading-primary mb-4" data-scroll data-scroll-speed="1.2">{{$project->project_headline}}</h1>
                    <h2 class="sub-tagline" data-scroll data-scroll-speed="1.3">{!!nl2br($project->project_caption)!!}</h2>
                </div>
            </div>
        </div>
        <div class="row custom-row project__intro__info mt-5">
            <div class="col-12 col-md-6 col-lg-6">
                <div class="project__intro__info__text" data-scroll data-scroll-speed=".5">
                    <p class="paragraph">{!!nl2br($project->project_description)!!}</p>
                </div>
                <div class="row project__intro__info__cta mt-5">
                    @if(!empty($project->project_brochure))
                    <div class="col-12 col-md-6">
                        <a class="link show_pointer download_brochure_config" data-type="1" data-id="{{$project->id}}">download Brochure <span><img loading="lazy" src="{{url('/')}}/assets/images/home/download-brochure.png" alt="Download" class="img-fluid"></span></a>
                    </div>
                    @endif
                    @if(!empty($project->project_3d_walk))
                    <div class="col-12 col-md-6 walkthrough">
                        <a class="link" data-iframe="{{$project->project_3d_walk}}">Take a Tour <span><img loading="lazy" src="{{url('/')}}/assets/images/home/360-degrees.png" alt="Take A Tour" class="img-fluid"></span></a>
                    </div>
                    @endif
                </div>
            </div>
            @if(!empty($project->project_about_image))
            <div class="col-12 col-md-6 col-lg-6">
                <div class="project__intro__info__img" data-scroll data-scroll-speed="1.5">
                    <img loading="lazy" src="{{url('/')}}/assets/images/projects/{{$project->project_about_image}}" alt="{{$project->project_name}}" class="img-fluid">
                </div>
            </div>
            @endif
        </div>
    </div>
    @if(!empty($project->project_rera_numbers))
    @php
    $project_rera_numbers_array = explode(", ", $project->project_rera_numbers);
    @endphp
    <div class="container-fluid project__rera">
        <div class="row custom-row project__rera__number">
            <div class="col-12">
                <div class="title">
                    <h3 class="sub-title">RERA Number</h3>
                </div>
                @foreach($project_rera_numbers_array as $project_rera_number)
                <p class="paragraph">{{$project_rera_number}}</p>
                @endforeach
            </div>
        </div>
    </div>
    @else
        <div class="container-fluid project__rera"> </div>
    @endif
    
    @if(!empty(count($project_video_sliders)))
    <div class="container-fluid project__videos seasons__videos">
        <div class="videos__hill"><img loading="lazy" src="{{url('/')}}/assets/images/project-details/illustrations/hiils.png" alt="Season" class="img-fluid"></div>
        <div class="row custom-row">
            <div class="col-12 title">
                <h3 class="sub-title">Video Wall</h3>
            </div>
            <div class="col-12 project__videos__slider owl-carousel owl-theme">
                @foreach($project_video_sliders as $project_video_slider_row)
                <div class="project__videos__slider__item">
                    <img loading="lazy" src="{{url('/')}}/assets/images/projects/{{$project_video_slider_row->project_video_thumbnail}}" alt="{{$project_video_slider_row->project_video_title}}" class="img-fluid">
                    <!-- <img loading="lazy" src="{{url('/')}}/assets/images/project-details/play.png" alt="Play" class="img-fluid play__icon" data-youtube-id="{{$project_video_slider_row->video_youtube_id}}" data-id="{{$project_video_slider_row->project_video_category_id}}"> -->
                    <div id="play-video" class="video__play__button play__icon" data-youtube-id="{{$project_video_slider_row->video_youtube_id}}" data-id="{{$project_video_slider_row->project_video_category_id}}">
                    <span></span>
                    </div>

                    <span class="caption">{{$project_video_slider_row->project_video_title}}</span>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif

    @if(!empty(count($project_highlighted_amenities)))
    <div class="container-fluid project__amenities">
        <div class="row custom-row">
            <div class="col-4 title">
                <h3 class="sub-title">Amenities</h3>
            </div>
            <div class="col-8 project__amenities__nav">
                @if(count($project_highlighted_amenities) > 1)
                <span class="slide_left"><img loading="lazy" src="{{url('/')}}/assets/images/home/Arrow.png" alt="Left" class="img-fluid"></span>
                <span class="slide_right"><img loading="lazy" src="{{url('/')}}/assets/images/home/Arrow.png" alt="right" class="img-fluid"></span>
                @endif
            </div>
        </div>
        <div class="project__amenities__slider owl-carousel owl-theme">
            @php
            $i = 0;
            @endphp
            @foreach($project_highlighted_amenities as $project_highlighted_amenity_row)
            <div class="row m-0">
                <div class="col-12 col-md-6 p-0 project__amenities__image" data-scroll-repeat data-scroll data-scroll-class="inView">
                    <img loading="lazy" src="{{url('/')}}/assets/images/projects/{{$project_highlighted_amenity_row->project_amenity_image}}" alt="{{$project_highlighted_amenity_row->project_amenity_title}}" class="img-fluid">
                </div>
                <div class="col-12 col-md-6  p-0 project__amenities__text">
                    <div class="project__amenities__text__inner">
                        <h3 class="heading-primary mb-2">{{$project_highlighted_amenity_row->project_amenity_title}}</h3>
                        <p class="paragraph">{!!$project_highlighted_amenity_row->project_amenity_description!!}</p>
                    </div>
                </div>
            </div>
            @php
            $i++;
            @endphp
            @endforeach
        </div>
    </div>
    @endif
    <div class="container-fluid project__experience">
        <div class="row custom-row project__experience__inner">
            <div class="col-12 col-md-6">
                @if(!empty(count($project_amenities)))
                <div class="title">
                    <h3 class="sub-title">A world of experience</h3>
                </div>
                @endif
            </div>
        </div>
        <div class="row custom-row project__experience__section">
            @foreach($project_amenities as $project_amenity_row)
            <div class="col-6 col-md-3 project__experience__section__block text-center">
                <img loading="lazy" src="{{url('/')}}/assets/images/projects/{{$project_amenity_row->project_amenity_image}}" alt="{{$project_amenity_row->project_amenity_title}}" class="img-fluid" data-scroll data-scroll-speed="1">
                <p class="paragraph" data-scroll data-scroll-speed="1.2">{{$project_amenity_row->project_amenity_title}}</p>
            </div>
            @endforeach
        </div>
    </div>

    @if(!empty(count($project_galleries)))
    <div class="container-fluid project__gallery">
        <div class="row custom-row project__gallery__tabs  mb-5 mt-5" id="filters" data-scroll
            data-scroll-speed="1.3">
            <div class="col-12 col-sm-12 col-md-6">
                <ul class="button-group">
                    @php
                    $i = 0;
                    $project_gallery_title_array = [];
                    @endphp
                    @foreach($project_galleries as $project_gallery_row)
                    @if(!in_array($project_gallery_row->project_gallery_category_title, $project_gallery_title_array))
                    @php
                    $project_gallery_title_array[] = $project_gallery_row->project_gallery_category_title;
                    @endphp
                    <li @if(empty($i)) class="is-checked" @endif data-filter=".{{$project_gallery_row->project_gallery_category_title}}">{{$project_gallery_row->project_gallery_category_title}}</li>
                    @endif
                    @php
                    $i++;
                    @endphp
                    @endforeach
                </ul>
            </div>
            @if(!empty($project->project_3d_walk))
            <div class="col-12 col-md-6 walkthrough">
                <span class="link" data-iframe="{{$project->project_3d_walk}}"> <span></span> Take a Tour</span>
            </div>
            @endif
        </div>

        <div class="project__gallery__lists">
            <div class="row grid project__gallery__lists__section active" id="Apartments" data-scroll-speed=".2" data-scroll-offset="5%" data-scroll-repeat data-scroll data-scroll-class="inView">
                @foreach($project_galleries as $project_gallery_row)
                <div class="project__gallery__lists__section__item {{$project_gallery_row->project_gallery_category_title}}">
                    <a data-magnify="project-gallery" data-caption="{{$project_gallery_row->project_gallery_caption}}" href="{{url('/')}}/assets/images/projects/{{$project_gallery_row->project_gallery_image}}" class="project__gallery__lists__section__item__inner">
                        <img loading="lazy" src="{{url('/')}}/assets/images/projects/{{$project_gallery_row->project_gallery_image}}" alt="{{$project_gallery_row->project_gallery_caption}}" class="img-fluid">
                        <div class="project__gallery__lists__section__item__inner__caption" data-scroll data-scroll-repeat data-scroll-class="fadeInView" data-scroll-delay="2000">
                            <p class="paragraph mb-4" data-scroll data-scroll-speed="1">{{$project_gallery_row->project_gallery_caption}}</p>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif

    @if(!empty(count($project_plans)))
    <div class="container-fluid plans">
        <div class="row custom-row plans__inner">
            <div class="col-12">
                <div class="title">
                    <h3 class="sub-title">Plans</h3>
                </div>
            </div>
        </div>
        <div class="row custom-row plans__section">
            <div class="col-12 col-md-12 plans__section__tab">
                <div class="row align-items-center">
                    <div class="col-1">
                        <span class="prev__plan disabled">
                            <img loading="lazy" src="{{url('/')}}/assets/images/home/plan-arrow-left.png" alt="Previous Plan" class="img-fluid">
                        </span>
                    </div>
                    <div class="col-10 plan__tabs">
                        <ul>
                            @php
                            $i = 0;
                            @endphp
                            @foreach($project_plans as $project_plan_row)
                            <li @if(empty($i)) class="active" @endif>{{$project_plan_row->project_layout_title}} <span>{{$project_plan_row->project_layout_type}}</span></li>
                            @php
                            $i++;
                            @endphp
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-1">
                        <span class="next__plan">
                            <img loading="lazy" src="{{url('/')}}/assets/images/home/plan-arrow-right.png" alt="Next Plan" class="img-fluid">
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-12 plans__section__content ">
            	<div class="plans__section__content__block owl-carousel owl-theme">
                    @foreach($project_plans as $project_plan_row)
                    <div class="row m-0 plans__item">
                        <div class="col-12 col-md-3 plan__info">
                            <div class="plan__info__inner">
                                <div class="block">
                                    <h3>{{$project_plan_row->project_layout_title}} <span>{{$project_plan_row->project_layout_type}}</span></h3>
                                </div>
                                @if(!empty($project_plan_row->project_layout_area_title_one) && !empty($project_plan_row->project_layout_area_value_one))
                                <div class="block">
                                    <p class="paragraph">{{$project_plan_row->project_layout_area_title_one}}</p>
                                    <p class="paragraph">{{$project_plan_row->project_layout_area_value_one}}</p>
                                </div>
                                @endif
                                @if(!empty($project_plan_row->project_layout_area_title_two) && !empty($project_plan_row->project_layout_area_value_two))
                                <div class="block">
                                    <p class="paragraph">{{$project_plan_row->project_layout_area_title_two}}</p>
                                    <p class="paragraph">{{$project_plan_row->project_layout_area_value_two}}</p>
                                </div>
                                @endif
                                @if(!empty($project_plan_row->project_layout_area_title_three) && !empty($project_plan_row->project_layout_area_value_three))
                                <div class="block">
                                    <p class="paragraph">{{$project_plan_row->project_layout_area_title_three}}</p>
                                    <p class="paragraph">{{$project_plan_row->project_layout_area_value_three}}</p>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-12 col-md-9 plan__image">
                            <div class="plan__image__block">
                                 <a data-magnify="plans-gallery" data-caption="{{$project_plan_row->project_layout_title}}" href="{{url('/')}}/assets/images/projects/{{$project_plan_row->project_layout_image}}">
                                    <img loading="lazy" src="{{url('/')}}/assets/images/projects/{{$project_plan_row->project_layout_image}}" alt="{{$project_plan_row->project_layout_title}}" class="img-fluid">
                                </a>
                                <!-- <img loading="lazy" src="{{url('/')}}/assets/images/projects/{{$project_plan_row->project_layout_image}}" alt="{{$project_plan_row->project_layout_title}}" class="img-fluid"> -->
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @endif
    @if(!empty(count($project_configurations)))
    <div class="container-fluid plans mb-5 pb-5">
        <div class="row custom-row plans__inner">
            <div class="col-12">
                <div class="title">
                    <h3 class="sub-title">Configurations</h3>
                </div>
            </div>
        </div>
        <div class="row custom-row plans__section">
            <div class="col-12 col-md-12 configuration">
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">Type</th>
                        <th scope="col">Area (Sq.Ft)</th>
                        <th scope="col">Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($project_configurations as $project_configuration_row)
                        <tr>
                            <td>{{$project_configuration_row->project_configuration_type}}</td>
                            <td>{{$project_configuration_row->project_configuration_area}}</td>
                            <td>
                                @if(!empty($project_configuration_row->project_configuration_sold_out))
                                Sold Out
                                @else
                                <span class="download_brochure_config" data-type="1" data-id="{{$project->id}}">Click here</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endif
    @if(!empty($project->project_location_title))
    <div class="container-fluid project__amenities bottom__amenities">
        <div class="row m-0">
            <div class="col-12 col-md-6 project__amenities__text">
                <div class="project__amenities__text__inner">
                    <h3 class="heading-primary mb-5" data-scroll data-scroll-speed="1">{{$project->project_location_title}}</h3>
                    {!!$project->project_location_description!!}
                </div>
            </div>
            @if(!empty($project->project_location_image))
            <div class="col-12 col-md-6 p-0 project__amenities__image" data-scroll-repeat data-scroll data-scroll-class="inView">
                <img loading="lazy" src="{{url('/')}}/assets/images/projects/{{$project->project_location_image}}" alt="{{$project->project_location_title}}" class="img-fluid">
            </div>
            @endif
        </div>
    </div>
    @endif

    <div class="container-fluid project__connectivity seasons__connectivity">
        <div class="row custom-row project__connectivity__inner">
            <div class="col-12">
                <div class="title">
                    <h3 class="sub-title">Connectivity</h3>
                </div>
            </div>
        </div>
        <div class="row custom-row project__connectivity__section">
            <div class="col-12 col-md-6 project__connectivity__section__map">
                {!!$project->project_location_iframe!!}
            </div>
            <div class="col-12 col-md-6 project__connectivity__section__location">
                {!!$project->project_landmarks!!}
            </div>
        </div>
    </div>

    @if(!empty(count($project_faqs)))
    <div class="container-fluid social_projects project__faqs" data-scroll data-scroll-speed="1">
        <div class="row custom-row project__connectivity__inner">
            <div class="col-12 p-0">
                <div class="title">
                    <h3 class="sub-title">Frequently asked questions</h3>
                </div>
            </div>
        </div>
        <div class="row custom-row">
            @foreach($project_faqs as $project_faq_row)
            <div class="social_projects__block">
                <div class="social_projects__block__title">
                    <span></span>
                    <h4 class="sub-title">{{$project_faq_row->project_faq_question}}</h4>
                </div>
                <div class="social_projects__block__info">
                    <p class="paragraph">{!!$project_faq_row->project_faq_answer!!}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    <div class="container-fluid project__enquiry seasons__enquiry" data-scroll-offset="5%" data-scroll-repeat data-scroll data-scroll-class="inView">
        <div class="enquiry-branches"><img loading="lazy" src="{{url('/')}}/assets/images/project-details/illustrations/branches.png" alt="Season" class="img-fluid">
        </div>
        <div class="row custom-row pr-0">
            <div class="col-12 col-sm-12 col-md-6">
                @php
                $form_location = "Project Details";
                @endphp
                @include('enquiry_form')
            </div>
            <div class="col-12 col-sm-12 col-md-6 project__enquiry__right lazy" style="background: #000 url({{url('/')}}/assets/images/projects/{{$project->project_form_image}})no-repeat center/cover;">
            </div>
        </div>
    </div>

    <div class="container-fluid project__links" data-scroll-offset="5%" data-scroll-repeat data-scroll
        data-scroll-class="inView">
        <div class="row custom-row">
            <div class="col-12 col-md-6 project__links__left">
                <a class="link"> <span></span>Other Projects</a>
            </div>
            <div class="col-12 col-md-6 project__links__right">
                <a class="link" href="{{url('/')}}/projects"> <span></span> View all Properties</a>
            </div>
        </div>
    </div>

    <div class="container-fluid project__other" data-scroll-offset="5%" data-scroll-repeat data-scroll data-scroll-class="inView">
        <div class="row">
            @foreach($related_projects as $project_row)
            <div class="col-4">
                <div class="project__other__left__block__item">
                    <a @if($project_row->project_template_id != 3) href="{{url('/')}}/projects/{{$project_row->project_url_slug}}" target="_blank" @endif class="project__other__left__block__item__inner">
                        <img loading="lazy" src="{{url('/')}}/assets/images/projects/{{$project_row->project_thumbnail}}" alt="{{$project_row->project_name}}" class="img-fluid">
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
</main>
@endsection