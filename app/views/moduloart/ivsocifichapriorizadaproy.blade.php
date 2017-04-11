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
   <script src="assets/art/js/wNumb.js"></script>   
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.2.4/css/buttons.dataTables.min.css" />
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
                <i class="bg-success"></i> La iniciativa fue cargado con éxito</div>
                <div class="col-sm-1"></div>
                @endif
                @if($status=='error_estatus')
                <div class="col-sm-1"></div>
                <div id = "mensajeestatus"class="alert alert-danger col-sm-10"><button class="close" data-dismiss="alert" type="button">×</button>
                <i class="bg-danger"></i> La iniciativa NO fue creado</div>
                <div class="col-sm-1"></div>
                @endif
                @if($status=='ok_estatus_editar')
                <div class="col-sm-1"></div>
                <div id = "mensajeestatus" class="alert alert-success col-sm-10"><button class="close" data-dismiss="alert" type="button">×</button>
                <i class="bg-success"></i> La iniciativa fue editado con éxito</div>
                <div class="col-sm-1"></div>
                @endif
                @if($status=='error_estatus_editar')
                <div class="col-sm-1"></div>
                <div id = "mensajeestatus"class="alert alert-danger col-sm-10"><button class="close" data-dismiss="alert" type="button">×</button>
                <i class="bg-danger"></i> La iniciativa NO fue editado</div>
                <div class="col-sm-1"></div>
                @endif
                @if($status=='ok_estatus_borrar')
                <div class="col-sm-1"></div>
                <div id = "mensajeestatus" class="alert alert-success col-sm-10"><button class="close" data-dismiss="alert" type="button">×</button>
                <i class="bg-success"></i> La iniciativa fue eliminado con éxito</div>
                <div class="col-sm-1"></div>
                @endif
                @if($status=='error_estatus_borrar')
                <div class="col-sm-1"></div>
                <div id = "mensajeestatus"class="alert alert-danger col-sm-10"><button class="close" data-dismiss="alert" type="button">×</button>
                <i class="bg-danger"></i> La iniciativa NO fue eliminado</div>
                <div class="col-sm-1"></div>
                @endif
            <?php $status=0; ?>
          </div>
           <div class="row">
            <div class="col-sm-2">
              <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#cargar_proyecto">Crear iniciativa</button>
            </div>
            <div class="col-sm-2">
              <button id="btnedipro" disabled="disabled" data-target="#editar_proyecto"  data-toggle="modal" type="button" class="btn btn-primary">Editar iniciativa</button>
            </div>
            <div class="col-sm-2">  
            <button id="btndeletepro" disabled="disabled" data-target="#borrar_proyecto"  data-toggle="modal" type="button" class="btn btn-danger ">Borrar iniciativa</button>
            </div>
            <div class="col-sm-4"></div>
            <div class="col-sm-2"> 
              <div><a href='Excelpic_uno'><img class="img-responsive" src='assets/img/excel.png'></img></a></div>    
            </div>

          </div>
          <!--Aca inicia el modal para cargar nuevo proyecto-->
          <!-- Modal -->
          <div class="modal fade" id="cargar_proyecto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-keyboard="false" data-backdrop="static">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="myModalLabel">Ficha de iniciativa-PIC</h4>
                </div>
                <div class="modal-body">
                  <form role="form" action="artpic/crear-proyecto" method="post" id="crearindi" enctype="multipart/form-data" >
                      <div class="form-group">
                        {{Form::label('deptolabel','Departamento:',['class' => 'control-label'])}}
                        {{Form::select('depto', $arraydepto, '', ['class' => 'form-control', 'id'=>'depto','required'=>'true'])}}
                      </div>

                      <div class="form-group">
                         {{Form::label('mpiolable','Municipio:',['class' => 'control-label'])}}
                          <select name="mpios" id="mpios" class="form-control" required> 
                            <option value=''>Seleccione uno</option>
                          </select>

                      </div>
                      <div class="form-group">
                        {{Form::label('nucleolable','Núcleo veredal:',['class' => 'control-label'])}}
                        <select name="nucleo" id="nucleo" class="form-control" required> 
                            <option value=''>Seleccione uno</option>
                          </select>
                      </div>
                      <div class="form-group" style='display:none'>
                        {{Form::label('focallable','Focalización:',[ 'id'=>'focallable','class' => 'control-label','style'=>'display:none'])}}
                        {{Form::select('focal[]', $arrayfocali, '', ['multiple'=>'multiple','class' => 'form-control', 'id'=>'focal','disabled','style'=>'display:none'])}}
                      </div>

                      <div class="form-group" style='display:none' id="terr">
                        {{Form::label('tipoterrlable','Tipo de territorio:',['class' => 'control-label'])}}
                        {{Form::select ('tipoterr[]', $arraytipoterr, '', ['multiple'=>'multiple','class' => 'form-control', 'id'=>'tipoterr','required'=>'true'])}}
                      </div> 
                      <div class="form-group" style='display:none' id="select_terr">
                        {{Form::label('nom_terrlable','Nombre de territorios:',['class' => 'control-label'])}}
                        <select name="nom_terr[]" id="nom_terr" class="form-control"  multiple> 
                          </select>
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
                      <div class="form-group" >
                        {{Form::label('subsubcatelable','Intervención:',['id'=>'subsubcatelable','class' => 'control-label','style'=>'display:none'])}}
                        {{Form::select ('subsubcate[]', $arraysubsubcate,'', ['class' => 'form-control', 'id'=>'subsubcate','required'=>'true','style'=>'display:none'])}}
                      </div> 
                      <div class="form-group">
                        {{Form::label('nomproylable','Nombre de la iniciativa:',['class' => 'control-label'])}}
                        {{ Form::text('nomproy', Input::old('nomproy'), ['class' => 'form-control', 'id'=>'nomproy','required'=>'true']) }}
                      </div> 
                      <div class="form-group">
                        {{Form::label('alcancelable','Alcance de la iniciativa:',['class' => 'control-label'])}}
                        {{ Form::textarea('alcance', null, ['class' => 'form-control', 'id'=>'alcance','required'=>'true']) }}
                      </div> 
                      <div class="form-group">
                        {{Form::label('estadolabel','Estado de la iniciativa:',['class' => 'control-label'])}}
                        {{Form::select('estado', $arrayestado, '', ['class' => 'form-control', 'id'=>'estado','required'=>'true'])}}
                      </div>
                      <div class="form-group" >
                        {{Form::label('fechalable','Fecha de taller de priorización de la iniciativa:',['class' => 'control-label'])}}
                        {{ Form::text('fecha', Input::old('fecha'), ['class' => 'form-control', 'id'=>'datepicker','required'=>'true','onchange'=>'fecha_change(this)']) }}
                      </div> 
                      <div class="form-group">
                        <label for="rankinglable" class="control-label">Ranking de la iniciativa (Valor según la matriz de priorización del acta):<br/> 1 muy alto y 20 muy bajo</label>
                        <select name="checkranking" id="ranking" class="form-control" required title="Si el valor no se encuentra, es porque ya existe un proyecto con ese ranking en el núcleo"> 
                          <option value="">Seleccione uno </option>
                          <?php for ($i=1; $i <=20 ; $i++) { ?>
                          <option value=<?php echo $i; ?>><?php echo $i; ?></option>
                          <?php } ?>
                          </select>
                      </div>
                      <div class="form-group" >
                        {{Form::label('actalable','Adjuntar acta de priorización :',['class' => 'control-label'])}}
                        {{ Form::file('acta', ['class' => 'form-control', 'id'=>'acta','required'=>'true','accept'=>'.pdf','placeholder'=>'ej: acta.pdf' ]) }}
                      </div>
                      <div class="form-group">
                        {{Form::label('preciolable','Precio estimado PIC:',['class' => 'control-label'])}}
                        {{ Form::text('precio','', ['class' => 'form-control', 'id'=>'precio','required'=>'true','onchange'=>'precio_change(this)', 'placeholder'=>'ej: $30.000.000'])}}
                      </div>
                      <div class="checkbox-group">
                        {{Form::label('cofinalable','La iniciativa tiene cofinanciación:',['class' => 'control-label'])}}
                        <div class="form-group" id="radioperidiocidadid">
                          <input type="radio" name="radiocofin" id="cofin1" value="1" required> Si
                          <input type="radio" name="radiocofin" id="cofin2" value="2"> No
                        </div>
                      </div>
                      <div class="form-group" >
                        {{Form::label('sociolable','Elija el o los confinaciadores:',['id'=>'sociolable','class' => 'control-label','style'=>'display:none'])}}
                        {{Form::select ('socio[]', $arraysocio, '', ['multiple'=>'multiple','class' => 'form-control', 'id'=>'socio','style'=>'display:none'])}}
                      </div>
                      <div class="form-group col-sm-12" >
                        <div class="form-group col-sm-4" id="div-1" style='display:none'>
                          {{Form::label('lables-1','ART:',['id'=>'lables-1','class' => 'control-label'])}}
                          {{ Form::text('s-1','', ['class' => 'form-control', 'id'=>'s-1','placeholder'=>'$ cofinanciado','onchange'=>'precio_change(this)'])}}
                        </div>
                        <div class="form-group col-sm-4" id="div-2" style='display:none'>
                          {{Form::label('lables-2','Alcaldía:',['id'=>'lables-2','class' => 'control-label'])}}
                          {{ Form::text('s-2','', ['class' => 'form-control', 'id'=>'s-2','placeholder'=>'$ cofinanciado','onchange'=>'precio_change(this)'])}}
                        </div>
                        <div class="form-group col-sm-4" id="div-3" style='display:none'>
                          {{Form::label('lables-3','CAR:',['id'=>'lables-3','class' => 'control-label'])}}
                          {{ Form::text('s-3','', ['class' => 'form-control', 'id'=>'s-3','placeholder'=>'$ cofinanciado','onchange'=>'precio_change(this)'])}}
                        </div>
                        <div class="form-group col-sm-4" id="div-4" style='display:none'>
                          {{Form::label('lables-4','DPS:',['id'=>'lables-4','class' => 'control-label'])}}
                          {{ Form::text('s-4','', ['class' => 'form-control', 'id'=>'s-4','placeholder'=>'$ cofinanciado','onchange'=>'precio_change(this)'])}}
                        </div>
                        <div class="form-group col-sm-4" id="div-5" style='display:none'>
                          {{Form::label('lables-5','Gobernación:',['id'=>'lables-5','class' => 'control-label'])}}
                          {{ Form::text('s-5','', ['class' => 'form-control', 'id'=>'s-5','placeholder'=>'$ cofinanciado','onchange'=>'precio_change(this)'])}}
                        </div>
                        <div class="form-group col-sm-4" id="div-6" style='display:none'>
                          {{Form::label('lables-6','JAC:',['id'=>'lables-6','class' => 'control-label'])}}
                          {{ Form::text('s-6','', ['class' => 'form-control', 'id'=>'s-6','placeholder'=>'$ cofinanciado','onchange'=>'precio_change(this)'])}}
                        </div>
                        <div class="form-group col-sm-4" id="div-7" style='display:none'>
                          {{Form::label('lables-7','Min Agricultura  :',['id'=>'lables-7','class' => 'control-label'])}}
                          {{ Form::text('s-7','', ['class' => 'form-control', 'id'=>'s-7','placeholder'=>'$ cofinanciado','onchange'=>'precio_change(this)'])}}
                        </div>
                        <div class="form-group col-sm-4" id="div-8" style='display:none'>
                          {{Form::label('lables-8','Min Ambiente:',['id'=>'lables-8','class' => 'control-label'])}}
                          {{ Form::text('s-8','', ['class' => 'form-control', 'id'=>'s-8','placeholder'=>'$ cofinanciado','onchange'=>'precio_change(this)'])}}
                        </div>
                        <div class="form-group col-sm-4" id="div-9" style='display:none'>
                          {{Form::label('lables-9','Min CIT:',['id'=>'lables-9','class' => 'control-label'])}}
                          {{ Form::text('s-9','', ['class' => 'form-control', 'id'=>'s-9','placeholder'=>'$ cofinanciado','onchange'=>'precio_change(this)'])}}
                        </div>
                        <div class="form-group col-sm-4" id="div-10" style='display:none'>
                          {{Form::label('lables-10','Min Cultura:',['id'=>'lables-10','class' => 'control-label'])}}
                          {{ Form::text('s-10','', ['class' => 'form-control', 'id'=>'s-10','placeholder'=>'$ cofinanciado','onchange'=>'precio_change(this)'])}}
                        </div>
                        <div class="form-group col-sm-4" id="div-11" style='display:none'>
                          {{Form::label('lables-11','Min Defensa:',['id'=>'lables-11','class' => 'control-label'])}}
                          {{ Form::text('s-11','', ['class' => 'form-control', 'id'=>'s-11','placeholder'=>'$ cofinanciado','onchange'=>'precio_change(this)'])}}
                        </div>
                        <div class="form-group col-sm-4" id="div-12" style='display:none'>
                          {{Form::label('lables-12','Min Educación:',['id'=>'lables-12','class' => 'control-label'])}}
                          {{ Form::text('s-12','', ['class' => 'form-control', 'id'=>'s-12','placeholder'=>'$ cofinanciado','onchange'=>'precio_change(this)'])}}
                        </div>
                        <div class="form-group col-sm-4" id="div-13" style='display:none'>
                          {{Form::label('lables-13','Min Hacienda:',['id'=>'lables-13','class' => 'control-label'])}}
                          {{ Form::text('s-13','', ['class' => 'form-control', 'id'=>'s-13','placeholder'=>'$ cofinanciado','onchange'=>'precio_change(this)'])}}
                        </div>
                        <div class="form-group col-sm-4" id="div-14" style='display:none'>
                          {{Form::label('lables-14','Min Justicia:',['id'=>'lables-14','class' => 'control-label'])}}
                          {{ Form::text('s-14','', ['class' => 'form-control', 'id'=>'s-14','placeholder'=>'$ cofinanciado','onchange'=>'precio_change(this)'])}}
                        </div>
                        <div class="form-group col-sm-4" id="div-15" style='display:none'>
                          {{Form::label('lables-15','Min TIC:',['id'=>'lables-15','class' => 'control-label'])}}
                          {{ Form::text('s-15','', ['class' => 'form-control', 'id'=>'s-15','placeholder'=>'$ cofinanciado','onchange'=>'precio_change(this)'])}}
                        </div>
                        <div class="form-group col-sm-4" id="div-16" style='display:none'>
                          {{Form::label('lables-16','Min Minas:',['id'=>'lables-16','class' => 'control-label'])}}
                          {{ Form::text('s-16','', ['class' => 'form-control', 'id'=>'s-16','placeholder'=>'$ cofinanciado','onchange'=>'precio_change(this)'])}}
                        </div>
                        <div class="form-group col-sm-4" id="div-17" style='display:none'>
                          {{Form::label('lables-17','Cancilleria:',['id'=>'lables-17','class' => 'control-label'])}}
                          {{ Form::text('s-17','', ['class' => 'form-control', 'id'=>'s-17','placeholder'=>'$ cofinanciado','onchange'=>'precio_change(this)'])}}
                        </div>
                        <div class="form-group col-sm-4" id="div-18" style='display:none'>
                          {{Form::label('lables-18','Min Salud:',['id'=>'lables-18','class' => 'control-label'])}}
                          {{ Form::text('s-18','', ['class' => 'form-control', 'id'=>'s-18','placeholder'=>'$ cofinanciado','onchange'=>'precio_change(this)'])}}
                        </div>
                        <div class="form-group col-sm-4" id="div-19" style='display:none'>
                          {{Form::label('lables-19','Min Trabajo:',['id'=>'lables-19','class' => 'control-label'])}}
                          {{ Form::text('s-19','', ['class' => 'form-control', 'id'=>'s-19','placeholder'=>'$ cofinanciado','onchange'=>'precio_change(this)'])}}
                        </div>
                        <div class="form-group col-sm-4" id="div-20" style='display:none'>
                          {{Form::label('lables-20','Min Transporte:',['id'=>'lables-20','class' => 'control-label'])}}
                          {{ Form::text('s-20','', ['class' => 'form-control', 'id'=>'s-20','placeholder'=>'$ cofinanciado','onchange'=>'precio_change(this)'])}}
                        </div>
                        <div class="form-group col-sm-4" id="div-21" style='display:none'>
                          {{Form::label('lables-21','Min Vivienda:',['id'=>'lables-21','class' => 'control-label'])}}
                          {{ Form::text('s-21','', ['class' => 'form-control', 'id'=>'s-21','placeholder'=>'$ cofinanciado','onchange'=>'precio_change(this)'])}}
                        </div>
                        <div class="form-group col-sm-4" id="div-22" style='display:none'>
                          {{Form::label('lables-22','Min Interior:',['id'=>'lables-22','class' => 'control-label'])}}
                          {{ Form::text('s-22','', ['class' => 'form-control', 'id'=>'s-22','placeholder'=>'$ cofinanciado','onchange'=>'precio_change(this)'])}}
                        </div>
                        <div class="form-group col-sm-4" id="div-23" style='display:none'>
                          {{Form::label('lables-23','Org. comunitarias:',['id'=>'lables-23','class' => 'control-label'])}}
                          {{ Form::text('s-23','', ['class' => 'form-control', 'id'=>'s-23','placeholder'=>'$ cofinanciado','onchange'=>'precio_change(this)',])}}
                        </div>
                        <div class="form-group col-sm-4" id="div-24" style='display:none'>
                          {{Form::label('lables-24','Org internacionales:',['id'=>'lables-24','class' => 'control-label'])}}
                          {{ Form::text('s-24','', ['class' => 'form-control', 'id'=>'s-24','placeholder'=>'$ cofinanciado','onchange'=>'precio_change(this)',])}}
                        </div>
                        <div class="form-group col-sm-4" id="div-25" style='display:none'>
                          {{Form::label('lables-25','Otro:',['id'=>'lables-25','class' => 'control-label'])}}
                          {{ Form::text('s-25','', ['class' => 'form-control', 'id'=>'s-25','placeholder'=>'$ cofinanciado','onchange'=>'precio_change(this)'])}}
                        </div>
                        <div class="form-group col-sm-4" id="divotro" style='display:none'>
                          {{Form::label('otrolables','Defina Otro:',['id'=>'otrolables','class' => 'control-label'])}}
                          {{ Form::text('otro','', ['class' => 'form-control', 'id'=>'otro'])}}
                        </div>
                      </div> 
                      <div class="form-group" id="div-cofina" style='display:none'>
                        {{Form::label('cofinalabel','Total de confinanciación:',['id'=>'cofinalabel','class' => 'control-label'])}}
                        {{ Form::text('cofina','', ['class' => 'form-control', 'id'=>'cofina', 'placeholder'=>'$ cofinanciado','disabled'=>'true'])}}
                        {{ Form::hidden('cofinan','', ['class' => 'form-control', 'id'=>'cofinan'])}}
                      </div>
                      <div class="form-group " id="divcofi_preci" style='display:none'>
                          {{Form::label('cofi_precilables','Precio TOTAL estimado (precio estimado PIC + cofinanciación):',['id'=>'cofi_precilables','class' => 'control-label'])}}
                          {{Form::text('cofi_preci','', ['class' => 'form-control', 'id'=>'cofi_preci','readonly'=>'true','onchange'=>'precio_change(this)'])}}
                      </div>
                      <div class="form-group text-right"  id="cargueind">                
                        <button type="submit" class="btn btn-primary" >Crear</button>
                        <button type="button" class="btn btn-primary" onclick="window.location=window.location.pathname">Cancelar</button> 
                      </div>
                    </form>
                </div>
              </div>
            </div>
          </div>
          <!--Aca finaliza el modal para cargar nuevo proyecto-->
          <!--Aca inicia el modal para editar proyecto-->
          <div class="modal fade" id="editar_proyecto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-keyboard="false" data-backdrop="static">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="Editar_tittle">Editar iniciativa-PIC</h4>
                </div>
                <div class="modal-body">
                  <form role="form" action="artpic/editar-proyecto" method="post" id="crearindi" enctype="multipart/form-data" >
                      <div class="form-group">
                        <input  id = "ediidproy" name = "ediidproy" class="form-control" type="hidden" required="true" ></input>               
                      </div>
                      <div class="form-group">
                            <label for="IDlabel" class="control-label">ID</label>
                            <input  id = "ID" name = "ID" class="form-control" type="text" disabled ></input>            
                      </div>
                      <div class="form-group">
                        {{Form::label('edideptolabel','Departamento',['class' => 'control-label'])}}
                        {{ Form::text('edidepto', Input::old('edidepto'), ['class' => 'form-control', 'id'=>'edidepto','required'=>'true','readonly'=>'true']) }}
                        <input  id = "edidepto2" name = "edidepto2" class="form-control" type="hidden"  ></input> 
                      </div>

                      <div class="form-group">
                        {{Form::label('edimpioslable','Municipios:',['class' => 'control-label'])}}
                        {{ Form::text('edimpios', Input::old('edimpios'), ['class' => 'form-control', 'id'=>'edimpios','required'=>'true','readonly'=>'true']) }}
                         <input  id = "edimpios2" name = "edimpios2" class="form-control" type="hidden"  ></input> 
                      </div>
                      <div class="form-group">
                        {{Form::label('edinucleolable','Núcleo veredal:',['class' => 'control-label'])}}
                        {{ Form::text('edinucleo', Input::old('edinucleo'), ['class' => 'form-control', 'id'=>'edinucleo','required'=>'true','readonly'=>'true']) }}
                        <input  id = "edinucleo2" name = "edinucleo2" class="form-control" type="hidden"  ></input> 
                      </div>

                      <div class="form-group" >
                        {{Form::label('editipoterrlable','Tipo de territorio:',['class' => 'control-label'])}}
                        {{Form::select('editipoterr[]', $arraytipoterr, '', ['multiple'=>'multiple','class' => 'form-control', 'id'=>'editipoterr','required'=>'true'])}}
                      </div> 
                      <div class="form-group"  id="select_terredi">
                        {{Form::label('nom_terrlableedi','Nombre de territorios:',['class' => 'control-label'])}}
                        <select name="nom_terredi[]" id="nom_terredi" class="form-control" multiple> 
                          </select>
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
                      <div class="form-group" >
                        {{Form::label('edisubsubcatelable','Intervención:',['id'=>'edisubsubcatelable','class' => 'control-label'])}}
                        {{Form::select ('edisubsubcate[]', $arraysubsubcate, '', ['class' => 'form-control', 'id'=>'edisubsubcate','required'=>'true'])}}
                      </div> 
                      <div class="form-group">
                        {{Form::label('edinomproylable','Nombre de la iniciativa:',['class' => 'control-label'])}}
                        {{ Form::text('edinomproy', Input::old('nomproy'), ['class' => 'form-control', 'id'=>'edinomproy','required'=>'true']) }}
                      </div> 
                      <div class="form-group">
                        {{Form::label('edialcancelable','Alcance de la iniciativa:',['class' => 'control-label'])}}
                        {{ Form::textarea('edialcance', null, ['class' => 'form-control', 'id'=>'edialcance','required'=>'true']) }}
                      </div> 
                      <div class="form-group">
                        {{Form::label('ediestadolabel','Estado de la iniciativa',['class' => 'control-label'])}}
                        {{Form::select('ediestado', $arrayestado, '', ['class' => 'form-control', 'id'=>'ediestado','required'=>'true'])}}
                      </div>
                      <div class="form-group" >
                        {{Form::label('edifechalable','Fecha de taller de priorización de la iniciativa:',['class' => 'control-label'])}}
                        {{ Form::text('edifecha', Input::old('edifecha'), ['class' => 'form-control', 'id'=>'edidatepicker','required'=>'true','onchange'=>'fecha_change(this)']) }}
                      </div>
                      <div class="form-group">
                        <label for="edirankinglable" class="control-label">Ranking de la iniciativa (Valor según la matriz de priorización del acta):<br/> 1 muy alto - 20 muy bajo</label>
                        <select name="edicheckranking" id="ediranking" class="form-control" required > 
                          <option value="">Seleccione uno </option>
                          <?php for ($i=1; $i <=20 ; $i++) { ?>
                          <option value=<?php echo $i; ?>><?php echo $i; ?></option>
                          <?php } ?>
                          </select>
                          </select>
                      </div>
                      <div class="col-sm-12"><br></div>
                      <div class="form-group col-sm-12" style="padding: 0;">
                      <div class="form-group col-sm-4" style="padding: 0;">
                        {{Form::label('actalable','Acta de priorización :',['class' => 'control-label'])}}
                      </div>
                      <div class="col-sm-8">
                        <span >
                          <a id="ediacta" target="_blank" href="" class="glyphicon glyphicon-download-alt btn btn-primary" title="Descargar acta" role="button"></a>
                        </span>
                      </div>
                    </div>
                    <div class="form-group col-sm-12" style="padding: 0;">
                      <div class="form-group col-sm-3" style="padding: 0;">
                        {{Form::label('actalableedi','Desea editar el acta anterior:',['class' => 'control-label'])}}
                      </div>
                      <div class="form-group col-sm-3" style="right-padding: 0;">
                        <div id="edicheckediacta">
                          <input type="radio" name="ediacta" value="1" required> Si
                          <input type="radio" name="ediacta" value="2"> No
                        </div>
                      </div>
                      <div class="form-group col-sm-6" style="padding: 0;display:none"id= 'div_acta'>
                        {{ Form::file('actaedi', ['class' => 'form-control', 'id'=>'actaedi','required'=>'true','accept'=>'.pdf','placeholder'=>'ej: acta.pdf' ]) }}
                      </div>
                    </div>
                      <div class="form-group">
                        {{Form::label('edipreciolable','Precio estimado PIC:',['class' => 'control-label'])}}
                        {{ Form::text('ediprecio','', ['class' => 'form-control', 'id'=>'ediprecio','required'=>'true','onchange'=>'precio_change2(this)'])}}
                      </div>
                      <div class="checkbox-group">
                        {{Form::label('cofinalable','La iniciativa tiene cofinanciación:',['class' => 'control-label'])}}
                        <div class="form-group" id="radioperidiocidadid">
                          <input type="radio" name="ediradiocofin" id="edicofin1" value="1" required> Si
                          <input type="radio" name="ediradiocofin" id="edicofin2" value="2"> No
                        </div>
                      </div>
                      <div class="form-group" >
                        {{Form::label('edisociolable','Elija el o los confinaciadores:',['id'=>'edisociolable','class' => 'control-label','style'=>'display:none'])}}
                        {{Form::select ('edisocio[]', $arraysocio, '', ['multiple'=>'multiple','class' => 'form-control', 'id'=>'edisocio','style'=>'display:none'])}}
                      </div>
                      <div class="form-group col-sm-12" >
                        <div class="form-group col-sm-4" id="edidiv-1" style='display:none'>
                          {{Form::label('edilables-1','ART:',['id'=>'edilables-1','class' => 'control-label'])}}
                          {{ Form::text('edis-1','', ['class' => 'form-control', 'id'=>'edis-1','placeholder'=>'$ cofinanciado','onchange'=>'precio_change2(this)'])}}
                        </div>
                        <div class="form-group col-sm-4" id="edidiv-2" style='display:none'>
                          {{Form::label('edilables-2','Alcaldía:',['id'=>'edilables-2','class' => 'control-label'])}}
                          {{ Form::text('edis-2','', ['class' => 'form-control', 'id'=>'edis-2','placeholder'=>'$ cofinanciado','onchange'=>'precio_change2(this)'])}}
                        </div>
                        <div class="form-group col-sm-4" id="edidiv-3" style='display:none'>
                          {{Form::label('edilables-3','CAR:',['id'=>'edilables-3','class' => 'control-label'])}}
                          {{ Form::text('edis-3','', ['class' => 'form-control', 'id'=>'edis-3','placeholder'=>'$ cofinanciado','onchange'=>'precio_change2(this)'])}}
                        </div>
                        <div class="form-group col-sm-4" id="edidiv-4" style='display:none'>
                          {{Form::label('edilables-4','DPS:',['id'=>'edilables-4','class' => 'control-label'])}}
                          {{ Form::text('edis-4','', ['class' => 'form-control', 'id'=>'edis-4','placeholder'=>'$ cofinanciado','onchange'=>'precio_change2(this)'])}}
                        </div>
                        <div class="form-group col-sm-4" id="edidiv-5" style='display:none'>
                          {{Form::label('edilables-5','Gobernación:',['id'=>'edilables-5','class' => 'control-label'])}}
                          {{ Form::text('edis-5','', ['class' => 'form-control', 'id'=>'edis-5','placeholder'=>'$ cofinanciado','onchange'=>'precio_change2(this)'])}}
                        </div>
                        <div class="form-group col-sm-4" id="edidiv-6" style='display:none'>
                          {{Form::label('edilables-6','JAC:',['id'=>'edilables-6','class' => 'control-label'])}}
                          {{ Form::text('edis-6','', ['class' => 'form-control', 'id'=>'edis-6','placeholder'=>'$ cofinanciado','onchange'=>'precio_change2(this)'])}}
                        </div>
                        <div class="form-group col-sm-4" id="edidiv-7" style='display:none'>
                          {{Form::label('edilables-7','Min Agricultura  :',['id'=>'edilables-7','class' => 'control-label'])}}
                          {{ Form::text('edis-7','', ['class' => 'form-control', 'id'=>'edis-7','placeholder'=>'$ cofinanciado','onchange'=>'precio_change2(this)'])}}
                        </div>
                        <div class="form-group col-sm-4" id="edidiv-8" style='display:none'>
                          {{Form::label('edilables-8','Min Ambiente:',['id'=>'edilables-8','class' => 'control-label'])}}
                          {{ Form::text('edis-8','', ['class' => 'form-control', 'id'=>'edis-8','placeholder'=>'$ cofinanciado','onchange'=>'precio_change2(this)'])}}
                        </div>
                        <div class="form-group col-sm-4" id="edidiv-9" style='display:none'>
                          {{Form::label('edilables-9','Min CIT:',['id'=>'edilables-9','class' => 'control-label'])}}
                          {{ Form::text('edis-9','', ['class' => 'form-control', 'id'=>'edis-9','placeholder'=>'$ cofinanciado','onchange'=>'precio_change2(this)'])}}
                        </div>
                        <div class="form-group col-sm-4" id="edidiv-10" style='display:none'>
                          {{Form::label('edilables-10','Min Cultura:',['id'=>'edilables-10','class' => 'control-label'])}}
                          {{ Form::text('edis-10','', ['class' => 'form-control', 'id'=>'edis-10','placeholder'=>'$ cofinanciado','onchange'=>'precio_change2(this)'])}}
                        </div>
                        <div class="form-group col-sm-4" id="edidiv-11" style='display:none'>
                          {{Form::label('edilables-11','Min Defensa:',['id'=>'edilables-11','class' => 'control-label'])}}
                          {{ Form::text('edis-11','', ['class' => 'form-control', 'id'=>'edis-11','placeholder'=>'$ cofinanciado','onchange'=>'precio_change2(this)'])}}
                        </div>
                        <div class="form-group col-sm-4" id="edidiv-12" style='display:none'>
                          {{Form::label('edilables-12','Min Educación:',['id'=>'edilables-12','class' => 'control-label'])}}
                          {{ Form::text('edis-12','', ['class' => 'form-control', 'id'=>'edis-12','placeholder'=>'$ cofinanciado','onchange'=>'precio_change2(this)'])}}
                        </div>
                        <div class="form-group col-sm-4" id="edidiv-13" style='display:none'>
                          {{Form::label('edilables-13','Min Hacienda:',['id'=>'edilables-13','class' => 'control-label'])}}
                          {{ Form::text('edis-13','', ['class' => 'form-control', 'id'=>'edis-13','placeholder'=>'$ cofinanciado','onchange'=>'precio_change2(this)'])}}
                        </div>
                        <div class="form-group col-sm-4" id="edidiv-14" style='display:none'>
                          {{Form::label('edilables-14','Min Justicia:',['id'=>'edilables-14','class' => 'control-label'])}}
                          {{ Form::text('edis-14','', ['class' => 'form-control', 'id'=>'edis-14','placeholder'=>'$ cofinanciado','onchange'=>'precio_change2(this)'])}}
                        </div>
                        <div class="form-group col-sm-4" id="edidiv-15" style='display:none'>
                          {{Form::label('edilables-15','Min TIC:',['id'=>'edilables-15','class' => 'control-label'])}}
                          {{ Form::text('edis-15','', ['class' => 'form-control', 'id'=>'edis-15','placeholder'=>'$ cofinanciado','onchange'=>'precio_change2(this)'])}}
                        </div>
                        <div class="form-group col-sm-4" id="edidiv-16" style='display:none'>
                          {{Form::label('edilables-16','Min Minas:',['id'=>'edilables-16','class' => 'control-label'])}}
                          {{ Form::text('edis-16','', ['class' => 'form-control', 'id'=>'edis-16','placeholder'=>'$ cofinanciado','onchange'=>'precio_change2(this)'])}}
                        </div>
                        <div class="form-group col-sm-4" id="edidiv-17" style='display:none'>
                          {{Form::label('edilables-17','Cancilleria:',['id'=>'edilables-17','class' => 'control-label'])}}
                          {{ Form::text('edis-17','', ['class' => 'form-control', 'id'=>'edis-17','placeholder'=>'$ cofinanciado','onchange'=>'precio_change2(this)'])}}
                        </div>
                        <div class="form-group col-sm-4" id="edidiv-18" style='display:none'>
                          {{Form::label('edilables-18','Min Salud:',['id'=>'edilables-18','class' => 'control-label'])}}
                          {{ Form::text('edis-18','', ['class' => 'form-control', 'id'=>'edis-18','placeholder'=>'$ cofinanciado','onchange'=>'precio_change2(this)'])}}
                        </div>
                        <div class="form-group col-sm-4" id="edidiv-19" style='display:none'>
                          {{Form::label('edilables-19','Min Trabajo:',['id'=>'edilables-19','class' => 'control-label'])}}
                          {{ Form::text('edis-19','', ['class' => 'form-control', 'id'=>'edis-19','placeholder'=>'$ cofinanciado','onchange'=>'precio_change2(this)'])}}
                        </div>
                        <div class="form-group col-sm-4" id="edidiv-20" style='display:none'>
                          {{Form::label('edilables-20','Min Transporte:',['id'=>'edilables-20','class' => 'control-label'])}}
                          {{ Form::text('edis-20','', ['class' => 'form-control', 'id'=>'edis-20','placeholder'=>'$ cofinanciado','onchange'=>'precio_change2(this)'])}}
                        </div>
                        <div class="form-group col-sm-4" id="edidiv-21" style='display:none'>
                          {{Form::label('edilables-21','Min Vivienda:',['id'=>'edilables-21','class' => 'control-label'])}}
                          {{ Form::text('edis-21','', ['class' => 'form-control', 'id'=>'edis-21','placeholder'=>'$ cofinanciado','onchange'=>'precio_change2(this)'])}}
                        </div>
                        <div class="form-group col-sm-4" id="edidiv-22" style='display:none'>
                          {{Form::label('edilables-22','Min Interior:',['id'=>'edilables-22','class' => 'control-label'])}}
                          {{ Form::text('edis-22','', ['class' => 'form-control', 'id'=>'edis-22','placeholder'=>'$ cofinanciado','onchange'=>'precio_change2(this)'])}}
                        </div>
                        <div class="form-group col-sm-4" id="edidiv-23" style='display:none'>
                          {{Form::label('edilables-23','Org. comunitarias:',['id'=>'edilables-23','class' => 'control-label'])}}
                          {{ Form::text('edis-23','', ['class' => 'form-control', 'id'=>'edis-23','placeholder'=>'$ cofinanciado','onchange'=>'precio_change2(this)',])}}
                        </div>
                        <div class="form-group col-sm-4" id="edidiv-24" style='display:none'>
                          {{Form::label('edilables-24','Org internacionales:',['id'=>'edilables-24','class' => 'control-label'])}}
                          {{ Form::text('edis-24','', ['class' => 'form-control', 'id'=>'edis-24','placeholder'=>'$ cofinanciado','onchange'=>'precio_change2(this)',])}}
                        </div>
                        <div class="form-group col-sm-4" id="edidiv-25" style='display:none'>
                          {{Form::label('edilables-25','Otro:',['id'=>'edilables-25','class' => 'control-label'])}}
                          {{ Form::text('edis-25','', ['class' => 'form-control', 'id'=>'edis-25','placeholder'=>'$ cofinanciado','onchange'=>'precio_change2(this)'])}}
                        </div>
                        <div class="form-group col-sm-4" id="edidivotro" style='display:none'>
                          {{Form::label('ediotrolables','Defina Otro:',['id'=>'ediotrolables','class' => 'control-label'])}}
                          {{ Form::text('ediotro','', ['class' => 'form-control', 'id'=>'ediotro'])}}
                        </div>
                      </div> 
                      <div class="form-group" id="edidiv-cofina" style='display:none'>
                        {{Form::label('edicofinalabel','Total de confinanciación:',['id'=>'edicofinalabel','class' => 'control-label'])}}
                        {{ Form::text('edicofina','', ['class' => 'form-control', 'id'=>'edicofina', 'placeholder'=>'$ cofinanciado','disabled'=>'true'])}}
                        {{ Form::hidden('edicofinan','', ['class' => 'form-control', 'id'=>'edicofinan'])}}
                      </div> 
                      <div class="form-group " id="edidivcofi_preci" style='display:none'>
                          {{Form::label('edicofi_precilables','Precio TOTAL estimado (precio estimado PIC + cofinanciación):',['id'=>'edicofi_precilables','class' => 'control-label'])}}
                          {{Form::text('edicofi_preci','', ['class' => 'form-control', 'id'=>'edicofi_preci','readonly'=>'true','onchange'=>'precio_change(this)'])}}
                      </div>
                       
                      <div class="form-group text-right"  id="cargueind">                
                        <button type="submit" class="btn btn-primary" >Editar</button>
                        <button type="button" class="btn btn-primary" onclick="window.location=window.location.pathname">Cancelar</button> 
                      </div>
                    </form>
                </div>    
              </div>
            </div>
          </div>
          <!--Aca finaliza el modal para editar proyecto-->
          <!--Aca inicia el modal para borrar proyecto-->
          <div class="modal fade bs-example-modal-sm" id="borrar_proyecto" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" data-keyboard="false" data-backdrop="static">
            <div class="modal-dialog modal-sm" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="borrar_tittle">Borrar iniciativa-PIC</h4>
                  </div>
                  <div class="modal-body">
                    <form role="form" action="artpic/delete-proyecto" method="post" enctype="multipart/form-data" >
                          <div class="form-group">
                            <input  id = "deleteproy" name = "deleteproy" class="form-control" type="hidden" ></input>
                            <div class="form-group">
                              <label for="IDdelelabel" class="control-label">ID</label>
                              <input  id = "IDdele" name = "IDdele" class="form-control" type="text" disabled ></input>            
                            </div>   
                            <label for="deleteproylabel" class="control-label">Nombre de la iniciativa que va a borrar</label>
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
          <h4>Listado de iniciativas de proyecto</h4>
          <table id="tabla_proyectos" class="table table-striped table-bordered  nowrap" cellspacing="0" width="100%">
            <thead>  
              <tr class="text-primary" data-toggle="tooltip" data-placement="top" >
                <th class="text-center">AUTO</th>
                <th class="text-center">ID</th>
                <th class="text-center">Departamento</th>
                <th class="text-center">Municipio</th>
                <th class="text-center">Núcleo veredal</th>
                <th class="text-center">Nombre de la iniciativa</th>
                <th class="text-center">Subcategoría</th>                       
              </tr>
            </thead> 
             <tbody> 
                    @foreach($arrayindipic as $pro) 
                      <tr id="{{$pro->id_proy}}">
                        <td >{{$pro->id_proy}} </td>  
                        <td >{{$pro->ID}} </td> 
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
          $( "#ivsocifichapriorizadaproymenu" ).addClass("active");
          $( "#iniciomenupeq" ).html("<small> INICIO</small>");
          $( "#artmenupeq" ).html("<strong>ART<span class='caret'></span></strong>");
          $( "#ivsocifichapriorizadaproymenupeq" ).html("<strong><span class='glyphicon glyphicon-ok'></span>Ficha Priorizada Proyectos</strong>");
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

          table=$('#tabla_proyectos').DataTable({
              "order": [[ 0, "desc" ]],
               "scrollX": true,
              "columnDefs": [
                    {
                        "targets": [ 0 ],
                        "visible": false
                    }
                ]
          });
      });

//##### funciones para ingresar proyecto ###########
        var alerta=0;
        function fecha_change(a) {
          var today = new Date();
           var select=new Date(a.value.split('/')[2], a.value.split('/')[1] - 1, a.value.split('/')[0]);
           var fecha="20/02/2017";
           var fecha_antes=new Date(fecha.split('/')[2], fecha.split('/')[1] - 1, fecha.split('/')[0]);

          if (select>today || select<fecha_antes){
              alerta=alerta+1;

          }else{
          }
          if (alerta==2) {
            alert('Debe seleccionar una fecha entre el 20/02/2017 y el día de hoy');
            alerta=0;
            $(a).val('');
          };
        }


        function precio_change(a) {
          var total=0;
           var Format = wNumb({
              prefix: '$ ',
              decimals: 0,
              thousand: '.'
          });  

          if (a.id=='precio' || a.id=='ediprecio'){
              if (a.value>=30000000 && a.value<=450000000){
                  if ($('input[type=radio][name=radiocofin]:checked').val()==1){
                    for (var i = 0; i < $('#socio').val().length; i++) {
                      var id_socio=$('#socio').val()[i];
                      var total=parseFloat(total) + parseFloat(($('#s-'+id_socio).val().replace(/[$ .]/gi,"")));
                      
                    };
                    $('#cofinan').val(total);
                    $('#cofi_preci').val(Format.to(Number(parseFloat(total) + parseFloat(($('#precio').val().replace(/[$ .]/gi,""))))));

                  }else{
                    $('#cofi_preci').val(Format.to(Number(parseFloat(total) + parseFloat(($('#precio').val().replace(/[$ .]/gi,""))))));
                  }
                  $('#cofi_preci').val(Format.to(Number(parseFloat(total) + parseFloat(($('#precio').val().replace(/[$ .]/gi,""))))));
              }else{
                alert('El valor debe ser mayor o igual a $30.000.000 y menor a $450.000.000 millones');
               $(a).val('');
             }
          }else{
            if (a.value>=1000000){

              if ($('input[type=radio][name=radiocofin]:checked').val()==1){
                
                for (var i = 0; i < $('#socio').val().length; i++) {
                  var id_socio=$('#socio').val()[i];
                  var total=parseFloat(total) + parseFloat(($('#s-'+id_socio).val().replace(/[$ .]/gi,"")));
                  
                };
                $('#cofina').val(Format.to(Number(total)));
                $('#cofinan').val(total);
                $('#cofi_preci').val(Format.to(Number(parseFloat(total) + parseFloat(($('#precio').val().replace(/[$ .]/gi,""))))));

              }else{}
            }else{
              alert('El valor debe ser mayor o igual a $1.000.000 millones');
               $(a).val('');
            }
          }

        
            if ($(a).val()!=''){
              val_format=Format.to(Number($(a).val()))

              if(val_format==false){
                  document.getElementById(a.id).value="";
                  alert("Ingrese un valor valido")        
              } else {        
                  document.getElementById(a.id).value=val_format;                
              }   
            }  
        }

        function precio_change2(a) {
          var total=0;  
          var Format = wNumb({
              prefix: '$ ',
              decimals: 0,
              thousand: '.'
          });  
          if (a.id=='ediprecio' || a.id=='ediprecio'){
              if (a.value>=30000000 && a.value<=450000000){
                  if ($('input[type=radio][name=ediradiocofin]:checked').val()==1){
                    for (var i = 0; i < $('#edisocio').val().length; i++) {
                      var id_socio=$('#edisocio').val()[i];
                      var total=parseFloat(total) + parseFloat(($('#edis-'+id_socio).val().replace(/[$ .]/gi,"")));
                      
                    };
                    $('#edicofinan').val(total);
                    $('#edicofi_preci').val(Format.to(Number(parseFloat(total) + parseFloat(($('#ediprecio').val().replace(/[$ .]/gi,""))))));

                  }else{
                    $('#edicofi_preci').val(Format.to(Number(parseFloat(total) + parseFloat(($('#ediprecio').val().replace(/[$ .]/gi,""))))));
                  }
                  $('#edicofi_preci').val(Format.to(Number(parseFloat(total) + parseFloat(($('#ediprecio').val().replace(/[$ .]/gi,""))))));
                  }else{
                      alert('El valor debe ser mayor o igual a $30.000.000 y menor a $450.000.000 millones');
                     $(a).val('');
                   }
          }else{
              if (a.value>=1000000){

                if ($('input[type=radio][name=ediradiocofin]:checked').val()==1){
                  
                  for (var i = 0; i < $('#edisocio').val().length; i++) {
                    var id_socio=$('#edisocio').val()[i];
                    var total=parseFloat(total) + parseFloat(($('#edis-'+id_socio).val().replace(/[$ .]/gi,"")));
                    
                  };
                  $('#edicofina').val(Format.to(Number(total)));
                  $('#edicofinan').val(total);
                  $('#edicofi_preci').val(Format.to(Number(parseFloat(total) + parseFloat(($('#ediprecio').val().replace(/[$ .]/gi,""))))));


                }else{}
              }else{
                alert('El valor debe ser mayor a $1.000.000 y menor a $450.000.000 millones');
                 $(a).val('');
              }
          }

            if ($(a).val()!=''){
              val_format=Format.to(Number($(a).val()))

              if(val_format==false){
                  document.getElementById(a.id).value="";
                  alert("Ingrese un valor valido")        
              } else {        
                  document.getElementById(a.id).value=val_format;                
              }   
            }     
        }
 

    $("#depto").change(function(){

        $("#terr").css("display","none");
        $("#select_terr").css("display","none");
        $("#nucleo").empty();
        $("#nucleo").append("<option value=''>Seleccione una</option>");
        $('#mpios').empty();
        $("#mpios").append("<option value=''>Seleccione uno</option>");
        
         $.ajax({url:"artpic/mpios",type:"POST",data:{depto:$('#depto').val()},dataType:'json',//llama al controlador siscadi/siscadirepdpto que trae los valores necesario para la grafica
          success:function(data1){
            $.each(data1.arraympios, function(nom,datos){
              $("#mpios").append("<option value=\""+datos+"\">"+nom+"</option>");
            });

          },
          error:function(){alert('error');}
        });//Termina Ajax prueva
     
    });//Termina chage 

    $("#mpios").change(function(){
        
          $("#terr").css("display","none");
          $("#select_terr").css("display","none");
        $('#nucleo').empty();
        $("#nucleo").append("<option value=''>Seleccione una</option>");
        
         $.ajax({url:"artpic/nucleo",type:"POST",data:{mpio:$('#mpios').val()},dataType:'json',//llama al controlador siscadi/siscadirepdpto que trae los valores necesario para la grafica
          success:function(data1){

            $.each(data1.arraynucleos, function(nom,datos){
              $("#nucleo").append("<option value=\""+datos+"\">"+nom+"</option>");
            });

            $("#focallable").css("display","block");
            $("#focal").css("display","block");
            var tipofoca = [];
                    if(data1.arraytipofocalizado[0]==0 ){
                      tipofoca[0]=0;
                    }else{
                      tipofoca[0]=2
                    }
                    if(data1.arraytipofocalizado[1]==0 ){
                      tipofoca[1]=0;
                    }else{
                      tipofoca[1]=1
                    }
                    if(data1.arraytipofocalizado[2]==0 ){
                      tipofoca[2]=0;
                    }else{
                      tipofoca[2]=3
                    }
            $('#focal').val(tipofoca);

          },
          error:function(){
            alert('Este municipio no tiene ningún núcleo veredal asignado');
            $('#nucleo').empty();
             $("#nucleo").append("<option value=''>El municipio no tiene núcelo veredal asignado  </option>");
          }
        });//Termina Ajax prueva
     
    });//Termina chage 

$("#nucleo").change(function(){
   $("#tipoterr option:selected").removeAttr("selected");
   if($(this).val()==''){
    $("#terr").css("display","none");
    $("#select_terr").css("display","none");
  }else{
    $("#terr").css("display","block");
  
      var nucleo=$(this).val();
      /*$("#ranking").empty();
      $("#ranking").append("<option value=''>Seleccione uno</option>");
      $.ajax({url:"artpic/ranking",type:"POST",data:{nucleo:nucleo},dataType:'json',
        success:function(data){
          $.each(data, function(datos,nom){
                $("#ranking").append("<option value=\""+datos+"\">"+nom+"</option>");
              });
           
        },
        error:function(){alert('error');}
    });//Termina Ajax*/
  }
});


$("#tipoterr").change(function(){

  var tipoterr=$(this).val();
  var nucleo=$("#nucleo").val();
  if(tipoterr==null){
    $("#select_terr").css("display","none");
  }else{
    $("#select_terr").css("display","block");
    $('#nom_terr').empty();
    $.ajax({url:"artpic/admi-terr",type:"POST",data:{nucleo:nucleo,tipoterr:tipoterr},dataType:'json',
        success:function(data){
          for (var i = 0; i < Object.keys(data['arraynom_terri']).length; i++) {
             $("#nom_terr").append("<optgroup label=\""+data['arratodoterrtipo'][i]+"\">"+i+"</optgroup>");

            $.each(data['arraynom_terri'][i], function(datos,nom){
                $("#nom_terr").append("<option value=\""+datos+"\">"+nom+"</option>");
              });
          };
           
        },
        error:function(){alert('error');}
    });//Termina Ajax
  }
});

    
    $("#nom_supcate").change(function(){
      if($("#nom_supcate").val()!=""){
        $("#subsubcatelable").css("display","block");
        $("#subsubcate").css("display","block");
      }else{
         $("#subsubcatelable").css("display","none");
        $("#subsubcate").css("display","none");
      }
      $("#subsubcate").val("");
      var selected = $(':selected', this);
      var categoria=selected.closest('optgroup').attr('label');

      if (categoria=='Servicios públicos domiciliarios') {
        $("#subsubcate option[value=3]").hide();
        $("#subsubcate option[value=4]").hide();
        $("#subsubcate option[value=5]").show();
      }else{
        $("#subsubcate option[value=5]").hide();
        $("#subsubcate option[value=3]").show();
        $("#subsubcate option[value=4]").show();
      }
  
    });//Termina chage 

    $('input[type=radio][name=radiocofin]').change(function() {
        if (this.value == 1) {
           $("#sociolable").css("display","block");
           $("#socio").css("display","block");
            $("#socio").prop('required',true);
            $('#divcofi_preci').css("display","block");  
        }
        else if (this.value == 2) {
          $("#sociolable").css("display","none");
          $("#socio").css("display","none");
          $("#socio").prop('required',false);
          $('[id^=div-]').css("display","none");
          $('[id^=s-]').prop('required',false);
          $('#divcofi_preci').css("display","none");  
          $('#divotro').css("display","none");
          $('#otro').prop('required',false);
        }
    });

    $("#socio").change(function(){
        var total=0;
        var Format = wNumb({
              prefix: '$ ',
              decimals: 0,
              thousand: '.'
          });
        $('[id^=div-]').css("display","none");
        $('[id^=s-]').prop('required',false);
        $('#div-cofina').css("display","none");

        for (var i = 0; i < $('#socio').val().length; i++) {
          var id_socio=$('#socio').val()[i];
          $("#div-"+id_socio).css("display","block");
          $("#s-"+id_socio).prop('required',true);
          $('#div-cofina').css("display","block");  
          total=parseFloat(total) + parseFloat($('#s-'+id_socio).val());
          if (id_socio==25){
            $('#divotro').css("display","block");
            $('#otro').prop('required',true);
          }else{
            $('#divotro').css("display","none");
            $('#otro').prop('required',false);
          }
          $('#cofi_preci').val(Format.to(Number(parseFloat(total) + parseFloat(($('#precio').val().replace(/[$ .]/gi,""))))));
          $('#cofi_preci').css("display","block");  

        };
        $('#cofina').val(total);
        if (total>450000000){
          alert("el valor total de Cofinanciación supera los $450.000.000");
          $("#s-"+id_socio).val("");
        }

    });
//##### termina funciones para ingresar proyecto ###########

//##### funciones para editar proyecto ###########

    $("#edinom_supcate").change(function(){
      if($("#edinom_supcate").val()!=""){
        $("#edisubsubcatelable").css("display","block");
        $("#edisubsubcate").css("display","block");
      }else{
         $("#edisubsubcatelable").css("display","none");
        $("#edisubsubcate").css("display","none");
      }
      $("#edisubsubcate").val("");
      var selected = $(':selected', this);
      var categoria=selected.closest('optgroup').attr('label');
      if (categoria=='Servicios públicos domiciliarios') {
        $("#edisubsubcate option[value=3]").hide();
        $("#edisubsubcate option[value=4]").hide();
        $("#edisubsubcate option[value=5]").show();
      }else{
        $("#edisubsubcate option[value=5]").hide();
        $("#edisubsubcate option[value=3]").show();
        $("#edisubsubcate option[value=4]").show();
      }
  
    });//Termina chage 

    $('input[type=radio][name=ediradiocofin]').change(function() {
        if (this.value == 1) {
           $("#edisociolable").css("display","block");
           $("#edisocio").css("display","block");
            $("#edisocio").prop('required',true);
            $('#edidivcofi_preci').css("display","block");  
        }
        else if (this.value == 2) {
          $("#edisociolable").css("display","none");
          $("#edisocio").css("display","none");
          $("#edisocio").prop('required',false);
          $('[id^=edidiv-]').css("display","none");
          $('[id^=edis-]').prop('required',false);
          $('#edidivotro').css("display","none");
          $('#ediotro').prop('required',false);
          $('#edidivcofi_preci').css("display","none");  
        }
    });

    
    $('input[type=radio][name=ediacta]').change(function() {
        if (this.value == 1) {
           $("#div_acta").css("display","block");
            $("#actaedi").prop('required',true);  
        }
        else if (this.value == 2) {
          $("#div_acta").css("display","none");
          $("#actaedi").prop('required',false); 
        }
    });

    $("#edisocio").change(function(){
        var total=0;
        var Format = wNumb({
              prefix: '$ ',
              decimals: 0,
              thousand: '.'
          });
        $('[id^=edidiv-]').css("display","none");
        $('[id^=edis-]').prop('required',false);
        $('#edidiv-cofina').css("display","none");

        for (var i = 0; i < $('#edisocio').val().length; i++) {
          var id_socio=$('#edisocio').val()[i];
          $("#edidiv-"+id_socio).css("display","block");
          $("#edis-"+id_socio).prop('required',true);
          $('#edidiv-cofina').css("display","block");  
          total=parseFloat(total) + parseFloat($('#edis-'+id_socio).val());

          if (id_socio==25){
            $('#edidivotro').css("display","block");
            $('#ediotro').prop('required',true);
          }else{
            $('#edidivotro').css("display","none");
            $('#ediotro').prop('required',false);
          }
          $('#edicofi_preci').val(Format.to(Number(parseFloat(total) + parseFloat(($('#ediprecio').val().replace(/[$ .]/gi,""))))));
        };
        $('#edicofina').val(total);
        if (total>450000000){
          alert("el valor total de Cofinanciación supera los $450.000.000");
          $("#edis-"+id_socio).val("");
        }
      
    });


$("#editipoterr").change(function(){

  var tipoterr=$(this).val();
  var nucleo=$("#edinucleo2").val();
  if(tipoterr==null){
    $("#select_terredi").css("display","none");
  }else{
    $("#select_terredi").css("display","block");
    $('#nom_terredi').empty();
    $.ajax({url:"artpic/admi-terr",type:"POST",data:{nucleo:nucleo,tipoterr:tipoterr},dataType:'json',
        success:function(data){
          for (var i = 0; i < Object.keys(data['arraynom_terri']).length; i++) {
             $("#nom_terredi").append("<optgroup label=\""+data['arratodoterrtipo'][i]+"\">"+i+"</optgroup>");

            $.each(data['arraynom_terri'][i], function(datos,nom){
                $("#nom_terredi").append("<option value=\""+datos+"\">"+nom+"</option>");
              });
          };
           
        },
        error:function(){alert('error');}
    });//Termina Ajax
  }
});
//##### fin de funciones para editar proyecto ###########

    


    $('#tabla_proyectos tbody').on('click', 'tr', function () {
            var Format = wNumb({
              prefix: '$ ',
              decimals: 0,
              thousand: '.'
          }); 
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
                    $('[id^=edidiv-]').css("display","none");
                    $("#ID").val(data['arrayproy'][0].ID);
                    $("#ediidproy").val(data['arrayproy'][0].id_proy);
                    $("#ediacta").attr("href", data['arrayproy'][0].acta)
                    $("#edidepto").val(data['arrayproy'][0].cod_depto);
                    $("#edimpios").val(data['arrayproy'][0].cod_mpio);
                    $("#edidepto2").val(data['arrayproy'][0].depto);
                    $("#edimpios2").val(data['arrayproy'][0].muni);
                    var tipoterr = [];
                    $.each(data.arraytipoterr, function(nom,datos){
                         tipoterr.push(datos.toString());
                    });
                    $('#editipoterr').val(tipoterr);
                    $("#nom_terredi").empty();

                    for (var i = 0; i < Object.keys(data['arratodoterredi']).length; i++) {
                      $("#nom_terredi").append("<optgroup label=\""+data['arratodoterrtipoedi'][i]+"\">"+i+"</optgroup>");
                      $.each(data['arratodoterredi'][i], function(datos,nom){
                          $("#nom_terredi").append("<option value=\""+datos+"\">"+nom+"</option>");
                        });
                    };

                    var nameterr = [];
                    if(data.arraynomter!=""){
                      $.each(data.arraynomter, function(nom,datos){
                           nameterr.push(nom.toString());
                      });
                    }

                    $('#nom_terredi').val(nameterr);
                    $("#edinom_supcate").val(data['arrayproy'][0].id_subcat);
                    var selected = $(':selected', $("#edinom_supcate"));
                    var categoria=selected.closest('optgroup').attr('label');
                    if (categoria=='Servicios públicos domiciliarios') {
                      $("#edisubsubcate option[value=3]").hide();
                      $("#edisubsubcate option[value=4]").hide();
                      $("#edisubsubcate option[value=5]").show();
                    }else{
                      $("#edisubsubcate option[value=5]").hide();
                      $("#edisubsubcate option[value=3]").show();
                      $("#edisubsubcate option[value=4]").show();
                    }
                    var subsubcate = [];
                    $.each(data.arraysubsubcate, function(nom,datos){
                         subsubcate.push(datos.toString());
                    });
                    $('#edisubsubcate').val(subsubcate);



                    $("#edifocal").val(data['arrayproy'][0].id_focal);

                    $("#edinucleo").val(data['arrayproy'][0].cod_nucleo);
                    $("#edinucleo2").val(data['arrayproy'][0].nucleo);
                    $("#edinomproy").val(data['arrayproy'][0].nom_proy);
                    $("#edialcance").val(data['arrayproy'][0].alcance);

                    $("#ediestado").val(data['arrayproy'][0].estado_proy);
                    $("#ediprecio").val(Format.to(Number(data['arrayproy'][0].prec_estim)));
                    
                    if (data['arrayproy'][0].cofinanc>0){
                      $('input:radio[name="ediradiocofin"]').filter('[value=1]').attr('checked', true);
                      $("#edidiv-cofina").css("display","block");
                      $("#edicofina").val(Format.to(Number(data['arrayproy'][0].cofinanc)));
                      $("#edisociolable").css("display","block");
                      $("#edisocio").css("display","block");
                      var socio = [];
                      var socio_valor = [];
                      $.each(data.arraysocio, function(nom,datos){
                           socio.push(parseInt(nom));
                           socio_valor.push(parseFloat(datos));
                      });
                      $('#edisocio').val(socio);
                      for (var i = 0; i < socio.length; i++) {
                        $("#edidiv-"+socio[i]).css("display","block");
                        $("#edis-"+socio[i]).val(Format.to(Number(socio_valor[i])));
                        if (socio[i]==25) {
                          $("#ediotro").val(data['arraysociootro']);
                          $("#edidivotro").css("display","block");
                        } else{
                          $("#ediotro").val("");
                          $("#edidiv-25").css("display","none");
                          $("#edidivotro").css("display","none");
                        };
                         $("#edidivcofi_preci").css("display","block");
                      };
                     $("#edicofi_preci").val(Format.to(Number(parseFloat($("#ediprecio").val().replace(/[$ .]/gi,""))+parseFloat($("#edicofina").val().replace(/[$ .]/gi,"")))));
                    }else{
                      $('input:radio[name="ediradiocofin"]').filter('[value=2]').attr('checked', true);
                      $("#edidiv-cofina").css("display","none");
                      $("#edisociolable").css("display","none");
                      $("#edisocio").css("display","none");
                      $('[id^=edidiv-]').css("display","none");
                      $("#edidivotro").css("display","none");
                      $("#edidivcofi_preci").css("display","none");
                    }
                    

                    $("#edidatepicker").val(data['arrayproy'][0].fecha_ingreso);

                    /*$("#ediranking").empty();
                    var valida=0;
                      $.each(data['arrayrankingedi'], function(datos,nom){
                          if ((nom>data['arrayproy'][0].ranking) && valida==0){
                            $("#ediranking").append("<option value=\""+data['arrayproy'][0].ranking+"\">"+data['arrayproy'][0].ranking+"</option>");
                            valida++;
                          }
                          $("#ediranking").append("<option value=\""+nom+"\">"+nom+"</option>");
                        });*/

                    $("#ediranking").val(data['arrayproy'][0].ranking);

                    $("#IDdele").val(data['arrayproy'][0].ID);
                    $("#deletenombre").val(data['arrayproy'][0].nom_proy);
                    $("#deleteproy").val(data['arrayproy'][0].id_proy);
                    $("#deletenucleo").val(data['arrayproy'][0].cod_nucleo);

                    $("#ediacta").attr("href", data['arrayproy'][0].acta);
                    $("#ediacta_cambio").html(data['arrayproy'][0].acta);
                    

                  },
                  error:function(){alert('error');}
              });//Termina Ajax
            }
          });

$('#editar_proyecto').on('hidden.bs.modal', function (e) {//funcion que resetea el modal
   $(this).find('form').trigger('reset');
    table.$('tr.active').removeClass('active');
    $("#btnedipro").prop('disabled', true);
    $("#btndeletepro").prop('disabled', true);
})

$('#borrar_proyecto').on('hidden.bs.modal', function (e) {//funcion que resetea el modal
   $(this).find('form').trigger('reset');
    table.$('tr.active').removeClass('active');
    $("#btnedipro").prop('disabled', true);
    $("#btndeletepro").prop('disabled', true);
})

$('#cargar_proyecto').on('hidden.bs.modal', function (e) {
   $(this).find('form').trigger('reset');
    table.$('tr.active').removeClass('active');
    $("#subsubcatelable").css("display","none");
    $("#subsubcate").css("display","none");
    $("#socio").css("display","none");
    $("#sociolable").css("display","none");
    $('[id^=div-]').css("display","none");
    $('#div-cofina').css("display","none");
    $('#divcofi_preci').css("display","none");
})



    </script>    
@stop

@endif<!--Cierra el if de mostrar el contenido de la página si esta autenticado-->