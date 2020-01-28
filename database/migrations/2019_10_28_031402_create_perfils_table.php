<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerfilsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perfils', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombrePerfil');
            $table->timestamps();
        });

        DB::table('perfils')->insert(array('nombrePerfil'=>'Superadmin'));
        DB::table('perfils')->insert(array('nombrePerfil'=>'Admin'));
        DB::table('perfils')->insert(array('nombrePerfil'=>'Conductor'));
        DB::table('perfils')->insert(array('nombrePerfil'=>'Socio'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('perfils');
    }
}
