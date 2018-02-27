@extends ('layouts.inicio')
@section('contenido')


<!-- Select CSS -->
<link rel="stylesheet" href="{{asset('css/bootstrap-select.min.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
<script type="text/javascript" src="js/calculoCredito.js"></script>
<style>
  .errors{
    background-color: #fcc;
    border: 1px solid #966;
  }
</style>

<section class="content-header">
  <h1 style="color: #333333; ">
    Calculo de Crédito
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ url('home')}}"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li><a href="{{URL::action('TipoCreditoController@create')}}"> Gestion de Crédito</a></li>
    <li class="active">Calcular Crédito Completo</li>
  </ol>
</section>
<br>




   <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

       
       <div class="table-responsive">
                 <table class="table table-striped table-bordered table-condesed table-hover" id="user_table">

               
                
                  
              <tbody>
                 <p id="demo"></p>

            </tbody>


            </table>
           </div>
           
    </div>

   </div>




@endsection