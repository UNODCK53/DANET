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
        <h1 class="text-center text-primary">Informes de certificación a la erradicación GME</h1>
        <br>
        <p class="lead text-justify" >A continuación puede descargar los informes trimestrales y anuales de validación a la erradicación manual forzosa 
        adelantada por los Grupos Móviles de Erradicación. </p>            
      </div>
      <div class="col-sm-1"></div>
    </div>
  <br>
  <div class="row">
    <div class="col-sm-1"></div>
    <div class="col-sm-10">
      <div class="col-sm-6 col-md-4">
        <img  src="assets/docgme/Informe_Fase_II_GME_2015.png" class="img-responsive">                    
          <div class="input-group">
            <h4 class="col-xs-10 text-center text-primary">Informe GME Fase II 2015</h4>
            <span class="col-xs-1">
              <a target="_blank" href="assets/docgme/Informe_Fase_II_GME_2015.pdf" class="glyphicon glyphicon-download-alt btn btn-primary" role="button"></a>
            </span>
          </div>        
      </div>
      <div class="col-sm-6 col-md-4">
        <img  src="assets/docgme/Informe_Fase_I_GME_2015.png" class="img-responsive">                    
          <div class="input-group">
            <h4 class="col-xs-10 text-center text-primary">Informe GME Fase I 2015</h4>
            <span class="col-xs-1">
              <a target="_blank" href="assets/docgme/Informe_Fase_I_GME_2015.pdf" class="glyphicon glyphicon-download-alt btn btn-primary" role="button"></a>
            </span>
          </div>        
      </div>
      <div class="col-sm-6 col-md-4">
        <img  src="assets/docgme/InformeFinal_GME_2014.png" class="img-responsive">                    
          <div class="input-group">
            <h4 class="col-xs-10 text-center text-primary">Informe GME 2014 Final</h4>
            <span class="col-xs-1">
              <a target="_blank" href="assets/docgme/InformeFinal_GME_2014.pdf" class="glyphicon glyphicon-download-alt btn btn-primary" role="button"></a>
            </span>
          </div>        
      </div>
      <div class="col-sm-6 col-md-4">
        <img src="assets/docgme/Informe_Fase_IV_GME_2014.png" class="img-responsive">                    
          <div class="input-group">
            <h4 class="col-xs-10 text-center text-primary">Informe GME Fase IV 2014</h4>
            <span class="col-xs-1">
              <a target="_blank" href="assets/docgme/Informe_Fase_IV_GME_2014.pdf" class="glyphicon glyphicon-download-alt btn btn-primary" role="button"></a>
            </span>
          </div>        
      </div>      
      <div class="col-sm-6 col-md-4">
        <img src="assets/docgme/Informe_Fase_III_GME_2014.png" class="img-responsive">                    
          <div class="input-group">
            <h4 class="col-xs-10 text-center text-primary">Informe GME Fase III 2014</h4>
            <span class="col-xs-1">
              <a target="_blank" href="assets/docgme/Informe_Fase_III_GME_2014.pdf" class="glyphicon glyphicon-download-alt btn btn-primary" role="button"></a>
            </span>
          </div>        
      </div>      
      <div class="col-sm-6 col-md-4">
        <img src="assets/docgme/Informe_Fase_II_GME_2014.png" class="img-responsive">                    
          <div class="input-group">
            <h4 class="col-xs-10 text-center text-primary">Informe GME Fase II 2014</h4>
            <span class="col-xs-1">
              <a target="_blank" href="assets/docgme/Informe_Fase_II_GME_2014.pdf" class="glyphicon glyphicon-download-alt btn btn-primary" role="button"></a>
            </span>
          </div>        
      </div>
      <div class="col-sm-6 col-md-4">
        <img src="assets/docgme/Informe_Fase_I_GME_2014.png" class="img-responsive">                    
          <div class="input-group">
            <h4 class="col-xs-10 text-center text-primary">Informe GME Fase I 2014</h4>
            <span class="col-xs-1 ">
              <a target="_blank" href="assets/docgme/Informe_Fase_I_GME_2014.pdf" class="glyphicon glyphicon-download-alt btn btn-primary" role="button"></a>
            </span>
          </div>        
      </div>
      <div class="col-sm-6 col-md-4">
        <img src="assets/docgme/Informe_GME_2013.png" class="img-responsive">                    
          <div class="input-group">
            <h4 class="col-xs-10 text-center text-primary">Informe GME 2013 Final</h4>
            <span class="col-xs-1 ">
              <a target="_blank" href="assets/docgme/Informe_GME_2013.pdf" class="glyphicon glyphicon-download-alt btn btn-primary" role="button"></a>
            </span>
          </div>        
      </div>
      <div class="col-sm-6 col-md-4">
        <img src="assets/docgme/Informe_GME_2013_Fase_III.png" class="img-responsive">                    
          <div class="input-group">
            <h4 class="col-xs-10 text-center text-primary">Informe GME Fase III 2013</h4>
            <span class="col-xs-1 ">
              <a target="_blank" href="assets/docgme/Informe_GME_2013_Fase_III.pdf" class="glyphicon glyphicon-download-alt btn btn-primary" role="button"></a>
            </span>
          </div>        
      </div>
      <div class="col-sm-6 col-md-4">
        <img src="assets/docgme/InformeGME2013_FaseII.png" class="img-responsive">                    
          <div class="input-group">
            <h4 class="col-xs-10 text-center text-primary">Informe GME Fase II 2013</h4>
            <span class="col-xs-1 ">
              <a target="_blank" href="assets/docgme/InformeGME2013_FaseII.pdf" class="glyphicon glyphicon-download-alt btn btn-primary" role="button"></a>
            </span>
          </div>        
      </div>
      <div class="col-sm-6 col-md-4">
        <img src="assets/docgme/Informe_GME_2013_Fase_I_V1.png" class="img-responsive">                    
          <div class="input-group">
            <h4 class="col-xs-10 text-center text-primary">Informe GME Fase I 2013</h4>
            <span class="col-xs-1 ">
              <a target="_blank" href="assets/docgme/Informe_GME_2013_Fase_I_V1.pdf" class="glyphicon glyphicon-download-alt btn btn-primary text-right" role="button"></a>
            </span>
          </div>        
      </div>
      <div class="col-sm-6 col-md-4">
        <img src="assets/docgme/Informe_GME_2012.png" class="img-responsive">                    
          <div class="input-group">
            <h4 class="col-xs-10 text-center text-primary">Informe GME 2012 Final</h4>
            <span class="col-xs-1 ">
              <a target="_blank" href="assets/docgme/Informe_GME_2012.pdf" class="glyphicon glyphicon-download-alt btn btn-primary" role="button"></a>
            </span>
          </div>        
      </div>
    </div>
    <div class="col-sm-1"></div>    
  </div>
</div>
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
          $( "#gmeinformes" ).addClass("active");
          $( "#iniciomenupeq" ).html("<small> INICIO</small>");
          $( "#gmemenupeq" ).html("<strong>GME<span class='caret'></span></strong>");
          $( "#gmeinformesmenupeq" ).html("<strong>Metodologia<span class='caret'></span></strong>");

     
      });
    
    </script>
@stop

@endif<!--Cierra el if de mostrar el contenido de la página si esta autenticado-->