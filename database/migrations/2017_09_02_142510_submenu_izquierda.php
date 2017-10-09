<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SubmenuIzquierda extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('submenuIzquierda', function (Blueprint $table) {
            $table->increments('id');
            $table->string('opcion',60);
            $table->string('route', 100);
            $table->integer('id_menuIzquierda');
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
        Schema::drop('submenuIzquierda');
    }
}
