@extends('layouts.website_layout')
@section('meta_title', $meta_data->meta_title)
@section('meta_description', $meta_data->meta_description)
@section('canonical_tag', $meta_data->canonical_tag)
@section('banner_image', "banners/".$banner->banner_image)
@section('content')
<main>
    <div class="container-fluid static">
        <div class="row custom-row content">
            <div class="col-12">
                <h1 class="sub-title">Disclaimer</h1>
                <br><br><br>
                <p>The information and materials contained or referred to on this website are for reference
                    only. Century Group makes no
                    representation or warranty of any kind, express, implied or statutory, regarding this web
                    site or the materials and
                    information contained or referred to on each page associated with this web site. The
                    information and materials contained
                    on this web site are subject to change without notice, are provided for general information
                    only and should not be used
                    as a basis for making business decisions. Any advice or information received via this web
                    site should not be relied upon
                    without consulting primary or more accurate or more up-to-date sources of information or
                    specific professional advice.
                    You are recommended to obtain such professional advice where appropriate.</p>
                <br>
                <p>Century Group accepts no liability and will not be liable for any loss or damage arising
                    directly or indirectly
                    (including special, incidental or consequential loss or damage) from your use of this web
                    site, howsoever arising,
                    including any loss, damage or expense arising from, but not limited to, any defect, error,
                    imperfection, fault,
                    omission, mistake or inaccuracy with this web site, its contents or associated services, or
                    due to any unavailability of
                    the web site or any part thereof or any contents or associated services. Century Group
                    further neither assumes nor
                    accepts liability for any loss or damage</p>
                <br>
                <p>Arising directly or indirectly (including special, incidental or consequential loss or
                    damage), howsoever caused, as a
                    result of any computer viruses or worms, software bombs or the like arising from your use of
                    this web site.</p>
                <br>
                <p>References in this website to any products, events or services do not necessarily constitute
                    or imply Century Group's
                    endorsement or recommendation of them.</p>
                <br>
                <p>Any "off-site" web pages or hypertext link from this web site exist for information purposes
                    and are for your
                    convenience only and Century Group accepts no liability for any loss or damage arising
                    directly or indirectly (including
                    special, indirect or consequential loss or damage) from the accuracy or otherwise of
                    materials or information contained
                    on the pages of such sites. Century Group's inclusion of hyperlinks or "off-site" web pages
                    does not imply any
                    endorsement of the materials on such sites.</p>
                <br><br><br>
            </div>
        </div>
    </div>
</main>
@endsection