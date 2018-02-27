<?php

namespace siap;

use Illuminate\Database\Eloquent\Model;

class cuenta extends Model
{
    protected $table = 'cuenta';

    
    protected $primaryKey='idcuenta';

    protected $fillable = [
        'idnegocio', 'idprestamo', 'idtipocredito', 'montocapital','interes','fechaultimapago','estado',
        'capitalanterior','mora','cuotaatrasada','numeroprestamo',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];
    
    //RELACION CON TABLA Negocio 
    public function negocio(){
        return $this->belongsTo(Negocio::class);
    }
     //RELACION CON TABLA TipoCredito 
     public function tipoCredito(){
        return $this->belongsTo(TipoCredito::class);
    }
     //RELACION CON TABLA Prestamo 
     public function prestamo(){
        return $this->belongsTo(Prestamo::class);
    }
    //Relacion con Tabla DetalleLiquidacion
    public function detalleLiquidacion(){
        return $this->hasMany(DetalleLiquidacion::class);
    }

}
