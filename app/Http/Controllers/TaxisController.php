<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class TaxisController extends Controller
{
    //
    /*********************************************
     *********************************************
     * Creacion y administracion de taxis*********
     *********************************************
     *********************************************/

    public function taxi(){

        $taxdet = DB::table('taxis')
            ->join('taxi_brands', 'taxis.marca', '=', 'taxi_brands.id')
            ->select('taxis.id', 'taxis.placa', 'taxi_brands.marca as marca', 'taxis.modelo', 'taxis.serie', 'taxis.estado', 'taxis.created_at')
            ->paginate(5);

        $conductores = DB::table('taxi_drivers')
            ->join('users', 'users.id', '=', 'taxi_drivers.idCond')
            ->select('taxi_drivers.idTaxi', 'taxi_drivers.estado', 'users.name', 'users.lastname')
            ->where([['users.estado', '=', '1'], ['users.perfil', '=', '3'], ['taxi_drivers.estado', '=', '1']])
            ->get();

        return view('taxis', compact('taxdet', 'conductores'));
    }

    public function detalleTax($id=null){
        $taxi = App\Taxi::findOrFail($id);
        $marcas = App\TaxiBrand::where('estado', 1)->get();
        $conductores = DB::table('taxi_drivers')
            ->join('users', 'users.id', '=', 'taxi_drivers.idCond')
            ->select('taxi_drivers.idTaxi', 'taxi_drivers.estado', 'users.name', 'users.lastname', 'users.id')
            ->where([['users.estado', '=', '1'], ['users.perfil', '=', '3'], ['taxi_drivers.estado', '=', '1']])
            ->get();

        $registros = App\Record::where('vehiculo', '=', $id)->orderBy('semana', 'desc')->limit(4)->get();

        return view('taxis.detalle', compact('taxi', 'marcas', 'conductores', 'registros'));
    }

    public function creaTax(){
        $marcas = App\TaxiBrand::where('estado', 1)->orderBy('marca', 'asc')->get();
        $marca = App\TaxiBrand::where('estado', '=', 1)->first();

        //var_dump($marca);

        if ($marca!==null) {
            return view('taxis.create', compact('marcas'));
        }else{
            return redirect('marcas/create')->with('sinMarca', 'Es necesario la creacion de una marca para poder crear un vehiculo');
        }

    }

    public function crearTax(Request $request){
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

    public function editaTax($id){
        $taxi = App\Taxi::findOrFail($id);

        $marcas = App\TaxiBrand::where('estado', '1')->orderBy('marca', 'asc')->get();

        $conductores = App\User::where([['estado', '=', '1'], ['perfil', '=', '3']])->orderBy('name', 'asc')->get();

        $asignacion = App\TaxiDriver::where([['estado', '=', '1'], ['idTaxi', '=', $id]])->get();

        $soat = App\Document::where([['vehiculo', '=', $id], ['tipo', '=', '1']])->orderBy('created_at', 'desc')->first();

        $tp = App\Document::where([['vehiculo', '=', $id], ['tipo', '=', '2']])->orderBy('created_at', 'desc')->first();

        $to = App\Document::where([['vehiculo', '=', $id], ['tipo', '=', '3']])->orderBy('created_at', 'desc')->first();

        $rt = App\Document::where([['vehiculo', '=', $id], ['tipo', '=', '4']])->orderBy('created_at', 'desc')->first();

        return view('taxis.edita', compact('taxi', 'marcas', 'conductores', 'asignacion', 'soat', 'tp', 'to', 'rt'));
    }

    public function editarTax(Request $request, $id){
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
            $comprobar = App\TaxiDriver::where([['idCond', '=', $request->idCond[$i]], ['idTaxi', '=', $id]])->first();

            if ($comprobar==null) {
                $asignar = new App\TaxiDriver();
                $asignar->idTaxi=$id;
                $asignar->idCond=$request->idCond[$i];
                $asignar->estado='1';

                $asignar->save();
            }else{
                $comprobar->estado='1';
                $comprobar->save();
            }
        }

        $asignaciones = App\TaxiDriver::where('estado', '=', '1')->get();

        foreach ($asignaciones as $asigna) {
            $valor = in_array($asigna->idCond, $request->idCond);
            if ($valor==null) {
                $taxi = App\TaxiDriver::findOrFail($asigna->id);
                $taxi->estado='0';
                $taxi->save();
            }
        }

        return redirect('taxis')->with('mensaje', 'Taxi ' . $request->modelo . ' - ' . $taxi->placa . ' actualizado con exito');
    }

    public function asignaTax($id){
        $taxi = App\Taxi::findOrFail($id);
        $conductores = App\User::where([['estado', '=', '1'], ['perfil', '=', '3']])->orderBy('name', 'asc')->get();
        $conductor = App\User::where([['estado', '=', '1'], ['perfil', '=', '3']])->first();

        if ($conductor!==null) {
            return view('taxis.asigna', compact('taxi', 'conductores'));
        }else{
            return redirect('conductores/create')->with('sinUsuario', 'Es necesario la creacion de un conductor para poder asignar un vehiculo');
        }
    }

    public function asignarTax(Request $request, $id){
        if (!empty($request->idCond)) {
            if (sizeof($request->idCond)<=4){
            
                for ($i=0; $i < sizeof($request->idCond); $i++) { 
                    $comprobar = App\TaxiDriver::where([['idCond', '=', $request->idCond[$i]], ['idTaxi', '=', $id]])->first();

                    if ($comprobar==null) {
                        $asignar = new App\TaxiDriver();
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

    public function documento($id){
        $taxi = App\Taxi::findOrFail($id);
        $tipos = App\DocumentType::all();

        return view('taxis/documento', compact('taxi', 'tipos'));
    }

    public function cargarDocumento(Request $request, $id){
        //return $request;
        if ($request->hasFile('soat')) {
            $file = $request->file('soat');
            if ($request->tipo==1) {
                $name = 'soat-'.$id.'-'.time().'.pdf';
                $file->move(public_path().'/documentos/soat/', $name);
            }elseif ($request->tipo==2) {
                $name = 'tp-'.$id.'-'.time().'.pdf';
                $file->move(public_path().'/documentos/tp/', $name);
            }elseif($request->tipo==3){
                $name = 'to-'.$id.'-'.time().'.pdf';
                $file->move(public_path().'/documentos/to/', $name);
            }else{
                $name = 'rt-'.$id.'-'.time().'.pdf';
                $file->move(public_path().'/documentos/rt/', $name);
            }
        }
        $documento = new App\Document();
        $documento->tipo = $request->tipo;
        $documento->vehiculo = $id;
        $documento->documento = $name;
        $documento->save();

        return redirect('taxis/edita/'.$id)->with('cargado', 'El SOAT fue cargado con exito');
    }

    public function reporta($id){
        $taxi = App\Taxi::findOrFail($id);
        $tarifas = App\Rate::get();

        return view('taxis/reportar', compact('taxi', 'tarifas', '$id'));
    }

    public function reportar(Request $request, $id){
        $validacion = App\Record::where([['semana', '=', $request->semana], ['vehiculo', '=', $id]])->first();

        if ($validacion==null) {
            
            $reporte = new App\Record();
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
                return redirect('taxis/gastos/' . $id . '/' . $request->semana . '/' . $gastos);
            }

        }else{
            return redirect('taxis/reporta/' . $id)->with('error', 'Ya se encuentra un registro para esta semana con este vehiculo');
        }
    }

    public function gastos($id, $w, $val){
        $categorias = App\ExpenseCategory::where('estado', '=', 1)->get();
        $descripciones = App\ExpenseDescription::where('estado', '=', 1)->get();

        return view('taxis/gastos', compact('id', 'w', 'val', 'categorias', 'descripciones'));
    }

    public function gastosIngresar(Request $request, $id){
        $identificador = explode("_", $id);
        $validar = App\Expense::where("semana", '=', $identificador[1])->first();
        if ($validar==NULL) {
            # code...
            for ($i=1; $i<=$request->cantidad ; $i++) {
                $name="";
                if ($request->hasFile('factura' . $i)) {
                    $file = $request->file('factura' . $i);
                    $name = 'factura-'.$identificador[0].'-'.time(). '-' . $i .'.pdf';
                    $file->move(public_path().'/documentos/facturas/', $name);
                }else{
                    $name="fallo";
                }

                $gasto = new App\Expense();
                $gasto->vehiculo=$identificador[0];
                $gasto->semana=$identificador[1];
                $gasto->fecha=$request['fecha'.$i];
                $gasto->valor=$request['valor'.$i];
                $gasto->categoria=$request['categoria'.$i];
                $gasto->descripcion=$request['descripcion'.$i];
                $gasto->otro=$request['otros'.$i];
                $gasto->factura=$name;

                $gasto->save();

                if ($request['km'.$i]!=NULL) {
                    $kilometaje = new App\OilChange();
                    $kilometaje->vehiculo=$identificador[0];
                    $kilometaje->km=$request['km'.$i];
                    $kilometaje->fecha=$request['fecha'.$i];

                    $kilometaje->save();
                }
            }
            return redirect('taxis/detalle/'.$id)->with('mensaje', 'Los gastos se registraron con exito');
        }else{
            return redirect('taxis')->with('error', 'Ya has registrado gastos para esta semana');
        }

    }
}
