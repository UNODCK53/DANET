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
            <textarea id="modobsconcjuri" class="form-control" name="modobsconcjuri" readonly>{{$pro->obsconceptojuridico}}</textarea>
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
            <input id="modareafor" type="number" step="any" class="form-control" name="modareafor" value='{{(double)$pro->areapredioformalizada}}' readonly>
          </div>
          <div class="col-sm-3 form-group">
            <label for="Proceso" class="control-label" >Unidades:</label><br>
            @if($pro->unidadareaprediofor==1)
            <input type="radio" name="modradiounidadfor" id="aunidadforha" value="1" checked disabled> ha.
            @else
            <input type="radio" name="modradiounidadfor" id="aunidadforha" value="1" disabled> ha.
            @endif
            @if($pro->unidadareaprediofor==2)
            <input type="radio" name="modradiounidadfor" id="aunidadforfan" value="2"checked disabled> fan.
            @else
            <input type="radio" name="modradiounidadfor" id="aunidadforfan" value="2" disabled> fan.
            @endif
            @if($pro->unidadareaprediofor==3)
            <input type="radio" name="modradiounidadfor" id="aunidadform2" value="3"checked disabled> m2.
            @else
            <input type="radio" name="modradiounidadfor" id="aunidadform2" value="3" disabled> m2.
            @endif
          </div>
          <div class="col-sm-6 form-group">
            <label for="Proceso" class="control-label">Latitud:</label>
            <input id="modlat" type="number" step="any" class="form-control" name="modlat" value='{{(double)$pro->latitud}}' readonly>
          </div>
          <div class="col-sm-6 form-group">
            <label for="Proceso" class="control-label">Longitud:</label>
            <input id="modlong" type="number" step="any" class="form-control" name="modlong" value='{{(double)$pro->longitud}}' readonly>
          </div>
          <div class="row">
          </div>
          <div class="form-group">
            <label for="Proceso" class="control-label">Viable:</label><br>
            <input type="radio" name="modviable" id="respoviasi" value="1" disabled='disabled' > SI
            <input type="radio" name="modviable" id="respoviano" value="2" disabled='disabled' > NO
          </div>
          <div class="form-group" id="obsvial">
            <label for="Proceso" class="control-label">Observación viabilidad:</label>
            <textarea id="modobsviab" name="modobsviab" class="form-control"readonly>{{$pro->obsviabilidad}}</textarea>
          </div>
          <div class="form-group">
            <label for="Proceso" class="control-label" >Requiere responsable Geográfico:</label><br>
            <input type="radio" name="modradiorespogeo" id="respogeosi" value="1" disabled='disabled' > SI
            <input type="radio" name="modradiorespogeo" id="respogeono" value="2" disabled='disabled' > NO<br>
          </div>
          <div class="form-group" id="respongeo">
            <label for="Proceso" class="control-label">Responsable Geográfico:</label>
            <select id="modrepogeo" class="form-control" name="modrepogeo" readonly>
              @foreach($arraydombobox[1] as $geo)
                <option value="{{$geo->id}}" hidden>{{$geo->name}}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="proceso" class="control-label">Departamento:</label>
              <input id="moddpto" type="text" class="form-control" name="moddpto" value='' readonly>
          </div>
          <div class="form-group">
            <label for="proceso" class="control-label">Municipio:</label>
            <input id="modmpio" type="text" class="form-control" name="modmpio" value='' readonly>
          </div>
          <div class="form-group">
            <label for="Proceso" class="control-label">Vereda:</label>
            <input id="modvereda" type="text" class="form-control" name="modvereda" value='' readonly>
          </div>
          <div class="form-group">
            <label for="Proceso" class="control-label">Nombre del predio:</label>
            <input id="modnompred" type="text" class="form-control" name="modnompred" value='{{$pro->nombrepredio}}' readonly>
          </div>
          <div class="form-group">
            <label for="Proceso" class="control-label">Dirección para notificación:</label>
            <input id="moddirnoti" type="text" class="form-control" name="moddirnoti" value='{{$pro->direccionnotificacion}}' readonly>
          </div>
          <div class="form-group">
            <label for="Proceso" class="control-label">Nombre:</label>
            <input id="modnombre" type="text" class="form-control" name="modnombre" value='{{$pro->nombre}}' readonly>
          </div>
          <div class="col-sm-6 form-group">
            <label for="Proceso" class="control-label">Cédula:</label>
            <input id="modcedula" type="number" class="form-control" name="modcedula" value='{{$pro->cedula}}' readonly>
          </div>
          <div class="col-sm-6 form-group">
            <label for="Proceso" class="control-label">Teléfono:</label>
            <input id="modtelefono" type="number" class="form-control" name="modtelefono" value='{{$pro->telefono}}' readonly>
          </div>
        </form>
        </div>
      <div class="col-sm-1"></div>
    </div>
    <hr>
    <blockquote>
      <p align="justify">Documentos sugeridos para adjuntar al proceso: </p>
      <p align="justify">
        @foreach($arraydombobox[2] as $docunecesario)
          <?php $encontro=0; ?>
          @foreach($arraydombobox[5] as $docucargado)
            @if($docunecesario->id_documento == $docucargado->id_documento)
              <?php $encontro=1; ?>
            @endif
          @endforeach
          @if($encontro==0)
            @if(($docunecesario->concepto == 'Levantamiento topográfico') and ($pro->requiererespgeo == 2))
                @else
                  {{$docunecesario->concepto}}{{','}}
                @endif
          @endif
        @endforeach
      </p>
    </blockquote>
    <?php $uno=0; ?>
    <div class="row">
      <div class="col-sm-1"></div>
        <div class="col-sm-10">
          <h3 class="text-primary">DOCUMENTOS ANEXADOS DEL PROCESO:</h3>
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
              <h3 class="text-primary">LEVANTAMIENTO TOPOGRÁFICO:</h3>
                  @if($arraydombobox[9])
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
      @if(($arraydombobox[6] == false) && ($arraydombobox[7] == false) && ($arraydombobox[9] == false)&&($arrayproceso[0]->requiererespgeo == 1) && 
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
    <?php
    foreach($arraydombobox[4] as $estadoproceso){
      if($estadoproceso->id_estado >= 2){
        $rad = true;
      }
      else{
        $rad = false;
      }
    }
    if($rad==true){ ?>
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
            @else
            @endif
          </div>
          <div class="col-sm-1"></div>
        </div>
        <hr>
      <?php }
      ?>
      @foreach($arraydombobox[4] as $estadoproceso)
      @if (($estadoproceso->id_estado == 3) or ($estadoproceso->id_estado == 4))
      <div class="row">
        <div class="col-sm-1"></div>
        <div class="col-sm-10">
        <h3 class="text-primary">VISITA DE INSPECCIÓN:</h3>
          <div class="form-group">
            <label for="Proceso" class="control-label">Requiere inspección: </label>
            @if($pro->requierevisinsp == '1')
              <input type="radio" name="modradiovisinsp" id="visinspsi" value="1" checked disabled> SI
            @else
              <input type="radio" name="modradiovisinsp" id="visinspsi" value="1" disabled> SI
            @endif
            @if($pro->requierevisinsp == '2')
              <input type="radio" name="modradiovisinsp" id="visinspno" value="2" checked disabled> NO<br>
            @else
              <input type="radio" name="modradiovisinsp" id="visinspno" value="2" disabled> NO<br>
            @endif
          </div>
          <input id="modfechaocular" type="text" class="form-control" name="modfechaocular" value = '{{$pro->fechainspeccionocular}}' readonly>
          <br>
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
            @else
            @endif
          </div>
          <div class="col-sm-1"></div>
        </div>
        <hr>
      @endif
      @if(($estadoproceso->id_estado == 6) or ($estadoproceso->id_estado == 7) or ($estadoproceso->id_estado == 8))
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
            @else
            @if (count($arraydombobox[5])==((count($arraydombobox[2]))-1))
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
      @if($estadoproceso->id_estado == 1)
        <p>Se debe adjuntar los documentos del <u><strong>Levantamiento Topográfico</strong></u>.</p>
      @endif
      @if($estadoproceso->id_estado == 2)
        <p>Se debe adjuntar <u><strong>Radicado</strong></u>.</p>
      @endif
      @if(($estadoproceso->id_estado == 3) or ($estadoproceso->id_estado == 4))
        <p>Se debe definir la <u><strong>Visita de Inspección</strong></u>.</p>
      @endif
      @if($estadoproceso->id_estado == 5)
        <p>Se debe adjuntar <u><strong>Resultado Procesal</strong></u>.</p>
      @endif      
      @if ($estadoproceso->id_estado ==9)
        <p>Se adjuntaron todos los datos requeridos para el proceso.</p>
      @elseif (($estadoproceso->id_estado >=6) and ($estadoproceso->id_estado <=8))
        <p>Usted tiene pendiente adjuntar <u><strong>{{$arraydombobox[3][8]->estado}}</strong></u></p>
      @endif
    </blockquote>
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
          $('#respoviano').prop('checked', 'true');
          $("#obsvial").show();
        }
      //Cierra viabilidad

      //Responsable geográfico
      $("#modrepogeo").val("{{$pro->respgeografico}}");
      if({{$pro->requiererespgeo}} == '1'){
        $('#respogeosi').prop("checked", true);
        $("#respongeo").show();
      }
      else{
        $('#respogeono').prop("checked", true);
        $("#respongeo").hide();
      }
      //cierra responsable geografico
      //para que los menus pequeño y grande funcione
      $( "#tierras" ).addClass("active");
      $( "#tierrasconsultageneral" ).addClass("active");
      $( "#iniciomenupeq" ).html("<small> INICIO</small>");
      $( "#tierrasmenupeq" ).html("<strong>MÓDULO TIERRAS<span class='caret'></span></strong>");
      $( "#tierrascongenmenupeq" ).html("<strong><span class='glyphicon glyphicon-ok'></span>Consulta General y/o Consulta por Proceso</strong>");
      //Finaliza Menús

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
          $("#moddpto").val(data[0][0].NOM_DPTO);
          $("#modmpio").val(data[0][0].NOM_MPIO);
          $("#modvereda").val(data[0][0].nombre1);
        },
        error:function(){alert('error');}
      });//Termina Ajax listadoproini
    });//Cierra document ready
  </script>
@stop
@endif<!--Cierra el if de mostrar el contenido de la página si esta autenticado-->