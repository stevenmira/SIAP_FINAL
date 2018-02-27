<!DOCTYPE html>
<html>
<head>
	<title>Pagare</title>
	<style type="text/css">
		@page{
			margin-top: 25.0mm;
            margin-left: 20.0mm;
            margin-right: 20.0mm;
            margin-bottom: 25.0mm;

		}
		body{
			line-height: 27px;
		}
	</style>
</head>
<body>
	<div style="font-size: 25px" align="center"><b>PAGARE</b></div>
	<div style="font-size: 25px" align="center"><b>"SIN PROTESTO"</b></div>
	<br>
	<table>
		<div align="justify" style="page-break-after: always;">
			Yo, <span><b>{{strtoupper( $nombre -> nombre)}} {{strtoupper( $nombre -> apellido )}},</b></span> mayor edad, portador de Documento Único de Indentidad número <b>{{$du1}} - {{$du2}} </b>


			por este PAGARE, me obligo a pagar incondicionalemente en la ciudad de Tepecoyo, a la orden de <b>ASESORES FINANCIEROS MICRO IMPULSADORES DE NEGOCIOS SOCIEDAD ANÓNIMA DE CAPITAL VARIABLE,</b> y que puede abreviarse <b>AFIMID, S.A. DE C.V.</b> con número de identificación tributaria cero seiscientos catorce - trescientos un mil diecisiete - ciento tres - cero; <b>GREGORIO ROSALES PORTILLO,</b> de {{$edad}} años de edad, contador, del domicilio de Tepecoyo, con Documento Único de Identidad, cero, dos millones dieciocho mil setecientos setenta y seis - siente y Número de Identificación Tributaria cero, quinientos veintiuno - cero, treinta mil novecientos sesenta y nueve - ciento uno - nueve, actuando en nombre y representación en calidad de Administrador único propietario de la Sociedad, la suma de: <span><b>{{$monto}} {{$dos}}/100 DOLARES DE LOS ESTADOS UNIDOS DE AMERICA (${{$prestamo->monto}}),</b></span> mas interés del <span>{{($tipo->interes)*100}}</span> % diario sobre saldo deudor, para el plazo de <span><b>

			<?php  
				if ($total>$prestamo->cuotadiaria) {
					$n++;
					$total=$total-$prestamo->cuotadiaria;
				}
			?>
			@if($total!=0)
				{{$n+1}}
			@else
				{{$n}}
			@endif

			</b></span> días, contando a partir de esta fecha, pagadas por medio de <span><b>{{$n}}</b></span> cuotas de <span><b>${{$prestamo->cuotadiaria}}</b></span> dólares de Estados Unidos de América


			@if($total!=0)
			y una cuota de <span><b>${{round($total,2)}}</b></span> dólares de los Estados Unidos de América
			@endif
			, en la cuota diaria se paga interés y capital, plazo final el día <span><b>{{$diaaux}} de {{$nuevomes}} de {{$anioaux}}.</b></span> En caso de mora, reconoceré un punto más de interés diario sobre el convenido (1%). El tipo de interés quedara fijo.
			<br><br>
			Para todos los efectos de esta obligación mercantil, fijo como domicilio especial la ciudad de Santa Tecla, y en caso de acción judicial, renuncio al Derecho de apelar del Decreto de embargo, de la sentencia de remate y de otra providencia apelable, que se dictare en el jucio mercantil ejecutivo o en sus incidencias, siendo a mi cargo cualquier gasto que la empresa <b>ASESORES FINANCIEROS MICRO IMPULSADORES DE NEGOCIOS SOCIEDAD ANÓNIMA DE CAPITAL VARIABLE,</b> y que puede abreviarse <b>AFIMID, S.A. DE C.V.</b> de generales antes relacionadas hicieren en el cobro de este PAGARE, inclusive los llamados personales y aún cuando por regla general no hubiere condenación en costas y faculto a <b>ASESORES FINANCIEROS MICRO IMPULSADORES DE NEGOCIOS SOCIEDAD ANÓNIMA DE CAPITAL VARIABLE,</b> y que puede abreviarse <b>AFIMID, S.A. DE C.V.</b> Para que designe la persona depositaria de los bienes que se embarguen, a quienes relevo de la obligación de rendir fianza y cuentas.
		</div>
	</table>

	<div align="center">En Tepecoyo, a los {{$diahoy}} días del mes de {{$meshoy}} del año {{$aniohoy}}.</div><br>
	<div>CONDICIONES DEL CREDITO:</div>
	<div>1) Sera para inversión de negocio; Compra de Mobiliario y Equipo de trabajo, mercaderia.</div>
	<div>2) Por falta de pago de dos cuota autorizo se me asigne un ejecutivo de cobro para que cobre la venta diaria de mi negocio</div>
	<div>3) Por falta de pago de tres cuotas vencidas acepto el embargo de: Mobiliario, Equipo de Trabajo, Mercadería, Equipo Informático, Electrodomésticos del Hogar.</div>
	<div>4) Que el valuó de lo embargado lo realicen mis acreedor o a quienes ellos designen para este caso.</div>
	<div>5) Eximo de toda responsabilidad a mi acreedor por los bienes que me sean embargados quien podrá venderlos para recuperar el crédito que se me otorgo.</div>
	<br>
	<br>
	<br>
	<div>F:<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></div>
	<div>Deudor: <b>{{strtoupper( $nombre -> nombre)}} {{strtoupper( $nombre -> apellido )}}</b></div>
	<div>Documento único de identidad Número: <b>{{$nombre->dui}}</b></div>
	<div>Lugar y fecha de expedición: <b>{{$nombre->lugarexpedicion}}</b>, <b>{{$fechaex}}</b></div>
	<div>Número de Identificación Tributaria: <b>{{$nombre->nit}}</b></div>

</body>
</html>