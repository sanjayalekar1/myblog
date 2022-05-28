@foreach($awards as $award_row)
<div class="awards__block text-center" data-scroll data-scroll-speed="1">
    <div class="awards">
        <img loading="lazy" src="{{url('/')}}/assets/images/awards/{{$award_row->award_thumbnail}}" alt="{{$award_row->award_title}}" class="img-fluid">
        
    </div>
    <h2 class="sub-title my-4">{{$award_row->award_title}}</h2>
        <!-- <p class="paragraph mb-0">{!!nl2br($award_row->award_description)!!}</p> -->
</div>
@endforeach