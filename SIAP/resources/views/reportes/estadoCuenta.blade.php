<!DOCTYPE html>
<html>
<head>
	<title>Formato Estado Cuenta</title>
	<style type="text/css">
		@page{
			margin-top: 25mm;
            margin-left: 15mm;
            margin-right: 15mm;
            margin-bottom: 25mm;

		}
		span{
			font-size: 13px;
		}
	</style>
</head>
<body>
	<div>
		<table>
			<tr>
				<th style="width: 500px;" align="left" valign="bottom">
					<img src="img/log.jpg" width="180px" height="70px">
				</th>
				<td valign="bottom">
					<span>{{$diahoy}} DE {{$meshoy}} DE {{$aniohoy}}</span>
				</td>
			</tr>
		</table>
	</div>
	<br>
	<div><span>CLIENTE: &nbsp;&nbsp;{{strtoupper($cliente->nombre)}} {{strtoupper($cliente->apellido)}}</span></div>
	<div><span>NEGOCIO: &nbsp;&nbsp;{{strtoupper($negocio->nombre)}} </span></div>
	<div><span>DUI: &nbsp;&nbsp;{{$cliente->dui}}</span></div>
	<div><span>NIT: &nbsp;&nbsp;{{$cliente->nit}}</span></div>
	<div><span>DIRECCION: &nbsp;&nbsp;{{strtoupper($cliente->direccion)}}</span></div>
	<div><span>TELEFONO: &nbsp;&nbsp;{{$cli->telefonocel}}</span></div>
	<br>
	<div><span>DEPARTAMENTO DE COBRO</span></div>
	<br>
	<br>
	<div align="center" style="width: 100%"><span>ESTADO DE CUENTA</span></div>
	<br>
	<div><span>DETALLE DE DEUDA</span></div>
	<br>
	<div>
		<table align="center" style="border-collapse: collapse; width: 99%;" >
			<thead>
				<tr>
					<th style="border: 1px solid #333; width: 30px; height: 20px;" align="center" valign="bottom" rowspan="2"><span style="font-size: 9px;">N</span></th>
					<th style="border: 1px solid #333; width: 200px;" align="center" valign="bottom" rowspan="2"><span style="font-size: 9px;">FECHAS</span></th>
					<th style="border: 1px solid #333" align="center" valign="bottom" rowspan="2"><span style="font-size: 10px;">DIAS</span></th>
					<th style="border: 1px solid #333" align="center" valign="bottom" colspan="2"><span style="font-size: 10px;">DETALLES</span></th>
					<th style="border: 1px solid #333" align="center" rowspan="2" colspan="2"><span style="font-size: 10px;">SALDO CAPITAL SIN<br>INTERESES</span></th>
					<th style="border: 1px solid #333" align="center" rowspan="2" colspan="2"><span style="font-size: 10px;">COBRO POR GESTION<br>COBRO</span></th>
					<th style="border: 1px solid #333" align="center" rowspan="2" colspan="2"><span style="font-size: 10px;">COBROS DE<br>ADMINISTRACION</span></th>
					<th style="border: 1px solid #333" align="center" rowspan="2" colspan="2"><span style="font-size: 10px;">TOTAL</span></th>
				</tr>
				<tr>
					<th style="border: 1px solid #333" align="center" valign="bottom" colspan="2"><span style="font-size: 10px;">CUOTA DIARIA<br>$&nbsp;&nbsp; {{$cliente->cuotadiaria}}</span></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td style="border: 1px solid #333; height: 30px;" align="center"><span style="font-size: 10px;">1</span></td>
					<td style="border: 1px solid #333" align="center"><span style="font-size: 10px;">Cuotas atrasadas <b>{{$estadoc->diasatrasados}}</b> de $ {{$cliente->cuotadiaria}}</span></td>
					<td style="border: 1px solid #333" align="center"><span style="font-size: 10px;">{{$estadoc->diasatrasados}}</span></td>
					<td style="border: 1px solid #333; border-right: 0px;"><span style="font-size: 13px;">&nbsp;&nbsp;$</span></td>
					<td style="border: 1px solid #333; border-left: 0px;" align="right"><span style="font-size: 13px;">{{$estadoc->diasatrasados*$cliente->cuotadiaria}}&nbsp;&nbsp;&nbsp;&nbsp;</span></td>
					<td style="border: 1px solid #333; border-right: 0px;" align="center"><span style="font-size: 10px;"></span></td>
					<td style="border: 1px solid #333; border-left: 0px;" align="center"><span style="font-size: 10px;"></span></td>
					<td style="border: 1px solid #333; border-right: 0px;" align="center"><span style="font-size: 10px;"></span></td>
					<td style="border: 1px solid #333; border-left: 0px;" align="center"><span style="font-size: 10px;"></span></td>
					<td style="border: 1px solid #333; border-right: 0px;" align="center"><span style="font-size: 10px;"></span></td>
					<td style="border: 1px solid #333; border-left: 0px;" align="center"><span style="font-size: 10px;"></span></td>
					<td style="border: 1px solid #333; border-right: 0px;"><span style="font-size: 13px;">&nbsp;&nbsp;$</span></td>
					<td style="border: 1px solid #333; border-left: 0px" align="right"><span style="font-size: 13px;">{{$estadoc->diasatrasados*$cliente->cuotadiaria}}&nbsp;&nbsp;&nbsp;&nbsp;</span></td>
				</tr>
				<tr>
					<td style="border: 1px solid #333; height: 30px;" align="center"><span style="font-size: 10px;">2</span></td>
					<td style="border: 1px solid #333" align="center"><span style="font-size: 10px;">Saldo capital sin intereses</span></td>
					<td style="border: 1px solid #333" align="center"><span style="font-size: 10px;"></span></td>
					<td style="border: 1px solid #333; border-right: 0px;" align="center"><span style="font-size: 10px;"></span></td>
					<td style="border: 1px solid #333; border-left: 0px;" align="center"><span style="font-size: 10px;"></span></td>
					<td style="border: 1px solid #333; border-right: 0px"; valign="bottom"><span style="font-size: 13px;">&nbsp;&nbsp;$</span></td>
					<td style="border: 1px solid #333; border-left: 0px;" align="right" valign="bottom"><span style="font-size: 13px;">{{$salmon}}&nbsp;&nbsp;</span></td>
					<td style="border: 1px solid #333; border-right: 0px;"><span style="font-size: 10px;"></span></td>
					<td style="border: 1px solid #333; border-left: 0px;" align="center"><span style="font-size: 10px;"></span></td>
					<td style="border: 1px solid #333; border-right: 0px;"><span style="font-size: 10px;"></span></td>
					<td style="border: 1px solid #333; border-left: 0px;"><span style="font-size: 10px;"></span></td>
					<td style="border: 1px solid #333; border-right: 0px;"><span style="font-size: 13px;">&nbsp;&nbsp;$</span></td>
					<td style="border: 1px solid #333; border-left: 0px;"><span style="font-size: 13px;">{{$salmon}}&nbsp;&nbsp;</span></td>
				</tr>
				<tr>
					<td style="border: 1px solid #333; height: 30px" align="center"><span style="font-size: 10px;">3</span></td>
					<td style="border: 1px solid #333" align="center"><span style="font-size: 10px;">Gastos por Gestión Cobro</span></td>
					<td style="border: 1px solid #333" align="center"><span style="font-size: 10px;"></span></td>
					<td style="border: 1px solid #333; border-right: 0px;" align="center"><span style="font-size: 10px;"></span></td>
					<td style="border: 1px solid #333; border-left: 0px;" align="center"><span style="font-size: 10px;"></span></td>
					<td style="border: 1px solid #333; border-right: 0px;" align="center"><span style="font-size: 10px;"></span></td>
					<td style="border: 1px solid #333; border-left: 0px;" align="center"><span style="font-size: 10px;"></span></td>
					<td style="border: 1px solid #333; border-right: 0px;"><span style="font-size: 13px;">&nbsp;&nbsp;$</span></td>
					<td style="border: 1px solid #333; border-left: 0px;" align="center"><span style="font-size: 13px;">{{$estadoc->gastosadmon}}</span></td>
					<td style="border: 1px solid #333; border-right: 0px;" align="center"><span style="font-size: 10px;"></span></td>					
					<td style="border: 1px solid #333; border-left: 0px;" align="center"><span style="font-size: 10px;"></span></td>
					<td style="border: 1px solid #333; border-right: 0px;"><span style="font-size: 13px;">&nbsp;&nbsp;$</span></td>
					<td style="border: 1px solid #333; border-left: 0px; " align="center"><span style="font-size: 13px;">{{$estadoc->gastosadmon}}</span></td>
				</tr>
				<tr>
					<td style="border: 1px solid #333; height: 30px" align="center"><span style="font-size: 10px;">4</span></td>
					<td style="border: 1px solid #333" align="center"><span style="font-size: 10px;">Gastos de Administracion por Notificacion</span></td>
					<td style="border: 1px solid #333" align="center"><span style="font-size: 10px;"></span></td>
					<td style="border: 1px solid #333; border-right: 0px;" align="center"><span style="font-size: 10px;"></span></td>
					<td style="border: 1px solid #333; border-left: 0px;" align="center"><span style="font-size: 10px;"></span></td>
					<td style="border: 1px solid #333; border-right: 0px;" align="center"><span style="font-size: 10px;"></span></td>
					<td style="border: 1px solid #333; border-left: 0px;" align="center"><span style="font-size: 10px;"></span></td>
					<td style="border: 1px solid #333; border-right: 0px;" align="center"><span style="font-size: 10px;"></span></td>
					<td style="border: 1px solid #333; border-left: 0px;" align="center"><span style="font-size: 10px;"></span></td>
					<td style="border: 1px solid #333; border-right: 0px;"><span style="font-size: 13px;">&nbsp;&nbsp;$</span></td>
					<td style="border: 1px solid #333; border-left: 0px;" align="right"><span style="font-size: 13px;">{{$estadoc->gastosnotariales}}&nbsp;&nbsp;</span></td>
					<td style="border: 1px solid #333; border-right: 0px;"><span style="font-size: 13px;">&nbsp;&nbsp;$</span></td>
					<td style="border: 1px solid #333; border-left: 0px; " align="center"><span style="font-size: 13px;">{{$estadoc->gastosnotariales}}</span></td>
				</tr>
				<tr>
					<th style="border: 1px solid #333; height: 30px" align="center" colspan="2"><span style="font-size: 9px;">TOTAL</span></th>
					<th style="border: 1px solid #333" align="center"><span style="font-size: 10px;"></span></th>
					<th style="border: 1px solid #333; border-right: 0px;"><span style="font-size: 13px;">&nbsp;&nbsp;$</span></th>
					<th style="border: 1px solid #333; border-left: 0px;" align="right"><span style="font-size: 13px;">{{$estadoc->diasatrasados*$cliente->cuotadiaria}}&nbsp;&nbsp;</span></th>
					<th style="border: 1px solid #333; border-right: 0px;"><span style="font-size: 13px;">$</span></th>
					<th style="border: 1px solid #333; border-left: 0px;" align="right"><span style="font-size: 13px;">{{$salmon}}&nbsp;&nbsp;</span></th>
					<th style="border: 1px solid #333; border-right: 0px;"><span style="font-size: 13px;">&nbsp;&nbsp;$</span></th>
					<th style="border: 1px solid #333; border-left: 0px;" align="right"><span style="font-size: 13px;">{{$estadoc->gastosadmon}}&nbsp;&nbsp;</span></th>
					<th style="border: 1px solid #333; border-right: 0px;"><span style="font-size: 13px;">&nbsp;&nbsp;$</span></th>
					<th style="border: 1px solid #333; border-left: 0px;" align="right"><span style="font-size: 13px;">{{$estadoc->gastosnotariales}}&nbsp;&nbsp;</span></th>
					<th style="border: 1px solid #333; border-right: 0px;"><span style="font-size: 13px;">&nbsp;&nbsp;$</span></th>
					<th style="border: 1px solid #333; border-left: 0px;" align="right"><span style="font-size: 13px;">{{$estadoc->diasatrasados*$cliente->cuotadiaria+$salmon+$estadoc->gastosnotariales+$estadoc->gastosadmon}}</span></th>
				</tr>
			</tbody>
		</table>
	</div>
	<br><br>
	<div><span>Por cada llamada que le empresa realice a su número de contacto después de a ver vencido el contrato se cargan $5.00 por llamada aun cuando esta no fuere correspondida. números de la empresa asignados: Tel: 2300-8288; Cel. 7333-9200</span></div>
	<br>
	<div><span>&nbsp;&nbsp;&nbsp;&nbsp;1. por visita ténica cuando el contrato ya este vencido se cargaran a su cuenta $10.00 aun cuando no sea atendida,</span></div><br>
	<div><span>- su credito vence el <b>{{$liquidacion->fechadiaria->format('l j')}} de {{$liquidacion->fechadiaria->format('F')}} de {{$liquidacion->fechadiaria->format('Y')}}</b> de no estar solvente a la fecha de vencimiento. Se cargaran mora por el incumplimiento de 1% diario sobre saldo deudor a la fecha.</span></div>
	<br><br><br><br><br><br>
	<div align="center"><b><span>Email: afimid@yahoo.com</span></b></div>
</body>
</html>