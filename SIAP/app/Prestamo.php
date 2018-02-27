<?php

namespace siap;

use Jenssegers\Date\Date;

use Illuminate\Database\Eloquent\Model;

class prestamo extends Model
{
    protected $table = 'prestamo';

    
    protected $primaryKey='idprestamo';

    protected $fillable = [
        'fecha', 'monto', 'cuotadiaria','estado','fechaultimapago','montooriginal','estadodos','cuentaanterior'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];
    
    //RElacion con tabla Cuenta
    public function cuenta(){
        return $this->hasMany(Cuenta::class);
    }

    public function getFechaAttribute($date)
    {
        if ($date != null) {
            return new Date($date);
        }
        
    }
}
