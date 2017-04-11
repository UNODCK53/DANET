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
  <style>
    input[type="number"]::-webkit-outer-spin-button,
    input[type="number"]::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
   
  </style>
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
          <h2 class="text-center text-primary">Plan 51/50</h2>
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
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#cargar_proyecto">Crear proyecto</button>
          <button id="btnedipro" disabled="disabled" data-target="#editar_proyecto"  data-toggle="modal" type="button" class="btn btn-primary">Editar proyecto</button>
          <button id="btndeletepro" disabled="disabled" data-target="#borrar_proyecto"  data-toggle="modal" type="button" class="btn btn-danger">Borrar proyecto</button>          
          <!--Aca inicia el modal para cargar nuevo proyecto-->
          <!-- Modal -->
          <div class="modal fade" id="cargar_proyecto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="myModalLabel">Ficha de proyecto: Plan 51/50</h4>
                </div>
                <div class="modal-body">
                    <form role="form" action="artpic/cargar-proyecto-plan50" method="post" onsubmit="return validar(this)" id="cargarproy" enctype="multipart/form-data" > 
                      <div class="form-group">
                        <b>Departamento<font color="red">*</font></b>
                        <select required id="depto" name="depto" class="form-control" onchange="filter_municipality()">
                          <option selected disabled>Seleccione un departamento</option>  
                          @foreach($departamentos as $pro)                  
                            <option value="{{$pro->COD_DPTO}}">{{$pro->NOM_DPTO}}</option>                    
                          @endforeach                    
                        </select>
                      </div>
                      <div class="form-group">
                        <b>Municipio<font color="red">*</font></b>
                        <select required id="municipios" name="municipios" class="form-control"> 
                         <option value="">Seleccione uno</option>                                        
                        </select>
                      </div>
                      <div class="form-group">
                        <b>Núcleo veredal<font color="red">*</font></b>
                        <select name="nucleo" id="nucleo" class="form-control" required> 
                            <option value=''>Seleccione uno</option>
                          </select>
                      </div>
                      <div class="form-group" style='display:none' id="terr">
                        <b>Tipo de territorio:<font color="red">*</font></b>
                        {{Form::select ('tipoterr[]', $arraytipoterr, '', ['multiple'=>'multiple','class' => 'form-control', 'id'=>'tipoterr','required'=>'true'])}}
                      </div> 
                      <div class="form-group" style='display:none' id="select_terr">
                          <b>Nombre de territorios:<font color="red">*</font></b>
                        <select name="nom_terr[]" id="nom_terr" class="form-control"  multiple> 
                          </select>
                      </div>
                      <div class="form-group">
                        <b>Nombre del proyecto<font color="red">*</font></b>
                        <input required id="nombre" name="nombre" type="text" class="form-control" placeholder="Text input">
                      </div>
                      <div class="form-group">
                        <b>Entidad Líder<font color="red">*</font></b>
                        <select required id="entidad" name="entidad" class="form-control">
                            <option selected value="">Seleccione una opción</option>
                            <option value="Alcaldía municipal">Alcaldía municipal</option>
                            <option value="Cabildo Indígena">Cabildo Indígena</option>
                            <option value="Consejo Comunitario">Consejo Comunitario</option>
                            <option value="Gobernación departamental">Gobernación departamental</option>
                            <option value="Invías">Invías</option>
                            <option value="Junta Acción Comunal">Junta Acción Comunal</option>
                            <option value="Ministerio de Transporte ">Ministerio de Transporte </option>
                            <option value="Organizaciones comunitarias">Organizaciones comunitarias</option>
                            <option value="Otro">Otro</option>                 
                        </select>
                      </div>
                      <div class="form-group">
                        <b>Línea de proyecto<font color="red">*</font></b>
                        <select required id="linea" name="linea" class="form-control">
                            <option selected value="">Seleccione una opción</option>
                            <option value="Mantenimiento períodico">Mantenimiento períodico </option>
                            <option value="Mantenimiento rutinario">Mantenimiento rutinario</option>
                            <option value="Obras de arte">Obras de arte</option>
                            <option value="Placa huella">Placa huella</option> 
                        </select>
                      </div>
                      <div class="form-group">
                        <b>Estado del proyecto<font color="red">*</font></b>
                        <select required id="estado" name="estado" class="form-control">
                            <option selected value="">Seleccione una opción</option>
                            <option value="Identificación">Identificación </option>
                            <option value="Estructuración">Estructuración</option>
                            <option value="Ejecución">Ejecución</option>                      
                        </select>
                      </div>
                      <div class="form-group" id="inden-1" style='display:none'>
                        <b>Alcance definido en identificación<font color="red">*</font></b>
                        <textarea  id="alcance" name="alcance" class="form-control" rows="3"></textarea>
                      </div>
                      <div class="form-group" id="est-1" style='display:none'>
                        <b>Alcance definido en estructuración<font color="red">*</font></b>
                        <textarea  id="alcance2" name="alcance2" class="form-control" rows="3"></textarea>
                      </div>
                      <div class="form-group" id="fecha-1" style='display:none'>
                      <b>Fecha estimada para inicio de ejecución<font color="red">*</font></b>
                        <div class="input-group date" id="datepicker-1">                      
                          <input  id="fecha_inicio" name="fecha_inicio" type="text" class="form-control"  placeholder="Ingrese la fecha de inicio del proyecto">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>                      
                        </div>
                      </div>
                      <div class="form-group" id="fecha-2" style='display:none'>
                        <b>Fecha estimada para final de ejecución<font color="red">*</font></b>
                        <div class="input-group date" id="datepicker-2">                      
                          <input  id="fecha_final" name="fecha_final" type="text" class="form-control"  placeholder="Ingrese la fecha de finalización del proyecto">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>                      
                        </div>
                      </div>
                      <div class="form-group" id="eje-1" style='display:none'>
                        <b>Alcance definido en ejecución<font color="red">*</font></b>
                        <textarea  id="alcance3" name="alcance3" class="form-control" rows="3"></textarea>
                      </div>
                      <div class="form-group" id="eje-2" style='display:none'>
                        <b>Población beneficiada</b>
                        {{Form::number('pob_bene','', ['class' => 'form-control', 'id'=>'pob_bene'])}}
                      </div>
                      <div class="form-group" id="eje-3" style='display:none'>
                        <b>Avance presupuestal<font color="red">*</font></b>
                        {{Form::number('ava_presu','', ['class' => 'form-control', 'id'=>'ava_presu'])}}
                      </div>
                      <div class="form-group" id="eje-4" style='display:none'>
                        <b>Avance producto<font color="red">*</font></b>
                        {{Form::number('ava_product','', ['class' => 'form-control', 'id'=>'ava_product'])}}
                      </div>
                      <div class="form-group" id="eje-5" style='display:none'>
                        <b>Longitud del tramo a intervenir<font color="red">*</font></b>
                        {{Form::number('long','', ['class' => 'form-control', 'id'=>'long'])}}
                      </div>
                       <div class="form-group" id="eje-6" style='display:none'>
                         <b>Fecha de inicio de la ejecución<font color="red">*</font></b>
                        <div class="input-group date" id="datepicker-3">                      
                          <input  id="fecha_inicio2" name="fecha_inicio2" type="text" class="form-control" placeholder="Ingrese la fecha de inicio del proyecto">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>                      
                        </div>
                      </div>
                      <div class="form-group" id="eje-7" style='display:none'>
                        <b>Fecha final de la ejecución<font color="red">*</font></b>
                        <div class="input-group date" id="datepicker-4">                      
                          <input  id="fecha_final2" name="fecha_final2" type="text" class="form-control"  placeholder="Ingrese la fecha de finalización del proyecto">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>                      
                        </div>
                      </div>
                      <div class="form-group" id="eje-8" style='display:none'>
                         <b>Costo del proyecto<font color="red">*</font></b>
                        {{ Form::text('cost_proy','', ['class' => 'form-control', 'id'=>'cost_proy','placeholder'=>'$','onchange'=>'precio_change(this)'])}}
                      </div>
                      
                      <div class="form-group" id="est-2" style='display:none'>
                         <b>Costo estimado del proyecto<font color="red">*</font></b>
                        {{ Form::text('cost_esti','', ['class' => 'form-control', 'id'=>'cost_esti','placeholder'=>'$','onchange'=>'precio_change(this)'])}}
                      </div>
                      <div class="form-group" >
                        <b>Documento de validación del proyecto</b>
                        {{ Form::file('doc', ['class' => 'form-control', 'id'=>'doc','accept'=>'.pdf','placeholder'=>'ej: acta.pdf' ]) }}
                      </div>

                      <div class="checkbox-group" id="cor-1"style='display:none'>
                        <b>Sabe las coordenadas iniciales del tramo?<font color="red">*</font></b>
                        <div class="form-group" id="coorderadio">
                          <input type="radio" name="coorde" id="coorde1" value="1" > Si
                          <input type="radio" name="coorde" id="coorde2" value="2"> No
                        </div>
                      </div>

                      <div class="form-group"id="datos_coorde_ini" style='display:none'>
                        <div class="form-group col-sm-6 ">
                          <div class="form-group col-sm-12 " >
                          {{Form::label('Latlable_ini','Latitud:',['class' => 'control-label'])}}
                          </div>
                          <div class="form-group col-sm-4 " >
                            Grados:
                            {{ Form::number('lat_gra_ini','', ['class' => 'form-control', 'id'=>'lat_grado_ini','placeholder'=>'4','onchange'=>'coorden(this)'])}} 
                          </div>
                          <div class="form-group col-sm-4 " >
                            Minutos:
                          {{ Form::number('lat_min_ini','', ['class' => 'form-control', 'id'=>'lat_min_ini','placeholder'=>'35','onchange'=>'coorden(this)'])}}
                          </div>
                          <div class="form-group col-sm-4 " >
                            Segundos:
                          {{ Form::number('lat_seg_ini','', ['class' => 'form-control', 'id'=>'lat_seg_ini','placeholder'=>'40','onchange'=>'coorden(this)'])}}
                          </div>
                        </div>
                        <div class=" form-group col-sm-6 " >
                          <div class="form-group col-sm-12 " >
                          {{Form::label('Longlable_ini','Longitud:',['class' => 'control-label'])}}
                          </div>
                          <div class="form-group col-sm-4 " >
                            Grados:
                          {{ Form::number('long_gra_ini','', ['class' => 'form-control', 'id'=>'long_gra_ini','placeholder'=>'-74','onchange'=>'coorden(this)'])}}
                          </div>
                          <div class="form-group col-sm-4 " >
                             Minutos:
                          {{ Form::number('long_min_ini','', ['class' => 'form-control', 'id'=>'long_min_ini','placeholder'=>'35','onchange'=>'coorden(this)'])}}
                          </div>
                          <div class="form-group col-sm-4 " >
                            Segundos:
                          {{ Form::number('long_seg_ini','', ['class' => 'form-control', 'id'=>'long_seg_ini','placeholder'=>'40','onchange'=>'coorden(this)'])}}
                        </div>
                        </div>
                      </div>
                      <div class="checkbox-group" id="cor-2"style='display:none'>
                        <b>Sabe las coordenadas finales del tramo?<font color="red">*</font></b>
                        <div class="form-group" id="coorderadio_fin">
                          <input type="radio" name="coorde_fin" id="coorde1_fin" value="1" > Si
                          <input type="radio" name="coorde_fin" id="coorde2_fin" value="2"> No
                        </div>
                      </div>
                      <div class="form-group"id="datos_coorde_fin" style='display:none'>
                        <div class="form-group col-sm-6 ">
                          <div class="form-group col-sm-12 " >
                          {{Form::label('Latlable_fin','Latitud:',['class' => 'control-label'])}}
                          </div>
                          <div class="form-group col-sm-4 " >
                            Grados:
                            {{ Form::number('lat_gra_fin','', ['class' => 'form-control', 'id'=>'lat_grado_fin','placeholder'=>'4','onchange'=>'coorden(this)'])}} 
                          </div>
                          <div class="form-group col-sm-4 " >
                            Minutos:
                          {{ Form::number('lat_min_fin','', ['class' => 'form-control', 'id'=>'lat_min_fin','placeholder'=>'35','onchange'=>'coorden(this)'])}}
                          </div>
                          <div class="form-group col-sm-4 " >
                            Segundos:
                          {{ Form::number('lat_seg_fin','', ['class' => 'form-control', 'id'=>'lat_seg_fin','placeholder'=>'40','onchange'=>'coorden(this)'])}}
                          </div>
                        </div>
                        <div class=" form-group col-sm-6 " >
                          <div class="form-group col-sm-12 " >
                          {{Form::label('Longlable_fin','Longitud:',['class' => 'control-label'])}}
                          </div>
                          <div class="form-group col-sm-4 " >
                            Grados:
                          {{ Form::number('long_gra_fin','', ['class' => 'form-control', 'id'=>'long_gra_fin','placeholder'=>'-74','onchange'=>'coorden(this)'])}}
                          </div>
                          <div class="form-group col-sm-4 " >
                             Minutos:
                          {{ Form::number('long_min_fin','', ['class' => 'form-control', 'id'=>'long_min_fin','placeholder'=>'35','onchange'=>'coorden(this)'])}}
                          </div>
                          <div class="form-group col-sm-4 " >
                            Segundos:
                          {{ Form::number('long_seg_fin','', ['class' => 'form-control', 'id'=>'long_seg_fin','placeholder'=>'40','onchange'=>'coorden(this)'])}}
                        </div>
                        </div>
                      </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                  <button type="submit" class="btn btn-primary">Crear proyecto</button>
                </div>
                </form>
              </div>
            </div>
          </div>
          <!--Aca finaliza el modal para cargar nuevo proyecto-->

          <!--Aca inicia el modal para borrar proyecto-->
          <div class="modal fade bs-example-modal-sm" id="borrar_proyecto" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
            <div class="modal-dialog modal-sm" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="borrar_tittle">Borrar proyecto</h4>
                  </div>
                  <div class="modal-body">
                  <form role="form" action="artpic/borrar-proyecto-plan50" method="post" id="cargarproy" enctype="multipart/form-data">
                   <div class="form-group">
                      <input  id = "deleteproy" name = "deleteproy" class="form-control" type="hidden" ></input>
                      <div class="form-group">
                        <label for="IDdelelabel" class="control-label">ID</label>
                        <input  id = "IDdele" name = "IDdele" class="form-control" type="text" disabled ></input>            
                      </div>   
                      <label for="deleteproylabel" class="control-label">Nombre de la iniciativa que va a borrar</label>
                      <input  id = "deletenombre" name = "deletenombre" class="form-control" type="text" disabled ></input>            
                    </div>
                    <div class="form-group">
                      
                      <label for="deletenucleolabel" class="control-label">Núcleo veredal</label>
                      <input  id = "deletenucleo" name = "deletenucleo" class="form-control" type="text" disabled ></input>            
                    </div>
                  
                  <div class="modal-footer" style="margin-bottom: 5px">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                      <button type="submit" class="btn btn-primary">Borrar proyecto</button>
                  </div>
                  </form>
                </div>

              </div>
            </div>
          </div>

          <!--Aca finaliza el modal para borrar proyecto-->
          <!--Acá inicia la tabla de proyectos-->
          <h4>Listado de proyectos</h4>
          <table id="tabla_proyectos" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>  
              <tr class="well text-primary" data-toggle="tooltip" data-placement="top" >
                <th class="text-center">ID</th>
                <th class="text-center">Departamento</th>
                <th class="text-center">Municipio</th>
                <th class="text-center">Núcleo</th>
                <th class="text-center">Nombre del proyecto</th>
                <th class="text-center">Estado</th>                          
              </tr>
            </thead>
            <tbody>            
              @foreach($proyectos as $pro)
                <tr id="{{$pro->OBJECTID}}">
                  <td >{{$pro->IDs}}</td>
                  <td >{{$pro->NOM_DPTO}}</td>
                  <td >{{$pro->NOM_MPIO}}</td>
                  <td >@foreach($arraynucleos as $key=>$val) @if($pro->cod_nucleo==$key) {{$val}} @endif @endforeach </td> 
                  <td >{{$pro->nom_proy}}</td>
                  <td >{{$pro->est_proy}}</td>                                           
                </tr>            
              @endforeach    
            </tbody>
          </table>
          <!--Acá termina la tabla de proyectos-->
          <!--fin del codigo-->   
          </div>
        </div>
      <div class="col-sm-1"></div> 
  </div>

<!--Fin del tercer contenedor--> 
<!-- Modal -->
        <div class="modal fade" id="editar_proyecto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-keyboard="false" data-backdrop="static">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Segumiento del Proyecto </h4>
              </div>
                <div class="modal-body">
                    <div class="tabbable"> <!-- Only required for left/right tabs -->
                    <ul id="estado_tab" class="nav nav-tabs">
                    <li><a href="#tab1" data-toggle="tab">Indentificación</a></li>
                    <li><a href="#tab2" data-toggle="tab">Estructuración</a></li>
                    <li><a href="#tab3" data-toggle="tab">Ejecución</a></li>
                    </ul>
                  </div>
                    <div class="tab-content">
                      <div class="tab-pane active" id="tab1">
                        <form role="form" action="artpic/edi-proy-p50-iden" method="post" enctype="multipart/form-data">
                          <div>
                            <!--El siguiente input es invisible para el usuario. Cotiene el id del proyecto a modificar-->
                            <div class="form-group">
                              <input  id = "ediidproyediiden" name = "ediidproyediiden" class="form-control" type="hidden" required="true" ></input>               
                            </div>
                            <div class="form-group">
                                  <b>ID</b>
                                  <input  id = "IDediiden" name = "IDediiden" class="form-control" type="text" disabled ></input>            
                            </div>
                            <div class="form-group">
                              <b>Departamento</b>
                              {{ Form::text('deptoediiden', Input::old('deptoediiden'), ['class' => 'form-control', 'id'=>'deptoediiden','required'=>'true','readonly'=>'true']) }}
                              <input  id = "deptoediiden2" name = "deptoediiden2" class="form-control" type="hidden"  ></input> 
                            </div>

                            <div class="form-group">
                              <b>Municipios</b>
                              {{ Form::text('mpioediiden', Input::old('mpioediiden'), ['class' => 'form-control', 'id'=>'mpioediiden','required'=>'true','readonly'=>'true']) }}
                               <input  id = "mpioediiden2" name = "mpioediiden2" class="form-control" type="hidden"  ></input> 
                            </div>
                            <div class="form-group">
                              <b>Núcleo veredal:</b>
                              {{ Form::text('nucleoediiden', Input::old('nucleoediiden'), ['class' => 'form-control', 'id'=>'nucleoediiden','required'=>'true','readonly'=>'true']) }}
                              <input  id = "nucleoediiden2" name = "nucleoediiden2" class="form-control" type="hidden"  ></input> 
                            </div>
                            <div class="form-group" >
                            <b>Estado del proyecto<font color="red">*</font></b>
                            <select required id="estadoediiden" name="estadoediiden" class="form-control">
                                <option selected value="">Seleccione una opción</option>
                                <option value="Identificación">Identificación </option>
                                <option value="Estructuración">Estructuración</option>
                                <option value="Ejecución">Ejecución</option>                      
                            </select>
                            </div>
                            <div class="form-group" >
                              <b>Tipo de territorio:<font color="red">*</font></b>
                              {{Form::select('tipoterrediiden[]', $arraytipoterr, '', ['multiple'=>'multiple','class' => 'form-control', 'id'=>'tipoterrediiden','required'=>'true'])}}
                            </div> 
                            <div class="form-group"  id="select_terrediiden">
                              <b>Nombre de territorios:<font color="red">*</font></b>
                              <select name="nom_terrediiden[]" id="nom_terrediiden" class="form-control" multiple required> 
                                </select>
                            </div>
                            <div class="form-group" >
                              <b>Nombre del proyecto<font color="red">*</font></b>
                              <input required id="nombreediiden" name="nombreediiden" type="text" class="form-control" placeholder="Text input">
                            </div>
                            <div class="form-group" >
                              <b>Alcance definido en identificación<font color="red">*</font></b>
                              {{ Form::textarea('alcanceediiden', Input::old('alcanceediiden'), ['class' => 'form-control', 'id'=>'alcanceediiden','required'=>'true']) }}
                            </div>
                            <div class="form-group">
                              <b>Entidad Líder<font color="red">*</font></b>
                              <select required id="entidadediiden" name="entidadediiden" class="form-control">
                                  <option selected value="">Seleccione una opción</option>
                                  <option value="Alcaldía municipal">Alcaldía municipal</option>
                                  <option value="Cabildo Indígena">Cabildo Indígena</option>
                                  <option value="Consejo Comunitario">Consejo Comunitario</option>
                                  <option value="Gobernación departamental">Gobernación departamental</option>
                                  <option value="Invías">Invías</option>
                                  <option value="Junta Acción Comunal">Junta Acción Comunal</option>
                                  <option value="Ministerio de Transporte ">Ministerio de Transporte </option>
                                  <option value="Organizaciones comunitarias">Organizaciones comunitarias</option>
                                  <option value="Otro">Otro</option>                 
                              </select>
                            </div>
                            <div class="form-group">
                              <b>Línea de proyecto<font color="red">*</font></b>
                              <select required id="lineaediiden" name="lineaediiden" class="form-control">
                                  <option selected value="">Seleccione una opción</option>
                                  <option value="Mantenimiento períodico">Mantenimiento períodico </option>
                                  <option value="Mantenimiento rutinario">Mantenimiento rutinario</option>
                                  <option value="Obras de arte">Obras de arte</option>
                                  <option value="Placa huella">Placa huella</option> 
                              </select>
                            </div>
                            <div class="form-group" >
                              <b>Fecha estimada para inicio de ejecución</b>
                               {{ Form::text('fecha_inicioediiden', Input::old('fecha_inicioediiden'), ['class' => 'form-control', 'id'=>'fecha_inicioediiden','required'=>'true','readonly'=>'true']) }}
                            </div>
                            <div class="form-group" >
                              <b>Fecha estimada para final de ejecución</b>
                              {{ Form::text('fecha_finalediiden', Input::old('fecha_finalediiden'), ['class' => 'form-control', 'id'=>'fecha_finalediiden','required'=>'true','readonly'=>'true']) }}
                            </div>
                            <div class="form-group col-sm-12" style="padding: 0;">
                              <div class="col-sm-9">
                              <b>Desea cargar o editar el documento de validación del proyecto:</b>
                              </div>
                              <div class="col-sm-1" >
                                <span >
                                  <a id="docediide" title="Descargar Documento" role="button"></a>
                                </span>
                              </div>
                              <div class="col-sm-1" >
                                <span >
                                  <a id="deletedocediide" title="Borrar Documento" class="glyphicon glyphicon glyphicon-trash btn btn-default" role="button" onclick="borr_crit(this)"></a>
                                </span>
                              </div>
                            

                              <div class="form-group col-sm-4" id="docradioide">
                                <input type="radio" name="docradioide" id="docradio1ide" value="1" required> Si
                                <input type="radio" name="docradioide" id="docradio2ide" value="2"> No
                              </div>
                              <div class="form-group col-sm-8" id="doc_cargaide" style='display:none'>
                              {{ Form::file('docide', ['class' => 'form-control', 'id'=>'docide','accept'=>'.pdf','placeholder'=>'ej: acta.pdf' ]) }}
                            </div>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Editar proyecto</button>
                          </div>
                        </form>
                      </div>


                      <div class="tab-pane active" id="tab2">
                        <form role="form" action="artpic/edi-proy-p50-estr" method="post" enctype="multipart/form-data">
                          <div>
                            <!--El siguiente input es invisible para el usuario. Cotiene el id del proyecto a modificar-->
                            <div class="form-group">
                              <input  id = "ediidproyediestr" name = "ediidproyediestr" class="form-control" type="hidden" required="true" ></input>               
                            </div>
                            <div class="form-group">
                                  <b>ID</b>
                                  <input  id = "IDediestr" name = "IDediestr" class="form-control" type="text" disabled ></input>            
                            </div>
                            <div class="form-group">
                              <b>Departamento</b>
                              {{ Form::text('deptoediestr', Input::old('deptoediestr'), ['class' => 'form-control', 'id'=>'deptoediestr','required'=>'true','readonly'=>'true']) }}
                              <input  id = "deptoediestr2" name = "deptoediestr2" class="form-control" type="hidden"  ></input> 
                            </div>

                            <div class="form-group">
                              <b>Municipios</b>
                              {{ Form::text('mpioediestr', Input::old('mpioediestr'), ['class' => 'form-control', 'id'=>'mpioediestr','required'=>'true','readonly'=>'true']) }}
                               <input  id = "mpioediestr2" name = "mpioediestr2" class="form-control" type="hidden"  ></input> 
                            </div>
                            <div class="form-group">
                              <b>Núcleo veredal:</b>
                              {{ Form::text('nucleoediestr', Input::old('nucleoediestr'), ['class' => 'form-control', 'id'=>'nucleoediestr','required'=>'true','readonly'=>'true']) }}
                              <input  id = "nucleoediestr2" name = "nucleoediestr2" class="form-control" type="hidden"  ></input> 
                            </div>
                            <div class="form-group" >
                            <b>Estado del proyecto<font color="red">*</font></b>
                            <select required id="estadoediestr" name="estadoediestr" class="form-control">
                                <option selected value="">Seleccione una opción</option>
                                <option value="Identificación">Identificación </option>
                                <option value="Estructuración">Estructuración</option>
                                <option value="Ejecución">Ejecución</option>                      
                            </select>
                            </div>
                            <div class="form-group" >
                              <b>Tipo de territorio:<font color="red">*</font></b>
                              {{Form::select('tipoterrediestr[]', $arraytipoterr, '', ['multiple'=>'multiple','class' => 'form-control', 'id'=>'tipoterrediestr','required'=>'true'])}}
                            </div> 
                            <div class="form-group"  id="select_terrediestr">
                              <b>Nombre de territorios:<font color="red">*</font></b>
                              <select name="nom_terrediestr[]" id="nom_terrediestr" class="form-control" multiple required> 
                                </select>
                            </div>
                            <div class="form-group" >
                              <b>Nombre del proyecto<font color="red">*</font></b>
                              <input required id="nombreediestr" name="nombreediestr" type="text" class="form-control" placeholder="Text input" >
                            </div>
                            <div class="form-group" >
                              <b>Alcance definido en estructuracion<font color="red">*</font></b>
                              {{ Form::textarea('alcanceediestr', Input::old('alcanceediestr'), ['class' => 'form-control', 'id'=>'alcanceediestr','required'=>'true']) }}
                            </div>
                            <div class="form-group">
                              <b>Entidad Líder<font color="red">*</font></b>
                              <select required id="entidadediestr" name="entidadediestr" class="form-control">
                                  <option selected value="">Seleccione una opción</option>
                                  <option value="Alcaldía municipal">Alcaldía municipal</option>
                                  <option value="Cabildo Indígena">Cabildo Indígena</option>
                                  <option value="Consejo Comunitario">Consejo Comunitario</option>
                                  <option value="Gobernación departamental">Gobernación departamental</option>
                                  <option value="Invías">Invías</option>
                                  <option value="Junta Acción Comunal">Junta Acción Comunal</option>
                                  <option value="Ministerio de Transporte ">Ministerio de Transporte </option>
                                  <option value="Organizaciones comunitarias">Organizaciones comunitarias</option>
                                  <option value="Otro">Otro</option>                 
                              </select>
                            </div>
                            <div class="form-group">
                              <b>Línea de proyecto<font color="red">*</font></b>
                              <select required id="lineaediestr" name="lineaediestr" class="form-control">
                                  <option selected value="">Seleccione una opción</option>
                                  <option value="Mantenimiento períodico">Mantenimiento períodico </option>
                                  <option value="Mantenimiento rutinario">Mantenimiento rutinario</option>
                                  <option value="Obras de arte">Obras de arte</option>
                                  <option value="Placa huella">Placa huella</option> 
                              </select>
                            </div>
                            <div class="form-group">
                              <b>Costo Estimado<font color="red">*</font></b>
                              <input required id="cost_proyediestr" name="cost_proyediestr"onchange="current(this)" class="form-control" placeholder="Ingrese el valor del costo estimado" type="text" min="0" step="any"/>
                            </div>
                            <div class="form-group" >
                              <b>Fecha estimada para inicio de ejecución</b>
                               {{ Form::text('fecha_inicioediestr', Input::old('fecha_inicioediestr'), ['class' => 'form-control', 'id'=>'fecha_inicioediestr','required'=>'true','readonly'=>'true']) }}
                            </div>
                            <div class="form-group" >
                              <b>Fecha estimada para final de ejecución</b>
                              {{ Form::text('fecha_finalediestr', Input::old('fecha_finalediestr'), ['class' => 'form-control', 'id'=>'fecha_finalediestr','required'=>'true','readonly'=>'true']) }}
                            </div>
                            <div class="form-group col-sm-12" style="padding: 0;">
                              <div class="col-sm-9">
                              <b>Desea cargar o editar el documento de validación del proyecto:</b>
                              </div>
                              <div class="col-sm-1" >
                                <span >
                                  <a id="docediest" title="Descargar Documento" role="button"></a>
                                </span>
                              </div>
                              <div class="col-sm-1" >
                                <span >
                                  <a id="deletedocediest" title="Borrar Documento" class="glyphicon glyphicon glyphicon-trash btn btn-default" role="button" onclick="borr_crit(this)"></a>
                                </span>
                              </div>
                            

                              <div class="form-group col-sm-4" id="docradioest">
                                <input type="radio" name="docradioest" id="docradio1est" value="1" required> Si
                                <input type="radio" name="docradioest" id="docradio2est" value="2"> No
                              </div>
                              <div class="form-group col-sm-8" id="doc_cargaest" style='display:none'>
                              {{ Form::file('docest', ['class' => 'form-control', 'id'=>'docest','accept'=>'.pdf','placeholder'=>'ej: acta.pdf' ]) }}
                            </div>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Editar proyecto</button>
                          </div>
                        </form>
                      </div>


                    <div class="tab-pane active" id="tab3">
                        <form role="form" action="artpic/edi-proy-p50-eje" method="post" enctype="multipart/form-data">
                          <div>
                            <!--El siguiente input es invisible para el usuario. Cotiene el id del proyecto a modificar-->
                            <div class="form-group">
                              <input  id = "ediidproyedieje" name = "ediidproyedieje" class="form-control" type="hidden" required="true" ></input>               
                            </div>
                            <div class="form-group">
                                  <b>ID</b>
                                  <input  id = "IDedieje" name = "IDedieje" class="form-control" type="text" disabled ></input>            
                            </div>
                            <div class="form-group">
                              <b>Departamento</b>
                              {{ Form::text('deptoedieje', Input::old('deptoedieje'), ['class' => 'form-control', 'id'=>'deptoedieje','required'=>'true','readonly'=>'true']) }}
                              <input  id = "deptoedieje2" name = "deptoedieje2" class="form-control" type="hidden"  ></input> 
                            </div>

                            <div class="form-group">
                              <b>Municipios</b>
                              {{ Form::text('mpioedieje', Input::old('mpioedieje'), ['class' => 'form-control', 'id'=>'mpioedieje','required'=>'true','readonly'=>'true']) }}
                               <input  id = "mpioedieje2" name = "mpioedieje2" class="form-control" type="hidden"  ></input> 
                            </div>
                            <div class="form-group">
                              <b>Núcleo veredal:</b>
                              {{ Form::text('nucleoedieje', Input::old('nucleoedieje'), ['class' => 'form-control', 'id'=>'nucleoedieje','required'=>'true','readonly'=>'true']) }}
                              <input  id = "nucleoedieje2" name = "nucleoedieje2" class="form-control" type="hidden"  ></input> 
                            </div>
                            <div class="form-group" >
                            <b>Estado del proyecto<font color="red">*</font></b>
                            <select required id="estadoedieje" name="estadoedieje" class="form-control">
                                <option selected value="">Seleccione una opción</option>
                                <option value="Identificación">Identificación </option>
                                <option value="Estructuración">Estructuración</option>
                                <option value="Ejecución">Ejecución</option>                      
                            </select>
                            </div>
                            <div class="form-group" >
                              <b>Tipo de territorio:<font color="red">*</font></b>
                              {{Form::select('tipoterredieje[]', $arraytipoterr, '', ['multiple'=>'multiple','class' => 'form-control', 'id'=>'tipoterredieje','required'=>'true'])}}
                            </div> 
                            <div class="form-group"  id="select_terredieje">
                              <b>Nombre de territorios:<font color="red">*</font></b>
                              <select name="nom_terredieje[]" id="nom_terredieje" class="form-control" multiple required> 
                                </select>
                            </div>
                            <div class="form-group" >
                              <b>Nombre del proyecto<font color="red">*</font></b>
                              <input required id="nombreedieje" name="nombreedieje" type="text" class="form-control" placeholder="Text input" >
                            </div>
                            <div class="form-group" >
                              <b>Alcance definido en ejecución<font color="red">*</font></b>
                              {{ Form::textarea('alcanceedieje', Input::old('alcanceedieje'), ['class' => 'form-control', 'id'=>'alcanceedieje','required'=>'true']) }}
                            </div>
                            <div class="form-group">
                              <b>Entidad Líder<font color="red">*</font></b>
                              <select required id="entidadedieje" name="entidadedieje" class="form-control">
                                  <option selected value="">Seleccione una opción</option>
                                  <option value="Alcaldía municipal">Alcaldía municipal</option>
                                  <option value="Cabildo Indígena">Cabildo Indígena</option>
                                  <option value="Consejo Comunitario">Consejo Comunitario</option>
                                  <option value="Gobernación departamental">Gobernación departamental</option>
                                  <option value="Invías">Invías</option>
                                  <option value="Junta Acción Comunal">Junta Acción Comunal</option>
                                  <option value="Ministerio de Transporte ">Ministerio de Transporte </option>
                                  <option value="Organizaciones comunitarias">Organizaciones comunitarias</option>
                                  <option value="Otro">Otro</option>                 
                              </select>
                            </div>
                            <div class="form-group">
                              <b>Línea de proyecto<font color="red">*</font></b>
                              <select required id="lineaedieje" name="lineaedieje" class="form-control">
                                  <option selected value="">Seleccione una opción</option>
                                  <option value="Mantenimiento períodico">Mantenimiento períodico </option>
                                  <option value="Mantenimiento rutinario">Mantenimiento rutinario</option>
                                  <option value="Obras de arte">Obras de arte</option>
                                  <option value="Placa huella">Placa huella</option> 
                              </select>
                            </div>
                            <div class="form-group">
                              <b>Población beneficiada</b>
                              {{Form::number('pob_beneedieje','', ['class' => 'form-control', 'id'=>'pob_beneedieje'])}}
                            </div>
                            <div class="form-group" >
                              <b>Avance presupuestal<font color="red">*</font></b>
                              {{Form::number('ava_presuedieje','', ['class' => 'form-control', 'id'=>'ava_presuedieje','required'=>'true'])}}
                            </div>
                            <div class="form-group">
                              <b>Avance producto<font color="red">*</font></b>
                              {{Form::number('ava_productedieje','', ['class' => 'form-control', 'id'=>'ava_productedieje','required'=>'true'])}}
                            </div>
                            <div class="form-group">
                              <b>Longitud del tramo a intervenir<font color="red">*</font></b>
                              {{Form::number('longedieje','', ['class' => 'form-control', 'id'=>'longedieje','required'=>'true'])}}
                            </div>
                             <div class="form-group">
                               <b>Fecha de inicio de la ejecución<font color="red">*</font></b>
                              <div class="input-group date" id="datepicker-5">                      
                                <input  required id="fecha_inicio2edieje" name="fecha_inicio2edieje" type="text" class="form-control"  placeholder="Ingrese la fecha de inicio del proyecto">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>                      
                              </div>
                            </div>
                            <div class="form-group">
                              <b>Fecha final de la ejecución<font color="red">*</font></b>
                              <div class="input-group date" id="datepicker-6">                      
                                <input  required id="fecha_final2edieje" name="fecha_final2edieje" type="text" class="form-control" placeholder="Ingrese la fecha de finalización del proyecto">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>                      
                              </div>
                            </div>
                            <div class="form-group">
                              <b>Costo del proyecto <font color="red">*</font></b>
                              <input required id="cost_proyedieje" name="cost_proyedieje"onchange="current(this)" class="form-control" placeholder="Ingrese el valor del costo ejecutado" type="text" min="0" step="any"/>
                            </div>
                            <div class="form-group col-sm-12" style="padding: 0;">
                              <div class="col-sm-9">
                              <b>Desea cargar o editar el documento de validación del proyecto:</b>
                              </div>
                              <div class="col-sm-1" >
                                <span >
                                  <a id="docedieje" title="Descargar Documento" role="button"></a>
                                </span>
                              </div>
                              <div class="col-sm-1" >
                                <span >
                                  <a id="deletedocedieje" title="Borrar Documento" class="glyphicon glyphicon glyphicon-trash btn btn-default" role="button" onclick="borr_crit(this)"></a>
                                </span>
                              </div>
                            

                              <div class="form-group col-sm-4" id="docradioeje">
                                <input type="radio" name="docradioeje" id="docradio1eje" value="1" required> Si
                                <input type="radio" name="docradioeje" id="docradio2eje" value="2"> No
                              </div>
                              <div class="form-group col-sm-8" id="doc_cargaeje" style='display:none'>
                              {{ Form::file('doceje', ['class' => 'form-control', 'id'=>'doceje','accept'=>'.pdf','placeholder'=>'ej: acta.pdf' ]) }}
                            </div>
                            </div>
                            <div class="checkbox-group">
                              <b>Sabe las coordenadas iniciales del tramo?<font color="red">*</font></b>
                              <div class="form-group" id="coorderadioedieje">
                                <input type="radio" name="coordeedieje" id="coorde1edieje" value="1" required> Si
                                <input type="radio" name="coordeedieje" id="coorde2edieje" value="2"> No
                              </div>
                            </div>
                            <div class="form-group"id="datos_coorde_iniedieje" style='display:none'>
                              <div class="form-group col-sm-6 ">
                                <div class="form-group col-sm-12 " >
                                {{Form::label('Latlable_iniedieje','Latitud:',['class' => 'control-label'])}}
                                </div>
                                <div class="form-group col-sm-4 " >
                                  Grados:
                                  {{ Form::number('lat_gra_iniedieje','', ['class' => 'form-control', 'id'=>'lat_grado_iniedieje','placeholder'=>'4','onchange'=>'coorden(this)'])}} 
                                </div>
                                <div class="form-group col-sm-4 " >
                                  Minutos:
                                {{ Form::number('lat_min_iniedieje','', ['class' => 'form-control', 'id'=>'lat_min_iniedieje','placeholder'=>'35','onchange'=>'coorden(this)'])}}
                                </div>
                                <div class="form-group col-sm-4 " >
                                  Segundos:
                                {{ Form::number('lat_seg_iniedieje','', ['class' => 'form-control', 'id'=>'lat_seg_iniedieje','placeholder'=>'40','onchange'=>'coorden(this)'])}}
                                </div>
                              </div>
                              <div class=" form-group col-sm-6 " >
                                <div class="form-group col-sm-12 " >
                                {{Form::label('Longlable_iniedieje','Longitud:',['class' => 'control-label'])}}
                                </div>
                                <div class="form-group col-sm-4 " >
                                  Grados:
                                {{ Form::number('long_gra_iniedieje','', ['class' => 'form-control', 'id'=>'long_gra_iniedieje','placeholder'=>'-74','onchange'=>'coorden(this)'])}}
                                </div>
                                <div class="form-group col-sm-4 " >
                                   Minutos:
                                {{ Form::number('long_min_iniedieje','', ['class' => 'form-control', 'id'=>'long_min_iniedieje','placeholder'=>'35','onchange'=>'coorden(this)'])}}
                                </div>
                                <div class="form-group col-sm-4 " >
                                  Segundos:
                                {{ Form::number('long_seg_iniedieje','', ['class' => 'form-control', 'id'=>'long_seg_iniedieje','placeholder'=>'40','onchange'=>'coorden(this)'])}}
                              </div>
                              </div>
                            </div>
                            <div class="checkbox-group" >
                              <b>Sabe las coordenadas finales del tramo?<font color="red">*</font></b>
                              <div class="form-group" id="coorderadio_finedieje">
                                <input type="radio" name="coorde_finedieje" id="coorde1_finedieje" value="1" required> Si
                                <input type="radio" name="coorde_finedieje" id="coorde2_finedieje" value="2"> No
                              </div>
                            </div>
                            <div class="form-group"id="datos_coorde_finedieje" style='display:none'>
                              <div class="form-group col-sm-6 ">
                                <div class="form-group col-sm-12 " >
                                {{Form::label('Latlable_finedieje','Latitud:',['class' => 'control-label'])}}
                                </div>
                                <div class="form-group col-sm-4 " >
                                  Grados:
                                  {{ Form::number('lat_gra_finedieje','', ['class' => 'form-control', 'id'=>'lat_grado_finedieje','placeholder'=>'4','onchange'=>'coorden(this)'])}} 
                                </div>
                                <div class="form-group col-sm-4 " >
                                  Minutos:
                                {{ Form::number('lat_min_finedieje','', ['class' => 'form-control', 'id'=>'lat_min_finedieje','placeholder'=>'35','onchange'=>'coorden(this)'])}}
                                </div>
                                <div class="form-group col-sm-4 " >
                                  Segundos:
                                {{ Form::number('lat_seg_finedieje','', ['class' => 'form-control', 'id'=>'lat_seg_finedieje','placeholder'=>'40','onchange'=>'coorden(this)'])}}
                                </div>
                              </div>
                              <div class=" form-group col-sm-6 " >
                                <div class="form-group col-sm-12 " >
                                {{Form::label('Longlable_finedieje','Longitud:',['class' => 'control-label'])}}
                                </div>
                                <div class="form-group col-sm-4 " >
                                  Grados:
                                {{ Form::number('long_gra_finedieje','', ['class' => 'form-control', 'id'=>'long_gra_finedieje','placeholder'=>'-74','onchange'=>'coorden(this)'])}}
                                </div>
                                <div class="form-group col-sm-4 " >
                                   Minutos:
                                {{ Form::number('long_min_finedieje','', ['class' => 'form-control', 'id'=>'long_min_finedieje','placeholder'=>'35','onchange'=>'coorden(this)'])}}
                                </div>
                                <div class="form-group col-sm-4 " >
                                  Segundos:
                                {{ Form::number('long_seg_finedieje','', ['class' => 'form-control', 'id'=>'long_seg_finedieje','placeholder'=>'40','onchange'=>'coorden(this)'])}}
                              </div>
                              </div>
                            </div>
                          </div>

                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Editar proyecto</button>
                      </div>
                    </form>
                  </div>
                </div>
           </div>
        </div>
      </div>
    </div>
        <!--Aca finaliza el modal para cargar nuevo proyecto-->   
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



          $('[id^=datepicker-]').datepicker({
             maxViewMode: 0,
            language: "es",
            autoclose: true,
            todayBtn: "linked"
          });


            $( "#mensajeestatus" ).fadeOut(5000);
            $('#tabla_proyectos').DataTable();

             
               
      });

//funcion que filtra los municipios por departamentos
      //------------------------------------------
    function filter_municipality(){
        var depto=document.getElementById("depto").value;
        $('#nucleo').empty();
        $("#nucleo").append("<option value=''>Seleccione una</option>");
        $("#terr").css("display","none");
        $("#select_terr").css("display","none");
        $.ajax({
            url:"artpic/municipios-plan50",
            type:"POST",
            data:{depto: depto},
            dataType:'json',
            success:function(data){                                                
                $("#municipios").empty();
                $("#municipios").append("<option selected disabled>Seleccione uno</option>");
                for (var i = 0; i < data.length; i++) {
                    $("#municipios").append("<option value=\""+data[i].COD_DANE+"\">"+data[i].NOM_MPIO_1+"</option>");
                    //console.log(data[i].COD_DANE)
                }                                
            },
            error:function(){alert('error');}
        });//Termina Ajax listadoproini
    };
        
    $("#municipios").change(function(){
        
        $("#terr").css("display","none");
        $("#select_terr").css("display","none");
        $('#nucleo').empty();
        $("#nucleo").append("<option value=''>Seleccione una</option>");
       
         $.ajax({url:"artpic/nucleo",type:"POST",data:{mpio:$('#municipios').val()},dataType:'json',//llama al controlador siscadi/siscadirepdpto que trae los valores necesario para la grafica
          success:function(data1){

            $.each(data1.arraynucleos, function(nom,datos){
              $("#nucleo").append("<option value=\""+datos+"\">"+nom+"</option>");
            });
          },
          error:function(){
            alert('Este municipio no tiene ningún núcleo veredal asignado');
            $('#nucleo').empty();
             $("#nucleo").append("<option value=''>El municipio no tiene núcelo veredal asignado  </option>");
          }
        });//Termina Ajax prueva
     
    });//Termina chage 


    $("#nucleo").change(function(){
       $("#tipoterr option:selected").removeAttr("selected");
       if($(this).val()==''){
        $("#terr").css("display","none");
        $("#select_terr").css("display","none");
      }else{
        $("#terr").css("display","block");
      
          var nucleo=$(this).val();
      }
    });


     $("#estado").change(function(){
        if ($("#estado").val()=='Ejecución'){
           $('[id^=eje-]').css("display","block");
           $('[id^=est-]').css("display","none");
           $('[id^=inden-]').css("display","none");
           $('[id^=fecha-]').css("display","none");
           $('[id^=cor-]').css("display","block");
        }else if($("#estado").val()==''){
          $('[id^=eje-]').css("display","none");
          $('[id^=est-]').css("display","none");
          $('[id^=inden-]').css("display","none");
          $('[id^=fecha-]').css("display","none");
          $('[id^=cor-]').css("display","none");
        }else if ($("#estado").val()=='Identificación'){
          $('[id^=eje-]').css("display","none");
          $('[id^=est-]').css("display","none");
          $('[id^=inden-]').css("display","block");
          $('[id^=fecha-]').css("display","block");
          $('[id^=cor-]').css("display","none");
        }else{
          $('[id^=fecha-]').css("display","block");
          $('[id^=eje-]').css("display","none");
          $('[id^=inden-]').css("display","none");
          $('[id^=est-]').css("display","block");
          $('[id^=cor-]').css("display","none");
        }
     });

    $("#tipoterr").change(function(){
      var tipoterr=$(this).val();
      var nucleo=$("#nucleo").val();
      if(tipoterr==null){
        $("#select_terr").css("display","none");
      }else{
        $("#select_terr").css("display","block");
        $('#nom_terr').empty();
        $.ajax({url:"artpic/admi-terr",type:"POST",data:{nucleo:nucleo,tipoterr:tipoterr},dataType:'json',
            success:function(data){
              console.log(data)
              for (var i = 0; i < Object.keys(data['arraynom_terri']).length; i++) {
                 $("#nom_terr").append("<optgroup label=\""+data['arratodoterrtipo'][i]+"\">"+i+"</optgroup>");

                $.each(data['arraynom_terri'][i], function(datos,nom){
                    $("#nom_terr").append("<option value=\""+datos+"\">"+nom+"</option>");
                  });
              };
               
            },
            error:function(){alert('error');}
        });//Termina Ajax
      }
    });

    $('input[type=radio][name=coorde]').change(function() {
        if (this.value == 1) {
           $("#datos_coorde_ini").css("display","block");
            $("#lat_grado_ini").prop('required',true); 
            $("#lat_min_ini").prop('required',true); 
            $("#lat_sed_ini").prop('required',true); 
            $("#long_grado_ini").prop('required',true); 
            $("#long_min_ini").prop('required',true); 
            $("#long_sed_ini").prop('required',true); 
        }
        else if (this.value == 2) {
          $("#datos_coorde_ini").css("display","none");
          $("#lat_grado_ini").prop('required',false); 
            $("#lat_min_ini").prop('required',false); 
            $("#lat_sed_ini").prop('required',false); 
            $("#long_grado_ini").prop('required',false); 
            $("#long_min_ini").prop('required',false); 
            $("#long_sed_ini").prop('required',false); 
          
        }
      });

    $('input[type=radio][name=coorde_fin]').change(function() {
        if (this.value == 1) {
           $("#datos_coorde_fin").css("display","block");
            $("#lat_grado_fin").prop('required',true); 
            $("#lat_min_fin").prop('required',true); 
            $("#lat_sed_fin").prop('required',true); 
            $("#long_grado_fin").prop('required',true); 
            $("#long_min_fin").prop('required',true); 
            $("#long_sed_fin").prop('required',true); 
        }
        else if (this.value == 2) {
          $("#datos_coorde_fin").css("display","none");
          $("#lat_grado_fin").prop('required',false); 
            $("#lat_min_fin").prop('required',false); 
            $("#lat_sed_fin").prop('required',false); 
            $("#long_grado_fin").prop('required',false); 
            $("#long_min_fin").prop('required',false); 
            $("#long_sed_fin").prop('required',false); 
          
        }
      });


    function current(e){
        var val=document.getElementById(e.id).value;            
        var Format = wNumb({
            prefix: '$ ',
            decimals: 0,
            thousand: '.'
        });        
        val_format=Format.to(Number(val))
        if(val_format==false){
            document.getElementById(e.id).value="";
            alert("Ingrese un valor valido")        
        } else {            
            document.getElementById(e.id).value=val_format;                
        } 
    } 
    //Termina tbody 
    var table = $('#tabla_proyectos').DataTable();
    $('#tabla_proyectos tbody').on('click', 'tr', function () {
        if ( $(this).hasClass('active') ) {
            $(this).removeClass('active');
            $("#btnedipro").prop('disabled', true);
            $("#btndeletepro").prop('disabled', true);
        } else {
            table.$('tr.active').removeClass('active');
            $(this).addClass('active');
            var id=$(this);
            $("#btnedipro").prop('disabled', false);
            $("#btndeletepro").prop('disabled', false);
            //Consulta ajax para traer los atributos editables del proyecto
            //var num=($('td', this).eq(0).text());
            var id=$(this);
            var num=id[0].id;
            $.ajax({
                url:"artpic/editar-plan50",
                type:"POST",
                data:{proy: num},
                dataType:'json',
                success:function(data){

                    if (data['arrayproy'][0].est_proy=='Ejecución'){
                      $('#estado_tab a[href="#tab3"]').tab('show');
                    }else if(data['arrayproy'][0].est_proy=='Estructuración'){
                      $('#estado_tab a[href="#tab2"]').tab('show');
                    }else if (data['arrayproy'][0].est_proy=='Identificación'){
                      $('#estado_tab a[href="#tab1"]').tab('show');
                    }

                    var tittle="Editar proyecto: "+ data['arrayproy'][0].nom_proy;
                    var tittle2=data['arrayproy'][0].nom_proy;
                    //inidicio del formulario de identificacion
                    $("#ediidproyediiden").val(num);  
                    $("#IDediiden").val(data['arrayproy'][0].ID);   
                    $("#deptoediiden").val(data['arrayproy'][0].cod_depto);              
                    $("#mpioediiden").val(data['arrayproy'][0].cod_mpio);
                    $("#nucleoediiden").val(data['arrayproy'][0].nom_nucleo);
                    $("#nucleoediiden2").val(data['arrayproy'][0].cod_nucleo);
                    
                    var tipoterr = [];
                    $.each(data['terr'], function(nom,datos){
                         tipoterr.push(datos.toString());
                    });
                    $('#tipoterrediiden').val(tipoterr);

                    $("#nom_terrediiden").empty();
                    for (var i = 0; i < Object.keys(data['arratodoterredi']).length; i++) {
                      $("#nom_terrediiden").append("<optgroup label=\""+data['arratodoterrtipoedi'][i]+"\">"+i+"</optgroup>");
                      $.each(data['arratodoterredi'][i], function(datos,nom){
                          $("#nom_terrediiden").append("<option value=\""+datos+"\">"+nom+"</option>");
                        });
                    };
                    var nameterr = [];
                    if(data['arraynomter']!=""){
                      $.each(data['arraynomter'], function(nom,datos){
                           nameterr.push(nom.toString());
                      });
                    }
                    $('#nom_terrediiden').val(nameterr);
                    $('#lineaediiden').val(data['arrayproy'][0].linea_proy);
                    $('#entidadediiden').val(data['arrayproy'][0].enti_lider);
                    $('#nombreediiden').val(data['arrayproy'][0].nom_proy);
                    $('#estadoediiden').val(data['arrayproy'][0].est_proy);
                    $('#alcanceediiden').val(data['arrayproy'][0].alcance);
                    $('#fecha_inicioediiden').val(data['arrayproy'][0].fecha_inicio);
                    $('#fecha_finalediiden').val(data['arrayproy'][0].fecha_fin);
                    //fin del formulario de identificacion

                    //inidicio del formulario de estructuracion
                    $("#ediidproyediestr").val(num);  
                    $("#IDediestr").val(data['arrayproy'][0].ID);   
                    $("#deptoediestr").val(data['arrayproy'][0].cod_depto);              
                    $("#mpioediestr").val(data['arrayproy'][0].cod_mpio);
                    $("#nucleoediestr").val(data['arrayproy'][0].nom_nucleo);
                    $("#nucleoediestr2").val(data['arrayproy'][0].cod_nucleo);
                    
                    var tipoterr = [];
                    $.each(data['terr'], function(nom,datos){
                         tipoterr.push(datos.toString());
                    });
                    $('#tipoterrediestr').val(tipoterr);

                    $("#nom_terrediestr").empty();
                    for (var i = 0; i < Object.keys(data['arratodoterredi']).length; i++) {
                      $("#nom_terrediestr").append("<optgroup label=\""+data['arratodoterrtipoedi'][i]+"\">"+i+"</optgroup>");
                      $.each(data['arratodoterredi'][i], function(datos,nom){
                          $("#nom_terrediestr").append("<option value=\""+datos+"\">"+nom+"</option>");
                        });
                    };
                    var nameterr = [];
                    if(data['arraynomter']!=""){
                      $.each(data['arraynomter'], function(nom,datos){
                           nameterr.push(nom.toString());
                      });
                    }
                    $('#nom_terrediestr').val(nameterr);
                    $('#lineaediestr').val(data['arrayproy'][0].linea_proy);
                    $('#entidadediestr').val(data['arrayproy'][0].enti_lider);
                    $('#nombreediestr').val(data['arrayproy'][0].nom_proy_2);
                    $('#estadoediestr').val(data['arrayproy'][0].est_proy);
                    $('#alcanceediestr').val(data['arrayproy'][0].alcance_2);
                    $('#fecha_inicioediestr').val(data['arrayproy'][0].fecha_inicio);
                    $('#fecha_finalediestr').val(data['arrayproy'][0].fecha_fin);
                    $('#cost_proyediestr').val(data['arrayproy'][0].costo_estim);
                    //fin del formulario de estructuracion

                    //inidicio del formulario de ejecucion
                    $("#ediidproyedieje").val(num);  
                    $("#IDedieje").val(data['arrayproy'][0].ID);   
                    $("#deptoedieje").val(data['arrayproy'][0].cod_depto);              
                    $("#mpioedieje").val(data['arrayproy'][0].cod_mpio);
                    $("#nucleoedieje").val(data['arrayproy'][0].nom_nucleo);
                    $("#nucleoedieje2").val(data['arrayproy'][0].cod_nucleo);
                    
                    var tipoterr = [];
                    $.each(data['terr'], function(nom,datos){
                         tipoterr.push(datos.toString());
                    });
                    $('#tipoterredieje').val(tipoterr);

                    $("#nom_terredieje").empty();
                    for (var i = 0; i < Object.keys(data['arratodoterredi']).length; i++) {
                      $("#nom_terredieje").append("<optgroup label=\""+data['arratodoterrtipoedi'][i]+"\">"+i+"</optgroup>");
                      $.each(data['arratodoterredi'][i], function(datos,nom){
                          $("#nom_terredieje").append("<option value=\""+datos+"\">"+nom+"</option>");
                        });
                    };
                    var nameterr = [];
                    if(data['arraynomter']!=""){
                      $.each(data['arraynomter'], function(nom,datos){
                           nameterr.push(nom.toString());
                      });
                    }
                    $('#nom_terredieje').val(nameterr);
                    $('#lineaedieje').val(data['arrayproy'][0].linea_proy);
                    $('#entidadedieje').val(data['arrayproy'][0].enti_lider);
                    $('#nombreedieje').val(data['arrayproy'][0].nom_proy_3);
                    $('#estadoedieje').val(data['arrayproy'][0].est_proy);
                    $('#alcanceedieje').val(data['arrayproy'][0].alcance_3);
                    $('#ava_presuedieje').val(data['arrayproy'][0].avance_pres);
                    $('#ava_productedieje').val(data['arrayproy'][0].avance_prod);
                    $('#longedieje').val(data['arrayproy'][0].longitud);
                    $('#pob_beneedieje').val(data['arrayproy'][0].pob_bene);
                    $('#fecha_inicio2edieje').val(data['arrayproy'][0].fecha_inicio_2);
                    $('#fecha_final2edieje').val(data['arrayproy'][0].fecha_fin_2);
                    $('#cost_proyedieje').val(data['arrayproy'][0].costo_ejec);
                    $("#deletedocedieje").attr('name', num);
                    $("#deletedocediide").attr('name', num);
                    $("#deletedocediest").attr('name', num);
                    if( data['arrayproy'][0].documento==""||  data['arrayproy'][0].documento==null){

                          $('[id^=docedi]').attr('disabled', true);
                          $('[id^=docedi]').removeClass().addClass('glyphicon glyphicon-download-alt btn btn-default ');
                          $('[id^=docedi]').attr("title", "No hay documento cargado");
                          $('[id^=docedi]').removeAttr("href");
                          $('[id^=docedi]').removeAttr("target");
                        }else{
                        $('[id^=docedi]').attr("href", data['arrayproy'][0].documento);
                         $('[id^=docedi]').removeClass().addClass('glyphicon glyphicon-download-alt btn btn-success ');
                         $('[id^=docedi]').attr("target", "_blank");
                         $('[id^=docedi]').attr('disabled', false);
                        }
                    

                     var coor_ini=data['arrayproy'][0].coord_ini.split(" ");
                     for (var i = 0; i < coor_ini.length; i++) {
                        if(coor_ini[i]!=""){
                          $("#coorde1edieje").attr('checked', 'checked');
                          $("#datos_coorde_iniedieje").css("display","block");
                          $("#lat_grado_iniedieje").prop('required',true); 
                          $("#lat_min_iniedieje").prop('required',true); 
                          $("#lat_sed_iniedieje").prop('required',true); 
                          $("#long_grado_iniedieje").prop('required',true); 
                          $("#long_min_iniedieje").prop('required',true); 
                          $("#long_sed_iniedieje").prop('required',true); 
                          if (i==0){
                           var g2=Math.trunc(coor_ini[i]);
                           var m2=Math.trunc((parseFloat(coor_ini[i])-parseInt(g2))*60);
                           var s2=Math.round(((Math.abs((parseFloat(coor_ini[i])-parseInt(g2))*60)-m2)*60)* 100) / 100;
                            $('#long_gra_iniedieje').val(g2);
                            $('#long_min_iniedieje').val(m2);
                            $('#long_seg_iniedieje').val(s2);

                          }else{
                             var g1=Math.trunc(coor_ini[i]);
                             var m1=Math.abs(Math.trunc((parseFloat(coor_ini[i])-parseInt(g1))*60));
                             var s1=Math.round(((Math.abs((parseFloat(coor_ini[i])-parseInt(g1))*60)-m1)*60)* 100) / 100;
                              $('#lat_grado_iniedieje').val(g1);
                              $('#lat_min_iniedieje').val(m1);
                              $('#lat_seg_iniedieje').val(s1);
                         }
                       }
                     };

                     var coor_fin=data['arrayproy'][0].coord_fin.split(" ");
                     for (var i = 0; i < coor_fin.length; i++) {
                        if(coor_fin[i]!=""){
                          $("#coorde1_finedieje").attr('checked', 'checked');
                          $("#datos_coorde_finedieje").css("display","block");
                          $("#lat_grado_finedieje").prop('required',true); 
                          $("#lat_min_finedieje").prop('required',true); 
                          $("#lat_sed_finedieje").prop('required',true); 
                          $("#long_grado_finedieje").prop('required',true); 
                          $("#long_min_finedieje").prop('required',true); 
                          $("#long_sed_finedieje").prop('required',true); 
                          if (i==0){
                               var g2=Math.trunc(coor_fin[i]);
                               var m2=Math.trunc((parseFloat(coor_fin[i])-parseInt(g2))*60);
                               var s2=Math.round(((Math.abs((parseFloat(coor_fin[i])-parseInt(g2))*60)-m2)*60)* 100) / 100;
                                $('#long_gra_finedieje').val(g2);
                                $('#long_min_finedieje').val(m2);
                                $('#long_seg_finedieje').val(s2);                    
                          }else{
                             var g1=Math.trunc(coor_fin[i]);
                             var m1=Math.abs(Math.trunc((parseFloat(coor_fin[i])-parseInt(g1))*60));
                             var s1=Math.round(((Math.abs((parseFloat(coor_fin[i])-parseInt(g1))*60)-m1)*60)* 100) / 100;
                              $('#lat_grado_finedieje').val(g1);
                              $('#lat_min_finedieje').val(m1);
                              $('#lat_seg_finedieje').val(s1);
                         }
                       }
                     };

                    //fin del formulario de ejecucion


                    $("#IDdele").val(data['arrayproy'][0].ID);
                    $("#deletenombre").val(data['arrayproy'][0].nom_proy);
                    $("#deleteproy").val(data['arrayproy'][0].OBJECTID);
                    $("#deletenucleo").val(data['arrayproy'][0].nom_nucleo);

                },
                error:function(){alert('error');}
            });//fin de la consulta ajax (Editar proceso)
            
        }
    });//Termina tbody

    function precio_change(a) {
          var total=0;
           var Format = wNumb({
              prefix: '$ ',
              decimals: 0,
              thousand: '.'
          }); 
    }

    function borr_crit(e) {
          var id=e.id.substring(6,15);
          $.ajax({url:"artpic/borrar-doc-plan50",type:"POST",data:{proy:e.name},dataType:'json',
                success:function(data){

                  $("#"+id).attr('class', 'glyphicon glyphicon-download-alt btn btn-default');
                  $("#"+id).removeAttr("href");
                  $("#"+id).removeAttr("target");
                  $("#"+id).attr("disabled", true);
                  $("#"+id).attr('title', 'No hay archivo para este criterio');
                  },
                error:function(){alert('error');}
            });//Termina Ajax
        }

    function coorden(e){
        if ((e.id.substring(0,8)=='lat_min_'|| e.id.substring(0,8)=='lat_seg_' || e.id.substring(0,9)=='long_min_' || e.id.substring(0,9)=='long_seg_') && (e.value<0 || e.value>=60)){
         alert("Ingrese un valor entre 0 y 59 ");
         e.value="";
         }

         if ((e.id.substring(0,9)=='lat_grado') && (e.value<-4 || e.value>=13)){
         alert("Ingrese un valor entre -4 y 13 grados ");
         e.value="";
         }

         if ((e.id.substring(0,8)=='long_gra') && (e.value<-80 || e.value>=-67)){
         alert("Ingrese un valor entre -80 y -67 grados ");
         e.value="";
         }

      }

//funciones de edicion para el estado de identificación
  $('#editar_proyecto').on('hidden.bs.modal', function (e) {//funcion que resetea el modal
    $(this).find('form').trigger('reset');
    table.$('tr.active').removeClass('active');
    $("#btnedipro").prop('disabled', true);
    $("#btndeletepro").prop('disabled', true);
  });

  $("#tipoterrediiden").change(function(){
      var tipoterr=$(this).val();
      var nucleo=$("#nucleoediiden2").val();
      if(tipoterr==null){
        $("#tipoterrediiden").css("display","none");
      }else{
        $("#tipoterrediiden").css("display","block");
        $('#nom_terrediiden').empty();
        $.ajax({url:"artpic/admi-terr",type:"POST",data:{nucleo:nucleo,tipoterr:tipoterr},dataType:'json',
            success:function(data){
              for (var i = 0; i < Object.keys(data['arraynom_terri']).length; i++) {
                 $("#nom_terrediiden").append("<optgroup label=\""+data['arratodoterrtipo'][i]+"\">"+i+"</optgroup>");

                $.each(data['arraynom_terri'][i], function(datos,nom){
                    $("#nom_terrediiden").append("<option value=\""+datos+"\">"+nom+"</option>");
                  });
              };
               
            },
            error:function(){alert('error');}
        });//Termina Ajax
      }
    });
  $("#tipoterrediestr").change(function(){
      var tipoterr=$(this).val();
      var nucleo=$("#nucleoediestr2").val();
      if(tipoterr==null){
        $("#tipoterrediestr").css("display","none");
      }else{
        $("#tipoterrediestr").css("display","block");
        $('#nom_terrediestr').empty();
        $.ajax({url:"artpic/admi-terr",type:"POST",data:{nucleo:nucleo,tipoterr:tipoterr},dataType:'json',
            success:function(data){
              for (var i = 0; i < Object.keys(data['arraynom_terri']).length; i++) {
                 $("#nom_terrediestr").append("<optgroup label=\""+data['arratodoterrtipo'][i]+"\">"+i+"</optgroup>");

                $.each(data['arraynom_terri'][i], function(datos,nom){
                    $("#nom_terrediestr").append("<option value=\""+datos+"\">"+nom+"</option>");
                  });
              };
               
            },
            error:function(){alert('error');}
        });//Termina Ajax
      }
    });
  $("#tipoterredieje").change(function(){
      var tipoterr=$(this).val();
      var nucleo=$("#nucleoedieje2").val();
      if(tipoterr==null){
        $("#tipoterredieje").css("display","none");
      }else{
        $("#tipoterredieje").css("display","block");
        $('#nom_terredieje').empty();
        $.ajax({url:"artpic/admi-terr",type:"POST",data:{nucleo:nucleo,tipoterr:tipoterr},dataType:'json',
            success:function(data){
              for (var i = 0; i < Object.keys(data['arraynom_terri']).length; i++) {
                 $("#nom_terredieje").append("<optgroup label=\""+data['arratodoterrtipo'][i]+"\">"+i+"</optgroup>");

                $.each(data['arraynom_terri'][i], function(datos,nom){
                    $("#nom_terredieje").append("<option value=\""+datos+"\">"+nom+"</option>");
                  });
              };
               
            },
            error:function(){alert('error');}
        });//Termina Ajax
      }
    });

    $('input[type=radio][name=coordeedieje]').change(function() {
        if (this.value == 1) {
           $("#datos_coorde_iniedieje").css("display","block");
            $("#lat_grado_iniedieje").prop('required',true); 
            $("#lat_min_iniedieje").prop('required',true); 
            $("#lat_sed_iniedieje").prop('required',true); 
            $("#long_grado_iniedieje").prop('required',true); 
            $("#long_min_iniedieje").prop('required',true); 
            $("#long_sed_iniedieje").prop('required',true); 
        }
        else if (this.value == 2) {
          $("#datos_coorde_iniedieje").css("display","none");
          $("#lat_grado_iniedieje").prop('required',false); 
            $("#lat_min_iniedieje").prop('required',false); 
            $("#lat_sed_iniedieje").prop('required',false); 
            $("#long_grado_iniedieje").prop('required',false); 
            $("#long_min_iniedieje").prop('required',false); 
            $("#long_sed_iniedieje").prop('required',false); 
          
        }
      });


    $('input[type=radio][name^=docradio]').change(function() {
        var id=this.id.substring(9,12);
        console.log(id)
        if (this.value == 1) {
           $("#doc_carga"+id).css("display","block");
           $("#doc"+id).prop('required',true);
        }
        else if (this.value == 2) {
          $("#doc_carga"+id).css("display","none");
           $("#doc"+id).prop('required',false);
          
        }
      });

    $('input[type=radio][name=coorde_finedieje]').change(function() {
        if (this.value == 1) {
           $("#datos_coorde_finedieje").css("display","block");
            $("#lat_grado_finedieje").prop('required',true); 
            $("#lat_min_finedieje").prop('required',true); 
            $("#lat_sed_finedieje").prop('required',true); 
            $("#long_grado_finedieje").prop('required',true); 
            $("#long_min_finedieje").prop('required',true); 
            $("#long_sed_finedieje").prop('required',true); 
        }
        else if (this.value == 2) {
          $("#datos_coorde_finedieje").css("display","none");
          $("#lat_grado_finedieje").prop('required',false); 
            $("#lat_min_finedieje").prop('required',false); 
            $("#lat_sed_finedieje").prop('required',false); 
            $("#long_grado_finedieje").prop('required',false); 
            $("#long_min_finedieje").prop('required',false); 
            $("#long_sed_finedieje").prop('required',false); 
          
        }
      });

  $('[id^=estadoedi]').change(function(){
        if ($(this).val()=='Ejecución'){
          $('#estado_tab a[href="#tab3"]').tab('show');
           $("#estadoedieje").val('Ejecución');
        }else if($(this).val()=='Estructuración'){
          $('#estado_tab a[href="#tab2"]').tab('show');
          $("#estadoediestr").val('Estructuración');
        }else if ($(this).val()=='Identificación'){
          $('#estado_tab a[href="#tab1"]').tab('show');
          $("#estadoediiden").val('Identificación');
        }
     });


//finalizacion de funciones de edicion para el estado de identificación  
</script>    
@stop

@endif<!--Cierra el if de mostrar el contenido de la página si esta autenticado-->