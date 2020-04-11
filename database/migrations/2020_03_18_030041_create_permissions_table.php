<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('perfil');
            $table->integer('menu');
            $table->integer('ver')->default(0);
            $table->integer('crear')->default(0);
            $table->integer('editar')->default(0);
            $table->integer('eliminar')->default(0);
            $table->timestamps();
        });

        DB::table('permissions')->insert(array('perfil'=>'1', 'menu'=>1, 'ver'=>1, 'crear'=>1, 'editar'=>1, 'eliminar'=>'1'));
        DB::table('permissions')->insert(array('perfil'=>'1', 'menu'=>2, 'ver'=>1, 'crear'=>1, 'editar'=>1, 'eliminar'=>'1'));
        DB::table('permissions')->insert(array('perfil'=>'1', 'menu'=>3, 'ver'=>1, 'crear'=>1, 'editar'=>1, 'eliminar'=>'1'));
        DB::table('permissions')->insert(array('perfil'=>'1', 'menu'=>4, 'ver'=>1, 'crear'=>1, 'editar'=>1, 'eliminar'=>'1'));
        DB::table('permissions')->insert(array('perfil'=>'1', 'menu'=>5, 'ver'=>1, 'crear'=>1, 'editar'=>1, 'eliminar'=>'1'));
        DB::table('permissions')->insert(array('perfil'=>'1', 'menu'=>6, 'ver'=>1, 'crear'=>1, 'editar'=>1, 'eliminar'=>'1'));
        DB::table('permissions')->insert(array('perfil'=>'1', 'menu'=>7, 'ver'=>1, 'crear'=>1, 'editar'=>1, 'eliminar'=>'1'));
        DB::table('permissions')->insert(array('perfil'=>'1', 'menu'=>8, 'ver'=>1, 'crear'=>1, 'editar'=>1, 'eliminar'=>'1'));
        DB::table('permissions')->insert(array('perfil'=>'1', 'menu'=>9, 'ver'=>1, 'crear'=>1, 'editar'=>1, 'eliminar'=>'1'));
        DB::table('permissions')->insert(array('perfil'=>'1', 'menu'=>11, 'ver'=>1, 'crear'=>1, 'editar'=>1, 'eliminar'=>'1'));
        DB::table('permissions')->insert(array('perfil'=>'1', 'menu'=>10, 'ver'=>1, 'crear'=>1, 'editar'=>1, 'eliminar'=>'1'));
        DB::table('permissions')->insert(array('perfil'=>'1', 'menu'=>12, 'ver'=>1, 'crear'=>1, 'editar'=>1, 'eliminar'=>'1'));
        DB::table('permissions')->insert(array('perfil'=>'1', 'menu'=>13, 'ver'=>1, 'crear'=>1, 'editar'=>1, 'eliminar'=>'1'));
        DB::table('permissions')->insert(array('perfil'=>'1', 'menu'=>14, 'ver'=>1, 'crear'=>1, 'editar'=>1, 'eliminar'=>'1'));
        DB::table('permissions')->insert(array('perfil'=>'1', 'menu'=>15, 'ver'=>1, 'crear'=>1, 'editar'=>1, 'eliminar'=>'1'));
        DB::table('permissions')->insert(array('perfil'=>'1', 'menu'=>16, 'ver'=>1, 'crear'=>1, 'editar'=>1, 'eliminar'=>'1'));
        DB::table('permissions')->insert(array('perfil'=>'1', 'menu'=>17, 'ver'=>1, 'crear'=>1, 'editar'=>1, 'eliminar'=>'1'));
        DB::table('permissions')->insert(array('perfil'=>'1', 'menu'=>18, 'ver'=>1, 'crear'=>1, 'editar'=>1, 'eliminar'=>'1'));
        DB::table('permissions')->insert(array('perfil'=>'1', 'menu'=>19, 'ver'=>1, 'crear'=>1, 'editar'=>1, 'eliminar'=>'1'));
        DB::table('permissions')->insert(array('perfil'=>'1', 'menu'=>20, 'ver'=>1, 'crear'=>1, 'editar'=>1, 'eliminar'=>'1'));
        DB::table('permissions')->insert(array('perfil'=>'1', 'menu'=>21, 'ver'=>1, 'crear'=>1, 'editar'=>1, 'eliminar'=>'1'));


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permissions');
    }
}
