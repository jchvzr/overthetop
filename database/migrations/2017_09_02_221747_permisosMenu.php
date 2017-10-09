<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PermisosMenu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('permisosMenu', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_perfil');
            $table->integer('id_menuIzquierda');
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
        Schema::drop('permisosMenu');
    }
}
