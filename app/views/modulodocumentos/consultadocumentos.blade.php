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
      <h3 class="text-center text-primary">CONSULTA DE DOCUMENTOS</h3>
      <br/>
      <div class="col-sm-12">
      <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#busbasic">Búsqueda básica</a></li>
        <li><a data-toggle="tab" href="#busdetallada">Búsqueda detallada</a></li>
        <li><a data-toggle="tab" href="#busgeo">Búsqueda geográfica</a></li>    
      </ul>
      </div>
      <div class="tab-content">
        <div id="busbasic" class="tab-pane fade in active">
          <div class="col-sm-1"></div>
          <div class="col-sm-10">
            <h3>Búsqueda básica:</h3>
            <p>Usted puede realizar una búsqueda por cualquier palabra que usted crea que puede estar en el título del documento, categoría, tipo de documento, autor, departamento, municipio, etc.</p>
           
            <form class="form-inline text-center">
              <input type="text" class="form-control" size="70" id="querybusqueda" name="querybusqueda" data-toggle="tooltip" title="Ingrese una palabra clave que quiera buscar" placeholder="Ingrese una palabra clave que quiera buscar">
              <button id="querybusquedas" type="button" class="btn btn-primary">Búsqueda básica</button>
            </form>
          </div>
          <div class="col-sm-1"></div>
        </div>
        <div id="busdetallada" class="tab-pane fade">
          
          <h3>Menu 1</h3>
          <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
          <form role="form" action="#" method="post" id="formbusdetallada">
            <div class="row">
              <div class="col-sm-4">        
                <div class="col-sm-1"></div>
                <div class="col-sm-10" id="sha">
                  <!--aca se escribe el codigo-->
                  <div class="form-group">
                    <br/>
                    <label for="carguedocu" class="control-label"> Departamento:</label><br>
                    <input type="checkbox" name="doc" value="1"> Documento LB 2012<br>
                    <input type="checkbox" name="doc" value="1"> Documento SG 2012<br>
                    <input type="checkbox" name="doc" value="1"> Informes Rápidos SG 2012<br>
                  </div>
                  <br>
                </div>
                <div class="col-sm-1"></div>
                <!--fin del codigo-->
              </div>
              <div class="col-sm-4">
                <div class="col-sm-1"></div>
                <div class="col-sm-10" id="sha">
                <!--aca se escribe el codigo-->
                  <br/>
                  <div class="form-group">
                    <label for="carguedocu" class="control-label"> Departamento:</label>
                    <select id="" class="form-control" name="">
                      <option value="" selected="selected">Por favor seleccione</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="carguedocu" class="control-label"> Municipio:</label>
                    <select id="" class="form-control" name="">
                      <option value="" selected="selected">Por favor seleccione</option>
                    </select>
                  </div>
                  <br/>
                <!--fin del codigo-->    
                </div>
                <div class="col-sm-1"></div>
              </div>
              <div class="col-sm-4">        
                <div class="col-sm-1"></div>
                <div class="col-sm-10" id="sha">
                <!--aca se escribe el codigo-->
                  <br/>
                  <div class="form-group">
                    <label for="carguedocu" class="control-label"> Año:</label>
                    <select id="" class="form-control" name="">
                      <option value="" selected="selected">Por favor seleccione</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="carguedocu" class="control-label"> Mes:</label>
                    <select id="" class="form-control" name="">
                      <option value="" selected="selected">Por favor seleccione</option>
                    </select>
                  </div>
                  <br/>
                <!--fin del codigo-->    
                </div>
                <div class="col-sm-1"></div>
              </div>
            </div>
            <div class="row">
              <div class="form-group text-center"  id="carguedocumento">
                <br/>
                <button type="submit" class="btn btn-primary">Consultar Documentos seleccionados</button>
              </div>
            </div>
          </form>
        </div>
        <div id="busgeo" class="tab-pane fade">
          <h3>Menu 2</h3>
          <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
        </div>
        <div class="bs-example">
    <div class="progress">
        <div class="progress-bar" style="width: 60%;">
            60%
        </div>
    </div>
</div>    
      </div>
    </div>
  
<br>
    <!-- AQUI FOREACH PARA MOSTRAR LOS DOCUMENTOS DE LA CONSULTA-->
    
      <div class="row" id="dosselec">
        <div class="col-sm-1"></div>
        <div class="col-sm-10" id="sha" >
          <div class="row" id="espacioresultado">
            
            <div class="col-sm-1"></div>
            <div class="col-sm-10 list-group" id="resultado">
            <!--aca se muestran los documentos que se buscaron-->




            </div>
            <div class="col-sm-1"></div>
          </div>
        </div>
        <div class="col-sm-1"></div>
      </div>
      <br/>
      <!-- AQUI END FOREACH PARA MOSTRAR LOS DOCUMENTOS DE LA CONSULTA-->
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
      
      $(document).ready(function(){
        //para que los menus pequeño y grande funcione
        $("#documentos").addClass("active");
        $("#consultadocumenu").addClass("active");
        $("#iniciomenupeq").html("<small> INICIO</small>");
        $("#documentosmenupeq").html("<strong>MÓDULO DOCUMENTOS<span class='caret'></span></strong>");
        $("#consultadocumenupeq").html("<strong><span class='glyphicon glyphicon-ok'></span>Consulta de documentos</strong>");
        $("#espacioresultado").hide();

        // activar mensaje para los tooltip
        $('[data-toggle="tooltip"]').tooltip(); 
        
        $("#querybusquedas").click(function(){          
          //alert($("#querybusqueda").val());
          $("#espacioresultado").show();
          $.ajax({url:"documentos/busquedabasica",type:"post",data:{querybusqueda:$('#querybusqueda').val()},dataType:'json',
                success:function(data){
                    console.log(data);
                    $("#resultado").empty();
                    $("#resultado").append('<br>');                    
                    [].forEach.call(data,function(datos){
                        $("#resultado").append('<li class="list-group-item"><div class="media"><div class="media-left media-middle"><img src="assets/img/masterdocu.png" width="106" height="138" alt="..."></div><div class="media-body"><h4 class="media-heading">Titulo: '+datos.titulo+'</h4><p><strong>Categoría: </strong>'+datos.categoria+'</p><p><strong>Contraparte: </strong>'+datos.contraparte+'</p><p><strong>Tipo de documento: </strong>'+datos.tipo+'</p><p><strong>Estrategia: </strong>'+datos.estrategia+'</p><p><strong>Bloque o Modalidad: </strong>'+datos.bloque+'</p><p><strong>Proyecto: </strong>'+datos.id_proyecto+'</p><p><strong>Momento: </strong>'+datos.momento+'</p><p><a href="" class="btn btn-primary" role="button">Mas info...</a></p></div></div></li>');
                      });
                    

                },
                error:function(){alert('error');}
              });//Termina Ajax 
        });        
      });
    </script>
@stop
@endif<!--Cierra el if de mostrar el contenido de la página si esta autenticado-->