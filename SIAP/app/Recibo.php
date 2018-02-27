<?php

namespace siap;

use Illuminate\Database\Eloquent\Model;

class Recibo extends Model
{
    protected $table = 'recibo';
    
    protected $primaryKey='idrecibo';

    protected $fillable = [
        'numerico',
        'estado', 
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];
}
