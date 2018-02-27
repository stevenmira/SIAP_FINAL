<div class="modal modal-danger fade modal-slide-in-right" aria-hidden="true"
role="dialog" tabindex="-1" id="modal-delete-{{$cuenta->idcuenta}}">
	{{Form::Open(array('action'=>array('CuentaController@destroy',$cuenta->idcuenta),'method'=>'delete'))}}
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" 
				aria-label="Close">
                     <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Configuración de cuenta</h4>
			</div>
			<div class="modal-body">
				<h4 style=" font-family: 'Times New Roman', Times, serif;">Confirme si desea cambiar al estado 
				@if($cuenta->estado == "ACTIVO")
				<b>INACTIVO</b> 
				@else
				<b>ACTIVO</b> 
				@endif
				la cuenta del cliente: </h4>

				<h3 style="font-family:  Times New Roman, sans-serif; color: #e3f2fd;  text-align: center;"><b>{{ $cliente->nombre }} {{$cliente->apellido}}</b></h3>

				<h4 style=" font-family: 'Times New Roman', Times, serif;">Asociada al negocio:</h4>
				<h3 style="font-family:  Times New Roman, sans-serif; color: #e3f2fd;  text-align: center;">
					<b>{{ $negocio->nombre }}</b></h3>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cerrar</button>
				<button type="submit" class="btn btn-outline">Confirmar</button>
			</div>
		</div>
	</div>
	{{Form::Close()}}
</div>