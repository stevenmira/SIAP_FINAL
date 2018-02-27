<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sistema | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/iCheck/square/blue.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  
  <body class="">
    <div class="">
      <div class="login-logo">
        <a href="#"><b>AFIMID S.A. DE C.V.</b></a>
      </div><!-- /.login-logo -->
      <div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		
		<br><br>
		@if (Session::has('error'))
			<p class="alert alert-danger">{{ Session::get('error')}}</p>
		@endif

		@if (Session::has('update'))
			<p class="alert alert-info">{{ Session::get('update')}}</p>
		@endif	

		@if (Session::has('message'))
			<p class="alert alert-success">{{ Session::get('message')}}</p>
		@endif

	</div>
</div>
      <div class="login-box-body">
        <p class="login-box-msg">Registro para usuario administrador</p>
       
      <form action="register" method="post">
      <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">   
          
      <div class="form-group col-md-12">
      <div class="form-group col-md-4">
                         
                            <label for="nombre">Nombre de Empleado</label>
                            <input type="text" class="form-control" id="nombre" name="nombre"  placeholder="Nombre de Empleado" p required >
                            
      </div>
      <div class="form-group col-md-4">
                         
                            <label for="name">Nombre de Usuario</label>
                            <input type="text" class="form-control" id="name" name="name"  placeholder="Nombre de Usuario" p required >
                            
      </div>
      
      
      <div class="form-group col-md-3 col-xs-4">
      
                            <label for="idtipousuario">Tipo Usuario</label>
                            <select id="idtipousuario" name="idtipousuario" class="form-control" >
                            <?php  for($i=0;$i<=count($tiposusuario)-1;$i++){   ?>
                            <option value="<?= $tiposusuario[$i]->idtipousuario  ?>" ><?= $tiposusuario[$i]->nombre ?> </option>
                            <?php  } ?>
                            </select>                 
                         
      </div>
    
     
     
      <div class="form-group col-md-4">
      
                            <label for="email">Email*</label>
                            <input type="text" class="form-control" id="email" name="email" placeholder="email" p required>
                            </div>
                            </div>
    <div class="form-group col-md-12">
      <div class="form-group col-md-3">
      
                            <label for="email">password*</label>
                            <input type="password" class="form-control" id="password" name="password" p required >
                            </div>
      </div>
 
            

            
 <div class=" form-group col-md-12 ">
<div class="form-group col-md-3">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Registrar</button>
            </div><!-- /.col -->
          </div>
        </form>

     
       
      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.4 -->
    <script src="../../plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="../../plugins/iCheck/icheck.min.js"></script>
   

    <script>
      
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>

    
  </body>
</html>
