@extends('layouts.website_layout')
@section('meta_title', $meta_data->meta_title)
@section('meta_description', $meta_data->meta_description)
@section('canonical_tag', $meta_data->canonical_tag)
@section('banner_image', "banners/".$banner->banner_image)
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12 p-0">
            <img loading="lazy" src="{{url('/')}}/assets/images/banners/{{$banner->banner_image}}" style="height: 100vh;object-fit: cover;" alt="Coming Soon" width="100%" class="img-fluid desktop">
            <img loading="lazy" src="{{url('/')}}/assets/images/banners/{{$banner->banner_image_mobile}}" style="height: 100vh;object-fit: cover;" alt="Coming Soon" width="100%" class="img-fluid mobile">
        </div>
    </div>
</div>
<div class="container-fluid testimonial mt-5 pt-5">
    <div class="row custom-row">
        <div class="col-12">
            <h3 class="heading-primary" data-scroll data-scroll-speed="1">{{$meta_data->introduction_text_one}}</h3>
            <p class="paragraph"  data-scroll data-scroll-speed="1">{{$meta_data->introduction_text_two}}</p>
        </div>
    </div>
    <div class="testimonial__lists">
        <div class="row grid testimonial__lists__section active" data-scroll-speed=".2" data-scroll-offset="5%" data-scroll-repeat data-scroll data-scroll-class="inView">
            @foreach($testimonials as $testimonial_row)
            @if($testimonial_row->testimonial_layout_id == 1)
            <div class="testimonial__lists__section__item video All">
                <div class="content">
                    <img loading="lazy" src="{{url('/')}}/assets/images/testimonials/{{$testimonial_row->testimonial_thumbnail}}" alt="{{$testimonial_row->testimonial_name}}" class="img-fluid">
                    <div class="caption">
                        <div class="video__play__buttons play__icon" data-youtube-id="{{$testimonial_row->testimonial_youtube_id}}">
                            <img src="{{url('/')}}/assets/images/more/play-btn.png" alt="play video" class="img-fluid">
                        </div>
                        <p class="paragraph">{{$testimonial_row->testimonial_content}}</p>
                        <h3>{{$testimonial_row->testimonial_name}}</h3>
                        @if(!empty($testimonial_row->project_name))
                        <h6 class="paragraph">- {{$testimonial_row->project_name}}</h6>
                        @endif
                    </div>
                </div>
                
            </div>
            @elseif($testimonial_row->testimonial_layout_id == 2)
            <div class="testimonial__lists__section__item image__text All">
                <div class="content">
                    <img loading="lazy" src="{{url('/')}}/assets/images/testimonials/{{$testimonial_row->testimonial_thumbnail}}" alt="{{$testimonial_row->testimonial_name}}" class="img-fluid">
                    <div class="caption">
                        <span><img loading="lazy" src="{{url('/')}}/assets/images/static/quotes.png" alt="Quotes" class="img-fluid"></span>
                        <p class="paragraph">
                            {{$testimonial_row->testimonial_content}}
                        </p>
                        <h3>{{$testimonial_row->testimonial_name}}</h3>
                        @if(!empty($testimonial_row->project_name))
                        <h6 class="paragraph">- {{$testimonial_row->project_name}}</h6>
                        @endif
                    </div>
                </div>
            </div>
            @elseif($testimonial_row->testimonial_layout_id == 3)
            <div class="testimonial__lists__section__item text All">
                <div class="testimonial__lists__section__item__inner">
                    <div class="content">
                        <span><img loading="lazy" src="{{url('/')}}/assets/images/static/quotes.png" alt="Quotes" class="img-fluid"></span>
                        <p class="paragraph">
                            {{$testimonial_row->testimonial_content}}
                        </p>
                        <h3>{{$testimonial_row->testimonial_name}}</h3>
                        @if(!empty($testimonial_row->project_name))
                        <h6 class="paragraph">- {{$testimonial_row->project_name}}</h6>
                        @endif
                    </div>
                </div>
            </div>
            @endif
            @endforeach


            <!-- <div class="testimonial__lists__section__item video All">
                <div class="content">
                    <img loading="lazy" src="{{url('/')}}/assets/images/more/Talreja.jpg" alt="Mr. & Mrs. Shyam Talreja" class="img-fluid">
                    <div class="caption">
                        <div class="video__play__buttons play__icon" data-youtube-id="IwdvFYqjSRM">
                            <img src="{{url('/')}}/assets/images/more/play-btn.png" alt="play video" class="img-fluid">
                        </div>
                        <p class="paragraph">“Trust factor we have already built in with Century.”</p>
                        <h3>Mr. & Mrs. Shyam Talreja,</h3>
                        <h6 class="paragraph">- Century Renata</h6>
                    </div>
                </div>
            </div>
            <div class="testimonial__lists__section__item text  All">
                <div class="testimonial__lists__section__item__inner">
                    <div class="content">
                        <span><img loading="lazy" src="{{url('/')}}/assets/images/static/quotes.png" alt="Quotes" class="img-fluid"></span>
                        <p class="paragraph">
                            It’s been a wonderful experience from the day I got to know that an apartment building is coming up here till moving in and living over here.
                        </p>
                        <h3>Mr. Vinay Bajaj</h3>
                        <h6 class="paragraph">- Century Renata</h6>
                    </div>
                </div>
            </div>
            <div class="testimonial__lists__section__item video All">
                <div class="content">
                    <img loading="lazy" src="{{url('/')}}/assets/images/more/Sastry.jpg" alt="Mr. & Mrs. Shyam Talreja" class="img-fluid">
                    <div class="caption">
                        <div class="video__play__buttons play__icon" data-youtube-id="IwdvFYqjSRM">
                            <img src="{{url('/')}}/assets/images/more/play-btn.png" alt="play video" class="img-fluid">
                        </div>
                        <p class="paragraph">“Century does not compromise on quality.”</p>
                        <h3>Mr. Shridar Sastry</h3>
                        <h6 class="paragraph">- Century Ethos & Century Saras</h6>
                    </div>
                </div>
            </div>
            <div class="testimonial__lists__section__item text All">
                <div class="testimonial__lists__section__item__inner">
                    <div class="content">
                        <span><img loading="lazy" src="{{url('/')}}/assets/images/static/quotes.png" alt="Quotes" class="img-fluid"></span>
                        <p class="paragraph">
                            Century is nice rather than getting agitated understanding what exactly we need, what the committee needs, what is the good living we need. They have really kept up to the commitments.
                        </p>
                        <h3>Mr. Vikram</h3>
                        <h6 class="paragraph">- Century Marvel</h6>
                    </div>
                </div>
            </div>
            <div class="testimonial__lists__section__item video All">
                <div class="content">
                    <img loading="lazy" src="{{url('/')}}/assets/images/more/Bajaj.jpg" alt="Mr. & Mrs. Shyam Talreja" class="img-fluid">
                    <div class="caption">
                        <div class="video__play__buttons play__icon" data-youtube-id="IwdvFYqjSRM">
                            <img src="{{url('/')}}/assets/images/more/play-btn.png" alt="play video" class="img-fluid">
                        </div>
                        <p class="paragraph">“There were absolutely no second thoughts.”</p>
                        <h3>Mr. Vinay Bajaj</h3>
                        <h6 class="paragraph">- Century Renata</h6>
                    </div>
                </div>
            </div>
            <div class="testimonial__lists__section__item text  All">
                <div class="testimonial__lists__section__item__inner">
                    <div class="content">
                        <span><img loading="lazy" src="{{url('/')}}/assets/images/static/quotes.png" alt="Quotes" class="img-fluid"></span>
                        <p class="paragraph">
                            When I invested, I told a lot of my friends, my realtives to invest here. And over a period of time you really enjoy.
                        </p>
                        <h3>Mr. Shridar Sastry</h3>
                        <h6 class="paragraph">- Century Ethos</h6>
                    </div>
                </div>
            </div>
            <div class="testimonial__lists__section__item video All">
                <div class="content">
                    <img loading="lazy" src="{{url('/')}}/assets/images/more/Vikram.jpg" alt="Mr. & Mrs. Shyam Talreja" class="img-fluid">
                    <div class="caption">
                        <div class="video__play__buttons play__icon" data-youtube-id="IwdvFYqjSRM">
                            <img src="{{url('/')}}/assets/images/more/play-btn.png" alt="play video" class="img-fluid">
                        </div>
                        <p class="paragraph">“The balconies are very spacious and the project is extremely well-planned.”</p>
                        <h3>Mr. Vikram,</h3>
                        <h6 class="paragraph">- Century Marvel</h6>
                    </div>
                </div>
            </div>
            <div class="testimonial__lists__section__item text  All">
                <div class="testimonial__lists__section__item__inner">
                    <div class="content">
                        <span><img loading="lazy" src="{{url('/')}}/assets/images/static/quotes.png" alt="Quotes" class="img-fluid"></span>
                        <p class="paragraph"> “We are associated with century since 2011, the time we booked our plot and we haven’t
                            had any kind of disappointment at all. So why not Century again. We have made our second investment.”
                        </p>
                        <h3>Mr. and Mrs. Vishwanathan</h3>
                        <h6 class="paragraph">-  Century Pragati </h6>
                    </div>
                </div>
            </div>
            <div class="testimonial__lists__section__item video All">
                <div class="content">
                    <img loading="lazy" src="{{url('/')}}/assets/images/more/Shailesh.jpg" alt="Mr. & Mrs. Shyam Talreja" class="img-fluid">
                    <div class="caption">
                        <div class="video__play__buttons play__icon" data-youtube-id="IwdvFYqjSRM">
                            <img src="{{url('/')}}/assets/images/more/play-btn.png" alt="play video" class="img-fluid">
                        </div>
                        <p class="paragraph">“The way it was coming up, we fell in love with it.”</p>
                        <h3>Mrs. Geetha & Mr. Shailesh</h3>
                        <h6 class="paragraph">- Century Ethos</h6>
                    </div>
                </div>
            </div> -->
            
            
        </div>
    </div>
    <!--<div class="row custom-row py-5 load__more text-center">
        <span><img src="{{url('/')}}/assets/images/more/load-more.png" alt="Load More" class="img-fluid"> Load More</span>
    </div>-->
</div>
@endsection