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
<!--aca se escribe el codigo-->
    <h2 class="text-center text-primary">Zonas Veredales de Transición</h2>
    <br>
    <div class="tab-content">

      <div id="seguimiento" class="tab-pane fade in active">
        <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-10">
              <h3>Seguimiento de indicadores en zonas veredales de transición</h3>
              <p>Usted puede realizar la consulta y actualizacion de los indicadores para cada zona veredal de transición</p>
                    
              <div class="col-sm-3">
                <button id="Actualziar" title="Presione para actualizar un indicador" data-target="#actindicadorModal"  data-toggle="modal" type="button" class="btn btn-primary">Actualizar indicadores</button>
              </div>
              <div id="select_indi" class=" col-sm-4" style="display:none;">
                       
                <select name="nom_indicador" id="nom_indicador" class="form-control">
                   <option value="">Seleccione indicador</option>
                    <?php foreach($categorias as $key=>$val): ?>
                            <optgroup label="<?php echo $key; ?>">
                               <?php foreach($indicadores as $option): 
                                if ($option->cate==$key):?>
                                <option value=<?php echo $option->id; ?>><?php echo $option->nombre; ?></option>
                                 <?php endif; endforeach; ?>
                            </optgroup>
                    <?php endforeach; ?>
                </select>     
              </div>
            </div>
            <div class="col-sm-1"></div>
        </div>
      </div>

      <br>

      <div class="row">
        <?php $status=Session::get('status'); ?>
        
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
      <br>

      <div class="row">
        <div class="col-sm-1"></div>
        <div class="col-sm-10" id="tabla">
          <table id="tablaresumen"  class="table table-striped table-bordered nowrap" cellspacing="0" width="100%">
            <thead>
              <tr class="well text-primary ">
                
                <th class="text-center">Responsable</th>
                <th class="text-center" >Indicador</th>
                <th class="text-center">Zona veredal</th>
                <th class="text-center">Categoría</th>
                <th class="text-center">Valor</th>
                <th class="text-center">Metodo</th>
                <th class="text-center">tablero</th>
              </tr>
            </thead>
          </table>
        </div>
        <div class="col-sm-1"></div>
      </div> 

      <div class="row">
          <div class="col-sm-1"></div>
          <div class="col-sm-10" id="tabla2" style="display:none;">
            <form role="form" action="artzvtn/editseguiindi" method="post" id="formEdit">  
              <div class="form-group text-right"  >                
                <button type="submit" class="btn btn-primary" >Actualziar</button>
                <button type="button" class="btn btn-primary" onclick="window.location">Cancelar</button> 
              </div>  
              <table id="tablasegeiindi" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <thead>
                  <tr class="well text-primary ">
                    <th class="text-center">Indicador</th>
                    <th class="text-center">Responsable</th>
                    <th class="text-center">Zona Veredal</th>
                    <th class="text-center">Categoría</th>
                    <th class="text-center">Metodo</th>
                    <th class="text-center">Valor</th>
                    <th class="text-center">Meta Parcial</th>
                    <th class="text-center">Meta total</th>
                    <th class="text-center">Fecha de inicio</th>
                  </tr>
                </thead>
                <body id='body'>
                </body>  
              </table>
              <div class="form-group text-right"  >                
                <button type="submit" class="btn btn-primary" >Actualziar</button>
                <button type="button" class="btn btn-primary" onclick="window.location">Cancelar</button> 
              </div>
            </form>
          </div>
          <div class="col-sm-1"></div>
      </div>
    </div>
               
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
  <script src="assets/js/wNumb.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

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
          var table=$('#tablaresumen').DataTable();
          $('#datepicker').datepicker({
            maxViewMode: 0,
            language: "es",
            autoclose: true
          });//Termina datepicker  

          //carga la tabla deindicadores

        var arra_tabla_seg_indi = <?php echo json_encode($arraysegidicadores); ?>;  

        var arra_catego_seg_indi=<?php echo json_encode($categorias); ?>;

         

        for (i = 0; i < arra_tabla_seg_indi.length; i++) {
            if (arra_tabla_seg_indi[i].id_metodo==1){
                    Metodos="Porcentual";
                 
                 }else if (arra_tabla_seg_indi[i].id_metodo==2){
                    Metodos="Temporal";
                 }else{
                 Metodos="Contador";
                 }

            for (var key in arra_catego_seg_indi) {
                  if (arra_catego_seg_indi.hasOwnProperty(key)) {
                    if (arra_catego_seg_indi[key]==arra_tabla_seg_indi[i].id_categoria){
                      cate=key;
                    }
                  }
                }

            if (arra_tabla_seg_indi[i].id_tablero==1){
                    Tablero="Tablero del Presidente";
                 }else if (arra_tabla_seg_indi[i].id_tablero==2){
                    Tablero="Tablero general";
                 }else{
                  Tablero="Tablero detallado";
                 }   
            table.row.add([
            arra_tabla_seg_indi[i].id_responsable,
            arra_tabla_seg_indi[i].nombre,
            arra_tabla_seg_indi[i].id_zv,
            cate,
            arra_tabla_seg_indi[i].valor,
            Metodos,
            Tablero,
            ]).draw(false);  
        }

        //fin de carga la tabla deindicadores

        $('#Actualziar').click(function() {
            $("#tabla").css("display","none");
            $("#select_indi").css("display","block");
        });

        $('#select_indi').change(function() {
          $.ajax({url:"artzvtn/tablaseguiindi",type:"POST",data:{indi:$("#nom_indicador").val()},dataType:'json',
            success:function(data1){ 
              
              /*table2
                .clear()
                .draw();*/
               
                $("#tablasegeiindi").find("tr:gt(0)").remove();

                for (var i = 0; i < data1.length; i++) {
                  var tr = document.createElement('TR');
                      tr.setAttribute('id',data1[i].id);
                      for (var j = 1; j <  6; j++) {
                        var td = document.createElement('TD');
                        td.appendChild(document.createTextNode(Object.values(data1[i])[j]));
                        tr.appendChild(td);
                      };

                      for (var j = 6; j <  9; j++) {
                        var td = document.createElement('TD');
                        var input = document.createElement("input");
                        input.type = "number";
                        input.className = "form-control"; // set the CSS class
                        input.value=Object.values(data1[i])[j];
                        input.required="true";
                        input.id=Object.keys(data1[i])[j]+data1[i].id;
                        input.name=Object.keys(data1[i])[j]+data1[i].id;
                        input.style="width:90px";
                         td.appendChild(input);
                        tr.appendChild(td);
                      };


                      var div = document.createElement("div");
                      div.className ="input-daterange input-group";
                      div.id="datepicker-"+i;

                      var td = document.createElement('TD');
                      var input = document.createElement("input");
                      input.type = "text";
                      input.className = "input-sm form-control"; // set the CSS class
                      input.value=Object.values(data1[i])[j];
                      input.id=Object.keys(data1[i])[j]+data1[i].id;
                      input.name=Object.keys(data1[i])[j]+data1[i].id;
                      input.style="width:90px";
                      input.placeholder="dd/mm/aaaa"
                      input.addEventListener("click", mySecondFunction);
                      div.appendChild(input)
                      td.appendChild(div);
                      tr.appendChild(td);

                      var td = document.createElement('TD');
                      td.setAttribute('style',"display:none");
                      var input = document.createElement("input");
                      input.type = "hidden";
                      input.id='id_indi';
                      input.name='id_indi';
                      input.value=$('#nom_indicador').find('option:selected').val();
                      td.appendChild(input);
                      tr.appendChild(td);
                        
                     $('#body tr:last').after(tr)
                    /*table2.row.add([
                    Object.values(data1[i])[1],
                    Object.values(data1[i])[2],
                    Object.values(data1[i])[3],
                    Object.values(data1[i])[4],
                    Object.values(data1[i])[5]
                    ]).draw(false); */ 
                };

                $("#tabla2").css("display","block");

                 if (data1[0].metodo=="Porcentual"){
                    '[id^=fecha_ini]'
                    $('[id^=meta_parc]').prop('required',true);
                    $('[id^=meta_parc]').css("visibility","visible");
                    $('[id^=meta_total]').prop('required',true);
                    $('[id^=meta_total]').css("visibility","visible");
                    $('[id^=fecha_ini]').prop('required',false);


                  }else if(data1[0].metodo=="Temporal"){
                    $('[id^=meta_parc]').prop('required',true);
                    $('[id^=meta_parc]').css("visibility","visible");
                    $('[id^=meta_total]').prop('required',true);
                    $('[id^=meta_total]').css("visibility","visible");
                    $('[id^=fecha_ini]').prop('required',true);


                 }else{
                  $('[id^=meta_parc]').prop('required',false);
                    $('[id^=meta_parc]').css("visibility","hidden");
                    $('[id^=meta_total]').prop('required',false);
                    $('[id^=meta_total]').css("visibility","hidden");
                    $('[id^=fecha_ini]').prop('required',false);
                  }
            },
            error:function(){alert('error');}
          });//Termina Ajax

        });

        function mySecondFunction() {

            $('[id^=datepicker-]').datepicker({
              maxViewMode: 0,
              language: "es",
              autoclose: true
            });//Termina datepicker
        }
               
    });
    </script>    
@stop

@endif<!--Cierra el if de mostrar el contenido de la página si esta autenticado-->