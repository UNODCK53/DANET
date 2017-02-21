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
          <h2 class="text-center text-primary">BID - Carga de información pública de las organizaciones</h2>
          <br><br>
          <div class="row">
          <?php $status=Session::get('status');?>
            @if($status=='ok_estatus')
            <div class="col-sm-1"></div>
            <div id = "mensajeestatus" class="alert alert-success col-sm-10"><button class="close" data-dismiss="alert" type="button">×</button>
            <i class="bg-success"></i> El proyecto fue cargado con éxito</div>
            <div class="col-sm-1"></div>
            @endif
            @if($status=='error_estatus')
            <div class="col-sm-1"></div>
            <div id = "mensajeestatus"class="alert alert-danger col-sm-10"><button class="close" data-dismiss="alert" type="button">×</button>
            <i class="bg-danger"></i> El proyecto NO fue creado</div>
            <div class="col-sm-1"></div>
            @endif
            @if($status=='ok_estatus_editar')
            <div class="col-sm-1"></div>
            <div id = "mensajeestatus" class="alert alert-success col-sm-10"><button class="close" data-dismiss="alert" type="button">×</button>
            <i class="bg-success"></i> El proyecto fue editado con éxito</div>
            <div class="col-sm-1"></div>
            @endif
            @if($status=='error_estatus_editar')
            <div class="col-sm-1"></div>
            <div id = "mensajeestatus"class="alert alert-danger col-sm-10"><button class="close" data-dismiss="alert" type="button">×</button>
            <i class="bg-danger"></i> El proyecto NO fue editado</div>
            <div class="col-sm-1"></div>
            @endif
            @if($status=='ok_estatus_borrar')
            <div class="col-sm-1"></div>
            <div id = "mensajeestatus" class="alert alert-success col-sm-10"><button class="close" data-dismiss="alert" type="button">×</button>
            <i class="bg-success"></i> El proyecto fue eliminado con éxito</div>
            <div class="col-sm-1"></div>
            @endif
            @if($status=='error_estatus_borrar')
            <div class="col-sm-1"></div>
            <div id = "mensajeestatus"class="alert alert-danger col-sm-10"><button class="close" data-dismiss="alert" type="button">×</button>
            <i class="bg-danger"></i> El proyecto NO fue eliminado</div>
            <div class="col-sm-1"></div>
            @endif
          <?php $status=0; ?>
        </div>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#cargar_info">Cargar información</button>
            <button id="edit_banner" type="button" disabled="disabled" class="btn btn-primary" data-toggle="modal" data-target="#editar_banner">Cambiar banner</button>
            <button id="edit_logo" type="button" disabled="disabled" class="btn btn-primary" data-toggle="modal" data-target="#editar_logo">Cambiar Logo</button>
            <button id="edit_lp" type="button" disabled="disabled" class="btn btn-primary" data-toggle="modal" data-target="#editar_lp">Editar línea productiva</button>
            <button id="edit_va" type="button" disabled="disabled" class="btn btn-primary" data-toggle="modal" data-target="#editar_lp">Editar valor agregado</button>
            <!--Aca inicia el modal para cargar nueva información-->
            <!-- Modal -->
            <div class="modal fade" id="cargar_info" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Carga de información pública de las organizaciones</h4>
                  </div>
                  <div class="modal-body">
                      <form role="form" action="bid/cargar" method="post" id="cargarproy" enctype="multipart/form-data" novalidate> 
                        <h4>Departamento</h4>
                        <select required id="depto" name="depto" class="form-control" onchange="filter_organizaciones()">
                          <option selected disabled>Seleccione un departamento</option>  
                          @foreach($departamentos as $pro)                  
                            <option value="{{$pro->COD_DPTO}}">{{$pro->NOM_DPTO}}</option>                    
                          @endforeach                    
                        </select>
                        <h4>Organización</h4>
                        <select required id="organizaciones" name="organizaciones" class="form-control">
                          <option selected disabled>Seleccione una organizacion</option>                                                
                        </select>
                        <h4>¿La organización tiene banner personalizado?</h4>
                        <div class="radio">
                          <label>
                            <input type="radio" name="optionsRadios" id="si" value="1" onchange="banner(this)">
                            Si
                          </label>
                        </div>
                        <div class="radio">
                          <label>
                            <input type="radio" name="optionsRadios" id="no" value="0" onchange="banner(this)" checked>
                            No
                          </label>
                        </div>
                        <div id="div_banner" class="form-group" style="display: none">
                          <h4>Adjuntar banner de la organización</h4>
                          <input id="name_banner" type="hidden" class="form-control" name="name_banner" value='0' readonly>                          
                          <input id="bannerjpg" type="file" class="form-control" name="bannerjpg" accept=".jpg" >
                        </div>
                        <h4>¿La organización tiene logo?</h4>
                        <div class="radio">
                          <label>
                            <input type="radio" name="optionsRadios_logo" id="si" value="1" onchange="logo(this)">
                            Si
                          </label>
                        </div>
                        <div class="radio">
                          <label>
                            <input type="radio" name="optionsRadios_logo" id="no" value="0" onchange="logo(this)" checked>
                            No
                          </label>
                        </div>
                        <div id="div_logo" class="form-group" style="display: none">
                          <h4>Adjunte logo de la organización</h4>
                          <input id="name_logo" type="hidden" class="form-control" name="name_logo" value='0' readonly>                          
                          <input id="logojpg" type="file" class="form-control" name="logojpg" required accept=".jpg">
                        </div>
                        <h4>Descripción de la organización</h4>
                        <textarea required id="descripcion" name="descripcion" class="form-control" rows="3"></textarea>
                        <!--Aca inica la descripción de las líneas productivas y de la información de valor agregado-->
                        <h4>¿La organización cuenta con información de líneas productivas y valor agregado?</h4>
                        <div class="radio">
                          <label>
                            <input type="radio" name="optionsRadios_lpva" id="si" value="1" onchange="lpva(this)">
                            Si
                          </label>
                        </div>
                        <div class="radio">
                          <label>
                            <input type="radio" name="optionsRadios_lpva" id="no" value="0" onchange="lpva(this)" checked>
                            No
                          </label>
                        </div>
                        <div class="raw" id="div_lp_va" style="display: none">
                          <h4>Ingrese la línea productiva de la organización</h4>
                          <input id="linea_prod" name="linea_prod" type="text" class="form-control" placeholder="Text input">
                          <!--Aca finaliza el modal para cargar nueva información-->
                          <h4>¿La línea productiva tiene imagen?</h4>
                          <div class="radio">
                            <label>
                              <input type="radio" name="optionsRadios_imagen_lp" id="si" value="1" onchange="imagen_lp(this)">
                              Si
                            </label>
                          </div>
                          <div class="radio">
                            <label>
                              <input type="radio" name="optionsRadios_imagen_lp" id="no" value="0" onchange="imagen_lp(this)" checked>
                              No
                            </label>
                          </div>
                          <div id="div_imagen_lp" class="form-group" style="display: none">
                            <h4>Adjunte la imagen de la línea productiva</h4>
                            <input id="name_logo_lp" type="hidden" class="form-control" name="name_logo_lp" value='0' readonly>                          
                            <input id="logo_lp" type="file" class="form-control" name="logo_lp" required accept=".jpg" >
                          </div>
                          <h4>¿La línea productiva tiene descripción?</h4>
                          <div class="radio">
                            <label>
                              <input type="radio" name="optionsRadios_descripcion_lp" id="si" value="1" onchange="descripcion_lp(this)">
                              Si
                            </label>
                          </div>
                          <div class="radio">
                            <label>
                              <input type="radio" name="optionsRadios_descripcion_lp" id="no" value="0" onchange="descripcion_lp(this)" checked>
                              No
                            </label>
                          </div>
                          <div id="div_descripcion_lp" class="form-group" style="display: none">
                            <h4>Ingrese la descripción de la línea productiva</h4>
                            <textarea id="descr_lp" name="descr_lp" class="form-control" rows="3"></textarea>
                          </div>
                          <h4>¿Seleccione valor agregado?</h4>
                          <select id="valoragregado" name="valoragregado" class="form-control">
                            <option selected disabled>Seleccione un valor agregado</option>  
                            @foreach($array[0] as $pro)                  
                              <option value="{{$pro->id}}">{{$pro->nombre}}</option>                    
                            @endforeach
                          </select>
                          <h4>Ingrese la descripción de valor agregada</h4>
                          <input id="va" name="va" type="text" class="form-control" placeholder="Text input">
                        </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Cargar informacion</button>
                  </div>
                  </form>
                </div>
              </div>
            </div>
            <!--Aca finaliza el modal para cargar nueva información-->
            <!--Aca inicia el modal para editar el banner-->
            <!-- Modal -->
            <div class="modal fade" id="editar_banner" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="edit-banner-title"></h4>
                  </div>
                  <div class="modal-body">
                      <form role="form" action="bid/edit-banner" method="post" id="cargarproy" enctype="multipart/form-data" novalidate>
                      <!--El siguiente input es invisible para el usuario. Cotiene el id del proyecto a modificar-->
                      <input type="text" id="id_editar_banner" name="id_editar_banner"  class="form-control" style="display: none;">
                        <h4>Adjuntar banner de la organización</h4>
                        <input id="name_banner_edit" type="hidden" class="form-control" name="name_banner_edit" value='0' readonly>
                        <input id="bannerjpg_edit" type="file" class="form-control" name="bannerjpg_edit" accept=".jpg" >
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Cargar informacion</button>
                  </div>
                  </form>
                </div>
              </div>
            </div>
            <!--Aca finaliza el modal para editar el banner-->
            <!--Aca inicia el modal para editar el logo-->
            <!-- Modal -->
            <div class="modal fade" id="editar_logo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="edit-logo-title"></h4>
                  </div>
                  <div class="modal-body">
                      <form role="form" action="bid/edit-logo" method="post" id="cargarproy" enctype="multipart/form-data" novalidate>
                      <!--El siguiente input es invisible para el usuario. Cotiene el id del proyecto a modificar-->
                      <input type="text" id="id_editar_logo" name="id_editar_logo"  class="form-control" style="display: none;">
                        <h4>Adjuntar logo de la organización</h4>
                        <input id="name_logo_edit" type="hidden" class="form-control" name="name_logo_edit" value='0' readonly>
                        <input id="logojpg_edit" type="file" class="form-control" name="logojpg_edit" accept=".jpg" >
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Cargar informacion</button>
                  </div>
                  </form>
                </div>
              </div>
            </div>
            <!--Aca finaliza el modal para editar el logo-->
            <!--Aca inicia el modal para editar las líneas productivas-->
            <!-- Modal -->
            <div class="modal fade" id="editar_lp" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="edit-lp-title"></h4>
                  </div>
                  <div class="modal-body">                      
                      <!--Acá inicia la tabla de proyectos-->
                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#adicionar_linea">Adicionar línea productiva</button>
                      <button id="borrar_lp_button" type="button" class="btn btn-danger" disabled="disabled" data-toggle="modal" data-target="#borrar_lp">Borrar línea productiva</button>
                      <h4>Líneas productivas por organización</h4>
                      <table id="tabla_lp" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                        <thead>  
                          <tr class="well text-primary" data-toggle="tooltip" data-placement="top" >
                            <th class="text-center">Línea productiva</th>
                            <th class="text-center">Descripción</th>                            
                          </tr>
                        </thead>
                        <tbody id="tabla_lp_body">
                        </tbody>
                      </table>
                        <!--Aca finaliza la tabla de proyectos cargados-->                        
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>                    
                  </div>
                </div>
              </div>
            </div>
            <!--Aca finaliza el modal para editar las líneas productivas-->
            <!--Aca inicia el modal para adicionar líneas productivas-->            
            <div class="modal fade" id="adicionar_linea" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="edit-adicionar-lp-title"></h4>
                  </div>
                  <div class="modal-body">
                      <form role="form" action="bid/adicionar-linea" method="post" id="adicionar_linea" enctype="multipart/form-data" novalidate>
                      <!--El siguiente input es invisible para el usuario. Cotiene el id del proyecto a modificar-->
                      <input type="text" id="id_adicionar_linea" name="id_adicionar_linea"  class="form-control" style="display: none;">
                      <h4>Ingrese la línea productiva de la organización</h4>
                      <input id="linea_prod_add" name="linea_prod_add" type="text" class="form-control" placeholder="Text input">
                      <!--Aca finaliza el modal para cargar nueva información-->
                      <h4>¿La línea productiva tiene imagen?</h4>
                      <div class="radio">
                        <label>
                          <input type="radio" name="optionsRadios_imagen_lp_edit" id="si" value="1" onchange="imagen_lp_edit(this)">
                          Si
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input type="radio" name="optionsRadios_imagen_lp_edit" id="no" value="0" onchange="imagen_lp_edit(this)" checked>
                          No
                        </label>
                      </div>
                      <div id="div_imagen_lp_edit" class="form-group" style="display: none">
                        <h4>Adjunte la imagen de la línea productiva</h4>
                        <input id="name_logo_lp_edit" type="hidden" class="form-control" name="name_logo_lp" value='0' readonly>                         
                        <input id="logo_lp_edit" type="file" class="form-control" name="logo_lp" required accept=".jpg" >
                      </div>
                      <h4>¿La línea productiva tiene descripción?</h4>
                      <div class="radio">
                        <label>
                          <input type="radio" name="optionsRadios_descripcion_lp_add" id="si" value="1" onchange="descripcion_lp_edit(this)">
                          Si
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input type="radio" name="optionsRadios_descripcion_lp_add" id="no" value="0" onchange="descripcion_lp_edit(this)" checked>
                          No
                        </label>
                      </div>
                      <div id="div_descripcion_lp_edit" class="form-group" style="display: none">
                        <h4>Ingrese la descripción de la línea productiva</h4>
                        <textarea id="descr_lp_add" name="descr_lp_add" class="form-control" rows="3"></textarea>
                      </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Cargar informacion</button>
                  </div>
                  </form>
                </div>
              </div>
            </div>
            <!--Aca finaliza el modal para adicionar líneas productivas-->
            <!--Aca inicia el modal para borrar línea productiva-->
            <div class="modal fade bs-example-modal-sm" id="borrar_lp" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
              <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="borrar_lp_tittle">Ups</h4>
                    </div>
                    <div class="modal-body">
                    <form role="form" action="bid/borrar-lp" method="post" id="cargarproy" enctype="multipart/form-data">
                    <!--El siguiente input es invisible para el usuario. Cotiene el id del proyecto a modificar-->
                    <input type="text" id="id_borrar" name="id_borrar"  class="form-control" style="display: none;">
                    Esta seguro que desea borrar la línea productiva
                    <br><br>
                    <b><i id="id_borrar_lp"></i></b>                
                    
                    </div>
                    <div class="modal-footer" style="margin-bottom: 5px">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Borrar línea productiva</button>
                    </div>
                    </form>
                </div>
              </div>
            </div>
            <!--Aca finaliza el modal para borrar proyecto-->
            <!--Aca inicia la tabla de proyectos cargados-->
            <!--Acá inicia la tabla de proyectos-->
          <h4>Listado de organizaciones</h4>
          <table id="tabla_organizaciones" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>  
              <tr class="well text-primary" data-toggle="tooltip" data-placement="top" >
                <th class="text-center">Departamento</th>
                <th class="text-center">NIT</th>                
                <th class="text-center">Acrónimo</th>
                <th class="text-center">Organización</th>                                                                          
              </tr>
            </thead>
            <tbody>            
              @foreach($array[1] as $pro)
                <tr id="{{$pro->nit}}">
                  <td >{{$pro->NOM_DPTO}}</td>                  
                  <td >{{$pro->nit}}</td>
                  <td >{{$pro->acronim}}</td>
                  <td >{{$pro->nombre}}</td>                                                           
                </tr>            
              @endforeach 
            </tbody>
          </table>
            <!--Aca finaliza la tabla de proyectos cargados-->
            
                  
          <!--fin del codigo-->   
          </div>
        </div>
      <div class="col-sm-1"></div> 
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
          $('#tabla_organizaciones').DataTable();
          $('#tabla_lp').DataTable();          
      });

      function filter_organizaciones(){
        var depto=document.getElementById("depto").value;

        $.ajax({
            url:"bid/organizaciones",
            type:"POST",
            data:{depto: depto},
            dataType:'json',
            success:function(data){                                                
                $("#organizaciones").empty();
                $("#organizaciones").append("<option selected disabled>Seleccione una organización</option>");
                for (var i = 0; i < data.length; i++) {
                    $("#organizaciones").append("<option value=\""+data[i].nit+"\">"+data[i].acronim+"</option>");
                    //console.log(data[i].COD_DANE)
                }                                
            },
            error:function(){alert('error');}
        });//Termina Ajax listadoproini
      }

      function banner(e){
        if (e.value=="1"){
          $('#div_banner').css('display','block')
        } else {
          $('#div_banner').css('display','none')
        }
      }

      function logo(e){
        if (e.value=="1"){
          $('#div_logo').css('display','block')
        } else {
          $('#div_logo').css('display','none')
        }
      }
      //Esta define prende y apaga el div que contien la información relacionada con la línea productiva y el valor agregado.
      function lpva(e){
        if (e.value=="1"){
          $('#div_lp_va').css('display','block')
        } else {
          $('#div_lp_va').css('display','none')
        }
      }

      function imagen_lp(e){
        if (e.value=="1"){
          $('#div_imagen_lp').css('display','block')
        } else {
          $('#div_imagen_lp').css('display','none')
        }
      }

      function imagen_lp_edit(e){
        if (e.value=="1"){
          $('#div_imagen_lp_edit').css('display','block')
        } else {
          $('#div_imagen_lp_edit').css('display','none')
        }
      }

      function descripcion_lp(e){
        if (e.value=="1"){
          $('#div_descripcion_lp').css('display','block')
        } else {
          $('#div_descripcion_lp').css('display','none')
        }
      }

      function descripcion_lp_edit(e){
        if (e.value=="1"){
          $('#div_descripcion_lp_edit').css('display','block')
        } else {
          $('#div_descripcion_lp_edit').css('display','none')
        }
      }

      //Termina tbody 
    var table = $('#tabla_organizaciones').DataTable();
    $('#tabla_organizaciones tbody').on('click', 'tr', function () {
        if ( $(this).hasClass('active') ) {
            $(this).removeClass('active');
            $("#edit_banner").prop('disabled', true);
            $("#edit_logo").prop('disabled', true);
            $("#edit_lp").prop('disabled', true);
            $("#edit_va").prop('disabled', true);
        } else {
            table.$('tr.active').removeClass('active');
            $(this).addClass('active');
            $("#edit_banner").prop('disabled', false);
            $("#edit_logo").prop('disabled', false);
            $("#edit_lp").prop('disabled', false);
            $("#edit_va").prop('disabled', false);                                  
            var id=$(this);
            var num=id[0].id;
            $.ajax({
                url:"bid/editar",
                type:"POST",
                data:{organizacion: num},
                dataType:'json',
                success:function(data){                                        
                    var tittle="Cargar o cambiar banner de la organización "+ data[0][0].acronim;
                    var tittle2="Cargar o cambiar logo de la organización "+ data[0][0].acronim;
                    var tittle3="Cargar o cambiar información de línea productiva de la organización "+ data[0][0].acronim;
                    var tittle4="Adicionar línea productiva de la organización "+ data[0][0].acronim;
                    $("#edit-banner-title").html(tittle);
                    $("#edit-logo-title").html(tittle2);
                    $("#edit-lp-title").html(tittle3);
                    $("#edit-adicionar-lp-title").html(tittle4);
                    $("#id_editar_banner").val(num);
                    $("#id_editar_logo").val(num);
                    $("#id_adicionar_linea").val(num);                    
                    $("#tabla_lp_body").empty();
                    for (var i = 0; i < data[1].length; i++) {
                      var table_body="<tr id="+data[1][0].id+"><td>"+data[1][0].linea_prod+"</td><td>"+data[1][0].desc_lp+"</td></tr>"
                      $("#tabla_lp_body").append(table_body);                    
                    }
                },
                error:function(){alert('error');}
            });//fin de la consulta ajax (Editar proceso)
        }
    });//Termina tbody

    var table2 = $('#tabla_lp').DataTable();
    $('#tabla_lp tbody').on('click', 'tr', function () {
        if ( $(this).hasClass('active') ) {
            $(this).removeClass('active');
            $("#borrar_lp_button").prop('disabled', true);           
        } else {
            table2.$('tr.active').removeClass('active');
            $(this).addClass('active');
            $("#borrar_lp_button").prop('disabled', false);            
            var id=$(this);
            var num=id[0].id;
            $.ajax({
                url:"bid/consulta-borrar-lp",
                type:"POST",
                data:{lineaproductiva: num},
                dataType:'json',
                success:function(data){                                        
                    var registro=data[0].linea_prod;                    
                    $("#id_borrar_lp").html(registro);
                    $("#id_borrar").html(num);                    
                },
                error:function(){alert('error');}
            });//fin de la consulta ajax (Editar proceso)
            
        }
    });//Termina tbody


    </script>    
@stop

@endif<!--Cierra el if de mostrar el contenido de la página si esta autenticado-->