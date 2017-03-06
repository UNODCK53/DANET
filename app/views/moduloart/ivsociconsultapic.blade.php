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
        <h2 class="text-center text-primary">Consulta PIC</h2>
        <br>
        <p class="lead text-justify">A continuación se presenta el avance de los Proyectos de pequeña infraestructura comunitaria-PIC para su consulta.</p>  
        <button id="consultar" disabled="disabled" type="button" class="btn btn-primary" data-toggle="modal" data-target="#consultar_norma">Consultar Proyecto</button>
        <h2 class="text-center text-primary">Etapa I - Construcción</h2>
        <table id="tabla_normas_1" class="table table-striped table-bordered dt-responsive nowrap">
          <thead>
            <tr class="well text-primary" data-toggle="tooltip" data-placement="top" >              
              <th class="text-center">ID</th>
              <th class="text-center">Departamento</th>
              <th class="text-center">Municipio</th>
              <th class="text-center">Núcleo veredal</th>              
              <th class="text-center">Proyecto</th>
              <th class="text-center">Priorización</th> 
              <th class="text-center">Viabilización</th>                             
            </tr>
          </thead>
          <tbody>
            @foreach($arrayindipic as $pro) 
              <tr id="{{$pro->id_proy}}"> 
                <td >{{$pro->ID}} </td> 
                <td >@foreach($arraydepto as $key=>$val) @if($pro->cod_depto==$key) {{$val}} @endif @endforeach </td> 
                <td >@foreach($arraymuni as $key=>$val) @if($pro->cod_mpio==$key) {{$val}} @endif @endforeach </td> 
                <td >@foreach($arraynucleos as $key=>$val) @if($pro->cod_nucleo==$key) {{$val}} @endif @endforeach </td> 
                <td >{{$pro->nom_proy}}</td>
                <td align="center"><p style="display:none;"></p><span class="glyphicon glyphicon-ok-sign" aria-hidden="true" style="color:green"></span></td>
                <td align="center"><p style="display:none;"></p><span class="glyphicon glyphicon-remove-sign" aria-hidden="true" style="color:red"></span></td>
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
@section('jsbody')
  @parent
    <script>
      $(document).ready(function() {          
          //para que los menus pequeño y grande funcione
          $( "#art" ).addClass("active");
          $( "#artdashboardmenu" ).addClass("active");
          $( "#iniciomenupeq" ).html("<small> INICIO</small>");
          $( "#artmenupeq" ).html("<strong>ART<span class='caret'></span></strong>");
          $( "#artdashboardmenupeq" ).html("<strong><span class='glyphicon glyphicon-ok'></span>Dashboard</strong>");
          $( "#mensajeestatus" ).fadeOut(5000);
               
      });
    </script>    
@stop

@endif<!--Cierra el if de mostrar el contenido de la página si esta autenticado-->