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
        <!--Empieza cariusel de imagenes-->  
            
     
      <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <h2 class="text-center text-primary">Análisis del cultivo de coca como motor de deforestación en el contexto del Desarrollo Alternativo y REDD+, en las Regiones de Amazonía y Catatumbo (2005-2014)</h2>
        <br>
        <ol class="carousel-indicators">
        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
        <li data-target="#carousel-example-generic" data-slide-to="1"></li>
        <li data-target="#carousel-example-generic" data-slide-to="2"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner">
          <div class="item active">
              <img src="assets/giz_map/images/Foto_2.jpg" alt="Gmail en todo tipo de dispositivos">
            <div class="carousel-caption">
             
            </div>
          </div>
          <div class="item">
            <img src="assets/giz_map/images/Foto_4.jpg" alt="Mensajes por tipo para organizarte mejor">
            <div class="carousel-caption">
             
            </div>
          </div>
          <div class="item">
            <img src="assets/giz_map/images/Foto_3.jpg" alt="chatea con un compañero o llama por teléfono">
            <div class="carousel-caption"></div>
          </div>    
        </div>  
      </div>
    
        <!--Empieza cariusel de imagenes-->

        <br>
        <p class="lead text-justify" >
          La GIZ, por encargo del Ministerio Federal de Cooperación Económica y Desarrollo de Alemania – BMZ – apoya a Colombia en el área medioambiental, el proceso hacia la paz, la igualdad social y el desarrollo sostenible; además apoya los proyectos de las contrapartes colombianas en tres áreas prioritarias: i) Desarrollo de la paz, prevención de crisis. Fomento de medidas para el Estado de derecho, justicia transicional, fomento de la paz y prevención de la violencia; ii) Política ambiental, protección y uso sostenible de los recursos naturales. Fomento de medidas de protección y uso racional de recursos naturales, para la prevención de desastres naturales y la adaptación al cambio climático; y iii) Fomento sostenible de la economía.
        </p>

        <p class="lead text-justify" >
          El Programa Global de Políticas de Drogas y Desarrollo – PGPDD, tiene como objetivo promover la implementación de enfoques orientados hacia el desarrollo y la salud pública junto con gobiernos y organizaciones internacionales interesadas. A través de este programa, se busca promover el diálogo internacional acerca de la política de drogas y promover la asesoría técnica para adaptar políticas de drogas en los países interesados. El programa se implementa en estrecha cooperación con varios socios, entre los que se encuentra, a nivel global, la Oficina de las Naciones Unidas contra la Droga y el Delito – UNODC. En Colombia, uno de los países enfoque del PGPDD, se implementan actividades en conjunto con el programa REDD+ de la GIZ dentro del enfoque medioambiental.
        </p>
        <p class="lead text-justify" >
          UNODC trabaja con los Estados y la sociedad civil para prevenir que las drogas y el delito amenacen la seguridad, la paz y las oportunidades de desarrollo de los ciudadanos. Desde hace 20 años, UNODC viene apoyando al Gobierno Colombiano en la implementación y en el monitoreo de diferentes estrategias de Desarrollo Alternativo - DA. Durante este tiempo, se han identificado lecciones y prácticas ambientalmente sostenibles que han permitido a las comunidades rurales desvincularse de la economía de los cultivos ilícitos, ingresar a la cultura de la legalidad y reducir el impacto sobre la pérdida de bosque en Colombia.
        </p>
        <p class="lead text-justify" >
          En el marco de la cooperación actual de apoyo a GIZ para la implementación de proyectos REDD+ y del PGPDD en Colombia, se firmó el 30 de junio de 2015 un Grant Agreement, con el  propósito de identificar y evaluar la asociación entre los cultivos ilícitos y deforestación, en la región del Amazonas Colombiano y Catatumbo en la última década (2005-2014).
        </p>
        <p class="lead text-justify" >
          El proyecto tiene como objetivo general la caracterización y análisis de la dinámica de la deforestación y degradación del bosque por causa de los cultivos de coca. Lo anterior con el fin de generar aportes para los Programas de Desarrollo Alternativo – PDA – enfocados a  lograr la mitigación de la  deforestación y degradación del bosque en el marco de proyectos REDD+.
        </p>
        <p class="lead text-justify" >
          Los principales objetivos rectores que orientan el estudio se sintetizan en: la identificación de los factores de deforestación asociados con los cultivos de coca, análisis y proyección mediante un modelo espacio-temporal, el comportamiento de la deforestación directa por causa de los cultivos de coca, formulación de recomendaciones para implementar en el marco del PDA con el fin de mitigar los motores de deforestación asociados con cultivos ilícitos en el marco de proyectos REDD+ y finalmente elaborar una plataforma web para la visualización el comportamiento de la deforestación asociada al cultivo de coca.
        </p>
        <p class="lead text-justify" >
          Para lograr lo anterior, y gracias al trabajo conjunto entre UNODC y GIZ, se realizaron entre los meses de enero y octubre de 2016 diversos procesos de concertación con entidades como el Instituto de Hidrología, Meteorología y Estudios Ambientales (IDEAM), Ministerio de Ambiente y Desarrollo Sostenible (MADS), Instituto Amazónico de Investigación Científica (SINCHI), entre otros; además, se adelantaron procesos de recolección de información primaria y secundaria a través de metodologías participativas, y de análisis cualitativo y cuantitativo. A través de estas herramientas se inició la construcción de la caracterización y análisis de la afectación del bosque por causa de los cultivos de coca.
        </p>       
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
          $( "#menugizestudio" ).addClass("active");          
          $( "#iniciomenupeq" ).html("<small> INICIO</small>");
          $( "#gizestudiomenupeq" ).html("<strong>Estudio</strong>");          
          $( "#mensajeestatus" ).fadeOut(5000);     
      });
    
    </script>
</body>
</html>