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
      <div class="col-sm-1"></div>
      <div class="col-sm-10">
      <h2 class="text-center text-primary">Reporte de sincronización de datos por organización</h2>
            @foreach($pp_datos as $dato1)@endforeach
            
            <p class="lead text-justify"><br>En total se han sincronizados {{$dato1->PP}} proyectos productivos ({{$dato1->BEN}} titulares) de {{$dato1->departamen}} departamentos, {{$dato1->municipio}} municipios, {{$dato1->territorio}} territorios y {{$dato1->memorando}} memorandos de acuerdo. La siguiente Tabla presenta el panorama general de sincronización por organización. Se debe tener en cuenta que los datos repetidos no se presentan en este reporte.</p>
            
          </div>
      <div class="col-sm-1"></div>
    </div>
    <div class="row">
<!--aca se escribe el codigo-->
      <div class="col-sm-1"></div>
      <div class="col-xs-12 col-sm-10">
      <br>
        <table id="tablaorganizacion" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
          <thead>  
            <tr class="well text-primary ">
              <th class="text-center">Organización</th>
              <th class="text-center">Memorando</th>
              <th class="text-center">Poligonos</th>
              <th class="text-center">Puntos</th>
              <th class="text-center">Total Proyectos Productivos</th>
              <th class="text-center">Beneficiarios</th>
              <th class="text-center">Beneficiarios Asociados</th>              
            </tr>
          </thead>
          <tbody>            
            @foreach($distribucion as $dist)
              <tr id="{{$dist->id_categoria_ejecutor}}">
                <td >{{$dist->organizacion}}</td>
                <td >{{$dist->memorando}}</td>
                <td >{{$dist->POLY}}</td>
                <td >{{$dist->PTO}}</td>
                <td >{{$dist->TOTALPP}}</td>
                <td >{{$dist->BENEF}}</td>
                <td >{{$dist->asociados}}</td>                
              </tr>            
            @endforeach            
          </tbody>
        </table>      
      </div>
      <div class="col-sm-1"></div>
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
@section('js')
  @parent
    <script>
    $("#btnExport").click(function (e) {
    window.open('data:application/vnd.ms-excel,' + $('#tablaorganizacion').html());
    e.preventDefault();
    });
    

      $(document).ready(function() {
          //para que los menus pequeño y grande funcione
          $( "#geoapi" ).addClass("active");
          $( "#geoapirepordistorg" ).addClass("active");
          $( "#iniciomenupeq" ).html("<small> INICIO</small>");
          $( "#geoapimenupeq" ).html("<strong>GeoApi<span class='caret'></span></strong>");
          $( "#geoapirepordistorgmenupeq" ).html("<strong>Distribución por Organización<span class='caret'></span></strong>");
          var table = $('#tablaorganizacion').DataTable();


     
      });
    
    </script>
@stop

@endif<!--Cierra el if de mostrar el contenido de la página si esta autenticado-->