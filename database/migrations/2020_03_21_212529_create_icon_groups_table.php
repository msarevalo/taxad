<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIconGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('icon_groups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre');
            $table->timestamps();
        });

        DB::table('icon_groups')->insert(array('nombre'=>'Usuario'));
        DB::table('icon_groups')->insert(array('nombre'=>'Transporte'));
        DB::table('icon_groups')->insert(array('nombre'=>'Tiempo'));
        DB::table('icon_groups')->insert(array('nombre'=>'Ayuda'));
        DB::table('icon_groups')->insert(array('nombre'=>'Alertas'));
        DB::table('icon_groups')->insert(array('nombre'=>'Administrativo'));
        DB::table('icon_groups')->insert(array('nombre'=>'Estaditico'));

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('icon_groups');
    }
}
