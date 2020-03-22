<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    //

    public function menus(){
        $menu = App\Menu::where('submenu', '=', 0)->orderby('orden', 'asc')->orderby('id', 'asc')->get();
        return $menu;
    }

    public function hijos($id){
        $menu = App\Menu::where([['submenu', '=', 1], ['menu_padre', '=', $id]])->orderby('orden', 'asc')->get();
        return $menu;
    }

    public function separador(){
    	$separa = App\Separator::where('estado', '=', 1)->get();
    	return $separa;
    }

}

$items = new MenuController;
