<?php

namespace siap\Http\Controllers;

use Illuminate\Http\Request;

use siap\Http\Requests;
use siap\Http\Requests\NegocioFormRequest;

use siap\Negocio;
use siap\Cliente;
use siap\Fecha;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

use Carbon\Carbon; //Para la zona fecha horaria

use DB;

class NegocioController extends Controller
{
    public function getNegocios($idcliente)
    {
    	$usuarioactual=\Auth::user();

    	$cliente = Cliente::where('idcliente','=',$idcliente)->first();

    	$negocios = DB::table('negocio')
    	->where('idcliente','=', $idcliente)
    	->orderBy('idcliente','desc')
    	->paginate(15);

    	//Obtenemos la fecha de hoy en español usando carbon y array
        $fecha_actual = Fecha::spanish();

    	return view('negocio.listaNegocios', ['negocios'=>$negocios, 'cliente'=>$cliente, 'fecha_actual'=>$fecha_actual, 'usuarioactual'=>$usuarioactual]);
    }

    public function newNegocio($idcliente)
    {
    	$usuarioactual=\Auth::user();

        //Obtenemos la fecha de hoy en español usando carbon y array
        $fecha_actual = Fecha::spanish();

    	$cliente = Cliente::where('idcliente','=',$idcliente)->first();

    	return view('negocio.newNegocio', ['cliente'=>$cliente, 'fecha_actual'=>$fecha_actual, 'usuarioactual'=>$usuarioactual]);
    }

    public function store(NegocioFormRequest $request)		//Para almacenar
    {
    	try{
                DB::beginTransaction();

        		$negocio = new Negocio;

        		$idcliente = $request->get('idcliente');

        		$negocio->idcliente = $idcliente;
        		$negocio->nombre = $request->get('nombreNegocio');
                $negocio->actividadeconomica = $request->get('actividadEconomica');
                $negocio->direccionnegocio = $request->get('direccionNegocio');
                $negocio->estado = 'ACTIVO';
                $negocio->save();

                Session::flash('create', ' '.$negocio->actividadeconomica.' ');

           DB::commit();

        } catch(\Exception $e)
        {
          DB::rollback();
          Session::flash('error', ''.' No se pudo guardar el negocio, algo salió mal');
        }   	

    	return Redirect::to('negocios/list/'.$idcliente);
    }

    public function edit($idnegocio)
    {
    	$usuarioactual=\Auth::user();

        //Obtenemos la fecha de hoy en español usando carbon y array
        $fecha_actual = Fecha::spanish();

        //Búscamos el negocio
        $negocio = Negocio::findOrFail($idnegocio);
        $cliente = Cliente::findOrFail($negocio->idcliente);

        return view('negocio.edit', ['negocio'=>$negocio, 'cliente'=>$cliente, 'fecha_actual'=>$fecha_actual, 'usuarioactual'=>$usuarioactual]);
    }

    public function update(NegocioFormRequest $request, $idnegocio)
    {	
        $usuarioactual=\Auth::user();

        try{
                DB::beginTransaction();
            
                //Encontramos el negocio del cliente
                $negocio = Negocio::findOrFail($idnegocio);

                //actualizamos datos del cliente
                $negocio->nombre = $request->get('nombreNegocio');
                $negocio->actividadeconomica = $request->get('actividadEconomica');
                $negocio->direccionnegocio = $request->get('direccionNegocio');
                $negocio->update();

                Session::flash('update', ' '.$negocio->actividadeconomica.' ');
                
           DB::commit();

        } catch(\Exception $e)
        {
          DB::rollback();
          Session::flash('error', ''.' No se pudo actualizar datos del negocio, algo salió mal');

        }       

        $negocio = Negocio::findOrFail($idnegocio);
        return Redirect::to('negocios/list/'.$negocio->idcliente);
    
    }

    public function destroy($idnegocio)
    {
    	$usuarioactual=\Auth::user();

        $negocio = Negocio::findOrFail($idnegocio);
        $estado  = $negocio->estado;

        if ($estado == 'ACTIVO') {

             $negocio->estado = 'INACTIVO';
             $negocio->update();
             Session::flash('activo'," ".$negocio->nombre.' ');
             
         }else{

            $negocio->estado = 'ACTIVO';
            $negocio->update();
            Session::flash('inactivo'," ".$negocio->nombre.' ');
     
         }

         return Redirect::to('negocios/list/'.$negocio->idcliente);
    }
}
