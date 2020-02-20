<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function inicio(){
        return view('login');
    }

    public function login(){
        return view('login');
    }

    public function registro(){
        return view('registro');
    }

    public function cambiar(Request $request){
        if ($request->npass===$request->rpass) {
            $usuario = App\User::findOrFail(Auth::user()->id);
            $usuario->password=Hash::make($request->npass);
            $usuario->nuevo='0';

            $usuario->save();

            return redirect('home');

        }else{
            return redirect('/')->with('error', 'Las constraseñas no coinsiden');            
        }
    }

    /*********************************************
     *********************************************
     * Creacion y administracion de conductores***
     *********************************************
     *********************************************/

    public function conductor(){
        if (Auth::user()->perfil!==3) {
            $conductores = App\User::where([['id', '!=', Auth::user()->id], ['perfil', '=', '3']])->paginate(5);
            $perfiles = App\Perfil::all();
            $estados = App\estados_conductor::all();

            return view('conductores', compact('conductores', 'perfiles', 'estados'));
        }else{
            return redirect('home');
        }
    }

    public function creacond(){
        $perfiles = App\Perfil::where('id', '=', '3')->get();

        return view('conductores.create', compact('perfiles'));
    }


    public function detalle($id=null){
        $conductor = App\User::findOrFail($id);

        if ($conductor->perfil==3) {
            return view('conductores.detalle', compact('conductor'));
        }else{
            return redirect('conductores');
        }

        
    }

    public function editacon($id){
        $conductor = App\User::findOrFail($id);
        $perfiles = App\Perfil::where('id', '=', '3')->get();
        $estados = App\estados_conductor::where('id', '<', '2')->get();

        if ($conductor->perfil==3) {
            return view('conductores.edita', compact('conductor', 'perfiles', 'estados'));
        }else{
            return redirect('conductores');
        }
        
    }

    public function crearcond(Request $request){
       // return$request->all();

        $verificacion = App\User::where('document', '=', $request->document)->first();
        $verificacion2 = App\User::where('email', '=', $request->email)->first();

        //var_dump($verificacion2);exit();
        if ($verificacion==null) {
            if ($verificacion2==null) {
                $apellido1=explode(" ", $request['lastname']);
                $usuario = $request['name'][0] . $apellido1[0];

                $existe = App\User::where('username', '=', $usuario)->first();;

                $contador1 = strlen($request['name'])-1;
                $contador2 = strlen($request['lastname2'])-1;

                $cont1 = 0;
                $cont2=0;

                while ($existe!==null) {
                    if ($cont1==$cont2) {
                        $usuario = substr($request['name'],0, -$contador1) . $apellido1[0] . substr($request['lastname2'],0, -$contador2);
                        $existe = App\User::where('username', '=', $usuario)->first();
                        $contador1--;
                        $cont1++;
                    }else{
                        $usuario = substr($request['name'],0, -$contador1) . $apellido1[0] . substr($request['lastname2'],0, -$contador2);
                        $existe = App\User::where('username', '=', $usuario)->first();
                        $contador2--;
                        $cont2++;
                    }
                }

                $conductor = new App\User;
                $conductor->username=strtolower($usuario);
                $conductor->document=$request->document;
                $conductor->name=$request->name;
                $conductor->lastname=$request->lastname;
                $conductor->lastname2=$request->lastname2;
                $conductor->email=$request->email;
                $conductor->password=Hash::make($request['document']);
                $conductor->perfil='3';
                $conductor->estado='1';
                $conductor->nuevo='1';

                $conductor->save();

                return redirect('conductores')->with('mensaje', 'Conductor ' . $request->name . ' ' . $request->lastname . ' creado con exito');
            }else{
                return redirect('conductores')->with('documento', 'El correo que ingresaste ya existe, verifica los datos');    
            }
        }else{
            return redirect('conductores')->with('documento', 'El documento que ingresaste ya existe, verifica los datos');
        }
    }

    public function editarcond(Request $request, $id){
        $conductor = App\User::findOrFail($id);
        $conductor->name = $request->name;
        $conductor->lastname = $request->lastname;
        $conductor->lastname2 = $request->lastname2;
        $conductor->email = $request->email;
        $conductor->perfil = '3';
        $conductor->estado = $request->estado;

        $conductor->save();

        $vehiculo = App\Conductores_Taxi::where('idCond', '=', $id)->first();
        if ($vehiculo!==null) {
            if ($request->estado==0) {
                $vehiculo->estado='0';
                $vehiculo->save();
            }
        }

        return redirect('conductores')->with('mensaje', 'Conductor ' . $request->name . ' actualizado con exito');

    }

    public function permitir($id){
        $conductor = App\User::findOrFail($id);
        $conductor->estado = 1;

        $conductor->save();

        return redirect('conductores')->with('mensaje', 'Conductor ' . $conductor->name . ' actualizado con exito');

    }

    public function negar($id){
        $conductor = App\User::findOrFail($id);

        $conductor->delete();

        return redirect('conductores')->with('mensaje-delete', 'Conductor ' . $conductor->name . ' eliminado con exito');

    }

    /*************************************************
     *************************************************
     * Creacion y administracion de Administradores***
     *************************************************
     *************************************************/

    public function administrador(){
        if (Auth::user()->perfil!==3) {
            $administradores = App\User::where([['id', '!=', Auth::user()->id], ['perfil', '>=', Auth::user()->perfil], ['perfil', '!=', '3']])->paginate(5);
            $perfiles = App\Perfil::all();
            $estados = App\estados_conductor::all();

            return view('administradores', compact('administradores', 'perfiles', 'estados'));
        }else{
            return redirect('home');
        }
    }

    public function creaadmin(){
        $perfiles = App\Perfil::where([['id', '>=', Auth::user()->perfil], ['id', '!=', '3']])->get();

        return view('administradores.create', compact('perfiles'));
    }

    public function crearadmin(Request $request){
       // return$request->all();
        $verificacion = App\User::where('document', '=', $request->document)->first();
        $verificacion2 = App\User::where('email', '=', $request->email)->first();

        //var_dump($verificacion2);exit();
        if ($verificacion==null) {
            if ($verificacion2==null) {
                $apellido1=explode(" ", $request['lastname']);
                $usuario = $request['name'][0] . $apellido1[0];

                $existe = App\User::where('username', '=', $usuario)->first();;

                $contador1 = strlen($request['name'])-1;
                $contador2 = strlen($request['lastname2'])-1;

                $cont1 = 0;
                $cont2=0;

                while ($existe!==null) {
                    if ($cont1==$cont2) {
                        $usuario = substr($request['name'],0, -$contador1) . $apellido1[0] . substr($request['lastname2'],0, -$contador2);
                        $existe = App\User::where('username', '=', $usuario)->first();
                        $contador1--;
                        $cont1++;
                    }else{
                        $usuario = substr($request['name'],0, -$contador1) . $apellido1[0] . substr($request['lastname2'],0, -$contador2);
                        $existe = App\User::where('username', '=', $usuario)->first();
                        $contador2--;
                        $cont2++;
                    }
                }

                $conductor = new App\User;
                $conductor->username=strtolower($usuario);
                $conductor->document=$request->document;
                $conductor->name=$request->name;
                $conductor->lastname=$request->lastname;
                $conductor->lastname2=$request->lastname2;
                $conductor->email=$request->email;
                $conductor->password=Hash::make($request['document']);
                $conductor->perfil=$request->perfil;
                $conductor->estado='1';
                $conductor->nuevo='1';

                $conductor->save();

                return redirect('administradores')->with('mensaje', 'Administrador ' . $request->name . ' ' . $request->lastname . ' creado con exito');
            }else{
                return redirect('administradores')->with('documento', 'El correo que ingresaste ya existen, verifica los datos');    
            }
        }else{
            return redirect('administradores')->with('documento', 'El documento que ingresaste ya existen, verifica los datos');
        }
    }

    public function detalleadmin($id=null){
        $conductor = App\User::findOrFail($id);

        if ($conductor->perfil!==3) {
            return view('administradores.detalle', compact('conductor'));
        }else{
            return redirect('administradores');
        } 
    }

    public function editaadmin($id){
        $conductor = App\User::findOrFail($id);
        $perfiles = App\Perfil::where([['id', '>=', Auth::user()->perfil], ['id', '!=', '3']])->get();
        $estados = App\estados_conductor::all();

        if ($conductor->perfil!==3) {
            return view('administradores.edita', compact('conductor', 'perfiles', 'estados'));
        }else{
            return redirect('administradores');
        }
    }

    public function editaradmin(Request $request, $id){
        $conductor = App\User::findOrFail($id);
        $conductor->name = $request->name;
        $conductor->lastname = $request->lastname;
        $conductor->lastname2 = $request->lastname2;
        $conductor->email = $request->email;
        $conductor->perfil = $request->perfil;
        $conductor->estado = $request->estado;

        $conductor->save();

        return redirect('administradores')->with('mensaje', 'Conductor ' . $request->name . ' actualizado con exito');
    }

    /*********************************************
     *********************************************
     * Creacion y administracion de taxis*********
     *********************************************
     *********************************************/

    public function taxi(){

        $taxdet = DB::table('taxis')
            ->join('marcas__taxis', 'taxis.marca', '=', 'marcas__taxis.id')
            ->select('taxis.id', 'taxis.placa', 'marcas__taxis.marca as marca', 'taxis.modelo', 'taxis.serie', 'taxis.estado', 'taxis.created_at')
            ->paginate(5);

        $conductores = DB::table('conductores__taxis')
            ->join('users', 'users.id', '=', 'conductores__taxis.idCond')
            ->select('conductores__taxis.idTaxi', 'conductores__taxis.estado', 'users.name', 'users.lastname')
            ->where([['users.estado', '=', '1'], ['users.perfil', '=', '3'], ['conductores__taxis.estado', '=', '1']])
            ->get();

        return view('taxis', compact('taxdet', 'conductores'));
    }

    public function detalletax($id=null){
        $taxi = App\Taxi::findOrFail($id);
        $marcas = App\Marcas_Taxi::where('estado', 1)->get();
        $conductores = DB::table('conductores__taxis')
            ->join('users', 'users.id', '=', 'conductores__taxis.idCond')
            ->select('conductores__taxis.idTaxi', 'conductores__taxis.estado', 'users.name', 'users.lastname', 'users.id')
            ->where([['users.estado', '=', '1'], ['users.perfil', '=', '3'], ['conductores__taxis.estado', '=', '1']])
            ->get();

        $registros = App\Registro::where('vehiculo', '=', $id)->orderBy('semana', 'desc')->limit(4)->get();

        return view('taxis.detalle', compact('taxi', 'marcas', 'conductores', 'registros'));
    }

    public function creatax(){
        $marcas = App\Marcas_Taxi::where('estado', 1)->orderBy('marca', 'asc')->get();
        $marca = App\Marcas_Taxi::where('estado', '=', 1)->first();

        //var_dump($marca);

        if ($marca!==null) {
            return view('taxis.create', compact('marcas'));
        }else{
            return redirect('marcas/create')->with('sinMarca', 'Es necesario la creacion de una marca para poder crear un vehiculo');
        }

    }

    public function creartax(Request $request){
        // return$request->all();
        $taxi = new App\Taxi();
        $taxi->placa=$request->placa;
        $taxi->marca=$request->marca;
        $taxi->modelo=$request->modelo;
        $taxi->serie=$request->serie;
        $taxi->estado='1';

        $taxi->save();

        return redirect('taxis')->with('mensaje', 'Vehiculo ' . $request->modelo . ' - ' . $request->placa . ' creado con exito');
    }

    public function editatax($id){
        $taxi = App\Taxi::findOrFail($id);

        $marcas = App\Marcas_Taxi::where('estado', '1')->orderBy('marca', 'asc')->get();

        $conductores = App\User::where([['estado', '=', '1'], ['perfil', '=', '3']])->orderBy('name', 'asc')->get();

        $asignacion = App\Conductores_Taxi::where([['estado', '=', '1'], ['idTaxi', '=', $id]])->get();

        $soat = App\documento::where([['vehiculo', '=', $id], ['tipo', '=', '1']])->orderBy('created_at', 'desc')->first();

        $tp = App\documento::where([['vehiculo', '=', $id], ['tipo', '=', '2']])->orderBy('created_at', 'desc')->first();

        $tarjeton = App\documento::where([['vehiculo', '=', $id], ['tipo', '=', '3']])->orderBy('created_at', 'desc')->first();

        return view('taxis.edita', compact('taxi', 'marcas', 'conductores', 'asignacion', 'soat', 'tp', 'tarjeton'));
    }

    public function asignatax($id){
        $taxi = App\Taxi::findOrFail($id);
        $conductores = App\User::where([['estado', '=', '1'], ['perfil', '=', '3']])->orderBy('name', 'asc')->get();
        $conductor = App\User::where([['estado', '=', '1'], ['perfil', '=', '3']])->first();

        if ($conductor!==null) {
            return view('taxis.asigna', compact('taxi', 'conductores'));
        }else{
            return redirect('conductores/create')->with('sinUsuario', 'Es necesario la creacion de un conductor para poder asignar un vehiculo');
        }
    }

    public function asignartax(Request $request, $id){
        if (!empty($request->idCond)) {
            if (sizeof($request->idCond)<=4){
            
                for ($i=0; $i < sizeof($request->idCond); $i++) { 
                    $comprobar = App\Conductores_Taxi::where([['idCond', '=', $request->idCond[$i]], ['idTaxi', '=', $id]])->first();

                    if ($comprobar==null) {
                        $asignar = new App\Conductores_Taxi();
                        $asignar->idTaxi=$id;
                        $asignar->idCond=$request->idCond[$i];
                        $asignar->estado='1';

                        $asignar->save();
                    }else{
                        $comprobar->estado='1';
                        $comprobar->save();
                    }

                    
                }        

                return redirect('taxis')->with('mensaje', 'Asignacion realizada con exito');
            }else{
                return redirect(route('taxi.asignar', $id))->with('error', 'No se pueden asignar mas de 4 conductores a un vehiculo');
            }
        }else{
            return redirect(route('taxi.asignar', $id))->with('error', 'No has seleccionado ningun conductor');
        }
    }

    public function editartax(Request $request, $id){
        $taxi = App\Taxi::findOrFail($id);
        /*echo $request->marca;
        echo $request->modelo;
        echo $request->serie;
        echo $request->estado;*/
        $taxi->marca = $request->marca;
        $taxi->modelo = $request->modelo;
        $taxi->serie = $request->serie;
        $taxi->estado = $request->estado;

        $taxi->save();

        for ($i=0; $i < sizeof($request->idCond); $i++) { 
            $comprobar = App\Conductores_Taxi::where([['idCond', '=', $request->idCond[$i]], ['idTaxi', '=', $id]])->first();

            if ($comprobar==null) {
                $asignar = new App\Conductores_Taxi();
                $asignar->idTaxi=$id;
                $asignar->idCond=$request->idCond[$i];
                $asignar->estado='1';

                $asignar->save();
            }else{
                $comprobar->estado='1';
                $comprobar->save();
            }
        }

        $asignaciones = App\Conductores_Taxi::where('estado', '=', '1')->get();

        foreach ($asignaciones as $asigna) {
            $valor = in_array($asigna->idCond, $request->idCond);
            if ($valor==null) {
                $taxi = App\Conductores_Taxi::findOrFail($asigna->id);
                $taxi->estado='0';
                $taxi->save();
            }
        }

        return redirect('taxis')->with('mensaje', 'Taxi ' . $request->modelo . ' - ' . $taxi->placa . ' actualizado con exito');
    }

    public function soat($id){
        $taxi = App\Taxi::findOrFail($id);
        $tipos = App\Tipo_documento::all();

        return view('taxis/documento', compact('taxi', 'tipos'));
    }

    public function soatcargar(Request $request, $id){
        //return $request;
        if ($request->hasFile('soat')) {
            $file = $request->file('soat');
            if ($request->tipo==1) {
                $name = 'soat-'.$id.'-'.time().'.pdf';
                $file->move(public_path().'/documentos/soat/', $name);
            }elseif ($request->tipo==2) {
                $name = 'tp-'.$id.'-'.time().'.pdf';
                $file->move(public_path().'/documentos/tp/', $name);
            }else{
                $name = 'tarjeton-'.$id.'-'.time().'.pdf';
                $file->move(public_path().'/documentos/tarjeton/', $name);
            }
        }
        $documento = new App\Documento();
        $documento->tipo = $request->tipo;
        $documento->vehiculo = $id;
        $documento->documento = $name;
        $documento->save();

        return redirect('taxis/edita/'.$id)->with('cargado', 'El SOAT fue cargado con exito');
    }

    public function reporta($id){
        $taxi = App\Taxi::findOrFail($id);
        $tarifas = App\Tarifa::get();

        return view('taxis/reportar', compact('taxi', 'tarifas', '$id'));
    }

    public function reportar(Request $request, $id){
        $validacion = App\Registro::where([['semana', '=', $request->semana], ['vehiculo', '=', $id]])->first();

        if ($validacion==null) {
            
            $reporte = new App\Registro();
            $reporte->vehiculo=$id;
            $reporte->semana=$request->semana;
            $reporte->domingo=$request->producidoD . ';' . $request->gastosD . ';' . $request->otrosD;
            $reporte->lunes=$request->producidoL . ';' . $request->gastosL . ';' . $request->otrosL;
            $reporte->martes=$request->producidoM . ';' . $request->gastosM . ';' . $request->otrosM;
            $reporte->miercoles=$request->producidoMi . ';' . $request->gastosMi . ';' . $request->otrosMi;
            $reporte->jueves=$request->producidoJ . ';' . $request->gastosJ . ';' . $request->otrosJ;
            $reporte->viernes=$request->producidoV . ';' . $request->gastosV . ';' . $request->otrosV;
            $reporte->sabado=$request->producidoS . ';' . $request->gastosS . ';' . $request->otrosS;
            
            $prod = $request->producidoD + $request->producidoL + $request->producidoM + $request->producidoMi + $request->producidoJ + $request->producidoV + $request->producidoS;
            $gastos = $request->gastosD + $request->otrosD + $request->gastosL + $request->otrosL + $request->gastosM + $request->otrosM + $request->gastosMi + $request->otrosMi + $request->gastosJ + $request->otrosJ + $request->gastosV + $request->otrosV + $request->gastosS + $request->otrosS;

            $pago = $prod - $gastos;

            $reporte->producido=$prod;
            $reporte->gastos=$gastos;
            $reporte->pago=$pago;

            $reporte->save();

            if ($gastos==0) {
                return redirect('taxis')->with('mensaje', 'Reporte de la semana ' . $request->semana . ' creado con exito');   
            }else{
                return redirect('taxis/gastos/' . $id . '/' . $request->semana);
            }

        }else{
            return redirect('taxis.reporta')->with('error', 'Ya se encuentra un registro para esta semana con este vehiculo');
        }
    }

    public function gastos($id, $w){

        return view('taxis/gastos', compact('id', 'w'));
    }

    /*************************************************
     *************************************************
     * Creacion y administracion de Marcas Vehiculos**
     *************************************************
     *************************************************/

    public function marca(){
        $marcas = App\Marcas_Taxi::paginate(5);

        return view('taxis/marcas', compact('marcas'));
    }

    public function creamarca(){

        return view('taxis.marcas.create');
    }

    public function crearmarca(Request $request){
        // return$request->all();
        $marca = new App\Marcas_Taxi();
        $marca->marca=$request->marca;
        $marca->estado='1';

        $marca->save();

        return redirect(route('marcas'))->with('mensaje', 'Marca ' . $request->marca . ' creada con exito');
    }

    public function detallemarca($id=null){
        $marca = App\Marcas_Taxi::findOrFail($id);

        return view('taxis.marcas.detalle', compact('marca'));
    }

    public function editamarca($id){
        $marca = App\Marcas_Taxi::findOrFail($id);

        return view('taxis.marcas.edita', compact('marca'));
    }

    public function editarmarca(Request $request, $id){
        $vehiculos = App\taxi::where('marca', '=', $id)->first();
        var_dump($vehiculos);
        if ($request->estado==0) {
            if ($vehiculos==null) {
                $marca = App\Marcas_Taxi::findOrFail($id);
                $marca->marca = $request->marca;
                $marca->estado = $request->estado;

                $marca->save();

                return redirect('taxis/marcas')->with('mensaje', 'Marca ' . $request->marca . ' actualizada con exito');
            }else{
                return redirect('taxis/marcas')->with('error', 'No se puede inactivar la marca ' . $request->marca . ' pues tiene vehiculos asociados');
            }
        }else{
            $marca = App\Marcas_Taxi::findOrFail($id);
                $marca->marca = $request->marca;
                $marca->estado = $request->estado;

                $marca->save();

                return redirect('taxis/marcas')->with('mensaje', 'Marca ' . $request->marca . ' actualizada con exito');
        }
        
    }

    /*************************************************
     *************************************************
     ********************Calendario*******************
     *************************************************
     *************************************************/

    public function calendario(){
        return view('calendar');
    }

    public function form(){
      return view("evento/form");
    }

    public function create(Request $request){

      $this->validate($request, [
      'titulo'     =>  'required',
      'descripcion'  =>  'required',
      'prioridad'   =>  'required',
      'fecha' =>  'required'
     ]);

      if ($request->usuario==0) {
          $broadcast=1;
      }else{
        $broadcast=0;
      }
      /*App\Event::insert([
        'titulo'       => $request->input("titulo"),
        'descripcion'  => $request->input("descripcion"),
        'prioridad'    => $request->prioridad,
        'propietario'  => Auth::user()->id,
        'broadcast'    => $broadcast,
        'fecha'        => $request->input("fecha"),
        'estado'       => '1'
      ]);*/

        $evento = new App\Event();
        $evento->titulo=$request->titulo;
        $evento->descripcion=$request->descripcion;
        $evento->prioridad=$request->prioridad;
        $evento->propietario=Auth::user()->id;
        $evento->broadcast=$broadcast;
        $evento->fecha=$request->fecha;
        $evento->estado='1';

        $evento->save();


      return redirect('calendario');

    }

    public function deleteEvent($id){
        $evento = App\Event::findOrFail($id);

        $evento->estado = '0';

        $evento->save();

        return redirect('calendario');
    }

    public function details($id){

      $event = App\Event::find($id);

      return view("evento/evento",[
        "event" => $event
      ]);

    }

    public function editaCalendario($id){
        $event = App\Event::find($id);

        return view("evento/edit",[
            "event" => $event
        ]);
    }

    public function editarCalendario(Request $request, $id){
        $evento = App\Event::findOrFail($id);

        if ($request->usuario==0) {
          $broadcast=1;
        }else{
            $broadcast=0;
        }
        $evento->titulo=$request->titulo;
        $evento->descripcion=$request->descripcion;
        $evento->prioridad=$request->prioridad;
        $evento->broadcast=$broadcast;
        $evento->fecha=$request->fecha;

        $evento->save();

        return redirect('calendario');

    }


    // =================== CALENDARIO =====================

    public function index(){

       $month = date("Y-m");
       //
       $data = $this->calendar_month($month);
       $mes = $data['month'];
       // obtener mes en espanol
       $mespanish = $this->spanish_month($mes);
       $mes = $data['month'];

       return view("evento/calendario",[
         'data' => $data,
         'mes' => $mes,
         'mespanish' => $mespanish
       ]);

   }

   public function index_month($month){

      $data = $this->calendar_month($month);
      $mes = $data['month'];
      // obtener mes en espanol
      $mespanish = $this->spanish_month($mes);
      $mes = $data['month'];

      return view("evento/calendario",[
        'data' => $data,
        'mes' => $mes,
        'mespanish' => $mespanish
      ]);

    }

    public static function calendar_month($month){
      //$mes = date("Y-m");
      $mes = $month;
      //sacar el ultimo de dia del mes
      $daylast =  date("Y-m-d", strtotime("last day of ".$mes));
      //sacar el dia de dia del mes
      $fecha      =  date("Y-m-d", strtotime("first day of ".$mes));
      $daysmonth  =  date("d", strtotime($fecha));
      $montmonth  =  date("m", strtotime($fecha));
      $yearmonth  =  date("Y", strtotime($fecha));
      // sacar el lunes de la primera semana
      $nuevaFecha = mktime(0,0,0,$montmonth,$daysmonth,$yearmonth);
      $diaDeLaSemana = date("w", $nuevaFecha);
      $nuevaFecha = $nuevaFecha - ($diaDeLaSemana*24*3600); //Restar los segundos totales de los dias transcurridos de la semana
      $dateini = date ("Y-m-d",$nuevaFecha);
      //$dateini = date("Y-m-d",strtotime($dateini."+ 1 day"));
      // numero de primer semana del mes
      $semana1 = date("W",strtotime($fecha));
      // numero de ultima semana del mes
      $semana2 = date("W",strtotime($daylast));
      // semana todal del mes
      // en caso si es diciembre
      if (date("m", strtotime($mes))==12) {
          $semana = 5;
      }
      else {
        $semana = ($semana2-$semana1)+1;
      }
      // semana todal del mes
      $datafecha = $dateini;
      $calendario = array();
      $iweek = 0;
      while ($iweek < $semana):
          $iweek++;
          //echo "Semana $iweek <br>";
          //
          $weekdata = [];
          for ($iday=0; $iday < 7 ; $iday++){
            // code...
            $datafecha = date("Y-m-d",strtotime($datafecha."+ 1 day"));
            $datanew['mes'] = date("M", strtotime($datafecha));
            $datanew['dia'] = date("d", strtotime($datafecha));
            $datanew['fecha'] = $datafecha;
            //AGREGAR CONSULTAS EVENTO
            $usuario=Auth::user()->id;
            $datanew['evento'] = App\Event::where([["fecha", '=', $datafecha], ["broadcast", '=', 1], ["estado", "=", '1']])->orwhere([["fecha", '=', $datafecha],["propietario", '=', '1'], ["estado", "=", '1']])->get();

            array_push($weekdata,$datanew);
          }
          $dataweek['semana'] = $iweek;
          $dataweek['datos'] = $weekdata;
          //$datafecha['horario'] = $datahorario;
          array_push($calendario,$dataweek);
      endwhile;
      $nextmonth = date("Y-M",strtotime($mes."+ 1 month"));
      $lastmonth = date("Y-M",strtotime($mes."- 1 month"));
      $month = date("M",strtotime($mes));
      $yearmonth = date("Y",strtotime($mes));
      //$month = date("M",strtotime("2019-03"));
      $data = array(
        'next' => $nextmonth,
        'month'=> $month,
        'year' => $yearmonth,
        'last' => $lastmonth,
        'calendar' => $calendario,
      );
      return $data;
    }

    public static function spanish_month($month)
    {

        $mes = $month;
        if ($month=="Jan") {
          $mes = "Enero";
        }
        elseif ($month=="Feb")  {
          $mes = "Febrero";
        }
        elseif ($month=="Mar")  {
          $mes = "Marzo";
        }
        elseif ($month=="Apr") {
          $mes = "Abril";
        }
        elseif ($month=="May") {
          $mes = "Mayo";
        }
        elseif ($month=="Jun") {
          $mes = "Junio";
        }
        elseif ($month=="Jul") {
          $mes = "Julio";
        }
        elseif ($month=="Aug") {
          $mes = "Agosto";
        }
        elseif ($month=="Sep") {
          $mes = "Septiembre";
        }
        elseif ($month=="Oct") {
          $mes = "Octubre";
        }
        elseif ($month=="Nov") {
          $mes = "Noviembre";
        }
        elseif ($month=="Dec") {
          $mes = "Diciembre";
        }
        else {
          $mes = $month;
        }
        return $mes;
    }

    /*************************************************
     *************************************************
     * Creacion y administracion de Socios************
     *************************************************
     *************************************************/

    public function socio(){
        if (Auth::user()->perfil!==3) {
            $socios = App\User::where('perfil', '=', '4')->paginate(5);
            $perfiles = App\Perfil::all();

            return view('socios', compact('socios', 'perfiles'));
        }else{
            return redirect('home');
        }
    }

    public function notificaciones($id){
        return App\Notification::where([['usuario', '=', Auth::user()->id], ['leido', '=', '0']])->get();

    }

    /*************************************************
     *************************************************
     * Creacion y administracion de Tarifas***********
     *************************************************
     *************************************************/

    public function tarifa(){
        $tarifas = App\Tarifa::get();

        return view('tarifas', compact('tarifas'));
    }

    public function editaTarifa(){
        $tarifas = App\Tarifa::get();

        return view('taxis.tarifas.edit', compact('tarifas'));
    }

    public function editarTarifa(Request $request){

        $lunes = App\Tarifa::findOrFail(1);
        $lunes->tarifa=$request->Lunes;
        $lunes->save();

        $martes = App\Tarifa::findOrFail(2);
        $martes->tarifa=$request->Martes;
        $martes->save();

        $miercoles = App\Tarifa::findOrFail(3);
        $miercoles->tarifa=$request->Miercoles;
        $miercoles->save();

        $jueves = App\Tarifa::findOrFail(4);
        $jueves->tarifa=$request->Jueves;
        $jueves->save();

        $viernes = App\Tarifa::findOrFail(5);
        $viernes->tarifa=$request->Viernes;
        $viernes->save();

        $sabado = App\Tarifa::findOrFail(6);
        $sabado->tarifa=$request->Sabado;
        $sabado->save();

        $domingo = App\Tarifa::findOrFail(7);
        $domingo->tarifa=$request->Domingo;
        $domingo->save();

        return redirect('tarifa')->with('mensaje', 'Las tarifas se han actualizado con exito');

    }

    public function categoria(){
        $categorias = App\CategoriasGasto::orderBy('categoria')->paginate(10);

        return view('categorias', compact('categorias'));
    }

    public function destalleCategoria($id){
        $categoria = App\CategoriasGasto::where('id', '=', $id)->get();
        $descripciones = App\DescipcionesGasto::where('categoria', '=', $id)->paginate(5);

        return view('taxis.categorias.detalle', compact('categoria', 'descripciones'));
    }
}

