<?php

namespace siap\Http\Controllers;

use Illuminate\Http\Request;
use siap\Negocio;
use siap\Cartera;
use siap\Cliente;
use siap\Cuenta;
use siap\Prestamo;
use siap\Comprobante;
use siap\DetalleLiquidacion;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use DB;

use siap\Http\Requests;

class ComprobanteController extends Controller
{
    public function index(Request $request)
    {
        
    }

    public function show(Request $request,$id)
    {
        $usuarioactual=\Auth::user();

        $estados=DB::table('comprobante')->where('idcuenta','=',$id)
        ->orderBy('created_at','asc')
        ->paginate(10);
//SE BUSCA EL CLIENTE Y SUS DATOS QUE PERTENECE A LA CUENTA
            $cliente = DB::table('cuenta')
            ->select('cuenta.idcuenta','cuenta.interes','negocio.nombre as nnegocio',/*'cuenta.montocapital',*/'cliente.nombre', 'cliente.apellido','cliente.dui','cliente.nit','cliente.direccion','cuenta.estado','prestamo.cuotadiaria','prestamo.estadodos')
            ->join('negocio as negocio','cuenta.idnegocio','=','negocio.idnegocio')
            ->join('cliente as cliente','negocio.idcliente','=','cliente.idcliente')
            ->join('prestamo as prestamo','cuenta.idprestamo','=','prestamo.idprestamo')
            ->where('cuenta.idcuenta','=',$id)
            ->first();
            
        return view('estadoCuenta.show',["estados"=>$estados,"usuarioactual"=>$usuarioactual,"cliente"=>$cliente]);
     }

     public function mostrar(Request $request,$id)
     {
         $usuarioactual=\Auth::user();
 
         $cliente = DB::table('cuenta')
         ->select('cuenta.idcuenta','cuenta.interes','cliente.nombre', 'cliente.apellido','cliente.dui','cliente.nit','cliente.direccion','cuenta.estado','prestamo.estadodos','prestamo.cuotadiaria')
         ->join('negocio as negocio','cuenta.idnegocio','=','negocio.idnegocio')
         ->join('cliente as cliente','negocio.idcliente','=','cliente.idcliente')
         ->join('prestamo as prestamo','cuenta.idprestamo','=','prestamo.idprestamo')
         ->join('comprobante as comprobante','cuenta.idcuenta','=','comprobante.idcuenta')
         ->where('comprobante.idcomprobante','=',$id)
         ->first();
 
         $estadoc = Comprobante::findOrFail($id);
         $ultimacuota=1;
         if($estadoc->estado=="VENCIDO" || $estadoc->estado=="CERRADO"  ){
             $subtotal=$estadoc->ultimacuota+$estadoc->totalcuotasdeuda+$estadoc->totalpendiente+$estadoc->mora;
             return view('estadoCuenta.vencido.consulta',["subtotal"=>$subtotal, "ultimacuota"=>$ultimacuota,"cliente"=>$cliente,"estadoc"=>$estadoc,"id"=>$id,"usuarioactual"=>$usuarioactual]);   
          }else{
             return view('estadoCuenta.consulta',["cliente"=>$cliente,"estadoc"=>$estadoc,"id"=>$id,"usuarioactual"=>$usuarioactual]);   
         }
     }
 
    public function nuevoestado($id){
            //Usuario loggeado 
            $usuarioactual=\Auth::user();
           
            
           
            //SE BUSCA EL CLIENTE Y SUS DATOS QUE PERTENECE A LA CUENTA
    		$cliente = DB::table('cuenta')
            ->select('cuenta.idcuenta','cuenta.interes','negocio.nombre as nnegocio',/*'cuenta.montocapital',*/'cliente.nombre', 'cliente.apellido','cliente.dui','cliente.nit','cliente.direccion','cuenta.estado','prestamo.cuotadiaria','prestamo.estadodos')
            ->join('negocio as negocio','cuenta.idnegocio','=','negocio.idnegocio')
            ->join('cliente as cliente','negocio.idcliente','=','cliente.idcliente')
            ->join('prestamo as prestamo','cuenta.idprestamo','=','prestamo.idprestamo')
            ->where('cuenta.idcuenta','=',$id)
            ->first();
           
            

        //Obtenemos la fecha de hoy
        $fechaactual = Carbon::now();
        $fechaactual = $fechaactual->format('d-m-Y'); 
        $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        
        $fechaactual =  $dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y');
        
        $liquidacio=DB::table('detalle_liquidacion')->where([
            ['idcuenta','=',$id],
            ['monto','!=',null],])
            ->orderBy('monto','asc')->first();

        //<-----CALCULOS PARA ESTADOS DE CUENTA NORMALES ------>

            //SE BUSCA EL DETALLE LIQUIDACION QUE PERTENECE A LA CUENTA
            $liquidacion=DB::table('detalle_liquidacion')->where([
                ['idcuenta','=',$id],
                ['monto','!=',null],])
                ->orderBy('monto','asc')->first();
            
            //SE CALCULAN EL NUMERO DE CUOTAS ATRASADAS
            $cuotasatrasadas = DB::table('detalle_liquidacion')->where([
                ['estado', '=', 'ATRASO'],
                ['idcuenta', '=', $id],
                ])->count();         

           //SE CALCULA EL VALOR MONETARIO DE LAS COUTAS ATRASADAS
           $totalcuotas = $cuotasatrasadas * $cliente->cuotadiaria;
           $totalcuotas=round($totalcuotas,2);
        //<-------------------FINALIZA CALCULOS ESTADO NORMAL-------->
    


        //<------CALCULOS PARA ESTADO DE CUENTA VENCIDOS---------->

           //SE OBTIENEN EL NUMERO DE CUOTAS 
           $cuotaspendientes = DB::table('detalle_liquidacion')->where([
            ['estado', '=', 'ABONO'],
            ['idcuenta', '=', $id],
            ])->count();

            $cpendiente = DB::table('detalle_liquidacion')->where([
                ['estado', '=', 'ABONO'],
                ['idcuenta', '=', $id],
                ])->first();

            if($cpendiente!=null){
               $tcuotaspendientes=$cuotaspendientes*($cliente->cuotadiaria-$cpendiente->totaldiario);
            }else{
                $tcuotaspendientes=$cuotaspendientes;
            }    
         
           //Se CALCULAN EL NUMERO DE CUOTAS PENDIENTES DEL PRESTAMO
           $tcuotascanceladas=DB::table('detalle_liquidacion')->where([
            ['estado', '=', 'ATRASO'],
            ['idcuenta', '=', $id],
            ])->count();
            
            if($tcuotascanceladas==0){
                $tcuotascanceladas=DB::table('detalle_liquidacion')->where([
                    ['estado', '=', 'PENDIENTE'],
                    ['idcuenta', '=', $id],
                    ])->count();
                    $tcuotascanceladas=$tcuotascanceladas-1;
                    $totalcancelado=$tcuotascanceladas*$cliente->cuotadiaria;
                }else{
            $tcuotascanceladas=$tcuotascanceladas-1;
            $totalcancelado=$tcuotascanceladas*$cliente->cuotadiaria;
            }
           
           

            
           
            //SE OBTIENE LA ULTIMA CUOTA
            $ultimacuota=1;
           // $totalultima=$liquidacion->monto-$totalcancelado;

            //CAlCULO DE MONTO ULTIMA CUOTA
          
            
            $liquida=DetalleLiquidacion::where('idcuenta','=',$id)->orderBy('iddetalleliquidacion','DESC')->take(1)->first();
            $fechaidealpago=$liquida->fechadiaria;

           if($fechaidealpago>=Carbon::now()){
            $diasatrasados=0;
           }else{
            $diasatrasados = $fechaidealpago->diffInDays(Carbon::now());
           }
            
           $mora=$liquidacion->monto*$cliente->interes*$diasatrasados;
           $mora=round($mora,2);
        //<-------------------FEINALIZA CALCULO ESTADO DE CUENTA VENCIDO---------->
       
       //<----------------PRESTAMO CON ESTADO: CERRADO NO PUEDE AGREGAR NUEVOS ESTADOS DE CUENTA-------------->
        while($cliente->estadodos=="CERRADO"){
            Session::flash('error',"El Prestamo esta: ". $cliente->estadodos. " y no se pueden agregar mas estados de cuenta");
            return back();
        }
        //<----------------------FIN DE VALIDACION ESTADO: CERRADO----------------------------->

        //SI LA LIQUIDACION ESTA VENCIDA SE MUESTRA ESTADO DE CUENTA VENCIDO
        if($cliente->estadodos=="VENCIDO"){

            $interesDiario = $liquidacion->monto * $cliente->interes;
            $cuotaCapital = $liquidacion->monto;
           

        while ($liquidacion->monto > $cliente->cuotadiaria) {
            
            $cuotaCapital = $cliente->cuotadiaria - $interesDiario;
            $liquidacion->monto = ($liquidacion->monto - $cuotaCapital);
            $interesDiario = $liquidacion->monto * $cliente->interes;
            $liquidacion->monto=round($liquidacion->monto,2);
        }

            //CALCULO DE RANGO DE FECHAS PARA CUOTAS PENDIENTES
           /* $lpendiente=DB::table('detalle_liquidacion')->where([
                ['estado', '=', 'ATRASO'],
                ['idcuenta', '=', $id],
                ['monto','!=',null],])
                ->orderBy('monto','asc')->first();

            $fechapendiente=Carbon::parse($lpendiente->fechadiaria);
           
            $fechafinal=$fechapendiente->addDays($tcuotascanceladas); 
            
            $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
            $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
            $fechapendiente =  $dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y');
            
          
            $fechafinal=$fechafinal->format('d-m-Y');
            $dia = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
            $mese = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
            $fechafinal =  $dia[date('w')]." ".date('d')." de ".$mese[date('n')-1]. " del ".date('Y');
            */
            $subtotal= $liquidacion->monto+$totalcancelado+$tcuotaspendientes+$mora;
           $subtotal=round($subtotal,2);
            return view('estadoCuenta.vencido.create',[ "liquidacio"=>$liquidacio,"cuotaCapital"=>$cuotaCapital,"mora"=>$mora,"diasatrasados"=>$diasatrasados,"cuotaspendientes"=>$cuotaspendientes,"tcuotaspendientes"=>$tcuotaspendientes,"totalcancelado"=>$totalcancelado, "ultimacuota"=>$ultimacuota, "tcuotascanceladas"=>$tcuotascanceladas,"fechaactual"=>$fechaactual,"usuarioactual"=>$usuarioactual,"cliente"=>$cliente,"subtotal"=>$subtotal,"liquidacion"=>$liquidacion,"cuotasatrasadas"=>$cuotasatrasadas,"totalcuotas"=>$totalcuotas]);
        }
        else{
            $subtotal=$totalcuotas+$liquidacion->monto;
            return view('estadoCuenta.create',[ "fechaactual"=>$fechaactual,"liquidacion"=>$liquidacion,"usuarioactual"=>$usuarioactual,"subtotal"=>$subtotal,"cliente"=>$cliente,"cuotasatrasadas"=>$cuotasatrasadas,"totalcuotas"=>$totalcuotas]);
          }
      
    }

    public function agregarestado(Request $request,$id){
        $usuarioactual=\Auth::user();

       


        $data = $request;
        
        $cliente = DB::table('cuenta')
        ->select('cuenta.idcuenta','cuenta.interes','negocio.nombre as nnegocio','cliente.nombre','cliente.apellido','cliente.dui','cliente.nit','cliente.direccion','cuenta.estado','prestamo.estadodos','prestamo.cuotadiaria')
        ->join('negocio as negocio','cuenta.idnegocio','=','negocio.idnegocio')
        ->join('cliente as cliente','negocio.idcliente','=','cliente.idcliente')
        ->join('prestamo as prestamo','cuenta.idprestamo','=','prestamo.idprestamo')
        ->where('cuenta.idcuenta','=',$id)
        ->first();

        
        $liquidacion=DB::table('detalle_liquidacion')->where([
            ['idcuenta','=',$id],
            ['monto','!=',null],])
            ->orderBy('monto','asc')->first();

            $liquidacio=DB::table('detalle_liquidacion')->where([
                ['idcuenta','=',$id],
                ['monto','!=',null],])
                ->orderBy('monto','asc')->first();

        $cuotasatrasadas = DB::table('detalle_liquidacion')->where([
            ['estado', '=', 'ATRASO'],
            ['idcuenta', '=', $id],
            ])->count();

       $totalcuotas=$cuotasatrasadas*$cliente->cuotadiaria;

        $cuenta=Cuenta::where('idcuenta','=',$id)->first();
       
       
        $date = Carbon::now();	
        $date = $date->format('d-m-Y');
          
        
 //<------CALCULOS PARA ESTADO DE CUENTA VENCIDOS---------->

           //SE OBTIENEN EL NUMERO DE CUOTAS 
           $cuotaspendientes = DB::table('detalle_liquidacion')->where([
            ['estado', '=', 'ABONO'],
            ['idcuenta', '=', $id],
            ])->count();

            $cpendiente = DB::table('detalle_liquidacion')->where([
                ['estado', '=', 'ABONO'],
                ['idcuenta', '=', $id],
                ])->first();

            if($cpendiente!=null){
               $tcuotaspendientes=$cuotaspendientes*($cliente->cuotadiaria-$cpendiente->totaldiario);
            }else{
                $tcuotaspendientes=$cuotaspendientes;
            }    
         
           //SE CALCULAN EL NUMERO DE CUOTAS PENDIENTES DEL PRESTAMO
           $tcuotascanceladas=DB::table('detalle_liquidacion')->where([
            ['estado', '=', 'ATRASO'],
            ['idcuenta', '=', $id],
            ])->count();
            

            if($tcuotascanceladas==0){
                $tcuotascanceladas=DB::table('detalle_liquidacion')->where([
                    ['estado', '=', 'PENDIENTE'],
                    ['idcuenta', '=', $id],
                    ])->count();
                    $tcuotascanceladas=$tcuotascanceladas-1;
                    $totalcancelado=$tcuotascanceladas*$cliente->cuotadiaria;
            }else{
            $tcuotascanceladas=$tcuotascanceladas-1;
            $totalcancelado=$tcuotascanceladas*$cliente->cuotadiaria;
            }

            
           
            
            //SE OBTIENE LA ULTIMA CUOTA
            $ultimacuota=1;

            
            
            $liquida=DetalleLiquidacion::where('idcuenta','=',$id)->orderBy('iddetalleliquidacion','DESC')->take(1)->first();
            $fechaidealpago=$liquida->fechadiaria;

           if($fechaidealpago>=Carbon::now()){
            $diasatrasados=0;
           }else{
            $diasatrasados = $fechaidealpago->diffInDays(Carbon::now());
           }
           $mora=$liquidacion->monto*$cliente->interes*$diasatrasados;

           $interesDiario = $liquidacion->monto * $cliente->interes;
           $cuotaCapital = $liquidacion->monto;
          

          while ($liquidacion->monto > $cliente->cuotadiaria) {
           
           $cuotaCapital = $cliente->cuotadiaria - $interesDiario;
           $liquidacion->monto = ($liquidacion->monto - $cuotaCapital);
           $interesDiario = $liquidacion->monto * $cliente->interes;
           $liquidacion->monto=round($liquidacion->monto,2);
       }
            $totalultima=$liquidacion->monto;
           
           $total=$totalultima+$totalcancelado+$tcuotaspendientes+$mora;
           $total=round($total,2);

        //<-------------------FINALIZA CALCULO ESTADO DE CUENTA VENCIDO---------->


        $estado= new Comprobante;
        $estado->idcuenta=$cuenta->idcuenta;
        $estado->gastosadmon =  $data['gastosadmon'];
        $estado->gastosnotariales= $data['gastosnoti'];
        
        if($cliente->estadodos=="VENCIDO"){
            
            $subtotal=$totalultima+$totalcancelado+$tcuotaspendientes+$mora;
            $estado->mora=$mora;
            $estado->diasatrasados= $diasatrasados;
            $estado->totalcuotas=0;
            $estado->diaspendientes=$cuotaspendientes;
            $estado->totalpendiente=$tcuotaspendientes;
            $estado->cuotadeuda=$tcuotascanceladas;
            $estado->totalcuotasdeuda=$totalcancelado;
            $estado->ultimacuota=$totalultima;
            $estado->montoactual=$liquidacio->monto;
            $estado->total = $total+$estado->gastosadmon+$estado->gastosnotariales; 
            $estado->estado='VENCIDO';
            $estado->estadodos='NO CANCELADO';
        }
        else{
            $subtotal=$totalcuotas+$liquidacion->monto;
            $estado->mora=0.00;
            $estado->diaspendientes=0;
            $estado->totalpendiente=0;
            $estado->cuotadeuda=0;
            $estado->totalcuotasdeuda=0;
            $estado->ultimacuota=0;
            $estado->diasatrasados=$data['cuotasatrasadas'];
            $estado->totalcuotas=$data['totalcuotas'];
            $estado->montoactual=$data['monto'];
            $estado->total=$estado->montoactual+$estado->totalcuotas+$estado->gastosadmon+$estado->gastosnotariales;         
            $estado->estado='NORMAL';
            $estado->estadodos='--';
        }
        $estado->fechacomprobante=$date; 
        $estado->save();

        $estados=DB::table('comprobante')->where('idcuenta','=',$id)
        ->orderBy('created_at','asc')
        ->paginate(10);
        
        Session::flash('create',"Estado de Cuenta ". $estado->estado. " agregado correctamente");
        return view('estadoCuenta.show',["estados"=>$estados,"usuarioactual"=>$usuarioactual,"cliente"=>$cliente]);
    }


    public function edit($id)
    {
        $usuarioactual=\Auth::user();

        $cliente = DB::table('cuenta')
        ->select('cuenta.idcuenta','cuenta.interes','negocio.nombre as nnegocio','cliente.nombre', 'cliente.apellido','cliente.dui','cliente.nit','cliente.direccion','cuenta.estado','prestamo.estadodos','prestamo.cuotadiaria')
        ->join('negocio as negocio','cuenta.idnegocio','=','negocio.idnegocio')
        ->join('cliente as cliente','negocio.idcliente','=','cliente.idcliente')
        ->join('prestamo as prestamo','cuenta.idprestamo','=','prestamo.idprestamo')
        ->join('comprobante as comprobante','cuenta.idcuenta','=','comprobante.idcuenta')
        ->where('comprobante.idcomprobante','=',$id)
        ->first();

        

        $estadoc = Comprobante::findOrFail($id);
        $ultimacuota=1;
        if($estadoc->estado=="VENCIDO" || $estadoc->estado=="CERRADO"){
            $subtotal=$estadoc->ultimacuota+$estadoc->totalcuotasdeuda+$estadoc->totalpendiente+$estadoc->mora;
            return view('estadoCuenta.vencido.edit',["subtotal"=>$subtotal, "ultimacuota"=>$ultimacuota,"cliente"=>$cliente,"estadoc"=>$estadoc,"usuarioactual"=>$usuarioactual]);   
         }else{
            return view('estadoCuenta.edit',["cliente"=>$cliente,"estadoc"=>$estadoc,"usuarioactual"=>$usuarioactual]);   
        }
    }

    public function update(Request $request, $id)
    {	
        $usuarioactual=\Auth::user();
      
        
        $data = $request;
        $cliente = DB::table('cuenta')
        ->select('cuenta.idcuenta','cuenta.interes','cliente.nombre','negocio.nombre as nnegocio', 'cliente.apellido','cliente.dui','cliente.nit','cliente.direccion','cuenta.estado','prestamo.estadodos','prestamo.cuotadiaria')
        ->join('negocio as negocio','cuenta.idnegocio','=','negocio.idnegocio')
        ->join('cliente as cliente','negocio.idcliente','=','cliente.idcliente')
        ->join('prestamo as prestamo','cuenta.idprestamo','=','prestamo.idprestamo')
        ->join('comprobante as comprobante','cuenta.idcuenta','=','comprobante.idcuenta')
        ->where('comprobante.idcomprobante','=',$id)
        ->first();

        $date = Carbon::now();	
        $date = $date->format('d-m-Y');
        
        

        $estado = Comprobante::findOrFail($id);
        $estado->idcuenta=$estado->idcuenta;
        $subtotal=$estado->total- $estado->gastosadmon- $estado->gastosnotariales;
        $estado->gastosadmon =  $data['gastosadmon'];
        $estado->gastosnotariales= $data['gastosnoti'];
        
        if(($cliente->estadodos=="VENCIDO" || $cliente->estadodos=="CERRADO") && $estado->estado=="VENCIDO"){
            
            $estado->mora=$estado->mora;
            $estado->diasatrasados= $estado->diasatrasados;
            $estado->totalcuotas=0;
            $estado->diaspendientes=$estado->diaspendientes;
            $estado->totalpendiente=$estado->totalpendiente;
            $estado->cuotadeuda=$estado->cuotadeuda;
            $estado->totalcuotasdeuda=$estado->totalcuotasdeuda;
            $estado->ultimacuota=$estado->ultimacuota;
            $estado->montoactual=$estado->montoactual;
            $total=$subtotal+$estado->gastosadmon+$estado->gastosnotariales; 
            $total=round($total,2);
            $estado->total = $total;
            $estado->estado='VENCIDO';
            $estado->estadodos='NO CANCELADO';
        }
        elseif($estado->estado=="NORMAL"){
           
            $estado->mora=0.00;
            $estado->diasatrasados=$data['cuotasatrasadas'];
            $estado->totalcuotas=$data['totalcuotas'];
            $estado->montoactual=$data['monto'];
            $estado->total=$estado->montoactual+$estado->totalcuotas+$estado->gastosadmon+$estado->gastosnotariales;         
            $estado->estado='NORMAL';
            $estado->estadodos='--';
        }
        $estado->fechacomprobante=$date; 
        $estado->update();

        $estados=DB::table('comprobante')->where('idcuenta','=',$id)
        ->orderBy('created_at','asc')
        ->paginate(10);
        
        Session::flash('create',"Estado de Cuenta " .$estado->estado. " Editado correctamente");
        return redirect('agregarestado/'.$cliente->idcuenta);
        //.$cliente->idcuenta.,["estados"=>$estados,"usuarioactual"=>$usuarioactual,"cliente"=>$cliente]);
    }

    public function cancelar($id){

        $usuarioactual=\Auth::user();
        $estado = Comprobante::findOrFail($id);
     
        $cliente = DB::table('cuenta')
        ->select('cuenta.idcuenta','negocio.nombre as nnegocio','cliente.nombre','negocio.nombre as nnegocio', 'cliente.apellido')
        ->join('negocio as negocio','cuenta.idnegocio','=','negocio.idnegocio')
        ->join('cliente as cliente','negocio.idcliente','=','cliente.idcliente')
        ->where('cuenta.idcuenta','=',$estado->idcuenta)
        ->first();

        

      
        $cuenta=Cuenta::where('idcuenta','=',$estado->idcuenta)->first();
        $prestamo=Prestamo::where('idprestamo','=',$cuenta->idprestamo)->first(); 
        $estado->estadodos="CANCELADO";
        $prestamo->estadodos="CERRADO";
        $cuenta->estado='INACTIVO';
        $estado->update(); 
        $prestamo->update();
        $cuenta->update();

        $estados=DB::table('comprobante')->where('idcuenta','=',$estado->idcuenta)
        ->orderBy('created_at','asc')
        ->paginate(10);

        Session::flash('create',"Estado de Cuenta ha sido cancelado exitosamente");
        return redirect('agregarestado/'.$cliente->idcuenta);
    }

    public function destroy($id)
    {
        $usuarioactual=\Auth::user();

        $estado = Comprobante::findOrFail($id);
        $estado->delete();
         Session::flash('delete',"Estado de Cuenta Fue ELIMINADO correctamente");
         return back();

    }


    public function estadoPDF($id)
    {
        $usuarioactual=\Auth::user();

        $cliente = DB::table('cuenta')
        ->select('cuenta.idcuenta','cuenta.interes','negocio.nombre as nnegocio','cliente.nombre', 'cliente.apellido','cliente.dui','cliente.nit','cliente.direccion','cuenta.estado','prestamo.estadodos','prestamo.cuotadiaria')
        ->join('negocio as negocio','cuenta.idnegocio','=','negocio.idnegocio')
        ->join('cliente as cliente','negocio.idcliente','=','cliente.idcliente')
        ->join('prestamo as prestamo','cuenta.idprestamo','=','prestamo.idprestamo')
        ->join('comprobante as comprobante','cuenta.idcuenta','=','comprobante.idcuenta')
        ->where('comprobante.idcomprobante','=',$id)
        ->first();
        
        $cuenta = Cuenta::findOrFail($cliente->idcuenta);
        $negocio = Negocio::where('idnegocio',$cuenta->idnegocio)->first();
        $cli = Cliente::where('idcliente',$negocio->idcliente)->first();

        $estadoc = Comprobante::findOrFail($id);
        $ultimacuota=1;

        $hoy = date("d-MM-Y");

        $hoi = explode("-", $hoy);

        $aniohoy = strtolower($hoi[2]);
        
        setlocale(LC_TIME, "spanish");
        $meshoy = strtoupper(ucfirst(strftime("%B")));
        $diahoy = $hoi[0];

        try {
            $saldoact = DetalleLiquidacion::where('idcuenta','=',$cuenta->idcuenta)
            ->orderby('iddetalleliquidacion','asc')
            ->where('estado','=','PENDIENTE')->first();
            if ($saldoact->monto==NULL) {
                $salmon=0;
            }else{
                $salmon=$saldoact->monto;}
        } catch (Exception $e) {
            $salmon = 0;
        }

        //$salmon = $estadoc->montoactual;

        try {
            $ultimafecha = DetalleLiquidacion::where('idcuenta','=',$cuenta->idcuenta)
            ->orderby('iddetalleliquidacion','desc')
            ->first();

            if ($ultimafecha->fechadiaria==NULL) {
                $ultima=0;
            }else{
                $ultima=$ultimafecha->fechadiaria->format('Y-m-d');
            }
        } catch (Exception $e) {
            $ultima = 0;
        }

        $fecfina = explode("-", $ultima);
        $diafe = $fecfina[2];
        $mesfe = $this -> obtenerMes($fecfina[1]);
        $aniofe = $fecfina[0];

        $liquidacion = new DetalleLiquidacion;
        $cont=0;
        $nuvfecha=date("Y-m-d",strtotime("$ultima + ".$cont." days "));
        $liquidacion->fechadiaria=$nuvfecha;

        if($estadoc->estado=="VENCIDO"|| $estadoc->estado=="CERRADO"){
            $vistaurl="reportes/estadoCuentaVencido";
            $name = "EstadoCuentaVencido".$id.$negocio->nombre.".pdf";
            $subtotal=$estadoc->ultimacuota+$estadoc->totalcuotasdeuda+$estadoc->totalpendiente+$estadoc->mora;
            return $this -> crearPDF2($vistaurl,$subtotal,$ultimacuota,$cliente,$estadoc,$name,$aniohoy,$meshoy,$diahoy,$negocio,$cli,$diafe,$mesfe,$aniofe,$liquidacion);   
         }else{
            $vistaurl="reportes/estadoCuenta";
            $name = "EstadoCuenta".$id.$negocio->nombre.".pdf";
            return $this -> crearPDF1($vistaurl,$cliente,$estadoc,$name,$aniohoy,$meshoy,$diahoy,$negocio,$cli,$salmon,$ultima,$diafe, $mesfe, $aniofe,$liquidacion);   
        }
    }

    public function crearPDF1($vistaurl,$cliente,$estadoc,$name,$aniohoy,$meshoy,$diahoy,$negocio,$cli,$salmon,$ultima,$diafe, $mesfe, $aniofe,$liquidacion)
    {
        
        $view=\View::make($vistaurl,compact('cliente','estadoc','aniohoy','meshoy','diahoy','negocio','cli','salmon','ultima','diafe','mesfe','aniofe','liquidacion'))->render();
        $pdf =\App::make('dompdf.wrapper');

        $pdf->loadHTML($view);
        return $pdf->stream($name);
    }

    public function crearPDF2($vistaurl,$subtotal,$ultimacuota,$cliente,$estadoc,$name,$aniohoy,$meshoy,$diahoy,$negocio,$cli,$diafe,$mesfe,$aniofe,$liquidacion){

        $view=\View::make($vistaurl,compact('cliente','cliente','estadoc','aniohoy','meshoy','diahoy','negocio','cli','diafe','mesfe','aniofe','liquidacion'))->render();
        $pdf =\App::make('dompdf.wrapper');

        $pdf->loadHTML($view);
        return $pdf->stream($name);

    }

    public function obtenerMes($mess){
        switch ($mess) {
            case '1':
                $mes = 'Enero';
                break;
            case '2':
                $mes = 'Febrero';
                break;
            case '3':
                $mes = 'Marzo';
                break;
            case '4':
                $mes = 'Abril';
                break;
            case '5':
                $mes = 'Mayo';
                break;
            case '6':
                $mes = 'Junio';
                break;
            case '7':
                $mes = 'Julio';
                break;
            case '8':
                $mes = 'Agosto';
                break;
            case '9':
                $mes = 'Septiembre';
                break;
            case '10':
                $mes = 'Octubre';
                break;
            case '11':
                $mes = 'Noviembre';
                break;
            case '12':
                $mes = 'Diciembre';
                break;
            default:
                $mes = 'Error al obtener el mes';
                break;
        }
        return $mes;
    }
     
}