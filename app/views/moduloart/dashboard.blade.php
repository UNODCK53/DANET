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
   <link rel="stylesheet" href="assets/art/fonts/font-awesome-4.6.3/css/font-awesome.min.css">
  <!-- Libreria y capas Leaflet-->
  <link rel="stylesheet" href="assets/art/css/leaflet.css" />  
  <link rel="stylesheet" href="assets/art/css/styledLayerControl.css" />
  
@stop

<!-- librerias JavaScript que se utilizan en la pagina -->  
 
  

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
        <br>
        
        <!--aca se inicia el contenedor de mapa y alertas-->  
        <div class="container col-xs-12" style="padding-top: 25px;">
          <div class="col-xs-12 col-md-6">            
            <div class="panel panel-primary">
              <div class="panel-heading">
                <h3 class="panel-title">Buscador geográfico</h3>
              </div>
              <div class="panel-body" style="padding: 0px;">
                <div id="map" class="col-xs-12"></div>
              </div>
            </div>

          </div>
          <div class="col-xs-12 col-md-6" id="alertas">          
            <div class="panel panel-danger">
              <div class="panel-heading">
                  <i class="fa fa-bell"></i>
                  Alertas y novedades              
              </div>
              <div class="panel-body">
                  <ul class="chat">
                      <li class="left clearfix">
                          <span class="chat-img pull-left">
                              <img src="assets/art/img/1.png" alt="User Avatar" class="img-circle" />
                          </span>
                          <div class="chat-body clearfix">
                              <div class="header">
                                  <strong class="primary-font "> Luis Gabriel Guzmán </strong>
                                  <small class="pull-right text-muted label label-danger">
                                      <i class="icon-time"></i> 12 mins ago
                                  </small>
                              </div>
                               <br />
                              <p>
                                  No se pudo entrar en el territorio. las condiciones de seguridad no lo permitieron.
                              </p>
                          </div>
                      </li>
                      <li class="right clearfix">
                          <span class="chat-img pull-right">
                              <img src="assets/art/img/2.png" alt="User Avatar" class="img-circle" />
                          </span>
                          <div class="chat-body clearfix">
                              <div class="header">
                                  <small class=" text-muted label label-info">
                                      <i class="icon-time"></i> 13 mins ago</small>
                                  <strong class="pull-right primary-font">Felipe Ramírez </strong>
                              </div>
                              <br />
                              <p>
                                  Los beneficiarios manifestaron que no han recibido los pagos.
                              </p>
                          </div>
                      </li>
                      <li class="left clearfix">
                          <span class="chat-img pull-left">
                              <img src="assets/art/img/3.png" alt="User Avatar" class="img-circle" />
                          </span>
                          <div class="chat-body clearfix">
                              <div class="header">
                                  <strong class="primary-font"> Gabriel Rojas </strong>
                                  <small class="pull-right text-muted label label-warning">
                                      <i class="icon-time"></i> 12 mins ago
                                  </small>
                              </div>
                               <br />
                              <p>
                                  El transporte no llego a recoger a los profesionale de UNODC. La reunión quedó aplazada.
                              </p>
                          </div>
                      </li>
                      <li class="right clearfix">
                          <span class="chat-img pull-right">
                              <img src="assets/art/img/4.png" alt="User Avatar" class="img-circle" />
                          </span>
                          <div class="chat-body clearfix">
                              <div class="header">
                                  <small class=" text-muted label label-primary">
                                      <i class="icon-time"></i> 13 mins ago</small>
                                  <strong class="pull-right primary-font"> Cristina Corrales</strong>
                              </div>
                              <br />
                              <p>
                                  No se cuenta con información del municipio
                              </p>
                          </div>
                      </li>
                  </ul>
              </div>
            </div>  
          </div>  
        </div>
        <!--aca se termina el contenedor de mapa y alertas-->  
        <!--aca se incio el contenedor de la informacion de avance-->
        <div id="avance" class="container col-xs-12" style="padding-top: 15px; display: none;">
          <div class="alert alert-info" role="alert" id="titulo"></div>
          <div class="panel panel-primary">
            <div class="panel-heading">
              <h3 class="panel-title">Fichas de caracterización</h3>
            </div>
            <div class="panel-body" id="panel_fichas"></div>            
          </div>
          <!--Acá se encuentran los avance de la ART  -->
          <div>
          <div class="panel panel-primary">
            <div class="panel-heading">
              <h3 class="panel-title">Avance Agencia de Renovación del Territorio - ART</h3>
            </div>            
            <div class="panel-body" id="avance_art">
              <div class="col-xs-12">
                <div id="familias" class="col-xs-12 col-sm-6 col-md-4" >
                  <h3>Familias </h3>
                  Familias caracterizadas (341)
                  <div class="progress">
                    <div class="progress-bar progress-bar-danger progress-bar-striped col-xs-12" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 40%;">
                      40%
                    </div>
                  </div>
                  <div class="col-xs-6"><img src="assets/art/img/family.jpg" alt="User Avatar" class="img-rounded" style="height: 90px" ></div>
                  <div class="col-xs-6" align="center">
                  <font size="50">853</font><br>Familias<br>censadas</div>
                </div>

                <div id="familias" class="col-xs-12 col-sm-6 col-md-8" >
                  <h3>Pequeña Infraestructura Comunitaria - PIC</h3>
                  <div class="col-xs-4" align="center">
                    <div class="col-xs-12"><img src="assets/art/img/obras.png" alt="User Avatar" class="img-rounded" style="height: 90px" ></div>
                    <font size="50">50</font><br>Obras priorizadas
                  </div>
                  <div class="col-xs-8">
                    Obras con proyecto estructurado vs obras priorizadas por la comunidad
                    <div class="progress">
                      <div class="progress-bar progress-bar-warning progress-bar-striped col-xs-12" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 50%;">
                        50%
                      </div>
                    </div>
                    Obras ejecutadas vs obras priorizadas por la comunidad
                    <div class="progress">
                      <div class="progress-bar progress-bar-danger progress-bar-striped col-xs-12" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 25%;">
                        25%
                      </div>
                    </div>
                    Porcentaje de mejoramiento de vías ejecutados vs mejoramiento de vías priorizados por la comunidad
                    <div class="progress">
                      <div class="progress-bar progress-bar-success progress-bar-striped col-xs-12" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">
                        100%
                      </div>
                    </div>
                    Porcentaje de viviendas mejoradas vs número de viviendas priorizadas para mejoramiento
                    <div class="progress">
                      <div class="progress-bar progress-bar-success progress-bar-striped col-xs-12" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 85%;">
                        85%
                      </div>
                    </div>
                  </div>
                </div>
              </div>  

              <div class="col-xs-12">
                
                <div id="familias" class="col-xs-12 col-sm-6 col-md-4" >
                  <h3>Núcleos</h3>
                  Porcentaje de Núcleos veredales con diagnósticos participativos realizados
                  <div class="progress">
                    <div class="progress-bar progress-bar-warning progress-bar-striped col-xs-12" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 65%;">
                      65%
                    </div>
                  </div>
                  <div class="col-xs-6"><img src="assets/art/img/Nucleo.png" alt="User Avatar" class="img-rounded" style="height: 90px" ></div>
                  <div class="col-xs-6" align="center">
                  <font size="50">50</font><br>Núcleos<br>veredales</div>
                </div>

                <div id="familias" class="col-xs-12 col-sm-6 col-md-8" >
                  <h3>Proyectos productivos</h3>
                  <div class="col-xs-4" align="center">
                    <div class="col-xs-12"><img src="assets/art/img/pp.png" alt="User Avatar" class="img-rounded" style="height: 90px" ></div>
                    <font size="50">756</font><br>Proyectos productivos
                  </div>
                  <div class="col-xs-8">
                    Proyectos  productivos estructurados vs Proyectos productivos concertados
                    <div class="progress">
                      <div class="progress-bar progress-bar-success progress-bar-striped col-xs-12" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 75%;">
                        75%
                      </div>
                    </div>
                    Proyectos productivos en ejecución Proyectos productivos estructurados
                    <div class="progress">
                      <div class="progress-bar progress-bar-danger progress-bar-striped col-xs-12" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 45%;">
                        45%
                      </div>
                    </div>

                  </div>
                </div>
                
              </div> 

            </div>
          </div>
          </div>
          <!--Acá se terminan los avance de la ART  -->
          <!--Acá inicia los avance de la DAILD  --> 
          <div class="panel panel-primary">
            <div class="panel-heading">
              <h3 class="panel-title">Avance Dirección para la Atención Integral de la Lucha Contra la Droga</h3>
            </div>            
            <div class="panel-body" id="avance_art">


              <div class="col-xs-12">
                <div id="familias" class="col-xs-12 col-sm-6 col-md-4" >

                  <h3>Cultivos ilícitos </h3>                                    
                  <div class="col-xs-5"><img src="assets/art/img/cultivos.png" alt="User Avatar" class="img-rounded" style="height: 90px" ></div>
                  <div class="col-xs-7" align="center"><font size="50">12 Ha</font><br>Identificadas</div>
                  Fuente: SIMCI - UNODC
                </div>  

                <div id="familias" class="col-xs-12 col-sm-6 col-md-8" >
                  <h3>Acuerdos de sustitución</h3>
                  <div class="col-xs-4" align="center">
                    <div class="col-xs-12"><img src="assets/art/img/obras.png" alt="User Avatar" class="img-rounded" style="height: 90px" ></div>
                    <font size="50">50 Ha</font><br>Cultivos ilícitos con acuerdo
                  </div>
                  <div class="col-xs-8">
                    Porcentaje de Hectáreas con acuerdo de sustitución de Cultivos ilícitos
                    <div class="progress">
                      <div class="progress-bar progress-bar-warning progress-bar-striped col-xs-12" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 50%;">
                        50%
                      </div>
                    </div>
                    Porcenteje de Hectáreas de Cultivos ilícitos sustituidas
                    <div class="progress">
                      <div class="progress-bar progress-bar-danger progress-bar-striped col-xs-12" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 25%;">
                        25%
                      </div>
                    </div>

                  </div>
                  <div class="col-xs-12"><br><br></div>
                  <div class="col-xs-4" align="center">
                      <div class="col-xs-12"><img src="assets/art/img/family.jpg" alt="User Avatar" class="img-rounded" style="height: 90px" ></div>
                      <font size="50">50</font><br>Familias con acuerdo
                  </div>

                  <div class="col-xs-8">
                      Porcentaje de Familias con acuerdo de sustitución
                      <div class="progress">
                        <div class="progress-bar progress-bar-success progress-bar-striped col-xs-12" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">
                          100%
                        </div>
                      </div>
                      Porcentaje de Familias con acuerdos de sustitución incumplidos
                      <div class="progress">
                        <div class="progress-bar progress-bar-success progress-bar-striped col-xs-12" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">
                          100%
                        </div>
                      </div>

                  </div>

                </div>

                <div id="familias" class="col-xs-12 col-sm-6 col-md-8" >
                    
                    
                  </div>
              </div>


             
            </div>
          </div>
          <!--Acá terminan los avance de la DAILD  -->

          <!--Acá inicia los oferta otros sectores  --> 
          <div class="col-xs-12 col-md-6">
          <div class="panel panel-primary">
            <div class="panel-heading">
              <h3 class="panel-title">Avance gestión otros sectores</h3>
            </div>            
            <div class="panel-body" id="avance_art">
              <div id="comunitaria" class="col-xs-12">
              <h3>Proyectos gestionados</h3>
              <div class="col-xs-6"><img src="assets/art/img/pg.jpg" alt="User Avatar" class="img-rounded" style="height: 90px" ></div>
              <div class="col-xs-6" align="center"><font size="50">7</font><br>Proyectos<br>gestionados</div>
              </div>
            </div>
          </div>
          </div>
          <!--Acá terminan oferta otros sectores  -->    

           <!--Acá inicia cooperación internacional  --> 
          <div class="col-xs-12 col-md-6">
          <div class="panel panel-primary">
            <div class="panel-heading">
              <h3 class="panel-title">Avance gestión cooperación internacional</h3>
            </div>            
            <div class="panel-body" id="avance_art">
              <div id="comunitaria" class="col-xs-12">
              <h3>Proyectos gestionados</h3>
              <div class="col-xs-6"><img src="assets/art/img/pg.jpg" alt="User Avatar" class="img-rounded" style="height: 90px" ></div>
              <div class="col-xs-6" align="center"><font size="50">5</font><br>Proyectos<br>gestionados</div>
              </div>
            </div>
          </div>
          </div>
          <!--Acá terminan cooperación internacional  -->

           <!--Acá inicia oferta privada  --> 
          <div class="col-xs-12 col-md-6">
          <div class="panel panel-primary">
            <div class="panel-heading">
              <h3 class="panel-title">Avance gestión oferta privada</h3>
            </div>            
            <div class="panel-body" id="avance_art">
              <div id="comunitaria" class="col-xs-12">
              <h3>Proyectos gestionados</h3>
              <div class="col-xs-6"><img src="assets/art/img/pg.jpg" alt="User Avatar" class="img-rounded" style="height: 90px" ></div>
              <div class="col-xs-6" align="center"><font size="50">8</font><br>Proyectos<br>gestionados</div>
              </div>
            </div>
          </div>
          </div>
          <!--Acá terminan oferta privada  -->   

        </div>  
        <!--aca se termina el contenedor de la informacion de avance-->

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

  <script type="text/javascript" charset="utf-8" src="assets/art/js/colombia_line_mm.js"></script>
  <script type="text/javascript" charset="utf-8" src="assets/art/js/mpios.js"></script>
  <script src="http://cdn.leafletjs.com/leaflet/v0.7.7/leaflet.js"></script>  
  <script src="assets/art/js/styledLayerControl.js"></script>  
  <link rel="stylesheet" href="assets/art/css/search_map.css"/>  
  <script type="text/javascript" charset="utf-8" src="assets/art/js/art_search_map.js"></script>
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