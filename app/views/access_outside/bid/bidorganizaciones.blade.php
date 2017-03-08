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
      height: 550px ;
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
    <div class="col-xs-10 col-sm-7 text-center">        
        <img src="assets/img/logos2.png" width="70%">        
    </div>
    <div class="col-sm-1 hidden-xs"></div>
    <div class="col-sm-2 text-center">
      <ul class="nav nav-pills ">
        
      </ul>
    </div>
    <div class="col-sm-1 hidden-xs"></div>
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
        <li id="" role="menu"><a href="" class="enlace-menu">Organizaciones</a></li>
        <li id="" role="menu"><a href="" class="enlace-menu">Nuevos Productos</a></li>
        <li id="" role="menu"><a href="" class="enlace-menu">Líneas Productivas</a></li>
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
              <li id="menuprincipal" role="menu"><a href="principal">INICIO</a></li>
              <li id="" role="menu"><a href="" class="enlace-menu">Organizaciones</a></li>
              <li id="" role="menu"><a href="" class="enlace-menu">Nuevos Productos</a></li>
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
        <h1>Nuestras Actividades</h1>
          <div class="col-xs-12 col-md-4">
            <div class="info">
              <img class="foto" src="assets/bid/img/a1.jpg">
              <h2>Capacitación en gestión financiera y contable</h2>
              <p style="font-size: 20px">Proyectos, créditos, BPA, asociatividad, liderazgo, paneación estratégica y rueda financiera</p>
            </div>            
          </div>
          <div class="col-xs-12 col-md-4" >
            <div class="info">
              <img class="foto" src="assets/bid/img/a2.jpg">
              <h2>Realización de alianzas productivas</h2>
              <p style="font-size: 20px">La organización ASOVICA se encuentra desarrollando un proceso de gestión en Europa para la búsqueda de nuevos…</p>
            </div>
          </div>
          <div class="col-xs-12 col-md-4">
            <div class="info">
              <img class="foto" src="assets/bid/img/a3.jpg">
              <h2>Documentos en el marco del proyecto DEL</h2>
              <p style="font-size: 20px">Informes de Seguimiento, planes de inversión, presentaciones para capacitaciones, informes trimestrales…</p>
            </div>
          </div>
          <div class="col-xs-12 col-md-4">
            <div class="info">
              <img class="foto" src="assets/bid/img/a4.jpg">
              <h2>Capacitación en Asociatividad – ASCABIA</h2>
              <p style="font-size: 20px">En pasados días realizamos la capacitación en Asociatividad, liderazgo, gobernanza y planeación estratégica con la…</p>
            </div>
          </div>
          <div class="col-xs-12 col-md-4">
            <div class="info">
              <img class="foto" src="assets/bid/img/a5.jpg">
              <h2>Visitas técnicas Verificación BPA</h2>
              <p style="font-size: 20px">Se realizaron talleres de sensibilización en el módulo de Buenas Prácticas Agrícolas (BPA) para la socialización…</p>
            </div>
          </div>
        </div>
        <div class="col-xs-12">
        <br><br>
        <hr>
        <h1>Nuestras Noticias DA</h1>
          <div class="col-xs-12 col-md-4">
            <div class="info">
              <img class="foto" src="assets/bid/noticias/avance-cacao.jpg">
              <h2>Así avanza la sustitución de cultivo de coca por cacao en el Vichada</h2>
              <p style="font-size: 20px">Cultivos productivos, legales y de alta comercialización, ahora son sembradas por sus habitantes, en un trabajo…</p>
            </div>            
          </div>
          <div class="col-xs-12 col-md-4" >
            <div class="info">
              <img class="foto" src="assets/bid/noticias/antioquia-N.jpg">
              <h2>Reconocen buen avance en sustitución de cultivos ilícitos en Antioquia</h2>
              <p style="font-size: 20px">Las autoridades estiman que en Antioquia hay de 9 a 10 mil familias que viven de los cultivos ilícitos.</p>
            </div>
          </div>
          <div class="col-xs-12 col-md-4">
            <div class="info">
              <img class="foto" src="assets/bid/noticias/n3.jpg">
              <h2>El posconflicto y su nuevo desafío: la deforestación</h2>
              <p style="font-size: 20px">En el pequeño municipio de El Retorno, Guaviare, arrasaron, en los últimos tres meses, con cerca de 400 hectáreas…</p>
            </div>
          </div>
          <div class="col-xs-12 col-md-4">
            <div class="info">
              <img class="foto" src="assets/bid/noticias/n2.jpg">
              <h2>Colombia recibirá crédito del BID por US$100 millones para posconflicto</h2>
              <p style="font-size: 20px">El crédito hace parte de los recursos del Fondo Colombia Sostenible, que será administrado por el multilateral y…</p>
            </div>
          </div>
          <div class="col-xs-12 col-md-4">
            <div class="info">
              <img class="foto" src="assets/bid/noticias/n1.jpg">
              <h2>Gobierno adelanta acuerdos con 39.000 familias</h2>
              <p style="font-size: 20px">Para la sustitución de cultivos ilícitos Permitirán erradicar más de 35.000 hectáreas de coca en Colombia. La meta es llegar a 100.000 en 2017.</p>
            </div>
          </div>
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
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-9 col-lg-offset-3">
      <br />        
      <br />
      <div class="col-xs-12" style="padding-top: 65px; background-image: url('assets/bid/img/regla.jpg');height: 150px; color: white; text-align: center;">      
      </div>        
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
          $( "#menugizdatrelev" ).addClass("active");          
          $( "#iniciomenupeq" ).html("<small> INICIO</small>");
          $( "#gizdatrelevmenupeq" ).html("<strong>Datos Relevantes</strong>");          
          $( "#mensajeestatus" ).fadeOut(5000);          
      });
    
    </script>
</body>
</html>