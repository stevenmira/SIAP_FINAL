<?php

namespace siap\Http\Controllers;

use Illuminate\Http\Request;

use siap\Http\Requests;
use siap\Http\Requests\LiquidacionFormRequest;

use siap\Cuenta;
use siap\Cliente;
use siap\Negocio;
use siap\Prestamo;
use siap\TipoCredito;
use siap\DetalleLiquidacion;
use siap\Fecha;
use siap\Comprobante;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;

use Carbon\Carbon; //Para la zona fecha horaria

use DB;

class LiquidacionController extends Controller
{
    
    public function cuenta($id)
    {
        $usuarioactual=\Auth::user();

        //Obtenemos la fecha de hoy
        $fecha_actual = Carbon::now();

        //Encontramos la cuenta con sus repectivas relaciones
        $cuenta = Cuenta::findOrFail($id);
        $negocio = Negocio::findOrFail($cuenta->idnegocio);
        $cliente = Cliente::findOrFail($negocio->idcliente);
        $prestamo = Prestamo::findOrFail($cuenta->idprestamo);
        $tipo_credito = TipoCredito::findOrFail($cuenta->idtipocredito);

        $componente = DetalleLiquidacion::calculoN_modificado($id);
        $n = DetalleLiquidacion::estados_cuotas($id);

        #$componente = Self::calculoN_modificado($cuenta->idcuenta);
        #$n = Self::estados_cuotas($cuenta->idcuenta);

        $liquidaciones = DetalleLiquidacion::where('idcuenta','=',$cuenta->idcuenta)
        ->orderby('iddetalleliquidacion', 'asc')
        ->paginate(400);


        //suma de totales
        $sum_interes_diario = 0;
        $sum_cuota_capital = 0;
        $sum_total_diario = 0;

        $atraso = 0;
        $cancelado = 0;
        $abono = 0;
        $pendiente = 0;
        $novalido = 0;

        
        foreach ($liquidaciones as $liq) {
            //sumas de totales
            $sum_interes_diario = $sum_interes_diario + $liq->interes;
            $sum_cuota_capital = $sum_cuota_capital + $liq->cuotacapital;
            $sum_total_diario = $sum_total_diario + $liq->totaldiario;

            if ($liq->estado == 'ATRASO') {
                $atraso = $atraso + 1;
            }

            if ($liq->estado == 'ABONO') {
                $abono = $abono + 1;
            }

            if ($liq->estado == 'PENDIENTE') {
                $pendiente = $pendiente + 1;
            }

            if ($liq->estado == 'NO VALIDO') {
                $novalido = $novalido + 1;
            }

            if ($liq->estado == 'CANCELADO') {
                $cancelado = $cancelado + 1;
            }


        }

        //Obtenemos la fecha de hoy en español usando carbon y array
        $fecha_server = Fecha::spanish();

        return view('liquidacion.index',["cuenta"=>$cuenta,"n"=>$n, "cliente"=>$cliente, "prestamo"=>$prestamo, "tipo_credito"=>$tipo_credito, "negocio"=>$negocio, "liquidaciones"=>$liquidaciones, "sum_interes_diario"=>$sum_interes_diario, "sum_cuota_capital"=>$sum_cuota_capital, "sum_total_diario"=>$sum_total_diario, "atraso"=>$atraso, "abono"=>$abono, "pendiente"=>$pendiente, "novalido"=>$novalido,  "cancelado"=>$cancelado, "fecha_actual"=>$fecha_actual, "fecha_server"=>$fecha_server, "usuarioactual"=>$usuarioactual ]);
    }

    //Recibe una liquidacion

    public function edit($id)   
    {   
        $usuarioactual=\Auth::user();

        //Encontramos lo necesario para la tupla de detalle_liquidacion
        $liquidacion = DetalleLiquidacion::findOrFail($id);
        $cuenta = Cuenta::findOrFail($liquidacion->idcuenta);
        $negocio = Negocio::findOrFail($cuenta->idnegocio);
        $cliente = Cliente::findOrFail($negocio->idcliente);
        $prestamo = Prestamo::findOrFail($cuenta->idprestamo);
        $tipo_credito = TipoCredito::findOrFail($cuenta->idtipocredito);

        //Obtenemos la fecha de hoy en español usando carbon y array
        $fecha_actual = Fecha::spanish();
        
        return view('liquidacion.edit',["liquidacion"=>$liquidacion, "cuenta"=>$cuenta, "cliente"=>$cliente, "prestamo"=>$prestamo, "fecha_actual"=>$fecha_actual, "tipo_credito"=>$tipo_credito, "usuarioactual"=>$usuarioactual]);
    }

    public function update(LiquidacionFormRequest $request, $id)
    {
        /*try{
                DB::beginTransaction();*/

                $usuarioactual=\Auth::user();
                //Obtenemos la fecha de hoy
                $fecha_actual = Carbon::now();
                $fecha_actual = $fecha_actual->format('Y-m-d');

                //Obtenemos el detalle_liquidacion a modificar
                $liquidacion = DetalleLiquidacion::findOrFail($id);
                $cuenta = Cuenta::findOrFail($liquidacion->idcuenta);
                $prestamo = Prestamo::findOrFail($cuenta->idprestamo);
                $tipo_credito = TipoCredito::findOrFail($cuenta->idtipocredito);

                //Traemos los datos de la template
                $montocapital = $request->get('monto_capital');
                $totaldiario = $request->get('total_diario');
                $fechaefectiva = $request->get('fecha_efectiva');

                if (Input::get('abonocapital')) {
                    $abonocapital = 1;                                           // El usuario SI marcó el checkbox 
                } else {
                    $abonocapital = 0;                                          // El usuario NO marcó el chechbox
                }

                //validaciones previas
                if ($totaldiario <= 0) {
                    Session::flash('negativo', ' El total diario no puede ser cero ó negativo, transacción fallida');
                    return Redirect::to('cuenta/carteraPagos/'.$cuenta->idcuenta);
                }
                
                
                /****************************   ESTADO DE LA CUENTA ****************************/
                if ($prestamo->estadodos == 'ACTIVO') 
                {

                    /****************************   PAGO_CUOTA    ****************************/

                    $mensaje = Self::PAGO_CUOTA($id, $montocapital, $totaldiario, $fechaefectiva, $abonocapital, $fecha_actual);

                    switch ($mensaje) 
                    {
                        case '1': 
                            #Session::flash('mensaje', 'Pago a cuota diaria : CANCELADO ');
                            return Redirect::to('cuenta/carteraPagos/'.$cuenta->idcuenta);
                            break;

                        case '2': 
                            #Session::flash('mensaje', ' Abono a cuota diaria : ABONO ');
                            return Redirect::to('cuenta/carteraPagos/'.$cuenta->idcuenta);
                            break;

                        case '3': 
                            Session::flash('fail', 'Falló al registrar el pago, lo máximo que se puede pagar a CUOTA DIARIA es: $ '.$prestamo->cuotadiaria.' ');
                            return Redirect::to('cuenta/carteraPagos/'.$cuenta->idcuenta);
                            break;

                        case '4': 
                            #Session::flash('mensaje', 'Pago a cuota capital : CANCELADO');
                            return Redirect::to('cuenta/carteraPagos/'.$cuenta->idcuenta);
                            break;

                        case '5': 
                            #Session::flash('fail', 'El pago a CUOTA CAPITAL es mayor al SALDO CAPITAL que tiene el crédito del cliente');
                            return Redirect::to('cuenta/carteraPagos/'.$cuenta->idcuenta);
                            break;

                        case 'finish': 
                            Session::flash('finish', 'Se realizó el pago de la última cuota, verifique que los totales sean correctos y luego cierre el préstamo.');
                            return Redirect::to('cuenta/carteraPagos/'.$cuenta->idcuenta);
                            break;

                        case 'fallo1': 
                            Session::flash('fail', 'Fallo al registrar el pago en CUOTA DIARIA, algo salió mal . . .');
                            return Redirect::to('cuenta/carteraPagos/'.$cuenta->idcuenta);
                            break;

                        case 'fallo2': 
                            Session::flash('fail', 'Fallo al registrar el pago en CUOTA CAPITAL, algo salió mal . . .');
                            return Redirect::to('cuenta/carteraPagos/'.$cuenta->idcuenta);
                            break;

                        case 'underflow1': 
                            Session::flash('fail', 'El último pago debe ser menor a la CUOTA DIARIA');
                            return Redirect::to('cuenta/carteraPagos/'.$cuenta->idcuenta);
                            break;

                        case 'gravado': 
                            #Session::flash('fail', 'El último pago debe ser menor a la CUOTA DIARIA');
                            return Redirect::to('cuenta/carteraPagos/'.$cuenta->idcuenta);
                            break;
                    }

                }
                else{

                    Session::flash('inactivo', 'El préstamo se encuentra en estado CERRADO, no es posible realizar pagos, para cambiar esto debes modificar al estado ACTIVO el préstamo');
                    return Redirect::to('cuenta/carteraPagos/'.$cuenta->idcuenta);

                }

            /*DB::commit();

            }catch(\Exception $e){
            DB::rollback();
            Session::flash('error', ''.' No se pudo actualizar al cliente, algo salió mal');
        } */      

    }

    public function PAGO_CUOTA($id, $montocapital, $totaldiario, $fechaefectiva, $abonocapital, $fecha_actual)
    {
        $usuarioactual=\Auth::user();

        //Obtenemos el detalle_liquidacion a modificar
        $liquidacion = DetalleLiquidacion::findOrFail($id);
        $cuenta = Cuenta::findOrFail($liquidacion->idcuenta);
        $prestamo = Prestamo::findOrFail($cuenta->idprestamo);
        $tipo_credito = TipoCredito::findOrFail($cuenta->idtipocredito);
        $idcuenta = $cuenta->idcuenta;  //calculoN

        $liquidacion->monto = round($montocapital, 2);                      // Para validaciones

        if ($liquidacion->monto == 0) {
            return $mensaje = 'El monto capital es igual a cero, el crédito a sido cancelado';
        }

            if ($abonocapital == 0)                                       // Abono a cuota diaria
            {                               
                //Último monto cuota diaria (valida que no sea mayor al monto + intereses)
                $interes = $liquidacion->monto * $tipo_credito->interes;
                $gravado = round($liquidacion->monto + $interes, 2);

                if ($totaldiario > $gravado) {
                Session::flash('gravado', ' El total diario no puede ser mayor al pago de la última cuota diaria. ( $'.$totaldiario.' > $'.$gravado.' )');

                    return 'gravado';
                }    

                if ($totaldiario == $prestamo->cuotadiaria) {            // Pagó exactamente la cuota diaria

                    if ($liquidacion->monto >= $prestamo->cuotadiaria) 
                    {
                    
                        $liquidacion->monto = round($montocapital, 2);
                        $liquidacion->interes = round($montocapital * $tipo_credito->interes, 2);
                        $liquidacion->cuotacapital = round($totaldiario - $liquidacion->interes,2);
                        $liquidacion->totaldiario = $totaldiario;
                        $liquidacion->fechaefectiva = $fechaefectiva;
                        $liquidacion->estado = 'CANCELADO';
                        $liquidacion->abonocapital = 'NO';
                        $liquidacion->update();

                        Session::flash('mensaje', 'Pago a cuota diaria CANCELADO  $ '.$totaldiario.' ');

                        return $mensaje = '1';  //Se registró correctamente el pago de la CUOTA DIARIA : CANCELADO
                    }else{
                        return $mensaje = 'underflow1';  // La última debe ser menor a la CUOTA DIARIA
                    }

                }elseif ($totaldiario < $prestamo->cuotadiaria) {       // Abono una parte de la cuota diaria

                    if ($liquidacion->monto >= $prestamo->cuotadiaria) 
                    {
                        $liquidacion->monto = round($montocapital, 2);
                        $liquidacion->interes = round($montocapital * $tipo_credito->interes, 2);
                        $liquidacion->cuotacapital = round($totaldiario - $liquidacion->interes,2);
                        $liquidacion->totaldiario = $totaldiario;
                        $liquidacion->fechaefectiva = $fechaefectiva;
                        $liquidacion->estado = 'ABONO';
                        $liquidacion->abonocapital = 'NO';
                        $liquidacion->update();

                        Session::flash('mensaje', ' Abono a cuota diaria  ABONO $ '.$totaldiario.' ');

                        return $mensaje = '2';  //Se registró correctamente el ABONO A CUOTA DIARIA : ABONADO

                    }elseif ($liquidacion->monto < $prestamo->cuotadiaria) 
                    {
                        $liquidacion->monto = round($montocapital, 2);
                        $liquidacion->interes = round($montocapital * $tipo_credito->interes, 2);
                        $liquidacion->cuotacapital = round($totaldiario - $liquidacion->interes,2);
                        $liquidacion->totaldiario = $totaldiario;
                        $liquidacion->fechaefectiva = $fechaefectiva;
                        $liquidacion->estado = 'CANCELADO';
                        $liquidacion->abonocapital = 'NO';
                        $liquidacion->update();

                        return $mensaje = 'finish';  //Se terminó el contrato, el cliente pagó la deuda 
                    }
                    

                }elseif ($totaldiario > $prestamo->cuotadiaria) {

                    return $mensaje = '3';  //' Lo máximo que se puede pagar a CUOTA DIARIA es: $ '.$prestamo->cuotadiaria

                }else{
                    return $mensaje = 'fallo1';
                }

            }
            elseif ($abonocapital == 1)                                   // Abono a capital
            {                                 
                if ($totaldiario <= $liquidacion->monto ) {              // Pagó total o parcial a capital

                    $liquidacion->monto = round($montocapital, 2);
                    $liquidacion->interes = 0;
                    $liquidacion->cuotacapital = round($totaldiario, 2);
                    $liquidacion->totaldiario = $totaldiario;
                    $liquidacion->fechaefectiva = $fechaefectiva;
                    $liquidacion->estado = 'CANCELADO';
                    $liquidacion->abonocapital = 'SI';
                    $liquidacion->update();

                    Session::flash('mensaje', 'Pago a cuota capital  CANCELADO $ '.$totaldiario.' ');

                    return $mensaje = '4';  //Se registró correctamente el pago de la CUOTA CAPITAL : CANCELADO

                }elseif($totaldiario > $liquidacion->monto){
                    
                    Session::flash('fail', 'El pago a CUOTA CAPITAL es mayor al SALDO CAPITAL que tiene el crédito del cliente ( $'.$totaldiario. ' > $'.$liquidacion->monto.' )');

                    return $mensaje = '5';  //El pago a CUOTA CAPITAL es mayor al SALDO CAPITAL que tiene el crédito del cliente
                
                }else{
                    return $mensaje = 'fallo2';
                }

                
            }   
    }




    
    public function destroy($iddetalleliquidacion)
    {
        $usuarioactual=\Auth::user();

        $liquidacion = DetalleLiquidacion::findOrFail($iddetalleliquidacion);
        $cuenta = Cuenta::findOrFail($liquidacion->idcuenta);

        $liquidacion->monto = null;
        $liquidacion->interes = null;
        $liquidacion->cuotacapital = null;
        $liquidacion->totaldiario = null;
        $liquidacion->fechaefectiva = null;
        $liquidacion->abonocapital = null;
        $liquidacion->estado = 'PENDIENTE';
        $liquidacion->update();

        Session::flash('limpiar', 'El pago a sido anulado');
        return Redirect::to('cuenta/carteraPagos/'.$cuenta->idcuenta);


    }

    public function carteraPDF($id){

        $cuenta = Cuenta::findOrFail($id);
        $negocio = Negocio::findOrFail($cuenta->idnegocio);
        $cliente = Cliente::findOrFail($negocio->idcliente);
        $prestamo = Prestamo::findOrFail($cuenta->idprestamo);
        $tipo_credito = TipoCredito::findOrFail($cuenta->idtipocredito);

        $fechahoy = date('d/m/y');
    
        $vistaurl = "reportes/licitacion";

        $name = "CarteraPagosIdeal".$negocio->nombre.$cliente->nombre.".pdf";

        $liquidacion = new DetalleLiquidacion;
  
        return $this -> crearPDF($vistaurl,$negocio,$cliente,$prestamo,$tipo_credito,$liquidacion,$name,$cuenta);
    }

    public function crearPDF($vistaurl,$negocio,$cliente,$prestamo,$tipo_credito,$liquidacion,$name,$cuenta)
    {
        
        $view=\View::make($vistaurl,compact('negocio','cliente','prestamo','tipo_credito','liquidacion','cuenta'))->render();
        $pdf =\App::make('dompdf.wrapper');

        $pdf->loadHTML($view);
        return $pdf->stream($name);
    }

    public function carteraRealPDF($id)
    {
        $usuarioactual=\Auth::user();

        //Obtenemos la fecha de hoy
        $fecha_actual = Carbon::now();

        //Encontramos la cuenta con sus repectivas relaciones
        $cuenta = Cuenta::findOrFail($id);
        $negocio = Negocio::findOrFail($cuenta->idnegocio);
        $cliente = Cliente::findOrFail($negocio->idcliente);
        $prestamo = Prestamo::findOrFail($cuenta->idprestamo);
        $tipo_credito = TipoCredito::findOrFail($cuenta->idtipocredito);

        $componente = DetalleLiquidacion::calculoN_modificado($id);
        $n = DetalleLiquidacion::estados_cuotas($id);
        $comprobante = Comprobante::where('idcuenta',$id);

        #$componente = Self::calculoN_modificado($cuenta->idcuenta);
        #$n = Self::estados_cuotas($cuenta->idcuenta);

        $liquidaciones = DetalleLiquidacion::where('idcuenta','=',$cuenta->idcuenta)
        ->orderby('iddetalleliquidacion', 'asc')
        ->paginate(100);


        //suma de totales
        $sum_interes_diario = 0;
        $sum_cuota_capital = 0;
        $sum_total_diario = 0;

        $atraso = 0;
        $cancelado = 0;
        $abono = 0;
        $pendiente = 0;
        $novalido = 0;

        
        foreach ($liquidaciones as $liq) {
            //sumas de totales
            $sum_interes_diario = $sum_interes_diario + $liq->interes;
            $sum_cuota_capital = $sum_cuota_capital + $liq->cuotacapital;
            $sum_total_diario = $sum_total_diario + $liq->totaldiario;

            if ($liq->estado == 'ATRASO') {
                $atraso = $atraso + 1;
            }

            if ($liq->estado == 'ABONO') {
                $abono = $abono + 1;
            }

            if ($liq->estado == 'PENDIENTE') {
                $pendiente = $pendiente + 1;
            }

            if ($liq->estado == 'NO VALIDO') {
                $novalido = $novalido + 1;
            }

            if ($liq->estado == 'CANCELADO') {
                $cancelado = $cancelado + 1;
            }


        }

        //Obtenemos la fecha de hoy en español usando carbon y array
        $fecha_server = Fecha::spanish();
        $name = "CarteraPagoReal".$cuenta->idcuenta.$cliente->idcliente.$negocio->nombre.".pdf";
        $vistaurl= "reportes/carteraReal";

        return $this -> carteraRPDF($vistaurl,$cuenta,$n,$cliente,$prestamo,$tipo_credito,$negocio,$liquidaciones,$sum_interes_diario,$sum_cuota_capital,$sum_total_diario,$atraso,$abono,$pendiente,$novalido,$cancelado,$fecha_actual,$fecha_server,$name,$comprobante);

    }

     public function carteraRPDF($vistaurl,$cuenta,$n,$cliente,$prestamo,$tipo_credito,$negocio,$liquidaciones,$sum_interes_diario,$sum_cuota_capital,$sum_total_diario,$atraso,$abono,$pendiente,$novalido,$cancelado,$fecha_actual,$fecha_server,$name,$comprobante)
    {
        
        $view=\View::make($vistaurl,compact('cuenta','n','cliente','prestamo','tipo_credito','negocio','liquidaciones','sum_interes_diario','sum_cuota_capital','sum_total_diario','atraso','abono','pendiente','novalido','cancelado','fecha_actual','fecha_server','comprobante'))->render();
        $pdf =\App::make('dompdf.wrapper');

        $pdf->loadHTML($view);
        return $pdf->stream($name);
    }
}

