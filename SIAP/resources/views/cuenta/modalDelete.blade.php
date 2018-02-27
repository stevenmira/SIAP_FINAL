<div class="modal modal-danger fade modal-slide-in-right" aria-hidden="true"
role="dialog" tabindex="-1" id="modal-deleteD-{{$cuenta->idcuenta}}">
	{{Form::Open(array('action'=>array('TipoCreditoController@destroy',$cuenta->idcuenta),'method'=>'delete'))}}
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" 
				aria-label="Close">
                     <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Eliminar Crédito</h4>
			</div>
			<div class="modal-body">
                <strong>ADVERTENCIA</strong> Esta acción eliminará por completo todo registro del crédito.
                <p>Tenga en cuenta que no podrá recuperarse.</p>
                <p><strong>¿Desea Continuar?</strong></p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cerrar</button>
				<button type="submit" class="btn btn-outline">Confirmar</button>
			</div>
		</div>
	</div>
	{{Form::Close()}}
</div>