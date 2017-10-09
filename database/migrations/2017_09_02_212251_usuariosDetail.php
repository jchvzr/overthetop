<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UsuariosDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('usuariosDetail', function (Blueprint $table) {
          $table->increments('id');
          $table->string('nombre',60);
          $table->string('apellidoPaterno', 60);
          $table->string('apellidoMaterno', 60);
          $table->string('domicilioCalle', 60);
          $table->string('domicilioColonia', 60);
          $table->string('domicilioCiudad', 60);
          $table->string('domicilioCP', 60);
          $table->date('fechaNacimiento');
          $table->integer('sexo');
          $table->string('curp', 60);
          $table->string('rfc', 60);
          $table->string('nss', 60);
          $table->date('fechaIngreso');
          $table->integer('id_usuario');
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
      Schema::drop('UsuariosDetail');
    }
}
