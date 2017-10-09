<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PermisosSubmenu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('permisosSubmenu', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_permisosMenu');
            $table->integer('id_perfil');
            $table->integer('id_submenuIzquierda');
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
        Schema::drop('permisosSubmenu');
    }
}
