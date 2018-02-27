<?php

namespace siap;
use Carbon\Carbon; //Para la zona fecha horaria

use Illuminate\Database\Eloquent\Model;

class Fecha extends Model
{
    public static function spanish()
    {
    	$fecha_actual = Carbon::now();
        $fecha_actual = $fecha_actual->format('d-m-Y');

    	$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        
        $fecha_actual =  $dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y');

        return $fecha_actual;
    }
}
