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
  <link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.7.5/leaflet.css" />
    <style>          
      #map {
        width: 100%;
        height: 400px;
        margin:0 auto 0 auto;
        position: relative;
        top: 1%;        
        }
  </style>
@stop
<!--agrega JavaScript dentro del header a la pagina-->
@section('js')
  <script src="assets/art/js/wNumb.js"></script>
  <script src="http://cdn.leafletjs.com/leaflet-0.7.5/leaflet.js"></script>
  <script src="http://cdn-geoweb.s3.amazonaws.com/esri-leaflet/1.0.0-rc.3/esri-leaflet.js"></script>    
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
    <div class="row" id="mensajeesta">           
    </div>

    <div class="row">
      <div class="col-sm-1"></div>
        <div class="col-sm-10 col-xs-12">
        <!--aca se escribe el codigo-->
        <h2 class="text-center text-primary">Plan 100 días</h2>        
        <br>        
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">        
        <div class="panel panel-default">
          <div class="panel-heading" role="tab" id="headingTwo">
            <h4 class="panel-title">
              <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#filtroscom" aria-expanded="false" aria-controls="filtroscom">
                <h3 class="panel-heading text-primary">Filtros</h3>

              </a>
            </h4>
          </div>
          <div id="filtroscom" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
            <div class="panel-body">
              <form class="form-horizontal">
                <div class="form-group">
                  <label class="col-xs-2 control-label">Avance</label>
                  <div class="col-xs-10">   
                    <select id="avance_producto" name="avance_producto" class="form-control">
                      <option value="" selected="selected">Seleccione una opción</option>                         
                      @foreach($arraydombobox[1] as $avance)                  
                        <option value="{{$avance->avance_prod}}">{{$avance->avance_prod}}</option>                    
                      @endforeach                    
                    </select>                      
                  </div>              
                </div>
                <div class="form-group">
                  <label for="inputPassword" class="col-xs-2 control-label">Modalidad</label> 
                  <div class="col-xs-10">   
                    <select id="modalidad" name="modalidad" class="form-control">
                      <option value="" selected="selected">Seleccione una opción</option>  
                      @foreach($arraydombobox[2] as $modalidad)                  
                        <option value="{{$modalidad->mod_foca}}">{{$modalidad->mod_foca}}</option>                    
                      @endforeach                    
                    </select> 
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword" class="col-xs-2 control-label">Estado</label>
                  <div class="col-xs-10">   
                    <select id="estado" name="estado" class="form-control">
                      <option value="" selected="selected">Seleccione una opción</option>  
                      @foreach($arraydombobox[3] as $estado)                  
                        <option value="{{$estado->est_proy}}">{{$estado->est_proy}}</option>                    
                      @endforeach                    
                    </select>  
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword" class="col-xs-2 control-label">Entidad líder</label>
                  <div class="col-xs-10">   
                    <select required id="entidad" name="entidad" class="form-control">
                      <option value="" selected="selected">Seleccione una opción</option>  
                      @foreach($arraydombobox[4] as $entilider)                  
                        <option value="{{$entilider->enti_lider}}">{{$entilider->enti_lider}}</option>                    
                      @endforeach                    
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword" class="col-xs-2 control-label">Línea del proyecto</label> 
                  <div class="col-xs-10">   
                    <select required id="linea" name="linea" class="form-control">
                      <option value="" selected="selected">Seleccione una opción</option>  
                      @foreach($arraydombobox[5] as $lineaproy)                  
                        <option value="{{$lineaproy->linea_proy}}">{{$lineaproy->linea_proy}}</option>                    
                      @endforeach                    
                    </select> 
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword" class="col-xs-2 control-label">Departamento</label> 
                  <div class="col-xs-10">   
                    <select id="deptos" name="deptos" class="form-control" onchange="filter_municipality()">
                      <option value="" selected="selected">Seleccione una opción</option>  
                      @foreach($arraydombobox[0] as $pro)                  
                        <option value="{{$pro->COD_DPTO}}">{{$pro->NOM_DPTO}}</option>                    
                      @endforeach                    
                    </select> 
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword" class="col-xs-2 control-label">Municipio</label> 
                  <div class="col-xs-10">   
                    <select id="municipios" name="municipios" class="form-control">                                       
                    </select>
                  </div>
                </div>
              <button type="button" id="genfiltros" data-toggle="tooltip" data-placement="top" title="Click para Filtrar" class="btn btn-primary">Filtrar información</button>
              <button type="button" id="borrarfiltro" class="btn btn-primary">Reiniciar filtros</button>
              <br>
              </form>
            </div>
          </div>
        </div>        
      </div>
        
        
<!--        
        <pre>
          <div id="map"></div>
            <script>
            var map = L.map('map').setView([4.5, -74.1], 6);
            L.esri.basemapLayer("Gray").addTo(map);
            //L.esri.dynamicMapLayer("http://services.nationalmap.gov/arcgis/rest/services/3DEPElevationIndex/MapServer/0", { opacity : 1}).addTo(map);
            var servicioarcgis = new L.esri.FeatureLayer("http://arcgisserver.unodc.org.co/arcgis/rest/services/prueba/MyMapService/MapServer/0").addTo(map);
            </script>
        </pre>
-->        
        <br>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#consultar_proyecto">Consultar proyecto Seleccionado</button>
        <!--Aca inicia el modal para cargar nuevo proyecto-->
        <!-- Modal -->
        <div class="modal fade" id="consultar_proyecto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Ficha de proyecto - Plan 100 días - Respuesta Rápida</h4>
              </div>
              <div class="modal-body">
              <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <thead>
                <tr class="well text-primary" data-toggle="tooltip" data-placement="top" >
                  <th class="text-center">Varibale</th>    
                  <th class="text-center">Descripción</th>
                </tr>
                <tbody>
                  <tr>
                    <td>Departamento</td>
                    <td id="depto"></td>
                  </tr>
                  <tr>
                    <td>Municipio</td>
                    <td id="mpio"></td>
                  </tr>
                  <tr>
                    <td>Vereda</td>
                    <td id="vereda"></td>
                  </tr>
                  <tr>
                    <td>Nombre del proyecto</td>
                    <td id="nom_proy"></td>
                  </tr>
                  <tr>
                    <td>Modalidad de focalización</td>
                    <td id="mod_foca"></td>
                  </tr>
                  <tr>
                    <td>Entidad líder</td>
                    <td id="enti_lider"></td>
                  </tr>
                  <tr>
                    <td>Línea del proyecto</td>
                    <td id="linea_proy"></td>
                  </tr>
                  <tr>
                    <td>Alcance</td>
                    <td id="alcance"></td>
                  </tr>
                  <tr>
                    <td>Población beneficiaria</td>
                    <td id="pob_bene"></td>
                  </tr>
                  <tr>
                    <td>Estado del proyecto</td>
                    <td id="est_proy"></td>
                  </tr>
                  <tr>
                    <td>Fecha de inicio</td>
                    <td id="fecha_inicio"></td>
                  </tr>
                  <tr>
                    <td>Fecha finalización</td>
                    <td id="fecha_fin"></td>
                  </tr>
                  <tr>
                    <td>Avance presupuestal</td>
                    <td id="avance_pres"></td>
                  </tr>
                  <tr>
                    <td>Avance producto</td>
                    <td id="avance_prod"></td>
                  </tr>
                  <tr>
                    <td>Costo estimado</td>
                    <td id="costo_estim"></td>
                  </tr>
                  <tr>
                    <td>Costo Ejecutado</td>
                    <td id="costo_ejec"></td>
                  </tr>
                </tbody>  
                </thead>

              </table>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>                
              </div>
              
            </div>
          </div>
        </div>
        <!--Aca finaliza el modal para cargar nuevo proyecto-->
        
        <!--Acá inicia la tabla de proyectos-->
        <h4>Listado de proyectos</h4>       

        <table id="tabla_proyectos" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
          <thead>  
            <tr class="well text-primary" data-toggle="tooltip" data-placement="top" >
              <th class="text-center">Departamento</th>
              <th class="text-center">Municipio</th>
              <th class="text-center">Vereda(s)</th>
              <th class="text-center">Nombre del proyecto</th>
              <th class="text-center">Modalidad</th>
              <th class="text-center">Avance</th>                          
            </tr>
          </thead>
          <tbody id="tbody_proyectos">            
            @foreach($proyectos as $pro)
              <tr id="{{$pro->id}}">
                <td >{{$pro->NOM_DPTO}}</td>
                <td >{{$pro->NOM_MPIO}}</td>
                <td >{{$pro->vereda}}</td>
                <td >{{$pro->nom_proy}}</td>
                <td >{{$pro->mod_foca}}</td>
                <td>
                <div class="progress" style="margin-bottom: 0px">                    
                    @if($pro->avance_prod >=75)
                    <div class="progress-bar progress-bar-success progress-bar-striped col-xs-12" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{$pro->avance_prod}}%; ">
                      {{$pro->avance_prod}}%
                    </div>
                    @elseif($pro->avance_prod >=25) 
                    <div class="progress-bar progress-bar-warning progress-bar-striped col-xs-12" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{$pro->avance_prod}}%; ">
                      {{$pro->avance_prod}}%
                    </div> 
                    @else
                    <div class="progress-bar progress-bar-danger progress-bar-striped col-xs-12" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{$pro->avance_prod}}%; ">
                      {{$pro->avance_prod}}%
                    </div> 
                    @endif
                </div>                
                </td>                                              
              </tr>            
            @endforeach    
          </tbody>
        </table>
        <!--Acá termina la tabla de proyectos-->       
        <!--fin del codigo-->
        </div>
      <div class="col-sm-1"></div>    
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
          

      });
      var table = $('#tabla_proyectos').DataTable();
      //funcion que filtra los municipios por departamentos
      //------------------------------------------    

      $("#borrarfiltro").on('click', function(){
        location.reload();
      });
      $("#genfiltros").on('click', function(){
        if(($('#avance_producto').val()=='') && ($('#modalidad').val()=='') && ($('#entidad').val()=='') && ($('#estado').val()=='') && ($('#linea').val()=='') && ($('#deptos').val()=='')){
          $("#mensajeesta").fadeIn(1);
          $("#mensajeesta").empty();
          $("#mensajeesta").append('<br><div class="col-sm-1"></div><div id = "mensajeestatus" class="alert alert-danger col-sm-10"><button class="close" data-dismiss="alert" type="button">×</button><i class="bg-danger"></i> Debe seleccionar algun filtro</div><div class="col-sm-1"></div>');
          $( "#mensajeesta" ).fadeOut(5000);
          $('#tabla_proyectos').DataTable().clear(); 
          $('#tabla_proyectos').DataTable().destroy();
          
        } else {
          info = [];
          info[0] = document.getElementById("avance_producto").value;
          info[1] = document.getElementById("modalidad").value;
          info[2] = document.getElementById("estado").value;
          info[3] = document.getElementById("entidad").value;
          info[4] = document.getElementById("linea").value;
          info[5] = document.getElementById("deptos").value;
          info[6] = document.getElementById("municipios").value;
          //console.log(info);
         
          $.ajax({
              url:"artplan100/filtrarplan",
              type:"POST",
              data: {info:info},
              dataType:'json',
            success:function(data1){
              //console.log(data1);
              if (data1.length>0) {
                $("#mensajeesta").fadeIn(1);
                $("#mensajeesta").empty();
                $("#mensajeesta").append('<br><div class="col-sm-1"></div><div id = "mensajeestatus" class="alert alert-success col-sm-10"><button class="close" data-dismiss="alert" type="button">×</button><i class="bg-success"></i> Se encontró <strong>'+data1.length+'</strong> registro(s)</div><div class="col-sm-1"></div>');
                $( "#mensajeesta" ).fadeOut(5000);
                //$("#tbody_proyectos").empty();
                var codtablagen = '';
                for (var i = 0; i < data1.length; i++) {
                  codtablagen=codtablagen+'<tr id="'+data1[i].id+'"><td>'+data1[i].NOM_DPTO+'</td><td>'+data1[i].NOM_MPIO+'</td><td>'+data1[i].vereda+'</td><td>'+data1[i].nom_proy+'</td><td>'+data1[i].mod_foca+'</td><td><div class="progress" style="margin-bottom: 0px">';
                  if(data1[i].avance_prod >=75)
                  {
                    codtablagen=codtablagen+'<div class="progress-bar progress-bar-success progress-bar-striped col-xs-12" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: '+data1[i].avance_prod+'%; ">'+data1[i].avance_prod+'%</div>';
                  }else if(data1[i].avance_prod >=25) {
                    codtablagen=codtablagen+'<div class="progress-bar progress-bar-warning progress-bar-striped col-xs-12" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: '+data1[i].avance_prod+'%; ">'+data1[i].avance_prod+'%</div>'; 
                  }else {
                    codtablagen=codtablagen+'<div class="progress-bar progress-bar-danger progress-bar-striped col-xs-12" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: '+data1[i].avance_prod+'%; ">'+data1[i].avance_prod+'%</div>';
                  }
                  codtablagen=codtablagen+'</div></td></tr>';
                }
                //console.log(codtablagen);
                //$("#tbody_proyectos").append(codtablagen);                
                $('#tabla_proyectos').DataTable().clear(); 
                $('#tabla_proyectos').DataTable().destroy();
                $('#tabla_proyectos').find('tbody').append(codtablagen);
                $('#tabla_proyectos').DataTable().draw(); 
                
              } else {
                $("#mensajeesta").fadeIn(1);
                $("#mensajeesta").empty();
                $("#mensajeesta").append('<br><div class="col-sm-1"></div><div id = "mensajeestatus" class="alert alert-danger col-sm-10"><button class="close" data-dismiss="alert" type="button">×</button><i class="bg-danger"></i> No hay registros con esa búsqueda</div><div class="col-sm-1"></div>');
                $( "#mensajeesta" ).fadeOut(5000);
                $('#tabla_proyectos').DataTable().clear(); 
                $('#tabla_proyectos').DataTable().destroy();
              }
              
            },
            error:function(){alert('error');}
          });//Termina Ajax 
        }
      });
      function filter_municipality(){
        var deptos=document.getElementById("deptos").value;
        $.ajax({
            url:"artplan100/municipiostabla",
            type:"POST",
            data:{depto: deptos},
            dataType:'json',
            success:function(data){                                                
                $("#municipios").empty();
                $("#municipios").append('<option value="" selected="selected">Seleccione una opción</option>');
                for (var i = 0; i < data.length; i++) {
                    $("#municipios").append("<option value=\""+data[i].COD_DANE+"\">"+data[i].NOM_MPIO_1+"</option>");
                    //console.log(data[i].COD_DANE)
                }                                
            },
            error:function(){alert('error');}
        });//Termina Ajax listadoproini
      };
      var Format = wNumb({
        prefix: '$ ',
        decimals: 0,
        thousand: '.'
      });
      
      $('#tabla_proyectos tbody').on('click', 'tr', function () {
          
          
          if ($(this).hasClass('active') ) {
              $(this).removeClass('active');

          } else {
              table.$('tr.active').removeClass('active');
              $('#tabla_proyectos >tbody >tr').removeClass('active');
              $(this).addClass('active');
              var id=$(this);              
              //Consulta ajax para traer los atributos editables del proyecto
              //var num=($('td', this).eq(0).text());
              var id=$(this);
              var num=id[0].id;
              //var num=10;
              $.ajax({
                  url:"artplan100/consultar",
                  type:"POST",
                  data:{proyecto: num},
                  dataType:'json',
                  success:function(data){
                      console.log(data[0]);
                      var date_1=data[0].fecha_inicio.split(" ");
                      var date_2=data[0].fecha_fin.split(" ");
                      var val_format_1=Format.to(Number(data[0].avance_pres));
                      var val_format_2=Format.to(Number(data[0].costo_estim));
                      var val_format_3=Format.to(Number(data[0].costo_ejec));
                      if(data[0].avance_prod>=75){
                      var avance='<div class="progress-bar progress-bar-success progress-bar-striped col-xs-12" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width:'+ data[0].avance_prod +'%; ">'+data[0].avance_prod+ '%</div>'  
                      } else if (data[0].avance_prod>=25){
                      var avance='<div class="progress-bar progress-bar-warning progress-bar-striped col-xs-12" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width:'+ data[0].avance_prod +'%; ">'+data[0].avance_prod+ '%</div>'  
                      } else {
                      var avance='<div class="progress-bar progress-bar-danger progress-bar-striped col-xs-12" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width:'+ data[0].avance_prod +'%; ">'+data[0].avance_prod+ '%</div>'
                      }
                      $("#depto").html(data[0].NOM_DPTO);
                      $("#mpio").html(data[0].NOM_MPIO);
                      $("#vereda").html(data[0].vereda);
                      $("#nom_proy").html(data[0].nom_proy);
                      $("#mod_foca").html(data[0].mod_foca);
                      $("#enti_lider").html(data[0].enti_lider);
                      $("#linea_proy").html(data[0].linea_proy);
                      $("#alcance").html(data[0].alcance);
                      $("#pob_bene").html(data[0].pob_bene);
                      $("#est_proy").html(data[0].est_proy);
                      $("#fecha_inicio").html(date_1[0]);
                      $("#fecha_fin").html(date_2[0]);
                      $("#avance_pres").html(val_format_1);
                      $("#avance_prod").html(avance);
                      $("#costo_estim").html(val_format_2);
                      $("#costo_ejec").html(val_format_3);
                  },
                  error:function(){alert('error');}
              });//fin de la consulta ajax (Editar proceso)
          }
      });//Termina tbody
    </script>    
@stop

@endif<!--Cierra el if de mostrar el contenido de la página si esta autenticado-->