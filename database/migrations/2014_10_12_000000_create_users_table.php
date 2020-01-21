<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username')->unique();
            $table->integer('document')->unique();
            $table->string('name');
            $table->string('lastname');
            $table->string('lastname2');
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('estado')->default('2');
            $table->integer('perfil')->default('3');
            $table->integer('nuevo')->default('0');
            $table->rememberToken();
            $table->timestamps();
        });

        $contraseña = Hash::make('ninguna123.');
        DB::table('users')->insert(array('username'=>'admin', 'document'=>'123', 'name'=>'admin', 'lastname'=>'', 'lastname2'=>'', 'email'=>'admin@taxad.com', 'password'=>$contraseña, 'estado'=>'1', 'perfil'=>'1', 'nuevo'=>'0'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
