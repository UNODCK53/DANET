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
        <h2 class="text-center text-primary">Validación de proyectos PIC</h2>
        <br>
        <p class="lead text-justify">En este módulo se realiza la validación de los proyectos PIC según los criterios necesarios para cada categoría, subcategoría y/o estado del proyecto.</p>  
    </div>  
    <div class="col-sm-1"></div>
    </div>
              <div class="row">
                    <?php $status=Session::get('status'); ?>
                    @if($status=='ok_estatus')
                    <div class="col-sm-1"></div>
                    <div id = "mensajeestatus" class="alert alert-success col-sm-10"><button class="close" data-dismiss="alert" type="button">×</button>
                    <i class="bg-success"></i> La acción se realizó con exito</div>
                    <div class="col-sm-1"></div>
                    @endif
                    @if($status=='error_estatus')
                    <div class="col-sm-1"></div>
                    <div id = "mensajeestatus"class="alert alert-danger col-sm-10"><button class="close" data-dismiss="alert" type="button">×</button>
                    <i class="bg-danger"></i> La acción no se realizó con exito</div>
                    <div class="col-sm-1"></div>
                    @endif
                      @if($status=='ok_estatus_editar')
                    <div class="col-sm-1"></div>
                    <div id = "mensajeestatus" class="alert alert-success col-sm-10"><button class="close" data-dismiss="alert" type="button">×</button>
                    <i class="bg-success"></i> Se editó el registro con éxito</div>
                    <div class="col-sm-1"></div>
                    @endif
                    @if($status=='error_estatus_editar')
                    <div class="col-sm-1"></div>
                    <div id = "mensajeestatus"class="alert alert-danger col-sm-10"><button class="close" data-dismiss="alert" type="button">×</button>
                    <i class="bg-danger"></i>  No se editó el registro</div>
                    <div class="col-sm-1"></div>
                    @endif

                    <?php $status=0; ?>
                </div>
    <div class="row">
    <div class="col-sm-1"></div>
      <div class="col-sm-2">
        <button id="criterios" disabled="disabled" type="button" class="btn btn-primary" data-toggle="modal" data-target="#carga_criterios">Evaluar criterios</button>
      </div>
      <div class="col-sm-2">
        <button id="viable" disabled="disabled" type="button" class="btn btn-success" data-toggle="modal" data-target="#viable_proyec">Validar proyecto</button>
      </div>
      <div class="col-sm-2">
        <button id="no_viable" disabled="disabled" type="button" class="btn btn-danger" data-toggle="modal" data-target="#no_viable_proyec">No validar proyecto</button>
      </div>
      <div class="col-sm-2">
        <button id="Recuperar" type="button" class="btn btn-warning" data-toggle="modal" data-target="#Recu_proyec">Recuperar proyecto</button>
      </div>
    </div>
<br>
    <div id="reporte" style='display:none'>
      <div  class="panel panel-default">
        <div class="panel-body">
        <h3 class="text-center text-primary" id="title2">Relación de precios entre el Proyecto seleccionado y los proyectos en su núcleo</h3>
        <br>
        <div class="row" >
            <div class="col-sm-1"></div>
            <div class="col-sm-3">
                 <div class="col-xs-12" align="center" >
                  <font size="6" id="pre_proy">0</font>
                </div>
                <div class="col-xs-12" align="center">
                  Precio PIC estimado del proyecto seleccionado
                </div>
            </div>  
            <div class="col-sm-3">
                 <div class="col-xs-12" align="center" >
                  <font size="6" id="num_viab_proy">0</font>
                </div>
                <div class="col-xs-12" align="center">
                  No. proyectos validados / No. iniciativas priorizadas para este núcleo
                </div>
            </div> 
            <div class="col-sm-3">
                 <div class="col-xs-12" align="center" >
                  <font size="6" id="pre_viab_proy">0</font>
                </div>
                <div class="col-xs-12" align="center">
                  Sumatoria de Precios PIC para proyectos validados en este núcleo + Precio PIC del proyecto seleccionado
                </div>
            </div>
            <!-- <div class="col-sm-3">
                 <div class="col-xs-12" align="center" >
                  <font size="6" id="pre_viab">0</font>
                </div>
                <div class="col-xs-12" align="center">
                  Sumatoria de Precios PIC para proyectos validados en este núcleo
                </div>
            </div> 
            <div class="col-sm-3">
                 <div class="col-xs-12" align="center" >
                  <font size="6" id="pre_prior">0</font>
                </div>
                <div class="col-xs-12" align="center">
                  Sumatoria de precios PIC para iniciativas priorizadas en este núcleo
                </div>
            </div>  -->
            
            <div class="col-sm-2"></div> 
        </div>
        <br>
 
          <hr>
          <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-6">
                <div class="col-sm-12" id="id">
                </div>
                <div class="col-sm-12" id="depto">
                </div>
                <div class="col-sm-12" id="mpio">
                </div>
                <div class="col-sm-12" id="nucleo">
                </div>
                <div class="col-sm-12" id="terr">
                </div>
                <div class="col-sm-12" id="nom_terr">
                </div>
                <div class="col-sm-12" id="categoria">
                </div>
                <div class="col-sm-12" id="subcategoria">
                </div>
                <div class="col-sm-12" id="intervencion">
                </div>
            </div>   
            <div class="col-sm-4"> 
                <div class="col-sm-12" id="nombre">
                </div>
                <div class="col-sm-12" id="estado">
                </div>
              
                <div class="col-sm-12" id="fecha">
                </div>
                <div class="col-sm-12" id="ranking">
                </div>
                <div class="col-sm-12" id="precio">
                </div>
                <div class="col-sm-12" id="cofinanciado">
                </div>
                <div class="col-sm-12" id="Total_precio">
                </div>
                <div class="col-sm-12" id="responsable">
                </div>
                <div class="col-sm-12" id="acta">
                </div>
            </div>
            <div class="col-sm-1"></div>
          </div>
          <div class="row">
            <div class="col-sm-1"> </div>
            <div class="col-sm-10">
              <div class="col-sm-12" id="alcance"></div>
              <div class="alert alert-danger col-sm-12" id="alert" style='display:none'>
                <strong>Alerta!</strong> Éste proyecto no puede validarse porque con él se supera los 450 millones del núcleo veredal 
              </div>
            </div>
            <div class="col-sm-1"></div>
          </div>
        </div>
        <br>
    </div>
  </div>



  <div class="row">
    <h2 class="text-center text-primary">Tabla de proyectos por validar</h2>
    <div class="col-sm-1 col-xs-1"></div>
    <div class="col-sm-10 col-xs-10">
        <table id="tabla_viabili" class="table table-striped table-bordered nowrap">
          <thead>
            <tr class="text-primary" data-toggle="tooltip" data-placement="top" >              
              <th class="text-center">ID</th>
              <th class="text-center">Departamento</th>
              <th class="text-center">Municipio</th>
              <th class="text-center">Núcleo veredal</th>              
              <th class="text-center">Proyecto</th>
              <th class="text-center">Ranking</th>
              <th class="text-center">Estado de validación</th>                            
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
                <td ><?php $no_tiene=0;
                      $tiene=0; 

                      foreach($change_viable as $pro2) {
                      
                      if($pro->id_proy==$pro2->id_proy) {
                          $no_tiene=$pro2->num;
                          break;
                          }else{
                              $no_tiene=0;
                            }
                        }  
                        foreach($change_viable_file as $pro3) {
                        if($pro->id_proy==$pro3->id_proy) {
                            $tiene=$pro3->num;
                            break;
                            }else{
                              $tiene=0;
                            }
                          }    
                        $text=  $tiene." de ".$no_tiene." criterios";
                        if($no_tiene==0){
                          $bar='<div class="progress" style="margin-bottom: 0px"><div class="progress-bar progress-bar-danger progress-bar-striped col-xs-12" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 0%; color: black"></div> </div>';
                        }elseif(($tiene/$no_tiene) < 0.35){
                          $bar='<div class="progress" style="margin-bottom: 0px"><div class="progress-bar progress-bar-danger progress-bar-striped col-xs-12" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: '.(($tiene/$no_tiene)*100).'%; color: black"></div> </div>';
                        }elseif(($tiene/$no_tiene) < 0.67){
                          $bar='<div class="progress" style="margin-bottom: 0px"><div class="progress-bar progress-bar-warning progress-bar-striped col-xs-12" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: '.(($tiene/$no_tiene)*100).'%; color: black"></div> </div>';
                        }else{
                           $bar='<div class="progress" style="margin-bottom: 0px"><div class="progress-bar progress-bar-success progress-bar-striped col-xs-12" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: '.(($tiene/$no_tiene)*100).'%; color: black"></div> </div>';
                        }
                        echo $bar;
                        echo $text;
                     ?>
                  </td> 
              </tr> 
            @endforeach 
          </tbody>
        </table>  
        </div>        
      <div class="col-sm-1 col-xs-1"></div>  
<!--fin del codigo-->    
    </div>
    <!--Aca inicia el modal para cargar criterios-->
    <div class="modal fade" id="carga_criterios" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-keyboard="false" data-backdrop="static">
            <div class="modal-dialog " role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="criterio_tittle">Documentos para validar el proyecto, según criterios</h4>
                </div>
                <div class="modal-body" style="max-height: calc(100vh - 210px);overflow-y: auto;">
                 
                       
                </div>    
              </div>
            </div>
          </div>
    
          <!--Aca finaliza el modal para cargar criterios-->

          <!--Aca inicia el modal para viabilizar criterios-->
    <div class="modal fade bs-example-modal-sm" id="viable_proyec" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-keyboard="false" data-backdrop="static">
            <div class="modal-dialog modal-sm" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="viabilizar_tittle">¿Desea validar el proyoceto?</h4>
                </div>
                <div class="modal-body">
                   <form role="form" action="artpic/proyecto-viavilizado" method="post" enctype="multipart/form-data" >
                      <input name='id_proy_viab' type=hidden id='id_proy_viab' value=""> 
                      <div class="form-group">
                        <label for="comment">Observación:</label>
                        <textarea class="form-control" rows="5" id="obs_viabl" name="obs_viabl"></textarea>
                      </div>
                      <button type="submit" class="btn btn-primary" >Si</button>
                     <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    </form>
                </div>    
              </div>
            </div>
          </div>
    
          <!--Aca finaliza el modal para viabilizar criterios-->
          <!--Aca inicia el modal para noviabilizar criterios-->
    <div class="modal fade bs-example-modal-sm" id="no_viable_proyec" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-keyboard="false" data-backdrop="static">
            <div class="modal-dialog modal-sm" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="no_viabilizar_tittle">¿Esta seguro de NO validar el proyecto?</h4>
                </div>
                <div class="modal-body">
                   <form role="form" action="artpic/proyecto-no-viavilizado" method="post" enctype="multipart/form-data" >
                      <input name='id_proy_no_viab' type=hidden id='id_proy_no_viab' value=""> 
                      <div class="form-group">
                        <label for="comment">Observación:</label>
                        <textarea class="form-control" rows="5" id="obs_no_viabl" name="obs_no_viabl" required ></textarea>
                      </div>
                      <button type="submit" class="btn btn-primary" >Si</button>
                      <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    </form>
                </div>    
              </div>
            </div>
          </div>
    
          <!--Aca finaliza el modal para noviabilizar criterios-->
          <!--Aca inicia el modal para recuperar proyecto-->
    <div class="modal fade" id="Recu_proyec" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-keyboard="false" data-backdrop="static">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="no_viabilizar_tittle">Recuperar proyecto para validación</h4>
                </div>
                <div class="modal-body" >
                   <table id="tabla_recupera" class="table table-striped table-bordered nowrap">
                      <thead>
                        <tr class="text-primary" data-toggle="tooltip" data-placement="top" >              
                          <th class="text-center"> Identificador del proyecto</th>
                          <th class="text-center">Departamento</th>
                          <th class="text-center">Municipio</th>
                          <th class="text-center">Núcleo veredal</th>              
                          <th class="text-center">Proyecto</th>
                          <th class="text-center">Estado de validación</th>    
                          <th class="text-center">Ranking</th>
                          <th class="text-center">Observación</th>                                
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($arrayindipic_recupe as $pro) 
                          <tr id="{{$pro->id_proy}}"> 
                            <td >{{$pro->ID}} </td> 
                            <td >@foreach($arraydepto as $key=>$val) @if($pro->cod_depto==$key) {{$val}} @endif @endforeach </td> 
                            <td >@foreach($arraymuni as $key=>$val) @if($pro->cod_mpio==$key) {{$val}} @endif @endforeach </td> 
                            <td id="{{$pro->cod_nucleo}}" name="nucle">@foreach($arraynucleos as $key=>$val) @if($pro->cod_nucleo==$key) {{$val}} @endif @endforeach </td> 
                            <td >{{$pro->nom_proy}}</td>
                            @if($pro->id_viabi==2)<td align="center"><p style="display:none;">{{$pro->id_viabi}}</p><span class="glyphicon glyphicon-ok-sign" aria-hidden="true" style="color:green"></span></td>
                              @elseif($pro->id_viabi==3)<td align="center"><p style="display:none;">{{$pro->id_viabi}}</p><span class="glyphicon glyphicon-remove-sign" aria-hidden="true" style="color:red"></span></td>
                              @else <td align="center"><p style="display:none;">{{$pro->id_viabi}}</p><span class="glyphicon glyphicon-alert" aria-hidden="true" style="color:orange"></span></td>                   
                              @endif
                            <td >{{$pro->ranking}}</td>
                            <td >{{$pro->obs}}</td>
                          </tr> 
                        @endforeach 
                      </tbody>
                    </table>
                    <form role="form" action="artpic/proyecto-recuperado" method="post" enctype="multipart/form-data" >
                      <input name='id_proy_recu' type=hidden id='id_proy_recu' value=""> 
                      <button type="submit" class="btn btn-primary" >Recuperar</button>
                      <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    </form>
                </div>    
              </div>
            </div>
          </div> <!--Aca finaliza el modal para recuperar proyecto-->
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
          $( "#ivsociseguimientopicmenu" ).addClass("active");
          $( "#iniciomenupeq" ).html("<small> INICIO</small>");
          $( "#artmenupeq" ).html("<strong>ART<span class='caret'></span></strong>");
          $( "#ivsociseguimientopicmenupeq" ).html("<strong><span class='glyphicon glyphicon-ok'></span>Validación PIC</strong>");
          $( "#mensajeestatus" ).fadeOut(5000);
          
          table2=$('#tabla_recupera').removeAttr('width').DataTable({
              order: [[ 3, "asc" ],[ 5, "asc" ],[ 0, "asc" ]],
              scrollX: true,

          });
          table=$('#tabla_viabili').DataTable({
              "order": [[ 3, "asc" ],[ 5, "asc" ],[ 0, "asc" ]],
              "scrollX": true
          });
            $('#carga_criterios').on('show',function(){
            });
      });

      $('#tabla_viabili tbody').on('click', 'tr', function () {
            var Format = wNumb({
              prefix: '$ ',
              decimals: 0,
              thousand: '.'
          }); 

            if ( $(this).hasClass('active') ) {
              $(this).removeClass('active');
              $("#criterios").prop('disabled', true);
              $("#no_viable").prop('disabled', true);
              $("#reporte").css("display","none");
              
              
            }else {
              $("#reporte").css("display","block");
              table.$('tr.active').removeClass('active');
              $(this).addClass('active');
              $("#criterios").prop('disabled', false);
              num =$('tr', this).context.id;
              nucleo =$(this).find('td')[3].id;
              nucleo_nom =$(this).find('td')[3].innerHTML;
              $("#no_viable").prop('disabled', false);
              $('#no_viabilizar_tittle').text("¿Esta seguro de NO validar el proyecto PIC_"+nucleo+num+"?");
              $('#id_proy_no_viab').val(num);
              $('#criterio_tittle').text("Criterios para validar el proyecto PIC_"+nucleo+num);
              $('#title2').text("Relación de precios PIC entre el Proyecto seleccionado y los proyectos del núcleo "+nucleo_nom);
              $.ajax({url:"artpic/proyecto-para-viavilizar",type:"POST",data:{proy:num,nucleo:nucleo},dataType:'json',//funcion q validad si el proyecto ya teiene todos los criterios cargados y habilida el boton viavilizar. ademas carga los datos de realcion
                  success:function(data){
                    $("#pre_proy").html(Format.to(Number(data['precio'])));
                    //$("#pre_prior").html(Format.to(Number(data['precio_nucleo'][0]['prec_estim'])));
                    //$("#pre_viab").html(Format.to(Number(data['precio_nucleo_viablilizados'][0]['prec_estim'])));
                    if(data['precio_nucleo_viablilizados'][0]['prec_estim'] == null){
                      var valor=parseFloat(0)+parseFloat(data['precio']);
                      $("#pre_viab_proy").html(Format.to(Number(valor)));
                    }else{
                      var valor=parseFloat(data['precio_nucleo_viablilizados'][0]['prec_estim'])+parseFloat(data['precio']);
                      $("#pre_viab_proy").html(Format.to(Number(valor)));
                    }

                    if (valor>=350000000){
                      $("#pre_viab_proy").css("color","red");

                    }else if(valor<350000000 && valor>=250000000){
                      $("#pre_viab_proy").css("color","orange");
                    }else{
                      $("#pre_viab_proy").css("color","black");
                    }

                    $("#num_viab_proy").html(data['precio_nucleo_viablilizados'][0]['cuenta']+"/"+data['precio_nucleo'][0]['cuenta'])

                    if (data['numero']>0){
                       $("#viable").prop('disabled', false);
                       $('#viabilizar_tittle').text("¿Desea validar el proyecto PIC_"+nucleo+num+"?");
                       $('#id_proy_viab').val(num);
                       if (valor>450000000){
                        $("#viable").prop('disabled', true);
                        $("#alert").css("display","block");
                        $('#alert').html("<strong>Alerta!</strong> Éste proyecto no puede validarse porque con él se supera los 450 millones del núcleo veredal "+ nucleo_nom);
                      }else{
                        $("#viable").prop('disabled', false);
                        $("#alert").css("display","none");
                      }
                    }else{
                         $("#viable").prop('disabled', true);
                         $("#alert").css("display","none");
                    }

                  },
                  error:function(){alert('error');}
              });//Termina Ajax

              $.ajax({url:"artpic/select-consulta-pic",type:"POST",data:{proy:num},dataType:'json',//funcion quie trae los datos del proyecto
                  success:function(data){ 
                    $("#id").html("<strong>ID_Iniciativa: </strong>"+data['arrayprio'][0].ID);
                    $("#nombre").html("<strong>Nombre de iniciativa: </strong>"+data['arrayprio'][0].Nombre_iniciativa);
                    $("#categoria").html("<strong>Categoría: </strong>"+data['cate'][0].nombre);
                    $("#responsable").html("<strong>Responsable: </strong>"+data['arrayprio'][0].usuario);
                    $("#subcategoria").html("<strong>Subcategoría: </strong>"+data['arrayprio'][0].subcategoria);
                    $("#intervencion").html("<strong>Intervención: </strong>"+data['arraysubsubcate'][0].nombre);
                    $("#estado").html("<strong>Estado: </strong>"+data['arrayprio'][0].Estado_iniciativa);
                    $("#precio ").html("<strong>Precio estimado PIC: </strong>"+Format.to(Number(data['arrayprio'][0].Precio_Estimado)));
                    $("#cofinanciado").html("<strong>Total cofinanciación: </strong>"+Format.to(Number(data['arrayprio'][0].Valor_cofinanciado)));
                    $("#ranking ").html("<strong>Ranking: </strong>"+data['arrayprio'][0].ranking);
                    $("#fecha").html("<strong>Fecha de priorización: </strong>"+data['arrayprio'][0].Fecha_priorizacion);
                    $("#Total_precio").html("<strong>Precio total estimado: </strong>"+Format.to(Number(parseFloat(data['arrayprio'][0].Precio_Estimado)+parseFloat(data['arrayprio'][0].Valor_cofinanciado))));
                    $("#depto ").html("<strong>Departamento: </strong>"+data['arrayprio'][0].NOM_DPTO);
                    $("#mpio").html("<strong>Municipio: </strong>"+data['arrayprio'][0].NOM_MPIO_1);
                    $("#nucleo ").html("<strong>Núcleo veredal: </strong>"+data['arrayprio'][0].nucleo_veredal);
                    $("#terr").html("<strong>Tipo de territorio: </strong>"+data['arraytipoterr']);
                    $("#acta").html('<div class="col-xs-2" style="padding-left:0"><strong>Acta: </strong> </div><div class="col-xs-1" ><span > <a target="_blank" href='+ data["arrayprio"][0].acta+' class="glyphicon glyphicon-download-alt btn btn-success" role="button"></a></span>');
                    $("#alcance").html("<strong>Alcance: </strong>"+data['arrayprio'][0].Alcance);  
                    $("#nom_terr").html("<strong>Territorios: </strong>"+data['nomter'][0]['nom_terr']); 
                           
                    },
                  error:function(){alert('error');}
              });//Termina Ajax
            }
      });

    $('#tabla_recupera tbody').on('click', 'tr', function () {
          

            if ( $(this).hasClass('active') ) {
              $(this).removeClass('active');
              $("#Rec_proy").prop('disabled', true);
            }else {
              table2.$('tr.active').removeClass('active');
              $(this).addClass('active');
              $("#Rec_proy").prop('disabled', false);
              num2 =$('tr', this).context.id;
              nucleo2 =$(this).find('td')[3].id;
              $("#id_proy_recu").val(num2);
             
              
            
            }
      });
       

   
      $('#criterios').on('click',function () {//function que crea los criterios y precarga los acrvhivos segun condicionales de criterios en un modal
            $.ajax({url:"artpic/criterios",type:"POST",data:{proy:num,nucleo:nucleo},dataType:'json',
               
                 
                success:function(data){
                        array_viable_file=data['array_viable_id'];
                        array_viable_info=data['array_viable_info'];
                        var  divs= $('<div>');
                        var form = document.createElement("form");
                        form.setAttribute('method',"post");
                        form.setAttribute('action',"artpic/cargar-criterio");
                        form.setAttribute("enctype", "multipart/form-data");

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
                        div1.style="padding: 0;margin: 0;margin-bottom:10px;";

                        var div = document.createElement("div");
                        div.className ="form-group col-sm-8";
                        div.style="padding: 0;margin: 0;margin-top:10px";
                        var Label = document.createElement("label");
                        Label.style="padding: 0;margin: 0;";
                        Label.innerHTML= "<p>"+data['array_viable'][i]+"</p>";
                        div.append("Criterio "+(parseInt(i)+parseInt(1))+": ");
                        div.append(Label);
                        div1.append(div);
                        div2.append(div1);
                        var div = document.createElement("div");
                        div.className ="col-sm-1";
                        var span = document.createElement("span");
                        var a = document.createElement("a");
                        a.id=i;
                        a.className="glyphicon glyphicon-download-alt btn btn-success";
                        a.title="Descarque el archvio del Criterio";
                        if(data['array_viable_estado'][i]=="No tiene"){
                          a.setAttribute('disabled','true')
                          a.className="glyphicon glyphicon-download-alt btn btn-default ";
                          a.title="No hay archivo para este criterio";
                          var borr=0;
                        }else if(data['array_viable_estado'][i]=="No aplica"){
                          a.setAttribute('disabled','true')
                          a.className="glyphicon glyphicon-download-alt btn btn-success";
                          a.title="No aplica archivo para este criterio";
                          var borr=0;
                        }else{
                          a.href=data['array_viable_file'][i];
                          a.target ="_blank";
                           var div3 = document.createElement("div");
                            div3.className ="col-sm-1";
                            var span1 = document.createElement("span");
                            var a1 = document.createElement("a");
                            a1.id=data['array_viable_id'][i];
                            a1.name=num;
                            a1.className="glyphicon glyphicon glyphicon-trash btn btn-default";
                            a1.title="Borrar el archivo de este Criterio";
                            a1.style="margin-top:10px;";
                            a1.role="button";
                            a1.addEventListener("click", borr_crit);
                            var borr=1;
                        }
                        a.style="margin-top:10px;";
                        a.role="button";
                        span.append(a);
                        div.append(span);
                        div1.append(div);
                        if(borr==1){
                          span1.append(a1);
                          div3.append(span1);
                          div1.append(div3);
                        }
                        var div4 = document.createElement("div");
                        div4.className ="col-sm-1";
                        var span2 = document.createElement("span");
                        var a2 = document.createElement("a");
                        a2.className="glyphicon glyphicon glyphicon-info-sign btn btn-default";
                        a2.title="Obtener información acerca del documento para éste criterio";
                        a2.style="margin-top:10px;";
                        a2.role="button";
                        a2.id="inf-"+i;
                        var info=data['array_viable_info'][i];
                        a2.addEventListener("click", informa);
                        span2.append(a2);
                        div4.append(span2);
                        div1.append(div4);
                        div2.append(div1);
                        divs.append(div2);
                        divs.append("<br>");

                        var div1 = document.createElement("div");
                        div1.className ="row";
                        div1.style="padding: 0;margin: 0;background:"+color+";";

                        var div = document.createElement("div");
                        div.className ="form-group col-sm-3";
                        div.style="padding: 0;margin: 0;";
                        var Label = document.createElement("label");
                        Label.innerHTML="Cargar o editar el documento:";
                        div.append(Label);
                        div1.append(div);
                        var div = document.createElement("div");
                        div.className ="form-group col-sm-2";
                        div.style="right-padding: 0;margin: 0;";
                        var radio= document.createElement("input");
                        radio.type = "radio";
                        radio.name="r-"+i;
                        radio.value='1';
                        radio.required="true";
                        radio.addEventListener("click", cargar_doc);
                        if(data['array_viable_estado'][i]!="No aplica" || data['array_viable_estado'][i]!="No tiene" ){
                           radio.setAttribute('checked', 'checked');
                          }
                        var radio2= document.createElement("input");
                        radio2.type = "radio";
                        radio2.name="r-"+i;
                        radio2.value='2';
                        if(data['array_viable_estado'][i]=="No tiene" ){
                           radio2.setAttribute('checked', 'checked');
                          }
                        radio2.addEventListener("click", cargar_doc);
                        div.append(radio);
                        div.append("Si ");
                        div.append(radio2);
                        div.append("No ");
                        
                        if (data['array_viable'][i]=='Canteras para extracción de materiales pétreos'){
                          var radio3= document.createElement("input");
                          radio3.type = "radio";
                          radio3.name="r-"+i;
                          radio3.id="r-"+i;
                          radio3.value='3';
                          radio3.addEventListener("click", cargar_doc);
                          div.append(radio3);
                          div.append("No Aplica");
                          if(data['array_viable_estado'][i]=="No aplica"){
                           radio3.setAttribute('checked', 'checked');
                          }
                        }
                        div1.append(div);
                        var div = document.createElement("div");
                        div.className ="form-group col-sm-7";
                        div.style="right-padding: 0;margin: 0;";
                        var file= document.createElement("input");
                        file.type = "file";
                        file.className ="form-control";
                        file.name="f-"+i;
                        file.id="f-"+i;
                        file.accept=".pdf";
                        file.style="display:none";
                        div.append(file);
                        div1.append(div);
                        div2.append(div1);
                        divs.append(div2);

                        if (data['array_viable'][i]=='Canteras para extracción de materiales pétreos'){
                          var div1 = document.createElement("div");
                          div1.className ="row";
                          div1.id="obs";
                          div1.style="padding: 0;margin: 0;background:"+color+";display:none;"; 
                          var Label = document.createElement("label");
                          Label.innerHTML="Observaciones del porque no aplcia:";
                          var input=document.createElement("input");
                          input.setAttribute("type", "text");
                          input.className ="form-control";
                          input.id="obs_input";
                          input.name="obs_input";
                          if (data['array_viable_obs'][0]==null){var obs="";}else{var obs=data['array_viable_obs'][0];}
                          input.setAttribute("value", obs);
                          input.style="padding: 0;margin: 0;background:"+color+";";
                          input.setAttribute("placeholder"," Ingrese observación");
                          div1.append(Label);
                          div1.append(input);
                          divs.append(div1);
                          if(data['array_viable_estado'][i]=="No aplica"){
                           div1.style="padding: 0;margin: 0;background:"+color+";"; 
                          }
                        }

                        var div1 = document.createElement("div");
                        div1.className ="row";
                        div1.id="info-"+i;
                        div1.className ="alert alert-info col-sm-12";
                        div1.style="display:none";
                        var button=document.createElement("button");
                        button.type="button";
                        button.id="clos-"+i;
                        button.className ="close";
                        button.setAttribute('aria-hidden','true');
                        button.addEventListener("click",  close);
                        button.innerHTML="&times;";
                        div1.append(button);
                        var textNode = document.createTextNode(info);
                        div1.appendChild(textNode);
                        divs.append(div1);

                    }


                        divs.append("</div>");
                         for(var j = 0; j < i; j++){
                            divs.append("<input name='doc[]' type=hidden id='doc' value="+data['array_viable_id'][j]+">");
                            divs.append("<input name='id_viable[]' type=hidden id='id_viable' value="+data['array_viable_id'][j]+">");
                            divs.append("<input name='id_viable2[]' type=hidden id='id_viable2' value="+data['array_viable_id2'][j]+">");
                            
                          }
                        divs.append("<input name='nucleo' type=hidden id='nucleo' value="+nucleo+">");
                        divs.append("<input name='proy' type=hidden id='proy' value="+num+">");
                        divs.append('<div class="form-group text-right" >');
                        divs.append('<div class= "col-sm-2"><button type="submit" class="btn btn-primary" >Enviar</button></div>');  
                        divs.append('<div class="col-sm-2"><button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button></div>');            
                        divs.append('</div>');    

                          
                        form.appendChild(divs[0]);
                        $('#carga_criterios .modal-body').html(form)

                         
                  },
                error:function(){alert('error');}
            });//Termina Ajax
       });

        function cargar_doc() {

          var id_carga=$(this).attr("name").replace('r','f');
          if($(this).val()==1){
            $('#'+id_carga).prop('required',true);
            $('#'+id_carga).css("display","block");
            $('#obs').css("display","none");
            $('#obs_input').prop('required',false);
            
          }else if($(this).val()==2){
            $('#'+id_carga).prop('required',false);
            $('#'+id_carga).css("display","none");
            $('#obs').css("display","none");
            $('#obs_input').prop('required',false);
          }else{
            $('#obs').css("display","block");
            $('#obs_input').prop('required',true);
            $('#'+id_carga).css("display","none");
            $('#'+id_carga).prop('required',false);
          }


        }

        
        function borr_crit() {
          
          var id=array_viable_file.indexOf($(this).attr("id"));
          $.ajax({url:"artpic/borrar-doc-criterios",type:"POST",data:{proy:$(this).attr("name"),crite:$(this).attr("id")},dataType:'json',
                success:function(data){
                  $("#"+id).attr('class', 'glyphicon glyphicon-download-alt btn btn-default');
                  $("#"+id).removeAttr("href");
                  $("#"+id).removeAttr("target");
                  $("#"+id).attr("disabled", true);
                  $("#"+id).attr('title', 'No hay archivo para este criterio');
                  },
                error:function(){alert('error');}
            });//Termina Ajax
        }

        function informa() {
           var id_info=$(this).attr("id").replace('inf-','');
           $('#info-'+id_info).css("display", "block");
        }

        function close() {
           var id_info_close=$(this).attr("id").replace('clos-','');
           $('#info-'+id_info_close).css("display", "none");
        }



   $('#carga_criterios').on('hidden.bs.modal', function (e) {//funcion que resetea el modal
       $(this).find('form').trigger('reset');
    })  
    $('#viable_proyec').on('hidden.bs.modal', function (e) {//funcion que resetea el modal
       $(this).find('form').trigger('reset');
    })  
   $('#no_viable_proyec').on('hidden.bs.modal', function (e) {//funcion que resetea el modal
       $(this).find('form').trigger('reset');
    })  

    </script>    
@stop

@endif<!--Cierra el if de mostrar el contenido de la página si esta autenticado-->