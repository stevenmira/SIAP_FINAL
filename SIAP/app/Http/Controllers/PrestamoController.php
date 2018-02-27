<?php

namespace siap\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

use siap\Http\Requests;
use siap\Prestamo;
use siap\Cuenta;

class PrestamoController extends Controller
{
    public function destroy(Request $request,$idcuenta)
    {
        $usuarioactual=\Auth::user();

        $cuenta = Cuenta::findOrFail($idcuenta);
        $prestamo = Prestamo::where('idprestamo',$cuenta->idprestamo)->first();
        $estado  = $prestamo->estadodos;

        if ($estado == 'ACTIVO') {

             $prestamo->estadodos =$request->get('state');
             $prestamo->update();
             Session::flash('inactivoP'," ".$prestamo->estadodos.' ');
             

         }elseif ($estado == 'CERRADO') {
            $prestamo->estadodos =$request->get('state');
             $prestamo->update();
             Session::flash('inactivoP'," ".$prestamo->estadodos.' ');
         }else{

            $prestamo->estadodos =$request->get('state');
            $prestamo->update();
            Session::flash('inactivoP'," ".$prestamo->estadodos.' ');
         }

         return Redirect::to('cuenta/'.$idcuenta);
    }
}
