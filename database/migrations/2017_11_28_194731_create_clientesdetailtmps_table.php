<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesdetailtmpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientesdetailtmps', function (Blueprint $table) {
          $table->increments('id');
          $table->string('customerid');
          $table->string('nombreCliente')->nullable()->default('');
          $table->string('calleCasa')->nullable()->default('');
          $table->string('coloniaCasa')->nullable()->default('');
          $table->string('ciudadCasa')->nullable()->default('');
          $table->string('cpCasa')->nullable()->default('');
          $table->string('calleTrabajo')->nullable()->default('');
          $table->string('coloniaTrabajo')->nullable()->default('');
          $table->string('ciudadTrabajo')->nullable()->default('');
          $table->string('cpTrabajo')->nullable()->default('');
          $table->string('telefono1')->nullable()->default('');
          $table->string('telefono2')->nullable()->default('');
          $table->string('telefono3')->nullable()->default('');
          $table->string('telefono4')->nullable()->default('');
          $table->string('custom1')->nullable()->default('');
          $table->string('custom2')->nullable()->default('');
          $table->string('custom3')->nullable()->default('');
          $table->string('custom4')->nullable()->default('');
          $table->string('custom5')->nullable()->default('');
          $table->string('custom6')->nullable()->default('');
          $table->string('custom7')->nullable()->default('');
          $table->string('custom8')->nullable()->default('');
          $table->string('custom9')->nullable()->default('');
          $table->string('custom10')->nullable()->default('');
          $table->string('ultimocodigo')->nullable()->default('');
          $table->string('fecha')->nullable()->default('');
          $table->string('usuariocodigo')->nullable()->default('');
          $table->integer('enuso')->nullable()->default('0');
          $table->string('usuarioenuso')->nullable()->default('');
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
        Schema::drop('clientesdetailtmps');
    }
}
