<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ExpensesCategoryController extends Controller
{
    //
    public function categoria(){
        $categorias = App\ExpenseCategory::orderBy('categoria')->paginate(10);

        return view('categorias', compact('categorias'));
    }

    public function destalleCategoria($id){
        $categoria = App\ExpenseCategory::findOrFail($id);
        $descripciones = App\ExpenseDescription::where('categoria', '=', $id)->orderBy('descripcion')->paginate(5);

        return view('taxis.categorias.detalle', compact('categoria', 'descripciones'));
    }
}
