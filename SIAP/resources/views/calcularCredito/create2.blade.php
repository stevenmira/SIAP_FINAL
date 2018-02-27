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
 @if (Session::has('negativo'))
       <div class="alert  fade in" style="background: #ff6666;">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
         <h4>El Monto debe ser mayor a $50 </h4>
      </div>
  @endif

@if (Session::has('negativo1'))
       <div class="alert  fade in" style="background: #ff6666;">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
         <h4>El Monto debe ser menor  a $10,000</h4>
      </div>
  @endif

@if (Session::has('negativo2'))
       <div class="alert  fade in" style="background: #ff6666;">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
         <h4>La cuota debe de ser mayor a cero</h4>
      </div>
  @endif

  @if (Session::has('negativo3'))
       <div class="alert  fade in" style="background: #ff6666;">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
         <h4> <b>{{ Session::get('negativo3')}}</b></h4>
      </div>
  @endif


{!!Form::open(array('url'=>'calcular-credito','method'=>'POST','autocomplete'=>'off'))!!}
            {{Form::token()}}
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
                <input type="number" class="form-control" name="monto" id="monto" required="true" placeholder="Ingresar monto a Otorgar" step="0.01">
             </div>
             </div>


           <div class="form-group col-md-4">
              <label for="nit">Tipo de Credito</label>
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-list-alt" aria-hidden="true"></i>
                </div>
                <input type="radio" name="tipo" id="tipo" value="normal" checked> Normal<br>
                <input type="radio" name="tipo" id="tipo" value="preferencial"> Preferencial<br>
                <input type="radio" name="tipo" id="tipo" value="oro"> Oro<br><br>
               
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
                <input type="number" step="0.01" name="cuota" id="cuota" required="true" placeholder="Ingresar cuota" >
              </div>
            </div>
      </div>

       <div class="row">
           
            <div class="form-group  col-md-offset-3"  >
            <button type="submit" class="btn btn-success" style="height: 40px; width: 100px;" >Calcular</button>
            
             <a class=" btn btn-danger" type="reset"  href="/" style="height: 40px; width: 100px;">Cancelar</a>
             </div>
          </div>
    </div>
  </div>

{!!Form::close()!!}

	<script type="text/javascript">
		var getData= function()
		{ var fecha=document.getElementById("fecha").value;
		  var montoCapital=document.getElementById("monto").value;
		  var cuota=document.getElementById("cuota").value;
      var tipo=document.getElementById("tipo").value;
  
     

    var tipoCredito, n, interesDiario,cuotaCapital,tasaInteres,totalDiario;
    n=0;

 switch (tipo) {
            case 'normal':
               {
                if (montoCapital <= 80) 
                    tipoCredito = 1;
                 else if (montoCapital > 80 && montoCapital <= 105)
                    tipoCredito = 2;
                else 
                    tipoCredito = 3;
                }
            break;
            case 'preferencial':
                tipoCredito = 4;

                break;

            case 'oro':
                $tipoCredito = 5;
      
                break;
        }


   // Definir la tasa de interes
   if (tipoCredito==1)
        tasaInteres=0.170;
    else if(tipoCredito==2)
          tasaInteres=0.110;
          else if (tipoCredito==3)
            tasaInteres=0.100;
                else if (tipoCredito==4)
                  tasaInteres=0.080;
                      else
                        tasaInteres=0.070;


     
    //calculo de valores del prestamo
   console.log(n);
   console.log(montoCapital);
   console.log(cuota);
   console.log(tasaInteres);
   while(montoCapital>cuota)
    { 
          n++;
       
       interesDiario=montoCapital*tasaInteres;
       cuotaCapital=cuota-interesDiario;
       montoCapital=montoCapital-cuotaCapital;


     
      
    }
     

   

      
    

  }



</script>



@endsection