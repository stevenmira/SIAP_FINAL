<html>
    <head>
        <title>OOOPS!!</title>
        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        <style>
            html, body {
                height: 100%;
            }
            body {
                margin: 0;
                padding: 0;
                width: 100%;
                color: #B0BEC5;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
            }
            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }
            .content {
                text-align: center;
                display: inline-block;
            }
            .title {
                font-size: 72px;
                margin-bottom: 40px;
            }
        </style>

    </head>
    <body>
        <div class="container">
            <div class="content">
                <div class="title">ESTA PAGINA NO EXISTE.</div>
            </div>
            <div class="row">
        	<a href="{{url('home')}}" style="color: black;" class="btn col-md-12 col-lg-12 btn-app">
              <i class="fa fa-refresh"></i>REGRESAR
      </a>
      </div>
        </div>
    </body>
</html>