<?php

namespace siap\Http\Middleware;

use Closure;

class MSusuarioempleado
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $usuarioactual=\Auth::user();
        if($usuarioactual->idtipousuario!=2){
            
        }
        return $next($request);
    }
}
