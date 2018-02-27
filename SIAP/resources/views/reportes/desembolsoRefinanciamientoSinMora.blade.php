<!DOCTYPE html>
<html>
<head>
	<title>Desembolso Refinanciado</title>
	<style type="text/css">
		@page{
			margin-top: 10.0mm;
            margin-bottom: 10.0mm;
		}
		body{
			line-height: 22px;
		}
	</style>
</head>
<body>
	<div>
		<table>
			<tr>
				<th style="width: 500px;" align="center" valign="bottom">
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;AFIMID, S.A. DE C.V.
				</th>
				<td>
					<img src="img/log.jpg" width="180px" height="70px">
				</td>
			</tr>
			<tr>
				<td colspan="2" align="center">ASESORES FINANCIEROS MICRO IMPULSADORES DE NEGOCIOS<br>SOCIEDAD ANONIMA DE CAPITAL<br>VARIABLE</td>
			</tr>
		</table>
	</div>
	<br>
	<div style="width: 100%">
		<table style="width: 100%">
			<tr>				
				<td align="right">
					{{ $prestamo->created_at->format('d/m/Y') }}
				</td>
			</tr>
		</table>
	</div>
	<br>
	<div>Detalle de desembolso aprobado</div>
	<br><br>
	<div>
		<table align="center" style="width: 90%; border-collapse: collapse;">
			<tr>
				<th style="border: 1px solid #333; width: 30px" align="center">N</th>
				<th style="border: 1px solid #333" align="center" colspan="2">MONTO</th>
			</tr>
			<tr>
				<td style="border: 1px solid #333" align="right">{{$cuenta->numeroprestamo}}</td>
				<td style="border: 1px solid #333; border-right: 0px; width: 300px">$ </td>
				<td style="border: 1px solid #333; border-left: 0px; width: 40px" align="right">{{ $prestamo->monto }}</td>
			</tr>
		</table>
	</div>
	<br>
	<br>
	<br>
	<div>
		<table align="center" style="width: 80%; border-collapse: collapse;">
			<tr>
				<th>Desembolso</th>
				<th>$ &nbsp;&nbsp;{{$prestamo->monto}}</th>
			</tr>
			<tr>
				<td>( - Desc. De $4.50 de cada $100.00 por desembolso)</td>
				<td>$ &nbsp;&nbsp;{{ $costo }}</td>
			</tr>
			<tr>
				<td>( - CUOTAS ATRASADAS <b>{{$cuentaAnterior->cuotaatrasada}} * {{$prestamoAnterior->cuotadiaria}})</td>
				<?php $subtotal =  $cuentaAnterior->cuotaatrasada * $prestamoAnterior->cuotadiaria; ?>
				<td>$ &nbsp;&nbsp;{{ $subtotal }}</td>
			</tr>
			
			<tr>
				<td>( - Saldo capital de credito anterior)</td>
				<td>$ <u>&nbsp;&nbsp;{{ $cuentaAnterior->capitalanterior }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></td>
			</tr>
			<tr>
				<td>EFECTIVO A RECIBIR</td>
				<?php $total = $prestamo->monto - $costo - $subtotal - $cuentaAnterior->capitalanterior; ?>
				<td>$ &nbsp;&nbsp;{{$total}}</td>
			</tr>
		</table>
	</div>
	<br>
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
				<td style="width: 15%;">NOMBRE:</td>
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
</body>
</html>