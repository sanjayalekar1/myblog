<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_plans', function (Blueprint $table) {
            $table->id();
            $table->integer('project_id');
            $table->string('project_layout_title');
            $table->string('project_layout_type');
            $table->string('project_layout_image');
            $table->string('project_layout_area_title_one');
            $table->string('project_layout_area_value_one');
            $table->string('project_layout_area_title_two');
            $table->string('project_layout_area_value_two');
            $table->string('project_layout_area_title_three');
            $table->string('project_layout_area_value_three');
            $table->integer('display_status');
            $table->integer('sorting_order');
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
        Schema::dropIfExists('project_plans');
    }
}
