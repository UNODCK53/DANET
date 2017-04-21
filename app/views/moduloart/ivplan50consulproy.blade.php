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
<script src="assets/art/js/wNumb.js"></script>    
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
        <p class="lead text-justify">A continuación se presenta el avance de los proyectos de pequeña infraestructura comunitaria-PIC para su consulta.</p>  
    </div>  
    <div class="col-sm-1"></div>
    </div>
    <div class="row">
    <div class="col-sm-1"></div>
      <div class="col-sm-8">
        <button id="consultar" disabled="disabled" type="button" class="btn btn-primary" data-toggle="modal" data-target="#consultar_norma">Consultar Proyecto</button>
      </div>
      <div class="col-sm-2">
        <a href='Excelpic50'><img class="img-responsive" src='assets/img/excel.png'></img></a>   
      </div>
    </div>
     <div class="row">
    <div class="col-sm-1"></div>
    <div class="col-sm-10">
        <h2 class="text-center text-primary">Proyectos</h2>
        <table id="tabla_proyectos" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
          <thead>  
            <tr class="well text-primary" data-toggle="tooltip" data-placement="top" >
              <th class="text-center">ID</th>
              <th class="text-center">Departamento</th>
              <th class="text-center">Municipio</th>
              <th class="text-center">Vereda(s)</th>
              <th class="text-center">Nombre del proyecto</th>
              <th class="text-center">Estado</th>                       
            </tr>
          </thead>
          <tbody>            
            @foreach($proyectos as $pro)
              <tr id="{{$pro->OBJECTID}}">
                <td >{{$pro->ID}}</td>
                <td >{{$pro->cod_depto}}</td>
                <td >{{$pro->cod_mpio}}</td>
                <td >{{$pro->nom_nucleo}}</td>
                <td >{{$pro->nom_proy}}</td>
                <td >{{$pro->est_proy}}</td>                                              
              </tr>            
            @endforeach    
          </tbody>
        </table>  
        </div>        
      <div class="col-sm-1"></div>  
      <!--Aca inicia el modal para cargar nuevo proyecto-->
        <!-- Modal -->
        <div class="modal fade" id="consultar_norma" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-keyboard="false" data-backdrop="static">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="PIC_95001011039">Consulta del Proyecto </h4>
              </div>
                <div class="modal-body">
                    <div class="tabbable"> <!-- Only required for left/right tabs -->
                    <ul id="tab_estado" class="nav nav-tabs">
                    <li><a href="#tab1" data-toggle="tab">Indentificación</a></li>
                    <li><a href="#tab2" data-toggle="tab">Estructuración</a></li>
                    <li><a href="#tab3" data-toggle="tab">Ejecución</a></li>
                    </ul>
                    <div class="tab-content">
                    <div class="tab-pane active" id="tab1" style="overflow-y: scroll; width: auto; max-height: 734px;">
                        <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                          <thead>
                          <tr class="text-primary" data-toggle="tooltip" data-placement="top" >
                            <th class="text-center">Item</th>    
                            <th class="text-center">Valor</th>
                          </tr>
                          <tbody>
                            <tr>
                              <td>ID</td>
                              <td id="id-ide"></td>
                            </tr>
                            <tr>
                              <td>Departamento</td>
                              <td id="dpto-ide"></td>
                            </tr>
                            <tr>
                              <td>Municipios</td>
                              <td id="mpios-ide"></td>
                            </tr>
                            <tr>
                              <td>Núcelo veredal</td>
                              <td id="nuleo-ide"></td>
                            </tr>
                            <tr>
                              <td>Estado actual del proyecto</td>
                              <td id="estado-ide"></td>
                            </tr>
                            <tr>
                              <td>Tipo de territorio</td>
                              <td id="tiopoterr-ide"></td>
                            </tr>
                            <tr>
                              <td>Nombre de territorios</td>
                              <td id="nomterr-ide"></td>
                            </tr>
                            <tr>
                              <td>Nombre del proyecto</td>
                              <td id="nomproy-ide"></td>
                            </tr>
                            <tr>
                              <td>Alcance definido en identificación</td>
                              <td id="alcance-ide"></td>
                            </tr>
                            <tr>
                              <td>Entidad Líder</td>
                              <td id="entidad-ide"></td>
                            </tr>
                            <tr>
                              <td>Línea de proyecto</td>
                              <td id="linea-ide"></td>
                            </tr>
                            <tr>
                              <td>Fecha estimada para inicio de la ejecución</td>
                              <td id="fechaini-ide"></td>
                            </tr>
                            <tr>
                              <td>Fecha estimada para el final de la ejecución</td>
                              <td id="fechafin-ide"></td>
                            </tr>
                            <tr>
                              <td>documento de validación del proyecto</td>
                              <td> 
                                <span class="col-xs-1">
                                  <a id="acta-ide" target="_blank" href="" class="glyphicon glyphicon-download-alt btn btn-success" role="button"></a>
                                </span>
                              </td>
                            </tr>
                          </tbody>  
                          </thead>

                        </table>
                    </div>
                    <div class="tab-pane" id="tab2" style="overflow-y: scroll; width: auto; max-height: 734px;">
                       <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                          <thead>
                          <tr class="text-primary" data-toggle="tooltip" data-placement="top" >
                            <th class="text-center">Item</th>    
                            <th class="text-center">Valor</th>
                          </tr>
                          <tbody>
                            <tr>
                              <td>ID</td>
                              <td id="id-est"></td>
                            </tr>
                            <tr>
                              <td>Departamento</td>
                              <td id="dpto-est"></td>
                            </tr>
                            <tr>
                              <td>Municipios</td>
                              <td id="mpios-est"></td>
                            </tr>
                            <tr>
                              <td>Núcelo veredal</td>
                              <td id="nuleo-est"></td>
                            </tr>
                            <tr>
                              <td>Estado actual del proyecto</td>
                              <td id="estado-est"></td>
                            </tr>
                            <tr>
                              <td>Tipo de territorio</td>
                              <td id="tiopoterr-est"></td>
                            </tr>
                            <tr>
                              <td>Nombre de territorios</td>
                              <td id="nomterr-est"></td>
                            </tr>
                            <tr>
                              <td>Nombre del proyecto</td>
                              <td id="nomproy-est"></td>
                            </tr>
                            <tr>
                              <td>Alcance definido en identificación</td>
                              <td id="alcance-est"></td>
                            </tr>
                            <tr>
                              <td>Entidad Líder</td>
                              <td id="entidad-est"></td>
                            </tr>
                            <tr>
                              <td>Línea de proyecto</td>
                              <td id="linea-est"></td>
                            </tr>
                            <tr>
                              <td>Costo estimado del proyecto</td>
                              <td id="costo-est"></td>
                            </tr>
                            <tr>
                              <td>Fecha estimada para inicio de la ejecución</td>
                              <td id="fechaini-est"></td>
                            </tr>
                            <tr>
                              <td>Fecha estimada para el final de la ejecución</td>
                              <td id="fechafin-est"></td>
                            </tr>
                            <tr>
                              <td>documento de validación del proyecto</td>
                              <td> 
                                <span class="col-xs-1">
                                  <a id="acta-est" target="_blank" href="" class="glyphicon glyphicon-download-alt btn btn-success" role="button"></a>
                                </span>
                              </td>
                            </tr>
                          </tbody>  
                          </thead>
                        </table>
                    </div>
                    <div class="tab-pane" id="tab3" style="overflow-y: scroll; width: auto; max-height: 734px;">
                       <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                          <thead>
                          <tr class="text-primary" data-toggle="tooltip" data-placement="top" >
                            <th class="text-center">Item</th>    
                            <th class="text-center">Valor</th>
                          </tr>
                          <tbody>
                            <tr>
                              <td>ID</td>
                              <td id="id-eje"></td>
                            </tr>
                            <tr>
                              <td>Departamento</td>
                              <td id="dpto-eje"></td>
                            </tr>
                            <tr>
                              <td>Municipios</td>
                              <td id="mpios-eje"></td>
                            </tr>
                            <tr>
                              <td>Núcelo veredal</td>
                              <td id="nuleo-eje"></td>
                            </tr>
                            <tr>
                              <td>Estado actual del proyecto</td>
                              <td id="estado-eje"></td>
                            </tr>
                            <tr>
                              <td>Tipo de territorio</td>
                              <td id="tiopoterr-eje"></td>
                            </tr>
                            <tr>
                              <td>Nombre de territorios</td>
                              <td id="nomterr-eje"></td>
                            </tr>
                            <tr>
                              <td>Nombre del proyecto</td>
                              <td id="nomproy-eje"></td>
                            </tr>
                            <tr>
                              <td>Alcance definido en identificación</td>
                              <td id="alcance-eje"></td>
                            </tr>
                            <tr>
                              <td>Entidad Líder</td>
                              <td id="entidad-eje"></td>
                            </tr>
                            <tr>
                              <td>Línea de proyecto</td>
                              <td id="linea-eje"></td>
                            </tr>
                            <tr>
                              <td>Costo del proyecto</td>
                              <td id="costo-eje"></td>
                            </tr>
                            <tr>
                              <td>Población beneficiada</td>
                              <td id="pob-eje"></td>
                            </tr>
                            <tr>
                              <td>Población beneficiada por territorio</td>
                              <td id="pob_terr-eje"></td>
                            </tr>
                            <tr>
                              <td>Avance presupuestal</td>
                              <td id="presu-eje"></td>
                            </tr>
                            <tr>
                              <td>Avance del producto</td>
                              <td id="prod-eje"></td>
                            </tr>
                            <tr>
                              <td>Longitud del tramo a intervenir</td>
                              <td id="long-eje"></td>
                            </tr>
                            <tr>
                              <td>Fecha de inicio de la ejecución</td>
                              <td id="fechaini-eje"></td>
                            </tr>
                            <tr>
                              <td>Fecha del final de la ejecución</td>
                              <td id="fechafin-eje"></td>
                            </tr>
                            <tr>
                              <td>Documento de validación del proyecto</td>
                              <td> 
                                <span class="col-xs-1">
                                  <a id="acta-eje" target="_blank" href="" class="glyphicon glyphicon-download-alt btn btn-success" role="button"></a>
                                </span>
                              </td>
                            </tr>
                            <tr>
                              <td>Coordenadas iniciales del proyecto</td>
                              <td id="coorini-eje"></td>
                            </tr>
                            <tr>
                              <td>Coordenadas finales del proyecto</td>
                              <td id="coorfin-eje"></td>
                            </tr>
                          </tbody>  
                          </thead>
                        </table>
                    </div>
                  </div>
                </div>
               </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>                
              </div>
            </div>
          </div>
        </div>
        <!--Aca finaliza el modal para cargar nuevo proyecto-->         
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
          $("#mensajeestatus").fadeOut(5000);
          $('#tabla_proyectos').DataTable();
      });

      //funcion que filtra los municipios por departamentos
      //------------------------------------------    

      var Format = wNumb({
        prefix: '$ ',
        decimals: 0,
        thousand: '.'
      });

      var table = $('#tabla_proyectos').DataTable();
      $('#tabla_proyectos tbody').on('click', 'tr', function () {
          if ( $(this).hasClass('active') ) {
              $(this).removeClass('active');
              $("#consultar").prop('disabled', true);
            }else {
              table.$('tr.active').removeClass('active');
              $(this).addClass('active');
              $("#consultar").prop('disabled', false);
              var id=$(this);
              //Consulta ajax para traer los atributos editables del proyecto
              //var num=($('td', this).eq(0).text());
              var id=$(this);
              var num=id[0].id;
              //var num=10;
              $.ajax({
                  url:"artpic/consultar-plan50",
                  type:"POST",
                  data:{proyecto: num},
                  dataType:'json',
                  success:function(data){
                     if (data['todo'][0].est_proy=='Ejecución'){
                      $('#tab_estado a[href="#tab3"]').tab('show');
                    }else if(data['todo'][0].est_proy=='Estructuración'){
                      $('#tab_estado a[href="#tab2"]').tab('show');
                    }else if (data['todo'][0].est_proy=='Identificación'){
                      $('#tab_estado a[href="#tab1"]').tab('show');
                    }
                     $('[id^=id]').html(data['todo'][0].ID);
                     $('[id^=dpto]').html(data['todo'][0].cod_depto);
                     $('[id^=mpios]').html(data['todo'][0].cod_mpio);
                     $('[id^=nuleo]').html(data['todo'][0].nom_nucleo);
                     $('[id^=estado]').html(data['todo'][0].est_proy);
                     $('[id^=tiopoterr]').html(data['tipoterr'].toString());
                     $('[id^=nomterr]').html(data['arraynomter']);
                     $('[id^=nomproy]').html(data['todo'][0].nom_proy);
                     $('#alcance-ide').html(data['todo'][0].alcance);
                     $('#alcance-est').html(data['todo'][0].alcance_2);
                     $('#alcance-eje').html(data['todo'][0].alcance_3);
                     $('[id^=entidad]').html(data['todo'][0].enti_lider);
                     $('[id^=linea]').html(data['todo'][0].linea_proy);
                     $('#costo-est').html(data['todo'][0].costo_estim);
                     $('#costo-eje').html(data['todo'][0].costo_ejec);
                     $('#pob-eje').html(data['todo'][0].pob_bene);
                     $('#pob_terr-eje').html(data['pobla_bene']);
                     
                     $('#presu-eje').html(data['todo'][0].avance_pres);
                     $('#prod-eje').html(data['todo'][0].avance_prod);
                     $('#long-eje').html(data['todo'][0].longitud);
                     $('#fechaini-ide').html(data['todo'][0].fecha_inicio);
                     $('#fechaini-est').html(data['todo'][0].fecha_inicio);
                     $('#fechaini-eje').html(data['todo'][0].fecha_inicio_2);
                     $('#fechafin-ide').html(data['todo'][0].fecha_fin);
                     $('#fechafin-est').html(data['todo'][0].fecha_fin);
                     $('#fechafin-eje').html(data['todo'][0].fecha_fin_2);
                     $('#coorini-eje').html(data['todo'][0].coord_ini);
                     $('#coorfin-eje').html(data['todo'][0].coord_fin);
                     if( data['todo'][0].documento==""||  data['todo'][0].documento==null){
                          $('[id^=acta]').attr('disabled', true);
                          $('[id^=acta]').removeClass().addClass('glyphicon glyphicon-download-alt btn btn-default ');
                          $('[id^=acta]').attr("title", "No hay documento cargado");
                          $('[id^=acta]').removeAttr("href");
                          $('[id^=acta]').removeAttr("target");
                        }else{
                         $('[id^=acta]').attr("href", data['todo'][0].documento);
                         $('[id^=acta]').removeClass().addClass('glyphicon glyphicon-download-alt btn btn-success ');
                         $('[id^=acta]').attr("target", "_blank");
                         $('[id^=acta]').attr('disabled', false);
                        }


                  },
                  error:function(){alert('error');}
              });//fin de la consulta ajax (Editar proceso)
          }
      });//Termina tbody
    </script>    
@stop

@endif<!--Cierra el if de mostrar el contenido de la página si esta autenticado-->