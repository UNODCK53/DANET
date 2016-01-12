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
      <h2 class="text-center text-primary">Consulta de documentos</h2>
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
           
            <div class="form-inline text-center">
              <input type="hidden">
              <input type="text" class="form-control" onkeypress="if (event.keyCode == 13){$('#querybusquedas').trigger( 'click' );}" size="70" id="querybusqueda" name="querybusqueda" data-toggle="tooltip" title="Ingrese una palabra clave que quiera buscar" placeholder="Ingrese una palabra clave que quiera buscar">
              <input type="hidden">
              <button id="querybusquedas" type="button" class="btn btn-primary">Búsqueda básica</button>
            </div>
          </div>
          <div class="col-sm-1"></div>
        </div>
        <div id="busdetallada" class="tab-pane fade">
          <div class="col-sm-1"></div>
            <div class="col-sm-10">
              <h3>Búsqueda detallada</h3>
              <p>Usted puede realizar una búsqueda combinando las opciones de tipo de documento, departamento, municipio, fecha o por cada una de ellas. </p>
            </div>
          <div class="col-sm-1"></div>
          <form>
          <!--<form role="form" action="documentos/datosbusqueda" method="post" id="formbusdetallada" enctype="multipart/form-data">-->
            <div class="row">
              <div class="col-sm-4">
                <div class="col-sm-1"></div>
                <div class="col-sm-10" id="sha">
                  <!--aca se escribe el codigo-->
                  <div class="form-group">
                    <br>
                    <label for="carguedocu" class="control-label">Tipo de documentos:</label><br>
                    <div class="btn-group-vertical" role="group" aria-label="...">
                      <?php $i=0; ?>
                      @foreach($dat[1] as $datos)
                      <?php $i++; ?>
                      <button id="<?php echo $i ?>" type="button" class="btn btn-default" value="{{$datos->tipo}}" name="tipodoc">{{$datos->nombre}} <span class="badge"> {{$datos->totaltipo}}</span></button>
                      @endforeach
                      <input type="hidden" id="valtipo"name="valtipo" value="">
                    </div>
                    <br>
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
                    <select id="seldpto" class="form-control" name="seldpto">
                      <option value="" selected="selected">Por favor seleccione</option>
                      @foreach($dat[2] as $geo)
                      <option value="{{$geo->COD_DEPTO}}">{{$geo->NOM_DPTO}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="carguedocu" class="control-label"> Municipio:</label>
                    <select id="selmpio" class="form-control" name="selmpio">
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
                    <label for="carguedocu" class="control-label"> Fecha:</label>
                    <div class="input-daterange input-group" id="datepicker">
                      <span class="input-group-addon">Inicio</span>
                      <input id="start"type="text" class="input-sm form-control" name="start" />
                      <span class="input-group-addon">fin</span>
                      <input id="end"type="text" class="input-sm form-control" name="end" />
                    </div>
                  <br/>
                  <div class="row" id="ba">
                    <div class="col-sm-1"></div>
                  <span class="label label-warning" id="b"></span>
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
                <button id="busqavan" type="button" class="btn btn-primary">Consultar documentos seleccionados</button>
                <br/>
                <span class="label label-warning" id="a"></span>
              </div>
            </div>
          </form>
        </div>
        <div id="busgeo" class="tab-pane fade">
          <h3>Menu 2</h3>
          <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
        </div>
        <div class="bs-example">
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
                var txt1 ='<li class="list-group-item">'
                +'<div class="media">'
                +'<div class="media-left media-middle">'
                +'<img src="assets/img/masterdocu.png" width="106" height="138" alt="...">'
                +'</div>'
                +'<div class="media-body"><h4 class="media-heading">Título: '+datos.titulo+'</h4>'
                +'<p><strong>Categoría: </strong>'+datos.categoria+'</p>';
                if(datos.contrapate!=null){
                  var txt2 = '<p><strong>Contraparte: </strong>'+datos.contrapate+'</p>';
                }
                else{
                  var txt2 = '<strong></strong>';
                }
                if(datos.tipo!=null){
                  var txt3 = '<p><strong>Tipo de documento: </strong>'+datos.tipo+'</p>';
                }
                else{
                  var txt3 = '<strong></strong>';
                }
                if(datos.estrategia!=null){
                  var txt4 = '<p><strong>Estrategía: </strong>'+datos.estrategia+'</p>';
                }
                else{
                  var txt4 = '<strong></strong>';
                }
                if(datos.bloque!=null){
                  var txt5 = '<p><strong>Bloque o Modalidad: </strong>'+datos.bloque+'</p>';
                }
                else{
                  var txt5 = '<strong></strong>';
                }
                if(datos.id_proyecto!=null){
                  var txt6 = '<p><strong>Proyecto: </strong>'+datos.id_proyecto+'</p>';
                }
                else{
                  var txt6 = '<strong></strong>';
                }
                if(datos.momento!=null){
                  var txt7 = '<p><strong>Momento: </strong>'+datos.momento+'</p>';
                }
                else{
                  var txt7 = '<strong></strong>';
                }
                var txtf ='<p><a href="" class="btn btn-primary" role="button">Mas info...</a></p></div></div></li>';
                $("#resultado").append(txt1+txt2+txt3+txt4+txt5+txt6+txt7+txtf);
              });
            },
            error:function(){alert('error');}
          });//Termina Ajax
        });//Termina querybusquedas
        <?php $i=0; ?>
        @foreach($dat[1] as $datos)
        <?php $i++; ?>;
        $('#'+<?php echo $i; ?>).click(function(){
          $('#valtipo').val({{$datos->tipo}});
          $('.btn').removeClass("active");
           $('#'+<?php echo $i; ?>).addClass("active");
        });
        @endforeach
        $("#seldpto").change(function(){
          $.ajax({url:"documentos/consultampio",type:"POST",data:{dpto:$('#seldpto').val()},dataType:'json',
            success:function(data1){ 
              $("#selmpio").empty();
              $("#selmpio").append("<option value=''>Por favor seleccione</option>");
              $.each(data1, function(nom,datos){
                $("#selmpio").append("<option value=\""+datos.COD_DANE+"\">"+datos.NOM_MPIO+"</option>");
              });
            },
            error:function(){alert('error');}
          });//Termina Ajax
        });//Termina chage seldpto
        $('#datepicker').datepicker({
          startDate: "{{$dat[3]}}",
          endDate: "{{$dat[4]}}",
          maxViewMode: 0,
          language: "es",
          autoclose: true
        });//Termina datepicker
        $("#busqavan").click(function(){
          //alert($("#querybusqueda").val());
          if(($('#valtipo').val()=="")&&($('#seldpto').val()=="")&&($('#selmpio').val()=="")&&($('#start').val()=="")&&($('#end').val()=="")){
            $('#a').show();
            $('#a').text("Seleccione mínimo una opción");
            $('#a').fadeOut(5000);
          }
          else if((($('#start').val()!="")&&($('#end').val()==""))||(($('#start').val()=="")&&($('#end').val()!=""))){
            $('#b').show();
            $('#b').text("Seleccione un rango válido");
            $('#b').fadeOut(5000);
          }
          else{
            $("#espacioresultado").show();
            $.ajax({url:"documentos/datosbusqueda",type:"post",data:{valtipo:$('#valtipo').val(), seldpto:$('#seldpto').val(),selmpio:$('#selmpio').val(),start:$('#start').val(),end:$('#end').val(), },dataType:'json',
              success:function(data){
                console.log(data);
                $("#resultado").empty();
                $("#resultado").append('<br>');
                [].forEach.call(data,function(datos){
        var txt1='<li class="list-group-item">'
                  +'<div class="media">'
                    +'<div class="media-left media-middle">'
                      +'<img src="assets/img/masterdocu.png" width="106" height="138" alt="...">'
                    +'</div>'
                    +'<div class="media-body">'
                      +'<h4 class="media-heading">Título: '+datos.titulo+'</h4>'
                      +'<p><strong>Categoría: </strong>'+datos.categoria+'</p>';
                        if(datos.contrapate!=null){
                          var txt2 = '<p><strong>Contraparte: </strong>'+datos.contrapate+'</p>';
                        }
                        else{
                          var txt2 = '<strong></strong>';
                        }
                        if(datos.tipo!=null){
                          var txt3 = '<p><strong>Tipo de documento: </strong>'+datos.tipo+'</p>';
                        }
                        else{
                          var txt3 = '<strong></strong>';
                        }
                        if(datos.estrategia!=null){
                          var txt4 = '<p><strong>Estrategía: </strong>'+datos.estrategia+'</p>';
                        }
                        else{
                          var txt4 = '<strong></strong>';
                        }
                        var txtm ='</div>'
                        +'<div class="media-body">';
                        if(datos.bloque!=null){
                          var txt5 = '<p><strong>Bloque o Modalidad: </strong>'+datos.bloque+'</p>';
                        }
                        else{
                          var txt5 = '<strong></strong>';
                        }
                        if(datos.id_proyecto!=null){
                          var txt6 = '<p><strong>Proyecto: </strong>'+datos.id_proyecto+'</p>';
                        }
                        else{
                          var txt6 = '<strong></strong>';
                        }
                        if(datos.momento!=null){
                          var txt7 = '<p><strong>Momento: </strong>'+datos.momento+'</p>';
                        }
                        else{
                          var txt7 = '<strong></strong>';
                        }
                        if(datos.autor!=null){
                          var txt8 = '<p><strong>Autor: </strong>'+datos.autor+'</p>';
                        }
                        else{
                          var txt8 = '<strong></strong>';
                        }
                      var txtf ='<p><a href="" class="btn btn-primary" role="button">Mas info...</a></p>'
                    +'</div>'
                  +'</div>'
                +'</li>';
                  $("#resultado").append(txt1+txt2+txt3+txt4+txt5+txt6+txt7+txt8+txtf);
                });
              },
              error:function(){alert('error');}
            });//Termina Ajax
          }//termina else
          $("#valtipo").val("");
          $("#seldpto").val("");
          $("#selmpio").empty();
          $("#selmpio").append("<option value=''>Por favor seleccione</option>");
          $("#start").val("");
          $("#end").val("");
          $('.btn').removeClass("active");
        });//Termina busqavan
      });//Termina documentready
    </script>
@stop
@endif<!--Cierra el if de mostrar el contenido de la página si esta autenticado-->