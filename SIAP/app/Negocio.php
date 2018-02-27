<?php

namespace siap;

use Illuminate\Database\Eloquent\Model;

class negocio extends Model
{
    protected $table = 'negocio';

    
    protected $primaryKey='idnegocio';

    protected $fillable = [
        'idcliente', 'nombre', 'actividadeconomica', 'direccionnegocio', 'estado'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];

    //RELACION con clase Cuenta
    public function cuenta(){
        return $this->hasMany(Cuenta::class);
    }

    //RElacion con clase Cliente
    public function cliente(){
        return $this->belongsTo(Cliente::class);
    }


    public static function negocios($id)
    {
        return Negocio::where('idcliente','=',$id)->where('estado','=','ACTIVO')->get();
    }

}
