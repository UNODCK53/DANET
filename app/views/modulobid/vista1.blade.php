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
      <div class="col-sm-1"></div>
        <div class="col-sm-10">          
          <!--aca se escribe el codigo-->
          <h2 class="text-center text-primary">Cargar Información</h2>
          <br>
          <p class="lead text-justify">En esta sección usted puede cargar información de Casos de Éxito, Alianzas Estratégicas, Prensa y Actividades las cuales serán presentadas en la sección pública del proyecto BID.</p>
          <div class="row">
            <?php $status=Session::get('status');?>
              @if($status=='ok_estatus')
              <div class="col-sm-1"></div>
              <div id = "mensajeestatus" class="alert alert-success col-sm-10"><button class="close" data-dismiss="alert" type="button">×</button>
              <i class="bg-success"></i> La información fue cargada con éxito</div>
              <div class="col-sm-1"></div>
              @endif
              @if($status=='ok_estatus_seccion')
              <div class="col-sm-1"></div>
              <div id = "mensajeestatus" class="alert alert-success col-sm-10"><button class="close" data-dismiss="alert" type="button">×</button>
              <i class="bg-success"></i> La sección fue cargada con éxito</div>
              <div class="col-sm-1"></div>
              @endif
              @if($status=='ok_estatus_delete_seccion')
              <div class="col-sm-1"></div>
              <div id = "mensajeestatus" class="alert alert-success col-sm-10"><button class="close" data-dismiss="alert" type="button">×</button>
              <i class="bg-success"></i> La sección fue borrada con éxito</div>
              <div class="col-sm-1"></div>
              @endif
              @if($status=='ok_estatus_delete_informacion')
              <div class="col-sm-1"></div>
              <div id = "mensajeestatus" class="alert alert-success col-sm-10"><button class="close" data-dismiss="alert" type="button">×</button>
              <i class="bg-success"></i> La información fue borrada con éxito</div>
              <div class="col-sm-1"></div>
              @endif
            <?php $status=0; ?>
          </div>
          <button type="button" class="btn btn-primary" data-toggle="modal" aria-pressed="false" autocomplete="off" data-target="#cargar-informacion">
          Cargar información          
          </button>
          <button id="borrar-informacion" type="button" disabled="disabled" class="btn btn-danger" data-toggle="modal" data-target="#borrar_informacion">Borrar información</button>
          <button id='adicionar_seccion' type="button" class="btn btn-primary" disabled="disabled" data-toggle="modal" aria-pressed="false" autocomplete="off" data-target="#adicionar-seccion">Adicionar sección</button>
          <button id="borrar-seccion" type="button" disabled="disabled" class="btn btn-danger" data-toggle="modal" data-target="#borrar_seccion">Borrar sección</button>
          <br><br>
          <div id="cargar-informacion" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">Cargar Información<h4>
                </div>                
                <div class="modal-body">
                  <form role="form" action="bid/cargar-informacion" method="post" id="cargarproy" enctype="multipart/form-data">
                  <h4>Seleccione tipo de información</h4>
                  <select required id="tipo" name="tipo" class="form-control">                    
                    <option disabled selected>Seleccione una opción</option>
                    <option value="1">Casos de éxito</option>
                    <option value="2">Alianzas estratégicas</option>
                    <option value="3">Prensa</option>
                    <option value="4">Actividades</option>
                  </select>
                  <h4>Fecha de la información</h4>
                  <div class="input-group date" id="datepicker">                      
                    <input id="fecha_info" type="text" class="form-control" name="fecha_info" required="true" placeholder="Fecha de la información">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>                      
                  </div>
                  <h4>Ingrese el título</h4>
                  <input required id="titulo" name="titulo" type="text" class="form-control" placeholder="Text input">
                  <h4>Ingrese el texto</h4>
                  <textarea required id="texto" name="texto" class="form-control" rows="5"></textarea>
                  <h4>Adjunte la foto de la noticia</h4>
                  <input id="name_foto" type="hidden" class="form-control" name="name_foto" value='0' readonly>                          
                  <input id="foto" type="file" class="form-control" name="foto" required accept=".jpg">
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                  <button type="submit" class="btn btn-primary">Cargar información</button>
                </div>
                </form>
              </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
          </div><!-- /.modal -->
          <div id="adicionar-seccion" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 id='adicionar-subtittle'><h4>
                  <h5>Adicionar sección<h5>
                  
                </div>                
                <div class="modal-body">
                <form role="form" action="bid/cargar-seccion" method="post" id="cargarproy" enctype="multipart/form-data">
                  <input type="text" id="id_cargar_seccion" name="id_cargar_seccion"  class="form-control" style="display: none;">
                  <h4>Ingrese el título de la sección</h4>
                  <input required id="titulo_seccion" name="titulo_seccion" type="text" class="form-control" placeholder="Text input">
                  <h4>Ingrese el texto de la sección</h4>
                  <textarea required id="texto_seccion" name="texto_seccion" class="form-control" rows="5"></textarea>
                  <h4>Adjunte la foto de la sección noticia</h4>
                  <input id="name_foto_seccion" type="hidden" class="form-control" name="name_foto_seccion" value='0' readonly>
                  <input id="foto_seccion" type="file" class="form-control" name="foto_seccion" accept=".jpg">
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                  <button type="submit" class="btn btn-primary">Adicionar sección</button>                  
                </div>
                </form>
              </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
          </div><!-- /.modal -->
          <!--Aca inicia el modal para borrar seccion-->
          <div class="modal fade" id="borrar_seccion" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
            <div class="modal-dialog modal-sm" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="borrar_lp_tittle">Borrar sección</h4>
                  </div>
                  <div class="modal-body">
                    <form role="form" action="bid/borrar-seccion" method="post" id="cargarproy" enctype="multipart/form-data">
                    <!--El siguiente input es invisible para el usuario. Cotiene el id del proyecto a modificar-->
                    <input type="text" id="id_borrar_seccion" name="id_borrar_seccion"  class="form-control" style="display: none;">
                    <i id="id_borrar_seccion_texto"></i>
                  </div>
                  <div class="modal-footer" style="margin-bottom: 5px">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                      <button type="submit" class="btn btn-danger">Borrar sección</button>
                  </div>
                  </form>
              </div>
            </div>
          </div>
          <!--Aca finaliza el modal para borrar seccion-->
          <!--Aca inicia el modal para borrar informacion-->
          <div class="modal fade" id="borrar_informacion" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
            <div class="modal-dialog modal-sm" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="borrar_lp_tittle">Borrar Información</h4>
                  </div>
                  <div class="modal-body">
                    <form role="form" action="bid/borrar-informacion" method="post" id="cargarproy" enctype="multipart/form-data">
                    <!--El siguiente input es invisible para el usuario. Cotiene el id del proyecto a modificar-->
                    <input type="text" id="id_borrar_informacion" name="id_borrar_informacion"  class="form-control" style="display: none;">
                    <b><i id="id_borrar_informacion_texto"></i></b>
                  </div>
                  <div class="modal-footer" style="margin-bottom: 5px">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                      <button type="submit" class="btn btn-danger">Borrar información</button>
                  </div>
                  </form>
              </div>
            </div>
          </div>
          <!--Aca finaliza el modal para borrar informacion-->
          <!--Acá inicia la tabla de proyectos-->
          <h4>Listado de información disponible</h4>
          <table id="tabla_informacion" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>  
              <tr class="well text-primary" data-toggle="tooltip" data-placement="top" >
                <th class="text-center">Título</th>
                <th class="text-center">Tipo</th>                
                <th class="text-center">Fecha</th>
              </tr>
            </thead>
            <tbody>            
              @foreach($informacion as $pro)
                <tr id="{{$pro->id}}">
                  <td >{{$pro->titulo}}</td>
                  @if($pro->tipo==1)           
                  <td>Caso de éxito</td>
                  @elseif($pro->tipo==2)
                  <td>Alianza estratégica</td>
                  @elseif($pro->tipo==3)
                  <td>Prensa</td>
                  @else
                  <td>Actividad</td>
                  @endif
                  <td >{{$pro->fecha_noticia}}</td>                       
                </tr>            
              @endforeach 
            </tbody>
          </table>

          <!--Aca finaliza la tabla de proyectos cargados-->
          <div id="seccion_secciones" style="display: none;">
            <h2 class="text-center text-primary">Secciones de la información</h2>
            <div id="tabla_seccion_div">            
            </div>
          </div>            
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
          $( "#bid" ).addClass("active");
          $( "#cargaorganizacionmenu" ).addClass("active");
          $( "#iniciomenupeq" ).html("<small> INICIO</small>");
          $( "#artmenupeq" ).html("<strong>ART<span class='caret'></span></strong>");
          $( "#artdashboardmenupeq" ).html("<strong><span class='glyphicon glyphicon-ok'></span>Dashboard</strong>");
          $( "#mensajeestatus" ).fadeOut(5000);
          $('#tabla_informacion').DataTable();
          $('#datepicker').datepicker({
            format: "yyyy-mm-dd",
            language: "es",
            startDate: "2016-12-01",            
            todayBtn: "linked",
            orientation: "auto",
            autoclose: true,
            todayHighlight: true
          }); 
      });

      var table = $('#tabla_informacion').DataTable();
      
      $('#tabla_informacion tbody').on('click', 'tr', function () {
          if ( $(this).hasClass('active') ) {
              $(this).removeClass('active');
              $("#adicionar_seccion").prop('disabled', true);
              $("#borrar-seccion").prop('disabled', true);
              $("#borrar-informacion").prop('disabled', true);
              $('#seccion_secciones').hide()
          } else {
              table.$('tr.active').removeClass('active');              
              $(this).addClass('active');
              $("#adicionar_seccion").prop('disabled', false);
              $("#borrar-informacion").prop('disabled', false);
              var id=$(this);
              var num=id[0].id;
              var name=id[0].cells[0].innerText;
              $('#adicionar-subtittle').html(name);
              $('#id_cargar_seccion').val(num);
              $('#id_borrar_informacion').val(num);
              $('#id_borrar_informacion_texto').html(name);
              $.ajax({
                  url:"bid/lista-secciones",
                  type:"POST",
                  data:{id: num},
                  dataType:'json',
                  success:function(data){
                      $("#tabla_seccion_div").empty();
                      if(data.length>0){

                        table_seccion = $('<table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%"></table>');
                        table_seccion.append('<thead><tr class="well text-primary" data-toggle="tooltip" data-placement="top" ><th class="text-center">Título</th></tr></thead>');
                        table_seccion.append('<tbody>');
                        for (var i = 0; i < data.length; i++) {
                          var row="<tr id="+data[i].id+"><td>"+data[i].titulo+"</td></tr>"
                          table_seccion.append(row);
                        }
                        table_seccion.append('</tbody>');
                        $('#tabla_seccion_div').append(table_seccion);
                        table_seccion.attr('id', 'example');
                        table2=$('#example').DataTable();
                        $('#seccion_secciones').show();
                        $('#example tbody').on('click', 'tr', function () {
                            console.log('Hola mundo')
                            if ( $(this).hasClass('active') ) {
                                $(this).removeClass('active');
                                $("#borrar-seccion").prop('disabled', true);
                            } else {
                                table2.$('tr.active').removeClass('active');
                                $(this).addClass('active');
                                $("#borrar-seccion").prop('disabled', false);
                                var id=$(this);
                                var num2=id[0].id;
                                var name2=id[0].cells[0].innerText;
                                $('#id_borrar_seccion').val(num2);
                                $('#id_borrar_seccion_texto').append("<b>Información:</b> " + name + "<br><br>");
                                $('#id_borrar_seccion_texto').append("<b>Sección:</b> " + name2);
                            }
                        });//Termina tbody
                      } else {
                        $("#borrar-seccion").prop('disabled', true);
                        $('#seccion_secciones').hide();
                      }
                                                   
                  },
                  error:function(){alert('error');}
              });//Termina Ajax listadoproini
          }
      });//Termina tbody
      
      
    </script>    
@stop

@endif<!--Cierra el if de mostrar el contenido de la página si esta autenticado-->