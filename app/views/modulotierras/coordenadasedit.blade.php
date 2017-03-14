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
      height: 500px;
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
      <div class="col-xs-12 col-sm-10">                  
        <h1 class="text-center text-primary">SELECCIONE 1 DE {{count($arrayeditcoordenainsumos[1])}} COORDENADAS REALES DEL PROCESO: {{$arrayeditcoordenainsumos[0][0]->id_proceso}}</h1>
      </div>  
      <div class="col-sm-1"></div>
    </div>
    <div class="row">
      <div class="col-sm-1"></div>
      <form role="form" action="tierras/guardar-coordenadas" method="post" id="formconsulcoord">
        <div class="col-sm-10">
          <!-- Standard button -->
          <button id="btnguardcoord" title="Presione para editar una novedad" disabled="disabled" type="submit" type="button" class="btn btn-primary">Guardar coordenada seleccionada</button>
          <input id="keyodk" type="hidden" class="form-control" name="keyodk">
        </div>
        <div class="col-sm-1"></div>
      </form>
    </div>
    <br>
    <div class="row">
      <div class="col-sm-1"></div>
      <div class="col-xs-12 col-sm-10">
        <table id="tablacoordenadas" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
          <thead>
            <tr class="well text-primary ">              
              <th class="text-center">Novedad</th>
              <th class="text-center">Longitud</th>
              <th class="text-center">Latitud</th>
              <th class="text-center">Cargado por</th>              
            </tr>
          </thead>
          <tbody>
            @foreach($arrayeditcoordenainsumos[1] as $cantcoord)
              <tr id='{{$cantcoord->llave}}'>                              
                <td>
                  @foreach($arrayeditcoordenainsumos[0] as $procesonovedad)
                    @if($cantcoord->llave==$procesonovedad->llave)                        
                        @if($procesonovedad->novedad==1)
                          <div class="bg-danger">Punto fuera de la vereda</div>
                        @elseif ($procesonovedad->novedad==2)
                          <div class="bg-danger">Punto fuera del municipio</div>
                        @elseif ($procesonovedad->novedad==3)
                          <div class="bg-danger">Punto fuera del departamento</div>
                        @elseif ($procesonovedad->novedad==4)
                          <div class="bg-danger">Precisión de coordenadas es baja</div>
                         @elseif ($procesonovedad->novedad==5)
                          <div class="bg-danger">Proceso repetido</div>
                        @endif                          
                    @endif
                  @endforeach
                </td>
                <td>{{$procesonovedad->longitud}}</td>
                <td>{{$procesonovedad->latitud}}</td>
                <td>                    
                  @foreach($arrayeditcoordenainsumos[2] as $tecnicos)
                    @if($procesonovedad->id_tecnico==$tecnicos->cedula)
                      {{$tecnicos->nombre}}
                    @endif
                  @endforeach
                </td>                              
              </tr>                    
            @endforeach             
          </tbody>
        </table>

      </div>
      <div class="col-sm-1"></div>
    </div>
    <div class="row">
      <!--Listado de Procesos Iniciales para edicion  @if($cantcoord->llave==$procesonovedad->llave)           @else               @endif   -->
      <div class="col-sm-1"></div>
      <div class="col-sm-10">          
        <div id="map"></div>
          <script>
            var map = L.map('map').setView([4.5, -74.1], 5);
            L.esri.basemapLayer("Gray").addTo(map);
          </script>          
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
        var table = $('#tablacoordenadas').DataTable();
        $('#tablacoordenadas tbody').on('click', 'tr', function () {
          if ( $(this).hasClass('active') ) {
            $(this).removeClass('active');
            $("#btnguardcoord").prop('disabled', true);
            map.removeLayer(marker);
            map.fitBounds([
                [-4.855, -79.138],
                [12.735, -67.242]
            ]);
          }
          else {
            table.$('tr.active').removeClass('active');
            $(this).addClass('active');
            $("#btnguardcoord").prop('disabled', false);            
            $( "#keyodk" ).val($('tr', this).context.id);            
            
            var Lat = $('td', this).eq(2).text();
            var Long = $('td', this).eq(1).text();
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
        });
      });

      /*
      
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
    */

    </script>
@stop
@endif<!--Cierra el if de mostrar el contenido de la página si esta autenticado-->