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
      <!--Texto del contenido-->
        <div class="col-sm-1"></div>
        <div class="col-sm-10">
            <h1 class="text-center text-primary">Validación Y Certificación De La Erradicación Manual Forzosa</h1>
            <br>
            <p class="lead text-justify" >La Unidad Administrativa Especial para la Consolidación Territorial – UACT a través del Programa contra Cultivos Ilícitos, suscribe un convenio o contrato con UNODC, quien actúa como  un organismo neutral, que realiza la validación de la información recolectada por los Apoyos Zonales con la que se registra la erradicación manual forzosa de cultivos ilícitos que desarrollan los GME.</p>
            <p class="lead text-justify" >Este monitoreo permite a UNODC efectuar la caracterización de los lotes erradicados, así como la validación y certificación de las áreas intervenidas en cada zona donde se realice la operación.</p>
            <p class="lead text-justify" >UNODC produce trimestralmente el “Informe de medición del número de hectáreas erradicadas de cultivos ilícitos en las zonas donde hacen presencia los Grupos Móviles de Erradicación (GME)”. Dicho informe presenta los principales resultados territoriales del proceso de erradicación y el indicador del área erradicada por los Grupos Móviles de Erradicación.</p> 
        </div>
        <div class="col-sm-1"></div>
      </div>
      <hr>
      
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
          $( "#GME" ).addClass("active");
          $( "#gmevalcert" ).addClass("active");
          $( "#iniciomenupeq" ).html("<small> INICIO</small>");
          $( "#gmemenupeq" ).html("<strong>GME<span class='caret'></span></strong>");
          $( "#gmevalcertmenupeq" ).html("<strong>Validación y Certificacion<span class='caret'></span></strong>");   

     
      });
    
    </script>
@stop

@endif<!--Cierra el if de mostrar el contenido de la página si esta autenticado-->