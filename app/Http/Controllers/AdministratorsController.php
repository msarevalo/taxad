<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdministratorsController extends Controller
{
    //

    /*************************************************
     *************************************************
     * Creacion y administracion de Administradores***
     *************************************************
     *************************************************/

    public function administrador(){
        if (Auth::user()->perfil!==3) {
            $administradores = App\User::where([['id', '!=', Auth::user()->id], ['perfil', '>=', Auth::user()->perfil], ['perfil', '!=', '3']])->paginate(5);
            $perfiles = App\Profile::all();
            $estados = App\DriversStatus::all();

            return view('administradores', compact('administradores', 'perfiles', 'estados'));
        }else{
            return redirect('home');
        }
    }

    public function creaAdmin(){
        $perfiles = App\Profile::where([['id', '>=', Auth::user()->perfil], ['id', '!=', '3']])->get();

        return view('administradores.create', compact('perfiles'));
    }

    public function crearAdmin(Request $request){
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
                $conductor->perfil=$request->perfil;
                $conductor->estado='1';
                $conductor->nuevo='1';

                $conductor->save();

                return redirect('administradores')->with('mensaje', 'Administrador ' . $request->name . ' ' . $request->lastname . ' creado con exito');
            }else{
                return redirect('administradores')->with('documento', 'El correo que ingresaste ya existen, verifica los datos');    
            }
        }else{
            return redirect('administradores')->with('documento', 'El documento que ingresaste ya existen, verifica los datos');
        }
    }

    public function detalleAdmin($id=null){
        $conductor = App\User::findOrFail($id);

        if ($conductor->perfil!==3) {
            return view('administradores.detalle', compact('conductor'));
        }else{
            return redirect('administradores');
        } 
    }

    public function editaAdmin($id){
        $conductor = App\User::findOrFail($id);
        $perfiles = App\Profile::where([['id', '>=', Auth::user()->perfil], ['id', '!=', '3']])->get();
        $estados = App\DriversStatus::all();

        if ($conductor->perfil!==3) {
            return view('administradores.edita', compact('conductor', 'perfiles', 'estados'));
        }else{
            return redirect('administradores');
        }
    }

    public function editarAdmin(Request $request, $id){
        $conductor = App\User::findOrFail($id);
        $conductor->name = $request->name;
        $conductor->lastname = $request->lastname;
        $conductor->email = $request->email;
        $conductor->perfil = $request->perfil;
        $conductor->estado = $request->estado;

        $conductor->save();

        return redirect('administradores')->with('mensaje', 'Conductor ' . $request->name . ' actualizado con exito');
    }
}
