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
  <link rel="stylesheet" href="assets/css/L.Control.Basemaps.css" />  
  <style>
  .icon-verde {
      color: #5CB85C;
  }
  .icon-amarillo {
      color: #FACC2E;
  }
  .icon-rojo {
      color: red;
  } 

  .nopadding {
   margin: 0 !important;
}

input[type="number"]::-webkit-outer-spin-button,
input[type="number"]::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}
input[type="number"] {
    -moz-appearance: textfield;
}
</style>
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
                  <i class="fa fa-bell col-xs-1"style="padding-top:9px"></i>
                  <div class="col-xs-6" style="padding-top:6px"> <?php echo ('Alertas ('.count ($array_alerta[0]).' de '. $num_alerta.')')?> </div>
                  <div class="col-xs-3"></div>
                  <div >
                    <button type="button" class="btn btn-default btn-ms" id="new_alerta" data-target="#alerta"  data-toggle="modal">
                      <span class="glyphicon glyphicon-plus" aria-hidden="true" ></span> 
                    </button> 
                  </div>               
              </div>
              <div class="panel-body" style="overflow-y: scroll; width: auto; height: 365px;">
                  <ul class="chat ">
                    <?php foreach($array_alerta[0] as $key=>$val): ?>
                            <li class="left clearfix ">
                                
                                <div class="chat-body clearfix nopadding">
                                    <div class="header">
                                        <small class="pull-right text-muted label label-danger">
                                            <i class="icon-time"></i> <?php echo ($array_alerta[4][$key])?>
                                        </small>
                                    </div>
                                     <br />
                                     <div class="col-xs-12 " >
                                      <div class="col-xs-2 " style="width:50px; height:50px; border-radius:100%; border-color:black; border: 1px solid;background-color: <?php if ($array_alerta[6][$key]==1){ 
                                          echo '#BBF2A6';
                                          $priori = "Prioridad Verde";
                                        }elseif ($array_alerta[6][$key]==2){
                                          echo '#FFE976';
                                          $priori = "Prioridad Amarilla";
                                        }else{
                                          echo '#F05454';
                                          $priori = "Prioridad Roja";
                                        } ?>; padding: 0; margin: 0; text-align:center">
                                        <span class="<?php 
                                          if ($array_alerta[0][$key]=='Vías'){ 
                                            echo 'glyphicon glyphicon-road';
                                          }elseif ($array_alerta[0][$key]=='Orden Público'){
                                            echo 'glyphicon glyphicon-alert';
                                          }elseif ($array_alerta[0][$key]=='Cultivos Ilícitos'){
                                            echo 'glyphicon glyphicon-leaf'; 
                                          }else{
                                            echo 'glyphicon glyphicon-cloud';
                                          } ?>" style="font-size:30px; padding-top:6px; padding-left:5px" aria-hidden="true" title=<?php echo (json_encode("Alerta de ".$array_alerta[0][$key].". ".$priori , JSON_UNESCAPED_UNICODE ))?>></span>
                                      </div>
                                      <div class="col-xs-8 "style="padding-top: 14px">
                                          <b style="color:grey"><?php echo ($array_alerta[1][$key])?>:</b>
                                      </div>
                                      </div> 

                                      <div class="col-xs-12" style="padding-top:5px"> 

                                          <p>
                                            <?php echo ($array_alerta[3][$key])?>
                                          </p>
                                      </div>
                                    
                                    <div class="footer">
                                      <strong class="primary-font pull-right"> <?php echo ($array_alerta[5][$key])?> </strong>
                                    </div>
                                </div>
                            </li>
                    <?php endforeach; ?>

                      
                  </ul>
              </div>
            </div>  
          </div>  
        </div>
        <!-- /.inicio modal-->
        <div id="alerta" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><strong>Nueva alerta</strong></h4>
                  </div>
                  <div class="modal-body">
                    <form role="form" action="artdashboard/nueva-alerta" method="post" id="crearalerta" enctype="multipart/form-data" >
                      <div id="supcate" class="form-group">
                         {{Form::label('nom_subcatelable','Subcategoría:',['class' => 'control-label'])}}
                        <select name="nom_subcate" id="nom_subcate" class="form-control" required>
                           <option value="">Seleccione una </option>
                            <?php foreach($arraycate as $key=>$val): ?>
                                    <optgroup label="<?php echo implode(",", $val); ?>">
                                       <?php foreach($arraysubcate as $option): 
                                        if ($option->id_cat==$key):?>
                                        <option value=<?php echo $option->id; ?>><?php echo $option->nombre; ?></option>
                                         <?php endif; endforeach; ?>
                                    </optgroup>
                            <?php endforeach; ?>
                        </select>     
                      </div>
                      <div class="form-group" id="intimidacion" style='display:none'>
                        <div class="form-group" >
                          {{Form::label('subsubcatelable','Persona víctima de intimidación:',['class' => 'control-label'])}}
                          {{Form::select('subsubcate', $arraysubsubcate, '', ['class' => 'form-control', 'id'=>'subsubcate'])}}
                        </div> 
                      </div>
                      <div class="form-group">
                        {{Form::label('semaforolable','Escoja prioridad de la alerta:',['class' => 'control-label'])}}
                        <select class="form-control selectpicker" required name="semaforo">
                          <option value="">Seleccione una </option>
                          <option data-icon="glyphicon glyphicon-exclamation-sign icon-rojo" value='4'>Rojo</option>
                          <option data-icon="glyphicon glyphicon-exclamation-sign icon-amarillo" value='2'>Amarillo</option>
                          <option data-icon="glyphicon glyphicon-exclamation-sign icon-verde" value='1'>Verde</option>
                        </select>
                       </div> 
                       <div class="form-group">
                        {{Form::label('descripcionlable','Descripción de la alerta:',['class' => 'control-label'])}}
                        <i id="texto">0</i> caracteres
                        {{ Form::textarea('descripcion', null, ['MAXLENGTH'=>'140','rows'=>'4','class' => 'form-control', 'id'=>'descripcion','required'=>'true','onKeyDown'=>"cuenta()",'onKeyUp'=>"cuenta()"]) }}
                      </div>
                      <div class="checkbox-group">
                        {{Form::label('coordelable','Tiene las coordenadas de la alerta?',['class' => 'control-label'])}}
                        <div class="form-group" id="coorderadio">
                          <input type="radio" name="coorde" id="coorde1" value="1" required> Si
                          <input type="radio" name="coorde" id="coorde2" value="2"> No
                        </div>
                      </div>

                      <div class="form-group"id="datos_coorde" style='display:none'>
                        <div class="form-group col-sm-6 ">
                          <div class="form-group col-sm-12 " >
                          {{Form::label('Latlable','Latitud:',['class' => 'control-label'])}}
                          </div>
                          <div class="form-group col-sm-4 " >
                            Grados:
                            {{ Form::number('lat_gra','', ['class' => 'form-control', 'id'=>'lat_grado','placeholder'=>'4','onchange'=>'coorden(this)'])}} 
                          </div>
                          <div class="form-group col-sm-4 " >
                            Minutos:
                          {{ Form::number('lat_min','', ['class' => 'form-control', 'id'=>'lat_min','placeholder'=>'35','onchange'=>'coorden(this)'])}}
                          </div>
                          <div class="form-group col-sm-4 " >
                            Segundos:
                          {{ Form::number('lat_seg','', ['class' => 'form-control', 'id'=>'lat_seg','placeholder'=>'40','onchange'=>'coorden(this)'])}}
                          </div>
                        </div>
                        <div class=" form-group col-sm-6 " >
                          <div class="form-group col-sm-12 " >
                          {{Form::label('Longlable','Longitud:',['class' => 'control-label'])}}
                          </div>
                          <div class="form-group col-sm-4 " >
                            Grados:
                          {{ Form::number('long_gra','', ['class' => 'form-control', 'id'=>'long_gra','placeholder'=>'-74','onchange'=>'coorden(this)'])}}
                          </div>
                          <div class="form-group col-sm-4 " >
                             Minutos:
                          {{ Form::number('long_min','', ['class' => 'form-control', 'id'=>'long_min','placeholder'=>'35','onchange'=>'coorden(this)'])}}
                          </div>
                          <div class="form-group col-sm-4 " >
                            Segundos:
                          {{ Form::number('long_seg','', ['class' => 'form-control', 'id'=>'long_seg','placeholder'=>'40','onchange'=>'coorden(this)'])}}
                        </div>
                        </div>
                        <div id="map_alerta" style="min-width: 100px; height: 200px; margin-left:0px " ></div>
                        
                      </div> 
                      <br> 
                      <div class="form-group text-right"  id="cargueind">                
                        <button type="submit" class="btn btn-primary" >Crear</button>
                        <button type="button" class="btn btn-primary" onclick="window.location=window.location.pathname">Cancelar</button> 
                      </div>
                    </form>
                  </div>
                </div>
              </div>      
            </div><!-- /.final modal-->
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
                  <font size="50">0</font><br>Familias<br>censadas
                </div>
                <div class="col-xs-12"><br><br></div>
                <div class="col-xs-6" align="center"><img src="assets/art/img/obras.png" alt="User Avatar" class="img-rounded" style="height: 90px" ></div>
                <div class="col-xs-6" align="center">
                  <font size="50">0</font><br>Obras priorizadas
                </div>
                <div class="col-xs-12"><br><br></div>
                <div class="col-xs-6" align="center"><img src="assets/art/img/pp.png" alt="User Avatar" class="img-rounded" style="height: 90px" ></div>
                <div class="col-xs-6" align="center">
                  <font size="50">0</font><br>Proyectos productivos
                </div>
                <div class="col-xs-12"><br><br></div>
                <div class="col-xs-6" align="center"><img src="assets/art/img/Nucleo.png" alt="User Avatar" class="img-rounded" style="height: 90px" ></div>
                <div class="col-xs-6" align="center">
                  <font size="50">0</font><br>Núcleos<br>veredales
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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>
  <script src="assets/js/L.Control.Basemaps-min.js"></script> 

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

      function cuenta(){ 
        $('#texto').html(document.forms[1].descripcion.value.length)
        if (document.forms[1].descripcion.value.length>=140){

        }
      }   

      $('input[type=radio][name=coorde]').change(function() {
        if (this.value == 1) {
           $("#datos_coorde").css("display","block");
            $("#lat_grado").prop('required',true); 
            $("#lat_min").prop('required',true); 
            $("#lat_sed").prop('required',true); 
            $("#long_grado").prop('required',true); 
            $("#long_min").prop('required',true); 
            $("#long_sed").prop('required',true); 
            setTimeout(function(){    
                map_alerta.invalidateSize();
            }, 1);
        }
        else if (this.value == 2) {
          $("#datos_coorde").css("display","none");
          $("#lat_grado").prop('required',false); 
            $("#lat_min").prop('required',false); 
            $("#lat_sed").prop('required',false); 
            $("#long_grado").prop('required',false); 
            $("#long_min").prop('required',false); 
            $("#long_sed").prop('required',false); 
          
        }
      });
       $('#nom_subcate').change(function() {
        if ($(this).val()==9){
          $("#intimidacion").css("display","block");
          $("#subsu").prop('required',true);         
        }else{
          $("#intimidacion").css("display","none");
          $("#subsu").prop('required',false);
        }

       });

      function coorden(e){
        if ((e.id=='lat_min'|| e.id=='lat_seg' || e.id=='long_min' || e.id=='long_seg') && (e.value<0 || e.value>=60)){
         alert("Ingrese un valor entre 0 y 59 ");
         e.value="";
         }

         if ((e.id=='lat_grado') && (e.value<-4 || e.value>=13)){
         alert("Ingrese un valor entre -4 y 13 grados ");
         e.value="";
         }

         if ((e.id=='long_gra') && (e.value<-80 || e.value>=-67)){
         alert("Ingrese un valor entre -80 y -67 grados ");
         e.value="";
         }

        if ($('#lat_min').val()!='' && $('#lat_seg').val()!='' && $('#long_min').val()!='' && $('#long_seg').val()!='' && $('#lat_grado').val()!='' && $('#long_gra')){
          
            if($('#lat_grado').val()>0){
              var Latitud=(parseInt($('#lat_grado').val())+parseFloat($('#lat_min').val()/60)+parseFloat($('#lat_seg').val()/3600));
            }else{
              var Latitud=(parseInt($('#lat_grado').val())-parseFloat($('#lat_min').val()/60)-parseFloat($('#lat_seg').val()/3600));
            }

            longitud=parseInt($('#long_gra').val())-parseFloat($('#long_min').val()/60)-parseFloat($('#long_seg').val()/3600);

            try{
              map_alerta.removeLayer(marker);
            }catch(err){

            }
            var nombre="Alerta de<br><strong>"+$('#nom_subcate option:selected').closest('optgroup').attr('label')+"</strong>: "+$('#nom_subcate option:selected').text();
            var planes = [[nombre,Latitud,longitud]];
            marker = new L.marker([planes[0][1],planes[0][2]])
                .bindPopup(planes[0][0])
                .addTo(map_alerta);
            map_alerta.setView(marker.getLatLng(),9)
          
        }

      }
        bounds = new L.LatLngBounds(new L.LatLng(-7, -90), new L.LatLng(15, -50));
        var map_alerta = L.map('map_alerta',{maxBounds: bounds}).setView([4.6097100, -74.0817500], 4);
        var basemaps2 = [
          L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { minZoom:4, maxZoom: 15}),
          L.tileLayer('http://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}',{minZoom:4, maxZoom: 15,    subdomains:['mt0','mt1','mt2','mt3']})
        ];

        map_alerta.addControl(L.control.basemaps({
          basemaps: basemaps2,
          position: 'bottomright',
          tileX: 0,  // tile X coordinate
          tileY: 0,  // tile Y coordinate
          tileZ: 1   // tile zoom level
        }));

        $('#alerta').on('hidden.bs.modal', function (e) {//funcion que resetea el modal
           $(this).find('form').trigger('reset');
            
        })
    </script>
    
@stop

@endif<!--Cierra el if de mostrar el contenido de la página si esta autenticado-->