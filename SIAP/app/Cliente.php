<?php

namespace siap;

use Illuminate\Database\Eloquent\Model;

class cliente extends Model
{
    protected $table = 'cliente';

    
    protected $primaryKey='idcliente';

    protected $fillable = [
        'idcartera', 'codigo', 'nombre', 'apellido', 'dui','nit','edad',
        'direccion','telefonocel','telefonofijo','estado', 'lugarexpedicion', 'fechaexpedicion'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];


    //Relacion con clase Cartera
    public function cartera(){
        return $this->belongsTo(Cartera::class);
    }

    //RELACION CON TABLA Negocio 
    public function negocio(){
        return $this->hasMany(Negocio::class);
    }

}
