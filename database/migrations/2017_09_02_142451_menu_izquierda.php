<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MenuIzquierda extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('menuIzquierda', function (Blueprint $table) {
          $table->increments('id');
          $table->string('opcion',60);
          $table->string('icono',100);
          $table->string('route', 100);
          $table->integer('consubmenu');
          $table->timestamp('created_at');
          $table->timestamp('updated_at');
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
          Schema::drop('menuIzquierda');
    }
}
