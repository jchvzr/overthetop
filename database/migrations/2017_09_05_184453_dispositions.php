<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Dispositions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('dispositions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->integer('contacto');
            $table->integer('rpc');
            $table->integer('exito');
            $table->integer('compromiso');
            $table->integer('bloqueo');
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
        Schema::drop('dispositions');
    }
}
