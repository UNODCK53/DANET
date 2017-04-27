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
      <h1 class="text-center text-primary">RELACIÓN DE PROCESOS ADJUDICADOS</h1>
    </div>

    <div class="row">
      <?php $status=Session::get('status'); ?>
      @if($status=='ok_estatus')
      <div class="col-sm-1"></div>    
      <div id = "mensajeestatus" class="alert alert-success col-sm-10"><button class="close" data-dismiss="alert" type="button">×</button>
      <i class="bg-success"></i> El proceso fue actualizado con éxito</div>
      <div class="col-sm-1"></div>
      @endif
      @if($status=='error_estatus')
      <div class="col-sm-1"></div>    
      <div id = "mensajeestatus"class="alert alert-danger col-sm-10"><button class="close" data-dismiss="alert" type="button">×</button>
      <i class="bg-danger"></i> El proceso NO fue actualizado</div>
      <div class="col-sm-1"></div>
      @endif
      <?php $actualizar=Session::get('actualizar');?>
      @if($actualizar!='')
      <div class="col-sm-1"></div>    
      <div id = "mensajeestatus" class="alert alert-success col-sm-10"><button class="close" data-dismiss="alert" type="button">×</button>
      <i class="bg-success"></i> El proceso {{$actualizar}} quedo actualizado con éxito </div>
      <div class="col-sm-1"></div>
      @endif
      <?php $documentosanexos=Session::get('documentosanexos'); ?>
      @if($documentosanexos!='')
      <div class="col-sm-1"></div>    
      <div id = "mensajeestatus" class="alert alert-success col-sm-10"><button class="close" data-dismiss="alert" type="button">×</button>
      <i class="bg-success"></i> Al proceso {{$documentosanexos}} se le adjunto con éxito el documento</div>
      <div class="col-sm-1"></div>
      @endif
      @if($documentosanexos=='error_doc')
      <div class="col-sm-1"></div>    
      <div id = "mensajeestatus"class="alert alert-danger col-sm-10"><button class="close" data-dismiss="alert" type="button">×</button>
      <i class="bg-danger"></i> El documento NO se adjuntó</div>
      <div class="col-sm-1"></div>
      @endif
      @if($status=='ok_fc')
      <div class="col-sm-1"></div>    
      <div id = "mensajeestatus" class="alert alert-success col-sm-10"><button class="close" data-dismiss="alert" type="button">×</button>
      <i class="bg-success"></i> Se generó exitosamente la ficha de caracterización</div>
      <div class="col-sm-1"></div>
      @endif

    </div>

    <div class="row">
      <div class="col-sm-1"></div>
      <div class="col-sm-10">
      <form role="form" action="tierras/editar-proceso" method="post" id="formEdit">
        <!-- Standard button -->
        <button id="btnedipro" title="Presione para activar la edicion del estudio juridico" disabled="disabled" type="submit" type="button" class="btn btn-primary">Editar Proceso</button>
        <input id="proceso" type="hidden" class="form-control" name="proceso">
      </div>
      <div class="col-sm-1"></div>
    </div>
    <div class="row">
    <!--Listado de Procesos Iniciales para edicion -->
      </br>
      <div class="col-sm-1"></div>
      <div class="col-xs-12 col-sm-10" >
        <table id="tablaresumen" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
          <thead>
            <tr class="well text-primary ">
              <th class="text-center">Proceso</th>
              <th class="text-center">Estudio Jurídico</th>
              <th class="text-center">Levantamiento Topográfico</th>
              <th class="text-center">Radicado</th>
              <th class="text-center">Visita de Inspección</th>
              <th class="text-center">Resultado Procesal</th>
              <th class="text-center">Registro ORIP</th>
            </tr>
          </thead>
          <tbody>
            @foreach($arrayproceso as $pro)
              <tr id="{{$pro->id_proceso}}"> 
                <td >{{$pro->id_proceso}}</td>
                @if($pro->estudiojuridico==1)<td align="center"><p style="display:none;">{{$pro->estudiojuridico}}</p><span class="glyphicon glyphicon-ok-sign" aria-hidden="true" style="color:green"></span></td> @else <td align="center"><p style="display:none;">{{$pro->estudiojuridico}}</p><span class="glyphicon glyphicon-remove-sign" aria-hidden="true" style="color:red"></span></td> @endif
                @if($pro->levantamientotopografico==1)<td align="center"><p style="display:none;">{{$pro->levantamientotopografico}}</p><span class="glyphicon glyphicon-ok-sign" aria-hidden="true" style="color:green"></span></td> @elseif ($pro->levantamientotopografico==0) <td align="center"><p style="display:none;">{{$pro->levantamientotopografico}}</p><span class="glyphicon glyphicon-remove-sign" aria-hidden="true" style="color:red"></span></td> @else <td align="center"><p style="display:none;">{{$pro->levantamientotopografico}}</p><span class="glyphicon glyphicon-warning-sign" aria-hidden="true" style="color:Orange"></span></td> @endif
                @if($pro->radicado==1)<td align="center"><p style="display:none;">{{$pro->radicado}}</p><span class="glyphicon glyphicon-ok-sign" aria-hidden="true" style="color:green"></span></td> @else <td align="center"><p style="display:none;">{{$pro->radicado}}</p><span class="glyphicon glyphicon-remove-sign" aria-hidden="true" style="color:red"></span></td> @endif
                @if($pro->visitainspeccionocular==1)<td align="center"><p style="display:none;">{{$pro->visitainspeccionocular}}</p><span class="glyphicon glyphicon-ok-sign" aria-hidden="true" style="color:green"></span></td> @elseif ($pro->visitainspeccionocular==0) <td align="center"><p style="display:none;">{{$pro->visitainspeccionocular}}</p><span class="glyphicon glyphicon-remove-sign" aria-hidden="true" style="color:red"></span></td> @else <td align="center"><p style="display:none;">{{$pro->visitainspeccionocular}}</p><span class="glyphicon glyphicon-warning-sign" aria-hidden="true" style="color:Orange"></span></td> @endif
                @if($pro->resultadoprocesal==1)<td align="center"><p style="display:none;">{{$pro->resultadoprocesal}}</p><span class="glyphicon glyphicon-ok-sign" aria-hidden="true" style="color:green"></span></td> @else <td align="center"><p style="display:none;">{{$pro->resultadoprocesal}}</p><span class="glyphicon glyphicon-remove-sign" aria-hidden="true" style="color:red"></span></td> @endif
                @if($pro->registroorip==1)<td align="center"><p style="display:none;">{{$pro->registroorip}}</p><span class="glyphicon glyphicon-ok-sign" aria-hidden="true" style="color:green"></span></td> @else <td align="center"><p style="display:none;">{{$pro->registroorip}}</p><span class="glyphicon glyphicon-remove-sign" aria-hidden="true" style="color:red"></span></td> @endif                                               
              </tr>
            @endforeach
          </tbody>
        </table>
      </form>
      </div>
      <div class="col-sm-1"></div>
      </br>
    </div>
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
          $( "#tierrascargaproceso" ).addClass("active");
          $( "#iniciomenupeq" ).html("<small> INICIO</small>");
          $( "#tierrasmenupeq" ).html("<strong>MÓDULO TIERRAS<span class='caret'></span></strong>");
          $( "#tierrasestjurmenupeq" ).html("<strong><span class='glyphicon glyphicon-ok'></span>Procesos Adjudicados</strong>");
          $( "#mensajeestatus" ).fadeOut(5000);


          var table = $('#tablaresumen').DataTable();

          $('#tablaresumen tbody').on('click', 'tr', function () {
              if ( $(this).hasClass('active') ) {
                $(this).removeClass('active');
                $("#btnedipro").prop('disabled', true);
              }
              else {
                table.$('tr.active').removeClass('active');
                $(this).addClass('active');
                $("#btnedipro").prop('disabled', false);
                $( "#proceso" ).val($('td', this).eq(0).text());
                
              }
              
          });       
      });

    </script>
@stop

@endif<!--Cierra el if de mostrar el contenido de la página si esta autenticado-->