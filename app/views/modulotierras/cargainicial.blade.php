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
  <div class="container" id="sha">
  <!--aca se escribe el codigo-->
    <div class="row">
      <div class="col-sm-1"></div>
      <div class="col-sm-10">
      <h2 class="text-center text-primary">Procesos iniciales</h2>
          
            <p class="lead text-justify">En esta sección se pueden encontrar todas los procesos que han sido creados en la base de datos a partir de las fichas de caracterización. Para continuar, se requiere que cada uno de los responsables jurídicos se adjudiquen los procesos.</p>
          </div>
      <div class="col-sm-1"></div>
    </div>

    <div class="row">
      <?php $status=Session::get('status'); ?>
      @if($status=='ok_estatus')
      <div class="col-sm-1"></div>
      <div id = "mensajeestatus" class="alert alert-success col-sm-10"><button class="close" data-dismiss="alert" type="button">×</button>
      <i class="bg-success"></i> El proceso fue creado con éxito</div>
      <div class="col-sm-1"></div>
      @endif
      @if($status=='error_estatus')
      <div class="col-sm-1"></div>
      <div id = "mensajeestatus"class="alert alert-danger col-sm-10"><button class="close" data-dismiss="alert" type="button">×</button>
      <i class="bg-danger"></i> El proceso NO fue creado</div>
      <div class="col-sm-1"></div>
      @endif
      <?php $status=0; ?>
    </div>
    <div class="row">
      <div class="col-sm-1"></div>
      <div class="col-sm-9">
        <!-- Standard button -->
        <button id="btnedijuri" title="Presione para adjudicarse el proceso" disabled="disabled" data-target="#edijuriModal"  data-toggle="modal" type="button" class="btn btn-primary">Adjudicarse proceso</button>
      </div>
      <div class="col-sm-1"><a href='excelcar'><img class="img-responsive" src='assets/img/excel.png'></img></a></div>
      <div class="col-sm-1"></div>
    </div>
    <div class="row">
    <!--Listado de Procesos Iniciales para edicion -->
      </br>
      <div class="col-sm-1"></div>
      <div class="col-xs-12 col-sm-10" >
        <table id="example" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
          <thead>
            <tr class="well text-primary ">
              <th class="text-center">Proceso</th>
              <th class="text-center">Vereda</th>
              <th class="text-center">Nombre del predio</th>
              <th class="text-center">Dirección Notificación</th>
              <th class="text-center">Nombre</th>
              <th class="text-center">Cédula</th>
              <th class="text-center">Teléfono</th>
              <th class="text-center">Área Preliminar</td>
            </tr>
          </thead>
          <tbody>
            @foreach($arrayproini as $pro)
              <tr id="{{$pro->id_proceso}}">
                <td >{{$pro->id_proceso}}</td>
                <td >{{$pro->nombre1}}</td>
                <td >{{$pro->nombrepredio}}</td>
                <td >{{$pro->direccionnotificacion}}</td>
                <td >{{$pro->nombre}}</td>
                <td >{{$pro->cedula}}</td>
                <td >{{$pro->telefono}}</td>
                @if ($pro->areaprediopreliminar==NULL)
                <td >0</td>
                @elseif ($pro->areaprediopreliminar<>NULL)
                <td >{{(double)$pro->areaprediopreliminar}}</td>
                @endif
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="col-sm-1"></div>
      </br>
    </div>
  </div> 
<!--edijuri modal-->
<div id="edijuriModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><strong>Edición Juridica</strong></h4>
      </div>
      <div class="modal-body">
        <form role="form" action="tierras/crear-proceso" method="get" id="formEdit">
          <div class="form-group">
            <label for="Proceso" class="control-label">NP:</label>
            <input id="modnp" type="number" class="form-control" name="modnp" readonly >
          </div>
          <div class="form-group">
            <label for="proceso" class="control-label">Concepto jurídico:</label>
            <select id="modconcpjuri" "Seleccione el concepto" class="form-control" name="modconcpjuri" required>
                <option value="" selected="selected">Por favor seleccione</option>
             @foreach($arraydombobox[0] as $concep)
                <option value="{{$concep->id_concepto}}">{{$concep->subconcepto}}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="Proceso" class="control-label">Observación concepto jurídico:</label>
            <textarea id="modobsconcjuri" class="form-control" name="modobsconcjuri"></textarea>
          </div>
          <div class="form-group">
            <label for="Proceso" class="control-label">Área preliminar:</label>
            <input id="modarea" type="number" step="any" class="form-control" name="modarea" readonly>
          </div>
          <div class="form-group">
            <label for="Proceso" class="control-label" >Unidades:</label><br>
            <input type="radio" name="modradiounidadpre" id="aunidadpreha" value="1" disabled> ha.
            <input type="radio" name="modradiounidadpre" id="aunidadprefan" value="2" disabled> fan.
            <input type="radio" name="modradiounidadpre" id="aunidadprem2" value="2" disabled> m2.
          </div>
          <div class="form-group">
            <label for="Proceso" class="control-label">Área predio a formalizar:</label>
            <input id="modareafor" type="number" step="any" class="form-control" name="modareafor" required>
          </div>
          <div class="form-group">
            <label for="Proceso" class="control-label" >Unidades:</label><br>
            <input type="radio" name="modradiounidadfor" id="aunidadforha" value="1" required> ha.
            <input type="radio" name="modradiounidadfor" id="aunidadforfan" value="2" required> fan.
            <input type="radio" name="modradiounidadfor" id="aunidadform2" value="3" required> m2.
          </div>
          <div class="form-group">
            <label for="Proceso" class="control-label">Latitud:</label>
            <input id="modlat" type="number" step="any" class="form-control" name="modlat" value="0" readonly>
          </div>
          <div class="form-group">
            <label for="Proceso" class="control-label">Longitud:</label>
            <input id="modlong" type="number" step="any" class="form-control" name="modlong" value="0" readonly>
          </div>
          <div class="form-group">
            <label for="Proceso" class="control-label">Viable:</label><br>
            <input type="radio" name="modviable" id="respoviasi" value="1" checked> SI
            <input type="radio" name="modviable" id="respoviano" value="2"> NO
          </div>
          <div class="form-group" id="obsvial">
            <label for="Proceso" class="control-label">Observación viabilidad:</label>
            <textarea id="modobsviab" name="modobsviab" class="form-control"></textarea>
          </div>
          <div class="form-group">
            <label for="Proceso" class="control-label" >Requiere responsable Geográfico:</label><br>
            <input type="radio" name="modradiorespogeo" id="respogeosi" value="1" checked> SI
            <input type="radio" name="modradiorespogeo" id="respogeono" value="2"> NO<br>
          </div>
          <div class="form-group" id="respongeo">
            <label for="Proceso" class="control-label">Responsable Geográfico:</label>
            <select id="modrepogeo" class="form-control" name="modrepogeo" required>
                <option value="" selected="selected">Por favor seleccione</option>
              @foreach($arraydombobox[1] as $geo)
                <option value="{{$geo->id}}">{{$geo->name}} {{$geo->last_name}}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="Proceso" class="control-label" >Requiere visita de inspección:</label><br>
            <input type="radio" name="modradiovisinsp" id="visinspsi" value="1" checked> SI
            <input type="radio" name="modradiovisinsp" id="visinspno" value="2"> NO<br>
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
            <input id="modnompred" type="text" class="form-control" name="modnompred">
          </div>
          <div class="form-group">
            <label for="Proceso" class="control-label">Dirección para notificación:</label>
            <input id="moddirnoti" type="text" class="form-control" name="moddirnoti">
          </div>
          <div class="form-group">
            <label for="Proceso" class="control-label">Nombre:</label>
            <input id="modnombre" type="text" class="form-control" name="modnombre">
          </div>
          <div class="form-group">
            <label for="Proceso" class="control-label">Cédula:</label>
            <input id="modcedula" type="number" class="form-control" name="modcedula">
          </div>
          <div class="form-group">
            <label for="Proceso" class="control-label">Teléfono:</label>
            <input id="modtelefono" type="number" class="form-control" name="modtelefono">
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Confirmar Estudio Jurídico</button>
      </div>
        </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
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
      $(document).ready(function(){
        //modal-responsable geográfico 
        $("#obsvial").hide();
        $('#respogeosi').click(function(){
          $("#respongeo").show();
          $("#modrepogeo").prop('required', true);
        });
        $('#respogeono').click(function(){
          $("#respongeo").hide();
          $("#modrepogeo").val("");
          $("#modrepogeo").prop('required', false);
        });
        //cierra modal responsable geografico
        //modal-viable y vialidad
        $('#respoviano').click(function(){
          $("#obsvial").show();
        });
        $('#respoviasi').click(function(){
          $("#obsvial").hide();
          $("#modobsviab").val("");
        });
        //para que los menus pequeño y grande funcione
        $( "#tierras" ).addClass("active");
        $( "#tierrascargainicial" ).addClass("active");
        $( "#iniciomenupeq" ).html("<small> INICIO</small>");
        $( "#tierrasmenupeq" ).html("<strong>MÓDULO TIERRAS<span class='caret'></span></strong>");
        $( "#tierrascarinimenupeq" ).html("<strong><span class='glyphicon glyphicon-ok'></span>Carga Inicial</strong>");
        $( "#mensajeestatus" ).fadeOut(5000);
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
        var table = $('#example').DataTable();
        $('#example tbody').on('click', 'tr', function () {
          if ( $(this).hasClass('active') ) {
            $(this).removeClass('active');
            $("#btnedijuri").prop('disabled', true);
          }
          else {
            table.$('tr.active').removeClass('active');
            $(this).addClass('active');
            $("#btnedijuri").prop('disabled', false);
            $("#moddpto").empty();
            $("#modmpio").empty();
            $("#modvereda").empty();
            var num =($('td', this).eq(0).text());
            $.ajax({url:"tierras/listadoproinimodal",type:"POST",data:{numerpro:$('td', this).eq(0).text()},dataType:'json',
              success:function(data){
                $("#modnp").val(data[0][0].id_proceso);
                $("#modnompred").val(data[0][0].nombrepredio);
                $("#moddirnoti").val(data[0][0].direccionnotificacion);
                $("#modnombre").val(data[0][0].nombre);
                $("#modcedula").val(data[0][0].cedula);
                $("#modtelefono").val(data[0][0].telefono);
                if(data[0][0].areaprediopreliminar==null){
                  $("#modarea").val(0);
                }
                else{
                  $("#modarea").val(Number(data[0][0].areaprediopreliminar));
                }
                if(data[0][0].unidadesarea=='1'){
                  $('#aunidadpreha').prop("checked", true);
                }
                else if(data[0][0].unidadesarea=='2') {
                  $('#aunidadprefan').prop("checked", true);
                }
                else if (data[0][0].unidadesarea=='3'){
                  $('#aunidadprem2').prop("checked", true);
                }
                if($("#modareafor").val()==""){
                  $("#modareafor").val(0);
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
          }
        });//Termina tbody
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
      });//Termina document ready
    </script>
@stop
@endif<!--Cierra el if de mostrar el contenido de la página si esta autenticado-->