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
            <h1 class="text-center text-primary">Metodología para la validación y certificación de la Erradicación Manual Forzosa</h1><br>
            <p class="lead text-justify" >Como lo evidencia el documento  metodológico del proceso de certificación por UNODC de las áreas de cultivos ilícitos erradicadas por los Grupos Móviles de Erradicación – GME (insertar link), UNODC ha definido  un  flujo de trabajo que permite la captura en terreno y la validación del área de cultivos de coca, amapola y marihuana erradicada por los GME bajo un enfoque de muestreo de calidad, que tiene en cuenta las evidencias capturadas en campo con dispositivos móviles, carteras de campo y fotografías georreferenciadas, así como la verificación en oficina apoyada con imágenes capturadas por sensores remotos.</p>
            <p class="lead text-justify" >Las etapas de la validación de las áreas erradicadas por GME son las siguientes:</p>
            
            <ul class="lead text-justify" > 
              <div class="media">
                    <div class="media-body media-middle">
                      <span class="glyphicon glyphicon-ok" aria-hidden="true" style="color:#337ab7"></span>
                      Diseño de los formularios de recolección de información: UNODC diseña e implementa la captura digital a través herramientas basadas en dispositivos móviles (Open Data Kit –ODK-, GeoODK, ArcGIS Online) los formularios de captura de información en campo, basado en las funcionalidades requeridas por UACT y GME.
                    </div>
                    <div class="media-right media-middle">                      
                        <img data-holder-rendered="true" src="assets/docgme/1_diseño_formulario.png" class="media-object">                      
                    </div>  
                </div>
            </ul>
            <ul class="lead text-justify" > 
              <div class="media">
                    <div class="media-left media-middle">                      
                        <img data-holder-rendered="true" src="assets/docgme/2_configuracion_gps.png" class="media-object">                      
                    </div>
                    <div class="media-body media-middle">
                      <span class="glyphicon glyphicon-ok" aria-hidden="true" style="color:#337ab7"></span>
                      Configuración de equipos GPS: UNODC configura los equipos de captura GPS, instalando las aplicaciones requeridas para el buen funcionamiento del aplicativo para la captura de información establecido.
                    </div>
                      
                </div>
            </ul>
            <ul class="lead text-justify" > 
              <div class="media">
                    <div class="media-body media-middle">
                      <span class="glyphicon glyphicon-ok" aria-hidden="true" style="color:#337ab7"></span>
                      Recolección de información en campo: proceso durante el cual los GME documentan  las áreas erradicadas en su dispositivo GPS, formulario digital en dispositivo móvil y en carteras de campo. Los monitores de UNODC de acuerdo con la programación de las zonas y disponibilidad de imágenes satelitales hacen presencia en el terreno para documentar el avance de la erradicación y la calidad en la captura de la información.
                    </div>
                    <div class="media-right media-middle">                      
                        <img data-holder-rendered="true" src="assets/docgme/3_captura.png" class="media-object">                      
                    </div>  
                </div>
            </ul>
            <ul class="lead text-justify" > 
              <div class="media">
                    <div class="media-left media-middle">                      
                        <img data-holder-rendered="true" src="assets/docgme/4_trasnferencia.png" class="media-object">                      
                    </div>
                    <div class="media-body media-middle">
                      <span class="glyphicon glyphicon-ok" aria-hidden="true" style="color:#337ab7"></span>
                      Transferencia y crítica de la información: la información capturada en terreno es transferida por UACT a la oficina de UNODC a través de la red de internet o tarjeta física y se consigna en un registro de transferencia para luego ser concertada con la Oficina Administrativa de Planeación y Gestión de la Información – OAPGI/UACT.
                    </div>
                      
                </div>
            </ul>
            <ul class="lead text-justify" > 
              <div class="media">
                    <div class="media-body media-middle">
                      <span class="glyphicon glyphicon-ok" aria-hidden="true" style="color:#337ab7"></span>
                      Estructuración de los polígonos delimitados en campo: proceso durante el cual los polígonos capturados en campo son editados para corregir errores topológicos y de captura debido a la variación de la señal GPS o recorrido del profesional en el terreno. De este proceso se deriva el archivo final de áreas de erradicación en formato shapefile que será entregado a OAPGI/DPCI/UACT.                      
                    </div>
                    <div class="media-right media-middle">                      
                        <img data-holder-rendered="true" src="assets/docgme/5_edicion.png" class="media-object">                      
                    </div>  
                </div>
            </ul>
            <ul class="lead text-justify" ><span class="glyphicon glyphicon-ok" aria-hidden="true" style="color:#337ab7"></span> Selección de la muestra: en este proceso se seleccionan mediante técnicas de muestreo un grupo de lotes que es representativo en cuanto al núcleo y punto de erradicación y  el tamaño de las áreas erradicadas.</ul>
            <ul class="lead text-justify" ><span class="glyphicon glyphicon-ok" aria-hidden="true" style="color:#337ab7"></span> Validación geográfica de los lotes de la muestra: en este proceso se utiliza la información de la cartera de campo, los lotes estructurados y las imágenes satelitales para determinar cuantitativa y cualitativamente la consistencia de las áreas reportadas.</ul>
            <ul class="lead text-justify" > 
              <div class="media">
                    <div class="media-left media-middle">                      
                        <img data-holder-rendered="true" src="assets/docgme/7_validacion.png" class="media-object">                      
                    </div>
                    <div class="media-body media-middle">
                      <span class="glyphicon glyphicon-ok" aria-hidden="true" style="color:#337ab7"></span>
                      Expansión de los resultados por municipio y punto de erradicación: aplicación de métodos de muestreo para llevar los resultados de verificación de la muestra a un estimativo, a escala de la Fase, del área erradicada por núcleo y departamento.
                    </div>
                      
                </div>
            </ul>
            <ul class="lead text-justify" ><span class="glyphicon glyphicon-ok" aria-hidden="true" style="color:#337ab7"></span> Publicación del informe.</ul>

            
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
          $( "#gmemetodologia" ).addClass("active");
          $( "#iniciomenupeq" ).html("<small> INICIO</small>");
          $( "#gmemenupeq" ).html("<strong>GME<span class='caret'></span></strong>");
          $( "#gmemetodologiamenupeq" ).html("<strong>Metodologia<span class='caret'></span></strong>");

     
      });
    
    </script>
@stop

@endif<!--Cierra el if de mostrar el contenido de la página si esta autenticado-->