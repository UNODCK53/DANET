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
  .icon-naranja {
      color: #FE9A2E;
  }
  .icon-gris {
      color: #A4A4A4;
  }

</style>

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
        <h2 class="text-center text-primary">Producción Normativa</h2>
        <br>
        <p class="lead text-justify">A continuación se presenta el avance de las normas que se están desarrollando para la implementación del acuerdo.</p>
        <div class="row">
            <?php $status=Session::get('status');?>
                @if($status=='ok_estatus')
                <div class="col-sm-1"></div>
                <div id = "mensajeestatus" class="alert alert-success col-sm-10"><button class="close" data-dismiss="alert" type="button">×</button>
                <i class="bg-success"></i> La Norma fue cargada con éxito</div>
                <div class="col-sm-1"></div>
                @endif
                @if($status=='error_estatus')
                <div class="col-sm-1"></div>
                <div id = "mensajeestatus"class="alert alert-danger col-sm-10"><button class="close" data-dismiss="alert" type="button">×</button>
                <i class="bg-danger"></i> La norma NO fue cargada</div>
                <div class="col-sm-1"></div>
                @endif
                @if($status=='ok_estatus_editar')
                <div class="col-sm-1"></div>
                <div id = "mensajeestatus" class="alert alert-success col-sm-10"><button class="close" data-dismiss="alert" type="button">×</button>
                <i class="bg-success"></i> La norma fue editada con éxito</div>
                <div class="col-sm-1"></div>
                @endif
                @if($status=='error_estatus_editar')
                <div class="col-sm-1"></div>
                <div id = "mensajeestatus"class="alert alert-danger col-sm-10"><button class="close" data-dismiss="alert" type="button">×</button>
                <i class="bg-danger"></i> La norma NO fue editada</div>
                <div class="col-sm-1"></div>
                @endif
                @if($status=='ok_estatus_borrar')
                <div class="col-sm-1"></div>
                <div id = "mensajeestatus" class="alert alert-success col-sm-10"><button class="close" data-dismiss="alert" type="button">×</button>
                <i class="bg-success"></i> La norma fue borrada con éxito</div>
                <div class="col-sm-1"></div>
                @endif
                @if($status=='error_estatus_borrar')
                <div class="col-sm-1"></div>
                <div id = "mensajeestatus"class="alert alert-danger col-sm-10"><button class="close" data-dismiss="alert" type="button">×</button>
                <i class="bg-danger"></i> La norma NO fue eliminado</div>
                <div class="col-sm-1"></div>
                @endif
                @if($status=='ok_estatus_corte')
                <div class="col-sm-1"></div>
                <div id = "mensajeestatus" class="alert alert-success col-sm-10"><button class="close" data-dismiss="alert" type="button">×</button>
                <i class="bg-success"></i> Se ha creado el corte de la base de datos</div>
                <div class="col-sm-1"></div>
                @endif
                @if($status=='error_estatus_corte')
                <div class="col-sm-1"></div>
                <div id = "mensajeestatus"class="alert alert-danger col-sm-10"><button class="close" data-dismiss="alert" type="button">×</button>
                <i class="bg-danger"></i> El corte no fue creado - ¡Ya existe un corte para <b><i id="fecha_corte_mensaje"></i></b>!</div>
                <div class="col-sm-1"></div>
                @endif
            <?php $status=0;?>
          </div>
        <button type="button" class="btn btn-primary" data-toggle="modal" aria-pressed="false" autocomplete="off" data-target="#modal-normatividad">
          Cargar norma          
        </button>
        <button id="btnedinorma" disabled="disabled" data-target="#modal-normatividad-edit"  data-toggle="modal" type="button" class="btn btn-primary">Editar norma</button>
         <button id="btneditablero" disabled="disabled" data-target="#modal-normatividad-tablero"  data-toggle="modal" type="button" class="btn btn-success">Editar tablero</button>
         <button id="btnborrar" disabled="disabled" data-target="#borrar_norma"  data-toggle="modal" type="button" class="btn btn-danger">Borrar norma</button>
         <button id="btncorte" data-target="#crear_corte"  data-toggle="modal" type="button" class="btn btn">Crear corte</button>
        <br><br>
        <table id="tablanormas" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
          <thead>  
            <tr class="well text-primary" data-toggle="tooltip" data-placement="top" >
              <th class="text-center">Punto acuerdo</th>
              <th class="text-center">Norma</th>
              <th class="text-center">Responsable</th>
              <th class="text-center">Tipo</th>
              <th class="text-center">Semáforo</th>              
              <th class="text-center">Fecha Gobierno</th>
              <th class="text-center">Consulta previa</th>
              <th class="text-center">Observaciones</th>
            </tr>
          </thead>
          <tbody>
            @foreach($array[3] as $pro)
                <tr id="{{$pro->id}}" valign="middle">
                  <td >{{$pro->pto_acu}}</td>
                  <td >{{$pro->norma}}</td>
                  <td >{{$pro->responsable}}</td>
                  <td >{{$pro->tipo}}</td>
                  <td align="center">
                      @if($pro->id_semafo =="1")
                      <div style="height: 20px; width: 20px; border-radius: 100%; background: #3ADF00"></div>
                      @elseif($pro->id_semafo =="2")
                      <div style="height: 20px; width: 20px; border-radius: 100%; background: #F4FA58"></div> 
                      @elseif($pro->id_semafo =="3")
                      <div style="height: 20px; width: 20px; border-radius: 100%; background: #FE9A2E"></div> 
                      @elseif($pro->id_semafo =="4")
                      <div style="height: 20px; width: 20px; border-radius: 100%; background: #FE2E2E"></div> 
                      @else
                      <div style="height: 20px; width: 20px; border-radius: 100%; background: #A4A4A4"></div> 
                      @endif                    
                  </td>                  
                  <td >{{$pro->fecha_gob}}</td>
                  <td >{{$pro->id_consprev}}</td>
                  <td >{{$pro->obs}}</td>                     
                </tr>            
              @endforeach 
          </tbody>
        </table>
        <div id="modal-normatividad" class="modal fade" tabindex="-1" role="dialog">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Cargar Norma<h4>
              </div>
              <div class="modal-body">
              <form role="form" action="artnormatividad/cargar-norma" method="post" id="cargarproy" enctype="multipart/form-data">
                Punto del acuerdo
                <select id="pto_acu" name="pto_acu" class="form-control" required placeholder="Seleccione un punto del acuerdo">                  
                  <option selected disabled>Seleccione punto del acuerdo</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                  <option value="6">6</option>
                  <option>Otro</option>
                </select>
                <br>
                Nombre de la Norma
                <input id="norma" name="norma" type="text" class="form-control" placeholder="Ingrese el nombre de la norma" required="true">
                <br>
                Responsable
                <br>
                <select id="id_res" name="id_res" class="form-control selectpicker" required="true">
                  <option selected disabled>Seleccione un responsable</option>  
                  @foreach($array[0] as $pro)                  
                    <option value="{{$pro->id}}">{{$pro->nombre}}</option>                    
                  @endforeach
                </select>
                <br>
                Tipo
                <select id="id_tipo" name="id_tipo" class="form-control" required="true">
                  <option selected disabled>Seleccione un tipo de norma</option>  
                  @foreach($array[1] as $pro)                  
                    <option value="{{$pro->id}}">{{$pro->nombre}}</option>                    
                  @endforeach                 
                </select>
                <br>
                Semáforo
                <select id="id_semafo" name="id_semafo" class="form-control selectpicker">
                  <option selected disabled>Seleccione una categoría</option>                  
                  <option data-icon="glyphicon glyphicon-exclamation-sign icon-verde" value='1'>Verde</option>
                  <option data-icon="glyphicon glyphicon-exclamation-sign icon-amarillo" value='2'>Amarillo</option>
                  <option data-icon="glyphicon glyphicon-exclamation-sign icon-naranja" value='3'>Naranja</option>
                  <option data-icon="glyphicon glyphicon-exclamation-sign icon-rojo" value='4'>Rojo</option>
                  <option data-icon="glyphicon glyphicon-exclamation-sign icon-gris" value='5'>Gris</option>
                  
                  
                </select>
                <br>
                Fecha Gobierno
                <div class="input-group date" id="datepicker">                      
                  <input id="fecha_gob" type="text" class="form-control" name="fecha_gob" required="true" placeholder="Fecha de elaboración del documento">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>                      
                </div>
                <br>
                Consulta previa
                <select id="id_consprev" name="id_consprev" class="form-control" required="true">
                  <option selected disabled>Seleccione una categoría</option>
                  <option value="1">Pendiente concepto</option>
                  <option value="2">Pendiente entrega texto</option>
                  <option value="3">OK</option>
                  <option value="4">No requiere</option>
                </select>
                <br>
                Observaciones
                <input id="obs" name="obs" type="text" class="form-control" placeholder="Text input">
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Cargar norma</button>
              </div>
              </form>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        
        <!-- Inicia modal editar norma -->
        <div id="modal-normatividad-edit" class="modal fade" tabindex="-1" role="dialog">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 id="editar-tittle" class="modal-title">Editar Norma<h4>
              </div>
              <div class="modal-body">
              <form role="form" action="artnormatividad/editar-norma" method="post" id="cargarproy" enctype="multipart/form-data">
                <!--El siguiente input es invisible para el usuario. Cotiene el id del proyecto a modificar-->
                <input type="text" id="id_editar" name="id_editar"  class="form-control" style="display: none;">
                Punto del acuerdo
                <select id="pto_acu-edit" name="pto_acu-edit" class="form-control">
                  <option>1</option>
                  <option>2</option>
                  <option>3</option>
                  <option>4</option>
                  <option>5</option>
                  <option>6</option>
                  <option>Otro</option>
                </select>
                <br>
                Nombre de la Norma
                <input id="norma-edit" name="norma-edit" type="text" class="form-control" placeholder="Text input">
                <br>
                Responsable
                <br>
                <select id="id_res_edit" name="id_res_edit" class="form-control selectpicker">
                  <option selected disabled>Seleccione un responsable</option>  
                  @foreach($array[0] as $pro)                  
                    <option value="{{$pro->id}}">{{$pro->nombre}}</option>                    
                  @endforeach
                </select>
                <br>
                Tipo
                <select id="id_tipo_edit" name="id_tipo_edit" class="form-control">
                  <option selected disabled>Seleccione un tipo de norma</option>  
                  @foreach($array[1] as $pro)                  
                    <option value="{{$pro->id}}">{{$pro->nombre}}</option>                    
                  @endforeach                 
                </select>
                <br>
                Semáforo
                <select id="id_semafo_edit" name="id_semafo_edit" class="form-control selectpicker">
                  <option selected disabled>Seleccione una categoría</option>                  
                  <option data-icon="glyphicon glyphicon-exclamation-sign icon-verde" value='1'>Verde</option>
                  <option data-icon="glyphicon glyphicon-exclamation-sign icon-amarillo" value='2'>Amarillo</option>
                  <option data-icon="glyphicon glyphicon-exclamation-sign icon-naranja" value='3'>Naranja</option>
                  <option data-icon="glyphicon glyphicon-exclamation-sign icon-rojo" value='4'>Rojo</option>
                  <option data-icon="glyphicon glyphicon-exclamation-sign icon-gris" value='5'>Gris</option>
                </select>
                <br>
                Consulta previa
                <select id="id_consprev_edit" name="id_consprev_edit" class="form-control">
                  <option selected disabled>Seleccione una categoría</option>
                  <option value="1">Pendiente concepto</option>
                  <option value="2">Pendiente entrega texto</option>
                  <option value="3">OK</option>
                  <option value="4">No requiere</option>
                </select>
                <br>                
                Observaciones
                <input id="obs_edit" name="obs_edit" type="text" class="form-control" placeholder="Text input">
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Editar norma</button>
              </div>
              </form>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal --> 
        <!-- Fin modal editar norma -->
        <!-- Inicia modal editar tablero de control -->
        <div id="modal-normatividad-tablero" class="modal fade" tabindex="-1" role="dialog">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 id="editar-tablero-tittle" class="modal-title">Editar Tablero de Control<h4>
              </div>
              <div class="modal-body">
              <form role="form" action="artnormatividad/editar-tablero" method="post" id="cargarproy" enctype="multipart/form-data">
                <!--El siguiente input es invisible para el usuario. Cotiene el id del proyecto a modificar-->
                <input type="text" id="id_editar_tablero" name="id_editar_tablero"  class="form-control" style="display: none;">
                1. En Construcción
                <select id="tab_encons" disabled name="tab_encons" class="form-control">
                  <option value="1">Si</option>
                  <option value="2">No</option>                                    
                </select>
                <div id="paso2">
                2. Producción Jurídica
                <select id="tab_prodjud" name="tab_prodjud" class="form-control" onchange="validacion(this)">
                  <option value="1">Si</option>
                  <option value="2">No</option>
                </select>
                </div>
                <div id="paso3" style="display: none">
                3. Ajustes
                <select id="tab_ajus" name="tab_ajus" class="form-control" onchange="validacion(this)">
                  <option value="1">Si</option>
                  <option value="2">No</option>                                    
                </select>
                </div>
                <div id="paso4" style="display: none">
                4. Última Revisión
                <select id="tab_ultrev" name="tab_ultrev" class="form-control" onchange="validacion(this)">
                  <option value="1">Si</option>
                  <option value="2">No</option>                                    
                </select>
                </div>
                <div id="paso5" style="display: none">
                5. Por definir expedición
                <select id="tab_defexp" name="tab_defexp" class="form-control" onchange="validacion(this)">
                  <option value="1">Si</option>
                  <option value="2">No</option>                                                     
                </select>
                </div>
                <div id="etapa2" style="display: none">
                  6. CSIVI
                  <select id="tab_csivi" name="tab_csivi" class="form-control">
                    <option value="1">Si</option>
                    <option value="2">No</option>                                     
                  </select>
                  7. Hacienda
                  <select id="tab_hacie" name="tab_hacie" class="form-control">
                    <option value="1">Si</option>
                    <option value="2">No</option>
                    <option value="3">Na</option>                  
                  </select>
                  8. Socialización
                  <select id="tab_social" name="tab_social" class="form-control">
                    <option value="1">Si</option>
                    <option value="2">No</option>
                    <option value="3">Na</option>                  
                  </select>
                  <!--
                  <div id="paso6b">
                  6.b Concepto consulta previa
                  <select id="tab_inte" name="tab_inte" class="form-control">
                    <option value="1">Si</option>
                    <option value="2">No</option>
                    <option value="3" style="display: none">Na</option>                    
                  </select>
                  </div>-->
                  8. Expedido
                  <select id="tab_expe" name="tab_expe" class="form-control">
                    <option value="1">Si</option>
                    <option value="2">No</option>
                    <option value="3">Na</option>                  
                  </select>
                  9. Congreso
                  <select id="tab_congre" name="tab_congre" class="form-control">
                    <option value="1">Si</option>
                    <option value="2">No</option>
                    <option value="3">Na</option>                  
                  </select>
                  10. Firmas
                  <select id="tab_firma" name="tab_firma" class="form-control">
                    <option value="1">Si</option>
                    <option value="2">No</option>
                    <option value="3">Na</option>                  
                  </select>
                  11. Sanción Presidencial
                  <select id="tab_sancpres" name="tab_sancpres" class="form-control">
                    <option value="1">Si</option>
                    <option value="2">No</option>
                    <option value="3">Na</option>              
                  </select>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Editar tablero</button>
              </div>
              </form>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal --> 
        <!-- Fin modal editar tablero de control -->
        <!--Aca inicia el modal para borrar proyecto-->
          <div class="modal fade bs-example-modal-sm" id="borrar_norma" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
            <div class="modal-dialog modal-sm" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="borrar_tittle">Borrar norma</h4>
                  </div>
                  <div class="modal-body">
                  <form role="form" action="artnormatividad/borrar-norma" method="post" id="cargarproy" enctype="multipart/form-data">
                  <!--El siguiente input es invisible para el usuario. Cotiene el id del proyecto a modificar-->
                  <input type="text" id="id_borrar" name="id_borrar"  class="form-control" style="display: none;">
                  Esta seguro que desea borrar la norma
                  <br><br>
                  <b><i id="id_borrar_norma"></i></b>                
                  
                  </div>
                  <div class="modal-footer" style="margin-bottom: 5px">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Borrar norma</button>
                  </div>
                  </form>
              </div>
            </div>
          </div>
          <!--Aca finaliza el modal para borrar proyecto-->
          <!--Aca inicia el modal para borrar proyecto-->
          <div class="modal fade bs-example-modal-sm" id="crear_corte" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
            <div class="modal-dialog modal-sm" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="borrar_tittle">Crear corte para reportes</h4>
                  </div>
                  <div class="modal-body">
                  <form role="form" action="artnormatividad/corte" method="post" id="cargarproy" enctype="multipart/form-data">
                  Se va a crear un corte de la base de datos con fecha:
                  <br><br>
                  <b><i id="fecha_corte_texto"></i></b> 
                  <input type="text" id="fecha_corte" name="fecha_corte" class="form-control" style="display: none">
                  <input type="text" id="fecha_corte_consulta" name="fecha_corte_consulta" class="form-control" style="display: none">
                  </div>
                  <div class="modal-footer" style="margin-bottom: 5px">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Crear corte</button>
                  </div>
                  </form>
              </div>
            </div>
          </div>
          <!--Aca finaliza el modal para borrar proyecto-->   
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>
    <script>
      $(document).ready(function() {          
          //para que los menus pequeño y grande funcione
          $( "#art" ).addClass("active");
          $( "#artdashboardmenu" ).addClass("active");
          $( "#iniciomenupeq" ).html("<small> INICIO</small>");
          $( "#artmenupeq" ).html("<strong>ART<span class='caret'></span></strong>");
          $( "#artdashboardmenupeq" ).html("<strong><span class='glyphicon glyphicon-ok'></span>Dashboard</strong>");
          $( "#mensajeestatus" ).fadeOut(5000);
          $('#tablagizdepto').DataTable();
          var today=new Date();          
          var dd = today.getDate();
          var mm = today.getMonth()+1; //January is 0!
          var yyyy = today.getFullYear();

          if(dd<10) {
              dd='0'+dd
          }
          if(mm<10) {
              mm='0'+mm
          }
          today = yyyy+'-'+dd+'-'+mm;
          today2 = dd+'/'+mm+'/'+yyyy;
          $('#fecha_corte').val(today);
          $('#fecha_corte_texto').html(today);
          $('#fecha_corte_mensaje').html(today);
          $('#fecha_corte_consulta').val(today2);          
      });

      $('#datepicker').datepicker({
            format: "yyyy-dd-mm",
            language: "es",
            startDate: "2016-12-01",            
            todayBtn: "linked",
            orientation: "auto",
            autoclose: true,
            todayHighlight: true

           }); 

      //Termina tbody 
    var table = $('#tablanormas').DataTable();
    $('#tablanormas tbody').on('click', 'tr', function () {
        if ( $(this).hasClass('active') ) {
            $(this).removeClass('active');
            $("#btnedinorma").prop('disabled', true);
            $("#btneditablero").prop('disabled', true);
            $("#btnborrar").prop('disabled', true);            
            //$("#btndeletepro").prop('disabled', true);
        } else {
            table.$('tr.active').removeClass('active');
            $(this).addClass('active');
            var id=$(this);
            $("#btnedinorma").prop('disabled', false);
            $("#btneditablero").prop('disabled', false);
            $("#btnborrar").prop('disabled', false);
            var id=$(this);
            var num=id[0].id;
            //var num=10;
            $("#paso3").css('display','none')
            $("#paso4").css('display','none')
            $("#paso5").css('display','none')
            $("#etapa2").css('display','none')
            $.ajax({
                url:"artnormatividad/consulta-editar",
                type:"POST",
                data:{norma: num},
                dataType:'json',
                success:function(data){
                    var tittle="Editar norma: "+ data[0].norma;
                    $("#editar-tittle").html(tittle);
                    $("#id_editar").val(num);
                    $("#pto_acu-edit").val(data[0].pto_acu);
                    $("#norma-edit").val(data[0].norma);
                    $("#id_res_edit").val(data[0].id_res);
                    $("#id_tipo_edit").val(data[0].id_tipo);
                    $("#id_semafo_edit").val(data[0].id_semafo);
                    $("#id_consprev_edit").val(data[0].id_consprev);
                    $("#obs_edit").val(data[0].obs);
                    var tittle2="Editar tablero de control norma: "+ data[0].norma;                    
                    $("#id_editar_tablero").val(num);
                    $("#editar-tablero-tittle").html(tittle2);
                    $("#tab_encons").val(data[0].tab_encons);
                    $("#tab_prodjud").val(data[0].tab_prodjud);
                    if(data[0].tab_prodjud==1){
                      $("#paso3").css('display','block');
                    } else {
                      $("#paso3").css('display','none');
                    }
                    $("#tab_ajus").val(data[0].tab_ajus);
                    if(data[0].tab_ajus==1){
                      $("#paso4").css('display','block');
                    } else {
                      $("#paso4").css('display','none');
                    }
                    $("#tab_ultrev").val(data[0].tab_ultrev);
                    if(data[0].tab_ultrev==1){
                      $("#paso5").css('display','block');
                    } else {
                      $("#paso5").css('display','none');
                    }
                    $("#tab_defexp").val(data[0].tab_defexp);
                    if(data[0].tab_ultrev==1){
                      $("#paso5").css('display','block');
                    } else {
                      $("#paso5").css('display','none');
                    }
                    $("#tab_defexp").val(data[0].tab_defexp);
                    if(data[0].tab_defexp==1){
                      $("#etapa2").css('display','block');
                    } else {
                      $("#etapa2").css('display','none');
                    }
                    if(data[0].tab_defexp==1){
                      $("#etapa2").css('display','block');
                    } else {
                      $("#etapa2").css('display','none');
                    }
                    $("#tab_csivi").val(data[0].tab_csivi);
                    $("#tab_hacie").val(data[0].tab_hacie);
                    $("#tab_social").val(data[0].tab_social);                    
                    /*$("#tab_inte").val(data[0].tab_inte);
                    if(data[0].tab_inte==3){
                      $("#paso6b").css('display','none');
                    } else {
                      $("#paso6b").css('display','block');
                    }*/
                    $("#tab_expe").val(data[0].tab_expe);
                    $("#tab_congre").val(data[0].tab_congre);
                    $("#tab_firma").val(data[0].tab_firma);
                    $("#tab_sancpres").val(data[0].tab_sancpres);
                    //Lo siguiente es para el modal de borrar
                    $("#id_borrar").val(num);
                    $("#id_borrar_norma").html(data[0].norma);
                },
                error:function(){alert('error');}
            });//fin de la consulta ajax (Editar proceso)
        }
    });//Termina tbody

    function validacion(e){
      var name=document.getElementById(e.id).name;
      var val=document.getElementById(e.id).value;
      if(name=="tab_prodjud" && val=="1"){
        $("#paso3").css('display','block')
      }
      if(name=="tab_prodjud" && val=="2"){
        $("#paso3").css('display','none')
        $("#paso4").css('display','none')
        $("#paso5").css('display','none')
        $("#etapa2").css('display','none')
      }
      if(name=="tab_ajus" && val=="1"){
        $("#paso4").css('display','block')        
      }
      if(name=="tab_ajus" && val=="2"){
        $("#paso4").css('display','none')
        $("#etapa2").css('display','none')
      }
      if(name=="tab_ultrev" && val=="1"){
        $("#paso5").css('display','block')
      }
      if(name=="tab_ultrev" && val=="2"){
        $("#paso5").css('display','none')
      }
      if(name=="tab_defexp" && val=="1"){
        $("#etapa2").css('display','block')
      }
      if(name=="tab_defexp" && val=="2"){
        $("#etapa2").css('display','none')
      }         
    }

    </script>    
@stop

@endif<!--Cierra el if de mostrar el contenido de la página si esta autenticado-->