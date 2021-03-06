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
      <h1 class="text-center text-primary">LEVANTAMIENTO TOPOGRÁFICO</h1>
    </div>

    <div class="row">
      <?php $status=Session::get('status'); ?>
      @if($status=='ok_estatus')
      <div class="col-sm-1"></div>    
      <div id = "mensajeestatus" class="alert alert-success col-sm-10"><button class="close" data-dismiss="alert" type="button">×</button>
      <i class="bg-success"></i> Se adjuntarón los documentos al proceso con éxito</div>
      <div class="col-sm-1"></div>
      @endif
      @if($status=='error_estatus')
      <div class="col-sm-1"></div>    
      <div id = "mensajeestatus"class="alert alert-danger col-sm-10"><button class="close" data-dismiss="alert" type="button">×</button>
      <i class="bg-danger"></i> NO se adjuntaron los documentos al proceso</div>
      <div class="col-sm-1"></div>
      @endif
    </div>

    <div class="row">
      <div class="col-sm-1"></div>
      <div class="col-sm-10">  
        <!-- Standard button -->
        <button id="btnlevtopo" title="Presione para adjuntar documentos al proceso" disabled="disabled" data-target="#levtopoModal"  data-toggle="modal" type="button" class="btn btn-primary">Adjuntar Documentos</button>
        
      </div>
      <div class="col-sm-1"></div>
    </div>
    <div class="row">
    <!--Listado de Procesos Iniciales para edicion -->
      </br>
      <div class="col-sm-1"></div>
      <div class="col-xs-12 col-sm-10" >
        <table id="example" class="table table-striped table-bordered table-hover" cellspacing="100" width="100%">
          <thead>
            <tr class="well text-primary ">
              <th class="text-center">Proceso</th>
              <th class="text-center">Municipio</th>
              <th class="text-center">Vereda</th>
              <th class="text-center">Nombre del predio</th>
              <th class="text-center">Nombre</th>
              <th class="text-center">Cédula</th>
              <th class="text-center">Área Predio Formalizada</td>
                <th class="text-center" hidden>concepto</td>
            </tr>
          </thead>
          <tbody>
            @foreach($arraylevtopo as $pro)
              <tr id="{{$pro->id_proceso}}">
                <td >{{$pro->id_proceso}}</td>
                <td >{{$pro->NOM_MPIO}}</td>                
                <td >{{$pro->NOM_TERR}}</td>
                <td >{{$pro->nombrepredio}}</td>
                <td >{{$pro->nombre}}</td>
                <td >{{$pro->cedula}}</td>
                @if ($pro->areapredioformalizada==NULL)
                <td >0</td>
                @elseif ($pro->areapredioformalizada<>NULL)
                  @if($pro->unidadareaprediofor==1)
                  <td >{{(double)$pro->areapredioformalizada}} ha</td>
                  @elseif($pro->unidadareaprediofor==2)
                  <td >{{(double)$pro->areapredioformalizada}} fan</td>
                  @elseif($pro->unidadareaprediofor==3)
                  <td >{{(double)$pro->areapredioformalizada}} m<sup>2</sup></td>
                  @else
                  <td >Ns/Nr</td>
                  @endif
                @endif
                <td hidden>{{$pro->conceptojuridico}}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="col-sm-1"></div>
      </br>
    </div>
    <div class="row">
        <h1 class="text-center text-primary">RELACIÓN DE PROCESOS ADJUDICADOS PARA EDICIÓN DE COORDENADAS</h1>
    </div>
    <div class="row">
      
      @if($status=='true')
        <div class="col-sm-1"></div>
        <div id = "mensajeestatus1" class="alert alert-success col-sm-10"><button class="close" data-dismiss="alert" type="button">×</button>
          <i class="bg-success"></i> Las coordenadas fueron actualizadas con éxito</div>
        <div class="col-sm-1"></div>
      @endif
      @if($status=='false')
        <div class="col-sm-1"></div>
        <div id = "mensajeestatus1"class="alert alert-danger col-sm-10"><button class="close" data-dismiss="alert" type="button">×</button>
          <i class="bg-danger"></i> Las coordenadas NO fueron actualizadas</div>
        <div class="col-sm-1"></div>
      @endif
    </div>
    <div class="row">
      <div class="col-sm-1"></div>
      <form role="form" action="tierras/coordenadas-ediciontopo" method="post" id="formconsulpro">
        <div class="col-sm-10">
          <!-- Standard button -->
          <button id="btnedicoord" title="Presione para editar coordenadas" disabled="disabled" type="submit" type="button" class="btn btn-primary">Edición de coordenadas</button>
          <input id="proceso" type="hidden" class="form-control" name="proceso">
        </div>
        <div class="col-sm-1"></div>
    </div>
    <div class="row">
    <!--Listado de Procesos Iniciales para edicion -->
      <br>
      <div class="col-sm-1"></div>
      <div class="col-xs-12 col-sm-10" >
        <table id="tablacoordenadaslevtopo" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
          <thead>
            <tr class="well text-primary ">
              <th class="text-center">Proceso</th>
              <th class="text-center">Modificación de Coordenadas</th>
              <th class="text-center">latitud</th>
              <th class="text-center">longitud</th>
            </tr>
          </thead>
          <tbody>
            @foreach($arrayproccoordlev as $coordenadas)
              <tr id="{{$coordenadas->id_proceso}}">
                <td>{{$coordenadas->id_proceso}}</td>
                @if($coordenadas->updatedcoord<>NULL)
                  <td align="center"><p style="display:none;">{{$coordenadas->updatedcoord}}</p><span class="glyphicon glyphicon-ok-sign" aria-hidden="true" style="color:green"></span></td> @else <td align="center"><p style="display:none;">{{$coordenadas->updatedcoord}}</p><span class="glyphicon glyphicon-remove-sign" aria-hidden="true" style="color:red"></span></td>
                @endif
                <td>{{(double)$coordenadas->latitud}}</td>
                <td>{{(double)$coordenadas->longitud}}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </form>
      </div>
      <div class="col-sm-1"></div>
      <br>
    </div>
  </div>   
<!--edijuri modal-->
<div id="levtopoModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><strong>Cargue de Información Topográfica</strong></h4>
      </div>
      <div class="modal-body">
        <form role="form" action="tierras/adjuntar-levtopo" method="post" id="formEdit" enctype="multipart/form-data">
          <div class="form-group">
            <label for="Proceso" class="control-label">NP:</label>
            <input id="modnp" type="text" class="form-control" name="modnp" readonly >
          </div>
          <div class="form-group">
            <label for="proceso" class="control-label">Adjuntar MAPA:</label>
            <input id="modmapa" type="file" class="form-control" name="modmapa" required accept=".pdf" >
          </div>
          <div class="form-group">
            <label for="proceso" class="control-label">Adjuntar SHP:</label>
            <input id="modshp" type="file" class="form-control" name="modshp" required accept=".rar">
          </div>
          <div class="form-group">
            <label for="proceso" class="control-label">Adjuntar TABLA:</label>
            <input id="modtabla" type="file" class="form-control" name="modtabla" required accept=".xls,.xlsx">
          </div>
          <input id="modconcep" type="hidden" class="form-control" name="modconcep">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary" id="btsumit">Adjuntar Documentos</button>
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
      $(document).ready(function() {
          //para que los menus pequeño y grande funcione
          $( "#tierras" ).addClass("active");
          $( "#tierraslevtopo" ).addClass("active");
          $( "#iniciomenupeq" ).html("<small> INICIO</small>");
          $( "#tierrasmenupeq" ).html("<strong>MÓDULO TIERRAS<span class='caret'></span></strong>");
          $( "#tierraslevtopmenupeq" ).html("<strong><span class='glyphicon glyphicon-ok'></span>Levantamiento Topográfico</strong>");
          $( "#mensajeestatus" ).fadeOut(5000);
          $( "#mensajeestatus1" ).fadeOut(5000);
          $("#btnlevtopo").prop('disabled', true);
          $("#btnedicoord").prop('disabled', true);
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
                $("#btnlevtopo").prop('disabled', true);
              }
              else { 
                table.$('tr.active').removeClass('active');
                $(this).addClass('active');
                $("#btnlevtopo").prop('disabled', false);
                var a = 0;
                $("#modnp").val($('td', this).eq(0).text());
                a = $('td', this).eq(6).text();
                $("#modconcep").val(a);                
                $('#btsumit').click(function(){
                  if(a == "6"){
                    $("#modtabla").prop("required", false);
                    $("#modshp").prop("required", false);
                  }
                });
              }
          });
          var table1 = $('#tablacoordenadaslevtopo').DataTable();
        $('#tablacoordenadaslevtopo tbody').on('click', 'tr', function () {
          if ( $(this).hasClass('active') ) {
            $(this).removeClass('active');
            $("#btnedicoord").prop('disabled', true);
          }
          else {
            table1.$('tr.active').removeClass('active');
            $(this).addClass('active');
            $("#btnedicoord").prop('disabled', false);
            $( "#proceso" ).val($('td', this).eq(0).text());
          }
        });       
      });   
    </script>
@stop
@endif<!--Cierra el if de mostrar el contenido de la página si esta autenticado-->