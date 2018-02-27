@extends ('layouts.inicio')
@section ('contenido')
<div id="rightcolumn">

<div class="row">
     <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
      <h3>Agregar Nueva Cartera</h3>
      @if (count($errors)>0)
      <div class="alert alert-danger">
        <ul>
        @foreach ($errors->all() as $error)
           <li>{{$error}}</li>
         @endforeach
        </ul>
        
      </div>
      @endif
{!!Form::open(array('url'=>'carteras','method'=>'POST','autocomplete'=>'off'))!!}
{{Form::token()}}
<div class="row"> 
            
            <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-4">

            <label class="form-control-label" for="nombre">Nombre</label>
            <input type="text" class="form-control" name="nombre"  class="form-control" placeholder="Ingrese el nombre de la cartera" >
            </div>
            <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-4">
            
            <label class="form-control-label" for="ejecutivo">Nombre Ejecutivo:</label>
            <input type="text" class="form-control" name="ejecutivo"  class="form-control" placeholder="Ingrese el nombre de la cartera" >
            </div>
            <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-4">

            <label class="form-control-label" for="supervisor">Nombre Supervisor</label>
            <input type="text" class="form-control" name="supervisor"  class="form-control" placeholder="Ingrese el nombre de la cartera" >
            </div>
        </div>
          <div class="form-group">
            <a  class="btn btn-danger" href="{{URL::action('CarteraController@index')}}">Cancelar</a>
            <button class="btn btn-primary" type="submit">Guardar</button>
          </div>
        </div>
    

@endsection