<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RatesController extends Controller
{
    //
    /*************************************************
     *************************************************
     * Creacion y administracion de Tarifas***********
     *************************************************
     *************************************************/

    public function tarifa(){
        $tarifas = App\Rate::get();

        return view('tarifas', compact('tarifas'));
    }

    public function editaTarifa(){
        $tarifas = App\Rate::get();

        return view('taxis.tarifas.edit', compact('tarifas'));
    }

    public function editarTarifa(Request $request){

        $lunes = App\Rate::findOrFail(1);
        $lunes->tarifa=$request->Lunes;
        $lunes->save();

        $martes = App\Rate::findOrFail(2);
        $martes->tarifa=$request->Martes;
        $martes->save();

        $miercoles = App\Rate::findOrFail(3);
        $miercoles->tarifa=$request->Miercoles;
        $miercoles->save();

        $jueves = App\Rate::findOrFail(4);
        $jueves->tarifa=$request->Jueves;
        $jueves->save();

        $viernes = App\Rate::findOrFail(5);
        $viernes->tarifa=$request->Viernes;
        $viernes->save();

        $sabado = App\Rate::findOrFail(6);
        $sabado->tarifa=$request->Sabado;
        $sabado->save();

        $domingo = App\Rate::findOrFail(7);
        $domingo->tarifa=$request->Domingo;
        $domingo->save();

        return redirect('tarifa')->with('mensaje', 'Las tarifas se han actualizado con exito');

    }

}
