<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ClientesDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('clientesdetail', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customerid');
            $table->string('nombreCliente');
            $table->string('calleCasa');
            $table->string('coloniaCasa');
            $table->string('ciudadCasa');
            $table->string('cpCasa');
            $table->string('calleTrabajo');
            $table->string('coloniaTrabajo');
            $table->string('ciudadTrabajo');
            $table->string('cpTrabajo');
            $table->string('telefono1');
            $table->string('telefono2');
            $table->string('telefono3');
            $table->string('telefono4');
            $table->string('custom1');
            $table->string('custom2');
            $table->string('custom3');
            $table->string('custom4');
            $table->string('custom5');
            $table->string('custom6');
            $table->string('custom7');
            $table->string('custom8');
            $table->string('custom9');
            $table->string('custom10');
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
        Schema::drop('clientesdetail');
    }
}
