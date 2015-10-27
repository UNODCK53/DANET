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
     <?php $status=Session::get('status'); ?>
      
      @if($status=='ok_estatus')
      <br>
      <div class="col-sm-1"></div>    
      <div id = "mensajeestatus" class="alert alert-success col-sm-10"><button class="close" data-dismiss="alert" type="button">×</button>
      <i class="bg-success"></i>El documento fue cargado con éxito</div>
      <div class="col-sm-1"></div>
      @endif
      @if($status=='error_estatus')
      <br>
      <div class="col-sm-1"></div>    
      <div id = "mensajeestatus"class="alert alert-danger col-sm-10"><button class="close" data-dismiss="alert" type="button">×</button>
      <i class="bg-danger"></i> El documento NO fue cargado</div>
      <div class="col-sm-1"></div>
      @endif
    </div>
    <div class="row">
      <!--Texto del contenido-->
        <div class="col-sm-1"></div>
        <div class="col-sm-10">
            <h3 class="text-center text-primary">CARGUE DE DOCUMENTOS</h3>
            <br>

            <form role="form" action="documentos/adjuntar-docu" method="post" id="formEdit" enctype="multipart/form-data">
              <div class="form-group">
                <label for="carguedocu" class="control-label">Categoria:</label>
                <select id="selectcategoria" class="form-control" name="selectcategoria" required="true">
                    <option value="" selected="selected">Por favor seleccione</option>
                    @foreach($arrayiniciales[0] as $catego)
                    <option value="{{$catego->id_categoria}}">{{$catego->categoria}}</option>              
                    @endforeach              
                </select>
              </div>
              <div class="form-group" id="estrategia">
                <label for="carguedocu" class="control-label">Estrategia:</label>
                <select id="selectestrategia" class="form-control" name="selectestrategia">
                    <option value="" selected="selected">Por favor seleccione</option>
                    @foreach($arrayiniciales[1] as $estrate)
                    <option value="{{$estrate->id_estrategia}}">{{$estrate->estrategia}}</option>              
                    @endforeach              
                </select>
              </div>
              <div class="form-group" id="carguedocumento">
                <label id="tipodocu" for="carguedocu" class="control-label">Tipo de documento:</label>
                <select id="selectipodocu" class="form-control" name="selectipodocu" required="true">                                 
                </select>
              </div>
              <div class="form-group" id="carguedocumento">
                <label id="tipodocu" for="carguedocu" class="control-label">Momento:</label>
                <select id="selecmomento" class="form-control" name="selecmomento">                    
                </select>
              </div>
              <div class="form-group" id="carguedocumento">
                <label id="tipodocu" for="carguedocu" class="control-label">Autor del documento:</label>
                <select id="selectautor" class="form-control" name="selectautor">
                    <option value="" selected="selected">Por favor seleccione</option>
                    @foreach($arrayiniciales[3] as $autor)
                    <option value="{{$autor->id_autor}}">{{$autor->autor}}</option>              
                    @endforeach                                 
                </select>
              </div>
              <div class="form-group" id="carguedocumento">
                <label id="tipodocu" for="carguedocu" class="control-label">Fecha del documento:</label>
                <div class="input-group date" id="datepicker">                      
                  <input id="selectfechadocu" type="text" class="form-control" name="selectfechadocu">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>                      
                </div>
              </div>
              <div class="form-group" id="carguedocumento">
                <label id="tipodocu" for="carguedocu" class="control-label">Referencia geográfica:</label>
                <select id="selecunigeo" class="form-control" name="selecunigeo">
                    <option value="" selected="selected">Por favor seleccione</option>
                    @foreach($arrayiniciales[2] as $unigeo)
                    <option value="{{$unigeo->id_ugeo}}">{{$unigeo->unidgeo}}</option>              
                    @endforeach                                 
                </select>
              </div>
              <div class="form-group" id="refegeo">
                <label id="tipodocu" for="carguedocu" class="control-label">Departamento:</label>
                    <select id="selecdepto" class="form-control" name="selecdepto">
                      <option value="" selected="selected">Por favor seleccione</option>
                      @foreach($arrayiniciales[4] as $depto)
                        <option value="{{$depto->COD_DPTO}}">{{$depto->NOM_DPTO}}</option>              
                      @endforeach
                    </select>                    
              </div>
              <div class="form-group" id="divmpio">
                
              </div>
              <div class="form-group"  id="carguedocumento">                  
                  <label for="carguedocu" class="control-label">Adjuntar documento:</label>
                  <input id="filedocu" type="file" class="form-control" name="filedocu" required accept=".pdf">
              </div>   
              <hr>           
              <div class="form-group text-right"  id="carguedocumento">                
                <button type="submit" class="btn btn-primary">Guardar Edición General</button>
              </div>
              </form>            
        </div>
      <div class="col-sm-1"></div>
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
          $( "#documentos" ).addClass("active");
          $( "#carguedocumenu" ).addClass("active");
          $( "#iniciomenupeq" ).html("<small> INICIO</small>");
          $( "#documentosmenupeq" ).html("<strong>MODULO DOCUMENTOS<span class='caret'></span></strong>");
          $( "#carguedocumenupeq" ).html("<strong><span class='glyphicon glyphicon-ok'></span>Cargue documentos</strong>");
          $( "#mensajeestatus" ).fadeOut(5000);



          $('#datepicker').datepicker({
            format: "yyyy-mm-dd",
            language: "es",
            startDate: "2010-01-01",
            endDate: "today",
            todayBtn: "linked",
            orientation: "auto",
            autoclose: true,
            todayHighlight: true

           });

          $("#refegeo").hide();
          $("#estrategia").hide();
          //para cargar el select de tipo de categoria
          $("#selectcategoria").change(function(){
            if ($('#selectcategoria').val() == 1) {
              $("#selectestrategia").val("");
              $("#estrategia").show();
              $("#selectestrategia").prop('required',true);
            }
            else {
              $("#selectestrategia").val("");
              $("#estrategia").hide();
              $("#selectestrategia").prop('required',false);
            }

            $.ajax({url:"documentos/subcategoria",type:"POST",data:{categoria:$('#selectcategoria').val()},dataType:'json',
              success:function(data){

                  $("#selectipodocu").empty();
                  //console.log(data);
                  $("#selectipodocu").append("<option value=''>Por favor seleccione</option>");
                    [].forEach.call(data[0],function(datos){
                      $("#selectipodocu").append("<option value=\""+datos.id_tipo+"\">"+datos.tipo+"</option>");
                    });

                  $("#selecmomento").empty();
                  //console.log(data);
                  $("#selecmomento").append("<option value=''>Por favor seleccione</option>");                   
                    [].forEach.call(data[1],function(datos1){
                      $("#selecmomento").append("<option value=\""+datos1.id_momento+"\">"+datos1.momento+"</option>");
                    });
                     
              },
              error:function(){alert('error');}
            });//Termina Ajax 
          });   
          $("#selecunigeo").change(function(){              
              if ($('#selecunigeo').val() == 2) {
                  $('#selecdepto').val("");
                  $("#refegeo").show();
                  $("#divmpio").hide();
                  $("#selecdepto").prop('required',true);
                  
              } else if ($('#selecunigeo').val() == 3) {
                  $('#selecdepto').val("");
                  $("#divmpio").empty();
                  $("#refegeo").show();
                  $("#divmpio").show();
                  $("#selecdepto").prop('required',true);
                  
              } else {
                 $("#refegeo").hide();
                 $("#divmpio").hide();
                 $("#selecdepto").prop('required',false);
                 

              }
          });
          $("#selecdepto").change(function(){
            
            $.ajax({url:"documentos/submpio",type:"POST",data:{depto:$('#selecdepto').val()},dataType:'json',
              success:function(data){
                  $("#selecmpio").empty();
                  $("#divmpio").empty();
                                 
                  $("#divmpio").append('<label id="tipodocu" for="carguedocu" class="control-label">Municipio:</label><br>');
                    [].forEach.call(data,function(datos){                      
                      $('#divmpio').append('<input type="checkbox" value='+datos.COD_DANE+'> '+datos.NOM_MPIO.toLowerCase()+'<br>');
                    });                  
                     
              },
              error:function(){alert('error');}
            });//Termina Ajax
          });
          
      });
    </script>
@stop

@endif<!--Cierra el if de mostrar el contenido de la página si esta autenticado-->

                               