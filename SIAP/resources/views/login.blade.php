<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<link rel="stylesheet" href="{{asset('css/login.css')}}">
    
<div class="main">

    <div class="container">
       <center>
         <div class="middle"  >
        
            <div id="login">
              <form action="login" method="post">
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">   
                <fieldset class="clearfix">
                   <p ><span class="fa fa-user"></span><input type="text" name="name" placeholder="Usuario" required=""></p> <!-- JS because of IE support; better: placeholder="Username" -->
                   <p><span class="fa fa-lock"></span><input type="password" name="password" placeholder="Contraseña" required=""></p> <!-- JS because of IE support; better: placeholder="Password" -->
            
                  <div>
                  <span style="width:48%; text-align:left;  display: inline-block;"><a class="small-text" href="#"></a></span>
                   <span style="width:50%; text-align:right;  display: inline-block;"><input type="submit" value="Entrar"></span>
                  </div>
                </fieldset>
                <br/>
               <div class="clearfix">
                   @if (Session::has('message'))
                    <p style="color:red" class="alert alert-danger">{{ Session::get('message')}}</p>
                     @endif
              </div>
             </form>

        <div class="clearfix"></div>
      </div> <!-- end login -->
      
      <div class="logo">
          
             <img src="../img/logo.png"  width="300" height="300">
             <div class="clearfix"></div>
      </div>
      
      </div>
      <div style="color:#eee">
        </br>
        <p>
         SIAP
        <small>Sistema Informatico para la Administración de Prestamos.</small>
        </p>
        </br>
        <p>
        <h3>{{$fecha_actual}}.</h3>
        
        </p>
   </div>
</center>

    </div>
    <div class="">
      <p>&copy; DEVS | Todos los derechos reservados. </p>
    </div>
   
</div>
