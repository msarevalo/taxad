<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Home extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function inicio(){
        if (Auth::user()->nuevo===1) {
        	return view('/cambio');
        }else{
        	return view('/home');
    	}
    }
}
