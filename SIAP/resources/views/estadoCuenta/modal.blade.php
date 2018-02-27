<div class="modal modal-danger fade modal-slide-in-right" aria-hidden="true"
role="dialog" tabindex="-1" id="modal-delete-{{$es->idcomprobante}}">
	{{Form::Open(array('action'=>array('ComprobanteController@destroy',$es->idcomprobante),'method'=>'delete'))}}
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" 
				aria-label="Close">
                     <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Eliminar Estado de Cuenta</h4>
			</div>
			<div class="modal-body">
            <p><b>ATENCIÓN: AL DAR CLIC EN CONFIRMAR, NO PODRA ACCEDER A LA INFORMACIÓN DE ESTE ESTADO DE CUENTA NUEVAMENTE.</b></p>
				<p>¿AÚN ASI DESEA ELIMINARLO?</p>
               </div>
			<div class="modal-footer">
			<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cerrar</button>
			<button type="submit" class="btn btn-outline">Confirmar</button></div>
		</div>
	</div>
	{{Form::Close()}}
</div>