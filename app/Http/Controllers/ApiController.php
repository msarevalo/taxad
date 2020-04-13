<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use Illuminate\Support\Facades\Hash;

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
}