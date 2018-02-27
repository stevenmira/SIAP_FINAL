<?php

namespace siap\Http\Controllers\Auth;
use siap\User;
use siap\TipoUsuario;
use Validator;
use siap\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;
use siap\Fecha;
use Carbon\Carbon; 
use siap\Prestamo;
use DB;


class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;


    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
        $this->middleware('guest', ['except' => 'getLogout']);
       
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
   


//login

       protected function getLogin()
    {
        $fecha_actual = Fecha::spanish();
        return view("login")->with("fecha_actual",$fecha_actual);
    }


       

        public function postLogin(Request $request)
   {
    $fecha_actual = Fecha::spanish();
    $this->validate($request, [
        'name' => 'required',
        'password' => 'required',
    ]);



    $credentials = $request->only('name', 'password');



    if ($this->auth->attempt($credentials, $request->has('remember')))
    {
    
       $usuarioactual=\Auth::user();
       //funcion que comprueba los prestamos vencidos
       $fecha_actual = Carbon::now();
       $fecha_actual = $fecha_actual->format('Y-m-d');
       $prestamos = Prestamo::all();
       foreach ($prestamos as $prestamo) {
        if($prestamo->fechaultimapago < $fecha_actual && $prestamo->estadodos=='ACTIVO')
        {
            $prestamo->estadodos = 'VENCIDO';
            $prestamo->update();
        }
       }

       

       
         return view('/principio')->with("usuarioactual",  $usuarioactual);
       
   
    }

    Session::flash('message','Usuario o Contraseña Incorrectos');
    return view("login")->with("fecha_actual",$fecha_actual);;

    }


//login

 //registro   


        protected function getRegister()
    {
       $usuarioactual=\Auth::user();
       return view("registro")->with("usuarioactual",  $usuarioactual);
    }


        

protected function postRegister(Request $request)
{
    

    $data = $request;


    $usuario= new User;
    $usuario->nombre  =  $data['nombre'];
    $usuario->name  =  $data['name'];
    $usuario->email=$data['email'];
    $usuario->idtipousuario=$data['idtipousuario'];
    $usuario->password=bcrypt($data['password']);
    $usuario->save();
    
    
    Session::flash('message',"Usuario agregado correctamente");
    return back();
               
    
   

   

}
public function tregistro()
    {

        $tiposusuario=TipoUsuario::all();
        return view('registro')->with("tiposusuario",$tiposusuario);
        
    }

//registro

protected function getLogout()
    {
        $this->auth->logout();

        Session::flush();

        return redirect('login');
    }






}
