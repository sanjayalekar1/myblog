<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterCommercialProjectTableAddFeature4 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('commercial_project', function (Blueprint $table) {

            // 1. Create new column
            $table->string('feature4')->after('feature3')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('commercial_project', function (Blueprint $table) {

            // 1. Create new column
            $table->dropColumn('feature4');
        });
    }
}
