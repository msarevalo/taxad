<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre');
            $table->string('ruta')->nullable();
            $table->integer('submenu');
            $table->integer('menu_padre')->nullable();
            $table->string('class')->nullable();
            $table->integer('orden');
            $table->timestamps();
            $table->softDeletes();
        });

        DB::table('menus')->insert(array('id'=>'1', 'nombre'=>'Perfil', 'ruta'=>'#', 'submenu'=>0, 'menu_padre'=>0, 'class'=>'fa fa-address-card-o', 'orden'=>-99));
        DB::table('menus')->insert(array('id'=>'2', 'nombre'=>'Dashboard', 'ruta'=>'/home', 'submenu'=>0, 'menu_padre'=>0, 'class'=>'fa fa-line-chart', 'orden'=>2));
        DB::table('menus')->insert(array('id'=>'3', 'nombre'=>'Administrativo', 'submenu'=>0, 'class'=>'fa fa-cogs', 'orden'=>3));
        DB::table('menus')->insert(array('id'=>'4', 'nombre'=>'Menús', 'ruta'=>'/administrativo/menus', 'submenu'=>1, 'menu_padre'=>3, 'orden'=>4));
        DB::table('menus')->insert(array('id'=>'5', 'nombre'=>'Separadores', 'ruta'=>'/administrativo/separadores', 'submenu'=>1, 'menu_padre'=>3, 'orden'=>5));
        DB::table('menus')->insert(array('id'=>'6', 'nombre'=>'Permisos', 'ruta'=>'/administrativo/permisos', 'submenu'=>1, 'menu_padre'=>3, 'orden'=>6));
        DB::table('menus')->insert(array('id'=>'7', 'nombre'=>'Perfiles', 'ruta'=>'/administrativo/perfiles', 'submenu'=>1, 'menu_padre'=>3, 'orden'=>7));
        DB::table('menus')->insert(array('id'=>'8', 'nombre'=>'Usuarios', 'submenu'=>0, 'class'=>'fa fa-users', 'orden'=>8));
        DB::table('menus')->insert(array('id'=>'9', 'nombre'=>'Administradores', 'ruta'=>'/administradores', 'submenu'=>1, 'menu_padre'=>8, 'orden'=>9));
        DB::table('menus')->insert(array('id'=>'10', 'nombre'=>'Conductores', 'ruta'=>'/conductores', 'submenu'=>1, 'menu_padre'=>8, 'orden'=>10));
        DB::table('menus')->insert(array('id'=>'11', 'nombre'=>'Socios', 'ruta'=>'/socios', 'submenu'=>1, 'menu_padre'=>8, 'orden'=>11));
        DB::table('menus')->insert(array('id'=>'12', 'nombre'=>'Taxis', 'submenu'=>0, 'class'=>'fa fa-taxi', 'orden'=>12));
        DB::table('menus')->insert(array('id'=>'13', 'nombre'=>'Tarifas', 'ruta'=>'/tarifa', 'submenu'=>1, 'menu_padre'=>12, 'orden'=>13));
        DB::table('menus')->insert(array('id'=>'14', 'nombre'=>'Categoria Gastos', 'ruta'=>'/categoria', 'submenu'=>1, 'menu_padre'=>12, 'orden'=>14));
        DB::table('menus')->insert(array('id'=>'15', 'nombre'=>'Descripcion Gastos', 'ruta'=>'/descripcion', 'submenu'=>1, 'menu_padre'=>12, 'orden'=>15));
        DB::table('menus')->insert(array('id'=>'16', 'nombre'=>'Marcas', 'ruta'=>'/marcas', 'submenu'=>1, 'menu_padre'=>12, 'orden'=>16));
        DB::table('menus')->insert(array('id'=>'17', 'nombre'=>'Vehiculos', 'ruta'=>'/taxis', 'submenu'=>1, 'menu_padre'=>12, 'orden'=>17));
        DB::table('menus')->insert(array('id'=>'18', 'nombre'=>'Calendario', 'ruta'=>'/calendario', 'submenu'=>0, 'menu_padre'=>0, 'class'=>'fa fa-calendar', 'orden'=>18));
        DB::table('menus')->insert(array('id'=>'19', 'nombre'=>'Notificaciones', 'ruta'=>'#', 'submenu'=>0, 'menu_padre'=>0, 'class'=>'fa fa-envelope', 'orden'=>19));
        DB::table('menus')->insert(array('id'=>'20', 'nombre'=>'Ayuda', 'ruta'=>'#', 'submenu'=>0, 'menu_padre'=>0, 'class'=>'fa fa-question-circle', 'orden'=>20));
        DB::table('menus')->insert(array('id'=>'21', 'nombre'=>'Cerrar Sesión', 'ruta'=>'logout', 'submenu'=>0, 'menu_padre'=>0, 'class'=>'fa fa-sign-out', 'orden'=>99));



    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menus');
    }
}
