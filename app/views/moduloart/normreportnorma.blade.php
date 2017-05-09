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
  {{HTML::style('assets/css/odometer-theme-train-station.css')}}
@stop
<!--agrega JavaScript dentro del header a la pagina-->
@section('js')     
  @parent
  {{HTML::script('assets/js/odometer.js')}}
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
        <br>          
        <!--aca se escribe el codigo-->
        <h2 class="text-center text-primary">Reportes Normatividad</h2>
        <div id="odometer" class="odometer text-center" style="font-size: 35px; width: 100%">0</div>
        <div class="col-xs-12">
          <h3>Distribución por tipo de Ley</h3>
          <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>
              <tr class="well text-primary">
                <th style="text-align: center;">Tipo</th>
                <th style="text-align: center;">Registros</th>
              </tr>
            </thead>
            <tbody>
              @foreach($reporte_tipo as $pro)
              <tr>
                <td>{{$pro->nombre}}</td>
                <td style="text-align: center;">{{$pro->suma}}</td>
              </tr>
              @endforeach
            </tbody>  
          </table>
          <h3>Reporte por corte</h3>
          <select id="fecha_corte" name="pto_acu" class="form-control" required placeholder="Seleccione un punto del acuerdo" onchange="reporte_corte()">
            <option selected disabled>Seleccione fecha de corte</option>
            @foreach($array as $pro)
            <option>{{$pro->fecha_corte}}</option>
            @endforeach
          </select>
          <br>
          <div class="col-xs-12">
            <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%" >
              <thead>
                <tr class="well text-primary">
                  <th style="text-align: center;"></th>
                  <th style="text-align: center;">Tipo</th>
                  <th id="fecha_corte_tittle" style="text-align: center;">Registros Corte ({{$ultimo_corte[0]->fecha_corte}})</th>
                  <th style="text-align: center;">Registros Hoy</th>
                  <th style="text-align: center;">Cambio</th>  
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td style="text-align: center;"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span></td>
                  <td>Construcción</td>
                  <td id="encons1" style="text-align: center;">{{str_replace('"','',(json_encode($consulta2[0]->encons)))}}</td>
                  <td id="encons2" style="text-align: center;">{{str_replace('"','',(json_encode($consulta[0]->encons)))}}</td>
                  <td id="encons3" style="text-align: center;"></td>
                </tr>
                <tr>
                  <td style="text-align: center;"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span></td>
                  <td>Producción Jurídica</td>
                  <td id="prodjud1" style="text-align: center;">{{str_replace('"','',(json_encode($consulta2[0]->prodjud)))}}</td>
                  <td id="prodjud2" style="text-align: center;">{{str_replace('"','',(json_encode($consulta[0]->prodjud)))}}</td>
                  <td id="prodjud3" style="text-align: center;">Subió</td>
                </tr>
                <tr>
                  <td style="text-align: center;"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></td>
                  <td>Ajustes</td>
                  <td id="ajust1" style="text-align: center;">{{str_replace('"','',(json_encode($consulta2[0]->ajust)))}}</td>
                  <td id="ajust2" style="text-align: center;">{{str_replace('"','',(json_encode($consulta[0]->ajust)))}}</td>
                  <td id="ajust3" style="text-align: center;">Subió</td>
                </tr>
                <tr>
                  <td style="text-align: center;"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></td>
                  <td>Revisión</td>
                  <td id="revis1" style="text-align: center;">{{str_replace('"','',(json_encode($consulta2[0]->revis)))}}</td>
                  <td id="revis2" style="text-align: center;">{{str_replace('"','',(json_encode($consulta[0]->revis)))}}</td>
                  <td id="revis3" style="text-align: center;">Subió</td>
                </tr>
                <tr>
                  <td style="text-align: center;"><span class="glyphicon glyphicon-repeat" aria-hidden="true"></span></td>
                  <td>Por definir expedición</td>
                  <td id="exped1" style="text-align: center;">{{str_replace('"','',(json_encode($consulta2[0]->exped)))}}</td>
                  <td id="exped2" style="text-align: center;">{{str_replace('"','',(json_encode($consulta[0]->exped)))}}</td>
                  <td id="exped3" style="text-align: center;">Subió</td>
                </tr>
                <tr>
                  <td style="text-align: center;"><span class="glyphicon glyphicon-hand-up" aria-hidden="true"></span></td>
                  <td>CSIVI</td>
                  <td id="csivi1" style="text-align: center;">{{str_replace('"','',(json_encode($consulta2[0]->csivi)))}}</td>
                  <td id="csivi2" style="text-align: center;">{{str_replace('"','',(json_encode($consulta[0]->csivi)))}}</td>
                  <td id="csivi3" style="text-align: center;">Subió</td>
                </tr>
                <tr>
                  <td style="text-align: center;"><span class="glyphicon glyphicon-usd" aria-hidden="true"></span></td>
                  <td>Hacienda</td>
                  <td id="haciend1" style="text-align: center;">{{str_replace('"','',(json_encode($consulta2[0]->haciend)))}}</td>
                  <td id="haciend2" style="text-align: center;">{{str_replace('"','',(json_encode($consulta[0]->haciend)))}}</td>
                  <td id="haciend3" style="text-align: center;">Subió</td>
                </tr>
                <tr>
                  <td style="text-align: center;"><span class="glyphicon glyphicon-bullhorn" aria-hidden="true"></span></td>
                  <td>Socialización</td>
                  <td id="sociali1" style="text-align: center;">{{str_replace('"','',(json_encode($consulta2[0]->sociali)))}}</td>
                  <td id="sociali2" style="text-align: center;">{{str_replace('"','',(json_encode($consulta[0]->sociali)))}}</td>
                  <td id="sociali3" style="text-align: center;">Subió</td>
                </tr>
                <tr>
                  <td style="text-align: center;"><span class="glyphicon glyphicon-retweet" aria-hidden="true"></span></td>
                  <td>Consulta Previa</td>
                  <td id="consprev1" style="text-align: center;">{{str_replace('"','',(json_encode($consulta2[0]->consprev)))}}</td>
                  <td id="consprev2" style="text-align: center;">{{str_replace('"','',(json_encode($consulta[0]->consprev)))}}</td>
                  <td id="consprev3" style="text-align: center;">Subió</td>
                </tr>
                <tr>
                  <td style="text-align: center;"><span class="glyphicon glyphicon-check" aria-hidden="true"></span></td>
                  <td>Expedido</td>
                  <td id="expedi1" style="text-align: center;">{{str_replace('"','',(json_encode($consulta2[0]->expedi)))}}</td>
                  <td id="expedi2" style="text-align: center;">{{str_replace('"','',(json_encode($consulta[0]->expedi)))}}</td>
                  <td id="expedi3" style="text-align: center;">Subió</td>
                </tr>
                <tr>
                  <td style="text-align: center;"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></td>
                  <td>Congreso/Firma</td>
                  <td id="congrefir1" style="text-align: center;">{{str_replace('"','',(json_encode($consulta2[0]->congrefir)))}}</td>
                  <td id="congrefir2" style="text-align: center;">{{str_replace('"','',(json_encode($consulta[0]->congrefir)))}}</td>
                  <td id="congrefir3" style="text-align: center;">Subió</td>
                </tr>
                <tr>
                  <td style="text-align: center;"><span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span></td>
                  <td>Sanción Presidencial</td>
                  <td id="tab_sancpres1" style="text-align: center;">{{str_replace('"','',(json_encode($consulta2[0]->tab_sancpres)))}}</td>
                  <td id="tab_sancpres2" style="text-align: center;">{{str_replace('"','',(json_encode($consulta[0]->tab_sancpres)))}}</td>
                  <td id="tab_sancpres3" style="text-align: center;">Subió</td>
                </tr>
              </tbody>
            </table>

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
          setTimeout(function(){
            var val=
            odometer.innerHTML = {{$num_registros[0]->suma}};
          }, 1000);          
          //para que los menus pequeño y grande funcione
          $( "#art" ).addClass("active");
          $( "#artdashboardmenu" ).addClass("active");
          $( "#iniciomenupeq" ).html("<small> INICIO</small>");
          $( "#artmenupeq" ).html("<strong>ART<span class='caret'></span></strong>");
          $( "#artdashboardmenupeq" ).html("<strong><span class='glyphicon glyphicon-ok'></span>Dashboard</strong>");
          $( "#mensajeestatus" ).fadeOut(5000);

          var encons=$("#encons2").html()-$("#encons1").html();
          if(encons>0){
            $("#encons3").html('<span style="color: green" class="glyphicon glyphicon-triangle-top" aria-hidden="true"></span>')
          } else if(encons==0){
            $("#encons3").html('<span style="color: orange" class="glyphicon glyphicon-menu-hamburger" aria-hidden="true"></span>')
          } else {
            $("#encons3").html('<span style="color: red" class="glyphicon glyphicon-triangle-bottom" aria-hidden="true"></span>')
          }
          var prodjud=$("#prodjud2").html()-$("#prodjud1").html();
          if(prodjud>0){
            $("#prodjud3").html('<span style="color: green" class="glyphicon glyphicon-triangle-top" aria-hidden="true"></span>')
          } else if(prodjud==0){
            $("#prodjud3").html('<span style="color: orange" class="glyphicon glyphicon-menu-hamburger" aria-hidden="true"></span>')
          } else {
            $("#prodjud3").html('<span style="color: red" class="glyphicon glyphicon-triangle-bottom" aria-hidden="true"></span>')
          }

          var ajust=$("#ajust2").html()-$("#ajust1").html();
          if(ajust>0){
            $("#ajust3").html('<span style="color: green" class="glyphicon glyphicon-triangle-top" aria-hidden="true"></span>')
          } else if(ajust==0){
            $("#ajust3").html('<span style="color: orange" class="glyphicon glyphicon-menu-hamburger" aria-hidden="true"></span>')
          } else {
            $("#ajust3").html('<span style="color: red" class="glyphicon glyphicon-triangle-bottom" aria-hidden="true"></span>')
          }

          var revis=$("#revis2").html()-$("#revis1").html();
          if(revis>0){
            $("#revis3").html('<span style="color: green" class="glyphicon glyphicon-triangle-top" aria-hidden="true"></span>')
          } else if(revis==0){
            $("#revis3").html('<span style="color: orange" class="glyphicon glyphicon-menu-hamburger" aria-hidden="true"></span>')
          } else {
            $("#revis3").html('<span style="color: red" class="glyphicon glyphicon-triangle-bottom" aria-hidden="true"></span>')
          }

          var exped=$("#exped2").html()-$("#exped1").html();
          if(exped>0){
            $("#exped3").html('<span style="color: green" class="glyphicon glyphicon-triangle-top" aria-hidden="true"></span>')
          } else if(exped==0){
            $("#exped3").html('<span style="color: orange" class="glyphicon glyphicon-menu-hamburger" aria-hidden="true"></span>')
          } else {
            $("#exped3").html('<span style="color: red" class="glyphicon glyphicon-triangle-bottom" aria-hidden="true"></span>')
          }

          var csivi=$("#csivi2").html()-$("#csivi1").html();
          if(csivi>0){
            $("#csivi3").html('<span style="color: green" class="glyphicon glyphicon-triangle-top" aria-hidden="true"></span>')
          } else if(exped==0){
            $("#csivi3").html('<span style="color: orange" class="glyphicon glyphicon-menu-hamburger" aria-hidden="true"></span>')
          } else {
            $("#csivi3").html('<span style="color: red" class="glyphicon glyphicon-triangle-bottom" aria-hidden="true"></span>')
          }

          var haciend=$("#haciend2").html()-$("#haciend1").html();
          if(haciend>0){
            $("#haciend3").html('<span style="color: green" class="glyphicon glyphicon-triangle-top" aria-hidden="true"></span>')
          } else if(haciend==0){
            $("#haciend3").html('<span style="color: orange" class="glyphicon glyphicon-menu-hamburger" aria-hidden="true"></span>')
          } else {
            $("#haciend3").html('<span style="color: red" class="glyphicon glyphicon-triangle-bottom" aria-hidden="true"></span>')
          }

          var sociali=$("#sociali2").html()-$("#sociali1").html();
          if(sociali>0){
            $("#sociali3").html('<span style="color: green" class="glyphicon glyphicon-triangle-top" aria-hidden="true"></span>')
          } else if(sociali==0){
            $("#sociali3").html('<span style="color: orange" class="glyphicon glyphicon-menu-hamburger" aria-hidden="true"></span>')
          } else {
            $("#sociali3").html('<span style="color: red" class="glyphicon glyphicon-triangle-bottom" aria-hidden="true"></span>')
          }

          var consprev=$("#consprev2").html()-$("#consprev1").html();
          if(consprev>0){
            $("#consprev3").html('<span style="color: green" class="glyphicon glyphicon-triangle-top" aria-hidden="true"></span>')
          } else if(consprev==0){
            $("#consprev3").html('<span style="color: orange" class="glyphicon glyphicon-menu-hamburger" aria-hidden="true"></span>')
          } else {
            $("#consprev3").html('<span style="color: red" class="glyphicon glyphicon-triangle-bottom" aria-hidden="true"></span>')
          }

          var expedi=$("#expedi2").html()-$("#expedi1").html();
          if(expedi>0){
            $("#expedi3").html('<span style="color: green" class="glyphicon glyphicon-triangle-top" aria-hidden="true"></span>')
          } else if(expedi==0){
            $("#expedi3").html('<span style="color: orange" class="glyphicon glyphicon-menu-hamburger" aria-hidden="true"></span>')
          } else {
            $("#expedi3").html('<span style="color: red" class="glyphicon glyphicon-triangle-bottom" aria-hidden="true"></span>')
          }

          var expedi=$("#expedi2").html()-$("#expedi1").html();
          if(expedi>0){
            $("#expedi3").html('<span style="color: green" class="glyphicon glyphicon-triangle-top" aria-hidden="true"></span>')
          } else if(expedi==0){
            $("#expedi3").html('<span style="color: orange" class="glyphicon glyphicon-menu-hamburger" aria-hidden="true"></span>')
          } else {
            $("#expedi3").html('<span style="color: red" class="glyphicon glyphicon-triangle-bottom" aria-hidden="true"></span>')
          }

          var congrefir=$("#congrefir2").html()-$("#congrefir1").html();
          if(congrefir>0){
            $("#congrefir3").html('<span style="color: green" class="glyphicon glyphicon-triangle-top" aria-hidden="true"></span>')
          } else if(congrefir==0){
            $("#congrefir3").html('<span style="color: orange" class="glyphicon glyphicon-menu-hamburger" aria-hidden="true"></span>')
          } else {
            $("#congrefir3").html('<span style="color: red" class="glyphicon glyphicon-triangle-bottom" aria-hidden="true"></span>')
          }

          var tab_sancpres=$("#tab_sancpres2").html()-$("#tab_sancpres1").html();
          if(tab_sancpres>0){
            $("#tab_sancpres3").html('<span style="color: green" class="glyphicon glyphicon-triangle-top" aria-hidden="true"></span>')
          } else if(tab_sancpres==0){
            $("#tab_sancpres3").html('<span style="color: orange" class="glyphicon glyphicon-menu-hamburger" aria-hidden="true"></span>')
          } else {
            $("#tab_sancpres3").html('<span style="color: red" class="glyphicon glyphicon-triangle-bottom" aria-hidden="true"></span>')
          }
      });

      function reporte_corte(){
        var fecha= $('#fecha_corte').val();
        $.ajax({
                url:"artnormatividad/reporte-corte",
                type:"POST",
                data:{fecha: fecha},
                dataType:'json',
                success:function(data){
                    $("#fecha_corte_tittle").html("Reporte Corte ("+data.ultimo_corte+")");
                    $("#encons1").html(data.consulta2[0].encons);
                    $("#prodjud1").html(data.consulta2[0].prodjud);
                    $("#ajust1").html(data.consulta2[0].ajust);
                    $("#revis1").html(data.consulta2[0].revis);
                    $("#exped1").html(data.consulta2[0].exped);
                    $("#csivi1").html(data.consulta2[0].csivi);
                    $("#haciend1").html(data.consulta2[0].haciend);
                    $("#sociali1").html(data.consulta2[0].sociali);
                    $("#consprev1").html(data.consulta2[0].consprev);
                    $("#expedi1").html(data.consulta2[0].expedi);
                    $("#congrefir").html(data.consulta2[0].congrefir);
                    $("#tab_sancpres1").html(data.consulta2[0].tab_sancpres);
                    
                    var encons=$("#encons2").html()-$("#encons1").html();
                    if(encons>0){
                      $("#encons3").html('<span style="color: green" class="glyphicon glyphicon-triangle-top" aria-hidden="true"></span>')
                    } else if(encons==0){
                      $("#encons3").html('<span style="color: orange" class="glyphicon glyphicon-menu-hamburger" aria-hidden="true"></span>')
                    } else {
                      $("#encons3").html('<span style="color: red" class="glyphicon glyphicon-triangle-bottom" aria-hidden="true"></span>')
                    }
                    var prodjud=$("#prodjud2").html()-$("#prodjud1").html();
                    if(prodjud>0){
                      $("#prodjud3").html('<span style="color: green" class="glyphicon glyphicon-triangle-top" aria-hidden="true"></span>')
                    } else if(prodjud==0){
                      $("#prodjud3").html('<span style="color: orange" class="glyphicon glyphicon-menu-hamburger" aria-hidden="true"></span>')
                    } else {
                      $("#prodjud3").html('<span style="color: red" class="glyphicon glyphicon-triangle-bottom" aria-hidden="true"></span>')
                    }

                    var ajust=$("#ajust2").html()-$("#ajust1").html();
                    if(ajust>0){
                      $("#ajust3").html('<span style="color: green" class="glyphicon glyphicon-triangle-top" aria-hidden="true"></span>')
                    } else if(ajust==0){
                      $("#ajust3").html('<span style="color: orange" class="glyphicon glyphicon-menu-hamburger" aria-hidden="true"></span>')
                    } else {
                      $("#ajust3").html('<span style="color: red" class="glyphicon glyphicon-triangle-bottom" aria-hidden="true"></span>')
                    }

                    var revis=$("#revis2").html()-$("#revis1").html();
                    if(revis>0){
                      $("#revis3").html('<span style="color: green" class="glyphicon glyphicon-triangle-top" aria-hidden="true"></span>')
                    } else if(revis==0){
                      $("#revis3").html('<span style="color: orange" class="glyphicon glyphicon-menu-hamburger" aria-hidden="true"></span>')
                    } else {
                      $("#revis3").html('<span style="color: red" class="glyphicon glyphicon-triangle-bottom" aria-hidden="true"></span>')
                    }

                    var exped=$("#exped2").html()-$("#exped1").html();
                    if(exped>0){
                      $("#exped3").html('<span style="color: green" class="glyphicon glyphicon-triangle-top" aria-hidden="true"></span>')
                    } else if(exped==0){
                      $("#exped3").html('<span style="color: orange" class="glyphicon glyphicon-menu-hamburger" aria-hidden="true"></span>')
                    } else {
                      $("#exped3").html('<span style="color: red" class="glyphicon glyphicon-triangle-bottom" aria-hidden="true"></span>')
                    }

                    var csivi=$("#csivi2").html()-$("#csivi1").html();
                    if(csivi>0){
                      $("#csivi3").html('<span style="color: green" class="glyphicon glyphicon-triangle-top" aria-hidden="true"></span>')
                    } else if(exped==0){
                      $("#csivi3").html('<span style="color: orange" class="glyphicon glyphicon-menu-hamburger" aria-hidden="true"></span>')
                    } else {
                      $("#csivi3").html('<span style="color: red" class="glyphicon glyphicon-triangle-bottom" aria-hidden="true"></span>')
                    }

                    var haciend=$("#haciend2").html()-$("#haciend1").html();
                    if(haciend>0){
                      $("#haciend3").html('<span style="color: green" class="glyphicon glyphicon-triangle-top" aria-hidden="true"></span>')
                    } else if(haciend==0){
                      $("#haciend3").html('<span style="color: orange" class="glyphicon glyphicon-menu-hamburger" aria-hidden="true"></span>')
                    } else {
                      $("#haciend3").html('<span style="color: red" class="glyphicon glyphicon-triangle-bottom" aria-hidden="true"></span>')
                    }

                    var sociali=$("#sociali2").html()-$("#sociali1").html();
                    if(sociali>0){
                      $("#sociali3").html('<span style="color: green" class="glyphicon glyphicon-triangle-top" aria-hidden="true"></span>')
                    } else if(sociali==0){
                      $("#sociali3").html('<span style="color: orange" class="glyphicon glyphicon-menu-hamburger" aria-hidden="true"></span>')
                    } else {
                      $("#sociali3").html('<span style="color: red" class="glyphicon glyphicon-triangle-bottom" aria-hidden="true"></span>')
                    }

                    var consprev=$("#consprev2").html()-$("#consprev1").html();
                    if(consprev>0){
                      $("#consprev3").html('<span style="color: green" class="glyphicon glyphicon-triangle-top" aria-hidden="true"></span>')
                    } else if(consprev==0){
                      $("#consprev3").html('<span style="color: orange" class="glyphicon glyphicon-menu-hamburger" aria-hidden="true"></span>')
                    } else {
                      $("#consprev3").html('<span style="color: red" class="glyphicon glyphicon-triangle-bottom" aria-hidden="true"></span>')
                    }

                    var expedi=$("#expedi2").html()-$("#expedi1").html();
                    if(expedi>0){
                      $("#expedi3").html('<span style="color: green" class="glyphicon glyphicon-triangle-top" aria-hidden="true"></span>')
                    } else if(expedi==0){
                      $("#expedi3").html('<span style="color: orange" class="glyphicon glyphicon-menu-hamburger" aria-hidden="true"></span>')
                    } else {
                      $("#expedi3").html('<span style="color: red" class="glyphicon glyphicon-triangle-bottom" aria-hidden="true"></span>')
                    }

                    var expedi=$("#expedi2").html()-$("#expedi1").html();
                    if(expedi>0){
                      $("#expedi3").html('<span style="color: green" class="glyphicon glyphicon-triangle-top" aria-hidden="true"></span>')
                    } else if(expedi==0){
                      $("#expedi3").html('<span style="color: orange" class="glyphicon glyphicon-menu-hamburger" aria-hidden="true"></span>')
                    } else {
                      $("#expedi3").html('<span style="color: red" class="glyphicon glyphicon-triangle-bottom" aria-hidden="true"></span>')
                    }

                    var congrefir=$("#congrefir2").html()-$("#congrefir1").html();
                    if(congrefir>0){
                      $("#congrefir3").html('<span style="color: green" class="glyphicon glyphicon-triangle-top" aria-hidden="true"></span>')
                    } else if(congrefir==0){
                      $("#congrefir3").html('<span style="color: orange" class="glyphicon glyphicon-menu-hamburger" aria-hidden="true"></span>')
                    } else {
                      $("#congrefir3").html('<span style="color: red" class="glyphicon glyphicon-triangle-bottom" aria-hidden="true"></span>')
                    }

                    var tab_sancpres=$("#tab_sancpres2").html()-$("#tab_sancpres1").html();
                    if(tab_sancpres>0){
                      $("#tab_sancpres3").html('<span style="color: green" class="glyphicon glyphicon-triangle-top" aria-hidden="true"></span>')
                    } else if(tab_sancpres==0){
                      $("#tab_sancpres3").html('<span style="color: orange" class="glyphicon glyphicon-menu-hamburger" aria-hidden="true"></span>')
                    } else {
                      $("#tab_sancpres3").html('<span style="color: red" class="glyphicon glyphicon-triangle-bottom" aria-hidden="true"></span>')
                    }
                },
                error:function(){alert('error');}
            });//fin de la consulta ajax (Editar proceso)
      }
    </script>    
@stop

@endif<!--Cierra el if de mostrar el contenido de la página si esta autenticado-->