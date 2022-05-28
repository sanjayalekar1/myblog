@extends('layouts.website_layout')
@section('meta_title', $meta_data->meta_title)
@section('meta_description', $meta_data->meta_description)
@section('canonical_tag', $meta_data->canonical_tag)
@section('banner_image', "banners/".$banner->banner_image)
@section('content')
@include('coming_soon')
@endsection