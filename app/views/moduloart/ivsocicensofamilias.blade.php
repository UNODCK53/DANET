@if(Auth::check())<!--muestra el contenido de la página si esta autenticado-->
 <!--agrega la pagina maestra-->
@extends('layouts.master')
<!--agrega seccion titulo por si se quiere cambiar el titulo de la pestaña-->
@section('titulo')
  @parent
@stop
 <!--agrega los estilos de la pagina y los meta-->
@section('cabecera')
  @parent

@stop
<!--agrega JavaScript dentro del header a la pagina-->
@section('js')    
  @parent
@stop 
<!--agrega script de cabecera y no de cuerpo si se necesitan-->
@section('scripthead')
  @parent
@stop 
<!--agrega el Primer Contenerdor  de logo y cabecera el boton de inicio se agrega por aca-->
@section('contenidocabecera1')
  @parent
@stop
<!--agrega el menu a la pagina-->
@section('menu1')
<!--Segundo contenedor menu secundario-->
  @parent
<!--Fin del segundo contenedor-->   
@stop
<!--CONTENEDOR GENERAL-->
@section('contenedorgeneral1')
  @parent  
<!--tercer contenedor pie de página-->
  <div class="container" id="sha">
    <div class="row">
<!--aca se escribe el codigo-->
    <h2 class="text-center text-primary">Censo de familias</h2>
	<br><br>
    <div class="col-sm-1"></div>
    <div class="col-sm-10">
      <b class="lead text-justify">Reporte de sincronización de encuestas de diagnóstioco de hogar y Anexo de Tierras   </b>
      <a class="glyphicon glyphicon-download-alt btn btn-success" title="Descarque el archvio del Criterio" href="\art\Rep_encuestas.pdf" target="_blank"></a>
    </div>
    <div class="col-sm-1"></div>
	<br><br><hr>
  <h3 class="text-center text-primary">Resultados detalaldos de recolección de encuestas digitales</h3>
  <br>
  <div class="row"> 
    <div class="col-sm-1"></div> 
    <div class="col-sm-2">
        <label id="labelindicador" for="Proceso" class="control-label">Tipo de Indicadores:</label>
    </div> 
    <div class="col-sm-2">
          <input type="radio" name="indicador" id="indicador1" value="1" required>General
    </div> 
    <div class="col-sm-1"></div> 
    <div class="col-sm-2">
          <input type="radio"  name="indicador" id="indicador2" value="2" required>Por Usuario
    </div> 
    <div class="col-sm-1"></div> 
  </div> 
  <br>
  <div class="row" id="General" style="display:none;">       
    
    <div class="col-sm-1"></div>   
    <div class="col-sm-3" id="General-depto"style="display:none;">
        <label id="labeldpto" for="Proceso" class="control-label">Departamento:</label>
        <select id="seldpto" class="form-control" name="seldpto">
          <option value="" selected="selected">Por favor seleccione</option>
<?php 
          function sortByOrder($a, $b) {
    return $a['order'] - $b['order'];
}

usort($depto[0], 'sortByOrder');?>


          <script>console.log(<?php print_r(sort($depto[0])); ?>)</script>
          <script>console.log(<?php print_r($depto[0]);?>)</script>
          <?php 
          sort($depto[0]);
          for ($i=0; $i <count($depto[0]) ; $i++) { ?>
           <option value=<?php echo $depto[1][$i]?>><?php echo $depto[0][$i]?></option>
          <?php } ?>
        </select>
    </div>  
    <div class="col-sm-3" id="General-mpio"style="display:none;">
        <label id="labelmpio" for="Proceso" class="control-label">Municipio:</label>
        <select id="selmpio" class="form-control" name="selmpio">
        </select>
    </div>
    <div class="col-sm-3" id="General-vda"style="display:none;">
        <label id="labelvda" for="Proceso" class="control-label">Vereda:</label>
        <select id="selvda" class="form-control" name="selvda">
        </select>
    </div> 
    <div class="col-sm-1"></div>
  </div>

  <div class="row" id="Usuario" style="display:none;">       
      <div class="col-sm-1"></div>
      <div class="col-sm-3" id="Usuario-usuar"style="display:none;">
        <label id="labelmonitor" for="Proceso" class="control-label">Usuario:</label>
        <select id="selmonitor" class="form-control" name="selmonitor">
            <option value="" selected="selected">Por favor seleccione</option>
        </select>
      </div>
      <div class="col-sm-2" id="Usuario-depto"style="display:none;">
          <label id="labeldptomoni" for="Proceso" class="control-label">Departamento:</label>
          <select id="seldptomoni" class="form-control" name="seldptomoni">
          </select>
      </div> 
      <div class="col-sm-2" id="Usuario-mpio"style="display:none;">
          <label id="labelmpiomoni" for="Proceso" class="control-label">Municipio:</label>
          <select id="selmpiomoni" class="form-control" name="selmpiomoni">
          </select>
      </div>  
      <div class="col-sm-3" id="Usuario-vda"style="display:none;">
          <label id="labelvdamoni" for="Proceso" class="control-label">Vereda:</label>
          <select id="selvdamoni" class="form-control" name="selvdamoni">
          </select>
      </div>  
      <div class="col-sm-1"></div>  
  </div> 
  <br><br>
  <div class="col-sm-12">
    <div id="container" class="col-sm-7"></div>
    <div class="col-sm-1"></div>
    <div id="map" class="col-sm-4"></div>
  </div>
<!--fin del codigo-->    
    </div>
  </div>

<!--Fin del tercer contenedor--> 

@stop
<!--Cierra el CONTENEDOR GENERAL-->
@section('contenedorgeneral2')
  @parent
@stop

<!--el pie de pagina o barra gris de abajo-->
@section('piedepagina')
  @parent

@stop

<!--agrega JavaScript dentro del body a la pagina-->
@section('jsbody')
  @parent
  <script src="assets/js/highcharts/highcharts.js"></script>
    <script>
      $(document).ready(function() {          
          //para que los menus pequeño y grande funcione
          $( "#art" ).addClass("active");
          $( "#artdashboardmenu" ).addClass("active");
          $( "#iniciomenupeq" ).html("<small> INICIO</small>");
          $( "#artmenupeq" ).html("<strong>ART<span class='caret'></span></strong>");
          $( "#artdashboardmenupeq" ).html("<strong><span class='glyphicon glyphicon-ok'></span>Dashboard</strong>");
          $( "#mensajeestatus" ).fadeOut(5000);
          console.log(<?php echo json_encode($depto); ?>)
      });

      $('input:radio[name=indicador]').change(function() {
        var indi = document.querySelector('input[name="indicador"]:checked').value;
        if(indi=='1'){
          $("#General").css("display","block");
          $("#General-depto").css("display","block");
          $("#Usuario").css("display","none");
          $("#Usuario-usuar").css("display","none");

          nacional=<?php echo json_encode($nacional); ?>;
          Highcharts.chart('container', {
              chart: {
                  type: 'column'
              },
              title: {
                  text: 'Total de encuentas realzadas a nivel nacional, 2017'
              },
              xAxis: {
                  type: 'category'
              },
              yAxis: {
                  title: {
                      text: '# de encuestas'
                  }

              },
              legend: {
                  enabled: false
              },
              plotOptions: {
                  series: {
                      borderWidth: 0,
                      dataLabels: {
                          enabled: true,
                          format: '{point.y}'
                      }
                  }
              },

              tooltip: {
                  headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                  pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b> encuestas<br/>'
              },

              series: [{
                  name: 'Encuestas capturadas en campo',
                  colorByPoint: true,
                  data: [{
                      name: 'Diagnóstico del hogar para renovación y transformación integral',
                      y: nacional[0]
                  }, {
                      name: 'Anexo línea base para formalización de tierras',
                      y: nacional[1]
                  }]
              }]
          });
        }else{
          $("#Usuario").css("display","block");
          $("#Usuario-usuar").css("display","block");
          $("#General").css("display","none");
          $("#General-depto").css("display","none");
          Highcharts.chart('container', {

            title: {
                text: 'Solar Employment Growth by Sector, 2010-2016'
            },

            subtitle: {
                text: 'Source: thesolarfoundation.com'
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
                name: 'Installation',
                data: [43934, 52503, 57177, 69658, 97031, 119931, 137133, 154175]
            }, {
                name: 'Manufacturing',
                data: [24916, 24064, 29742, 29851, 32490, 30282, 38121, 40434]
            }, {
                name: 'Sales & Distribution',
                data: [11744, 17722, 16005, 19771, 20185, 24377, 32147, 39387]
            }, {
                name: 'Project Development',
                data: [null, null, 7988, 12169, 15112, 22452, 34400, 34227]
            }, {
                name: 'Other',
                data: [12908, 5948, 8105, 11248, 8989, 11816, 18274, 18111]
            }]

        });
        }
      });

      
    </script>    
@stop

@endif<!--Cierra el if de mostrar el contenido de la página si esta autenticado-->