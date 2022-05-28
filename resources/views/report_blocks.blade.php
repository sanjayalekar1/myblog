@foreach($report_blocks as $report_row)
<div class="col-12 col-md-3 press__media__block">
    <div class="press__media__block__inner">
        <a href="{{url('/')}}/assets/pdfs/{{$report_row->report_pdf}}" target="_blank" class="link">
            <img loading="lazy" src="{{url('/')}}/assets/images/media/{{$report_row->report_thumbnail}}" alt="{{$report_row->report_title}}" class="img-fluid" width="362" height="512">
            <span><img loading="lazy" src="{{url('/')}}/assets/images/century-times/download.png" alt="download" class="img-fluid" width="48" height="48"></span>
        </a>
        <h2 class="paragraph">{{date('F Y', strtotime($report_row->report_publish_date))}}</h2>
    </div>
</div>
@endforeach