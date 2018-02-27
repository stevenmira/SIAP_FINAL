<?php

namespace siap\Http\Controllers;

use Illuminate\Http\Request;

use siap\Http\Requests;

use siap\Negocio;
use siap\Cartera;
use siap\Cliente;
use siap\Cuenta;
use siap\Prestamo;
use siap\TipoCredito;
use siap\DetalleLiquidacion;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

use DB;

class CuentaController extends Controller
{
	public function index(Request $request)
    {
        


    }

    public function show($idcuenta)
    {
    	$usuarioactual=\Auth::user();

        //Actualización de montos y estados
        $componente = DetalleLiquidacion::calculoN_modificado($idcuenta);
        $n = DetalleLiquidacion::estados_cuotas($idcuenta);

    	//Encontramos la cuenta con sus repectivas relaciones
        $cuenta = Cuenta::findOrFail($idcuenta);
        $negocio = Negocio::findOrFail($cuenta->idnegocio);
        $cliente = Cliente::findOrFail($negocio->idcliente);
        $cartera = Cartera::findOrFail($cliente->idcartera);
        $prestamo = Prestamo::findOrFail($cuenta->idprestamo);
        $tipo_credito = TipoCredito::findOrFail($cuenta->idtipocredito);

    	return view('cuenta.show',["cuenta"=>$cuenta, "negocio"=>$negocio, "cliente"=>$cliente, "prestamo"=>$prestamo, "tipo_credito"=>$tipo_credito, "cartera"=>$cartera, "usuarioactual"=>$usuarioactual]);
    }




    //Éste metodo funciona para ambos casos de estado ACTIVO o INACTIVO
    public function destroy($idcuenta)
    {
        $usuarioactual=\Auth::user();

        $cuenta = Cuenta::findOrFail($idcuenta);
        $estado  = $cuenta->estado;

        if ($estado == 'ACTIVO') {

             $cuenta->estado = 'INACTIVO';
             $cuenta->update();
             Session::flash('inactivo'," ".$cuenta->estado.' ');
             

         }else{

            $cuenta->estado = 'ACTIVO';
            $cuenta->update();
            Session::flash('activo'," ".$cuenta->estado.' ');
         }

         return Redirect::to('cuenta/'.$idcuenta);

    }

    public function desembolso($idcuenta)
    {
        $usuarioactual=\Auth::user();

        //Encontramos la cuenta con sus repectivas relaciones
        $cuenta = Cuenta::findOrFail($idcuenta);
        $negocio = Negocio::findOrFail($cuenta->idnegocio);
        $cliente = Cliente::findOrFail($negocio->idcliente);
        $prestamo = Prestamo::findOrFail($cuenta->idprestamo);
        $tipo_credito = TipoCredito::findOrFail($cuenta->idtipocredito);

        if ($prestamo->estado == 'COMPLETO') 
        {

            $costo = intdiv($prestamo->montooriginal, 50) * 2.25;
            $montoreal = $prestamo->montooriginal;

            return view('cuenta.desembolso',["cuenta"=>$cuenta, "cliente"=>$cliente, "prestamo"=>$prestamo, "montoreal"=>$montoreal, "costo"=>$costo, "usuarioactual"=>$usuarioactual]);

        }else{

            $cuentaAnterior = Cuenta::findOrFail($prestamo->cuentaanterior);
            $prestamoAnterior = Prestamo::findOrFail($cuentaAnterior->idprestamo);

            $costo = intdiv($prestamo->montooriginal, 50) * 2.25;
            $montoreal = $prestamo->montooriginal;

            return view('cuenta.desembolsoRefinanciamiento',["cuenta"=>$cuenta, "cuentaAnterior"=>$cuentaAnterior, "prestamoAnterior"=>$prestamoAnterior, "cliente"=>$cliente, "prestamo"=>$prestamo, "montoreal"=>$montoreal, "costo"=>$costo, "usuarioactual"=>$usuarioactual]);
        }
        
    }

    ///Generacion de Reportes de Desesmbolso con o sin Refinanciamiento, con o sin mora.

    public function desembolsoPDF($idcuenta){
        //Encontramos la cuenta con sus repectivas relaciones
        $cuenta = Cuenta::findOrFail($idcuenta);
        $negocio = Negocio::findOrFail($cuenta->idnegocio);
        $cliente = Cliente::findOrFail($negocio->idcliente);
        $prestamo = Prestamo::findOrFail($cuenta->idprestamo);
        $tipo_credito = TipoCredito::findOrFail($cuenta->idtipocredito);

        if ($prestamo->estado == 'COMPLETO') 
        {

            $costo = intdiv($prestamo->montooriginal, 50) * 2.25;
            $montoreal = $prestamo->montooriginal;

            $vistaurl = 'reportes/desembolso';

            $name='Desembolso'.$cuenta->idcuenta.$prestamo->idprestamo.$negocio->nombre.$cliente->nombre.".pdf";

            return $this -> desemPDF($vistaurl,$cuenta,$cliente,$prestamo,$montoreal,$costo,$name);

        }else{

            $cuentaAnterior = Cuenta::findOrFail($prestamo->cuentaanterior);
            $prestamoAnterior = Prestamo::findOrFail($cuentaAnterior->idprestamo);

            $costo = intdiv($prestamo->montooriginal, 50) * 2.25;
            $montoreal = $prestamo->montooriginal;

            $vistaurl = 'reportes/desembolsoRefinanciamiento';

            $name='algo';

            return $this -> desemMoraPDf($vistaurl,$cuenta, $cuentaAnterior, $prestamoAnterior, $cliente, $prestamo, $montoreal, $costo,$name);
        }
           
    }

    public function desemSinMoraPDF ($idcuenta){
        //Encontramos la cuenta con sus repectivas relaciones
        $cuenta = Cuenta::findOrFail($idcuenta);
        $negocio = Negocio::findOrFail($cuenta->idnegocio);
        $cliente = Cliente::findOrFail($negocio->idcliente);
        $prestamo = Prestamo::findOrFail($cuenta->idprestamo);
        $tipo_credito = TipoCredito::findOrFail($cuenta->idtipocredito);

        if ($prestamo->estado == 'COMPLETO') 
        {

            $costo = intdiv($prestamo->montooriginal, 50) * 2.25;
            $montoreal = $prestamo->montooriginal;

            $vistaurl = 'reportes/desembolso';

            $name='Desembolso';

            return $this -> desemPDF($vistaurl,$cuenta,$cliente,$prestamo,$montoreal,$costo,$name);

        }else{

            $cuentaAnterior = Cuenta::findOrFail($prestamo->cuentaanterior);
            $prestamoAnterior = Prestamo::findOrFail($cuentaAnterior->idprestamo);

            $costo = intdiv($prestamo->montooriginal, 50) * 2.25;
            $montoreal = $prestamo->montooriginal;

            $vistaurl = 'reportes/desembolsoRefinanciamientoSinMora';

            $name='algo';

            return $this -> desemMoraPDf2($vistaurl,$cuenta, $cuentaAnterior, $prestamoAnterior, $cliente, $prestamo, $montoreal, $costo,$name);
        }
           
    }

    public function desemPDF($vistaurl,$cuenta,$cliente,$prestamo,$montoreal,$costo,$name){
        $view=\View::make($vistaurl,compact('cuenta','cliente','prestamo','montoreal','costo'))->render();
        $pdf =\App::make('dompdf.wrapper');

        $pdf->loadHTML($view);
        return $pdf->stream($name);
    }

    public function desemMoraPDf($vistaurl,$cuenta, $cuentaAnterior, $prestamoAnterior, $cliente, $prestamo, $montoreal, $costo,$name){
        $view=\View::make($vistaurl,compact('cuenta','cuenta', 'cuentaAnterior', 'prestamoAnterior', 'cliente', 'prestamo', 'montoreal', 'costo'))->render();
        $pdf =\App::make('dompdf.wrapper');

        $pdf->loadHTML($view);
        return $pdf->stream($name);
    }

    public function desemMoraPDf2($vistaurl,$cuenta, $cuentaAnterior, $prestamoAnterior, $cliente, $prestamo, $montoreal, $costo,$name){
        $view=\View::make($vistaurl,compact('cuenta','cuenta', 'cuentaAnterior', 'prestamoAnterior', 'cliente', 'prestamo', 'montoreal', 'costo'))->render();
        $pdf =\App::make('dompdf.wrapper');

        $pdf->loadHTML($view);
        return $pdf->stream($name);
    }

}
