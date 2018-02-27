<?php

namespace siap\Http\Controllers;

use Illuminate\Http\Request;

use siap\Http\Requests;
use siap\Cartera;
use Illuminate\Support\Facades\Redirect;
use siap\Http\Requests\CarterasFormRequest;

use Illuminate\Support\Facades\Session;

use DB;



class CarteraController extends Controller
{
   
    public function index(Request $request)
    {
    	if ($request)
    	{
    		$usuarioactual=\Auth::user();
            $query=trim($request->get('searchText'));
            $consulta = Cartera::where('estado','=','ACTIVO')->get();
    		$cartera=DB::table('cartera')->where('nombre','LIKE','%'.$query.'%')->where('cartera.estado','=','ACTIVO')->orderBy('idcartera')->paginate(7);
    		return view('carteras.index',["carteras"=>$cartera,"consulta"=>$consulta,"searchText"=>$query,"usuarioactual"=>$usuarioactual]);

    	}

    }
    public function create()
    {
        $usuarioactual=\Auth::user();
        
    	return view("carteras.create",["usuarioactual"=>$usuarioactual]);
    }
    public function store(CarterasFormRequest $request)
    {

        $carteras = Cartera::all();

        foreach ($carteras as $cartera) {
            if($cartera->nombre== $request->get('nombre'))
            {
                Session::flash('error', 'Ya existe una cartera con el nombre: '.$cartera->nombre.'');
                return Redirect::to('carteras');
            }
        }

    	$usuarioactual=\Auth::user();
        $cartera=new Cartera;
    	$cartera->nombre= $request->get('nombre');
        $cartera->estado = 'ACTIVO';
        $cartera->ejecutivo= $request->get('ejecutivo');
        $cartera->supervisor= $request->get('supervisor');
    	$cartera->save();
        Session::flash('create', ' '.$cartera->nombre.' ');
    	return Redirect::to('carteras');
 
    }
    public function show($id)
    {
    	$usuarioactual=\Auth::user();
        return view("carteras.show",["carteras"=>Cartera::findOrFail($id),"usuarioactual"=>$usuarioactual]);
    }
    public function edit($id)
    {
        $usuarioactual=\Auth::user();
        $cartera= Cartera::findOrFail($id);
    	return view("carteras.edit",["cartera"=>Cartera::findOrFail($id),"usuarioactual"=>$usuarioactual]);
    }
    public function update(CarterasFormRequest $request, $id)
    {
    	$usuarioactual=\Auth::user();
        $cartera=Cartera::findOrFail($id);
        $cartera->nombre=$request->get('nombre');
        $cartera->ejecutivo= $request->get('ejecutivo');
        $cartera->supervisor= $request->get('supervisor');
        $cartera->update();
        
        Session::flash('update', ' '.$cartera->nombre.' ');
    	return Redirect::to('carteras');
    }
    public function destroy($id)
    {

        $usuarioactual=\Auth::user();

        $cartera = Cartera::findOrFail($id);
        $estado  = $cartera->estado;

        if ($estado == 'ACTIVO') {

             $cartera->estado = 'INACTIVO';
             $cartera->update();
             Session::flash('activo'," ".$cartera->nombre.' ');
             

         }else{

            $cartera->estado = 'ACTIVO';
            $cartera->update();
            Session::flash('inactivo'," ".$cartera->nombre.' ');
            return Redirect::to('cartera/inactiva');
         }

         return Redirect::to('carteras');

    }

     //Gestión de Carteras Inactivas

    public function inactivos(Request $request)
    {


        if ($request)
        {
            $usuarioactual=\Auth::user();
            $query=trim($request->get('searchText'));
            $consulta = Cartera::where('estado','=','INACTIVO')->get();
            $cartera=DB::table('cartera')
            ->where('nombre','LIKE','%'.$query.'%')
            ->where('cartera.estado','=','INACTIVO')
            ->orderBy('idcartera')
            ->paginate(7);
            return view('carteras.inactiva.index',["carteras"=>$cartera,"consulta"=>$consulta,"searchText"=>$query,"usuarioactual"=>$usuarioactual]);

        }
     }   



}


