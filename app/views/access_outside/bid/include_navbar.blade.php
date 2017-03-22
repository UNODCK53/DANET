<div class="container-fluid">
  <div class="row" id="menu-sec">
    <!--Menu secundario es visible en sm lg-->
    <div class="col-sm-2 "></div>
    <div class="col-sm-9 text-center text-primary visible-sm visible-md visible-lg ">
      <ul class="nav nav-pills ">
        <!--<li role="presentation" ><a href="#"><strong> INICIO</strong></a></li>-->
        <li id="menuprincipal" role="menu"><a href="principal">Home</a></li>
        <li id="inicio" role="menu"><a href="bid_organizaciones">Inicio</a></li>
        <li id="organizaciones_menu" role="menu">
          <a href="" class="enlace-menu dropdown-toggle" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Organizaciones<span class="caret"></span></a>
          <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">        
          @foreach($array[0] as $pro) 
            <li class="dropdown-submenu" role="menu" >
            <a href="#" class="test" id="" tabindex="-1" href="" name="{{$pro->COD_DPTO}}" >{{$pro->NOM_DPTO}} <span class="caret" style="float: right; "></span></a>
              <ul class="dropdown-menu submenu" id="submenu_{{$pro->COD_DPTO}}">
              </ul>
            </li>
          @endforeach
          </ul>
        </li>
        <li id="productos_terminados" role="menu"><a href="bid_productos_terminados">Productos terminados</a></li>
        <li id="lineas_productivas" class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Líneas productivas <span class="caret"></span></a>
          <ul class="dropdown-menu">
            @foreach($array[2] as $pro)
            <li><a href="bid_linea_productiva?lp={{$pro->id_lipex}}" name="{{$pro->id_lipex}}" >{{$pro->nombre}}</a></li>
            @endforeach
          </ul>
        </li>
        <li id="" role="menu"><a href="" class="enlace-menu">Casos de Éxito</a></li>
        <li id="" role="menu"><a href="" class="enlace-menu">Alianzas estrategicas</a></li>
        <li id="" role="menu"><a href="" class="enlace-menu">Contáctenos</a></li>
      </ul>
    </div>
    <div class="col-sm-1"></div>
    <!--Menu compacto es visible en xs -->   
    <div class="col-xs-12 visible-xs">
      <nav class="navbar navbar-default" >
        <div class="container">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </button>
            <a id="iniciomenupeq" class="navbar-brand " href="principal"><small><strong> INICIO</strong></small></a>
          </div>
          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
              <!-- Lista desplegable de menu con submenu -->
              <li id="menuprincipal" role="menu"><a href="principal">Home</a></li>
              <li id="inicio" role="menu"><a href="bid_organizaciones">Inicio</a></li>
              <li id="organizaciones_menu" role="menu">
                <a href="" class="enlace-menu dropdown-toggle" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Organizaciones<span class="caret"></span></a>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">        
                @foreach($array[0] as $pro) 
                  <li class="dropdown-submenu" role="menu" >
                  <a href="#" class="test" id="" tabindex="-1" href="" name="{{$pro->COD_DPTO}}" >{{$pro->NOM_DPTO}} <span class="caret" style="float: right; "></span></a>
                    <ul class="dropdown-menu submenu" id="submenu_{{$pro->COD_DPTO}}">
                    </ul>
                  </li>
                @endforeach
                </ul>
              </li>
              <li id="productos_terminados" role="menu"><a href="bid_productos_terminados">Productos terminados</a></li>
              <li id="" role="menu"><a href="" class="enlace-menu">Líneas Productivas</a></li>
              <li id="" role="menu"><a href="" class="enlace-menu">Casos de Éxito</a></li>
              <li id="" role="menu"><a href="" class="enlace-menu">Alianzas estrategicas</a></li>
              <li id="" role="menu"><a href="" class="enlace-menu">Contáctenos</a></li>
              <!--  <li><a id="guardaunmenupeq" href="guardaun">GUARDAUN</a></li>   -->            
              
            </ul><!-- fin de menu con submenu -->
          </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
      </nav>
    </div>
  </div>
</div>
