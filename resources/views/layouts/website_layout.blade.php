<!DOCTYPE html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('meta_title')</title>
        <meta name="title" content="@yield('meta_title')  ">
        <meta name="description" content="@yield('meta_description')" />
        <meta property="og:locale" content="en_US" />
        <meta property="og:type" content="website" />
        <meta property="og:title" content="@yield('meta_title')" />
        <meta property="og:description" content="@yield('meta_description')" />
        <meta property="og:url" content="{{url('/')}}/@yield('canonical_tag')" />
        <meta property="og:site_name" content="@yield('meta_title')" />
        <meta property="og:image" content="{{url('/')}}/assets/images/@yield('banner_image')" />
        <meta name="twitter:card" content="summary" />
        <meta name="twitter:description" content="@yield('meta_description')" />
        <meta name="twitter:title" content="@yield('meta_title')" />
        <link rel="canonical" href="{{url('/')}}/@yield('canonical_tag')" />
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <link rel="apple-touch-icon" sizes="180x180" href="{{url('/')}}/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="{{url('/')}}/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="{{url('/')}}/favicon-16x16.png">
        <link rel="manifest" href="{{url('/')}}/site.webmanifest">
        <link rel="mask-icon" href="{{url('/')}}/safari-pinned-tab.svg" color="#5bbad5">
        <meta name="msapplication-TileColor" content="#00aba9">
        <meta name="theme-color" content="#88e0e5">

        <link rel="preload" href="{{url('/')}}/assets/css/bootstrap.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
        <link rel="preload" href="{{url('/')}}/assets/css/style.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
        {!!$script_code!!}
        @if(isset($project->schema_code) && !empty($project->schema_code))
        {!!$project->schema_code!!}
        @endif
        <style>
            .page_loader, .wait_loader {
                height: 100%;
                width: 100%;
                position: fixed;
                top: 0px;
                left: 0px;
                background: url({{url('/')}}/assets/images/img_loader.gif) no-repeat scroll center center #fff;
                z-index: 999999999;
                cursor: wait;
            }
            .show_pointer {cursor: pointer}
            .page_loader {
                opacity: 1;
            }
            .wait_loader {opacity: 0.6;display: none;}
            .error span {display:none;}
            .error {width:100%; text-align:left; height:10px; font-size:13px; color:white;}
            .project__enquiry .error {color:black !IMPORTANT;}
        </style>
    </head>
    <body>
        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-P7ML4RZ"
        height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->
        <div class="page_loader"></div>
        <div class="wait_loader"></div>
        <header class="container-fluid {{$navigation_class}}">
            <div class="row custom-row">
                <div class="col-6 col-md-3 col-lg-2 logo">
                    <a href="{{url('/')}}">
                        <img loading="lazy" src="{{url('/')}}/assets/images/global/logo-white.png" alt="Century" class="img-fluid" width="207" height="121">
                    </a>
                </div>
                <nav class="col-6 col-md-9 col-lg-10 nav">
                    <ul>
                        <li>
                            <a href="{{url('/')}}/about">About Us</a>
                        </li>
                        <li>
                            <a href="{{url('/')}}/why-us">Why Us</a>
                        </li>
                        <li>
                            <a href="{{url('/')}}/projects">Residential</a>
                        </li>                        
                        <li>
                            <a href="https://careers.centuryrealestate.in/" target="_blank">Life at Century</a>
                        </li>
                        <!-- <li>
                            <a href="{{url('/')}}/rising-north">Rising North</a>
                        </li> -->
                        <li>
                            <a class="enquire show_pointer trigger_enquire_now" data-toggle="modal" data-target="#enquire_now_Modal">Enquire</a>
                        </li>
                        <li>
                            <div class="nav__hamburger">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </li>
                    </ul>
                </nav>
                <div class="sidemenu">
                    <div class="sidemenu__hamburger">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                    <div class="sidemenu__top">
                        <ul>
                            <li class="mobile"><a href="{{url('/')}}/about">About Us</a></li>
                            <li class="mobile"><a href="{{url('/')}}/why-us">Why Us</a></li>
                            <li class="mobile"><a href="{{url('/')}}/projects">Residential</a></li>
                            <li class="mobile"><a href="https://careers.centuryrealestate.in/" target="_blank">Life at Century</a></li>
                            <li><a href="{{url('/')}}/referrals">Referrals</a></li>
                            <li><a href="{{url('/')}}/century-connect">Century Connect</a></li>
                            <li><a href="https://commercialportfolio.centuryrealestate.in/" target="_blank">Leasing Solutions</a></li>
                            <li><a href="{{url('/')}}/nri-corner">NRI Corner</a></li>
                            <li><a href="{{url('/')}}/media">Media</a></li>
                            <li><a href="{{url('/')}}/awards">Awards</a></li>
                            <li><a href="{{url('/')}}/social-responsibility">Social Responsibility</a></li>
                            <li><a href="{{url('/')}}/client-testimonials">Client Testimonials</a></li>
                            <li><a href="{{url('/')}}/contact-us">Contact Us</a></li>
                        </ul>
                    </div>
                    <!-- <div class="sidemenu__bottom">
                        <p>Download App</p>
                        <div class="sidemenu__bottom__boxes">
                            <a href="https://apps.apple.com/in/app/century-real-estate/id1236641723" target="_blank">
                                <img loading="lazy" src="{{url('/')}}/assets/images/global/app-store.png" alt="Download App" class="img-fluid">
                            </a>
                            <a href="https://play.google.com/store/apps/details?id=in.centuryrealestate" target="_blank">
                                <img loading="lazy" src="{{url('/')}}/assets/images/global/google-play.png" alt="Download App" class="img-fluid">
                            </a>
                        </div>
                    </div> -->
                </div>
            </div>
        </header>
        <div class="scroller" data-scroll-container>
            @yield('content')
            <footer class="container-fluid footer" data-scroll-offset="5%" data-scroll-repeat data-scroll data-scroll-class="inView">
                <span class="awards-footer"><img src="{{url('/')}}/assets/images/more/certification-badge.png" alt="Great place to work" class="img-fluid"></span>
                <div class=" row custom-row footer__top align-items-center">
                    <div class="col-12 col-sm-12 col-md-3">
                        <div class="footer__top__logo">
                            <img loading="lazy" src="{{url('/')}}/assets/images/global/logo-color.png" alt="Century Propery" class="img-fluid" width="254" height="155">
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="footer__top__address">
                            <p class="paragraph">No. 3/1 Fourth Floor, J P Techno Park, Millers Road,<br> Bangalore - 560052, India</p>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-3">
                        <div class="footer__top__social">
                            <ul>
                                <li><a href="https://www.facebook.com/centuryrealestatebangalore" target="_blank"><i class="fa fa-facebook-official" aria-hidden="true"></i></a></li>
                                <li><a href="https://www.instagram.com/centuryrealestate/" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                                <li><a href="https://twitter.com/centuryblr" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                </li>
                                <li><a href="https://www.linkedin.com/company/century-real-estate-holdings-pvt-ltd" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row custom-row footer__bottom">
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="footer__bottom__links">
                            <ul>
                                <li><a href="{{url('/')}}/projects">Projects</a></li>
                                @foreach($project_types as $project_type_row)
                                <li><a href="{{url('/')}}/projects">{{$project_type_row->project_type_title}}</a></li>
                                @endforeach
                                <li><a href="{{url('/')}}/disclaimer">Disclaimer</a></li>
                                <li><a href="{{url('/')}}/terms">T&C</a></li>
                                <li><a href="{{url('/')}}/privacy">Privacy</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="footer__bottom__p">
                            <p class="paragraph">&copy; {{date('Y')}} by Century Real Estate Holdings Pvt. Ltd. All rights reserved.</p>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        @if(isset($sections))
        @foreach($sections as $section_row)
        <div class="modal fade fullscreen" id="{{Str::slug($section_row->section_title)}}" tabindex="-1" aria-labelledby="visionModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content">
                    <div class="row custom-row modal-header align-items-center">
                        <div class="col-6">
                            <a href="{{url('/')}}"><img loading="lazy" src="{{url('/')}}/assets/images/about/pup_up_logo.png" alt="Century properties" class="img-fluid" width="81" height="66"></a>
                        </div>
                        <div class="col-6 text-end">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                    </div>
                    <div class="modal-body row custom-row fullscreen__body">
                        <div class="col-12 col-md-5 p-0 fullscreen__body__image lazy"
                            style="background: #000 url('{{url('/')}}/assets/images/social-responsibilities/{{$section_row->section_image}}')no-repeat center/cover;">
                        </div>
                        <div class="col-12 col-md-7 fullscreen__body__content">
                            <h3 class="sub-title">{{$section_row->section_title}}</h3>
                            {!!$section_row->section_content!!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        @endif
        <div class="modal fade fullscreen" id="profile" tabindex="-1" aria-labelledby="profileModalLabel"aria-hidden="true">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content">
                    <div class="row custom-row modal-header align-items-center">
                        <div class="col-6">
                            <a href="{{url('/')}}"><img loading="lazy" src="{{url('/')}}/assets/images/about/pup_up_logo.png" alt="Century properties" class="img-fluid" width="81" height="66"></a>
                        </div>
                        <div class="col-6 text-end">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                    </div>
                    <div class="modal-body row custom-row fullscreen__body">
                        <!-- <div class="col-12 col-md-12 col-lg-5 p-0 fullscreen__body__image lazy"
                                style="background: #000 url({{url('/')}}/assets/images/about/ravindra-pai.jpg)no-repeat center/cover;">
                            </div> -->
                        <div class="col-12 col-md-12 col-lg-5 p-0 fullscreen__body__image">
                            <img loading="lazy" src="" alt="ravindra-pai" class="img-fluid profile_image">
                        </div>
                        <div class="col-12 col-md-12 col-lg-7 fullscreen__body__content">
                            <h5 class="heading-primary profile_name"></h5>
                            <h6 class="mt-3 profile_position"></h6>
                            <ul class="fullscreen__body__content__social mt-4 mb-4">
                                <li><a class="profile_linkedin" href="#" target="_blank"><i class="fa fa-linkedin"
                                            aria-hidden="true"></i></a>
                                </li>
                                <!-- <li><a class="profile_twitter" href="#" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                </li> -->
                            </ul>
                            <p class="paragraph profile_description"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade fullscreen" id="mission" tabindex="-1" aria-labelledby="missionModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content">
                    <div class="row custom-row modal-header align-items-center">
                        <div class="col-6">
                            <a href="{{url('/')}}"><img loading="lazy" src="{{url('/')}}/assets/images/about/pup_up_logo.png" alt="Century properties" class="img-fluid" width="81" height="66"></a>
                        </div>
                        <div class="col-6 text-end">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                    </div>
                    <div class="modal-body row custom-row fullscreen__body">
                        <div class="col-12 col-md-5 p-0 fullscreen__body__image lazy"
                            style="background: #000 url({{url('/')}}/assets/images/about/mission.jpg)no-repeat center/cover;">
                            <!-- <img loading="lazy" src="{{url('/')}}/assets/images/about/mission.jpg" alt="Mission" class="img-fluid"> -->
                        </div>
                        <div class="col-12 col-md-7 fullscreen__body__content">
                            <h3 class="sub-title">About / Mission</h3>
                            <ul class="fullscreen__body__content__list">
                                <li>We will be a model real estate organisation: institutionalized and adopting best
                                    practises in every sphere.</li>
                                <li>We will aim to successfully leverage significant opportunities across the real estate
                                    spectrum, by being fully
                                    integrated and present in all verticals and horizontals that demonstrate potential. We
                                    will follow utmost
                                    professionalism, in management and in structure, and build the best team and workplace
                                    in the industry.</li>
                                <li>We will build the Century brand to make it widely known and highly regarded, by
                                    continually striving to earn and
                                    maintain the respect of our peers and stakeholders. We will abide by the tenets of the
                                    Century brand which have helped
                                    us win market success over the past three decades, and continue to build and nurture
                                    bonds of lasting value with all our
                                    stakeholders.</li>
                                <li>We will constantly think ahead and establish the Century brand in the long term, by
                                    anticipating, innovating and
                                    delivering to tomorrow's opportunities, trends and needs.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade fullscreen" id="vision" tabindex="-1" aria-labelledby="visionModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content">
                    <div class="row custom-row modal-header align-items-center">
                        <div class="col-6">
                            <a href="{{url('/')}}"><img loading="lazy" src="{{url('/')}}/assets/images/about/pup_up_logo.png" alt="Century properties" class="img-fluid" width="81" height="66"></a>
                        </div>
                        <div class="col-6 text-end">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                    </div>
                    <div class="modal-body row custom-row fullscreen__body">
                        <div class="col-12 col-md-5 p-0 fullscreen__body__image lazy"
                            style="background: #000 url({{url('/')}}/assets/images/about/value.jpg)no-repeat center/cover;">
                            <!-- <img loading="lazy" src="{{url('/')}}/assets/images/about/mission.jpg" alt="Mission" class="img-fluid"> -->
                        </div>
                        <div class="col-12 col-md-7 fullscreen__body__content">
                            <h3 class="sub-title">About / Vision</h3>
                            <ul class="fullscreen__body__content__list">
                                <li>Aim beyond what is easy to see: Always target far and high, aim to look and go beyond
                                    what's in easy sight. Dream twice, not once: Dream in our mind, Dream in our action.
                                </li>
                                <li>Believe in self-first: We must believe we can do it, only if there's success in the
                                    head, can we achieve success in the real world. </li>
                                <li>Enjoy the adventure: We must enjoy our work, be adventurous, we have nothing to lose
                                    everything to gain.</li>
                                <li>Innovate to secure: We must keep in touch with the latest developments in our field and
                                    keep bringing new ideas to our
                                    customers, to continually surprise and delight them.</li>
                                <li>No Substitute to hard work: To achieve success, we must welcome hard work and hardships.
                                </li>
                                <li>Win with pleasantness and humility: Arrogance may help us succeed once or twice, but
                                    will drive people off in the long
                                    term. We never lose anything with humility and pleasantness though, but always win in
                                    the long term.</li>
                                <li>Never compromise our name: Our name is our badge of honour. We must always protect it by
                                    honouring every commitment we
                                    make under its name.
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="disclaimer">
            <div class="disclaimer__inner">
                <div class="disclaimer__inner__title">
                    DISCLAIMER
                </div>
                <div class="disclaimer__inner__content">
                    <p>By accessing this website, the viewer confirms that the information including
                        brochures and
                        marketing
                        collaterals on this website are solely for informational purposes only. Nothing on this website,
                        constitutes advertising, marketing, booking, selling or an offer for sale, or invitation to
                        purchase
                        a unit in any project by the Company. This website is for guidance only. It does not constitute
                        part
                        of an offer or contract. Design & specifications are subject to change without prior notice.
                        Computer generated images are the artist's impression and are an indicative of the actual
                        designs.<br><br>
                        The particulars contained on the mentions details of the Projects/developments undertaken by the
                        Company including
                        depicting banners/posters of the Project. The contents are being modified in terms of the
                        stipulations / recommendations under the Real Estate Regulation Act, 2016 and Rules made
                        thereunder
                        ("RERA") and accordingly may not be fully in line thereof as of date. You are therefore required
                        to
                        verify all the details, including area, amenities, services, terms of sales and payments and
                        other
                        relevant terms independently with the sales team/ company prior to concluding any decision for
                        buying any unit(s) in any of the said projects. Till such time the details are fully updated,
                        the
                        said information
                        will not be construed as an advertisement.<br><br>
                        In no event will the Company be liable for claim made by the users including seeking any
                        cancellation for any of the
                        inaccuracies in the information provided in this website, though all efforts have to be made to
                        ensure accuracy. The
                        Company will no circumstance will be liable for any expense, loss or damage including, without
                        limitation, indirect or
                        consequential loss or damage, or any expense, loss or damage whatsoever arising from use, or
                        loss of
                        use, of data,
                        arising out of or in connection with the use of this website.
                    </p>
                    <span>read more</span>
                </div>
                <div class="disclaimer__inner__link">
                    <span>I Agree</span>
                </div>
            </div>
        </div>
        @if(isset($project->project_brochure) && !empty($project->project_brochure))
        <span class="download__brochure download_brochure_config" data-type="1" data-id="{{$project->id}}">
            <img loading="lazy" src="{{url('/')}}/assets/images/project-details/download.png" alt="Download" class="img-fluid" width="75" height="75">
        </span>
        @endif
        <!-- Video Modal -->
        <div class="modal fade" id="video__modal" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog modal-xl modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="close close-video-modal" data-bs-dismiss="modal"
                            aria-label="Close"><span aria-hidden="true">×</span></button>
                        <iframe id="youtube" width="100%" height="550px" frameborder="0" allow="autoplay" allowfullscreen=""
                            src=""></iframe>
                    </div>
                </div>
            </div>
        </div>

        @if(isset($project->project_3d_walk) && !empty($project->project_3d_walk))
        <div class="modal fade" id="walkthrough__modal" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog modal-fullscreen modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="close close-video-modal" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <iframe src="" id="walkthrough" style="width:100%"></iframe>
                    </div>
                </div>
            </div>
        </div>
        @endif
        <div class="modal fade" id="otp_modal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-center sub-title" id="exampleModalLabel">ENTER OTP</h5>
                        <span class="sep"></span>
                    </div>
                    <div class="modal-body text-center">
                        <form id="otp_verification_form">
                            @csrf
                            <div class="otp__input">
                                <input type="number" maxlength="1" class="form-control" name="otp_digit[]" id="otp_digit_one" pattern="[0123456789]">
                                <input type="number" maxlength="1" class="form-control" name="otp_digit[]" id="otp_digit_two" pattern="[0123456789]">
                                <input type="number" maxlength="1" class="form-control" name="otp_digit[]" id="otp_digit_three" pattern="[0123456789]">
                                <input type="number" maxlength="1" class="form-control" name="otp_digit[]" id="otp_digit_four" pattern="[0123456789]">
                            </div>
                            <div class="error" style="text-align: center;">
                                <span id="otp_digit_err"></span>
                            </div>
                            <button type="submit" class="btn submit_otp_verification mt-4">Verify</button><br>
                            <p class="paragraph d-none resend_button_timer mt-2"></p>
                            <a href="#" class="resend_otp_trigger d-none">Resend</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Configuration Modal -->
        <div class="modal fade" id="configurationModal" tabindex="-1" aria-labelledby="configurationModal" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><img loading="lazy" src="{{url('/')}}/assets/images/global/close-modal.png" alt="Close" class="img-fluid" width="12" height="12"></button>
                    </div>
                    <div class="modal-body p-0">

                        <div class="container-fluid contact">
                            <div class="row custom__row">
                                <div class="col-12 location__inner__title text-center">
                                    <h4 class="secondary-heading mb-0">Download Brochure</h4>
                                    <span class="sep"></span>
                                </div>
                            </div>
                            <form class="row custom__row" id="enquiry_form_pop">
                                @csrf
                                <input type="hidden" name="enquiry_form_name" value="Download Brochure">
                                <div class="col-12 mb-3">
                                    <input type="text" class="form-control" name="enquiry_pop_name" id="enquiry_pop_name" placeholder="Name*">
                                    <div class="error" style="color: black">
                                        <span id="enquiry_pop_name_err"></span>
                                    </div>
                                </div>
                                <div class="col-12 mb-3">
                                    <input type="email" class="form-control" name="enquiry_pop_email_id" id="enquiry_pop_email_id" placeholder="Email*">
                                    <div class="error" style="color: black">
                                        <span id="enquiry_pop_email_id_err"></span>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 mb-3">
                                    <select class="form-control form-select country_dropdown" name="enquiry_pop_isd_code">
                                        <option value="">Select Country*</option>
                                    </select>
                                    <div class="error" style="color: black">
                                        <span id="enquiry_pop_isd_code_err"></span>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-12 col-md-6 mb-3">
                                    <input type="text" class="form-control" name="enquiry_pop_mobile_number" id="enquiry_pop_mobile_number" placeholder="Mobile Number*" inputmode="numeric">
                                    <div class="error" style="color: black">
                                        <span id="enquiry_pop_mobile_number_err"></span>
                                    </div>
                                </div>
                                <div class="col-12 mb-3 text-center popup__btn">
                                    <button type="submit" class="btn">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="mediaKitModal" tabindex="-1" aria-labelledby="mediaKitModal" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><img loading="lazy" src="{{url('/')}}/assets/images/global/close-modal.png" alt="Close" class="img-fluid" width="12" height="12"></button>
                    </div>
                    <div class="modal-body p-0">

                        <div class="container-fluid contact">
                            <div class="row custom__row">
                                <div class="col-12 location__inner__title text-center">
                                    <h4 class="secondary-heading mb-0">Media Kit</h4>
                                    <span class="sep"></span>
                                </div>
                            </div>
                            <form class="row custom__row" id="media_kit_form_pop">
                                @csrf
                                <div class="col-12 mb-3">
                                    <input type="text" class="form-control" name="media_kit_pop_name" id="media_kit_pop_name" placeholder="Name*">
                                    <div class="error">
                                        <span id="media_kit_pop_name_err"></span>
                                    </div>
                                </div>
                                <div class="col-12 mb-3">
                                    <input type="email" class="form-control" name="media_kit_pop_email_id" id="media_kit_pop_email_id" placeholder="Email*">
                                    <div class="error">
                                        <span id="media_kit_pop_email_id_err"></span>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 mb-3">
                                    <select class="form-control form-select country_dropdown" name="media_kit_pop_isd_code">
                                        <option value="">Select Country*</option>
                                    </select>
                                    <div class="error">
                                        <span class="media_kit_pop_isd_code_err"></span>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-12 col-md-6 mb-3">
                                    <input type="text" class="form-control" name="media_kit_pop_mobile_number" id="media_kit_pop_mobile_number" placeholder="Mobile Number*" inputmode="numeric">
                                    <div class="error">
                                        <span id="media_kit_pop_mobile_number_err"></span>
                                    </div>
                                </div>
                                <div class="col-12 mb-3 text-center popup__btn">
                                    <button type="submit" class="btn">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="enquire_now_Modal" tabindex="-1" aria-labelledby="enquire_now_Modal" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body p-0">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        <div class="container-fluid contact">
                            <form class="row enquiry__form enquiry_form">
                                @csrf
                                <input type="hidden" name="enquiry_form_name" value="Pop-up Form">
                                <div class="col-12 enquiry__form__title">
                                    <p>Enquire Now</p>
                                </div>
                                <div class="col-12 mb-3">
                                    <input type="text" class="form-control enquiry_name" name="enquiry_name" placeholder="Full Name*">
                                    <div class="error">
                                        <span class="enquiry_name_err"></span>
                                    </div>
                                </div>
                                <div class="col-12 mb-3">
                                    <input type="email" class="form-control enquiry_email_id" name="enquiry_email_id" placeholder="Email*">
                                    <div class="error">
                                        <span class="enquiry_email_id_err"></span>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 mb-3 search__box">
                                    <select class="form-select pop_up_select enquiry_isd_code country_dropdown" name="enquiry_isd_code" style="margin-bottom:0rem">
                                        <option value="">Select Country*</option>
                                    </select>
                                    <div class="error">
                                        <span class="enquiry_isd_code_err"></span>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 mb-3">
                                    <input type="text" class="form-control enquiry_mobile_number" name="enquiry_mobile_number" placeholder="Mobile Number*" inputmode="numeric">
                                    <div class="error">
                                        <span class="enquiry_mobile_number_err"></span>
                                    </div>
                                </div>
                                <div class="col-12 mb-3 search__box">
                                    <select class="form-select enquiry_project_id" name="enquiry_project_id" style="margin-bottom:0rem">
                                        <option value="">Select Property</option>
                                        @foreach($projects as $project_row)
                                        <option value="{{$project_row->id}}" @if(isset($project->id) && $project->id == $project_row->id) selected @endif>{{$project_row->project_name}}</option>
                                        @endforeach
                                        @foreach($commercial_projects as $project_row)
                                        <option value="{{$project_row->id}}" @if(isset($project->id) && $project->id == $project_row->id) selected @endif>{{$project_row->project_name}}</option>
                                        @endforeach
                                    </select>
                                    <div class="error">
                                        <span class="enquiry_project_id_err"></span>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-mb-6 mb-3">
                                    <input type="text" class="form-control enquiry_comments" name="enquiry_comments" placeholder="Type Your Query">
                                    <div class="error">
                                        <span class="enquiry_comments_err"></span>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-mb-6 mb-3" style="text-align:center;">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- @if(isset($project) && !empty($project->project_url_slug) && $project->project_url_slug == "century-renataa")
        <div class="modal fade" id="promotional_Modal" tabindex="-1" aria-labelledby="promotional_Modal" aria-hidden="true">
            <div class="modal-dialog modal-md modal-dialog-centered">
                <div class="modal-content">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="modal-body p-0">
                        <a href="https://bit.ly/3axL32T" target="_blank">
                        <img src="{{url('/')}}/assets/images/home/promotional_Modal.jpg" alt="Promotional Modal" class="img-fluid">
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endif -->

        @if(Request::url() != "https://www.centuryrealestate.in/projects")
        <!--<div class="modal fade" id="promotional_Modal" tabindex="-1" aria-labelledby="promotional_Modal" aria-hidden="true">
            <div class="modal-dialog modal-md modal-dialog-centered">
                <div class="modal-content">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="modal-body p-0">
                        <a href="https://bit.ly/3CntQqd">
                        <img src="{{url('/')}}/assets/images/home/promotional_Modal.jpg" alt="Promotional Modal" class="img-fluid">
                        </a>
                    </div>
                </div>
            </div>
        </div>-->
        @endif
        
        <div class="backdrop"></div>
        <link rel="preload" href="{{url('/')}}/assets/css/font-awesome.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
        <link rel="preload" href="{{url('/')}}/assets/css/owl.carousel.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
        <link rel="preload" href="{{url('/')}}/assets/css/jquery.magnify.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
        <link rel="preload" href="{{url('/')}}/assets/css/locomotive-scroll.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
        <link rel="stylesheet" href="{{url('/')}}/assets/css/vanilla-tabs.min.css"  as="style" onload="this.onload=null;this.rel='stylesheet'">
        <script src="{{url('/')}}/assets/js/jquery.min.js" defer></script>
        <script src="{{url('/')}}/assets/js/popper.min.js" defer></script>
        <script src="{{url('/')}}/assets/js/bootstrap.min.js" defer></script>
        <script src="https://unpkg.com/isotope-layout@3.0.6/dist/isotope.pkgd.min.js" defer></script>
        <script src="https://unpkg.com/splitting@1.0.6/dist/splitting.min.js" defer></script>
        <script src="{{url('/')}}/assets/js/owl.carousel.min.js" defer></script>
        <script src="{{url('/')}}/assets/js/jquery.magnify.min.js" defer></script>
        <script src="https://cdn.jsdelivr.net/npm/locomotive-scroll@3.5.4/dist/locomotive-scroll.min.js" defer></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.5.0/gsap.min.js" defer></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.5.0/ScrollTrigger.min.js" defer></script>
        <script src="{{url('/')}}/assets/js/custom.js?v={{time()}}" defer></script>
        <script src="{{url('/')}}/assets/js/main.js" defer></script>
        <script src="https://cwc.livserv.in/chat.js?lid=1937" id="lp_cwc_xqzyihjdskw"></script>
        <script src="https://cw1.livserv.in?did=1937&amp;pid=1"></script>
    </body>
</html>