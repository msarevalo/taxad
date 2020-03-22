<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIconsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('icons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre');
            $table->string('class');
            $table->integer('grupo');
            $table->timestamps();
        });

        DB::table('icons')->insert(array('nombre'=>'Usuario - Libro Direcciones - Fondo', 'class'=>'fa fa-address-book', 'grupo'=>1));
        DB::table('icons')->insert(array('nombre'=>'Usuario - Libro Direcciones', 'class'=>'fa fa-address-book-o', 'grupo'=>1));
        DB::table('icons')->insert(array('nombre'=>'Usuario - Tarjeta Direcciones - Fondo', 'class'=>'fa fa-address-card', 'grupo'=>1));
        DB::table('icons')->insert(array('nombre'=>'Usuario - Tarjeta Direcciones', 'class'=>'fa fa-address-card-o', 'grupo'=>1));
        DB::table('icons')->insert(array('nombre'=>'Estadistico - Grafica Area', 'class'=>'fa fa-area-chart', 'grupo'=>7));
        DB::table('icons')->insert(array('nombre'=>'Transporte - Vehiculo', 'class'=>'fa fa-car', 'grupo'=>2));
        DB::table('icons')->insert(array('nombre'=>'Estadistico - Grafica de Barras', 'class'=>'fa fa-bar-chart', 'grupo'=>7));
        DB::table('icons')->insert(array('nombre'=>'Alertas - Campana Fondo', 'class'=>'fa fa-bell', 'grupo'=>5));
        DB::table('icons')->insert(array('nombre'=>'Alertas - Campana', 'class'=>'fa fa-bell-o', 'grupo'=>5));
        DB::table('icons')->insert(array('nombre'=>'Alertas - Campana Slash Fondo', 'class'=>'fa fa-bell-slash', 'grupo'=>5));
        DB::table('icons')->insert(array('nombre'=>'Alertas - Campana Slash Fondo', 'class'=>'fa fa-bell-slash-o', 'grupo'=>5));
        DB::table('icons')->insert(array('nombre'=>'Alertas - Megafono', 'class'=>'fa fa-bullhorn', 'grupo'=>5));
        DB::table('icons')->insert(array('nombre'=>'Transporte - Bus', 'class'=>'fa fa-bus', 'grupo'=>2));
        DB::table('icons')->insert(array('nombre'=>'Tiempo - Calendario Cuadriculado', 'class'=>'fa fa-calendar', 'grupo'=>3));
        DB::table('icons')->insert(array('nombre'=>'Tiempo - Calendario Check', 'class'=>'fa fa-calendar-check-o', 'grupo'=>3));
        DB::table('icons')->insert(array('nombre'=>'Tiempo - Calendario Menos', 'class'=>'fa fa-calendar-minus-o', 'grupo'=>3));
        DB::table('icons')->insert(array('nombre'=>'Tiempo - Calendario Blanco', 'class'=>'fa fa-calendar-o', 'grupo'=>3));
        DB::table('icons')->insert(array('nombre'=>'Tiempo - Calendario Mas', 'class'=>'fa fa-calendar-plus-o', 'grupo'=>3));
        DB::table('icons')->insert(array('nombre'=>'Tiempo - Calendario Negar', 'class'=>'fa fa-calendar-times-o', 'grupo'=>3));
        DB::table('icons')->insert(array('nombre'=>'Administrativo - Piñon', 'class'=>'fa fa-cog', 'grupo'=>6));
        DB::table('icons')->insert(array('nombre'=>'Administrativo - Piñones', 'class'=>'fa fa-cogs', 'grupo'=>6));
        DB::table('icons')->insert(array('nombre'=>'Alertas - Burbuja Dialogo Fondo', 'class'=>'fa fa-comment', 'grupo'=>5));
        DB::table('icons')->insert(array('nombre'=>'Alertas - Burbuja Dialogo', 'class'=>'fa fa-comment-o', 'grupo'=>5));
        DB::table('icons')->insert(array('nombre'=>'Alertas - Burbuja Dialogo Puntos Fondo', 'class'=>'fa fa-commenting', 'grupo'=>5));
        DB::table('icons')->insert(array('nombre'=>'Alertas - Burbuja Dialogo Puntos', 'class'=>'fa fa-commenting-o', 'grupo'=>5));
        DB::table('icons')->insert(array('nombre'=>'Alertas - Burbujas Dialogo Fondo', 'class'=>'fa fa-comments', 'grupo'=>5));
        DB::table('icons')->insert(array('nombre'=>'Alertas - Burbujas Dialogo', 'class'=>'fa fa-comments-o', 'grupo'=>5));
        DB::table('icons')->insert(array('nombre'=>'Estadistico - Tacometro', 'class'=>'fa fa-tachometer', 'grupo'=>7));
        DB::table('icons')->insert(array('nombre'=>'Estadistico - Pantalla', 'class'=>'fa fa-desktop', 'grupo'=>7));
        DB::table('icons')->insert(array('nombre'=>'Usuario - Licencia de Conducir Fondo', 'class'=>'fa fa-id-card', 'grupo'=>1));
        DB::table('icons')->insert(array('nombre'=>'Usuario - Licencia de Conducir', 'class'=>'fa fa-id-card-o', 'grupo'=>1));
        DB::table('icons')->insert(array('nombre'=>'Alertas - Sobre Fondo', 'class'=>'fa fa-envelope', 'grupo'=>5));
        DB::table('icons')->insert(array('nombre'=>'Alertas - Sobre', 'class'=>'fa fa-envelope-o', 'grupo'=>5));
        DB::table('icons')->insert(array('nombre'=>'Alertas - Sobre Abierto Fondo', 'class'=>'fa fa-envelope-open', 'grupo'=>5));
        DB::table('icons')->insert(array('nombre'=>'Alertas - Sobre Abierto', 'class'=>'fa fa-envelope-open-o', 'grupo'=>5));
        DB::table('icons')->insert(array('nombre'=>'Alertas - Sobre Cuadro', 'class'=>'fa fa-envelope-square', 'grupo'=>5));
        DB::table('icons')->insert(array('nombre'=>'Alertas - Admiracion', 'class'=>'fa fa-exclamation', 'grupo'=>5));
        DB::table('icons')->insert(array('nombre'=>'Alertas - Admiracion Circulo', 'class'=>'fa fa-exclamation-circle', 'grupo'=>5));
        DB::table('icons')->insert(array('nombre'=>'Usuario - Grupo de Usuarios', 'class'=>'fa fa-users', 'grupo'=>1));
        DB::table('icons')->insert(array('nombre'=>'Tiempo - Reloj Arena Lleno', 'class'=>'fa fa-hourglass', 'grupo'=>3));
        DB::table('icons')->insert(array('nombre'=>'Tiempo - Reloj Arena Medio', 'class'=>'fa fa-hourglass-start', 'grupo'=>3));
        DB::table('icons')->insert(array('nombre'=>'Tiempo - Reloj Arena Cuartos', 'class'=>'fa fa-hourglass-half', 'grupo'=>3));
        DB::table('icons')->insert(array('nombre'=>'Tiempo - Reloj Arena Fin', 'class'=>'fa fa-hourglass-end', 'grupo'=>3));
        DB::table('icons')->insert(array('nombre'=>'Usuario - Insignia Usuario', 'class'=>'fa fa-id-badge', 'grupo'=>1));
        DB::table('icons')->insert(array('nombre'=>'Ayuda - Info', 'class'=>'fa fa-info', 'grupo'=>4));
        DB::table('icons')->insert(array('nombre'=>'Ayuda - Info Circulo', 'class'=>'fa fa-info-circle', 'grupo'=>4));
        DB::table('icons')->insert(array('nombre'=>'Ayuda - Foco', 'class'=>'fa fa-lightbulb-o', 'grupo'=>4));
        DB::table('icons')->insert(array('nombre'=>'Estadistico - Grafica de Linea', 'class'=>'fa fa-line-chart', 'grupo'=>7));
        DB::table('icons')->insert(array('nombre'=>'Estadistico - Diagrama de Torta', 'class'=>'fa fa-pie-chart', 'grupo'=>7));
        DB::table('icons')->insert(array('nombre'=>'Administrativo - Rompecabeza', 'class'=>'fa fa-puzzle-piece', 'grupo'=>6));
        DB::table('icons')->insert(array('nombre'=>'Ayuda - Pregunta', 'class'=>'fa fa-question', 'grupo'=>4));
        DB::table('icons')->insert(array('nombre'=>'Ayuda - Pregunta Criculo Fondo', 'class'=>'fa fa-question-circle', 'grupo'=>4));
        DB::table('icons')->insert(array('nombre'=>'Ayuda - Pregunta Criculo', 'class'=>'fa fa-question-circle-o', 'grupo'=>4));
        DB::table('icons')->insert(array('nombre'=>'Administrativo - Slider', 'class'=>'fa fa-sliders', 'grupo'=>6));
        DB::table('icons')->insert(array('nombre'=>'Transporte - Taxi', 'class'=>'fa fa-taxi', 'grupo'=>2));
        DB::table('icons')->insert(array('nombre'=>'Transporte - Camion', 'class'=>'fa fa-truck', 'grupo'=>2));
        DB::table('icons')->insert(array('nombre'=>'Usuario - Usuario Fondo', 'class'=>'fa fa-user', 'grupo'=>1));
        DB::table('icons')->insert(array('nombre'=>'Usuario - Usuario Circulo Fondo', 'class'=>'fa fa-user-circle', 'grupo'=>1));
        DB::table('icons')->insert(array('nombre'=>'Usuario - Usuario Circulo', 'class'=>'fa fa-user-circle-o', 'grupo'=>1));
        DB::table('icons')->insert(array('nombre'=>'Usuario - Usuario', 'class'=>'fa fa-user-o', 'grupo'=>1));

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('icons');
    }
}
