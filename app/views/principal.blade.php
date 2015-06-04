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
 <!--agrega el Primer Contenerdor  de logo y cabecera el boton de inicio se agrega por aca-->
@section('contenidocabecera1')
  @parent
@stop
<!--agrega el menu a la pagina-->
@section('menu1')
<!--Segundo contenedor menu secundario-->

<div class="container-fluid">
    <div class="row" id="menu-sec">
        <!--Menu secundario es visible en sm lg-->
        <div class="col-sm-12 col-sm-offset-1 visible-sm visible-md  col-md-8 col-md-offset-2 visible-lg col-lg-9 col-lg-offset-3">
            <ul class="nav nav-pills ">
                <!--<li role="presentation" ><a href="#"><strong> INICIO</strong></a></li>-->
                <li role="menu" class="active"><a href="#">INICIO</a></li>
                @if(Auth::user()->level=="1")<!--Oculta la opción Ejecución si no es el administrador-->
                <li role="menu" class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">EJECUCION <span class="caret"></span></a>
                    
                    <ul class="dropdown-menu" role="menu">
                      <li><a href="#">Monitoreo Integrado</a></li>
                      <li><a href="#">GME</a></li>
                      <li><a href="#">Proyectos Productivos</a></li>
                      <li><a href="#">Catatumbo</a></li>
                      <li><a href="#">SAI</a></li>
                      <li><a href="#">Saldo a diciembre</a></li>
                    </ul>
                </li>
                  @else
                @endif<!--Finaliza Ocultar la opción Ejecución si no es el administrador-->
                <li role="menu" class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">SISCADI <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                      <li><a href='vista2'>Consulta de encuestas</a></li>
                      <li><a href="#">Indicadores de recolección</a></li>
                    </ul>
                </li>
                <li role="menu" class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">DONDE ESTAMOS <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                      <li><a href='vista1'>Crear misión</a></li>
                      <li><a href="#">Cargar track</a></li>
                    </ul>
                </li> 
                <li role="menu"><a href="#" class="enlace-menu">HISTORIA</a></li>
                <li role="menu"><a href="#" class="enlace-menu">GME</a></li>
            </ul>
            
        </div>  
            
           <!--Menu compacto es visible en xs -->   
        <div class="col-xs-12 visible-xs">
          
          <nav class="navbar navbar-default" >
            <div class="container">
        
            <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>

                  </button>
                  <a class="navbar-brand" href="#"><small><strong> INICIO</strong></small></a>
              </div>

              <!-- Collect the nav links, forms, and other content for toggling -->
              <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                  <!-- Lista desplegable de menu con submenu -->
                @if(Auth::user()->level=="1")<!--Oculta la opción Ejecución si no es el administrador-->
                  <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">EJECUCION <span class="caret"></span></a>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Monitoreo Integrado</a></li>
                        <li><a href="#">GME</a></li>
                        <li><a href="#">Proyectos Productivos</a></li>
                        <li><a href="#">Catatumbo</a></li>
                        <li><a href="#">SAI</a></li>
                        <li><a href="#">Saldo a diciembre</a></li>
                      </ul>
                  </li>
                  @else
                @endif<!--Finaliza Ocultar la opción Ejecución si no es el administrador-->
                  <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">SISCADI <span class="caret"></span></a>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href='vista2'>Consulta de encuestas</a></li>
                        <li><a href="#">Indicadores de recolección</a></li>
                      </ul>
                  </li>
                  <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">DONDE ESTAMOS <span class="caret"></span></a>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href='vista1'>Crear misión</a></li>
                        <li><a href="#">Cargar track</a></li>
                      </ul>
                  </li>                

                  <li><a href="#" class="enlace-menu">HISTORIA</a></li>
                  <li><a href="#" class="enlace-menu">GME</a></li>

                </ul><!-- fin de menu con submenu -->
                
                
              </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
          </nav>
      
        </div>
    </div>
</div>


  <!--Fin del segundo contenedor-->   
@stop
<!--CONTENEDOR GENERAL-->
@section('contenedorgeneral1')
  @parent
  <!--aca se escribe el codigo-->



hola mundo
<br/>




<br/>
hola mundo 3



<!--fin del codigo-->
@stop

<!--Cierra el CONTENEDOR GENERAL-->
@section('contenedorgeneral2')
  @parent

@stop

<!--el pie de pagina o barra gris de abajo-->
@section('piedepagina')
  @parent

@stop

<!--agrega JavaScript a la pagina-->
@section('js')
  @parent
@stop

@endif<!--Cierra el if de mostrar el contenido de la página si esta autenticado-->