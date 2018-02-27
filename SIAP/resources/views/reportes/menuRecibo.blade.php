@extends ('layouts.inicio')
@section('contenido')
<style>
  .errors{
    background-color: #fcc;
    border: 1px solid #966;
        }
     table{
            border-collapse: collapse;
        }
        table, td, th {
            border: 2px solid orange;
            padding:20px;
        }
  }
</style>

<section class="content-header">
  <h1 style="color: #333333; font-family: 'Times New Roman', Times, serif;">
    Generar Recibo de Cliente
  </h1>
</section>

{!!Form::open(array('url'=>'record/imprimir','method'=>'GET','autocomplete'=>'off'))!!}
            {{Form::token()}}


<input type="number" name="idcuenta" id="idcuenta" hidden="true" value="{{ $cuenta->idcuenta }}">
<input type="number" name="idrecibo" id="idrecibo" hidden="true" value="{{ $reciboAct->idrecibo }}">
<div class="col-md-12"> 
	<div class="panel panel-success">
		<div class="panel-body">
			<div><b>Cliente:</b> {{$cliente->nombre}} {{$cliente->apellido}}</div>
			<br>
			<div><b>Negocio:</b> {{$negocio->nombre}}</div>
            <div class="row">
            <div class="col-md-2">
            </div>
            </div>
			<br>
			<div class="row">
				<div class="form-group col-md-2">
        			<label for="monto">Cobros x Admon</label>
    			</div>
    			<div class="form-group col-md-4">
        			<div class="input-group">
            			<div class="input-group-addon">
                			<i class="fa fa-list-alt" aria-hidden="true"></i>
            			</div>
            			<input style="width: 150px;" type="number" step="any" class="form-control" name="cobro" id="cobro" placeholder="Ingresar monto..">
        			</div>
    			</div>
                <div class="form-group col-md-1 ">
                    <label>N° Recibo</label>
                </div>
                <div class="form-group col-md-1">
                    <div class="input-group">
                        {!! Form::text('recibo', $reciboAct->numerico, ['class' => 'form-control' , 'required' => 'required', 'autofocus'=>'on']) !!}
                    </div>
                </div>
			</div>
			<div class="row">
				<div class="form-group col-md-2">
        			<label for="monto">Recargo por Mora</label>
    			</div>
    			<div class="form-group col-md-4">
        			<div class="input-group">
            			<div class="input-group-addon">
                			<i class="fa fa-list-alt" aria-hidden="true"></i>
            			</div>
            			<input style="width: 150px;" type="number" step="any" class="form-control" name="recargo" id="recargo" placeholder="Ingresar monto..">
        			</div>
    			</div>
                <div class="form-group col-md-1 ">
                    <label>N° Cuotas Atrasadas</label>
                </div>
                <div class="form-group col-md-1">
                    <div class="input-group">
                        {!! Form::text('cuotasatrasadas', $cuotasatrasadas, ['class' => 'form-control' , 'required' => 'required', 'autofocus'=>'on']) !!}
                    </div>
                </div>
			</div>
			<div class="row">
				<div class="form-group col-md-2">
        			<label for="monto">ABONO A CUOTA N°</label>
    			</div>
    			<div class="form-group col-md-1">
    				<input style="width: 80px;" type="number" step="any" class="form-control" name="abonoA" id="abonoA" placeholder="N°">
    			</div> 
    			<div class="form-group col-md-4">
        			<div class="input-group">
            			<div class="input-group-addon">
                			<i class="fa fa-list-alt" aria-hidden="true"></i>
            			</div>
            			<input style="width: 150px;" type="number" step="any" class="form-control" name="abonoB" id="abonoB" placeholder="Ingresar monto..">
        			</div>
    			</div>
			</div>
			<div class="row">
				<div class="form-group col-md-2">
        			<label for="monto">COMPLEMENTO DE CUOTA N°</label>
    			</div>
    			<div class="form-group col-md-1">
    				<input style="width: 80px;" type="number" step="any" class="form-control" name="compleA" id="compleA" placeholder="N°">
    			</div> 
    			<div class="form-group col-md-4">
        			<div class="input-group">
            			<div class="input-group-addon">
                			<i class="fa fa-list-alt" aria-hidden="true"></i>
            			</div>
            			<input style="width: 150px;" type="number" step="any" class="form-control" name="compleB" id="compleB" placeholder="Ingresar monto..">
        			</div>
    			</div>
			</div>
			<div class="row">
				<div class="form-group col-md-2">
        			<label for="monto">CUOTA COMPLETA N°</label>
    			</div>
    			<div class="form-group col-md-1">
    				<input style="width: 80px;" type="number" step="any" class="form-control" name="cuotaA" id="cuotaA" placeholder="N°">
    			</div> 
    			<div class="form-group col-md-4">
        			<div class="input-group">
            			<div class="input-group-addon">
                			<i class="fa fa-list-alt" aria-hidden="true"></i>
            			</div>
            			<input style="width: 150px;" type="number" step="any" class="form-control" name="cuotaB" id="cuotaB" placeholder="Ingresar monto..">
        			</div>
    			</div>
			</div>
			<div class="row">
				<div class="form-group col-md-2">
        			<label for="monto">Gastos Notariales</label>
    			</div>
    			<div class="form-group col-md-4">
        			<div class="input-group">
            			<div class="input-group-addon">
                			<i class="fa fa-list-alt" aria-hidden="true"></i>
            			</div>
            			<input style="width: 150px;" type="number" step="any" class="form-control" name="gastos" id="gastos" placeholder="Ingresar monto..">
        			</div>
    			</div>
			</div>
            <div class="row">
                <div class="form-group col-md-2">
                    <label for="monto">Descripcion</label>
                </div>
                <div class="form-group col-md-4">
                    <div class="input-group">
                        <input style="width: 550px; height: 50px" type="text" step="any" class="form-control" name="desc" id="desc" placeholder="Ingresar Descripcion..">
                    </div>
                </div>
            </div>
            <br>
    		<div class="row">
        		<div class="form-group  col-md-offset-3"  >
            		<button type="submit" class="btn btn-danger" data-toggle="tooltip" data-placement="right"><i class="fa fa-print" aria-hidden="true"></i> Generar Recibo</a></button>
            		<a class=" btn btn-danger" type="reset"  href="{{URL::action('RecordClienteController@index')}}">Cancelar</a>
        		</div>
    		</div>
    	</div>
  	</div>
</div>

{!!Form::close()!!}
	
@endsection