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
      <div class="col-sm-1"></div>
        <div class="col-sm-10">
          
          <!--aca se escribe el codigo-->
          <h2 class="text-center text-primary">Proyectos de pequeña infraestructura comunitaria</h2>
          
          <h3 class="text-center text-primary">Ficha de iniciativa de proyectos</h3>
          <br><br>
          <div class="row">
            <?php $status=Session::get('status'); ?>
                @if($status=='ok_estatus')
                <div class="col-sm-1"></div>
                <div id = "mensajeestatus" class="alert alert-success col-sm-10"><button class="close" data-dismiss="alert" type="button">×</button>
                <i class="bg-success"></i> El proyecto fue cargado con éxito</div>
                <div class="col-sm-1"></div>
                @endif
                @if($status=='error_estatus')
                <div class="col-sm-1"></div>
                <div id = "mensajeestatus"class="alert alert-danger col-sm-10"><button class="close" data-dismiss="alert" type="button">×</button>
                <i class="bg-danger"></i> El proyecto NO fue creado</div>
                <div class="col-sm-1"></div>
                @endif
                @if($status=='ok_estatus_editar')
                <div class="col-sm-1"></div>
                <div id = "mensajeestatus" class="alert alert-success col-sm-10"><button class="close" data-dismiss="alert" type="button">×</button>
                <i class="bg-success"></i> El proyecto fue editado con éxito</div>
                <div class="col-sm-1"></div>
                @endif
                @if($status=='error_estatus_editar')
                <div class="col-sm-1"></div>
                <div id = "mensajeestatus"class="alert alert-danger col-sm-10"><button class="close" data-dismiss="alert" type="button">×</button>
                <i class="bg-danger"></i> El proyecto NO fue editado</div>
                <div class="col-sm-1"></div>
                @endif
                @if($status=='ok_estatus_borrar')
                <div class="col-sm-1"></div>
                <div id = "mensajeestatus" class="alert alert-success col-sm-10"><button class="close" data-dismiss="alert" type="button">×</button>
                <i class="bg-success"></i> El proyecto fue eliminado con éxito</div>
                <div class="col-sm-1"></div>
                @endif
                @if($status=='error_estatus_borrar')
                <div class="col-sm-1"></div>
                <div id = "mensajeestatus"class="alert alert-danger col-sm-10"><button class="close" data-dismiss="alert" type="button">×</button>
                <i class="bg-danger"></i> El proyecto NO fue eliminado</div>
                <div class="col-sm-1"></div>
                @endif
            <?php $status=0; ?>
          </div>
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#cargar_proyecto">Crear proyecto</button>
          <button id="btnedipro" disabled="disabled" data-target="#editar_proyecto"  data-toggle="modal" type="button" class="btn btn-primary">Editar proyecto</button>
          <button id="btndeletepro" disabled="disabled" data-target="#borrar_proyecto"  data-toggle="modal" type="button" class="btn btn-danger">Borrar proyecto</button>          
          <!--Aca inicia el modal para cargar nuevo proyecto-->
          <!-- Modal -->
          <div class="modal fade" id="cargar_proyecto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="myModalLabel">Ficha de proyecto-PIC</h4>
                </div>
                <div class="modal-body">
                  <form role="form" action="artpic/crear-proyecto" method="post" id="crearindi" enctype="multipart/form-data" >
                      <div class="form-group">
                        {{Form::label('deptolabel','Departamento',['class' => 'control-label'])}}
                        {{Form::select('depto', $arraydepto, '', ['class' => 'form-control', 'id'=>'depto','required'=>'true'])}}
                      </div>

                      <div class="form-group">
                         {{Form::label('mpiolable','Municipios:',['class' => 'control-label'])}}
                          <select name="mpios" id="mpios" class="form-control" required> 
                            <option value=''>Seleccione uno</option>
                          </select>

                      </div>
                      <div class="form-group">
                        {{Form::label('nucleolable','Núcleo veredal:',['class' => 'control-label'])}}
                        {{Form::select('nucleo', $arraynucleos, '', ['class' => 'form-control', 'id'=>'nucleo','required'=>'true'])}}  
                      </div>

                      <div class="form-group" >
                        {{Form::label('tipoterrlable','Tipo de territorio:',['class' => 'control-label'])}}
                        {{Form::select('tipoterr', $arraytipoterr, '', ['class' => 'form-control', 'id'=>'tipoterr','required'=>'true'])}}
                      </div> 
                      <div id="supcate" class="form-group">
                         {{Form::label('nom_supcatelable','Subcategoría:',['class' => 'control-label'])}}
                        <select name="nom_supcate" id="nom_supcate" class="form-control" required>
                           <option value="">Seleccione subcategoria </option>
                            <?php foreach($arraycate as $key=>$val): ?>
                                    <optgroup label="<?php echo implode(",", $val); ?>">
                                       <?php foreach($arraysubcate as $option): 
                                        if ($option->id_categ==$key):?>
                                        <option value=<?php echo $option->id; ?>><?php echo $option->nombre; ?></option>
                                         <?php endif; endforeach; ?>
                                    </optgroup>
                            <?php endforeach; ?>
                        </select>     
                      </div>
                      <div class="form-group">
                        {{Form::label('focallable','Focalización:',['class' => 'control-label'])}}
                        {{Form::select('focal', $arrayfocali, '', ['class' => 'form-control', 'id'=>'focal','required'=>'true'])}}
                      </div>
                      <div class="form-group">
                        {{Form::label('nomproylable','Nombre del proyecto:',['class' => 'control-label'])}}
                        {{ Form::text('nomproy', Input::old('nomproy'), ['class' => 'form-control', 'id'=>'nomproy','required'=>'true']) }}
                      </div> 
                      <div class="form-group">
                        {{Form::label('alcancelable','Alcance del proyecto:',['class' => 'control-label'])}}
                        {{ Form::textarea('alcance', null, ['class' => 'form-control', 'id'=>'alcance','required'=>'true']) }}
                      </div> 
                      <div class="form-group">
                        {{Form::label('estadolabel','Estado del proyecto',['class' => 'control-label'])}}
                        {{Form::select('estado', $arrayestado, '', ['class' => 'form-control', 'id'=>'estado','required'=>'true'])}}
                      </div>
                      <div class="form-group">
                        {{Form::label('preciolable','Precio estimado:',['class' => 'control-label'])}}
                        {{ Form::number('precio','', ['class' => 'form-control', 'id'=>'precio','required'=>'true'])}}
                      </div>
                      <div class="form-group" >
                        {{Form::label('cofinalable','Cofinanciación:',['class' => 'control-label'])}}
                        {{ Form::number('cofina','', ['class' => 'form-control', 'id'=>'cofina','required'=>'true'])}}
                      </div> 
                      <div class="form-group" >
                        {{Form::label('fechalable','Fecha de ingreso:',['class' => 'control-label'])}}
                        {{ Form::text('fecha', Input::old('fecha'), ['class' => 'form-control', 'id'=>'datepicker','required'=>'true','click'=>'fecha']) }}
                      </div> 
                      <div class="form-group text-right"  id="cargueind">                
                        <button type="submit" class="btn btn-primary" >Crear</button>
                      </div>
                    </form>
                </div>
              </div>
            </div>
          </div>
          <!--Aca finaliza el modal para cargar nuevo proyecto-->
          <!--Aca inicia el modal para editar proyecto-->
          <div class="modal fade" id="editar_proyecto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="Editar_tittle">Editar proyecto-PIC</h4>
                </div>
                <div class="modal-body">
                  <form role="form" action="artpic/editar-proyecto" method="post" id="crearindi" enctype="multipart/form-data" >
                      <div class="form-group">
                        <input  id = "ediidproy" name = "ediidproy" class="form-control" type="hidden" required="true" ></input>               
                      </div>
                      <div class="form-group">
                        {{Form::label('edideptolabel','Departamento',['class' => 'control-label'])}}
                        {{Form::select('edidepto', $arraydepto, '', ['class' => 'form-control', 'id'=>'edidepto','required'=>'true'])}}
                      </div>

                      <div class="form-group">
                        {{Form::label('edimpioslable','Municipios:',['class' => 'control-label'])}}
                        <select name="edimpios" id="edimpios" class="form-control">

                        </select>    

                      </div>
                      <div class="form-group">
                        {{Form::label('edinucleolable','Núcleo veredal:',['class' => 'control-label'])}}
                        {{Form::select('edinucleo', $arraynucleos, '', ['class' => 'form-control', 'id'=>'edinucleo','required'=>'true'])}}  
                      </div>

                      <div class="form-group" >
                        {{Form::label('editipoterrlable','Tipo de territorio:',['class' => 'control-label'])}}
                        {{Form::select('editipoterr', $arraytipoterr, '', ['class' => 'form-control', 'id'=>'editipoterr','required'=>'true'])}}
                      </div> 
                      <div id="supcate" class="form-group">
                         {{Form::label('edinom_supcatelable','Subcategoría:',['class' => 'control-label'])}}
                        <select name="edinom_supcate" id="edinom_supcate" class="form-control">
                           <option value="">Seleccione subcategoria </option>
                            <?php foreach($arraycate as $key=>$val): ?>
                                    <optgroup label="<?php echo implode(",", $val); ?>">
                                       <?php foreach($arraysubcate as $option): 
                                        if ($option->id_categ==$key):?>
                                        <option value=<?php echo $option->id; ?>><?php echo $option->nombre; ?></option>
                                         <?php endif; endforeach; ?>
                                    </optgroup>
                            <?php endforeach; ?>
                        </select>     
                      </div>
                      <div class="form-group">
                        {{Form::label('edifocallable','Focalización:',['class' => 'control-label'])}}
                        {{Form::select('edifocal', $arrayfocali, '', ['class' => 'form-control', 'id'=>'edifocal','required'=>'true'])}}
                      </div>
                      <div class="form-group">
                        {{Form::label('edinomproylable','Nombre del proyecto:',['class' => 'control-label'])}}
                        {{ Form::text('edinomproy', Input::old('nomproy'), ['class' => 'form-control', 'id'=>'edinomproy','required'=>'true']) }}
                      </div> 
                      <div class="form-group">
                        {{Form::label('edialcancelable','Alcance del proyecto:',['class' => 'control-label'])}}
                        {{ Form::textarea('edialcance', null, ['class' => 'form-control', 'id'=>'edialcance','required'=>'true']) }}
                      </div> 
                      <div class="form-group">
                        {{Form::label('ediestadolabel','Estado del proyecto',['class' => 'control-label'])}}
                        {{Form::select('ediestado', $arrayestado, '', ['class' => 'form-control', 'id'=>'ediestado','required'=>'true'])}}
                      </div>
                      <div class="form-group">
                        {{Form::label('edipreciolable','Precio estimado:',['class' => 'control-label'])}}
                        {{ Form::number('ediprecio','', ['class' => 'form-control', 'id'=>'ediprecio','required'=>'true'])}}
                      </div>
                      <div class="form-group" >
                        {{Form::label('edicofinalable','Cofinanciación:',['class' => 'control-label'])}}
                        {{ Form::number('edicofina','', ['class' => 'form-control', 'id'=>'edicofina','required'=>'true'])}}
                      </div> 
                      <div class="form-group" >
                        {{Form::label('edifechalable','Fecha de ingreso:',['class' => 'control-label'])}}
                        {{ Form::text('edifecha', Input::old('fecha'), ['class' => 'form-control', 'id'=>'edidatepicker','required'=>'true','click'=>'fecha']) }}
                      </div> 
                      <div class="form-group text-right"  id="cargueind">                
                        <button type="submit" class="btn btn-primary" >Editar</button>
                      </div>
                    </form>
                </div>    
              </div>
            </div>
          </div>
          <!--Aca finaliza el modal para editar proyecto-->
          <!--Aca inicia el modal para borrar proyecto-->
          <div class="modal fade bs-example-modal-sm" id="borrar_proyecto" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
            <div class="modal-dialog modal-sm" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="borrar_tittle">Borrar proyecto-PIC</h4>
                  </div>
                  <div class="modal-body">
                    <form role="form" action="artpic/delete-proyecto" method="post" id="crearcate" enctype="multipart/form-data" >
                          <div class="form-group">
                            <input  id = "deleteproy" name = "deleteproy" class="form-control" type="hidden" ></input>   
                            <label for="deleteproylabel" class="control-label">Nombre del proyecto que va a borrar</label>
                            <input  id = "deletenombre" name = "deletenombre" class="form-control" type="text" disabled ></input>            
                          </div>
                          <div class="form-group">
                            
                            <label for="deletenucleolabel" class="control-label">Núcleo veredal</label>
                            <input  id = "deletenucleo" name = "deletenucleo" class="form-control" type="text" disabled ></input>            
                          </div>
                          <div class="form-group text-right"  id="carguecte">                
                            <button type="submit" class="btn btn-primary" >Borrar</button>
                          </div>
                    </form>
                  </div>
              </div>
            </div>
          </div>
          <!--Aca finaliza el modal para borrar proyecto-->
          <!--Acá inicia la tabla de proyectos-->
          <h4>Listado de proyectos</h4>
          <table id="tabla_proyectos" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>  
              <tr class="well text-primary" data-toggle="tooltip" data-placement="top" >
                <th class="text-center">Departamento</th>
                <th class="text-center">Municipio</th>
                <th class="text-center">Núcleo veredal</th>
                <th class="text-center">Nombre del proyecto</th>
                <th class="text-center">Subcategoría</th>                       
              </tr>
            </thead>
             <tbody>
                    @foreach($arrayindipic as $pro) 
                      <tr id="{{$pro->id_proy}}"> 
                        <td >@foreach($arraydepto as $key=>$val) @if($pro->cod_depto==$key) {{$val}} @endif @endforeach </td> 
                        <td >@foreach($arraymuni as $key=>$val) @if($pro->cod_mpio==$key) {{$val}} @endif @endforeach </td> 
                        <td >@foreach($arraynucleos as $key=>$val) @if($pro->cod_nucleo==$key) {{$val}} @endif @endforeach </td> 
                        <td >{{$pro->nom_proy}}</td>
                        <td >@foreach($arraysubcate as $option) @if($pro->id_subcat==$option->id) {{$option->nombre}} @endif @endforeach </td> 


                      </tr>
                    @endforeach
                  </tbody>
          </table>
          <!--Acá termina la tabla de proyectos-->
          <!--fin del codigo-->   
          </div>
        </div>
      <div class="col-sm-1"></div> 
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
          $( "#artdashboardmenu" ).addClass("active");
          $( "#iniciomenupeq" ).html("<small> INICIO</small>");
          $( "#artmenupeq" ).html("<strong>ART<span class='caret'></span></strong>");
          $( "#artdashboardmenupeq" ).html("<strong><span class='glyphicon glyphicon-ok'></span>Dashboard</strong>");
          $( "#mensajeestatus" ).fadeOut(5000);

          $('#datepicker').datepicker({
            maxViewMode: 0,
            language: "es",
            autoclose: true
          });//Termina datepicker 

          $('#edidatepicker').datepicker({
            maxViewMode: 0,
            language: "es",
            autoclose: true
          });//Termina datepicker 

          table=$('#tabla_proyectos').DataTable();
      });



      function fecha() {

            $('#datepicker').datepicker({
              maxViewMode: 0,
              language: "es",
              autoclose: true
            });//Termina datepicker

        }

    $("#depto").change(function(){
      
         $.ajax({url:"artpic/mpios",type:"POST",data:{depto:$('#depto').val()},dataType:'json',//llama al controlador siscadi/siscadirepdpto que trae los valores necesario para la grafica
          success:function(data1){
            $.each(data1.arraympios, function(nom,datos){
              $("#mpios").append("<option value=\""+datos+"\">"+nom+"</option>");
            });

          },
          error:function(){alert('error');}
        });//Termina Ajax prueva
     
    });//Termina chage 

    $("#edidepto").change(function(){
      
         $.ajax({url:"artpic/mpios",type:"POST",data:{depto:$('#edidepto').val()},dataType:'json',//llama al controlador siscadi/siscadirepdpto que trae los valores necesario para la grafica
          success:function(data1){
            $.each(data1.arraympios, function(nom,datos){
              $("#edimpios").append("<option value=\""+datos+"\">"+nom+"</option>");
            });

          },
          error:function(){alert('error');}
        });//Termina Ajax prueva
     
    });//Termina chage 


    $('#tabla_proyectos tbody').on('click', 'tr', function () {
            if ( $(this).hasClass('active') ) {
              $(this).removeClass('active');
              $("#btnedipro").prop('disabled', true);
              $("#btndeletepro").prop('disabled', true);
            }else {
              table.$('tr.active').removeClass('active');
              $(this).addClass('active');
              $("#btnedipro").prop('disabled', false);
              $("#btndeletepro").prop('disabled', false);

              var num =$('tr', this).context.id;
              $.ajax({url:"artpic/tablaproy",type:"POST",data:{proy:num},dataType:'json',
                  success:function(data){ 
                    console.log(data)
                    $("#ediidproy").val(data['arrayproy'][0].id_proy);
                    $("#edidepto").val(data['arrayproy'][0].cod_depto);
                    $.each(data.arraympios, function(nom,datos){
                      $("#edimpios").append("<option value=\""+datos+"\">"+nom+"</option>");
                    });
                    $("#edimpios").val(data['arrayproy'][0].cod_mpio);

                    $("#editipoterr").val(data['arrayproy'][0].id_tipoterr);
                    $("#edinom_supcate").val(data['arrayproy'][0].id_subcat);
                    $("#edifocal").val(data['arrayproy'][0].id_focal);

                    $("#edinucleo").val(data['arrayproy'][0].cod_nucleo);
                    $("#edinomproy").val(data['arrayproy'][0].nom_proy);
                    $("#edialcance").val(data['arrayproy'][0].alcance);

                    $("#ediestado").val(data['arrayproy'][0].estado_proy);
                    $("#ediprecio").val(data['arrayproy'][0].prec_estim);
                    $("#edicofina").val(data['arrayproy'][0].cofinanc);

                    $("#edidatepicker").val(data['arrayproy'][0].fecha_ingreso);


                    $("#deletenombre").val(data['arrayproy'][0].nom_proy);
                    $("#deleteproy").val(data['arrayproy'][0].id_proy);

                    $.each(data.arraynucleos, function(nom,datos){
                      if (nom==data['arrayproy'][0].cod_nucleo){

                         $("#deletenucleo").val(datos);
                      }
                      
                    });



                    
                    
                  },
                  error:function(){alert('error');}
              });//Termina Ajax
            }
          });


    </script>    
@stop

@endif<!--Cierra el if de mostrar el contenido de la página si esta autenticado-->