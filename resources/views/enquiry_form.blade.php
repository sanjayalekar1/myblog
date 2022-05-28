<form class="row @if(isset($project->id)) project__enquiry__form @else enquiry__form @endif enquiry_form">
    @csrf
    <input type="hidden" name="enquiry_form_name" value="{{$form_location}}">
    <div class="col-12 @if(isset($project->id)) project__enquiry__form__title @else enquiry__form__title @endif">
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
        <select class="form-select enquiry_isd_code country_dropdown" name="enquiry_isd_code" style="margin-bottom:0rem">
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
    <div class="col-12 col-sm-12 col-mb-6 mb-3">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>