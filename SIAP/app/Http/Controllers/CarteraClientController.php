<?php

namespace siap\Http\Controllers;

use Illuminate\Http\Request;

use siap\Http\Requests;

use siap\Cuenta;
use siap\Cliente;
use siap\Negocio;
use siap\Cartera;
use siap\Prestamo;
use siap\TipoCredito;
use siap\DetalleLiquidacion;
use siap\Fecha;

use Carbon\Carbon;

use DB;

class CarteraClientController extends Controller
{
    //
	public function index(Request $request)
    {
        $usuarioactual=\Auth::user();
        return view('carteras.ListaCliente.index',["usuarioactual"=>$usuarioactual]);
    }

    public function show(Request $request, $id)
    {
     if($request)
        {
            $usuarioactual=\Auth::user();


            //Obtenemos la fecha actual
            $hoy= Carbon::now();
            $hoy= $hoy->format('Y-m-d');

            //Obtenemos la fecha de hoy en español usando carbon y array
            $fecha_actual = Fecha::spanish();


            //$query3 
            $query = $request->get('searchText');

            if (is_null($query)) {
                $query = $hoy;
            }

            $consulta = DB::table('cartera as cartera')
            ->select('cuenta.idcuenta','cartera.idcartera','cartera.nombre as nombreCartera','cliente.nombre' , 'cliente.apellido', 'detalle_liquidacion.interes','detalle_liquidacion.cuotacapital' , 'detalle_liquidacion.totaldiario','detalle_liquidacion.monto' ,'negocio.nombre as nombreNegocio' , 'prestamo.cuotadiaria', 'detalle_liquidacion.fechadiaria' , 'detalle_liquidacion.fechaefectiva')
            ->join('cliente as cliente','cartera.idcartera','=','cliente.idcartera')
            ->join('negocio as negocio','cliente.idcliente','=','negocio.idcliente')
            ->join('cuenta as cuenta','negocio.idnegocio','=','cuenta.idnegocio')
            ->join('prestamo as prestamo','cuenta.idprestamo','=','prestamo.idprestamo')
            ->join('detalle_liquidacion as detalle_liquidacion','cuenta.idcuenta','=','detalle_liquidacion.idcuenta')
            ->where('cartera.idcartera', '=', $id)
            ->where('detalle_liquidacion.fechadiaria','=', $query)
            ->where('cuenta.estado','=','ACTIVO')
            ->get();

            $array = [];
            $array2 = [];
            $i=0;

            foreach ($consulta as $c) {
                $componente = DetalleLiquidacion::calculoN_modificado($c->idcuenta);
                $n = DetalleLiquidacion::estados_cuotas($c->idcuenta);

                $liquidaciones = DetalleLiquidacion::where('idcuenta','=',$c->idcuenta)->get();

                $atraso = 0;
                foreach ($liquidaciones as $liq) {

                        if (strtotime($liq->fechadiaria) <= strtotime($query) ) {
                            if ($liq->estado == 'ATRASO') {
                                $atraso = $atraso + 1;
                            }
                        }

                        if (!is_null($liq->monto) && is_null($liq->fechaefectiva) && is_null($liq->totaldiario)) {
                            $array2[$i] = $liq->monto;
                        }
                }

                if ($atraso > 0) {
                    $array[$i] = $atraso;
                }else{
                    $array[$i] = 0;
                }

                $i = $i + 1;
            }

           // $nombre = DB::table('cartera as cartera')
            //->select('cartera.idcartera','cartera.nombre') 
            //->get()
            $car = Cartera::findOrFail($id);
            $nombrecar = $car->nombre;

            return view('carteras.ListaCliente.index',["array"=>$array, "fecha_actual"=>$fecha_actual, "array2"=>$array2,"nombre"=>$nombrecar, "car"=>$car, "consulta"=>$consulta,"id"=>$id,"searchText"=>$query ,"usuarioactual"=>$usuarioactual]);
        }   
   
    }

    public function carteraClientPDF(Request $request, $id)
    {
     if($request)
        {
            $usuarioactual=\Auth::user();


            //Obtenemos la fecha actual
            $hoy= Carbon::now();
            $hoy= $hoy->format('Y-m-d');

            //Obtenemos la fecha de hoy en español usando carbon y array
            $fecha_actual = Fecha::spanish();


            //$query3 
            $query = $request->get('fecha');

            if (is_null($query)) {
                $query = $hoy;
            }

            $consulta = DB::table('cartera as cartera')
            ->select('cuenta.idcuenta','cartera.idcartera','cartera.nombre as nombreCartera','cliente.nombre' , 'cliente.apellido', 'detalle_liquidacion.interes','detalle_liquidacion.cuotacapital' , 'detalle_liquidacion.totaldiario','detalle_liquidacion.monto' ,'negocio.nombre as nombreNegocio' , 'prestamo.cuotadiaria', 'detalle_liquidacion.fechadiaria' , 'detalle_liquidacion.fechaefectiva')
            ->join('cliente as cliente','cartera.idcartera','=','cliente.idcartera')
            ->join('negocio as negocio','cliente.idcliente','=','negocio.idcliente')
            ->join('cuenta as cuenta','negocio.idnegocio','=','cuenta.idnegocio')
            ->join('prestamo as prestamo','cuenta.idprestamo','=','prestamo.idprestamo')
            ->join('detalle_liquidacion as detalle_liquidacion','cuenta.idcuenta','=','detalle_liquidacion.idcuenta')
            ->where('cartera.idcartera', '=', $id)
            ->where('detalle_liquidacion.fechadiaria','=', $query)
            ->where('cuenta.estado','=','ACTIVO')
            ->get();

            $array = [];
            $array2 = [];
            $i=0;

            $nombree="";

            foreach ($consulta as $c) {
                $componente = DetalleLiquidacion::calculoN_modificado($c->idcuenta);
                $n = DetalleLiquidacion::estados_cuotas($c->idcuenta);

                $nombree=$c->nombreCartera;

                $liquidaciones = DetalleLiquidacion::where('idcuenta','=',$c->idcuenta)->get();

                $atraso = 0;
                foreach ($liquidaciones as $liq) {

                        if (strtotime($liq->fechadiaria) <= strtotime($query) ) {
                            if ($liq->estado == 'ATRASO') {
                                $atraso = $atraso + 1;
                            }
                        }

                        if (!is_null($liq->monto) && is_null($liq->fechaefectiva) && is_null($liq->totaldiario)) {
                            $array2[$i] = $liq->monto;
                        }
                }

                if ($atraso > 0) {
                    $array[$i] = $atraso;
                }else{
                    $array[$i] = 0;
                }

                $i = $i + 1;
            }

           // $nombre = DB::table('cartera as cartera')
            //->select('cartera.idcartera','cartera.nombre') 
            //->get()
            $car = Cartera::findOrFail($id);
            $nombrecar = $car->nombre;

            $vistaurl = "reportes/cartera";

            $name = "Cartera".$nombree.$query;

            return $this -> crearPDF($vistaurl,$array,$fecha_actual,$array2,$nombrecar,$car,$consulta,$id,$query,$name,$nombree);
        }  
   
    }

    public function crearPDF($vistaurl,$array,$fecha_actual,$array2,$nombrecar,$car,$consulta,$id,$query,$name,$nombree){
        $view=\View::make($vistaurl,compact('array','fecha_actual','array2','nombrecar','car','consulta','id','query','nombree'))->render();
        $pdf =\App::make('dompdf.wrapper');

        $pdf->loadHTML($view);
        return $pdf->stream($name.".pdf");
    }
}
