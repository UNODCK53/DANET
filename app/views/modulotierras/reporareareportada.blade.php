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
    <br>
    <div class="row">
      <br>
      <p class="lead text-center">RELACIÓN DE ÁREA FORMALIZADA</p>
    </div>
      <div class="col-sm-1"></div>
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
      <div class="col-sm-1"></div>
    </div>
    <div class="row">
      <br>
      <div class="col-sm-1"></div>
      <div class="col-sm-10">
        <div class="panel panel-primary">
          <div class="panel-heading">
            <h3 class="panel-title">Área Preliminar - Área Formalizada</h3>
          </div>
          <div class="panel-body">
            <div id="container"></div>
          </div>
        </div>
      </div>      
      
      <div class="col-sm-1"></div>
    </div>
<br/>
<!--fin del codigo-->    
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
    var ha={{json_encode($arraytotal[0])}}
    var fa={{json_encode($arraytotal[1])}}
    var m={{json_encode($arraytotal[2])}}
    var preliminar=ha[0].area_p+(fa[0].area_p*0.644)+(m[0].area_p*0.0001)
    var formalizada=ha[0].area_f+(fa[0].area_f*0.644)+(m[0].area_f*0.0001)
    $(function(){
      $('#container').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: ''
        },
        xAxis: {
            categories: [
                '<b>Formalización de tierras</b>',
            ]
        },
        yAxis: [{
            min: 0,
            title: {
                text: 'Hectáreas'
            }
        }],
        legend: {
            shadow: false
        },
        tooltip: {
            shared: true,
            pointFormat:'<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.0f} Ha</b></td></tr><br>',
        },
        plotOptions: {
            column: {
                grouping: false,
                shadow: false,
                borderWidth: 0
            }
        },
        series: [{
            name: 'Área Preliminar',
            color: 'rgba(124,181,236,1)',
            data: [Number(preliminar)],
            pointPadding: 0.3,
            
        }, {
            name: 'Área Formalizada',
            color: 'rgba(22,88,154,0.9)',
            data: [Number(formalizada)],
            pointPadding: 0.4,       
        }]
      });  
    });//Termina function highchart
    $(document).ready(function() {
      $("#tierras").addClass("active");
      $("#tierrasreporarearepor").addClass("active");
      $("#iniciomenupeq").html("<small> INICIO</small>");
      $("#tierrasmenupeq").html("<strong>MÓDULO TIERRAS<span class='caret'></span></strong>");
      $("#tierrasreporarearepormenupeq").html("<strong><span class='glyphicon glyphicon-ok'></span>Área Levantada</strong>");
      $("#mensajeestatus").fadeOut(5000);
      $("#labelmpio").hide();
      $("#selmpio").hide();
      $("#labelvda").hide();
      $("#selvda").hide();
      $("#seldpto").change(function(){
        if((($('#seldpto').val()=='')&&($('#selmpio').val()!=''))||(($('#seldpto').val()=='')&&($('#selmpio').val()=='')))
        {
          location.reload();
        }
        else{
          $.ajax({url:"tierras/reporarealevantadampio",type:"POST",data:{dpto:$('#seldpto').val()},dataType:'json',
            success:function(data1){
              $("#labelmpio").show();
              $("#selmpio").show();
              $("#selmpio").empty();
              $("#selvda").empty();
              $("#selvda").hide();
              $("#selmpio").append("<option value=''>Por favor seleccione</option>");
              $.each(data1[0], function(nom,datos){
                $("#selmpio").append("<option value=\""+datos.cod_mpio+"\">"+datos.nom_mpio+"</option>");
              });
              var ha=data1[1];
              var fa=data1[2];
              var m=data1[3];
              var preliminar=ha[0].area_p+(fa[0].area_p*0.644)+(m[0].area_p*0.0001)
              var formalizada=ha[0].area_f+(fa[0].area_f*0.644)+(m[0].area_f*0.0001)
              $('#container').highcharts({
                chart: {
                    type: 'column'
                },
                title: {
                    text: ''
                },
                xAxis: {
                    categories: [
                        '<b>Formalización de tierras</b>',
                    ]
                },
                yAxis: [{
                    min: 0,
                    title: {
                        text: 'Hectáreas'
                    }
                }],
                legend: {
                    shadow: false
                },
                tooltip: {
                    shared: true,
                    pointFormat:'<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y:.2f} Ha</b></td></tr><br>',
                },
                plotOptions: {
                    column: {
                        grouping: false,
                        shadow: false,
                        borderWidth: 0
                    }
                },
                series: [{
                    name: 'Área Preliminar',
                    color: 'rgba(124,181,236,1)',
                    data: [Number(preliminar)],
                    pointPadding: 0.3,
                    
                }, {
                    name: 'Área Formalizada',
                    color: 'rgba(22,88,154,0.9)',
                    data: [Number(formalizada)],
                    pointPadding: 0.4,       
                }]
              });
            },
            error:function(){alert('error');}
          });//Termina Ajax prueva
        }
      });//Termina chage seldpto
      $("#selmpio").change(function(){
        if($('#selmpio').val()=='')
        {
          $.ajax({url:"tierras/reporarealevantadampio",type:"POST",data:{dpto:$('#seldpto').val()},dataType:'json',
            success:function(data1){
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
              var ha=data1[1];
              var fa=data1[2];
              var m=data1[3];
              var preliminar=ha[0].area_p+(fa[0].area_p*0.644)+(m[0].area_p*0.0001)
              var formalizada=ha[0].area_f+(fa[0].area_f*0.644)+(m[0].area_f*0.0001)
              $('#container').highcharts({
                chart: {
                    type: 'column'
                },
                title: {
                    text: ''
                },
                xAxis: {
                    categories: [
                        '<b>Formalización de tierras</b>',
                    ]
                },
                yAxis: [{
                    min: 0,
                    title: {
                        text: 'Hectáreas'
                    }
                }],
                legend: {
                    shadow: false
                },
                tooltip: {
                    shared: true,
                    pointFormat:'<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y:.2f} Ha</b></td></tr><br>',
                },
                plotOptions: {
                    column: {
                        grouping: false,
                        shadow: false,
                        borderWidth: 0
                    }
                },
                series: [{
                    name: 'Área Preliminar',
                    color: 'rgba(124,181,236,1)',
                    data: [Number(preliminar)],
                    pointPadding: 0.3,
                    
                }, {
                    name: 'Área Formalizada',
                    color: 'rgba(22,88,154,0.9)',
                    data: [Number(formalizada)],
                    pointPadding: 0.4,       
                }]
              });
            },
            error:function(){alert('error');}
          });//Termina Ajax prueva
        }
        else{
          $.ajax({url:"tierras/reporarealevantadavda",type:"POST",data:{mpio:$('#selmpio').val()},dataType:'json',
            success:function(data){
              $("#labelvda").show();
              $("#selvda").show();
              $("#selvda").empty();
              $("#selvda").append("<option value=''>Por favor seleccione</option>");
              [].forEach.call(data[0],function(datos){
                $("#selvda").append("<option value=\""+datos.cod_unodc+"\">"+datos.nombre1+"</option>");
              });
              var ha=data[1];
              var fa=data[2];
              var m=data[3];
              var preliminar=ha[0].area_p+(fa[0].area_p*0.644)+(m[0].area_p*0.0001)
              var formalizada=ha[0].area_f+(fa[0].area_f*0.644)+(m[0].area_f*0.0001)
              $('#container').highcharts({
                chart: {
                    type: 'column'
                },
                title: {
                    text: ''
                },
                xAxis: {
                    categories: [
                        '<b>Formalización de tierras</b>',
                    ]
                },
                yAxis: [{
                    min: 0,
                    title: {
                        text: 'Hectáreas'
                    }
                }],
                legend: {
                    shadow: false
                },
                tooltip: {
                    shared: true,
                    pointFormat:'<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y:.2f} Ha</b></td></tr><br>',
                },
                plotOptions: {
                    column: {
                        grouping: false,
                        shadow: false,
                        borderWidth: 0
                    }
                },
                series: [{
                    name: 'Área Preliminar',
                    color: 'rgba(124,181,236,1)',
                    data: [Number(preliminar)],
                    pointPadding: 0.3,
                    
                }, {
                    name: 'Área Formalizada',
                    color: 'rgba(22,88,154,0.9)',
                    data: [Number(formalizada)],
                    pointPadding: 0.4,       
                }]
              });
            },
            error:function(){alert('error');}
          });//Termina Ajax prueva
        }
      });//Termina change selmpio
      $("#selvda").change(function(){
        if($('#selvda').val()=='')
        {
          $.ajax({url:"tierras/reporarealevantadampio",type:"POST",data:{dpto:$('#seldpto').val()},dataType:'json',
            success:function(data1){
              $.each(data1[0], function(nom,datos){
                $("#selmpio").append("<option value=\""+datos.cod_mpio+"\">"+datos.nom_mpio+"</option>");
              });
              var ha=data1[1];
              var fa=data1[2];
              var m=data1[3];
              var preliminar=ha[0].area_p+(fa[0].area_p*0.644)+(m[0].area_p*0.0001)
              var formalizada=ha[0].area_f+(fa[0].area_f*0.644)+(m[0].area_f*0.0001)
              $('#container').highcharts({
                chart: {
                    type: 'column'
                },
                title: {
                    text: ''
                },
                xAxis: {
                    categories: [
                        '<b>Formalización de tierras</b>',
                    ]
                },
                yAxis: [{
                    min: 0,
                    title: {
                        text: 'Hectáreas'
                    }
                }],
                legend: {
                    shadow: false
                },
                tooltip: {
                    shared: true,
                    pointFormat:'<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y:.2f} Ha</b></td></tr><br>',
                },
                plotOptions: {
                    column: {
                        grouping: false,
                        shadow: false,
                        borderWidth: 0
                    }
                },
                series: [{
                    name: 'Área Preliminar',
                    color: 'rgba(124,181,236,1)',
                    data: [Number(preliminar)],
                    pointPadding: 0.3,
                    
                }, {
                    name: 'Área Formalizada',
                    color: 'rgba(22,88,154,0.9)',
                    data: [Number(formalizada)],
                    pointPadding: 0.4,       
                }]
              });
            },
            error:function(){alert('error');}
          });//Termina Ajax prueva
        }
        else{
          $.ajax({url:"tierras/reporarealevantadavdadet",type:"POST",data:{vda:$('#selvda').val()},dataType:'json',
            success:function(data3){
              var ha=data3[0];
              var fa=data3[1];
              var m=data3[2];
              var preliminar=ha[0].area_p+(fa[0].area_p*0.644)+(m[0].area_p*0.0001)
              var formalizada=ha[0].area_f+(fa[0].area_f*0.644)+(m[0].area_f*0.0001)
              $('#container').highcharts({
                chart: {
                    type: 'column'
                },
                title: {
                    text: ''
                },
                xAxis: {
                    categories: [
                        '<b>Formalización de tierras</b>',
                    ]
                },
                yAxis: [{
                    min: 0,
                    title: {
                        text: 'Hectáreas'
                    }
                }],
                legend: {
                    shadow: false
                },
                tooltip: {
                    shared: true,
                    pointFormat:'<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y:.2f} Ha</b></td></tr><br>',
                },
                plotOptions: {
                    column: {
                        grouping: false,
                        shadow: false,
                        borderWidth: 0
                    }
                },
                series: [{
                    name: 'Área Preliminar',
                    color: 'rgba(124,181,236,1)',
                    data: [Number(preliminar)],
                    pointPadding: 0.3,
                    
                }, {
                    name: 'Área Formalizada',
                    color: 'rgba(22,88,154,0.9)',
                    data: [Number(formalizada)],
                    pointPadding: 0.4,       
                }]
              });
            },
            error:function(){alert('error');}
          });//Termina Ajax prueva
        }
      });//Termina change selvda
    });//Termina document ready
    </script>
@stop
@endif<!--Cierra el if de mostrar el contenido de la página si esta autenticado-->