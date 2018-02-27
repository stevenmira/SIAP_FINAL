@extends ('layouts.inicio')
@section('contenido')
<section class="content-header">
  <h1 style="color: #333333; font-family: 'Times New Roman', Times, serif;">
    Desembolso
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{URL::action('ClienteController@index')}}"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li><a href="{{URL::action('RecordClienteController@index')}}"> Récord Cliente</a></li>
    <li><a href="{{URL::action('CuentaController@show',$cuenta->idcuenta)}}"> Cuenta</a></li>
    <li class="active">Desembolso</li>
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
        <td><u>$ {{ $costo }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></td>
      </tr>
      <tr>
        <td>EFECTIVO A RECIBIR</td>
        <td>$ {{$montoreal}}</td>
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
  <a href="{{URL::action('CuentaController@desembolsoPDF',$cuenta->idcuenta)}}" class="btn btn-danger btn-lg col-md-offset-10" target="_blank"><i class="fa fa-print" aria-hidden="true"></i> IMPRIMIR</a>
</div>

@endsection