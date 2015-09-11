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
  <link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.7.5/leaflet.css" />
        <style>          
          #map {
            width: 100%;
            height: 600px;
            margin:0 auto 0 auto;
            position: relative;
            top: 1%;
           
            
            }
      </style>
@stop
<!--agrega JavaScript dentro del header a la pagina-->
@section('js')
  @parent
  <script src="http://cdn.leafletjs.com/leaflet-0.7.5/leaflet.js"></script>
  <script src="http://cdn-geoweb.s3.amazonaws.com/esri-leaflet/1.0.0-rc.3/esri-leaflet.js"></script>
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
    <br>
<!--aca se escribe el codigo-->
        <div class="col-md-12">  
            <div id="map"></div>
            <script>
            var map = L.map('map').setView([4.5, -74.1], 6);
            L.esri.basemapLayer("Gray").addTo(map);
            //L.esri.dynamicMapLayer("http://services.nationalmap.gov/arcgis/rest/services/3DEPElevationIndex/MapServer/0", { opacity : 1}).addTo(map);
            var servicioarcgis = new L.esri.FeatureLayer("http://arcgisserver.unodc.org.co/arcgis/rest/services/prueba/MyMapService/MapServer/0").addTo(map);
            </script>
        </div>

        
    
<!--fin del codigo-->    
    </div>
    <br>    
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
    <script>
    

      $(document).ready(function() {
          //para que los menus pequeño y grande funcione
          $( "#tierras" ).addClass("active");
          $( "#tierrasmapas" ).addClass("active");
          $( "#iniciomenupeq" ).html("<small> INICIO</small>");
          $( "#tierrasmenupeq" ).html("<strong>MODULO TIERRAS<span class='caret'></span></strong>");
          $( "#tierrasmapasmenupeq" ).html("<strong><span class='glyphicon glyphicon-ok'></span>Mapas</strong>");
               
      });
    
    </script>
@stop

@endif<!--Cierra el if de mostrar el contenido de la página si esta autenticado-->