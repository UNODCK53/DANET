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
    <!--aca se escribe el codigo-->
    <div class="row">
        <h1 class="text-center text-primary">RELACIÓN DE PROCESOS ADJUDICADOS PARA EDICIÓN DE COORDENADAS</h1>
    </div>
    <div class="row">
      <?php $status=Session::get('status'); ?>
      @if($status=='true')
        <div class="col-sm-1"></div>
        <div id = "mensajeestatus" class="alert alert-success col-sm-10"><button class="close" data-dismiss="alert" type="button">×</button>
          <i class="bg-success"></i> Las coordenadas fueron actualizadas con éxito</div>
        <div class="col-sm-1"></div>
      @endif
      @if($status=='false')
        <div class="col-sm-1"></div>
        <div id = "mensajeestatus"class="alert alert-danger col-sm-10"><button class="close" data-dismiss="alert" type="button">×</button>
          <i class="bg-danger"></i> Las coordenadas NO fueron actualizadas</div>
        <div class="col-sm-1"></div>
      @endif
    </div>
    <div class="row">
      <div class="col-sm-1"></div>
      <form role="form" action="tierras/coordenadas-edicion" method="post" id="formconsulpro">
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
        <table id="tablacoordenadas" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
          <thead>
            <tr class="well text-primary ">
              <th class="text-center">Proceso</th>
              <th class="text-center">Modificación de Coordenadas</th>
              <th class="text-center">latitud</th>
              <th class="text-center">longitud</th>
            </tr>
          </thead>
          <tbody>
            @foreach($arrayproccoord as $coordenadas)
              <tr id="{{$coordenadas->id_proceso}}">
                <td>{{$coordenadas->id_proceso}}</td>
                @if($coordenadas->updatedcoord<>NULL)
                  <td align="center"><p style="display:none;">{{$coordenadas->updatedcoord}}</p><span class="glyphicon glyphicon-ok-sign" aria-hidden="true" style="color:green"></span></td> @else <td align="center"><p style="display:none;">{{$coordenadas->updatedcoord}}</p><span class="glyphicon glyphicon-remove-sign" aria-hidden="true" style="color:red"></span></td>
                @endif
                <td>{{$coordenadas->latitud}}</td>
                <td>{{$coordenadas->longitud}}</td>
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
@section('js')
  @parent
    <script>
      $(document).ready(function() {
        //para que los menus pequeño y grande funcione
        $( "#tierras" ).addClass("active");
        $( "#tierrascoord" ).addClass("active");
        $( "#iniciomenupeq" ).html("<small> INICIO</small>");
        $( "#tierrasmenupeq" ).html("<strong>MODULO TIERRAS<span class='caret'></span></strong>");
        $( "#tierrascoordmenupeq" ).html("<strong><span class='glyphicon glyphicon-ok'></span>Edición de Coordenadas</strong>");
        $( "#mensajeestatus" ).fadeOut(5000);
        var table = $('#tablacoordenadas').DataTable();
        $('#tablacoordenadas tbody').on('click', 'tr', function () {
          if ( $(this).hasClass('active') ) {
            $(this).removeClass('active');
            $("#btnedicoord").prop('disabled', true);
          }
          else {
            table.$('tr.active').removeClass('active');
            $(this).addClass('active');
            $("#btnedicoord").prop('disabled', false);
            $( "#proceso" ).val($('td', this).eq(0).text());
          }
        });
      });
    </script>
@stop
@endif<!--Cierra el if de mostrar el contenido de la página si esta autenticado-->