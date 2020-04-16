<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PermissionsController extends Controller
{
    //
    /*************************************************
     *************************************************
     * Creacion y administracion de Permisos**********
     *************************************************
     *************************************************/

    public function permisos(){
        $menus = App\Menu::count();
        $permisos = DB::table('permissions')
                        ->select(DB::raw('perfil, count(*) as conteo'))
                        ->where('ver', '=', 1)
                        ->groupBy('perfil')->get();
        $listap = App\Profile::where('estado', '=', 1)->get();

        return view('permisos', compact('menus', 'permisos', 'listap'));
    }

    public function configuraPermisos($id){
        $perfil = App\Permission::where([['perfil', '=', $id], ['menu', '<>', 1], ['menu', '<>', 21]])->get();
        $nombre = App\Profile::findOrFail($id);
        $menus = App\Menu::select('id', 'nombre')->where([['nombre', '<>', 'Perfil'], ['nombre', '<>', 'Cerrar Sesión']])->paginate(5);

        return view('administrativo.permisos.configurar', compact('perfil', 'menus', 'nombre'));
    }
}
