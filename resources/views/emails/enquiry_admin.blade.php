<p>Name: {{$enquiry->enquiry_name}}</p>
<p>Email ID: {{$enquiry->enquiry_email_id}}</p>
<p>Mobile Number: {{$enquiry->enquiry_mobile_number}}</p>
@if(!empty($enquiry->project_name))
<p>Project Name: {{$enquiry->project_name}}</p>
@endif
<p>Query: {{$enquiry->enquiry_comments}}</p>
@if(!empty($enquiry->utm_source))
<p>Source: {{$enquiry->utm_source}}</p>
@endif
@if(!empty($enquiry->utm_medium))
<p>Medium: {{$enquiry->utm_medium}}</p>
@endif
@if(!empty($enquiry->utm_campaign))
<p>Campaign: {{$enquiry->utm_campaign}}</p>
@endif
@if(!empty($enquiry->utm_term))
<p>Term: {{$enquiry->utm_term}}</p>
@endif
@if(!empty($enquiry->utm_content))
<p>Content: {{$enquiry->utm_content}}</p>
@endif