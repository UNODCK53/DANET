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

<!--aca se escribe el codigo-->
<div id="map"></div>
  <!--Modal para municipios-->  
  <div class="modal fade" id="featureModal-municipios" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" >
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h5 class="modal-title text-primary" id="feature-title-municipio"></h5>
        </div>
        <div class="modal-body" style="padding-bottom: 0px;" id="feature-info-municipio">
          <div>
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
              <li role="presentation" class="active"><a href="#social" aria-controls="home" role="tab" data-toggle="tab">Social</a></li>
              <li role="presentation"><a href="#inversion" aria-controls="profile" role="tab" data-toggle="tab">inversion</a></li>              
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
              <div role="tabpanel" class="tab-pane active" id="social">                    
                    <br>
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                      <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingOne">
                          <h4 class="panel-title">
                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                              Población
                            </a>
                          </h4>
                        </div>
                        <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                          <div class="panel-body">
                            <div>
                              <div class="col-xs-12 col-sm-3 col-md-4">
                                1. Número hábitantes<br><br>
                                <div class="col-xs-12" align="center"><img src="assets/art/img/edificios.png" alt="No images" class="img-rounded" style="height: 60px"></div>
                                <div>
                                <div class="col-xs-6" align="center"><p style="color: rgb(15,38,74); font-size:18px; margin-bottom: 0px;" id="s_urbana">17000</p></div>
                                <div class="col-xs-6" align="center"><p style="color: rgb(15,38,74); font-size:18px; margin-bottom: 0px;" id="s_rural">17000</p></div>
                                </div>
                                <div>
                                <div class="col-xs-6" align="center"><p style="color: rgb(15,38,74); font-size:15px;">Urbana</p></div>
                                <div class="col-xs-6" align="center"><p style="color: rgb(15,38,74); font-size:15px;">Rural</p></div>
                                </div>
                              </div>
                              <div class="col-xs-12 col-sm-3 col-md-4">
                                2. Mujeres y hombres - Área rural dispersa
                                <div class="col-xs-12" align="center"><img src="assets/art/img/genero.png" alt="No images" class="img-rounded" style="height: 60px"></div>
                                <div>
                                <div class="col-xs-6" align="center"><p style="color: rgb(15,38,74); font-size:18px; margin-bottom: 0px;" id="s_mujer">17000</p></div>
                                <div class="col-xs-6" align="center"><p style="color: rgb(15,38,74); font-size:18px; margin-bottom: 0px;" id="s_hombre">17000</p></div>
                                </div>
                                <div>
                                <div class="col-xs-6" align="center"><p style="color: rgb(15,38,74); font-size:15px;">Mujeres</p></div>
                                <div class="col-xs-6" align="center"><p style="color: rgb(15,38,74); font-size:15px;">Hombres</p></div>
                                </div>
                              </div>
                              <div class="col-xs-12 col-sm-3 col-md-4">
                                3. Personas > 60 años - Área rural dispersa<br><br>
                                <div class="col-xs-6" align="center"><img src="assets/art/img/mayores.png" alt="No images" class="img-rounded" style="height: 60px"></div>
                                <div>
                                <div class="col-xs-6" align="center"><p style="color: rgb(15,38,74); font-size:18px; margin-bottom: 0px;" id="s_mayores">17000</p></div>
                                
                                </div>
                                <div>
                                <div class="col-xs-6" align="center"><p style="color: rgb(15,38,74); font-size:15px;">Personas</p></div>
                                
                                </div>
                              </div>
                              <div class="col-xs-12"></div>
                              <br><br>
                              <div class="col-xs-12 col-sm-3 col-md-4">
                                4. Personas < 15 años - Área rural dispersa<br><br>
                                <div class="col-xs-6" align="center"><img src="assets/art/img/menores.png" alt="No images" class="img-rounded" style="height: 60px"></div>
                                <div>
                                <div class="col-xs-6" align="center"><p style="color: rgb(15,38,74); font-size:18px; margin-bottom: 0px;" id="s_menores">17000</p></div>
                                
                                </div>
                                <div>
                                <div class="col-xs-6" align="center"><p style="color: rgb(15,38,74); font-size:15px;">Personas</p></div>
                                
                                </div>
                              </div>
                              <div class="col-xs-12 col-sm-3 col-md-4">
                                5. Tasa analfabetismo<br><br>
                                <div class="col-xs-6" align="center"><img src="assets/art/img/analfabetismo.png" alt="No images" class="img-rounded" style="height: 60px"></div>
                                <div>
                                <div class="col-xs-6" align="center"><p style="color: rgb(15,38,74); font-size:18px; margin-bottom: 0px;" id="s_analfabetismo">17000</p></div>
                                
                                </div>
                                <div>                                
                                
                                </div>
                              </div>

                              <div class="col-xs-12 col-md-6"></div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingTwo">
                          <h4 class="panel-title">
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                              Vivienda
                            </a>
                          </h4>
                        </div>
                        <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                          <div class="panel-body">
                            <div class="col-xs-12">
                                6. Viviendas con servicios públicos - Área rural urbana<br><br>
                                  <div class="col-xs-12 col-sm-3 col-md-4">
                                    <div class="col-xs-6" align="center"><img src="assets/art/img/energia.png" alt="No images" class="img-rounded" style="height: 60px"></div>
                                    <div>
                                    <div class="col-xs-6" align="center"><p style="color: rgb(15,38,74); font-size:18px; margin-bottom: 0px;" id="s_energia">17000</p></div>
                                    
                                    </div>
                                    <div>
                                    <div class="col-xs-6" align="center"><p style="color: rgb(15,38,74); font-size:15px;">Energía eléctrica</p></div>
                                    </div>
                                  </div>
                                  <div class="col-xs-12 col-sm-3 col-md-4">
                                    <div class="col-xs-6" align="center"><img src="assets/art/img/agua.png" alt="No images" class="img-rounded" style="height: 60px"></div>
                                    <div>
                                    <div class="col-xs-6" align="center"><p style="color: rgb(15,38,74); font-size:18px; margin-bottom: 0px;" id="s_acueducto">17000</p></div>
                                    
                                    </div>
                                    <div>
                                    <div class="col-xs-6" align="center"><p style="color: rgb(15,38,74); font-size:15px;">Acueducto</p></div>
                                    </div>
                                  </div> 
                                  <div class="col-xs-12 col-sm-3 col-md-4">
                                    <div class="col-xs-6" align="center"><img src="assets/art/img/alcantarillado.png" alt="No images" class="img-rounded" style="height: 60px"></div>
                                    <div>
                                    <div class="col-xs-6" align="center"><p style="color: rgb(15,38,74); font-size:18px; margin-bottom: 0px;" id="s_alcantarillado">17000</p></div>
                                    
                                    </div>
                                    <div>
                                    <div class="col-xs-6" align="center"><p style="color: rgb(15,38,74); font-size:15px;">Alcantarillado</p></div>
                                    </div>
                                  </div>                                 
                              </div>
                          </div>
                        </div>
                      </div>
                      <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingThree">
                          <h4 class="panel-title">
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                              Territoriales y agropecuarios
                            </a>
                          </h4>
                        </div>
                        <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                          <div class="panel-body">
                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                          </div>
                        </div>
                      </div>
                    </div>


              </div>
              <div role="tabpanel" class="tab-pane" id="inversion">...</div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
        <div class="col-sm-6" align="center"><img src="assets/art/img/Logo_Unodc.png" height="42" ></div><div align="center"><img src="assets/art/img/ART.jpg" height="42"></div>        
        </div>                             
      </div>
    </div>
  </div>
  <!--fin modal para municipios-->      
<!--fin del codigo-->    

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
  <script type="text/javascript" charset="utf-8" src="assets/art/js/mpios_50.js"></script>
  <script type="text/javascript" charset="utf-8" src="assets/art/js/veredas.js"></script>
  <script src="http://cdn.leafletjs.com/leaflet/v0.7.7/leaflet.js"></script>  
  <script src="assets/art/js/styledLayerControl.js"></script>
  <link href="assets/art/css/art_map.css" rel="stylesheet">
  <script type="text/javascript" charset="utf-8" src="assets/art/js/art_map.js"></script>
    <script>
    

      $(document).ready(function() {
          //para que los menus pequeño y grande funcione
          $( "#art" ).addClass("active");
          $( "#artmapamenu" ).addClass("active");
          $( "#iniciomenupeq" ).html("<small> INICIO</small>");
          $( "#artmenupeq" ).html("<strong>ART<span class='caret'></span></strong>");
          $( "#artmapamenupeq" ).html("<strong><span class='glyphicon glyphicon-ok'></span>Mapa</strong>");
          $( "#mensajeestatus" ).fadeOut(5000);

      });
    
    </script>
@stop

@endif<!--Cierra el if de mostrar el contenido de la página si esta autenticado-->