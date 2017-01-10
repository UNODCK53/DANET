<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
  <title>
			Cooperación GIZ-UNODC 
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
    <!--Columna logo con imágen-->
    <div class="col-xs-6 col-sm-3 col-sm-offset-1 col-md-2 col-md-offset-2 col-lg-2 col-lg-offset-3">
      <img src="assets/img/unodc.gif" class="img-responsive" alt="logounodc">
    </div>
    <!--espaciado para que en xs queden separado logo y boton-->
    <div class="col-xs-1 visible-xs">
    </div>
    <div class="col-lg-6 visible-lg">
    </div>
    <!--columna botón crear cuenta solo es visible en xs-->
    <div class="col-xs-5 visible-xs">
    
    </div>
           
  </div>
</div>
<!--Fin del primer contenedor-->

<!--Segundo contenedor menu secundario-->
<div class="container-fluid">
  <div class="row" id="menu-sec">
    <!--Menu secundario es visible en sm lg-->
    <div class="col-sm-2 "></div>
    <div class="col-sm-9 text-center text-primary visible-sm visible-md visible-lg ">
      <ul class="nav nav-pills ">
        <!--<li role="presentation" ><a href="#"><strong> INICIO</strong></a></li>-->
        <li id="menuprincipal" role="menu"><a href="principal">INICIO</a></li>
        <li id="menugizestudio" role="menu"><a href="Cooperacion_GIZ" class="enlace-menu">Estudio</a></li>
        <li id="menugizdatrelev" role="menu"><a href="Cooperacion_GIZ_datosrelevantes" class="enlace-menu">Datos Relevantes</a></li>
        <li id="menugizvisor" role="menu"><a href="Cooperacion_GIZ_visorgeo" class="enlace-menu">Visor Geográfico</a></li>
        <li id="menugizdocu" role="menu"><a href="Cooperacion_GIZ_documentos" class="enlace-menu">Documentos</a></li>        
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
              <li><a id="gizestudiomenupeq" href="Cooperacion_GIZ" class="enlace-menu">Estudio</a></li>                           
              <li><a id="gizdatrelevmenupeq" href="Cooperacion_GIZ_datosrelevantes" class="enlace-menu">Datos Relevantes</a></li>
              <li><a id="gizvisormenupeq" href="Cooperacion_GIZ_visorgeo" class="enlace-menu">Visor Geográfico</a></li>
              <li><a id="gizdocumenupeq" href="Cooperacion_GIZ_documentos" class="enlace-menu">Documentos</a></li>
              <!--  <li><a id="guardaunmenupeq" href="guardaun">GUARDAUN</a></li>   -->            
              
            </ul><!-- fin de menu con submenu -->
          </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
      </nav>
    </div>
  </div>
</div>
<!--Fin del segundo contenedor-->  
<!--tercer contenedor pie de página-->
  <div class="container" id="sha">
    <div class="row">

      <div class="col-sm-1"></div>
        <div class="col-sm-10">
<!--aca se escribe el codigo-->  
        <br>



        <div class="row">
        <!--Texto del contenido-->
      <div class="col-sm-1"></div>
      <div class="col-sm-10">
        <h1 class="text-center text-primary">Descarga de documentos</h1>
        <br>
        <p class="lead text-justify">Análisis del cultivo de coca como motor de deforestación en el contexto del Desarrollo Alternativo y REDD+, en las Regiones de Amazonía y Catatumbo (2005-2014)</p>
                           
      </div>
      <div class="col-sm-1"></div>
    </div>
  <br>
  <div class="row">
  <!--Inicio seccion Informes-->
  <div class="col-xs-12">
    <hr>
    <h2 class="col-xs-10 text-center text-primary" style="text-align: left; padding-bottom: 20px ">Informes</h2>    
    <div class="col-xs-12 col-md-3">
      <img  src="assets/giz_map/images/Port_info_tecn.png" class="img-responsive">
    </div>
    <div class="col-xs-12 col-md-3" >
      <div class="input-group" style="vertical-align:middle;">
            <h4 class="text-center text-primary">Publicación</h4>
            <span class="">
              <a target="_blank" href="assets/giz_map/documentos/doc.pdf" class="glyphicon glyphicon-download-alt btn btn-primary" role="button"></a>
            </span>
          </div>
    </div>
    <div class="col-xs-12 col-md-3">
      <img  src="assets/giz_map/images/Port_info_tecn.png" class="img-responsive">                    
          
    </div>
    <div class="col-xs-12 col-md-3">
      <div class="input-group">
            <h4 class="text-center text-primary">Informe técnico</h4>
            <span>
              <a target="_blank" href="assets/giz_map/documentos/doc.pdf" class="glyphicon glyphicon-download-alt btn btn-primary" role="button"></a>
            </span>
          </div>
    </div>
  </div>
  <!--Fin seccion Informes-->
  <!--Inicio seccion Talleres FASE I-->
  <div class="col-xs-12" style="padding-bottom: 15px">
    <hr>
    <h2 class="col-xs-10 text-center text-primary" style="text-align: left; padding-bottom: 20px ">Talleres Regionales Fase I</h2>
    <div class="col-xs-12 col-md-3">
      <img  src="assets/giz_map/images/Port_taller1_Catatumbo.png" class="img-responsive">
    </div>
    <div class="col-xs-12 col-md-3" >
      <div class="input-group" style="vertical-align:middle;">
            <h4 class="text-center text-primary">Región Catatumbo</h4>
            <span class="">
              <a target="_blank" href="assets/giz_map/documentos/Taller Fase I - Norte de Santander.pdf" class="glyphicon glyphicon-download-alt btn btn-primary" role="button"></a>
            </span>
          </div>
    </div>
    <div class="col-xs-12 col-md-3">
      <img  src="assets/giz_map/images/Port_taller1_Putumayo.png" class="img-responsive">                    
          
    </div>
    <div class="col-xs-12 col-md-3">
      <div class="input-group">
            <h4 class="text-center text-primary">Región Putumayo</h4>
            <span>
              <a target="_blank" href="assets/giz_map/documentos/Taller Fase I - Putumayo.pdf" class="glyphicon glyphicon-download-alt btn btn-primary" role="button"></a>
            </span>
          </div>
    </div>    
  </div>
  <br><br>
  <div class="col-xs-12">    
    <div class="col-xs-12 col-md-3">
      <img  src="assets/giz_map/images/Port_taller1_Guaviare-Meta.png" class="img-responsive">
    </div>
    <div class="col-xs-12 col-md-3" >
      <div class="input-group" style="vertical-align:middle;">
            <h4 class="text-center text-primary">Región Meta-Guaviare</h4>
            <span class="">
              <a target="_blank" href="assets/giz_map/documentos/doc.pdf" class="glyphicon glyphicon-download-alt btn btn-primary" role="button"></a>
            </span>
          </div>
    </div>
    <div class="col-xs-12 col-md-3">
      <img  src="assets/giz_map/images/Port_taller1_Caqueta-Meta.png" class="img-responsive">                    
          
    </div>
    <div class="col-xs-12 col-md-3">
      <div class="input-group">
            <h4 class="text-center text-primary">Región Caquetá</h4>
            <span>
              <a target="_blank" href="assets/giz_map/documentos/Taller Fase I - Caquetá - Meta.pdf" class="glyphicon glyphicon-download-alt btn btn-primary" role="button"></a>
            </span>
          </div>
    </div>    
  </div>

  <!--Fin seccion Talleres FASE I-->
  <!--Inicio seccion Talleres FASE II-->
  <div class="col-xs-12" style="padding-bottom: 15px">
    <hr>
    <h2 class="col-xs-10 text-center text-primary" style="text-align: left; padding-bottom: 20px ">Talleres Regionales Fase II</h2>
    <div class="col-xs-12 col-md-3">
      <img  src="assets/giz_map/images/Port_taller2_Catatumbo.png" class="img-responsive">
    </div>
    <div class="col-xs-12 col-md-3" >
      <div class="input-group" style="vertical-align:middle;">
            <h4 class="text-center text-primary">Región Catatumbo</h4>
            <span class="">
              <a target="_blank" href="assets/giz_map/documentos/doc.pdf" class="glyphicon glyphicon-download-alt btn btn-primary" role="button"></a>
            </span>
          </div>
    </div>
    <div class="col-xs-12 col-md-3">
      <img  src="assets/giz_map/images/Port_taller2_Putumayo.png" class="img-responsive">                    
          
    </div>
    <div class="col-xs-12 col-md-3">
      <div class="input-group">
            <h4 class="text-center text-primary">Región Putumayo</h4>
            <span>
              <a target="_blank" href="assets/giz_map/documentos/doc.pdf" class="glyphicon glyphicon-download-alt btn btn-primary" role="button"></a>
            </span>
          </div>
    </div>    
  </div>
  
  <div class="col-xs-12" style="padding-bottom: 15px">    
    <div class="col-xs-12 col-md-3">
      <img  src="assets/giz_map/images/Port_taller2_Guaviare-Meta.png" class="img-responsive">
    </div>
    <div class="col-xs-12 col-md-3" >
      <div class="input-group" style="vertical-align:middle;">
            <h4 class="text-center text-primary">Región Meta-Guaviare</h4>
            <span class="">
              <a target="_blank" href="assets/giz_map/documentos/doc.pdf" class="glyphicon glyphicon-download-alt btn btn-primary" role="button"></a>
            </span>
          </div>
    </div>
    <div class="col-xs-12 col-md-3">
      <img  src="assets/giz_map/images/Port_taller2_Caqueta-Meta.png" class="img-responsive">                    
          
    </div>
    <div class="col-xs-12 col-md-3">
      <div class="input-group">
            <h4 class="text-center text-primary">Región Caquetá</h4>
            <span>
              <a target="_blank" href="assets/giz_map/documentos/doc.pdf" class="glyphicon glyphicon-download-alt btn btn-primary" role="button"></a>
            </span>
          </div>
    </div>    
  </div>

  <!--Fin seccion Talleres FASE II-->

      
    </div>
    <div class="col-sm-1"></div>    
  </div>





<!--fin de se escribe el codigo-->        
        </div>
      <div class="col-sm-1"></div>          
      
<!--fin del codigo-->    
    </div>
  </div>
<!--Fin del tercer contenedor--> 

<!--cuarto contenedor pie de página-->
<div class="container-fluid well" id="piedepagina">
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-9 col-lg-offset-3">
      <br />        
      <br />        
    </div>
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
          $( "#menugizdocu" ).addClass("active");          
          $( "#iniciomenupeq" ).html("<small> INICIO</small>");
          $( "#gizdocumenupeq" ).html("<strong>Documentos</strong>");          
          $( "#mensajeestatus" ).fadeOut(5000);     
      });
    
    </script>
</body>
</html>