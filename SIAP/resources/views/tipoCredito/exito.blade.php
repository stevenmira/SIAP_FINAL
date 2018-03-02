@extends ('layouts.inicio')
@section('contenido')

<!-- Select CSS -->
<link rel="stylesheet" href="{{asset('css/bootstrap-select.min.css')}}">
<link rel="stylesheet" href="{{asset('css/table.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
<style>
  .errors{
    background-color: #fcc;
    border: 1px solid #966;
  }
</style>

    <!-- Notificación -->
 

    @if (Session::has('unicidad'))
    <div class="alert  fade in" style="background:  #ff8a80;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4> No se pudo actualizar, el cliente con el número de DUI  <b>{{ Session::get('unicidad')}}</b>  ya está en uso.</h4>
    </div>
    @endif
  
    @if (Session::has('update'))
    <div class="alert  fade in" style="background:  #bbdefb;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4> El cliente  <b>{{ Session::get('update')}}</b>  ha sido actualizado correctamente.</h4>
    </div>
    @endif
  
    @if (Session::has('activo'))
    <div class="alert  fade in" style="background:  #ccff90;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4> El cliente  <b>{{ Session::get('activo')}}</b>  fué dado de baja exitosamente.</h4>
    </div>
    @endif
  
    @if (Session::has('fallo'))
    <div class="alert  fade in" style="background:  #ff8a80;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4>   <b>{{ Session::get('fallo')}}</b>  </h4>
    </div>
    @endif
  
    @if (Session::has('error1'))
    <div class="alert  fade in" style="background:  #ff8a80;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4>   <b>{{ Session::get('error1')}}</b>  </h4>
    </div>
    @endif
  
    @if (Session::has('error5'))
   
    <div class="alert  fade in" style="background:  #ff8a80;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4>   <b>{{ Session::get('error5')}}</b>  </h4>
    </div>
    @endif

    @if(Session::has('exito1'))
    <div class="alert  fade in" style="background:  #ccff90;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4>{{ Session::get('exito1')}}.</h4>
    </div>
    
    @endif
    <!-- Fin Notificación -->


<section class="content-header">
  <h1 style="color: #333333; font-family: 'Times New Roman', Times, serif;">
    @if(Session::has('bandera'))
    Credito Completo
    @else
    Refinanciamiento
    @endif
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{URL::action('ClienteController@index')}}"><i class="fa fa-dashboard"></i> Inicio</a></li>
   
    <li class="active">Credito</li>
  </ol>
</section>
<br>


  <div class="container">
    <div class="row text-center">
        <div class="col-md-12">
            <h2>El Credito ha sido Creado Correctamente</h2>
        </div>
        <div class="col-md-12" style="margin-top: 20px;">
            <div class="pricing-table">
                <div class="panel panel-primary" style="border: none;">
                    <div class="controle-header panel-heading panel-heading-landing">
                        <h1 class="panel-title panel-title-landing">
                            Negocio: <strong>{{$negocio->nombre}}</strong>
                        </h1>
                    </div>
                    <div class="controle-panel-heading panel-heading panel-heading-landing-box">
                        Cliente: <strong>{{$persona->nombre}} {{$persona->apellido}}</strong>
                    </div>
                    <div class="panel-body panel-body-landing">
                        <table class="table">
                            <tr>
                                <td width="50px"><i class="fa fa-check"></i></td>
                                <td><strong>Monto:</strong></td>
                                <td>{{$prestamo->montooriginal}}</td>
                            </tr>
                            <tr>
                                <td width="50px"><i class="fa fa-check"></i></td>
                                <td><strong>Monto Financiado:</strong></td>
                                <td>{{$cuenta->montocapital}}</td>
                            </tr>
                            <tr>
                                <td width="50px"><i class="fa fa-check"></i></td>
                                <td><strong>Interes:</strong></td>
                                <td>{{($cuenta->interes)*100}}%</td>
                            </tr>
                            <tr>
                              <td width="50px"><i class="fa fa-check"></i></td>
                              <td><strong>Fecha Ultima de Pago:</strong></td>
                              <td>{{$prestamo->fechaultimapago}}</td>
                          </tr>
                        </table>
                    </div>
                    <div class="panel-footer panel-footer-landing">
                        <a href="{{URL::action('LiquidacionController@carteraPDF',$cuenta->idcuenta)}}" target="_blank" class="btn btn-price btn-success btn-lg">Imprimir Cartera del Cliente</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@push('scripts')


<!-- InputMask -->
<script src="{{asset('js/inputmask/jquery3.js')}}"></script>  
<script src="{{asset('js/inputmask/input-mask.js')}}"></script>
<script src="{{asset('js/inputmask/input-mask-date.js')}}"></script>


<!-- Select -->
<script src="{{asset('js/bootstrap-select.min.js')}}"></script>

<!--Autocomplete-->
<script src="{{asset('js/search/autocomplete.js')}}"></script>

<script src="{{asset('js/popover.js')}}"></script>

<script>
  $(function () {
    //Money Euro
    $('[data-mask]').inputmask()

  })
</script>


<!--searchphp-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
@endpush


@endsection