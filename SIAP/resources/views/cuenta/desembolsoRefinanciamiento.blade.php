@extends ('layouts.inicio')
@section('contenido')
<section class="content-header">
  <h1 style="color: #333333; font-family: 'Times New Roman', Times, serif;">
    DESEMBOLSO CON REFINANCIAMIENTO
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{URL::action('ClienteController@index')}}"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li><a href="{{URL::action('RecordClienteController@index')}}"> Récord Cliente</a></li>
    <li><a href="{{URL::action('CuentaController@show',$cuenta->idcuenta)}}"> Cuenta</a></li>
    <li class="active">Desembolso con refinanciamiento</li>
  </ol>
</section>
<br>    

  <div class="row">
        <!-- <img align="right"  src="{{asset('img/log.jpg')}}" width="180px" height="70px"> -->
        <h4 align="center"> <b>AFIMID, S.A. DE C.V.</b></h4>
        <h4 colspan="2" align="center">
          ASESORES FINANCIEROS MICRO IMPULSADORES DE NEGOCIOS<br>SOCIEDAD ANONIMA DE CAPITAL<br>VARIABLE
        </h4>
  </div>

<section class="content-header">
  <p align="right">{{ $prestamo->created_at->format('d/m/Y') }}</p>
  <p>Detalle de desembolso aprobado</p>
</section>

  <div>
    <table align="center" style="width: 80%; border-collapse: collapse;">
      <thead>
        <th style="border: 1px solid #333; text-align: center; " rowspan="2">N</th>
        <th style="border: 1px solid #333; text-align: center;"  rowspan="2">MONTO</th>
      </thead>
      <tr>
        <td style="border: 1px solid #333" align="right">{{$cuenta->numeroprestamo}}</td>
        <td style="border: 1px solid #333; text-align: right;"><span class="pull-left" >$ </span> {{ $prestamo->monto }}</td>
      </tr>
    </table>
  </div>
  <br>
  <br>
  <div>
    <table align="center" style="width: 80%; border-collapse: collapse;">
      <tr>
        <th>Desembolso</th>
        <th>$ {{$prestamo->monto}}</th>
      </tr>
      <tr>
        <td>( - Desc. De $4.50 de cada $100.00 por desembolso)</td>
        <td>$ {{ $costo }}</td>
      </tr>
      <tr>
        <td>( - CUOTAS ATRASADAS <b>{{$cuentaAnterior->cuotaatrasada}} * {{$prestamoAnterior->cuotadiaria}})</b></td>
        <?php $subtotal =  $cuentaAnterior->cuotaatrasada * $prestamoAnterior->cuotadiaria; ?>
        <td>$ {{ $subtotal }}</td>
      </tr>
      <tr>
        <td>( - MORA POR INCUMPLIMIENTO)</td>
        <td><b id="totalMora"> $ {{ $cuentaAnterior->mora }}</b></td>
      </tr>
      <tr>
        <td>( - Saldo capital del crédito anterior  )</td>
        <td><u>$ {{ $cuentaAnterior->capitalanterior }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></td>
      </tr>
      <tr>
        <td>EFECTIVO A RECIBIR</td>
        <?php 
        $total = $prestamo->monto - $costo - $subtotal - $cuentaAnterior->mora - $cuentaAnterior->capitalanterior;
        $totalB = $prestamo->monto - $costo - $subtotal - $cuentaAnterior->capitalanterior; 
        ?>
        <td><b id="totalDesembolso">$ {{$total}}</b></td>
      </tr>
    </table>
  </div>
  <br>
  <div>
    <table align="center" style="width: 80%;" cellpadding="0" cellspacing="0">
      <tr>
        <td colspan="2">F: <u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></td>
      </tr>
    </table>
  </div>
  <div>
    <table align="center" style="width: 80%;" cellpadding="0" cellspacing="0">
      <tr>
        <td style="width: 10%;">NOMBRE:</td>
        <td>{{ $cliente->nombre}} {{ $cliente->apellido }}</td>
      </tr>
      <tr>
        <td>DUI: </td>
        <td>{{ $cliente->dui }}</td>
      </tr>
      <tr>
        <td>NIT: </td>
        <td>{{ $cliente->nit }}</td>
      </tr>
    </table>
  </div>
  <div>
    <table align="center" style="width: 80%;" cellpadding="0" cellspacing="0">
      <tr>
        <td align="center">DEUDOR/A RECIBI CONFORME</td>
      </tr>
    </table>
  </div>

<div class="row">
  <a href="{{URL::action('CuentaController@desemSinMoraPDF',$cuenta->idcuenta)}}" target="_blank" class="btn btn-danger btn-lg pull-center"><i class="fa fa-print" aria-hidden="true"></i> IMPRIMIR SIN MORA</a>

  <a href="{{URL::action('CuentaController@desembolsoPDF',$cuenta->idcuenta)}}" target="_blank" class="btn btn-danger btn-lg pull-right" ><i class="fa fa-print" aria-hidden="true"></i> IMPRIMIR CON MORA</a>
</div>

<div class="row">
  <div  style="display:  center-block();">
  <button  class="btn btn-danger col-md-offset-5 col-lg-offset-5  col-sm-offset-5 azul" title="QUITAR MORA" id="sinMora"><i class="fa fa-times" aria-hidden="true"></i></button>

  <button  class="btn btn-success col-md-offset-1 col-lg-offset-1  col-sm-offset-1 azul" title="AGREGAR MORA" id="conMora"><i class="fa fa-check" aria-hidden="true"></i></button>
  </div>

  <div  style="display:  center-block();">
  
  </div>
</div>


<input  id="monto" value="{{ $prestamo->monto }}" type="hidden"></input>
<input  id="costo" value="{{ $costo }}" type="hidden"></input>
<input  id="capitalanterior" value="{{ $cuentaAnterior->capitalanterior }}" type="hidden"></input>
<input  id="mora" value="{{ $cuentaAnterior->mora }}" type="hidden"></input>
<input  id="cuotaatrasada" value="{{ $cuentaAnterior->cuotaatrasada }}" type="hidden"></input>
<input  id="cuotadiaria" value="{{ $prestamoAnterior->cuotadiaria }}" type="hidden"></input>
<input  id="total" value="{{ $total }}" type="hidden"></input>
<input  id="totalB" value="{{ $totalB }}" type="hidden"></input>

@push('scripts')


<!-- InputMask -->
<script src="{{asset('js/inputmask/jquery3.js')}}"></script>  

<script>

   $(document).ready(function(){
        $('#conMora').click(function(){
            conMora();
        });
    });

   $(document).ready(function(){
        $('#sinMora').click(function(){
            sinMora();
        });
    });


   function conMora()
   {
        limpiar();
        mora = $("#mora").val();
        total = $("#total").val();

        total2 = total;
        
        $('#totalMora').html(" $ " + mora);
        $('#totalDesembolso').html(" $ " + total2);
   }

   function sinMora()
   {
        limpiar();
        mora = $("#mora").val();
        total = $("#total").val();
        totalB = $("#totalB").val();

        total2 = totalB;
        mora = '------';

        $('#totalMora').html(" $ " + mora);
        $('#totalDesembolso').html(" $ " + total2);
   }

   function limpiar(){
    $("#totalMora").html(" " );
    $("#totalDesembolso").html(" " );
  }


</script>
@endpush

@endsection