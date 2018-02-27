<!DOCTYPE html>
<html>
  <head>
  
    <meta charset="utf-8">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <title>Sistema de Administración de Préstamos</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-select.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('css/font-awesome.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('css/AdminLTE.min.css')}}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{asset('css/_all-skins.min.css')}}">
    <link rel="apple-touch-icon" href="{{asset('img/apple-touch-icon.png')}}">
    <link rel="shortcut icon" href="{{asset('img/favicon.ico')}}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <!-- Mis Estilos -->
    <link rel="stylesheet" href="{{asset('css/estilos-stvn.css')}}">
    
  

  </head>
  <body class="hold-transition skin-green sidebar-mini sidebar-collapse">
    <div class="wrapper">

      <header class="main-header">

        <!-- Logo -->
        <a href="{{ url('home')}}" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>SIAP</b></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>SIAP</b></span>
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Navegación</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-circle" style="color:#00FF00"></i>
                  <span class="hidden-xs">{{$usuarioactual->nombre}} </span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <h4>ROL: <?= $usuarioactual->tipo($usuarioactual->idtipousuario); ?></h4>
                    <p>
                    Username: {{$usuarioactual->name}}
                    <small>Nombre: {{$usuarioactual->nombre}}</small>
                    </p>
                  </li>
                  
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    
                    <div class="pull-right">
                      <a href="{{ route('logout')}}" class="btn btn-default btn-flat">Cerrar Sesión</a>
                    </div>
                  </li>
                </ul>
              </li>
              
            </ul>
          </div>

        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
                    
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header"></li>

            
            @if($usuarioactual->idtipousuario==1) 
               @include('menu/admin')
            @endif
            @if($usuarioactual->idtipousuario!=1)
                @include('menu/emp') 
            @endif  

          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>
       <!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-12">
              <div class="box">
                <!-- /.box-header -->
                <div class="box-body">
                	<div class="row">
                  	<div class="col-md-12">
	                          <!--Contenido-->
                           

                            @yield('contenido')
                        <!--Fin Contenido-->
                    </div>
                  </div>    
                </div>
              </div><!-- /.row -->
            </div><!-- /.box-body -->
          </div><!-- /.box -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <!--Fin-Contenido-->
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Versión</b> 1.0
        </div>
        <strong>Sistema de Administración de Préstamos &copy; <a href="#"> SIAP</a></strong>.  Todos los derechos reservados.
      </footer>

    <!-- Contenido JS -->
    <script src="{{asset('js/palabra.min.js')}}"></script>
    <!-- jQuery 2.1.4 -->
    <script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>
    <!-- Mis Script -->
    @stack('scripts')
    <!-- Bootstrap 3.3.5 -->
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/bootstrap-select.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('js/app.min.js')}}"></script>
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
 



    
  </body>
</html>
