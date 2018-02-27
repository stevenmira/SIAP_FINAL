@extends ('layouts.inicio')
@section ('contenido')



  <section class="content">

  <!-- Notificación -->
  @if (Session::has('create'))
  <div class="alert  fade in" style="background:  #ccff90;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4>La Cartera <b>{{ Session::get('create')}}</b> han sido guardada correctamente.</h4>
  </div>
  @endif

  @if (Session::has('update'))
  <div class="alert  fade in" style="background:   #bbdefb;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4> La Cartera  <b>{{ Session::get('update')}}</b> ha sido actualizada correctamente.</h4>
  </div>
  @endif
  @if (Session::has('error'))
  <div class="alert  fade in" style="background:  #ff8a80;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><b>{{ Session::get('error')}}</b></h4>
  </div>
  @endif

  @if (Session::has('activo'))
  <div class="alert  fade in" style="background:  #f0f4c3;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4> La Cartera  <b>{{ Session::get('activo')}}</b>  fué dado de baja exitosamente.</h4>
  </div>
  @endif

  <section class="content-header">
    <h1 style="color: #333333; ">
      Gestion de Carteras Activas
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('home')}}" ><i class="fa fa-dashboard"></i> Inicio</a></li>
     
      <li class="active">Carteras Activas</li>
    </ol>
  </section>
<br>
  <div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			@include('carteras.search')
		</div>
	</div>

<div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive" style="padding: 4px 4px;">
                <table class="table table-striped table-bordered table-condensed table-hover">
                    <thead>
                        <tr class="success">
                          <th colspan="12">
                              
                              <h3 style="text-align: center; font-family:  Times New Roman, sans-serif; color: #1C2331;"><b>LISTA DE CARTERAS ACTIVAS</b><a class="btn btn-success pull-right verde" data-title="Agregar Nueva Cartera" href="{{URL::action('CarteraController@create')}}"><i class="fa fa-fw -square -circle fa-plus-square"></i></a></h3>
                              
                          </th>
                      </tr>
                        <tr class="info">
                            <th>Nombre</th>
                            <th>Ejecutivos</th>
                            <th>Supervisor</th>
                            <th>Clientes</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    @foreach ($carteras as $cartera)
                    @if($cartera->estado == 'ACTIVO')
        
                      <tr>
							              <td>{{ $cartera->nombre }}</td>
                            <td>{{ $cartera->ejecutivo }}</td>
                            <td>{{ $cartera->supervisor }}</td>
                          	<td style="width: 200px;">
                              <a class="btn btn-warning amarillo"  data-title="Ver Clientes de esta Cartera" href="{{URL::action('CarteraClientController@show',$cartera->idcartera)}}"><i class="fa fa-check-square-o" aria-hidden="true"></i></a>
                          	</td>
                          	<td style="width: 200px">

                              <a class="btn btn-info azul" data-title="Editar Nombre de la Cartera" href="{{URL::action('CarteraController@edit',$cartera->idcartera)}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

                              <a class="btn btn-danger rojo" data-title="Eliminar Cartera" href="" data-target="#modal-delete-{{$cartera->idcartera}}" data-toggle="modal"><i class="fa fa-trash" aria-hidden="true"></i></a>


                          </td>
                      </tr>
		@include('carteras.modal')
		@endif
		@endforeach
	</table>

	</div>
		{{$carteras->render()}}

	</div>
	</div>
  </section>
@endsection
