<div class="modal modal-primary fade modal-slide-in-right" aria-hidden="true"
role="dialog" tabindex="-1" id="modal-cancelar-{{$estadoc->idcomprobante}}">
	{{Form::Open(array('action'=>array('ComprobanteController@cancelar',$estadoc->idcomprobante)))}}
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" 
				aria-label="Close">
                     <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Cancelar Estado de Cuenta</h4>
			</div>
			<div class="modal-body">
            <p><b>Dar Clic en Confirmar para Pagar la deuda del Estado de Cuenta</b></p>
				
               </div>
			<div class="modal-footer">
			<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cerrar</button>
			<button type="submit" class="btn btn-outline">Confirmar</button></div>
		</div>
	</div>
	{{Form::Close()}}