<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeparatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('separators', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre');
            $table->integer('menu_posterior');
            $table->integer('estado')->default(1);
            $table->timestamps();
        });

        DB::table('separators')->insert(array('id'=>'1', 'nombre'=>'TAXAD | Taxi Administrator', 'menu_posterior'=>1));
        DB::table('separators')->insert(array('id'=>'2', 'nombre'=>'ADMINISTRACION', 'menu_posterior'=>2));
        DB::table('separators')->insert(array('id'=>'3', 'nombre'=>'OPCIONES', 'menu_posterior'=>18));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('separators');
    }
}
