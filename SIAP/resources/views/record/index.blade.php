@extends ('layouts.inicio')
@section('contenido')
<section class="content-header">

   

  <h1 style="color: #333333; font-family: 'Times New Roman', Times, serif;">
    Cuentas del Cliente
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ url('home')}}"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li class="active">Récord Cliente </li>
  </ol>
</section>
<br>

@if (Session::has('borrado'))
<div class="alert  fade in" style="background:  #ccff90;">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
  <h4> <b>{{ Session::get('borrado')}}</b>  </h4>
</div>
@endif

  <div class="row">
    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
      <div class="alert  fade in" style="background:  rgba(255, 235, 59, 0.7);">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <font face="Comic Sans MS,arial,verdana">Puedes realizar tus búsquedas por el  <b>Número de DUI</b> ó bien por el <b style="color: black;"> Nombre</b> ó <b style="color: black;"> Apellido</b> <b style="color: black;">Completo </b> ó <b style="color: black;"> Parcial </b> del cliente</font>
      </div>
      @include('record.search')
    </div>
  </div>

@if($cuentas == null)
  @if($query!=0)
      <div class="alert  fade in" >
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h3><font face="Comic Sans MS,arial,verdana"><i class="fa fa-info-circle"> No se encontraron cuentas del cliente . . .</i> </font></h3>
      </div>
  @endif
@else
  <div class="row">                  
  @foreach ($cuentas as $cuenta)
          <div class="col-md-4">
            <!-- Widget: user widget style 1 -->
            <div class="box box-widget widget-user-2">
              <!-- Add the bg color to the header using any of the bg-* classes -->
                  @if($cuenta->estado =='ACTIVO')
                  <div class="widget-user-header" style="background: #64dd17;">
                    <div class="widget-user-image">
                      <img class="img-circle" src="{{asset('img/logos/check3.png')}}" alt="User Avatar">
                  @else
                  <div class="widget-user-header" style="background: #cfd8dc;">
                    <div class="widget-user-image">
                    <img class="img-circle" src="{{asset('img/logos/equis.png')}}" alt="User Avatar">
                  @endif
                </div>
                <!-- /.widget-user-image -->
                <h5 class="widget-user-username">{{$cuenta->nombre}} {{$cuenta->apellido}}</h5>
                <h4 class="widget-user-desc"> <b style="color: black;">{{$cuenta->nombreNegocio}}</b> </h4>
                <h4 class="widget-user-desc"> <b style="color: black;">{{$cuenta->actividadeconomica}}</b> </h4>
              </div>
              <div class="box-footer no-padding">
                @if($cuenta->estado =='ACTIVO')
                <ul class="nav nav-stacked" style="background: #ccff90 ;">
                @else
                <ul class="nav nav-stacked" style="background: #cfd8dc;">
                @endif

                  <li><a href="{{URL::action('CuentaController@show',$cuenta->idcuenta)}}"> INFORMACION DE LA CUENTA <small class="label pull-right bg-blue"><i class="fa fa-info" aria-hidden="true"></i></small></a></li>

                  @if($usuarioactual->idtipousuario==1) 
                  <li><a href="{{ url('cuenta/carteraPagos', ['id' => $cuenta->idcuenta]) }}"> CARTERA DE PAGOS <small class="label pull-right bg-green"><i class="fa fa-money" aria-hidden="true"></i></small></a></li>
                  @endif

                  <li style="text-align: center;">
                    <p style="margin: 5px 0px;"><b> CREDITO < {{$cuenta->estadoPrestamo}} > </b> </p>
                    <p style="text-align: center;" class="content-header"> <b>FECHA :</b> {{$cuenta->fecha}}   <b> MONTO : </b>  {{$cuenta->monto}} <b>CUOTA :</b> {{$cuenta->cuotadiaria}}</p>
                  </li>
                  
                </ul>
              </div>
          </div>
        </div>
  @endforeach
  </div>
@endif

<div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <h3 style="text-align:center; font-family:  Times New Roman, sans-serif; color: #1C2331; float: right;"><b>{{$fecha_actual}}</b></h3>
  </div>
</div>
@endsection