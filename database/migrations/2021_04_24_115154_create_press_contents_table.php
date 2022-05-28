<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePressContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('press_contents', function (Blueprint $table) {
            $table->id();
            $table->integer('press_id');
            $table->date('press_publish_date');
            $table->integer('press_link_attachment');
            $table->text('press_link');
            $table->string('press_attachment');
            $table->integer('display_status');
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
        Schema::dropIfExists('press_contents');
    }
}
