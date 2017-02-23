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
        <h2 class="text-center text-primary">Normatividad</h2>
        <br>
        <p class="lead text-justify">A continuación se presenta el avance de las normas que se están desarrollando para la implementación del acuerdo.</p>        
        <button id="consultar" disabled="disabled" type="button" class="btn btn-primary" data-toggle="modal" data-target="#consultar_norma">Consultar norma</button>
        <h2 class="text-center text-primary">Etapa I - Construcción</h2>
        <table id="tabla_normas_1" class="table table-striped table-bordered dt-responsive nowrap">
          <thead>
            <tr class="well text-primary" data-toggle="tooltip" data-placement="top" >              
              <th class="text-center">Norma</th>
              <th class="text-center">Construcción</th>
              <th class="text-center">Producción jurídica</th>
              <th class="text-center">Ajustes</th>              
              <th class="text-center">Revisión</th>                            
            </tr>
          </thead>
          <tbody>
            @foreach($array as $pro)
                <tr id="{{$pro->id}}" valign="middle">
                  <td>{{$pro->norma}}</td>
                  @if($pro->tab_encons==1)<td align="center"><p style="display:none;">{{$pro->tab_encons}}</p><span class="glyphicon glyphicon-ok-sign" aria-hidden="true" style="color:green"></span></td>
                  @elseif($pro->tab_encons==2)<td align="center"><p style="display:none;">{{$pro->tab_encons}}</p><span class="glyphicon glyphicon-remove-sign" aria-hidden="true" style="color:red"></span></td>
                  @else <td align="center"><p style="display:none;">{{$pro->tab_encons}}</p><span class="glyphicon glyphicon-warning-sign" aria-hidden="true" style="color:orange"></span></td> 
                  @endif
                  @if($pro->tab_prodjud==1)<td align="center"><p style="display:none;">{{$pro->tab_prodjud}}</p><span class="glyphicon glyphicon-ok-sign" aria-hidden="true" style="color:green"></span></td>
                  @elseif($pro->tab_prodjud==2)<td align="center"><p style="display:none;">{{$pro->tab_prodjud}}</p><span class="glyphicon glyphicon-remove-sign" aria-hidden="true" style="color:red"></span></td>
                  @else <td align="center"><p style="display:none;">{{$pro->tab_prodjud}}</p><span class="glyphicon glyphicon-warning-sign" aria-hidden="true" style="color:orange"></span></td> 
                  @endif
                  @if($pro->tab_ajus==1)<td align="center"><p style="display:none;">{{$pro->tab_ajus}}</p><span class="glyphicon glyphicon-ok-sign" aria-hidden="true" style="color:green"></span></td>
                  @elseif($pro->tab_ajus==2)<td align="center"><p style="display:none;">{{$pro->tab_ajus}}</p><span class="glyphicon glyphicon-remove-sign" aria-hidden="true" style="color:red"></span></td>
                  @else <td align="center"><p style="display:none;">{{$pro->tab_ajus}}</p><span class="glyphicon glyphicon-warning-sign" aria-hidden="true" style="color:orange"></span></td> 
                  @endif
                  @if($pro->tab_ultrev==1)<td align="center"><p style="display:none;">{{$pro->tab_ultrev}}</p><span class="glyphicon glyphicon-ok-sign" aria-hidden="true" style="color:green"></span></td>
                  @elseif($pro->tab_ultrev==2)<td align="center"><p style="display:none;">{{$pro->tab_ultrev}}</p><span class="glyphicon glyphicon-remove-sign" aria-hidden="true" style="color:red"></span></td>
                  @else <td align="center"><p style="display:none;">{{$pro->tab_ultrev}}</p><span class="glyphicon glyphicon-warning-sign" aria-hidden="true" style="color:orange"></span></td> 
                  @endif
                                    
                </tr>                            
              @endforeach 
          </tbody>
        </table>
        <br>
        <h2 class="text-center text-primary">Etapa II - Aprobación</h2>
        <table id="tabla_normas_2" class="table table-striped table-bordered dt-responsive nowrap">
          <thead>
            <tr class="well text-primary" data-toggle="tooltip" data-placement="top" >              
              <th class="text-center">Norma</th>
              <th class="text-center">CSIVI</th>              
              <th class="text-center">Hacienda</th>
              <th class="text-center">Consulta previa</th>
              <th class="text-center">Expedido</th>
              <th class="text-center">Congreso/Firma</th>              
              <th class="text-center">Sanción Presidencial</th>
            </tr>
          </thead>
          <tbody>
            @foreach($array as $pro)
                <tr id="{{$pro->id}}" valign="middle">
                  <td>{{$pro->norma}}</td>
                  @if($pro->tab_csivi==1)<td align="center"><p style="display:none;">{{$pro->tab_csivi}}</p><span class="glyphicon glyphicon-ok-sign" aria-hidden="true" style="color:green"></span></td>
                  @elseif($pro->tab_csivi==2)<td align="center"><p style="display:none;">{{$pro->tab_csivi}}</p><span class="glyphicon glyphicon-remove-sign" aria-hidden="true" style="color:red"></span></td>
                  @else <td align="center"><p style="display:none;">{{$pro->tab_csivi}}</p><span class="glyphicon glyphicon-warning-sign" aria-hidden="true" style="color:orange"></span></td> 
                  @endif                   
                  @if($pro->tab_hacie==1)<td align="center"><p style="display:none;">{{$pro->tab_hacie}}</p><span class="glyphicon glyphicon-ok-sign" aria-hidden="true" style="color:green"></span></td>
                  @elseif($pro->tab_hacie==2)<td align="center"><p style="display:none;">{{$pro->tab_hacie}}</p><span class="glyphicon glyphicon-remove-sign" aria-hidden="true" style="color:red"></span></td>
                  @else <td align="center"><p style="display:none;">{{$pro->tab_hacie}}</p><span class="glyphicon glyphicon-warning-sign" aria-hidden="true" style="color:orange"></span></td> 
                  @endif
                  @if($pro->tab_inte==1)<td align="center"><p style="display:none;">{{$pro->tab_inte}}</p><span class="glyphicon glyphicon-ok-sign" aria-hidden="true" style="color:green"></span></td>
                  @elseif($pro->tab_inte==2)<td align="center"><p style="display:none;">{{$pro->tab_inte}}</p><span class="glyphicon glyphicon-remove-sign" aria-hidden="true" style="color:red"></span></td>
                  @else <td align="center"><p style="display:none;">{{$pro->tab_inte}}</p><span class="glyphicon glyphicon-warning-sign" aria-hidden="true" style="color:orange"></span></td> 
                  @endif
                  @if($pro->tab_expe==1)<td align="center"><p style="display:none;">{{$pro->tab_expe}}</p><span class="glyphicon glyphicon-ok-sign" aria-hidden="true" style="color:green"></span></td>
                  @elseif($pro->tab_expe==2)<td align="center"><p style="display:none;">{{$pro->tab_expe}}</p><span class="glyphicon glyphicon-remove-sign" aria-hidden="true" style="color:red"></span></td>
                  @else <td align="center"><p style="display:none;">{{$pro->tab_expe}}</p><span class="glyphicon glyphicon-warning-sign" aria-hidden="true" style="color:orange"></span></td> 
                  @endif                  
                  @if($pro->tab_congre==1)<td align="center"><p style="display:none;">{{$pro->tab_congre}}</p><span class="glyphicon glyphicon-ok-sign" aria-hidden="true" style="color:green"></span></td>
                  @elseif($pro->tab_firma==1)<td align="center"><p style="display:none;">{{$pro->tab_firma}}</p><span class="glyphicon glyphicon-ok-sign" aria-hidden="true" style="color:green"></span></td>
                  @elseif($pro->tab_congre==2)<td align="center"><p style="display:none;">{{$pro->tab_congre}}</p><span class="glyphicon glyphicon-remove-sign" aria-hidden="true" style="color:red"></span></td>
                  @else<td align="center"><p style="display:none;">{{$pro->tab_firma}}</p><span class="glyphicon glyphicon-remove-sign" aria-hidden="true" style="color:red"></span></td>
                  @endif
                  @if($pro->tab_sancpres==1)<td align="center"><p style="display:none;">{{$pro->tab_sancpres}}</p><span class="glyphicon glyphicon-ok-sign" aria-hidden="true" style="color:green"></span></td>
                  @elseif($pro->tab_sancpres==2)<td align="center"><p style="display:none;">{{$pro->tab_sancpres}}</p><span class="glyphicon glyphicon-remove-sign" aria-hidden="true" style="color:red"></span></td>
                  @else <td align="center"><p style="display:none;">{{$pro->tab_sancpres}}</p><span class="glyphicon glyphicon-warning-sign" aria-hidden="true" style="color:orange"></span></td> 
                  @endif  
                </tr>                            
              @endforeach 
          </tbody>
        </table>

         <!--Aca inicia el modal para cargar nuevo proyecto-->
        <!-- Modal -->
        <div class="modal fade" id="consultar_norma" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Tabla normatividad</h4>
              </div>
              <div class="modal-body">
              <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <thead>
                <tr class="well text-primary" data-toggle="tooltip" data-placement="top" >
                  <th class="text-center">Variable</th>    
                  <th class="text-center">Descripción</th>
                </tr>
                <tbody>
                  <tr>
                    <td>Nombre de la norma</td>
                    <td id="norma"></td>
                  </tr>
                  <tr>
                    <td>Punto del acuerdo</td>
                    <td id="punto"></td>
                  </tr>
                  <tr>
                    <td>Responsable</td>
                    <td id="responsable"></td>
                  </tr>
                  <tr>
                    <td>Tipo</td>
                    <td id="tipo"></td>
                  </tr>
                  <tr>
                    <td>Semáforo</td>
                    <td id="semaforo"></td>
                  </tr>
                  <tr>
                    <td>Fecha Gobierno</td>
                    <td id="fecha"></td>
                  </tr>
                  <tr>
                    <td>Consulta previa</td>
                    <td id="consultaprevia"></td>
                  </tr>
                  <tr>
                    <td>Observaciones</td>
                    <td id="obs"></td>
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
          $("#tabla_normas_1").dataTable();
          $("#tabla_normas_2").dataTable();               
      });

      var table = $('#tabla_normas_1').DataTable();
      var table2 = $('#tabla_normas_2').DataTable();
      $('#tabla_normas_1 tbody').on('click', 'tr', function () {
          if ( $(this).hasClass('active') ) {
              $(this).removeClass('active');
              $("#consultar").prop('disabled', true);
              table2.$('tr.active').removeClass('active');              
          } else {
              table.$('tr.active').removeClass('active');
              table2.$('tr.active').removeClass('active');
              $(this).addClass('active');
              var id=$(this);
              $("#consultar").prop('disabled', false);              
              //Consulta ajax para traer los atributos editables del proyecto              
              var id=$(this);
              var num=id[0].id;              
              $.ajax({
                  url:"artnormatividad/consultar",
                  type:"POST",
                  data:{norma: num},
                  dataType:'json',
                  success:function(data){                      
                      change_data(data);                      
                  },
                  error:function(){alert('error');}
              });//fin de la consulta ajax (Editar proceso)
          }
      });//Termina tbody
      $('#tabla_normas_2 tbody').on('click', 'tr', function () {
          if ( $(this).hasClass('active') ) {
              $(this).removeClass('active');
              $("#consultar").prop('disabled', true);
              table.$('tr.active').removeClass('active');              
          } else {
              table.$('tr.active').removeClass('active');
              table2.$('tr.active').removeClass('active');
              $(this).addClass('active');
              var id=$(this);
              $("#consultar").prop('disabled', false);              
              //Consulta ajax para traer los atributos editables del proyecto              
              var id=$(this);
              var num=id[0].id;              
              $.ajax({
                  url:"artnormatividad/consultar",
                  type:"POST",
                  data:{norma: num},
                  dataType:'json',
                  success:function(data){                      
                      change_data(data);                      
                  },
                  error:function(){alert('error');}
              });//fin de la consulta ajax (Editar proceso)
          }
      });//Termina tbody

      function change_data(data){
        //console.log(data)
        $("#norma").html(data[0].norma);
        $("#punto").html(data[0].pto_acu);
        $("#responsable").html(data[0].responsable);
        $("#tipo").html(data[0].tipo);
        if(data[0].id_semafo=="1"){
          var text='<div style="height: 20px; width: 20px; border-radius: 100%; background: #3ADF00"></div>'
          $("#semaforo").html(text);
        } else if(data[0].id_semafo=="2"){
          var text='<div style="height: 20px; width: 20px; border-radius: 100%; background: #F4FA58"></div>'
          $("#semaforo").html(text);
        } else if(data[0].id_semafo=="3"){
          var text='<div style="height: 20px; width: 20px; border-radius: 100%; background: #FE9A2E"></div>'
          $("#semaforo").html(text);
        } else if(data[0].id_semafo=="4"){
          var text='<div style="height: 20px; width: 20px; border-radius: 100%; background: #FE2E2E"></div>'
          $("#semaforo").html(text);
        } else {
          var text='<div style="height: 20px; width: 20px; border-radius: 100%; background: #A4A4A4"></div>'
          $("#semaforo").html(text);
        }
        //$("#semaforo").html(data[0].id_semafo);
        $("#fecha").html(data[0].fecha_gob);
        $("#consultaprevia").html(data[0].id_consprev);
        $("#obs").html(data[0].obs);
      }
    </script>    
@stop

@endif<!--Cierra el if de mostrar el contenido de la página si esta autenticado-->