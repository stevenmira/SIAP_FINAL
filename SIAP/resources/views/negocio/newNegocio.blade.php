@extends('layouts.inicio')
@section('contenido')
<style>
  .errors{
    background-color: #fcc;
    border: 1px solid #966;
  }
</style>

<section class="content-header">
  <h1 style="color: #333333; font-family: 'Times New Roman', Times, serif;">
    NUEVO NEGOCIO
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ url('home')}}"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li><a href="{{URL::action('ClienteController@index')}}"> Clientes</a></li>
    <li><a href="{{ url('negocios/list', ['id' => $cliente->idcliente ]) }}"> Negocios</a></li>
    <li class="active">Nuevo</li>
  </ol>
</section>

<section class="content-header">
<div class="row">
  <h2 style=" font-family:  Times New Roman, sans-serif; color:#3F729B; padding: 0px 15px;">
    <b><i>{{ $cliente->nombre}} {{$cliente->apellido}}</i></b></h2>
</div>
</section>

{!!Form::open(array('url'=>'negocio','method'=>'POST','autocomplete'=>'off'))!!}
            {{Form::token()}}

  <div class="col-md-12"> 
    <div class="panel panel-success">
      <div class="panel-body">
          <h4 style="color: #333333; font-family: 'Times New Roman', Times, serif;"><b> Datos del Negocio</b></h4>
          <hr>

          <div class="row">
            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
              @if(count($errors) > 0)
              <div class="errors">
                <ul>
                  <p><b>Por favor, corrige lo siguiente:</b></p>
                  <?php $cont = 1; ?>
                @foreach($errors->all() as $error)
                  <li>{{$cont}}. {{ $error }}</li>
                  <?php $cont=$cont+1; ?>
                @endforeach
                </ul>
              </div>
            @endif
            </div>
          </div>
          

          <div class="row"> 

            <div class="form-group col-md-4">
              <label for="nombreNegocio">Nombre del Negocio</label>
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-pencil" aria-hidden="true"></i>
                </div>
                {!! Form::textarea('nombreNegocio', null, ['class' => 'form-control' , 'required' => 'required', 'placeholder'=>'Digite el nombre del negocio . . .', 'autofocus'=>'on', 'rows'=>'3']) !!}
              </div>
            </div>

            <div class="form-group col-md-4">
              <label for="actividadEconomica">Actividad Economica</label>
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-pencil" aria-hidden="true"></i>
                </div>
                {!! Form::textarea('actividadEconomica', null, ['class' => 'form-control' , 'required' => 'required', 'placeholder'=>'Digite la actividad economica del negocio . . . ', 'autofocus'=>'on', 'rows'=>'3']) !!}
              </div>
            </div>

            <div class="form-group col-md-4">
              <label for="direccionNegocio">Dirección del Negocio</label>
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-pencil" aria-hidden="true"></i>
                </div>
                {!! Form::textarea('direccionNegocio', null, ['class' => 'form-control' , 'required' => 'required', 'placeholder'=>'Digite la dirección del negocio . . .', 'autofocus'=>'on', 'rows'=>'3']) !!}
              </div>
            </div>

          </div>

          <div class="row">
            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12" id="guardar">
              <div class="form-group">
              <input name="_token" value="{{csrf_token()}}" type="hidden"></input>
                  <a href="{{ url('negocios/list', ['id' => $cliente->idcliente ]) }}" class="btn btn-danger btn-lg col-md-offset-2"><i class="fa fa-times" aria-hidden="true"></i> Cancelar</a>
                  <button class="btn btn-primary btn-lg col-md-offset-6" type="submit"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</button>
                </div>
            </div>
          </div>
      </div>
    </div>
  </div>

  <input type="hidden" name="idcliente" value="{{ $cliente->idcliente }}">

{!!Form::close()!!}

<div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <h3 style="text-align:center; font-family:  Times New Roman, sans-serif; color: #1C2331; float: right;"><b>{{$fecha_actual}}</b></h3>
  </div>
</div>



@endsection