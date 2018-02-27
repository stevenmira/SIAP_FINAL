@extends ('layouts.inicio')
@section('contenido')
<section class="content-header">
  <h1 style="color: #333333; font-family: 'Times New Roman', Times, serif;">
    Gestión Usuarios
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ url('home')}}"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li class="active">Usuarios</li>
  </ol>
</section>

<section class="content">

  <!-- Notificación -->
  @if (Session::has('create'))
  <div class="alert  fade in" style="background:  #ccff90;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4>El Usuario ha sido guardado correctamente.</h4>
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
    <h4><b>{{ Session::get('update')}}</b>.</h4>
  </div>
  @endif
  @if (Session::has('delete'))
  <div class="alert  fade in" style="background:  #ccff90;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4>El Usuario se elimino correctamente</h4>
  </div>
  @endif

  @if (Session::has('activo'))
  <div class="alert  fade in" style="background:  #ccff90;">
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

  <div class="row">
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
      
    </div>
  </div>

<div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive" style="padding: 4px 4px;">
                <table class="table table-striped table-bordered table-condensed table-hover">
                    <thead>
                        <tr class="success">
                          <th colspan="12">
                              
                              <h3 style="text-align: center;"><b>Listado de Usuarios</b><a class="btn btn-success pull-right verde" data-title="Agregar Nuevo Usuario" href="{{URL::action('UsuarioController@create')}}"><i class="fa fa-fw -square -circle fa-plus-square"></i></a></h3>
                              
                          </th>
                      </tr>
                        <tr class="info">
                            <th>Nombre </th>
                            <th>Nombre de usuario</th>
                            <th>Rol de usuario</th>
                            <th>E-mail</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                   @foreach ($usuarios as $us)
                     
                      <tr>
                          <td>{{ $us->nombre}}</td>
                          <td>{{ $us->name}}</td>
                          <td><?= $us->tipo($us->idtipousuario);   ?></td>
                          <td>{{ $us->email }}</td>
                          <td style="width: 200px;">
                              <a class="btn btn-info azul" data-title="Editar Datos del Usuario" href="{{URL::action('UsuarioController@edit',$us->idusuario)}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                              <a class="btn btn-danger rojo" data-title="Eliminar Usuario" href="" data-target="#modal-delete-{{$us->idusuario}}" data-toggle="modal"><i class="fa fa-trash" aria-hidden="true"></i></a>
                          </td>
                      </tr>
                      @include('usuario.modal')
                  @endforeach
                </table>
            </div>
            {{$usuarios->render()}}
        </div>
    </div>

<div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="float: left;">
      <p style="text-align:center;"><b>{{$usuarioactual->nombre}}</b></p>
      <p style="text-align:center;"><?= $usuarioactual->tipo($usuarioactual->idtipousuario); ?></p>
  </div>

 
</div>

</section>



@endsection