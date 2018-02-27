<div class="modal modal-danger fade modal-slide-in-right" aria-hidden="true"
role="dialog" tabindex="-1" id="modal-delete-{{$us->idusuario}}">
	{{Form::Open(array('action'=>array('UsuarioController@destroy',$us->idusuario),'method'=>'delete'))}}
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" 
				aria-label="Close">
                     <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Eliminar Usuario</h4>
			</div>
			<div class="modal-body">
				<p>Confirme si desea Eliminar el Empleado <b>{{ $us->nombre }}</b> con usuario <b>{{$us->name}}</b></p>
			</div>
			<div class="modal-footer">
			<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cerrar</button>
			<button type="submit" class="btn btn-outline">Confirmar</button></div>
		</div>
	</div>
	{{Form::Close()}}
</div>