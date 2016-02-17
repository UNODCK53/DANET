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
            <h2 class="text-center text-primary">Cargar documentos</h2>
            <br>

            <form role="form" action="documentos/adjuntar-docu" method="post" id="formEdit" enctype="multipart/form-data">
              <div class="form-group">
                <label for="carguedocu" class="control-label">Título del documento:</label>
                <input  id = "titulo" name="titulo" class="form-control" type="text" required="true" placeholder="Ejemplo: Reporte mundial de drogas 2015"></input>
                
              </div>
              <div class="form-group">
                <label for="carguedocu" class="control-label">Categoría:</label>
                <select id="selectcategoria" class="form-control" name="selectcategoria" required="true">
                    <option value="" selected="selected">Seleccione el origen del documento</option>
                    @foreach($arrayiniciales[0] as $catego)
                    <option value="{{$catego->id_categoria}}">{{$catego->categoria}}</option>              
                    @endforeach              
                </select>
              </div>
            <div id="proyectocontraparte">
              <div class="form-group">
                <label for="carguedocu" class="control-label">Proyecto:</label>
                <select id="selectproyecto" class="form-control" name="selectproyecto" required="true">                                                    
                </select>
              </div>
              <div class="form-group">              
                <label for="carguedocu" class="control-label">Contraparte:</label>
                <select id="selectcontraparte" class="form-control" name="selectcontraparte" required="true">                                  
                </select>
              </div>              
            </div>
            <div class="form-group">              
                <label id="tipodocu" for="carguedocu" class="control-label">Tipo de documento:</label>
                <select id="selectipodocu" class="form-control" name="selectipodocu" required="true">                                 
                </select>
              </div>
            <div id="estrategia">
              <div class="form-group">              
                <label for="carguedocu" class="control-label">Estrategia:</label>
                <select id="selectestrategia" class="form-control" name="selectestrategia" required="true">                                
                </select>
              </div>

              <div class="form-group" id="bloquemodalidad">
                <label for="carguedocu" class="control-label">Bloque o Modalidad:</label>
                <select id="selectbloque" class="form-control" name="selectbloque" required="true">                               
                </select>
              </div>
              <div class="form-group" id="momento">
                <label id="tipodocu" for="carguedocu" class="control-label">Momento:</label>
                <select id="selecmomento" class="form-control" name="selecmomento" required="true">   
                  <option value=''></option>                    
                </select>
              </div>
            </div>
              <div class="form-group" id="carguedocumento">
                <label id="tipodocu" for="carguedocu" class="control-label">Autor del documento:</label>
                <input id="selectautor" class="form-control" name="selectautor" required="true" placeholder="Ejemplo: UNODC"></input>
              </div>
              <div class="form-group" id="carguedocumento">
                <label id="tipodocu" for="carguedocu" class="control-label">Fecha del documento:</label>
                <div class="input-group date" id="datepicker">                      
                  <input id="selectfechadocu" type="text" class="form-control" name="selectfechadocu" required="true" placeholder="Fecha de elaboración del documento">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>                      
                </div>
              </div>
              <div class="form-group" id="carguedocumento">
                <label id="tipodocu" for="carguedocu" class="control-label">Referencia geográfica:</label>
                <select id="selecunigeo" class="form-control" name="selecunigeo" required="true">
                    <option value="" selected="selected">Referencia administrativa de elaboración del documento</option>
                    @foreach($arrayiniciales[1] as $unigeo)
                    <option value="{{$unigeo->id_ugeo}}">{{$unigeo->unidgeo}}</option>              
                    @endforeach                                 
                </select>
              </div>
              <div class="form-group" id="refegeo">
                <label id="tipodocu" for="carguedocu" class="control-label">Departamento:</label>
                    <select id="selecdepto" class="form-control" name="selecdepto">
                      <option value="" selected="selected">Por favor seleccione</option>
                      @foreach($arrayiniciales[2] as $depto)
                        <option value="{{$depto->COD_DPTO}}">{{$depto->NOM_DPTO}}</option>              
                      @endforeach
                    </select>                    
              </div>
              <div class="form-group" id="divmpio">
                  
              </div>
              <div class="form-group"  id="carguedocumento">
                  <label for="carguedocu" class="control-label">Adjuntar documento:</label>
                  <input id="filedocu" type="file" class="form-control" name="filedocu" required accept=".pdf">
                  <p class="text-danger">El nombre de archivo no puede contener caracteres especiales como la tílde o la letra ñ</p>
                  <br>
              </div>
              <hr>
              <div class="form-group text-right"  id="carguedocumento">                
                <button type="submit" class="btn btn-primary">Guardar documento</button>
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
          
          $('#selectcategoria').val("");
          $('#selecunigeo').val("");
          $('#filedocu').val("");
          $('#selectautor').val("");
          $('#selectfechadocu').val("");                    
          $("#refegeo").hide();
          
          //para cargar el select de tipo de categoria
          $("#selectcategoria").change(function(){            
            if ($('#selectcategoria').val() == 8) {               
                $("#bloquemodalidad").hide(1000);
                $("#selectbloque").prop('required',false);
            }else{
              $("#bloquemodalidad").show(1000);
              $("#selectbloque").prop('required',true);
            }
            if ($('#selectcategoria').val() >= 14) {               
                $("#proyectocontraparte").hide(1000);
                $("#selectproyecto,#selectcontraparte, #selecmomento,#selectbloque").prop('required',false);
            }else{
              $("#proyectocontraparte").show(1000);
              $("#selectproyecto,#selectcontraparte").prop('required',true);
            }
            if ((($('#selectcategoria').val() <= 11) && ($('#selectcategoria').val() >= 9)) || ($('#selectcategoria').val() == 14) || ($('#selectcategoria').val() == 15)) {
                $("#estrategia").hide(1000);
                $("#selectestrategia, #selecmomento, #selectbloque").prop('required',false);                
            }else{
              $("#estrategia").show(1000);
              $("#selectestrategia, #selecmomento").prop('required',true);
            }
                 
            if ($('#selectcategoria').val() != "") {
              $.ajax({url:"documentos/subcategorias",type:"POST",data:{categoria:$('#selectcategoria').val()},dataType:'json',
                success:function(data){

                    $("#selectbloque").empty();
                    $("#selecmomento").empty();
                    $("#selectproyecto").empty();
                    //console.log(data);
                    $("#selectproyecto").append("<option value=''>Seleccione las siglas del proyecto</option>");
                      [].forEach.call(data[0],function(datos){
                        $("#selectproyecto").append("<option value=\""+datos.id_proyecto+"\">"+datos.id_proyecto+"</option>");
                      }); 
                    $("#selectcontraparte").empty();                    
                    $("#selectcontraparte").append("<option value=''>Seleccione el socio estratégico principal</option>");
                      [].forEach.call(data[1],function(datos1){
                        $("#selectcontraparte").append("<option value=\""+datos1.id_contraparte+"\">"+datos1.contrapate+"</option>");
                      });
                    $("#selectipodocu").empty();                    
                    $("#selectipodocu").append("<option value=''>Seleccione la opción que más se adecúe al documento que esta cargando</option>");
                      [].forEach.call(data[2],function(datos2){
                        $("#selectipodocu").append("<option value=\""+datos2.id_tipo+"\">"+datos2.tipo+"</option>");
                      });
                      $("#selectestrategia").empty();                    
                    $("#selectestrategia").append("<option value=''>Seleccione la estrategia de la contraparte que da sustento a la elaboración del documento</option>");
                      [].forEach.call(data[3],function(datos3){
                        $("#selectestrategia").append("<option value=\""+datos3.id_estrategia+"\">"+datos3.estrategia+"</option>");
                      });                     
                },
                error:function(){alert('error');}
              });//Termina Ajax 
            };
          });
          $("#selectestrategia").change(function(){              
             $.ajax({url:"documentos/selbloqmodmomen",type:"POST",data:{estrategia:$('#selectestrategia').val()},dataType:'json',
                success:function(data){

                    $("#selectbloque").empty();
                    //console.log(data);
                    $("#selectbloque").append("<option value=''>Seleccione de acuerdo a la estrategia</option>");
                      [].forEach.call(data[0],function(datos){
                        $("#selectbloque").append("<option value=\""+datos.id_bloque+"\">"+datos.bloque_modalidad+"</option>");
                      });
                    $("#selecmomento").empty();
                    $("#selecmomento").append("<option value=''>Etapa en la cual se realiza el monitoreo</option>");
                      [].forEach.call(data[1],function(datos1){
                        $("#selecmomento").append("<option value=\""+datos1.id_momento+"\">"+datos1.momento+"</option>");
                      });                       
                },
                error:function(){alert('error');}
              });//Termina Ajax 
          });

          $("#selecunigeo").change(function(){              
              if ($('#selecunigeo').val() == 2) {
                  $("#divmpio").empty();
                  $('#selecdepto').val("");
                  $("#refegeo").show(1000);
                  $("#divmpio").hide(1000);
                  $("#selecdepto").prop('required',true);
                  
              } else if ($('#selecunigeo').val() == 3) {
                  $("#divmpio").empty();
                  $('#selecdepto').val("");                  
                  $("#refegeo").show(1000);
                  $("#divmpio").show();                  
                  $("#selecdepto").prop('required',true);
                  
              } else {
                 $("#divmpio").empty();
                 $("#refegeo").hide();
                 $("#divmpio").hide();
                 $("#selecdepto").prop('required',false);
                 

              }
          });
          $("#selecdepto").change(function(){
            
            $.ajax({url:"documentos/submpio",type:"POST",data:{depto:$('#selecdepto').val()},dataType:'json',
              success:function(data){
                  $("#divmpio").empty();                                
                  $("#divmpio").append('<label id="tipodocu" for="carguedocu" class="control-label">Municipio(s):</label><br>');
                    [].forEach.call(data,function(datos3){                      
                      $('#divmpio').append('<input id="selectmpios" type="checkbox" name="selectmpios[]" value='+datos3.COD_DANE+'> '+datos3.NOM_MPIO+'<br>');
                    });                  
                     
              },
              error:function(){alert('error');}
            });//Termina Ajax
          });
          
      });
    </script>
@stop

@endif<!--Cierra el if de mostrar el contenido de la página si esta autenticado-->

                               