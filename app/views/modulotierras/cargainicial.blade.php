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
      <h1 class="text-center text-primary">PROCESOS INICIALES</h1>
    </div>
    
    <div class="row">
      <?php $status=Session::get('status'); ?>
      @if($status=='ok_estatus')
      <div class="col-sm-1"></div>    
      <div id = "mensajeestatus" class="alert alert-success col-sm-10"><button class="close" data-dismiss="alert" type="button">×</button>
      <i class="bg-success"></i> El proceso fue creado con exito</div>
      <div class="col-sm-1"></div>
      @endif
      @if($status=='error_estatus')
      <div class="col-sm-1"></div>    
      <div id = "mensajeestatus"class="alert alert-danger col-sm-10"><button class="close" data-dismiss="alert" type="button">×</button>
      <i class="bg-danger"></i> El proceso NO fue creado</div>
      <div class="col-sm-1"></div>
      @endif

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
        <table id="example" class="table table-striped table-bordered table-hover" cellspacing="100" width="100%">
          <thead>  
            <tr class="well text-primary ">
              <th class="text-center">Proceso</th>
              <th class="text-center">Vereda</th>
              <th class="text-center">Nombre del predio</th>
              <th class="text-center">Direccion Notificacion</th>
              <th class="text-center">Nombre</th>
              <th class="text-center">Cedula</th>
              <th class="text-center">Telefono</th>
              <th class="text-center">Area Preliminar</td>
            </tr>
          </thead>
          <tbody>
            @foreach($arrayproini as $pro)
              <tr id="{{$pro->id_proceso}}">
                <td >{{$pro->id_proceso}}</td>
                <td >{{$pro->vereda}}</td>
                <td >{{$pro->nombrepredio}}</td>
                <td >{{$pro->direccionnotificacion}}</td>
                <td >{{$pro->nombre}}</td>
                <td >{{$pro->cedula}}</td>
                <td >{{$pro->telefono}}</td>
                @if ($pro->areaprediopreliminar==NULL)
                <td >0</td>
                @elseif ($pro->areaprediopreliminar<>NULL)
                <td >{{$pro->areaprediopreliminar}}</td>
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
            <input id="modnp" type="text" class="form-control" name="modnp" readonly >
          </div>
          <div class="form-group">
            <label for="proceso" class="control-label">Concepto juridico:</label>
            <select id="modconcpjuri" "Seleccione el concepto" class="form-control" name="modconcpjuri" required>
                <option value="" selected="selected">Por favor seleccione</option>
             @foreach($arraydombobox[0] as $concep)
                <option value="{{$concep->id_concepto}}">{{$concep->subconcepto}}</option>              
              @endforeach              
            </select>
          </div>
          <div class="form-group">
            <label for="Proceso" class="control-label">Observacion concepto juridico:</label>
            <textarea id="modobsconcjuri" class="form-control" name="modobsconcjuri"></textarea>
          </div>
          <div class="form-group">
            <label for="Proceso" class="control-label">Area predio a formalizar:</label>
            <input id="modarea" type="number" class="form-control" name="modarea">
          </div>
          <div class="form-group">
            <label for="Proceso" class="control-label">Latitud:</label>
            <input id="modlat" type="number" class="form-control" name="modlat" value="0">
          </div>
          <div class="form-group">
            <label for="Proceso" class="control-label">Longitud:</label>
            <input id="modlong" type="number" class="form-control" name="modlong" value="0">
          </div>
          
          <div class="form-group">
            <label for="Proceso" class="control-label">Viable:</label><br>
            <input type="radio" name="modviable" id="respoviasi" value="1" checked> SI
            <input type="radio" name="modviable" id="respoviano" value="2"> NO

          </div>
          <div class="form-group" id="obsvial">
            <label for="Proceso" class="control-label">Observacion viabilidad:</label>
            <textarea id="modobsviab" name="modobsviab" class="form-control"></textarea>
          </div>
          <div class="form-group">
            <label for="Proceso" class="control-label" >Requiere responsable Geografico:</label><br>
            <input type="radio" name="modradiorespogeo" id="respogeosi" value="1"> SI
            <input type="radio" name="modradiorespogeo" id="respogeono" value="2"checked> NO<br>
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
            <input id="modvereda" type="text" class="form-control" name="modvereda">
          </div>
          <div class="form-group">
            <label for="Proceso" class="control-label">Nombre del predio:</label>
            <input id="modnompred" type="text" class="form-control" name="modnompred">
          </div>
          <div class="form-group">
            <label for="Proceso" class="control-label">Direccion para notificacion:</label>
            <input id="moddirnoti" type="text" class="form-control" name="moddirnoti">
          </div>
          <div class="form-group">
            <label for="Proceso" class="control-label">Nombre:</label>
            <input id="modnombre" type="text" class="form-control" name="modnombre">
          </div>
          <div class="form-group">
            <label for="Proceso" class="control-label">Cedula:</label>
            <input id="modcedula" type="number" class="form-control" name="modcedula">
          </div>
          <div class="form-group">
            <label for="Proceso" class="control-label">Telefono:</label>
            <input id="modtelefono" type="number" class="form-control" name="modtelefono">
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Confirmar Estudio Juridico</button>
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
        //modal-responsable geográfico
        $("#respongeo").hide();
        $('#respogeosi').click(function(){
          $("#respongeo").show();
        });
        $('#respogeono').click(function(){
          $("#respongeo").hide();
          $("#modrepogeo").val("");
        });
        //cierra modal responsable geografico
        //modal-viable y vialidad
        $('#respoviano').click(function(){
          $("#obsvial").hide();
          $("#modobsviab").val("");
        });
        $('#respoviasi').click(function(){
          $("#obsvial").show();
        });
        //cierra-modal-viable y vialidad

          //para que los menus pequeño y grande funcione
          $( "#tierras" ).addClass("active");
          $( "#tierrascargainicial" ).addClass("active");
          $( "#iniciomenupeq" ).html("<small> INICIO</small>");
          $( "#tierrasmenupeq" ).html("<strong>MODULO TIERRAS<span class='caret'></span></strong>");
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
                $("#modnp").val($('td', this).eq(0).text());
                $("#modvereda").val($('td', this).eq(1).text());
                $("#modnompred").val($('td', this).eq(2).text());
                $("#moddirnoti").val($('td', this).eq(3).text());
                $("#modnombre").val($('td', this).eq(4).text());
                $("#modcedula").val($('td', this).eq(5).text());
                $("#modtelefono").val($('td', this).eq(6).text());
                $("#modarea").val($('td', this).eq(7).text());
              }

          });               

      });

    </script>
@stop

@endif<!--Cierra el if de mostrar el contenido de la página si esta autenticado-->