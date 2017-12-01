<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UsuariosArchivo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('UsuariosArchivo', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_usuario');
            $table->string('nombrearchivo');
            $table->string('nombreunico');
            $table->string('icono');
            $table->integer('size');
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
        Schema::drop('UsuariosArchivo');
    }
}
