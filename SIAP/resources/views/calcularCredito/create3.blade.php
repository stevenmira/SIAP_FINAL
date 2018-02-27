@extends ('layouts.inicio')
@section('contenido')

<?php
use Carbon\Carbon;
?>

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
    CALCULAR CRÉDITO
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ url('home')}}"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li><a href="{{URL::action('calcularCreditoController@create')}}"><i></i> Cálculo del crédito</a></li>
    <li><a href="#"><i></i> Resultado</a></li>
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
  <div class="alert  fade in" style="background:  #ccff90;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><b>{{ Session::get('mensaje')}}</b></h4>
  </div>
  @endif

  @if (Session::has('negativo'))
  <div class="alert  fade in" style="background:  #ff9e80;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><b>{{ Session::get('negativo')}}</b></h4>
  </div>
  @endif
  <!-- Fin Notificación -->

  <!-- Criterios de búsquedas -->  

  <!-- END Criterios de búsquedas -->
<?php
$monto=$nuevo_monto;



if ($tipoCredito==1)
        $tasa=1.70;
    else if($tipoCredito==2)
          $tasa=1.10;
          else if ($tipoCredito==3)
            $tasa=1;
                else if ($tipoCredito==4)
                  $tasa=0.80;
                      else
                        $tasa=0.70;


?>
<!--asignacion del nuevo monto-->

<br>
{!!Form::open(array('url'=>'calcular-credito/imprimir','method'=>'GET','autocomplete'=>'off'))!!}
            {{Form::token()}}


<input type="number" name="monto_capital" id="monto_capital" hidden="true" value="{{ $nuevo_monto }}">
<input type="number" name="gastos_diarios" id="gastos_diarios" hidden="true" value="{{ $cuota }}">
<input type="number" name="tasa_interes" id="tasa_interes" hidden="true" value="{{ $tasaInteres }}">
<input type="date" name="fecha" id="fecha" hidden="true" value="{{ $fecha }}">

  <button type="submit" class="btn btn-danger btn-lg" data-toggle="tooltip" data-placement="right"><i class="fa fa-print" aria-hidden="true"></i> Generar PDF </a></button>
  

{!!Form::close()!!}

<br>

<div class="table-responsive">
  <table class="table table-striped table-bordered  table-condensed table-hover">
 
      <tr class="info">
        <th style="border: 1px solid #333; width: 75px" rowspan="3"> </th>
        <th style="border: 1px solid #333; width: 200px" rowspan="2" align="center"><span>N</span></th>
        <th style="border: 1px solid #333; width: 130px" rowspan="2" align="center"><span>MONTO</span></th>
        <th style="border: 1px solid #333; width: 130px" align="center"><span>Interés diario</span></th>
        <th style="border: 1px solid #333; width: 130px" rowspan="2" align="center"><span>PAGOS DIARIOS</span></th>
        <td style="width: 130px; background-color:white;" ></td>
      </tr>
      <tr class="info">
        <td style="border: 1px solid #333; height: 10px; text-align:center;"> interes</td>
      </tr>
      <tr class="info">
        <td style="border: 1px solid #333; text-align: right;">1</td>

        <td style="border: 1px solid #333; text-align: right;"><span align="center" >$ {{$nuevo_monto}} </span></td>
       <td style="border: 1px solid #333; text-align: right;"><span align="center" > {{$tasa}} % </span></td>
        <td style="border: 1px solid #333"></td>
        <td style="border: 1px solid #333"></td>
       
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
        
      </tr>
      
  <?php 
    $monto_capital = $nuevo_monto;
    $cuota = $cuota;
    $contador = 0;
    $sum_interes_diario = 0;
    $sum_cuota_capital = 0;
    $sum_total_diario = 0;
    $cuotacapital=0
 
   ?>
     

      @while($monto_capital > $cuota)

      <?php 

         $contador = $contador + 1;
          
           if($contador==1)
            {$monto_capital=$monto_capital;
             $monto_capital = round($monto_capital, 2);}
          else
           { $monto_capital=$monto_capital - $cuotacapital;
             $monto_capital = round($monto_capital, 2);
          }
          

          $monto_capital = round($monto_capital, 2);
          $interes = round($monto_capital * $tasaInteres, 2);
          $cuota = round($cuota, 2);
          $cuotacapital = round($cuota - $interes,2);
         
         $nuevafecha= date("Y-m-d", strtotime("$fecha + ". $contador ." days"));

          $liquidacion->fechadiaria = $nuevafecha;
         
      ?>
   
      <tr>
        <td style="border: 1px solid #333;" align="right"><span> {{ $contador}}</span></td>

        <!-- Pasamos la fecha a español con Jenssegers -->
        
      
        <td style="border: 1px solid #333;" align="center"><span> {{ $liquidacion->fechadiaria->format('l j  F Y ') }}</span></td>
        

        <td style="border: 1px solid #333; text-align: right;"><span class="pull-left">&nbsp;$</span> {{ $monto_capital }}</td>

        <td style="border: 1px solid #333; text-align: right;"><span class="pull-left">&nbsp;$</span> {{ $interes }}</td>


       @if($monto_capital < $cuota)
        <?php
        
          $cuota=$monto_capital+$interes;
          $cuotacapital=$monto_capital;

        ?>
         <td style="border: 1px solid #333; text-align: right;"><span class="pull-left">&nbsp;$</span> {{ $cuotacapital }}</td>

        <td style="border: 1px solid #333; text-align: right;"><span class="pull-left">&nbsp;$</span> {{ $cuota }}</td>
       @else
         <td style="border: 1px solid #333; text-align: right;"><span class="pull-left">&nbsp;$</span> {{ $cuotacapital }}</td>

        <td style="border: 1px solid #333; text-align: right;"><span class="pull-left">&nbsp;$</span> {{ $cuota }}</td>
       

       @endif


        
       

        <?php 
        $sum_interes_diario = $sum_interes_diario + $interes;
        $sum_cuota_capital = $sum_cuota_capital + $cuotacapital;
        $sum_total_diario = $sum_total_diario + $cuota; 
        ?>

        
      </tr>

     @endwhile

     <!--Imprime la ultima iteraccion!-->

     

      <tr class="danger">
        <td style="border: 1px solid #333"><span>TOTALES</span></td>
        <td style="border: 1px solid #333"></td>
        <td style="border: 1px solid #333"></td>
        <td style="border: 1px solid #333; text-align: right;"><span class="pull-left">&nbsp;$</span><a href="#" data-title="Total de Intereses" class="rojo total"> <b>{{$sum_interes_diario}}</b></a></td>

        <td style="border: 1px solid #333; text-align: right;"><span class="pull-left">&nbsp;$</span><a href="#" data-title="Total de cuota capital" class="rojo total"> <b>{{$sum_cuota_capital}}</b></a></td>

        <td style="border: 1px solid #333; text-align: right;"><span class="pull-left">&nbsp;$</span><a href="#" data-title="Total diario" class="rojo total"> <b>{{$sum_total_diario}}</b> </a></td>
       
      </tr>
    </tbody>
  </table>
</div>

</section>

<div class="row">
  <a href="calcular-credito/create" class="btn btn-danger btn-lg col-md-offset-2"><i class="fa fa-chevron-left" aria-hidden="true"></i> Atrás</a>
</div>


@endsection