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
  <script src="assets/js/highcharts/highcharts.js"></script>
  
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

      <div class="carousel-inner" style="height: 250px; width: 100%;display: table; color: white;font-size: 25px;text-align: center;background-image: url(assets/bid/lineas_productivas/banner-default.jpg); background-repeat: no-repeat;">        
        <div style="display: table-cell; vertical-align: middle; background-image: url(assets/bid/lineas_productivas/<?php echo  str_replace('"','',(json_encode($array[3][0] -> id_lipex))); ?>.jpg); background-repeat: no-repeat;">
          <?php echo  str_replace('"','',(json_encode($array[3][0] -> nombre,JSON_UNESCAPED_UNICODE))); ?>
        </div>
      </div>
      <div class="col-xs-12">
      <!--Inicia el contenido-->
      <br><br>
      <div class="col-xs-12 col-md-3">
        <div class="col-xs-12" style="background-color: #f2f2f2;text-align: center">
          <h4>Precio Promedio Nacional</h4>
          <h1 style="color: #2991d6">$15.000</h1>
        </div>
        <div class="col-xs-12" style="height: 20px"></div>
        <h4>Eventos de <?php echo  str_replace('"','',(json_encode($array[3][0] -> nombre,JSON_UNESCAPED_UNICODE))); ?></h4>
        <img class="foto" src="assets/bid/img/agenda.png" style="width: 100%;">      
      </div>
      <div class="col-xs-12 col-md-9">
        <div>
          <!-- Nav tabs -->
          <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#paises" aria-controls="paises" role="tab" data-toggle="tab">Países</a></li>
            <li role="presentation"><a href="#organizaciones" aria-controls="organizaciones" role="tab" data-toggle="tab">Organizaciones</a></li>
          </ul>
          <!-- Tab panes -->
          <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="paises">
                <div id="country_chart"> </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="organizaciones">
                <br><br>
                @foreach($array[4] as $pro)
                  <div class="col-xs-12 - col-sm-6 col-md-3"> 
                      <h4 style="margin-bottom: 0px">{{$pro->NOM_DPTO}}</h4>
                      <hr style="margin-top: 0px">
                      <ul>
                        @foreach($array[5] as $pro2)
                          @if($pro->cod_depto == $pro2->cod_depto)
                            <li>{{$pro2->acronim}}</li>
                          @endif
                        @endforeach
                      </ul>      
                  </div>
                @endforeach
            </div>
          </div>
        </div>
      </div>
      <!--Fin el contenido-->
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
          $( "#lineas_productivas" ).addClass("active");          
          $( "#lineas_productivas_menupeq" ).html("<small> INICIO</small>");
          $( "#gizdatrelevmenupeq" ).html("<strong>Datos Relevantes</strong>");          
          $( "#mensajeestatus" ).fadeOut(5000);
          $('.dropdown-submenu a.test').on("mouseover", function(e){
            $('.submenu').css('display','none');
            var submenu='#submenu_'+this.name;
            $(submenu).empty();
            var cod=this.name;
            organizaciones=[{{$array[1]}}];
            organizaciones_query=[];
            for (var i =0; i<organizaciones[0].length; i++){
              var position=organizaciones_query.length;
              if (organizaciones[0][i].cod_depto==cod){
                organizaciones_query[position]=organizaciones[0][i].acronim;
                $(submenu).append("<li><a tabindex='-1' href='bid_public_organizacion?id="+organizaciones[0][i].nit+"' name='"+organizaciones[0][i].nit+"''>"+organizaciones[0][i].acronim+"</a></li>")
              }              
            }
            $(this).next('ul').toggle();
            e.stopPropagation();
            e.preventDefault();
          });
          
          Highcharts.chart('country_chart', {
          title: {
              text: 'Principales países de destino en las exportación de <?php echo  str_replace('"','',(json_encode($array[3][0] -> nombre,JSON_UNESCAPED_UNICODE))); ?>'
          },

          subtitle: {
              text: 'Listado de los cinco principales países de destino por año'
          },

          yAxis: {
              title: {
                  text: 'Number of Employees'
              }
          },
          legend: {
              layout: 'vertical',
              align: 'right',
              verticalAlign: 'middle'
          },

          plotOptions: {
              series: {
                  pointStart: 2010
              }
          },

          series: [{
              name: 'Estados Unidos',
              data: [43934, 52503, 57177, 69658, 97031, 119931, 137133, 154175]
          }, {
              name: 'Japón',
              data: [24916, 24064, 29742, 29851, 32490, 30282, 38121, 40434]
          }, {
              name: 'Bélgica',
              data: [11744, 17722, 16005, 19771, 20185, 24377, 32147, 39387]
          }, {
              name: 'Canada',
              data: [null, null, 7988, 12169, 15112, 22452, 34400, 34227]
          }, {
              name: 'Brazil',
              data: [12908, 5948, 8105, 11248, 8989, 11816, 18274, 18111]
          }]

      });

            
      });
</script>
</body>
</html>