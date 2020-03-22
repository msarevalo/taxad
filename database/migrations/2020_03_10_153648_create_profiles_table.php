<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombrePerfil');
            $table->integer('estado')->default(1);
            $table->timestamps();
        });

        DB::table('profiles')->insert(array('nombrePerfil'=>'Superadmin'));
        DB::table('profiles')->insert(array('nombrePerfil'=>'Admin'));
        DB::table('profiles')->insert(array('nombrePerfil'=>'Conductor'));
        DB::table('profiles')->insert(array('nombrePerfil'=>'Socio'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
}
