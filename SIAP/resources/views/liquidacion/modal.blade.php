<div class="modal modal-warning fade modal-slide-in-right" aria-hidden="true"
role="dialog" tabindex="-1" id="modal-delete-{{$ma->iddetalleliquidacion}}">
	{{Form::Open(array('action'=>array('LiquidacionController@destroy',$ma->iddetalleliquidacion),'method'=>'delete'))}}
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" 
				aria-label="Close">
                     <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Anular Pago</h4>
			</div>
			<div class="modal-body">
				<h2>Confirme si desea anular el pago :</h2>
				<div class="row">
				<aside class="col-md-6 col-lg-6">
					<h4>DIA: </h4>
					<h4>FECHA:</h4>
					<h4>MONTO: </h4>
					<h4>INTERES: </h4>
					<h4>CUOTA CAPITAL:</h4>
					<h4>TOTAL DIARIO:</h4>
					@if( $ma->fechaefectiva != null)
						<h4>FECHA EFECTIVA DE PAGO: </h4>
					@else
						<h4>FECHA EFECTIVA DE PAGO: </h4>
					@endif
					<h4>ESTADO DE LA CUOTA: </h4>
				</aside>
				<aside class="col-md-6 col-lg-6">
					<h4> <b style="color: black;">{{ $ma->contador }} </b></h4>
					<h4> <b style="color: black;">{{ $ma->fechadiaria->format('l j  F Y ') }} </b></h4>
					<h4> <b style="color: black;">{{ $ma->monto }} </b></h4>
					<h4> <b style="color: black;">{{ $ma->interes }} </b></h4>
					<h4> <b style="color: black;">{{ $ma->cuotacapital }} </b></h4>
					<h4> <b style="color: black;">{{ $ma->totaldiario }} </b></h4>
					@if( $ma->fechaefectiva != null)
						<h4> <b style="color: black;">{{ $ma->fechaefectiva->format('l j  F Y ') }} </b></h4>
					@else
						<h4> <b style="color: black;">{{ $ma->fechaefectiva }} </b></h4>
					@endif
					<h4> <b style="color: black;">{{ $ma->estado }} </b></h4>
				</aside>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cerrar</button>
				<button type="submit" class="btn btn-outline">Confirmar</button>
			</div>
		</div>
	</div>
	{{Form::Close()}}
</div>