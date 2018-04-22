<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EncuestaDesatisfaccions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('encuestadesatisfaccions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('customer_id');
            $table->string('p1');
            $table->string('p2');
            $table->string('p3');
            $table->integer('p4');
            $table->integer('p5');
            $table->integer('p6');
            $table->integer('p7');
            $table->integer('p8');
            $table->integer('p9');
            $table->string('p10');
            $table->integer('p11');
            $table->integer('p12');
            $table->integer('p13');
            $table->string('p14');
            $table->integer('p15_factoraje');
            $table->integer('p15_credito_de_capital_de_trabajo');
            $table->integer('p15_credito_puente');
            $table->integer('p15_arrendamiento_financiero');
            $table->integer('p15_otro');
            $table->string('p15_cual');
            $table->integer('p16_factoraje');
            $table->integer('p16_credito_de_capital_de_trabajo');
            $table->integer('p16_credito_puente');
            $table->integer('p16_arrendamiento_financiero');
            $table->integer('p16_otro');
            $table->string('p16_cual');
            $table->integer('p17');
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
        Schema::dropIfExists('encuestadesatisfaccions');
    }
}
