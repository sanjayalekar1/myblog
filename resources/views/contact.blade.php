@extends('layouts.website_layout')
@section('meta_title', $meta_data->meta_title)
@section('meta_description', $meta_data->meta_description)
@section('canonical_tag', $meta_data->canonical_tag)
@section('banner_image', "banners/".$banner->banner_image)
@section('content')
<main>
    <div class="container-fluid banner lazy p-0" data-scroll-repeat data-scroll data-scroll-class="inView" style="background: #000 url({{url('/')}}/assets/images/banners/{{$banner->banner_image}})no-repeat top center/cover;"></div>
    <div class="container-fluid addresses">
        <div class="row custom-row">
            <div class="col-12 col-md-4 addresses__block">
                <h1 class="sub-title mb-4" data-scroll data-scroll-speed="1">Marketing Office</h1>
                <h2 class="heading-primary mb-3 pt-1" data-scroll data-scroll-speed="1.2">Century Ethos</h2>
                <p class="paragraph" data-scroll data-scroll-speed="1
                3">Opposite Sahakaranagar Cross,<br>
                    Bellary Road,<br>
                    Bangalore - 560092<br>
                    India</p>
                <a href="tel:+918044334403" class="d-block sub-title" data-scroll data-scroll-speed="1
                4">080 4433 4403</a>
                <a href="tel:+918044334492" class="d-block sub-title" data-scroll data-scroll-speed="1
                4">+91 80 44334492</a>
                <a href="mailto:enquiry@centuryrealestate.in" class="d-block sub-title" data-scroll data-scroll-speed="1
                4" style="letter-spacing: 0rem;">enquiry@centuryrealestate.in</a>
            </div>
            <div class="col-12 col-md-4 addresses__block">
                <h1 class="sub-title mb-4" data-scroll data-scroll-speed="1">Corporate Office</h1>
                <h2 class="heading-primary mb-3 pt-1" data-scroll data-scroll-speed="1.2">Century Real Estate
                    <br> Holdings Pvt. Ltd
                </h2>
                <p class="paragraph" data-scroll data-scroll-speed="1
                3">No. 3/1 Fourth floor,<br>
                    J P Techno Park,<br>
                    Millers Road,<br>
                    Bangalore - 560052<br>
                    India
                </p>
                <a href="tel:+918044334433" class="d-block sub-title" data-scroll data-scroll-speed="1
                4">+91 80 4035 3453</a>
                <a href="mailto:info@centuryrealestate.in" class="d-block sub-title" data-scroll data-scroll-speed="1
                4" style="letter-spacing: 0rem;">info@centuryrealestate.in</a>
            </div>
            <div class="col-12 col-md-4 addresses__block">
                <h1 class="sub-title mb-4" data-scroll data-scroll-speed="1">Registered Office</h1>
                <h2 class="heading-primary mb-3 pt-1" data-scroll data-scroll-speed="1.2">Century Real Estate
                    <br> Holdings Pvt. Ltd
                </h2>
                <p class="paragraph" data-scroll data-scroll-speed="1
                3">CIN : U70101KA2007PTC042078<br>
                    No. 10/1 Ground Floor<br>
                    Laxminarayan Complex,<br>
                    Palace Road Vasanth Nagar,<br>
                    Bangalore - 560052,
                    India
                </p>
                <a href="tel:+918044334433" class="d-block sub-title" data-scroll data-scroll-speed="1
                4">+91 80 4113 1401</a>
                <a href="mailto:info@centuryrealestate.in" class="d-block sub-title" data-scroll data-scroll-speed="1
                4" style="letter-spacing: 0rem;">info@centuryrealestate.in</a>
            </div>
        </div>
    </div>
    <div class="container-fluid enquiry" data-scroll-offset="5%" data-scroll-repeat data-scroll
        data-scroll-class="inView">
        <div class="row custom-row pr-0">
            <div class="col-12 col-sm-12 col-md-6">
                <form class="row enquiry__form" id="contact_enquiry_form">
                    @csrf
                    <div class="col-12 enquiry__form__title">
                        <p>Connect with us</p>
                    </div>
                    <div class="col-12 mb-3">
                        <input type="text" class="form-control" id="contact_enquiry_name" name="contact_enquiry_name" placeholder="Full Name*">
                        <div class="error">
                            <span id="contact_enquiry_name_err"></span>
                        </div>
                    </div>
                    <div class="col-12 mb-3">
                        <input type="email" class="form-control" id="contact_enquiry_email_id" name="contact_enquiry_email_id" placeholder="Email*">
                        <div class="error">
                            <span id="contact_enquiry_email_id_err"></span>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 mb-3 search__box">
                        <select class="form-select country_dropdown" id="contact_enquiry_isd_code" name="contact_enquiry_isd_code" style="margin-bottom:0rem">
                            <option value="">Select Country*</option>
                        </select>
                        <div class="error">
                            <span id="contact_enquiry_isd_code_err"></span>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 mb-3">
                        <input type="text" class="form-control" id="contact_enquiry_mobile_number" name="contact_enquiry_mobile_number" placeholder="Mobile Number*" inputmode="numeric">
                        <div class="error">
                            <span id="contact_enquiry_mobile_number_err"></span>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-mb-6 mb-3">
                        <textarea class="form-control" rows="3" style="resize:none" id="contact_enquiry_comments" name="contact_enquiry_comments" placeholder="Type Your Query"></textarea>
                        <div class="error">
                            <span id="contact_enquiry_comments_err"></span>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-mb-6 mb-3">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
            <div class="col-12 col-sm-12 col-md-6 lazy d-none" style="background: #2e080d url({{url('/')}}/assets/images/home/big-logo.png)no-repeat center/contain;"></div>
        </div>
    </div>
    <div class="container-fluid p-0">
        <div class="row">
            <iframe style="filter:grayscale(100%);" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15550.999001992428!2d77.5905597!3d12.9878514!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xe8db8f8074cdd120!2sCentury%20Real%20Estate%20Holdings%20Private%20Limited!5e0!3m2!1sen!2sin!4v1619638643960!5m2!1sen!2sin" width="100%" height="600" style="border:0;" allowfullscreen=""></iframe>
        </div>
    </div>
</main>
@endsection