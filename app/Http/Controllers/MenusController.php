<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class MenusController extends Controller
{
    //
    /*************************************************
     *************************************************
     * Creacion y administracion de Menus*************
     *************************************************
     *************************************************/
    
    public function menus(){
        $menus = App\Menu::paginate(10);
        $padres = App\Menu::where([['submenu', '=', 0], ['nombre', 'not like', '%Cerrar Sesión%']])->get();

        return view('menus', compact('menus', 'padres'));
    }

    public function editaMenu($id){
        $menu = App\Menu::findOrFail($id);
        $padres = App\Menu::where('submenu', '=', 0)->get();
        $iconos = App\Icon::orderBy('nombre', 'asc')->get();
        $grupos = App\IconGroup::orderBy('nombre', 'asc')->get();

        if ($menu->nombre=="Perfil") {
            return redirect('administrativo/menus')->with('negar', 'Este menu no se puede editar');
        }elseif ($menu->nombre=="Cerrar Sesión") {
            return redirect('administrativo/menus')->with('negar', 'Este menu no se puede editar');
        }elseif ($menu->nombre=="Menús") {
            return redirect('administrativo/menus')->with('negar', 'Este menu no se puede editar');
        }else{
            return view('administrativo.menu.edit', compact('menu', 'padres', 'iconos', 'grupos'));
        }
    }

    public function menuPadre(){
        return App\Menu::where('submenu', '=', 0)->get();
    }

    public function editarMenu(Request $request, $id){
        $menu = App\Menu::findOrFail($id);

        $menu->nombre=$request->nombre;
        $menu->submenu=$request->submenu;
        $padre = $request->padre;
        $icono = $request->iconos;
        if ($request->submenu==0) {
            $padre = NULL;
        }else{
            $icono = NULL;
        }
        $menu->menu_padre=$padre;
        $menu->class=$icono;
        $menu->orden=$request->orden;

        $menu->save();

        return redirect('administrativo/menus')->with('mensaje', 'Se edito el menú con exito');

    }

    /*************************************************
     *************************************************
     * Creacion y administracion de Separadores*******
     *************************************************
     *************************************************/
    public function separadores(){
        $separadores = App\Separator::all();
        $menu = App\Menu::select('id', 'nombre')->get();

        return view('separadores', compact('separadores', 'menu'));
    }

    public function editaSepara($id){
        $separador = App\Separator::findOrFail($id);
        $padres = App\Menu::where('submenu', '=', 0)->get();

        return view('administrativo.separador.edit', compact('separador', 'padres'));
    }

    public function editarSepara(Request $request, $id){
        $separador = App\Separator::findOrFail($id);

        $separador->nombre=$request->nombre;
        $separador->menu_posterior=$request->menu;
        $separador->estado = $request->estado;
        
        $separador->save();

        return redirect('administrativo/separadores')->with('mensaje', 'Se edito el menú con exito');

    }

    public function creaSepara(){
        $padres = App\Menu::where('submenu', '=', 0)->get();

        return view('administrativo.separador.create', compact('padres'));
    }

    public function crearSepara(Request $request){
        $separador = new App\Separator();
        $separador->nombre=$request->nombre;
        $separador->menu_posterior=$request->menu;
        
        $separador->save();

        return redirect('administrativo/separadores')->with('mensaje', 'El separador fue agregado con exito');
    }
}
