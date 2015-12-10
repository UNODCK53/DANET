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
<div class="col-sm-1"></div>
<div class="col-sm-10">
  <h2 class="text-center text-primary">Resultados de recolección de encuestas digitales realizadas en Desarrollo Alternativo</h2>
  <p class="lead text-justify" >Esta sección presenta gráficamente los resultados del número de encuestas digitales realizadas en el monitoreo a los beneficiarios y Comités Comunitarios de Verificación y Control Social - CCVCS que hacen parte de la estrategias de Desarrollo Alternativo implementadas por la UACT en cooperación con UNODC. Las opciones de reporte son las siguientes:</p>
  <ul class="lead text-justify" ><span class="glyphicon glyphicon-ok" aria-hidden="true" style="color:#337ab7"></span> <span style="font-style: italic;">Resultados generales:</span> Esta opción permite conocer diferentes tipos de datos que van desde la totalidad de encuestas realizadas en todo Desarrollo Alternativo, filtrado por alguna intervención específica o hasta la cuantificación de indicadores administrativos</ul>
  <ul class="lead text-justify" ><span class="glyphicon glyphicon-ok" aria-hidden="true" style="color:#337ab7"></span> <span style="font-style: italic;">Resultados por monitor:</span> Muestra las encuestas digitales realizadas por cada monitor en cada intervención de Desarrollo Alternativo</ul>            
</div>
 <div class="col-sm-1"></div> 
   </div>  

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
          <input type="radio"  name="indicador" id="indicador2" value="2" required>Por Monitor
    </div> 
  <div class="col-sm-1"></div> 
</div> 


   <div class="row">       
    <br>
      <div class="col-sm-1"></div>
      <div class="col-sm-2">
        <label id="labelintervencion" for="Proceso" class="control-label">Intervención:</label>
          <select id="selintervencion" class="form-control" name="selintervencion">
              <option value="" selected="selected">Por favor seleccione</option>
              @foreach($todo[0] as $pro)
                  <option value="{{$pro->intervencion}}">{{$pro->intervencion}}</option>
              @endforeach
          </select>
      </div>
      <div class="col-sm-2">
        <label id="labelmision" for="Proceso" class="control-label">Misión:</label>
          <select id="selmision" class="form-control" name="selmision">
          </select>
      </div> 
      <div class="col-sm-2">
        <label id="labeldpto" for="Proceso" class="control-label">Departamento:</label>
          <select id="seldpto" class="form-control" name="seldpto">
          </select>
      </div>  
      <div class="col-sm-2">
        <label id="labelmpio" for="Proceso" class="control-label">Municipio:</label>
          <select id="selmpio" class="form-control" name="selmpio">
          </select>
      </div>
      
      <div class="col-sm-1"></div>
    </div>

    <div class="row">       
      <div class="col-sm-1"></div>
      <div class="col-sm-3">
        <label id="labelmonitor" for="Proceso" class="control-label">Monitor:</label>
         <select id="selmonitor" class="form-control" name="selmonitor">
              <option value="" selected="selected">Por favor seleccione</option>
              @foreach($todo[1] as $pro)
                  <option value="{{$pro->id}}">{{$pro->name}} {{$pro->last_name}}</option>
              @endforeach
          </select>
      </div>
      <div class="col-sm-2">
        <label id="labelintervencionmoni" for="Proceso" class="control-label">Intervención:</label>
          <select id="selintervencionmoni" class="form-control" name="selintervencionmoni">
          </select>
      </div>
      <div class="col-sm-2">
        <label id="labeldptomoni" for="Proceso" class="control-label">Departamento:</label>
          <select id="seldptomoni" class="form-control" name="seldptomoni">
          </select>
      </div> 
      <div class="col-sm-2">
        <label id="labelmpiomoni" for="Proceso" class="control-label">Municipio:</label>
          <select id="selmpiomoni" class="form-control" name="selmpiomoni">
          </select>
      </div>
      <div class="col-sm-1"></div>
      </div>
    <div class="row"> 
    <br>      
      <div class="col-sm-1"></div> 
      <div class="col-sm-3">
        <label id="labelvdamoni" for="Proceso" class="control-label">Vereda:</label>
          <select id="selvdamoni" class="form-control" name="selvdamoni">
          </select>
      </div>  
      <div class="col-sm-2">
        <label id="labelmisionmoni" for="Proceso" class="control-label">Misión:</label>
          <select id="selmisionmoni" class="form-control" name="selmisionmoni">
          </select>
      </div>  
      <div class="col-sm-1"></div>    
    </div> 
    <br>

    <div class="row">
      <br>
      <div class="col-sm-1"></div>
      <div class="col-sm-10" id="container" style="min-width: 310px; height: 400px; max-width: auto; margin: 0 auto"></div>
      <div class="col-sm-1"></div>
    </div>

    <div id="hr1"><hr></div>

    <div class="row">
      <div class="col-sm-1"></div>
      <div id="container1" class="col-sm-6" style="min-width: 310px; height: 400px;"></div>
      <div id="container_label" class="col-sm-4" style="min-width: 310px; height: 400px;">
            <h3 class="text-center text-primary">Línea base {{ $todo[4]}}</h3>
            <p class="text-justify">En la intervención {{ $todo[4]}} se han realizado un total de {{$todo[6][0]}}  encuestas desde el {{$todo[5][0][0]}} hasta {{$todo[5][0][1]}} distribuida en {{$todo[7][0]}} departamentos y {{$todo[8][0]}} municipios<p>
            <ul class="text-justify" ><span class="glyphicon glyphicon-ok" aria-hidden="true" style="color:#337ab7"></span> <span style="font-style: italic;">Escala nacional:</span> El visor permite ver el número total de encuestas realizadas por departamento en línea base</ul>
            <ul class="text-justify" ><span class="glyphicon glyphicon-ok" aria-hidden="true" style="color:#337ab7"></span> <span style="font-style: italic;">Escala departamental:</span> Al dar click sobre un departamento en específico, el visor muestra el número de encuestas de línea base por municipio para el departamento en cuestión</ul>            
      </div>
      <div class="col-sm-1"></div>
    </div>

    <div id="hr2"><hr></div>

    <div class="row">
      <div class="col-sm-1"></div>
      <div id="container2" class="col-sm-6" style="min-width: 310px; height: 400px;"></div>
      <div id="container2_label" class="col-sm-4" style="min-width: 310px; height: 400px;">
            <h3 class="text-center text-primary">Seguimiento {{ $todo[4]}}</h3>
            <p class="text-justify">En la intervención {{ $todo[4]}} se han realizado un total de {{$todo[6][1]}}  encuestas desde el {{$todo[5][1][0]}} hasta {{$todo[5][1][1]}} distribuida en {{$todo[7][1]}} departamentos y {{$todo[8][1]}} municipios<p>
            <ul class="text-justify" ><span class="glyphicon glyphicon-ok" aria-hidden="true" style="color:#337ab7"></span> <span style="font-style: italic;">Escala nacional:</span> El visor permite ver el número total de encuestas realizadas por departamento en Seguimineto</ul>
            <ul class="text-justify" ><span class="glyphicon glyphicon-ok" aria-hidden="true" style="color:#337ab7"></span> <span style="font-style: italic;">Escala departamental:</span> Al dar click sobre un departamento en específico, el visor muestra el número de encuestas de Seguimineto por municipio para el departamento en cuestión</ul>            
      </div>
      <div class="col-sm-1"></div>
    </div>
    
   <div id="hr3"><hr></div>
    <div class="row">
      <div class="col-sm-1"></div>
      <div id="container3" class="col-sm-6" style="min-width: 310px; height: 400px;"><hr></div>
      <div id="container3_label" class="col-sm-4" style="min-width: 310px; height: 400px;">
            <h3 class="text-center text-primary">Línea final {{ $todo[4]}}</h3>
            <p class="text-justify">En la intervención {{ $todo[4]}} se han realizado un total de {{$todo[6][2]}}  encuestas desde el {{$todo[5][2][0]}} hasta {{$todo[5][2][1]}} distribuida en {{$todo[7][2]}} departamentos y {{$todo[8][2]}} municipios<p>
            <ul class="text-justify" ><span class="glyphicon glyphicon-ok" aria-hidden="true" style="color:#337ab7"></span> <span style="font-style: italic;">Escala nacional:</span> El visor permite ver el número total de encuestas realizadas por departamento en línea final</ul>
            <ul class="text-justify" ><span class="glyphicon glyphicon-ok" aria-hidden="true" style="color:#337ab7"></span> <span style="font-style: italic;">Escala departamental:</span> Al dar click sobre un departamento en específico, el visor muestra el número de encuestas de línea final por municipio para el departamento en cuestión</ul>            

      </div>
      <div class="col-sm-1"></div>
    </div>
 <div id="hr4"><hr></div>

<!--fin del codigo-->
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
@section('js')
  @parent
   <script src="assets/js/highcharts/highcharts.js"></script>
  <script src="assets/js/highcharts/highcharts-3d.js"></script>
  <script src="assets/js/highcharts/exporting.js"></script>
  <script src="assets/js/highcharts/heatmap.js"></script>
  <script src="assets/js/highcharts/treemap.js"></script>
  <script src="assets/js/highcharts/drilldown.js"></script>
  <script src="assets/js/highcharts/highmaps.js"></script>
  <script src="assets/js/highcharts/data.js"></script>
  <script src="assets/js/highcharts/map.js"></script>





  <script>
 

    $(document).ready(function(){
    
    $("#labelintervencion").hide();
    $("#selintervencion").hide();
    $("#labelmpio").hide();
    $("#selmpio").hide();
    $("#labelmision").hide();
    $("#selmision").hide();    
    $("#labeldpto").hide();
    $("#seldpto").hide();
    $("#container").hide();

    $("#labelmonitor").hide();
    $("#selmonitor").hide();
    $("#labelintervencionmoni").hide();
    $("#selintervencionmoni").hide();
    $("#labelmpiomoni").hide();
    $("#selmpiomoni").hide();
    $("#labelmisionmoni").hide();
    $("#selmisionmoni").hide();    
    $("#labeldptomoni").hide();
    $("#seldptomoni").hide();
    $("#labelvdamoni").hide();
    $("#selvdamoni").hide();



   
    $.ajax({url:"siscadi/siscadiidmapa",type:"POST",dataType:'json',//llama al controlador siscadi/siscadimision que trae los valores necesario para la grafica
          success:function(data1){
          
$.getJSON('assets/geojson/SISCADI/SISCADI_dptos_geo.js', function (geojson) {  
  Highcharts.setOptions({
    lang: {
        drillUpText: '◁ Regresar a <br>datos nacionales'
    }
});

    var data = Highcharts.geojson(geojson);
                            small = $('#container').width() < 400;                                                                                                             
    // Set drilldown pointers
    $.each(data, function (i) {
        this.drilldown = this.properties['COD_DPTO'];//asigna al geojson la propieada del drilldown con el codigo DEPTO
    });

    // grafica de liena base
    $('#container1').highcharts('Map', {
        chart : {
            events: {
                drilldown: function (e) {//función que hace el drilldown con el evento click

                    if (!e.seriesOptions) {
                        var chart = this,
                            mapKey =   e.point.drilldown + '_geo',//variable con el nombre de la capa geojson por municipio segun seleccion de deprtamento (e.point.drilldown). las capas se llama COO_DEPTO_geo
                            // Handle error, the timeout is cleared on success
                            fail = setTimeout(function () {// validador de las capasexistentes por municipio
                                if (! 'assets/geojson/SISCADI/SISCADI_'+mapKey+'.js') {
                                    chart.showLoading('<i class="icon-frown"></i> Failed loading ' + e.point.name);

                                    fail = setTimeout(function () {
                                        chart.hideLoading();
                                    }, 6000);
                                }
                            }, 8000);

                        // Show the spinner
                        chart.showLoading('<i class="icon-spinner icon-spin icon-3x"></i>'); // Font Awesome spinner

                        // Load the drilldown map

                        $.ajax({url:"siscadi/siscadiidmapa",type:"POST",dataType:'json',//llama nuevamente al controlador siscadi/siscadimision dado que si no se hace esto, la grafica mantiene los municipios seleccionados en anteriores drilldown 
                        success:function(data1){
          
                          $.getJSON('assets/geojson/SISCADI/SISCADI_'+mapKey+'.js', function (geojsonmuni) {

                            
                              var data2 = Highcharts.geojson(geojsonmuni);

                              $.each(data2, function (i) {
                                  this.name = this.properties['NOM_MPIO'];//asigna al geojson la propieada del nombre  con el NOM_MPIO

                              });
                              
                             
                              // Hide loading and add series
                              chart.hideLoading();
                              clearTimeout(fail);
                              chart.addSeriesAsDrilldown(e.point, {/// creacion de la seire para los municipios segun seleccion del departamento

                                  name: 'Datos municipal',
                                  data: data1.Linea_base_muni,
                                  mapData: data2,//carga el geojson municipal
                                   joinBy: ['COD_DANE', 'COD_DANE'],//realzia un join enttre el geojson y la consulta ajax
                                   tooltip: {
                                      pointFormat: 'En {point.name} se realizaron {point.value} encuestas'
                                  },
                                  dataLabels: {
                                      enabled: true,
                                      format: '{point.name}'
                                  }
                              });
                          });
                        }});
                    }
                    this.setTitle({ text: 'Línea base. '+e.point.value+' encuestas realizadas' }, { text: 'Departamento de  '+e.point.nombre });

                },

                drillup: function () {
                    this.setTitle({ text: 'Línea Base. '+data1.cuenta_todos[0]+' encuestas realizadas'}, { text: 'Intervención '+ data1.intervencion});


                }
            }
        },

        title : {
            text : 'Línea Base. '+data1.cuenta_todos[0]+' encuestas realizadas'
        },

        subtitle: {
            text: 'Intervención '+ data1.intervencion,
           
        },

        legend: small ? {} : {
            layout: 'vertical',
            align: 'left',
            verticalAlign: 'middle',
            itemMarginTop: 80,
        },

        colorAxis: {
            min: 0,
        },

        mapNavigation: {
            enabled: true

        },

        plotOptions: {
            map: {
                states: {
                    hover: {
                        color: '#EEDD66'
                    }
                }
            }
        },

        series : [{
            data : data1.Linea_base_depto,
            mapData: data,//carga el geojson nacional
                joinBy: ['COD_DPTO', 'COD_DPTO'],//realzia un join enttre el geojson y la consulta ajax
            name: 'Intervención '+ data1.intervencion,
             tooltip: {
                    pointFormat: 'En {point.properties.NOM_DPTO} se realizaron {point.value} encuestas'
                },
            dataLabels: {
                enabled: true,
                format: '{point.properties.NOM_DPTO}'
            }
        }],

        drilldown: {
            //series: drilldownSeries,
            activeDataLabelStyle: {
                color: '#FFFFFF',
                textDecoration: 'none',
                textShadow: '0 0 3px #000000'
            },
            drillUpButton: {
                relativeTo: 'spacingBox',
                position: {
                    x: 0,
                    y: 300
                }
            }
        }
    });
  
   // grafica de seguimiento
  $('#container2').highcharts('Map', {
        chart : {
            events: {
                drilldown: function (e) {//función que hace el drilldown con el evento click

                    if (!e.seriesOptions) {
                        var chart = this,
                            mapKey =   e.point.drilldown + '_geo',//variable con el nombre de la capa geojson por municipio segun seleccion de deprtamento (e.point.drilldown). las capas se llama COO_DEPTO_geo
                            // Handle error, the timeout is cleared on success
                            fail = setTimeout(function () {// validador de las capasexistentes por municipio
                                if (! 'assets/geojson/SISCADI/SISCADI_'+mapKey+'.js') {
                                    chart.showLoading('<i class="icon-frown"></i> Failed loading ' + e.point.name);

                                    fail = setTimeout(function () {
                                        chart.hideLoading();
                                    }, 6000);
                                }
                            }, 8000);

                        // Show the spinner
                        chart.showLoading('<i class="icon-spinner icon-spin icon-3x"></i>'); // Font Awesome spinner

                        // Load the drilldown map

                        $.ajax({url:"siscadi/siscadiidmapa",type:"POST",dataType:'json',//llama nuevamente al controlador siscadi/siscadimision dado que si no se hace esto, la grafica mantiene los municipios seleccionados en anteriores drilldown 
                        success:function(data1){
          
                          $.getJSON('assets/geojson/SISCADI/SISCADI_'+mapKey+'.js', function (geojsonmuni) {

                            
                              var data2 = Highcharts.geojson(geojsonmuni);

                              $.each(data2, function (i) {
                                  this.name = this.properties['NOM_MPIO'];//asigna al geojson la propieada del nombre  con el NOM_MPIO

                              });
                              
                             
                              // Hide loading and add series
                              chart.hideLoading();
                              clearTimeout(fail);
                              chart.addSeriesAsDrilldown(e.point, {/// creacion de la seire para los municipios segun seleccion del departamento

                                  name: 'Datos municipal',
                                  data: data1.Seguimiento_muni,
                                  mapData: data2,//carga el geojson municipal
                                   joinBy: ['COD_DANE', 'COD_DANE'],//realzia un join enttre el geojson y la consulta ajax
                                   tooltip: {
                                      pointFormat: 'En {point.name} se realizaron {point.value} encuestas'
                                  },
                                  dataLabels: {
                                      enabled: true,
                                      format: '{point.name}'
                                  }
                              });
                          });
                        }});
                    }


                    this.setTitle( { text: 'Seguimiento. '+e.point.value+' encuestas realizadas' }, { text: 'Departamento de  '+e.point.nombre });

                },

                drillup: function () {
                    this.setTitle({ text: 'Seguimiento.  '+data1.cuenta_todos[1]+'  encuestas realizadas' }, { text: 'Intervención '+ data1.intervencion, });


                }
            }
        },

        title : {
            text : 'Seguimiento. '+data1.cuenta_todos[1]+' encuestas realizadas'
        },

        subtitle: {
            text: 'Intervención '+ data1.intervencion,
           
        },

        legend: small ? {} : {
            layout: 'vertical',
            align: 'left',
            verticalAlign: 'middle',
            itemMarginTop: 80,
        },

        colorAxis: {
            min: 0
        },

        mapNavigation: {
            enabled: true,
            
        },

        plotOptions: {
            map: {
                states: {
                    hover: {
                        color: '#EEDD66'
                    }
                }
            }
        },

        series : [{
            data : data1.Seguimiento_depto,
            mapData: data,//carga el geojson nacional
                joinBy: ['COD_DPTO', 'COD_DPTO'],//realzia un join enttre el geojson y la consulta ajax
            name: 'Intervención '+ data1.intervencion,
             tooltip: {
                    pointFormat: 'En {point.properties.NOM_DPTO} se realizaron {point.value} encuestas'
                },
            dataLabels: {
                enabled: true,
                format: '{point.properties.NOM_DPTO}'
            }
        }],

        drilldown: {
            //series: drilldownSeries,
            activeDataLabelStyle: {
                color: '#FFFFFF',
                textDecoration: 'none',
                textShadow: '0 0 3px #000000'
            },
            drillUpButton: {
                relativeTo: 'spacingBox',
                position: {
                    x: 0,
                    y: 300
                }
            }
        }
    });
  
   // grafica de Linea final
  $('#container3').highcharts('Map', {
        chart : {
            events: {
                drilldown: function (e) {//función que hace el drilldown con el evento click

                    if (!e.seriesOptions) {
                        var chart = this,
                            mapKey =   e.point.drilldown + '_geo',//variable con el nombre de la capa geojson por municipio segun seleccion de deprtamento (e.point.drilldown). las capas se llama COO_DEPTO_geo
                            // Handle error, the timeout is cleared on success
                            fail = setTimeout(function () {// validador de las capasexistentes por municipio
                                if (! 'assets/geojson/SISCADI/SISCADI_'+mapKey+'.js') {
                                    chart.showLoading('<i class="icon-frown"></i> Failed loading ' + e.point.name);

                                    fail = setTimeout(function () {
                                        chart.hideLoading();
                                    }, 6000);
                                }
                            }, 8000);

                        // Show the spinner
                        chart.showLoading('<i class="icon-spinner icon-spin icon-3x"></i>'); // Font Awesome spinner

                        // Load the drilldown map

                        $.ajax({url:"siscadi/siscadiidmapa",type:"POST",dataType:'json',//llama nuevamente al controlador siscadi/siscadimision dado que si no se hace esto, la grafica mantiene los municipios seleccionados en anteriores drilldown 
                        success:function(data1){
          
                          $.getJSON('assets/geojson/SISCADI/SISCADI_'+mapKey+'.js', function (geojsonmuni) {

                            
                              var data2 = Highcharts.geojson(geojsonmuni);

                              $.each(data2, function (i) {
                                  this.name = this.properties['NOM_MPIO'];//asigna al geojson la propieada del nombre  con el NOM_MPIO

                              });
                              
                             
                              // Hide loading and add series
                              chart.hideLoading();
                              clearTimeout(fail);
                              chart.addSeriesAsDrilldown(e.point, {/// creacion de la seire para los municipios segun seleccion del departamento

                                  name: 'Datos municipal',
                                  data: data1.Linea_final_muni,
                                  mapData: data2,//carga el geojson municipal
                                   joinBy: ['COD_DANE', 'COD_DANE'],//realzia un join enttre el geojson y la consulta ajax
                                   tooltip: {
                                      pointFormat: 'En {point.name} se realizaron {point.value} encuestas'
                                  },
                                  dataLabels: {
                                      enabled: true,
                                      format: '{point.name}'
                                  }
                              });
                          });
                        }});
                    }


                    this.setTitle({ text: 'Línea final. '+e.point.value+' encuestas realizadas'}, { text: 'Departamento de  '+e.point.nombre });

                },

                drillup: function () {
                    this.setTitle({ text: 'Línea final. '+data1.cuenta_todos[2]+' encuestas realizadas'}, { text: 'Intervención '+ data1.intervencion,});


                }
            }
        },

        title : {
            text : 'Línea final. '+data1.cuenta_todos[2]+' encuestas realizadas'
        },

        subtitle: {
            text: 'Intervención '+ data1.intervencion,
           
        },

        legend: small ? {} : {
            layout: 'vertical',
            align: 'left',
            verticalAlign: 'middle',
            itemMarginTop: 80,
        },

        colorAxis: {
            min: 0
        },

        mapNavigation: {
            enabled: true,
           
        },

        plotOptions: {
            map: {
                states: {
                    hover: {
                        color: '#EEDD66'
                    }
                }
            }
        },

        series : [{
            data : data1.Linea_final_depto,
            mapData: data,//carga el geojson nacional
                joinBy: ['COD_DPTO', 'COD_DPTO'],//realzia un join enttre el geojson y la consulta ajax
            name: 'Intervención '+ data1.intervencion,
             tooltip: {
                    pointFormat: 'En {point.properties.NOM_DPTO} se realizaron {point.value} encuestas'
                },
            dataLabels: {
                enabled: true,
                format: '{point.properties.NOM_DPTO}'
            }
        }],

        drilldown: {
            //series: drilldownSeries,
            activeDataLabelStyle: {
                color: '#FFFFFF',
                textDecoration: 'none',
                textShadow: '0 0 3px #000000'
            },
            drillUpButton: {
                relativeTo: 'spacingBox',
                position: {
                    x: 0,
                    y: 300
                }
            }
        }
    });
});
            
       //Termina function highchart
          },
          error:function(){alert('error');}
        });//Termina Ajax prueva


    //grafica segun indicador      
      $('input:radio[name=indicador]').change(function() {

      var indi = document.querySelector('input[name="indicador"]:checked').value;

       if(indi=='1')
      {// inicializa la grafica si se escoge el tipo de indicador general, y solo muestra los input de "general"
        $("#selintervencion").val("");
        $("#labelintervencion").show();
        $("#selintervencion").show();
        $("#labelmonitor").hide();
        $("#selmonitor").hide();
        $("#labelintervencionmoni").hide();
        $("#selintervencionmoni").hide();
        $("#labelmpiomoni").hide();
        $("#selmpiomoni").hide();
        $("#labelmisionmoni").hide();
        $("#selmisionmoni").hide();    
        $("#labeldptomoni").hide();
        $("#seldptomoni").hide();
        $("#labelvdamoni").hide();
        $("#selvdamoni").hide();
        $("#container").empty();
        $("#container").show();
        $("#container1").hide();
        $("#container2").hide();
        $("#container3").hide();
        $("#container_label").hide();
        $("#container2_label").hide();
        $("#container3_label").hide();
        $("#hr1").hide();
        $("#hr2").hide();
        $("#hr3").hide();
        $("#hr4").hide();

 
        

       


    
        $('#container').highcharts({
          chart:{type:'column'},
          title:{text:'Encuestas realizadas en misiones de Desarrollo Alternativo'},
         subtitle:{text:'Distribución según año de Intervención '},
          xAxis:{
            categories:[
              @foreach($todo[2] as $arraydat3)
                {{'"'.$arraydat3->intervencion.' ",'}}
              @endforeach
            ],
            crosshair: true
          },
          yAxis:{min:0,title:{text:'Número de encuestas'}},
          tooltip:{
            formatter: function () {
                    return ' En la intervención <b>' + this.key +
                        '</b> <br>se realizaron <b>' + this.y + '</b> encuestas a  <span style="color:'+this.series.color+'">'+this.series.name +'</span>';
                }
            
          },
          plotOptions:{series:{borderWidth:0,dataLabels:{enabled:true,format:'{point.y:.0f}'}}},
          series:[{
            name:'Beneficiarios',data:[
            @foreach($todo[2] as $arraydat1)
              {{$arraydat1->num_intervencion.','}}
            @endforeach
            ]},
            {name:'Comités',data:[
            @foreach($todo[3] as $arraydat2)
              {{$arraydat2->num_intervencion.','}}
            @endforeach
            ]}
          ]
        });
      }else{
        // inicializa solo muestra los input de "Monitor"
        $("#labelmonitor").show();
        $("#selmonitor").show();
        $("#selmonitor").val("");
        $("#labelintervencion").hide();
        $("#selintervencion").hide();
        $("#labelmpio").hide();
        $("#selmpio").hide();
        $("#labelmision").hide();
        $("#selmision").hide();    
        $("#labeldpto").hide();
        $("#seldpto").hide();
        $("#container").empty();
        $("#container").show();
        $("#container1").hide();
        $("#container2").hide();
        $("#container3").hide();
        $("#container_label").hide();
        $("#container2_label").hide();
        $("#container3_label").hide();
        $("#hr1").hide();
        $("#hr2").hide();
        $("#hr3").hide();
        $("#hr4").hide();
   

        
            
      }
       });//Termina chage seldpto



    //grafica segun intervencion      
      $("#selintervencion").change(function(){
      if($('#selintervencion').val()!='')//si selecciona una opcion diferente de "" ejecuta la nueva grafica si no vuelve a calcular la grafica anterior
      {
         $.ajax({url:"siscadi/siscadiinter",type:"POST",data:{intervencion:$('#selintervencion').val()},dataType:'json',//llama al controlador siscadi/siscadiinter que trae los valores necesario para la grafica
          success:function(data1){
            $("#labelmision").show();
            $("#selmision").show();
             $("#selmision").empty();
            $("#selmpio").empty();
             $("#seldpto").empty();
              $("#labelmpio").hide();
              $("#selmpio").hide();
              $("#labeldpto").hide();
              $("#seldpto").hide();
            $("#selmision").append("<option value=''>Por favor seleccione</option>");
            $.each(data1[0], function(nom,datos){
              $("#selmision").append("<option value=\""+datos.mision+"\">"+datos.nom_mision+"</option>");
            });

            $('#container').highcharts({
                chart:{type:'column'},
                title:{text:'Encuestas realizadas en la Intervención '+$('#selintervencion').val()+' de Desarrollo Alternativo'},
               subtitle:{text:'Distribución según tipo de misión' },
                xAxis:{
                  categories:data1[3],
                  crosshair: true
                },
                yAxis:{min:0,title:{text:'Número de encuestas'}},
                tooltip:{
                  formatter: function () {
                          return ' En la misión de <b>' + this.key +
                              '</b> <br>se realizaron <b>' + this.y + '</b> encuestas a  <span style="color:'+this.series.color+'">'+this.series.name +'</span>';
                      }
                  
                },
                plotOptions:{series:{borderWidth:0,dataLabels:{enabled:true,format:'{point.y:.0f}'}}},
                series:[
                  {name:'Beneficiarios',
                   data:data1[1]
                  },
                  {name:"Comités",
                  data:data1[2]
                  }
                ]
              });
            
       //Termina function highchart
          },
          error:function(){alert('error');}
        });//Termina Ajax prueva
      }else{//vuelve a calcular la grafica inicial y ocualta los input siguientes
        $("#labelmpio").hide();
        $("#selmpio").hide();
        $("#labelmision").hide();
        $("#selmision").hide();    
        $("#labeldpto").hide();
        $("#seldpto").hide();

        $('#container').highcharts({
          chart:{type:'column'},
          title:{text:'Encuestas realizadas en misiones de Desarrollo Alternativo'},
         subtitle:{text:'Distribución según año de Intervención '},
          xAxis:{
            categories:[
              @foreach($todo[2] as $arraydat3)
                {{'"'.$arraydat3->intervencion.' ",'}}
              @endforeach
            ],
            crosshair: true
          },
          yAxis:{min:0,title:{text:'Número de encuestas'}},
          tooltip:{
            formatter: function () {
                    return ' En la intervención <b>' + this.key +
                        '</b> <br>se realizaron <b>' + this.y + '</b> encuestas a  <span style="color:'+this.series.color+'">'+this.series.name +'</span>';
                }
            
          },
          plotOptions:{series:{borderWidth:0,dataLabels:{enabled:true,format:'{point.y:.0f}'}}},
          series:[{
            name:'Beneficiarios',data:[
            @foreach($todo[2] as $arraydat1)
              {{$arraydat1->num_intervencion.','}}
            @endforeach
            ]},
            {name:'Comités',data:[
            @foreach($todo[3] as $arraydat2)
              {{$arraydat2->num_intervencion.','}}
            @endforeach
            ]}
          ]
        });
      }
       });//Termina chage seldpto
    

     //grafica segun mision      
      $("#selmision").change(function(){
       if($('#selmision').val()!='')//si selecciona una opcion diferente de "" ejecuta la nueva grafica si no vuelve a calcular la grafica anterior
      {
        $.ajax({url:"siscadi/siscadimision",type:"POST",data:{mision:$('#selmision').val(),intervencion:$('#selintervencion').val()},dataType:'json',//llama al controlador siscadi/siscadimision que trae los valores necesario para la grafica
          success:function(data1){
            $("#labeldpto").show();
            $("#seldpto").show(); 
            $("#seldpto").empty();
            $("#selmpio").hide();
            $("#labelmpio").hide();
            $("#seldpto").append("<option value=''>Por favor seleccione</option>");
            $.each(data1.arraydpto, function(nom,datos){
              $("#seldpto").append("<option value=\""+datos.COD_DPTO+"\">"+datos.NOM_DPTO+"</option>");
            });

//grafica de cajas por departamento
            $('#container').highcharts({//funcion qu crea la grafica
              
              chart: {
                type: 'treemap'
              },


              title: {
                  text: 'Encuestas realizadas de '+data1.arraymision[0].nom_mision+' intervención '+$('#selintervencion').val()+' de Desarrollo Alternativo'
                },
                subtitle: {
                  text: "Distribución departamental. <br>Haga Click sobre la gráfica para desagregar más la información"
                },
              tooltip: {
                  headerFormat: '<span style="font-size:11px"></span>',
                  pointFormat: 'En <span style="color:{point.color}">{point.name}</span> se realizaron <br><b>{point.value:.0f} </b> encuestas<br/>'
                },  
              exporting: {
                sourceWidth: 2000,
                sourceHeight: 700
              },
                
              series: [{
                layoutAlgorithm: 'squarified',
                allowDrillToNode: true,
                dataLabels: {
                  enabled: false,
                  style: {
                      textShadow: ''
                    }
                },
                levelIsConstant: false,
                levels: [{
                  level: 1,
                  dataLabels: {
                    enabled: true,
                    style: {
                      textShadow: ''
                    }
                  },
                  borderWidth: 3
                }],
                data: data1.grafica,
              }],

            });
            
       //Termina function highchart
          },
          error:function(){alert('error');}
        });//Termina Ajax prueva
      }
      else{//vuelve a calcular la grafica inicial y ocualta los input siguientes
        $.ajax({url:"siscadi/siscadiinter",type:"POST",data:{intervencion:$('#selintervencion').val()},dataType:'json',//llama al controlador siscadi/siscadiinter que trae los valores necesario para la grafica
          success:function(data1){
            $("#labelmision").show();
            $("#selmision").show(); 
            $("#selmision").empty();
            $("#selmpio").empty();
            $("#seldpto").hide();
            $("#labeldpto").hide();
            $("#selmpio").hide();
             $("#labelmpio").hide();
            $("#selmision").append("<option value=''>Por favor seleccione</option>");
            $.each(data1[0], function(nom,datos){
              $("#selmision").append("<option value=\""+datos.mision+"\">"+datos.nom_mision+"</option>");
            });

            $('#container').highcharts({
                chart:{type:'column'},
                title:{text:'Encuestas realizadas en la Intervención '+$('#selintervencion').val()+' de Desarrollo Alternativo'},
               subtitle:{text:'Distribución según tipo de misión' },
                xAxis:{
                  categories:data1[3],
                  crosshair: true
                },
                yAxis:{min:0,title:{text:'Número de encuestas'}},
                tooltip:{
                  formatter: function () {
                          return ' En la misión de <b>' + this.key +
                              '</b> <br>se realizaron <b>' + this.y + '</b> encuestas a  <span style="color:'+this.series.color+'">'+this.series.name +'</span>';
                      }
                  
                },
                plotOptions:{series:{borderWidth:0,dataLabels:{enabled:true,format:'{point.y:.0f}'}}},
                series:[
                  {name:'Beneficiarios',
                   data:data1[1]
                  },
                  {name:"Comités",
                  data:data1[2]
                  }
                ]
              });
            
       //Termina function highchart
          },
          error:function(){alert('error');}
        });//Termina Ajax prueva
      }

       });//Termina chage seldpto


   //grafica segun departamento      
      $("#seldpto" ).change(function(){
       if($('#seldpto').val()!='')
      {
        $.ajax({url:"siscadi/siscadidpto",type:"POST",data:{mision:$('#selmision').val(),intervencion:$('#selintervencion').val(),departamento:$('#seldpto').val()},dataType:'json',//llama al controlador siscadi/siscadidpto que trae los valores necesario para la 
          success:function(data1){
            $("#selmpio").show();
            $("#labelmpio").show(); 
             $("#selmpio").empty();
            $("#selmpio").append("<option value=''>Por favor seleccione</option>");
            $.each(data1.arraymuni, function(nom,datos){
              $("#selmpio").append("<option value=\""+datos.COD_DANE+"\">"+datos.NOM_MPIO+"</option>");
            });

            $('#container').highcharts({//funcion qu crea la grafica
              
              chart: {
                type: 'treemap'
              },


              title: {
                  text: 'Encuestas realizadas en el departamento de '+data1.arraydepto[0].NOM_DPTO+'<br>'+data1.arraymision[0].nom_mision+'intervención '+$('#selintervencion').val()+' de Desarrollo Alternativo'
                },
                subtitle: {
                  text: "Distribución municipal. <br>Haga Click sobre la gráfica para desagregar más la información"
                },
              tooltip: {
                  headerFormat: '<span style="font-size:11px"></span>',
                  pointFormat: 'En <span style="color:{point.color}">{point.name}</span> se realizaron <br><b>{point.value:.0f} </b> encuestas<br/>'
                },  
              exporting: {
                sourceWidth: 2000,
                sourceHeight: 700
              },
                
              series: [{
                layoutAlgorithm: 'squarified',
                allowDrillToNode: true,
                dataLabels: {
                  enabled: false,
                  style: {
                      textShadow: ''
                    }
                },
                levelIsConstant: false,
                levels: [{
                  level: 1,
                  dataLabels: {
                    enabled: true,
                    style: {
                      textShadow: ''
                    }
                  },
                  borderWidth: 3
                }],
                data: data1.grafica,
              }],

            });
            
       //Termina function highchart
          },
          error:function(){alert('error');}
        });//Termina Ajax prueva
      }
      else{
        $.ajax({url:"siscadi/siscadimision",type:"POST",data:{mision:$('#selmision').val(),intervencion:$('#selintervencion').val()},dataType:'json',//llama al controlador siscadi/siscadimision que trae los valores necesario para la 
          success:function(data1){
            $("#labeldpto").show();
            $("#seldpto").show(); 
            $("#seldpto").empty();
            $("#selmpio").hide();
            $("#labelmpio").hide(); 
            $("#seldpto").append("<option value=''>Por favor seleccione</option>");
            $.each(data1.arraydpto, function(nom,datos){
              $("#seldpto").append("<option value=\""+datos.COD_DPTO+"\">"+datos.NOM_DPTO+"</option>");
            });

            $('#container').highcharts({//funcion qu crea la grafica
              
              chart: {
                type: 'treemap'
              },


              title: {
                  text: 'Encuestas realizadas de '+data1.arraymision[0].nom_mision+' intervención '+$('#selintervencion').val()+' de Desarrollo Alternativo'

                },
                subtitle: {
                  text: "Distribución departamental. <br>Haga Click sobre la gráfica para desagregar más la información"
                },
              tooltip: {
                  headerFormat: '<span style="font-size:11px"></span>',
                  pointFormat: 'En <span style="color:{point.color}">{point.name}</span> se realizaron <br><b>{point.value:.0f} </b> encuestas<br/>'
                },  
              exporting: {
                sourceWidth: 2000,
                sourceHeight: 700
              },
                
              series: [{
                layoutAlgorithm: 'squarified',
                allowDrillToNode: true,
                dataLabels: {
                  enabled: false,
                  style: {
                      textShadow: ''
                    }
                },
                levelIsConstant: false,
                levels: [{
                  level: 1,
                  dataLabels: {
                    enabled: true,
                    style: {
                      textShadow: ''
                    }
                  },
                  borderWidth: 3
                }],
                data: data1.grafica,
              }],

            });
            
       //Termina function highchart
          },
          error:function(){alert('error');}
        });//Termina Ajax prueva
      }

       });//Termina chage selpeto

//grafica segun departamento      
      $("#selmpio" ).change(function(){
       if($('#selmpio').val()!='')
      {
        var label=[];

 $.ajax({url:"siscadi/siscadimoni",type:"POST",data:{mision:$('#selmision').val(),intervencion:$('#selintervencion').val(),departamento:$('#seldpto').val(),municipio:$('#selmpio').val()},dataType:'json',
          success:function(data1){
			  
            label=data1;
          }
        });

        $.ajax({url:"siscadi/siscadimpio",type:"POST",data:{mision:$('#selmision').val(),intervencion:$('#selintervencion').val(),departamento:$('#seldpto').val(),municipio:$('#selmpio').val()},dataType:'json',
          success:function(data1){
        $('#container').highcharts({//funcion qu crea la grafica
            
            chart: {
              type: 'heatmap'
            },

            title: {
             text: 'Encuestas realizadas en  '+label.muni+','+label.depto+'<br>'+label.mision+'intervención '+$('#selintervencion').val()+' de Desarrollo Alternativo'

                },
                subtitle: {
                  text: "Distribución por monitor"
                },

            xAxis: {
              categories: label.moni,
              labels: {
                rotation: 45
              }
            },

            yAxis: {
              title:{text:'Encuestas a'},
              categories: ['Comités','Beneficiarios'] 
            },

            colorAxis: {
              min: 0,
              minColor: '#FFFFFF',
              maxColor: Highcharts.getOptions().colors[0]
            },

            legend: {
              enabled: false
            },

           tooltip: {
              formatter: function () {
                return 'El monitor:<b> ' + this.series.xAxis.categories[this.point.x] + '</b>  <br>realizó <b>' +
                  this.point.value + '</b> encuestas a ' + this.series.yAxis.categories[this.point.y] + '</b>';
              }
            },

            series: [{
              name: 'Sales per employee',
              data: data1,
              dataLabels: {
                enabled: true,
                color: '#000000'
              },
              
            }]

          });
       //Termina function highchart
          },
          error:function(){alert('error');}
        });//Termina Ajax prueva
      }
      else{
        $("#selmpio").empty();
       $.ajax({url:"siscadi/siscadidpto",type:"POST",data:{mision:$('#selmision').val(),intervencion:$('#selintervencion').val(),departamento:$('#seldpto').val()},dataType:'json',
          success:function(data1){
            $("#selmpio").show();
            $("#labelmpio").show(); 
            $("#selmpio").append("<option value=''>Por favor seleccione</option>");
            $.each(data1.arraymuni, function(nom,datos){
              $("#selmpio").append("<option value=\""+datos.COD_DANE+"\">"+datos.NOM_MPIO+"</option>");
            });

            $('#container').highcharts({//funcion qu crea la grafica
              
              chart: {
                type: 'treemap'
              },


              title: {
                  text: 'Encuestas realizadas en el departamento de '+data1.arraydepto[0].NOM_DPTO+'<br>'+data1.arraymision[0].nom_mision+'intervención '+$('#selintervencion').val()+' de Desarrollo Alternativo'
                },
                subtitle: {
                  text: "Distribución municipal. <br>Haga Click sobre la gráfica para desagregar más la información"
                },
              tooltip: {
                  headerFormat: '<span style="font-size:11px"></span>',
                  pointFormat: 'En <span style="color:{point.color}">{point.name}</span> se realizaron <br><b>{point.value:.0f} </b> encuestas<br/>'
                },  
              exporting: {
                sourceWidth: 2000,
                sourceHeight: 700
              },
                
              series: [{
                layoutAlgorithm: 'squarified',
                allowDrillToNode: true,
                dataLabels: {
                  enabled: false,
                  style: {
                      textShadow: ''
                    }
                },
                levelIsConstant: false,
                levels: [{
                  level: 1,
                  dataLabels: {
                    enabled: true,
                    style: {
                      textShadow: ''
                    }
                  },
                  borderWidth: 3
                }],
                data: data1.grafica,
              }],

            });
            
       //Termina function highchart
          },
          error:function(){alert('error');}
        });//Termina Ajax prueva
      }

       });//Termina chage selpeto


//grafica segun monitor      
    $("#selmonitor" ).change(function(){
       if($('#selmonitor').val()!='')
      {
        $("#labelintervencionmoni").show();
        $("#selintervencionmoni").show();
        $("#selintervencionmoni").empty();
        $("#labelmpiomoni").hide();
        $("#selmpiomoni").hide();         
        $("#labeldptomoni").hide();
        $("#seldptomoni").hide();
        $("#labelvdamoni").hide();
        $("#selvdamoni").hide();
        

 $.ajax({url:"siscadi/siscadiidmonitor",type:"POST",data:{monitor:$('#selmonitor').val()},dataType:'json',//llama al controlador siscadi/siscadiidmonitor que trae los valores necesario para la 
          success:function(data1){

      $("#selintervencionmoni").append("<option value=''>Por favor seleccione</option>");
          $.each(data1.arrayinter, function(nom,datos){
            $("#selintervencionmoni").append("<option value=\""+datos.intervencion+"\">"+datos.intervencion+"</option>");
          });

        $('#container').highcharts({
          chart:{type:'column'},
          title:{text:'Encuestas realizadas por '+data1.arraymonitor[0].name+ ' '+data1.arraymonitor[0].last_name+ '<br>en misiones de Desarrollo Alternativo'},
         
          xAxis:{
            categories:[""]
            ,
            crosshair: true
          },
          yAxis:{min:0,title:{text:'Número de encuestas'}},
          tooltip:{
            formatter: function () {
                    return data1.arraymonitor[0].name+ ' '+data1.arraymonitor[0].last_name+ ' a realizado <b>' + this.y + '</b> encuestas a  <span style="color:'+this.series.color+'">'+this.series.name +'</span>';
                }
            
          },
          plotOptions:{series:{borderWidth:0,dataLabels:{enabled:true,format:'{point.y:.0f}'}}},
          series:[{
            name:'Beneficiarios',data:[
            data1.arrayintercountcomi[1]
            ]},
            {name:'Comités',data:[
            data1.arrayintercountcomi[0]
            ]}
          ]
        });
       //Termina function highchart
          },
          error:function(){alert('error');}
        });//Termina Ajax prueva
      }
      else{
        // inicializa solo muestra los input de "Monitor"
        $("#labelmonitor").show();
        $("#selmonitor").show();
        $("#labelintervencion").hide();
        $("#selintervencion").hide();
        $("#labelmpio").hide();
        $("#selmpio").hide();
        $("#labelmision").hide();
        $("#selmision").hide();    
        $("#labeldpto").hide();
        $("#seldpto").hide();
        $("#container").empty();

        
        $("#labelintervencionmoni").hide();
        $("#selintervencionmoni").hide();
        $("#selintervencionmoni").empty();
        $("#labelmpiomoni").hide();
        $("#selmpiomoni").hide();
        $("#labelmisionmoni").hide();
        $("#selmisionmoni").hide();    
        $("#labeldptomoni").hide();
        $("#seldptomoni").hide();
        $("#labelvdamoni").hide();
        $("#selvdamoni").hide();
      }

       });//Termina chage selmonitor

//grafica segun id_monitor _intervencion     
    $("#selintervencionmoni" ).change(function(){
       if($('#selintervencionmoni').val()!='')
      {
        $("#labeldptomoni").show();
        $("#seldptomoni").show();
        $("#seldptomoni").empty();
        

 $.ajax({url:"siscadi/siscadiidmoniinter",type:"POST",data:{monitor:$('#selmonitor').val(),intervencion:$('#selintervencionmoni').val()},dataType:'json',//llama al controlador siscadi/siscadiidmoniinter que trae los valores necesario para la 
          success:function(data1){


        $("#seldptomoni").append("<option value=''>Por favor seleccione</option>");
          $.each(data1.arraydpto, function(nom,datos){
            $("#seldptomoni").append("<option value=\""+datos.COD_DPTO+"\">"+datos.NOM_DPTO+"</option>");
          });

         // Create the chart
     $('#container').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Encuestas realizadas por '+data1.arraymonitor[0].name+ ' '+data1.arraymonitor[0].last_name+ '<br>en la intervención '+$('#selintervencionmoni').val()
            
        },
        subtitle:{text:'Según distribución departamental '},
        xAxis: {
            categories: data1.nombre
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Número de encuestas'
            },
            stackLabels: {
                enabled: true,
                style: {
                    fontWeight: 'bold',
                    color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                }
            }
        },
        legend: {
            
            
            verticalAlign: 'bottom',
            
            
        },
        tooltip: {
            headerFormat: 'En el departamento de <b>{point.x}</b><br/>',
            pointFormat: 'realizó {point.y} encuestas a {series.name} <br> Total general: {point.stackTotal} encuestas <br> '
        },
        plotOptions: {
            column: {
                stacking: 'normal',
                dataLabels: {
                    enabled: true,
                    color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white',
                    style: {
                        textShadow: '0 0 3px black'
                    }
                }
            }
        },
        series: [{
            name: 'Beneficiarios',
            data: data1.arraydptocountbene
        }, {
            name: 'Comités',
            data: data1.arraydptocountcomi
        }]
    });

 
       //Termina function highchart
          },
          error:function(){alert('error');}
        });//Termina Ajax prueva
      }
      else{
        // inicializa solo muestra los input de "Monitor"
         $("#labelmonitor").show();
        $("#selmonitor").show();
        $("#labelintervencion").hide();
        $("#selintervencion").hide();
        $("#labelmpio").hide();
        $("#selmpio").hide();
        $("#labelmision").hide();
        $("#selmision").hide();    
        $("#labeldpto").hide();
        $("#seldpto").hide();
        $("#container").empty();

        $("#selintervencionmoni").empty();
        $("#labelmpiomoni").hide();
        $("#selmisionmoni").hide();    
        $("#labeldptomoni").hide();
        $("#seldptomoni").hide();
        $("#labelvdamoni").hide();
        $("#selvdamoni").hide();
        $("#selmpiomoni").hide();

    $.ajax({url:"siscadi/siscadiidmonitor",type:"POST",data:{monitor:$('#selmonitor').val()},dataType:'json',//llama al controlador siscadi/siscadiidmonitor que trae los valores necesario para la 
          success:function(data1){

      $("#selintervencionmoni").append("<option value=''>Por favor seleccione</option>");
          $.each(data1.arrayinter, function(nom,datos){
            $("#selintervencionmoni").append("<option value=\""+datos.intervencion+"\">"+datos.intervencion+"</option>");
          });

        $('#container').highcharts({
          chart:{type:'column'},
          title:{text:'Encuestas realizadas por '+data1.arraymonitor[0].name+ ' '+data1.arraymonitor[0].last_name+ '<br>en misiones de Desarrollo Alternativo'},
        
          xAxis:{
            categories:[""]
            ,
            crosshair: true
          },
          yAxis:{min:0,title:{text:'Número de encuestas'}},
          tooltip:{
            formatter: function () {
                    return data1.arraymonitor[0].name+ ' '+data1.arraymonitor[0].last_name+ ' a realizado <b>' + this.y + '</b> encuestas a  <span style="color:'+this.series.color+'">'+this.series.name +'</span>';
                }
            
          },
          plotOptions:{series:{borderWidth:0,dataLabels:{enabled:true,format:'{point.y:.0f}'}}},
          series:[{
            name:'Beneficiarios',data:[
            data1.arrayintercountcomi[1]
            ]},
            {name:'Comités',data:[
            data1.arrayintercountcomi[0]
            ]}
          ]
        });
       //Termina function highchart
          },
          error:function(){alert('error');}
        });//Termina Ajax prueva
      }

       });//Termina chage selmonitor

//grafica segun id_monitor depto     
    $("#seldptomoni" ).change(function(){
       if($('#seldptomoni').val()!='')
      {
        $("#labelmpiomoni").show();
        $("#selmpiomoni").show();
        $("#selmpiomoni").empty();
        

 $.ajax({url:"siscadi/siscadiidmonidepto",type:"POST",data:{monitor:$('#selmonitor').val(),intervencion:$('#selintervencionmoni').val(),departamento:$('#seldptomoni').val()},dataType:'json',//llama al controlador siscadi/siscadiidmonidepto que trae los valores necesario para la 
          success:function(data1){
        $("#selmpiomoni").append("<option value=''>Por favor seleccione</option>");
          $.each(data1.arraympio, function(nom,datos){
            $("#selmpiomoni").append("<option value=\""+datos.COD_DANE+"\">"+datos.NOM_MPIO+"</option>");
          });

         // Create the chart
     $('#container').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Encuestas realizadas por '+data1.arraymonitor[0].name+ ' '+data1.arraymonitor[0].last_name+  '<br>en departamento de '+ data1.arraydpto[0].NOM_DPTO+'. Intervención '+$('#selintervencionmoni').val()
            
        },
        subtitle:{text:'Según distribución municipal '},
        xAxis: {
            categories: data1.nombre
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Número de encuestas'
            },
            stackLabels: {
                enabled: true,
                style: {
                    fontWeight: 'bold',
                    color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                }
            }
        },
        legend: {
            
            
            verticalAlign: 'bottom',
            
            
        },
        tooltip: {
            headerFormat: 'En el municipio de <b>{point.x}</b><br/>',
            pointFormat: 'realizó {point.y} encuestas a {series.name} <br> Total general: {point.stackTotal} encuestas <br> '
        },
        plotOptions: {
            column: {
                stacking: 'normal',
                dataLabels: {
                    enabled: true,
                    color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white',
                    style: {
                        textShadow: '0 0 3px black'
                    }
                }
            }
        },
        series: [{
            name: 'Beneficiarios',
            data: data1.arraympiocountbene
        }, {
            name: 'Comités',
            data: data1.arraympiocountcomi
        }]
    });

 
       //Termina function highchart
          },
          error:function(){alert('error');}
        });//Termina Ajax prueva
      }
      else{
        // inicializa solo muestra los input de "intervencion"
         $("#labelmonitor").show();
        $("#selmonitor").show();
        $("#labelintervencion").hide();
        $("#selintervencion").hide();
        $("#labelmpio").hide();
        $("#selmpio").hide();
        $("#labelmision").hide();
        $("#selmision").hide();    
        $("#labeldpto").hide();
        $("#seldpto").hide();
        $("#container").empty();

        $("#selmpiomoni").hide();
        $("#labelmpiomoni").hide();
        $("#selmisionmoni").hide(); 
        $("#seldptomoni").empty();
        $("#labelvdamoni").hide();
        $("#selvdamoni").hide();

    $.ajax({url:"siscadi/siscadiidmoniinter",type:"POST",data:{monitor:$('#selmonitor').val(),intervencion:$('#selintervencionmoni').val()},dataType:'json',//llama al controlador siscadi/siscadiidmoniinter que trae los valores necesario para la 
          success:function(data1){


        $("#seldptomoni").append("<option value=''>Por favor seleccione</option>");
          $.each(data1.arraydpto, function(nom,datos){
            $("#seldptomoni").append("<option value=\""+datos.COD_DPTO+"\">"+datos.NOM_DPTO+"</option>");
          });

         // Create the chart
     $('#container').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Encuestas realizadas por '+data1.arraymonitor[0].name+ ' '+data1.arraymonitor[0].last_name+  '<br>en la intervención '+$('#selintervencionmoni').val()
            
        },
        subtitle:{text:'Según distribución departamental '},
        xAxis: {
            categories: data1.nombre
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Número de encuestas'
            },
            stackLabels: {
                enabled: true,
                style: {
                    fontWeight: 'bold',
                    color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                }
            }
        },
        legend: {
            
            
            verticalAlign: 'bottom',
            
            
        },
        tooltip: {
            headerFormat: 'En el departamento de <b>{point.x}</b><br/>',
            pointFormat: 'realizó {point.y} encuestas a {series.name} <br> Total general: {point.stackTotal} encuestas <br> '
        },
        plotOptions: {
            column: {
                stacking: 'normal',
                dataLabels: {
                    enabled: true,
                    color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white',
                    style: {
                        textShadow: '0 0 3px black'
                    }
                }
            }
        },
        series: [{
            name: 'Beneficiarios',
            data: data1.arraydptocountbene
        }, {
            name: 'Comités',
            data: data1.arraydptocountcomi
        }]
    });
       //Termina function highchart
          },
          error:function(){alert('error');}
        });//Termina Ajax prueva
      }

       });//Termina chage selintermoni

  
  //grafica segun id_monitor muni     
    $("#selmpiomoni" ).change(function(){
       if($('#selmpiomoni').val()!='')
      {
        $("#labelvdamoni").show();
        $("#selvdamoni").show();
        $("#selvdamoni").empty();
        

 $.ajax({url:"siscadi/siscadiidmonimuni",type:"POST",data:{monitor:$('#selmonitor').val(),intervencion:$('#selintervencionmoni').val(),departamento:$('#seldptomoni').val(),municipio:$('#selmpiomoni').val()},dataType:'json',//llama al controlador siscadi/siscadiidmonimuni que trae los valores necesario para la 
          success:function(data1){

        $("#selvdamoni").append("<option value=''>Por favor seleccione</option>");
          $.each(data1.arrayvda, function(nom,datos){
            $("#selvdamoni").append("<option value=\""+datos.COD_UNODC+"\">"+datos.NOM_TERR+"</option>");
          });

         // Create the chart
     $('#container').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text:  'Encuestas realizadas por '+data1.arraymonitor[0].name+ ' '+data1.arraymonitor[0].last_name+'<br>en  '+ data1.arraymuni[0].NOM_MPIO+'-'+ data1.arraydpto[0].NOM_DPTO+'. Intervención '+$('#selintervencionmoni').val()
            
        },
        subtitle:{text:'Según distribución veredal '},
        xAxis: {
            categories: data1.nombre
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Número de encuestas'
            },
            stackLabels: {
                enabled: true,
                style: {
                    fontWeight: 'bold',
                    color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                }
            }
        },
        legend: {
            
            
            verticalAlign: 'bottom',
            
            
        },
        tooltip: {
            headerFormat: 'En el departamento de <b>{point.x}</b><br/>',
            pointFormat: 'realizó {point.y} encuestas a {series.name} <br> Total general: {point.stackTotal} encuestas <br> '
        },
        plotOptions: {
            column: {
                stacking: 'normal',
                dataLabels: {
                    enabled: true,
                    color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white',
                    style: {
                        textShadow: '0 0 3px black'
                    }
                }
            }
        },
        series: [{
            name: 'Beneficiarios',
            data: data1.arrayvdacountbene
        }, {
            name: 'Comités',
            data: data1.arrayvdacountcomi
        }]
    });

 
       //Termina function highchart
          },
          error:function(){alert('error');}
        });//Termina Ajax prueva
      }
      else{
    
         $("#labelmonitor").show();
        $("#selmonitor").show();
        $("#labelintervencion").hide();
        $("#selintervencion").hide();
        $("#labelmpio").hide();
        $("#selmpio").hide();
        $("#labelmision").hide();
        $("#selmision").hide();    
        $("#labeldpto").hide();
        $("#seldpto").hide();
        $("#container").empty();

        $("#selmpiomoni").empty();
        $("#labelvdamoni").hide();
        $("#selvdamoni").hide();


        

 $.ajax({url:"siscadi/siscadiidmonidepto",type:"POST",data:{monitor:$('#selmonitor').val(),intervencion:$('#selintervencionmoni').val(),departamento:$('#seldptomoni').val()},dataType:'json',//llama al controlador siscadi/siscadiidmonidepto que trae los valores necesario para la 
          success:function(data1){

        $("#selmpiomoni").append("<option value=''>Por favor seleccione</option>");
          $.each(data1.arraympio, function(nom,datos){
            $("#selmpiomoni").append("<option value=\""+datos.COD_DANE+"\">"+datos.NOM_MPIO+"</option>");
          });

         // Create the chart
     $('#container').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Encuestas realizadas por '+data1.arraymonitor[0].name+ ' '+data1.arraymonitor[0].last_name+ '<br>en departamento de '+ data1.arraydpto[0].NOM_DPTO+'. Intervención '+$('#selintervencionmoni').val()
            
        },
        subtitle:{text:'Según distribución municipal '},
        xAxis: {
            categories: data1.nombre
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Número de encuestas'
            },
            stackLabels: {
                enabled: true,
                style: {
                    fontWeight: 'bold',
                    color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                }
            }
        },
        legend: {
            
            
            verticalAlign: 'bottom',
            
            
        },
        tooltip: {
            headerFormat: 'En el departamento de <b>{point.x}</b><br/>',
            pointFormat: 'realizó {point.y} encuestas a {series.name} <br> Total general: {point.stackTotal} encuestas <br> '
        },
        plotOptions: {
            column: {
                stacking: 'normal',
                dataLabels: {
                    enabled: true,
                    color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white',
                    style: {
                        textShadow: '0 0 3px black'
                    }
                }
            }
        },
        series: [{
            name: 'Beneficiarios',
            data: data1.arraympiocountbene
        }, {
            name: 'Comités',
            data: data1.arraympiocountcomi
        }]
    });

 
       //Termina function highchart
          },
          error:function(){alert('error');}
        });//Termina Ajax prueva
      }

       });//Termina chage seldptomoni


//grafica segun id_monitor muni     
    $("#selvdamoni" ).change(function(){
       if($('#selvdamoni').val()!='')
      {
        

 $.ajax({url:"siscadi/siscadiidmonivda",type:"POST",data:{monitor:$('#selmonitor').val(),intervencion:$('#selintervencionmoni').val(),departamento:$('#seldptomoni').val(),municipio:$('#selmpiomoni').val(),vereda:$('#selvdamoni').val()},dataType:'json',//llama al controlador siscadi/siscadiidmonimuni que trae los valores necesario para la 
          success:function(data1){

var colors = Highcharts.getOptions().colors,
        categories = data1.nombre,
        data = data1.grafica,
        browserData = [],
        versionsData = [],
        i,
        j,
        dataLen = data.length,
        drillDataLen,
        brightness;


    // Build the data arrays
    for (i = 0; i < dataLen; i += 1) {

        // add browser data
        browserData.push({
            name: categories[i],
            y: data[i].y,
            color: data[i].color
        });

        // add version data
        drillDataLen = data[i].drilldown.data.length;
        for (j = 0; j < drillDataLen; j += 1) {
            brightness = 0.2 - (j / drillDataLen) / 5;
            versionsData.push({
                name: data[i].drilldown.categories[j],
                y: data[i].drilldown.data[j],
                color: Highcharts.Color(data[i].color).brighten(brightness).get()
            });
        }
    }
$('#container').highcharts({
        chart: {
            type: 'pie'
        },
        title: {
            text: 'Encuestas realizadas por '+data1.arraymonitor[0].name+ ' '+data1.arraymonitor[0].last_name+ '<br>vereda  '+ data1.arrayvda[0].NOM_TERR+', '+ data1.arraymuni[0].NOM_MPIO+'- '+ data1.arraydpto[0].NOM_DPTO+'. Intervención '+$('#selintervencionmoni').val()
        },
         subtitle:{text:'Según distribución por tipo de misión '},
        yAxis: {
            title: {
                text: 'Total percent market share'
            }
        },
        plotOptions: {
            pie: {
                shadow: false,
                center: ['50%', '50%']
            }
        },
        tooltip: {
      headerFormat: '<span style="font-size:11px"></span>',
      pointFormat: 'En <span style="color:{point.color}"><strong>{point.name}</strong></span> hay <br><b>{point.y} </b> encuestas reportadas<br/>'
    },
    legend: {
      align: 'left',
      layout: 'vertical',
      verticalAlign: 'top',
      x: 40,
      y: 0
    },  
    exporting: {
      sourceWidth: 1300,
      sourceHeight: 1000
    },
        series: [{
            name: 'Grupo de situación',
            data: browserData,
            size: '60%',
      showInLegend: false,
            dataLabels: {
                formatter: function () {
                    return this.y > 0 ? this.point.name : null;
                },
        style: {
          textShadow: ''
        },
                color: 'white',
        
                distance: -30
            }
        }, {
            name: 'Tipo de situación',
            data: versionsData,
            size: '80%',
            innerSize: '60%',
            dataLabels: {
                formatter: function () {
                    // display only if larger than 1
                    return this.y > 0 ? '<b>' + this.point.name + ':</b> ' + this.y : null;
                },
      style: {
          textShadow: ''
        }
            }
        }]
    });

 
       //Termina function highchart
          },
          error:function(){alert('error');}
        });//Termina Ajax prueva
      }
      else{
    
        $("#labelmonitor").show();
        $("#selmonitor").show();
        $("#labelintervencion").hide();
        $("#selintervencion").hide();
        $("#labelmpio").hide();
        $("#selmpio").hide();
        $("#labelmision").hide();
        $("#selmision").hide();    
        $("#labeldpto").hide();
        $("#seldpto").hide();
        $("#container").empty();

        $("#selvdamoni").empty();
          

  $.ajax({url:"siscadi/siscadiidmonimuni",type:"POST",data:{monitor:$('#selmonitor').val(),intervencion:$('#selintervencionmoni').val(),departamento:$('#seldptomoni').val(),municipio:$('#selmpiomoni').val()},dataType:'json',//llama al controlador siscadi/siscadiidmonimuni que trae los valores necesario para la 
          success:function(data1){

        $("#selvdamoni").append("<option value=''>Por favor seleccione</option>");
          $.each(data1.arrayvda, function(nom,datos){
            $("#selvdamoni").append("<option value=\""+datos.COD_UNODC+"\">"+datos.NOM_TERR+"</option>");
          });

         // Create the chart
     $('#container').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Encuestas realizadas por '+data1.arraymonitor[0].name+ ' '+data1.arraymonitor[0].last_name+'<br>en  '+ data1.arraymuni[0].NOM_MPIO+'-'+ data1.arraydpto[0].NOM_DPTO+'. Intervención '+$('#selintervencionmoni').val()
        },
        subtitle:{text:'Según distribución veredal '},
        xAxis: {
            categories: data1.nombre
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Número de encuestas'
            },
            stackLabels: {
                enabled: true,
                style: {
                    fontWeight: 'bold',
                    color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                }
            }
        },
        legend: {
            
            
            verticalAlign: 'bottom',
            
            
        },
        tooltip: {
            headerFormat: 'En el departamento de <b>{point.x}</b><br/>',
            pointFormat: 'realizó {point.y} encuestas a {series.name} <br> Total de general: {point.stackTotal} encuestas <br> '
        },
        plotOptions: {
            column: {
                stacking: 'normal',
                dataLabels: {
                    enabled: true,
                    color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white',
                    style: {
                        textShadow: '0 0 3px black'
                    }
                }
            }
        },
        series: [{
            name: 'Beneficiarios',
            data: data1.arrayvdacountbene
        }, {
            name: 'Comites',
            data: data1.arrayvdacountcomi
        }]
    });

 
       //Termina function highchart
          },
          error:function(){alert('error');}
        });//Termina Ajax prueva
      }

       });//Termina chage seldptomoni 

    //para que los menus pequeño y grande funcione
          $( "#siscadi" ).addClass("active");
          $( "#indicadoressiscadi" ).addClass("active");
          $( "#iniciomenupeq" ).html("<small> INICIO</small>");
          $( "#siscadimenupeq" ).html("<strong>SISCADI<span class='caret'></span></strong>");
          $( "#indicadoressiscadimenupeq" ).html("<strong><span class='glyphicon glyphicon-ok'></span>Resultados de recolección</strong>");

    });
    </script>
@stop

@endif<!--Cierra el if de mostrar el contenido de la página si esta autenticado-->