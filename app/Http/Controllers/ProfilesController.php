<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfilesController extends Controller
{
    //
    /*************************************************
     *************************************************
     * Creacion y administracion de Perfiles**********
     *************************************************
     *************************************************/

    public function perfiles(){
        $perfiles = App\Profile::all();

        return view('perfiles', compact('perfiles'));
    }

    public function editaPerfil($id){
        $perfil = App\Profile::findOrFail($id);

        return view('administrativo.perfiles.edit', compact('perfil'));
    }

    public function editarPerfil(Request $request, $id){
        $perfil = App\Profile::findOrFail($id);

        $perfil->nombrePerfil=$request->nombre;
        $perfil->estado = $request->estado;
        
        $perfil->save();

        return redirect('administrativo/perfiles')->with('mensaje', 'Se edito el perfil con exito');

    }
}
