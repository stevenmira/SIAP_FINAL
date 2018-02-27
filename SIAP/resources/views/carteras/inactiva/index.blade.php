@extends ('layouts.inicio')
@section ('contenido')


<section class="content">
  
  @if (Session::has('inactivo'))
  <div class="alert  fade in" style="background:  #f0f4c3;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4> La Cartera <b>{{ Session::get('inactivo')}}</b> ha sido modificado al estado <b> ACTIVO </b>  nuevamente.</h4>
  </div>
  @endif

   @if (Session::has('error'))
  <div class="alert  fade in" style="background:  #ff8a80;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4> La Cartera <b>{{ Session::get('error')}}</b> ha sido modificado al estado <b> ACTIVO </b>  nuevamente.</h4>
  </div>
  @endif

  <section class="content-header">
    <h1 style="color: #333333; ">
      Lista de Carteras Inactivas
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('home')}}" ><i class="fa fa-dashboard"></i> Inicio</a></li>
     
      <li class="active">Carteras Inactivas</li>
    </ol>
  </section>

  <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <br>
      @include('carteras.inactiva.search')
    </div>
  </div>

<div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive" style="padding: 4px 4px;">
                <table class="table table-striped table-bordered table-condensed table-hover">
                    <thead>
                        <tr class="success">
                          <th colspan="12">
                              
                              <h3 style="text-align: center; font-family:  Times New Roman, sans-serif; color: #1C2331;"><b>LISTADO DE CARTERAS</b> <b style="color: red;">INACTIVAS</b></h3>
                              
                          </th>
                      </tr>
                        <tr class="info">
                            <th>Nombre</th>
                            <th>Ejecutivos</th>
                            <th>Supervisor</th>
                            <th>Opciones</th>
                        </tr>

                    </thead>
                    @foreach ($carteras as $cartera)
                    @if($cartera->estado == 'INACTIVO')
          
                      <tr>
                            <td>{{ $cartera->nombre }}</td>
                            <td>{{ $cartera->ejecutivo }}</td>
                            <td>{{ $cartera->supervisor }}</td>
                            <td>  <a class="btn btn-primary azul" data-title="Habilitar Cartera" href="" data-target="#modal-delete-{{$cartera->idcartera}}" data-toggle="modal"><i class="fa fa-check" aria-hidden="true"></i></a>
                              
                            </td>
                            
                          </td>
                      </tr>
    @include('carteras.inactiva.modal')
    @endif
    @endforeach
  </table>

  </div>
    {{$carteras->render()}}

  </div>
  </div>
  </section>
@endsection
