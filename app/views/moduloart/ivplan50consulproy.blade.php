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
      <div class="col-sm-1"></div>
        <div class="col-sm-10">
        <!--aca se escribe el codigo-->
        <h2 class="text-center text-primary">Plan 51/50 </h2>
        <br><br>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#consultar_proyecto">Consultar proyecto</button>
        <!--Aca inicia el modal para cargar nuevo proyecto-->
        <!-- Modal -->
        <div class="modal fade" id="consultar_proyecto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Ficha de proyecto - Plan 51/50 </h4>
              </div>
              <div class="modal-body">
              <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <thead>
                <tr class="well text-primary" data-toggle="tooltip" data-placement="top" >
                  <th class="text-center">Varibale</th>    
                  <th class="text-center">Descripción</th>
                </tr>
                <tbody>
                  <tr>
                    <td>Departamento</td>
                    <td id="depto"></td>
                  </tr>
                  <tr>
                    <td>Municipio</td>
                    <td id="mpio"></td>
                  </tr>
                  <tr>
                    <td>Vereda</td>
                    <td id="vereda"></td>
                  </tr>
                  <tr>
                    <td>Nombre del proyecto</td>
                    <td id="nom_proy"></td>
                  </tr>
                  <tr>
                    <td>Modalidad de focalización</td>
                    <td id="mod_foca"></td>
                  </tr>
                  <tr>
                    <td>Entidad líder</td>
                    <td id="enti_lider"></td>
                  </tr>
                  <tr>
                    <td>Línea del proyecto</td>
                    <td id="linea_proy"></td>
                  </tr>
                  <tr>
                    <td>Alcance</td>
                    <td id="alcance"></td>
                  </tr>
                  <tr>
                    <td>Población beneficiaria</td>
                    <td id="pob_bene"></td>
                  </tr>
                  <tr>
                    <td>Estado del proyecto</td>
                    <td id="est_proy"></td>
                  </tr>
                  <tr>
                    <td>Fecha de inicio</td>
                    <td id="fecha_inicio"></td>
                  </tr>
                  <tr>
                    <td>Fecha finalización</td>
                    <td id="fecha_fin"></td>
                  </tr>
                  <tr>
                    <td>Avance presupuestal</td>
                    <td id="avance_pres"></td>
                  </tr>
                  <tr>
                    <td>Avance producto</td>
                    <td id="avance_prod"></td>
                  </tr>
                  <tr>
                    <td>Costo estimado</td>
                    <td id="costo_estim"></td>
                  </tr>
                  <tr>
                    <td>Costo Ejecutado</td>
                    <td id="costo_ejec"></td>
                  </tr>
                </tbody>  
                </thead>

              </table>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>                
              </div>
              
            </div>
          </div>
        </div>
        <!--Aca finaliza el modal para cargar nuevo proyecto-->
        
        <!--Acá inicia la tabla de proyectos-->
        <h4>Listado de proyectos</h4>       

        <table id="tabla_proyectos" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
          <thead>  
            <tr class="well text-primary" data-toggle="tooltip" data-placement="top" >
              <th class="text-center">Departamento</th>
              <th class="text-center">Municipio</th>
              <th class="text-center">Vereda(s)</th>
              <th class="text-center">Nombre del proyecto</th>
              <th class="text-center">Modalidad</th>
              <th class="text-center">Avance</th>                          
            </tr>
          </thead>
          <tbody>            
            @foreach($proyectos as $pro)
              <tr id="{{$pro->id}}">
                <td >{{$pro->NOM_DPTO}}</td>
                <td >{{$pro->NOM_MPIO}}</td>
                <td >{{$pro->vereda}}</td>
                <td >{{$pro->nom_proy}}</td>
                <td >{{$pro->mod_foca}}</td>
                <td>
                <div class="progress" style="margin-bottom: 0px">                    
                    @if($pro->avance_prod >=75)
                    <div class="progress-bar progress-bar-success progress-bar-striped col-xs-12" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{$pro->avance_prod}}%;color:black ">
                      {{$pro->avance_prod}}%
                    </div>
                    @elseif($pro->avance_prod >=25) 
                    <div class="progress-bar progress-bar-warning progress-bar-striped col-xs-12" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{$pro->avance_prod}}%;color:black ">
                      {{$pro->avance_prod}}%
                    </div> 
                    @else
                    <div class="progress-bar progress-bar-danger progress-bar-striped col-xs-12" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{$pro->avance_prod}}%;color:black ">
                      {{$pro->avance_prod}}%
                    </div> 
                    @endif
                </div>                
                </td>                                              
              </tr>            
            @endforeach    
          </tbody>
        </table>
        <!--Acá termina la tabla de proyectos-->       
        <!--fin del codigo-->
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
          $("#mensajeestatus").fadeOut(5000);
          $('#tabla_proyectos').DataTable();
      });

      //funcion que filtra los municipios por departamentos
      //------------------------------------------    

      var Format = wNumb({
        prefix: '$ ',
        decimals: 0,
        thousand: '.'
      });

      var table = $('#tabla_proyectos').DataTable();
      $('#tabla_proyectos tbody').on('click', 'tr', function () {
          if ( $(this).hasClass('active') ) {
              $(this).removeClass('active');
              $("#btnedipro").prop('disabled', true);
              $("#btndeletepro").prop('disabled', true);
          } else {
              table.$('tr.active').removeClass('active');
              $(this).addClass('active');
              var id=$(this);
              $("#btnedipro").prop('disabled', false);
              $("#btndeletepro").prop('disabled', false);
              //Consulta ajax para traer los atributos editables del proyecto
              //var num=($('td', this).eq(0).text());
              var id=$(this);
              var num=id[0].id;
              //var num=10;
              $.ajax({
                  url:"artpic/consultar-plan50",
                  type:"POST",
                  data:{proyecto: num},
                  dataType:'json',
                  success:function(data){
                      console.log(data[0]);
                      var date_1=data[0].fecha_inicio.split(" ");
                      var date_2=data[0].fecha_fin.split(" ");
                      var val_format_1=Format.to(Number(data[0].avance_pres));
                      var val_format_2=Format.to(Number(data[0].costo_estim));
                      var val_format_3=Format.to(Number(data[0].costo_ejec));
                      if(data[0].avance_prod>=75){
                      var avance='<div class="progress-bar progress-bar-success progress-bar-striped col-xs-12" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width:'+ data[0].avance_prod +'%; ">'+data[0].avance_prod+ '%</div>'  
                      } else if (data[0].avance_prod>=25){
                      var avance='<div class="progress-bar progress-bar-warning progress-bar-striped col-xs-12" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width:'+ data[0].avance_prod +'%; ">'+data[0].avance_prod+ '%</div>'  
                      } else {
                      var avance='<div class="progress-bar progress-bar-danger progress-bar-striped col-xs-12" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width:'+ data[0].avance_prod +'%; ">'+data[0].avance_prod+ '%</div>'
                      }
                      $("#depto").html(data[0].NOM_DPTO);
                      $("#mpio").html(data[0].NOM_MPIO);
                      $("#vereda").html(data[0].vereda);
                      $("#nom_proy").html(data[0].nom_proy);
                      $("#mod_foca").html(data[0].mod_foca);
                      $("#enti_lider").html(data[0].enti_lider);
                      $("#linea_proy").html(data[0].linea_proy);
                      $("#alcance").html(data[0].alcance);
                      $("#pob_bene").html(data[0].pob_bene);
                      $("#est_proy").html(data[0].est_proy);
                      $("#fecha_inicio").html(date_1[0]);
                      $("#fecha_fin").html(date_2[0]);
                      $("#avance_pres").html(val_format_1);
                      $("#avance_prod").html(avance);
                      $("#costo_estim").html(val_format_2);
                      $("#costo_ejec").html(val_format_3);
                  },
                  error:function(){alert('error');}
              });//fin de la consulta ajax (Editar proceso)
          }
      });//Termina tbody
    </script>    
@stop

@endif<!--Cierra el if de mostrar el contenido de la página si esta autenticado-->