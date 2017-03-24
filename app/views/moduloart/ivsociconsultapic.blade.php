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
<script src="assets/art/js/wNumb.js"></script>    
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
<!--aca se escribe el codigo-->
    <div class="col-sm-1"></div>
    <div class="col-sm-10">
        <h2 class="text-center text-primary">Consulta PIC</h2>
        <br>
        <p class="lead text-justify">A continuación se presenta el avance de los proyectos de pequeña infraestructura comunitaria-PIC para su consulta.</p>  
    </div>  
    <div class="col-sm-1"></div>
    </div>
    <div class="row">
    <div class="col-sm-1"></div>
      <div class="col-sm-8">
        <button id="consultar" disabled="disabled" type="button" class="btn btn-primary" data-toggle="modal" data-target="#consultar_norma">Consultar Proyecto</button>
      </div>
      <div class="col-sm-2">
        <a href='Excelpic'><img class="img-responsive" src='assets/img/excel.png'></img></a>   
      </div>
    </div>
     <div class="row">
    <div class="col-sm-1"></div>
    <div class="col-sm-10">
        <h2 class="text-center text-primary">Proyectos</h2>
        <table id="tabla_pic" class="table table-striped table-bordered nowrap">
          <thead>
            <tr class="text-primary" data-toggle="tooltip" data-placement="top" >              
              <th class="text-center">ID</th>
              <th class="text-center">Departamento</th>
              <th class="text-center">Municipio</th>
              <th class="text-center">Núcleo veredal</th>              
              <th class="text-center">Proyecto</th>
              <th class="text-center">Ranking</th>
              <th class="text-center">Priorización</th> 
              <th class="text-center">Validación</th>                             
            </tr>
          </thead>
          <tbody>
            @foreach($arrayindipic as $pro) 
              <tr id="{{$pro->id_proy}}"> 
                <td >{{$pro->ID}} </td> 
                <td >@foreach($arraydepto as $key=>$val) @if($pro->cod_depto==$key) {{$val}} @endif @endforeach </td> 
                <td >@foreach($arraymuni as $key=>$val) @if($pro->cod_mpio==$key) {{$val}} @endif @endforeach </td> 
                <td id="{{$pro->cod_nucleo}}" name="nucle">@foreach($arraynucleos as $key=>$val) @if($pro->cod_nucleo==$key) {{$val}} @endif @endforeach </td> 
                <td >{{$pro->nom_proy}}</td>
                <td >{{$pro->ranking}}</td>
                <td align="center"><p style="display:none;"></p><span class="glyphicon glyphicon-ok-sign" aria-hidden="true" style="color:green"></span></td>
                @if($pro->id_viabi==2)<td id="esta_via" align="center"><p style="display:none" >{{$pro->id_viabi}}</p><span class="glyphicon glyphicon-ok-sign" aria-hidden="true" style="color:green"></span></td>
                  @elseif($pro->id_viabi==3)<td id="esta_via" align="center"><p style="display:none;">{{$pro->id_viabi}}</p><span class="glyphicon glyphicon-remove-sign" aria-hidden="true" style="color:red"></span></td>
                  @else <td id="esta_via" align="center"><p style="display:none;">{{$pro->id_viabi}}</p><span class="glyphicon glyphicon-alert" aria-hidden="true" style="color:orange"></span></td>                   
                  @endif
              </tr> 
            @endforeach 
          </tbody>
        </table>  
        </div>        
      <div class="col-sm-1"></div>  
      <!--Aca inicia el modal para cargar nuevo proyecto-->
        <!-- Modal -->
        <div class="modal fade" id="consultar_norma" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-keyboard="false" data-backdrop="static">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="PIC_95001011039">Consulta del Proyecto </h4>
              </div>
                <div class="modal-body">
                    <div class="tabbable"> <!-- Only required for left/right tabs -->
                    <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab1" data-toggle="tab">Priorización</a></li>
                    <li><a href="#tab2" data-toggle="tab">Validación</a></li>
                    </ul>
                    <div class="tab-content">
                    <div class="tab-pane active" id="tab1">
                        <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%" id="tabla_prioriza">
                          <thead>
                          <tr class="text-primary" data-toggle="tooltip" data-placement="top" >
                            <th class="text-center">Item</th>    
                            <th class="text-center">Valor</th>
                          </tr>
                          <tbody>
                            <tr>
                              <td>ID</td>
                              <td id="id"></td>
                            </tr>
                            <tr>
                              <td>Nombre de la Iniciativa</td>
                              <td id="nombre"></td>
                            </tr>
                            <tr>
                              <td>Alcance</td>
                              <td ><div id="alcance" style="overflow-y:scroll; width:100%;max-height: 350px;" ></div></td>
                            </tr>
                            <tr>
                              <td>Categoría</td>
                              <td id="categoria"></td>
                            </tr>
                            <tr>
                              <td>Subcategoría</td>
                              <td id="subcategoria"></td>
                            </tr>
                            <tr>
                              <td>Intervención</td>
                              <td id="intervencion"></td>
                            </tr>
                            <tr>
                              <td>Estado</td>
                              <td id="estado"></td>
                            </tr>
                            <tr>
                              <td>Precio estimado</td>
                              <td id="precio"></td>
                            </tr>
                            <tr>
                              <td>Valor cofinanciado</td>
                              <td id="cofinanciado"></td>
                            </tr>
                            <tr>
                              <td>Ranking</td>
                              <td id="ranking"></td>
                            </tr> 
                            <tr>
                              <td>Fecha de priorización</td>
                              <td id="fecha"></td>
                            </tr> 
                            <tr>
                              <td>Acta de priorizacón</td>
                              <td > 
                                <span class="col-xs-1">
                                  <a id="acta" target="_blank" href="" class="glyphicon glyphicon-download-alt btn btn-success" role="button"></a>
                                </span></td>
                            </tr>
                            <tr>
                              <td>Responsable</td>
                              <td id="responsable"></td>
                            </tr>
                            <tr>
                              <td>Departamento</td>
                              <td id="depto"></td>
                            </tr>   
                            <tr>
                              <td>Municipio</td>
                              <td id="mpio"></td>
                            </tr>
                            <tr>
                              <td>Núcleo veredal</td>
                              <td id="nucleo"></td>
                            </tr>
                            <tr>
                              <td>Tipo de territorio</td>
                              <td id="terr"></td>
                            </tr>             
                          </tbody>  
                          </thead>

                        </table>
                    </div>
                    <div class="tab-pane" id="tab2" style="overflow-y: scroll; width: auto; max-height: 734px;">
                      <p>No hay Datos</p>
                    </div>
                    </div>
                    </div>
               </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>                
                </div>
              
            </div>
          </div>
        </div>
        <!--Aca finaliza el modal para cargar nuevo proyecto-->         
<!--fin del codigo-->    
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
@section('jsbody')
  @parent

    <script>
      $(document).ready(function() {          
          //para que los menus pequeño y grande funcione
          $( "#art" ).addClass("active");
          $( "#ivsociconsultapicmenu" ).addClass("active");
          $( "#iniciomenupeq" ).html("<small> INICIO</small>");
          $( "#artmenupeq" ).html("<strong>ART<span class='caret'></span></strong>");
          $( "#ivsociconsultapicmenupeq" ).html("<strong><span class='glyphicon glyphicon-ok'></span>Cosulta PIC</strong>");
          $( "#mensajeestatus" ).fadeOut(5000);

          table=$('#tabla_pic').DataTable({
              "scrollX": true,
              "order": [[ 3, "asc" ],[ 5, "asc" ]]
          });
               
      });

      $('#tabla_pic tbody').on('click', 'tr', function () {
            var Format = wNumb({
              prefix: '$ ',
              decimals: 0,
              thousand: '.'
          }); 

            if ( $(this).hasClass('active') ) {
              $(this).removeClass('active');
              $("#consultar").prop('disabled', true);
            }else {
              table.$('tr.active').removeClass('active');
              $(this).addClass('active');
              $("#consultar").prop('disabled', false);
              num =$('tr', this).context.id;
              nucleo =$(this).find('td')[3].id;
              esta_via=$(this).find('p')[1].innerHTML;

              $.ajax({url:"artpic/select-consulta-pic",type:"POST",data:{proy:num},dataType:'json',
                  success:function(data){ 
                    $("#PIC_95001011039").html("Consulta del Proyecto "+data['arrayprio'][0].ID);
                    $("#id").html(data['arrayprio'][0].ID);
                    $("#nombre").html(data['arrayprio'][0].Nombre_iniciativa);
                    $("#alcance").html(data['arrayprio'][0].Alcance);
                    $("#categoria").html(data['cate'][0].nombre);
                    $("#responsable").html(data['arrayprio'][0].usuario);
                    $("#subcategoria").html(data['arrayprio'][0].subcategoria);
                    $("#intervencion").html(data['arraysubsubcate'][0].nombre);
                    $("#estado").html(data['arrayprio'][0].Estado_iniciativa);
                    $("#precio ").html(Format.to(Number(data['arrayprio'][0].Precio_Estimado)));
                    $("#cofinanciado").html(Format.to(Number(data['arrayprio'][0].Valor_cofinanciado)));
                    $("#ranking ").html(data['arrayprio'][0].ranking);
                    $("#fecha").html(data['arrayprio'][0].Fecha_priorizacion);
                    $("#acta").attr("href", data['arrayprio'][0].acta)
                    $("#depto ").html(data['arrayprio'][0].NOM_DPTO);
                    $("#mpio").html(data['arrayprio'][0].NOM_MPIO_1);
                    $("#nucleo ").html(data['arrayprio'][0].nucleo_veredal);
                    $("#terr").html(data['arraytipoterr']);
                    obs=data['arrayprio'][0].obs;
                    },
                  error:function(){alert('error');}
              });//Termina Ajax
            }
      });

      $('#consultar').on('click',function () {//function que crea los criterios y precarga los acrvhivos segun condicionales de criterios en un modal
             
            if (esta_via==1){
              var estado="<ul style='padding-top:10px;padding-left: 15px'> <li>El estado del proyecto es en: <strong>Estudio</strong> (<span class='glyphicon glyphicon-alert' aria-hidden='true' style='color:orange'>)</li></<ul>";
              var observa="";
            }else if(esta_via==2){
               var estado="<ul style='padding-top:10px;padding-left: 15px'> <li>El estado del proyecto es: <strong>Válido</strong> (<span class='glyphicon glyphicon-ok-sign' aria-hidden='true' style='color:green'></span>)</li></<ul>";
               var observa="<div class='panel panel-success'> <div class='panel-body' style='padding-left: 18px'>"+obs+"</div></div>";

            }else{
              var estado="<ul style='padding-top:10px;padding-left: 15px'> <li>El estado del proyecto es : <strong>No valido</strong> (<span class='glyphicon glyphicon-remove-sign' aria-hidden='true' style='color:red'></span>)</li></<ul>";
              var observa="<div class='panel panel-danger'> <div class='panel-body' style='padding-left: 18px'>"+obs+"</div></div>";

            }
            $('#tab2').html(estado);
            if(obs!=null && obs!=""){
              $('#tab2').append("<ul style='padding-top:10px;padding-left: 15px'> <li>La <strong>observación</strong> para el estado es: </li></ul>");
              $('#tab2').append(observa);
            }
            
             $('#tab2').append("<ul style='padding-top:10px;padding-left: 15px'> <li>El listado muestra el estado de los documentos para cada criterio requerido:</li></ul>");
                

            $.ajax({url:"artpic/criterios",type:"POST",data:{proy:num,nucleo:nucleo},dataType:'json',
                success:function(data){
                      var  divs= $('<div class="panel panel-default">');

                     for(var i = 0; i < data['array_viable'].length; i++){
                        if (i%2==0)
                        {
                          var color="#FAF6F5";
                        }else{
                          var color="";
                        }
                        var div2 = document.createElement("div");
                        div2.style="background:"+color+";";
                        var div1 = document.createElement("div");
                        div1.className ="row";
                        div1.style="padding: 0;margin: 0;margin-bottom:10px;padding-left: 18px";

                        var div = document.createElement("div");
                        div.className ="col-sm-8";
                        div.style="padding: 0;margin: 0;margin-top:10px;padding-left: 18px";
                        var Label = document.createElement("label");
                        Label.style="padding: 0;margin: 0;";
                        Label.innerHTML= "<p>"+data['array_viable'][i]+"</p>";
                        div.append("Criterio "+(parseInt(i)+parseInt(1))+": ");
                        div.append(Label);
                        div1.append(div);
                        div2.append(div1);
                        var div = document.createElement("div");
                        div.className ="col-sm-3";
                        var span = document.createElement("span");
                        var a = document.createElement("a");
                        a.id=i;
                        a.className="glyphicon glyphicon-download-alt btn btn-success";
                        a.title="Descargue aquí el archivo adjunto";
                        if(data['array_viable_file'][i]=="No tiene"){
                          a.setAttribute('disabled','true')
                          a.className="glyphicon glyphicon-download-alt btn btn-default ";
                          a.title="No hay archivo para este criterio";
                        }else if(data['array_viable_file'][i]=="No aplica"){
                          a.setAttribute('disabled','true')
                          a.className="glyphicon glyphicon-download-alt btn btn-success";
                          a.title="No aplica archivo para este criterio";
                        }else{
                          a.href=data['array_viable_file'][i];
                          a.target ="_blank";
                        }
                        a.style="margin-top:10px;";
                        a.role="button";
                        span.append(a);
                        div.append(span);
                        div1.append(div);
                        div2.append(div1);
                        divs.append(div2);
                        divs.append("<br>");
                    }


                        divs.append("</div>");           
                        divs.append('</div>'); 

                        $('#tab2').append(divs)

                         
                  },
                error:function(){alert('error');}
            });//Termina Ajax
       });
    </script>    
@stop

@endif<!--Cierra el if de mostrar el contenido de la página si esta autenticado-->