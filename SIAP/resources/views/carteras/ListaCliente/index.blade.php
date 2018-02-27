@extends ('layouts.inicio')
@section ('contenido')
<section class="content-header">
  <h1 style="color: #333333; font-family: 'Times New Roman', Times, serif;">
     LISTA DE CLIENTES POR CARTERA
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{URL::action('ClienteController@index')}}"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li class="active"><a href="{{URL::action('CarteraController@index')}}"> Carteras</a></li>
    <li class="active"> Cartera de clientes</li>
  </ol>
</section>

<br>
  <div class="row">
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
      @include('carteras.ListaCliente.search')
    </div>
  </div>
  <div class="row">
   <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
      <div style="text-align: left;">
        <h4><b>Cartera : </b> {{$nombre}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <b>Ejecutivo : </b>{{$car->ejecutivo}}  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <b>Supervisor : </b>{{$car->supervisor}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </h4>
    </div>
   </div>

   <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
      {!! Form::open(array('url'=>'lista/clientesPDF/'.$id ,'method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}
      <div class="form-group">
        <span class="input-group-btn">
        <input type="date" hidden="true" name="fecha" value="{{$searchText}}">
        <button type="submit" class="btn btn-danger btn-lg col-md-offset-2"><i class="fa fa-print" aria-hidden="true"></i>Imprimir</button></span>
      </div>
      {{Form::close()}}
    </div>
  </div>
<div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive" style="padding: 4px 4px;">
            <table class="table table-striped table-bordered table-condensed table-hover text-centered" style="border: 1px solid #333;">

                    <thead>
              <tr class="success" style="border: 1px solid #333;">

              <th colspan="12" style="border: 1px solid #333;">

             <h3 style="text-align: center;"><b>PAGOS DIARIOS</b></h3>

                              
                          </th>
                      </tr>
             <tr class="info" style="border: 1px solid #333;text-align: center;">

                            
                  <th style="border: 1px solid #333;text-align: center;">Nº</th>
                  <th style="border: 1px solid #333;text-align: center;">CLIENTE/NOMBRE</th>
                  <th style="border: 1px solid #333;text-align: center;">SALDO CAPITAL</th>
                  <th style="border: 1px solid #333;text-align: center;">INTERES DIARIO</th>
                  <th style="border: 1px solid #333;text-align: center;">CAPITAL DIARIO</th>
                  <th style="border: 1px solid #333;text-align: center;">TOTAL RECIBIDO DIARIO</th>
                  <th style="border: 1px solid #333;text-align: center;">#CUOTAS ATRASADAS</th>
                  <th style="border: 1px solid #333;text-align: center;">PRECIO DE CUOTA</th>
                  <th style="border: 1px solid #333;text-align: center;">TOTAL CUOTAS ATRASADAS</b></th>
                  </tr>

                        <?php
                        $sum_interes_diario=0;
                        $sum_capital_diario=0;
                        $sum_recibo_diario=0;
                        $sum_total_atrasadas=0;

                        $n=0;

                        $i=0;
                        ?>

                    </thead>
                      @foreach ($consulta as $con)
                     <tr style="text-align: center;">
                          
                          <?php $n=$n+1?>                         
                          <td style="border: 1px solid #333;">{{ $n}}</td>
                          <td style="border: 1px solid #333;">{{ $con->nombre }} {{ $con->apellido }}</td>

                          <?php $saldo_capital = $con->monto - $con->cuotacapital; ?>

                          @if($con->monto == null)
                          <td style="border: 1px solid #333;">{{ $array2[$i] }}</td>
                          @else
                           <td style="border: 1px solid #333;">{{ $saldo_capital }}</td>
                          @endif

                          <td style="border: 1px solid #333;">{{ $con->interes }}</td>
                          <td style="border: 1px solid #333;">{{ $con->cuotacapital }}</td>
                          <td style="border: 1px solid #333;">{{ $con->totaldiario }}</td>

                          <td style="border: 1px solid #333;">{{$array[$i]}}</td>
                          
                          <td style="border: 1px solid #333;">{{ $con->cuotadiaria }}</td>

                          <?php $total = $array[$i] * $con->cuotadiaria ?>
                          <td style="border: 1px solid #333;">{{ $total }}</td>
                      </tr>
                    


                      <?php 
                    
                     $sum_interes_diario = $sum_interes_diario + $con->interes; 
                     $sum_capital_diario = $sum_capital_diario + $con->cuotacapital;
                     $sum_recibo_diario =  $sum_recibo_diario+  $con->totaldiario;
                     $sum_total_atrasadas = $sum_total_atrasadas + $total;

                     $i = $i + 1;

                     ?>
                    @endforeach

                     <tr class="danger">
        <td style="border: 1px solid #333"><span>TOTAL</span></td>
        <td style="border: 1px solid #333"></td>
        <td style="border: 1px solid #333"></td>
      
        <td style="border: 1px solid #333; text-align: right;"><span class="pull-left">&nbsp;$</span><a href="#" data-title="Total de Intereses" class="rojo total"> <b>{{$sum_interes_diario}}</b></a></td>

        <td style="border: 1px solid #333; text-align: right;"><span class="pull-left">&nbsp;$</span><a href="#" data-title="Total de cuota capital" class="rojo total"> <b>{{ $sum_capital_diario}}</b></a></td>

        <td style="border: 1px solid #333; text-align: right;"><span class="pull-left">&nbsp;$</span><a href="#" data-title="Total diario" class="rojo total"> <b>{{  $sum_recibo_diario }}</b> </a></td>
         <td style="border: 1px solid #333"></td>
        <td style="border: 1px solid #333"></td>
        <td style="border: 1px solid #333; text-align: center;"><span class="pull-center">&nbsp;$</span><a href="#" data-title="Total Cuotas Atrasadas" class="rojo total"> <b>{{  $sum_total_atrasadas }}</b> </a></td>

        
       
      </tr>
    
  </table>

  </div>

<div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <h3 style="text-align:center; font-family:  Times New Roman, sans-serif; color: #1C2331; float: right;"><b>{{$fecha_actual}}</b></h3>
  </div>
</div>
@endsection
