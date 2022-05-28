<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromQuery;

class MediaKitEnquiries implements WithHeadings, FromQuery {
    /**
    * @return \Illuminate\Support\Collection
    */
    public function query() {
    	return \App\Models\MediaKitEnquiry::query()->selectRaw("enquiry_name, enquiry_email_id, enquiry_mobile_number, ip_address, utm_source, utm_medium, utm_campaign, utm_term, utm_content, user_device, otp_status, created_at")->orderBy('created_at', 'desc');
    }

    public function headings(): array {
    	return [
    		'Name',
    		'Email ID',
    		'Mobile Number',
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
