<!DOCTYPE html>
<!-- saved from url=(0042)https://getbootstrap.com/examples/navbar/# -->
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" href="assets/fonts/font-awesome-4.6.3/css/font-awesome.min.css">

    <title>Visor Acuerdo</title>
    <!-- j-Query -->
    <script type="text/javascript" src="assets/visor_acuerdo/js/jquery.min.js"></script>    

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="assets/visor_acuerdo/css/Navbar Template for Bootstrap_files/ie10-viewport-bug-workaround.css" rel="stylesheet">    

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <!--<script src="css/Navbar Template for Bootstrap_files/ie-emulation-modes-warning.js"></script>-->

    <!-- Libreria y capas Leaflet-->
    <link rel="stylesheet" href="assets/visor_acuerdo/css/leaflet.css" />
    <script src="http://cdn.leafletjs.com/leaflet/v0.7.7/leaflet.js"></script>
    
    <link rel="stylesheet" href="assets/visor_acuerdo/css/styledLayerControl.css" />
    <script src="assets/visor_acuerdo/js/styledLayerControl.js"></script>
    <script src="assets/visor_acuerdo/js/L.Control.MousePosition.js"></script> 
    <!-- Cargar librerias de labels -->    
    
    <link rel="stylesheet" href="assets/visor_acuerdo/Leaflet_label_master/dist/leaflet.label.css" />
    <script src="assets/visor_acuerdo/Leaflet_label_master/src/Label.js"></script>
    <script src="assets/visor_acuerdo/Leaflet_label_master/src/BaseMarkerMethods.js"></script> 
    <script src="assets/visor_acuerdo/Leaflet_label_master/src/Marker.Label.js"></script> 
    <script src="assets/visor_acuerdo/Leaflet_label_master/src/CircleMarker.Label.js"></script> 
    <script src="assets/visor_acuerdo/Leaflet_label_master/src/Path.Label.js"></script> 
    <script src="assets/visor_acuerdo/Leaflet_label_master/src/Map.Label.js"></script>
    <script src="assets/visor_acuerdo/Leaflet_label_master/src/FeatureGroup.Label.js"></script>     
    
    <!-- Bootstrap core CSS -->
    <link href="assets/visor_acuerdo/css/bootstrap.min.css" rel="stylesheet">

  <!-- Estilos personalizados CSS -->  
    <link rel="stylesheet" href="assets/visor_acuerdo/css/map_styles.css"/>

  </head>

  <body data-pinterest-extension-installed="cr1.40">
  <!-- Capas --> 
   <script type="text/javascript" charset="utf-8" src="assets/visor_acuerdo/capas/municipios.js"></script>
   <script type="text/javascript" charset="utf-8" src="assets/visor_acuerdo/js/Municipios_coca_gme.js"></script>  
  <script type="text/javascript" charset="utf-8" src="assets/visor_acuerdo/js/zvnt.js"></script>
  <script type="text/javascript" charset="utf-8" src="assets/visor_acuerdo/js/Campamento.js"></script>
  <script type="text/javascript" charset="utf-8" src="assets/visor_acuerdo/js/oficinas_unodc.js"></script>
  <script type="text/javascript" charset="utf-8" src="assets/visor_acuerdo/js/otras_agencias.js"></script>   
  <script type="text/javascript" charset="utf-8" src="assets/visor_acuerdo/js/colombia_line_mm.js"></script>    
    <div>
      <!-- Static navbar -->    
      <nav class="navbar navbar-default navbar-fixed-top" style="margin-bottom: 0px">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand"><img src="assets/visor_acuerdo/images/Logo_UNODC.png" height="160%"></a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav" role="tablist">
              <li role="presentation" class="active"><a href="#acuerdo" id="link1" aria-controls="acuerdo" role="tab" data-toggle="tab" id="link1"><i class="fa fa-file" aria-hidden="true"></i> El Acuerdo </a></li>
              <li role="presentation"><a href="#da" id="link2" aria-controls="da" role="tab" data-toggle="tab" id="link2"><i class="fa fa-users" aria-hidden="true"></i> Desarrollo Alternativo</a></li>
              <li role="presentation"><a href="#ci" aria-controls="ci" role="tab" data-toggle="tab" id="link3"><i class="fa fa-envira"  aria-hidden="true"></i> Cultivos ilícitos</a></li>
              <li role="presentation"><a href="#nu" id="link4" aria-controls="nu" role="tab" data-toggle="tab"><i class="fa fa-globe" aria-hidden="true"></i> Naciones Unidas</a></li>
              
            </ul>
            <ul class="nav navbar-nav navbar-right">
              
            </ul>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>

      <!-- Main component for a primary marketing message or call to action -->
      <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="acuerdo">
          <div id="acuerdo_map">           
          </div>
        </div>
        <div role="tabpanel" class="tab-pane" id="da" >
          <div style="padding-right: 0px; padding-left: 0px">
            <div id="da_map">
  
              <div class="modal fade bs-example-modal-sm" id="featureModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" >
                <div class="modal-dialog modal-sm" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h5 class="modal-title text-primary" id="feature-title"></h5>
                    </div>
                    <div class="modal-body" style="padding-bottom: 0px;" id="feature-info"></div>                 
                      <div id="grafica_da" style="padding-right: 0px; padding-left: 0px" align="center"></div>   
                  </div>
                </div>
              </div>
              
            </div>
          </div>          
        </div>
        

        <div role="tabpanel" class="tab-pane" id="ci">
            <div style="padding-right: 0px; padding-left: 0px">
                <div id="ci_map">

                    <div class="modal fade bs-example-modal-sm" id="featureModal-ci" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" >
                    <div class="modal-dialog modal-sm" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <h5 class="modal-title text-primary" id="feature-title-ci"></h5>
                        </div>
                        <div class="modal-body" style="padding-bottom: 0px;" id="feature-info-ci"></div>                 
                          <div id="grafica_ci" style="padding-right: 0px; padding-left: 0px" align="center"></div>
                      </div>
                    </div>
                  </div>

                </div>                  
            </div>          
        </div>
        <div role="tabpanel" class="tab-pane" id="nu">
          <div id="nu_map">

          </div>
          
        </div>
      </div>
     

      <!--<div id="map"></div>-->

      
    </div> <!-- /container -->    

    <!-- Bootstrap core JavaScript
    ================================================== -->
    

    <!--Mapa Acuerdo-->
    <script>
    $(document).ready(function(){
      var ini=0;
      var ini_2=0;
      var ini_3=0;
      acuerdo_map();
      $('#link3').click(function (e) {        
        //$("#da_map").empty();
        //$("#acuerdo_map").empty(); 
        if (ini==0) {
          ini=1;  
          ci_map();  
        };
        
        //e.preventDefault()
        $(this).tab('show')
      });
      $('#link2').click(function (e) {        
        //$("#ci_map").empty();
        //$("#acuerdo_map").empty();
        if (ini_2==0) { 
        ini_2=1;
        da_map();
      };
        //e.preventDefault()
        $(this).tab('show')
      });
      $('#link4').click(function (e) {        
        //$("#da_map").empty();
        //$("#acuerdo_map").empty(); 
        if (ini_3==0) {
          ini_3=1;  
          nu_map();  
        };
        
        //e.preventDefault()
        $(this).tab('show')
      });
 
    });


    </script> 
    <link href="assets/visor_acuerdo/css/story_map.css" rel="stylesheet"> 
    <script type="text/javascript" charset="utf-8" src="assets/visor_acuerdo/js/acuerdo_map.js"></script>
    <!--Cultivos Ilícitos-->
    <link href="assets/visor_acuerdo/css/ci_map.css" rel="stylesheet">
    <script type="text/javascript" charset="utf-8" src="assets/visor_acuerdo/js/ci_map.js"></script>
    <!--Mapa Desarrollo Alternativo-->  
    <link href="assets/visor_acuerdo/css/da_map.css" rel="stylesheet">
    <script type="text/javascript" charset="utf-8" src="assets/visor_acuerdo/js/da_map.js"></script>
    <!--Mapa Naciones Unidas-->  
    <link href="assets/visor_acuerdo/css/nu_map.css" rel="stylesheet">
    <script type="text/javascript" charset="utf-8" src="assets/visor_acuerdo/js/nu_map.js"></script>
    


    <!-- Placed at the end of the document so the pages load faster -->
    <script src="assets/visor_acuerdo/css/Navbar Template for Bootstrap_files/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="assets/visor_acuerdo/css/Navbar Template for Bootstrap_files/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="assets/visor_acuerdo/css/Navbar Template for Bootstrap_files/ie10-viewport-bug-workaround.js"></script>
    
    <script src="assets/visor_acuerdo/highcharts/js/highcharts.js"></script>
    
    <script src="assets/visor_acuerdo/highcharts/js/modules/exporting.js"></script>
    <script src="assets/visor_acuerdo/highcharts/js/modules/export_csv.js"></script>

    <!--Eventos del visor-->
    <script type="text/javascript" src="assets/visor_acuerdo/js/grafica_da_v2.js"></script>
    <script type="text/javascript" src="assets/visor_acuerdo/js/grafica_ci.js"></script>



</body></html>