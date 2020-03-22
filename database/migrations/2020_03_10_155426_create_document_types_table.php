<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('document_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tipo');
            $table->timestamps();
        });

        DB::table('document_types')->insert(array('tipo'=>'SOAT'));
        DB::table('document_types')->insert(array('tipo'=>'Tarjeta Propiedad'));
        DB::table('document_types')->insert(array('tipo'=>'Tarjeta de Operacion'));
        DB::table('document_types')->insert(array('tipo'=>'Revision Tecnomecanica'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('document_types');
    }
}
