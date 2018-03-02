<?php

namespace siap\Http\Controllers;

use Illuminate\Http\Request;

use siap\Http\Requests;
use siap\Http\Requests\ClienteFormRequest;
use siap\Http\Requests\ClienteEditFormRequest;

use siap\Negocio;
use siap\Cartera;
use siap\Cliente;
use siap\Fecha;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon; //Para la zona fecha horaria

use DB;

class ClienteController extends Controller
{
   
    public function index(Request $request)
    {

    	if($request)
    	{
            $usuarioactual=\Auth::user();

            //Obtenemos la fecha de hoy en español usando carbon y array
            $fecha_actual = Fecha::spanish();
            
    		$query = trim($request->get('searchText'));

            $consulta = DB::table('cliente')->where('cliente.estado','=','ACTIVO')->orderby('cliente.apellido','asc')->get();

    		$clientes = DB::table('cliente as cliente')
            ->select('cliente.idcliente', 'cliente.nombre', 'cliente.apellido',  'cliente.dui', 'cliente.estado', 'ca.nombre as nombreCartera')
            ->join('cartera as ca','cliente.idcartera','=','ca.idcartera')
            ->orwhere('cliente.dui','LIKE','%'.$query.'%')
            ->where('cliente.estado','=','ACTIVO')
    		->orderBy('cliente.apellido','asc')
    		->paginate(25);

    		return view('cliente.index',["clientes"=>$clientes, "consulta"=>$consulta, "fecha_actual"=>$fecha_actual, "searchText"=>$query,"usuarioactual"=>$usuarioactual]);
    	}

    }

    
    public function create()
    {
        //Obtenemos la fecha de hoy en español usando carbon y array
        $fecha_actual = Fecha::spanish();

        $usuarioactual=\Auth::user();
        $carteras = Cartera::where('estado','=','ACTIVO')->orderBy('cartera.nombre','asc');

    	return view('cliente.create',["carteras"=>$carteras, "fecha_actual"=>$fecha_actual, "usuarioactual"=>$usuarioactual]);
    }

    public function store( ClienteFormRequest $request)		//Para almacenar
    {
        /*$usuarioactual=\Auth::user();*/

        try{
                DB::beginTransaction();

                $cliente = new Cliente;

                $cliente->idcartera = $request->get('idcartera');
                $cliente->codigo = '0';                                     //quemado
                $cliente->nombre = $request->get('nombre');
                $cliente->apellido = $request->get('apellido');
                $cliente->nit = $request->get('nit');
                $cliente->dui = $request->get('dui');
                $cliente->lugarexpedicion = $request->get('lugarexpedicion');
                $cliente->fechaexpedicion = $request->get('fechaexpedicion');
                $cliente->edad = $request->get('edad');
                $cliente->telefonocel = $request->get('telefonocel');
                $cliente->telefonofijo = $request->get('telefonofijo');
                $cliente->direccion = $request->get('direccionCliente');
                $cliente->profesion = $request->get('profesion');
                $cliente->estado = 'ACTIVO';

                $cliente->save();

                Session::flash('create', ' '.$cliente->nombre.' '.$cliente->apellido.' ');


                

           DB::commit();

        } catch(\Exception $e)
        {
          DB::rollback();
          Session::flash('error', ''.' No se pudo guardar los datos del cliente, algo salió mal');
        }   	

    	return Redirect::to('cliente');
    }

    public function show($id)		//Para mostrar
    {
        $usuarioactual=\Auth::user();

        //Obtenemos la fecha de hoy en español usando carbon y array
        $fecha_actual = Fecha::spanish();

        $cliente = Cliente::findOrFail($id);
        $cartera = Cartera::findOrFail($cliente->idcartera);

        $negocios = DB::table('negocio')
        ->where('idcliente','=', $id)
        ->orderBy('idnegocio','asc')
        ->get();

        return view('cliente.show',["cliente"=>$cliente, "negocios"=>$negocios, "cartera"=>$cartera, "fecha_actual"=>$fecha_actual, "usuarioactual"=>$usuarioactual]);   
    }

    public function edit($id)
    {
        $usuarioactual=\Auth::user();

        //Obtenemos la fecha de hoy en español usando carbon y array
        $fecha_actual = Fecha::spanish();

        //Búscamos el cliente junto con sus relaciones
        $cliente = Cliente::findOrFail($id);
        $cartera = Cartera::findOrFail($cliente->idcartera);

        //Consultamos todas las carteras
        $carteras = Cartera::where('estado','=','ACTIVO')->orderBy('cartera.nombre','asc')->get();

         return view('cliente.edit',["cliente"=>$cliente, "cartera"=>$cartera, "carteras"=>$carteras, "fecha_actual"=>$fecha_actual, "usuarioactual"=>$usuarioactual]);   
        
    }

    public function update(ClienteEditFormRequest $request, $id)
    {	
        $usuarioactual=\Auth::user();

        try{
                DB::beginTransaction();

                //Se valida que el dui ingresado no exista en la tabla cliente

                //Se resetea el dui del cliente
                $cliente = Cliente::findOrFail($id);
                $dui_original = $cliente->dui;      // Guardamos el dui que tenía anteriomente
                $cliente->dui = 'reset';           // Asignamos reset para que no se repita en la base
                $cliente->update();

                //Se valida que el dui no este en uso                             
                $dui = $request->get('dui');
                $dui_unique = Cliente::where('dui','=',$dui)->first();  // Busca un cliente con el dui ingresado


                if(!is_null($dui_unique))                         // Es decir, encontró ya en uso el DUI
                {

                    Session::flash('unicidad', ' '.$dui.' ');     // Existe dui, se crea el mensaje
                    $cliente->dui = $dui_original;               // Se vuelve a guardar el cliente con el dui original
                    $cliente->update();                         // Falló la actualización se retorna a index
                    return Redirect::to('cliente');
                }

                
                //Actualizamos datos de la cartera seleccionada

                $cliente->idcartera = $request->get('idcartera');
                
                //Actualizamos datos del cliente
                $cliente->codigo = '0';                                     //quemado
                $cliente->nombre = $request->get('nombre');
                $cliente->apellido = $request->get('apellido');
                $cliente->dui = $dui;
                $cliente->lugarexpedicion = $request->get('lugarexpedicion');
                $cliente->fechaexpedicion = $request->get('fechaexpedicion');
                $cliente->nit = $request->get('nit');
                $cliente->edad = $request->get('edad');
                $cliente->direccion = $request->get('direccionCliente');
                $cliente->telefonocel = $request->get('telefonocel');
                $cliente->telefonofijo = $request->get('telefonofijo');
                $cliente->profesion = $request->get('profesion');
                $cliente->estado = 'ACTIVO';

                $cliente->update();

                Session::flash('update', ' '.$cliente->nombre.' '.$cliente->apellido.' ');
                
           DB::commit();

        } catch(\Exception $e)
        {
          DB::rollback();
          Session::flash('error', ''.' No se pudo actualizar al cliente, algo salió mal');

        }       

        return Redirect::to('cliente');
    
    }

    //Éste metodo funciona para ambos casos de estado ACTIVO o INACTIVO
    public function destroy($id)
    {
        $usuarioactual=\Auth::user();

        $cliente = Cliente::findOrFail($id);
        $estado  = $cliente->estado;

        if ($estado == 'ACTIVO') {

             $cliente->estado = 'INACTIVO';
             $cliente->update();
             Session::flash('activo'," ".$cliente->nombre.' '.$cliente->apellido. " ");
             

         }else{

            $cliente->estado = 'ACTIVO';
            $cliente->update();
            Session::flash('inactivo'," ".$cliente->nombre.' '.$cliente->apellido. " ");
            return Redirect::to('clientes/inactivos');
         }

         return Redirect::to('cliente');

    }


    //Gestión de Clientes Inactivos

    public function inactivos(Request $request)
    {
        if($request)
        {
            $usuarioactual=\Auth::user();

            //Obtenemos la fecha de hoy en español usando carbon y array
            $fecha_actual = Fecha::spanish();

            $query = trim($request->get('searchText'));

            $consulta = DB::table('cliente')->where('cliente.estado','=','INACTIVO')->orderby('cliente.apellido','asc')->get();

            $clientes = DB::table('cliente as cliente')
            ->select('cliente.idcliente', 'cliente.nombre', 'cliente.apellido',  'cliente.dui', 'cliente.estado', 'ca.nombre as nombreCartera')
            ->join('cartera as ca','cliente.idcartera','=','ca.idcartera')
            ->orwhere('cliente.dui','LIKE','%'.$query.'%')
            ->where('cliente.estado','=','INACTIVO')
            ->orderBy('cliente.apellido','asc')
            ->paginate(25);

            return view('cliente.inactivo.index',["clientes"=>$clientes, "consulta"=>$consulta, "searchText"=>$query, "fecha_actual"=>$fecha_actual, "usuarioactual"=>$usuarioactual]);
        }
    }

}
