<!DOCTYPE html>
<html>
<head>
	<title>Pagare</title>
	<style type="text/css">
		@page{
			margin-top: 20.0mm;
            margin-left: 20.0mm;
            margin-right: 20.0mm;
            margin-bottom: 20.0mm;

		}
		body{
			line-height: 27px;
		}
		span{
			font-size: 13px;
		}
	</style>
</head>
<body>
<span><div style="font-size: 25px" align="center"><b>PAGARE</b></div>
	<div style="font-size: 25px" align="center"><b>"SIN PROTESTO"</b></div>
	<br>
	<table>
		<div align="justify" style="page-break-after: always;">
			Yo, <span><b>{{strtoupper( $nombre -> nombre)}} {{strtoupper( $nombre -> apellido )}},</b></span> mayor edad, @if($nombre->profesion!=''&&$nombre->profesion!=' ') {{$nombre->profesion}}, @endif portador de Documento Único de Indentidad número
			
			@if(substr($dui, -10, 1)==0)
				cero
				@if(substr($dui, -9, 1)==0)
					cero
					@if(substr($dui, -8, 1)==0)
						cero
						@if(substr($dui, -7, 1)==0)
							cero
							@if(substr($dui, -6, 1)==0)
								cero
								@if(substr($dui, -5, 1)==0)
									cero
									@if(substr($dui, -4, 1)==0)
										cero
										@if(substr($dui, -3, 1)==0)
											cero
										@endif
									@endif
								@endif
							@endif
						@endif
					@endif
				@endif
			@endif
			
			@if(strcmp("UN ",$du1)==0)
				uno
			@else
					{{strtolower($du1)}}
			@endif
			-
			@if(strcmp("UN ",$du2)==0)
				uno
			@else
				@if($newdui[1]=="0")
					cero
				@else
					{{strtolower($du2)}}
				@endif
			@endif

			, y Número de Identificación Tributaria 
			@if(substr($nit, -17, 1)==0)
				cero
				@if(substr($nit, -16, 1)==0)
					cero
					@if(substr($nit, -15, 1)==0)
						cero
						@if(substr($nit, -14, 1)==0)
							cero
						@endif
					@endif
				@endif
			@endif

			@if(strcmp("UN ",$ni1)==0)
				uno
			@else
				{{strtolower($ni1)}}
			@endif
			-
			@if(substr($nit, -12, 1)==0)
				cero
				@if(substr($nit, -11, 1)==0)
					cero
					@if(substr($nit, -10, 1)==0)
						cero
						@if(substr($nit, -9, 1)==0)
							cero
							@if(substr($nit, -8, 1)==0)
								cero
								@if(substr($nit, -7, 1)==0)
									cero
								@endif
							@endif
						@endif
					@endif
				@endif
			@endif

			@if(strcmp("UN ",$ni2)==0)
				uno
			@else
				{{strtolower($ni2)}}
			@endif
			-
			@if(substr($nit, -5, 1)==0)
				cero
				@if(substr($nit, -4, 1)==0)
					cero
					@if(substr($nit, -3, 1)==0)
						cero
					@endif
				@endif
			@endif
			@if(strcmp("UN ",$ni3)==0)
				uno
			@else
				{{strtolower($ni3)}}
			@endif
			-
			@if(strcmp("UN ",$ni4)==0)
				uno
			@else
				@if($newnit[3]=="0")
					cero
				@else
					{{strtolower($ni3)}}
				@endif
			@endif
			,  por este PAGARE, me obligo a pagar incondicionalmente en la ciudad de Tepecoyo, departamento de La Libertad al señor <b>GREGORIO ROSALES PORTILLO,</b> de {{$edad}} de edad, contador, del domicilio de Tepecoyo, departamento de La Libertad, portador de Documento Único de Identidad número cero dos millones dieciocho mil setecientos setenta y seis - siete y Número de Identificación Tributaria cero  quinientos veintiuno – cero  treinta mil novecientos sesenta y nueve - ciento uno - nueve, actuando en nombre y representación  Sociedad <b>ASESORES FINANCIEROS MICRO IMPULSADORES DE NEGOCIOS SOCIEDAD ANÓNIMA DE CAPITAL VARIABLE,</b> y que puede abreviarse <b>AFIMID, S.A. DE C.V.</b>  con número de identificación tributaria cero seiscientos catorce - trescientos un mil diecisiete - ciento tres - cero; en calidad de Administrador Único Propietario de la Sociedad, por la suma de: <span><b>{{strtolower($monto)}} 
			@if($soncen!=0)
				CENTAVOS DE DOLAR
			@else
				DOLARES
			@endif
			DE LOS ESTADOS UNIDOS DE AMERICA,</b></span> mas interés del
			@if(strcmp("UN ",$porcenta1)==0)
				<b>UNO</b>
			@else
				@if($porcenta1=="")
					<b>CERO</b>
				@else
					<b>{{$porcenta1}}</b>
				@endif
			@endif

			@if($por==0)
			@else
				<b>PUNTO {{$porcenta2}}</b>
			@endif
			<b>POR CIENTO</b> diario sobre saldo deudor, para el plazo de <b>{{$n1}}</b>días, contando a partir de esta fecha, pagadas por medio de <b>{{$n2}}</b> cuotas de <b>{{$exculet}}</b>
			@if($longi==2)
				<b>CENTAVOS DE</b>
			@endif
			@if($exculet=='UN ')
				<b>DÓLAR DE LOS ESTADOS UNIDOS DE AMÉRICA</b> 
			@else
				<b>DÓLAR DE LOS ESTADOS UNIDOS DE AMÉRICA</b>
			@endif

			@if($total!=0)
			<b>Y UNA CUOTA DE 

			@if($extota1=='UN ')
				UNO CON {{$extota2}}
			@else
				@if($extota1=="")
					{{$extota2}}
				@else 
				 {{$extoe}}
				@endif

			@endif

			@if($logto==2)
				CENTAVOS DE
			@endif

			@if($extoe=='UN ')
				DOLAR DE LOS ESTADOS UNIDOS DE AMÉRICA,
			@else
				DOLAR DE LOS ESTADOS UNIDOS DE AMÉRICA,
			@endif
			</b></span>
			@endif
			en la cuota diaria se paga interés y capital, plazo final el día <b>{{$diaaus}} DE {{strtoupper($nuevomes)}} DE {{$anius}}.</b> En caso de mora, reconoceré un  punto más de interés diario sobre el convenido <b>(1%).</b> El tipo de interés quedara fijo. 
			
			<br><br>
			Para todos los efectos de esta obligación mercantil, fijo como domicilio especial la ciudad de Santa Tecla, departamento de La Libertad, y en caso de acción judicial, renuncio al Derecho de apelar del Decreto de embargo, de la sentencia de remate y de otra providencia apelable, que se dictare en el juicio mercantil ejecutivo o en sus incidencias, siendo a mi cargo cualquier gasto que la empresa <b>ASESORES FINANCIEROS MICRO IMPULSADORES DE NEGOCIOS SOCIEDAD ANÓNIMA DE CAPITAL VARIABLE,</b> y que puede abreviarse <b>AFIMID, S.A. DE C.V.</b> de generales antes relacionadas hicieren en el cobro de este PAGARE, inclusive los llamados personales y aún cuando por regla general no hubiere condenación en costas y faculto a <b>ASESORES FINANCIEROS MICRO IMPULSADORES DE NEGOCIOS SOCIEDAD ANÓNIMA DE CAPITAL VARIABLE,</b> y que puede abreviarse <b>AFIMID, S.A. DE C.V.</b> Para que designe la persona depositaria de los bienes que se embarguen, a quienes relevo de la obligación de rendir fianza y cuentas. 
		</div>
	</table>

	<div align="center">En la ciudad de Tepecoyo a los {{$diahoy}} @if($diahoy=='UN ') dia @else días @endif del mes de {{strtoupper($meshoy)}} de {{$aniohoy}}.</div><br>
	<div>CONDICIONES DEL CREDITO:</div>
	<div>1) Sera para inversión de negocio; Compra de Mobiliario y Equipo de trabajo, mercadería. </div>
	<div>2) Por falta de pago de dos cuota autorizo se me asigne un ejecutivo de cobro para que cobre la venta diaria de mi negocio.</div>
	<div>3) Por falta de pago de tres cuotas vencidas acepto el embargo de: Mobiliario, Equipo de Trabajo, Mercadería, Equipo Informático, Electrodomésticos del Hogar.</div>
	<div>4) Que el valuó de lo embargado lo  realicen  mis  acreedor o a quien ellos designen para este caso.</div>
	<div>5) Eximo de toda responsabilidad a mi acreedor por los bienes que me sean embargados quien podrá venderlos para recuperar el crédito que se me otorgo.</div>
	<br>
	<br>
	<br>
	<div>F:<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></div>
	<div>Deudor: {{strtoupper( $nombre -> nombre)}} {{strtoupper( $nombre -> apellido )}}</div>
	<div>Documento único de identidad Número: {{$nombre->dui}}</div>
	<div>Lugar y fecha de expedición: {{strtoupper($nombre->lugarexpedicion)}}, {{$fechaex}}</div>
	<div>Número de Identificación Tributaria: {{$nombre->nit}}</div></span>

</body>
</html>