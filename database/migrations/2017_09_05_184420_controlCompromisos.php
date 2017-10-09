<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ControlCompromisos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('controlCompromisos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_clientes');
            $table->date('fechaInicio');
            $table->date('fechaFin');
            $table->string('comentario');
            $table->integer('monto');
            $table->integer('id_disposition');
            $table->integer('hecho');
            $table->integer('id_users');             
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
        Schema::drop('controlCompromisos');
    }
}
