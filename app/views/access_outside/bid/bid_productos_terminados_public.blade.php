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
    <div class="row" >
      <div class="col-sm-1"></div>
      <div class="col-xs-12 col-sm-10">
        <br><br>
        <div class="col-xs-12">
          <div class="radio col-xs-4 col-md-3" >
            <label style="width: 100%" >
              <input style="width: 100%" class="btn btn-default" type="button" name="optionsRadios" id="optionsRadios1" value="All" checked="true" onclick="filtro(this)">
            </label>
          </div>
          <div class="radio col-xs-4 col-md-3">
            <label style="width: 100%" >
              <input style="width: 100%"  class="btn btn-default" type="button" name="optionsRadios" id="optionsRadios2" value="Café" onclick="filtro(this)">
            </label>
          </div>
          <div class="radio col-xs-4 col-md-3">
            <label style="width: 100%" >
              <input style="width: 100%"  class="btn btn-default" type="button" name="optionsRadios" id="optionsRadios3" value="Chocolate" onclick="filtro(this)">
            </label>
          </div>
          <div class="radio col-xs-4 col-md-3">
            <label style="width: 100%" >
              <input style="width: 100%"  class="btn btn-default" type="button" name="optionsRadios" id="optionsRadios4" value="Condimentos" onclick="filtro(this)">
            </label>
          </div>
          <div class="radio col-xs-4 col-md-3">
            <label style="width: 100%" >
              <input style="width: 100%"  class="btn btn-default" type="button" name="optionsRadios" id="optionsRadios5" value="Miel" onclick="filtro(this)">
            </label>
          </div>
          <div class="radio col-xs-4 col-md-3">
            <label style="width: 100%" >
              <input style="width: 100%"  class="btn btn-default" type="button" name="optionsRadios" id="optionsRadios5" value="Otros" onclick="filtro(this)">
            </label>
          </div>
        </div>
        <script type="text/javascript">
          function filtro(e){
            if (e.value=="Café"){
              $('.cafe').css('display','block')
              $('.chocolate').css('display','none')
              $('.condimentos').css('display','none')
              $('.miel').css('display','none')
              $('.otros').css('display','none')
            } else if (e.value=="Chocolate"){
              $('.cafe').css('display','none')
              $('.chocolate').css('display','block')
              $('.condimentos').css('display','none')
              $('.miel').css('display','none')
              $('.otros').css('display','none')
            } else if (e.value=="Condimentos"){
              $('.cafe').css('display','none')
              $('.chocolate').css('display','none')
              $('.condimentos').css('display','block')
              $('.miel').css('display','none')
              $('.otros').css('display','none')
            } else if (e.value=="Miel"){
              $('.cafe').css('display','none')
              $('.chocolate').css('display','none')
              $('.condimentos').css('display','none')
              $('.miel').css('display','block')
              $('.otros').css('display','none')
            } else if (e.value=="Otros"){
              $('.cafe').css('display','none')
              $('.chocolate').css('display','none')
              $('.condimentos').css('display','none')
              $('.miel').css('display','none')
              $('.otros').css('display','block')
            } else {
              $('.cafe').css('display','block')
              $('.chocolate').css('display','block')
              $('.condimentos').css('display','block')
              $('.miel').css('display','block')
              $('.otros').css('display','block')
            }
          }
        </script>
        <div id="polen" class="otros col-xs-6 col-md-3" style="display: block; padding: 10px">
          <img class="foto" src="assets/bid/productos_terminados/polen.jpg" style="">
        </div>
        <div id="polen" class="chocolate col-xs-6 col-md-3" style="display: block; padding: 10px">
          <img class="foto" src="assets/bid/productos_terminados/chocolatina-arauca.jpg" style="">
        </div>
        <div id="polen" class="cafe col-xs-6 col-md-3" style="display: block; padding: 10px">
          <img class="foto" src="assets/bid/productos_terminados/cafe-kogi-1.jpg" style="">
        </div>
        <div id="polen" class="condimentos col-xs-6 col-md-3" style="display: block; padding: 10px">
          <img class="foto" src="assets/bid/productos_terminados/sazonadores-asapiv2.jpg" style="">
        </div>
        <div id="polen" class="cafe col-xs-6 col-md-3" style="display: block; padding: 10px">
          <img class="foto" src="assets/bid/productos_terminados/cafe-opicafe.jpg" style="">
        </div>
        <div id="polen" class="miel col-xs-6 col-md-3" style="display: block; padding: 10px">
          <img class="foto" src="assets/bid/productos_terminados/miel-campanilla.jpg" style="">
        </div>


        
      </div>
      <div class="col-sm-1"></div>
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
          $( "#productos_terminados" ).addClass("active");          
          $( "#iniciomenupeq" ).html("<small> INICIO</small>");
          $( "#gizdatrelevmenupeq" ).html("<strong>Datos Relevantes</strong>");          
          $( "#mensajeestatus" ).fadeOut(5000);

          @include('access_outside.bid.include_organizaciones_menu')

                 
      });
      

    </script>
</body>
</html>