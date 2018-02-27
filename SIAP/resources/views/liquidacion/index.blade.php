@extends ('layouts.inicio')
@section('contenido')

<style type="text/css">
  th{
    text-align: center;
  }


a.total{
  color: black;
}
a.total:visited {text-decoration:none; color:#000} /*Link visitado*/
a.total:active {text-decoration:none; color:#000;} /*Link activo*/
a.total:hover {text-decoration:none; color:#000; } /*Mause sobre el link*/

</style>

<section class="content-header">
  <h1 style="color: #333333; font-family: 'Times New Roman', Times, serif;">
    CARTERA DE PAGOS ( CUOTAS POR PAGAR <b style="color: red;"> {{$n}} </b> )
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ url('home')}}"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li><a href="{{URL::action('RecordClienteController@index')}}"> Récord Cliente</a></li>
    <li><a href="{{URL::action('CuentaController@show',$cuenta->idcuenta)}}"> Cuenta</a></li>
    <li class="active">Cartera de Pagos</li>
  </ol>
</section>

<section class="content">

  <!-- Notificación -->
  @if (Session::has('create'))
  <div class="alert  fade in" style="background:  #ccff90;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4>El cliente <b>{{ Session::get('create')}}</b> ha sido guardado correctamente.</h4>
  </div>
  @endif

  @if (Session::has('inactivo'))
  <div class="alert  fade in" style="background:  #ffd54f;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><b>{{ Session::get('inactivo')}}</b></h4>
  </div>
  @endif

  @if (Session::has('mensaje'))
  <div class="alert  fade in" style="background:  #ccff90; font-family: 'Times New Roman', Times, serif;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><b>{{ Session::get('mensaje')}}</b></h4>
  </div>
  @endif

  @if (Session::has('negativo'))
  <div class="alert  fade in" style="background:  #ff9e80; font-family: 'Times New Roman', Times, serif;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><b>{{ Session::get('negativo')}}</b></h4>
  </div>
  @endif

  @if (Session::has('fail'))
  <div class="alert  fade in" style="background:  #ff9e80; font-family: 'Times New Roman', Times, serif;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><b>{{ Session::get('fail')}}</b></h4>
  </div>
  @endif

  @if (Session::has('gravado'))
  <div class="alert  fade in" style="background:  #ff9e80; font-family: 'Times New Roman', Times, serif;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><b>{{ Session::get('gravado')}}</b></h4>
  </div>
  @endif

  @if (Session::has('limpiar'))
  <div class="alert  fade in" style="background:  #ffe57f ; font-family: 'Times New Roman', Times, serif;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><b>{{ Session::get('limpiar')}}</b></h4>  
  </div>
  @endif

  @if (Session::has('finish'))
  <div class="alert  fade in" style="background:  #b2ebf2 ; font-family: 'Times New Roman', Times, serif;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><b>{{ Session::get('finish')}}</b></h4>  
  </div>
  @endif


  <!-- Fin Notificación -->

  <!-- Criterios de búsquedas -->  
  <!-- END Criterios de búsquedas -->

<fieldset class="scheduler-border">
    <legend class="scheduler-border">Datos del cliente </legend>
    
    <div class="row">
      <div class="col-md-1 col-lg-1 col-sm-2 col-xs-12">
            <p><label class="control-label input-label" >NOMBRE:</label></p>
      </div>

      <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12">
            <p>{{$cliente->nombre}} {{$cliente->apellido}}</p>
      </div>

      <div class="col-md-2 col-lg-2 col-sm-1 col-xs-12">
            <p><label class="control-label input-label" >DUI:</label></p>
      </div>

      <div class="col-md-2 col-lg-2 col-sm-2 col-xs-12">
            <p>{{$cliente->dui}}</p>
      </div>

      <div class="col-md-1 col-lg-1 col-sm-1 col-xs-12">
            <p><label class="control-label input-label" >NIT:</label></p>
      </div>

      <div class="col-md-2 col-lg-2 col-sm-2 col-xs-12">
            <p>{{$cliente->nit}}</p>
      </div>
    </div>

    <div class="row">
      <div class="col-md-1 col-lg-1 col-sm-2 col-xs-12">
            <p><label class="control-label input-label" >DIRECCIÓN:</label></p>
      </div>

      <div class="col-md-4 col-lg-4 col-sm-3 col-xs-12">
            <p>{{$cliente->direccion}}</p>
      </div>

      <div class="col-md-2 col-lg-2 col-sm-1 col-xs-12">
            <p><label class="control-label input-label" >ACTIVIDAD ECON.:</label></p>
      </div>

      <div class="col-md-2 col-lg-2 col-sm-2 col-xs-12">
            <p>{{$negocio->actividadeconomica}}</p>
      </div>

      <div class="col-md-1 col-lg-1 col-sm-1 col-xs-12">
            <p><label class="control-label input-label" >TELÉFONO:</label></p>
      </div>

      <div class="col-md-2 col-lg-2 col-sm-2 col-xs-12">
            <p>{{$cliente->telefonofijo}} * {{$cliente->telefonocel}}</p>
      </div>
    </div>

    <div class="row">
      <div class="col-md-2 col-lg-2 col-sm-2 col-xs-12">
            <p><label class="control-label input-label" >NOMBRE DEL NEGOCIO:</label></p>
      </div>

      <div class="col-md-3 col-lg-3 col-sm-3 col-xs-12">
            <p>{{$negocio->nombre}}</p>
      </div>

      <div class="col-md-2 col-lg-2 col-sm-1 col-xs-12">
            <p><label class="control-label input-label" >DIREC. DEL NEGOCIO:</label></p>
      </div>

      <div class="col-md-5 col-lg-5 col-sm-2 col-xs-12">
            <p>{{$negocio->direccionnegocio}}</p>
      </div>
    </div>

</fieldset>

<a href="{{URL::action('LiquidacionController@carteraPDF',$cuenta->idcuenta)}}" target="_blank" class="btn btn-danger btn-lg col-md-offset-2"><i class="fa fa-print" aria-hidden="true"></i> Imprimir Cartera Ideal</a>

<a href="{{URL::action('LiquidacionController@carteraRealPDF',$cuenta->idcuenta)}}" target="_blank" class="btn btn-danger btn-lg col-md-offset-2"><i class="fa fa-print" aria-hidden="true"></i> Imprimir Cartera Real</a><br><br>

<label class="control-label input-label" >NO. DE CUOTAS:</label>

<div class="row">

      <div class="col-md-1 col-lg-1 col-sm-2 col-xs-12">
            <p><label class="control-label input-label" >CANCELADO:</label></p>
      </div>

      <div class="col-md-1 col-lg-1 col-sm-3 col-xs-12">
            <p style="color: red;"> <b> {{$cancelado}} </b></p>
      </div>

      <div class="col-md-1 col-lg-1 col-sm-1 col-xs-12">
            <p><label class="control-label input-label" >ABONO:</label></p>
      </div>

      <div class="col-md-1 col-lg-1 col-sm-2 col-xs-12">
            <p style="color: red;"><b>{{$abono}}</b></p>
      </div>

      <div class="col-md-1 col-lg-1 col-sm-1 col-xs-12">
            <p><label class="control-label input-label" >ATRASO:</label></p>
      </div>

      <div class="col-md-1 col-lg-1 col-sm-2 col-xs-12">
            <p style="color: red;"><b>{{$atraso}}</b></p>
      </div>

      <div class="col-md-1 col-lg-1 col-sm-1 col-xs-12">
            <p><label class="control-label input-label" >PENDIENTE:</label></p>
      </div>

      <div class="col-md-1 col-lg-1 col-sm-2 col-xs-12">
            <p style="color: red;"><b>{{$pendiente}}</b></p>
      </div>

      <div class="col-md-1 col-lg-1 col-sm-1 col-xs-12">
            <p><label class="control-label input-label" >NO_VALIDO:</label></p>
      </div>

      <div class="col-md-1 col-lg-1 col-sm-2 col-xs-12">
            <p style="color: red;"><b>{{$novalido}}</b></p>
      </div>

      <div class="col-md-1 col-lg-1 col-sm-1 col-xs-12">
            <p><label class="control-label input-label" >TOTAL:</label></p>
      </div>

      <div class="col-md-1 col-lg-1 col-sm-2 col-xs-12">
            <?php $total = $cancelado + $abono + $atraso + $pendiente + $novalido?>
            <p style="color: red;"><b>{{$total}}</b></p>
      </div>
    </div>


<div class="table-responsive">
  <table class="table table-striped table-bordered  table-condensed table-hover">
    <thead>
      <tr class="info">
        <th style="border: 1px solid #333; width: 75px" rowspan="3"> </th>
        <th style="border: 1px solid #333; width: 200px" rowspan="2" align="center"><span>N</span></th>
        <th style="border: 1px solid #333; width: 130px" rowspan="2" align="center"><span>MONTO</span></th>
        <th style="border: 1px solid #333; width: 130px" align="center"><span>Interés diario</span></th>
        <th style="border: 1px solid #333; width: 130px" rowspan="2" align="center"><span>PAGOS DIARIOS</span></th>
        <th style="border: 1px solid #333; width: 130px" rowspan="2" align="center"><span>CUOTA DIARIA</span></th>
      </tr>
      <tr class="info">
        <?php $interes = $tipo_credito->interes * 100; ?>
        <td style="border: 1px solid #333; height: 10px; text-align:center;">{{$interes}} %</td>
      </tr>
      <tr class="info">
      <td style="border: 1px solid #333; text-align: right;">{{$cuenta->numeroprestamo}}</td>
        <td style="border: 1px solid #333; text-align: right;"><span class="pull-left" >$ </span>{{$prestamo->monto}}</td>
        <td style="border: 1px solid #333"></td>
        <td style="border: 1px solid #333"></td>
       <td style="border: 1px solid #333; text-align: right;"><span class="pull-left" >$ </span> {{$prestamo->cuotadiaria}}</td>
      </tr>
    </thead>
    <tbody>
      <tr class="warning">
        <td style="border: 1px solid #333" align="center"><span>DIA</span></td>
        <td style="border: 1px solid #333" align="center"><span>FECHA</span></td>
        <td style="border: 1px solid #333" align="center"><span>MONTO</span></td>
        <td style="border: 1px solid #333" align="center"><span>INTERES DIARIO</span></td>
        <td style="border: 1px solid #333" align="center"><span>CUOTA CAPITAL</span></td>
        <td style="border: 1px solid #333" align="center"><span>TOTAL DIARIO</span></td>
        <td style="border: 1px solid #333" align="center"><span>FECHA EFECTIVA DE<br>PAGO</span></td>
        <td style="border: 1px solid #333" align="center"><span>ESTADO</span></td>
      </tr>
      
      @foreach ($liquidaciones as $ma)
      
        @if($ma->estado == 'ATRASO')
          <tr style="background: #ffcdd2;">
            @if($ma->fechadiaria->format('Y-m-d') == $fecha_actual->format('Y-m-d'))
              <td style="border: 1px solid #333; background: #ffd740;" align="right"><span><a class="rojo" data-title=" ANULAR PAGO " href="" data-target="#modal-delete-{{$ma->iddetalleliquidacion}}" data-toggle="modal"> {{ $ma->contador}}</a></span></td>
            @else
              <td style="border: 1px solid #333;" align="right"><span><a class="rojo" data-title=" ANULAR PAGO " href="" data-target="#modal-delete-{{$ma->iddetalleliquidacion}}" data-toggle="modal"> {{ $ma->contador}}</a></span></td>
            @endif

            <!-- Pasamos la fecha a español con Jenssegers -->
            
            @if( $ma->fechadiaria != null)
            <td style="border: 1px solid #333;" align="center"><span> {{ $ma->fechadiaria->format('l j  F Y ') }}</span></td>
            @else
            <td style="border: 1px solid #333" align="center"><span>{{ $ma->fechadiaria }}</span></td>
            @endif

            <td style="border: 1px solid #333; text-align: right;"><span class="pull-left">&nbsp;$</span> {{ $ma->monto }}</td>

            <td style="border: 1px solid #333; text-align: right;"><span class="pull-left">&nbsp;$</span> {{ $ma->interes }}</td>

            <td style="border: 1px solid #333; text-align: right;"><span class="pull-left">&nbsp;$</span> {{ $ma->cuotacapital }}</td>
            <td style="border: 1px solid #333; text-align: right;"><span class="pull-left">&nbsp;$</span> {{ $ma->totaldiario }}</td>

            @if( $ma->fechaefectiva != null)
            <td style="border: 1px solid #333" align="center"><span>{{ $ma->fechaefectiva->format('l j  F Y ') }}</span></td>
            @else
            <td style="border: 1px solid #333" align="center"><span>{{ $ma->fechaefectiva }}</span></td>
            @endif

            <td style="border: 1px solid #333" align="center"><span> {{ $ma->estado }}</span></td>
            
            <td style="border: 1px solid #333" align="center"><span></span> <a href="{{URL::action('LiquidacionController@edit', $ma->iddetalleliquidacion)}} " class="btn btn-success verde" data-title="Ingresar cuota"><i class="fa fa-fw -square -circle fa-plus-square"></i></a></td>
          </tr>
        @elseif($ma->estado == 'ABONO')
          <tr style="background: #fff59d;">

            @if($ma->fechadiaria->format('Y-m-d') == $fecha_actual->format('Y-m-d'))
              <td style="border: 1px solid #333; background: #ffd740;" align="right"><span><a class="rojo" data-title=" ANULAR PAGO " href="" data-target="#modal-delete-{{$ma->iddetalleliquidacion}}" data-toggle="modal"> {{ $ma->contador}}</a></span></td>
            @else
              <td style="border: 1px solid #333;" align="right"><span><a class="rojo" data-title=" ANULAR PAGO " href="" data-target="#modal-delete-{{$ma->iddetalleliquidacion}}" data-toggle="modal"> {{ $ma->contador}}</a></span></td>
            @endif

            <!-- Pasamos la fecha a español con Jenssegers -->
            
            @if( $ma->fechadiaria != null)
            <td style="border: 1px solid #333;" align="center"><span> {{ $ma->fechadiaria->format('l j  F Y ') }}</span></td>
            @else
            <td style="border: 1px solid #333" align="center"><span>{{ $ma->fechadiaria }}</span></td>
            @endif

            <td style="border: 1px solid #333; text-align: right;"><span class="pull-left">&nbsp;$</span> {{ $ma->monto }}</td>

            <td style="border: 1px solid #333; text-align: right;"><span class="pull-left">&nbsp;$</span> {{ $ma->interes }}</td>

            <td style="border: 1px solid #333; text-align: right;"><span class="pull-left">&nbsp;$</span> {{ $ma->cuotacapital }}</td>
            <td style="border: 1px solid #333; text-align: right;"><span class="pull-left">&nbsp;$</span> {{ $ma->totaldiario }}</td>

            @if( $ma->fechaefectiva != null)
            <td style="border: 1px solid #333" align="center"><span>{{ $ma->fechaefectiva->format('l j  F Y ') }}</span></td>
            @else
            <td style="border: 1px solid #333" align="center"><span>{{ $ma->fechaefectiva }}</span></td>
            @endif

            <td style="border: 1px solid #333" align="center"><span> {{ $ma->estado }}</span></td>
            
            <td style="border: 1px solid #333" align="center"><span></span> <a href="{{URL::action('LiquidacionController@edit', $ma->iddetalleliquidacion)}} " class="btn btn-success verde" data-title="Ingresar cuota"><i class="fa fa-fw -square -circle fa-plus-square"></i></a></td>
          </tr>
        @elseif($ma->estado == 'CANCELADO')
          <tr style="background: #ccff90;">

            @if($ma->fechadiaria->format('Y-m-d') == $fecha_actual->format('Y-m-d'))
              <td style="border: 1px solid #333; background: #ffd740;" align="right"><span><a class="rojo" data-title=" ANULAR PAGO " href="" data-target="#modal-delete-{{$ma->iddetalleliquidacion}}" data-toggle="modal"> {{ $ma->contador}}</a></span></td>
            @else
              <td style="border: 1px solid #333;" align="right"><span><a class="rojo" data-title=" ANULAR PAGO " href="" data-target="#modal-delete-{{$ma->iddetalleliquidacion}}" data-toggle="modal"> {{ $ma->contador}}</a></span></td>
            @endif

            <!-- Pasamos la fecha a español con Jenssegers -->
            
            @if( $ma->fechadiaria != null)
            <td style="border: 1px solid #333;" align="center"><span> {{ $ma->fechadiaria->format('l j  F Y ') }}</span></td>
            @else
            <td style="border: 1px solid #333" align="center"><span>{{ $ma->fechadiaria }}</span></td>
            @endif

            <td style="border: 1px solid #333; text-align: right;"><span class="pull-left">&nbsp;$</span> {{ $ma->monto }}</td>

            @if( $ma->abonocapital == "NO")
              <td style="border: 1px solid #333; text-align: right; background:#b2ff59;"><span class="pull-left">&nbsp;$</span> {{ $ma->interes }}</td>
            @else
              <td style="border: 1px solid #333; text-align: right;"><span class="pull-left">&nbsp;$</span> {{ $ma->interes }}</td>
            @endif

            @if( $ma->abonocapital == "SI")
              <td style="border: 1px solid #333; text-align: right; background: #b2ff59;"><span class="pull-left">&nbsp;$</span> {{ $ma->cuotacapital }}</td>
            @else
              <td style="border: 1px solid #333; text-align: right;"><span class="pull-left">&nbsp;$</span> {{ $ma->cuotacapital }}</td>
            @endif

            <td style="border: 1px solid #333; text-align: right;"><span class="pull-left">&nbsp;$</span> {{ $ma->totaldiario }}</td>

            @if( $ma->fechaefectiva != null)
            <td style="border: 1px solid #333" align="center"><span>{{ $ma->fechaefectiva->format('l j  F Y ') }}</span></td>
            @else
            <td style="border: 1px solid #333" align="center"><span>{{ $ma->fechaefectiva }}</span></td>
            @endif

            <td style="border: 1px solid #333" align="center"><span> {{ $ma->estado }}</span></td>
            
            <td style="border: 1px solid #333" align="center"><span></span> <a href="{{URL::action('LiquidacionController@edit', $ma->iddetalleliquidacion)}} " class="btn btn-success verde" data-title="Ingresar cuota"><i class="fa fa-fw -square -circle fa-plus-square"></i></a></td>
          </tr>
        @elseif($ma->estado == 'NO VALIDO')
          <tr style="background: #eeeeee;">

            @if($ma->fechadiaria->format('Y-m-d') == $fecha_actual->format('Y-m-d'))
              <td style="border: 1px solid #333; background: #ffd740;" align="right"><span><a class="rojo" data-title=" ANULAR PAGO " href="" data-target="#modal-delete-{{$ma->iddetalleliquidacion}}" data-toggle="modal"> {{ $ma->contador}}</a></span></td>
            @else
              <td style="border: 1px solid #333;" align="right"><span><a class="rojo" data-title=" ANULAR PAGO " href="" data-target="#modal-delete-{{$ma->iddetalleliquidacion}}" data-toggle="modal"> {{ $ma->contador}}</a></span></td>
            @endif

            <!-- Pasamos la fecha a español con Jenssegers -->
            
            @if( $ma->fechadiaria != null)
            <td style="border: 1px solid #333;" align="center"><span> {{ $ma->fechadiaria->format('l j  F Y ') }}</span></td>
            @else
            <td style="border: 1px solid #333" align="center"><span>{{ $ma->fechadiaria }}</span></td>
            @endif

            <td style="border: 1px solid #333; text-align: right;"><span class="pull-left">&nbsp;$</span> {{ $ma->monto }}</td>

            <td style="border: 1px solid #333; text-align: right;"><span class="pull-left">&nbsp;$</span> {{ $ma->interes }}</td>

            <td style="border: 1px solid #333; text-align: right;"><span class="pull-left">&nbsp;$</span> {{ $ma->cuotacapital }}</td>
            <td style="border: 1px solid #333; text-align: right;"><span class="pull-left">&nbsp;$</span> {{ $ma->totaldiario }}</td>

            @if( $ma->fechaefectiva != null)
            <td style="border: 1px solid #333" align="center"><span>{{ $ma->fechaefectiva->format('l j  F Y ') }}</span></td>
            @else
            <td style="border: 1px solid #333" align="center"><span>{{ $ma->fechaefectiva }}</span></td>
            @endif

            <td style="border: 1px solid #333" align="center"><span> {{ $ma->estado }}</span></td>
            
            <td style="border: 1px solid #333" align="center"><span></span></td>
          </tr>
        @else
          <tr>
            @if($ma->fechadiaria->format('Y-m-d') == $fecha_actual->format('Y-m-d'))
              <td style="border: 1px solid #333; background: #ffd740;" align="right"><span><a class="rojo" data-title=" ANULAR PAGO " href="" data-target="#modal-delete-{{$ma->iddetalleliquidacion}}" data-toggle="modal"> {{ $ma->contador}}</a></span></td>
            @else
              <td style="border: 1px solid #333;" align="right"><span><a class="rojo" data-title=" ANULAR PAGO " href="" data-target="#modal-delete-{{$ma->iddetalleliquidacion}}" data-toggle="modal"> {{ $ma->contador}}</a></span></td>
            @endif

            <!-- Pasamos la fecha a español con Jenssegers -->
            
            @if( $ma->fechadiaria != null)
            <td style="border: 1px solid #333;" align="center"><span> {{ $ma->fechadiaria->format('l j  F Y ') }}</span></td>
            @else
            <td style="border: 1px solid #333" align="center"><span>{{ $ma->fechadiaria }}</span></td>
            @endif

            <td style="border: 1px solid #333; text-align: right;"><span class="pull-left">&nbsp;$</span> {{ $ma->monto }}</td>

            <td style="border: 1px solid #333; text-align: right;"><span class="pull-left">&nbsp;$</span> {{ $ma->interes }}</td>

            <td style="border: 1px solid #333; text-align: right;"><span class="pull-left">&nbsp;$</span> {{ $ma->cuotacapital }}</td>
            <td style="border: 1px solid #333; text-align: right;"><span class="pull-left">&nbsp;$</span> {{ $ma->totaldiario }}</td>

            @if( $ma->fechaefectiva != null)
            <td style="border: 1px solid #333" align="center"><span>{{ $ma->fechaefectiva->format('l j  F Y ') }}</span></td>
            @else
            <td style="border: 1px solid #333" align="center"><span>{{ $ma->fechaefectiva }}</span></td>
            @endif

            <td style="border: 1px solid #333" align="center"><span> {{ $ma->estado }}</span></td>
            
            <td style="border: 1px solid #333" align="center"><span></span> <a href="{{URL::action('LiquidacionController@edit', $ma->iddetalleliquidacion)}} " class="btn btn-success verde" data-title="Ingresar cuota"><i class="fa fa-fw -square -circle fa-plus-square"></i></a></td>
          </tr>
        @endif

        @include('liquidacion.modal')
      @endforeach
      <tr class="danger">
        <td style="border: 1px solid #333"><span>TOTALES</span></td>
        <td style="border: 1px solid #333"></td>
        <td style="border: 1px solid #333"></td>
        <td style="border: 1px solid #333; text-align: right;"><span class="pull-left">&nbsp;$</span><a href="#" data-title="Total de Intereses" class="rojo total"> <b>{{$sum_interes_diario}}</b></a></td>

        <td style="border: 1px solid #333; text-align: right;"><span class="pull-left">&nbsp;$</span><a href="#" data-title="Total de cuota capital" class="rojo total"> <b>{{$sum_cuota_capital}}</b></a></td>

        <td style="border: 1px solid #333; text-align: right;"><span class="pull-left">&nbsp;$</span><a href="#" data-title="Total diario" class="rojo total"> <b>{{$sum_total_diario}}</b> </a></td>
        <td style="border: 1px solid #333"></td>
        <td style="border: 1px solid #333"></td>
        <td style="border: 1px solid #333"></td>
      </tr>
    </tbody>
  </table>
</div>
{{$liquidaciones->render()}}





<div class="row">
  <a href="{{URL::action('RecordClienteController@index')}}" class="btn btn-danger btn-lg col-md-offset-2"><i class="fa fa-chevron-left" aria-hidden="true"></i> Atrás</a>
</div>

<div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <h3 style="text-align:center; font-family:  Times New Roman, sans-serif; color: #1C2331; float: right;"><b>{{$fecha_server}}</b></h3>
  </div>
</div>

</section>



@endsection