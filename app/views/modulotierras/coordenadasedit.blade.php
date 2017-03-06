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
      width:300px;
      height: 300px;
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
    <!--aca se escribe el codigo-->
    <div class="row">
      <div class="col-sm-1"></div>
      <div class="col-sm-10">                  
        <h1 class="text-center text-primary">SELECCIONE 1 DE {{count($arrayeditcoordenainsumos[1])}} COORDENADAS REALES DEL PROCESO: {{$arrayeditcoordenainsumos[0][0]->id_proceso}}</h1>
      </div>  
      <div class="col-sm-1"></div>
    </div>
    <div class="row">
      <!--Listado de Procesos Iniciales para edicion -->
      <div class="col-sm-1"></div>
        <div class="col-sm-10">
          <form role="form" action="tierras/guardar-coordenadas" method="post" id="formEdit" enctype="multipart/form-data">
            <input id="idpro" class="form-control" name="idpro" type="hidden" value="{{$arrayeditcoordenainsumos[0][0]->id_proceso}}">
            <div class="form-group">
              <br/>
              <label for="proceso" class="control-label">Latitud: 
              <input type="radio" name="nortesur" id="radionorte" value="1" required> Norte - 
              <input type="radio" name="nortesur" id="radiosur" value="2" required> Sur
              <span class="label label-danger" id="c"></span>
              </label>
              <br/>
              <div class="col-sm-4">
                <label for="proceso" class="control-label">Grados:</label>
                <input id="latgrados" type="number" class="form-control" name="latgrados" min="-4" max="13" required>
                <span class="label label-danger" id="a"></span>
                <span class="label label-danger" id="b"></span>
              </div>
              <div class="col-sm-4">
                <label for="proceso" class="control-label">Minutos:</label>
                <input id="latminutos" type="number" class="form-control" name="latminutos" min="0" max="59" required>
                <span class="label label-danger" id="d"></span>
              </div>
              <div class="col-sm-4">
                <label for="proceso" class="control-label">Segundos:</label>
                <input id="latsegundos" type="number" class="form-control" name="latsegundos" max="59.99" required step="any">
                <span class="label label-danger" id="e"></span>
                <br/>
              </div>
            </div>
            <div class="form-group">
              <label for="proceso" class="control-label">Longitud (Occidente):</label>
              <br>
              <div class="col-sm-4">
                <label for="proceso" class="control-label">Grados:</label>
                <input id="longrados" type="number" class="form-control" name="longrados" min="-80" max="-67" required>
                <span class="label label-danger" id="f"></span>
              </div>
              <div class="col-sm-4">
                <label for="proceso" class="control-label">Minutos:</label>
                <input id="lonminutos" type="number" class="form-control" name="lonminutos" min="0" max="59" required>
                <span class="label label-danger" id="g"></span>
              </div>
              <div class="col-sm-4">
                <label for="proceso" class="control-label">Segundos:</label>
                <input id="lonsegundos" type="number" class="form-control" name="lonsegundos" max="59.99" required step="any">
                <span class="label label-danger" id="h"></span>
                <br/>
              </div>
            </div>
            <br>
            <br>
            <br>
            <div id="map"></div>
              <script>
                var map = L.map('map').setView([4.5, -74.1], 5);
                L.esri.basemapLayer("Gray").addTo(map);
              </script>
          <br/>
        </div>
        <div class="row">
          <div class="form-group text-center"  id="carguedocumento">
            <button type="submit" class="btn btn-primary">Guardar Coordenadas</button>
          </div>
        </div>
        </form>
        </div>
      <div class="col-sm-1"></div>
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
@section('js')
  @parent
    <script>
      $(document).ready(function(){
        //para que los menus pequeño y grande funcione
        $("#a").hide(); 
        $( "#tierras" ).addClass("active");
        $( "#tierrascoord" ).addClass("active");
        $( "#iniciomenupeq" ).html("<small> INICIO</small>");
        $( "#tierrasmenupeq" ).html("<strong>MODULO TIERRAS<span class='caret'></span></strong>");
        $( "#tierrascoordmenupeq" ).html("<strong><span class='glyphicon glyphicon-ok'></span>Validación de Coordenadas</strong>");
        $( "#mensajeestatus" ).fadeOut(5000);
        $('#latgrados').keyup(function(){
          $('#lonsegundos').val("");
          var latgrados = $('#latgrados').val();
          var sur = document.getElementById('radiosur').checked;
          if((sur==true)&&(latgrados>0)){
            $('#a').text("Los grados deben ser negativos");
            $("#a").show();
            $('#latgrados').val("");
          }
          else{
            $('#latminutos').prop('disabled', false);
            $("#a").hide();
          }
        });
        $('#latgrados').keyup(function(){
          var latgrados = $('#latgrados').val();
          var norte = document.getElementById('radionorte').checked;
          if((norte==true)&&(latgrados<0)){
            $('#b').text("Los grados deben ser positivos");
            $("#b").show();
            $('#latgrados').val("");
          }
          else{
            $('#latminutos').prop('disabled', false);
            $("#b").hide();
          }
        });
        $('#radionorte').change(function(){
          $('#latgrados').val("");
          $('#lonsegundos').val("");
        });
        $('#radiosur').change(function(){
          $('#latgrados').val("");
          $('#lonsegundos').val("");
        });
        $('#latminutos').keyup(function(){
          $('#lonsegundos').val("");
        });
        $('#latsegundos').keyup(function(){
          $('#lonsegundos').val("");
        });
        $('#longrados').blur(function(){
          $('#lonsegundos').val("");
          var a = $('#longrados').val();
          var c = -80;
          var d = -67;
          if((a<c)||(a>d))
          {
            $('#f').text("Rango valido -80° y -67°");
            $("#f").show();
          }
          else{
            $("#f").hide();
          }
        });
        $('#longrados').keyup(function(){
          $('#lonsegundos').val("");
        });
        $('#lonminutos').keyup(function(){
          $('#lonsegundos').val("");
        });
        $('#lonsegundos').keyup(function(){
          if(validacion() == true){
            var latGG = $('#latgrados').val();
            var latMM = $('#latminutos').val();
            var latSS = $('#latsegundos').val();
            var longGG = $('#longrados').val();
            var longMM = $('#lonminutos').val();
            var longSS = $('#lonsegundos').val();
            var sur = document.getElementById('radiosur').checked;
            var norte = document.getElementById('radionorte').checked;
            if(sur==true){
              Lat=parseInt(latGG)-parseFloat(latMM/60)-parseFloat(latSS/3600);
            }
            if(norte==true){
              var Lat = parseInt(latGG)+parseFloat(latMM/60)+parseFloat(latSS/3600);
            }
            var Long = parseInt(longGG)-parseFloat(longMM/60)-parseFloat(longSS/3600);
            if((norte==true)||(sur==true)){
              $("#c").hide();
              try {
                map.removeLayer(marker);
                var Limites=[[parseFloat(Lat) + 0.5, parseFloat(Long) - 0.5],[parseFloat(Lat) - 0.5, parseFloat(Long) + 0.5]]
                marker = new L.Marker([Lat,Long], {draggable:true});
                map.addLayer(marker);
                map.fitBounds(Limites);
              }
              catch(err) {
                var Limites=[[parseFloat(Lat) + 0.5, parseFloat(Long) - 0.5],[parseFloat(Lat) - 0.5, parseFloat(Long) + 0.5]]
                marker = new L.Marker([Lat,Long]);
                map.addLayer(marker);
                map.fitBounds(Limites);
              }
            }
            else{
              $('#c').text("Seleccione latitud");
              $("#c").show();
            }
          }
          else{
            $('#lonsegundos').val("");
          }
        });
      });
      function validacion() {
        var latGG = $('#latgrados').val();
        var latMM = $('#latminutos').val();
        var latSS = $('#latsegundos').val();
        var longGG = $('#longrados').val();
        var longMM = $('#lonminutos').val();
        var longSS = $('#lonsegundos').val();
        var sur = document.getElementById('radiosur').checked;
        var norte = document.getElementById('radionorte').checked;
        if((norte==false)&&(sur==false)){
          $('#c').text("Seleccione latitud");
          $("#c").show();
          $("#c").fadeOut(5000);
          return false;
        }
        else if(latGG ==""){
          $('#a').text("Escriba la latitud");
          $("#a").show();
          $("#a").fadeOut(5000);
        }
        else if(latMM ==""){
          $('#d').text("Escriba los minutos");
          $("#d").show();
          $("#d").fadeOut(5000);
        }
        else if(latSS ==""){
          $('#e').text("Escriba los minutos");
          $("#e").show();
          $("#e").fadeOut(5000);
        }
        else if(longGG ==""){
          $('#f').text("Escriba la latitud");
          $("#f").show();
          $("#f").fadeOut(5000);
        }
        else if(longMM ==""){
          $('#g').text("Escriba los minutos");
          $("#g").show();
          $("#g").fadeOut(5000);
        }
        else if(longSS ==""){
          $('#h').text("Escriba los segundos");
          $("#h").show();
          $("#h").fadeOut(5000);
        }
        else{
          return true;
        }
      }
    </script>
@stop
@endif<!--Cierra el if de mostrar el contenido de la página si esta autenticado-->