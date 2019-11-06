<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
        if (Auth::user()->perfil!==3) {
            $conductores = App\User::where('id', '!=', Auth::user()->id)->paginate(5);
            $perfiles = App\Perfil::all();
            $estados = App\estados_conductor::all();

            return view('conductores', compact('conductores', 'perfiles', 'estados'));
        }else{
            return redirect('home');
        }
    }

    public function creacond(){
        $perfiles = App\Perfil::where('id', '=', '3')->get();

        return view('conductores.create', compact('perfiles'));
    }


    public function detalle($id=null){
        $conductor = App\User::findOrFail($id);

        return view('conductores.detalle', compact('conductor'));
    }

    public function editacon($id){
        $conductor = App\User::findOrFail($id);
        $perfiles = App\Perfil::where('id', '=', '3')->get();
        $estados = App\estados_conductor::all();

        return view('conductores.edita', compact('conductor', 'perfiles', 'estados'));
    }

    public function crearcond(Request $request){
       // return$request->all();

        $apellido1=explode(" ", $request['lastname']);
        $usuario = $request['name'][0] . $apellido1[0];

        $existe = App\User::where('username', '=', $usuario)->first();;

        $contador1 = strlen($request['name'])-1;
        $contador2 = strlen($request['lastname2'])-1;

        $cont1 = 0;
        $cont2=0;

        while ($existe!==null) {
            if ($cont1==$cont2) {
                $usuario = substr($request['name'],0, -$contador1) . $apellido1[0] . substr($request['lastname2'],0, -$contador2);
                $existe = App\User::where('username', '=', $usuario)->first();
                $contador1--;
                $cont1++;
            }else{
                $usuario = substr($request['name'],0, -$contador1) . $apellido1[0] . substr($request['lastname2'],0, -$contador2);
                $existe = App\User::where('username', '=', $usuario)->first();
                $contador2--;
                $cont2++;
            }
        }

        $conductor = new App\User;
        $conductor->username=strtolower($usuario);
        $conductor->document=$request->document;
        $conductor->name=$request->name;
        $conductor->lastname=$request->lastname;
        $conductor->lastname2=$request->lastname2;
        $conductor->email=$request->email;
        $conductor->password=Hash::make($request['document']);
        $conductor->perfil='3';
        $conductor->estado='1';
        $conductor->nuevo='1';

        $conductor->save();

        return redirect('conductores')->with('mensaje', 'Conductor ' . $request->name . ' ' . $request->lastname . ' creado con exito');
    }

    public function editarcond(Request $request, $id){
        $conductor = App\User::findOrFail($id);
        $conductor->name = $request->name;
        $conductor->lastname = $request->lastname;
        $conductor->lastname2 = $request->lastname2;
        $conductor->email = $request->email;
        $conductor->perfil = '3';
        $conductor->estado = $request->estado;

        $conductor->save();

        return redirect('conductores')->with('mensaje', 'Conductor ' . $request->name . ' actualizado con exito');

    }

    public function permitir($id){
        $conductor = App\User::findOrFail($id);
        $conductor->estado = 1;

        $conductor->save();

        return redirect('conductores')->with('mensaje', 'Conductor ' . $conductor->name . ' actualizado con exito');

    }

    public function negar($id){
        $conductor = App\User::findOrFail($id);

        $conductor->delete();

        return redirect('conductores')->with('mensaje-delete', 'Conductor ' . $conductor->name . ' eliminado con exito');

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
            ->join('users', 'users.id', '=', 'conductores__taxis.idCond')
            ->select('conductores__taxis.idTaxi', 'users.name', 'users.lastname')
            ->where('users.estado', '=', '1')
            ->get();

        return view('taxis', compact('taxdet', 'conductores'));
    }

    public function detalletax($id=null){
        $taxi = App\Taxi::findOrFail($id);

        return view('taxis.detalle', compact('taxi'));
    }

    public function creatax(){
        $marcas = App\Marcas_Taxi::where('estado', 1)->orderBy('marca', 'asc')->get();
        $marca = App\Marcas_Taxi::where('estado', '=', 1)->first();

        //var_dump($marca);

        if ($marca!==null) {
            return view('taxis.create', compact('marcas'));
        }else{
            return redirect('taxis/marcas/create')->with('sinMarca', 'Es necesario la creacion de una marca para poder crear un vehiculo');
        }

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

        return view('taxis.edita', compact('taxi', 'marcas'));
    }

    public function asignatax($id){
        $taxi = App\Taxi::findOrFail($id);
        $conductores = App\User::where([['estado', '=', 1], ['perfil', '=', 3]])->orderBy('name', 'asc')->get();
        $conductor = App\User::where([['estado', '=', 1], ['perfil', '=', 3]])->first();

        if ($conductor!==null) {
            return view('taxis.asigna', compact('taxi', 'conductores'));
        }else{
            return redirect('conductores/create')->with('sinUsuario', 'Es necesario la creacion de un conductor para poder asignar un vehiculo');
        }
    }

    public function asignartax(Request $request, $id){
        
        for ($i=0; $i < sizeof($request->idCond); $i++) { 
            $asignar = new App\Conductores_Taxi();
            $asignar->idTaxi=$id;
            $asignar->idCond=$request->idCond[$i];

            $asignar->save();
        }        

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
