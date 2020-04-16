<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class BrandsController extends Controller
{
    //
    /*************************************************
     *************************************************
     * Creacion y administracion de Marcas Vehiculos**
     *************************************************
     *************************************************/

    public function marca(){
        $marcas = App\TaxiBrand::paginate(5);

        return view('taxis/marcas', compact('marcas'));
    }

    public function creaMarca(){

        return view('taxis.marcas.create');
    }

    public function crearMarca(Request $request){
        // return$request->all();
        $marca = new App\TaxiBrand();
        $marca->marca=$request->marca;
        $marca->estado='1';

        $marca->save();

        return redirect(route('marcas'))->with('mensaje', 'Marca ' . $request->marca . ' creada con exito');
    }

    public function detalleMarca($id=null){
        $marca = App\TaxiBrand::findOrFail($id);

        return view('taxis.marcas.detalle', compact('marca'));
    }

    public function editaMarca($id){
        $marca = App\TaxiBrand::findOrFail($id);

        return view('taxis.marcas.edita', compact('marca'));
    }

    public function editarMarca(Request $request, $id){
        $vehiculos = App\taxi::where('marca', '=', $id)->first();
        var_dump($vehiculos);
        if ($request->estado==0) {
            if ($vehiculos==null) {
                $marca = App\TaxiBrand::findOrFail($id);
                $marca->marca = $request->marca;
                $marca->estado = $request->estado;

                $marca->save();

                return redirect('taxis/marcas')->with('mensaje', 'Marca ' . $request->marca . ' actualizada con exito');
            }else{
                return redirect('taxis/marcas')->with('error', 'No se puede inactivar la marca ' . $request->marca . ' pues tiene vehiculos asociados');
            }
        }else{
            $marca = App\TaxiBrand::findOrFail($id);
                $marca->marca = $request->marca;
                $marca->estado = $request->estado;

                $marca->save();

                return redirect('taxis/marcas')->with('mensaje', 'Marca ' . $request->marca . ' actualizada con exito');
        }
        
    }
}
