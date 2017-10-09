<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ClientesInteraccion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('clientesinteraccion', function (Blueprint $table) {
            $table->increments('id');
            $table->string('customerid');
            $table->integer('id_tipoInteraccion');
            $table->integer('id_disposition');
            $table->string('comentario');
            $table->integer('id_users');
            $table->datetime('fechaInteraccion');
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
        Schema::drop('clientesinteraccion');
    }
}
