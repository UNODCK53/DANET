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
        @foreach($arrayproceso as $pro)
        @endforeach
        <h1 class="text-center text-primary">EDICIÓN PROCESO NP:{{$pro->id_proceso}}</h1>
      </div>
       <hr>
      <div class="row">
        <div class="col-sm-1"></div>
        <div class="col-sm-10">
        <h3 class="text-primary">EDICIÓN GENERAL:</h3>
        <form role="form" action="tierras/editar-proceso" method="get" id="formEdit">
          <div class="form-group">
            <label for="Proceso" class="control-label">NP:</label>
            <input id="modnp" type="text" class="form-control" name="modnp"  value='{{$pro->id_proceso}}' readonly>
          </div>
          <div class="form-group">
            <label for="proceso" class="control-label">Concepto jurídico:</label>
            <input id="modconcpjuri" type="hidden" class="form-control" name="modconcpjuri" value='{{$pro->conceptojuridico}}'>
            @foreach($arraydombobox[0] as $concep)
              @if($pro->conceptojuridico==$concep->id_concepto)
                <input id="modconcpjuri2" type="text" class="form-control" name="modconcpjuri2" value='{{$concep->subconcepto}}' readonly>
              @endif
            @endforeach
          </div>
          <div class="form-group">
            <label for="Proceso" class="control-label">Observación concepto jurídico:</label>
            <textarea id="modobsconcjuri" class="form-control" name="modobsconcjuri">{{$pro->obsconceptojuridico}}</textarea>
          </div>
          <div class="col-sm-3 form-group">
            <label for="Proceso" class="control-label">Área preliminar:</label>
            <input id="modarea" type="number" step="any" class="form-control" name="modarea" value='' readonly>
          </div>
          <div class="col-sm-3 form-group">
            <label for="Proceso" class="control-label" >Unidades:</label><br>
            <input type="radio" name="modradiounidadpre" id="aunidadpreha" value="1" disabled> ha.
            <input type="radio" name="modradiounidadpre" id="aunidadprefan" value="2" disabled> fan.
            <input type="radio" name="modradiounidadpre" id="aunidadprem2" value="2" disabled> m2.
          </div>
          <div class="col-sm-3 form-group">
            <label for="Proceso" class="control-label">Área predio a formalizar:</label>
            <input id="modareafor" type="number" step="any" class="form-control" name="modareafor" value='{{(double)$pro->areapredioformalizada}}'>
          </div>
          <div class="col-sm-3 form-group">
            <label for="Proceso" class="control-label" >Unidades:</label><br>
            @if($pro->unidadareaprediofor==1)
            <input type="radio" name="modradiounidadfor" id="aunidadforha" value="1" checked> ha.
            @else
            <input type="radio" name="modradiounidadfor" id="aunidadforha" value="1"> ha.
            @endif
            @if($pro->unidadareaprediofor==2)
            <input type="radio" name="modradiounidadfor" id="aunidadforfan" value="2"checked> fan.
            @else
            <input type="radio" name="modradiounidadfor" id="aunidadforfan" value="2"> fan.
            @endif
            @if($pro->unidadareaprediofor==3)
            <input type="radio" name="modradiounidadfor" id="aunidadform2" value="3"checked> m2.
            @else
            <input type="radio" name="modradiounidadfor" id="aunidadform2" value="3"> m2.
            @endif
          </div>
          <div class="col-sm-6 form-group">
            <label for="Proceso" class="control-label">Latitud:</label>
            <input id="modlat" type="number" step="any" class="form-control" name="modlat" value='{{(double)$pro->latitud}}'readonly>
          </div>
          <div class="col-sm-6 form-group">
            <label for="Proceso" class="control-label">Longitud:</label>
            <input id="modlong" type="number" step="any" class="form-control" name="modlong" value='{{(double)$pro->longitud}}' readonly>
          </div>
          <div class="row">
          </div>
          <div class="form-group">
            <label for="Proceso" class="control-label">Viable:</label><br>
            <input type="radio" name="modviable" id="respoviasi" value="1"> SI
            <input type="radio" name="modviable" id="respoviano" value="2"> NO
          </div>
          <div class="form-group" id="obsvial">
            <label for="Proceso" class="control-label">Observación viabilidad:</label>
            <textarea id="modobsviab" name="modobsviab" class="form-control">{{$pro->obsviabilidad}}</textarea>
          </div>
          <div class="form-group">
            <label for="Proceso" class="control-label" >Requiere responsable Geográfico:</label><br>
            <input type="radio" name="modradiorespogeo" id="respogeosi" value="1"> SI
            <input type="radio" name="modradiorespogeo" id="respogeono" value="2"> NO<br>
          </div>
          <div class="form-group" id="respongeo">
            <label for="Proceso" class="control-label">Responsable Geográfico:</label>
            <select id="modrepogeo" class="form-control" name="modrepogeo" >
                <option value="" selected="selected">Por favor seleccione</option>
                @foreach($arraydombobox[1] as $geo)
                <option value="{{$geo->id}}">{{$geo->name}} {{$geo->last_name}}</option>
                @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="proceso" class="control-label">Departamento:</label>
            <select id="moddpto" "Seleccione el departamento" class="form-control" name="moddpto" required>
            </select>
          </div>
          <div class="form-group">
            <label for="proceso" class="control-label">Municipio:</label>
            <select id="modmpio" "Seleccione el municipio" class="form-control" name="modmpio" required>
            </select>
          </div>
          <div class="form-group">
            <label for="Proceso" class="control-label">Vereda:</label>
            <select id="modvereda" "Seleccione la vereda" class="form-control" name="modvereda" required>
            </select>
          </div>
          <div class="form-group">
            <label for="Proceso" class="control-label">Nombre del predio:</label>
            <input id="modnompred" type="text" class="form-control" name="modnompred" value='{{$pro->nombrepredio}}'>
          </div>
          <div class="form-group">
            <label for="Proceso" class="control-label">Dirección para notificación:</label>
            <input id="moddirnoti" type="text" class="form-control" name="moddirnoti" value='{{$pro->direccionnotificacion}}'>
          </div>
          <div class="form-group">
            <label for="Proceso" class="control-label">Nombre:</label>
            <input id="modnombre" type="text" class="form-control" name="modnombre" value='{{$pro->nombre}}'>
          </div>
          <div class="col-sm-6 form-group">
            <label for="Proceso" class="control-label">Cédula:</label>
            <input id="modcedula" type="number" class="form-control" name="modcedula" value='{{$pro->cedula}}'>
          </div>
          <div class="col-sm-6 form-group">
            <label for="Proceso" class="control-label">Teléfono:</label>
            <input id="modtelefono" type="number" class="form-control" name="modtelefono" value='{{$pro->telefono}}'>
          </div>
          <div class="form-group text-right">
            <button type="submit" class="btn btn-primary">Guardar Edición General</button>
          </div>
        </form>
        </div>
        <div class="col-sm-1"></div>
      </div>
      <hr>
      <blockquote>
        <p align="justify">Por favor adjuntar los siguientes documentos para poder terminar el proceso: </p>
        <p align="justify">
          @foreach($arraydombobox[2] as $docunecesario)
              <?php $encontro=0; ?>
              @foreach($arraydombobox[5] as $docucargado)
                @if ($docunecesario->id_documento == $docucargado->id_documento)
                  <?php $encontro=1; ?>
                @endif
              @endforeach
              @if ($encontro==0)
                {{$docunecesario->concepto}}{{','}}
              @endif
          @endforeach
        </p>
      </blockquote>

      <?php $uno=0; ?>
      <div class="row">
          <div class="col-sm-1"></div>
            <div class="col-sm-10">
            <h3 class="text-primary">ANEXAR DOCUMENTOS REQUIRDOS PARA EL PROCESO:</h3>
            <form role="form" action="tierras/downloadfile" method="get" id="formEdit">
                  <div class="col-sm-12 form-group">
                    <input id="modnp" type="hidden" class="form-control" name="modnp"  value='{{$pro->id_proceso}}'>
        @foreach($arraydombobox[5] as $procdocu)
        @if (($procdocu->id_documento != 23) and ($procdocu->id_documento != 24) and ($procdocu->id_documento != 25) and ($procdocu->id_documento != 2))
                    <input id="moddownload" type="image" name="moddownload" src="assets/img/pdf.png" value='{{$procdocu->id_documento}}'>
                    <spam>{{$procdocu->concepto}}</spam><br>
        @endif
        @endforeach
                  </div>
            </form>
            <button id="btndocu" title="Presione para adjuntar documento al proceso" data-target="#docModal"  data-toggle="modal" type="button" class="btn btn-primary">Anexar documentos</button>
            </div>
          <div class="col-sm-1"></div>
        </div>

        <hr>
      @foreach($arraydombobox[4] as $estadoproceso)
        @if (($estadoproceso->id_estado == 2 )&&($arrayproceso[0]->requiererespgeo == 1))
          @if ($pro->conceptojuridico <= 6)
            <div class="row">
              <div class="col-sm-1"></div>
              <div class="col-sm-10">
                  @if($arraydombobox[8])
                  <h3 class="text-primary">LEVANTAMIENTO TOPOGRÁFICO:</h3>
                  <form role="form" action="tierras/downloadfile" method="get" id="formEdit">
                  <div class="col-sm-1 form-group">
                  <input id="modnp" type="hidden" class="form-control" name="modnp"  value='{{$pro->id_proceso}}'>
                  <input id="moddownload" type="image" name="moddownload" src="assets/img/pdf.png" value='_LT_MAPA.pdf'>
                  <spam>Mapa</spam>
                  </div>
                  </form>
                  @endif
                  @if($arraydombobox[6])
                  <form role="form" action="tierras/downloadfile" method="get" id="formEdit">
                  <div class="col-sm-1 form-group">
                  <input id="modnp" type="hidden" class="form-control" name="modnp"  value='{{$pro->id_proceso}}'>
                  <input id="moddownload" type="image" name="moddownload" src="assets/img/rar.png" value='_LT_SHP.rar'>
                  <spam>SHP</spam>
                  </div>
                  </form>
                  @endif
                  @if($arraydombobox[7])
                  <form role="form" action="tierras/downloadfile" method="get" id="formEdit">
                  <div class="col-sm-1 form-group">
                  <input id="modnp" type="hidden" class="form-control" name="modnp"  value='{{$pro->id_proceso}}'>
                  <input id="moddownload" type="image" name="moddownload" src="assets/img/excel.png" value='2'>
                  <spam>Coordenadas</spam>
                  </div>
                  </form>
                  @endif
              </div>
              <div class="col-sm-1"></div>
            </div>
            <hr>
          @endif
        @endif
      @endforeach
      @foreach($arraydombobox[4] as $estadoproceso)
        @if(($arraydombobox[6] == false) && ($arraydombobox[7] == false) && ($arraydombobox[8] == false)&&($arrayproceso[0]->requiererespgeo == 1) && 
        (($estadoproceso->id_estado == 3) || ($estadoproceso->id_estado == 4)))
      <div class="row">
        <div class="col-sm-1"></div>
        <div class="col-sm-10">
            <h3 class="text-primary">LEVANTAMIENTO TOPOGRÁFICO:</h3>
            <br>
            <h4 >Se modificó el levantamiento topográfico y no hay documentos cargados</h4>
        </div>
        <div class="col-sm-1"></div>
      </div>
      <hr>
        @endif
      @endforeach
    @if($arrayproceso[0]->requiererespgeo == 2)
       <div class="row">
        <div class="col-sm-1"></div>
        <div class="col-sm-10">
            <h3 class="text-primary">LEVANTAMIENTO TOPOGRÁFICO:</h3>
            <br>
            <h4 >No se requiere de levantamiento topográfico</h4>
        </div>
        <div class="col-sm-1"></div>
      </div>
      <hr>
    @endif
    <?php $rad=0; ?>
@foreach($arraydombobox[4] as $estadoproceso)
  @if ($estadoproceso->id_estado >= 2)
    <?php $rad = 1; ?>
  @else
    <?php $rad = 0; ?>  
  @endif
@endforeach
  @if($rad == 1 )
       <div class="row">
        <div class="col-sm-1"></div>
          <div id = 'radicado' class="col-sm-10">
          <h3 class="text-primary">RADICADO:</h3>          
        <?php $uno=0; ?>
        @foreach($arraydombobox[5] as $procdocu)
          @if ($procdocu->id_documento == 23)
            <?php $uno=23; ?>
          @endif
        @endforeach
          @if ($uno == 23)
            <form role="form" action="tierras/downloadfile" method="get" id="formEdit">
            <div class="col-sm-1 form-group">
            <input id="modnp" type="hidden" class="form-control" name="modnp"  value='{{$pro->id_proceso}}'>
            <input id="moddownload" type="image" name="moddownload" src="assets/img/pdf.png" value='23'>
            </div>
            </form>
            <button id="btndocuobliradicado" title="Presione para adjuntar documento al proceso" data-target="#docobligModal1"  data-toggle="modal" type="button" class="btn btn-primary">Editar Radicado</button>
          @else
          <button id="btndocuobliradicado" title="Presione para adjuntar documento al proceso" data-target="#docobligModal1"  data-toggle="modal" type="button" class="btn btn-primary">Adjuntar Radicado</button>
          @endif
          </div>
        <div class="col-sm-1"></div>
      </div>
      <hr>
  @endif
  @foreach($arraydombobox[4] as $estadoproceso)
    @if (($estadoproceso->id_estado == 3) or ($estadoproceso->id_estado == 4))
      <div class="row">
        <div class="col-sm-1"></div>
          <div class="col-sm-10">
          <h3 class="text-primary">VISITA DE INSPECCIÓN:</h3>
                <form role="form" action="tierras/editar-proceso2" method="get" id="formEdit">
                  <div class="form-group">
                    <label for="Proceso" class="control-label">Requiere inspección: </label>
                    @if(($pro->requierevisinsp == '1') or ($pro->requierevisinsp == ''))
                      <input type="radio" name="modradiovisinsp" id="visinspsi" value="1" checked> SI
                    @else
                      <input type="radio" name="modradiovisinsp" id="visinspsi" value="1"> SI
                    @endif
                    @if($pro->requierevisinsp == '2')
                      <input type="radio" name="modradiovisinsp" id="visinspno" value="2" checked> NO<br>
                    @else
                      <input type="radio" name="modradiovisinsp" id="visinspno" value="2" > NO<br>
                    @endif
                  </div>
                  <input id="modnp" type="hidden" class="form-control" name="modnp"  value='{{$pro->id_proceso}}' readonly>
                  <div class="input-group date" id="datepicker">
                    @if(($pro->requierevisinsp == '1') or ($pro->requierevisinsp == ''))
                      <input id="modfechaocular" type="text" class="form-control" name="modfechaocular" value = '{{$pro->fechainspeccionocular}}' required>
                    @else
                      <input id="modfechaocular" type="text" class="form-control" name="modfechaocular" value = '' disabled>
                    @endif
                        <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                  </div>
                  <br>
                  <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
          </div>
        <div class="col-sm-1"></div>
      </div>
      <hr>
    @endif
    @if ($estadoproceso->id_estado == 5 )
      <div class="row">
        <div class="col-sm-1"></div>
          <div class="col-sm-10">
          <h3 class="text-primary">RESULTADO PROCESAL:</h3>
        <?php $uno=0; ?>
        @foreach($arraydombobox[5] as $procdocu)
          @if ($procdocu->id_documento == 24)
            <?php $uno=24; ?>
          @endif
        @endforeach
          @if ($uno == 24)
            <form role="form" action="tierras/downloadfile" method="get" id="formEdit">
            <div class="col-sm-1 form-group">
            <input id="modnp" type="hidden" class="form-control" name="modnp"  value='{{$pro->id_proceso}}'>
            <input id="moddownload" type="image" name="moddownload" src="assets/img/pdf.png" value='24'>
            </div>
            </form>
            <button id="btndocuobliradicado" title="Presione para adjuntar documento al proceso" data-target="#docobligModal2"  data-toggle="modal" type="button" class="btn btn-primary">Editar Resultado Procesal</button>
          @else
          <button id="btndocuobliradicado" title="Presione para adjuntar documento al proceso" data-target="#docobligModal2"  data-toggle="modal" type="button" class="btn btn-primary">Adjuntar Resultado Procesal</button>
          @endif
          </div>
        <div class="col-sm-1"></div>
      </div>
      <hr>
    @endif
    @if (($estadoproceso->id_estado == 6) or ($estadoproceso->id_estado == 7) or ($estadoproceso->id_estado == 8))
      <div class="row">
        <div class="col-sm-1"></div>
          <div class="col-sm-10">
          <h3 class="text-primary">REGISTRO ORIP:</h3>
        <?php $uno=0; ?>
        @foreach($arraydombobox[5] as $procdocu)
          @if ($procdocu->id_documento == 25)
            <?php $uno=25; ?>
          @endif
        @endforeach
          @if ($uno == 25)
            <form role="form" action="tierras/downloadfile" method="get" id="formEdit">
            <div class="col-sm-1 form-group">
            <input id="modnp" type="hidden" class="form-control" name="modnp"  value='{{$pro->id_proceso}}'>
            <input id="moddownload" type="image" name="moddownload" src="assets/img/pdf.png" value='25'>
            </div>
            </form>
            <button id="btndocuobliradicado" title="Presione para adjuntar documento al proceso" data-target="#docobligModal3"  data-toggle="modal" type="button" class="btn btn-primary">Editar Registro ORIP</button>
          @else
            @if (count($arraydombobox[5])==((count($arraydombobox[2]))-1))
              <button id="btndocuobliradicado" title="Presione para adjuntar documento al proceso" data-target="#docobligModal3"  data-toggle="modal" type="button" class="btn btn-primary">Adjuntar Registro ORIP</button>
            @endif
          @endif
          </div>
        <div class="col-sm-1"></div>
      </div>
      <hr>
  @endif
@endforeach
      <blockquote>
      <input id="idestado" type = 'hidden' name="idestado" value='{{$estadoproceso->id_estado}}'>
        @if ($estadoproceso->id_estado ==9)
          <p>El proceso finalizó con éxito.</p>
        @elseif ($estadoproceso->id_estado <=5)
          <p>El proceso debe continuar al siguiente estado <u><strong>{{$arraydombobox[3][$estadoproceso->id_estado]->estado}}</strong></u>.</p>
        @elseif (($estadoproceso->id_estado >=6) and ($estadoproceso->id_estado <=8))
          <p>Usted tiene pendiente adjuntar <u><strong>{{$arraydombobox[3][8]->estado}}</strong></u> para activar el boton de cargue de documento ORIP necesita cargar todos los documentos del proceso.</p>
        @endif
      </blockquote>
      <!--ajuntar modal-->
      <div id="docModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><strong>Cargue de Documentos</strong></h4>
            </div>
            <div class="modal-body">
              <form role="form" action="tierras/adjuntar-docu" method="post" id="formEdit" enctype="multipart/form-data">
                <div class="form-group">
                  <label for="Proceso" class="control-label">NP:</label>
                  <input id="modnp" type="text" class="form-control" name="modnp"  value='{{$pro->id_proceso}}' readonly>
                </div>
                <div class="form-group">
                  <label for="Proceso" class="control-label">Tipo documento:</label>
                  <select id="modocu" class="form-control" name="modocu" required>
                      <option value="" selected="selected">Por favor seleccione</option>
                      @foreach($arraydombobox[2] as $docu)
                        @if($docu->id_documento!=2 and $docu->id_documento!=23 and $docu->id_documento!=24 and $docu->id_documento!=25)
                          <option value="{{$docu->id_documento}}">{{$docu->concepto}}</option>
                        @endif
                      @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <input id="modsubestado" type="hidden" class="form-control" name="modsubestado" value='0' readonly>
                  <label for="proceso" class="control-label">Adjuntar documento:</label>
                  <input id="modpdf" type="file" class="form-control" name="modpdf" required accept=".pdf" >
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Adjuntar Documento</button>
            </div>
              </form>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div>
      <!--ajuntar modal radicado-->
      <div id="docobligModal1" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><strong>Cargue de Documentos</strong></h4>
            </div>
            <div class="modal-body">
              <form role="form" action="tierras/adjuntar-docu" method="post" id="formEdit" enctype="multipart/form-data">
                <div class="form-group">
                  <label for="Proceso" class="control-label">NP:</label>
                  <input id="modnp" type="text" class="form-control" name="modnp"  value='{{$pro->id_proceso}}' readonly>
                </div>
                <div class="form-group">
                  <label for="Proceso" class="control-label">Tipo documento:</label>
                      @foreach($arraydombobox[2] as $docu)
                        @if($docu->id_documento==23)
                          <input id="modocu" type="hidden" class="form-control" name="modocu" value='{{$docu->id_documento}}' readonly>
                          <input id="modocu2" type="text" class="form-control" name="modocu2" value='{{$docu->concepto}}' readonly>
                        @endif
                      @endforeach
                </div>
                <div class="form-group">
                  <select id="modsubestado" class="form-control" name="modsubestado" required>
                      <option value="" selected="selected">Por favor seleccione</option>
                      @foreach($arraydombobox[3] as $estado)
                        @if($estado->estado=='Radicado')
                          <option value="{{$estado->id_estado}}">{{$estado->subestado}}</option>
                        @endif
                      @endforeach
                  </select>
              </div>
                <div class="form-group">
                  <label for="proceso" class="control-label">Adjuntar documento:</label>
                  <input id="modpdf" type="file" class="form-control" name="modpdf" required accept=".pdf" >
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Adjuntar Documento</button>

            </div>
              </form>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div>
        <!--ajuntar modal resultado procesal-->
      <div id="docobligModal2" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><strong>Cargue de Documentos</strong></h4>
            </div>
            <div class="modal-body">
              <form role="form" action="tierras/adjuntar-docu" method="post" id="formEdit" enctype="multipart/form-data">
                <div class="form-group">
                  <label for="Proceso" class="control-label">NP:</label>
                  <input id="modnp" type="text" class="form-control" name="modnp"  value='{{$pro->id_proceso}}' readonly>
                </div>
                <div class="form-group">
                  <label for="Proceso" class="control-label">Tipo documento:</label>
                      @foreach($arraydombobox[2] as $docu)
                        @if($docu->id_documento==24)
                          <input id="modocu" type="hidden" class="form-control" name="modocu" value='{{$docu->id_documento}}' readonly>
                          <input id="modocu2" type="text" class="form-control" name="modocu2" value='{{$docu->concepto}}' readonly>
                        @endif
                      @endforeach
                </div>
                <div class="form-group">
                  <select id="modsubestado" class="form-control" name="modsubestado" required>
                      <option value="" selected="selected">Por favor seleccione</option>
                      @foreach($arraydombobox[3] as $estado)
                        @if($estado->estado=='Resultado procesal')
                          <option value="{{$estado->id_estado}}">{{$estado->subestado}}</option>
                        @endif
                      @endforeach
                  </select>
              </div>
                <div class="form-group">
                  <label for="proceso" class="control-label">Adjuntar documento:</label>
                  <input id="modpdf" type="file" class="form-control" name="modpdf" required accept=".pdf" >
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Adjuntar Documento</button>
            </div>
              </form>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div>
        <!--ajuntar modal registro orip-->
      <div id="docobligModal3" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><strong>Cargue de Documentos</strong></h4>
            </div>
            <div class="modal-body">
              <form role="form" action="tierras/adjuntar-docu" method="post" id="formEdit" enctype="multipart/form-data">
                <div class="form-group">
                  <label for="Proceso" class="control-label">NP:</label>
                  <input id="modnp" type="text" class="form-control" name="modnp"  value='{{$pro->id_proceso}}' readonly>
                </div>
                <div class="form-group">
                  <label for="Proceso" class="control-label">Tipo documento:</label>
                      @foreach($arraydombobox[2] as $docu)
                        @if($docu->id_documento==25)
                          <input id="modocu" type="hidden" class="form-control" name="modocu" value='{{$docu->id_documento}}' readonly>
                          <input id="modocu2" type="text" class="form-control" name="modocu2" value='{{$docu->concepto}}' readonly>
                        @endif
                      @endforeach
                </div>
                <div class="form-group">
                  <input id="modsubestado" type="hidden" class="form-control" name="modsubestado" value='9' readonly>
                  <label for="proceso" class="control-label">Adjuntar documento:</label>
                  <input id="modpdf" type="file" class="form-control" name="modpdf" required accept=".pdf" >
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Adjuntar Documento</button>
            </div>
              </form>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div>
  <!--finaliza el codigo dentro de este contenedor-->
  </div>
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
@section('js')
  @parent
    <script>
      $(document).ready(function() {

        //Viabilidad
        if({{$pro->viabilidad}} == '1'){
            $('#respoviasi').prop('checked', 'true');
             $("#obsvial").hide();
             $("#obsvial").val("");
        }
        else{
          $('#respoviano').prop('checked', true);
          $("#obsvial").show();
        }
        $('#respoviano').click(function(){
        $("#obsvial").show();
        });
        $('#respoviasi').click(function(){
          $("#obsvial").hide();
          $("#modobsviab").val("");
        });
        //Cierra viabilidad

        //Responsable geográfico
        $("#modrepogeo").val("{{$pro->respgeografico}}");
        if({{$pro->requiererespgeo}} == '1'){
          $('#respogeosi').prop("checked", true);
          $("#respongeo").show();
          if({{$pro->respgeografico}} == '0'){
            $("#modrepogeo").val("");
          }
        }
        else{
          $('#respogeono').prop("checked", true);
          $("#respongeo").hide();
        }
        $('#respogeosi').click(function(){
          $("#respongeo").show();
          $("#modrepogeo").prop('required','true');
          $("#modrepogeo").val("");
        });
        $('#respogeono').click(function(){
          $("#respongeo").hide();
          $("#modrepogeo").val("");
          $("#modrepogeo").prop("required",false);
        });
        //cierra responsable geografico

        //Requiere Vista de inspección
        $('#visinspsi').click(function(){
          $("#modfechaocular").prop("required", true);
          $("#modfechaocular").prop("disabled", false);
        });
        $('#visinspno').click(function(){
          $("#modnp").prop("required", false);
          $("#modfechaocular").val("");
          $("#modfechaocular").prop("disabled", true);
        });
        //Cierra Vista de inspección

         $('#btndocuobliradicado').click(function(){
          $("#idestado").val(23);
        });
         $('#btndocuobliresproc').click(function(){
          $("#idestado").val(24);
        });
        $('#btndocuobliregorip').click(function(){
          $("#idestado").val(25);
        });
        //para que los menus pequeño y grande funcione
        $( "#tierras" ).addClass("active");
        $( "#tierrascargaproceso" ).addClass("active");
        $( "#iniciomenupeq" ).html("<small> INICIO</small>");
        $( "#tierrasmenupeq" ).html("<strong>MÓDULO TIERRAS<span class='caret'></span></strong>");
        $( "#tierrasestjurmenupeq" ).html("<strong><span class='glyphicon glyphicon-ok'></span>Procesos Adjudicados</strong>");
        
        var table = $('#levtopo').DataTable();
        // para el calendario interno
        $('#datepicker').datepicker({
            format: "yyyy-mm-dd",
            language: "es",
            startDate: "2014-11-01",
            endDate: "today",
            todayBtn: "linked",
            orientation: "bottom auto",
            autoclose: true,
            todayHighlight: true
        });
        //Cierra datapicker
        var np = $('#modnp').val();
        $.ajax({url:"tierras/editarprocesodatgeo",type:"POST",data:{numerpro:np},dataType:'json',
          success:function(data){
            if(data[2][0].areaprediopreliminar==null){
              $("#modarea").val("0");
            }
            else{
              $("#modarea").val(data[2][0].areaprediopreliminar);
            }
            if(data[2][0].unidadesarea=='1'){
              $('#aunidadpreha').prop("checked", true);
            }
            else if(data[2][0].unidadesarea=='2') {
              $('#aunidadprefan').prop("checked", true);
            }
            else if (data[2][0].unidadesarea=='3'){
              $('#aunidadprem2').prop("checked", true);
            }
            $.each(data[1], function(nom,datos){
              $("#moddpto").append("<option value=\""+datos.cod_dpto+"\">"+datos.nom_dpto+"</option>");
            });
            $("#moddpto").val(data[0][0].COD_DPTO);
            $.ajax({url:"tierras/reporarealevantadampio",type:"POST",data:{dpto:$('#moddpto').val()},dataType:'json',
              success:function(data1){
                $.each(data1[0], function(nom,datos1){
                  $("#modmpio").append("<option value=\""+datos1.cod_mpio+"\">"+datos1.nom_mpio+"</option>");
                });
                $("#modmpio").val(data[0][0].COD_MPIO);
                $.ajax({url:"tierras/reporarealevantadavda",type:"POST",data:{mpio:$('#modmpio').val()},dataType:'json',
                  success:function(data2){
                    $.each(data2[0], function(nom,datos2){
                      $("#modvereda").append("<option value=\""+datos2.cod_unodc+"\">"+datos2.nombre1+"</option>");
                    });
                    $("#modvereda").val(data[0][0].COD_UNODC);
                  },
                  error:function(){alert('error');}
                });//Termina Ajax vereda
              },
              error:function(){alert('error');}
            });//Termina Ajax mpio
          },
          error:function(){alert('error');}
        });//Termina Ajax listadoproini
        $("#moddpto").change(function(){
          $("#modmpio").empty();
          $("#modvereda").empty();
          $.ajax({url:"tierras/reporarealevantadampio",type:"POST",data:{dpto:$('#moddpto').val()},dataType:'json',
            success:function(data1){
              $("#modmpio").append("<option value=''>Por favor seleccione</option>");
              $("#modvereda").append("<option value=''>Por favor seleccione</option>");
              $.each(data1[0], function(nom,datos){
                $("#modmpio").append("<option value=\""+datos.cod_mpio+"\">"+datos.nom_mpio+"</option>");
              });
            },
            error:function(){alert('error');}
          });//Termina reporarealevantadampio
        });//Termina chage moddpto
        $("#modmpio").change(function(){
          $("#modvereda").empty();
          $.ajax({url:"tierras/reporarealevantadavda",type:"POST",data:{mpio:$('#modmpio').val()},dataType:'json',
            success:function(data1){
              $("#modvereda").append("<option value=''>Por favor seleccione</option>");
              $.each(data1[0], function(nom,datos){
                $("#modvereda").append("<option value=\""+datos.cod_unodc+"\">"+datos.nombre1+"</option>");
              });
            },
            error:function(){alert('error');}
          });//Termina reporarealevantadavda
        });//Termina change modmpio

      });//Cierra document ready

    </script>
@stop

@endif<!--Cierra el if de mostrar el contenido de la página si esta autenticado-->