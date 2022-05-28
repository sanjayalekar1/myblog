@extends('layouts.website_layout')
@section('meta_title', $meta_data->meta_title)
@section('meta_description', $meta_data->meta_description)
@section('canonical_tag', $meta_data->canonical_tag)
@section('banner_image', "banners/".$banner->banner_image)
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <img loading="lazy" src="{{url('/')}}/assets/images/banners/{{$banner->banner_image}}" style="height: 100vh;object-fit: cover;" alt="Coming Soon" width="100%" class="img-fluid desktop">
            <img loading="lazy" src="{{url('/')}}/assets/images/banners/{{$banner->banner_image_mobile}}" style="height: 100vh;object-fit: cover;" alt="Coming Soon" width="100%" class="img-fluid mobile">
        </div>
    </div>
</div>
@endsection