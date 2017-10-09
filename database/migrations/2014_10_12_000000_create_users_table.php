<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('usuario', 60);
            $table->string('email', 60)->unique();
            $table->string('password', 60);
            $table->rememberToken();
            $table->integer('habilitado');
            $table->date('fechaExpiracionPass');
            $table->date('fechaParaInhabilitarUsuario');
            $table->integer('id_usuariosPerfil');
            $table->integer('id_usuariosPuesto');
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
        Schema::drop('users');
    }
}
