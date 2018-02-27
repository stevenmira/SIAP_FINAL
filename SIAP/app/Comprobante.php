<?php

namespace siap;

use Illuminate\Database\Eloquent\Model;

class Comprobante extends Model
{
    protected $table = 'comprobante';

    
    protected $primaryKey='idcomprobante';

    protected $fillable = [
        'estadodos','gastosadmon','gastosnotariales','mora','total','fechacomprobante','estado',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];
    
    //RELACION CON TABLA CLIENTE 
    public function cuenta(){
        return $this->hasMany(Cuenta::class);
    }
    
}
