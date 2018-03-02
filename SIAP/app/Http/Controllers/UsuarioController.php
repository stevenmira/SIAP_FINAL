<?php

namespace siap\Http\Controllers;

use Illuminate\Http\Request;
use siap\User;
use siap\TipoUsuario;
use siap\Http\Requests;

use Illuminate\Support\Facades\Response;
use siap\Http\Requests\UsuarioFormRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class UsuarioController extends Controller
{
   
    public function index(Request $request)
    {
       	$usuarioactual=\Auth::user();
        $tipousuario=TipoUsuario::all();
        $usuarios= User::orderBy('created_at','desc')->paginate(10);
          
        return view('usuario.index',compact('usuarios'),["usuarios"=>$usuarios, "usuarioactual"=>$usuarioactual,"tiposusuario"=>$tipousuario]);
    }

  
    public function create()
    {
     $usuarioactual=\Auth::user();
     $tipousuario = TipoUsuario::orderBy('idtipousuario','asc');
     return view('usuario.create',["usuarioactual"=>$usuarioactual,"tipousuario"=>$tipousuario]);
    }

    public function store(UsuarioFormRequest $request)        //Para almacenar
    {
        $usuarioactual=\Auth::user();
        $tipousuario=TipoUsuario::all();
        $usuarios= User::orderBy('created_at','desc')->paginate(10);
        
     $data = $request;
     $usuario= new User;
     $usuario->nombre =  $data['nombre'];
   
     $usuario->name=$data['name'];
     $usuario->email=$data['email'];
     $usuario->idtipousuario=$data['idtipousuario'];
     $usuario->password=bcrypt($data['password']);
     $usuario->save();
     
     Session::flash('create',"Usuario agregado correctamente");
    
     return redirect('usuario');
     
     
    
            
    }

    public function edit($id)
    {
        $usuarioactual=\Auth::user();
        $tipousuario=TipoUsuario::all();

        $usuario = User::findOrFail($id);
        return view('usuario.edit',[  "tipousuario"=>$tipousuario,"usuario"=>$usuario,"usuarioactual"=>$usuarioactual]);   
        
    }
    
     public function update(Request $request, $id)
    {
     $usuario = User::findOrFail($id);
     $data = $request;
     $usuario->nombre =  $data['nombre'];
     $usuario->name=$data['name'];
     $usuario->email=$data['email'];
     $usuario->idtipousuario=$data['idtipousuario'];
     $usuario->password=bcrypt($data['password']);
     $usuario->update();
     
     Session::flash('update',"El Usuario: ".$usuario->nombre. " con Username: " .$usuario->name  ." ha sido editado correctamente");
       
    return redirect('usuario');
    }

    public function destroy($id)
    {
        $usuarioactual=\Auth::user();

        $usuario = User::findOrFail($id);
        $usuario->delete();
         
        Session::flash('delete',"Usuario Eliminado correctamente");
         return back();

    }
    

    public function download(){
       
        $filename = 'manual.pdf';
        $tempImage = tempnam(sys_get_temp_dir(), $filename);
        copy('./img/manual.pdf', $tempImage);
        
        return response()->download($tempImage, $filename);
        
    }


}
