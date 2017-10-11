<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DispositionsPlan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('dispositionPlan', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->integer('descripcion');
            $table->integer('id_compania');
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
        Schema::drop('dispositionPlan');
    }
}