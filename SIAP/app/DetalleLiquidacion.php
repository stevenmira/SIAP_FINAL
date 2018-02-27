<?php

namespace siap;

use Jenssegers\Date\Date;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon; //Para la zona fecha horaria

use DB;

class DetalleLiquidacion extends Model
{
    protected $table = 'detalle_liquidacion';

    
    protected $primaryKey='iddetalleliquidacion';

    protected $fillable = [

        'idcuenta', 'fechadiaria', 'fechaefectiva', 'monto', 'interes', 'cuotacapital', 'totaldiario', 'abonocapital', 'estado', 'contador', 'created_at', 'updated_at'

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];
    
    //Relacion con tabla Cuenta
    public function cuenta(){
        return $this->belongsTo(Cuenta::class);
    }
    //Relacion con tabla Usuario
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function cartera(){
        return $this->belongsTo(Cartera::class);
    }

    public function getFechadiariaAttribute($date)
    {
        if ($date != null) {
            return new Date($date);
        }
    }

    public function getFechaefectivaAttribute($date)
    {
        if ($date != null) {
            return new Date($date);
        }
        
    }

    public function getCreatedAtAttribute($date)
    {
        if ($date != null) {
            return new Date($date);
        }
        
    }

    public function getUpdatedAtAttribute($date)
    {
        if ($date != null) {
            return new Date($date);
        }
        
    }

    public static function calculoN_modificado($idcuenta)
    {
        //funcion para actualizar la tabla

        $usuarioactual=\Auth::user();

        //Encontramos la cuenta con sus repectivas relaciones
        $cuenta = Cuenta::findOrFail($idcuenta);
        $prestamo = Prestamo::findOrFail($cuenta->idprestamo);
        $tipo_credito = TipoCredito::findOrFail($cuenta->idtipocredito);

        $liquidaciones = DetalleLiquidacion::where('idcuenta','=',$cuenta->idcuenta)
        ->orderby('iddetalleliquidacion', 'asc')
        ->get();

        $monto_capital = $prestamo->monto;          //  $313.50
        $pivote = 0;                               //   $10
        #$pivote2 = 0;                             // 0; cuando el monto es cero  
        #$pivote3 = 0;


        foreach ($liquidaciones as $liq) {

            if($liq->abonocapital == "NO") {

              $liq->monto = round($monto_capital, 2);
              $liq->interes = round($monto_capital * $tipo_credito->interes, 2);    // 3.14
              $liq->totaldiario = round($liq->totaldiario, 2);                      // 10
              $liq->cuotacapital = round($liq->totaldiario - $liq->interes,2);      // 6.86
              $liq->update();

              $monto_capital = $liq->monto - $liq->cuotacapital;

            }
            elseif($liq->abonocapital == "SI"){

                $liq->monto = round($monto_capital,2);
                $liq->update();

                $monto_capital = $liq->monto - $liq->totaldiario;

            }elseif ($liq->abonocapital == null) {              // Modificamos la siguiente tupla

                if ($monto_capital >= $pivote) {               // Cuando el monto_capital es cero
                    $liq->monto = round($monto_capital,2);
                    $liq->update();

                    $pivote = 9999999999999999.999; //cualquier valor
                }
                else{
                    $liq->monto = null;
                    $liq->update();
                }
                

                
            }  

        }

        return $componente = 'Actualizacion de pagos';
    }

    public static function estados_cuotas($idcuenta)
    {
        //Obtenemos la fecha de hoy
        $fecha_actual = Carbon::now();
        $fecha_actual = $fecha_actual->format('Y-m-d');

        //Obtenemos el detalle_liquidacion a modificar
        $cuenta = Cuenta::findOrFail($idcuenta);
        $prestamo = Prestamo::findOrFail($cuenta->idprestamo);
        $tipo_credito = TipoCredito::findOrFail($cuenta->idtipocredito);

        $liquidaciones = DetalleLiquidacion::where('idcuenta','=',$cuenta->idcuenta)
        ->orderby('iddetalleliquidacion', 'asc')
        ->get();

        $monto_capital = $prestamo->monto;
        $n=0;

        foreach ($liquidaciones as $liq) 
        {
            if ($liq->abonocapital == "NO") {
                $monto_capital = $liq->monto - $liq->cuotacapital;
            
            }
            elseif($liq->abonocapital == "SI")
            {
                $monto_capital = $liq->monto - $liq->totaldiario;
            }

            elseif ($liq->abonocapital == null) 
            {
                if($monto_capital > 0)
                {
                        if ($liq->fechadiaria >= $fecha_actual) {
                            $liq->estado = 'PENDIENTE';
                            $liq->update();
                        }elseif ($liq->fechadiaria < $fecha_actual) {
                            $liq->estado = 'ATRASO';
                            $liq->update();
                        }

                    $intereses = round($monto_capital * $tipo_credito->interes, 2);
                    $cuotacapital = round($prestamo->cuotadiaria - $intereses);
                    $monto_capital = $monto_capital - $cuotacapital;
                    $n = $n +1;

                }else{
                    $liq->estado = 'NO VALIDO';
                    $liq->update();
                }
            }


        }
        return $n;

    }


}
