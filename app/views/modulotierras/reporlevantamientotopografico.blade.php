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
  <script src="https://code.highcharts.com/modules/drilldown.js"></script>
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
      <p class="lead text-center">REPORTE DE LEVANTAMIENTOS TOPOGRÁFICOS</p>
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
      <div class="col-sm-1">
      </div>
      <div class="col-sm-10">
        <div class="col-xs-12 col-md-6">
          <div class="panel panel-primary">
            <div class="panel-heading">
              <h3 class="panel-title">Procesos por levantamiento topográfico</h3>
            </div>
            <div class="panel-body">
              <div id="container"></div>
            </div>
          </div>
        </div>
        <div class="col-xs-12 col-md-6">
          <div class="panel panel-primary">
            <div class="panel-heading">
              <h3 class="panel-title">Levantamientos topográficos por topógrafo</h3>
            </div>
            <div class="panel-body">
              <div id="container2"></div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-1">
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
@stop
<!--agrega JavaScript dentro del body a la pagina-->
@section('js')
  @parent
  <script src="assets/js/highcharts/highcharts.js"></script>
  <script src="assets/js/highcharts/exporting.js"></script>
  <script>
  var procesos={{json_encode($arraylt)}}
  $(function () {
    $('#container').highcharts({
      chart: {
          type: 'column'
      },
      title: {
          text: ''
      },
      xAxis: {
          categories: ['Procesos']
      },
      yAxis: {
          min: 0,
          title: {
              text: 'Número de procesos'
          },
          stackLabels: {
              enabled: true,
              style: {
                  fontWeight: 'bold',
                  color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
              }
          }
      },
      legend: {
          
          backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
          
          shadow: false
      },
      tooltip: {
          headerFormat: '<b>{point.x}</b><br/>',
          pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
      },
      plotOptions: {
          column: {
              stacking: 'normal',
              dataLabels: {
                  enabled: true,
                  color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
              }
          }
      },
      series: [{
          name: 'Si requiere',
          data: [Number(procesos[0].y)]
      }, {
          name: 'No requiere',
          data: [Number(procesos[1].y)]
      }] 
    });
  });  
  var procesos_depto={{json_encode($arraydepto_num)}}
  var arreglo=[]
  for(var i = 0; i < procesos_depto.length; i++){
    arreglo[i]={name: procesos_depto[i].NOM_DPTO, y: Number(procesos_depto[i].procesos)}
  }
  $(function () {
    $('#container2').highcharts({
      chart: {
        type: 'column'
      },
      title: {
          text: ''
      },
      subtitle: {
          text: ''
      },
      xAxis: {
          type: 'category'
      },
      yAxis: {
          title: {
              text: 'Número de procesos'
          }

      },
      legend: {
          enabled: false
      },
      plotOptions: {
          series: {
              borderWidth: 0,
              dataLabels: {
                  enabled: true,
                  format: '{point.y}'
              }
          }
      },

      tooltip: {
          headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
          pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b> procesos<br/>'
      },

      series: [{
          name: 'Brands',
          colorByPoint: true,
          data: arreglo
      }],
    });
  });  

  $(document).ready(function() {
    //para que los menus pequeño y grande funcione
    $( "#tierras" ).addClass("active");
    $( "#tierrasreporlevtop" ).addClass("active");
    $( "#iniciomenupeq" ).html("<small> INICIO</small>");
    $( "#tierrasmenupeq" ).html("<strong>MÓDULO TIERRAS<span class='caret'></span></strong>");
    $( "#tierrasreporlevtopmenupeq" ).html("<strong><span class='glyphicon glyphicon-ok'></span>Levantamiento Topográfico</strong>");
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
          $.ajax({
            url:"tierras/reporlevantamientompio",
            type:"POST",
            data:{dpto:$('#seldpto').val()},
            dataType:'json',
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
                if(data1[3].length==1){
                  procesos=[];
                  if(data1[3][0].requiererespgeo=="1"){
                    procesos[0]={
                      requiererespgeo: "1",
                      y: data1[3][0].y
                    }
                    procesos[1]={
                      requiererespgeo: "2",
                      y: 0
                    }
                  } else {
                    procesos[0]={
                      requiererespgeo: "1",
                      y: 0
                    }
                    procesos[1]={
                      requiererespgeo: "2",
                      y: data1[3][0].y
                    }
                  }
                } else {
                  procesos=data1[3]
                }                
                $('#container').highcharts({
                   chart: {
                      type: 'column'
                  },
                  title: {
                      text: ''
                  },
                  xAxis: {
                      categories: ['Procesos']
                  },
                  yAxis: {
                      min: 0,
                      title: {
                          text: 'Número de procesos'
                      },
                      stackLabels: {
                          enabled: true,
                          style: {
                              fontWeight: 'bold',
                              color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                          }
                      }
                  },
                  legend: {
                      
                      backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
                      
                      shadow: false
                  },
                  tooltip: {
                      headerFormat: '<b>{point.x}</b><br/>',
                      pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
                  },
                  plotOptions: {
                      column: {
                          stacking: 'normal',
                          dataLabels: {
                              enabled: true,
                              color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
                          }
                      }
                  },
                  series: [{
                      name: 'Si requiere',
                      data: [Number(procesos[0].y)]
                  }, {
                      name: 'No requiere',
                      data: [Number(procesos[1].y)]
                  }] 
                });
                //For para incluir datos de procesos con levantamiento 
                if (data1[2].length>0){
                    //el primer arreglo recorre la tabla de procesos ok
                    for (var i = 0; i < data1[2].length; i++){
                      var user=data1[2][i].respgeografico;
                      var procesos_ok=data1[2][i].procesos;
                      //El segundo arreglo carga la informacion al arreglo que va a graficar los datos
                      for(var j=0; j<data1[1].length;j++){
                        var user_2=data1[1][i].respgeografico;
                        if(user_2==user){
                          data1[1][i].procesos_ok=Number(procesos_ok);
                          data1[1][i].procesos_no_ok=Number(data1[1][i].procesos) -  procesos_ok;
                        }
                      }
                    }
                } else if(data1[2].length==0 && procesos.length>0){
                  for (var i = 0; i < data1[1].length; i++){
                    data1[1][i].procesos_ok=0;
                    data1[1][i].procesos_no_ok=Number(procesos[0].y);
                  }
                } else {
                    for (var i = 0; i < data1[1].length; i++){
                      data1[1][i].procesos_ok=0;
                      data1[1][i].procesos_no_ok=0;
                    }
                }
                var arreglo=[];
                for(var i = 0; i < data1[1].length; i++){
                  arreglo[i]={name: data1[1][i].name + " " + data1[1][i].last_name, y: Number(data1[1][i].procesos), drilldown: data1[1][i].respgeografico}
                }
                var arreglo2=[];
                for(var i = 0; i < data1[1].length; i++){
                  arreglo2[i]={
                    name: data1[1][i].name + " " + data1[1][i].last_name, 
                    id: data1[1][i].respgeografico,
                    data: [['Con Levantamiento', data1[1][i].procesos_ok],['Sin Levantamiento',data1[1][i].procesos_no_ok]]
                  }
                }            
                Highcharts.setOptions({
                    lang: {
                        drillUpText: '<< Regresar'
                    }
                });
                $('#container2').highcharts({
                  chart: {
                    type: 'column'
                  },
                  title: {
                      text: ''
                  },
                  subtitle: {
                      text: ''
                  },
                  xAxis: {
                      type: 'category'
                  },
                  yAxis: {
                      title: {
                          text: 'Número de procesos'
                      }
                  },
                  legend: {
                      enabled: false
                  },
                  plotOptions: {
                      series: {
                          borderWidth: 0,
                          dataLabels: {
                              enabled: true,
                              format: '{point.y}'
                          }
                      }
                  },
                  tooltip: {
                      headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                      pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b> procesos<br/>'
                  },
                  series: [{
                      name: 'Brands',
                      colorByPoint: true,
                      data: arreglo
                  }],
                  drilldown: {
                    drillUpButton: {
                        relativeTo: 'spacingBox',
                        position: {
                            y: 0,
                            x: 0
                        },
                        theme: {
                            fill: 'white',
                            'stroke-width': 1,
                            stroke: 'silver',
                            r: 0,
                            states: {
                                hover: {
                                    fill: '#a4edba'
                                },
                                select: {
                                    stroke: '#039',
                                    fill: '#a4edba'
                                }
                            }
                        }

                    },
                    series: arreglo2}
                });
            },
            error:function(){alert('error');
            }
          });//Termina Ajax prueva
        }
    });
    $("#selmpio").change(function(){
      if($('#selmpio').val()==''){
          $.ajax({
            url:"tierras/reporlevantamientompio",
            type:"POST",
            data:{dpto:$('#seldpto').val()},
            dataType:'json',
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
                if(data1[3].length==1){
                  procesos=[];
                  if(data1[3][0].requiererespgeo=="1"){
                    procesos[0]={
                      requiererespgeo: "1",
                      y: data1[3][0].y
                    }
                    procesos[1]={
                      requiererespgeo: "2",
                      y: 0
                    }
                  } else {
                    procesos[0]={
                      requiererespgeo: "1",
                      y: 0
                    }
                    procesos[1]={
                      requiererespgeo: "2",
                      y: data1[3][0].y
                    }
                  }
                } else {
                  procesos=data1[3]
                }               
                $('#container').highcharts({
                   chart: {
                      type: 'column'
                  },
                  title: {
                      text: ''
                  },
                  xAxis: {
                      categories: ['Procesos']
                  },
                  yAxis: {
                      min: 0,
                      title: {
                          text: 'Número de procesos'
                      },
                      stackLabels: {
                          enabled: true,
                          style: {
                              fontWeight: 'bold',
                              color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                          }
                      }
                  },
                  legend: {
                      
                      backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
                      
                      shadow: false
                  },
                  tooltip: {
                      headerFormat: '<b>{point.x}</b><br/>',
                      pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
                  },
                  plotOptions: {
                      column: {
                          stacking: 'normal',
                          dataLabels: {
                              enabled: true,
                              color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
                          }
                      }
                  },
                  series: [{
                      name: 'Si requiere',
                      data: [Number(procesos[0].y)]
                  }, {
                      name: 'No requiere',
                      data: [Number(procesos[1].y)]
                  }] 
                });
                //For para incluir datos de procesos con levantamiento 
                if (data1[2].length>0){
                    //el primer arreglo recorre la tabla de procesos ok
                    for (var i = 0; i < data1[2].length; i++){
                      var user=data1[2][i].respgeografico;
                      var procesos_ok=data1[2][i].procesos;
                      //El segundo arreglo carga la informacion al arreglo que va a graficar los datos
                      for(var j=0; j<data1[1].length;j++){
                        var user_2=data1[1][i].respgeografico;
                        if(user_2==user){
                          data1[1][i].procesos_ok=Number(procesos_ok);
                          data1[1][i].procesos_no_ok=Number(data1[1][i].procesos) -  procesos_ok;
                        }
                      }
                    }
                } else if(data1[2].length==0 && procesos.length>0){
                  for (var i = 0; i < data1[1].length; i++){
                    data1[1][i].procesos_ok=0;
                    data1[1][i].procesos_no_ok=Number(procesos[0].y);
                  }
                } else {
                    for (var i = 0; i < data1[1].length; i++){
                      data1[1][i].procesos_ok=0;
                      data1[1][i].procesos_no_ok=0;
                    }
                }
                var arreglo=[];
                for(var i = 0; i < data1[1].length; i++){
                  arreglo[i]={name: data1[1][i].name + " " + data1[1][i].last_name, y: Number(data1[1][i].procesos), drilldown: data1[1][i].respgeografico}
                }
                var arreglo2=[];
                for(var i = 0; i < data1[1].length; i++){
                  arreglo2[i]={
                    name: data1[1][i].name + " " + data1[1][i].last_name, 
                    id: data1[1][i].respgeografico,
                    data: [['Con Levantamiento', data1[1][i].procesos_ok],['Sin Levantamiento',data1[1][i].procesos_no_ok]]
                  }
                }            
                Highcharts.setOptions({
                    lang: {
                        drillUpText: '<< Regresar'
                    }
                });
                $('#container2').highcharts({
                  chart: {
                    type: 'column'
                  },
                  title: {
                      text: ''
                  },
                  subtitle: {
                      text: ''
                  },
                  xAxis: {
                      type: 'category'
                  },
                  yAxis: {
                      title: {
                          text: 'Número de procesos'
                      }
                  },
                  legend: {
                      enabled: false
                  },
                  plotOptions: {
                      series: {
                          borderWidth: 0,
                          dataLabels: {
                              enabled: true,
                              format: '{point.y}'
                          }
                      }
                  },
                  tooltip: {
                      headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                      pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}%</b> procesos<br/>'
                  },
                  series: [{
                      name: 'Brands',
                      colorByPoint: true,
                      data: arreglo
                  }],
                  drilldown: {
                    drillUpButton: {
                        relativeTo: 'spacingBox',
                        position: {
                            y: 0,
                            x: 0
                        },
                        theme: {
                            fill: 'white',
                            'stroke-width': 1,
                            stroke: 'silver',
                            r: 0,
                            states: {
                                hover: {
                                    fill: '#a4edba'
                                },
                                select: {
                                    stroke: '#039',
                                    fill: '#a4edba'
                                }
                            }
                        }

                    },
                    series: arreglo2}
                });
            },
            error:function(){alert('error');
            }
          });//Termina Ajax prueva
        }
      else{
        $.ajax({
          url:"tierras/reporlevantamientovda",
          type:"POST",
          data:{mpio:$('#selmpio').val()},
          dataType:'json',
          success:function(data1){
            $("#title_reporte").html(("Reporte - "+ $('#selmpio').find('option:selected').text()))
            $("#labelvda").show();
            $("#selvda").show();
            $("#selvda").empty();
            $("#selvda").append("<option value=''>Por favor seleccione</option>");
            [].forEach.call(data1[0],function(datos){
              $("#selvda").append("<option value=\""+datos.cod_unodc+"\">"+datos.nombre1+"</option>");
            });
            if(data1[3].length==1){
              procesos=[];
              if(data1[3][0].requiererespgeo=="1"){
                procesos[0]={
                  requiererespgeo: "1",
                  y: data1[3][0].y
                }
                procesos[1]={
                  requiererespgeo: "2",
                  y: 0
                }
              } else {
                procesos[0]={
                  requiererespgeo: "1",
                  y: 0
                }
                procesos[1]={
                  requiererespgeo: "2",
                  y: data1[3][0].y
                }
              }
            } else {
              procesos=data1[3]
            }

            if (procesos.length>0){
                $('#container').highcharts({
                  chart: {
                      type: 'column'
                  },
                  title: {
                      text: ''
                  },
                  xAxis: {
                      categories: ['Procesos']
                  },
                  yAxis: {
                      min: 0,
                      title: {
                          text: 'Número de procesos'
                      },
                      stackLabels: {
                          enabled: true,
                          style: {
                              fontWeight: 'bold',
                              color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                          }
                      }
                  },
                  legend: {
                      
                      backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
                      
                      shadow: false
                  },
                  tooltip: {
                      headerFormat: '<b>{point.x}</b><br/>',
                      pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
                  },
                  plotOptions: {
                      column: {
                          stacking: 'normal',
                          dataLabels: {
                              enabled: true,
                              color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
                          }
                      }
                  },
                  series: [{
                      name: 'Si requiere',
                      data: [Number(procesos[0].y)]
                  }, {
                      name: 'No requiere',
                      data: [Number(procesos[1].y)]
                  }] 
                });
                //For para incluir datos de procesos con levantamiento 
                if (data1[2].length>0){
                    //el primer arreglo recorre la tabla de procesos ok
                    for (var i = 0; i < data1[2].length; i++){
                      var user=data1[2][i].respgeografico;
                      var procesos_ok=data1[2][i].procesos;
                      //El segundo arreglo carga la informacion al arreglo que va a graficar los datos
                      for(var j=0; j<data1[1].length;j++){
                        var user_2=data1[1][i].respgeografico;
                        if(user_2==user){
                          data1[1][i].procesos_ok=Number(procesos_ok);
                          data1[1][i].procesos_no_ok=Number(data1[1][i].procesos) -  procesos_ok;
                        }
                      }
                    }
                } else if(data1[2].length==0 && procesos.length>0){
                  for (var i = 0; i < data1[1].length; i++){
                    data1[1][i].procesos_ok=0;
                    data1[1][i].procesos_no_ok=Number(procesos[0].y);
                  }
                } else {
                  for (var i = 0; i < data1[1].length; i++){
                    data1[1][i].procesos_ok=0;
                    data1[1][i].procesos_no_ok=0;
                  }
                }
                console.log(data1)
                var arreglo=[];
                for(var i = 0; i < data1[1].length; i++){
                  arreglo[i]={name: data1[1][i].name + " " + data1[1][i].last_name, y: Number(data1[1][i].procesos), drilldown: data1[1][i].respgeografico}
                }
                var arreglo2=[];
                for(var i = 0; i < data1[1].length; i++){
                  arreglo2[i]={
                    name: data1[1][i].name + " " + data1[1][i].last_name, 
                    id: data1[1][i].respgeografico,
                    data: [['Con Levantamiento', data1[1][i].procesos_ok],['Sin Levantamiento',data1[1][i].procesos_no_ok]]
                  }
                }
                          
                Highcharts.setOptions({
                    lang: {
                        drillUpText: '<< Regresar'
                    }
                });
                $('#container2').highcharts({
                  chart: {
                    type: 'column'
                  },
                  title: {
                      text: ''
                  },
                  subtitle: {
                      text: ''
                  },
                  xAxis: {
                      type: 'category'
                  },
                  yAxis: {
                      title: {
                          text: 'Número de procesos'
                      }
                  },
                  legend: {
                      enabled: false
                  },
                  plotOptions: {
                      series: {
                          borderWidth: 0,
                          dataLabels: {
                              enabled: true,
                              format: '{point.y}'
                          }
                      }
                  },
                  tooltip: {
                      headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                      pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b> Procesos<br/>'
                  },
                  series: [{
                      name: 'Brands',
                      colorByPoint: true,
                      data: arreglo
                  }],
                  drilldown: {
                    drillUpButton: {
                        relativeTo: 'spacingBox',
                        position: {
                            y: 0,
                            x: 0
                        },
                        theme: {
                            fill: 'white',
                            'stroke-width': 1,
                            stroke: 'silver',
                            r: 0,
                            states: {
                                hover: {
                                    fill: '#a4edba'
                                },
                                select: {
                                    stroke: '#039',
                                    fill: '#a4edba'
                                }
                            }
                        }

                    },
                    series: arreglo2}
                });
              } else {
                $( "#container" ).empty();
                $( "#container" ).html("No hay registros que mostrar");
                $( "#container2" ).empty();
                $( "#container2" ).html("No hay registros que mostrar");
                $("#selvda").hide();
                $("#labelvda").hide();
              }
          },
          error:function(){alert('error');
          }
        });//Termina Ajax prueva
      }
    });
    $("#selvda").change(function(){
      if($('#selvda').val()==''){
        $.ajax({
          url:"tierras/reporlevantamientovda",
          type:"POST",
          data:{mpio:$('#selmpio').val()},
          dataType:'json',
          success:function(data1){
            $("#title_reporte").html(("Reporte - "+ $('#selmpio').find('option:selected').text()))
            $("#labelvda").show();
            $("#selvda").show();
            $("#selvda").empty();
            $("#selvda").append("<option value=''>Por favor seleccione</option>");
            [].forEach.call(data1[0],function(datos){
              $("#selvda").append("<option value=\""+datos.cod_unodc+"\">"+datos.nombre1+"</option>");
            });
            if(data1[3].length==1){
              procesos=[];
              if(data1[3][0].requiererespgeo=="1"){
                procesos[0]={
                  requiererespgeo: "1",
                  y: data1[3][0].y
                }
                procesos[1]={
                  requiererespgeo: "2",
                  y: 0
                }
              } else {
                procesos[0]={
                  requiererespgeo: "1",
                  y: 0
                }
                procesos[1]={
                  requiererespgeo: "2",
                  y: data1[3][0].y
                }
              }
            } else {
              procesos=data1[3]
            }

            if (procesos.length>0){
              $('#container').highcharts({
                chart: {
                    type: 'column'
                },
                title: {
                    text: ''
                },
                xAxis: {
                    categories: ['Procesos']
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Número de procesos'
                    },
                    stackLabels: {
                        enabled: true,
                        style: {
                            fontWeight: 'bold',
                            color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                        }
                    }
                },
                legend: {
                    
                    backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
                    
                    shadow: false
                },
                tooltip: {
                    headerFormat: '<b>{point.x}</b><br/>',
                    pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
                },
                plotOptions: {
                    column: {
                        stacking: 'normal',
                        dataLabels: {
                            enabled: true,
                            color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
                        }
                    }
                },
                series: [{
                    name: 'Si requiere',
                    data: [Number(procesos[0].y)]
                }, {
                    name: 'No requiere',
                    data: [Number(procesos[1].y)]
                }] 
              });
              //For para incluir datos de procesos con levantamiento 
              if (data1[2].length>0){
                  //el primer arreglo recorre la tabla de procesos ok
                  for (var i = 0; i < data1[2].length; i++){
                    var user=data1[2][i].respgeografico;
                    var procesos_ok=data1[2][i].procesos;
                    //El segundo arreglo carga la informacion al arreglo que va a graficar los datos
                    for(var j=0; j<data1[1].length;j++){
                      var user_2=data1[1][i].respgeografico;
                      if(user_2==user){
                        data1[1][i].procesos_ok=Number(procesos_ok);
                        data1[1][i].procesos_no_ok=Number(data1[1][i].procesos) -  procesos_ok;
                      }
                    }
                  }
              } else if(data1[2].length==0 && procesos.length>0){
                for (var i = 0; i < data1[1].length; i++){
                  data1[1][i].procesos_ok=0;
                  data1[1][i].procesos_no_ok=Number(procesos[0].y);
                }
              } else {
                for (var i = 0; i < data1[1].length; i++){
                  data1[1][i].procesos_ok=0;
                  data1[1][i].procesos_no_ok=0;
                }
              }
              
              var arreglo=[];
              for(var i = 0; i < data1[1].length; i++){
                arreglo[i]={name: data1[1][i].name + " " + data1[1][i].last_name, y: Number(data1[1][i].procesos), drilldown: data1[1][i].respgeografico}
              }
              var arreglo2=[];
              for(var i = 0; i < data1[1].length; i++){
                arreglo2[i]={
                  name: data1[1][i].name + " " + data1[1][i].last_name, 
                  id: data1[1][i].respgeografico,
                  data: [['Con Levantamiento', data1[1][i].procesos_ok],['Sin Levantamiento',data1[1][i].procesos_no_ok]]
                }
              }
                        
              Highcharts.setOptions({
                  lang: {
                      drillUpText: '<< Regresar'
                  }
              });
              $('#container2').highcharts({
                chart: {
                  type: 'column'
                },
                title: {
                    text: ''
                },
                subtitle: {
                    text: ''
                },
                xAxis: {
                    type: 'category'
                },
                yAxis: {
                    title: {
                        text: 'Número de procesos'
                    }
                },
                legend: {
                    enabled: false
                },
                plotOptions: {
                    series: {
                        borderWidth: 0,
                        dataLabels: {
                            enabled: true,
                            format: '{point.y}'
                        }
                    }
                },
                tooltip: {
                    headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                    pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b> Procesos<br/>'
                },
                series: [{
                    name: 'Brands',
                    colorByPoint: true,
                    data: arreglo
                }],
                drilldown: {
                  drillUpButton: {
                      relativeTo: 'spacingBox',
                      position: {
                          y: 0,
                          x: 0
                      },
                      theme: {
                          fill: 'white',
                          'stroke-width': 1,
                          stroke: 'silver',
                          r: 0,
                          states: {
                              hover: {
                                  fill: '#a4edba'
                              },
                              select: {
                                  stroke: '#039',
                                  fill: '#a4edba'
                              }
                          }
                      }

                  },
                  series: arreglo2}
              });
            } else {
                $( "#container" ).empty();
                $( "#container" ).html("No hay registros que mostrar");
                $( "#container2" ).empty();
                $( "#container2" ).html("No hay registros que mostrar");
                $("#selvda").hide();
                $("#labelvda").hide();
            }
          },
          error:function(){alert('error');
          }
        });//Termina Ajax prueva
      } else {
        $.ajax({
          url:"tierras/reporlevantamientovdadet",
          type:"POST",
          data:{mpio:$('#selvda').val()},
          dataType:'json',
          success:function(data1){
            console.log(data1)
            $("#title_reporte").html(("Reporte - "+ $('#selvda').find('option:selected').text()))
            if(data1[3].length==1){
              procesos=[];
              if(data1[3][0].requiererespgeo=="1"){
                procesos[0]={
                  requiererespgeo: "1",
                  y: data1[3][0].y
                }
                procesos[1]={
                  requiererespgeo: "2",
                  y: 0
                }
              } else {
                procesos[0]={
                  requiererespgeo: "1",
                  y: 0
                }
                procesos[1]={
                  requiererespgeo: "2",
                  y: data1[3][0].y
                }
              }
            } else {
              procesos=data1[3]
            }
            if (procesos.length>0){
              $('#container').highcharts({
                chart: {
                    type: 'column'
                },
                title: {
                    text: ''
                },
                xAxis: {
                    categories: ['Procesos']
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Número de procesos'
                    },
                    stackLabels: {
                        enabled: true,
                        style: {
                            fontWeight: 'bold',
                            color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                        }
                    }
                },
                legend: {
                    
                    backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
                    
                    shadow: false
                },
                tooltip: {
                    headerFormat: '<b>{point.x}</b><br/>',
                    pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
                },
                plotOptions: {
                    column: {
                        stacking: 'normal',
                        dataLabels: {
                            enabled: true,
                            color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
                        }
                    }
                },
                series: [{
                    name: 'Si requiere',
                    data: [Number(procesos[0].y)]
                }, {
                    name: 'No requiere',
                    data: [Number(procesos[1].y)]
                }] 
              });
              //For para incluir datos de procesos con levantamiento 
              if (data1[2].length>0){
                  //el primer arreglo recorre la tabla de procesos ok
                  for (var i = 0; i < data1[2].length; i++){
                    var user=data1[2][i].respgeografico;
                    var procesos_ok=data1[2][i].procesos;
                    //El segundo arreglo carga la informacion al arreglo que va a graficar los datos
                    for(var j=0; j<data1[1].length;j++){
                      var user_2=data1[1][i].respgeografico;
                      if(user_2==user){
                        data1[1][i].procesos_ok=Number(procesos_ok);
                        data1[1][i].procesos_no_ok=Number(data1[1][i].procesos) -  procesos_ok;
                      }
                    }
                  }
              } else if(data1[2].length==0 && procesos.length>0){
                for (var i = 0; i < data1[1].length; i++){
                  data1[1][i].procesos_ok=0;
                  data1[1][i].procesos_no_ok=Number(procesos[0].y);
                }
              } else {
                for (var i = 0; i < data1[1].length; i++){
                  data1[1][i].procesos_ok=0;
                  data1[1][i].procesos_no_ok=0;
                }
              }
              
              var arreglo=[];
              for(var i = 0; i < data1[1].length; i++){
                arreglo[i]={name: data1[1][i].name + " " + data1[1][i].last_name, y: Number(data1[1][i].procesos), drilldown: data1[1][i].respgeografico}
              }
              var arreglo2=[];
              for(var i = 0; i < data1[1].length; i++){
                arreglo2[i]={
                  name: data1[1][i].name + " " + data1[1][i].last_name, 
                  id: data1[1][i].respgeografico,
                  data: [['Con Levantamiento', data1[1][i].procesos_ok],['Sin Levantamiento',data1[1][i].procesos_no_ok]]
                }
              }
                        
              Highcharts.setOptions({
                  lang: {
                      drillUpText: '<< Regresar'
                  }
              });
              $('#container2').highcharts({
                chart: {
                  type: 'column'
                },
                title: {
                    text: ''
                },
                subtitle: {
                    text: ''
                },
                xAxis: {
                    type: 'category'
                },
                yAxis: {
                    title: {
                        text: 'Número de procesos'
                    }
                },
                legend: {
                    enabled: false
                },
                plotOptions: {
                    series: {
                        borderWidth: 0,
                        dataLabels: {
                            enabled: true,
                            format: '{point.y}'
                        }
                    }
                },
                tooltip: {
                    headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                    pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b> Procesos<br/>'
                },
                series: [{
                    name: 'Brands',
                    colorByPoint: true,
                    data: arreglo
                }],
                drilldown: {
                  drillUpButton: {
                      relativeTo: 'spacingBox',
                      position: {
                          y: 0,
                          x: 0
                      },
                      theme: {
                          fill: 'white',
                          'stroke-width': 1,
                          stroke: 'silver',
                          r: 0,
                          states: {
                              hover: {
                                  fill: '#a4edba'
                              },
                              select: {
                                  stroke: '#039',
                                  fill: '#a4edba'
                              }
                          }
                      }

                  },
                  series: arreglo2}
              });
            } else {
                $( "#container" ).empty();
                $( "#container" ).html("No hay registros que mostrar");
                $( "#container2" ).empty();
                $( "#container2" ).html("No hay registros que mostrar");
            }

          },
          error:function(){alert('error');}
        });//Termina Ajax prueva
      }
    });

  });

  
  
  </script>
@stop
@endif<!--Cierra el if de mostrar el contenido de la página si esta autenticado-->