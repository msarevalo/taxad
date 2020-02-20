<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriasGastosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categorias_gastos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('categoria');
            $table->timestamps();
        });

        DB::table('categorias_gastos')->insert(array('categoria'=>'Reparacion Motor'));
        DB::table('categorias_gastos')->insert(array('categoria'=>'Electrico'));
        DB::table('categorias_gastos')->insert(array('categoria'=>'Seguros'));
        DB::table('categorias_gastos')->insert(array('categoria'=>'Suspension'));
        DB::table('categorias_gastos')->insert(array('categoria'=>'GPS'));
        DB::table('categorias_gastos')->insert(array('categoria'=>'Llantas'));
        DB::table('categorias_gastos')->insert(array('categoria'=>'Clutch'));
        DB::table('categorias_gastos')->insert(array('categoria'=>'Aceite'));
        DB::table('categorias_gastos')->insert(array('categoria'=>'Motor'));
        DB::table('categorias_gastos')->insert(array('categoria'=>'Frenos'));
        DB::table('categorias_gastos')->insert(array('categoria'=>'Caja'));
        DB::table('categorias_gastos')->insert(array('categoria'=>'Rodamiento'));
        DB::table('categorias_gastos')->insert(array('categoria'=>'Gas'));
        DB::table('categorias_gastos')->insert(array('categoria'=>'SOAT'));
        DB::table('categorias_gastos')->insert(array('categoria'=>'Miscelaneo'));
        DB::table('categorias_gastos')->insert(array('categoria'=>'Revision Tecnomecanica'));
        DB::table('categorias_gastos')->insert(array('categoria'=>'Puerta'));
        DB::table('categorias_gastos')->insert(array('categoria'=>'Traspaso'));
        DB::table('categorias_gastos')->insert(array('categoria'=>'Administracion'));
        DB::table('categorias_gastos')->insert(array('categoria'=>'Patios'));
        DB::table('categorias_gastos')->insert(array('categoria'=>'Direccion Hidraulica'));
        DB::table('categorias_gastos')->insert(array('categoria'=>'Gasolina'));
        DB::table('categorias_gastos')->insert(array('categoria'=>'Impuestos'));
        DB::table('categorias_gastos')->insert(array('categoria'=>'Transmision'));
        DB::table('categorias_gastos')->insert(array('categoria'=>'Radiador'));
        DB::table('categorias_gastos')->insert(array('categoria'=>'Exhosto'));
        DB::table('categorias_gastos')->insert(array('categoria'=>'Seguridad Social'));
        DB::table('categorias_gastos')->insert(array('categoria'=>'Alineacion'));
        DB::table('categorias_gastos')->insert(array('categoria'=>'Revision Preventiva'));
        DB::table('categorias_gastos')->insert(array('categoria'=>'Taximetro'));
        DB::table('categorias_gastos')->insert(array('categoria'=>'Radio'));
        DB::table('categorias_gastos')->insert(array('categoria'=>'Otro'));
    }




    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categorias_gastos');
    }
}
