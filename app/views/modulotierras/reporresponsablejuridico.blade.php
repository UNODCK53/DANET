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
      <div class="row">
        <br>
        <p class="lead text-center">DISTRIBUCIÓN DE PROCESOS ASIGNADOS POR RESPONSABLE JURÍDICO</p>
      </div>
      <div class="col-sm-1">
      </div>
      <div class="col-sm-10">
        <div class="col-sm-4">
          <label id="labeldpto" for="Proceso" class="control-label">Departamento:</label>
          <select id="seldpto" class="form-control" name="seldpto">
            <option value="" selected="selected">Por favor seleccione</option>
            @foreach($arraydpto as $pro)
                <option value="{{$pro->cod_dpto}}">{{$pro->nom_dpto}}</option>
            @endforeach
          </select>
        </div>
        <div class="col-sm-4">
          <label id="labelmpio" for="Proceso" class="control-label">Municipio:</label>
            <select id="selmpio" class="form-control" name="selmpio">
            </select>
        </div>
        <div class="col-sm-4">
          <label id="labelvda" for="Proceso" class="control-label">Vereda:</label>
            <select id="selvda" class="form-control" name="selvda">
            </select>
        </div>  
      </div>
      <div class="col-sm-1">
      </div>
      <div class="col-sm-12" style="height: 20px">
      </div>
      <h2 id="title_reporte" style="text-align: center;">Reporte Nacional</h2>
      <div id="container" ></div>
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
@section('js')
  @parent
<script src="assets/js/highcharts/highcharts.js"></script>
<script src="assets/js/highcharts/exporting.js"></script>
    <script>
    $(function () {
      $('#container').highcharts({
          chart: {
              type: 'pie',
              options3d: {
                  enabled: true,
                  alpha: 45,
                  beta: 0
              }
          },
          title: {
              text: ''
          },
          tooltip: {
              pointFormat: '{series.name}: <b>{point.y:.0f}</b>'
          },
          plotOptions: {
              pie: {
                  allowPointSelect: true,
                  cursor: 'pointer',
                  depth: 35,
                  dataLabels: {
                      enabled: true,
                      format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                      style:{textShadow:'',color:(Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'}
                  }
              }
          },
          series: [{
              name: "No. de Procesos",
              colorByPoint: true,
              data: [
              @foreach($arrayrj as $arraygra)
              {{'{name:'}}{{'"'.$arraygra->name." ".$arraygra->last_name.'"'}}{{',y:'}}{{$arraygra->y}}{{','}}{{'},'}}
              @endforeach
              ]
          }]
      });
    });
      $(document).ready(function() {
          //para que los menus pequeño y grande funcione
          $( "#tierras" ).addClass("active");
          $( "#tierrasreporresponsjuri" ).addClass("active");
          $( "#iniciomenupeq" ).html("<small> INICIO</small>");
          $( "#tierrasmenupeq" ).html("<strong>MÓDULO TIERRAS<span class='caret'></span></strong>");
          $( "#tierrasreporesjurimenupeq" ).html("<strong><span class='glyphicon glyphicon-ok'></span>Responsable Jurídico</strong>");
          $( "#mensajeestatus" ).fadeOut(5000);
          $("#labelmpio").hide();
          $("#selmpio").hide();
          $("#labelvda").hide();
          $("#selvda").hide();
          $("#labelvda").hide();
          $("#seldpto").change(function(){
            if((($('#seldpto').val()=='')&&($('#selmpio').val()!=''))||(($('#seldpto').val()=='')&&($('#selmpio').val()=='')))
              {
                location.reload();
              } else{
                $.ajax({url:"tierras/reporjuridicompio",type:"POST",data:{dpto:$('#seldpto').val()},dataType:'json',
                  success:function(data1){
                    $("#title_reporte").html(("Reporte - "+ $('#seldpto').find('option:selected').text()))
                    $("#labelmpio").show();
                    $("#selmpio").show();
                    $("#selmpio").empty();
                    $("#selvda").empty();
                    $("#selvda").hide();
                    $("#labelvda").hide();
                    $("#selmpio").append("<option value=''>Por favor seleccione</option>");
                    $.each(data1[0], function(nom,datos){
                      $("#selmpio").append("<option value=\""+datos.cod_mpio+"\">"+datos.nom_mpio+"</option>");
                    });
                    var arreglo=[]
                    for(var i = 0; i < data1[1].length; i++){
                      arreglo[i]=[(data1[1][i].name + " " + data1[1][i].last_name),Number(data1[1][i].y)]
                    }
                    console.log(data1)
                    $('#container').highcharts({
                        chart: {
                            type: 'pie',
                            options3d: {
                                enabled: true,
                                alpha: 45,
                                beta: 0
                            }
                        },
                        title: {
                            text: ''
                        },
                        tooltip: {
                            pointFormat: '{series.name}: <b>{point.y:.0f}</b>'
                        },
                        plotOptions: {
                            pie: {
                                allowPointSelect: true,
                                cursor: 'pointer',
                                depth: 35,
                                dataLabels: {
                                    enabled: true,
                                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                                    style:{textShadow:'',color:(Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'}
                                }
                            }
                        },
                        series: [{
                            name: "No. de Procesos",
                            colorByPoint: true,
                            data: arreglo
                        }]
                    });
                    
                  },
                  error:function(){alert('error');}
                });//Termina Ajax prueva
            }
          });
          $("#selmpio").change(function(){
            if($('#selmpio').val()==''){
              $.ajax({url:"tierras/reporjuridicompio",type:"POST",data:{dpto:$('#seldpto').val()},dataType:'json',
                success:function(data1){
                  $("#title_reporte").html(("Reporte - "+ $('#seldpto').find('option:selected').text()))
                  $("#labelmpio").show();
                  $("#selmpio").show();
                  $("#selmpio").empty();
                  $("#selvda").empty();
                  $("#selvda").hide();
                  $("#labelvda").hide();
                  $("#selmpio").append("<option value=''>Por favor seleccione</option>");
                  $.each(data1[0], function(nom,datos){
                    $("#selmpio").append("<option value=\""+datos.cod_mpio+"\">"+datos.nom_mpio+"</option>");
                  });
                  var arreglo=[]
                  for(var i = 0; i < data1[1].length; i++){
                    arreglo[i]=[(data1[1][i].name + " " + data1[1][i].last_name),Number(data1[1][i].y)]
                  }
                  $('#container').highcharts({
                      chart: {
                          type: 'pie',
                          options3d: {
                              enabled: true,
                              alpha: 45,
                              beta: 0
                          }
                      },
                      title: {
                          text: ''
                      },
                      tooltip: {
                          pointFormat: '{series.name}: <b>{point.y:.0f}</b>'
                      },
                      plotOptions: {
                          pie: {
                              allowPointSelect: true,
                              cursor: 'pointer',
                              depth: 35,
                              dataLabels: {
                                  enabled: true,
                                  format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                                  style:{textShadow:'',color:(Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'}
                              }
                          }
                      },
                      series: [{
                          name: "No. de Procesos",
                          colorByPoint: true,
                          data: arreglo
                      }]
                  });
                },
                error:function(){alert('error');}
              });//Termina Ajax prueba
            }
            else{        
              $.ajax({url:"tierras/reporjuridicovda",type:"POST",data:{mpio:$('#selmpio').val()},dataType:'json',
                success:function(data1){
                  $("#title_reporte").html(("Reporte - "+ $('#selmpio').find('option:selected').text()))
                  $("#labelvda").show();
                  $("#selvda").show();
                  $("#selvda").empty();
                  $("#selvda").append("<option value=''>Por favor seleccione</option>");
                  [].forEach.call(data1[0],function(datos){
                    $("#selvda").append("<option value=\""+datos.cod_unodc+"\">"+datos.nombre1+"</option>");
                  });
                  var arreglo=[]
                  for(var i = 0; i < data1[1].length; i++){
                    arreglo[i]=[(data1[1][i].name + " " + data1[1][i].last_name),Number(data1[1][i].y)]
                  }
                  $('#container').highcharts({
                      chart: {
                          type: 'pie',
                          options3d: {
                              enabled: true,
                              alpha: 45,
                              beta: 0
                          }
                      },
                      title: {
                          text: ''
                      },
                      tooltip: {
                          pointFormat: '{series.name}: <b>{point.y:.0f}</b>'
                      },
                      plotOptions: {
                          pie: {
                              allowPointSelect: true,
                              cursor: 'pointer',
                              depth: 35,
                              dataLabels: {
                                  enabled: true,
                                  format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                                  style:{textShadow:'',color:(Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'}
                              }
                          }
                      },
                      series: [{
                          name: "No. de Procesos",
                          colorByPoint: true,
                          data: arreglo
                      }]
                  });
                },
                error:function(){alert('error');}
              });//Termina Ajax prueba
            }
          });
          $("#selvda").change(function(){
            if($('#selvda').val()==''){
              $.ajax({url:"tierras/reporjuridicovda",type:"POST",data:{mpio:$('#selmpio').val()},dataType:'json',
                success:function(data1){
                  $("#title_reporte").html(("Reporte - "+ $('#selmpio').find('option:selected').text()))
                  $("#labelvda").show();
                  $("#selvda").show();
                  $("#selvda").empty();
                  $("#selvda").append("<option value=''>Por favor seleccione</option>");
                  [].forEach.call(data1[0],function(datos){
                    $("#selvda").append("<option value=\""+datos.cod_unodc+"\">"+datos.nombre1+"</option>");
                  });
                  var arreglo=[]
                  for(var i = 0; i < data1[1].length; i++){
                    arreglo[i]=[(data1[1][i].name + " " + data1[1][i].last_name),Number(data1[1][i].y)]
                  }
                  $('#container').highcharts({
                      chart: {
                          type: 'pie',
                          options3d: {
                              enabled: true,
                              alpha: 45,
                              beta: 0
                          }
                      },
                      title: {
                          text: ''
                      },
                      tooltip: {
                          pointFormat: '{series.name}: <b>{point.y:.0f}</b>'
                      },
                      plotOptions: {
                          pie: {
                              allowPointSelect: true,
                              cursor: 'pointer',
                              depth: 35,
                              dataLabels: {
                                  enabled: true,
                                  format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                                  style:{textShadow:'',color:(Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'}
                              }
                          }
                      },
                      series: [{
                          name: "No. de Procesos",
                          colorByPoint: true,
                          data: arreglo
                      }]
                  });
                },
                error:function(){alert('error');}
              });//Termina Ajax
            } else {
              $.ajax({url:"tierras/reporjuridicovdadet",type:"POST",data:{mpio:$('#selvda').val()},dataType:'json',
                success:function(data1){
                  $("#title_reporte").html(("Reporte - "+ $('#selvda').find('option:selected').text()))
                  var arreglo=[]
                  for(var i = 0; i < data1[0].length; i++){
                    arreglo[i]=[(data1[0][i].name + " " + data1[0][i].last_name),Number(data1[0][i].y)]
                  }
                  $('#container').highcharts({
                      chart: {
                          type: 'pie',
                          options3d: {
                              enabled: true,
                              alpha: 45,
                              beta: 0
                          }
                      },
                      title: {
                          text: ''
                      },
                      tooltip: {
                          pointFormat: '{series.name}: <b>{point.y:.0f}</b>'
                      },
                      plotOptions: {
                          pie: {
                              allowPointSelect: true,
                              cursor: 'pointer',
                              depth: 35,
                              dataLabels: {
                                  enabled: true,
                                  format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                                  style:{textShadow:'',color:(Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'}
                              }
                          }
                      },
                      series: [{
                          name: "No. de Procesos",
                          colorByPoint: true,
                          data: arreglo
                      }]
                  });
                  //console.log(valores)
                },
                error:function(){alert('error');}
              });//Termina Ajax prueva
            }
          });
      });
    </script>
@stop
@endif<!--Cierra el if de mostrar el contenido de la página si esta autenticado-->