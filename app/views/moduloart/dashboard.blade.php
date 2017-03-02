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
  <script src="https://code.highcharts.com/highcharts.js"></script>
  <script src="https://code.highcharts.com/modules/exporting.js"></script>
  
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
                  <div>Aalertas y novedades</div><div><button type="button" class="btn btn-default btn-lg">
  <span class="glyphicon glyphicon-star" aria-hidden="true"></span> Star
</button>  </div>           
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
              <h3 class="panel-title">Caracterización municipal</h3>
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
            <!--Inicio seccion caracterizacion  -->
              <div class="col-xs-6">
                <h3>Caracterización</h3>
                <br>
                <div class="col-xs-6" align="center"><img src="assets/art/img/family.jpg" alt="User Avatar" class="img-rounded" style="height: 90px" ></div>
                <div class="col-xs-6" align="center">
                  <font size="50">853</font><br>Familias<br>censadas
                </div>
                <div class="col-xs-12"><br><br></div>
                <div class="col-xs-6" align="center"><img src="assets/art/img/obras.png" alt="User Avatar" class="img-rounded" style="height: 90px" ></div>
                <div class="col-xs-6" align="center">
                  <font size="50">50</font><br>Obras priorizadas
                </div>
                <div class="col-xs-12"><br><br></div>
                <div class="col-xs-6" align="center"><img src="assets/art/img/pp.png" alt="User Avatar" class="img-rounded" style="height: 90px" ></div>
                <div class="col-xs-6" align="center">
                  <font size="50">756</font><br>Proyectos productivos
                </div>
                <div class="col-xs-12"><br><br></div>
                <div class="col-xs-6" align="center"><img src="assets/art/img/Nucleo.png" alt="User Avatar" class="img-rounded" style="height: 90px" ></div>
                <div class="col-xs-6" align="center">
                  <font size="50">50</font><br>Núcleos<br>veredales
                </div>
              </div>
              <!--Fin seccion caracterizacion  -->
              <!--Inicio seccion Indicadores  -->
              <div class="col-xs-6">
                <h3>Indicadores</h3>
                Familias caracterizadas (341)
                <div class="progress">
                    <div class="progress-bar progress-bar-danger progress-bar-striped col-xs-12" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 40%;">
                      40%
                    </div>
                </div>
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
                Porcentaje de Núcleos veredales con diagnósticos participativos realizados
                  <div class="progress">
                    <div class="progress-bar progress-bar-warning progress-bar-striped col-xs-12" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 65%;">
                      65%
                    </div>
                  </div>
              </div>
              <!--Fin seccion Indicadores  -->  
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
                  <h4>Fuente: SIMCI - UNODC</h4>

                  <h3>Reducción de la oferta </h3>                                    
                  <table class="table table-hover">
                    <tr>
                      <td>Laboratorios destruidos</td>
                      <td>25</td>
                    </tr>
                    <tr>
                      <td>Toneladas incautadas</td>
                      <td>25</td>
                    </tr>
                  </table>
                  Fuente: Policia Nacional
                </div>  

                <div id="familias" class="col-xs-12 col-sm-6 col-md-8" >
                  <h3>Acuerdos de erradicación voluntaria</h3>
                  <div class="col-xs-4" align="center">
                    <div class="col-xs-12"><img src="assets/art/img/obras.png" alt="User Avatar" class="img-rounded" style="height: 90px" ></div>
                    <font size="50">50 Ha</font><br>Cultivos ilícitos con acuerdo
                  </div>
                  <div class="col-xs-8">
                    Porcentaje de Hectáreas con acuerdo de erradicación voluntaria de Cultivos ilícitos
                    <div class="progress">
                      <div class="progress-bar progress-bar-warning progress-bar-striped col-xs-12" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 50%;">
                        50%
                      </div>
                    </div>
                    Porcenteje de hectáreas de cultivos ilícitos con erradicación voluntaria
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
                      Porcentaje de Familias con acuerdo de erradicación voluntaria
                      <div class="progress">
                        <div class="progress-bar progress-bar-success progress-bar-striped col-xs-12" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">
                          100%
                        </div>
                      </div>
                      Porcentaje de Familias con acuerdos de erradicación voluntaria incumplidos
                      <div class="progress">
                        <div class="progress-bar progress-bar-success progress-bar-striped col-xs-12" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">
                          100%
                        </div>
                      </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!--Acá terminan los avance de la DAILD  -->
           <!--Acá incia grafica de distribucion de obras-->
          <!--
         
          <div class="panel panel-primary">
            <div class="panel-heading">
              <h3 class="panel-title">Distribución de las obras por Ejecutor</h3>
            </div>
            <div class="panel-body">
            <div id="container" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
            <script type="text/javascript">
              $(function () {
                  Highcharts.chart('container', {
                      chart: {
                          plotBackgroundColor: null,
                          plotBorderWidth: 0,
                          plotShadow: false
                      },
                      title: {
                          text: 'Browser<br>shares<br>2015',
                          align: 'center',
                          verticalAlign: 'middle',
                          y: 40
                      },
                      tooltip: {
                          pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                      },
                      plotOptions: {
                          pie: {
                              dataLabels: {
                                  enabled: true,
                                  distance: -50,
                                  style: {
                                      fontWeight: 'bold',
                                      color: 'white'
                                  }
                              },
                              startAngle: -90,
                              endAngle: 90,
                              center: ['50%', '75%']
                          }
                      },
                      series: [{
                          type: 'pie',
                          name: 'Browser share',
                          innerSize: '50%',
                          data: [
                              ['Privada',   10.38],
                              ['ART',       56.33],
                              ['Respuesta Rápida', 24.03],
                              ['Otros sectores',    4.77],
                              ['Cooperación internacional',     0.91],
                              {
                                  name: 'Proprietary or Undetectable',
                                  y: 0.2,
                                  dataLabels: {
                                      enabled: false
                                  }
                              }
                          ]
                      }]
                  });
              });
            </script>  
            </div>
          </div>          
          -->
          <!--Acá termina grafica de distribucion de obras-->
          <!--Acá inicia los oferta otros sectores  --> 
          <div class="col-xs-12 col-md-6">
          <div class="panel panel-primary">
            <div class="panel-heading">
              <h3 class="panel-title">Avance gestión Respuesta Rápida</h3>
            </div>            
            <div class="panel-body" id="avance_art">
              <div class="col-xs-12" align="center">
                    <div class="col-xs-12"><img src="assets/art/img/obras.png" alt="User Avatar" class="img-rounded" style="height: 90px" ></div>
                    <font size="50">50</font><br>Obras priorizadas por Respuesta Rápida
                </div>
                <div class="col-xs-12"><br><br></div>
                Porcentaje de Proyectos priorizados por la comunidad financiados por Respuesta Rápida  
                <div class="progress">
                  <div class="progress-bar progress-bar-success progress-bar-striped col-xs-12" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">
                    100%
                  </div>
                </div>
                Porcentaje de Familias impactadas por proyectos financiados por Respuesta Rápida  
                <div class="progress">
                  <div class="progress-bar progress-bar-success progress-bar-striped col-xs-12" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">
                    100%
                  </div>
                </div>
                Porcentaje de aporte de Respuesta Rápida en la financiación de proyectos identificados  
                <div class="progress">
                  <div class="progress-bar progress-bar-success progress-bar-striped col-xs-12" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">
                    100%
                  </div>
                </div>
            </div>
          </div>
          </div>
          <!--Acá terminan oferta otros sectores  -->

          <!--Acá inicia los oferta otros sectores  --> 
          <div class="col-xs-12 col-md-6">
          <div class="panel panel-primary">
            <div class="panel-heading">
              <h3 class="panel-title">Avance gestión otros sectores</h3>
            </div>            
            <div class="panel-body" id="avance_art">
                <div class="col-xs-12" align="center">
                    <div class="col-xs-12"><img src="assets/art/img/obras.png" alt="User Avatar" class="img-rounded" style="height: 90px" ></div>
                    <font size="50">50</font><br>Obras priorizadas otros sectores
                </div>
                <div class="col-xs-12"><br><br></div>
                Porcentaje de Proyectos priorizados por la comunidad financiados por otros sectores  
                <div class="progress">
                  <div class="progress-bar progress-bar-warning progress-bar-striped col-xs-12" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                    60%
                  </div>
                </div>
                Porcentaje de Familias impactadas por proyectos financiados por otros sectores  
                <div class="progress">
                  <div class="progress-bar progress-bar-warning progress-bar-striped col-xs-12" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 70%;">
                    70%
                  </div>
                </div>
                Porcentaje de aporte de otros sectores en la financiación de proyectos identificados  
                <div class="progress">
                  <div class="progress-bar progress-bar-danger progress-bar-striped col-xs-12" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 40%;">
                    40%
                  </div>
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
              <div class="col-xs-12" align="center">
                    <div class="col-xs-12"><img src="assets/art/img/obras.png" alt="User Avatar" class="img-rounded" style="height: 90px" ></div>
                    <font size="50">50</font><br>Obras priorizadas cooperación internacional
                </div>
                <div class="col-xs-12"><br><br></div>
                Porcentaje de Proyectos priorizados por la comunidad financiados por cooperación internacional 
                <div class="progress">
                  <div class="progress-bar progress-bar-danger progress-bar-striped col-xs-12" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 20%;">
                    20%
                  </div>
                </div>
                Porcentaje de Familias impactadas por proyectos financiados por cooperación internacional 
                <div class="progress">
                  <div class="progress-bar progress-bar-danger progress-bar-striped col-xs-12" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 45%;">
                    45%
                  </div>
                </div>
                Porcentaje de aporte de cooperación internacional en la financiación de proyectos identificados  
                <div class="progress">
                  <div class="progress-bar progress-bar-danger progress-bar-striped col-xs-12" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 20%;">
                    20%
                  </div>
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
                <div class="col-xs-12" align="center">
                    <div class="col-xs-12"><img src="assets/art/img/obras.png" alt="User Avatar" class="img-rounded" style="height: 90px" ></div>
                    <font size="50">50</font><br>Obras priorizadas oferta privada
                </div>
                <div class="col-xs-12"><br><br></div>
                Porcentaje de Proyectos priorizados por la comunidad financiados por la oferta privada  
                <div class="progress">
                  <div class="progress-bar progress-bar-danger progress-bar-striped col-xs-12" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 40%;">
                    40%
                  </div>
                </div>
                Porcentaje de Familias impactadas por proyectos financiados por la oferta privada  
                <div class="progress">
                  <div class="progress-bar progress-bar-danger progress-bar-striped col-xs-12" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 30%;">
                    30%
                  </div>
                </div>
                Porcentaje de aporte de la oferta privada en la financiación de proyectos identificados  
                <div class="progress">
                  <div class="progress-bar progress-bar-danger progress-bar-striped col-xs-12" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 5%;">
                    5%
                  </div>
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
          $( "#ivsocidashboardmenu" ).addClass("active");
          $( "#iniciomenupeq" ).html("<small> INICIO</small>");
          $( "#artmenupeq" ).html("<strong>ART<span class='caret'></span></strong>");
          $( "#ivsocidashboardmenupeq" ).html("<strong><span class='glyphicon glyphicon-ok'></span>Dashboard</strong>");
          $( "#mensajeestatus" ).fadeOut(5000);      
      });
    </script>
  
    
@stop

@endif<!--Cierra el if de mostrar el contenido de la página si esta autenticado-->