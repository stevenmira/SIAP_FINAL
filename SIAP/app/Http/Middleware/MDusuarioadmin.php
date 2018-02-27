<?php

namespace siap\Http\Middleware;

use siap\User;
use siap\TipoUsuario;
use Closure;

class MDusuarioadmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle( $request, Closure $next)
    {
        
        $usuarioactual=\Auth::user();
      

        if($usuarioactual->idtipousuario!=1){
            

        }
        return $next($request);
    
    }
}
