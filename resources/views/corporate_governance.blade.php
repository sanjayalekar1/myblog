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
                    <h1 class="sub-title mb-5">Corporate Governance</h1>
                </div>
                <div class="associates__right__block">
                    <div class="title mt-4">
                        <h2 class="heading-primary">DEFINITION AND PURPOSE</h2>
                    </div>
                    <div class="content mt-3">
                        <div class="text">
                            <p class="paragraph">Globalization has not only significantly heightened business
                                risks, but has also compelled Indian companies to adopt
                                international norms of transparency and good governance. Business today is no
                                longer just about the bottom line. A
                                company is now more than the sum of its quantifiable parts: without a deeply
                                ingrained set of core values and a
                                humanistic outlook, a strong balance sheet alone does not guarantee a company’s
                                success. At Century Real Estate, our
                                governance policy recognizes the challenge of this new business reality in
                                India.</p>
                            <p class="paragraph">Although we are a privately held Company, good governance
                                underpins our every action and decision. Because we understand
                                the value of the long-term view, and our solid history goes to proves this.
                                Rather than settling for instant gains at
                                any cost, we foster an atmosphere of credibility, trust and transparency. It is
                                no great achievement to merely comply
                                with the letter of the law; by going further than the mandatory and embracing
                                the voluntary, we strive to create genuine
                                wealth. While this value generation may begin in the workplace, it extends to
                                all our stakeholders. By investing the
                                Company with a social conscience, our customers, employees, investors and
                                partners all benefit from increased
                                accountability, a sense of fair play and commitment to the larger community.</p>
                        </div>
                    </div>
                </div>
                <div class="associates__right__block">
                    <div class="title mt-4">
                        <h2 class="heading-primary">GOVERNANCE STRUCTURE</h2>
                    </div>
                    <div class="content mt-3">
                        <div class="text">
                            <p class="paragraph">Flowing from the concept and principles of Corporate Governance
                                adopted by Century Real Estate, leadership within the
                                Company is exercised at three levels. The Board of Directors at the apex carries
                                the responsibility for strategic
                                supervision of the Company. The Board of Directors at Century Real Estate is a
                                balanced Board with an equal number of
                                Executive and Independent Directors. The Independent Directors are eminent
                                professionals from diverse fields who bring
                                together vast experience and credibility and provide direction to the Management
                                team in a dynamic economic and business
                                environment.</p>
                            <p class="paragraph">
                                The strategic management of the Company rests with the Executive Committee (EC)
                                comprising the Executive Directors and
                                members drawn from senior Management. Executive Committee is chaired by the
                                Managing Director. The executive management
                                of each department is vested with the Sub-Committee (SC). Each Sub-Committee is
                                chaired by a member of the Executive
                                Committee and the departmental/functional head is the Secretary. Each
                                Sub-Committee is responsible for and totally
                                focused on the management of its assigned department. The Management team headed
                                by the Chief Executive Officer (CEO) of
                                the Company is responsible for the execution and implementation of the various
                                decisions taken at the Executive and Sub
                                Committee.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="associates__right__block">
                    <div class="title mt-4">
                        <h2 class="heading-primary">COMPOSITION OF THE BOARD</h2>
                    </div>
                    <div class="content mt-3">
                        <div class="text">
                            <ul>
                                <li class="paragraph">Mr. Ravindra Pai - Managing Director</li>
                                <li class="paragraph">Mr. Ashwin Pai - Executive Director</li>
                                <li class="paragraph">Mr. Dev Patel - Executive Director</li>
                                <li class="paragraph">Mr. Mahesh Prabhu - Executive Director</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection