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
        <div class="row">
          <div class="col-sm-1"></div>
          <div class="col-sm-10">
              <h2 class="text-center text-primary">Consulta Dirección para la Atención Integral de la Lucha Contra las Drogas</h2>
              <br>
              <p class="lead text-justify">A continuación se presenta el resumen de la implementación de acuerdos para la sustitución de cultivos ilícitos.</p>  
          </div>  
          <div class="col-sm-1"></div>
        </div>
        <div class="row">
          <div class="col-sm-1"></div>
          <div class="col-sm-8">
            <button id="consultar" disabled="disabled" type="button" class="btn btn-primary" data-toggle="modal" data-target="#consultar_acuerdo">Consultar acuerdo</button>
          </div>
          <div class="col-sm-2"></div>
        </div>
        <div class="row">
          <div class="col-sm-1"></div>
          <div class="col-sm-10">
            <h2 class="text-center text-primary">Acuerdos</h2>
            <table id="tabla_daild" class="table table-striped table-bordered nowrap">
              <thead>
                <tr class="text-primary" data-toggle="tooltip" data-placement="top" >              
                  <th class="text-center">ID</th>
                  <th class="text-center">Fecha firma</th>
                  <th class="text-center">Departamento</th>
                  <th class="text-center">Municipio</th>
                  <th class="text-center">No. Territorios</th>
                  <th class="text-center">No. Familias</th>
                  <th class="text-center">No. Hectáreas</th>                        
                </tr>
              </thead>
              <tbody>
                @foreach($arraydaild as $pro) 
                  <tr id="{{$pro->id_acuerdo}}"> 
                    <td >{{$pro->id_acuerdo}} </td> 
                    <td >{{$pro->fecha}}</td>
                    <td >{{$pro->depto}}</td> 
                    <td >{{$pro->mpio}}</td> 
                    <td id="terr"> {{$pro->terr}}</td> 
                    <td id="fami">{{$pro->familias}}</td>
                    <td id="ha">{{$pro->has}}</td>
                  </tr> 
                @endforeach 
              </tbody>
            </table>  
          </div>        
          <div class="col-sm-1"></div> 
        </div>

        <!-- Modal -->
        <div class="modal fade" id="consultar_acuerdo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="titulo_modal"></h4>
              </div>
              <div class="modal-body" id="body_modal" >
               <div id="body_modal1" ></div> 
               <div id="body_modal2"  class="col-sm-7" style="padding: 0;"></div> 
               <div id="body_modal3"  class="col-sm-5"></div> 
              <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%" id="table_consulta">
                <thead>
                <tr class="well text-primary" data-toggle="tooltip" data-placement="top" >
                  <th class="text-center">Núcleo</th>    
                  <th class="text-center">Vereda</th>    
                  <th class="text-center">No. Familias</th>
                  <th class="text-center">No. Hectáreas</th>   
                </tr>
                </thead>
                <tbody id="body_table_consulta">
                </tbody> 
              </table>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>                
              </div>
              
            </div>
          </div>
        </div>
        


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

          table=$('#tabla_daild').DataTable({
            "scrollX": true,
          });    

      });     

      $('#tabla_daild tbody').on('click', 'tr', function () {
        if ( $(this).hasClass('active') ) {
            $(this).removeClass('active');
            $("#consultar").prop('disabled', true);
        } else {
            table.$('tr.active').removeClass('active');
            $(this).addClass('active');
            var id=$(this);
            $("#consultar").prop('disabled', false);
            var id=$(this);
            var num=id[0].id;
            var descri=("<b>"+$(this).find('td')[4].innerHTML+ "</b> territorios, <b>"+$(this).find('td')[5].innerHTML+"</b> familias y <b>"+$(this).find('td')[6].innerHTML+"</b> hectáreas de cultivos de coca. <br><br>");
            $.ajax({
                  url:"artdaild/daild-consulta",
                  type:"POST",
                  data:{acuerdo: num},
                  dataType:'json',
                  success:function(data){
                      $('#titulo_modal').html("Datos detallados para el Acuerdo No."+data['arraydaildconsul'][0]['id_acuerdo']);
                      $('#body_modal1').html("Acuerdo en el municipio de <b>"+data['arraydaildconsul'][0]['mpio']+" ("+data['arraydaildconsul'][0]['depto']+")</b>. <br><br> Cuenta con un total de "+descri);
                      $('#body_modal2').html("El documento de verificación para este acuerdo es:");
                      var acuerdo=existeUrl('daild/acuerdos/'+num+'.pdf');
                      $('#body_modal3').empty();
                      if(acuerdo){
                        $('#body_modal3').append("<a target='_blank' href='daild/acuerdos/"+num+".pdf' class='glyphicon glyphicon-download-alt btn btn-success' role='button'></a> <br><br>");
                      }else{
                         $('#body_modal3').append("<a disabled='true' class='glyphicon glyphicon-download-alt btn btn-default ' role='button'></a> <br><br>");
                      }

                      

                      $('#table_consulta').empty();

                        var thead = document.createElement("thead");

                        var y = document.createElement("TR");
                        y.className="well text-primary";
                        y.setAttribute("data-toggle","tooltip");
                        y.setAttribute("data-placement","top");
                        thead.appendChild(y);

                        var th = document.createElement("TH");
                        var t = document.createTextNode("Núcleo");
                        th.appendChild(t);
                        y.appendChild(th);
                        thead.appendChild(y);
                      
                        var th = document.createElement("TH");
                        var t = document.createTextNode("Vereda");
                        th.appendChild(t);
                        y.appendChild(th);
                        thead.appendChild(y);

                        var th = document.createElement("TH");
                        var t = document.createTextNode("No. Familias");
                        th.appendChild(t);
                        y.appendChild(th);
                        thead.appendChild(y);

                        var th = document.createElement("TH");
                        var t = document.createTextNode("No. Hectáreas");
                        th.appendChild(t);
                        y.appendChild(th);
                        thead.appendChild(y);
                        document.getElementById('table_consulta').appendChild(thead);

                        var tbody = document.createElement("tbody");
                        tbody.setAttribute("id", "body_table_consulta");
                        document.getElementById('table_consulta').appendChild(tbody);

                      for(var i = 0; i < data['arraydaildconsul'].length; i++){
                        var y = document.createElement("TR");
                        y.setAttribute("id", "ID"+i);
                        document.getElementById("body_table_consulta").appendChild(y);

                        var z = document.createElement("TD");
                        var t = document.createTextNode(data['arraydaildconsul'][i]['nucleoterritorial']);
                        z.appendChild(t);
                        document.getElementById("ID"+i).appendChild(z);

                        var z = document.createElement("TD");
                        var t = document.createTextNode(data['arraydaildconsul'][i]['veredadaild']);
                        z.appendChild(t);
                        document.getElementById("ID"+i).appendChild(z);

                        var z = document.createElement("TD");
                        var t = document.createTextNode(data['arraydaildconsul'][i]['familias']);
                        z.appendChild(t);
                        document.getElementById("ID"+i).appendChild(z);

                        var z = document.createElement("TD");
                        var t = document.createTextNode(data['arraydaildconsul'][i]['hectareas']);
                        z.appendChild(t);
                        document.getElementById("ID"+i).appendChild(z);
                      }

                      if ( $.fn.dataTable.isDataTable( '#table_consulta' ) ) {
                        table2.destroy();
                        table2 = $('#table_consulta').DataTable( {
                          } );
                      }else {
                        table2 = $('#table_consulta').DataTable( {
                        });
                      }
                        

                          
                        //$('#consultar_acuerdo .modal-body').html(table)


                  },
                  error:function(){alert('error');}
              });//fin de la consulta ajax (Editar proceso)
        }
    });//Termina tbody 

    function existeUrl(url) {
       var http = new XMLHttpRequest();
       http.open('HEAD', url, false);
       http.send();
       return http.status!=404;
    }

  $('#consultar_acuerdo').on('hidden.bs.modal', function (e) {//funcion que resetea el modal
    table.$('tr.active').removeClass('active');
    $(this).removeData();
    $("#consultar").prop('disabled', true);
})
    </script>    
@stop

@endif<!--Cierra el if de mostrar el contenido de la página si esta autenticado-->