<?php

namespace siap;

use Illuminate\Database\Eloquent\Model;

class TipoUsuario extends Model
{
    //
    protected $table = 'tipo_usuario';

    
    protected $primaryKey='idtipousuario';

    protected $fillable = [
        'nombre',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
       
    ];
    public function user(){
        return $this->hasMany(User::class);
    }
}
