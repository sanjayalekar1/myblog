<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommercialProjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commercial_project', function (Blueprint $table) {
           // $table->increments('id',1000);
            $table->id()->startingValue(2000);
            $table->string('project_title');
            $table->string('project_slug');
            $table->string('project_logo')->nullable();
            $table->string('project_logo_alt_text')->nullable();
            $table->string('project_thumbnail');
            $table->integer('project_type')->nullable();
            $table->string('project_location_text')->nullable();
            $table->integer('project_location');
            $table->integer('project_status_id');
            $table->string('project_area');
            $table->string('feature1')->nullable();
            $table->string('feature2')->nullable();
            $table->string('feature3')->nullable();
            $table->string('google_iframe_code')->nullable();
            $table->string('project_landmarks')->nullable();
            $table->string('broucher_pdf_link')->nullable();
            $table->string('project_link')->nullable();
            $table->longtext('project_description')->nullable();
            $table->string('project_about_image')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('schema_code')->nullable();
            $table->integer('status')->default(0);
            $table->integer('sorting_order')->default(0);
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
        Schema::dropIfExists('commercial_project');
    }
}
