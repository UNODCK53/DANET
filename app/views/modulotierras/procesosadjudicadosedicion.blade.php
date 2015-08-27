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
        <h1 class="text-center text-primary">EDICION PROCESO NP:{{$pro->id_proceso}}</h1>
      </div>
       <hr>       
      <div class="row">      
        <div class="col-sm-1"></div>               
        <div class="col-sm-10">
        <h3 class="text-primary">EDICION GENERAL:</h3>      
        
        <form role="form" action="tierras/editar-proceso" method="get" id="formEdit">
          <div class="form-group">
            <label for="Proceso" class="control-label">NP:</label>
            <input id="modnp" type="text" class="form-control" name="modnp"  value='{{$pro->id_proceso}}' readonly>
          </div>
          <div class="form-group">
            <label for="proceso" class="control-label">Concepto juridico:</label>
            <input id="modconcpjuri" type="hidden" class="form-control" name="modconcpjuri" value='{{$pro->conceptojuridico}}'>
            @foreach($arraydombobox[0] as $concep)
              @if($pro->conceptojuridico==$concep->id_concepto)
                <input id="modconcpjuri2" type="text" class="form-control" name="modconcpjuri2" value='{{$concep->subconcepto}}' readonly>
              @endif
            @endforeach
            </div>
          <div class="form-group">
            <label for="Proceso" class="control-label">Observacion concepto juridico:</label>
            <textarea id="modobsconcjuri" class="form-control" name="modobsconcjuri">{{$pro->obsconceptojuridico}}</textarea>
          </div>
          <div class="col-sm-4 form-group">
            <label for="Proceso" class="control-label">Area predio a formalizar:</label>
            <input id="modarea" type="number" step="any" class="form-control" name="modarea" value='{{$pro->areapredioformalizada}}' >
          </div>
          <div class="col-sm-4 form-group">
            <label for="Proceso" class="control-label">Latitud:</label>
            <input id="modlat" type="number" step="any" class="form-control" name="modlat" value='{{$pro->latitud}}' >
          </div>
          <div class="col-sm-4 form-group">
            <label for="Proceso" class="control-label">Longitud:</label>
            <input id="modlong" type="number" step="any" class="form-control" name="modlong" value='{{$pro->longitud}}' >
          </div>          
          <div class="form-group">
            <label for="Proceso" class="control-label">Viable:</label><br>
            <input type="radio" name="modviable" id="respoviasi" value="1" > SI
            <input type="radio" name="modviable" id="respoviano" value="2"> NO
          </div>
          <div class="form-group" id="obsvial">
            <label for="Proceso" class="control-label">Observacion viabilidad:</label>
            <textarea id="modobsviab" name="modobsviab" class="form-control">{{$pro->obsviabilidad}}</textarea>
          </div>
          <div class="form-group">
            <label for="Proceso" class="control-label" >Requiere responsable Geografico:</label><br>
            <input type="radio" name="modradiorespogeo" id="respogeosi" value="1"> SI
            <input type="radio" name="modradiorespogeo" id="respogeono" value="2"> NO<br>
          </div>
          <div class="form-group" id="respongeo">
            <label for="Proceso" class="control-label">Responsable Geografico:</label>
            <select id="modrepogeo" class="form-control" name="modrepogeo">
                <option value="" selected="selected">Por favor seleccione</option>
                @foreach($arraydombobox[1] as $geo)
                <option value="{{$geo->id}}">{{$geo->name}}</option>              
                @endforeach              
            </select>
          </div>
          <div class="form-group">
            <label for="Proceso" class="control-label">Vereda:</label>
            <input id="modvereda" type="text" class="form-control" name="modvereda" value='{{$pro->vereda}}'>
          </div>
          <div class="form-group">
            <label for="Proceso" class="control-label">Nombre del predio:</label>
            <input id="modnompred" type="text" class="form-control" name="modnompred" value='{{$pro->nombrepredio}}'>
          </div>
          <div class="form-group">
            <label for="Proceso" class="control-label">Direccion para notificacion:</label>
            <input id="moddirnoti" type="text" class="form-control" name="moddirnoti" value='{{$pro->direccionnotificacion}}'>
          </div>
          <div class="form-group">
            <label for="Proceso" class="control-label">Nombre:</label>
            <input id="modnombre" type="text" class="form-control" name="modnombre" value='{{$pro->nombre}}'>
          </div>
          <div class="col-sm-6 form-group">
            <label for="Proceso" class="control-label">Cedula:</label>
            <input id="modcedula" type="number" class="form-control" name="modcedula" value='{{$pro->cedula}}'>
          </div>
          <div class="col-sm-6 form-group">
            <label for="Proceso" class="control-label">Telefono:</label>
            <input id="modtelefono" type="number" class="form-control" name="modtelefono" value='{{$pro->telefono}}'>
          </div>
          <div class="form-group text-right">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Guardar Edicion General</button>
          </div>
        </form>          
        </div>              
        <div class="col-sm-1"></div>
      </div>
      <hr>
@foreach($arraydombobox[4] as $estadoproceso)
  @if ($estadoproceso->id_estado == 2 )
    @if ($pro->conceptojuridico <= 6) 
      <div class="row">
        <div class="col-sm-1"></div>               
        <div class="col-sm-10">
            <h3 class="text-primary">LEVANTAMIENTO TOPOGRAFICO:</h3>
            <form role="form" action="tierras/downloadfile" method="get" id="formEdit">
            <div class="col-sm-1 form-group">            
            <input id="modnp" type="hidden" class="form-control" name="modnp"  value='{{$pro->id_proceso}}'>            
            <input id="moddownload" type="image" name="moddownload" src="assets/img/pdf.png" value='_LT_MAPA.pdf'>
            </div>
            </form>
            <form role="form" action="tierras/downloadfile" method="get" id="formEdit">
            <div class="col-sm-1 form-group">            
            <input id="modnp" type="hidden" class="form-control" name="modnp"  value='{{$pro->id_proceso}}'>            
            <input id="moddownload" type="image" name="moddownload" src="assets/img/rar.png" value='_LT_SHP.rar'>
            </div>
            </form>
            <form role="form" action="tierras/downloadfile" method="get" id="formEdit">
            <div class="col-sm-1 form-group">            
            <input id="modnp" type="hidden" class="form-control" name="modnp"  value='{{$pro->id_proceso}}'>            
            <input id="moddownload" type="image" name="moddownload" src="assets/img/excel.png" value='2'>
            </div>
            </form>            
        </div>
        <div class="col-sm-1"></div>        
      </div>
      <hr>
    @endif 
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
  @if (($estadoproceso->id_estado == 3) or ($estadoproceso->id_estado == 4))
      <div class="row">
        <div class="col-sm-1"></div>               
          <div class="col-sm-10">
          <h3 class="text-primary">VISITA DE INSPECCION OCULAR:</h3>                  
                <form role="form" action="tierras/editar-proceso2" method="get" id="formEdit">
                  <input id="modnp" type="hidden" class="form-control" name="modnp"  value='{{$pro->id_proceso}}' readonly>
                  <div class="input-group date" id="datepicker">                      
                      <input id="modfechaocular" type="text" class="form-control" name="modfechaocular" value = '{{$pro->fechainspeccionocular}}' readonly>
                      <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>                      
                  </div>
                  <br>
                  
                  <button type="submit" class="btn btn-primary">Guardar Fecha</button>
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
          <button id="btndocuobliradicado" title="Presione para adjuntar documento al proceso" data-target="#docobligModal3"  data-toggle="modal" type="button" class="btn btn-primary">Adjuntar Registro ORIP</button>
          @endif          
          </div> 
        <div class="col-sm-1"></div>        
      </div>
      <hr>          
  @endif
@endforeach

      <blockquote>
      <button id="btndocu" title="Presione para adjuntar documento al proceso" data-target="#docModal"  data-toggle="modal" type="button" class="btn btn-primary">Adjuntar no obli</button>
      <input id="idestado" type = 'hidden' name="idestado" value='{{$estadoproceso->id_estado}}'>
        @if ($estadoproceso->id_estado ==9)
          <p>Grandioso el proceso finalizo con exito.</p>
        @elseif ($estadoproceso->id_estado <=8)
          <p>usted tiene pendiente realizar los siguientes procesos {{$arraydombobox[3][$estadoproceso->id_estado]->estado}}.</p>
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
        
        
        $("#modrepogeo").val("{{$pro->respgeografico}}");

        if({{$pro->viabilidad}} == '1'){
            $('#respoviasi').prop('checked', 'true');
             $("#obsvial").show();
          }
          else{
            $('#respoviano').prop('checked', 'true');
             $("#obsvial").hide();
          } 

        if({{$pro->requiererespgeo}} == '1'){
            $('#respogeosi').prop('checked', 'true');
            $("#respongeo").show();
          }
          else{
            $('#respogeono').prop('checked', 'true');
            $("#respongeo").hide();
          } 

        //modal-responsable geográfico

        $('#respogeosi').click(function(){
          $("#respongeo").show();
        });
        $('#respogeono').click(function(){
          $("#respongeo").hide();
          $("#modrepogeo").val("");
        });
        //cierra modal responsable geografico

        $('#respoviano').click(function(){
          $("#obsvial").hide();
          $("#modobsviab").val("");
        });
        $('#respoviasi').click(function(){
          $("#obsvial").show();
        });
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
        $( "#tierrasmenupeq" ).html("<strong>MODULO TIERRAS<span class='caret'></span></strong>");
        $( "#tierrasestjurmenupeq" ).html("<strong><span class='glyphicon glyphicon-ok'></span>Procesos Adjudicados</strong>");
        
        var table = $('#levtopo').DataTable();
        // para el calendario interno
          $('#datepicker').datepicker({
            format: "yyyy-mm-dd",
            language: "es",
            startDate: "2015-01-01",
            endDate: "today",
            todayBtn: "linked",
            orientation: "bottom auto",
            autoclose: true,
            todayHighlight: true

          });
               
      });
    
    </script>
@stop

@endif<!--Cierra el if de mostrar el contenido de la página si esta autenticado-->