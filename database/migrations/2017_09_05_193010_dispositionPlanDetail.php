<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DispositionPlanDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('dispositionPlanDetail', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_dispositionPlan');
            $table->integer('id_disposition');
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
        //
        Schema::drop('dispositionPlanDetail');
    }
}
