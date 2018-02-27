{!! Form::open(array('url'=>'cliente','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}
<div class="row">
	<div class="col-md-8 col-sm-8 col-xs-6 col-md-offset-0">
		<div class="form-group">
			<label for="matricula">Selecciona el cliente</label>
			<select name="searchText"  class="form-control selectpicker" id="searchText" data-Live-search="true" title="-- Introduzca el criterio de búsqueda --">
				@foreach($consulta as $cliente)
				<option value="{{ $cliente->dui }}">{{$cliente->nombre}} {{$cliente->apellido}} DUI:  {{$cliente->dui}}</option>
				@endforeach
			</select>
		</div>
	</div>

	<div class="col-md-2 col-sm-6 col-xs-6">
		<label>Acción</label>
		<div class="input-group">
			<span class="input-group-btn"><button type="submit" class="btn btn-primary">Buscar</button></span>
		</div>
	</div>	
	
</div>
{{Form::close()}}