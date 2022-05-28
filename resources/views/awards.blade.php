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
<div class="container-fluid intro mb-0">
    <div class="row custom-row">
        <div class="col-12 col-md-12 p-0 intro__inner text-left">
            <h1 class="heading-primary mb-5" data-scroll data-scroll-speed="1">Century Awards</h1>
        </div>
    </div>
</div>
<div class="container-fluid press">
    <div class="row custom-row align-items-center">
        <div class="col-4 col-md-2 ps-0 press__title" data-scroll data-scroll-speed="1">
            <p class="paragraph m-0">Choose Year</p>
        </div>
        <div class="col-3 col-md-2 search__box" data-scroll data-scroll-speed="1">
            <select class="form-select filter_award_year">
                <option value="">All Years</option>
                @foreach($award_years as $award_year_row)
                <option value="{{$award_year_row->single_year}}">{{$award_year_row->single_year}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row custom-row align-items-center mt-3" data-scroll data-scroll-speed="1">
        <div class="col-12 p-0">
            <hr>
        </div>
    </div>
    <div class="row custom-row press__listing awards__listing">
        @include('award_blocks')
    </div>
</div>
@endsection