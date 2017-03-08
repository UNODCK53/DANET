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
        <table id="tabla_pic" class="table table-striped table-bordered dt-responsive nowrap">
          <thead>
            <tr class="well text-primary" data-toggle="tooltip" data-placement="top" >              
              <th class="text-center">ID</th>
              <th class="text-center">Departamento</th>
              <th class="text-center">Municipio</th>
              <th class="text-center">Núcleo veredal</th>              
              <th class="text-center">Proyecto</th>
              <th class="text-center">Priorización</th> 
              <th class="text-center">Viabilización</th>                             
            </tr>
          </thead>
          <tbody>
            @foreach($arrayindipic as $pro) 
              <tr id="{{$pro->id_proy}}"> 
                <td >{{$pro->ID}} </td> 
                <td >@foreach($arraydepto as $key=>$val) @if($pro->cod_depto==$key) {{$val}} @endif @endforeach </td> 
                <td >@foreach($arraymuni as $key=>$val) @if($pro->cod_mpio==$key) {{$val}} @endif @endforeach </td> 
                <td >@foreach($arraynucleos as $key=>$val) @if($pro->cod_nucleo==$key) {{$val}} @endif @endforeach </td> 
                <td >{{$pro->nom_proy}}</td>
                <td align="center"><p style="display:none;"></p><span class="glyphicon glyphicon-ok-sign" aria-hidden="true" style="color:green"></span></td>
                <td align="center"><p style="display:none;"></p><span class="glyphicon glyphicon-remove-sign" aria-hidden="true" style="color:red"></span></td>
              </tr> 
            @endforeach 
          </tbody>
        </table>  
        </div>        
      <div class="col-sm-1"></div>  
      <!--Aca inicia el modal para cargar nuevo proyecto-->
        <!-- Modal -->
        <div class="modal fade" id="consultar_norma" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Consulta de Proyectos PIC</h4>
              </div>
                <div class="modal-body">
                    <div class="tabbable"> <!-- Only required for left/right tabs -->
                    <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab1" data-toggle="tab">Prioriazación</a></li>
                    <li><a href="#tab2" data-toggle="tab">Viabilización</a></li>
                    </ul>
                    <div class="tab-content">
                    <div class="tab-pane active" id="tab1">
                        <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%" id="tabla_prioriza">
                          <thead>
                          <tr class="well text-primary" data-toggle="tooltip" data-placement="top" >
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
                                  <a id="acta" target="_blank" href="" class="glyphicon glyphicon-download-alt btn btn-primary" role="button"></a>
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
                    <div class="tab-pane" id="tab2">
                      <p>No hay Datos</p>
                    </div>
                    </div>
                    </div>
               </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>                
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

          table=$('#tabla_pic').DataTable();
               
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
              var num =$('tr', this).context.id;
              $.ajax({url:"artpic/select-consulta-pic",type:"POST",data:{proy:num},dataType:'json',
                  success:function(data){ 
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

                    },
                  error:function(){alert('error');}
              });//Termina Ajax
            }


      });
    </script>    
@stop

@endif<!--Cierra el if de mostrar el contenido de la página si esta autenticado-->