<div class="row custom-row grid projects__lists__section" data-scroll-speed=".2" data-scroll-offset="5%" data-scroll-repeat data-scroll data-scroll-class="inView">
	@foreach($projects as $project_row)
	<div class="projects__lists__section__item">
	    <a @if($project_row->project_template_id != 3) href="{{url('/')}}/projects/{{$project_row->project_url_slug}}" target="_blank" @endif class="projects__lists__section__item__inner">
	        <img loading="lazy" src="{{url('/')}}/assets/images/projects/{{$project_row->project_thumbnail}}" alt="{{$project_row->project_name}}" class="img-fluid" width="402" height="402">
	        <div class="projects__lists__item__inner__caption" data-scroll data-scroll-repeat data-scroll-class="fadeInView" data-scroll-delay="2000">
	            <h3 class="project-heading mb-2" data-scroll data-scroll-speed="1">{{$project_row->project_name}}</h3>
	            @if(!empty($project_row->project_accommodation_type))
				<h4 data-scroll data-scroll-speed="1.1" class="mb-3"><span><i class="fa fa-building-o" aria-hidden="true"></i></span> {{$project_row->project_accommodation_type}}</h4>
				@endif
				@if(!empty($project_row->project_location_text))
				<h4 data-scroll data-scroll-speed="1.2" class="mb-2"><span><i class="fa fa-map-marker" aria-hidden="true"></i></span> {{$project_row->project_location_text}}</h4>
				@endif
				@if($project_row->project_template_id != 3)
	            <span class="link" data-scroll data-scroll-speed="1.3"> <span></span> Explore</span>
	            @else
	            <span></span>
	            @endif
	        </div>
	    </a>
	</div>
	@endforeach
</div>