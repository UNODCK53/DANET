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
        <p class="lead text-center">DISTRIBUCIÓN DE PROCESOS POR ESTADO</p>
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
            <h3 class="panel-title">Procesos por estado</h3>
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
  <script src="assets/js/highcharts/highcharts-3d.js"></script>
  <script src="assets/js/highcharts/exporting.js"></script>
  <script>
  $(function(){
    $('#container').highcharts({
      chart:{type:'column'},
      title:{text:''},
      subtitle:{text:'Resultados Nacionales'},
      xAxis:{
        categories:[
          @foreach($arrayvial[2] as $arraydat3)
            {{'"'.$arraydat3->estado.' ",'}}
          @endforeach
        ],
        crosshair: true
      },
      yAxis:{min:0,title:{text:'Número de procesos'}},
      tooltip:{
        headerFormat:'<span style="font-size:12px">{point.key}</span><table>',
        pointFormat:'<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.0f} Procesos</b></td></tr>',
        footerFormat:'</table>'
      },
      plotOptions:{series:{borderWidth:0,dataLabels:{enabled:true,format:'{point.y:.0f}', style:{textShadow:''}}}},
      series:[{
        name:'Viable',data:[
        @foreach($arrayvial[0] as $arraydat1)
          {{$arraydat1.','}}
        @endforeach
        ]},
        {name:'No viable',data:[
        @foreach($arrayvial[1] as $arraydat2)
          {{$arraydat2.','}}
        @endforeach
        ]}
      ]
    });
  });  //Termina function highchart
  $(document).ready(function(){
    //para que los menus pequeño y grande funcione
    $("#tierras").addClass("active");
    $("#tierrasreporestado").addClass("active");
    $("#iniciomenupeq").html("<small> INICIO</small>");
    $("#tierrasmenupeq").html("<strong>MÓDULO TIERRAS<span class='caret'></span></strong>");
    $("#tierrasreporestadomenupeq").html("<strong><span class='glyphicon glyphicon-ok'></span>Estado</strong>");
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
        $.ajax({url:"tierras/reporestadompio",type:"POST",data:{dpto:$('#seldpto').val()},dataType:'json',
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
            $('#container').highcharts({
              chart:{type:'column'},
              title:{text:''},
              subtitle:{text:'Resultados por departamento'},
              xAxis:{
                categories:[
                  @foreach($arrayvial[2] as $arraydat3)
                    {{'"'.$arraydat3->estado.' ",'}}
                  @endforeach
                ],
                crosshair: true
              },
              yAxis:{min:0,title:{text:'Número de procesos'}},
              tooltip:{
                headerFormat:'<span style="font-size:12px">{point.key}</span><table>',
                pointFormat:'<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y:.0f} Procesos</b></td></tr>',
                footerFormat:'</table>'
              },
              plotOptions:{series:{borderWidth:0,dataLabels:{enabled:true,format:'{point.y:.0f}', style:{textShadow:''}}}},
              series:[
                {name:'Viable',
                 data:data1[1]
                },
                {name:"No viable",
                data:data1[2]
                }
              ]
            });//Termina function highchart
          },
          error:function(){alert('error');}
        });//Termina Ajax prueva
      }
    });//Termina chage seldpto
    $("#selmpio").change(function(){
      if($('#selmpio').val()=='')
      {
        $.ajax({url:"tierras/reporestadompio",type:"POST",data:{dpto:$('#seldpto').val()},dataType:'json',
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
          $('#container').highcharts({
            chart:{type:'column'},
            title:{text:''},
            subtitle:{text:'Resultados por departamento'},
            xAxis:{
              categories:[
                @foreach($arrayvial[2] as $arraydat3)
                  {{'"'.$arraydat3->estado.' ",'}}
                @endforeach
              ],
              crosshair: true
            },
            yAxis:{min:0,title:{text:'Número de procesos'}},
            tooltip:{
              headerFormat:'<span style="font-size:12px">{point.key}</span><table>',
              pointFormat:'<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                  '<td style="padding:0"><b>{point.y:.0f} Procesos</b></td></tr>',
              footerFormat:'</table>'
            },
            plotOptions:{series:{borderWidth:0,dataLabels:{enabled:true,format:'{point.y:.0f}', style:{textShadow:''}}}},
            series:[
              {name:'Viable',
               data:data1[1]
              },
              {name:"No viable",
              data:data1[2]
              }
            ]
          });//Termina function highchart
        },
        error:function(){alert('error');}
      });//Termina Ajax prueva
      }
      else{
        $.ajax({url:"tierras/reporestadovda",type:"POST",data:{mpio:$('#selmpio').val()},dataType:'json',
          success:function(data){
            $("#labelvda").show();
            $("#selvda").show();
            $("#selvda").empty();
            $("#selvda").append("<option value=''>Por favor seleccione</option>");
            [].forEach.call(data[0],function(datos){
              $("#selvda").append("<option value=\""+datos.cod_unodc+"\">"+datos.nombre1+"</option>");
            });
            //console.log(valores)
            $('#container').highcharts({
            chart:{type:'column'},
            title:{text:''},
            subtitle:{text:'Resultados por municipio'},
            xAxis:{
              categories:[
                @foreach($arrayvial[2] as $arraydat3)
                  {{'"'.$arraydat3->estado.' ",'}}
                @endforeach
              ],
              crosshair: true
            },
            yAxis:{min:0,title:{text:'Número de procesos'}},
            tooltip:{
              headerFormat:'<span style="font-size:12px">{point.key}</span><table>',
              pointFormat:'<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                  '<td style="padding:0"><b>{point.y:.0f} Procesos</b></td></tr>',
              footerFormat:'</table>'
            },
            plotOptions:{series:{borderWidth:0,dataLabels:{enabled:true,format:'{point.y:.0f}', style:{textShadow:''}}}},
            series:[
              {name:'Viable',
               data:data[1]
              },
              {name:"No viable",
              data:data[2]
              }
            ]
          });//Termina function highchart
          },
          error:function(){alert('error');}
        });//Termina Ajax prueva
      }
    });//Termina change selmpio
    $("#selvda").change(function(){
      if($('#selvda').val()=='')
      {
        $.ajax({url:"tierras/reporestadovda",type:"POST",data:{mpio:$('#selmpio').val()},dataType:'json',
          success:function(data){
            $("#labelvda").show();
            $("#selvda").show();
            $("#selvda").empty();
            $("#selvda").append("<option value=''>Por favor seleccione</option>");
            [].forEach.call(data[0],function(datos){
              $("#selvda").append("<option value=\""+datos.cod_unodc+"\">"+datos.nombre1+"</option>");
            });
            //console.log(valores)
            $('#container').highcharts({
            chart:{type:'column'},
            title:{text:''},
            subtitle:{text:'Resultados por municipio'},
            xAxis:{
              categories:[
                @foreach($arrayvial[2] as $arraydat3)
                  {{'"'.$arraydat3->estado.' ",'}}
                @endforeach
              ],
              crosshair: true
            },
            yAxis:{min:0,title:{text:'Número de procesos'}},
            tooltip:{
              headerFormat:'<span style="font-size:12px">{point.key}</span><table>',
              pointFormat:'<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                  '<td style="padding:0"><b>{point.y:.0f} Procesos</b></td></tr>',
              footerFormat:'</table>'
            },
            plotOptions:{series:{borderWidth:0,dataLabels:{enabled:true,format:'{point.y:.0f}', style:{textShadow:''}}}},
            series:[
              {name:'Viable',
               data:data[1]
              },
              {name:"No viable",
              data:data[2]
              }
            ]
          });//Termina function highchart
          },
          error:function(){alert('error');}
        });//Termina Ajax prueva
      }
      else{
        $.ajax({url:"tierras/reporestadovdadet",type:"POST",data:{vda:$('#selvda').val()},dataType:'json',
          success:function(data){
            $('#container').highcharts({
            chart:{type:'column'},
            title:{text:''},
            subtitle:{text:'Resultados por vereda'},
            xAxis:{
              categories:[
                @foreach($arrayvial[2] as $arraydat3)
                  {{'"'.$arraydat3->estado.' ",'}}
                @endforeach
              ],
              crosshair: true
            },
            yAxis:{min:0,title:{text:'Número de procesos'}},
            tooltip:{
              headerFormat:'<span style="font-size:12px">{point.key}</span><table>',
              pointFormat:'<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                  '<td style="padding:0"><b>{point.y:.0f} Procesos</b></td></tr>',
              footerFormat:'</table>'
            },
            plotOptions:{series:{borderWidth:0,dataLabels:{enabled:true,format:'{point.y:.0f}', style:{textShadow:''}}}},
            series:[
              {name:'Viable',
               data:data[0]
              },
              {name:"No viable",
              data:data[1]
              }
            ]
          });//Termina function highchart
          },
          error:function(){alert('error');}
        });//Termina Ajax prueva
      }
    });//Termina change selvda
  });
  </script>
@stop
@endif<!--Cierra el if de mostrar el contenido de la página si esta autenticado-->