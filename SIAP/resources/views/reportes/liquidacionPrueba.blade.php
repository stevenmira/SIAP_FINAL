<!DOCTYPE html>
<html>
<head>
	<title>Cartera Pago</title>
	<style type="text/css">
		@page{
			margin-top: 1.5mm;
            margin-left: 1.5mm;
            margin-right: 1.5mm;
            margin-bottom: 1.5mm;

		}
		span{
			font-size: 10px;
		}
	</style>
</head>
<body>
	<div align=center><b>AFIMID S.A. de C.V.</b></div>
	<div align=center>ASESORES FINANCIEROS MICRO IMPULSADORES DE NEGOCIOS&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$fecha}}</div>

	<table style="border-collapse: collapse;">
		<tbody>
			<tr>
				<td colspan="6"><span>Detalles de pagos de capital e intereses</span></td>
			</tr>
		</tbody>
	</table>

	<table style="border-collapse: collapse;">
		<thead>
			<tr>
				<th style="width: 75px" rowspan="3"> </th>
				<th style="border: 1px solid #333; width: 165px" rowspan="2" align="center"><span>N</span></th>
				<th style="border: 1px solid #333; width: 70px" rowspan="2" align="center"><span>MONTO</span></th>
				<th style="border: 1px solid #333; width: 85px" align="center"><span>Interés diario</span></th>
				<th style="border: 1px solid #333; width: 85px" rowspan="2" align="center"><span>PAGOS DIARIOS</span></th>
				<th style="width: 85px" rowspan="2"> </th>
				<th style="border: 1px solid #333;" rowspan="3" align="center"><span>{{$tasa_interes*100}}%</th>
				<th rowspan="2"></th>
				<th rowspan="2"></th>
			</tr>
			<tr>
				<td style="border: 1px solid #333; height: 10px;" align="center"><span>{{$tasa_interes*100}}%</td>
			</tr>
			<tr>
				<td style="border: 1px solid #333"></td>
				<td style="border: 1px solid #333" align=""><span>&nbsp;$ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$monto_capital}}</span></td>
				<td style="border: 1px solid #333"></td>
				<td style="border: 1px solid #333"></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td style="border: 1px solid #333" align="center"><span>DIA</span></td>
				<td style="border: 1px solid #333" align="center"><span>FECHA</span></td>
				<td style="border: 1px solid #333" align="center"><span>MONTO</span></td>
				<td style="border: 1px solid #333" align="center"><span>INTERES DIARIO</span></td>
				<td style="border: 1px solid #333" align="center"><span>CUOTA CAPITAL</span></td>
				<td style="border: 1px solid #333" align="center"><span>TOTAL DIARIO</span></td>
				<td style="border: 1px solid #333" align="center"><span>FIRMA DE<br>COMPROBANTE DE<br>PAGO</span></td>
				<td style="border: 1px solid #333" align="center"><span>FECHA EFECTIVA DE<br>PAGO</span></td>
				<td style="border: 1px solid #333" align="center"><span>ABONO</span></td>
			</tr>
		</thead>
		<tbody>
			<?php 

				$n=0;
				$actasa=0.0;
				$accuo=0.0;
				$acdiar=0.0;

				$cont = 0;

				while($monto_capital>$pagos_diarios)
				{	
					$n++;
					$cont++;

					$interes_diario=round($monto_capital*$tasa_interes,2);
					$cuota_capital=round($pagos_diarios-$interes_diario,2);
					$nuvfecha=date("Y-m-d",strtotime("$fecha + ".$cont." days "));
					$liquidacion->fechadiaria=$nuvfecha;				
			?>
			<tr>
				<td style="border: 1px solid #333" align="right"><span>{{ $n }}</span></td>
				<td style="border: 1px solid #333" align="right"><span>{{$liquidacion->fechadiaria->format('l j F Y')}}</span></td>
				<td style="border: 1px solid #333"><span>&nbsp;$ {{round($monto_capital,2)}}</span></td>
				<td style="border: 1px solid #333"><span>&nbsp;$ {{round($interes_diario,2)}}</span></td>
				<td style="border: 1px solid #333"><span>&nbsp;$ {{round($cuota_capital,2)}}</span></td>
				<td style="border: 1px solid #333"><span>&nbsp;$ {{$pagos_diarios}}</span></td>
				<td style="border: 1px solid #333" align="center"><span></span></td>
				<td style="border: 1px solid #333" align="center"><span></span></td>
				<td style="border: 1px solid #333" align="center"><span></span></td>
			</tr>
			<?php
					$monto_capital=$monto_capital-$cuota_capital; 
					$actasa=$actasa+$interes_diario;
					$accuo=$accuo+$cuota_capital;
					$acdiar=$acdiar+$pagos_diarios;
					
				}

				$interes_diario=$monto_capital*$tasa_interes;
				$total_diario=$monto_capital+ $interes_diario;
				$cuota_capital=$monto_capital;
				
				$actasa=$actasa+$interes_diario;
				$accuo=$accuo+$cuota_capital;
				$acdiar=$acdiar+$total_diario;

				$n++;

				$cont++;

				$nuvfecha=date("Y-m-d",strtotime("$fecha + ".$cont." days "));
				$liquidacion->fechadiaria=$nuvfecha;
				
				if ($total_diario>$pagos_diarios) {
					$cuota_capital=$pagos_diarios-$interes_diario;

			?>
					<tr>
						<td style="border: 1px solid #333" align="right"><span>{{ $n }}</span></td>
						<td style="border: 1px solid #333" align="right"><span>{{$liquidacion->fechadiaria->format('l j F Y')}}</span></td>
						<td style="border: 1px solid #333; text-align: right;"><span>&nbsp;$ {{round($monto_capital,2)}}</span></td>
						<td style="border: 1px solid #333; text-align: right;"><span>&nbsp;$ {{round($interes_diario,2)}}</span></td>
						<td style="border: 1px solid #333; text-align: right;"><span>&nbsp;$ {{round($cuota_capital,2)}}</span></td>
						<td style="border: 1px solid #333; text-align: right;"><span>&nbsp;$ {{$pagos_diarios}}</span></td>
						<td style="border: 1px solid #333" align="center"><span></span></td>
						<td style="border: 1px solid #333" align="center"><span></span></td>
						<td style="border: 1px solid #333" align="center"><span></span></td>
					</tr>
			<?php
					$monto_capital=round($monto_capital-$cuota_capital);
					$interes_diario=round($monto_capital*$tasa_interes);
					$total_diario=round($monto_capital+$interes_diario);

					$cuota_capital=$monto_capital;
				
					$actasa=$actasa+$interes_diario;
					$accuo=$accuo+$cuota_capital;
					$acdiar=$acdiar+$total_diario;

					$n++;
					$cont++;

					$nuvfecha=date("Y-m-d",strtotime("$prestamo->fecha + ".$cont." days "));
					$liquidacion->fechadiaria=$nuvfecha;

				}
			?>

			<tr>
				<td style="border: 1px solid #333" align="right"><span>{{ $n }}</span></td>
				<td style="border: 1px solid #333" align="right"><span>{{$liquidacion->fechadiaria->format('l j F Y')}}</span></td>
				<td style="border: 1px solid #333"><span>&nbsp;$ {{round($monto_capital,2)}}</span></td>
				<td style="border: 1px solid #333"><span>&nbsp;$ {{round($interes_diario,2)}}</span></td>
				<td style="border: 1px solid #333"><span>&nbsp;$ {{round($cuota_capital,2)}}</span></td>
				<td style="border: 1px solid #333"><span>&nbsp;$ {{round($total_diario,2)}}</span></td>
				<td style="border: 1px solid #333" align="center"><span></span></td>
				<td style="border: 1px solid #333" align="center"><span></span></td>
				<td style="border: 1px solid #333" align="center"><span></span></td>
			</tr>

			<tr>
				<td><span>TOTALES</span></td>
				<td></td>
				<td></td>
				<td><span>&nbsp;$ {{round($actasa,2)}}</span></td>
				<td><span>&nbsp;$ {{round($accuo,2)}}</span></td>
				<td><span>&nbsp;$ {{round($acdiar,2)}}</span></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
		</tbody>
	</table>
</body>
</html>