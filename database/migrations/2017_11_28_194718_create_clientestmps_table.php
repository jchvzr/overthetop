<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientestmpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientestmps', function (Blueprint $table) {
          $table->increments('id');
          $table->string('customerid')->nullable()->default('');
          $table->integer('idcampana');
          $table->integer('id_compania');
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
        Schema::drop('clientestmps');
    }
}
