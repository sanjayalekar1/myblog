@extends('layouts.website_layout')
@section('meta_title', $meta_data->meta_title)
@section('meta_description', $meta_data->meta_description)
@section('canonical_tag', $meta_data->canonical_tag)
@section('banner_image', "banners/".$banner->banner_image)
@section('content')
<main>
    <div class="container-fluid associates">
        <div class="row">
            <div class="col-12 col-md-5 associates__left lazy"
                style="background: #fff url({{url('/')}}/assets/images/banners/{{$banner->banner_image}})no-repeat center/cover;min-height: 20rem;">
            </div>
            <div class="col-12 col-md-7 associates__right">
                <div class="associates__right__title">
                    <h1 class="sub-title mb-4">Associated Enterprises</h1>
                    <p class="paragraph">{{$meta_data->introduction_text_one}}</p>
                </div>
                <div class="associates__right__block">
                    <div class="title mt-4">
                        <h2 class="heading-primary">EDUCATION</h2>
                    </div>
                    <div class="content mt-5">
                        <div class="image">
                            <img loading="lazy" src="{{url('/')}}/assets/images/associates/vidyashilp-logo.png" alt="">
                        </div>
                        <div class="text">
                            <p class="paragraph">This is a progressive institution, following the ICSE pattern
                                and committed to
                                providing primary and secondary school
                                education in the global context. Holistic, networked learning and technology in
                                education are an integral part of its
                                routine academic practice. The school has earned recognition for the quality of
                                the teaching and learning practices,
                                which function in a collaborative and dynamic environment of a new paradigm in
                                education, recognizing the child’s
                                ability to THINK.</p>
                        </div>
                    </div>
                    <div class="content mt-4">
                        <div class="image">
                            <img loading="lazy" src="{{url('/')}}/assets/images/associates/vidyasagar-logo.png" alt="">
                        </div>
                        <div class="text">
                            <p class="paragraph">Founded to serve the educational needs of toddlers and
                                pre-school children, this school aims to provide a stimulating
                                educational environment where children feel happy, secure and confident.</p>
                        </div>
                    </div>
                </div>
                <div class="associates__right__block">
                    <div class="title mt-4">
                        <h2 class="heading-primary">hospitality</h2>
                    </div>
                    <div class="content mt-5">
                        <div class="image">
                            <img loading="lazy" src="{{url('/')}}/assets/images/associates/royal-orchid.png" alt="hospitality" class="img-fluid">
                        </div>
                        <div class="text">
                            <p class="paragraph">Icon Hospitality Pvt. Ltd. - The owner of Royal Orchid Central
                                Hotel, M.G. Road (a 130 room, centrally located 4 star
                                business hotel), this company partners with Royal Orchid Hotels which also owns
                                Royal Orchid Harsha and Royal Orchid
                                Towers hotels.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection