<?php

namespace siap\Http\Controllers;

use Illuminate\Http\Request;

use siap\Http\Requests;



class ImprimirController extends Controller
{
    public function index()
	{  
        $usuarioactual=\Auth::user();
		return view('reporteriaEmpty.index')->with('usuarioactual',  $usuarioactual);
	}

	public function licitacionPDF()
	{
        $vistaurl = "reporteriaEmpty/reportes/licitacion";
        $name = "FormatoCarteraPagos";
        $tipo = "vertical";
  		return $this -> crearPDF($vistaurl,$name,$tipo);
	}

    public function carteraPDF()
    {
        $vistaurl = "reporteriaEmpty/reportes/cartera";
        $name = "FormatoCarteraClientes";
        $tipo = "horizontal";
        return $this -> crearPDF($vistaurl,$name,$tipo);
    }

    public function desembolsoPDF()
    {
        $vistaurl = "reporteriaEmpty/reportes/desembolso";
        $name = "FormatoDesembolso";
        $tipo = "vertical";
        return $this -> crearPDF($vistaurl,$name,$tipo);
    }

    public function desembolsoRefinanciamientoPDF()
    {
        $vistaurl = "reporteriaEmpty/reportes/desembolsoRefinanciamiento";
        $name = "FormatoDesembolsoRefinanciamiento";
        $tipo = "vertical";
        return $this -> crearPDF($vistaurl,$name,$tipo);
    }

    public function estadoCuentaPDF()
    {
        $vistaurl = "reporteriaEmpty/reportes/estadoCuenta";
        $name = "FormatoEstadoCuenta";
        $tipo = "vertical";
        return $this -> crearPDF($vistaurl,$name,$tipo);
    }

    public function estadoCuentaVencidoPDF()
    {
        $vistaurl = "reporteriaEmpty/reportes/estadoCuentaVencido";
        $name = "FormatoEstadoCuentaVencido";
        $tipo = "vertical";
        return $this -> crearPDF($vistaurl,$name,$tipo);
    }

    public function pagarePDF()
    {
        $vistaurl = "reporteriaEmpty/reportes/pagare";
        $name = "FormatoPagare";
        $tipo = "vertical";
        return $this -> crearPDF($vistaurl,$name,$tipo);
    }

    public function reciboPDF()
    {
        $vistaurl = "reporteriaEmpty/reportes/recibo";
        $name = "FormatoRecibo";
        $tipo = "vertical";
        return $this -> crearPDF($vistaurl,$name,$tipo);
    }

    public function crearPDF($vistaurl,$name,$tipo)
    {

        $view=\View::make($vistaurl)->render();
        $pdf =\App::make('dompdf.wrapper');
        if ($tipo == "horizontal") {
            $pdf->loadHTML($view)->setPaper('Letter', 'landscape');
        }else{
            $pdf->loadHTML($view);
        }
        return $pdf->stream($name);
    }

}
