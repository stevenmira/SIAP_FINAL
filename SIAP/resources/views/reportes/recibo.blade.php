<!DOCTYPE html>
<html>
<head>
	<title>Recibo</title>
	<style type="text/css">
		@page{
            margin-bottom: 0.0mm;
            margin-top: 3mm;

		}
		span{
			font-size: 10px;
		}
	</style>
</head>
<body>
	<div align="center"><b><span style="font-size: 14px">AFIMID, S.A. de C.V</span></b></div>
	<div align="center"><span style="font-size: 12px;">AFIMID ASESORES FINANCIEROS MICRO IMPULSADORES DE NEGOCIOS SOCIEDAD ANONIMA DE CAPITAL VARIABLE</span></div>
	<div align="center"><b><span style="font-size: 14px">COMPROBANTE DE PAGO "CLIENTE"/INGRESO  "ADMON"</b></div>
	<div>
		<table style="border-collapse: collapse; width: 100%">
			<tr>
				<td style="width: 80px"><span style="font-size: 12px;">Fecha</td>
				<td style="width: 1px"><span style="font-size: 12px;">{{$hoy}}</td>
				<td style="width: 70px"> </td>
				<td style="width: 100px"><span style="font-size: 12px;"> </td>
				<td style="width: 20px"><span style="font-size: 12px;"> </td>
				<td style="width: 40px"><span style="font-size: 12px;"> </td>
				<td style="width: 120px"><span style="font-size: 12px;"> </td>
				<td><span style="font-size: 12px;"></td>
				<td><span style="font-size: 12px;"></td>
				<td style="width: 1px"><span style="font-size: 12px;">N°</td>
				<td colspan="2" style="border: 1px solid #333;" align="center"><span style="font-size: 12px;">{{$numeri}}<span style="font-size: 12px;"></td>
			</tr>
			<tr>
				<td><span style="font-size: 12px;">CLIENTE:</td>
				<td colspan="3" style="border: 1px solid #333;" align="center"><span style="font-size: 12px;">{{$cliente->nombre}} {{$cliente->apellido}}</td>
				<td><span style="font-size: 12px;"></td>
				<td align="center"><span style="font-size: 12px;">DUI:</td>
				<td align="center" style="border: 1px solid #333;"><span style="font-size: 12px;">{{$cliente->dui}}</td>
				<td><span style="font-size: 12px;"></td>
				<td><span style="font-size: 12px;"></td>
				<td><span style="font-size: 12px;"></td>
				<td><span style="font-size: 12px;"></td>
				<td><span style="font-size: 12px;"></td>
			</tr>
			<tr>
				<td align="center" colspan="4" style="border: 1px solid #333;"><b><span style="font-size: 12px;">PAGOS</b></td>
				<td><span style="font-size: 12px;"></td>
				<td style="border: 1px solid #333;" colspan="4"><span style="font-size: 12px;">Tasa interes</td>
				<td><span style="font-size: 12px;"></td>
				<td style="border: 1px solid #333;" align="left"><span style="font-size: 12px;">&nbsp;&nbsp;{{($tipo->interes)*100}} %</td>
				<td><span style="font-size: 12px;"></td>
			</tr>
			<tr>
				<td colspan="2" style="border: 1px solid #333;"><span style="font-size: 12px;">Cobros x Admon</td>
				<td><span style="font-size: 12px;"></td>
				<td style="border: 1px solid #333;"><span style="font-size: 12px;">&nbsp;&nbsp;$
					@if($cobro==0)
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- </td>
					@else
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$cobro}} 
					@endif
				</td>
				<td><span style="font-size: 12px;"></td>
				<td colspan="4" style="border: 1px solid #333;"><span style="font-size: 12px;">Saldo Actual CAPITAL sin intereses</td>
				<td><span style="font-size: 12px;"></td>
				<td colspan="2" style="border: 1px solid #333;"><span style="font-size: 12px;">&nbsp;&nbsp;$&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$salmon}}</td>
			</tr>
			<tr>				
				<td colspan="2" style="border: 1px solid #333;"><span style="font-size: 12px;">Recargo por Mora</td>
				<td align=right><span style="font-size: 12px;">%</td>
				<td style="border: 1px solid #333;"><span style="font-size: 12px;">&nbsp;&nbsp;$
					@if($recargo==0)
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- </td>
					@else
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$recargo}} 
					@endif
				</td>
				<td><span style="font-size: 12px;"></td>
				<td colspan="4" style="border: 1px solid #333"><span style="font-size: 12px;">CUOTAS VENCIDAS</td>
				<td><span style="font-size: 12px;"></td>
				<td colspan="2" style="border: 1px solid #333;"><span style="font-size: 12px;">&nbsp;&nbsp;N°&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$cuotasatrasadas}}</td>
			</tr>
			<tr>
				<td style="border-left: 1px solid #333;" colspan="3"><span style="font-size: 12px;">ABONO A CUOTA N° 
					@if($abonoA=="")
					<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></td>
					@else
					<u>&nbsp;&nbsp;{{$abonoA}}&nbsp;&nbsp;</u>
					@endif
				<td style="border: 1px solid #333;"><span style="font-size: 12px;">&nbsp;&nbsp;$
					@if($abonoB==0)
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- </td>
					@else
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$abonoB}} 
					@endif
				</td>
				<td><span style="font-size: 12px;"></td>
				<td style="border: 1px solid #333;" colspan="4"><span style="font-size: 12px;">TOTAL EN $ DE CUOTAS VENCIDAS</td>
				<td><span style="font-size: 12px;"></td>
				<td style="border: 1px solid #333;" colspan="2"><span style="font-size: 12px;">&nbsp;&nbsp;$&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$cuotasatrasadas*$prestamo->cuotadiaria}}</td>
			</tr>
			<tr>
				<td style="border-left:  1px solid #333;" colspan="3"><span style="font-size: 12px;">COMPLEMENTO DE CUOTA N° 
					@if($compleA=="")
					<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></td>
					@else
					<u>{{$compleA}}</u>
					@endif
				</td>
				<td style="border: 1px solid #333;"><span style="font-size: 12px;">&nbsp;&nbsp;$
					@if($compleB==0)
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-</td>
					@else
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$compleB}} 
					@endif
				</td>
				<td><span style="font-size: 12px;"></td>
				<td style="border: 1px solid #333;" colspan="4"><span style="font-size: 12px;">TOTAL DEUDA</td>
				<td><span style="font-size: 12px;"></td>
				<td style="border: 3px solid #333;" colspan="2"><span style="font-size: 12px;">&nbsp;&nbsp;$&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{($cuotasatrasadas*$prestamo->cuotadiaria)+$salmon}}</td>
			</tr>
			<tr>
				<td style="border-left:  1px solid #333;" colspan="3"><span style="font-size: 12px;">CUOTA COMPLETA N° 
					@if($cuotaA=="")
					<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></td>
					@else
					<u>&nbsp;&nbsp;{{$cuotaA}}&nbsp;&nbsp;</u>
					@endif
				</td>
				<td style="border: 1px solid #333;"><span style="font-size: 12px;">&nbsp;&nbsp;$
					@if($cuotaB==0)
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- </td>
					@else
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$cuotaB}} 
					@endif
				</td>
				<td><span style="font-size: 12px;"></td>
				<td style="border: 1px solid #333;" colspan="4"><span style="font-size: 12px;"></td>
				<td><span style="font-size: 12px;"></td>
				<td style="border: 1px solid #333;" colspan="2"><span style="font-size: 12px;"></td>
			</tr>
			<tr>
				<td style="border: 1px solid #333;" colspan="2"><span style="font-size: 12px;">Gastos Notariales</td>
				<td><span style="font-size: 12px;"></td>
				<td style="border: 1px solid #333;"><u><span style="font-size: 12px;">&nbsp;&nbsp;$
					@if($gastos==0)
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- </td>
					@else
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$gastos}} 
					@endif
				</u></td>
				<td><span style="font-size: 12px;"></td>
				<td colspan="4" style="border: 1px solid #333;"><span style="font-size: 12px;"></td>
				<td><span style="font-size: 12px;"></td>
				<td colspan="2" style="border: 1px solid #333;"><span style="font-size: 12px;"></td>
			</tr>
			<tr>
				<td style="border: 1px solid #333;" colspan="2"><b><span style="font-size: 12px;">Total pagado</b></td>
				<td><span style="font-size: 12px;"></td>
				<td style="border: 3px solid #333;"><b><span style="font-size: 12px;">&nbsp;&nbsp;$ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$pretotal}}</b></td>
				<td><span style="font-size: 12px;"></td>
				<td colspan="4" style="border: 1px solid #333;"><span style="font-size: 12px;"></td>
				<td><span style="font-size: 12px;"></td>
				<td colspan="2" style="border: 1px solid #333;"><span style="font-size: 12px;"></td>
			</tr>
			<tr>
				<td colspan="5"><span style="font-size: 12px;"></td>
				<td colspan="4" style="border: 1px solid #333;"><span style="font-size: 12px;"> &nbsp;</td>
				<td><span style="font-size : 12px;"></td>
				<td colspan="2" style="border: 1px solid #333;"><span style="font-size: 12px;"></td>
			</tr>
			<tr>
				<td align="center" style="border: 1px solid #333; height: 30px;"><span style="font-size: 12px;">Descripcion</td>
				<td style="border: 1px solid #333;" colspan="7" align="center"><span style="font-size: 12px;">{{$desc}}</td>
				<td style="border: 3px solid #333;" colspan="3"><span style="font-size: 12px;">&nbsp;&nbsp;$&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$pretotal}}</td>
				<td><span style="font-size: 12px;"></td>
			</tr>
		</table>
	</div>
	<br>
	<div>
		<table style="width: 100%; border-collapse: collapse;">
			<tr>
				<td colspan="2"><span style="font-size: 12px;">F. <u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></td>
				<td rowspan="4" align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="img/log.jpg" width="120px" height="40px"></td>
			</tr>
			<tr>
				<td style="width: 100px"><span style="font-size: 12px;">NOMBRE:</td>
				<td style="border: 1px solid #333;width: 400px" align="center"><span style="font-size: 12px;">{{$cliente->nombre}} {{$cliente->apellido}}</td>
			</tr>
			<tr>
				<td><span style="font-size: 12px;">NEGOCIO:</span></td>
				<td style="border: 1px solid #333;" align="center"><span style="font-size: 12px;">{{$negocio->nombre}}</td>
			</tr>
			<tr>
				<td><span style="font-size: 12px;">DUI:</td>
				<td style="border: 1px solid #333;" align="center"><span style="font-size: 12px;">{{$cliente->dui}}</td>
			</tr>
		</table>
	</div>
	<div>
		<table style="width: 60%;" align="center">
			<tr>
				<td align="center" style="border: 1px solid #333; background: #ECECEC;"><span style="font-size: 12px">En caso de incumplimiento reconocere el 1%, diario mas de intereses sobre<br>lo convenido calculado sobre el saldo capital.	</span></td>
			</tr>
		</table>
	</div>
	<div align="center">F: <u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></div>
	<div align="center">Recibido</div><br>
	<div align="center"><span style="font-size: 13px">Para mayor información de su crédito y la emisión de estado de cuenta comuniquese al Tel.: 2300-8288 Cel.: Email: afimid@hotmail.com</span></div>
	<div><span style="font-size: 12px;">---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------</div>
	<div align="center"><b><span style="font-size: 14px">AFIMID, S.A. de C.V</span></b></div>
	<div align="center"><span style="font-size: 12px;">AFIMID ASESORES FINANCIEROS MICRO IMPULSADORES DE NEGOCIOS SOCIEDAD ANONIMA DE CAPITAL VARIABLE</span></div>
	<div align="center"><b><span style="font-size: 14px">COMPROBANTE DE PAGO "CLIENTE"/INGRESO  "ADMON"</b></div>
	<div>
		<table style="border-collapse: collapse; width: 100%">
			<tr>
				<td style="width: 80px"><span style="font-size: 12px;">Fecha</td>
				<td style="width: 1px"><span style="font-size: 12px;">{{$hoy}}</td>
				<td style="width: 70px"> </td>
				<td style="width: 100px"><span style="font-size: 12px;"> </td>
				<td style="width: 20px"><span style="font-size: 12px;"> </td>
				<td style="width: 40px"><span style="font-size: 12px;"> </td>
				<td style="width: 120px"><span style="font-size: 12px;"> </td>
				<td><span style="font-size: 12px;"></td>
				<td><span style="font-size: 12px;"></td>
				<td style="width: 1px"><span style="font-size: 12px;">N°</td>
				<td colspan="2" style="border: 1px solid #333;" align="center"><span style="font-size: 12px;">{{$numeri}}<span style="font-size: 12px;"></td>
			</tr>
			<tr>
				<td><span style="font-size: 12px;">CLIENTE:</td>
				<td colspan="3" style="border: 1px solid #333;" align="center"><span style="font-size: 12px;">{{$cliente->nombre}} {{$cliente->apellido}}</td>
				<td><span style="font-size: 12px;"></td>
				<td align="center"><span style="font-size: 12px;">DUI:</td>
				<td align="center" style="border: 1px solid #333;"><span style="font-size: 12px;">{{$cliente->dui}}</td>
				<td><span style="font-size: 12px;"></td>
				<td><span style="font-size: 12px;"></td>
				<td><span style="font-size: 12px;"></td>
				<td><span style="font-size: 12px;"></td>
				<td><span style="font-size: 12px;"></td>
			</tr>
			<tr>
				<td align="center" colspan="4" style="border: 1px solid #333;"><b><span style="font-size: 12px;">PAGOS</b></td>
				<td><span style="font-size: 12px;"></td>
				<td style="border: 1px solid #333;" colspan="4"><span style="font-size: 12px;">Tasa interes</td>
				<td><span style="font-size: 12px;"></td>
				<td style="border: 1px solid #333;" align="left"><span style="font-size: 12px;">&nbsp;&nbsp;{{($tipo->interes)*100}} %</td>
				<td><span style="font-size: 12px;"></td>
			</tr>
			<tr>
				<td colspan="2" style="border: 1px solid #333;"><span style="font-size: 12px;">Cobros x Admon</td>
				<td><span style="font-size: 12px;"></td>
				<td style="border: 1px solid #333;"><span style="font-size: 12px;">&nbsp;&nbsp;$
					@if($cobro==0)
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- </td>
					@else
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$cobro}} 
					@endif
				</td>
				<td><span style="font-size: 12px;"></td>
				<td colspan="4" style="border: 1px solid #333;"><span style="font-size: 12px;">Saldo Actual CAPITAL sin intereses</td>
				<td><span style="font-size: 12px;"></td>
				<td colspan="2" style="border: 1px solid #333;"><span style="font-size: 12px;">&nbsp;&nbsp;$&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$salmon}}</td>
			</tr>
			<tr>				
				<td colspan="2" style="border: 1px solid #333;"><span style="font-size: 12px;">Recargo por Mora</td>
				<td align=right><span style="font-size: 12px;">%</td>
				<td style="border: 1px solid #333;"><span style="font-size: 12px;">&nbsp;&nbsp;$
					@if($recargo==0)
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- </td>
					@else
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$recargo}} 
					@endif
				</td>
				<td><span style="font-size: 12px;"></td>
				<td colspan="4" style="border: 1px solid #333"><span style="font-size: 12px;">CUOTAS VENCIDAS</td>
				<td><span style="font-size: 12px;"></td>
				<td colspan="2" style="border: 1px solid #333;"><span style="font-size: 12px;">&nbsp;&nbsp;N°&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$cuotasatrasadas}}</td>
			</tr>
			<tr>
				<td style="border-left: 1px solid #333;" colspan="3"><span style="font-size: 12px;">ABONO A CUOTA N° 
					@if($abonoA=="")
					<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></td>
					@else
					<u>&nbsp;&nbsp;{{$abonoA}}&nbsp;&nbsp;</u>
					@endif
				<td style="border: 1px solid #333;"><span style="font-size: 12px;">&nbsp;&nbsp;$
					@if($abonoB==0)
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- </td>
					@else
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$abonoB}} 
					@endif
				</td>
				<td><span style="font-size: 12px;"></td>
				<td style="border: 1px solid #333;" colspan="4"><span style="font-size: 12px;">TOTAL EN $ DE CUOTAS VENCIDAS</td>
				<td><span style="font-size: 12px;"></td>
				<td style="border: 1px solid #333;" colspan="2"><span style="font-size: 12px;">&nbsp;&nbsp;$&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$cuotasatrasadas*$prestamo->cuotadiaria}}</td>
			</tr>
			<tr>
				<td style="border-left:  1px solid #333;" colspan="3"><span style="font-size: 12px;">COMPLEMENTO DE CUOTA N° 
					@if($compleA=="")
					<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></td>
					@else
					<u>{{$compleA}}</u>
					@endif
				</td>
				<td style="border: 1px solid #333;"><span style="font-size: 12px;">&nbsp;&nbsp;$
					@if($compleB==0)
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-</td>
					@else
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$compleB}} 
					@endif
				</td>
				<td><span style="font-size: 12px;"></td>
				<td style="border: 1px solid #333;" colspan="4"><span style="font-size: 12px;">TOTAL DEUDA</td>
				<td><span style="font-size: 12px;"></td>
				<td style="border: 3px solid #333;" colspan="2"><span style="font-size: 12px;">&nbsp;&nbsp;$&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{($cuotasatrasadas*$prestamo->cuotadiaria)+$salmon}}</td>
			</tr>
			<tr>
				<td style="border-left:  1px solid #333;" colspan="3"><span style="font-size: 12px;">CUOTA COMPLETA N° 
					@if($cuotaA=="")
					<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></td>
					@else
					<u>&nbsp;&nbsp;{{$cuotaA}}&nbsp;&nbsp;</u>
					@endif
				</td>
				<td style="border: 1px solid #333;"><span style="font-size: 12px;">&nbsp;&nbsp;$
					@if($cuotaB==0)
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- </td>
					@else
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$cuotaB}} 
					@endif
				</td>
				<td><span style="font-size: 12px;"></td>
				<td style="border: 1px solid #333;" colspan="4"><span style="font-size: 12px;"></td>
				<td><span style="font-size: 12px;"></td>
				<td style="border: 1px solid #333;" colspan="2"><span style="font-size: 12px;"></td>
			</tr>
			<tr>
				<td style="border: 1px solid #333;" colspan="2"><span style="font-size: 12px;">Gastos Notariales</td>
				<td><span style="font-size: 12px;"></td>
				<td style="border: 1px solid #333;"><u><span style="font-size: 12px;">&nbsp;&nbsp;$
					@if($gastos==0)
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- </td>
					@else
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$gastos}} 
					@endif
				</u></td>
				<td><span style="font-size: 12px;"></td>
				<td colspan="4" style="border: 1px solid #333;"><span style="font-size: 12px;"></td>
				<td><span style="font-size: 12px;"></td>
				<td colspan="2" style="border: 1px solid #333;"><span style="font-size: 12px;"></td>
			</tr>
			<tr>
				<td style="border: 1px solid #333;" colspan="2"><b><span style="font-size: 12px;">Total pagado</b></td>
				<td><span style="font-size: 12px;"></td>
				<td style="border: 3px solid #333;"><b><span style="font-size: 12px;">&nbsp;&nbsp;$ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$pretotal}}</b></td>
				<td><span style="font-size: 12px;"></td>
				<td colspan="4" style="border: 1px solid #333;"><span style="font-size: 12px;"></td>
				<td><span style="font-size: 12px;"></td>
				<td colspan="2" style="border: 1px solid #333;"><span style="font-size: 12px;"></td>
			</tr>
			<tr>
				<td colspan="5"><span style="font-size: 12px;"></td>
				<td colspan="4" style="border: 1px solid #333;"><span style="font-size: 12px;"> &nbsp;</td>
				<td><span style="font-size : 12px;"></td>
				<td colspan="2" style="border: 1px solid #333;"><span style="font-size: 12px;"></td>
			</tr>
			<tr>
				<td align="center" style="border: 1px solid #333; height: 30px;"><span style="font-size: 12px;">Descripcion</td>
				<td style="border: 1px solid #333;" colspan="7" align="center"><span style="font-size: 12px;">{{$desc}}</td>
				<td style="border: 3px solid #333;" colspan="3"><span style="font-size: 12px;">&nbsp;&nbsp;$&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$pretotal}}</td>
				<td><span style="font-size: 12px;"></td>
			</tr>
		</table>
	</div>
	<br>
	<div>
		<table style="width: 100%; border-collapse: collapse;">
			<tr>
				<td colspan="2"><span style="font-size: 12px;">F. <u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></td>
				<td rowspan="4" align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="img/log.jpg" width="120px" height="40px"></td>
			</tr>
			<tr>
				<td style="width: 100px"><span style="font-size: 12px;">NOMBRE:</td>
				<td style="border: 1px solid #333;width: 400px" align="center"><span style="font-size: 12px;">{{$cliente->nombre}} {{$cliente->apellido}}</td>
			</tr>
			<tr>
				<td><span style="font-size: 12px;">NEGOCIO:</span></td>
				<td style="border: 1px solid #333;" align="center"><span style="font-size: 12px;">{{$negocio->nombre}}</td>
			</tr>
			<tr>
				<td><span style="font-size: 12px;">DUI:</td>
				<td style="border: 1px solid #333;" align="center"><span style="font-size: 12px;">{{$cliente->dui}}</td>
			</tr>
		</table>
	</div>
	<div>
		<table style="width: 60%;" align="center">
			<tr>
				<td align="center" style="border: 1px solid #333; background: #ECECEC;"><span style="font-size: 12px">En caso de incumplimiento reconocere el 1%, diario mas de intereses sobre<br>lo convenido calculado sobre el saldo capital.	</span></td>
			</tr>
		</table>
	</div>
	<div align="center">F: <u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></div>
	<div align="center">Recibido</div><br>
	<div align="center"><span style="font-size: 13px">Para mayor información de su crédito y la emisión de estado de cuenta comuniquese al Tel.: 2300-8288 Cel.: Email: afimid@hotmail.com</span></div>
	</body>
</html>