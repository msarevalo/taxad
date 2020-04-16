<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    //
    public function encrip($id){
    	$prueba = Hash::make($id);
    	return $prueba;
    }

    public function categorias(){
    	$categorias = App\ExpenseCategory::where('estado', '=', 1)->orderBy('categoria', 'asc')->get();

    	return $categorias;
    }

    public function descripciones($id){
    	$descripciones = App\ExpenseDescription::where([['estado', '=', 1], ['categoria', '=', $id]])->orderBy('descripcion', 'asc')->get();

    	return $descripciones;
    }

    public function notificaciones($id){
        $permisos = DB::table('notifications')
                        ->select(DB::raw('count(id) as conteo'))
                        ->where('lectores', 'NOT LIKE', '%'.$id.'%')->orWhereNull('lectores')->get();
        //return App\Notification::count('lectores', 'NOT LIKE', $id)->get();
        return $permisos;
    }

    public function leido($id){
        $mensaje = App\Notification::findOrFail();
        $usuario = $id;
        if ($mensaje->lectores==NULL) {
            $mensaje->lectores==$usuario."_";
        }else{

            $mensaje->lectores==$usuario."_";
        }

        $mensaje->save();

    }

}