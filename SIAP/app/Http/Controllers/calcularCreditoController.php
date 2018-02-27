<?php

namespace siap\Http\Controllers;

use Illuminate\Http\Request;

use siap\Http\Requests;

use siap\Prestamo;

use Illuminate\Support\Facades\Redirect;
use siap\DetalleLiquidacion;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;




class calcularCreditoController extends Controller
{

    public function create()

    {
       $usuarioactual=\Auth::user();
       return view ('calcularCredito.create2')->with("usuarioactual",  $usuarioactual);
    }



   public function store(Request $request)
    {  

      $usuarioactual=\Auth::user();
      $nuevo_monto=0;

      $fecha = $request->input("fecha");
      $monto_capital = $request->input("monto");
      $cuota = $request->input("cuota");
      $tipo = $request->input("tipo");

      
     $monto_extra=(floor($monto_capital/50))*2.25;
     $nuevo_monto=$monto_capital+$monto_extra;


      switch ($tipo) {
            case 'normal':
               {
                if ($monto_capital  <= 80) 
                    $tipoCredito = 1;
                 else if ($monto_capital  > 80 && $monto_capital  <= 105)
                    $tipoCredito = 2;
                else 
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


   // Definir la tasa de interes
   if ($tipoCredito==1)
        $tasaInteres=0.0170;
    else if($tipoCredito==2)
          $tasaInteres=0.0110;
          else if ($tipoCredito==3)
            $tasaInteres=0.0100;
                else if ($tipoCredito==4)
                  $tasaInteres=0.0080;
                      else
                        $tasaInteres=0.0070;

      //validacion de interes diario menor a la cuota diaria

           $interesDiario=$nuevo_monto*$tasaInteres;

           if($interesDiario>$cuota)
            {
                    Session::flash('negativo3', ' Para un monto de $'.$monto_capital.' su cuota debe de ser mayor a $'.$interesDiario.' ');

                    return Redirect::to('calcular-credito/create');
           }




       //validaciones previas
                if ($monto_capital < 50 ) {
                    Session::flash('negativo', ' El pago diario no puede ser negativo, transacción fallida');

                    return Redirect::to('calcular-credito/create');
                }

                if($monto_capital > 10000)
                  {
                    Session::flash('negativo1', ' El pago diario no puede ser negativo, transacción fallida');
                    return Redirect::to('calcular-credito/create');
                }



              if($cuota < 0)
                 {
                    Session::flash('negativo2', ' El pago diario no puede ser negativo, transacción fallida');
                    return Redirect::to('calcular-credito/create');
                }




       $liquidacion = new DetalleLiquidacion;



     return view('calcularCredito.create3', ["liquidacion"=>$liquidacion,"fecha"=>$fecha, "nuevo_monto"=>$nuevo_monto, "cuota"=>$cuota, "tipoCredito"=>$tipoCredito,"interesDiario"=>$interesDiario, "tasaInteres"=>$tasaInteres, "usuarioactual"=>$usuarioactual]);
    }











    public function show()

    {
       $usuarioactual=\Auth::user();
       return view ('calcularCredito.show')->with("usuarioactual",  $usuarioactual);
    }

    public function generarPDF(Request  $request){
      $fecha = $request->input("fecha");
      $monto_capital = $request->input("monto_capital");
      $pagos_diarios = $request->input("gastos_diarios");
      $tasa_interes = $request->input("tasa_interes");

      $vistaurl = "reportes/liquidacionPrueba";

      $name = "CarteraPagos".$fecha.".pdf";

      $liquidacion = new DetalleLiquidacion;
  
      return $this -> crearPDF($vistaurl,$fecha,$monto_capital,$pagos_diarios,$tasa_interes,$liquidacion,$name);

    }

    public function crearPDF($vistaurl,$fecha,$monto_capital,$pagos_diarios,$tasa_interes,$liquidacion,$name)
    {
        
        $view=\View::make($vistaurl,compact('fecha','monto_capital','pagos_diarios','tasa_interes','liquidacion'))->render();
        $pdf =\App::make('dompdf.wrapper');

        $pdf->loadHTML($view);
        return $pdf->stream($name);
    }

 
}
