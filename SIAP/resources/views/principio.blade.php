@extends ('layouts.inicio')
@section('contenido')
<div class="clearfix">
                            <h2 style="text-align:center" ><b>BIENVENIDO USUARIO</b></h2></div>
                           <div><h3 style="text-align:center"><b>{{$usuarioactual->nombre}}</b></h3></div> 
                          <div style="text-align:center">
                          <img src="../img/logo.png"  width="300" height="300">
                          </div>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            
                <div class="panel-heading">
                   </div>
                <div class="panel-body">
                    <div class="row">
                    
                        <div style="text-align:center" class="col-xs-11 col-md-11">
                       
      
        <div class="callout" style="background: #9FD1BD; color: #0B3323;">
          <h4>TIP!</h4>

          <p><div id="rotando"><script language="JavaScript">
                   rotar();
          </script></div></p>
        </div>


                        
                                                
                    </div>
                    
                </div>
            
        </div>
    </div>
</div>

 @stack('scripts')
 <script type="text/javascript">
var indice = 0;
frases = new Array();
frases[0] = "RECUERDE MANTENER LA FECHA DE SU COMPUTADORA AL DIA.";
frases[1] = "PUEDE NAVEGAR POR LAS DIFERENTES OPCIONES DE NUESTRO MENU A SU IZQUIERDA.";
frases[2] = "SI NECESITA AYUDA, PUEDE CONSULTAR LA OPCION AYUDA EN EL MENU.";
frases[3] = "RECUERDE REALIZAR UN RESPALDO DE SU BASE DE DATOS.";
frases[4] = "ESPERAMOS QUE SU VISITA AL SISTEMA SE AGRADABLE.";

indice = Math.random()*(frases.length);
indice = Math.floor(indice);

function rotar() {
if (indice == frases.length) {indice = 0;}
document.getElementById("rotando").innerHTML = frases[indice];
indice++;
setTimeout("rotar();",5000);
}
</script>
<div id="rotando" style="height:60px;margin:0px auto;"></div>
<script type="text/javascript">rotar();</script>

@endsection