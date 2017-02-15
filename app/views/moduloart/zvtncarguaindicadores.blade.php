@if(Auth::check())<!--muestra el contenido de la página si esta autenticado-->
 <!--agrega la pagina maestra-->
@extends('layouts.master')
<!--agrega seccion titulo por si se quiere cambiar el titulo de la pestaña-->
@section('titulo')
  @parent
@stop
 <!--agrega los estilos de la pagina y los meta-->
@section('cabecera')
  
 <link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.7.5/leaflet.css" />
     <link href="assets/noUiSlider.9.2.0/nouislider.css" rel="stylesheet">
  <style> 
    #map {
    min-height: 250px;
    }
  </style>
  @parent

@stop
<!--agrega JavaScript dentro del header a la pagina-->
@section('js')  
  <script src="http://cdn.leafletjs.com/leaflet-0.7.5/leaflet.js"></script>
  <script src="http://cdn-geoweb.s3.amazonaws.com/esri-leaflet/1.0.0-rc.3/esri-leaflet.js"></script>
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
		<h2 class="text-center text-primary">Zonas Veredales de Transición</h2>
    <br>
		<div class="row">
    <div class="col-sm-1"></div>
		<div class="col-sm-10">
  	  <ul class="nav nav-tabs">
    		<li class="active"><a data-toggle="tab" href="#indicadores">Indicadores veredales</a></li>
    		<li><a data-toggle="tab" href="#categoria">Categoría de indicadores</a></li>
  	  </ul>
	 </div>
     <div class="col-sm-1"></div>
   </div>
   
		<div class="tab-content">
        <div id="indicadores" class="tab-pane fade in active">
          <div class="row">
          <div class="col-sm-1"></div>
          <div class="col-sm-10">
            <h3>Indicadores veredales:</h3>
            <p>Usted puede realizar la consulta, edición e ingreso de los indicadores a evaluar en las zonas veredales de transición</p>           
            <div class="row">
      			  <div class="col-sm-2">
        				<!-- Standard button -->
        				<button id="creaindicador" title="Presione para crear un nuevo indicador"  data-target="#creaindicadorModal"  data-toggle="modal" type="button" class="btn btn-primary">Crear indicador</button>
      			  </div>
      			   <div class="col-sm-2">
      			     <button id="editindicador" title="Seleccione un idnicador en la tabla para editar su contenido" disabled="disabled" data-target="#editindicadorModal"  data-toggle="modal" type="button" class="btn btn-primary">Editar indicador</button>
      			   </div>
      			</div>
            <div class="row">
                <?php $status=Session::get('status'); ?>
                @if($status=='ok_estatus')
                <div class="col-sm-1"></div>
                <div id = "mensajeestatus" class="alert alert-success col-sm-10"><button class="close" data-dismiss="alert" type="button">×</button>
                <i class="bg-success"></i> Se ingresó el nuevo registro con éxito</div>
                <div class="col-sm-1"></div>
                @endif
                @if($status=='error_estatus')
                <div class="col-sm-1"></div>
                <div id = "mensajeestatus"class="alert alert-danger col-sm-10"><button class="close" data-dismiss="alert" type="button">×</button>
                <i class="bg-danger"></i> No se ingresó el nuevo registro</div>
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
			     </div>
          <div class="col-sm-1"></div>
          </div>
              <br>
              <div class="row">
                <div class="col-sm-1"></div>
              <div class="col-sm-10" >
                <table id="tablaresumenindi" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                  <thead>
                    <tr class="well text-primary ">
                      
                      <th class="text-center">Nombre del indicador</th>
                      <th class="text-center">Responsable</th>
                      <th class="text-center">Categoría</th>
                      <th class="text-center">Periodo de captura</th>
                      <th class="text-center">Día de captura</th>
                      <th class="text-center">Metodo de medición</th>
                      <th class="text-center">Prioridad o tablero de visualización</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($arraypidnicadores as $pro)
                      <tr id="{{$pro->id}}"> 
                        <td >{{$pro->nombre}}</td> 
                        <td >{{$pro->id_responsable}}</td> 
                        <td >{{$pro->id_categoria}}</td> 
                        <td >{{$pro->id_period}}</td>
                        <td >{{$pro->dia_semana}}</td>
                        <td >{{$pro->id_metodo}}</td>
                        <td >{{$pro->id_tablero}}</td>

                      </tr>
                    @endforeach
                  </tbody>
                </table>
            </div>
            <div class="col-sm-1"></div>
          </div>

          <div id="creaindicadorModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title"><strong>Creación de nuevos indicadores de zonas veredales</strong></h4>
                </div>
                <div class="modal-body">
                  <form role="form" action="artzvtn/crear-indicador" method="post" id="crearindi" enctype="multipart/form-data" >
                        <div class="form-group">
                          <label for="nomindilabel" class="control-label">Nombre del indicador</label>
                          <input  id = "nomindi" name = "nomindi" class="form-control" type="text" required="true" placeholder="Ejemplo: numero de observadores"></input>               
                        </div>
                        <div class="form-group">
                          {{Form::label('categolabel','Categoria',['class' => 'control-label'])}}
                          {{Form::select('catego', $arraycategoria, '', ['class' => 'form-control', 'id'=>'catego','required'=>'true'])}}
                        </div>

                        <div class="form-group">
                          {{Form::label('peridiolable','Peridiocidad de captura:',['class' => 'control-label'])}}
                          {{Form::select('periodo', $arrayperiodo, '', ['class' => 'form-control', 'id'=>'periodo','required'=>'true'])}}
                        </div>  
                        <div class="checkbox-group">
                          <label for="peridioslable" class="control-label" style="visibility:hidden">Seleccione el día de la semana de captura del indicador:</label>
                          <div class="form-group" id="radioperidiocidadid" style="visibility:hidden">

                            <input type="radio" name="radioperidiocidadid" id="1" value="Lunes"> Lunes
                            <input type="radio" name="radioperidiocidadid" id="2" value="Martes"> Martes
                            <input type="radio" name="radioperidiocidadid" id="3" value="Miercoles"> Miercoles
                            <input type="radio" name="radioperidiocidadid" id="4" value="Jueves"> Jueves
                            <input type="radio" name="radioperidiocidadid" id="5" value="Viernes"> Viernes
                            <input type="radio" name="radioperidiocidadid" id="6" value="Sabado"> Sabado
                            <input type="radio" name="radioperidiocidadid" id="7" value="Domingo"> Domingo
                            </div>
                        </div>
                        


                        <div class="form-group">
                          <label for="tablerolable" class="control-label">Prioridad del indicador:</label>
                          <div id="checktablero">
                            <input type="radio" name="Tablero" value="1" required> Tablero del Presidente
                            <input type="radio" name="Tablero" value="2"> Tablero General
                            <input type="radio" name="Tablero" value="3"> Tablero detallado
                          </div>
                        </div>
                        <div class="form-group">
                          {{Form::label('metodolabel','Metodo de medición',['class' => 'control-label'])}}
                          {{Form::select('metodo', $arraymetodo, '', ['class' => 'form-control', 'id'=>'metodo','required'=>'true'])}}
                      </div> 
                         <label for="rangoslabel" class="control-label" style="visibility:hidden">Rangos del mideción</label>
                          <div id="rangos" class="noUi-target noUi-ltr noUi-horizontal" style="visibility:hidden"></div>
                          <input type="text" id="rangos-value-1" name="rangos-value-1" style="visibility:hidden">
                          <input type="text" id="rangos-value-2" name="rangos-value-2" style="visibility:hidden">
                          <input type="text" id="rangos-value-3" name="rangos-value-3" style="visibility:hidden">
                        <hr>
                        <div class="form-group text-right"  id="cargueind">                
                          <button type="submit" class="btn btn-primary" >Crear</button>
                        </div>
                        </form>
                </div>
              </div>
            </div>      
          </div><!-- /.final modal-->

          <div id="editindicadorModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true"> <!-- /.inicio modal-->
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><strong>Creación de nuevas categorías de indicadores</strong></h4>
              </div>
              <div class="modal-body">
                <form role="form" action="artzvtn/editindi" method="post" id="crearcate" enctype="multipart/form-data" >
                      <div class="form-group">
                        <input  id = "idindiedi" name = "idindiedi" class="form-control" type="hidden" required="true" ></input>               
                      </div>
                      <div class="form-group">
                        <label for="nomindilabeledi" class="control-label">Nombre del indicador</label>
                        <input  id = "nomindiedi" name = "nomindiedi" class="form-control" type="text" required="true" placeholder="Ejemplo: numero de observadores"></input>               
                      </div>
                      <div class="form-group">
                        {{Form::label('categolabeledi','Categoria',['class' => 'control-label'])}}
                        {{Form::select('categoedi', $arraycategoria, '', ['class' => 'form-control', 'id'=>'categoedi','required'=>'true'])}}
                      </div>

                      <div class="form-group">
                        {{Form::label('peridiolableedi','Peridiocidad de captura:',['class' => 'control-label'])}}
                        {{Form::select('periodoedi', $arrayperiodo, '', ['class' => 'form-control', 'id'=>'periodoedi','required'=>'true'])}}
                      </div>  
                      <div class="checkbox-group">
                        <label for="peridioslableedi" class="control-label" style="visibility:hidden">Seleccione el día de la semana de captura del indicador:</label>
                        <div class="form-group" id="radioperidiocidadidedi" style="visibility:hidden">

                          <input type="radio" name="radioperidiocidadidedi" id="1edi" value="Lunes"> Lunes
                          <input type="radio" name="radioperidiocidadidedi" id="2edi" value="Martes"> Martes
                          <input type="radio" name="radioperidiocidadidedi" id="3edi" value="Miercoles"> Miercoles
                          <input type="radio" name="radioperidiocidadidedi" id="4edi" value="Jueves"> Jueves
                          <input type="radio" name="radioperidiocidadidedi" id="5edi" value="Viernes"> Viernes
                          <input type="radio" name="radioperidiocidadidedi" id="6edi" value="Sabado"> Sabado
                          <input type="radio" name="radioperidiocidadidedi" id="7edi" value="Domingo"> Domingo
                          </div>
                      </div>
                      


                      <div class="form-group">
                        <label for="tablerolable" class="control-label">Prioridad del indicador:</label>
                        <div id="checktablero">
                          <input type="radio" name="Tableroedi" value="1" required> Tablero del Presidente
                          <input type="radio" name="Tableroedi" value="2"> Tablero General
                          <input type="radio" name="Tableroedi" value="3"> Tablero detallado
                        </div>
                      </div>
                      <div class="form-group">
                        {{Form::label('metodolabeledi','Metodo de medición',['class' => 'control-label'])}}
                        {{Form::select('metodoedi', $arraymetodo, '', ['class' => 'form-control', 'id'=>'metodoedi','required'=>'true'])}}
                    </div> 
                       <label for="rangoslabeledi" class="control-label" style="visibility:hidden">Rangos del mideción</label>
                        <div id="rangosedi" class="noUi-target noUi-ltr noUi-horizontal" style="visibility:hidden"></div>
                        <input type="text" id="edirangos-value-1" name="edirangos-value-1" style="visibility:hidden">
                        <input type="text" id="edirangos-value-2" name="edirangos-value-2" style="visibility:hidden">
                        <input type="text" id="edirangos-value-3" name="edirangos-value-3" style="visibility:hidden">
                      
                      <div class="form-group text-right"  id="carguecte">                
                        <button type="submit" class="btn btn-primary" >Crear</button>
                      </div>
                      </form>
              </div>
            </div>
          </div>      
        </div><!-- /.final modal-->
		</div>

    <div id="categoria" class="tab-pane fade">
      <div class="row">
          <div class="col-sm-1"></div>
            <div class="col-sm-10">
              <h3>Categoría de indicadores</h3>
              <p>Usted puede realizar la consulta, edición e ingreso de las categorías de los indicadores en las zonas veredales de transición</p>
          			  <div class="col-sm-2">
            				<!-- Standard button -->
            				<button id="creacategoria" title="Presione para crear una nueva categoría"  data-target="#creacategoriaModal"  data-toggle="modal" type="button" class="btn btn-primary">Crear categoría</button>
          			  </div>
            			   <div class="col-sm-2">
            			   <button id="editcategoria" title="Presione una categoría en la tabla para editar su contendio" disabled="disabled" data-target="#editcategoriaModal"  data-toggle="modal" type="button" class="btn btn-primary">Editar categoría</button>
          			   </div>
                </div>
              <div class="col-sm-1"></div>
           </div>

          <br>
              <div class="row">
                <div class="col-sm-1"></div>
              <div class="col-sm-5" >
                <table id="tablaresumencate" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                  <thead>
                    <tr class="well text-primary ">
                      <th class="text-center">ID</th>
                      <th class="text-center">Nombre de la categoría</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($categoria as $pro)
                      <tr id="{{$pro->id}}"> 
                        <td >{{$pro->id}}</td> 
                        <td >{{$pro->nombre}}</td> 
                      </tr>
                    @endforeach
                  </tbody>
                </table>
            </div>
            <div class="col-sm-1"></div>
          </div> 

          <div id="creacategoriaModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true"> <!-- /.inicio modal-->
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title"><strong>Creación de nuevas categorías de indicadores</strong></h4>
                </div>
                <div class="modal-body">
                  <form role="form" action="artzvtn/crear-categoria" method="post" id="crearcate" enctype="multipart/form-data" >
                        <div class="form-group">
                          <label for="nomcatelabel" class="control-label">Nombre de la categoría</label>
                          <input  id = "nomcate" name = "nomcate" class="form-control" type="text" required="true" placeholder="Ejemplo: Insfraestructura"></input>            
                        </div>
                        <div class="form-group">
                            {{Form::label('peridiolable','Categorias existentes:',['class' => 'control-label'])}}
                            {{Form::text('periodo', str_replace(",","\t-",str_replace("Seleccione una","",implode(",", $arraycategoria))), ['class' => 'form-control', 'id'=>'periodo','disabled'])}}           
                        </div>
                        
                        <div class="form-group text-right"  id="carguecte">                
                          <button type="submit" class="btn btn-primary" >Crear</button>
                        </div>
                        </form>
                </div>
              </div>
            </div>      
          </div><!-- /.final modal-->

          <div id="editcategoriaModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true"> <!-- /.inicio modal-->
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title"><strong>Edición de las categorías de indicadores</strong></h4>
                </div>
                <div class="modal-body">
                  <form role="form" action="artzvtn/editcate" method="post" id="crearcate" enctype="multipart/form-data" >
                        <div class="form-group">
                          <input  id = "editcate" name = "editcate" class="form-control" type="hidden" ></input>   
                          <label for="editnomcatelabel" class="control-label">Nombre de la categoría</label>
                          <input  id = "editnomcate" name = "editnomcate" class="form-control" type="text" required="true" placeholder="Ejemplo: Insfraestructura"></input>            
                        </div>
                        <div class="form-group text-right"  id="carguecte">                
                          <button type="submit" class="btn btn-primary" >Crear</button>
                        </div>
                        </form>
                </div>
              </div>
            </div>      
          </div><!-- /.final modal-->
   </div>
   </div>

 </div>
</div>
    
<!--fin del codigo-->    

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
  <script src="assets/noUiSlider.9.2.0/nouislider.min.js"></script>
  <script src="assets/js/wNumb.js"></script>
<script type="text/javascript">
     

      $(document).ready(function() {
          //para que los menus pequeño y grande funcione
          
          var table=$('#tablaresumenindi').DataTable();
         var table2= $('#tablaresumencate').DataTable();
          $( "#tierras" ).addClass("active");
          $( "#tierraslevtopo" ).addClass("active");
          $( "#iniciomenupeq" ).html("<small> INICIO</small>");
          $( "#tierrasmenupeq" ).html("<strong>MODULO TIERRAS<span class='caret'></span></strong>");
          $( "#tierrasestjurmenupeq" ).html("<strong><span class='glyphicon glyphicon-ok'></span>Estudio Juridico</strong>");
          $( "#mensajeestatus" ).fadeOut(5000);

          $("#periodo").change(function() {
            metod_selec=$(this).find('option:selected').val();
                if (metod_selec==2){
                    $('label[for="peridioslable"]').css("visibility","visible");
                    $("#radioperidiocidadid").css("visibility","visible");
                    $("#1").prop('required',true);
                  } else {
                    $('label[for="peridioslable"]').css("visibility","hidden");
                    $("#radioperidiocidadid").css("visibility","hidden");
                    $("#1").prop('required',false);
                }

          });

          $("#periodoedi").change(function() {
            metod_selec=$(this).find('option:selected').val();
                if (metod_selec==2){
                    $('input[name="radioperidiocidadidedi"]').prop('checked', false);
                    $('label[for="peridioslableedi"]').css("visibility","visible");
                    $("#radioperidiocidadidedi").css("visibility","visible");
                    $("#1edi").prop('required',true);
                  } else {
                    $('label[for="peridioslableedi"]').css("visibility","hidden");
                    $("#radioperidiocidadidedi").css("visibility","hidden");
                    $("#1edi").prop('required',false);
                }

          });


          $("#metodo").change(function() {
            metod_selec=$(this).find('option:selected').val();
                if (metod_selec==1){
                    $('label[for="rangoslabel"]').css("visibility","visible");
                    $("#rangos").css("visibility","visible");
                     vari=var_meto();
                     handlesSlider4.noUiSlider.updateOptions({
                          format: wNumb({
                            decimals: 0,
                            postfix:vari
                          })
                      }); 
                } else if (metod_selec==2){
                    $('label[for="rangoslabel"]').css("visibility","visible");
                    $("#rangos").css("visibility","visible");
                     vari=var_meto();
                     handlesSlider4.noUiSlider.updateOptions({
                          format: wNumb({
                            decimals: 0,
                            postfix:vari
                          })
                      });
                }else{
                    $('label[for="rangoslabel"]').css("visibility","hidden");
                    $("#rangos").css("visibility","hidden");
                }

          });

        $("#metodoedi").change(function() {
            metod_selec=$(this).find('option:selected').val();
                if (metod_selec==1){
                    $('label[for="rangoslabeledi"]').css("visibility","visible");
                    $("#rangosedi").css("visibility","visible");
                     vari=var_meto();
                     handlesSlider4.noUiSlider.updateOptions({
                          format: wNumb({
                            decimals: 0,
                            postfix:vari
                          })
                      }); 
                } else if (metod_selec==2){
                    $('label[for="rangoslabeledi"]').css("visibility","visible");
                    $("#rangosedi").css("visibility","visible");
                     vari=var_meto();
                     handlesSlider4.noUiSlider.updateOptions({
                          format: wNumb({
                            decimals: 0,
                            postfix:vari
                          })
                      });
                }else{
                    $('label[for="rangoslabeledi"]').css("visibility","hidden");
                    $("#rangosedi").css("visibility","hidden");
                }

          });
            
             
            var handlesSlider4 = document.getElementById('rangos');
                noUiSlider.create(handlesSlider4, {
                    start: [ 20, 40, 60],
                    step: 1,
                    tooltips: true,
                    range: {
                        'min': [  0 ],
                        'max': [ 100 ]
                    },
                    format: wNumb({
                        decimals: 0
                    })
                });

                var input1 = document.getElementById('rangos-value-1');
                var input2 = document.getElementById('rangos-value-2');
                var input3 = document.getElementById('rangos-value-3');
                var inputs = [input1, input2,input3];

                handlesSlider4.noUiSlider.on('update', function( values, handle ) {
                    inputs[handle].value = values[handle];
                });



              

                $('input:checkbox').change(function() {
                  if($(this).context.id==8 && $(this).is(":checked")) {
                      $("input:checkbox").prop('checked', $(this).prop("checked"));
                    }else if ($(this).context.id==8 && !$(this).is(":checked")) {
                      $('input:checkbox').removeAttr('checked');
                    }else if ($(this).context.id!=8 && !$(this).is(":checked")) {
                      $('#8').removeAttr('checked');
                    }      
                });

                $('#tablaresumenindi tbody').on('click', 'tr', function () {
                  if ( $(this).hasClass('active') ) {
                    $(this).removeClass('active');
                    $("#editindicador").prop('disabled', true);
                  }else {
                    table.$('tr.active').removeClass('active');
                    $(this).addClass('active');
                    $("#editindicador").prop('disabled', false);
                    var num =$('tr', this).context.id;
                    console.log(num)
                  $.ajax({url:"artzvtn/tablaindi",type:"POST",data:{indi:num},dataType:'json',
                      success:function(data){ 
                        
                        $("#idindiedi").val(data[0].id);
                        $("#nomindiedi").val(data[0].nombre);
                        $("#categoedi").val(data[0].id_categoria);

                        $("#periodoedi").val(data[0].id_period);
                        if (data[0].id_period==2){
                            $('input:radio[name="radioperidiocidadidedi"]').filter('[value="'+data[0].dia_semana+'"]').attr('checked', true);
                            $('label[for="peridioslableedi"]').css("visibility","visible");
                            $("#radioperidiocidadidedi").css("visibility","visible");
                            $("#1edi").prop('required',true);
                          } else {
                            $('label[for="peridioslableedi"]').css("visibility","hidden");
                            $("#radioperidiocidadidedi").css("visibility","hidden");
                            $("#1edi").prop('required',false);
                        }

                        $('input:radio[name="Tableroedi"]').filter('[value='+data[0].id_tablero+']').attr('checked', true);
                        $("#metodoedi").val(data[0].id_metodo);
                        metod_selec=data[0].id_metodo;

                        if (metod_selec==1){
                            $('label[for="rangoslabeledi"]').css("visibility","visible");
                            $("#rangosedi").css("visibility","visible");
                            vari=" %";
                             handlesSlider4.noUiSlider.updateOptions({
                                start:[data[0].c2, data[0].c3, data[0].c4],
                                format: wNumb({
                                  decimals: 0,
                                  postfix:vari
                                })
                            });
                        } else if (metod_selec==2){
                            $('label[for="rangoslabeledi"]').css("visibility","visible");
                            $("#rangosedi").css("visibility","visible");
                             vari=" días";
                             handlesSlider4.noUiSlider.updateOptions({
                              start:[data[0].c2, data[0].c3, data[0].c4],
                                format: wNumb({
                                  decimals: 0,
                                  postfix:vari
                                })
                               });  
                        }else{
                            $('label[for="rangoslabeledi"]').css("visibility","hidden");
                            $("#rangosedi").css("visibility","hidden");
                        }


//data[0].c2, data[0].c3, data[0].c4]


                      },
                      error:function(){alert('error');}
                    });//Termina Ajax


                  }
                });

                var handlesSlider4= document.getElementById('rangosedi');
                    noUiSlider.create(handlesSlider4, {
                        start: [ 20, 40, 80],
                        step: 1,
                        tooltips: true,
                        range: {
                            'min': [  0 ],
                            'max': [ 100 ]
                        },
                        format: wNumb({
                            decimals: 0
                        })
                    });

                    var input1 = document.getElementById('edirangos-value-1');
                    var input2 = document.getElementById('edirangos-value-2');
                    var input3 = document.getElementById('edirangos-value-3');
                    var inputs = [input1, input2,input3];

                    handlesSlider4.noUiSlider.on('update', function( values, handle ) {
                        inputs[handle].value = values[handle];
                    });




              $('#tablaresumencate tbody').on('click', 'tr', function () {
                  if ( $(this).hasClass('active') ) {
                    $(this).removeClass('active');
                    $("#editcategoria").prop('disabled', true);
                  }else {
                    table2.$('tr.active').removeClass('active');
                    $(this).addClass('active');
                    $("#editcategoria").prop('disabled', false);
                    var num =$('tr', this).context.id;
                    console.log(num)

                  $.ajax({url:"artzvtn/tablacate",type:"POST",data:{cate:num},dataType:'json',
                      success:function(data){ 
                        
                        $("#editcate").val(data[0].id);
                        $("#editnomcate").val(data[0].nombre);


                      },
                      error:function(){alert('error');}
                    });//Termina Ajax


                  }
                });



        });

              

         function var_meto(a) {/// seguri con el cambio de dias % segun metodo
            if (metod_selec==2){
                     vari=" días";
                } else if (metod_selec==1){
                     vari="%";
                }else{
                    vari="";
                }
                return vari;

         }

          


    </script>
@stop

@endif<!--Cierra el if de mostrar el contenido de la página si esta autenticado-->