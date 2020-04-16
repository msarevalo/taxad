<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PartnerController extends Controller
{
    //

    /*************************************************
     *************************************************
     * Creacion y administracion de Socios************
     *************************************************
     *************************************************/

    public function socio(){
        if (Auth::user()->perfil!==3) {
            $socios = App\User::where('perfil', '=', '4')->paginate(5);
            $perfiles = App\Profile::all();

            return view('socios', compact('socios', 'perfiles'));
        }else{
            return redirect('home');
        }
    }
}
