<div class="modal fade modal-slide-in-right" aria-hidden="true"
role="dialog" tabindex="-1" id="modal-detalle-{{$es->idcomprobante}}">


Form::Open(array('url'=>'estadodecuenta','method'=>'patch','autocomplete'=>'off'))!!}

<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" 
			aria-label="Close">
				 <span aria-hidden="true">×</span>
			</button>
			<h2 class="modal-title">Estado de Cuenta {{$es->estado}}</h2 >
			<h4><label>Cliente:</label> {{$cliente->nombre}} {{$cliente->apellido}}</h4>
		
		
		</div>
	 <div class="modal-body">
	 

		<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			
		</div>
		
	</div>
</div>
{{Form::Close()}}
