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
     table{
            border-collapse: collapse;
        }
        table, td, th {
            border: 2px solid orange;
            padding:20px;
        }
        button{
            color:white;
            font-weight:bold;
            background-color:orange;
            width:100px;
            height:25px;
            font-size:15px;
        }
  }
</style>

<section class="content-header">
  <h1 style="color: #333333; ">
    Cálculo de Crédito
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ url('home')}}"><i class="fa fa-dashboard"></i> Inicio</a></li>
   
    <li class="active">Calcular Crédito Completo</li>
  </ol>
</section>
<br>

{!!Form::open(array('url'=>'calcular-credito','method'=>'POST','autocomplete'=>'off'))!!}
            {{Form::token()}}

  <div class="col-md-12"> 
    <div class="panel panel-success">
      <div class="panel-body">
          <h4 ><b> Datos del Crédito</b></h4>
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
              <label for="date">Fecha</label>
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-pencil" aria-hidden="true"></i>
                </div>
                
                <input type="date" class="form-control" name="fecha" id="fecha" >
 
              </div>
            </div>

           
            
          </div>

          <div class="row"> 

            <div class="form-group col-md-4">
              <label for="monto">Monto a Otorgar</label>
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-list-alt" aria-hidden="true"></i>
                </div>
                {!! Form::number('monto', null, ['class' => 'form-control' , 'required' => 'required', 'placeholder'=>'Escriba el Monto a ser Otorgado', 'autofocus'=>'on']) !!}
              </div>
            </div>

            <div class="form-group col-md-4">
              <label for="nit">Tipo de Credito</label>
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-list-alt" aria-hidden="true"></i>
                </div>
                {{Form::radio('credito','normal',true)}}<i> Normal</i><br>
                {{Form::radio('credito','preferencial')}}<i> Preferencial</i><br>
                {{Form::radio('credito','oro')}}<i> Oro</i><br>
              </div>
            </div>
            
            
          </div>

          <div class="row"> 
            <div class="form-group col-md-4">
              <label for="direccionCliente">Cuota del Cliente</label>
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-pencil" aria-hidden="true"></i>
                </div>
                {!! Form::number('cuota', null, ['class' => 'form-control' , 'required' => 'required', 'placeholder'=>'Introduzca la cuota del cliente', 'autofocus'=>'on']) !!}
              </div>
            </div>

         


      </div>
       <div class="row">
           
            <div class="form-group  col-md-offset-3"  >
            <input type="button" name="boton" id="boton" value="Submit" onclick="all_user()"/>
             <a class=" btn btn-danger" type="reset"  href="{{URL::action('ClienteController@index')}}">Cancelar</a>
             </div>
          </div>
    </div>
  </div>

  <P>
  

{!!Form::close()!!}





@endsection