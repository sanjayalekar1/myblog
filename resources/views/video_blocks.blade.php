@foreach($videos as $video_row)
<div class="col-12 col-md-6 press__media__block">
    <div class="press__media__block__inner">
        <a href="#" class="link">
            <img loading="lazy" src="http://i3.ytimg.com/vi/{{$video_row->youtube_video_id}}/hqdefault.jpg" alt="{{$video_row->video_title}}" class="img-fluid">
            <p class="play__icon" data-youtube-id="{{$video_row->youtube_video_id}}">
                <img loading="lazy" src="{{url('/')}}/assets/images/videos/play.png" alt="play" class="img-fluid">
            </p>
        </a>
        <h2 class="paragraph">{{$video_row->video_title}}</h2>
    </div>
</div>
@endforeach