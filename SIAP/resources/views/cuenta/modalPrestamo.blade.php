<div class="modal modal-danger fade modal-slide-in-right" aria-hidden="true"
role="dialog" tabindex="-1" id="modal-deleteP-{{$cuenta->idcuenta}}">
	{{Form::Open(array('action'=>array('PrestamoController@destroy',$cuenta->idcuenta),'method'=>'delete'))}}
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" 
				aria-label="Close">
                     <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Configuración de Prestamo</h4>
			</div>
			<div class="modal-body">
				<h5 style=" font-family: 'Times New Roman', Times, serif;">
                </h5>
                <h4 style="font-family: bold;">Confirme si desea cambiar el estado del Prestamo del cliente</h4>
                <h3 style="font-family:  Times New Roman, sans-serif; color: #e3f2fd;  text-align: center;"><b>{{ $cliente->nombre }} {{$cliente->apellido}}</b></h3>

                <h4 style="font-family: bold;">Asociada al negocio:</h4>
                <h3 style="font-family:  Times New Roman, sans-serif; color: #e3f2fd;  text-align: center;"><b>{{ $negocio->nombre }}</b></h3>

                <h4 style="font-family: bold;">El Estado del Prestamo Actual es: </h4>
                @if($prestamo->estadodos == "ACTIVO")
                <h2 style="font-family:  Times New Roman, sans-serif; color: #e3f2fd;  text-align: center;"><b>ACTIVO</b></h2>
                @endif
                @if($prestamo->estadodos == "VENCIDO")
				<h2 style="font-family:  Times New Roman, sans-serif; color: #e3f2fd;  text-align: center;"><b>VENCIDO</b></h2>
                @endif
                @if($prestamo->estadodos=="CERRADO")
				<h2 style="font-family:  Times New Roman, sans-serif; color: #e3f2fd;  text-align: center;"><b>CERRADO</b></h2>
                @endif
                

                <h4 style=" font-family: 'Times New Roman', Times, serif;">Seleccione el nuevo estado</h4>

                @if($prestamo->estadodos == "ACTIVO")
                {{Form::radio('state','CERRADO',true)}}<i> CERRADO</i><br>
                {{Form::radio('state','VENCIDO')}}<i> VENCIDO</i><br>
                @endif

                @if($prestamo->estadodos == "VENCIDO")
				{{Form::radio('state','ACTIVO',true)}}<i> ACTIVO</i><br>
                {{Form::radio('state','CERRADO')}}<i> CERRADO</i><br>
                @endif

                @if($prestamo->estadodos=="CERRADO")
				{{Form::radio('state','ACTIVO',true)}}<i> ACTIVO</i><br>
                
                {{Form::radio('state','VENCIDO')}}<i> VENCIDO</i><br>
                @endif

                        
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cerrar</button>
				<button type="submit" class="btn btn-outline">Confirmar</button>
			</div>
		</div>
	</div>
	{{Form::Close()}}
</div>