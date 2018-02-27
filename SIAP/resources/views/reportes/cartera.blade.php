<!DOCTYPE html>
<html>
<head>
	<title>Cartera Clientes</title>
	<style type="text/css">
		@page{
			margin-top: 7.0mm;
            margin-left: 7.0mm;
            margin-right: 7.0mm;
            margin-bottom: 7.0mm;

		}
		span{
			font-size: 11px;
		}
	</style>
</head>
<body>
	<div style="font-size: 23px" align="center">AFIMID, S.A. DE C.V.</div>
	<div align="center"><span>ACESORES FINANCIEROS MICRO IMPULSADORES DE NEGOCIOS S.A. DE C.V.</span></div>
	<table style="width: 100%;">
		<tbody>
			<tr>
				<td><span>FECHA: {{$query}}</span></td>
				<td style="width: 500px;"></td>
				<td><span>CARTERA: {{$nombree}} &nbsp;&nbsp;&nbsp;&nbsp;EJECUTIVO/ASESORES/SUPERVISOR: {{$car->ejecutivo}} </span></td>
			</tr>
		</tbody>
	</table>
	<table style="border-collapse: collapse; width: 100%">
		<thead>
			<tr>
				<td style="border: 1px solid #333" colspan="10" align="center"><span>PAGOS DIARIOS</span></td>
			</tr>
			<tr>
				<th style="border: 1px solid #333" align="center"><span>N</span></th>
				<th style="border: 1px solid #333" align="center"><span>CLIENTE/NOMBRE</span></th>
				<th style="border: 1px solid #333" align="center"><span>SALDO<br>CAPITAL</span></th>
				<th style="border: 1px solid #333" align="center"><span>INTERES<br>DIARIO</span></th>
				<th style="border: 1px solid #333" align="center"><span>CAPITAL<br>DIARIO</span></th>
				<th style="border: 1px solid #333" align="center"><span>TOTAL<br>RECIBIDO<br>DIARIO</span></th>
				<th style="border: 1px solid #333" align="center"><span>#CUOTAS<br>ATRASADAS</span></th>
				<th style="border: 1px solid #333" align="center"><span>PRECIO DE<br>CUOTAS</span></th>
				<th style="border: 1px solid #333" align="center"><span>TOTAL $<br>CUOTAS<br>ATRASADAS</span></th>
				<th style="border: 1px solid #333" align="center"><span>OBSERVACIONES</span></th>
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
		<tbody>
			@foreach ($consulta as $con)
            <tr style="text-align: center;">
            <?php $n=$n+1?>                         
                <td style="border: 1px solid #333;"><span>{{ $n}}</td>
                <td style="border: 1px solid #333;"><span>{{ $con->nombre }} {{ $con->apellido }}</td>
                <?php $saldo_capital = $con->monto - $con->cuotacapital; ?>
				@if($con->monto == null)
                <td style="border: 1px solid #333;"><span>{{ $array2[$i] }}</td>
                @else
                <td style="border: 1px solid #333;"><span>{{ $saldo_capital }}</td>
                @endif
				<td style="border: 1px solid #333;"><span>{{ $con->interes }}</td>
                <td style="border: 1px solid #333;"><span>{{ $con->cuotacapital }}</td>
                <td style="border: 1px solid #333;"><span>{{ $con->totaldiario }}</td>
				<td style="border: 1px solid #333;"><span>{{$array[$i]}}</td>
                <td style="border: 1px solid #333;"><span>{{ $con->cuotadiaria }}</td>
				<?php $total = $array[$i] * $con->cuotadiaria ?>
                <td style="border: 1px solid #333;"><span>{{ $total }}</td>
                <td style="border: 1px solid #333;"><span></td>
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
		        <td style="border: 1px solid #333; text-align: right;"><span class="pull-left">&nbsp;$ <b>{{$sum_interes_diario}}</b></a></td>
		        <td style="border: 1px solid #333; text-align: right;"><span class="pull-left">&nbsp;$ <b>{{ $sum_capital_diario}}</b></a></td>
        		<td style="border: 1px solid #333; text-align: right;"><span class="pull-left">&nbsp;$ <b>{{  $sum_recibo_diario }}</b> </a></td>
         		<td style="border: 1px solid #333"></td>
        		<td style="border: 1px solid #333"></td>
        		<td style="border: 1px solid #333; text-align: center;"><span class="pull-center">&nbsp;$ <b>{{  $sum_total_atrasadas }}</b> </a></td>
        		<td style="border: 1px solid #333;"></td>  

       		</tr>
		</tbody>
	</table>
	<br>
	<table style="width: 100%;">
		<tbody>
			<tr>
				<td style="width: 31%"> </td>
				<td style="width: 33%;"></td>
				<td style="width: 33%"><span>F: <u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></span></td>
			</tr>
			<tr>
				<td><span>F: <u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></span></td>
				<td></td>
				<td style="border: 1px solid #333"></td>
			</tr>
			<tr>
				<td style="border: 1px solid #333"><span>{{$car->ejecutivo}}</td>
				<td></td>
				<td><span>RECIBO</span></td>
			</tr>
			<tr>
				<td><span>NOMBRE DE EJECUTIVO/ASESOR/SUPERVISOR</span></td>
				<td></td>
				<td><span>DIA: <u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>/<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>/<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></span></td>
			</tr>
			<tr>
				<td><span>ENCARGADO DE COBRO</span></td>
				<td></td>
				<td><span>HORA: <u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></span></td>
			</tr>
		</tbody>
	</table>
</body>
</html>