<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromQuery;

class Enquiries implements WithHeadings, FromQuery {
    /**
    * @return \Illuminate\Support\Collection
    */
    public function query() {
        $project_query = \App\Models\Project::select('project_name')->whereColumn('projects.id', 'enquiries.enquiry_project_id')->toSql();

    	return \App\Models\Enquiry::query()->selectRaw("enquiry_name, enquiry_email_id, enquiry_mobile_number, ($project_query) AS project_name, enquiry_comments, ip_address, utm_source, utm_medium, utm_campaign, utm_term, utm_content, user_device, otp_status, DATE_FORMAT(created_at, '%D %M %Y, %r')")->orderBy('created_at', 'desc');
    }

    public function headings(): array {
    	return [
    		'Name',
    		'Email ID',
    		'Mobile Number',
            'Project',
    		'Comments',
    		'IP Address',
            'Source',
            'Medium',
            'Campaign',
            'Term',
            'Content',
            'Device',
            'OTP Status',
    		'Time Stamp'
    	];
    }
}
