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
      <!--Texto del contenido-->
        <div class="col-sm-1"></div>
        <div class="col-sm-10">
            <h3 class="text-center text-primary">CARGUE DE DOCUMENTOS</h3>
            <br>            

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
              <div class="col-sm-4 form-group">
                <label for="Proceso" class="control-label">Área predio a formalizar:</label>
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
                <input type="radio" name="modviable" id="respoviasi" value="1"> SI
                <input type="radio" name="modviable" id="respoviano" value="2"> NO
              </div>
              <div class="form-group" id="obsvial">
                <label for="Proceso" class="control-label">Observación viabilidad:</label>
                <textarea id="modobsviab" name="modobsviab" class="form-control">{{$pro->obsviabilidad}}</textarea>
              </div>
              <div class="form-group">
                <label for="Proceso" class="control-label" >Requiere responsable Geográfico:</label><br>
                <input type="radio" name="modradiorespogeo1" id="respogeosi" value="1" disabled='disabled'> SI
                <input type="radio" name="modradiorespogeo1" id="respogeono" value="2"checked disabled='disabled'> NO<br>
                <input type='hidden' name='modradiorespogeo' id='modradiorespogeo' value='{{$pro->requiererespgeo}}'>
              </div>
              <div class="form-group" id="respongeo">
                <label for="Proceso" class="control-label">Responsable Geográfico:</label>
                <select id="modrepogeo" class="form-control" name="modrepogeo">
                    <option value="" selected="selected">Por favor seleccione</option>
                    @foreach($arraydombobox[1] as $geo)
                    <option value="{{$geo->id}}">{{$geo->name}} {{$geo->last_name}}</option>              
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
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Guardar Edición General</button>
              </div>
            </form>



        </div>
      <div class="col-sm-1"></div>
    </div>
      <hr>
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
          $( "#tierraslevtopo" ).addClass("active");
          $( "#iniciomenupeq" ).html("<small> INICIO</small>");
          $( "#tierrasmenupeq" ).html("<strong>MODULO TIERRAS<span class='caret'></span></strong>");
          $( "#tierrasestjurmenupeq" ).html("<strong><span class='glyphicon glyphicon-ok'></span>Estudio Juridico</strong>");
          $( "#mensajeestatus" ).fadeOut(5000);

     
      });
    </script>
@stop

@endif<!--Cierra el if de mostrar el contenido de la página si esta autenticado-->