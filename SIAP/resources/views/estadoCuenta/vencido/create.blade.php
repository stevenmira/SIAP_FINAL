@extends ('layouts.inicio')
@section('contenido')

<style>
  .errors{
    background-color: #fcc;
    border: 1px solid #966;
  }
</style>

<section class="content-header">
  <h1 style="color: #333333; font-family: 'Times New Roman', Times, serif;">
   ESTADO DE CUENTA VENCIDO
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ url('home')}}"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li><a href="{{URL::action('ComprobanteController@show',$cliente->idcuenta)}}"> Estados de Cuentas</a></li>
    <li class="active">Nuevo</li>
  </ol>
</section>
<br>



  <div class="col-md-12"> 
    <div class="panel panel-success">
      <div class="panel-body">
          

          <div class="row">
            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
              @if(count($errors) > 0)
              <div class="errors">
                <ul>
                  <p><b>Por favor, corrige lo siguiente:</b></p>
                  <?php $cont = 1; ?>
                @foreach($errors->all() as $error)
                  <li>{{$cont}}. {{ $error }}</li>
                  <?php $cont=$cont+1; ?>
                @endforeach
                </ul>
              </div>
            @endif
            </div>
          </div>
      
          <section class="posts col-md-9">
          {!!Form::open(array('action' => array('ComprobanteController@agregarestado',$cliente->idcuenta), 'method'=>'POST','autocomplete'=>'off'))!!}
          
          <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 toppad" >
              <div class="panel panel-info">
        
                <div class="panel-heading">
                  <h3 class="panel-title">INFORMACIÓN DEL CLIENTE</h3>
                </div>
                <div class="panel-body">
                  <div class="row">
                           
                    <div class=" col-md-9 col-lg-9 "> 
                      <table class="table table-user-information">
                        <tbody>
                          <tr>
                            <td>NOMBRES Y APELLIDOS:</td>
                            <td>{{ $cliente->nombre}} {{ $cliente->apellido }}</td>
                          </tr>
                           <tr>
                            <td>NEGOCIO:</td>
                            <td>{{ $cliente->nnegocio }}</td>
                          </tr>       
                          <tr>
                            <td>DUI:</td>
                            <td>{{ $cliente->dui }}</td>
                          </tr>
        
                          <tr>
                            <td>NIT:</td>
                            <td>{{ $cliente->nit }}</td>
                          </tr>        
                          <tr>
                            <td>DIRECCIÓN:</td>
                            <td>{{ $cliente->direccion}}</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                </div>
                
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 toppad" >
                <div class="panel panel-success"> 
                <div class="panel-heading">
                  <h3 class="panel-title">DETALLE DE LA DEUDA</h3>
                </div>
        
                <div class="panel-body">
                  <div class="row">
                          
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 "> 
                      <table class="table">
                        <tbody>
                          <tr>
                            <td>SALDO PENDIENTE DE CUOTAS: <b>{{$cuotaspendientes}}</b> DE <b>${{$tcuotaspendientes}}</b></td>
                            <td> <b>${{$tcuotaspendientes}}</b></td>
                          </tr>
                          <tr>
                            <td><b>{{$tcuotascanceladas}}</b> CUOTAS DE <b>${{$cliente->cuotadiaria}}</b> DEL {{$fechapendiente}} AL {{$fechafinal}}</td>
                            <td> <b>${{$totalcancelado}}</b></td>
                          </tr>
                          <tr>
                            <td><b>{{$ultimacuota}}</b> CUOTA DE <b>${{$liquidacion->monto}}</b> DEL </td>
                            <td> <b>${{$liquidacion->monto}}</b></td>
                          </tr>
                          <tr>
                            <td class="col-xs-12 col-sm-12 col-md-8 col-lg-8">MORA POR INCUMPLIMIENTO DE CONTRATO DE UN CAPITAL DE <b>{{$liquidacion->monto}}*{{$cliente->interes*100}}*{{$diasatrasados}}</b> DIAS ATRASADOS:</td>
                            <td>{{$mora}}</td>
                          </tr>
                          <tr>
                            <td><b style="color:blue">SubTotal</b></td>
                            <td><span id="monto">{{$subtotal}}</span></td>
                          </tr>
                          <tr>
                            <td>Gastos de Administración por gestion de cobros:</td>
                            <td>{!! Form::number('gastosadmon', null, ['id'=>'gastosadmon','onkeyup'=>'Sumar()','class' => 'form-control' , 'required' => 'required', 'placeholder'=>'Introduzca los gastos administrativos. . .', 'autofocus'=>'on', 'maxlength'=>'6']) !!}</td>
                          </tr>
                          <tr>
                            <td>Gastos Administrativos por Notificación:</td>
                            <td>{!! Form::number('gastosnoti', null, ['id'=>'gastosnoti','onkeyup'=>'Sumar()','class' => 'form-control' , 'required' => 'required', 'placeholder'=>'Gastos por Notificación. . .', 'autofocus'=>'on', 'maxlength'=>'6']) !!}</td>
                          </tr>
                          <tr>
                            <td><b style="color:red">TOTAL A CANCELAR</b></td>
                            <td><b>{!! Form::number('total', null, [ 'id'=>'total','class' => 'form-control' , 'disabled' => 'disabled', 'autofocus'=>'on', 'maxlength'=>'6']) !!}</b></td>
                           
                          </tr>
                        </tbody>
                      </table>
                   </div>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                 <input name="_token" value="{{csrf_token()}}" type="hidden"></input>
                 <a href="{{URL::action('ComprobanteController@show',$cliente->idcuenta)}}" class="btn btn-danger btn-lg col-md-offset-2">Cancelar</a>
                  <button class="btn btn-primary btn-lg col-md-offset-2" type="submit">Guardar</button>
              </div>
            </div>
          </div>
            
        </section>
        <aside class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
        <div class="box-body">
        @if($usuarioactual->idtipousuario!=1)
    <a href="{{URL::action('ComprobanteController@show',$cliente->idcuenta)}}" style="background: #ccff90; color: black;" class="btn col-md-12 col-lg-12 btn-app" title="Ver estados de cuenta">
        <i class="fa fa-folder"></i> Estado Cuenta
      </a>
      <a href="{{URL::action('RecordClienteController@recibo',$cliente->idcuenta)}}" style="background: #ccff90; color: black;" class="btn col-md-12 col-lg-12 btn-app" title="Generar recibo">
        <i class="fa fa-file"></i> Recibos
      </a>
      <a href="{{URL::action('RecordClienteController@pagare',$cliente->idcuenta)}}" target="_blank" style="background: #ccff90; color: black;" class="btn col-md-12 col-lg-12 btn-app" title="Imprimir pagaré">
        <i class="fa fa-print"></i> Pagaré
      </a>
    @endif
    @if($usuarioactual->idtipousuario==1)
      <a href="{{URL::action('RecordClienteController@pagare',$cliente->idcuenta)}}" target="_blank" style="background: #ccff90; color: black;" class="btn col-md-12 col-lg-12 btn-app" title="Imprimir pagaré">
        <i class="fa fa-print"></i> Pagaré
      </a>
      <a href="{{ url('cuenta/desembolso', ['id' => $cliente->idcuenta]) }}" style="background: #ccff90; color: black;" class="btn col-md-12 col-lg-12 btn-app" title="Ver desembolso">
        <i class="fa fa-print"></i> Desembolso
      </a>
      <a href="{{ url('cuenta/carteraPagos', ['id' => $cliente->idcuenta]) }}" style="background: #ccff90; color: black;" class="btn col-md-12 col-lg-12 btn-app" title="Ver cartera de pagos">
        <i class="fa fa-money"></i> Cartera Pagos
      </a>
      <a href="{{URL::action('ComprobanteController@show',$cliente->idcuenta)}}" style="background: #ccff90; color: black;" class="btn col-md-12 col-lg-12 btn-app" title="Ver estados de cuenta">
        <i class="fa fa-folder"></i> Estado Cuenta
      </a>
      <a href="{{URL::action('RecordClienteController@recibo',$cliente->idcuenta)}}" style="background: #ccff90; color: black;" class="btn col-md-12 col-lg-12 btn-app" title="Generar recibo">
        <i class="fa fa-file"></i> Recibos
      </a>
     
      @endif
    </div>
</aside>
      </div>
    </div>
  </div>

{!!Form::close()!!}

@push('scripts')


<!-- InputMask -->
<script src="{{asset('js/inputmask/jquery3.js')}}"></script>  
<script src="{{asset('js/inputmask/input-mask.js')}}"></script>
<script src="{{asset('js/inputmask/input-mask-date.js')}}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script>
  $(function () {
    //Money Euro
    $('[data-mask]').inputmask()

  })
</script>

<!--Script para sumar el total del monto a pagar-->
<script>
function Sumar(){
 total=parseFloat(document.getElementById("monto").innerHTML);
 numero1 = parseFloat(document.getElementById("monto").innerHTML);
 numero2 = parseFloat(document.getElementById("gastosadmon").value);
 numero4 = parseFloat(document.getElementById("gastosnoti").value);


if((isNaN(numero2)) && (isNaN(numero4))){
  total=numero1;
}else if(isNaN(numero2)){
    total+=numero4;
}else if(isNaN( numero4)){
  total+=numero2;
}
else {
   total=numero1 + numero2 + numero4;
}
document.getElementById("total").value = total.toFixed(2);
}
</script>



@endpush


@endsection


