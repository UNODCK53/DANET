<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
  <title>
			Sello Desarrollo Alternativo 
	</title>
	
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/dataTables.bootstrap.css">
  <link rel="stylesheet" type="text/css" href="assets/css/responsive.bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap-datepicker.css">
	<style>
    #sha{
      -webkit-box-shadow: 0px 0px 18px 0px rgba(48, 50, 50, 0.48);
      -moz-box-shadow:    0px 0px 18px 0px rgba(48, 50, 50, 0.48);
      box-shadow:         0px 0px 18px 0px rgba(48, 50, 50, 0.48);
    }
	 .enlace-sesion{
	    margin-right:11px;
	  }
	  .enlace-menu{
	    margin-right:13px;
	    color:#245DC1;
	  }
	  .enlace-menu2{
	    margin-left:10px;
	    color:#444449;
	  }
	  #menu-sec{
	    border-bottom:1px #EEEEEE solid;  
	  }			  
	  .menu-footer{
	    font-size:11px;
	    color:#245DC1;
	    margin-right:2px;
	  }

    .foto{
      width: 100%;
    }

    .info{
      background: #f2f2f2;
      padding: 15px;
      margin-bottom: 15px;
      height: 380px ;
    }

    .dropdown-submenu {
    position: relative;
    }

    .dropdown-submenu .dropdown-menu {
        top: 0;
        left: 100%;
        margin-top: -1px;
    }

    
  </style>
	
	<!-- librerias JavaScript que se utilizan en la pagina -->
	<script src="assets/js/jquery-1.11.3.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/jquery.dataTables.min.js"></script>
	<script src="assets/js/dataTables.bootstrap.min.js"></script>
  <script src="assets/js/dataTables.responsive.min.js"></script>
	<script src="assets/js/bootstrap-datepicker.js"></script>
	<script src="assets/js/locales/bootstrap-datepicker.es.min.js" charset="UTF-8"></script>
	
</head>
<body>
<!--comienza la cabecera-->

<!--Primer Contenerdor logo y botón iniciar sesion-->  
<div class="container-fluid well">
  <div class="row">
    <div class="col-sm-1 hidden-xs" ></div>
    <div class="col-xs-10">        
        <img src="assets/bid/img/sello.png" width="5%">        
    </div>
    <div class="col-sm-1 hidden-xs"></div>
    
    <div class="col-sm-1 hidden-xs"></div>
  </div>
</div>
<!--Fin del primer contenedor-->
<!--Segundo contenedor menu secundario-->
@include('access_outside.bid.include_navbar')
<!--Fin del segundo contenedor--> 
<!--tercer contenedor pie de página-->
  <div class="container" id="sha">
    <div class="row">
      <div class="row" style="margin-right: 0px;margin-left: 0px">
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
          <!-- Indicators -->
          <ol class="carousel-indicators">
          <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
          <li data-target="#carousel-example-generic" data-slide-to="1"></li>          
          <li data-target="#carousel-example-generic" data-slide-to="2"></li>          
          </ol>
          <!-- Wrapper for slides -->
          <div class="carousel-inner">
            <div class="item active">
                <img src="assets/bid/img/banner-sello2.jpg">                
              <div class="carousel-caption">
              </div>
            </div>
            <div class="item">
              <img src="assets/bid/img/banner-cfp.jpg"> 
              <div class="carousel-caption">
              </div>
            </div>
            <div class="item">
              <img src="assets/bid/img/Firma-MPA.jpg">
              <div class="carousel-caption">
              </div>
            </div>                         
          </div>  
        </div>
      </div>
      <div class="row" style="line-height: 200px; margin-right: 0px;margin-left: 0px; background: #84b326; height: 150px; color: white; text-align: center;">
            <span style="display: inline-block;line-height: normal; font-size: 30px">Mejoramiento de la Competitividad y Consolidación Empresarial de Pequeños Productores para la Sustitución de Cultivos Ilícitos.</span>
      </div>
      <div class="col-sm-1"></div>
      <div class="col-xs-12 col-sm-10">          
        <!--escribir el codigo-->
        <div class="col-xs-12">
          <br><br>
          <hr>
          <h1>Nuestras Actividades en zona</h1>
          @foreach($array[3] as $pro)
          <div class="col-xs-12 col-md-3">
            <div class="info">
              <img class="foto" src="assets/bid/informacion/{{$pro->id}}/{{$pro->id}}.jpg">
              <h3>{{$pro->titulo}}</h3>
            </div>            
          </div>
          @endforeach
        </div>

        
        <!--finaliza escribir codigo--> 
      </div>
      <div class="col-sm-1"></div> 
      
      <div class="col-xs-12" style="padding-top: 65px; background-image: url('assets/bid/img/banner-producto.jpg');height: 250px; color: white; text-align: center;">
      <p style="font-size: 32px">Productos de Desarrollo Alternativo</p>
      Conozca los productos que hacen parte del proyecto de Desarrollo Alternativo
      <br><br>
      <button type="button" class="btn btn-primary">Ampliar</button>
      </div>
      
        
    </div>
  </div>
<!--Fin del tercer contenedor--> 

<!--cuarto contenedor pie de página-->
<div class="container-fluid well" id="piedepagina">      
      <div class="col-xs-12" style="color: white; text-align: center;">
      <img class="foto" src="assets/bid/img/regla.jpg" style="height: 135px; width: auto;">      
      </div>        
</div>
<!--Fin del cuarto contenedor-->
<!--quinto contenedor-->  
<div class="container">
  <div class="row">
    <div class="col-xs-12 col-md-12"><small><p class="text-right">Unidad de Información y Análisis – Monitoreo Integrado Desarrollo Alternativo – UNODC <br/>Bogotá D.C. - Colombia</p></small>
    </div>
  </div>
	<br/><br/>
</div>
<!--Fin del quinto contenedor-->  
<script>
    $(document).ready(function() {          
      //para que los menus pequeño y grande funcione
      $( "#inicio" ).addClass("active");          
      $( "#iniciomenupeq" ).html("<small> INICIO</small>");
      $( "#gizdatrelevmenupeq" ).html("<strong>Datos Relevantes</strong>");          
      $( "#mensajeestatus" ).fadeOut(5000);
      @include('access_outside.bid.include_organizaciones_menu');
    });
</script>
</body>
</html>