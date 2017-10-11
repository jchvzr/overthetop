<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UsuariosPuesto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('usuariosPuesto', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parentId');
            $table->string('puesto',60);
            $table->integer('id_compania');
            $table->string('cadenadescendencia',250);
            $table->integer('id_areas');
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
        Schema::drop('usuariosPuesto');
    }
}
