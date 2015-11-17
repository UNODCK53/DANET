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
              <th class="text-center">Vereda</th>
              <th class="text-center">Nombre del predio</th>              
              <th class="text-center">Nombre</th>
              <th class="text-center">Cédula</th>
              <th class="text-center">Área Predio Formalizada</td>
            </tr>
          </thead>
          <tbody>
            @foreach($arraylevtopo as $pro)
              <tr id="{{$pro->id_proceso}}">
                <td >{{$pro->id_proceso}}</td>
                <td >{{$pro->vereda}}</td>
                <td >{{$pro->nombrepredio}}</td>                
                <td >{{$pro->nombre}}</td>
                <td >{{$pro->cedula}}</td>                
                @if ($pro->areapredioformalizada==NULL)
                <td >0</td>
                @elseif ($pro->areapredioformalizada<>NULL)
                <td >{{$pro->areapredioformalizada}}</td>
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
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Adjuntar Documentos</button>
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
                $("#modnp").val($('td', this).eq(0).text());
               
              }
          });       
      });
    
    </script>
@stop

@endif<!--Cierra el if de mostrar el contenido de la página si esta autenticado-->