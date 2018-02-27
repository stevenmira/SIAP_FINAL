@extends ('layouts.inicio')
@section('contenido')
<section class="content-header">
  <h1 style="color: #333333; font-family: 'Times New Roman', Times, serif;">
    CLIENTES ACTIVOS
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{URL::action('ClienteController@index')}}"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li class="active"><a href="{{URL::action('ClienteController@index')}}"> Clientes</a></li>
    <li class="active">Inactivos </li>
  </ol>
</section>

<section class="content">

  <!-- Notificación -->

  @if (Session::has('inactivo'))
  <div class="alert  fade in" style="background:  #f0f4c3;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4> El cliente  <b>{{ Session::get('inactivo')}}</b>  ha sido modificado al estado <b> ACTIVO </b>  nuevamente. </h4>
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
      @include('cliente.inactivo.search')
    </div>
  </div>

<div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive" style="padding: 4px 4px;">
                <table class="table table-striped table-bordered table-condensed table-hover">
                    <thead>
                        <tr class="success">
                          <th colspan="12">
                              
                              <h3 style="text-align: center; font-family:  Times New Roman, sans-serif; color: #1C2331;"><b>LISTADO DE CLIENTES</b> <b style="color: red;">INACTIVOS</b></h3>
                              
                          </th>
                      </tr>
                        <tr class="info">
                            <th>Cartera</th>
                            <th>Nombres</th>
                            <th>Apellidos</th>
                            <th>DUI</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                   @foreach ($clientes as $ma)
                      <tr>
                          <td>{{ $ma->nombreCartera }}</td>
                          <td>{{ $ma->nombre }}</td>
                          <td>{{ $ma->apellido }}</td>
                          <td>{{ $ma->dui }}</td>
                          <td style="width: 200px;">

                              <a class="btn btn-primary azul" data-title="Habilitar Cliente" href="" data-target="#modal-delete-{{$ma->idcliente}}" data-toggle="modal"><i class="fa fa-check" aria-hidden="true"></i></a>


                          </td>
                      </tr>
                      @include('cliente.inactivo.modal')
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