<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use App\Notification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class MessagesController extends Controller
{
    //
    public function buzon(){
		$mensajes = DB::table('messages')
            ->join('users', 'users.username', '=', 'messages.user')
            ->select('messages.id as id', 'users.username as username', 'users.name as nombre', 'users.lastname as apellidos', 'messages.message as mensaje', 'messages.date as fecha')
            ->orderBy('id', 'desc')->paginate(7);

        $notificaciones = App\Notification::get();
        
    	return view('buzon', compact('mensajes', 'notificaciones'));
    }

    public function leido(Request $request){
    	$mensaje = App\Notification::where('mensaje', '=', $request->mensaje)->first();
    	$usuario = $request->user;

    	$userenvio;
    	if ($mensaje->lectores==NULL) {
            $userenvio=$usuario . "_";
        }else{
            $user = explode("_", $mensaje->lectores);
            $contador=0;
            for($i=0; $i<sizeof($user); $i++){
               	if ($user[$i]==$usuario) {
                    $contador++;
                }
            }
            if ($contador==0) {
            	$lectores = $mensaje->lectores . $usuario . "_";
            	$userenvio=$lectores;
            }
        }
        $data = array('lectores'=>$userenvio);
        Notification::leido($mensaje->id, $data);
      	/*echo 'Update successfully.';

      	exit;
      	/*$not = App\Notification::findOrFail($mensaje->id);
      	$not->usuario_envia=="prueba";
      	$not->save();

      	return redirect('/home');*/

    }
}
