@php
$i = 0;
@endphp
@foreach($press as $press_row)
<div class="col-12 press__listing__block @if(empty($i)) active @endif">
    <div class="press__listing__block__title">
        <span></span>
        <h4 class="sub-title">{{ucwords(strtolower($press_row->press_title))}}</h4>
    </div>
    <div class="press__listing__block__info @if(empty($i)) active @endif">
        @if(isset($press_content_array[$press_row->id]))
        <p class="paragraph">{{date('d F, Y', strtotime($press_content_array[$press_row->id][0]['press_publish_date']))}}</p>
        @endif
        <div class="press__listing__block__info__links">
            @if(isset($press_content_array[$press_row->id]))
            @foreach($press_content_array[$press_row->id] as $press_content_single_array)
            <a @if($press_content_single_array['press_link_attachment'] == 1) href="{{$press_content_single_array['press_link']}}" @elseif($press_content_single_array['press_link_attachment'] == 2) href="{{url('/')}}/assets/images/press/{{$press_content_single_array['press_attachment']}}" @endif target="_blank">{{$press_content_single_array['press_media_title']}}</a>
            @endforeach
            @endif
        </div>
    </div>
</div>
@php
$i++;
@endphp
@endforeach