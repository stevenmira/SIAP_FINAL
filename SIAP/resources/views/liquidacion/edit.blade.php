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
    CARTERA DE PAGO
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ url('home')}}"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li><a href="{{URL::action('RecordClienteController@index')}}"> Récord Cliente</a></li>
    <li><a href="{{URL::action('CuentaController@show',$cuenta->idcuenta)}}"> Cuenta</a></li>
    <li><a href="{{ url('cuenta/carteraPagos', ['id' => $cuenta->idcuenta]) }}"> Cartera de Pagos</a></li>
    <li class="active">Agregar Pago</li>
  </ol>
</section>
<br>

{!!Form::model($liquidacion,['method'=>'PATCH','route'=>['ingresarPago.update',$liquidacion->iddetalleliquidacion]])!!}
{{Form::token()}}

<div class="container">
<h2 style="color: #333333; font-family: bold;"><b> {{$cliente->nombre}} {{$cliente->apellido}} </b></h2>
<hr style="width: 100%; height: 4px; background: green;">
</div>

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

<section class="posts col-lg-9 col-md-9 col-sm-9" style="background: #fffde7;">
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 toppad">

      <div class="row">
        <div class="form-group col-lg-1 col-md-1 col-sm-1">
          <label for="nombre">DIA</label>
          <p>{{$liquidacion->contador}}</p>
        </div>

        <div class="form-group col-lg-3 col-md-3 col-sm-3">
          <label for="apellido">FECHA </label>
            <!-- Pasamos la fecha a español con Jenssegers -->
            <?php $fechadiaria = $liquidacion->fechadiaria; ?>
            <p>{{ $fechadiaria->format('l j  F Y ') }}</p>
        </div>

        <div class="form-group col-lg-3 col-md-3 col-sm-3">
          <label for="apellido">TASA DE INTERÉS</label>
            <p><span readonly="readonly" id="tasaInteres">{{ $tipo_credito->interes}}</span></p>
        </div>

        <div class="form-group col-lg-3 col-md-3 col-sm-3">
          <label for="apellido">ESTADO DE CUOTA</label>
            <p>{{ $liquidacion->estado }}</p>
        </div>

        <div class="form-group col-lg-2 col-md-2 col-sm-2">
          <label for="apellido">SIGUIENTE ></label>
            <p>$ <span id="new_montocapital"></span></p> 
        </div>
      </div>

      <div class="row">

        <div class="form-group col-lg-3 col-md-3 col-sm-3">
          <label>MONTO CAPITAL</label>
          <div class="input-group">
            <div class="input-group-addon">
              <i class="fa fa-money" aria-hidden="true"></i>
            </div>
            {!! Form::number('monto_capital', $liquidacion->monto, ['class' => 'form-control' , 'required' => 'required','step'=>'any', 'onkeyup'=>'calcularCuotas()', 'id'=>'monto_capital']) !!}
          </div>
        </div>

        <div class="form-group col-lg-3 col-md-3 col-sm-3">
          <label for="edad">TOTAL DIARIO</label>
          <div class="input-group">
            <div class="input-group-addon">
              <i class="fa fa-money" aria-hidden="true"></i>
            </div>
            {!! Form::number('total_diario', $liquidacion->totaldiario, ['class' => 'form-control' , 'placeholder'=>' . . .', 'autofocus'=>'on', 'required' => 'required', 'id'=>'ptotaldiario', 'step'=>'any', 'onkeyup'=>'calcularCuotas()', 'id'=>'total_diario']) !!}
          </div>
        </div>

        <div class="form-group col-lg-3 col-md-3 col-sm-3">
          <label for="edad">  FECHA EFECTIVA PAGO </label>
          <div class="input-group">
            <div class="input-group-addon">
              <i class="fa fa-calendar" aria-hidden="true"></i>
            </div>
            {!! Form::date('fecha_efectiva', $liquidacion->fechaefectiva, ['class' => 'form-control', 'autofocus'=>'on', 'required' => 'required']) !!}
          </div>
        </div>

        <div align="center" class="form-group col-lg-3 col-md-3 col-sm-3">
          <label> ¿ABONO A CAPITAL?</label>
          <div class="row text-center" data-toggle="buttons">
            <label for="success" class="btn" style="background: rgba(62, 69, 81, 0.7);">
              @if ($liquidacion->abonocapital == 'SI')
                {!! Form::checkbox('abonocapital',1,true, ['class'=>'badgebox', 'onkeyup'=>'calcularCuotas()', 'id'=>'checkbox' ]) !!}
              @else
                {!! Form::checkbox('abonocapital',1,false, ['class'=>'badgebox', 'onkeyup'=>'calcularCuotas()', 'id'=>'checkbox']) !!}
              @endif
            <span class="badge"><b> &check; </b></span>
            </label>
          </div>
        </div>

      </div>

      <br>
      <h5 style="font-family: bold;"> NOTA:</h5>
      <p style="font-family: bold; padding: 2px;"> -  De no seleccionar ¿Abono a Capital? se toma el pago como abono a CUOTA DIARIA.</p>

      <div class="row">
  <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12"><br>
      <div class="form-group">
          <input name="_token" value="{{csrf_token()}}" type="hidden"></input>
              <a href="{{ url('cuenta/carteraPagos', ['id' => $cuenta->idcuenta]) }}" class="btn btn-danger btn-lg col-md-offset-2 col-lg-offset-2 col-sm-offset-2"><i class="fa fa-times" aria-hidden="true"></i> Cancelar</a>
              <button class="btn btn-primary btn-lg col-md-offset-4 col-lg-offset-4 col-sm-offset-4" type="submit"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</button>
          </div>
      </div>
  </div>

  </div>
</section>

<aside class="col-md-3 col-lg-3 col-sm-12 col-xs-12" style="background: #b2dfdb;">
      <div class="row">
        @if($liquidacion->abonocapital == 'SI')
        <h4 style="text-align: center; font-family: bold;"><b><span id="tipoEncabezado">PAGO CUOTA CAPITAL</span></b></h4>
        @else
        <h4 style="text-align: center; font-family: bold;"><b><span id="tipoEncabezado">PAGO CUOTA DIARIA</span></b></h4>
        @endif

        <div class="form-group col-lg-6 col-md-6 col-sm-6">
          <p>INTERÉS DIARIO</p>
            {!! Form::text('interesDiario', $liquidacion->interes, ['class' => 'form-control' ,'readonly'=>'readonly', 'maxlength'=>'6', 'id'=>'interesDiario']) !!}
        </div>

        <div class="form-group col-lg-6 col-md-6 col-sm-6">
        @if($liquidacion->abonocapital == 'SI')
            <p><span id="tipoCuota">CUOTA CAPITAL</span></p>
        @else
            <p><span id="tipoCuota">CUOTA DIARIA</span></p>
        @endif
          {!! Form::text('cuota', $liquidacion->cuotacapital, ['class' => 'form-control' ,'readonly'=>'readonly', 'maxlength'=>'6', 'id'=>'cuota']) !!}
        </div>
      </div>
</aside>

@if($liquidacion->monto <= $prestamo->cuotadiaria)

<?php 
      $interes = round($liquidacion->monto * $tipo_credito->interes,2);
      $cuotacapital = $liquidacion->monto;
      $total = round($interes + $cuotacapital,2);
?>
<aside class="col-md-3 col-lg-3 col-sm-12 col-xs-12" style="background: #ffcdd2; font-family: bold;">
      <div class="row">
        <h4 style="text-align: center; font-family: bold;"><b>ÚLTIMO PAGO CUOTA DIARIA</b></h4>
      </div>
      
      <div class="row">
        <div class="form-group col-lg-6 col-md-6 col-sm-6">
          <p>INTERES:</p>
        </div>
          <div class="form-group col-lg-6 col-md-6 col-sm-6">
              {{$interes}}
          </div>
      </div>

      <div class="row">
        <div class="form-group col-lg-6 col-md-6 col-sm-6">
          <p>CUOTA DIARIA:</p>
        </div>
        <div class="form-group col-lg-6 col-md-6 col-sm-6">
            {{$cuotacapital}}
        </div>
      </div>

      <div class="row">
        <div class="form-group col-lg-6 col-md-6 col-sm-6">
          <p><b>TOTAL DIARIO:</b></p>
        </div>
        <div class="form-group col-lg-6 col-md-6 col-sm-6">
            <b>{{$total}}</b>
        </div>
      </div>
      
</aside>
<aside class="col-md-3 col-lg-3 col-sm-12 col-xs-12" style="background: #ffcdd2; font-family: bold;">
      <div class="row">
        <h4 style="text-align: center; font-family: bold;"><b>ÚLTIMO PAGO CUOTA CAPITAL</b></h4>
      </div>
      
      <div class="row">
        <div class="form-group col-lg-6 col-md-6 col-sm-6">
          <p>INTERES:</p>
        </div>
          <div class="form-group col-lg-6 col-md-6 col-sm-6">
              <p>0</p>
          </div>
      </div>

      <div class="row">
        <div class="form-group col-lg-6 col-md-6 col-sm-6">
          <p>CUOTA CAPITAL:</p>
        </div>
        <div class="form-group col-lg-6 col-md-6 col-sm-6">
            {{$liquidacion->monto}}
        </div>
      </div>

      <div class="row">
        <div class="form-group col-lg-6 col-md-6 col-sm-6">
          <p><b>TOTAL DIARIO:</b></p>
        </div>
        <div class="form-group col-lg-6 col-md-6 col-sm-6">
            <b>{{$liquidacion->monto}}</b>
        </div>
      </div>
      
</aside>
@else


<aside class="col-md-3 col-lg-3 col-sm-12 col-xs-12" style="background: #fff176; text-align: center; font-family: bold;">

      <div style="" class="row">
        <h4><b>OPERACIONES BÁSICAS</b></h4>

        <div class="form-group col-lg-6 col-md-6 col-sm-6">
          <p>A</p>
            {!! Form::text('a', null, ['class' => 'form-control', 'step'=>'any', 'onkeyup'=>'sumar()', 'id'=>'a']) !!}
        </div>

        <div class="form-group col-lg-6 col-md-6 col-sm-6">
          <p>B</p>
            {!! Form::text('b', null, ['class' => 'form-control', 'step'=>'any', 'onkeyup'=>'sumar()', 'id'=>'b']) !!}<span></span>
        </div>
      </div>
      <div class="row">
        <div class="form-group col-lg-6 col-md-6 col-sm-6">
          <p><b>SUMA</b></p>
        </div>
        <div class="form-group col-lg-6 col-md-6 col-sm-6">
            {!! Form::text('suma', null, ['class' => 'form-control' ,'readonly'=>'readonly', 'maxlength'=>'6', 'id'=>'suma']) !!}
        </div>
      </div>
</aside>

@endif

<div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <h3 style="text-align:center; font-family:  Times New Roman, sans-serif; color: #1C2331; float: right;"><b>{{$fecha_actual}}</b></h3>
  </div>
</div>


{!!Form::close()!!}

@push('scripts')


<!-- InputMask -->
<script src="{{asset('js/inputmask/jquery3.js')}}"></script>  

<!-- Script para hacer calculos de cuotas . . . -->

<script>
  function calcularCuotas(){
    monto_capital = parseFloat(document.getElementById("monto_capital").value);
    total_diario = parseFloat(document.getElementById("total_diario").value);
    tasaInteres = parseFloat(document.getElementById("tasaInteres").innerHTML);
    var checkbox = document.getElementById('checkbox');


      if (checkbox.checked) 
      {

        if (isNaN(total_diario)) {
          cuotaCapital = 0;
          interes = 0;
          new_montocapital = ' ';
        }
        else {
          interes = 0;
          cuotaCapital = total_diario;
          cuotaCapital = Math.round((cuotaCapital + 0.00001) * 100) / 100;            //solo para redondear a 2 decimales
          new_montocapital = monto_capital - cuotaCapital;
          new_montocapital = Math.round((new_montocapital + 0.00001) * 100) / 100;
        }
          document.getElementById("interesDiario").value = interes;
          document.getElementById("cuota").value = cuotaCapital;
          document.getElementById("tipoEncabezado").innerHTML = 'PAGO CUOTA CAPITAL';
          document.getElementById("tipoCuota").innerHTML = 'CUOTA CAPITAL';
          document.getElementById("new_montocapital").innerHTML = new_montocapital;
      }
      else
      {

        if (isNaN(total_diario)) {
            interesDiario = monto_capital * tasaInteres;
            interesDiario = Math.round((interesDiario + 0.00001) * 100) / 100;
          } 
          else
          {
              interesDiario = monto_capital * tasaInteres;
              interesDiario = Math.round((interesDiario + 0.00001) * 100) / 100; 
          }
            



          if (isNaN(total_diario)) {
          cuotaDiaria = 0;
          new_montocapital = ' ';
          }
          else {
               cuotaDiaria = total_diario - interesDiario;
               cuotaDiaria = Math.round((cuotaDiaria + 0.00001) * 100) / 100;
               new_montocapital = monto_capital - cuotaDiaria;
               new_montocapital = Math.round((new_montocapital + 0.00001) * 100) / 100;
            }

            document.getElementById("interesDiario").value = interesDiario;
            document.getElementById("cuota").value = cuotaDiaria;
            document.getElementById("tipoEncabezado").innerHTML = 'PAGO CUOTA DIARIA';
            document.getElementById("tipoCuota").innerHTML = 'CUOTA DIARIA';
            document.getElementById("new_montocapital").innerHTML = new_montocapital;
      }



    }

    function sumar(){
      a = parseFloat(document.getElementById("a").value);
      b = parseFloat(document.getElementById("b").value);

      if (isNaN(a)) {
          a = 0;
          b = 0;
        }
        else {
          suma = a+b;
          suma = Math.round((suma + 0.00001) * 100) / 100;                    //solo para redondear a 2 decimales

          resta = a-b;
          resta = Math.round((resta + 0.00001) * 100) / 100;                    //solo para redondear a 2 decimales
        }

          document.getElementById("suma").value = suma;
          document.getElementById("resta").value = resta;

    }

  

</script>

@endpush


@endsection