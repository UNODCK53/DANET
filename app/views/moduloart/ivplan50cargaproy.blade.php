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
  <link href="assets/noUiSlider.9.2.0/nouislider.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/L.Control.Basemaps.css" />  
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.3/dist/leaflet.css"/>
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
    .noUi-tooltip{
        width: 40px
    }
    .noUi-value{
      margin-top: 5px;
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
          <div class="modal fade" id="cargar_proyecto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-keyboard="false" data-backdrop="static">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="myModalLabel">Ficha de proyecto: Plan 51/50</h4>
                </div>
                <div class="modal-body">
                    <form role="form" action="artpic/cargar-proyecto-plan50" method="post" id="cargarproy" enctype="multipart/form-data" > 
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
                        <select name="nom_terr[]" id="nom_terr" class="form-control"  multiple required> 
                          </select>
                      </div>
                      <div class="form-group">
                        <b>Nombre del proyecto<font color="red">*</font></b>
                        <input required id="nombre" name="nombre" type="text" class="form-control" placeholder="Ingrese el nombre del proyecto">
                      </div>
                      <div class="form-group">
                        <b>Actores para implementación<font color="red">*</font></b>
                        <select required id="entidad" name="entidad[]" class="form-control" multiple>
                            <option value="Alcaldía municipal">Alcaldía municipal</option>
                            <option value="Cabildo Indígena">Cabildo Indígena</option>
                            <option value="Consejo Comunitario">Consejo Comunitario</option>
                            <option value="Invías">Invías</option>
                            <option value="Junta Acción Comunal">Junta Acción Comunal</option>
                            <option value="Organizaciones comunitarias">Organizaciones comunitarias</option>
                            <option value="Otro">Otro</option>                 
                        </select>
                      </div>
                      <div class="form-group" id="otro" style='display:none'>
                        <b>Defina otro actor<font color="red">*</font></b>
                        <input  id="otro_act" name="otro_act" class="form-control" rows="3"></input>
                      </div>
                      <div class="form-group">
                        <b>Estado del proyecto<font color="red">*</font></b>
                        <select  id="estado" name="estado" class="form-control" readonly="true" disabled>
                            <option  value="">Seleccione una opción</option>
                            <option selected value="Identificación">Identificación </option>
                            <!-- <option value="Estructuración">Estructuración</option>
                            <option value="Ejecución">Ejecución</option> -->                   
                        </select>
                      </div>
                      <div class="form-group" id="inden-1" <!--style='display:none'--> 
                        <b>Alcance definido en identificación<font color="red">*</font></b>
                        <textarea  id="alcance" name="alcance" class="form-control" rows="3" required></textarea>
                      </div>
                      <div class="form-group" id="fecha-1" >
                      <b>Fecha para la estructuración<font color="red">*</font></b>
                        <div class="input-group date" id="datepicker-1">                      
                          <input  id="fecha_inicio" name="fecha_inicio" type="text" class="form-control"  placeholder="Ingrese la fecha para la estructuración del proyecto" onchange='fecha_change(this)' required>
                          <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>                      
                        </div>
                      </div>
                      <div class="form-group" >
                        <b>Acta de validación del proyecto<font color="red">*</font></b>
                        {{ Form::file('doc_iden', ['class' => 'form-control', 'id'=>'doc_iden','accept'=>'.pdf','placeholder'=>'ej: acta.pdf','required'=>'true']) }}
                      </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                  <button type="submit" class="btn btn-primary">Crear proyecto</button>
                </div>
                </form>
              </div>
            </div>
          </div>
          <!--Aca finaliza el modal para cargar nuevo proyecto-->

          <!--Aca inicia el modal para borrar proyecto-->
          <div class="modal fade bs-example-modal-sm" id="borrar_proyecto" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" data-keyboard="false" data-backdrop="static">
            <div class="modal-dialog modal-sm" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="borrar_tittle">Borrar proyecto</h4>
                  </div>
                  <div class="modal-body">
                  <form role="form" action="artpic/borrar-proyecto-plan50" method="post" id="deleteproy" enctype="multipart/form-data">
                   <div class="form-group">
                      <input  id = "deleteproycto" name = "deleteproy" class="form-control" type="hidden" ></input>
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
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
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
                <h4 class="modal-title">Seguimiento del Proyecto </h4>
              </div>
                <div class="modal-body" style="max-height: calc(100vh - 210px);overflow-y: auto;">
                    <div class="tabbable"> <!-- Only required for left/right tabs -->
                    <ul id="estado_tab" class="nav nav-tabs">
                    <li><a href="#tab1" >Indentificación</a></li>
                    <li><a href="#tab2" >Estructuración</a></li>
                    <li><a href="#tab3" >Ejecución</a></li>
                    </ul>
                  </div>
                    <div class="tab-content">
                      <div class="tab-pane" id="tab1">
                        <form role="form" action="artpic/edi-proy-p50-iden" method="post" enctype="multipart/form-data" id="edi-form-iden">
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
                              <b>Actores para implementación<font color="red">*</font></b>
                              <select required id="entidadediiden" name="entidadediiden[]" class="form-control" multiple>
                                  <option value="Alcaldía municipal">Alcaldía municipal</option>
                                  <option value="Cabildo Indígena">Cabildo Indígena</option>
                                  <option value="Consejo Comunitario">Consejo Comunitario</option>
                                  <option value="Invías">Invías</option>
                                  <option value="Junta Acción Comunal">Junta Acción Comunal</option>
                                  <option value="Organizaciones comunitarias">Organizaciones comunitarias</option>
                                  <option value="Otro">Otro</option>                 
                              </select>
                            </div>
                            <div class="form-group" id="otroediiden" style='display:none'>
                              <b>Defina otro actor<font color="red">*</font></b>
                              <input  id="otro_actediiden" name="otro_actediiden" class="form-control" rows="3"></input>
                            </div>
                            <div class="form-group" >
                              <b>Fecha para la estructuración</b>
                               {{ Form::text('fecha_inicioediiden', Input::old('fecha_inicioediiden'), ['class' => 'form-control', 'id'=>'fecha_inicioediiden','required'=>'true','readonly'=>'true']) }}
                            </div>
                            <div class="form-group col-sm-12" style="padding: 0;">
                              <div class="col-sm-9">
                              <b>Desea cargar o editar el acta de validación del proyecto:</b>
                              </div>
                              <div class="col-sm-1" >
                                <span >
                                  <a id="docediiden" title="Descargar Documento" role="button"></a>
                                </span>
                              </div>
                              <div class="col-sm-1" >
                                <span >
                                  <a id="deletedocediiden" title="Borrar Documento" class="glyphicon glyphicon glyphicon-trash btn btn-default" role="button" onclick="borr_crit(this)"></a>
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
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Editar proyecto</button>
                          </div>
                        </form>
                      </div>


                      <div class="tab-pane active" id="tab2">
                        <form role="form" action="artpic/edi-proy-p50-estr" method="post" enctype="multipart/form-data" id="edi-form-estr">
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
                              <b>Alcance definido en estructuración<font color="red">*</font></b>
                              {{ Form::textarea('alcanceediestr', Input::old('alcanceediestr'), ['class' => 'form-control', 'id'=>'alcanceediestr','required'=>'true']) }}
                            </div>
                            <div class="form-group">
                              <b>Actores para implementación<font color="red">*</font></b>
                              <select required id="entidadediestr" name="entidadediestr[]" class="form-control" multiple>
                                  <option value="Alcaldía municipal">Alcaldía municipal</option>
                                  <option value="Cabildo Indígena">Cabildo Indígena</option>
                                  <option value="Consejo Comunitario">Consejo Comunitario</option>
                                  <option value="Invías">Invías</option>
                                  <option value="Junta Acción Comunal">Junta Acción Comunal</option>
                                  <option value="Organizaciones comunitarias">Organizaciones comunitarias</option>
                                  <option value="Otro">Otro</option>                 
                              </select>
                            </div>
                            <div class="form-group" id="otroediestr" style='display:none'>
                              <b>Defina otro actor<font color="red">*</font></b>
                              <input  id="otro_actediestr" name="otro_actediestr" class="form-control" rows="3"></input>
                            </div>
                            <div class="form-group">
                              <b>Costo Estimado<font color="red">*</font></b>
                              <input required id="cost_proyediestr" name="cost_proyediestr"onchange="current(this)" class="form-control" placeholder="Ingrese el valor del costo estimado" type="text" min="0" step="any"/>
                            </div>
                            <div class="form-group">
                              <b>Fecha de la firma del convenio<font color="red">*</font></b>
                              <div class="input-group date" id="datepicker-4">                      
                                <input  required id="fecha_inicioediestr" name="fecha_inicioediestr" type="text" class="form-control" placeholder="Ingrese la fecha de la firma del convenio" onchange='fecha_change(this)'>
                                <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>                      
                              </div>
                            </div>
                            <div class="form-group col-sm-12" style="padding: 0;">
                              <div class="col-sm-9">
                              <b>Desea cargar o editar el documento presupuestal del proyecto:</b>
                              </div>
                              <div class="col-sm-1" >
                                <span >
                                  <a id="docediestr" title="Descargar Documento" role="button"></a>
                                </span>
                              </div>
                              <div class="col-sm-1" >
                                <span >
                                  <a id="deletedocediestr" title="Borrar Documento" class="glyphicon glyphicon glyphicon-trash btn btn-default" role="button" onclick="borr_crit(this)"></a>
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
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Editar proyecto</button>
                          </div>
                        </form>
                      </div>


                    <div class="tab-pane active" id="tab3">
                      <form role="form" action="artpic/edi-proy-p50-eje" method="post" enctype="multipart/form-data" id="edi-form-eje">
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
                              <b>Actores para implementación<font color="red">*</font></b>
                              <select required id="entidadediejec" name="entidadedieje[]" class="form-control" multiple>
                                  <option value="Alcaldía municipal">Alcaldía municipal</option>
                                  <option value="Cabildo Indígena">Cabildo Indígena</option>
                                  <option value="Consejo Comunitario">Consejo Comunitario</option>
                                  <option value="Invías">Invías</option>
                                  <option value="Junta Acción Comunal">Junta Acción Comunal</option>
                                  <option value="Organizaciones comunitarias">Organizaciones comunitarias</option>
                                  <option value="Otro">Otro</option>                 
                              </select>
                            </div>
                            <div class="form-group" id="otroediejec" style='display:none'>
                              <b>Defina otro actor<font color="red">*</font></b>
                              <input  id="otro_actediejec" name="otro_actedieje" class="form-control" rows="3"></input>
                            </div>
                            <div class="form-group">
                              {{Form::hidden ('pob_beneedieje','', ['class' => 'form-control', 'id'=>'pob_beneedieje'])}}
                            </div>
                            <div class="form-group">
                              <b>Costo del proyecto <font color="red">*</font></b>
                              <input required id="cost_proyedieje" name="cost_proyedieje"onchange="current(this)" class="form-control" placeholder="Ingrese el valor del costo a ejecutar" type="text" />
                            </div>
                            <div class="form-group" >
                              <div id="avance_presu"><b>Avance de ejecución presupuestal<font color="red">*</font></b></div>
                              <input required id="ava_presuedieje" name="ava_presuedieje"onchange="current(this)" class="form-control" placeholder="Ingrese el valor del costo ejecutado" type="text" />
                            </div>
                            <div class="form-group" style="margin-bottom: 30px">
                              <b>Avance físico del proyecto<font color="red">*</font></b>
                              <br><br>
                              <div id="ava_product" class="noUi-target noUi-ltr noUi-horizontal" style="margin-left: 20px;margin-right: 25px;"></div>
                              <input type="text" id="ava_productedieje" name="ava_productedieje" style="visibility:hidden">
                            </div>
                             <div class="form-group">
                               <b>Fecha de inicio de la ejecución<font color="red">*</font></b>
                              <div class="input-group date" id="datepicker-5">                      
                                <input  required id="fecha_inicio2edieje" name="fecha_inicio2edieje" type="text" class="form-control"  placeholder="Ingrese la fecha de inicio del proyecto" onchange='fecha_change(this)'>
                                <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>                      
                              </div>
                            </div>
                            <div class="form-group">
                              <b>Fecha final de la ejecución<font color="red">*</font></b>
                              <div class="input-group date" id="datepicker-6">                      
                                <input  required id="fecha_final2edieje" name="fecha_final2edieje" type="text" class="form-control" placeholder="Ingrese la fecha de finalización del proyecto" onchange='fecha_change(this)'>
                                <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>                      
                              </div>
                            </div>
                            <div class="form-group col-sm-12" style="padding: 0;">
                              <div class="col-sm-9">
                              <b>Desea cargar o editar el acta de inicio del proyecto:</b>
                              </div>
                              <div class="col-sm-1" >
                                <span >
                                  <a id="docediejec" title="Descargar Documento" role="button"></a>
                                </span>
                              </div>
                              <div class="col-sm-1" >
                                <span >
                                  <a id="deletedocediejec" title="Borrar Documento" class="glyphicon glyphicon glyphicon-trash btn btn-default" role="button" onclick="borr_crit(this)"></a>
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
                            <div class="row" id="label_pobla-eje" >
                              <b style="padding: 15px;" >Ingrese el número de población beneficiada para cada territorio seleccionado:</b>
                              <br><br>
                            </div> 

                            <div class="form-group">
                              <b>Seleccione el numero de tramos a intervenir:<font color="red">*</font></b>
                              <select name="tramo" id="tramo" class="form-control" required > 
                                <option value="" selected >Seleccione uno </option>
                                <?php for ($i=1; $i <=10 ; $i++) { ?>
                                <option value=<?php echo $i; ?>><?php echo $i; ?></option>
                                <?php } ?>
                                </select>
                            </div>
                            <div class="row" id="tramos" >
                            </div> 
                            <div>
                            Ver tramos en el mapa
                            <input type="button" value="Ver mapa" id="boton" onclick="map()">
                            </div>
                            <div id="mapid" style="min-width: 100px; height: 300px; margin-left:0px; display:none" ></div>   
                        </div>    
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
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
 <script src="assets/noUiSlider.9.2.0/nouislider.min.js"></script>
 <script src="https://unpkg.com/leaflet@1.0.3/dist/leaflet.js"></script>
 <script src="assets/js/L.Control.Basemaps-min.js"></script> 

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

          Format = wNumb({
              prefix: '$ ',
              decimals: 0,
              thousand: '.'
          });


            $( "#mensajeestatus" ).fadeOut(5000);
            $('#tabla_proyectos').DataTable();
          
               
      });



 bounds = new L.LatLngBounds(new L.LatLng(-7, -90), new L.LatLng(15, -50));
        var map_alerta = L.map('mapid',{maxBounds: bounds});
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




function map(){

        setTimeout(function(){    
                map_alerta.invalidateSize();
            }, 1);
           try{
              map_alerta.removeLayer(polylines);
            }catch(err){

            }
            var popup=[];

            for (var i = 1; i <= $("#tramo").val(); i++) {//valdia que las coordenas de tramo(inicial y finales) esten todas lelnas, si no no poltea este tramo
              if( $('#lat_gra_ini'+i).val()!='' && $('#lat_min_ini'+i).val()!='' && $('#lat_seg_ini'+i).val()!='' && $('#lon_gra_ini'+i).val()!='' && $('#lon_min_ini'+i).val()!='' && $('#lon_seg_ini'+i).val()!='' && $('#lat_gra_fin'+i).val()!='' && $('#lat_min_fin'+i).val()!='' && $('#lat_seg_fin'+i).val()!='' && $('#lon_gra_fin'+i).val()!='' && $('#lon_min_fin'+i).val()!='' && $('#lon_seg_fin'+i).val()!='' ) {

                if ($('#lat_gra_ini'+i).val()<0) {//valida el signo del la latitud
                  var Latitud=(parseInt($('#lat_gra_ini'+i).val())-parseFloat($('#lat_min_ini'+i).val()/60)-parseFloat($('#lat_seg_ini'+i).val()/3600));
                }else{
                  var Latitud=(parseInt($('#lat_gra_ini'+i).val())+parseFloat($('#lat_min_ini'+i).val()/60)+parseFloat($('#lat_seg_ini'+i).val()/3600));
                  if($("input[name=sig_lat_ini"+i+"]:checked").val()=='-1'){//valida si se tiene seleccionado el signo sur cuando es latitud 0
                     Latitud=Latitud*-1;
                  }
                }
                longitud=parseInt($('#lon_gra_ini'+i).val())-parseFloat($('#lon_min_ini'+i).val()/60)-parseFloat($('#lon_seg_ini'+i).val()/3600);
                var ini = [Math.round(Latitud*10000)/10000,Math.round(longitud*10000)/10000];

                if ($('#lat_gra_fin'+i).val()<0) {//valida el signo del la latitud
                  var Latitud=(parseInt($('#lat_gra_fin'+i).val())-parseFloat($('#lat_min_fin'+i).val()/60)-parseFloat($('#lat_seg_fin'+i).val()/3600));
                }else{
                  var Latitud=(parseInt($('#lat_gra_fin'+i).val())+parseFloat($('#lat_min_fin'+i).val()/60)+parseFloat($('#lat_seg_fin'+i).val()/3600));
                  if($("input[name=sig_lat_fin"+i+"]:checked").val()=='-1'){//valida si se tiene seleccionado el signo sur cuando es latitud 0
                     Latitud=Latitud*-1;
                  }
                }
                longitud=parseInt($('#lon_gra_fin'+i).val())-parseFloat($('#lon_min_fin'+i).val()/60)-parseFloat($('#lon_seg_fin'+i).val()/3600);
                var fin = [Math.round(Latitud*10000)/10000,Math.round(longitud*10000)/10000];

                var pointList=[ini, fin];
                colores="#"+((1<<24)*Math.random()|0).toString(16);
                var polyline = new L.Polyline(pointList, {
                    color: colores,
                    weight: 3,
                    opacity: 0.7,
                    smoothFactor: 1
                })
              .bindPopup("<h3 style='text-decoration: underline;text-decoration-color: "+colores+";-webkit-text-decoration-color: "+colores+";  '>Tramo "+i+"</h3><br><b>Linea de:</b> "+$('#linea-'+i+' option:selected').text()+"<br> <b>Coordenadas tramo:</b> <br> Inicial "+ini+ " <br>final "+fin);
              popup.push(polyline)

              } 
            }

            polylines = L.layerGroup(popup);
            polylines.addTo(map_alerta);
            map_alerta.fitBounds(polyline.getBounds());

        $("#mapid").css("display","block");
    };


var handlesSlider3= document.getElementById('ava_product');
          noUiSlider.create(handlesSlider3, {
              start: [0],
              step: 10,
              tooltips: true,
              range: {
                  'min': [  0 ],
                  'max': [ 100 ]
              },
              format: wNumb({
                  decimals: 0,
                  postfix:'%'
              }),
              pips: { // Show a scale with the slider
                mode: 'steps',
                stepped: true,
                density: 10,
                format: wNumb({
                  decimals: 0,
                  postfix: '%'
                })
              }
          });

          var input1 = document.getElementById('ava_productedieje');
          
          handlesSlider3.noUiSlider.on('update', function( values, handle ) {
              input1.value = values[handle];
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
    var alerta=0;
    var alerta1=0;
    function fecha_change(a) {
          
          switch(a.id.substr(-1)) {
              case 'e':
                  if ($('#fecha_inicio2edieje').val()!='' && $('#fecha_final2edieje').val()!='' ){
                    var fecha1=new Date($('#fecha_inicio2edieje').val().split('/')[2], $('#fecha_inicio2edieje').val().split('/')[1] - 1, $('#fecha_inicio2edieje').val().split('/')[0]);
                    var fecha2=new Date($('#fecha_final2edieje').val().split('/')[2], $('#fecha_final2edieje').val().split('/')[1] - 1, $('#fecha_final2edieje').val().split('/')[0]);
                    if(fecha1 > fecha2){
                      alert('La fecha final NO puede ser anterior a la fecha de inicio de ejecución');
                      $(a).val('');
                    }
                  }

                  break;
          }

          var today = new Date();
          if (a.id=='fecha_inicioediestr'){
             var select=new Date(a.value.split('/')[2], a.value.split('/')[1] - 1, a.value.split('/')[0]);
             var fecha="20/02/2017";
             var fecha_antes=new Date(fecha.split('/')[2], fecha.split('/')[1] - 1, fecha.split('/')[0]);
            if (select>today || select<fecha_antes){
                alerta=alerta+1;
            }
          }else{
            var select=new Date(a.value.split('/')[2], a.value.split('/')[1] - 1, a.value.split('/')[0]);
            var fecha="20/02/2017";
            var fecha_antes=new Date(fecha.split('/')[2], fecha.split('/')[1] - 1, fecha.split('/')[0]);
            if (select<fecha_antes){
                alerta1=alerta1+1;
            }
          }

          if (alerta==3) {
            alert('Debe seleccionar una fecha entre el 20/02/2017 y el día de hoy');
            alerta=0;
            $(a).val('');
          };

          if (alerta1==3) {
            alert('Debe seleccionar una fecha superior al 20/02/2017');
            alerta1=0;
            $(a).val('');
          };
        }


    $("#entidad").change(function(){
        $('#entidad :selected').each(function(i, selected){ 
        if($(selected).text()=='Otro'){
          $("#otro").css("display","block");
          $("#otro_act").prop('required',true);
        }else{
          $("#otro").css("display","none");
          $("#otro_act").prop('required',false);
        }
      }); 
    });

    $('[id^=entidadedi]').change(function(){
      var enti=$(this).attr("id").substr(-7);
       var e=0;
        $('#entidadedi'+$(this).attr("id").substr(-4)+' :selected').each(function(i, selected){ 
          if($(selected).text()=='Otro'){
            e=1;
          }
        }); 
        if(e==1){
          $("#otro"+enti).css("display","block");
            $("#otro_act"+enti).prop('required',true);
          }else{
            $("#otro"+enti).css("display","none");
            $("#otro_act"+enti).prop('required',false);
          }
    });     


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
           $('#label_pobla').css("display","block");
           $('#alcance').prop('required',false);
           $('#alcance2').prop('required',false);
           $('#alcance3').prop('required',true);
           $('#fecha_inicio').prop('required',false);
           $('#fecha_final').prop('required',false);
           $('#fecha_inicio2').prop('required',true);
           $('#fecha_final2').prop('required',true);
           $('#cost_esti').prop('required',false);
           $('#cost_proy').prop('required',true);
           $('#ava_presu').prop('required',true);
           $('#ava_product').prop('required',true);
           $('#long').prop('required',true);
           $('#coorde1').prop('required',true);
           $('#coorde1_fin').prop('required',true);
           
            var ids=$("#nom_terr").val();
            var  text=$('#nom_terr option:selected').text().split(" ");
            $('[id^=pobl-]').remove();
            if ($("#estado").val()=="Ejecución"){//crea imput de poblacion beneficiada cuando se cambia al esatdo ejecucion
                $("#nom_terr option:selected").each(function () {
                  var $this = $(this);
                  var div = document.createElement("div");
                  div.className ="form-group col-sm-4";
                  div.id ="pobl-"+$this.val();
                  var Label = document.createElement("label");
                  Label.innerHTML= "<b>"+$this.text()+"</b>";
                  var input=document.createElement("input");
                  input.setAttribute("type", "number");
                  input.setAttribute("min", "0");
                  input.className ="form-control";
                  input.id=$this.val();
                  input.name="pob_bene_ter[]";
                  input.setAttribute("placeholder","# de población");
                  div.append(Label);
                  div.append(input);
                  document.getElementById("label_pobla").append(div);
                 
                });
            }
        }else if($("#estado").val()==''){
          $('[id^=eje-]').css("display","none");
          $('[id^=est-]').css("display","none");
          $('[id^=inden-]').css("display","none");
          $('[id^=fecha-]').css("display","none");
          $('[id^=cor-]').css("display","none");
          $('#label_pobla').css("display","none");
          $('[id^=pobl-]').remove();
          $('#alcance').prop('required',false);
           $('#alcance2').prop('required',false);
           $('#alcance3').prop('required',false);
           $('#fecha_inicio').prop('required',false);
           $('#fecha_final').prop('required',false);
           $('#fecha_inicio2').prop('required',false);
           $('#fecha_final2').prop('required',false);
           $('#cost_esti').prop('required',false);
           $('#cost_proy').prop('required',false);
           $('#ava_presu').prop('required',false);
           $('#ava_product').prop('required',false);
           $('#long').prop('required',false);
           $('#coorde1').prop('required',false);
           $('#coorde1_fin').prop('required',false);
        }else if ($("#estado").val()=='Identificación'){
           $('#alcance').prop('required',true);
           $('#alcance2').prop('required',false);
           $('#alcance3').prop('required',false);
           $('#fecha_inicio').prop('required',true);
           $('#fecha_final').prop('required',true);
           $('#fecha_inicio2').prop('required',false);
           $('#fecha_final2').prop('required',false);
           $('#cost_esti').prop('required',false);
           $('#cost_proy').prop('required',false);
           $('#ava_presu').prop('required',false);
           $('#ava_product').prop('required',false);
           $('#long').prop('required',false);
           $('#coorde1').prop('required',false);
           $('#coorde1_fin').prop('required',false);

          $('[id^=eje-]').css("display","none");
          $('[id^=est-]').css("display","none");
          $('[id^=inden-]').css("display","block");
          $('[id^=fecha-]').css("display","block");
          $('[id^=cor-]').css("display","none");
          $('#label_pobla').css("display","none");
          $('[id^=pobl-]').remove();
        }else{
           $('#alcance').prop('required',false);
           $('#alcance2').prop('required',true);
           $('#alcance3').prop('required',false);
           $('#fecha_inicio').prop('required',true);
           $('#fecha_final').prop('required',true);
           $('#fecha_inicio2').prop('required',false);
           $('#fecha_final2').prop('required',false);
           $('#cost_esti').prop('required',true);
           $('#cost_proy').prop('required',false);
           $('#ava_presu').prop('required',false);
           $('#ava_product').prop('required',false);
           $('#long').prop('required',false);
           $('#coorde1').prop('required',false);
           $('#coorde1_fin').prop('required',false);

          $('[id^=fecha-]').css("display","block");
          $('[id^=eje-]').css("display","none");
          $('[id^=inden-]').css("display","none");
          $('[id^=est-]').css("display","block");
          $('[id^=cor-]').css("display","none");
          $('#label_pobla').css("display","none");
          $('[id^=pobl-]').remove();
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
              for (var i = 0; i < Object.keys(data['arraynom_terri']).length; i++) {
                  var OPTGROUP=document.createElement("OPTGROUP");//funcion para crear select con agrupacion
                  OPTGROUP.setAttribute("label", data['arratodoterrtipo'][i]);
                $.each(data['arraynom_terri'][i], function(datos,nom){
                    var x = document.createElement("OPTION");
                    x.setAttribute("value",nom);
                    var t = document.createTextNode( datos);
                    x.appendChild(t);
                    OPTGROUP.append(x);
                  });
                 $("#nom_terr").append(OPTGROUP);
              };
               
            },
            error:function(){alert('error');}
        });//Termina Ajax
      }
    }); 

    $("#nom_terr").change(function() {
        var ids=$("#nom_terr").val();
        var  text=$('#nom_terr option:selected').text().split(" ");
        $('[id^=pobl-]').remove();
        $('[id^=tipoterr_comple-]').remove();
        if ($("#estado").val()=="Ejecución"){
            $("#nom_terr option:selected").each(function () {//crea input de poblacion beneficiada cuando se cambian los territorios
              var $this = $(this);
              var div = document.createElement("div");
              div.className ="form-group col-sm-4";
              div.id ="pobl-"+$this.val();
              var Label = document.createElement("label");
              Label.innerHTML= "<b>"+$this.text()+"</b>";
              var input=document.createElement("input");
              input.setAttribute("type", "number");
              input.setAttribute("min", "0");
              input.className ="form-control";
              input.id=$this.val();
              input.name="pob_bene_ter[]";
              input.setAttribute("placeholder","# de población");
              div.append(Label);
              div.append(input);
              document.getElementById("label_pobla").append(div);
              
            });
        }
          $("#nom_terr option:selected").each(function () {
          var $this = $(this);

          var input=document.createElement("input");
          input.setAttribute("type", "hidden");
          input.name="tipoterr_comple[]";
          input.id="tipoterr_comple-"+$this.val();
          if ($(this).parent().attr("label")=="Resguardos indígenas:"){
            input.value=1;
          }else if($(this).parent().attr("label")=="Consejos cumunitarios:"){
            input.value=2;
          }else{
             input.value=3;
          }
          document.getElementById("cargarproy").append(input);
        });
        
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
        val_format=Format.to(Number(val))
        if(val_format==false){
            document.getElementById(e.id).value="";
            alert("Ingrese un valor valido")        
        } else {            
            document.getElementById(e.id).value=val_format;                
        } 
        if (val<=0 ){
          document.getElementById(e.id).value="";
            alert("El valor debe ser mayor a 0") 
        }
        var cos=Number($('#cost_proyedieje').val().replace(/[$ \.]/g, ''));
        var ava=Number($('#ava_presuedieje').val().replace(/[$ \.]/g, ''));


        if (cos < ava){
          document.getElementById(e.id).value="";
            alert("El valor de avance de ejecución no puede ser mayor al costo del proyecto") 
        }

        if (cos>0 && ava>=0){
          var div=ava / cos * 100;
          div=Math.round(div*100)/100;
          $('#avance_presu').html('<b>Avance de ejecución presupuestal ('+div+'%)<font color="red">*</font></b>')
        }else{
          $('#avance_presu').html('<b>Avance de ejecución presupuestal<font color="red">*</font></b>')
        }

    } 

    $("#tramo").change(function() {//funcion que crea n tramos con sus respectivos inputs de linea de trabajo y coordenandas
        $('[id^=tramo-]').remove();
        var opciones=['Seleccione una opción','Mantenimiento períodico','Mantenimiento rutinario','Obras de arte','Placa huella'];
        for (var i = 1; i <= $("#tramo").val(); i++) {//crea input de poblacion beneficiada cuando se cambian los territorios
          //inicio de ciclo para crear los inputs de cada tramo
              var divmayor = document.createElement("div");//div q contiene todos los input de un tramo
                  divmayor.className ="form-group col-sm-12";
                  divmayor.id ="tramo-"+i;
                  var Label = document.createElement("label");
                  Label.innerHTML= "<h4> Tramo "+i+"</h4>";
                  Label.style="margin:0px";
                  Label.className ="text-center text-primary";
                  divmayor.append(Label);
                  divmayor.append(document.createElement('br'));
                  divmayor.append(document.createElement('br'));

              var div = document.createElement("div");//div que contiene el nombre del tramo y la liean del proryecto
                  div.className ="form-group col-sm-6";
                      var Label1 = document.createElement("label");
                      Label1.innerHTML= "<b>Línea de proyecto<font color='red'>*</font></b>";

                      //Create and append select list
                      var selectList = document.createElement("select");//se crea el select con las lineas para el tramo
                      selectList.id = "linea-"+i;
                      selectList.name = "lineas[]";
                      selectList.className ="form-control";
                      selectList.setAttribute("required","true");
                      div.appendChild(selectList);

                      //Create and append the options
                      for (var j = 0; j < opciones.length; j++) {
                          var option = document.createElement("option");
                          if(j==0){
                            option.value = "";
                          }else{
                            option.value = opciones[j];
                          }
                          option.text = opciones[j];
                          selectList.appendChild(option);
                      }
                      
                      div.append(Label1);
                      div.append(selectList);
                      divmayor.append(div);

              var div = document.createElement("div");//div que contiene el nombre del tramo y la liean del proryecto
                  div.className ="form-group col-sm-6";
                      var Label1 = document.createElement("label");
                      Label1.innerHTML= "<b>Longitud del tramo (en Km)<font color='red'>*</font></b>";

                      //Create and append select list
                      var input = document.createElement("input");//se crea el select con las lineas para el tramo
                      input.id = "longitud-"+i;
                      input.name = "longitud[]";
                      input.className ="form-control";
                      input.setAttribute("required","true");
                      div.appendChild(input);

                      div.append(Label1);
                      div.append(input);
                      divmayor.append(div);


              var div = document.createElement("div");//div con el labe de coordenadas iniciales
                  div.className ="form-group col-sm-12";
                  var Label = document.createElement("label");
                  Label.innerHTML= "<b>Coordenadas inicales del tramo "+i+"</b>";

              div.append(Label);
              divmayor.append(div);

                  var divini = document.createElement("div");//espacio que crea el div que contiene los 3 campor de ingreso de grados minutos y segundos de latitud  para las cooredenadas iniciales
                      divini.className ="form-group col-sm-6";
                      var divlable = document.createElement("div");
                          divlable.className ="form-group col-sm-12";
                          divlable.style="margin-bottom:0px";
                          var lablelat = document.createElement("label");
                              lablelat.innerHTML= "<b>Latitud</b>";
                              lablelat.id='Lat_ini'+i;
                          var divGrado = document.createElement("div");//div de grados
                              divGrado.className ="form-group col-sm-3";
                              divGrado.style="padding:1%;";
                              divGrado.innerHTML= "<font size='2', color='#A4A4A4'>Grados</font>";
                              var numberGrado = document.createElement("input");
                                  numberGrado.id='lat_gra_ini'+i;
                                  numberGrado.name='lat_gra_ini[]';
                                  numberGrado.className ="form-control";
                                  numberGrado.setAttribute("type", "number");
                                  numberGrado.addEventListener("change", coorden);
                                  numberGrado.setAttribute("title","Grados");
                          var divmin = document.createElement("div");//div para minutos
                              divmin.className ="form-group col-sm-3";
                              divmin.style="padding:1%;";
                              divmin.innerHTML= "<font size='2', color='#A4A4A4'>Minutos</font>";
                              var numberMin = document.createElement("input");
                                  numberMin.id='lat_min_ini'+i;
                                  numberMin.name='lat_min_ini[]';
                                  numberMin.className ="form-control";
                                  numberMin.setAttribute("type", "number");
                                  numberMin.addEventListener("change", coorden);
                                  numberMin.setAttribute("title","Minutos");
                          var divseg = document.createElement("div");//div para segundos
                              divseg.className ="form-group col-sm-3";
                              divseg.style="padding:1%;";
                              divseg.innerHTML= "<font size='2', color='#A4A4A4'>Segundos</font>";
                              var numberSeg = document.createElement("input");
                                  numberSeg.id='lat_seg_ini'+i;
                                  numberSeg.name='lat_seg_ini[]';
                                  numberSeg.className ="form-control";
                                  numberSeg.setAttribute("type", "number");
                                  numberSeg.addEventListener("change", coorden);
                                  numberSeg.setAttribute("title","Segundos");
                          var divsigno = document.createElement("div");//div de grados
                              divsigno.className ="form-group col-sm-2";
                              divsigno.setAttribute("type", "number");
                              divsigno.style="margin:0px;padding:0px;margin-top: 19px;display:none";
                              divsigno.id="sig_lat_ini"+i;
                              var radio= document.createElement("input");
                                  radio.style="margin:0px;padding:0px";
                                  radio.type = "radio";
                                  radio.name="sig_lat_ini"+i;
                                  radio.id="sig_lat_N_ini"+i;
                                  radio.value='1';
                              var radio2= document.createElement("input");
                                  radio2.style="margin:0px;padding:0px";
                                  radio2.type = "radio";
                                  radio2.name="sig_lat_ini"+i;
                                  radio2.id="sig_lat_S_ini"+i;
                                  radio2.value='-1';
                                  divsigno.append(radio);
                                  divsigno.append("N");
                                  divsigno.append(document.createElement('br'));
                                  divsigno.append(radio2);
                                  divsigno.append("S");

                  divlable.append(lablelat);
                  divini.append(divlable);

                  divini.append(divsigno);

                  divGrado.append(numberGrado);
                  divini.append(divGrado);

                  divmin.append(numberMin);
                  divini.append(divmin);
                  divseg.append(numberSeg);
                  divini.append(divseg);

                  divmayor.append(divini);

                  var divini = document.createElement("div");//espacio que crea el div que contiene los 3 campor de ingreso de grados minutos y segundos de longitud  para las cooredenadas iniciales
                      divini.className ="form-group col-sm-6";
                      var divlable = document.createElement("div");
                          divlable.className ="form-group col-sm-12";
                          divlable.style="margin-bottom:0px";
                          var lablelat = document.createElement("label");
                              lablelat.innerHTML= "<b>Longitud</b>";
                              lablelat.id='Lon_ini'+i;
                          var divGrado = document.createElement("div");//div de grados
                              divGrado.className ="form-group col-sm-3";
                              divGrado.style="padding:1%;";
                              divGrado.innerHTML= "<font size='2', color='#A4A4A4'>Grados</font>";
                              var numberGrado = document.createElement("input");
                                  numberGrado.id='lon_gra_ini'+i;
                                  numberGrado.name='lon_gra_ini[]';
                                  numberGrado.className ="form-control";
                                  numberGrado.setAttribute("type", "number");
                                  numberGrado.addEventListener("change", coorden);
                                  numberGrado.setAttribute("title","Grados");
                          var divmin = document.createElement("div");//div para minutos
                              divmin.className ="form-group col-sm-3";
                              divmin.style="padding:1%;";
                              divmin.innerHTML= "<font size='2', color='#A4A4A4'>Minutos</font>";
                              var numberMin = document.createElement("input");
                                  numberMin.id='lon_min_ini'+i;
                                  numberMin.name='lon_min_ini[]';
                                  numberMin.className ="form-control";
                                  numberMin.setAttribute("type", "number");
                                  numberMin.addEventListener("change", coorden);
                                  numberMin.setAttribute("title","Minutos");
                          var divseg = document.createElement("div");//div para segundos
                              divseg.className ="form-group col-sm-3";
                              divseg.style="padding:1%;";
                              divseg.innerHTML= "<font size='2', color='#A4A4A4'>Segundos</font>";
                              var numberSeg = document.createElement("input");
                                  numberSeg.id='lon_seg_ini'+i;
                                  numberSeg.name='lon_seg_ini[]';
                                  numberSeg.className ="form-control";
                                  numberSeg.setAttribute("type", "number");
                                  numberSeg.addEventListener("change", coorden);
                                  numberSeg.setAttribute("title","Segundos");

                  divlable.append(lablelat);
                  divini.append(divlable);

                  divGrado.append(numberGrado);
                  divini.append(divGrado);

                  divmin.append(numberMin);
                  divini.append(divmin);
                  divseg.append(numberSeg);
                  divini.append(divseg);
                  
                  divmayor.append(divini);

                  var div = document.createElement("div");//div con el labe de coordenadas finales
                  div.className ="form-group col-sm-12";
                  var Label = document.createElement("label");
                  Label.innerHTML= "<b>Coordenadas finales del tramo "+i+"</b>";

                  div.append(Label);
                  divmayor.append(div);

                      var divini = document.createElement("div");//espacio que crea el div que contiene los 3 campor de ingreso de grados minutos y segundos de latitud  para las cooredenadas finales
                          divini.className ="form-group col-sm-6";
                          var divlable = document.createElement("div");
                              divlable.className ="form-group col-sm-12";
                              divlable.style="margin-bottom:0px";
                              var lablelat = document.createElement("label");
                                  lablelat.innerHTML= "<b>Latitud</b>";
                                  lablelat.id='Lat_fin'+i;
                              var divGrado = document.createElement("div");//div de grados
                                  divGrado.className ="form-group col-sm-3";
                                  divGrado.style="padding:1%;";
                                  divGrado.innerHTML= "<font size='2', color='#A4A4A4'>Grados</font>";
                                  var numberGrado = document.createElement("input");
                                      numberGrado.id='lat_gra_fin'+i;
                                      numberGrado.name='lat_gra_fin[]';
                                      numberGrado.className ="form-control";
                                      numberGrado.setAttribute("type", "number");
                                      numberGrado.addEventListener("change", coorden);
                                      numberGrado.setAttribute("title","Grados");
                              var divmin = document.createElement("div");//div para minutos
                                  divmin.className ="form-group col-sm-3";
                                  divmin.style="padding:1%;";
                                  divmin.innerHTML= "<font size='2', color='#A4A4A4'>Minutos</font>";
                                  var numberMin = document.createElement("input");
                                      numberMin.id='lat_min_fin'+i;
                                      numberMin.name='lat_min_fin[]';
                                      numberMin.className ="form-control";
                                      numberMin.setAttribute("type", "number");
                                      numberMin.addEventListener("change", coorden);
                                      numberMin.setAttribute("title","Minutos");
                              var divseg = document.createElement("div");//div para segundos
                                  divseg.className ="form-group col-sm-3";
                                  divseg.style="padding:1%;";
                                  divseg.innerHTML= "<font size='2', color='#A4A4A4'>Segundos</font>";
                                  var numberSeg = document.createElement("input");
                                      numberSeg.id='lat_seg_fin'+i;
                                      numberSeg.name='lat_seg_fin[]';
                                      numberSeg.className ="form-control";
                                      numberSeg.setAttribute("type", "number");
                                      numberSeg.addEventListener("change", coorden);
                                      numberSeg.setAttribute("title","Segundos");
                              var divsigno = document.createElement("div");//div de grados
                                      divsigno.className ="form-group col-sm-2";
                                      divsigno.setAttribute("type", "number");
                                      divsigno.id="sig_lat_fin"+i;
                                      divsigno.style="margin:0px;padding:0px;margin-top: 19px;display:none";
                                      var radio= document.createElement("input");
                                          radio.style="margin:0px;padding:0px";
                                          radio.type = "radio";
                                          radio.name="sig_lat_fin"+i;
                                          radio.id="sig_lat_N_fin"+i;
                                          radio.value='1';
                                      var radio2= document.createElement("input");
                                          radio2.style="margin:0px;padding:0px";
                                          radio2.type = "radio";
                                          radio2.name="sig_lat_fin"+i;
                                          radio2.id="sig_lat_S_fin"+i;
                                          radio2.value='-1';
                                          divsigno.append(radio);
                                          divsigno.append("N");
                                          divsigno.append(document.createElement('br'));
                                          divsigno.append(radio2);
                                          divsigno.append("S");

                      divlable.append(lablelat);
                      divini.append(divlable);

                      divini.append(divsigno);

                      divGrado.append(numberGrado);
                      divini.append(divGrado);

                      divmin.append(numberMin);
                      divini.append(divmin);
                      divseg.append(numberSeg);
                      divini.append(divseg);

                      divmayor.append(divini);

                      var divini = document.createElement("div");//espacio que crea el div que contiene los 3 campor de ingreso de grados minutos y segundos de longitud  para las cooredenadas finales
                          divini.className ="form-group col-sm-6";
                          var divlable = document.createElement("div");
                              divlable.className ="form-group col-sm-12";
                              divlable.style="margin-bottom:0px";
                              var lablelat = document.createElement("label");
                                  lablelat.innerHTML= "<b>Longitud</b>";
                                  lablelat.id='Lon_fin'+i;
                              var divGrado = document.createElement("div");//div de grados
                                  divGrado.className ="form-group col-sm-3";
                                  divGrado.style="padding:1%;";
                                  divGrado.innerHTML= "<font size='2', color='#A4A4A4'>Grados</font>";
                                  var numberGrado = document.createElement("input");
                                      numberGrado.id='lon_gra_fin'+i;
                                      numberGrado.name='lon_gra_fin[]';
                                      numberGrado.className ="form-control";
                                      numberGrado.setAttribute("type", "number");
                                      numberGrado.addEventListener("change", coorden);
                                      numberGrado.setAttribute("title","Grados");
                              var divmin = document.createElement("div");//div para minutos
                                  divmin.className ="form-group col-sm-3";
                                  divmin.style="padding:1%;";
                                  divmin.innerHTML= "<font size='2', color='#A4A4A4'>Minutos</font>";
                                  var numberMin = document.createElement("input");
                                      numberMin.id='lon_min_fin'+i;
                                      numberMin.name='lon_min_fin[]';
                                      numberMin.className ="form-control";
                                      numberMin.setAttribute("type", "number");
                                      numberMin.addEventListener("change", coorden);
                                      numberMin.setAttribute("title","Minutos");
                              var divseg = document.createElement("div");//div para segundos
                                  divseg.className ="form-group col-sm-3";
                                  divseg.style="padding:1%;";
                                  divseg.innerHTML= "<font size='2', color='#A4A4A4'>Segundos</font>";
                                  var numberSeg = document.createElement("input");
                                      numberSeg.id='lon_seg_fin'+i;
                                      numberSeg.name='lon_seg_fin[]';
                                      numberSeg.className ="form-control";
                                      numberSeg.setAttribute("type", "number");
                                      numberSeg.addEventListener("change", coorden);
                                      numberSeg.setAttribute("title","Segundos");

                      divlable.append(lablelat);
                      divini.append(divlable);

                      divGrado.append(numberGrado);
                      divini.append(divGrado);

                      divmin.append(numberMin);
                      divini.append(divmin);
                      divseg.append(numberSeg);
                      divini.append(divseg);
                      
                      divmayor.append(divini);
                  var divhr = document.createElement("div");
                      divhr.className ="form-group col-sm-12";
                  var hr= document.createElement("HR");
                  divhr.append(hr);
                  divmayor.append(divhr);

              document.getElementById("tramos").append(divmayor);//se unen todos los input al div mayor del tramo

                           



        }
    }); 



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
                  //console.log(data)
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
                    var arrayenti = [];
                    var otro=0;
                    $.each(data['entidades'], function(nom,datos){
                      if(datos['Identificación']){
                         arrayenti.push(datos['Identificación']);
                         if(datos['Identificación']=='Otro'){
                          otro=1;
                         }
                       }
                    });
                    $('#entidadediiden').val(arrayenti);
                    if (otro==1){
                      $('#otro_actediiden').val(data['arrayproy'][0].otro_iden);
                      $("#otroediiden").css("display","block");
                      $('#otro_actediiden').prop('required',true);
                    }

                    $.each(data['entidades'], function(nom,datos){
                      if(datos['Estructuración']){
                         arrayenti.push(datos['Estructuración']);
                         if(datos['Estructuración']=='Otro'){
                          otro=1;
                         }
                       }
                    });
                    $('#entidadediestr').val(arrayenti);

                    $("#nom_terrediiden").empty();
                    for (var i = 0; i < Object.keys(data['arratodoterredi']).length; i++) {
                      var OPTGROUP=document.createElement("OPTGROUP");
                      OPTGROUP.setAttribute("label", data['arratodoterrtipoedi'][i]);
                      if (data['arratodoterrtipoedi'][i]=="Resguardos indígenas:"){
                        OPTGROUP.id='1-ide';
                      }else if(data['arratodoterrtipoedi'][i]=="Consejos cumunitarios:"){
                        OPTGROUP.id='2-ide';
                      }else if(data['arratodoterrtipoedi'][i]=="Veredas:"){
                         OPTGROUP.id='3-ide';
                      }

                      $.each(data['arratodoterredi'][i], function(datos,nom){
                          var x = document.createElement("OPTION");
                          x.setAttribute("value", datos);
                          var t = document.createTextNode(nom);
                          x.appendChild(t);
                          OPTGROUP.append(x);
                        });
                     $("#nom_terrediiden").append(OPTGROUP);
                   }

                    var nameterr = [];
                    if(data['arraynomter']!=""){
                      $.each(data['arraynomter'], function(datos){
                           if (data['arraynomter'][datos]["tipo_terr"]==1){
                              $('#1-ide option[value='+data['arraynomter'][datos]["id_terr"]+']').prop('selected', true);
                           }else if(data['arraynomter'][datos]["tipo_terr"]==2){
                              $('#2-ide option[value='+data['arraynomter'][datos]["id_terr"]+']').prop('selected', true);
                           }else if(data['arraynomter'][datos]["tipo_terr"]==3){
                              $('#3-ide option[value='+data['arraynomter'][datos]["id_terr"]+']').prop('selected', true);
                           }
                      });
                    }


                    $("#nom_terrediiden option:selected").each(function () {
                        var $this = $(this);
                        var input=document.createElement("input");
                        input.setAttribute("type", "hidden");
                        input.name="tipoterredi_comple[]";
                        input.id="tipoterredi_comple-"+$this.val();
                        if ($(this).parent().attr("label")=="Resguardos indígenas:"){
                          input.value=1;
                        }else if($(this).parent().attr("label")=="Consejos cumunitarios:"){
                          input.value=2;
                        }else{
                           input.value=3;
                        }
                        document.getElementById('edi-form-iden').append(input);
                      });

                    $('#lineaediiden').val(data['arrayproy'][0].linea_proy);
                    $('#nombreediiden').val(data['arrayproy'][0].nom_proy);
                    $('#estadoediiden').val(data['arrayproy'][0].est_proy);
                    $('#alcanceediiden').val(data['arrayproy'][0].alcance);
                    $('#fecha_inicioediiden').val(data['arrayproy'][0].fecha_iden);



                    if( data['arrayproy'][0].doc_iden==""||  data['arrayproy'][0].doc_iden==null){
                          $('#docediiden').attr('disabled', true);
                          $('#docediiden').removeClass().addClass('glyphicon glyphicon-download-alt btn btn-default ');
                          $('#docediiden').attr("title", "No hay documento cargado");
                          $('#docediiden').removeAttr("href");
                          $('#docediiden').removeAttr("target");
                        }else{
                         $('#docediiden').attr("href", data['arrayproy'][0].doc_iden);
                         $('#docediiden').removeClass().addClass('glyphicon glyphicon-download-alt btn btn-success ');
                         $('#docediiden').attr("target", "_blank");
                         $('#docedi').attr('disabled', false);
                         $('#docradio2ide').attr('checked', 'checked');
                        }
                    

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
                      var OPTGROUP=document.createElement("OPTGROUP");
                      OPTGROUP.setAttribute("label", data['arratodoterrtipoedi'][i]);
                      if (data['arratodoterrtipoedi'][i]=="Resguardos indígenas:"){
                        OPTGROUP.id='1-est';
                      }else if(data['arratodoterrtipoedi'][i]=="Consejos cumunitarios:"){
                        OPTGROUP.id='2-est';
                      }else if(data['arratodoterrtipoedi'][i]=="Veredas:"){
                         OPTGROUP.id='3-est';
                      }
                      $.each(data['arratodoterredi'][i], function(datos,nom){
                          var x = document.createElement("OPTION");
                          x.setAttribute("value", datos);
                          var t = document.createTextNode(nom);
                          x.appendChild(t);
                          OPTGROUP.append(x);
                        });
                     $("#nom_terrediestr").append(OPTGROUP);
                   }

                    
                    var nameterr = [];
                    if(data['arraynomter']!=""){
                      $.each(data['arraynomter'], function(datos){
                           if (data['arraynomter'][datos]["tipo_terr"]==1){
                              $('#1-est option[value='+data['arraynomter'][datos]["id_terr"]+']').prop('selected', true);
                           }else if(data['arraynomter'][datos]["tipo_terr"]==2){
                              $('#2-est option[value='+data['arraynomter'][datos]["id_terr"]+']').prop('selected', true);
                           }else if(data['arraynomter'][datos]["tipo_terr"]==3){
                              $('#3-est option[value='+data['arraynomter'][datos]["id_terr"]+']').prop('selected', true);
                           }
                      });
                    }
                    $("#nom_terrediestr option:selected").each(function () {
                        var $this = $(this);
                        var input=document.createElement("input");
                        input.setAttribute("type", "hidden");
                        input.name="tipoterredi_comple[]";
                        input.id="tipoterredi_comple-"+$this.val();
                        if ($(this).parent().attr("label")=="Resguardos indígenas:"){
                          input.value=1;
                        }else if($(this).parent().attr("label")=="Consejos cumunitarios:"){
                          input.value=2;
                        }else{
                           input.value=3;
                        }
                        document.getElementById('edi-form-estr').append(input);
                      });
                    var arrayenti = [];
                    var otro=0;
                    $.each(data['entidades'], function(nom,datos){
                      if(datos['Estructuración']){
                         arrayenti.push(datos['Estructuración']);
                         if(datos['Estructuración']=='Otro'){
                          otro=1;
                         }
                       }
                    });
                    $('#entidadediestr').val(arrayenti);

                    if (otro==1){
                      $('#otro_actediestr').val(data['arrayproy'][0].otro_estr);
                      $("#otroediestr").css("display","block");
                      $('#otro_actediestr').prop('required',true);
                    }

                    $('#lineaediestr').val(data['arrayproy'][0].linea_proy);
                    $('#nombreediestr').val(data['arrayproy'][0].nom_proy_2);
                    $('#estadoediestr').val(data['arrayproy'][0].est_proy);
                    $('#alcanceediestr').val(data['arrayproy'][0].alcance_2);
                    $('#fecha_inicioediestr').val(data['arrayproy'][0].fecha_estr);
                    $('#cost_proyediestr').val(Format.to(Number(data['arrayproy'][0].costo_estim)));
                    if( data['arrayproy'][0].doc_estr==""||  data['arrayproy'][0].doc_estr==null){
                          $('#docediestr').attr('disabled', true);
                          $('#docediestr').removeClass().addClass('glyphicon glyphicon-download-alt btn btn-default ');
                          $('#docediestr').attr("title", "No hay documento cargado");
                          $('#docediestr').removeAttr("href");
                          $('#docediestr').removeAttr("target");
                        }else{
                         $('#docediestr').attr("href", data['arrayproy'][0].doc_iden);
                         $('#docediestr').removeClass().addClass('glyphicon glyphicon-download-alt btn btn-success ');
                         $('#docediestr').attr("target", "_blank");
                         $('#docediestr').attr('disabled', false);
                         $('#docradio2est').attr('checked', 'checked');
                        }
                    
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
                      var OPTGROUP=document.createElement("OPTGROUP");
                      OPTGROUP.setAttribute("label", data['arratodoterrtipoedi'][i]);
                      if (data['arratodoterrtipoedi'][i]=="Resguardos indígenas:"){
                        OPTGROUP.id='1-eje';
                      }else if(data['arratodoterrtipoedi'][i]=="Consejos cumunitarios:"){
                        OPTGROUP.id='2-eje';
                      }else if(data['arratodoterrtipoedi'][i]=="Veredas:"){
                         OPTGROUP.id='3-eje';
                      }
                      $.each(data['arratodoterredi'][i], function(datos,nom){
                          var x = document.createElement("OPTION");
                          x.setAttribute("value", datos);
                          var t = document.createTextNode(nom);
                          x.appendChild(t);
                          OPTGROUP.append(x);
                        });
                     $("#nom_terredieje").append(OPTGROUP);
                   }
                    
                    var nameterr = [];
                     if(data['arraynomter']!=""){
                      $.each(data['arraynomter'], function(datos){
                           if (data['arraynomter'][datos]["tipo_terr"]==1){
                              $('#1-eje option[value='+data['arraynomter'][datos]["id_terr"]+']').prop('selected', true);
                           }else if(data['arraynomter'][datos]["tipo_terr"]==2){
                              $('#2-eje option[value='+data['arraynomter'][datos]["id_terr"]+']').prop('selected', true);
                           }else if(data['arraynomter'][datos]["tipo_terr"]==3){
                              $('#3-eje option[value='+data['arraynomter'][datos]["id_terr"]+']').prop('selected', true);
                           }
                      });
                    }
                    $("#nom_terredieje option:selected").each(function () {
                        var $this = $(this);
                        var input=document.createElement("input");
                        input.setAttribute("type", "hidden");
                        input.name="tipoterredi_comple[]";
                        input.id="tipoterredi_comple-"+$this.val();
                        if ($(this).parent().attr("label")=="Resguardos indígenas:"){
                          input.value=1;
                        }else if($(this).parent().attr("label")=="Consejos cumunitarios:"){
                          input.value=2;
                        }else{
                           input.value=3;
                        }
                        document.getElementById('edi-form-eje').append(input);
                      });
                    //$('#nom_terredieje').val(nameterr);
                    $('#lineaedieje').val(data['arrayproy'][0].linea_proy);
                    $('#nombreedieje').val(data['arrayproy'][0].nom_proy_3);
                    $('#estadoedieje').val(data['arrayproy'][0].est_proy);
                    $('#alcanceedieje').val(data['arrayproy'][0].alcance_3);
                    $('#ava_presuedieje').val(Format.to(Number(data['arrayproy'][0].avance_pres)));
                    $('#ava_productedieje').val(data['arrayproy'][0].avance_prod);
                    $('#longedieje').val(data['arrayproy'][0].longitud);
                    $('#pob_beneedieje').val(data['arrayproy'][0].pob_bene);
                    $('#fecha_inicio2edieje').val(data['arrayproy'][0].Fec_eje_ini);
                    $('#fecha_final2edieje').val(data['arrayproy'][0].Fec_eje_fin);
                    $('#cost_proyedieje').val(Format.to(Number(data['arrayproy'][0].costo_ejec)));
                    $('#tramo').val(data['tramos'].length);  
                    var div=data['arrayproy'][0].avance_pres / data['arrayproy'][0].costo_ejec * 100;
                    div=Math.round(div*100)/100;
                    $('#avance_presu').html('<b>Avance de ejecución presupuestal ('+div+'%)<font color="red">*</font></b>')

                    $("#deletedocediejec").attr('name', num);
                    $("#deletedocediiden").attr('name', num);
                    $("#deletedocediestr").attr('name', num);
                    if( data['arrayproy'][0].doc_ejec==""||  data['arrayproy'][0].doc_ejec==null){
                          $('#docediejec').attr('disabled', true);
                          $('#docediejec').removeClass().addClass('glyphicon glyphicon-download-alt btn btn-default ');
                          $('#docediejec').attr("title", "No hay documento cargado");
                          $('#docediejec').removeAttr("href");
                          $('#docediejec').removeAttr("target");
                        }else{
                         $('#docediejec').attr("href", data['arrayproy'][0].doc_iden);
                         $('#docediejec').removeClass().addClass('glyphicon glyphicon-download-alt btn btn-success ');
                         $('#docediejec').attr("target", "_blank");
                         $('#docediejec').attr('disabled', false);
                         $('#docradio2eje').attr('checked', 'checked');
                        }
                    var arrayenti = [];
                    var otro=0;
                    $.each(data['entidades'], function(nom,datos){
                      if(datos['Ejecución']){
                         arrayenti.push(datos['Ejecución']);
                         if(datos['Ejecución']=='Otro'){
                          otro=1;
                         }
                       }
                    });

                    if (otro==1){
                      $('#otro_actediejec').val(data['arrayproy'][0].otro_ejec);
                      $("#otroediejec").css("display","block");
                      $('#otro_actediejec').prop('required',true);
                    }
                    $('#entidadediejec').val(arrayenti);

                    vari=" %";
                         handlesSlider3.noUiSlider.updateOptions({
                            start:[data['arrayproy'][0].avance_prod],
                            format: wNumb({
                              decimals: 0,
                              postfix:vari
                            }),
                            range: {
                              'min': [  0 ],
                              'max': [ 100 ]
                          }
                        });
                    var input1 = document.getElementById('ava_productedieje');
          
                        handlesSlider3.noUiSlider.on('update', function( values, handle ) {
                            input1.value = values[handle];
                        });

                    if (data['arrayproy'][0].coord_ini){
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
                               var g2=Math.trunc(-1*coor_ini[i]);
                               var m2=Math.trunc((parseFloat(-1*coor_ini[i])-parseInt(g2))*60);
                               var s2=Math.round(((Math.abs((parseFloat(-1*coor_ini[i])-parseInt(g2))*60)-m2)*60)* 100) / 100;
                                $('#long_gra_iniedieje').val(-1*g2);
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
                           }else{
                              $("#coorde2edieje").attr('checked', 'checked');
                            }
                         };
                      }


                    if (data['arrayproy'][0].coord_fin){  
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

                                 var g2=Math.trunc(-1*coor_fin[i]);
                                 var m2=Math.trunc((parseFloat(-1*coor_fin[i])-parseInt(g2))*60);
                                 var s2=Math.round(((Math.abs((parseFloat(-1*coor_fin[i])-parseInt(g2))*60)-m2)*60)* 100) / 100;
                                  $('#long_gra_finedieje').val(-1*g2);
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
                         }else{
                          $("#coorde2_finedieje").attr('checked', 'checked');
                         }
                       };
                    }


                    //carga la población por cada territorio seleccionado
                     $('[id^=pobl-]').remove();
                     $('[id^=tipoterr_comple-]').remove();

                     $("#nom_terredieje option:selected").each(function () {
                      var $this = $(this);
                      var div = document.createElement("div");
                      div.className ="form-group col-sm-4";
                      div.id ="pobl-"+$this.val();
                      var Label = document.createElement("label");
                      Label.innerHTML= "<b>"+$this.text()+"</b>";
                      var input=document.createElement("input");
                      input.setAttribute("type", "number");
                      input.setAttribute("min", "0");
                      input.className ="form-control";
                      input.id=$this.val();
                      $.each(data['arraynomter'], function(datos){
                          if ($this.val()==data['arraynomter'][datos]["id_terr"]){
                           
                            input.value=data['arraynomter'][datos]["pobla"];
                          }
                      });
                      input.name="pob_bene_ter[]";
                      input.setAttribute("placeholder","# de población");
                      div.append(Label);
                      div.append(input);
                      document.getElementById("label_pobla-eje").append(div);
                      var input=document.createElement("input");
                      input.setAttribute("type", "hidden");
                      input.name="tipoterr_comple[]";
                      input.id="tipoterr_comple-"+$this.val();
                      if ($(this).parent().attr("label")=="Resguardos indígenas:"){
                        input.value=1;
                      }else if($(this).parent().attr("label")=="Consejos cumunitarios:"){
                        input.value=2;
                      }else{
                         input.value=3;
                      }
                      document.getElementById("label_pobla-eje").append(input);
                    });

                    
                    //carga la infromacion para cada tramo
                      $('[id^=tramo-]').remove();
                      for (var i = 1; i <= data['tramos'].length; i++) {
                        //inicio de ciclo para crear los inputs de cada tramo
                        var opciones=['Seleccione una opción','Mantenimiento períodico','Mantenimiento rutinario','Obras de arte','Placa huella'];
                          var divmayor = document.createElement("div");//div q contiene todos los input de un tramo
                              divmayor.className ="form-group col-sm-12";
                              divmayor.id ="tramo-"+i;
                              var Label = document.createElement("label");
                              Label.innerHTML= "<h4> Tramo "+i+"</h4>";
                              Label.style="margin:0px";
                              Label.className ="text-center text-primary";
                              divmayor.append(Label);
                              divmayor.append(document.createElement('br'));
                              divmayor.append(document.createElement('br'));

                          var div = document.createElement("div");//div que contiene el nombre del tramo y la liean del proryecto
                              div.className ="form-group col-sm-6";
                                  var Label1 = document.createElement("label");
                                  Label1.innerHTML= "<b>Línea de proyecto<font color='red'>*</font></b>";

                                  //Create and append select list
                                  var selectList = document.createElement("select");//se crea el select con las lineas para el tramo
                                  selectList.id = "linea-"+i;
                                  selectList.name = "lineas[]";
                                  selectList.className ="form-control";
                                  selectList.setAttribute("required","true");
                                  div.appendChild(selectList);

                                  //Create and append the options
                                  for (var j = 0; j < opciones.length; j++) {
                                      var option = document.createElement("option");
                                      if(j==0){
                                        option.value = "";
                                      }else{
                                        option.value = opciones[j];
                                      }
                                      option.text = opciones[j];
                                      selectList.appendChild(option);
                                  }
                                  
                                  div.append(Label1);
                                  div.append(selectList);
                                  divmayor.append(div);

                          var div = document.createElement("div");//div que contiene el nombre del tramo y la liean del proryecto
                              div.className ="form-group col-sm-6";
                                  var Label1 = document.createElement("label");
                                  Label1.innerHTML= "<b>Longitud del tramo (en Km)<font color='red'>*</font></b>";

                                  //Create and append select list
                                  var input = document.createElement("input");//se crea el select con las lineas para el tramo
                                  input.id = "longitud-"+i;
                                  input.name = "longitud[]";
                                  input.className ="form-control";
                                  input.setAttribute("required","true");
                                  div.appendChild(input);

                                  div.append(Label1);
                                  div.append(input);
                                  divmayor.append(div);


                          var div = document.createElement("div");//div con el labe de coordenadas iniciales
                              div.className ="form-group col-sm-12";
                              var Label = document.createElement("label");
                              Label.innerHTML= "<b>Coordenadas inicales del tramo "+i+"</b>";

                          div.append(Label);
                          divmayor.append(div);

                              var divini = document.createElement("div");//espacio que crea el div que contiene los 3 campor de ingreso de grados minutos y segundos de latitud  para las cooredenadas iniciales
                                  divini.className ="form-group col-sm-6";
                                  var divlable = document.createElement("div");
                                      divlable.className ="form-group col-sm-12";
                                      divlable.style="margin-bottom:0px";
                                      var lablelat = document.createElement("label");
                                          lablelat.innerHTML= "<b>Latitud</b>";
                                          lablelat.id='Lat_ini'+i;
                                      var divGrado = document.createElement("div");//div de grados
                                          divGrado.className ="form-group col-sm-3";
                                          divGrado.style="padding:1%;";
                                          divGrado.innerHTML= "<font size='2', color='#A4A4A4'>Grados</font>";
                                          var numberGrado = document.createElement("input");
                                              numberGrado.id='lat_gra_ini'+i;
                                              numberGrado.name='lat_gra_ini[]';
                                              numberGrado.className ="form-control";
                                              numberGrado.setAttribute("type", "number");
                                              numberGrado.addEventListener("change", coorden);
                                              numberGrado.setAttribute("title","Grados");
                                      var divmin = document.createElement("div");//div para minutos
                                          divmin.className ="form-group col-sm-3";
                                          divmin.style="padding:1%;";
                                          divmin.innerHTML= "<font size='2', color='#A4A4A4'>Minutos</font>";
                                          var numberMin = document.createElement("input");
                                              numberMin.id='lat_min_ini'+i;
                                              numberMin.name='lat_min_ini[]';
                                              numberMin.className ="form-control";
                                              numberMin.setAttribute("type", "number");
                                              numberMin.addEventListener("change", coorden);
                                              numberMin.setAttribute("title","Minutos");
                                      var divseg = document.createElement("div");//div para segundos
                                          divseg.className ="form-group col-sm-3";
                                          divseg.style="padding:1%;";
                                          divseg.innerHTML= "<font size='2', color='#A4A4A4'>Segundos</font>";
                                          var numberSeg = document.createElement("input");
                                              numberSeg.id='lat_seg_ini'+i;
                                              numberSeg.name='lat_seg_ini[]';
                                              numberSeg.className ="form-control";
                                              numberSeg.setAttribute("type", "number");
                                              numberSeg.addEventListener("change", coorden);
                                              numberSeg.setAttribute("title","Segundos");
                                      var divsigno = document.createElement("div");//div de grados
                                          divsigno.className ="form-group col-sm-2";
                                          divsigno.setAttribute("type", "number");
                                          divsigno.style="margin:0px;padding:0px;margin-top: 19px;display:none";
                                          divsigno.id="sig_lat_ini"+i;
                                          var radio= document.createElement("input");
                                              radio.style="margin:0px;padding:0px";
                                              radio.type = "radio";
                                              radio.name="sig_lat_ini"+i;
                                              radio.id="sig_lat_N_ini"+i;
                                              radio.value='1';
                                          var radio2= document.createElement("input");
                                              radio2.style="margin:0px;padding:0px";
                                              radio2.type = "radio";
                                              radio2.name="sig_lat_ini"+i;
                                              radio2.id="sig_lat_S_ini"+i;
                                              radio2.value='-1';
                                              divsigno.append(radio);
                                              divsigno.append("N");
                                              divsigno.append(document.createElement('br'));
                                              divsigno.append(radio2);
                                              divsigno.append("S");

                              divlable.append(lablelat);
                              divini.append(divlable);

                              divini.append(divsigno);

                              divGrado.append(numberGrado);
                              divini.append(divGrado);

                              divmin.append(numberMin);
                              divini.append(divmin);
                              divseg.append(numberSeg);
                              divini.append(divseg);

                              divmayor.append(divini);

                              var divini = document.createElement("div");//espacio que crea el div que contiene los 3 campor de ingreso de grados minutos y segundos de longitud  para las cooredenadas iniciales
                                  divini.className ="form-group col-sm-6";
                                  var divlable = document.createElement("div");
                                      divlable.className ="form-group col-sm-12";
                                      divlable.style="margin-bottom:0px";
                                      var lablelat = document.createElement("label");
                                          lablelat.innerHTML= "<b>Longitud</b>";
                                          lablelat.id='Lon_ini'+i;
                                      var divGrado = document.createElement("div");//div de grados
                                          divGrado.className ="form-group col-sm-3";
                                          divGrado.style="padding:1%;";
                                          divGrado.innerHTML= "<font size='2', color='#A4A4A4'>Grados</font>";
                                          var numberGrado = document.createElement("input");
                                              numberGrado.id='lon_gra_ini'+i;
                                              numberGrado.name='lon_gra_ini[]';
                                              numberGrado.className ="form-control";
                                              numberGrado.setAttribute("type", "number");
                                              numberGrado.addEventListener("change", coorden);
                                              numberGrado.setAttribute("title","Grados");
                                      var divmin = document.createElement("div");//div para minutos
                                          divmin.className ="form-group col-sm-3";
                                          divmin.style="padding:1%;";
                                          divmin.innerHTML= "<font size='2', color='#A4A4A4'>Minutos</font>";
                                          var numberMin = document.createElement("input");
                                              numberMin.id='lon_min_ini'+i;
                                              numberMin.name='lon_min_ini[]';
                                              numberMin.className ="form-control";
                                              numberMin.setAttribute("type", "number");
                                              numberMin.addEventListener("change", coorden);
                                              numberMin.setAttribute("title","Minutos");
                                      var divseg = document.createElement("div");//div para segundos
                                          divseg.className ="form-group col-sm-3";
                                          divseg.style="padding:1%;";
                                          divseg.innerHTML= "<font size='2', color='#A4A4A4'>Segundos</font>";
                                          var numberSeg = document.createElement("input");
                                              numberSeg.id='lon_seg_ini'+i;
                                              numberSeg.name='lon_seg_ini[]';
                                              numberSeg.className ="form-control";
                                              numberSeg.setAttribute("type", "number");
                                              numberSeg.addEventListener("change", coorden);
                                              numberSeg.setAttribute("title","Segundos");

                              divlable.append(lablelat);
                              divini.append(divlable);

                              divGrado.append(numberGrado);
                              divini.append(divGrado);

                              divmin.append(numberMin);
                              divini.append(divmin);
                              divseg.append(numberSeg);
                              divini.append(divseg);
                              
                              divmayor.append(divini);

                              var div = document.createElement("div");//div con el labe de coordenadas finales
                              div.className ="form-group col-sm-12";
                              var Label = document.createElement("label");
                              Label.innerHTML= "<b>Coordenadas finales del tramo "+i+"</b>";

                              div.append(Label);
                              divmayor.append(div);

                                  var divini = document.createElement("div");//espacio que crea el div que contiene los 3 campor de ingreso de grados minutos y segundos de latitud  para las cooredenadas finales
                                      divini.className ="form-group col-sm-6";
                                      var divlable = document.createElement("div");
                                          divlable.className ="form-group col-sm-12";
                                          divlable.style="margin-bottom:0px";
                                          var lablelat = document.createElement("label");
                                              lablelat.innerHTML= "<b>Latitud</b>";
                                              lablelat.id='Lat_fin'+i;
                                          var divGrado = document.createElement("div");//div de grados
                                              divGrado.className ="form-group col-sm-3";
                                              divGrado.style="padding:1%;";
                                              divGrado.innerHTML= "<font size='2', color='#A4A4A4'>Grados</font>";
                                              var numberGrado = document.createElement("input");
                                                  numberGrado.id='lat_gra_fin'+i;
                                                  numberGrado.name='lat_gra_fin[]';
                                                  numberGrado.className ="form-control";
                                                  numberGrado.setAttribute("type", "number");
                                                  numberGrado.addEventListener("change", coorden);
                                                  numberGrado.setAttribute("title","Grados");
                                          var divmin = document.createElement("div");//div para minutos
                                              divmin.className ="form-group col-sm-3";
                                              divmin.style="padding:1%;";
                                              divmin.innerHTML= "<font size='2', color='#A4A4A4'>Minutos</font>";
                                              var numberMin = document.createElement("input");
                                                  numberMin.id='lat_min_fin'+i;
                                                  numberMin.name='lat_min_fin[]';
                                                  numberMin.className ="form-control";
                                                  numberMin.setAttribute("type", "number");
                                                  numberMin.addEventListener("change", coorden);
                                                  numberMin.setAttribute("title","Minutos");
                                          var divseg = document.createElement("div");//div para segundos
                                              divseg.className ="form-group col-sm-3";
                                              divseg.style="padding:1%;";
                                              divseg.innerHTML= "<font size='2', color='#A4A4A4'>Segundos</font>";
                                              var numberSeg = document.createElement("input");
                                                  numberSeg.id='lat_seg_fin'+i;
                                                  numberSeg.name='lat_seg_fin[]';
                                                  numberSeg.className ="form-control";
                                                  numberSeg.setAttribute("type", "number");
                                                  numberSeg.addEventListener("change", coorden);
                                                  numberSeg.setAttribute("title","Segundos");
                                          var divsigno = document.createElement("div");//div de grados
                                                  divsigno.className ="form-group col-sm-2";
                                                  divsigno.setAttribute("type", "number");
                                                  divsigno.id="sig_lat_fin"+i;
                                                  divsigno.style="margin:0px;padding:0px;margin-top: 19px;display:none";
                                                  var radio= document.createElement("input");
                                                      radio.style="margin:0px;padding:0px";
                                                      radio.type = "radio";
                                                      radio.name="sig_lat_fin"+i;
                                                      radio.id="sig_lat_N_fin"+i;
                                                      radio.value='1';
                                                  var radio2= document.createElement("input");
                                                      radio2.style="margin:0px;padding:0px";
                                                      radio2.type = "radio";
                                                      radio2.name="sig_lat_fin"+i;
                                                      radio2.id="sig_lat_S_fin"+i;
                                                      radio2.value='-1';
                                                      divsigno.append(radio);
                                                      divsigno.append("N");
                                                      divsigno.append(document.createElement('br'));
                                                      divsigno.append(radio2);
                                                      divsigno.append("S");

                                  divlable.append(lablelat);
                                  divini.append(divlable);

                                  divini.append(divsigno);

                                  divGrado.append(numberGrado);
                                  divini.append(divGrado);

                                  divmin.append(numberMin);
                                  divini.append(divmin);
                                  divseg.append(numberSeg);
                                  divini.append(divseg);

                                  divmayor.append(divini);

                                  var divini = document.createElement("div");//espacio que crea el div que contiene los 3 campor de ingreso de grados minutos y segundos de longitud  para las cooredenadas finales
                                      divini.className ="form-group col-sm-6";
                                      var divlable = document.createElement("div");
                                          divlable.className ="form-group col-sm-12";
                                          divlable.style="margin-bottom:0px";
                                          var lablelat = document.createElement("label");
                                              lablelat.innerHTML= "<b>Longitud</b>";
                                              lablelat.id='Lon_fin'+i;
                                          var divGrado = document.createElement("div");//div de grados
                                              divGrado.className ="form-group col-sm-3";
                                              divGrado.style="padding:1%;";
                                              divGrado.innerHTML= "<font size='2', color='#A4A4A4'>Grados</font>";
                                              var numberGrado = document.createElement("input");
                                                  numberGrado.id='lon_gra_fin'+i;
                                                  numberGrado.name='lon_gra_fin[]';
                                                  numberGrado.className ="form-control";
                                                  numberGrado.setAttribute("type", "number");
                                                  numberGrado.addEventListener("change", coorden);
                                                  numberGrado.setAttribute("title","Grados");
                                          var divmin = document.createElement("div");//div para minutos
                                              divmin.className ="form-group col-sm-3";
                                              divmin.style="padding:1%;";
                                              divmin.innerHTML= "<font size='2', color='#A4A4A4'>Minutos</font>";
                                              var numberMin = document.createElement("input");
                                                  numberMin.id='lon_min_fin'+i;
                                                  numberMin.name='lon_min_fin[]';
                                                  numberMin.className ="form-control";
                                                  numberMin.setAttribute("type", "number");
                                                  numberMin.addEventListener("change", coorden);
                                                  numberMin.setAttribute("title","Minutos");
                                          var divseg = document.createElement("div");//div para segundos
                                              divseg.className ="form-group col-sm-3";
                                              divseg.style="padding:1%;";
                                              divseg.innerHTML= "<font size='2', color='#A4A4A4'>Segundos</font>";
                                              var numberSeg = document.createElement("input");
                                                  numberSeg.id='lon_seg_fin'+i;
                                                  numberSeg.name='lon_seg_fin[]';
                                                  numberSeg.className ="form-control";
                                                  numberSeg.setAttribute("type", "number");
                                                  numberSeg.addEventListener("change", coorden);
                                                  numberSeg.setAttribute("title","Segundos");

                                  divlable.append(lablelat);
                                  divini.append(divlable);

                                  divGrado.append(numberGrado);
                                  divini.append(divGrado);

                                  divmin.append(numberMin);
                                  divini.append(divmin);
                                  divseg.append(numberSeg);
                                  divini.append(divseg);
                                  
                                  divmayor.append(divini);
                                  var divhr = document.createElement("div");
                                      divhr.className ="form-group col-sm-12";
                                  var hr= document.createElement("HR");
                                  divhr.append(hr);
                                  divmayor.append(divhr);
                              document.getElementById("tramos").append(divmayor);//se unen todos los input al div mayor del tramo
                              //fin del ciclo para crear los inputs de cada tramo

                              //se llenan los campos con los datos que se encuentarn en la base de datos
                              $("#mapid").css("display","none");
                              $('#linea-'+i).val(data['tramos'][i-1]['linea']);
                              $('#longitud-'+i).val(data['tramos'][i-1]['longitud']);

                              var lat_ini=data['tramos'][i-1]['lat_ini'];
                              var lon_ini=Math.abs(data['tramos'][i-1]['lon_ini']);
                              var lat_fin=data['tramos'][i-1]['lat_fin'];
                              var lon_fin=Math.abs(data['tramos'][i-1]['lon_fin']);

                               $('[id^=lat_gra]').val(null);
                               $('[id^=lat_min]').val(null);
                               $('[id^=lat_seg]').val(null);
                               $('[id^=lon_gra]').val(null);
                               $('[id^=lon_min]').val(null);
                               $('[id^=lon_seg]').val(null);


                              if(lat_ini!=null){
                                   var g1=Math.trunc(lat_ini);
                                   var m1=Math.abs(Math.trunc((parseFloat(lat_ini)-parseInt(g1))*60));
                                   var s1=Math.round(((Math.abs((parseFloat(lat_ini)-parseInt(g1))*60)-m1)*60)* 100) / 100;
                                    $('#lat_gra_ini'+i).val(g1);
                                    $('#lat_min_ini'+i).val(m1);
                                    $('#lat_seg_ini'+i).val(s1);
                                    if (g1==0){
                                      $('#sig_lat_ini'+i).css("display","block");
                                      if (lat_ini<0){
                                        $("#sig_lat_S_ini"+i).prop("checked", true)
                                      }else{
                                        $("#sig_lat_N_ini"+i).prop("checked", true)
                                      }
                                    }
                              }
                              if(lon_ini!=null){
                                   var g2=Math.trunc(lon_ini);
                                   var m2=Math.trunc((parseFloat(lon_ini)-parseInt(g2))*60);
                                   var s2=Math.round(((Math.abs((parseFloat(lon_ini)-parseInt(g2))*60)-m2)*60)* 100) / 100;
                                    $('#lon_gra_ini'+i).val(-1*g2);
                                    $('#lon_min_ini'+i).val(m2);
                                    $('#lon_seg_ini'+i).val(s2);  
                              }
                              if(lat_fin!=null){
                                   var g1=Math.trunc(lat_fin);
                                   var m1=Math.abs(Math.trunc((parseFloat(lat_fin)-parseInt(g1))*60));
                                   var s1=Math.round(((Math.abs((parseFloat(lat_fin)-parseInt(g1))*60)-m1)*60)* 100) / 100;
                                    $('#lat_gra_fin'+i).val(g1);
                                    $('#lat_min_fin'+i).val(m1);
                                    $('#lat_seg_fin'+i).val(s1);
                                    if (g1==0){
                                      $('#sig_lat_fin'+i).css("display","block");
                                      if (lat_fin<0){
                                        $("#sig_lat_S_fin"+i).prop("checked", true)
                                      }else{
                                        $("#sig_lat_N_fin"+i).prop("checked", true)
                                      }
                                    }

                              }
                              if(lon_fin!=null){
                                   var g2=Math.trunc(lon_fin);
                                   var m2=Math.trunc((parseFloat(lon_fin)-parseInt(g2))*60);
                                   var s2=Math.round(((Math.abs((parseFloat(lon_fin)-parseInt(g2))*60)-m2)*60)* 100) / 100;
                                    $('#lon_gra_fin'+i).val(-1*g2);
                                    $('#lon_min_fin'+i).val(m2);
                                    $('#lon_seg_fin'+i).val(s2);   
                              }
                      };

                    //fin del formulario de ejecucion

                    
                    $("#IDdele").val(data['arrayproy'][0].ID);
                    $("#deletenombre").val(data['arrayproy'][0].nom_proy);
                    $("#deleteproycto").val(data['arrayproy'][0].OBJECTID);
                    $("#deletenucleo").val(data['arrayproy'][0].nom_nucleo);

                },
                error:function(){alert('error');}
            });//fin de la consulta ajax (Editar proceso)
            
        }
    });//Termina tbody

    function borr_crit(e) {

          var id=e.id.substring(6,16);
          $.ajax({url:"artpic/borrar-doc-plan50",type:"POST",data:{proy:e.name,estado:e.id.substring(12,16)},dataType:'json',
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

    function coorden(){
      var e=$(this).attr("id").substring(0,7);
        if ((e=='lat_min'|| e=='lat_seg' || e=='lon_min' || e=='lon_seg') && ($(this).val()<0 || $(this).val()>=60)){
         alert("Ingrese un valor entre 0 y 59 ");
         $(this).val("");
         }

         if ((e=='lat_gra') && ($(this).val()<-4 || $(this).val()>=13)){
         alert("Ingrese un valor entre -3 y 12 grados ");
         $(this).val("");
         }
         
         if ((e=='lon_gra') && ($(this).val()<-80 || $(this).val()>=-67)){
         alert("Ingrese un valor entre -79 y -66 grados ");
         $(this).val("");
         }

        var id=$(this).attr("id").substring(8,13);
        if (($("#lon_gra_"+id).val()=='' && $("#lon_min_"+id).val()=='' && $("#lon_seg_"+id).val()=='' && $("#lat_gra_"+id).val()=='' && $("#lat_min_"+id).val()=='' && $("#lat_seg_"+id).val()=='')){
          $("#lon_gra_"+id).prop('required',false); 
          $("#lon_min_"+id).prop('required',false); 
          $("#lon_seg_"+id).prop('required',false); 
          $("#lat_gra_"+id).prop('required',false); 
          $("#lat_min_"+id).prop('required',false); 
          $("#lat_seg_"+id).prop('required',false);
          $("#Lat_"+id).html('<b>Latitud</b>');
          $("#Lon_"+id).html('<b>Longitud</b>');
        }else {
          $("#lon_gra_"+id).prop('required',true); 
          $("#lon_min_"+id).prop('required',true); 
          $("#lon_seg_"+id).prop('required',true); 
          $("#lat_gra_"+id).prop('required',true); 
          $("#lat_min_"+id).prop('required',true); 
          $("#lat_seg_"+id).prop('required',true);
          $("#Lat_"+id).html('<b>Latitud</b><font color="red">*</font></b>');
          $("#Lon_"+id).html('<b>Longitud</b><font color="red">*</font></b>');
        }

        if (e=='lat_gra' && $(this).val()==0){
            $('#sig_lat_'+id).css("display","block");
            $('#sig_lat_N_'+id).prop('required',true);
         }else if (e=='lat_gra' && $(this).val()!=0){
             $('#sig_lat_'+id).css("display","none");
             $('#sig_lat_N_'+id).prop('required',false);
         }
         if (e=='lat_gra' && $(this).val()==''){
             $('#sig_lat_'+id).css("display","none");
             $('#sig_lat_N_'+id).prop('required',false);
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

                 var OPTGROUP=document.createElement("OPTGROUP");
                  OPTGROUP.setAttribute("label", data['arratodoterrtipo'][i]);
                $.each(data['arraynom_terri'][i], function(datos,nom){
                    var x = document.createElement("OPTION");
                    x.setAttribute("value", nom);
                    var t = document.createTextNode(datos);
                    x.appendChild(t);
                    OPTGROUP.append(x);
                  });
                 $("#nom_terrediiden").append(OPTGROUP);
              };
                
               
            },
            error:function(){alert('error');}
        });//Termina Ajax
      }
    });

    $("#nom_terrediiden").change(function(){
      $('[id^=tipoterredi_comple-]').remove();
      $("#nom_terrediiden option:selected").each(function () {
          var $this = $(this);
          
          var input=document.createElement("input");
          input.setAttribute("type", "hidden");
          input.name="tipoterredi_comple[]";
          input.id="tipoterredi_comple-"+$this.val();
          if ($(this).parent().attr("label")=="Resguardos indígenas:"){
            input.value=1;
          }else if($(this).parent().attr("label")=="Consejos cumunitarios:"){
            input.value=2;
          }else{
             input.value=3;
          }
          document.getElementById("edi-form-iden").append(input);
        });    

    });

//funciones de edicion para el estado de estructutra
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
                 var OPTGROUP=document.createElement("OPTGROUP");
                  OPTGROUP.setAttribute("label", data['arratodoterrtipo'][i]);
                $.each(data['arraynom_terri'][i], function(datos,nom){
                    var x = document.createElement("OPTION");
                    x.setAttribute("value", nom);
                    var t = document.createTextNode(datos);
                    x.appendChild(t);
                    OPTGROUP.append(x);
                  });
                 $("#nom_terrediestr").append(OPTGROUP);
              };
               
            },
            error:function(){alert('error');}
        });//Termina Ajax
      }
    });

    $("#nom_terrediestr").change(function(){
      $('[id^=tipoterredi_comple-]').remove();
      $("#nom_terrediestr option:selected").each(function () {
          var $this = $(this);
          
          var input=document.createElement("input");
          input.setAttribute("type", "hidden");
          input.name="tipoterredi_comple[]";
          input.id="tipoterredi_comple-"+$this.val();
          if ($(this).parent().attr("label")=="Resguardos indígenas:"){
            input.value=1;
          }else if($(this).parent().attr("label")=="Consejos cumunitarios:"){
            input.value=2;
          }else{
             input.value=3;
          }
          document.getElementById("edi-form-estr").append(input);
        });    

    });

//funciones de edicion para el estado de ejecucion
  $("#tipoterredieje").change(function(){
      $('[id^=pobl-]').remove();
      $('[id^=tipoterr_comple-]').remove();
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
                 var OPTGROUP=document.createElement("OPTGROUP");
                  OPTGROUP.setAttribute("label", data['arratodoterrtipo'][i]);
                $.each(data['arraynom_terri'][i], function(datos,nom){
                    var x = document.createElement("OPTION");
                    x.setAttribute("value", nom);
                    var t = document.createTextNode(datos);
                    x.appendChild(t);
                    OPTGROUP.append(x);
                  });
                 $("#nom_terredieje").append(OPTGROUP);
              };
               
            },
            error:function(){alert('error');}
        });//Termina Ajax
      }
    });


$("#nom_terredieje").change(function(){
      $('[id^=tipoterredi_comple-]').remove();
      $("#nom_terredieje option:selected").each(function () {
          var $this = $(this);
          
          var input=document.createElement("input");
          input.setAttribute("type", "hidden");
          input.name="tipoterredi_comple[]";
          input.id="tipoterredi_comple-"+$this.val();
          if ($(this).parent().attr("label")=="Resguardos indígenas:"){
            input.value=1;
          }else if($(this).parent().attr("label")=="Consejos cumunitarios:"){
            input.value=2;
          }else{
             input.value=3;
          }
          document.getElementById("edi-form-eje").append(input);
        });    

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

  $("#nom_terredieje").change(function() {
        var ids=$("#nom_terredieje").val();
        var  text=$('#nom_terredieje option:selected').text().split(" ");
        $('[id^=pobl-]').remove();
        $('[id^=tipoterr_comple-]').remove();
        if ($("#estadoedieje").val()=="Ejecución"){
            $("#nom_terredieje option:selected").each(function () {
              var $this = $(this);
              var div = document.createElement("div");
              div.className ="form-group col-sm-4";
              div.id ="pobl-"+$this.val();
              var Label = document.createElement("label");
              Label.innerHTML= "<b>"+$this.text()+"</b>";
              var input=document.createElement("input");
              input.setAttribute("type", "number");
              input.setAttribute("min", "0");
              input.className ="form-control";
              input.id=$this.val();
              input.name="pob_bene_ter[]";
              input.setAttribute("placeholder","# de población");
              div.append(Label);
              div.append(input);
              document.getElementById("label_pobla-eje").append(div);
              var input=document.createElement("input");
              input.setAttribute("type", "hidden");
              input.name="tipoterr_comple[]";
              input.id="tipoterr_comple-"+$this.val();
              if ($(this).parent().attr("label")=="Resguardos indígenas:"){
                input.value=1;
              }else if($(this).parent().attr("label")=="Consejos cumunitarios:"){
                input.value=2;
              }else{
                 input.value=3;
              }
              document.getElementById("label_pobla-eje").append(input);
            });
        }
    });


$('#cargar_proyecto').on('hidden.bs.modal', function (e) {//funcion que resetea el modal
   $(this).find('form').trigger('reset');
    table.$('tr.active').removeClass('active');
})

$('#borrar_proyecto').on('hidden.bs.modal', function (e) {//funcion que resetea el modal
   $(this).find('form').trigger('reset');
    table.$('tr.active').removeClass('active');
})

$('#editar_proyecto').on('hidden.bs.modal', function (e) {//funcion que resetea el modal
   $(this).find('form').trigger('reset');
    table.$('tr.active').removeClass('active');
    try{
      map_alerta.removeLayer(polylines);
    }catch(err){

    }
})
//finalizacion de funciones de edicion para el estado de identificación  
</script>    
@stop

@endif<!--Cierra el if de mostrar el contenido de la página si esta autenticado-->