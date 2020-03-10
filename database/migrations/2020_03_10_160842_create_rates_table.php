<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('dia');
            $table->integer('tarifa');
            $table->timestamps();
        });

        DB::table('rates')->insert(array('dia'=>'Lunes', 'tarifa'=>'0'));
        DB::table('rates')->insert(array('dia'=>'Martes', 'tarifa'=>'0'));
        DB::table('rates')->insert(array('dia'=>'Miercoles', 'tarifa'=>'0'));
        DB::table('rates')->insert(array('dia'=>'Jueves', 'tarifa'=>'0'));
        DB::table('rates')->insert(array('dia'=>'Viernes', 'tarifa'=>'0'));
        DB::table('rates')->insert(array('dia'=>'Sabado', 'tarifa'=>'0'));
        DB::table('rates')->insert(array('dia'=>'Domingo','tarifa'=>'0'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rates');
    }
}
