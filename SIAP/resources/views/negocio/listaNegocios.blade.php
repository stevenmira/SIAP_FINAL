@extends('layouts.inicio')
@section('contenido')

<section class="content-header">
  <h1 style="color: #333333; font-family: 'Times New Roman', Times, serif;">
    LISTA DE NEGOCIOS
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ url('home')}}"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li><a href="{{URL::action('ClienteController@index')}}"> Clientes</a></li>
    <li class="active">Negocio</li>
  </ol>
</section>

@if (Session::has('create'))
  <br>
	<div class="alert  fade in" style="background:  #ccff90;">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	<h4>Los datos del negocio <b>{{ Session::get('create')}}</b> han sido guardados correctamente.</h4>
	</div>
@endif


@if (Session::has('update'))
  <br>
	<div class="alert  fade in" style="background:  #bbdefb;">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	<h4> Los datos del negocio  <b>{{ Session::get('update')}}</b>  han sido actualizados correctamente.</h4>
	</div>
@endif

@if (Session::has('activo'))
  <br>
  <div class="alert  fade in" style="background:  #f0f4c3;">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
  <h4> El negocio  <b>{{ Session::get('activo')}}</b>  fué dado de baja exitosamente.</h4>
  </div>
@endif

@if (Session::has('inactivo'))
<div class="alert  fade in" style="background:  #f0f4c3;">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
  <h4> El Negocio  <b>{{ Session::get('inactivo')}}</b>  ha sido modificado al estado <b> ACTIVO </b>  nuevamente. </h4>
</div>
@endif

@if (Session::has('error'))
  <br>
  <div class="alert  fade in" style="background:  #ff9e80;">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
  <h4>   <b>{{ Session::get('error')}}</b>  </h4>
  </div>
@endif

<section class="content-header">
<div class="row">
	<h2 style=" font-family:  Times New Roman, sans-serif; color:#3F729B; padding: 0px 10px;">
    <b><i>{{ $cliente->nombre}} {{$cliente->apellido}}</i></b></h2>
</div>
</section>

<div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive" style="padding: 5px 5px;">
                <table class="table table-striped table-bordered table-condensed table-hover">
                    <thead>
                        <tr class="success">
                          <th colspan="12">
                              <h3 style="text-align: center; font-family:  Times New Roman, sans-serif; color: #1C2331;"><b>LISTADO DE NEGOCIOS</b><a class="btn btn-success pull-right verde" data-title="Agregar Nuevo Negocio" href="{{ url('negocios/nuevo', ['id' => $cliente->idcliente ]) }}"><i class="fa fa-fw -square -circle fa-plus-square"></i></a></h3>
                          </th>
                      </tr>
                        <tr class="info">
                        	<th style="width: 30px;">No.</th>
                            <th style="width: 310px;">Nombre</th>
                            <th style="width: 310px;">Actividad Economica</th>
                            <th>Dirección</th>
                            <th style="width: 180px;">Acciones</th>
                        </tr>
                    </thead>
                   <?php $cont = 1; ?> 
                   @foreach ($negocios as $ma)
                      <tr>
                      	  <td>{{ $cont }}</td>
                          <td>{{ $ma->nombre }}</td>
                          <td>{{ $ma->actividadeconomica }}</td>
                          <td>{{ $ma->direccionnegocio }}</td>
                          <td style="width: 150px;">
                              <a class="btn btn-info azul" data-title="Editar Datos del Negocio" href="{{URL::action('NegocioController@edit',$ma->idnegocio)}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

                              @if($ma->estado == 'ACTIVO')
                              <a class="btn btn-danger rojo" data-title="Inabilitar Negocio" href="" data-target="#modal-delete-{{$ma->idnegocio}}" data-toggle="modal"><i class="fa fa-trash" aria-hidden="true"></i></a>
                              @else
                              <a class="btn btn-primary azul" data-title="Habilitar Negocio" href="" data-target="#modal-delete-{{$ma->idnegocio}}" data-toggle="modal"><i class="fa fa-check" aria-hidden="true"></i></a>
                              @endif
                          </td>
                      </tr>
                      @include('negocio.modal')
                  <?php $cont = $cont + 1; ?>
                  @endforeach
                </table>
            </div>
            {{$negocios->render()}}
        </div>
</div>

<div class="row">
  <a href="{{URL::action('ClienteController@index')}}" class="btn btn-danger btn-lg col-md-offset-2"><i class="fa fa-chevron-left" aria-hidden="true"></i> Atrás</a>
</div>

<div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <h3 style="text-align:center; font-family:  Times New Roman, sans-serif; color: #1C2331; float: right;"><b>{{$fecha_actual}}</b></h3>
  </div>
</div>


@endsection