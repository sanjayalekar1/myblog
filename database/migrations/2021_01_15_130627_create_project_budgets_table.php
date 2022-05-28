<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectBudgetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_budgets', function (Blueprint $table) {
            $table->id();
            $table->string('project_budget_title');
            $table->integer('project_budget_min_price');
            $table->integer('project_budget_max_price');
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
        Schema::dropIfExists('project_budgets');
    }
}
