<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DriversController extends Controller
{
    //
    /*********************************************
     *********************************************
     * Creacion y administracion de conductores***
     *********************************************
     *********************************************/

    public function conductor(){
        if (Auth::user()->perfil!==3) {
            $conductores = App\User::where([['id', '!=', Auth::user()->id], ['perfil', '=', '3']])->paginate(5);
            $perfiles = App\Profile::all();
            $estados = App\DriversStatus::all();

            return view('conductores', compact('conductores', 'perfiles', 'estados'));
        }else{
            return redirect('home');
        }
    }

    public function detalle($id=null){
        $conductor = App\User::findOrFail($id);

        if ($conductor->perfil==3) {
            return view('conductores.detalle', compact('conductor'));
        }else{
            return redirect('conductores');
        }

        
    }

    public function creaCond(){
        $perfiles = App\Profile::where('id', '=', '3')->get();

        return view('conductores.create', compact('perfiles'));
    }

    public function crearCond(Request $request){
       // return$request->all();

        $verificacion = App\User::where('document', '=', $request->document)->first();
        $verificacion2 = App\User::where('email', '=', $request->email)->first();

        //var_dump($verificacion2);exit();
        if ($verificacion==null) {
            if ($verificacion2==null) {
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
                $conductor->lastname=$request->lastname . ' ' . $request->lastname2;
                $conductor->email=$request->email;
                $conductor->password=Hash::make($request['document']);
                $conductor->perfil='3';
                $conductor->estado='1';
                $conductor->nuevo='1';

                $conductor->save();

                return redirect('conductores')->with('mensaje', 'Conductor ' . $request->name . ' ' . $request->lastname . ' creado con exito');
            }else{
                return redirect('conductores')->with('documento', 'El correo que ingresaste ya existe, verifica los datos');    
            }
        }else{
            return redirect('conductores')->with('documento', 'El documento que ingresaste ya existe, verifica los datos');
        }
    }

    public function editaCon($id){
        $conductor = App\User::findOrFail($id);
        $perfiles = App\Profile::where('id', '=', '3')->get();
        $estados = App\DriversStatus::where('id', '<', '2')->get();

        if ($conductor->perfil==3) {
            return view('conductores.edita', compact('conductor', 'perfiles', 'estados'));
        }else{
            return redirect('conductores');
        }
        
    }

    public function editarCond(Request $request, $id){
        $conductor = App\User::findOrFail($id);
        $conductor->name = $request->name;
        $conductor->lastname = $request->lastname;
        $conductor->email = $request->email;
        $conductor->perfil = '3';
        $conductor->estado = $request->estado;

        $conductor->save();

        $vehiculo = App\TaxiDriver::where('idCond', '=', $id)->first();
        if ($vehiculo!==null) {
            if ($request->estado==0) {
                $vehiculo->estado='0';
                $vehiculo->save();
            }
        }

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
}
