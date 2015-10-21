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
            width: 300px;
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
        <h1 class="text-center text-primary">RELACIÓN DE PROCESOS ADJUDICADOS PARA EDICIÓN DE COORDENADAS</h1>
      </div>
    <div class="row">
      <?php $status=Session::get('status'); ?>
      @if($status=='ok_estatus')
      <div class="col-sm-1"></div>    
      <div id = "mensajeestatus" class="alert alert-success col-sm-10"><button class="close" data-dismiss="alert" type="button">×</button>
      <i class="bg-success"></i> El proceso actualizado con éxito</div>
      <div class="col-sm-1"></div>
      @endif
      @if($status=='error_estatus')
      <div class="col-sm-1"></div>    
      <div id = "mensajeestatus"class="alert alert-danger col-sm-10"><button class="close" data-dismiss="alert" type="button">×</button>
      <i class="bg-danger"></i> El proceso NO fue extualizado</div>
      <div class="col-sm-1"></div>
      @endif

    </div>
    <div class="row">
      <div class="col-sm-1"></div>
      <div class="col-sm-10">  
        <!-- Standard button -->
        <button id="btnedicoord" title="Edición de coordenadas" disabled="disabled" data-target="#edicoordModal"  data-toggle="modal" type="button" class="btn btn-primary">Edición de coordenadas</button>
      </div>
      
      <div class="col-sm-1"></div>
    </div>

    <div class="row">
    <!--Listado de Procesos Iniciales para edicion -->
      <br>
      <div class="col-sm-1"></div>
      <div class="col-xs-12 col-sm-10" >
        <table id="tablacoordenadas" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
          <thead>
            <tr class="well text-primary ">
              <th class="text-center">Proceso</th>
              <th class="text-center">Modificación de Coordenadas</th>
              <th class="text-center">longitud</th>
              <th class="text-center">latitud</th>
            </tr>
          </thead>
          <tbody>
            @foreach($arrayproccoord as $coordenadas)
              <tr id="{{$coordenadas->id_proceso}}"> 
                <td>{{$coordenadas->id_proceso}}</td>
                @if($coordenadas->updatedcoord<>NULL)<td align="center"><p style="display:none;">{{$coordenadas->updatedcoord}}</p><span class="glyphicon glyphicon-ok-sign" aria-hidden="true" style="color:green"></span></td> @else <td align="center"><p style="display:none;">{{$coordenadas->updatedcoord}}</p><span class="glyphicon glyphicon-remove-sign" aria-hidden="true" style="color:red"></span></td> @endif
                <td>{{$coordenadas->longitud}}</td>
                <td>{{$coordenadas->latitud}}</td>               
              </tr>
            @endforeach
          </tbody>
        </table>
      
      </div>
      <div class="col-sm-1"></div>
      <br>
    </div>
      
  </div> 

<div id="edicoordModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><strong>Cargue de Coordenadas del Proceso</strong></h4>
      </div>
      <div class="modal-body">
        <form role="form" action="tierras/coordenadas-edicion" method="post" id="formEdit" enctype="multipart/form-data">
          <div class="form-group">
            <label for="Proceso" class="control-label">NP:</label>
            <input id="modnp" type="text" class="form-control" name="modnp" readonly >
          </div>
          <div class="form-group">
            <label for="proceso" class="control-label">Longitud:</label>
            <br>
            <div class="col-sm-4">
              <label for="proceso" class="control-label">Grados:</label>
              <input id="modgrados" type="text" class="form-control" name="modgrados">
            </div>
            <div class="col-sm-4">
              <label for="proceso" class="control-label">Minutos:</label>
              <input id="modminutos" type="text" class="form-control" name="modminutos">
            </div>
            <div class="col-sm-4">
              <label for="proceso" class="control-label">Segundos:</label>
              <input id="modsegundos" type="text" class="form-control" name="modsegundos">
            </div>
          </div>
          <div class="form-group">
            <label for="proceso" class="control-label">Latitud:</label>
            <br>
            <div class="col-sm-4">
              <label for="proceso" class="control-label">Grados:</label>
              <input id="modgrados" type="text" class="form-control" name="modgrados">
            </div>
            <div class="col-sm-4">
              <label for="proceso" class="control-label">Minutos:</label>
              <input id="modminutos" type="text" class="form-control" name="modminutos">
            </div>
            <div class="col-sm-4">
              <label for="proceso" class="control-label">Segundos:</label>
              <input id="modsegundos" type="text" class="form-control" name="modsegundos">
            </div>
          </div>
          <br>
          <br>
          <br>
          <div id="map"></div> 
              <script>
                var map = L.map('map').setView([4.5, -74.1], 5);
                L.esri.basemapLayer("Gray").addTo(map);
                //L.esri.dynamicMapLayer("http://services.nationalmap.gov/arcgis/rest/services/3DEPElevationIndex/MapServer/0", { opacity : 1}).addTo(map);
                //var servicioarcgis = new L.esri.FeatureLayer("http://arcgisserver.unodc.org.co/arcgis/rest/services/prueba/MyMapService/MapServer/0").addTo(map);
              </script>                   
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Guardar Coordenadas</button>
      </div>
        </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
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
          $( "#tierrascoord" ).addClass("active");
          $( "#iniciomenupeq" ).html("<small> INICIO</small>");
          $( "#tierrasmenupeq" ).html("<strong>MODULO TIERRAS<span class='caret'></span></strong>");
          $( "#tierrascoordmenupeq" ).html("<strong><span class='glyphicon glyphicon-ok'></span>Edición de Coordenadas</strong>");
          $( "#mensajeestatus" ).fadeOut(5000);

          var table = $('#tablacoordenadas').DataTable();

          $('#tablacoordenadas tbody').on('click', 'tr', function () {
              if ( $(this).hasClass('active') ) {
                $(this).removeClass('active');
                $("#btnedicoord").prop('disabled', true);
              }
              else {
                table.$('tr.active').removeClass('active');
                $(this).addClass('active');
                $("#btnedicoord").prop('disabled', false);
                $( "#proceso" ).val($('td', this).eq(0).text());
                
              }
              
          });

     
      });
    
    </script>
@stop

@endif<!--Cierra el if de mostrar el contenido de la página si esta autenticado-->