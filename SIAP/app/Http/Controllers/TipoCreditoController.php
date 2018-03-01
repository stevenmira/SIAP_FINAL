<?php

namespace siap\Http\Controllers;

use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use siap\Cliente;
use siap\Cuenta;
use siap\DetalleLiquidacion;
use siap\Prestamo;
use siap\TipoCredito;
use siap\Negocio;

class TipoCreditoController extends Controller
{
    public function index()
    {

    }

    public function create()
    {
        
        $usuarioactual = \Auth::user();
        $clientes = DB::table('cliente')->where('estado','=','ACTIVO')->orderby('cliente.apellido', 'asc')->get();
        return view('tipoCredito.completo.create', ["clientes" => $clientes, "usuarioactual" => $usuarioactual]);
    }

    public function store(Request $request)
    {
        $usuarioactual = \Auth::user();
        $cliente = Cliente::where('idcliente', $request->get('searchItem'))->first();
        //$fecha= Carbon::parse($request->get('fechaCredito'));
        $cuenta = Cuenta::where('idnegocio','=',$request->get('idnegocio'))->where('estado','=','ACTIVO')->first();
        $clientes = DB::table('cliente')->where('estado','=','ACTIVO')->orderby('cliente.apellido', 'asc')->get();
        
        //se comprueba que el cliente solicitante no posea un credito abierto.
        if (!is_null($cuenta)) {
            Session::flash('fallo', "El negocio del cliente ".$cliente->nombre." ".$cliente->apellido." ya posee una cuenta abierta");
            return view('tipoCredito.completo.create', ["clientes" => $clientes, "usuarioactual" => $usuarioactual]);    
        }

        if (!is_null($cliente)) {
           
            $montoCapital = ((intdiv($request->get('monto'), 50)) * 2.25) + $request->get('monto');
            $type = Self::validacion($request->get('credito'),$montoCapital);

            $tipoCredito = TipoCredito::where('idtipocredito',$type)->first();
          
            $interesDiario = $montoCapital * $tipoCredito->interes;

            if($interesDiario>$request->get('cuota'))
        {
            Session::flash('bandera',1);
            Session::flash('error6', "Debe redefinir la Cuota, debe ser mayor de $".$interesDiario." (Sugerencia de cuota: $".($interesDiario + 10)." )");
            return view('tipoCredito.fracaso', ["clientes" => $clientes, "usuarioactual" => $usuarioactual]);
        }


        $resultado = Self::calculoCredito($request->get('monto'), $request->get('cuota'), $request->get('credito'), $cliente->idcliente,$request->get('idnegocio'),$request->get('fechaCredito'));
            Session::flash('exito1', $resultado);
            Session::flash('bandera',1);
            $count = Cuenta::where('idnegocio',$request->get('idnegocio'))->where('estado','=','ACTIVO')->first();
            $prestamo = Prestamo::where('idprestamo',$count->idprestamo)->first();
            $negocio = Negocio::where('idnegocio',$request->get('idnegocio'))->first();
            return view('tipoCredito.exito', ["clientes" => $clientes, "usuarioactual" => $usuarioactual,"cuenta"=> $count,"persona"=>$cliente,"prestamo"=>$prestamo,"negocio"=>$negocio]);
        } else {
            Session::flash('error1', "Hay un problema con el cliente, al parecer no se encuentra en nuesta base de datos");
            return view('tipoCredito.completo.create', ["clientes" => $clientes, "usuarioactual" => $usuarioactual]);
        }

    }

    public function show()
    {

    }

    public function edit()
    {

    }

    public function update()
    {

    }

    public function destroy(Request $request,$id)
    {

        $cuenta= Cuenta::where('idcuenta',$id)->first();
        $prestamo = Prestamo::where('idprestamo',$cuenta->idprestamo)->first();
        #$prestamo2 = $prestamo;
        $prestamo->delete();
        Session::flash('borrado', "El Crédito fue Borrado del sistema correctamente");
        return redirect('record');

    }

    /*
    Nombre: autoComplete
    Objetivo: hacer una busqueda de un negocio
    Autor: Lexan
    parámetros de entrada: un request
    parámetros de salida: un array de datos de negocios
     */
    public function autoComplete(Request $request,$id)
    {
       if($request->ajax()){
           $negocios = Negocio::negocios($id);
           return response()->json($negocios);
       }
    }

    /*
    Nombre: calculoCredito
    Objetivo: bifurca entre los diferentes tipos de creditos
    Autor: Lexan
    parámetros de entrada: monto, cuota,tipo del credito y ID de cliente
    parámetros de salida: mensaje exito o fracaso.
     */
    public function calculoCredito($monto, $cuota, $tipo, $id,$idN,$fecha)
    {
        $montoCapital = ((intdiv($monto, 50)) * 2.25) + $monto;
       

        switch ($tipo) {
            case 'normal':

                if ($montoCapital <= 80) {
                    $tipoCredito = 1;
                } elseif ($montoCapital > 80 && $montoCapital <= 105) {
                    $tipoCredito = 2;
                } else {
                    $tipoCredito = 3;
                }

               $idPrestamo = Self::insertarCuentaPrestamo($montoCapital, $cuota, $tipoCredito, $id,$idN,$monto,$fecha);

                Self::calculoDetalleLiquidacion($montoCapital, $tipoCredito, $cuota, $id,$idPrestamo,$idN,$fecha);
                return 'Credito de tipo NORMAl guardado con exito';
                break;

            case 'preferencial':
                $tipoCredito = 4;
                $idPrestamo = Self::insertarCuentaPrestamo($montoCapital, $cuota, $tipoCredito, $id,$idN,$monto,$fecha);

                Self::calculoDetalleLiquidacion($montoCapital, $tipoCredito, $cuota, $id,$idPrestamo,$idN,$fecha);
                return 'Credito de tipo Preferencial guardado con exito';

                break;

            case 'oro':
                $tipoCredito = 5;
                $idPrestamo = Self::insertarCuentaPrestamo($montoCapital, $cuota, $tipoCredito, $id,$idN,$monto,$fecha);

                Self::calculoDetalleLiquidacion($montoCapital, $tipoCredito, $cuota, $id,$idPrestamo,$idN,$fecha);
                return 'Credito de tipo ORO guardado con exito';
                break;
        }

    }

    /*
    Nombre: calculoDetalleLiquidacion
    Objetivo: inserta la tuplas correspondientes a cada cuota de pago del credito.
    Autor: Lexan
    parámetros de entrada: monto, cuota, tipo del credito y ID de cliente
    parámetros de salida: ninguno
     */
    public function calculoDetalleLiquidacion($montoCapital, $tipoCredito, $cuota, $id,$idPrestamo,$idN,$Date)
    {
        $clientes = DB::table('cliente')->where('estado','=','ACTIVO')->orderby('cliente.apellido', 'asc')->get();
        $usuarioactual = \Auth::user();
        $nuevoTipoCredito = TipoCredito::where('idtipocredito', $tipoCredito)->first();
        $fechaDos= Carbon::parse($Date);

        $cuenta = Cuenta::where('idnegocio',$idN)->where('estado', '=', 'ACTIVO')->first();
        $fecha = $fechaDos->addDay();
        //$fechadiaria = $fecha;
        $cliente=Cliente::where('idcliente',$id)->first();
        $interesDiario = $montoCapital * $nuevoTipoCredito->interes;
        $cuotaCapital = $montoCapital;



        $detalleLiquidacion = new DetalleLiquidacion;
        $count = 1;

        $detalleLiquidacion->idcuenta = $cuenta->idcuenta; 
   
        $detalleLiquidacion->fechadiaria = $fecha->format('Y-m-d');
 
        $detalleLiquidacion->estado = "ACTIVO";
        $detalleLiquidacion->idusuario = $usuarioactual->idusuario;
        $detalleLiquidacion->contador = $count;

        $detalleLiquidacion->save();

        while ($montoCapital > $cuota) {
            $count++;
            $cuotaCapital = $cuota - $interesDiario;

            $montoCapital = $montoCapital - $cuotaCapital;
            $interesDiario = $montoCapital * $nuevoTipoCredito->interes;

            $detalleLiquidacion = new DetalleLiquidacion;

            $detalleLiquidacion->idcuenta = $cuenta->idcuenta;
            $fechadiaria = $fecha->addDay();
            $detalleLiquidacion->fechadiaria = $fechadiaria->format('Y-m-d');
         
            $detalleLiquidacion->estado = "ACTIVO";
            $detalleLiquidacion->idusuario = $usuarioactual->idusuario;
            $detalleLiquidacion->contador = $count;
           
            $detalleLiquidacion->save();
            
        }

        //guarda la ultima fecha de pago
        $prestamo = Prestamo::where('idprestamo',$idPrestamo)->first();
        $prestamo->fechaultimapago=$detalleLiquidacion->fechadiaria;
        $prestamo->update();
    }

    /*
    Nombre: insertarCuentaPrestamodetalleLiquidacion
    Objetivo: crea la correspondiente cuenta a un cliente y la definiciones del prestamo asociado a la cuenta recien creada.
    Autor: Lexan
    parámetros de entrada: monto, cuota, tipo del credito y ID del cliente.
    parámetros de salida: el ID del prestamo recien creado.
     */
    public function insertarCuentaPrestamo($montoCapital, $cuota, $tipoCredito, $id,$idN,$monto,$date)
    {
        $nuevoTipoCredito = TipoCredito::where('idtipocredito', $tipoCredito)->first();

        $number = Self::numeroPrestamo($id);
        //se crea un nuevo prestamo
        $fechaUno= Carbon::parse($date);
        $prestamo = new Prestamo;
        $fecha = $fechaUno->addDay();
        $prestamo->fecha = $fecha->format('Y-m-d');
        $prestamo->monto = $montoCapital;
        $prestamo->cuotadiaria = $cuota;
        $prestamo->estado = 'COMPLETO';
        $prestamo->estadodos = 'ACTIVO';
        $prestamo->montooriginal = $monto;
        $prestamo->save();

        //se crea una nueva cuenta
        $cuenta = new Cuenta;
        $cuenta->montocapital = $montoCapital;
        $cuenta->interes = $nuevoTipoCredito->interes;
        $cuenta->idtipocredito = $nuevoTipoCredito->idtipocredito;
        $cuenta->idprestamo = $prestamo->idprestamo;
        $cuenta->numeroprestamo = $number+1;
        $cuenta->idnegocio=$idN;
        $cuenta->estado = 'ACTIVO';
        $cuenta->save();

        
        return $prestamo->idprestamo;
    }




    public function validacion($tipo,$montoCapital)
    {
        switch ($tipo) {
            case 'normal':

                if ($montoCapital <= 80) {
                    $tipoCredito = 1;
                } elseif ($montoCapital > 80 && $montoCapital <= 105) {
                    $tipoCredito = 2;
                } else {
                    $tipoCredito = 3;
                }
                break;

            case 'preferencial':
                $tipoCredito = 4;
                break;

            case 'oro':
                $tipoCredito = 5;
                break;
        }

        return $tipoCredito;
    }



    public function numeroPrestamo($idcliente)
    {
        $consulta = DB::table('cuenta')
        ->join('negocio as negocio','cuenta.idnegocio','=','negocio.idnegocio')
        ->where('negocio.idcliente','=',$idcliente)
        ->count();
        return $consulta;
    }
}
