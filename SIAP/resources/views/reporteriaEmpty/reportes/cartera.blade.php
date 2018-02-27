<!DOCTYPE html>
<html>
<head>
	<title>Formato Cartera Clientes</title>
	<style type="text/css">
		@page{
			margin-top: 7.0mm;
            margin-left: 7.0mm;
            margin-right: 7.0mm;
            margin-bottom: 7.0mm;

		}
		span{
			font-size: 13px;
		}
	</style>
</head>
<body>
	<div style="font-size: 23px" align="center">AFIMID, S.A. DE C.V.</div>
	<div align="center"><span>ACESORES FINANCIEROS MICRO IMPULSADORES DE NEGOCIOS S.A. DE C.V.</span></div>
	<table style="width: 100%;">
		<tbody>
			<tr>
				<td><span>FECHA: <u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>/<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>/<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></span></td>
				<td></td>
				<td><span>CARTERA:</span></td>
			</tr>
		</tbody>
	</table>
	<table style="border-collapse: collapse; width: 100%">
		<thead>
			<tr>
				<td style="border: 1px solid #333" colspan="10" align="center"><span>PAGOS DIARIOS</span></td>
			</tr>
			<tr>
				<td style="border: 1px solid #333" align="center"><span>N</span></td>
				<td style="border: 1px solid #333" align="center"><span>CLIENTE/NOMBRE</span></td>
				<td style="border: 1px solid #333" align="center"><span>SALDO<br>CAPITAL</span></td>
				<td style="border: 1px solid #333" align="center"><span>INTERES<br>DIARIO</span></td>
				<td style="border: 1px solid #333" align="center"><span>CAPITAL<br>DIARIO</span></td>
				<td style="border: 1px solid #333" align="center"><span>TOTAL<br>RECIBIDO<br>DIARIO</span></td>
				<td style="border: 1px solid #333" align="center"><span>#CUOTAS<br>ATRASADAS</span></td>
				<td style="border: 1px solid #333" align="center"><span>PRECIO DE<br>CUOTAS</span></td>
				<td style="border: 1px solid #333" align="center"><span>TOTAL $<br>CUOTAS<br>ATRASADAS</span></td>
				<td style="border: 1px solid #333" align="center"><span>OBSERVACIONES</span></td>
			</tr>
		</thead>
		<tbody>
			<?php 
				$count = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
			?>
			@foreach($count as $indice=>$result)
			<tr>
				<td style="border: 1px solid #333" align="right"><span>{{ $indice+1 }}</span></td>
				<td style="border: 1px solid #333"><span></span></td>
				<td style="border: 1px solid #333"><span>$</span></td>
				<td style="border: 1px solid #333"><span>$</span></td>
				<td style="border: 1px solid #333"><span>$</span></td>
				<td style="border: 1px solid #333"><span>$</span></td>
				<td style="border: 1px solid #333"><span>$</span></td>
				<td style="border: 1px solid #333"><span>$</span></td>
				<td style="border: 1px solid #333"><span></span></td>
				<td style="border: 1px solid #333"><span></span></td>
			</tr>
			@endforeach
			<tr>
				<td style="border: 1px solid #333" colspan="2"><span>TOTAL ************************</span></td>
				<td style="border: 1px solid #333"><span>$</span></td>
				<td style="border: 1px solid #333"><span>$</span></td>
				<td style="border: 1px solid #333"><span>$</span></td>
				<td style="border: 1px solid #333"><span>$</span></td>
				<td></td>
				<td></td>
				<td style="border: 1px solid #333"><span>$</span></td>
				<td></td>
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
				<td style="border: 1px solid #333"></td>
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