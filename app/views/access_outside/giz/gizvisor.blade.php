<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
  <title>
			Cooperación GIZ-UNODC 
	</title>
	
	
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<script src="assets/js/jquery-1.11.3.min.js"></script>
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/dataTables.bootstrap.css">
  <link rel="stylesheet" type="text/css" href="assets/css/responsive.bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap-datepicker.css">
  <link rel="stylesheet" href="assets/fonts/font-awesome-4.6.3/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="assets/css/dataTables.bootstrap.css">
  <!-- Libreria y capas Leaflet-->
  <link rel="stylesheet" href="assets/giz_map/css/leaflet.css" />
  <script src="http://cdn.leafletjs.com/leaflet/v0.7.7/leaflet.js"></script>


  <link rel="stylesheet" href="assets/giz_map/css/styledLayerControl.css" />
  <script src="assets/giz_map/js/styledLayerControl.js"></script>
  <script src="https://code.highcharts.com/highcharts.js"></script>
  <script src="https://code.highcharts.com/modules/exporting.js"></script>
  <script src="assets/js/jquery.dataTables.min.js"></script>
  <!-- LLibreria No Slider -->
  <script src="assets/giz_map/nouislider/nouislider.js"></script>
  <link href="assets/giz_map/nouislider/nouislider.min.css" rel="stylesheet">
  <!-- Libreria para leer topojson -->
  <script src="http://d3js.org/topojson.v1.min.js"></script>

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
	
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/jquery.dataTables.min.js"></script>
	<script src="assets/js/dataTables.bootstrap.min.js"></script>
  <script src="assets/js/dataTables.responsive.min.js"></script>
	<script src="assets/js/bootstrap-datepicker.js"></script>
	<script src="assets/js/locales/bootstrap-datepicker.es.min.js" charset="UTF-8"></script>	

  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
  
</head>
<body>
<!--comienza la cabecera-->
<script type="text/javascript" charset="utf-8" src="assets/visor_acuerdo/js/colombia_line_mm.js"></script>
<script type="text/javascript" charset="utf-8" src="assets/giz_map/js/deptos.js"></script>
<script type="text/javascript" charset="utf-8" src="assets/giz_map/js/municipios.js"></script>
<script type="text/javascript" charset="utf-8" src="assets/giz_map/js/parques.js"></script>
<script type="text/javascript" charset="utf-8" src="assets/giz_map/js/resguardos.js"></script>
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
              
            </ul><!--fin de menu con submenu-->
          </div><!--/.navbar-collapse-->
        </div><!--/.container-fluid-->
      </nav>
    </div>
  </div>
</div>
<!--Fin del segundo contenedor-->  
<!--tercer contenedor pie de página-->        
<!--aca se escribe el codigo-->  

<div id="map">
  <!--Modal para municipios-->

  <div class="modal fade" id="featureModal-municipios" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" >
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h5 class="modal-title text-primary" id="feature-title-municipios"></h5>
        </div>
        <div class="modal-body" style="padding-bottom: 0px;" id="feature-info-municipios"></div>
        <div class="modal-footer">
        <div class="col-sm-6" align="center"><img src="assets/giz_map/images/Logo_Unodc.png" height="42" ></div><div align="center"><img src="assets/giz_map/images/Logo_GIZ.jpg" height="42"></div>        
        </div>                             
      </div>
    </div>
  </div>
  <!--Modal para parques-->  
  <div class="modal fade" id="featureModal-parques" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" >
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h5 class="modal-title text-primary" id="feature-title-parques"></h5>
        </div>
        <div class="modal-body" style="padding-bottom: 0px;" id="feature-info-parques"></div>
        <div class="modal-footer">
        <div class="col-sm-6" align="center"><img src="assets/giz_map/images/Logo_Unodc.png" height="42" ></div><div align="center"><img src="assets/giz_map/images/Logo_GIZ.jpg" height="42"></div>        
        </div>                             
      </div>
    </div>
  </div>
    <!--Modal para resguardos-->  
  <div class="modal fade" id="featureModal-resguardos" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" >
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h5 class="modal-title text-primary" id="feature-title-resguardos"></h5>
        </div>
        <div class="modal-body" style="padding-bottom: 0px;" id="feature-info-resguardos"></div>
        <div class="modal-footer">
        <div class="col-sm-6" align="center"><img src="assets/giz_map/images/Logo_Unodc.png" height="42" ></div><div align="center"><img src="assets/giz_map/images/Logo_GIZ.jpg" height="42"></div>        
        </div>                             
      </div>
    </div>
  </div>
      <!--Modal para query search-->  
  <div class="modal fade" id="featureModal-query" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" >
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title text-primary" id="feature-title-query">Bosque 2005 (ha) y afectación del bosque por coca (ha)</h4> 
        </div>
        <div class="modal-body" style="padding-bottom: 0px;" id="feature-info-query">
          <div>
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
              <li role="presentation" class="active"><a href="#departamento" aria-controls="home" role="tab" data-toggle="tab">Departamental</a></li>
              <li role="presentation"><a href="#municipio" aria-controls="municipio" role="tab" data-toggle="tab">Municipal</a></li>
              <li role="presentation"><a href="#parques" aria-controls="parques" id="parques_tab" role="tab" data-toggle="tab">Parques Nacionales</a></li>
              <li role="presentation"><a href="#resguardos" aria-controls="settings" id="resguardos_tab" role="tab" data-toggle="tab">Resguardos</a></li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
              <div role="tabpanel" class="tab-pane active" id="departamento">
                
                <div id="container"></div>
                
              </div>
              <div role="tabpanel" class="tab-pane" id="municipio"><h4>Departamento</h4>
                <select class="form-control" id="departamento_select">
                <option selected disabled>Seleccione un departamento</option>
                @foreach($Datos_arreglo[0] as $departamentos)
                <option>{{$departamentos->NOM_DPTO}}</option>
                @endforeach
                <option>Todos</option>   
                </select>
                <br><br>                
                <div id="container2"></div>    
              </div>
              <div role="tabpanel" class="tab-pane" id="parques"><div id="container3"></div></div>
              <div role="tabpanel" class="tab-pane" id="resguardos"><div id="container4"></div></div>
            </div>
          </div> 
        </div>
        <div class="modal-footer">
        <div class="col-sm-6" align="center"><img src="assets/giz_map/images/Logo_Unodc.png" height="42" ></div><div align="center"><img src="assets/giz_map/images/Logo_GIZ.jpg" height="42"></div>        
        </div>                             
      </div>
    </div>
  </div>
</div>
        
<!--fin de se escribe el codigo-->                  
      
<!--fin del codigo-->        
<!--Fin del tercer contenedor--> 
<!--Mapa -->  
<link href="assets/giz_map/css/giz_map.css" rel="stylesheet">
<script type="text/javascript" charset="utf-8" src="assets/giz_map/js/giz_map.js"></script>
<script type="text/javascript">
</script>>
<script type="text/javascript" charset="utf-8" src="assets/giz_map/js/grafica_departamento.js"></script>
<script type="text/javascript" charset="utf-8" src="assets/giz_map/js/grafica_municipio.js"></script>  
<script type="text/javascript" charset="utf-8" src="assets/giz_map/js/grafica_parques.js"></script>
<script type="text/javascript" charset="utf-8" src="assets/giz_map/js/grafica_resguardos.js"></script>  
<script>
      $(document).ready(function() {
                    
          //para que los menus pequeño y grande funcione
          $("#menugizvisor").addClass("active");          
          $("#iniciomenupeq").html("<small> INICIO</small>");
          $("#gizvisormenupeq").html("<strong>Visor Geográfico</strong>");          
          $("#mensajeestatus").fadeOut(5000);
          
          $("#departamento_select").change(function(){
            options=municipio.update();
            var chart = new Highcharts.Chart(options);            
          });

          $('#parques_tab').click(function (e) {
            options=parques.update();
            var chart = new Highcharts.Chart(options);            
          });

          $('#resguardos_tab').click(function (e) {
            res_tab(); 
          });

 
          $(function () {
            $('[data-toggle="tooltip"]').tooltip()
          });

          $(function () {
            $('[data-toggle="popover"]').popover({
               html: true,
               container: 'body'                
            });
          });
      });            
</script>

</body>
</html>