<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpenseCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expense_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('categoria');
            $table->integer('estado')->default('1');
            $table->timestamps();
        });

        DB::table('expense_categories')->insert(array('categoria'=>'Reparacion Motor'));
        DB::table('expense_categories')->insert(array('categoria'=>'Electrico'));
        DB::table('expense_categories')->insert(array('categoria'=>'Seguros'));
        DB::table('expense_categories')->insert(array('categoria'=>'Suspension'));
        DB::table('expense_categories')->insert(array('categoria'=>'GPS'));
        DB::table('expense_categories')->insert(array('categoria'=>'Llantas'));
        DB::table('expense_categories')->insert(array('categoria'=>'Clutch'));
        DB::table('expense_categories')->insert(array('categoria'=>'Aceite'));
        DB::table('expense_categories')->insert(array('categoria'=>'Motor'));
        DB::table('expense_categories')->insert(array('categoria'=>'Frenos'));
        DB::table('expense_categories')->insert(array('categoria'=>'Caja'));
        DB::table('expense_categories')->insert(array('categoria'=>'Rodamiento'));
        DB::table('expense_categories')->insert(array('categoria'=>'Gas'));
        DB::table('expense_categories')->insert(array('categoria'=>'SOAT'));
        DB::table('expense_categories')->insert(array('categoria'=>'Miscelaneo'));
        DB::table('expense_categories')->insert(array('categoria'=>'Revision Tecnomecanica'));
        DB::table('expense_categories')->insert(array('categoria'=>'Puerta'));
        DB::table('expense_categories')->insert(array('categoria'=>'Traspaso'));
        DB::table('expense_categories')->insert(array('categoria'=>'Administracion'));
        DB::table('expense_categories')->insert(array('categoria'=>'Patios'));
        DB::table('expense_categories')->insert(array('categoria'=>'Direccion Hidraulica'));
        DB::table('expense_categories')->insert(array('categoria'=>'Gasolina'));
        DB::table('expense_categories')->insert(array('categoria'=>'Impuestos'));
        DB::table('expense_categories')->insert(array('categoria'=>'Transmision'));
        DB::table('expense_categories')->insert(array('categoria'=>'Radiador'));
        DB::table('expense_categories')->insert(array('categoria'=>'Exhosto'));
        DB::table('expense_categories')->insert(array('categoria'=>'Seguridad Social'));
        DB::table('expense_categories')->insert(array('categoria'=>'Alineacion'));
        DB::table('expense_categories')->insert(array('categoria'=>'Revision Preventiva'));
        DB::table('expense_categories')->insert(array('categoria'=>'Taximetro'));
        DB::table('expense_categories')->insert(array('categoria'=>'Radio'));
        DB::table('expense_categories')->insert(array('categoria'=>'Otro'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('expense_categories');
    }
}
