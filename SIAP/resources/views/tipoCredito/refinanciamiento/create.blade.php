@extends ('layouts.inicio')
@section('contenido')

<!-- Select CSS -->
<link rel="stylesheet" href="{{asset('css/bootstrap-select.min.css')}}">
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
  <!-- Fin Notificación -->


<section class="content-header">
  <h1 style="color: #333333; font-family: 'Times New Roman', Times, serif;">
    Nuevo Refinanciamiento de Credito
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ url('home')}}"><i class="fa fa-dashboard"></i> Inicio</a></li>
   
    <li class="active">Refinanciamiento</li>
  </ol>
</section>
<br>

{!!Form::open(array('url'=>'refinanciamiento','method'=>'POST','autocomplete'=>'off'))!!}
            {{Form::token()}}

  <div class="col-md-12"> 
    <div class="panel panel-success">
      <div class="panel-body">
          <h4 style="color: #333333; font-family: 'Times New Roman', Times, serif;"><b> Datos del Credito</b></h4>
          <hr>

          <div class = "row">
              <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="input-group">
                    <label for="nombre">Fecha del Credito</label>
                  <input type="date" class="form-control" name="fechaCredito" value="" required>
              
                </div>
              </div>
            </div>

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
              <label for="nombre">Nombres del cliente</label>
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-pencil" aria-hidden="true"></i>
                </div>
                {{--  
                <input type="text" class="form-control" name="searchItem" id="searchItem" placeholder="Escriba el nombre del cliente" required>
   --}}

   <select name="searchItem"  class="form-control selectpicker" id="searchItem" data-Live-search="true" title="Seleccione o Busque un Cliente" required>
    @foreach($clientes as $cliente)
    <option value="{{ $cliente->idcliente }}">{{$cliente->nombre}} {{$cliente->apellido}}</option>
    @endforeach
  </select>
              </div>
            </div>

            <div class="form-group col-md-4">
                <label for="nombre">Negocio/s del cliente</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-pencil" aria-hidden="true"></i>
                  </div>
                  {{--  
                  <input type="text" class="form-control" name="searchItem" id="searchItem" placeholder="Escriba el nombre del cliente" required>
     --}}
  
     {!!Form::select('idnegocio',['placeholder'=>'Seleccione un Negocio'],null,['id'=>'negocioItem','class'=>'form-control','required' => 'required'])!!}
  
                </div>
              </div>
             
  
            
          </div>

          <div class="row"> 

            <div class=" col-md-4">
              <label for="monto">Monto a Otorgar</label>
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-list-alt" aria-hidden="true"></i>
               </div>
                {!! Form::number('monto', null, ['class' => 'form-control' , 'required' => 'required','max'=>'10000','min'=>'50','step'=>'0.01', 'placeholder'=>'Escriba el Monto a ser Otorgado', 'autofocus'=>'on']) !!}
              </div>
            </div>
            <div class="col-md-4">
              <label for="direccionCliente">Cuota del Cliente (en dolares)</label>
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-pencil" aria-hidden="true"></i>
                </div>
                {!! Form::number('cuota', null, ['class' => 'form-control' , 'required' => 'required','step'=>'0.01', 'placeholder'=>'Introduzca la cuota del cliente', 'autofocus'=>'on']) !!}
              </div>
            </div>

            <div class=" col-md-4">
              <label for="nit">Tipo de Credito</label>
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-list-alt" aria-hidden="true" ></i>
                </div>
                {{Form::radio('credito','normal',true)}}<i> Normal</i><br>
                {{Form::radio('credito','preferencial')}}<i> Preferencial</i><br>
                {{Form::radio('credito','oro')}}<i> Oro</i><br>
                        
              
                <a href="" data-target="#modal-ayuda" data-toggle="modal"><i class="fa fa-info-circle" aria-hidden="true">¿Ayuda sobre las tasas aplicables?</i></a>
                @include('tipoCredito.refinanciamiento.modalAyuda')
              </div>
              
            </div>
            
            
          </div>

          
             

           
          <br>
          <br>
            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12" id="guardar">
              <div class="form-group col-md-8">
             <!--  <input name="_token" value="{{csrf_token()}}" type="hidden"></input>
                  <a href="{{URL::action('ClienteController@index')}}" class="btn btn-danger btn-lg col-md-offset-2">Cancelar</a> -->
  
                  <a class="btn btn-success form-control" href="" data-target="#modal-verificar" data-toggle="modal" >Siguiente</a>
                  @include('tipoCredito.refinanciamiento.modal')
                  
                </div>
            </div>
          </div>
      </div>
    </div>
  </div>


{!!Form::close()!!}

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