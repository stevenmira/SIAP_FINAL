<?php


use siap\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/



//Cliente



//Formatos de reportes vacios
Route::get('imprimir','ImprimirController@index');
Route::get('imprimir/licitacionPDF','ImprimirController@licitacionPDF');
Route::get('imprimir/carteraPDF','ImprimirController@carteraPDF');
Route::get('imprimir/desembolsoPDF','ImprimirController@desembolsoPDF');
Route::get('imprimir/desembolsoRefinanciamientoPDF','ImprimirController@desembolsoRefinanciamientoPDF');
Route::get('imprimir/estadoCuentaPDF','ImprimirController@estadoCuentaPDF');
Route::get('imprimir/estadoCuentaVencidoPDF','ImprimirController@estadoCuentaVencidoPDF');
Route::get('imprimir/pagarePDF','ImprimirController@pagarePDF');
Route::get('imprimir/reciboPDF','ImprimirController@reciboPDF');

//Reportes
Route::get('record/pagare/{id}','RecordClienteController@pagare');
Route::get('record/recibo/{id}','RecordClienteController@recibo');
Route::get('record/imprimir','RecordClienteController@show');

Route::get('cuenta/carteraPagosPDF/{id}', 'LiquidacionController@carteraPDF');

Route::get('calcular-credito/imprimir','calcularCreditoController@generarPDF');

Route::get('cuenta/desembolsoPDF/{idcuenta}','CuentaController@desembolsoPDF');
Route::get('cuenta/desembolsoPDF2/{idcuenta}','CuentaController@desemSinMoraPDF');

Route::get('agregarestado/estadoPDf/{id}','ComprobanteController@estadoPDF');

Route::get('cuenta/carteraRealPDF/{id}','LiquidacionController@carteraRealPDF');

Route::get('lista/clientesPDF/{id}','CarteraClientController@carteraClientPDF');


//consulta a la base por jquery
Route::get('search/{id}','TipoCreditoController@autoComplete');
//ERRORES 

Route::get('error', function(){ 
    abort(500);
    abort(503);
    abort(404);
});


//Prestamos
Route::resource('prestamo','PrestamoController');


//VIstas para usuarios sin logearse
Route::group(['middleware' => 'guest'], function () {
    Route::get('/','Auth\AuthController@getLogin');
    Route::get('login', 'Auth\AuthController@getLogin');
    Route::post('login', ['as' =>'login', 'uses' => 'Auth\AuthController@postLogin']); 
    Route::get('register', 'Auth\AuthController@getRegister');
    Route::get('register', 'Auth\AuthController@tregistro'); 
    Route::post('register', ['as' => 'auth/register', 'uses' => 'Auth\AuthController@postRegister']);

});



//Vistas comunes para los dos tipos de usuarios
Route::group(['middleware' => 'auth'], function () {
	Route::get('/', 'HomeController@index');
    Route::get('home', 'HomeController@index');
    Route::get('logout', ['as' => 'logout', 'uses' => 'Auth\AuthController@getLogout']);
    Route::resource('usuario','UsuarioController');
    Route::get('estadodecuenta/{id}', ['as' => 'idcuenta', 'uses' => 'ComprobanteController@nuevoestado']);
    Route::post('agregarestado/{id}',  'ComprobanteController@agregarestado');
    Route::resource('agregarestado',  'ComprobanteController');
   Route::post('cancelar/{id}',  'ComprobanteController@cancelar');
   Route::get('estadodecuentas/{id}', 'ComprobanteController@mostrar');
   //Calcular credito
   Route::resource('calcular-credito','calcularCreditoController');
   Route::get('mostrar-credito','calcularCreditoController@show');

   //DESCargar ayuda
   Route::get('ayuda/descargar','UsuarioController@download');

   //Record
   Route::resource('record','RecordClienteController');

   
});

//VIstas para usuarios tipo ADMINISTRADOR
Route::group(['middleware' => 'usuarioAdmin'], function () {
 
//cartera de pagos
Route::get('cuenta/carteraPagos/{id}', ['as' => 'idcuenta', 'uses' => 'LiquidacionController@cuenta']);
Route::resource('ingresarPago', 'LiquidacionController');  //edit

//Refinanciamiento de credito
Route::resource('refinanciamiento','RefinanciamientoController');
Route::resource('refinanciamiento/nuevo','RefinanciamientoController@create');

//Cliente
Route::resource('cliente','ClienteController');
Route::resource('cliente/nuevo','ClienteController@create');
Route::get('clientes/inactivos', 'ClienteController@inactivos');

//Negocio
Route::resource('negocio','NegocioController');
Route::get('negocios/list/{id}', ['as' => 'idcliente', 'uses' => 'NegocioController@getNegocios']);
Route::get('negocios/nuevo/{id}', ['as' => 'idcliente', 'uses' => 'NegocioController@newNegocio']);

//Record
Route::resource('record','RecordClienteController');

//cartera de pagos
Route::get('cuenta/carteraPagos/{id}', ['as' => 'idcuenta', 'uses' => 'LiquidacionController@cuenta']);
Route::resource('ingresarPago', 'LiquidacionController');  //edit

#Route::get('cuenta/ingresarPago/{id}', ['as' => 'iddetalleliquidacion', 'uses' => 'LiquidacionController@ingresarPago']);

//Gestionar Carteras
Route::resource('carteras','CarteraController');
Route::get('cartera/inactiva', 'CarteraController@inactivos');
Route::resource('lista/clientes','CarteraClientController');

//Cuenta
Route::get('record','RecordClienteController@index');
Route::resource('cuenta','CuentaController');
Route::get('cuenta/desembolso/{idcuenta}', ['as' => 'idcuenta', 'uses' => 'CuentaController@desembolso']);
Route::resource('credito','TipoCreditoController');
Route::resource('credito/nuevo','TipoCreditoController@create');
	
});


//VIstas para usuarios tipo EMPLEADO
Route::group(['middleware' => 'usuarioEmpleado'], function () { 
         //Credito nuevo



});