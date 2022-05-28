<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactEnquiriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_enquiries', function (Blueprint $table) {
            $table->id();
            $table->string('enquiry_name');
            $table->string('enquiry_email_id');
            $table->integer('enquiry_isd_code');
            $table->string('enquiry_mobile_number');
            $table->integer('enquiry_project_id');
            $table->text('enquiry_comments');
            $table->text('referral_url');
            $table->string('utm_source');
            $table->string('utm_medium');
            $table->string('utm_campaign');
            $table->string('utm_term');
            $table->string('utm_content');
            $table->string('user_device');
            $table->string('otp_status');
            $table->string('ip_address');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contact_enquiries');
    }
}
