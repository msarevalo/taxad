<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use Illuminate\Support\Facades\DB;

class PagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function inicio(){
        return view('welcome');
    }

    public function login(){
        return view('login');
    }

    public function registro(){
        return view('registro');
    }

    /*********************************************
     *********************************************
     * Creacion y administracion de conductores***
     *********************************************
     *********************************************/

    public function conductor(){
        $conductores = App\Conductor::paginate(5);

        return view('conductores', compact('conductores'));
    }

    public function creacond(){
        return view('conductores.create');
    }


    public function detalle($id=null){
        $conductor = App\Conductor::findOrFail($id);

        return view('conductores.detalle', compact('conductor'));
    }

    public function editacon($id){
        $conductor = App\Conductor::findOrFail($id);

        return view('conductores.edita', compact('conductor'));
    }

    public function crearcond(Request $request){
       // return$request->all();
        $conductor = new App\Conductor;
        $conductor->documento=$request->documento;
        $conductor->nombres=$request->nombres;
        $conductor->apellidos=$request->apellidos;
        $conductor->estado='1';

        $conductor->save();

        return redirect('conductores')->with('mensaje', 'Conductor ' . $request->nombres . ' creado con exito');
    }

    public function editarcond(Request $request, $id){
        $conductor = App\Conductor::findOrFail($id);
        $conductor->nombres = $request->nombres;
        $conductor->apellidos = $request->apellidos;
        $conductor->estado = $request->estado;

        $conductor->save();

        return redirect('conductores')->with('mensaje', 'Conductor ' . $request->nombres . ' actualizado con exito');

    }

    public function permitir($id){
        $conductor = App\Conductor::findOrFail($id);
        $conductor->estado = 1;

        $conductor->save();

        return redirect('conductores')->with('mensaje', 'Conductor ' . $conductor->nombres . ' actualizado con exito');

    }

    public function negar($id){
        $conductor = App\Conductor::findOrFail($id);

        $conductor->delete();

        return redirect('conductores')->with('mensaje-delete', 'Conductor ' . $conductor->nombres . ' eliminado con exito');

    }

    /*********************************************
     *********************************************
     * Creacion y administracion de taxis*********
     *********************************************
     *********************************************/

    public function taxi(){

        $taxdet = DB::table('taxis')
            ->join('marcas__taxis', 'taxis.marca', '=', 'marcas__taxis.id')
            ->select('taxis.id', 'taxis.placa', 'marcas__taxis.marca as marca', 'taxis.modelo', 'taxis.serie', 'taxis.estado', 'taxis.created_at')
            ->paginate(5);

        $conductores = DB::table('conductores__taxis')
            ->join('conductors', 'conductors.id', '=', 'conductores__taxis.idCond')
            ->select('conductores__taxis.idTaxi', 'conductors.nombres', 'conductors.apellidos')
            ->get();

        return view('taxis', compact('taxdet'), compact('conductores'));
    }

    public function detalletax($id=null){
        $taxi = App\Taxi::findOrFail($id);

        return view('taxis.detalle', compact('taxi'));
    }

    public function creatax(){
        $marcas = App\Marcas_Taxi::where('estado', 1)->orderBy('marca', 'asc')->get();

        return view('taxis.create', compact('marcas'));
    }

    public function creartax(Request $request){
        // return$request->all();
        $taxi = new App\Taxi();
        $taxi->placa=$request->placa;
        $taxi->marca=$request->marca;
        $taxi->modelo=$request->modelo;
        $taxi->serie=$request->serie;
        $taxi->estado='1';

        $taxi->save();

        return redirect('taxis')->with('mensaje', 'Vehiculo ' . $request->modelo . ' - ' . $request->placa . ' creado con exito');
    }

    public function editatax($id){
        $taxi = App\Taxi::findOrFail($id);
        $marcas = App\Marcas_Taxi::where('estado', 1)->orderBy('marca', 'asc')->get();

        return view('taxis.edita', compact('taxi'), compact('marcas'));
    }

    public function asignatax($id){
        $taxi = App\Taxi::findOrFail($id);
        $conductores = App\Conductor::where('estado', 1)->orderBy('nombres', 'asc')->get();

        return view('taxis.asigna', compact('taxi'), compact('conductores'));
    }

    public function asignartax(Request $request, $id){
        $asignar = new App\Conductores_Taxi();
        $asignar->idTaxi=$id;
        $asignar->idCond=$request->idCond;

        $asignar->save();

        return redirect('taxis')->with('mensaje', 'Asignacion realizada con exito');
    }

    public function editartax(Request $request, $id){
        $taxi = App\Taxi::findOrFail($id);
        /*echo $request->marca;
        echo $request->modelo;
        echo $request->serie;
        echo $request->estado;*/
        $taxi->marca = $request->marca;
        $taxi->modelo = $request->modelo;
        $taxi->serie = $request->serie;
        $taxi->estado = $request->estado;

        $taxi->save();

        return redirect('taxis')->with('mensaje', 'Taxi ' . $request->marca . ' - ' . $taxi->placa . ' actualizado con exito');
    }

    /*************************************************
     *************************************************
     * Creacion y administracion de Marcas Vehiculos**
     *************************************************
     *************************************************/

    public function marca(){
        $marcas = App\Marcas_Taxi::paginate(5);

        return view('taxis/marcas', compact('marcas'));
    }

    public function creamarca(){

        return view('taxis.marcas.create');
    }

    public function crearmarca(Request $request){
        // return$request->all();
        $marca = new App\Marcas_Taxi();
        $marca->marca=$request->marca;
        $marca->estado='1';

        $marca->save();

        return redirect('taxis/marcas')->with('mensaje', 'Marca ' . $request->marca . ' creada con exito');
    }

    public function detallemarca($id=null){
        $marca = App\Marcas_Taxi::findOrFail($id);

        return view('taxis.marcas.detalle', compact('marca'));
    }

    public function editamarca($id){
        $marca = App\Marcas_Taxi::findOrFail($id);

        return view('taxis.marcas.edita', compact('marca'));
    }

    public function editarmarca(Request $request, $id){
        $marca = App\Marcas_Taxi::findOrFail($id);
        $marca->marca = $request->marca;
        $marca->estado = $request->estado;

        $marca->save();

        return redirect('taxis/marcas')->with('mensaje', 'Taxi ' . $request->marca . ' actualizada con exito');
    }
}
