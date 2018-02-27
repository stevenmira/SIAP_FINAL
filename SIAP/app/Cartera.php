<?php

namespace siap;

use Illuminate\Database\Eloquent\Model;

class cartera extends Model
{
    protected $table = 'cartera';

    
    protected $primaryKey='idcartera';

    protected $fillable = [
        'nombre',
        'estado',
        'ejecutivo',
        'supervisor', 
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];

    //Relacion con tabla Cliente
    public function cliente(){
        return $this->hasMany(Cliente::class);
    }
}
