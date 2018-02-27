         <li class="treeview">
            <a href="">
               <i class="fa fa-sort-alpha-asc"></i>
                <span>Carteras</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
              <li><a href="{{URL::action('CarteraController@index')}}"><i class="fa fa-circle-o"></i> Activas </a></li>
              <li><a href="{{URL::action('CarteraController@inactivos')}}"><i class="fa fa-circle-o"></i> Inactivas</a></li>
            </ul>
        </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-folder-open"></i>
                <span>Clientes</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{URL::action('ClienteController@index')}}"><i class="fa fa-circle-o"></i> Activos</a></li>
                <li><a href="{{URL::action('ClienteController@inactivos')}}"><i class="fa fa-circle-o"></i> Inactivos</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-file-text"></i>
                <span>Gestión de Crédito</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">

                <li><a  href="{{URL::action('calcularCreditoController@create')}}"><i class="fa fa-circle-o"></i> Calcular Crédito</a></li>

                <li><a href="{{URL::action('TipoCreditoController@create')}}"><i class="fa fa-circle-o"></i> Credito Completo</a></li>
                <li><a href="{{URL::action('RefinanciamientoController@create')}}"><i class="fa fa-circle-o"></i> Refinanciamiento</a></li>
              </ul>
            </li>
                     
            <li class="treeview">
              <a href="{{URL::action('RecordClienteController@index')}}">
                <i class="fa fa-folder-open"></i> 
                <span>Récord de Cliente</span>
                <i class="fa fa-info-circle pull-right"></i>
              </a>
            </li>

            <li class="treeview">
              <a href="{{URL::action('UsuarioController@index')}}">
                <i class="fa fa-users"></i> 
                <span>Gestión de Usuarios</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
            </li>

            <li class="treeview">
              <a href="#">
                <i class="fa fa-cog"></i> 
                <span>Ajustes</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{URL::action('ImprimirController@index')}}"><i class="fa fa-circle-o"></i> Imprimir</a></li>
              </ul>
            </li>

             <li>
              <a href="{{URL::action('UsuarioController@download')}}">
                <i class="fa fa-plus-square"></i> 
                <span>Ayuda</span>
                <small class="label pull-right bg-red">PDF</small>
              </a>
              <ul class="treeview-menu">

                <li><a  href="{{URL::action('UsuarioController@download')}}"><i class="fa fa-circle-o"></i> Manual de Usuario</a></li>

              </ul>
            </li>
            <li>
              <a href="#">
                <i class="fa fa-info-circle"></i> <span>Acerca De...</span>
                <small class="label pull-right bg-yellow">IT</small>
              </a>
            </li>