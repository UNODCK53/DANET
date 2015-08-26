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
              <tr id="{{$pro->id_proceso}}"> 
                <td >{{$pro->id_proceso}}</td>
                <td >{{$pro->conceptojuridico}}</td>
              </tr>
        @endforeach
        
        
        <h1 class="text-center text-primary">EDICION PROCESO NP:{{$pro->id_proceso}}</h1>
      </div>
       <hr>       
      <div class="row">      
        <div class="col-sm-1"></div>               
        <div class="col-sm-10">
        <h3 class="text-primary">EDICION GENERAL:</h3>      
        
        <form role="form" action="tierras/crear-proceso" method="get" id="formEdit">
          <div class="form-group">
            <label for="Proceso" class="control-label">NP:</label>
            <input id="modnp" type="text" class="form-control" name="modnp"  value='{{$pro->id_proceso}}' readonly>
          </div>
          <div class="form-group">
            <label for="proceso" class="control-label">Concepto juridico:</label>
            <input id="modconcpjuri" type="text" class="form-control" name="modconcpjuri" value='{{$pro->conceptojuridico}}' readonly>
            @foreach($arraydombobox[0] as $concep)

            @endforeach

            {{$arraydombobox[0][2]->id_concepto}}


            


            <input id="modconcpjuri" type="text" class="form-control" name="modconcpjuri" value='{{$concep->subconcepto}}' readonly>
          </div>
          <div class="form-group">
            <label for="Proceso" class="control-label">Observacion concepto juridico:</label>
            <textarea id="modobsconcjuri" class="form-control" name="modobsconcjuri" value='{{$pro->obsconceptojuridico}}'></textarea>
          </div>
          <div class="col-sm-4 form-group">
            <label for="Proceso" class="control-label">Area predio a formalizar:</label>
            <input id="modarea" type="text" class="form-control" name="modarea" value='{{$pro->areapredioformalizada}}' >
          </div>
          <div class="col-sm-4 form-group">
            <label for="Proceso" class="control-label">Latitud:</label>
            <input id="modlat" type="text" class="form-control" name="modlat" value='{{$pro->latitud}}' >
          </div>
          <div class="col-sm-4 form-group">
            <label for="Proceso" class="control-label">Longitud:</label>
            <input id="modlong" type="text" class="form-control" name="modlong" value='{{$pro->longitud}}' >
          </div>          
          <div class="form-group">
            <label for="Proceso" class="control-label">Viable:</label><br>
            <input type="radio" name="modviable" id="respoviasi" value="1" > SI
            <input type="radio" name="modviable" id="respoviano" value="2"> NO
          </div>
          <div class="form-group" id="obsvial">
            <label for="Proceso" class="control-label">Observacion viabilidad:</label>
            <textarea id="modobsviab" name="modobsviab" class="form-control" value='{{$pro->id_proceso}}'></textarea>
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
        </form>          
        </div>              
        <div class="col-sm-1"></div>
      </div>
      <hr>
      <div class="row">
        <div class="col-sm-1"></div>               
          <div class="col-sm-10">
          <h3 class="text-primary">LEVANTAMIENTO TOPOGRAFICO:</h3>
          </div> 
        <div class="col-sm-1"></div>        
      </div>
      <hr>
      <div class="row">
        <div class="col-sm-1"></div>               
          <div class="col-sm-10">
          <h3 class="text-primary">RADICADO:</h3>
          </div> 
        <div class="col-sm-1"></div>        
      </div>
      <hr>
      <div class="row">
        <div class="col-sm-1"></div>               
          <div class="col-sm-10">
          <h3 class="text-primary">VISITA DE INSPECCION OCULAR:</h3>                  
                  <div class="input-group date" id="datepicker">
                      <input id="modfechaocular" type="text" class="form-control" name="modfechaocular" readonly>
                      <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                  </div>
          </div>
        <div class="col-sm-1"></div>        
      </div>
      <hr>
      <div class="row">
        <div class="col-sm-1"></div>               
          <div class="col-sm-10">
          <h3 class="text-primary">RESULTADO PROCESAL:</h3>
          </div> 
        <div class="col-sm-1"></div>        
      </div>
      <hr>
      <div class="row">
        <div class="col-sm-1"></div>               
          <div class="col-sm-10">
          <h3 class="text-primary">REGISTRO ORIP:</h3>
          </div> 
        <div class="col-sm-1"></div>        
      </div>
      <hr>

      <blockquote>
        <p>usted tiene pendiente realizar los siguientes.</p>
      </blockquote>
<!--fin del codigo-->    
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


        //para que los menus pequeño y grande funcione
        $( "#tierras" ).addClass("active");
        $( "#tierrascargaproceso" ).addClass("active");
        $( "#iniciomenupeq" ).html("<small> INICIO</small>");
        $( "#tierrasmenupeq" ).html("<strong>MODULO TIERRAS<span class='caret'></span></strong>");
        $( "#tierrasestjurmenupeq" ).html("<strong><span class='glyphicon glyphicon-ok'></span>Procesos Adjudicados</strong>");
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