@extends ('layouts.inicio')
@section('contenido')
<section class="content-header">
  <h1 style="color: #333333; font-family: 'Times New Roman', Times, serif;">
     CLIENTES ACTIVOS
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{URL::action('ClienteController@index')}}"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li class="active"><a href="{{URL::action('ClienteController@index')}}"> Clientes</a></li>
    <li class="active">Activos</li>
  </ol>
</section>

<section class="content">

  <!-- Notificación -->
  @if (Session::has('create'))
  <div class="alert  fade in" style="background:  #ccff90;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4>Los datos del cliente <b>{{ Session::get('create')}}</b> han sido guardados correctamente.</h4>
  </div>
  @endif

  @if (Session::has('unicidad'))
  <div class="alert  fade in" style="background:  #ff8a80;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4> No se pudo actualizar, el cliente con el número de DUI  <b>{{ Session::get('unicidad')}}</b>  ya está en uso.</h4>
  </div>
  @endif

  @if (Session::has('update'))
  <div class="alert  fade in" style="background:  #bbdefb;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4> Los datos del cliente  <b>{{ Session::get('update')}}</b>  han sido actualizados correctamente.</h4>
  </div>
  @endif

  @if (Session::has('activo'))
  <div class="alert  fade in" style="background:  #f0f4c3;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4> El cliente  <b>{{ Session::get('activo')}}</b>  fué dado de baja exitosamente.</h4>
  </div>
  @endif

  @if (Session::has('error'))
  <div class="alert  fade in" style="background:  #ff8a80;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4>   <b>{{ Session::get('error')}}</b>  </h4>
  </div>
  @endif
  <!-- Fin Notificación -->

  <!-- Criterios de búsquedas -->
  
  <!-- /.row -->

  <div class="row">
    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
      <div class="alert  fade in" style="background:  rgba(255, 235, 59, 0.7);">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <font face="Comic Sans MS,arial,verdana">Puedes realizar tus búsquedas por el  <b>Número de DUI</b> ó bien por el <b style="color: black;"> Nombre</b> ó <b style="color: black;"> Apellido</b> <b style="color: black;">Completo </b> ó <b style="color: black;"> Parcial </b> del cliente</font>
      </div>
      @include('cliente.search')
    </div>
  </div>

<div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive" style="padding: 5px 5px;">
                <table class="table table-striped table-bordered table-condensed table-hover">
                    <thead>
                        <tr class="success">
                          <th colspan="12">
                              
                              <h3 style="text-align: center;font-family:  Times New Roman, sans-serif; color: #1C2331;"><b>LISTADO DE CLIENTES ACTIVOS</b><a class="btn btn-success pull-right verde" data-title="Agregar Nuevo Cliente" href="{{URL::action('ClienteController@create')}}"><i class="fa fa-fw -square -circle fa-plus-square"></i></a></h3>
                              
                          </th>
                      </tr>
                        <tr class="info">
                            <th>Cartera</th>
                            <th>Nombres</th>
                            <th>Apellidos</th>
                            <th>DUI</th>
                            <th style="width: 75px; text-align: center;">Negocios</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                   @foreach ($clientes as $ma)
                      <tr>
                          <td>{{ $ma->nombreCartera }}</td>
                          <td>{{ $ma->nombre }}</td>
                          <td>{{ $ma->apellido }}</td>
                          <td>{{ $ma->dui }}</td>
                          <td>
                            <a class=" verde" data-title="Ver lista de negocios" href="{{ url('negocios/list', ['id' => $ma->idcliente ]) }}"><button style="background: #b2ff59;" class=" btn btn-default center-block"><i class="fa fa-list"></i></button>
                            </a> 
                          </td>
                          <td style="width: 230px;">
                              <a class="btn btn-warning amarillo"  data-title="Ver Datos del Cliente" href="{{URL::action('ClienteController@show',$ma->idcliente)}}"><i class="fa fa-eye" aria-hidden="true"></i></a>

                              <a class="btn btn-info azul" data-title="Editar Datos del Cliente" href="{{URL::action('ClienteController@edit',$ma->idcliente)}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

                              <a class="btn btn-danger rojo" data-title="Inhabilitar Cliente" href="" data-target="#modal-delete-{{$ma->idcliente}}" data-toggle="modal"><i class="fa fa-trash" aria-hidden="true"></i></a>
                          </td>
                      </tr>
                      @include('cliente.modal')
                  @endforeach
                </table>
            </div>
            {{$clientes->render()}}
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

</section>



@endsection